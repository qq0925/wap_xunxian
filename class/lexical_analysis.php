<?php
namespace lexical_analysis;

use DB;
use PDO;
use ParseError;
use Error;

//解析各个地方传来的{}。

//input是原始输入，sid是用户识别码，uid用于特殊事件，oid用于o关键字，mid用于获取当前场景id或npc的id,para用于分辨是泛字符串解析还是纯变量解析

class Cache {
    private static $cache = [];
    private static $expiry = [];

    public static function set($key, $value, $ttl) {
        self::$cache[$key] = $value;
        self::$expiry[$key] = time() + $ttl;
    }

    public static function get($key) {
        if (isset(self::$cache[$key]) && time() < self::$expiry[$key]) {
            return self::$cache[$key];
        }
        return false;
    }

    public static function clear($key) {
        unset(self::$cache[$key]);
        unset(self::$expiry[$key]);
    }
}

require_once 'pdo.php';

function hurt_calc($jid = null, $sid, $gid, $type, $dblj, $pid = null)
{
    $ngid = explode(',', $gid);
    $db = DB::pdo();
    //这段是处理伤害公式的获取
    if ($jid) {
        $sql = "SELECT * FROM system_skill WHERE jid = :jid";
        $stmt = $db->prepare($sql);
        $stmt->execute([':jid' => $jid]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $j_hurt_exp = $row['jhurt_exp'];
            $j_group_attack = $row['jgroup_attack'];
            $j_umsg = $row['jeffect_cmmt'];
            $j_event_use_id = $row['jevent_use_id'];
        }
        if (!$j_hurt_exp) {
            $sql = "SELECT jhurt_exp FROM system_skill_module WHERE jid = '2'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $j_hurt_exp = $row['jhurt_exp'];
            }
            if (!$j_hurt_exp) {
                $j_hurt_exp = 1;
            }
        }
    }

    if ($pid) {
        // 先做单宠，传入pid为3，无忙碌状态
        $sql = "SELECT * FROM system_skill_user WHERE jpid = :pid";
        $stmt = $db->prepare($sql);
        $stmt->execute([':pid' => $pid]);
        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($ret) {
            $pets_skills = $ret['jid'];
            if (!$pets_skills) {
                $sql = "SELECT default_skill_id FROM gm_game_basic";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                $pets_skills = $ret['default_skill_id'];
            } else {
                $sql = "SELECT jhurt_exp, jeffect_cmmt, jgroup_attack, jevent_use_id FROM system_skill WHERE jid = :pets_skills";
                $stmt = $db->prepare($sql);
                $stmt->execute([':pets_skills' => $pets_skills]);
                $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($ret) {
                    $p_umsg = $ret['jeffect_cmmt'];
                    $p_hurt_exp = $ret['jhurt_exp'];
                    $p_group_attack = $ret['jgroup_attack'];
                    $p_event_use_id = $ret['jevent_use_id'];
                }
                
                if (!$p_hurt_exp) {
                    $sql = "SELECT jhurt_exp FROM system_skill_module WHERE jid = '2'";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($row) {
                        $p_hurt_exp = $row['jhurt_exp'];
                    }
                    
                    if (!$p_hurt_exp) {
                        $p_hurt_exp = 1;
                    }
                }
            }
        }
    }

    //这段是处理操作
    if ($type == 1) {
        //-1表示群体攻击
        if ($j_group_attack == '-1') {
            $ngid_count = count($ngid);
            for ($i = 0; $i < $ngid_count; $i++) {
                $attack_gid_root = "";
                $attack_gid = $ngid[$i];
                $attack_gid_root = \player\getguaiwu_alive($attack_gid, $dblj)->nid;
                if ($attack_gid_root) {
                    $attack_gid_para = $attack_gid_root . "|" . $attack_gid;
                    if ($j_event_use_id != 0) {
                        include_once 'class/events_steps_change.php';
                        events_steps_change($j_event_use_id, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc', $attack_gid_para, $para);
                    }
                    global_events_steps_change(5, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc', $attack_gid_para, $para);
                    global_events_steps_change(28, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc', $attack_gid_para, $para);
                    $hurt_cut = process_string($j_hurt_exp, $sid, 'npc', $attack_gid_para, $jid, 'fight');
                    $hurt_cut = @eval("return $hurt_cut;"); // 计算 eval 表达式的结果
                    $hurt_cut = (int)floor($hurt_cut);
                    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
                    $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - $hurt_cut, nsid = '$sid' WHERE ngid = '$attack_gid'";
                    $dblj->exec($sql);
                    $sql = "UPDATE game2 SET hurt_hp = '$hurt_cut' WHERE gid = '$attack_gid'";
                    $dblj->exec($sql);
                    $j_umsg = \lexical_analysis\process_string($j_umsg, $sid, 'npc', $attack_gid_para);
                    $sql = "UPDATE game2 SET fight_umsg = '$j_umsg' WHERE sid = '$sid'";
                    $cxjg = $dblj->exec($sql);
                }
            }
        } else {
            for ($i = 0; $i < $j_group_attack; $i++) {
                $attack_gid_root = "";
                $attack_gid = $ngid[$i];
                $attack_gid_root = \player\getguaiwu_alive($attack_gid, $dblj)->nid;
                $attack_gid_para = $attack_gid_root . "|" . $attack_gid;
                if ($attack_gid_root) {
                    if ($j_event_use_id != 0) {
                        include_once 'class/events_steps_change.php';
                        events_steps_change($j_event_use_id, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc', $attack_gid_para, $para);
                    }
                    global_events_steps_change(5, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc', $attack_gid_para, $para);
                    global_events_steps_change(28, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc', $attack_gid_para, $para);
                    $hurt_cut = process_string($j_hurt_exp, $sid, 'npc', $attack_gid_para, $jid, 'fight');
                    $hurt_cut = @eval("return $hurt_cut;"); // 计算 eval 表达式的结果
                    $hurt_cut = (int)floor($hurt_cut);
                    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
                    $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - :hurt_cut, nsid = :sid WHERE ngid = :attack_gid";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute([':hurt_cut' => $hurt_cut, ':sid' => $sid, ':attack_gid' => $attack_gid]);
                    
                    $sql = "UPDATE game2 SET hurt_hp = :hurt_cut WHERE gid = :attack_gid";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute([':hurt_cut' => $hurt_cut, ':attack_gid' => $attack_gid]);
                    
                    $j_umsg = \lexical_analysis\process_string($j_umsg, $sid, 'npc', $attack_gid_para);
                    $sql = "UPDATE game2 SET fight_umsg = :j_umsg WHERE sid = :sid AND gid = :attack_gid";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute([':j_umsg' => $j_umsg, ':sid' => $sid, ':attack_gid' => $attack_gid]);
                }
            }
        }
    } elseif ($type == 2) {
        for ($i = 0; $i < @count($ngid); $i++) {
            $monster_skills = '';
            $monster_skills_arr = [];
            $attack_gid = $ngid[$i];
            $attack_gid_root = \player\getguaiwu_alive($attack_gid, $dblj)->nid;
            $attack_gid_para = $attack_gid_root . "|" . $attack_gid;
            $guai_busy = \player\get_temp_attr($attack_gid_para, 'busy', 2, $dblj);
            if ($guai_busy > 0) {
                $dblj->exec("UPDATE game2 SET cut_hp = '', fight_omsg = '正忙，不能出招！' WHERE gid = '$attack_gid'");
                \player\update_temp_attr($attack_gid_para, 'busy', 2, $dblj, 2, -1);
            } else {
                $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = '$attack_gid' AND nhp > 0";
                $stmt = $dblj->query($sql);
                $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($ret) {
                    $monster_skills = $ret['nskills'];
                    if (!$monster_skills) {
                        $sql = "SELECT default_skill_id FROM gm_game_basic";
                        $stmt = $dblj->query($sql);
                        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                        $monster_skills = $ret['default_skill_id'];
                    } else {
                        $monster_skills_lists = explode(',', $monster_skills);
                        foreach ($monster_skills_lists as $monster_skills_list) {
                            $monster_skills_list_only = explode('|', $monster_skills_list);
                            $monster_skills_arr[] = $monster_skills_list_only[0];
                        }
                        $random_key = array_rand($monster_skills_arr);
                        $random_number = $monster_skills_arr[$random_key];
                        $sql = "SELECT jhurt_exp, jeffect_cmmt, jgroup_attack FROM system_skill WHERE jid = '$random_number'";
                        $stmt = $dblj->query($sql);
                        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                        $j_omsg = $ret['jeffect_cmmt'];
                        $j_hurt_exp = $ret['jhurt_exp'];
                        $j_group_attack = $ret['jgroup_attack'];
                        
                        if (!$j_hurt_exp) {
                            $sql = "SELECT jhurt_exp FROM system_skill_module WHERE jid = '2'";
                            $stmt = $dblj->query($sql);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $j_hurt_exp = $row['jhurt_exp'] ?? 1;
                        }
                        $j_omsg = \lexical_analysis\process_string_2($j_omsg, $sid, $attack_gid);
                        $dblj->exec("UPDATE game2 SET fight_omsg = '$j_omsg' WHERE gid = '$attack_gid'");

                        $hurt_cut = process_string_2($j_hurt_exp, $sid, $attack_gid, $random_number, $random_number, null, 1);
                        $hurt_cut = @eval("return $hurt_cut;");
                        $hurt_cut = (int)floor($hurt_cut);
                        $g_hurt_cut = ($hurt_cut >= 0) ? abs($hurt_cut) : 1;
                        
                        $dblj->exec("UPDATE game1 SET uhp = uhp - '$g_hurt_cut' WHERE sid = '$sid'");
                        $dblj->exec("UPDATE game2 SET cut_hp = '$g_hurt_cut' WHERE sid = '$sid' AND gid = '$attack_gid'");
                    }
                } else {
                    $dblj->exec("UPDATE game2 SET cut_hp = '' WHERE gid = '$attack_gid'");
                }
            }
        }
    } elseif ($type == 3) {
        //-1表示群体攻击
        if ($p_group_attack == '-1') {
            $ngid_count = count($ngid);

            for ($i = 0; $i < $ngid_count; $i++) {
                $attack_gid_root = "";
                $attack_gid = $ngid[$i];
                $attack_gid_root = \player\getguaiwu_alive($attack_gid, $dblj)->nid;

                if ($attack_gid_root) {
                    $attack_gid_para = $attack_gid_root . "|" . $attack_gid;
                    
                    $hurt_cut = process_string_3($p_hurt_exp, $pid, $attack_gid, $pets_skills, $sid, null, 1);
                    $hurt_cut = @eval("return $hurt_cut;"); 
                    $hurt_cut = (int)floor($hurt_cut);
                    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
                    
                    $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - $hurt_cut, nsid = '$sid' WHERE ngid = '$attack_gid'";
                    $dblj->exec($sql);
                    
                    $sql = "UPDATE game2 SET hurt_hp = hurt_hp + $hurt_cut WHERE gid = '$attack_gid'";
                    $dblj->exec($sql);
                    
                    $p_umsg = \lexical_analysis\process_string_3($p_umsg, $pid, $attack_gid, $pets_skills, $sid, null, 1);
                    
                    $sql = "UPDATE game2 SET fight_umsg = '$p_umsg' WHERE sid = '$sid' AND gid = '$attack_gid' AND pid = '$pid'";
                    $dblj->exec($sql);
                }
            }
        } else {
            for ($i = 0; $i < $p_group_attack; $i++) {
                $attack_gid_root = "";
                $attack_gid = $ngid[$i];
                $attack_gid_root = \player\getguaiwu_alive($attack_gid, $dblj)->nid;
                $attack_gid_para = $attack_gid_root . "|" . $attack_gid;
                if ($attack_gid_root) {
                    $hurt_cut = process_string_3($p_hurt_exp, $pid, $attack_gid, $pets_skills, $sid, null, 1);
                    $hurt_cut = @eval("return $hurt_cut;"); 
                    $hurt_cut = (int)floor($hurt_cut);
                    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
                    
                    $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - $hurt_cut, nsid = '$sid' WHERE ngid = '$attack_gid'";
                    $dblj->exec($sql);
                    
                    $sql = "UPDATE game2 SET hurt_hp = hurt_hp + $hurt_cut WHERE gid = '$attack_gid'";
                    $dblj->exec($sql);

                    $p_umsg = \lexical_analysis\process_string_3($p_umsg, $pid, $attack_gid, $pets_skills, $sid, null, 1);

                    $sql = "UPDATE game2 SET fight_umsg = :p_umsg WHERE sid = :sid AND gid = :attack_gid AND pid = :pid";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute([
                        ':p_umsg' => $p_umsg,
                        ':sid' => $sid,
                        ':attack_gid' => $attack_gid,
                        ':pid' => $pid
                    ]);
                }
            }
        }
    }
}




//---------分割线----------//
function evaluate_expression($expr, $db, $sid, $oid, $mid, $jid, $type, $para = null)
{
    $expr = preg_replace_callback('/\{eval\((.*?)\)\}/', function ($matches) use ($db, $sid, $oid, $mid, $jid, $type, $para) {
        // /\{eval\(([^)]+)\)\}/
        $eval_expr = $matches[1]; // 获取 eval 中的表达式
        $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
        if (is_float($eval_result) && !is_string($eval_result)) {
            return (int)$eval_result;
        } else {
            return $eval_result; // 返回计算结果
        }
    }, $expr);
    $expr = preg_replace_callback('/\{([^}]+)\}/', function ($matches) use ($db, $sid, $oid, $mid, $jid, $type, $para) {
        $attr = $matches[1]; // 获取匹配到的变量名
        $firstDotPosition = strpos($attr, '.');
        if (!empty($firstDotPosition)) {
            $attr1 = substr($attr, 0, $firstDotPosition);
            $attr2 = substr($attr, $firstDotPosition + 1);
            // 使用 process_attribute 处理单个属性
            $op = process_attribute($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para);
            // 替换字符串中的变量
        }

        // 在这里根据变量名获取对应的值，例如从数据库中查询
        // 假设你从数据库中获取了 $attr_value]
        if ($para == 'cond_exp') {
            $op = "(bool)\"$op\"";
        }

        return $op;
    }, $expr);
    // 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
    $result = $expr;
    try {
        //$result = eval("return $expr;");
    } catch (ParseError $e) {
        print("语法错误: " . $e->getMessage());
    } catch (Error $e) {
        print("执行错误: " . $e->getMessage());
    }
    return $result;
}

function process_attribute($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para = null)
{
    $db = DB::pdo();
    switch ($attr1) {
        case 'u':
            if (strpos($attr2, "env.") === 0) {
                $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                switch ($attr3) {
                    case 'user_count':
                        // 构建 SQL 查询语句
                        $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = :sid) and uis_sailing = 0";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $op = $stmt->fetchColumn();
                        break;
                    case 'npc_count':
                        $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 处理结果
                        $totalNpcCount = 0;
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row) {
                            $mnpc = $row["mnpc_now"];
                            $npcs = explode(",", $mnpc); // 拆分成每个npc项
                            foreach ($npcs as $npc) {
                                $npc_show_cond = urldecode(explode("|", $npc)[2]);
                                $show_cond = checkTriggerCondition($npc_show_cond, $dblj, $sid);
                                if (is_null($show_cond)) {
                                    $show_cond = true;
                                }
                                if ($show_cond) {
                                    list(, $npcCount) = explode("|", $npc);
                                    $totalNpcCount += (int)$npcCount; // 将每个npc的数量累加
                                }
                            }
                        }

                        $op = $totalNpcCount;
                        break;
                    case 'monster_count':
                        $sql = "SELECT COUNT(*) as count FROM system_npc_midguaiwu WHERE nsid = '' and nmid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $op = $stmt->fetchColumn();
                        break;
                    case 'item_count':
                        $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // 处理结果
                        $totalItemCount = 0;
                        foreach ($rows as $row) {
                            $mitem = $row["mitem_now"];
                            $items = explode(",", $mitem); // 拆分成每个item项
                            foreach ($items as $item) {
                                list(, $itemCount) = explode("|", $item);
                                $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                            }
                        }
                        $op = $totalItemCount;
                        break;
                    case 'justmid':
                        // 构建 SQL 查询语句
                        $sql = "SELECT justmid FROM game1 WHERE sid = :sid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $op = $row["justmid"];
                        break;
                    case 'nowmid':
                        // 构建 SQL 查询语句
                        $sql = "SELECT nowmid FROM game1 WHERE sid = :sid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $op = $row["nowmid"];
                        break;
                    case 'name':
                        // 构建 SQL 查询语句
                        $sql = "SELECT mname FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $op = $row["mname"];

                        $sql = "SELECT uis_sailing FROM game1 WHERE sid = :sid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $is_sailing = $row["uis_sailing"];
                        if ($is_sailing == 1) {
                            $op = "茫茫大海";
                        }
                        break;
                }
            } elseif (strpos($attr2, "input.") === 0) {
                $attr3 = substr($attr2, 6); // 提取 "input." 后面的部分
                switch ($attr3) {
                    case 'value':
                        // 构建 SQL 查询语句
                        $sql = "SELECT * FROM system_player_inputs WHERE sid = :sid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $op = $row["value"];
                        if ($op === null || $op == '') {
                            $op = "\"\""; // 或其他默认值
                        }
                        break;
                }
            } elseif (strpos($attr2, "refresh_time") === 0) {
                $sql = "SELECT mgtime, mrefresh_time FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->execute([':sid' => $sid]);
                // 获取查询结果
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nowdate = date('Y-m-d H:i:s');
                $mid_time = $row["mgtime"];
                $mid_refresh_time = $row['mrefresh_time'];
                $op = $mid_refresh_time - floor((strtotime($nowdate) - strtotime($mid_time)) / 60); //获取刷新分钟剩余
            } elseif (strpos($attr2, "team_member_count") === 0) {
               $sql = "SELECT team_member FROM system_team_user WHERE team_member IN (SELECT uid FROM game1 WHERE sid = :sid)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute([':sid' => $sid]);
                // 获取查询结果
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $team_member = $row["team_member"];
                $op = @count(explode(',', $team_member));
            } elseif (strpos($attr2, "team_members") === 0) {
                $attr3 = substr($attr2, 13); // 提取 "team_members." 后面的部分
                $para = explode(".", $attr3);
                $order = intval($para[0]);
                $attr_player = "u" . $para[1];
                $sql = "
    SELECT g1.*
    FROM game1 g1
    JOIN system_team_user stu ON FIND_IN_SET(g1.uid, stu.team_member) > 0
    WHERE EXISTS (
        SELECT uid
        FROM game1
        WHERE sid = :sid
    )
    ORDER BY FIND_IN_SET(g1.uid, stu.team_member);
";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute([':sid' => $sid]);
                // 获取查询结果
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // 获取指定顺序的行
                $row = isset($rows[$order]) ? $rows[$order] : null;
                $op = $row ? ($row[$attr_player] ?? null) : null;
            } elseif (strpos($attr2, "tasks.") === 0) {
                $attr3 = substr($attr2, 6); // 提取 "tasks." 后面的部分
                if (strpos($attr3, 't') === 0) {
                    $attr3 = substr($attr3, 1); // 去掉开头的 "t"
                }
                $tid = $attr3;
                $sql = "SELECT ttype FROM system_task WHERE tid = :tid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':tid' => $tid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $ttype = $row["ttype"];

                $sql = "SELECT tstate FROM system_task_user WHERE tid = :tid AND sid = :sid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':tid' => $tid, ':sid' => $sid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $op = $row["tstate"];

                if (is_null($op)) {
                    $op = 0;
                } elseif ($ttype == 3) {
                    $op = 2;
                }
            } elseif (strpos($attr2, "ic.") === 0) {
                $attr3 = substr($attr2, 3); // 提取 "ic." 后面的部分
                if (strpos($attr3, 'i') === 0) {
                    $attr3 = substr($attr3, 1); // 去掉开头的 "i"
                }
                $iid = $attr3;
                $sql = "SELECT icount FROM system_item WHERE iid = :iid AND sid = :sid";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute([':iid' => $iid, ':sid' => $sid]);
                // 获取查询结果
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $op = $row["icount"] ?? 0;
            } elseif (strpos($attr2, "jv.") === 0) {
                $attr3 = substr($attr2, 3); // 提取 "jv." 后面的部分
                if (strpos($attr3, 'j') === 0) {
                    $attr3 = substr($attr3, 1); // 去掉开头的 "j"
                }
                $jid = $attr3;
                $sql = "SELECT jlvl FROM system_skill_user WHERE jid = :jid AND jsid = :sid";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute([':jid' => $jid, ':sid' => $sid]);
                // 获取查询结果
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $op = $row["jlvl"] ?? 0;
            } elseif (strpos($attr2, "enemys.") === 0) {
                $attr3 = substr($attr2, 7); // 提取 "enemys." 后面的部分
                $jid = $attr3;
                if ($attr3 == "count") {
                    $sql = "SELECT COUNT(*) as enemys_count FROM system_npc_midguaiwu WHERE nsid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $op = $stmt->fetchColumn();
                } else {
                    $para = explode(".", $attr3);
                    $order = (int)$para[0];
                    $attr_guai = "n" . $para[1];
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE nsid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (isset($rows[$order])) {
                        $op = $rows[$order][$attr_guai] ?? null;
                    } else {
                        $op = null;
                    }
                }
                if (is_null($op)) {
                    $op = 0;
                }
            } elseif (strpos($attr2, "alive_enemys.") === 0) {
                $attr3 = substr($attr2, 13); // 提取 "alive_enemys." 后面的部分
                $jid = $attr3;
                if ($attr3 == "count") {
                    $sql = "SELECT COUNT(*) as alive_enemys_count FROM system_npc_midguaiwu WHERE nhp > 0 AND nsid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $op = $stmt->fetchColumn();
                } else {
                    $para = explode(".", $attr3);
                    $order = (int)$para[0];
                    $attr_guai = "n" . $para[1];
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE nhp > 0 AND nsid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (isset($rows[$order])) {
                        $op = $rows[$order][$attr_guai] ?? null;
                    } else {
                        $op = null;
                    }
                }
                if (is_null($op)) {
                    $op = 0;
                }
            } elseif (strpos($attr2, "equips.") === 0) {
                $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
                if (strpos($attr3, 'b.') === 0) {
                    $attr4 = substr($attr3, 2); // 提取 "b." 后面的部分
                    $bid = $attr4;
                    $sql = "SELECT eq_true_id FROM system_equip_user WHERE eq_type = 1 AND eqsid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["eq_true_id"] ?? null;
                    if (!$op) {
                        $op = 0;
                    } else {
                        if (strpos($attr4, 'embed.') === 0) {
                            //镶物属性相关
                            $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                            if (preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)) {
                                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                                $mosaic_pos = rtrim($prefix, ".");

                                $attr6 = $matches[2]; // 匹配到的剩余部分
                            }
                            $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = :op";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            // 执行查询
                            $stmt->execute([':op' => $op]);

                            // 获取查询结果
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $mosaic_list = $row['equip_mosaic'];
                            $mosaic_para = explode('|', $mosaic_list);
                            if (!isset($mosaic_para[$mosaic_pos])) {
                                $op = 0;
                            } else {
                                $mosaic_id = $mosaic_para[$mosaic_pos];
                                $xid = "i" . $attr6;
                                $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :mosaic_id)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':mosaic_id' => $mosaic_id]);

                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row === null || $row == '') {
                                    $op = 0; // 或其他默认值
                                } else {
                                    $op = nl2br($row[$xid]);
                                }
                            }
                            //镶物属性相关
                        } else {
                            $bid = "i" . $bid;
                            $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :op)";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            // 执行查询
                            $stmt->execute([':op' => $op]);
                            // 获取查询结果
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($attr4 == "count") {
                                $op = $op ? 1 : 0;
                            } elseif ($attr4 == "embed_count") {
                                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = :op";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':op' => $op]);

                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row) {
                                    $op = count(explode('|', $row['equip_mosaic']));
                                } else {
                                    $op = 0;
                                }
                            } else {
                                if ($row === null || $row == '') {
                                    $op = 0; // 或其他默认值
                                } else {
                                    $op = nl2br($row[$bid]);
                                }
                            }
                        }
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                } elseif (preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)) {
                    $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                    $equiped_pos = rtrim($prefix, ".");
                    $attr4 = $matches[2]; // 匹配到的剩余部分
                    // SQL 查询语句
                    $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";

                    // 执行查询并检查是否有结果
                    $stmt = $db->query($sql);
                    $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    $equiped_pos = $idArray[$equiped_pos];

                    $fid = $attr4;
                    $sql = "SELECT eq_true_id FROM system_equip_user WHERE eq_type = 2 AND equiped_pos_id = :equiped_pos AND eqsid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':equiped_pos' => $equiped_pos, ':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["eq_true_id"] ?? 0;
                    
                    if ($op) {
                        if (strpos($attr4, 'embed.') === 0) {
                            $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                            if (preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)) {
                                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                                $mosaic_pos = rtrim($prefix, ".");

                                $attr6 = $matches[2]; // 匹配到的剩余部分
                            }
                            $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = :op";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            // 执行查询
                            $stmt->execute([':op' => $op]);

                            // 获取查询结果
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $mosaic_list = $row['equip_mosaic'] ?? '';
                            $mosaic_para = explode('|', $mosaic_list);
                            if (!isset($mosaic_para[$mosaic_pos])) {
                                $op = 0;
                            } else {
                                $mosaic_id = $mosaic_para[$mosaic_pos];
                                $xid = "i" . $attr6;
                                $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :mosaic_id)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':mosaic_id' => $mosaic_id]);

                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row === null || $row == '') {
                                    $op = 0; // 或其他默认值
                                } else {
                                    $op = nl2br($row[$xid]);
                                }
                            }
                            //镶物属性相关
                        } else {
                            $fid = "i" . $fid;
                            $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :op)";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            // 执行查询
                            $stmt->execute([':op' => $op]);

                            // 获取查询结果
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($attr4 == "count") {
                                $op = $op ? 1 : 0;
                            } elseif ($attr4 == "embed_count") {
                                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = :op";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':op' => $op]);

                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row) {
                                    $op = count(explode('|', $row['equip_mosaic']));
                                } else {
                                    $op = 0;
                                }
                            } else {
                                if ($row === null || $row == '') {
                                    $op = 0; // 或其他默认值
                                } else {
                                    $op = nl2br($row[$fid]);
                                }
                            }
                        }
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                }
            } elseif (strpos($attr2, "callout_adopt.") === 0) {
                $attr3 = substr($attr2, 14); // 提取 "callout_adopt." 后面的部分
                if (strpos($attr3, 'count') === 0) {
                    $sql = "SELECT COUNT(*) as total_callout FROM system_pet_player WHERE pstate = 1 AND psid = :psid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 绑定参数并执行查询
                    $stmt->execute([':psid' => $sid]);

                    // 获取查询结果
                    $op = $stmt->fetchColumn();
                    if (!$op) {
                        $op = 0;
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                } elseif (preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)) {
                    $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                    $pet_pos = rtrim($prefix, ".");
                    $attr4 = $matches[2]; // 匹配到的剩余部分
                    // SQL 查询语句
                    $sql = "SELECT pid FROM system_pet_player WHERE psid = :sid ORDER BY pid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    $pet_pos = $idArray[$pet_pos] ?? null;

                    $fid = $attr4;

                    if (strpos($attr4, 'cut_hp') === 0) {
                        $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                        if (preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)) {
                            $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                            $mosaic_pos = rtrim($prefix, ".");

                            $attr6 = $matches[2]; // 匹配到的剩余部分
                        }
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = :op";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':op' => $op]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $mosaic_list = $row['equip_mosaic'] ?? '';
                        $mosaic_para = explode('|', $mosaic_list);
                        if (!isset($mosaic_para[$mosaic_pos])) {
                            $op = 0;
                        } else {
                            $mosaic_id = $mosaic_para[$mosaic_pos];
                            $xid = "i" . $attr6;
                            $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :mosaic_id)";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            // 执行查询
                            $stmt->execute([':mosaic_id' => $mosaic_id]);

                            // 获取查询结果
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($row === null || $row == '') {
                                $op = 0; // 或其他默认值
                            } else {
                                $op = nl2br($row[$xid]);
                            }
                        }
                        //镶物属性相关
                    } else {
                        $pid = "p" . $fid;
                        $sql = "SELECT * FROM system_pet_player WHERE pid = :pet_pos";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':pet_pos' => $pet_pos]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row === null || $row == '') {
                            $op = 0; // 或其他默认值
                        } else {
                            $op = nl2br($row[$pid]);
                        }
                    }

                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                }
            } else {
                $attr3 = $attr1 . $attr2;
                $attr3 = str_replace('.', '', $attr3);
                $sql = "SHOW COLUMNS FROM game1 LIKE :attr3";
                $stmt = $db->prepare($sql);
                $stmt->execute([':attr3' => $attr3]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($result) > 0) {
                    $sql = "SELECT * FROM game1 WHERE sid = :sid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);
                } else {
                    $sql = "SELECT * FROM system_addition_attr WHERE sid = :sid AND name = :attr3";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid, ':attr3' => $attr3]);
                    $attr_type = 1;
                }
                
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($row === false || $row === null) {
                    $op = 0; // 或其他默认值
                } else {
                    if (!isset($attr_type) || $attr_type != 1) {
                        $op = nl2br($row[$attr3]);
                    } else {
                        $op = nl2br($row['value']);
                    }
                }
                
                $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                // 替换字符串中的变量
            }
            break;
        case 'ut':
            switch ($attr2) {
                case 'is_computer':
                    $userAgent = $_SERVER['HTTP_USER_AGENT'];
                    if (strpos($userAgent, 'Mobile') !== false) {
                        // 用户正在使用移动设备（手机或平板）
                        $op = 0;
                    } else {
                        // 用户正在使用桌面设备（电脑）
                        $op = 1;
                    }
                    break;
                case 'cut_hp':
                    // 构建 SQL 查询语句
                    $sql = "SELECT SUM(cut_hp) AS total_cut_hp FROM game2 WHERE sid = :sid AND gid != ''";
                    $sql_2 = "SELECT SUM(cut_hp) AS total_cut_hp FROM game2 WHERE sid = :sid AND gid = ''";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // 使用预处理语句
                    $stmt_2 = $db->prepare($sql_2);
                    $stmt_2->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);

                    // 获取总和并处理结果
                    $total_cut_hp = $row["total_cut_hp"];
                    $total_cut_hp_2 = $row_2["total_cut_hp"];
                    $op = ($total_cut_hp <= 0 ? "+" : "-") . abs($total_cut_hp);
                    $op_2 = ($total_cut_hp_2 <= 0 ? "+" : "-") . abs($total_cut_hp_2);
                    
                    // 合并字符串
                    if ($total_cut_hp_2 != 0) {
                        $op = $op . $op_2;
                    } else {
                        $op = $op;
                    }
                    
                    if ($op === null || $op == '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    break;
                case 'busy':
                    $sql = "SELECT attr_value FROM player_temp_attr WHERE obj_id = :sid AND obj_type = 1 AND attr_name = 'busy'";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        $op = $row["attr_value"];
                    }
                    if ($op === null || $op == '') {
                        $op = "0"; // 或其他默认值
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    break;
                case 'fight_umsg':
                    $sql = "SELECT fight_umsg FROM game2 WHERE sid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);
                    // 初始化 $op
                    $op = '';
                    // 获取查询结果
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $op .= $row["fight_umsg"];
                    }
                    if ($op === '' || $op === null) {
                        $op = "0"; // 或其他默认值
                    } else {
                        $op = nl2br($op);
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    break;
                case 'fight_omsg':
                    $sql = "SELECT fight_omsg FROM game2 WHERE sid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);
                    // 初始化 $op
                    $op = '';
                    // 获取查询结果
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $op .= $row["fight_omsg"];
                    }
                    if ($op === '' || $op === null) {
                        $op = "0"; // 或其他默认值
                    } else {
                        $op = nl2br($op);
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    break;
            }
            break;
        case 'ot':
            switch ($attr2) {
                case 'is_computer':
                    $sql = "SELECT sfzx FROM game1 WHERE sid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $mid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $sfzx = $row["sfzx"];
                    if ($sfzx == 1) {
                        $sql = "SELECT device_agent FROM game4 WHERE sid = :sid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':sid' => $mid]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $userAgent = $row["device_agent"];
                        if (strpos($userAgent, 'Mobile') !== false) {
                            // 用户正在使用移动设备（手机或平板）
                            $op = 0;
                        } else {
                            // 用户正在使用桌面设备（电脑）
                            $op = 1;
                        }
                    } else {
                        // 用户离线
                        $op = 2;
                    }
                    break;
                case 'cut_hp':
                    // 构建 SQL 查询语句
                    $sql = "SELECT * FROM game2 WHERE sid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["hurt_hp"];
                    if ($op === null || $op == '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
            }
            break;
        case 'o':
            switch ($oid) {
                case 'scene':
                    $attr3 = 'm' . $attr2;
                    $sql = "SELECT * FROM system_map WHERE mid = :mid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':mid' => $mid]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === false) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3] ?? '');
                        if ($op === '') {
                            $op = "\"\""; // 或其他默认值
                        }
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'pet':
                    if ($attr2 == "skills_cmmt") {
                        $sql = "SELECT * FROM system_skill_user WHERE jpid = :jpid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':jpid' => $mid]);
                        $row_result = "";

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $skill_id = $row['jid'];
                            $skill_lvl = $row['jlvl'];
                            $sql2 = "SELECT * FROM system_skill WHERE jid = :jid";
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->execute([':jid' => $skill_id]);
                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                            $row_result .= "，" . $row2['jname'] . "_" . "{$skill_lvl}";
                        }
                        $op = ltrim($row_result, "，");
                    } else {
                        $attr3 = 'p' . $attr2;
                        $sql = "SELECT * FROM system_pet_player WHERE pid = :pid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':pid' => $mid]);
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($row === false) {
                            $op = 0; // 或其他默认值
                        } else {
                            $op = nl2br($row[$attr3] ?? '');
                        }
                        if ($op === null || $op === '') {
                            $op = "\"\""; // 或其他默认值
                        }
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'npc':
                    $attr3 = 'n' . $attr2;
                    if (is_numeric($mid)) {
                        $sql = "SELECT * FROM system_npc WHERE nid = :nid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':nid' => $mid]);
                    } else {
                        $data_mid = explode("|", $mid);
                        $mid2 = $data_mid[1];
                        $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :ngid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':ngid' => $mid2]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    if ($attr2 == "skills_cmmt") {
                        $skills_cmmt = $row['nskills'];
                        $skill_cmmt = explode(',', $skills_cmmt);
                        $row_result = "";
                        if ($skills_cmmt) {
                            foreach ($skill_cmmt as $skill_cmmt_detail) {
                                $skill_para = explode('|', $skill_cmmt_detail);
                                $skill_id = $skill_para[0];
                                $skill_lvl = $skill_para[1];
                                $sql = "SELECT jname FROM system_skill WHERE jid = :jid";
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':jid' => $skill_id]);
                                $skill_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $row_result .= "，" . $skill_row['jname'] . "_" . "{$skill_lvl}";
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } elseif ($attr2 == "equips_cmmt") {
                        $equips_cmmt = $row['nequips'];
                        $equip_cmmt = explode(',', $equips_cmmt);
                        $row_result = "";
                        if ($equips_cmmt) {
                            foreach ($equip_cmmt as $equips_cmmt_para) {
                                $equips_cmmt_id = explode('_', $equips_cmmt_para)[2];
                                $sql = "SELECT iname FROM system_item_module WHERE iid = :iid";
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':iid' => $equips_cmmt_id]);
                                $equip_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $row_result .= "，" . $equip_row['iname'];
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } else {
                        $row_result = $row[$attr3];
                    }

                    if ($row_result === null || $row_result === '') {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row_result);
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'item':
                    $attr3 = 'i' . $attr2;
                    if ($attr3 == "icount" || $attr3 == "iroot") {
                        $sql = "SELECT * FROM system_item WHERE item_true_id = :mid AND sid = :sid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid, ':sid' => $sid]);
                    } else {
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :mid AND sid = :sid)";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid, ':sid' => $sid]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $row_result = $row[$attr3];
                    if ($attr3 == "iroot") {
                        $item_para = explode("|", $row_result);
                        $para_1 = $item_para[0];
                        $para_2 = $item_para[1];
                        if ($para_1 == 1) {
                            $sql = "SELECT nname FROM system_npc WHERE nid = :nid";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':nid' => $para_2]);
                            $row_npc = $stmt->fetch(PDO::FETCH_ASSOC);
                            $row_npc_name = $row_npc['nname'];
                            $row_result = "怪物掉落" . "|" . $row_npc_name;
                        } else {
                            $row_result = "未知来源";
                        }
                    }
                    if ($row_result === null || $row_result === '') {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row_result);
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'scene_oplayer':
                    if (strpos($attr2, "env.") === 0) {
                        $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                        switch ($attr3) {
                            case 'user_count':
                                // 构建 SQL 查询语句
                                $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = :sid)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $op = $row["count"];
                                break;
                            case 'npc_count':
                                $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $totalNpcCount = 0;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $mnpc = $row["mnpc_now"];
                                    $npcs = explode(",", $mnpc); // 拆分成每个npc项
                                    foreach ($npcs as $npc) {
                                        list(, $npcCount) = explode("|", $npc);
                                        $totalNpcCount += (int)$npcCount; // 将每个npc的数量累加
                                    }
                                }
                                $op = $totalNpcCount;
                                break;
                            case 'monster_count':
                                $sql = "SELECT COUNT(*) as count FROM system_npc_midguaiwu WHERE nsid = '' and nmid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                // 处理结果
                                $op = $row["count"];
                                break;
                            case 'item_count':
                                $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                // 处理结果
                                $totalItemCount = 0;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $mitem = $row["mitem_now"];
                                    $items = explode(",", $mitem); // 拆分成每个item项
                                    foreach ($items as $item) {
                                        list(, $itemCount) = explode("|", $item);
                                        $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                                    }
                                }
                                $op = $totalItemCount;
                                break;
                            case 'justmid':
                                // 构建 SQL 查询语句
                                $sql = "SELECT justmid FROM game1 WHERE sid = :sid";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $op = $row["justmid"];
                                break;
                            case 'nowmid':
                                // 构建 SQL 查询语句
                                $sql = "SELECT nowmid FROM game1 WHERE sid = :sid";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $op = $row["nowmid"];
                                break;
                            case 'name':
                                // 构建 SQL 查询语句
                                $sql = "SELECT mname FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $op = $row["mname"];
                                $sql = "SELECT uis_sailing FROM game1 WHERE sid = :sid";
                                // 使用预处理语句
                                $stmt = $db->prepare($sql);
                                // 执行查询
                                $stmt->execute([':sid' => $mid]);
                                // 获取查询结果
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $is_sailing = $row["uis_sailing"];
                                if ($is_sailing == 1) {
                                    $op = "茫茫大海";
                                }
                                break;
                        }
                    } else {
                        $attr3 = 'u' . $attr2;
                        $sql = "SHOW COLUMNS FROM game1 LIKE :attr3";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':attr3' => $attr3]);
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($result) > 0) {
                            $sql = "SELECT * FROM game1 WHERE sid = :sid";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':sid' => $mid]);
                        } else {
                            $sql = "SELECT * FROM system_addition_attr WHERE sid = :sid AND name = :attr3";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':sid' => $mid, ':attr3' => $attr3]);
                            $attr_type = 1;
                        }
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($row === false) {
                            $op = 0; // 或其他默认值
                        } else {
                            if (!isset($attr_type) || $attr_type != 1) {
                                $op = nl2br($row[$attr3]);
                            } else {
                                $op = nl2br($row['value']);
                            }
                        }
                        if ($op === '') {
                            $op = 0;
                        }
                        $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                        // 替换字符串中的变量
                        break;
                    }
                    break;
                default:
                    $attr3 = 'n' . $attr2;
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :ngid AND nsid = :nsid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':ngid' => $oid, ':nsid' => $sid]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === false) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
            }
            break;
        case 'm':
            if ($para != 1) {
                switch ($type) {
                    case 'fight':
                        $attr3 = 'j'.$attr2;
                        if($attr3 == "jlvl" || $attr3 == "jpoint" || $attr3 == "jdefault"){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = :jid AND jsid = :jsid";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':jid' => $jid, ':jsid' => $sid]);
                        } else {
                            $sql = "SELECT * FROM system_skill WHERE jid = :jid";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':jid' => $jid]);
                        }
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($result) == 0) {
                            die('查询失败: 没有找到匹配的记录');
                        }
                        $row = $result[0];
                        $row_result = $row[$attr3] ?? null;
                        if ($row_result === null || $row_result === '') {
                            $op = 0; // 或其他默认值
                        } else {
                            $op = nl2br($row_result);
                        }
                        $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                        if ($attr3 == "jgroup_attack") {
                            if ($row_result == -1) {
                                $op = "群体";
                            } elseif ($row_result == 1) {
                                $op = "单体";
                            }
                        } elseif ($attr3 == "jhurt_attr" || $attr3 == "jdeplete_attr") {
                            // 查询获取 name 字段值
                            $query = "SELECT name FROM gm_game_attr WHERE value_type = 1 AND id = :id";
                            $stmt = $db->prepare($query);
                            $stmt->execute([':id' => $row_result]);
                            $op = $stmt->fetchColumn();
                        }

                        // 替换字符串中的变量
                        //$input = str_replace("{{$match}}", $op, $input);
                        break;
                    default:
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl" ||$attr3 == "jpoint"||$attr3 =="jdefault"){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = :jid AND jsid = :jsid";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':jid' => $jid, ':jsid' => $sid]);
                        }else{
                            $sql = "SELECT * FROM system_skill WHERE jid = :jid";
                            $stmt = $db->prepare($sql);
                            $stmt->execute([':jid' => $jid]);
                        }
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($result)) {
                            die('查询失败: 没有找到匹配的记录');
                        }
                        $row = $result[0];
                        $row_result = $row[$attr3] ?? null;
                        if ($row_result === null || $row_result === '') {
                            $op = 0; // 或其他默认值
                        } else {
                            $op = nl2br($row_result);
                        }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                        if($attr3 == "jgroup_attack"){
                            if($row_result == -1){
                                $op = "群体";
                            }elseif ($row_result == 1) {
                                $op = "单体";
                            }
                        }elseif($attr3 =="jhurt_attr" || $attr3 =="jdeplete_attr"){
                            // 查询获取 name 字段值
                            $query = "SELECT name FROM gm_game_attr WHERE value_type = 1 AND id = :id";
                            $stmt = $db->prepare($query);
                            $stmt->execute([':id' => $row_result]);
                            $op = $stmt->fetchColumn();
                        }
                        break;
                }
            } elseif ($para == 1) {
                $attr3 = 'j' . $attr2;
                //TODO 代码逻辑有问题，待修改
                if ($attr3 == "jlvl") {
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :ngid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':ngid' => $oid]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $row_result = $row['nskills'];
                    $monster_skills_lvl = explode(',', $row_result);
                } else {
                    $sql = "SELECT * FROM system_skill WHERE jid = :jid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':jid' => $mid]);
                }
                if (!$stmt) {
                    die('查询失败: ' . $db->errorInfo()[2]);
                }
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_result = $row[$attr3];
                if ($para != 1) {
                    $row_result = $row[$attr3];
                }
                if ($row_result === null || $row_result === '') {
                    $op = 0; // 或其他默认值
                } else {
                    $op = nl2br($row_result);
                }
                $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
            }
            break;
        case 'c':
            switch ($attr2) {
                case 'time':
                    $op = date('U');
                    break;
                case 'day':
                    $op = date('N');
                    break;
                case 'year':
                    $op = date('Y');
                    break;
                case 'month':
                    $op = date('n');
                    break;
                case 'date':
                    $op = date('j');
                    break;
                case 'hour':
                    $op = date('G');
                    break;
                case 'minute':
                    $op = 1 * date('i');
                    break;
                case 'second':
                    $op = 1 * date('s');
                    break;
                case 'online_user_count':
                    $query = "SELECT COUNT(*) FROM game1 WHERE sfzx = 1";
                    // 执行查询语句并获取结果
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    // 获取行数
                    $op = $stmt->fetchColumn();
                    break;
                default:
                    $game_id = '19980925';
                    $attr4 = 'game_';
                    $attr3 = $attr4 . $attr2;
                    $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$game_id]);
                    if (!$stmt) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
            }
            // 使用正则表达式匹配字符串中的时间格式部分
            $pattern = '/nowtime_([UNYnjGHhist:]+)/';
            if (preg_match($pattern, $attr2, $matches)) {
                // 获取当前时间，并根据格式解析为具体时间信息
                $op = date($matches[1]);
            }
            $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
            // 替换字符串中的变量
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'g':
            $sql = "SELECT gvalue FROM global_data WHERE gid = :attr2";
            $stmt = $db->prepare($sql);
            $stmt->execute(['attr2' => $attr2]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row === false) {
                $op = 0; // 或其他默认值
            } else {
                $op = nl2br($row['gvalue']);
            }
            $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
            // 替换字符串中的变量
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'e':
            $sql = "SELECT * FROM system_exp_def WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$attr2]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                die('查询失败: ' . $db->errorInfo()[2]);
            }
            $op = nl2br($row['value']);
            // 替换字符串中的变量
            $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);

            $op = @eval("return $op;");
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'r':
            if (!is_numeric($attr2)) {
                $attr2 = "{" . $attr2 . "}";
            }
            $attr2 = process_string($attr2, $sid, $oid, $mid, $jid, $type, $para);
            if (intval($attr2) <= 0) {
                $attr2 = 1;
            }
            $op = rand(0, intval($attr2) - 1); // 生成随机整数
            //$op = "\"$op\"";
            break;
        case 'gph':
            $attr_para = explode(".", "$attr2");
            $attr_id = $attr_para[0];
            $attr_pos = $attr_para[1];
            $attr_attr = $attr_para[2];
            // 提取获取排名数据的函数
            if (!function_exists('lexical_analysis\getRankData')) {
                function getRankData($db)
                {
                    $sql = "SELECT * FROM system_rank";
                    $stmt = $db->query($sql);
                    if (!$stmt) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $rankData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $rankData;
                }
            }

            // 提取获取用户数据的函数
            if (!function_exists('lexical_analysis\getUserData')) {
                function getUserData($db, $rankExp, $showCond)
                {
                    $sql = "SELECT uname, sid, uid FROM game1";
                    $stmt = $db->query($sql);
                    if (!$stmt) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $userData = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $userSid = $row['sid'];
                        $userExp = process_string($rankExp, $userSid);
                        $userShowCond = checkTriggerCondition($showCond, $db, $userSid);

                        if (is_null($userShowCond)) {
                            $userShowCond = 1;
                        }

                        if ($userShowCond) {
                            $user_name = $row['uname'];
                            $userUid = $row['uid'];
                            $userData[] = [
                                'score' => $userExp,
                                'id' => $userUid,
                                'name' => $user_name
                            ];
                        }
                    }
                    return $userData;
                }
            }
            // 获取排名数据
            $rankData = getRankData($db);

            $counter = 0;
            foreach ($rankData as $row) {
                $rankExp = $row['rank_exp'];
                $show_cond = $row['show_cond'];
                $userData = getUserData($db, $rankExp, $show_cond);
                usort($userData, function ($a, $b) {
                    return $b['score'] - $a['score'];
                });

                if ($attr_id == $counter) {
                    $op = isset($userData[$attr_pos][$attr_attr]) ? $userData[$attr_pos][$attr_attr] : 0;
                }
                $counter++;
            }
            $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
            break;
        case 'gphn':
            $attr_para = explode(".", "$attr2");
            $attr_name = $attr_para[0];
            $attr_pos = $attr_para[1];
            $attr_attr = $attr_para[2];

            // 缓存的键名
            $rankCacheKey = "rankData_$attr_name";
            $userCacheKey = "userData_$attr_name";

            // 提取获取排名数据的函数
            if (!function_exists('lexical_analysis\getRankData2')) {
                function getRankData2($db, $rank_name)
                {
                    $sql = "SELECT * FROM system_rank WHERE rank_name = :rank_name";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(['rank_name' => $rank_name]);
                    if (!$stmt) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $rankData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $rankData;
                }
            }

            // 提取获取用户数据的函数
            if (!function_exists('lexical_analysis\getUserData2')) {
                function getUserData2($db, $rankExp, $showCond)
                {
                    $sql = "SELECT uname, sid, uid FROM game1";
                    $stmt = $db->query($sql);
                    if (!$stmt) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $userData = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $userSid = $row['sid'];
                        $userExp = process_string($rankExp, $userSid);
                        $userShowCond = checkTriggerCondition($showCond, $db, $userSid);
                        if (is_null($userShowCond)) {
                            $userShowCond = 1;
                        }
                        if ($userShowCond) {
                            $user_name = $row['uname'];
                            $userUid = $row['uid'];
                            $userData[] = [
                                'score' => $userExp,
                                'id' => $userUid,
                                'name' => $user_name
                            ];
                        }
                    }
                    return $userData;
                }
            }

            // 从缓存获取排名数据
            $rankData = Cache::get($rankCacheKey);
            if ($rankData === false) {
                $rankData = getRankData2($db, $attr_name);
                Cache::set($rankCacheKey, $rankData, 1); // 缓存1秒
            }

            foreach ($rankData as $row) {
                $rankExp = $row['rank_exp'];
                $show_cond = $row['show_cond'];

                // 从缓存获取用户数据
                $userData = Cache::get($userCacheKey);
                if ($userData === false) {
                    $userData = getUserData2($db, $rankExp, $show_cond);
                    Cache::set($userCacheKey, $userData, 1); // 缓存1秒
                }

                usort($userData, function ($a, $b) {
                    return $b['score'] - $a['score'];
                });
                $op = $userData[$attr_pos][$attr_attr] ?? 0;
            }
            $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
            break;
        default:
            return 0;
            break;
    }
    // 在这里根据属性的不同进行处理
    // ...
    // 返回属性值，处理过程中可能会嵌套调用 process_string
    return $op;
}

// 定义处理字符串的函数
function process_string($input, $sid, $oid = null, $mid = null, $jid = null, $type = null, $para = null) {
    $db = DB::pdo();

    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);
    if (!empty($matches[1])) {
        foreach ($matches[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1,$attr2,$sid, $oid, $mid,$jid,$type,$db,$para);
                if($op =='' || $op == "" || $op ==null){
                    $op = 0;
                }
                // var_dump($match);
                // var_dump($op);
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
                
            }
        }
    }

    $matches_2 = [];
    preg_match_all('/f\(([\w.]+)\)/', $input, $matches_2);
    if (!empty($matches_2[1])) {
        foreach ($matches_2[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para);
                if ($op == '' || $op == "" || $op == null) {
                    $op = "\"\"";
                }
                // var_dump($match);
                // var_dump($op);
                // 替换字符串中的变量

                $sql = "SELECT sid FROM game1 WHERE uid = :op";
                $stmt = $db->prepare($sql);
                $stmt->execute(['op' => $op]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$row) {
                    die('查询失败: 未找到匹配的记录');
                }
                $temp_sid = $row['sid'];
                $op = str_replace("f({$match})", "u", $input);
                if ($temp_sid) {
                    $input = process_string($op, $temp_sid, $oid, $mid, $jid, $type, $para);
                }
            }
        }
    }

    // 进行其他逻辑处理
    // ...
    $input = evaluate_expression($input, $db, $sid, $oid, $mid, $jid, $type, $para);
    return $input;
}


//上为主对被，下为被对主。

function evaluate_expression_2($expr, $db, $sid, $oid, $mid, $jid, $type, $para = null)
{
    $expr = preg_replace_callback('/\{eval\(([^)]+)\)\}/', function ($matches) use ($db, $sid, $oid, $mid, $jid, $type, $para) {
        $eval_expr = $matches[1]; // 获取 eval 中的表达式
        $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
        return $eval_result; // 返回计算结果
    }, $expr);
    //var_dump($expr);
    $expr = preg_replace_callback('/\{([^}]+)\}/', function ($matches) use ($db, $sid, $oid, $mid, $jid, $type, $para) {
        $attr = $matches[1]; // 获取匹配到的变量名
        $firstDotPosition = strpos($attr, '.');
        if (!empty($firstDotPosition)) {
            $attr1 = substr($attr, 0, $firstDotPosition);
            $attr2 = substr($attr, $firstDotPosition + 1);
            // 使用 process_attribute 处理单个属性
            $op = process_attribute_2($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para);
            // 替换字符串中的变量
        }

        // 在这里根据变量名获取对应的值，例如从数据库中查询
        // 假设你从数据库中获取了 $attr_value
        if ($para == 'cond_exp') {
            $op = "(bool)\"$op\"";
        }
        return $op;
    },
        $expr
    );
    //var_dump($expr);
    // 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
    $result = $expr;
    try {
        //$result = eval("return $expr;");
    } catch (ParseError $e) {
        print("语法错误: " . $e->getMessage());
    } catch (Error $e) {
        print("执行错误: " . $e->getMessage());
    }
    return $result;
}

function process_attribute_2($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para = null)
{
    $db = DB::pdo();
    switch ($attr1) {
        case 'u':
            if (strpos($attr2, "env.") === 0) {
                $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                switch ($attr3) {
                    case 'user_count':
                        // 构建 SQL 查询语句
                        $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = :oid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':oid' => $oid]);
                        // 获取查询结果
                        $op = $stmt->fetchColumn();
                        break;
                    case 'npc_count':
                        $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = :oid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':oid' => $oid]);
                        // 获取查询结果
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // 处理结果
                        $totalNpcCount = 0;
                        foreach ($result as $row) {
                            $mnpc = $row["mnpc_now"];
                            $npcs = explode(",", $mnpc); // 拆分成每个npc项
                            foreach ($npcs as $npc) {
                                $npc_show_cond = urldecode(explode("|", $npc)[2]);
                                $show_cond = checkTriggerCondition($npc_show_cond, $db, $sid);
                                if(is_null($show_cond)){
                                    $show_cond = true;
                                }
                                if($show_cond){
                                    list(, $npcCount) = explode("|", $npc);
                                    $totalNpcCount += (int)$npcCount; // 将每个npc的数量累加
                                }
                            }
                        }
                        $op = $totalNpcCount;
                        break;
                    case 'item_count':
                        $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = :oid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':oid' => $oid]);
                        // 获取查询结果
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // 处理结果
                        $totalItemCount = 0;
                        foreach ($result as $row) {
                            $mitem = $row["mitem_now"];
                            $items = explode(",", $mitem); // 拆分成每个item项
                            foreach ($items as $item) {
                                list(, $itemCount) = explode("|", $item);
                                $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                            }
                        }
                        $op = $totalItemCount;
                        break;
                }
            } elseif (strpos($attr2, "equips.") === 0) {
                $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
                if (strpos($attr3, 'b.') === 0) {
                    $attr3 = substr($attr3, 2); // 提取 "b." 后面的部分
                    $bid = $attr3;
                    $sql = "SELECT nequips FROM system_npc_midguaiwu WHERE ngid = :oid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':oid' => $oid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }

                    $op = $row["nequips"];
                    $pattern = '/兵器_\d+_(\d+)/';

                    preg_match_all($pattern, $op, $matches);

                    if (!empty($matches[1])) {
                        // 获取最后一个匹配的数值
                        $op = end($matches[1]);
                    }
                    if (!$op) {
                        $op = 0;
                    } else {
                        $bid = "i" . $bid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = :op";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':op' => $op]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($attr3 == "count") {
                            $op = $op ? 1 : 0;
                        } else {
                            $op = nl2br($row[$bid] ?? '');
                            if ($row === null || $op === '') {
                                $op = 0; // 或其他默认值
                            }
                        }
                    }
                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                } elseif (preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)) {
                    $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                    $equiped_pos = rtrim($prefix, ".");
                    $attr4 = $matches[2]; // 匹配到的剩余部分
                    // SQL 查询语句
                    $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";
                    // 执行查询并检查是否有结果
                    $stmt = $db->query($sql);
                    $idArray = array();
                    // 将查询结果存入数组
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $idArray[] = $row["id"];
                    }
                    $equiped_pos = $idArray[$equiped_pos];

                    $fid = $attr4;
                    $sql = "SELECT nequips FROM system_npc_midguaiwu WHERE ngid = :oid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':oid' => $oid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }

                    $op = $row["nequips"];
                    $pattern = '/防具_' . preg_quote($equiped_pos) . '_(\d+)/';
                    preg_match_all($pattern, $op, $matches);
                    if (!empty($matches[1])) {
                        // 获取第一个匹配的数值
                        $op = end($matches[1]);
                    }
                    if (!$op) {
                        $op = 0;
                    } else {
                        $fid = "i" . $fid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = :op";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':op' => $op]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($attr4 == "count") {
                            $op = $op ? 1 : 0;
                        } else {
                            if ($row === null || $row == '') {
                                $op = 0; // 或其他默认值
                            } else {
                                $op = nl2br($row[$fid]);
                            }
                        }
                    }
                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                }
            } elseif (strpos($attr2, "refresh_time") === 0) {
                $sql = "SELECT mgtime, mrefresh_time FROM system_map WHERE mid = (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = :oid)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->execute([':oid' => $oid]);
                // 获取查询结果
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nowdate = date('Y-m-d H:i:s');
                $mid_time = $row["mgtime"];
                $mid_refresh_time = $row['mrefresh_time'];
                $op = $mid_refresh_time - floor((strtotime($nowdate) - strtotime($mid_time)) / 60); //获取刷新分钟剩余
            } else {
                $attr3 = "n" . $attr2;
                $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :oid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':oid' => $oid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row === false) {
                    die('查询失败: ' . $db->errorInfo()[2]);
                }
                if ($row === null || $row === '') {
                    $op = 0; // 或其他默认值
                } else {
                    $op = nl2br($row[$attr3]);
                }
                $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                // 替换字符串中的变量
            }
            break;
        case 'ut':
            switch ($attr2) {
                case 'cut_hp':
                    // 构建 SQL 查询语句
                    $sql = "SELECT * FROM game3 WHERE sid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["hurt_hp"] ?? "";
                    if ($op === null || $op === '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
                case 'fight_umsg':
                    $sql = "SELECT * FROM game3 WHERE sid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["fight_umsg"] ?? "";
                    if ($op === null || $op === '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
                case 'fight_omsg':
                    $sql = "SELECT * FROM game3 WHERE sid = ?";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    // 执行查询
                    $stmt->execute();
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row["fight_omsg"];
                    if ($op === null || $op == '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
            }
            break;
        case 'ot':
            switch ($attr2) {
                case 'cut_hp':
                    // 构建 SQL 查询语句
                    $sql = "SELECT * FROM game2 WHERE sid = :sid";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);
                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["hurt_hp"] ?? "";
                    if ($op === null || $op === '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
            }
            break;
        case 'o':
            switch ($oid) {
                case 'scene':
                    $attr3 = 'm' . $attr2;
                    $sql = "SELECT * FROM system_map WHERE mid = :mid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':mid' => $mid]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === false) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'npc':
                    $attr3 = 'n' . $attr2;
                    if (is_numeric($mid)) {
                        $sql = "SELECT * FROM system_npc WHERE nid = :mid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid]);
                    } else {
                        $data_mid = explode("|", $mid);
                        $mid2 = $data_mid[1];
                        $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :mid2";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid2' => $mid2]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }

                    if ($attr2 == "skills_cmmt") {
                        $skills_cmmt = $row['nskills'];
                        $skill_cmmt = explode(',', $skills_cmmt);
                        $row_result = '';
                        if ($skills_cmmt) {
                            foreach ($skill_cmmt as $skill_cmmt_detail) {
                                $skill_para = explode('|', $skill_cmmt_detail);
                                $skill_id = $skill_para[0];
                                $skill_lvl = $skill_para[1];
                                $sql = "SELECT jname FROM system_skill WHERE jid = :skill_id";
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':skill_id' => $skill_id]);
                                $skill_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($skill_row) {
                                    $row_result .= "," . $skill_row['jname'] . "({$skill_lvl})";
                                }
                            }
                            $row_result = ltrim($row_result, ",");
                        }
                    } elseif ($attr2 == "equips_cmmt") {
                        $equips_cmmt = $row['nequips'];
                        $equip_cmmt = explode(',', $equips_cmmt);
                        $row_result = '';
                        if ($equips_cmmt) {
                            foreach ($equip_cmmt as $equips_cmmt_id) {
                                $sql = "SELECT iname FROM system_item_module WHERE iid = :equips_cmmt_id";
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':equips_cmmt_id' => $equips_cmmt_id]);
                                $equip_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($equip_row) {
                                    $row_result .= "," . $equip_row['iname'];
                                }
                            }
                            $row_result = ltrim($row_result, ",");
                        }
                    } else {
                        $row_result = $row[$attr3];
                    }

                    if ($row_result === null || $row_result === '') {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row_result);
                    }

                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'item':
                    $attr3 = 'i' . $attr2;
                    if ($attr3 == "icount") {
                        $sql = "SELECT * FROM system_item WHERE item_true_id = :mid AND sid = :sid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid, ':sid' => $sid]);
                    } else {
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :mid AND sid = :sid)";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid, ':sid' => $sid]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . implode(" ", $db->errorInfo()));
                    }
                    $row_result = $row[$attr3];
                    if ($row_result === null || $row_result === '') {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row_result);
                    }
                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'scene_oplayer':
                    $attr3 = 'u' . $attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                default:
                    $attr3 = 'u' . $attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = :sid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':sid' => $sid]);
                    if (!$stmt) {
                        die('查询失败: ' . implode(" ", $db->errorInfo()));
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
            }
            break;
        case 'm':
            $monster_skills_lvls = "";
            $attr3 = 'j' . $attr2;
            if ($attr3 == "jlvl") {
                $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :oid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':oid' => $oid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_result = $row['nskills'];
                $monster_skills_lvls = explode(',', $row_result);
                foreach ($monster_skills_lvls as $monster_skills_lvl) {
                    $monster_skills_detail = explode('|', $monster_skills_lvl);
                    if ($jid == $monster_skills_detail[0]) {
                        $op = $monster_skills_detail[1];
                        $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
                        break;
                    }
                }
            } else {
                $sql = "SELECT * FROM system_skill WHERE jid = :jid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':jid' => $jid]);

                if (!$stmt) {
                    die('查询失败: ' . implode(" ", $db->errorInfo()));
                }
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_result = $row[$attr3];
                if ($row_result === null || $row_result === '') {
                    $op = 0; // 或其他默认值
                } else {
                    $op = nl2br($row_result);
                }
                $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
            }
            break;
        case 'c':
            switch ($attr2) {
                case 'time':
                    $op = date('U');
                    break;
                case 'day':
                    $op = date('N');
                    break;
                case 'year':
                    $op = date('Y');
                    break;
                case 'month':
                    $op = date('n');
                    break;
                case 'date':
                    $op = date('j');
                    break;
                case 'hour':
                    $op = date('G');
                    break;
                case 'minute':
                    $op = 1 * date('i');
                    break;
                case 'second':
                    $op = 1 * date('s');
                    break;
                case 'online_user_count':

                    break;
                default:
                    $game_id = '19980925';
                    $attr4 = 'game_';
                    $attr3 = $attr4 . $attr2;
                    $sql = "SELECT * FROM gm_game_basic WHERE game_id = :game_id";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':game_id' => $game_id]);
                    if (!$stmt) {
                        die('查询失败: ' . implode(" ", $db->errorInfo()));
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
            }
            // 使用正则表达式匹配字符串中的时间格式部分
            $pattern = '/nowtime_([UNYnjGHhist:]+)/';
            if (preg_match($pattern, $attr2, $matches)) {
                // 获取当前时间，并根据格式解析为具体时间信息
                $op = date($matches[1]);
            }
            $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
            // 替换字符串中的变量
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'g':
            $sql = "SELECT * FROM global_data WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $attr2]);
            if (!$stmt) {
                die('查询失败: ' . implode(" ", $db->errorInfo()));
            }
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row === null) {
                $op = 0; // 或其他默认值
            } else {
                $op = nl2br($row['value']);
            }
            $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
            // 替换字符串中的变量
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'e':
            $sql = "SELECT * FROM system_exp_def WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $attr2]);
            if (!$stmt) {
                die('查询失败: ' . implode(" ", $db->errorInfo()));
            }
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row === null) {
                $op = "";
            } else {
                $op = nl2br($row['value']);
            }
            // 替换字符串中的变量
            $op = process_string_2($op, $sid, $oid, $mid, $jid, $type, $para);
            $op = @eval("return $op;");
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'r':
            if (!is_numeric($attr2)) {
                $attr2 = "{" . $attr2 . "}";
            }
            $attr2 = process_string_2($attr2, $sid, $oid, $mid, $jid, $type, $para);
            $op = rand(1, $attr2) - 1;
            return $op;
            break;
        default:
            return 0;
            break;
    }
    // 在这里根据属性的不同进行处理
    // ...
    // 返回属性值，处理过程中可能会嵌套调用 process_string
    return $op;
}

// 定义处理字符串的函数
function process_string_2($input, $sid, $oid = null, $mid = null, $jid = null, $type = null, $para = null)
{
    $db = DB::pdo();
    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);

    if (!empty($matches[1])) {
        foreach ($matches[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute_2($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para);
                if ($op == '' || $op == "" || $op == null) {
                    $op = "\"\"";
                }
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
            }
        }
    }

    // 进行其他逻辑处理
    // ...
    $input = evaluate_expression_2($input, $db, $sid, $oid, $mid, $jid, $type, $para);
    return $input;
}

//上为被对主，下为宠对被。

function evaluate_expression_3($expr, $db, $sid, $oid, $mid, $jid, $type, $para = null)
{
    $expr = preg_replace_callback('/\{eval\(([^)]+)\)\}/', function ($matches) use ($db, $sid, $oid, $mid, $jid, $type, $para) {
        $eval_expr = $matches[1]; // 获取 eval 中的表达式
        $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
        return $eval_result; // 返回计算结果
    }, $expr);
    //var_dump($expr);
    $expr = preg_replace_callback('/\{([^}]+)\}/', function ($matches) use ($db, $sid, $oid, $mid, $jid, $type, $para) {
        $attr = $matches[1]; // 获取匹配到的变量名
        $firstDotPosition = strpos($attr, '.');
        if (!empty($firstDotPosition)) {
            $attr1 = substr($attr, 0, $firstDotPosition);
            $attr2 = substr($attr, $firstDotPosition + 1);
            // 使用 process_attribute 处理单个属性
            $op = process_attribute_3($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para);
            // 替换字符串中的变量
        }

        // 在这里根据变量名获取对应的值，例如从数据库中查询
        // 假设你从数据库中获取了 $attr_value
        if ($para == 'cond_exp') {
            $op = "(bool)\"$op\"";
        }
        return $op;
    }, $expr);
    //var_dump($expr);
    // 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
    $result = $expr;
    try {

        //$result = eval("return $expr;");
    } catch (ParseError $e) {
        print("语法错误: " . $e->getMessage());
    } catch (Error $e) {
        print("执行错误: " . $e->getMessage());
    }
    return $result;
}

function process_attribute_3($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para = null)
{
    switch ($attr1) {
        case 'u':
            if (strpos($attr2, "env.") === 0) {
                $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                switch ($attr3) {
                        case 'user_count':
                        // 构建 SQL 查询语句
                        $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        
                        // 绑定参数并执行查询
                        $stmt->execute([':sid' => $sid]);
                        
                        // 获取查询结果
                        $op = $stmt->fetchColumn();
                        break;
                    case 'npc_count':
                        $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        
                        // 获取查询结果
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // 处理结果
                        $totalNpcCount = 0;
                        foreach ($result as $row) {
                            $mnpc = $row["mnpc_now"];
                            $npcs = explode(",", $mnpc); // 拆分成每个npc项
                            foreach ($npcs as $npc) {
                                $npc_show_cond = urldecode(explode("|", $npc)[2]);
                                $show_cond = checkTriggerCondition($npc_show_cond, $db, $sid);
                                if(is_null($show_cond)){
                                    $show_cond = true;
                                }
                                if($show_cond){
                                    list(, $npcCount) = explode("|", $npc);
                                    $totalNpcCount += (int)$npcCount; // 将每个npc的数量累加
                                }
                            }
                        }
                        $op = $totalNpcCount;
                        break;
                    case 'item_count':
                        $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // 处理结果
                        $totalItemCount = 0;
                        foreach ($result as $row) {
                            $mitem = $row["mitem_now"];
                            $items = explode(",", $mitem); // 拆分成每个item项
                            foreach ($items as $item) {
                                list(, $itemCount) = explode("|", $item);
                                $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                            }
                        }
                        $op = $totalItemCount;
                        break;
                }
            } elseif (strpos($attr2, "equips.") === 0) {
                $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
                if (strpos($attr3, 'b.') === 0) {
                    $attr3 = substr($attr3, 2); // 提取 "b." 后面的部分
                    $bid = $attr3;
                    $sql = "SELECT nequips FROM system_pet_player WHERE pid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }

                    $op = $row["nequips"];
                    $pattern = '/兵器_\d+_(\d+)/';

                    preg_match_all($pattern, $op, $matches);

                    if (!empty($matches[1])) {
                        // 获取最后一个匹配的数值
                        $op = end($matches[1]);
                    }
                    if (!$op) {
                        $op = 0;
                    } else {
                        $bid = "i" . $bid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = :op";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':op' => $op]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($attr3 == "count") {
                            $op = $op ? 1 : 0;
                        } else {
                            $op = nl2br($row[$bid] ?? '');
                            if ($row === null || $op === '') {
                                $op = 0; // 或其他默认值
                            }
                        }
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                } elseif (preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)) {
                    $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                    $equiped_pos = rtrim($prefix, ".");
                    $attr4 = $matches[2]; // 匹配到的剩余部分
                    // SQL 查询语句
                    $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";

                    // 执行查询并检查是否有结果
                    $stmt = $db->query($sql);
                    $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    $equiped_pos = $idArray[$equiped_pos] ?? null;

                    $fid = $attr4;
                    $sql = "SELECT nequips FROM system_pet_player WHERE pid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }

                    $op = $row["nequips"];
                    $pattern = '/防具_' . preg_quote($equiped_pos) . '_(\d+)/';

                    preg_match_all($pattern, $op, $matches);

                    if (!empty($matches[1])) {
                        // 获取第一个匹配的数值
                        $op = end($matches[1]);
                    }
                    if (!$op) {
                        $op = 0;
                    } else {
                        $fid = "i" . $fid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = :op";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':op' => $op]);

                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($attr4 == "count") {
                            $op = $op ? 1 : 0;
                        } else {
                            if ($row === null || $row === false) {
                                $op = 0; // 或其他默认值
                            } else {
                                $op = nl2br($row[$fid] ?? '');
                            }
                        }
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                }
            } elseif (strpos($attr2, "refresh_time") === 0) {
                $sql = "SELECT mgtime, mrefresh_time FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = :sid)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->execute([':sid' => $sid]);
                // 获取查询结果
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nowdate = date('Y-m-d H:i:s');
                $mid_time = $row["mgtime"];
                $mid_refresh_time = $row['mrefresh_time'];
                $op = $mid_refresh_time - floor((strtotime($nowdate) - strtotime($mid_time)) / 60); //获取刷新分钟剩余
            } else {
                $attr3 = "p" . $attr2;
                $sql = "SELECT * FROM system_pet_player WHERE pid = :sid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':sid' => $sid]);
                if (!$stmt) {
                    die('查询失败: ' . implode(" ", $db->errorInfo()));
                }
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row === null || $row === false) {
                    $op = 0; // 或其他默认值
                } else {
                    $op = nl2br($row[$attr3] ?? '');
                }
                $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                // 替换字符串中的变量
            }
            break;
        case 'ut':
            switch ($attr2) {
                case 'cut_hp':
                    // 构建 SQL 查询语句
                    $sql = "SELECT * FROM game3 WHERE sid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);

                    // 执行查询
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["hurt_hp"] ?? '';
                    if ($op === null || $op === '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
                case 'fight_umsg':
                    $sql = "SELECT * FROM game3 WHERE sid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);

                    // 执行查询
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["fight_umsg"] ?? '';
                    if ($op === null || $op === '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
                case 'fight_omsg':
                        $sql = "SELECT * FROM game3 WHERE sid = :sid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute([':sid' => $sid]);
                        // 获取查询结果
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $op = $row["fight_omsg"] ?? '';
                        if ($op === null || $op === '') {
                            $op = "\"\""; // 或其他默认值
                        }
                    break;
            }
            break;
        case 'ot':
            switch ($attr2) {
                case 'cut_hp':
                    // 构建 SQL 查询语句
                    $sql = "SELECT * FROM game2 WHERE sid = :sid";

                    // 使用预处理语句
                    $stmt = $db->prepare($sql);

                    // 执行查询
                    $stmt->execute([':sid' => $sid]);

                    // 获取查询结果
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $op = $row["hurt_hp"] ?? '';
                    if ($op === null || $op === '') {
                        $op = "\"\""; // 或其他默认值
                    }
                    break;
            }
            break;
        case 'o':
            switch ($oid) {
                case 'scene':
                    $attr3 = 'm' . $attr2;
                    $sql = "SELECT * FROM system_map WHERE mid = :mid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':mid' => $mid]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === false) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'npc':
                    $attr3 = 'n' . $attr2;
                    if (is_numeric($mid)) {
                        $sql = "SELECT * FROM system_npc WHERE nid = :mid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid]);
                    } else {
                        $data_mid = explode("|", $mid);
                        $mid2 = $data_mid[1];
                        $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :mid2";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid2' => $mid2]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }

                    if ($attr2 == "skills_cmmt") {
                        $skills_cmmt = $row['nskills'];
                        $skill_cmmt = explode(',', $skills_cmmt);
                        $row_result = '';
                        if ($skills_cmmt) {
                            foreach ($skill_cmmt as $skill_cmmt_detail) {
                                $skill_para = explode('|', $skill_cmmt_detail);
                                $skill_id = $skill_para[0];
                                $skill_lvl = $skill_para[1];
                                $sql = "SELECT jname FROM system_skill WHERE jid = :skill_id";
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':skill_id' => $skill_id]);
                                $skill_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($skill_row) {
                                    $row_result .= "," . $skill_row['jname'] . "({$skill_lvl})";
                                }
                            }
                            $row_result = ltrim($row_result, ",");
                        }
                    } elseif ($attr2 == "equips_cmmt") {
                        $equips_cmmt = $row['nequips'];
                        $equip_cmmt = explode(',', $equips_cmmt);
                        $row_result = '';
                        if ($equips_cmmt) {
                            foreach ($equip_cmmt as $equips_cmmt_id) {
                                $sql = "SELECT iname FROM system_item_module WHERE iid = :equips_cmmt_id";
                                $stmt = $db->prepare($sql);
                                $stmt->execute([':equips_cmmt_id' => $equips_cmmt_id]);
                                $equip_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($equip_row) {
                                    $row_result .= "," . $equip_row['iname'];
                                }
                            }
                            $row_result = ltrim($row_result, ",");
                        }
                    } else {
                        $row_result = $row[$attr3];
                    }
                    if ($row_result === null || $row_result === '') {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row_result);
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'item':
                    $attr3 = 'i' . $attr2;
                    if ($attr3 == "icount") {
                        $sql = "SELECT * FROM system_item WHERE item_true_id = :mid AND sid = :sid";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid, ':sid' => $sid]);
                    } else {
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = :mid AND sid = :sid)";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([':mid' => $mid, ':sid' => $sid]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $row_result = $row[$attr3];
                    if ($row_result === null || $row_result === '') {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row_result);
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'scene_oplayer':
                    $attr3 = 'u' . $attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = :mid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':mid' => $mid]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                default:
                    $attr3 = 'n' . $attr2;
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = :oid";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':oid' => $oid]);
                    if (!$stmt) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3]);
                    }
                    $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
            }
            break;
        case 'm':
            $monster_skills_lvls = "";
            $attr3 = 'j' . $attr2;
            if ($attr3 == "jlvl") {
                $sql = "SELECT * FROM system_skill_user WHERE jpid = :jpid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':jpid' => $sid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_result = $row['jlvl'] ?? '';
                $op = process_string_3($row_result, $sid, $oid, $mid, $jid, $type, $para);
            } else {
                $sql = "SELECT * FROM system_skill WHERE jid = :jid";
                $stmt = $db->prepare($sql);
                $stmt->execute([':jid' => $jid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$row) {
                    die('查询失败: ' . $db->errorInfo()[2]);
                }
                $row_result = $row[$attr3] ?? null;
                if ($row_result === null || $row_result === '') {
                    $op = 0; // 或其他默认值
                } else {
                    $op = nl2br($row_result);
                }
                $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
            }
            break;
        case 'c':
            switch ($attr2) {
                case 'time':
                    $op = date('U');
                    break;
                case 'day':
                    $op = date('N');
                    break;
                case 'year':
                    $op = date('Y');
                    break;
                case 'month':
                    $op = date('n');
                    break;
                case 'date':
                    $op = date('j');
                    break;
                case 'hour':
                    $op = date('G');
                    break;
                case 'minute':
                    $op = 1 * date('i');
                    break;
                case 'second':
                    $op = 1 * date('s');
                    break;
                case 'online_user_count':

                    break;
                default:
                    $game_id = '19980925';
                    $attr4 = 'game_';
                    $attr3 = $attr4 . $attr2;
                    $sql = "SELECT * FROM gm_game_basic WHERE game_id = :game_id";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([':game_id' => $game_id]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row === false) {
                        die('查询失败: ' . $db->errorInfo()[2]);
                    }
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                    } else {
                        $op = nl2br($row[$attr3] ?? '');
                    }
            }
            // 使用正则表达式匹配字符串中的时间格式部分
            $pattern = '/nowtime_([UNYnjGHhist:]+)/';
            if (preg_match($pattern, $attr2, $matches)) {
                // 获取当前时间，并根据格式解析为具体时间信息
                $op = date($matches[1]);
            }
            $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
            // 替换字符串中的变量
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'g':
            $sql = "SELECT * FROM global_data WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $attr2]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row === false) {
                die('查询失败: ' . $db->errorInfo()[2]);
            }
            if ($row === null) {
                $op = 0; // 或其他默认值
            } else {
                $op = nl2br($row['value']);
            }
            $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
            // 替换字符串中的变量
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'e':
            $sql = "SELECT * FROM system_exp_def WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $attr2]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row === false) {
                die('查询失败: ' . $db->errorInfo()[2]);
            }
            if ($row === null) {
                $op = '';
            } else {
                $op = nl2br($row['value']);
            }
            // 替换字符串中的变量
            $op = process_string_3($op, $sid, $oid, $mid, $jid, $type, $para);
            $op = @eval("return $op;");
            //$input = str_replace("{{$match}}", $op, $input);
            break;
        case 'r':
            if (!is_numeric($attr2)) {
                $attr2 = "{" . $attr2 . "}";
            }
            $attr2 = process_string_3($attr2, $sid, $oid, $mid, $jid, $type, $para);
            $op = rand(1, $attr2) - 1;
            return $op;
            break;
        default:
            return 0;
            break;
    }
    // 在这里根据属性的不同进行处理
    // ...
    // 返回属性值，处理过程中可能会嵌套调用 process_string
    return $op;
}

// 定义处理字符串的函数
function process_string_3($input, $sid, $oid = null, $mid = null, $jid = null, $type = null, $para = null) {
    $db = DB::pdo();
    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);

    if (!empty($matches[1])) {
        foreach ($matches[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute_3($attr1,$attr2,$sid, $oid, $mid,$jid,$type,$db,$para);
                if($op =='' || $op == "" || $op ==null){
                    $op = "\"\"";
                }
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
            }
        }
    }

    // 进行其他逻辑处理
    // ...
    $input = evaluate_expression_3($input, $db, $sid, $oid, $mid, $jid, $type, $para);
    return $input;
}



function color_string($input)
{
    $pattern = '/@([^@]+)@([^@]+)@end@/'; // 匹配以 @ 开头和结尾的内容，括号内部为捕获组，表示颜色值和文本
    $matches = array();
    preg_match_all($pattern, $input, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $color = $match[1]; // 提取颜色值
        $text = $match[2]; // 提取文本内容
        if (!empty($color) && !empty($text)) {
            if (ctype_xdigit($color) && strlen($color) === 6) {
                $color = '#' . $color; // 添加 "#" 符号
            }
            $input = str_replace($match[0], '<span style="font-weight: bold;color: ' . $color . ';">' . $text . '</span>', $input);
        }
    }
    $input = str_replace('@end@', '</span>', $input);
    return $input;
}

function generate_image_link($hashtag)
{
    // 生成图片链接的逻辑
    // 创建数据库连接
    $para = explode("|", $hashtag);
    $para_1 = $para[0];
    $para_2 = $para[1];
    $db = DB::pdo();
    $sql = "SELECT photo_url FROM system_photo WHERE id = :para_2 AND type = :para_1";
    $stmt = $db->prepare($sql);
    $stmt->execute([':para_2' => $para_2, ':para_1' => $para_1]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $photo_url = $row['photo_url'] ?? '';
    $imageLink = urlencode($photo_url);
    return $imageLink;
}

function generate_image_style($hashtag)
{
    // 生成图片样式的逻辑
    // 创建数据库连接
    $para = explode("|", $hashtag);
    $para_1 = $para[0];
    $para_2 = $para[1];
    $db = DB::pdo();
    $sql = "SELECT photo_style FROM system_photo WHERE id = :para_2 AND type = :para_1";
    $stmt = $db->prepare($sql);
    $stmt->execute([':para_2' => $para_2, ':para_1' => $para_1]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $imageStyle = $row['photo_style'] ?? '';
    return $imageStyle;
}

function process_photoshow($input)
{
    $pattern = '/#([^#]+)#/'; // 匹配以 # 开头和结尾的内容，括号内部为捕获组，表示文本内容
    $matches = array();
    preg_match_all($pattern, $input, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $hashtag = $match[1]; // 提取文本内容
        if (!empty($hashtag)) {
            $imageLink = generate_image_link($hashtag);
            $imageStyle = generate_image_style($hashtag);
            $input = str_replace($match[0], "<img src='$imageLink' alt='$hashtag' style='{$imageStyle}'>", $input);
        }
    }

    return $input;
}

?>