<?php
require 'pdo.php';
require 'class/encode.php';
require 'class/player.php';
require 'class/lexical_analysis.php';

// 初始化数据库连接和类
$dblj = DB::pdo();
if(!$encode){
    $encode = new \encode\encode();
}
if(!$player){
    $player = new \player\player();
}

// 记录抽奖日志
function logDrawActivity($sid, $action, $result, $details, $dblj) {
    $sql = "INSERT INTO system_draw_log (sid, action, result, details, ip_address, time) 
            VALUES (:sid, :action, :result, :details, :ip, NOW())";
    try {
        $stmt = $dblj->prepare($sql);
        $stmt->execute([
            ':sid' => $sid,
            ':action' => $action,
            ':result' => $result,
            ':details' => $details,
            ':ip' => $_SERVER['REMOTE_ADDR']
        ]);
    } catch (PDOException $e) {
        error_log("Draw log error: " . $e->getMessage());
    }
}

// 抽奖核心逻辑
if (isset($_POST['cmd'])) {
    try {
        $Dcmd = $encode->decode($_POST['cmd']);
        if (!$Dcmd) {
            throw new Exception("无效的请求");
        }
        
        // 解析命令参数
        parse_str($Dcmd, $variables);
        
        // 验证必要参数
        if (!isset($variables['sid']) || !isset($variables['action']) || !isset($variables['reward_change'])) {
            throw new Exception("缺少必要参数");
        }
        
        // 提取变量
        extract($variables);
        
        // 验证sid格式
        if (!preg_match('/^[a-zA-Z0-9]+$/', $sid)) {
            throw new Exception("无效的会话ID");
        }
        
        // 验证reward_change (应为数字)
        if (!is_numeric($reward_change) || $reward_change <= 0) {
            throw new Exception("无效的奖励ID");
        }
        
        // 验证CSRF令牌 (如果实现了令牌系统)
        if (isset($variables['csrf_token'])) {
            // 检查令牌有效性的代码
        }
        
        // 抽奖处理
        if (isset($action) && $action === 'spin') {
            header('Content-Type: application/json');
            
            // 计算奖品函数
            function calculatePrize($prizes) {
                if (empty($prizes)) {
                    return -1;
                }
                
                $totalWeight = 0;
                foreach ($prizes as $prize) {
                    if (!isset($prize['probability']) || !is_numeric($prize['probability'])) {
                        continue;
                    }
                    $totalWeight += floatval($prize['probability']);
                }
                
                if ($totalWeight <= 0) {
                    return -1;
                }
                
                // 使用安全的随机数生成
                if (function_exists('random_int')) {
                    $random = random_int(0, PHP_INT_MAX) / PHP_INT_MAX * $totalWeight;
                } else {
                    // 兼容性处理
                    $random = mt_rand(0, mt_getrandmax()) / mt_getrandmax() * $totalWeight;
                }
                
                $currentWeight = 0;
                foreach ($prizes as $index => $prize) {
                    $currentWeight += floatval($prize['probability']);
                    if ($random <= $currentWeight) {
                        return $index;
                    }
                }
                
                return count($prizes) - 1; // 兜底，防止异常
            }
            
            // 获取抽奖配置
            try {
                $sql = "SELECT * FROM system_draw WHERE id = :id";
                $stmt = $dblj->prepare($sql);
                $stmt->execute([':id' => $reward_change]);
                $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$ret) {
                    throw new Exception("未找到抽奖配置");
                }
                
                $reward_name = $ret['name'];
                $reward_cons_type = $ret['cons_type'];
                $reward_cons_count = $ret['cons_count'];
                
                // 安全地解析参数
                $cons_parts = explode('|', $reward_cons_count);
                if (count($cons_parts) < 2) {
                    throw new Exception("抽奖配置格式错误");
                }
                
                $reward_cons_count_type = $cons_parts[0];
                $reward_cons_count_final = intval($cons_parts[1]);
                
                $reward_cons_open_time = $ret['cons_open_time'];
                $reward_cons_close_time = $ret['cons_close_time'];
                $current_time = time(); // 获取当前时间戳
                
                // 验证时间有效性
                if (empty($reward_cons_open_time) || empty($reward_cons_close_time)) {
                    throw new Exception("抽奖时间配置错误");
                }
                
                // 检查活动时间
                if ($current_time < strtotime($reward_cons_open_time) || $current_time > strtotime($reward_cons_close_time)) {
                    die(json_encode([
                        'error' => '抽奖活动未开始或已结束',
                        'index' => -1,
                        'prize' => ''
                    ]));
                }
                
                // 解析奖品数据
                $reward_gift_para = explode(",", $ret['draw_reward']);
                $prizes = [];
                
                // 开始事务
                $dblj->beginTransaction();
                
                // 检查消耗品
                $super_prizeIndex = -1;
                
                switch($reward_cons_type) {
                    case '1': // 货币类型
                        $attr = 'u' . $reward_cons_count_type;
                        // 使用参数绑定防止SQL注入
                        $sql = "SELECT $attr FROM game1 WHERE sid = :sid";
                        $stmt = $dblj->prepare($sql);
                        $stmt->execute([':sid' => $sid]);
                        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (!$ret) {
                            throw new Exception("找不到玩家数据");
                        }
                        
                        $money_count = intval($ret[$attr]);
                        if ($money_count >= $reward_cons_count_final) {
                            $sql = "UPDATE game1 SET $attr = $attr - :amount WHERE sid = :sid";
                            $stmt = $dblj->prepare($sql);
                            $stmt->bindParam(':amount', $reward_cons_count_final, PDO::PARAM_INT);
                            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $stmt->execute();
                            $super_prizeIndex = 1;
                        } else {
                            $super_prizeIndex = -1;
                        }
                        break;
                        
                    case '2': // 物品类型
                        // 使用参数绑定防止SQL注入
                        $sql = "SELECT icount FROM system_item WHERE sid = :sid AND iid = :iid";
                        $stmt = $dblj->prepare($sql);
                        $stmt->execute([
                            ':sid' => $sid,
                            ':iid' => $reward_cons_count_type
                        ]);
                        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (!$ret) {
                            throw new Exception("找不到物品数据");
                        }
                        
                        $item_count = intval($ret['icount']);
                        if ($item_count >= $reward_cons_count_final) {
                            $sql = "UPDATE system_item SET icount = icount - :amount WHERE sid = :sid AND iid = :iid";
                            $stmt = $dblj->prepare($sql);
                            $stmt->bindParam(':amount', $reward_cons_count_final, PDO::PARAM_INT);
                            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $stmt->bindParam(':iid', $reward_cons_count_type, PDO::PARAM_STR);
                            $stmt->execute();
                            $super_prizeIndex = 1;
                        } else {
                            $super_prizeIndex = -1;
                        }
                        break;
                        
                    case '3': // 属性类型
                        $attr = 'u' . $reward_cons_count_type;
                        // 使用参数绑定防止SQL注入
                        $sql = "SELECT $attr FROM game1 WHERE sid = :sid";
                        $stmt = $dblj->prepare($sql);
                        $stmt->execute([':sid' => $sid]);
                        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (!$ret) {
                            throw new Exception("找不到玩家数据");
                        }
                        
                        $attr_count = intval($ret[$attr]);
                        if ($attr_count >= $reward_cons_count_final) {
                            $sql = "UPDATE game1 SET $attr = $attr - :amount WHERE sid = :sid";
                            $stmt = $dblj->prepare($sql);
                            $stmt->bindParam(':amount', $reward_cons_count_final, PDO::PARAM_INT);
                            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $stmt->execute();
                            $super_prizeIndex = 1;
                        } else {
                            $super_prizeIndex = -1;
                        }
                        break;
                        
                    default:
                        $super_prizeIndex = -1;
                }
                
                // 如果有足够的资源，解析奖品
                if ($super_prizeIndex == 1) {
                    foreach ($reward_gift_para as $gift) {
                        // 安全地解析奖品参数
                        $reward_gift_detail_para = explode("|", $gift);
                        if (count($reward_gift_detail_para) < 3) {
                            continue; // 跳过格式不正确的奖品
                        }
                        
                        $reward_gift_id = trim($reward_gift_detail_para[0]);
                        $reward_gift_count = intval($reward_gift_detail_para[1]);
                        $reward_gift_probability = floatval($reward_gift_detail_para[2]);
                        
                        // 验证数据有效性
                        if (empty($reward_gift_id) || $reward_gift_count <= 0 || $reward_gift_probability < 0) {
                            continue;
                        }
                        
                        try {
                            $reward_gift_root_name = \player\getitem($reward_gift_id, $dblj)->iname;
                            $reward_gift_name = \lexical_analysis\color_string($reward_gift_root_name);
                            
                            $prizes[] = [
                                'real_name' => $reward_gift_name,
                                'real_id' => $reward_gift_id,
                                'real_count' => $reward_gift_count,
                                'probability' => $reward_gift_probability
                            ];
                        } catch (Exception $e) {
                            error_log("Error loading prize item: " . $e->getMessage());
                            continue;
                        }
                    }
                    
                    // 执行抽奖
                    $prizeIndex = calculatePrize($prizes);
                } else {
                    $final = '你没有足够的抽取消耗！';
                    $prizeIndex = -1;
                }
                
                // 处理抽奖结果
                if ($prizeIndex >= 0 && isset($prizes[$prizeIndex])) {
                    $prizeID = $prizes[$prizeIndex]['real_id'];
                    $prizeCount = $prizes[$prizeIndex]['real_count'];
                    
                    ob_start();
                    try {
                        if ($prizeID) {
                            $get_ret = \player\additem($sid, $prizeID, $prizeCount, $dblj);
                            if (!$get_ret) {
                                throw new Exception("添加物品失败");
                            }
                        } else {
                            echo '奖品配置错误！';
                        }
                    } catch (Exception $e) {
                        echo '领取奖品时出错：' . $e->getMessage();
                    }
                    $final = ob_get_clean();
                } else {
                    $final = '抽奖失败，请稍后再试！';
                    $prizeIndex = -1;
                }
                
                // 提交或回滚事务
                if (!empty($final)) {
                    // 有错误信息，回滚事务
                    $dblj->rollBack();
                    logDrawActivity($sid, 'spin', 'failed', $final, $dblj);
                } else {
                    // 提交事务
                    $dblj->commit();
                    logDrawActivity($sid, 'spin', 'success', json_encode([
                        'prize_id' => $prizeID, 
                        'prize_count' => $prizeCount,
                        'prize_name' => $prizes[$prizeIndex]['real_name']
                    ]), $dblj);
                }
                
                // 返回结果
                die(json_encode([
                    'error' => $final,
                    'index' => $prizeIndex,
                    'prize' => isset($prizes[$prizeIndex]['real_name']) ? $prizes[$prizeIndex]['real_name'] : ''
                ]));
                
            } catch (PDOException $e) {
                if ($dblj->inTransaction()) {
                    $dblj->rollBack();
                }
                error_log("Draw system error (DB): " . $e->getMessage());
                die(json_encode([
                    'error' => '系统错误，请稍后再试',
                    'index' => -1,
                    'prize' => ''
                ]));
            }
        }
    } catch (Exception $e) {
        error_log("Draw system error: " . $e->getMessage());
        header('Content-Type: application/json');
        die(json_encode([
            'error' => '请求处理错误',
            'index' => -1,
            'prize' => ''
        ]));
    }
}
?>