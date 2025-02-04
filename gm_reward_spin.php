<?php
require 'pdo.php';
require 'class/encode.php';
require 'class/player.php';
require 'class/lexical_analysis.php';

$dblj = DB::pdo();
/******************** 抽奖逻辑处理 ********************/
if(!$encode){
$encode = new \encode\encode();
}
if(!$player){
$player = new \player\player();
}
$Dcmd = $encode->decode($_POST['cmd'] );
parse_str($Dcmd,$variables);
extract($variables);
if (isset($action) && $action === 'spin') {
    header('Content-Type: application/json');
    
    function calculatePrize($prizes) {
        $totalWeight = array_sum(array_column($prizes, 'probability'));
        // 方法一：转换为整数处理（保持精度）
        $scale = 1000000; // 保留6位小数精度
        $random = mt_rand(1, $totalWeight * $scale);
        
        // 方法二：使用PHP7+的random_int
        $random = random_int(0, PHP_INT_MAX) / PHP_INT_MAX * $totalWeight;
    
        $currentWeight = 0;
        foreach ($prizes as $index => $prize) {
            $currentWeight += $prize['probability'];
            if ($random <= $currentWeight) {
                return $index;
            }
        }
        return count($prizes) - 1; // 兜底，防止异常
    }
    
$sql = "SELECT * FROM system_draw WHERE id = :id";
$stmt = $dblj->prepare($sql);
$stmt->execute([':id' => $reward_change]);
$ret = $stmt->fetch(PDO::FETCH_ASSOC);

$reward_name = $ret['name'];
$reward_cons_type = $ret['cons_type'];
$reward_cons_count = $ret['cons_count'];
$reward_cons_count_type = explode('|',$reward_cons_count)[0];
$reward_cons_count_final = explode('|',$reward_cons_count)[1];
$reward_cons_open_time = $ret['cons_open_time'];
$reward_cons_close_time = $ret['cons_close_time'];
$current_time = time(); // 获取当前时间戳
// 重新解析奖品数据（与页面逻辑一致）
$reward_gift_para = explode(",", $ret['draw_reward']);
$prizes = [];

if ($current_time >=strtotime($reward_cons_open_time)  && $current_time <= strtotime($reward_cons_close_time)){
    
// 开始事务
$dblj->beginTransaction();
switch($reward_cons_type){
    case '1':
        $attr = 'u'.$reward_cons_count_type;
        $sql = "select $attr from game1 where sid = '$sid'";
        $cxjg = $dblj->query($sql);
        $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        $money_count = $ret[$attr];
        if($money_count>=$reward_cons_count_final){
            $dblj->exec("update game1 set $attr = $attr - $reward_cons_count_final where sid = '$sid' ");
            $super_prizeIndex = 1;
        }else{
            $super_prizeIndex = -1;
        }
        break;
    case '2':
        $sql = "select icount from system_item where sid = '$sid' and iid = '$reward_cons_count_type'";
        $cxjg = $dblj->query($sql);
        $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        $item_count = $ret['icount'];
        if($item_count>=$reward_cons_count_final){
            $dblj->exec("update system_item set icount = icount - $reward_cons_count_final where sid = '$sid' and  iid = '$reward_cons_count_type'");
            
            $super_prizeIndex = 1;
        }else{
            $super_prizeIndex = -1;
        }
        break;
    case '3':
        $attr = 'u'.$reward_cons_count_type;
        $sql = "select $attr from game1 where sid = '$sid'";
        $cxjg = $dblj->query($sql);
        $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        $attr_count = $ret[$attr];
        if($attr_count>=$reward_cons_count_final){
            $dblj->exec("update game1 set $attr = $attr - $reward_cons_count_final where sid = '$sid' ");
            
            $super_prizeIndex = 1;
        }else{
            $super_prizeIndex = -1;
        }
        break;
    default:
        $super_prizeIndex = -1;
}

if($super_prizeIndex==1){
foreach ($reward_gift_para as $gift) {
    $reward_gift_detail = $gift;
    $reward_gift_detail_para = explode("|", $reward_gift_detail);
    $reward_gift_id = $reward_gift_detail_para[0];
    $reward_gift_count = $reward_gift_detail_para[1];
    $reward_gift_probability = $reward_gift_detail_para[2];
    $reward_gift_root_name = \player\getitem($reward_gift_id, $dblj)->iname;
    $reward_gift_name = \lexical_analysis\color_string($reward_gift_root_name);
    $prizes[] = [
            'real_name' =>"{$reward_gift_name}",
            'real_id' =>"{$reward_gift_id}",
            'real_count'=>"{$reward_gift_count}",
            'probability' =>"{$reward_gift_probability}"
        ];
}
    // 执行抽奖
    $prizeIndex = calculatePrize($prizes);
}else{
    $final = '你没有足够的抽取消耗！<br/>';
}
}

$prizeID = $prizes[$prizeIndex]['real_id'];
$prizeCount = $prizes[$prizeIndex]['real_count'];
ob_start();
if($prizeID){
$get_ret = \player\additem($sid,$prizeID,$prizeCount,$dblj);
}else{
echo '你没有足够的抽取消耗！<br/>';
}
$final = ob_get_clean();


if($final){
        // 如果发生异常，则回滚事务
        $dblj->rollBack();
}else{
        // 提交事务
        $dblj->commit();
}

    die(json_encode([
        'error' => $final,
        'index' => $prizeIndex,
        'prize' => $prizes[$prizeIndex]['real_name']
    ]));
}
?>