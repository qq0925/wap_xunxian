<?php

namespace lexical_analysis;
use DB;
use mysqli;
//解析各个地方传来的{}。

//input是原始输入，sid是用户识别码，uid用于特殊事件，oid用于o关键字，mid用于获取当前场景id或npc的id,para用于分辨是泛字符串解析还是纯变量解析

// 全局 Redis 连接初始化，放在更高层级
$redis = new \Redis();
$redis->connect('127.0.0.1', 6379);



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

function hurt_calc($sid, $gid, $type, $dblj,$next_round, $jid = null, $pid = null) {
    $ngid = explode(',', $gid);
    $db = DB::conn();
    if($pid){
        $members = $sid.",".$pid;
    }else{
        $members = $sid;
    }
    // 获取伤害公式
    $skill_data = get_skill_data($jid, $db);
    if (!$skill_data['j_hurt_exp']) {
        $skill_data['j_hurt_exp'] = get_default_skill_hurt($db, 2)['j_hurt_exp'];
    }
    if (!$skill_data['j_deplete_exp']) {
        $skill_data['j_deplete_exp'] = get_default_skill_hurt($db, 2)['j_deplete_exp'];
    }
    
    if (!$skill_data['j_add_point_exp']) {
        $skill_data['j_add_point_exp'] = get_default_skill_hurt($db, 2)['j_add_point_exp'];
    }

    if (!$skill_data['j_promotion']) {
        $skill_data['j_promotion'] = get_default_skill_hurt($db, 2)['j_promotion'];
    }

    if (!$skill_data['j_promotion_cond']) {
        $skill_data['j_promotion_cond'] = get_default_skill_hurt($db, 2)['j_promotion_cond'];
    }

    if (!$skill_data['j_group_attack']) {
        $skill_data['j_group_attack'] = get_default_skill_hurt($db, 2)['j_group_attack'];
    }
    if (!$skill_data['j_umsg']) {
        $skill_data['j_umsg'] = get_default_skill_hurt($db, 2)['j_umsg'];
    }
    if (!$skill_data['j_event_use_id']) {
        $skill_data['j_event_use_id'] = get_default_skill_hurt($db, 2)['j_event_use_id'];
    }

    // 处理操作
    if ($type == 1) {
        handle_attack($ngid, $sid, $dblj, $skill_data, $jid,$next_round);
    } elseif ($type == 2) {
        handle_monster_attack($ngid,$sid, $members, $dblj,$db,$next_round,null);
    } elseif ($type == 3) {
        handle_pet_attack($ngid, $pid, $sid, $dblj,$db,$next_round);
    }
}

// 获取技能数据
function get_skill_data($jid, $db) {
    $sql = "SELECT * FROM system_skill WHERE jid = ?";
    $stmt = $db->prepare($sql);  // 预处理语句
    if($stmt) {
        // 绑定参数并执行语句
        $stmt->bind_param('i', $jid);  // 假设 $jid 是整数类型
        $stmt->execute();
        $result = $stmt->get_result();  // 获取查询结果
        $row = $result->fetch_assoc();  // 将结果作为关联数组获取

        return [
            'j_name' => $row['jname'] ?? null,
            'j_hurt_exp' => $row['jhurt_exp'] ?? null,
            'j_deplete_exp' => $row['jdeplete_exp'] ?? null,
            'j_deplete_attr' => $row['jdeplete_attr'] ?? null,
            'j_add_point_exp' => $row['jadd_point_exp'] ?? null,
            'j_promotion' => $row['jpromotion'] ?? null,
            'j_promotion_cond' => $row['jpromotion_cond'] ?? null,
            'j_group_attack' => $row['jgroup_attack'] ?? null,
            'j_umsg' => $row['jeffect_cmmt'] ?? null,
            'j_event_use_id' => $row['jevent_use_id'] ?? null,
        ];
    }
    return null;  // 如果 prepare 失败或没有数据，返回 null
}


// 获取默认技能伤害
function get_default_skill_hurt($db, $default_jid) {
    $sql = "SELECT * FROM system_skill_module WHERE jid = ?";
    $stmt = $db->prepare($sql);
    if($stmt){
        // 绑定参数并执行语句
        $stmt->bind_param('i', $default_jid);  // 假设 $default_jid 是整数类型
        $stmt->execute();
        $result = $stmt->get_result();  // 获取查询结果
        $row = $result->fetch_assoc();  // 将结果作为关联数组获取
    }
    
        return [
            'j_name' => $row['j_name'] ?? null,
            'j_hurt_exp' => $row['jhurt_exp'] ?? null,
            'j_deplete_exp' => $row['jdeplete_exp'] ?? null,
            'j_deplete_attr' => $row['jdeplete_attr'] ?? null,
            'j_add_point_exp' => $row['jadd_point_exp'] ?? null,
            'j_promotion' => $row['jpromotion'] ?? null,
            'j_promotion_cond' => $row['jpromotion_cond'] ?? null,
            'j_group_attack' => $row['jgroup_attack'] ?? null,
            'j_umsg' => $row['jeffect_cmmt'] ?? null,
            'j_event_use_id' => $row['jevent_use_id'] ?? null,
        ];
    
    return null;
}

// 处理群体攻击
function handle_attack($ngid, $sid, $dblj, $skill_data, $jid,$next_round) {
    $j_group_attack = $skill_data['j_group_attack'];
    $j_event_use_id = $skill_data['j_event_use_id'];
    $j_deplete_exp = $skill_data['j_deplete_exp'];
    $j_deplete_attr = $skill_data['j_deplete_attr'];
    if (!is_numeric($j_deplete_exp)) {
        $hurt_m_cut = process_string($j_deplete_exp, $sid, 'npc_monster', $ngid[0], $jid, 'fight',null);
        $hurt_m_cut = eval("return $hurt_m_cut;");
    } else {
        $hurt_m_cut = $j_deplete_exp;
    }
    $hurt_m_cut = (int)floor($hurt_m_cut);


    $u_skill_attr = "u".$j_deplete_attr;
    $attr_name = \gm\get_gm_attr_info('1',$j_deplete_attr,$dblj)['name'];
    $u_attr = \player\getplayer($sid,$dblj)->$u_skill_attr;
    $diff = $u_attr - $hurt_m_cut;
    if($diff <0){
        echo "没有足够的{$attr_name}！<br/>";
        return 'no';
    }else{
    \player\addplayertable('game1',$u_skill_attr,-$hurt_m_cut,$sid,$dblj);
    $sql = "insert into game2(cut_mp,sid,gid,round,type)values('-$hurt_m_cut','$sid','$ngid','$next_round','1')";
    $dblj->exec($sql);
    $j_add_point_exp = $skill_data['j_add_point_exp'];
    $j_promotion = $skill_data['j_promotion'];
    $j_promotion_cond = $skill_data['j_promotion_cond'];
    $jname = $skill_data['j_name'];

    if (!is_numeric($j_add_point_exp)) {
        $j_point_exp = process_string($j_add_point_exp, $sid, 'npc_monster', $ngid[0], $jid, 'fight',null);
        $j_point_exp = eval("return $j_point_exp;");
    } else {
        $j_point_exp = $j_add_point_exp;
    }
    $j_point_exp = (int)floor($j_point_exp);

    if (!is_numeric($j_promotion)) {
        $j_promotion_add = process_string($j_promotion, $sid, 'npc_monster', $ngid[0], $jid, 'fight',null);
        $j_promotion_add = eval("return $j_promotion_add;");
    } else {
        $j_promotion_add = $j_promotion;
    }
    $j_promotion_add = (int)floor($j_promotion_add);
    if (!is_numeric($j_promotion_cond)) {
        $j_promotion_cond_add = process_string($j_promotion_cond, $sid, 'npc_monster', $ngid[0], $jid, 'fight',1);
        $j_promotion_cond_add = eval("return $j_promotion_cond_add;");
    } else {
        $j_promotion_cond_add = $j_promotion_cond;
    }
    $j_promotion_cond_add = (int)floor($j_promotion_cond_add);

    if($j_promotion_cond_add){
    $sql = "update system_skill_user set jpoint = jpoint + '$j_point_exp' where jsid = '$sid' and jid = '$jid'";
    $dblj->exec($sql);
    $sql = "select jpoint,jlvl from system_skill_user where jid = '$jid' and jsid = '$sid'";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $jnowpoint = $ret['jpoint'];
    $jnowlvl = $ret['jlvl'];
    if($jnowpoint >=$j_promotion_add){
        $jnowlvl +=1;
        echo "你的技能[{$jname}]升级啦！当前为{$jnowlvl}级<br/>";
        $sql = "update system_skill_user set jpoint = jpoint - '$j_promotion_add',jlvl = jlvl + 1 where jsid = '$sid' and jid = '$jid'";
        $cxjg = $dblj->exec($sql);
    }
    }
    }


    }

    if ($j_group_attack == '-1') {
        $ngid_count = count($ngid);
        for ($i = 0; $i < $ngid_count; $i++) {
            $attack_gid = $ngid[$i];
            if ($attack_gid) {
                process_event($j_event_use_id, $sid, $dblj, $attack_gid);
                process_damage($skill_data, $sid, $dblj, $jid, $attack_gid, 'npc_monster',$next_round);
            }
        }
    } else {
        $ngid_count = count($ngid);
        if ($ngid_count > 0 && $j_group_attack > 0){
            $random_keys = array_rand($ngid, min($j_group_attack, $ngid_count));
        if ($j_group_attack == 1||$ngid_count ==1) {
            $random_keys = [$random_keys]; // 如果只选择一个 ID，确保 $random_keys 是数组
            }
        foreach ($random_keys as $key){
            $attack_gid = $ngid[$key];
            if ($attack_gid) {
                        process_event($j_event_use_id, $sid, $dblj, $attack_gid);
                        process_damage($skill_data, $sid, $dblj, $jid, $attack_gid, 'npc_monster',$next_round);
                    }
        }
        }
        
    }
}

//处理怪物群体攻击
function handle_members_attack($gid,$sid, $members, $dblj, $skill_id,$db,$next_round) {
            // Fetch skill details
        $skill_sql = "SELECT jhurt_exp, jeffect_cmmt, jgroup_attack FROM system_skill WHERE jid = '$skill_id'";
        $skill_result = $db->query($skill_sql);
        $skill = $skill_result->fetch_assoc();

            $hurt_exp = $skill['jhurt_exp'];
            $effect_comment = $skill['jeffect_cmmt'];
            $j_group_attack = $skill['jgroup_attack'];
            
            
            if(!$hurt_exp){
            $hurt_exp = get_default_skill_hurt($db, 2)['j_hurt_exp'];
        }
        
            if(!$effect_comment){
            $effect_comment = get_default_skill_hurt($db, 2)['j_umsg'];
        }

            if(!$j_group_attack){
            $j_group_attack = get_default_skill_hurt($db, 2)['j_group_attack'];
        }
            
            // 将 members 字符串转换为数组
            $member_ids = explode(',', $members);
            if ($j_group_attack == '-1') {
                $members_count = count($member_ids);
                for ($i = 0; $i < $members_count; $i++) {
                    $attack_member = $member_ids[$i];
                    if ($attack_member) {
                        //process_event($j_event_use_id, $sid, $dblj, $attack_gid);
                        process_monster_damage($hurt_exp,$effect_comment,$skill_id, $gid, $dblj, $attack_member,$sid,$next_round);
                    }
                }
            } else {
                
                
        // 随机选择 $j_group_attack 个 ID
        $count = count($member_ids);
        if ($count > 0 && $j_group_attack > 0) {
            $random_keys = array_rand($member_ids, min($j_group_attack, $count));
            if ($j_group_attack == 1||$count==1) {
                $random_keys = [$random_keys]; // 如果只选择一个 ID，确保 $random_keys 是数组
            }
            foreach ($random_keys as $key) {
                $member_id = $member_ids[$key];
                // 在这里处理每个 $member_id
                if($member_id){
                process_monster_damage($hurt_exp,$effect_comment,$skill_id, $gid, $dblj, $member_id,$sid,$next_round);
                }
                
            }
        }
            }
        
}

//处理怪物攻击
function handle_monster_attack($ngid,$sid, $members, $dblj, $db,$next_round) {
    // Loop through each monster in the group
    foreach ($ngid as $monster_id) {
        // Get monster details
        $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = '$monster_id' AND nhp > 0";
        $result = $db->query($sql);
        if ($result && $monster = $result->fetch_assoc()) {
            $monster_skills = $monster['nskills'];

            // Get default skill if no skills are available
            if (empty($monster_skills)) {
                $default_skill_sql = "SELECT default_skill_id FROM gm_game_basic";
                $default_result = $db->query($default_skill_sql);
                $default_skill = $default_result->fetch_assoc();
                $skill_id = $default_skill['default_skill_id'];
            } else {
                // Choose a random skill
                $skills_list = explode(',', $monster_skills);
                $skill_id = explode('|', $skills_list[array_rand($skills_list)])[0];
            }
            handle_members_attack($monster_id,$sid, $members, $dblj, $skill_id,$db,$next_round);
        }
    }
}

//处理宠物攻击
function handle_pet_attack($ngid, $pid, $sid, $dblj, $db,$next_round) {
        // -1表示群体攻击

        // 宠物循环，获取宠物技能参数。宠物出招生效的是?
        $pet_id = explode(",", $pid);
        
        foreach ($pet_id as $p_one) {
            // 查询宠物技能
            $sql = "SELECT * FROM system_skill_user WHERE jpid = ?";
            $stmt = $dblj->prepare($sql);
            $stmt->execute([$p_one]);
            $ret = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // 如果查询为空，执行默认操作
            if (!$ret) {
                $sql = "SELECT default_skill_id FROM gm_game_basic";
                $stmt = $dblj->query($sql);
                $default_skill = $stmt->fetch(\PDO::FETCH_ASSOC);
                $pet_jid = $default_skill['default_skill_id'];
            } else {
                // 随机选择一个技能
                $pet_jid = $ret[array_rand($ret)]['jid'];
            }

            // 获取技能详细信息
            $sql = "SELECT * FROM system_skill WHERE jid = '$pet_jid'";
            $result = $db->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $j_hurt_exp = $row['jhurt_exp'];
                $j_group_attack = $row['jgroup_attack'];
                $j_umsg = $row['jeffect_cmmt'];
            }

            if(!$hurt_exp){
            $hurt_exp = get_default_skill_hurt($db, 2)['j_hurt_exp'];
        }
        
            if(!$j_umsg){
            $j_umsg = get_default_skill_hurt($db, 2)['j_umsg'];
        }

            if(!$j_group_attack){
            $j_group_attack = get_default_skill_hurt($db, 2)['j_group_attack'];
        }

            if ($j_group_attack == '-1') {
                $ngid_count = count($ngid);

                for ($i = 0; $i < $ngid_count; $i++) {
                    $attack_gid = $ngid[$i];
                    if ($attack_gid) {
                        $hurt_cut = process_string_3($j_hurt_exp, $p_one, 'pet_fight', $attack_gid, $pet_jid, 'fight');
                        $hurt_cut = (int)floor(@eval("return $hurt_cut;"));
                        $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
                        
                        $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - {$hurt_cut}, nsid = '$sid' WHERE ngid='$attack_gid'";
                        $dblj->exec($sql);
                        
                        $j_umsg = \lexical_analysis\process_string_3($j_umsg, $p_one, 'pet_fight', $attack_gid, $pet_jid);
                        $j_umsg = str_replace(array("'", "\""), '', $j_umsg);
                        $sql = "insert into game2(hurt_hp,sid,gid,pid,fight_umsg,type)values('-$hurt_cut','$sid','$attack_gid','$p_one','$j_umsg','4')";
                        $dblj->exec($sql);
                    }
                }
            } else {
                
        $ngid_count = count($ngid);
        if ($ngid_count > 0 && $j_group_attack > 0){
            $random_keys = array_rand($ngid, min($j_group_attack, $ngid_count));
        if ($j_group_attack == 1||$ngid_count==1) {
            $random_keys = [$random_keys]; // 如果只选择一个 ID，确保 $random_keys 是数组
            }
        foreach ($random_keys as $key){
            $attack_gid = $ngid[$key];
            if ($attack_gid) {
                        $hurt_cut = process_string_3($j_hurt_exp, $p_one, 'pet_fight', $attack_gid, $pet_jid, 'fight');
                        $hurt_cut = (int)floor(@eval("return $hurt_cut;"));
                        $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
                        
                        $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - {$hurt_cut}, nsid = '$sid' WHERE ngid='$attack_gid'";
                        $dblj->exec($sql);

                        $j_umsg = \lexical_analysis\process_string_3($j_umsg, $p_one, 'pet_fight', $attack_gid, $pet_jid);
                        $j_umsg = str_replace(array("'", "\""), '', $j_umsg);
                        
                        $sql = "insert into game2(hurt_hp,sid,gid,pid,fight_umsg,round,type)values('-$hurt_cut','$sid','$attack_gid','$p_one','$j_umsg','$next_round','4')";
                        $dblj->exec($sql);
                    }
        }
        }
            }
        }
    
}




// 处理事件
function process_event($j_event_use_id, $sid, $dblj, $attack_gid) {
    if ($j_event_use_id != 0) {
        include_once 'class/events_steps_change.php';
        events_steps_change($j_event_use_id, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc_monster', $attack_gid, $para);
    }
    global_events_steps_change(5, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc_monster', $attack_gid, $para);
    global_events_steps_change(28, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'npc_monster', $attack_gid, $para);
}

// 处理伤害
function process_damage($skill_data, $sid, $dblj, $jid, $attack_gid, $context,$next_round) {
    $j_hurt_exp = $skill_data['j_hurt_exp'];
    $j_umsg = $skill_data['j_umsg'];

    $hurt_cut = process_string($j_hurt_exp, $sid, $context, $attack_gid, $jid, 'fight',1);
    $hurt_cut = eval("return $hurt_cut;");
    $hurt_cut = (int)floor($hurt_cut);
    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;

    $sql = "UPDATE system_npc_midguaiwu SET nhp = nhp - ?, nsid = ? WHERE ngid = ?";
    $stmt = $dblj->prepare($sql);
    $stmt->execute([$hurt_cut, $sid, $attack_gid]);

    $j_umsg = \lexical_analysis\process_string($j_umsg, $sid, $context, $attack_gid,1);
    $j_umsg = str_replace(["'", "\""], '', $j_umsg);

    $sql = "insert into game2(hurt_hp,sid,gid,pid,fight_umsg,round,type)values('-$hurt_cut','$sid','$attack_gid','$p_one','$j_umsg','$next_round','1')";
    $dblj->exec($sql);
}

//处理怪物伤害
function process_monster_damage($hurt_exp, $effect_comment,$jid, $gid, $dblj, $member_id,$sid,$next_round) {
    if(!is_numeric($member_id)){
    $hurt_cut = process_string_2($hurt_exp, $gid,'monstertouser', $member_id,$jid);
    $hurt_cut = eval("return $hurt_cut;");
    $hurt_cut = (int)floor($hurt_cut);
    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
    $sql = "UPDATE game1 SET uhp = uhp - ? WHERE sid = ?";
    $stmt = $dblj->prepare($sql);
    $stmt->execute([$hurt_cut, $member_id]);

    $j_omsg = process_string_2($effect_comment, $gid, 'monstertouser',$member_id,$jid);
    $j_omsg = str_replace(["'", "\""], '', $j_omsg);

    $sql = "insert into game2(cut_hp,gid,sid,fight_omsg,round,type)values('-$hurt_cut','$gid','$sid','$j_omsg','$next_round','2')";
    $dblj->exec($sql);
}
    else{
    $hurt_cut = process_string_2($hurt_exp, $gid,'monstertopet', $member_id,$jid);
    $hurt_cut = eval("return $hurt_cut;");
    $hurt_cut = (int)floor($hurt_cut);
    $hurt_cut = $hurt_cut <= 0 ? 1 : $hurt_cut;
    $sql = "UPDATE system_pet_scene SET nhp = nhp - ? WHERE npid = ?";
    $stmt = $dblj->prepare($sql);
    $stmt->execute([$hurt_cut, $member_id]);
    $j_omsg = process_string_2($effect_comment, $gid, 'monstertopet',$member_id,$jid);
    $j_omsg = str_replace(["'", "\""], '', $j_omsg);

    $sql = "insert into game2(cut_hp,gid,sid,pid,fight_omsg,round,type)values('-$hurt_cut','$gid','$sid','$member_id','$j_omsg','$next_round','3')";
    $dblj->exec($sql);

    }
}

function getSubstringBetweenDots($str, $startDotIndex = 0, $endDotIndex = null) {
    // 将字符串按 '.' 分割成数组
    $parts = explode('.', $str);

    // 检查 startDotIndex 是否合理
    if ($startDotIndex < 0 || $startDotIndex >= count($parts)) {
        return false; // startDotIndex 不正确
    }

    // 如果 endDotIndex 为 null，获取从 startDotIndex 到结尾的部分
    if ($endDotIndex === null) {
        return implode('.', array_slice($parts, $startDotIndex));
    }

    // 检查 endDotIndex 是否合理
    if ($endDotIndex <= $startDotIndex || $endDotIndex > count($parts)) {
        return false; // endDotIndex 不正确
    }

    // 获取从 startDotIndex 到 endDotIndex - 1 的子字符串
    return implode('.', array_slice($parts, $startDotIndex, $endDotIndex - $startDotIndex));
}

//---------分割线----------//
function evaluate_expression($expr, $db, $sid,$oid,$mid,$jid,$type,$para=null){
$expr = preg_replace_callback('/\{eval\((.*?)\)\}/', function($matches) use ($db,$sid,$oid,$mid,$jid,$type,$para) {
    // /\{eval\(([^)]+)\)\}/
    $eval_expr = $matches[1]; // 获取 eval 中的表达式
    $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
    if(is_float($eval_result) && !is_string($eval_result)){
        return (int)$eval_result;
    }else{
    return $eval_result; // 返回计算结果
    }
}, $expr);
$expr = preg_replace_callback('/\{([^}]+)\}/', function($matches) use ($db,$sid,$oid,$mid,$jid,$type,$para) {
    $attr = $matches[1]; // 获取匹配到的变量名
    global $redis;
        // 检查缓存中是否已有值
            // 如果缓存中没有，则查询数据库并缓存
            $firstDotPosition = strpos($attr, '.');
            if ($firstDotPosition !== false) {
                $attr1 = getSubstringBetweenDots($attr, 0, 1);
                $attr2 = getSubstringBetweenDots($attr, 1);
                $attr3 = getSubstringBetweenDots($attr, 1, 2);
                switch($attr1){
    case 'u':
        $cacheKey = 'user:'.$sid.':'.$attr;
        break;
    case 'o':
        $cacheKey = 'obj_type:'.$oid.':'.'obj_value:'.$mid.':'.$attr;
        break;
    case 'e':
        $cacheKey = 'expr:'.':'.$attr2;
        break;
    case 'c':
        $cacheKey = 'system:'.':'.$attr2;
        break;
    case 'g':
        $cacheKey = 'global:'.':'.$attr2;
        break;
    case 'm':
        $cacheKey = 'm_type:'.$oid.':'.'m_value:'.$mid.'m_j:'.$jid.':'.$attr;
        break;
}
                if (!$redis->exists($cacheKey)||$attr1 == 'r'||$attr3 =='env'||$attr1 == 'e'||$attr3 =='equips'||$attr3=='skills'||$attr1 =='ut'||$attr1=='ot'){
                
                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1,$attr2,$sid, $oid, $mid,$jid,$type,$db,$para);
                // 替换字符串中的变量
                 // 将查询的结果存储在 Redis 中，使用 JSON 序列化
                $redis->set($cacheKey, json_encode($op));
                }else {
            // 从 Redis 缓存中获取值
            $op = json_decode($redis->get($cacheKey), true);
        }
            }

    // 在这里根据变量名获取对应的值，例如从数据库中查询
    // 假设你从数据库中获取了 $attr_value]
    $temp = $op;
    if (strpos($temp, '"') === false){
    $op = "\"".$temp."\"";
    }
    $op = str_replace(array("''", "\"\""), '0', $op);
    // 使用正则表达式，去掉内部的单引号
    $op = preg_replace("/'(.*?)'/", '$1', $op);
    $op = str_replace(array("\""), '\'', $op);
    return $op;
}, $expr);

// 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
$result = $expr;
//var_dump($result);
try{

//$result = eval("return $expr;");
}catch (ParseError $e){
                print("语法错误: ". $e->getMessage());
                
            }
            catch (Error $e){
                print("执行错误: ". $e->getMessage());
}
return $result;
}

function process_attribute($attr1, $attr2,$sid, $oid, $mid,$jid,$type,$db,$para=null) {
            switch ($attr1) {
                case 'u':
                    if (strpos($attr2, "env.") === 0) {
                    $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                    switch($attr3){
                        case 'user_count':
                        // 构建 SQL 查询语句
                        $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = ?) and uis_sailing = 0";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["count"];
                        break;
                        case 'npc_count':
                        $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        // 处理结果
                        $totalNpcCount = 0;
                        
                        while ($row = $result->fetch_assoc()) {
                            $mnpc = $row["mnpc_now"];
                            $npcs = explode(",", $mnpc); // 拆分成每个npc项
                            foreach ($npcs as $npc) {
                                $npc_show_cond = urldecode(explode("|", $npc)[2]);
                                $show_cond = checkTriggerCondition($npc_show_cond,$dblj,$sid);
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
                        case 'alive_npc_count':
                        $sql = "SELECT COUNT(*) as count FROM system_npc_scene WHERE nmid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        // 处理结果
                        $op = $row['count'];
                        break;
                        case 'monster_count':
                        $sql = "SELECT COUNT(*) as count FROM system_npc_midguaiwu WHERE nsid = '' and nmid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        // 处理结果
                        $op = $row["count"];
                        break;
                        case 'pet_count':
                        $sql = "SELECT COUNT(*) as count FROM system_pet_scene WHERE nmid = (SELECT nowmid FROM game1 WHERE sid = ?) and nstate = 1";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        // 处理结果
                        $op = $row["count"];
                        break;
                        case 'item_count':
                        $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        // 处理结果
                        $totalItemCount = 0;
                        while ($row = $result->fetch_assoc()) {
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
                        $sql = "SELECT justmid FROM game1 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["justmid"];
                        break;
                        case 'nowmid':
                        // 构建 SQL 查询语句
                        $sql = "SELECT nowmid FROM game1 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["nowmid"];
                        break;
                        case 'name':
                        // 构建 SQL 查询语句
                        $sql = "SELECT mname from system_map where mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["mname"];
                        $sql = "SELECT uis_sailing from game1 where sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $is_sailing = $row["uis_sailing"];
                        if($is_sailing ==1){
                        $op = "茫茫大海";
                        }
                        break;
                    }
                    }
                    elseif(strpos($attr2, "input.") === 0){
                    $attr3 = substr($attr2, 6); // 提取 "input." 后面的部分
                    // 构建 SQL 查询语句
                    $sql = "SELECT value FROM system_player_inputs WHERE sid = ? and id = ?";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("ss", $sid,$attr3);
                    
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row['value'];
                    if ($op === null||$op =='') {
                        $op = "\"\""; // 或其他默认值
                        }
                    }
                    elseif(strpos($attr2, "refresh_time") === 0){
                    $sql = "SELECT mgtime,mrefresh_time FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $nowdate = date('Y-m-d H:i:s');
                    $mid_time = $row["mgtime"];
                    $mid_refresh_time = $row['mrefresh_time'];
                    $op= $mid_refresh_time - floor((strtotime($nowdate)-strtotime($mid_time))/60);//获取刷新分钟剩余
                    }elseif(strpos($attr2, "team_member_count") === 0){
                    $sql = "SELECT team_member FROM system_team_user WHERE team_member in (SELECT uid FROM game1 WHERE sid = ?)";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $team_member = $row["team_member"];
                    $op= @count(explode(',',$team_member));
                    }elseif(strpos($attr2, "team_members") === 0){
                    $attr3 = substr($attr2, 13); // 提取 "team_members." 后面的部分
                    $para = explode(".",$attr3);
                    $order = $para[0];
                    $attr_player = "u".$para[1];
                    $sql = "
    SELECT g1.*
    FROM game1 g1
    JOIN system_team_user stu ON FIND_IN_SET(g1.uid, stu.team_member) > 0
    WHERE EXISTS (
        SELECT uid
        FROM game1
        WHERE sid = ?
    )
    ORDER BY FIND_IN_SET(g1.uid, stu.team_member);
";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    // 移动指针到第 $order+1 行
                    for ($i = 0; $i < $order; $i++) {
                        $row = $result->fetch_assoc();
                    }
                    $op = $row[$attr_player];

                    
                    }elseif(strpos($attr2, "tasks.") === 0){
                    $attr3 = substr($attr2, 6); // 提取 "tasks." 后面的部分
                    if (strpos($attr3, "count") === 0){
                    $sql = "select * from system_task_user WHERE sid='$sid' AND tstate !=2";
                    $cxjg = $db->query($sql);
                    $wtjrw = $cxjg->fetch_all(MYSQLI_ASSOC);
                    $op = count($wtjrw);
                    }elseif (strpos($attr3, 't') === 0) {
                    $attr3 = substr($attr3, 1); // 去掉开头的 "t"
                    $tid = $attr3;
                    $sql = "SELECT ttype from system_task where tid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $tid);
                    // 执行查询
                    $stmt->execute();
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $ttype = $row["ttype"];
                    $sql = "SELECT tstate FROM system_task_user WHERE tid =  ? and sid = ?";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("ss", $tid,$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row["tstate"];
                    }
                    if(is_null($op)){
                        $op = "\"\"";
                    }else{
                        if($ttype ==3){
                        $op = 2;
                        }
                    }
                    }elseif(strpos($attr2, "ic.") === 0){
                    $attr3 = substr($attr2, 3); // 提取 "ic." 后面的部分
                    if (strpos($attr3, 'i') === 0) {
                        $attr3 = substr($attr3, 1); // 去掉开头的 "i"
                    }
                    $iid = $attr3;
                    $sql = "SELECT icount FROM system_item WHERE iid =  ? and sid = ?";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("ss", $iid,$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row["icount"];
                    if(is_null($op)){
                        $op = "\"\"";
                    }
                    }elseif(strpos($attr2, "jv.") === 0){
                    $attr3 = substr($attr2, 3); // 提取 "jv." 后面的部分
                    if (strpos($attr3, 'j') === 0) {
                        $attr3 = substr($attr3, 1); // 去掉开头的 "j"
                    }
                    $jid = $attr3;
                    $sql = "SELECT jlvl FROM system_skill_user WHERE jid =  ? and jsid = ?";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("ss", $jid,$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row["jlvl"];
                    if(is_null($op)){
                        $op = "\"\"";
                    }
                    }elseif(strpos($attr2, "enemys.") === 0){
                    $attr3 = substr($attr2, 7); // 提取 "enemys." 后面的部分
                    $jid = $attr3;
                    if($attr3 =="count"){
                    $sql = "SELECT count(*) as enemys_count FROM system_npc_midguaiwu WHERE nsid = ?";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s",$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row["enemys_count"];
                    }else{
                    $para = explode(".",$attr3);
                    $order = $para[0];
                    $attr_guai = "n".$para[1];
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE nsid = ?";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s",$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    // 移动指针到第 $order+1 行
                    for ($i = 0; $i < $order; $i++) {
                        $row = $result->fetch_assoc();
                    }
                    $op = $row[$attr_guai];
                    }
                    if(is_null($op)){
                        $op = "\"\"";
                    }
                    }elseif(strpos($attr2, "alive_enemys.") === 0){
                    $attr3 = substr($attr2, 13); // 提取 "alive_enemys." 后面的部分
                    $jid = $attr3;
                    if($attr3 =="count"){
                    $sql = "SELECT count(*) as alive_enemys_count FROM system_npc_midguaiwu WHERE nhp > 0 and nsid = ?";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s",$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $op = $row["alive_enemys_count"];
                    }else{
                    $para = explode(".",$attr3);
                    $order = $para[0];
                    $attr_guai = "n".$para[1];
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE nhp > 0 and nsid = ?";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s",$sid);
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    // 移动指针到第 $order+1 行
                    for ($i = 0; $i < $order; $i++) {
                        $row = $result->fetch_assoc();
                    }
                    $op = $row[$attr_guai];
                    }
                    if(is_null($op)){
                        $op = "\"\"";
                    }
                    }elseif(strpos($attr2, "equips.") === 0){
                    $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
                    if (strpos($attr3, 'b.') === 0) {
                        $attr4 = substr($attr3, 2); // 提取 "b." 后面的部分
                        $bid = $attr4;
                        $sql = "SELECT eq_true_id FROM system_equip_user WHERE eq_type =  1 and eqsid = ? and eqpid = 0";
                    
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$sid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["eq_true_id"];
                        if(!$op){
                            $op = "\"\"";
                        }else{
                        if (strpos($attr4, 'embed.') === 0){
                        //镶物属性相关
                        $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                        if(preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $mosaic_pos = rtrim($prefix, ".");
                        
                        $attr6 = $matches[2]; // 匹配到的剩余部分
                        }
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $mosaic_list = $row['equip_mosaic'];
                        $mosaic_para = explode('|',$mosaic_list);
                        if(!$mosaic_para[$mosaic_pos]){
                            $op = "\"\"";
                        }else{
                        $mosaic_id = $mosaic_para[$mosaic_pos];
                        $xid = "i".$attr6;
                        $sql = "SELECT * FROM system_item_module WHERE iid = '$mosaic_id'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$xid]);
                        }
                        }
                        //镶物属性相关
                        
                        
                        }else{
                        $bid = "i".$bid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$op')";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($attr4 =="count"){
                            $op = $op?1:0;
                        }elseif($attr4 =="embed_count"){
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($row){
                        $op = count(explode('|',$row['equip_mosaic']));
                        }else{
                        $op = "\"\"";
                        }
                        }else{
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$bid]);
                        }
                        }
                        }
                        }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    }
                    elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $equiped_pos = rtrim($prefix, ".");
                        $attr4 = $matches[2]; // 匹配到的剩余部分
                        // SQL 查询语句
                        $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";
                        
                        // 执行查询并检查是否有结果
                        $result = $db->query($sql);
                        
                        if ($result->num_rows > 0) {
                            // 初始化数组
                            $idArray = array();
                        
                            // 将查询结果存入数组
                            while ($row = $result->fetch_assoc()) {
                                $idArray[] = $row["id"];
                            }
                        }
                        $equiped_pos = $idArray[$equiped_pos];

                        $fid = $attr4;
                        $sql = "SELECT eq_true_id FROM system_equip_user WHERE eq_type =  2 and equiped_pos_id = ? and eqsid = ? and eqpid = 0";
                    
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("ss",$equiped_pos,$sid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["eq_true_id"];
                        if(!$op){
                            $op = "\"\"";
                        }else{
                        if (strpos($attr4, 'embed.') === 0){
                        $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                        if(preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $mosaic_pos = rtrim($prefix, ".");
                        
                        $attr6 = $matches[2]; // 匹配到的剩余部分
                        }
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $mosaic_list = $row['equip_mosaic'];
                        $mosaic_para = explode('|',$mosaic_list);
                        if(!$mosaic_para[$mosaic_pos]){
                            $op = "\"\"";
                        }else{
                        $mosaic_id = $mosaic_para[$mosaic_pos];
                        $xid = "i".$attr6;
                        $sql = "SELECT * FROM system_item_module WHERE iid = '$mosaic_id'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$xid]);
                        }
                        }
                        //镶物属性相关
                        }else{
                        $fid = "i".$fid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$op')";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($attr4 =="count"){
                            $op = $op?1:0;
                        }elseif($attr4 =="embed_count"){
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($row){
                        $op = count(explode('|',$row['equip_mosaic']));
                        }else{
                        $op = "\"\"";
                        }
                        }else{
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$fid]);
                        }
                        }
                        }
                        }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    }
                    }elseif(strpos($attr2, "callout_adopt.") === 0){
                    $attr3 = substr($attr2, 14); // 提取 "callout_adopt." 后面的部分
                    if (strpos($attr3, 'count') === 0) {
                        $sql = "SELECT COUNT(*) as total_callout FROM system_pet_scene WHERE nstate =  1 and nsid = ?";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$sid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["total_callout"];
                        if(!$op){
                            $op = "\"\"";
                        }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    }
                    elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $pet_pos = rtrim($prefix, ".");
                        $attr4 = $matches[2]; // 匹配到的剩余部分
                        // SQL 查询语句
                        $sql = "SELECT npid FROM system_pet_scene WHERE nsid = ? ORDER BY npid";

                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$sid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        if ($result->num_rows > 0) {
                            // 初始化数组
                            $idArray = array();
                        
                            // 将查询结果存入数组
                            while ($row = $result->fetch_assoc()) {
                                $idArray[] = $row["npid"];
                            }
                        }
                        $pet_pos = $idArray[$pet_pos];

                        $fid = $attr4;
                        
                        if (strpos($attr4, 'cut_hp') === 0){
                        $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                        if(preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $mosaic_pos = rtrim($prefix, ".");
                        
                        $attr6 = $matches[2]; // 匹配到的剩余部分
                        }
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $mosaic_list = $row['equip_mosaic'];
                        $mosaic_para = explode('|',$mosaic_list);
                        if(!$mosaic_para[$mosaic_pos]){
                            $op = "\"\"";
                        }else{
                        $mosaic_id = $mosaic_para[$mosaic_pos];
                        $xid = "i".$attr6;
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$mosaic_id')";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$xid]);
                        }
                        }
                        //镶物属性相关
                        }else{
                        $pid = "p".$fid;
                        $sql = "SELECT * FROM system_pet_player WHERE pid = '$pet_pos'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$pid]);
                        }
                        }
                        
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    }
                    }else{
                    $attr3 = $attr1.$attr2;
                    $attr3 = str_replace('.', '', $attr3);
                    $sql = "SHOW COLUMNS FROM game1 LIKE '$attr3'";
                    $result = $db->query($sql);
                    if($result->num_rows >0){
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    }else{
                    $sql = "SELECT * FROM system_addition_attr WHERE sid = ? and name = '$attr3'";
                    $attr_type = 1;
                    }
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    $stmt->execute();
                    $result_2 = $stmt->get_result();
                    if (!$result_2) {
                        
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result_2->fetch_assoc();
                    if ($row === null||$row =='') {
                        $op = "\"\""; // 或其他默认值
                        }else{
                            if($attr_type !=1){
                    $op = nl2br($row[$attr3]);
                            }else{
                    $op = nl2br($row['value']);
                            }
                        }
                    $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    }
                    break;
                case 'ut':
                    switch($attr2){
                        case 'is_computer':
                        $userAgent = $_SERVER['HTTP_USER_AGENT'];
                        if (strpos($userAgent, 'Mobile') !== false) {
                            // 用户正在使用移动设备（手机或平板）
                            $op = "\"\"";
                        } else {
                            // 用户正在使用桌面设备（电脑）
                            $op = 1;
                        }
                            break;
                        case 'fight_show_cut':
                        $sql = "SELECT ucmd FROM game1 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($row){
                        $ucmd = $row["ucmd"];
                        }
                            if($ucmd =="pve_fighting"){
                                $op = 1;
                            }else{
                                $op = 0;
                            }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            break;
                        case 'cut_hp':
                        $db = DB::conn();
                        $round = \player\getnowround($sid,$dblj,$db);
                        // 构建 SQL 查询语句
                        $sql = "SELECT SUM(cut_hp) AS total_cut_hp FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        
                        // 关闭第一个查询的结果集
                        $stmt->close();
                        
                        // 获取总和并处理结果
                        $total_cut_hp = $row["total_cut_hp"];
                        $op = $total_cut_hp;
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                        break;
                        case 'cut_mp':
                        $db = DB::conn();
                        $round = \player\getnowround($sid,$dblj,$db);
                        // 构建 SQL 查询语句
                        $sql = "SELECT SUM(cut_mp) as total_cut_mp FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        
                        // 关闭第一个查询的结果集
                        $stmt->close();
                        
                        // 获取总和并处理结果
                        $total_cut_mp = $row["total_cut_mp"];
                        
                        $op = $total_cut_mp;
                        
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                        break;
                        case 'busy':
                        $sql = "SELECT attr_value FROM player_temp_attr WHERE obj_id = ? and obj_type = 1 and attr_name = 'busy'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($row){
                        $op = $row["attr_value"];
                        }
                        if ($op === null||$op =='') {
                            $op = "0"; // 或其他默认值
                            }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                        break;
                        case 'fight_umsg':
                        $dblj = DB::pdo();
                        $round = \player\getnowround($sid,$dblj);
                        $sql = "SELECT fight_umsg FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                        $op .= $row["fight_umsg"];
                        }
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($op);
                            }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                        break;
                        case 'fight_omsg':
                        $dblj = DB::pdo();
                        $round = \player\getnowround($sid,$dblj);
                        $sql = "SELECT fight_omsg FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                        $op .= $row["fight_omsg"];
                        }
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($op);
                            }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                        break;
                    }
                    break;
                case 'ot':
                    switch($attr2){
                        case 'is_computer':
                        $sql = "SELECT sfzx from game1 where sid = ?";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $sfzx = $row["sfzx"];
                        if($sfzx ==1){
                        $sql = "SELECT device_agent FROM game4 WHERE sid = ?";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $userAgent = $row["device_agent"];
                        if (strpos($userAgent, 'Mobile') !== false) {
                            // 用户正在使用移动设备（手机或平板）
                            $op = "\"\"";
                        } else {
                            // 用户正在使用桌面设备（电脑）
                            $op = 1;
                        }
                        }else{
                            // 用户离线
                            $op = 2;
                        }
                            break;
                        case 'cut_hp':
                        // 构建 SQL 查询语句
                        $sql = "SELECT * FROM game2 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["hurt_hp"];
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        break;
                    }
                    break;
                case 'o':
                    switch($oid){
                        case 'scene':
                            // 匹配字符串格式 exit_x.xx，不限制.xx的具体值
                            // 匹配字符串格式 exit_x.xx
                            if (preg_match('/exit_([nswe])\.(.+)/', $attr2, $matches)) {
                                $exitType = $matches[1];  // 匹配到的x (n, s, w, e)
                                $xxValue = 'm' . $matches[2];   // 匹配到的.xx的值加上'm'前缀
                                // 将x映射到对应的字段
                                $fieldMapping = [
                                    'n' => 'mup',
                                    's' => 'mdown',
                                    'w' => 'mleft',
                                    'e' => 'mright',
                                ];
                                
                                $field = $fieldMapping[$exitType];  // 获取对应字段名称
                            
                                // 查询system_map表，获取对应字段（up, down, left, right）对应的mid
                                $sql = "SELECT $field FROM system_map WHERE mid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param('i', $mid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if ($result && $row = $result->fetch_assoc()) {
                                    $targetMid = $row[$field];
                            
                                    // 根据targetMid获取.xx字段的值
                                    $sql2 = "SELECT $xxValue FROM system_map WHERE mid = ?";
                                    $stmt2 = $db->prepare($sql2);
                                    $stmt2->bind_param('i', $targetMid);
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();
                            
                                    if ($result2 && $row2 = $result2->fetch_assoc()) {
                                        if($xxValue =='mid'){
                                        $op = 's'.$row2[$xxValue];
                                        }else{
                                        $op = $row2[$xxValue];
                                        }
                                    }
                                }
                                if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                            }
                            else{
                            $attr3 = 'm'.$attr2;
                            $sql = "SELECT * FROM system_map WHERE mid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row == null||$row =='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'pet':
                            if ($attr2 == "skills_cmmt") {
                                
                                $sql = "SELECT * FROM system_skill_user WHERE jpid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $mid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                while($row = $result->fetch_assoc()){
                                
                                    $skill_id = $row['jid'];
                                    $skill_lvl = $row['jlvl'];
                                    $sql2 = "SELECT * FROM system_skill WHERE jid = ?";
                                    $stmt2 = $db->prepare($sql2);
                                    $stmt2->bind_param("s", $skill_id);
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();
                                    $row2 = $result2->fetch_assoc();
                                    $row_result .= "，" . $row2['jname'] ."(". "{$skill_lvl}".")";
                                    
                                    $skill_final = ltrim($row_result, "，");
                                    if(!$skill_final){
                                        $op = "无";
                                    }else{
                                        $op = $skill_final;
                                    }
                                }
                            }elseif($attr2 == "equips_cmmt") {
    $sql = "SELECT * FROM system_equip_def WHERE type = '1'";
    $cxjg = $db->query($sql);
    $ret = $cxjg ? $cxjg->fetch_all(MYSQLI_ASSOC) : [];
    
    $equipbid = null;
    foreach ($ret as $row) {
        $equiptypeid = $row['id'];
        $equiptypename = $row['name'];
        $sql = "SELECT * FROM system_equip_user WHERE eq_type = 1 AND equiped_pos_id = '$equiptypeid' AND eqsid = '$sid' AND eqpid = '$mid'";
        $cxjg = $db->query($sql);
        if ($cxjg) {
            $row = $cxjg->fetch_assoc();
            if ($row) {
                $equipbid = $row['eq_true_id'];
                break;
            }
        }
    }
    
    if ($equipbid) {
        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$equipbid')";
        $cxjg = $db->query($sql);
        if ($cxjg) {
            $row = $cxjg->fetch_assoc();
            if ($row) {
                $equipbname = \lexical_analysis\color_string($row['iname']);
                $equipbhtml = $equipbname . ",";
            }
        }
    }
    
    $sql = "SELECT * FROM system_equip_def WHERE type = 2";
    $cxjg = $db->query($sql);
    $ret = $cxjg ? $cxjg->fetch_all(MYSQLI_ASSOC) : [];
    
    $equipfhtml = '';
    foreach ($ret as $row) {
        $equiptypeid = $row['id'];
        $equiptypename = $row['name'];
        $sql = "SELECT * FROM system_equip_user WHERE eq_type = 2 AND equiped_pos_id = '$equiptypeid' AND eqsid = '$sid' AND eqpid = '$mid'";
        $cxjg = $db->query($sql);
        if ($cxjg) {
            $row = $cxjg->fetch_assoc();
            if ($row) {
                $equipfid = $row['eq_true_id'];
                if ($equipfid) {
                    $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$equipfid')";
                    $cxjg = $db->query($sql);
                    if ($cxjg) {
                        $row = $cxjg->fetch_assoc();
                        if ($row) {
                            $equipfname = \lexical_analysis\color_string($row['iname']);
                        }
                    }
                }
                $equipfhtml .= $equipfname . ",";
            }
        }
    }

$equipbhtml = rtrim($equipbhtml,',');
$equipfhtml = rtrim($equipfhtml,',');
$bagequiphtml = $equipbhtml.",".$equipfhtml;
$bagequiphtml = rtrim($bagequiphtml,',');

if(!$bagequiphtml){
    $op = "无";
}else{
    $op = $bagequiphtml;
}
                            }else{
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_pet_scene WHERE npid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            
                            
                            if ($row == null||$row =='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                            if ($attr2 == "is_adopt") {
                                $op = $row['ncan_shouyang'];
                            } 
                                }
                            if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'npc':
                            $attr3 = 'n'.$attr2;
                            if (is_numeric($mid)){
                            $sql = "SELECT * FROM system_npc WHERE nid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            }else{
                            $data_mid = explode("|",$mid);
                            $mid2 = $data_mid[1];
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid2);
                            }
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($attr2 == "skills_cmmt") {
                                $skills_cmmt = $row['nskills'];
                                $skill_cmmt = explode(',', $skills_cmmt);
                                if ($skills_cmmt) {
                                    foreach ($skill_cmmt as $skill_cmmt_detail) {
                                        $skill_para = explode('|', $skill_cmmt_detail);
                                        $skill_id = $skill_para[0];
                                        $skill_lvl = $skill_para[1];
                                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $skill_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "，" . $row['jname'] ."(". "{$skill_lvl}".")";
                                    }
                                    $row_result = ltrim($row_result, "，");
                                }
                            } elseif ($attr2 == "equips_cmmt") {
                                $equips_cmmt = $row['nequips'];
                                $equip_cmmt = explode(',', $equips_cmmt);
                                if ($equips_cmmt) {
                                    foreach ($equip_cmmt as $equips_cmmt_para) {
                                        $equips_cmmt_id = explode('_',$equips_cmmt_para)[2];
                                        $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $equips_cmmt_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "，" . $row['iname'];
                                    }
                                    $row_result = ltrim($row_result, "，");
                                }
                            } elseif ($attr2 == "is_adopt") {
                                $row_result = $row['ncan_shouyang'];
                            } else {
                                $row_result = $row[$attr3];
}

                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'npc_monster':
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($attr2 == "skills_cmmt") {
                                $skills_cmmt = $row['nskills'];
                                $skill_cmmt = explode(',', $skills_cmmt);
                                if ($skills_cmmt) {
                                    foreach ($skill_cmmt as $skill_cmmt_detail) {
                                        $skill_para = explode('|', $skill_cmmt_detail);
                                        $skill_id = $skill_para[0];
                                        $skill_lvl = $skill_para[1];
                                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $skill_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "，" . $row['jname'] ."(". "{$skill_lvl}".")";
                                    }
                                    $row_result = ltrim($row_result, "，");
                                }
                            } elseif ($attr2 == "equips_cmmt") {
                                $equips_cmmt = $row['nequips'];
                                $equip_cmmt = explode(',', $equips_cmmt);
                                if ($equips_cmmt) {
                                    foreach ($equip_cmmt as $equips_cmmt_para) {
                                        $equips_cmmt_id = explode('_',$equips_cmmt_para)[2];
                                        $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $equips_cmmt_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "，" . $row['iname'];
                                    }
                                    $row_result = ltrim($row_result, "，");
                                }
                            } else {
                                $row_result = $row[$attr3];
}

                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'npc_scene':
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_npc_scene WHERE ncid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($attr2 == "skills_cmmt") {
                                $skills_cmmt = $row['nskills'];
                                $skill_cmmt = explode(',', $skills_cmmt);
                                if ($skills_cmmt) {
                                    foreach ($skill_cmmt as $skill_cmmt_detail) {
                                        $skill_para = explode('|', $skill_cmmt_detail);
                                        $skill_id = $skill_para[0];
                                        $skill_lvl = $skill_para[1];
                                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $skill_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "，" . $row['jname'] ."(". "{$skill_lvl}".")";
                                    }
                                    $row_result = ltrim($row_result, "，");
                                }
                            } elseif ($attr2 == "equips_cmmt") {
                                $equips_cmmt = $row['nequips'];
                                $equip_cmmt = explode(',', $equips_cmmt);
                                if ($equips_cmmt) {
                                    foreach ($equip_cmmt as $equips_cmmt_para) {
                                        $equips_cmmt_id = explode('_',$equips_cmmt_para)[2];
                                        $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $equips_cmmt_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "，" . $row['iname'];
                                    }
                                    $row_result = ltrim($row_result, "，");
                                }
                            } elseif ($attr2 == "is_adopt") {
                                $row_result = $row['ncan_shouyang'];
                            }  else {
                                $row_result = $row[$attr3];
}

                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'item':
                            $attr3 = 'i'.$attr2;
                            if($attr3 =="icount"||$attr3 =="iroot"){
                                $sql = "SELECT * FROM system_item WHERE item_true_id = ? and sid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("ss", $mid,$sid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                            }elseif(strpos($attr3, 'iembed.') === 0){
                        //镶物属性相关
                        $attr4 = substr($attr3, 7); // 提取 "embed." 后面的部分
                        if(preg_match('/^(\d+\.)?(.*)/', $attr4, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $mosaic_pos = rtrim($prefix, ".");
                        
                        $attr5 = $matches[2]; // 匹配到的剩余部分
                        }
                        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$mid'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $mosaic_list = $row['equip_mosaic'];
                        $mosaic_para = explode('|',$mosaic_list);
                        if(!$mosaic_para[$mosaic_pos]){
                            $op = "\"\"";
                        }else{
                        $mosaic_id = $mosaic_para[$mosaic_pos];
                        $xid = "i".$attr5;
                        $sql = "SELECT * FROM system_item_module WHERE iid = '$mosaic_id'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $attr3 = $xid;
                        }
                        //镶物属性相关
                            }else{
                                $sql = "SHOW COLUMNS FROM system_item_module LIKE '$attr3'";
                                $result = $db->query($sql);
                                if($result->num_rows >0){
                                $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$mid' and sid = '$sid')";
                                }else{
                                $sql = "SELECT * FROM system_addition_attr WHERE sid = '$sid' and oid = 'item' and mid = '$mid' and name = '$attr3'";
                                $attr_type = 1;
                                }
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result_2 = $stmt->get_result();
                                if (!$result_2) {
                                    die('查询失败: ' . $db->error);
                                }
                                $row = $result_2->fetch_assoc();
                            }
                            
                            if($attr_type ==1){
                            $row_result = $row['value'];
                            }else{
                            $row_result = $row[$attr3];
                            }
                            if($attr3 =="iroot"){
                                $item_para = explode("|",$row_result);
                                $para_1 = $item_para[0];
                                $para_2 = $item_para[1];
                                if($para_1 ==1){
                                $sql = "SELECT nname FROM system_npc WHERE nid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $para_2);
                                $stmt->execute();
                                $result_npc = $stmt->get_result();
                                $row_npc = $result_npc->fetch_assoc();
                                $row_npc_name = $row_npc['nname'];
                                $row_result = "怪物掉落"."|".$row_npc_name;
                                }else{
                                $row_result = "未知来源";
                                }
                            }
                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'item_module':
                            $attr3 = 'i'.$attr2;
                            $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if($attr_type !=1){
                            $row_result = $row[$attr3];
                            }else{
                            $row_result = $row['value'];
                            }
                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'scene_oplayer':
                            if (strpos($attr2, "env.") === 0) {
                                $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                                switch($attr3){
                                    case 'user_count':
                                    // 构建 SQL 查询语句
                                    $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = ?)";
                                    
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $op = $row["count"];
                                    break;
                                    case 'npc_count':
                                    $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    // 处理结果
                                    $totalNpcCount = 0;
                                    while ($row = $result->fetch_assoc()) {
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
                                    $sql = "SELECT COUNT(*) as count FROM system_npc_midguaiwu WHERE nsid = '' and nmid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    // 处理结果
                                    $op = $row["count"];
                                    break;
                                    case 'item_count':
                                    $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    // 处理结果
                                    $totalItemCount = 0;
                                    while ($row = $result->fetch_assoc()) {
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
                                    $sql = "SELECT justmid FROM game1 WHERE sid = ?";
                                    
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $op = $row["justmid"];
                                    break;
                                    case 'nowmid':
                                    // 构建 SQL 查询语句
                                    $sql = "SELECT nowmid FROM game1 WHERE sid = ?";
                                    
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $op = $row["nowmid"];
                                    break;
                                    case 'name':
                                    // 构建 SQL 查询语句
                                    $sql = "SELECT mname from system_map where mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                                    
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $op = $row["mname"];
                                    $sql = "SELECT uis_sailing from game1 where sid = ?";
                                    
                                    // 使用预处理语句
                                    $stmt = $db->prepare($sql);
                                    $stmt->bind_param("s", $mid);
                                    
                                    // 执行查询
                                    $stmt->execute();
                                    
                                    // 获取查询结果
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $is_sailing = $row["uis_sailing"];
                                    if($is_sailing ==1){
                                    $op = "茫茫大海";
                                    }
                                    break;
                                }
                    }
                            else{
                            $attr3 = 'u'.$attr2;
                            $sql = "SHOW COLUMNS FROM game1 LIKE '$attr3'";
                            $result = $db->query($sql);
                            if($result->num_rows >0){
                            $sql = "SELECT * FROM game1 WHERE sid = ?";
                            }else{
                            $sql = "SELECT * FROM system_addition_attr WHERE sid = ? and name = '$attr3'";
                            $attr_type = 1;
                            }
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result_2 = $stmt->get_result();
                            if (!$result_2) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result_2->fetch_assoc();
                            if ($row == null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                                    if($attr_type !=1){
                            $op = nl2br($row[$attr3]);
                                    }else{
                            $op = nl2br($row['value']);
                                    }
                                }
                                if($op ==''){
                                    $op = "\"\"";
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            break;
                    }
                            break;
                        default:
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_npc_scene WHERE ncid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                    }
                    break;
                case 'm':
                    if($para !=1){
                    switch($type){
                    case 'fight':
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl" ||$attr3 == "jpoint" ||$attr3=="jdefault"){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ?";
                            if($oid =='skill_pet'){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = '$mid'";
                            }
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("ss", $jid,$sid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            $row_result = $row[$attr3];
                            
                        }else{
                            // 首先从 system_skill 表中查询
                            $sql = "SELECT $attr3 FROM system_skill WHERE jid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $jid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            $row_result = null; // 初始化结果
                            
                            if ($result && $result->num_rows > 0) {
                                // 如果 system_skill 表中有数据
                                $row = $result->fetch_assoc();
                                if (!empty($row[$attr3])) {
                                    $row_result = $row[$attr3]; // 获取 $attr3 字段的值
                                }
                            }
                            $exclude_attr = in_array($attr3,['jname','jid','jdesc','joccasion','jimage','jhurt_mod']);
                            // 如果 $row_result 仍然为 null，查询 system_skill_module 表
                            if ($row_result === null&&!$exclude_attr) {
                                $sql = "SELECT $attr3 FROM system_skill_module WHERE jid = 2";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            
                                if ($result && $result->num_rows > 0) {
                                    // 如果 system_skill_module 表中有数据
                                    $row = $result->fetch_assoc();
                                    if (!empty($row[$attr3])) {
                                        $row_result = $row[$attr3]; // 获取 $attr3 字段的值
                                    }
                                }
                            }
                        }
                        if ($row_result === null ||$row_result ==='') {
                            $op = "\"\""; // 或其他默认值
                            }else{
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
                        $query = "SELECT name FROM gm_game_attr WHERE value_type = 1 AND id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->bind_param("s", $row_result);  // 绑定字符串型参数
                        $stmt->execute();
                        $stmt->bind_result($op);  // 绑定结果到 $op 变量
                        $stmt->fetch();
                        // 释放查询结果
                        $stmt->free_result();
                        }
                        
                        // 替换字符串中的变量
                        //$input = str_replace("{{$match}}", $op, $input);
                        break;
                        default:
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl" ||$attr3 == "jpoint"||$attr3 =="jdefault"){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ?";
                            if($oid =='skill_pet'){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = '$mid'";
                            }
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("ss", $jid,$sid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        }else{
                            $sql = "SELECT * FROM system_skill WHERE jid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $jid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        }
                        if (!$result) {
                            die('查询失败: ' . $db->error);
                        }
                        $row = $result->fetch_assoc();
                        $row_result = $row[$attr3];
                        if ($row_result === null ||$row_result ==='') {
                            $op = "\"\""; // 或其他默认值
                            }else{
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
                        $query = "SELECT name FROM gm_game_attr WHERE value_type = 1 AND id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->bind_param("s", $row_result);  // 绑定字符串型参数
                        $stmt->execute();
                        $stmt->bind_result($op);  // 绑定结果到 $op 变量
                        $stmt->fetch();
                        // 释放查询结果
                        $stmt->free_result();
                        }
                            
                        break;
                    }
                    }elseif($para ==1){
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl"){
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $oid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $row_result = $row['nskills'];
                            $monster_skills_lvl = explode(',',$row_result);
                        }else{
                            $sql = "SELECT * FROM system_skill WHERE jid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        }
                        if (!$result) {
                            die('查询失败: ' . $db->error);
                        }
                        $row = $result->fetch_assoc();
                        $row_result = $row[$attr3];
                        if($para !=1){
                        $row_result = $row[$attr3];
                        }
                        if ($row_result === null ||$row_result ==='') {
                            $op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($row_result);
                            }
                        $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    }
                    break;
                case 'c':
                    switch($attr2){
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
                            $op = 1 *date('s');
                            break;
                        case 'online_user_count':
                            $query = "SELECT COUNT(*) FROM game1 WHERE sfzx = 1";
                        
                            // 执行查询语句并获取结果
                            $result = $db->query($query);
                        
                            // 获取行数
                            $op = $result->fetch_row()[0];
                            break;
                            default:
                            $game_id = '19980925';
                            $attr4 = 'game_';
                            $attr3 = $attr4.$attr2;
                            $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $game_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                                
                                
                        }
                    // 使用正则表达式匹配字符串中的时间格式部分
                    $pattern = '/nowtime_([UNYnjGHhist:]+)/';
                    if (preg_match($pattern, $attr2, $matches)) {
                        // 获取当前时间，并根据格式解析为具体时间信息
                        $op = date($matches[1]);
                    }
                    $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'g':
                    $sql = "SELECT gvalue FROM global_data where gid = '$attr2'";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row['gvalue']);
                        }
                    $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'e':
                    $sql = "SELECT value FROM system_exp_def WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    
                    // 替换字符串中的变量
                    $op = process_string($op,$sid,$oid,$mid,$jid,$type,$para);
                    $op = @eval("return $op;");
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'r':
                    if(!is_numeric($attr2)){
                        $attr2 = "{".$attr2."}";
                    }
                    $attr2 = process_string($attr2,$sid,$oid,$mid,$jid,$type,$para);
                    if(intval($attr2) <=0){
                    $attr2 = 1;
                    }
                    $op = rand(0, intval($attr2) - 1); // 生成随机整数
                    //$op = "\"$op\"";
                    break;
                case 'gph':
                    $attr_para = explode(".","$attr2");
                    $attr_id = $attr_para[0];
                    $attr_pos = $attr_para[1];
                    $attr_attr = $attr_para[2];
                    // 提取获取排名数据的函数
                    if (!function_exists('lexical_analysis\getRankData')){
                    function getRankData($db) {
                        $sql = "SELECT * FROM system_rank";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                        if (!$result) {
                            die('查询失败: ' . $db->error);
                        }
                    
                        $rankData = [];
                        while ($row = $result->fetch_assoc()) {
                            $rankData[] = $row;
                        }
                    
                        return $rankData;
                    }
                    }
                    
                    // 提取获取用户数据的函数
                    if (!function_exists('lexical_analysis\getUserData')){
                    function getUserData($db, $rankExp, $showCond) {
                        $sql = "SELECT uname, sid,uid FROM game1";
                        $cxjg = $db->query($sql);
                    
                        if (!$cxjg) {
                            die('查询失败: ' . $db->error);
                        }
                    
                        $userData = [];
                        while ($row = $cxjg->fetch_assoc()) {
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
                            function getRankData2($db, $rank_name) {
                                $sql = "SELECT * FROM system_rank where rank_name = '$rank_name'";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            
                                if (!$result) {
                                    die('查询失败: ' . $db->error);
                                }
                            
                                $rankData = [];
                                while ($row = $result->fetch_assoc()) {
                                    $rankData[] = $row;
                                }
                            
                                return $rankData;
                            }
                        }
                    
                        // 提取获取用户数据的函数
                        if (!function_exists('lexical_analysis\getUserData2')) {
                            function getUserData2($db, $rankExp, $showCond) {
                                $sql = "SELECT uname, sid, uid FROM game1";
                                $cxjg = $db->query($sql);
                            
                                if (!$cxjg) {
                                    die('查询失败: ' . $db->error);
                                }
                            
                                $userData = [];
                                while ($row = $cxjg->fetch_assoc()) {
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
    $db = DB::conn();

    $matches = [];
    if($input){
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
                    $op = "\"\"";
                }
                $op = str_replace(array("''", "\"\""), '0', $op);
                //  var_dump($match);
                //  var_dump($op);
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
                
            }
        }
    }
    }
    $matches_2 = [];
    //preg_match_all('/f\(([\w.]+)\)/', $input, $matches_2);
    if($input){
    preg_match_all('/\{f\((.*?)\).*?\}/', $input, $matches_2);
    if (!empty($matches_2[1])) {
        $f_temp = $matches_2[0][0];
        foreach ($matches_2[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1,$attr2,$sid, $oid, $mid,$jid,$type,$db,$para);
                if($op =='' || $op == "" || $op ==null){
                    $op = "\"\"";
                }
                // var_dump($op);
                // 替换字符串中的变量
                switch ($op[0]) {
                    case 's':
                        $remain = substr($op, 1);
                        $sql = "SELECT mid FROM system_map where mid = '$remain'";
                        $cxjg = $db->query($sql);
                        if (!$cxjg) {
                        die('查询失败: ' . $db->error);
                        }
                        $row = $cxjg->fetch_assoc();
                        $temp_mid = $row['mid'];
                        $op = str_replace(array("'", "\"\""), '0', $op);
                        $op = str_replace("f({$match})", "o", $f_temp);
                        if($temp_mid){
                        $f_input = process_string($op, $sid, 'scene', $temp_mid, $jid, $type, $para);
                        }
                        $input = str_replace($f_temp, $f_input, $input);
                        break;
                    case 'i':
                        $remain = substr($op, 1);
                        $sql = "SELECT iid FROM system_item_module where iid = '$remain'";
                        $cxjg = $db->query($sql);
                        if (!$cxjg) {
                        die('查询失败: ' . $db->error);
                        }
                        $row = $cxjg->fetch_assoc();
                        $temp_iid = $row['iid'];
                        $op = str_replace(array("'", "\"\""), '0', $op);
                        $op = str_replace("f({$match})", "o", $f_temp);
                        if($temp_iid){
                        $f_input = process_string($op, $sid, 'item_module', $temp_iid, $jid, $type, $para);
                        }
                        $input = str_replace($f_temp, $f_input, $input);
                        break;
                    case 'n':
                        $remain = substr($op, 1);
                        $sql = "SELECT nid FROM system_npc where nid = '$remain'";
                        $cxjg = $db->query($sql);
                        if (!$cxjg) {
                        die('查询失败: ' . $db->error);
                        }
                        $row = $cxjg->fetch_assoc();
                        $temp_nid = $row['nid'];
                        $op = str_replace(array("'", "\"\""), '0', $op);
                        $op = str_replace("f({$match})", "o", $f_temp);
                        if($temp_nid){
                        $f_input = process_string($op, $sid, 'npc', $temp_nid, $jid, $type, $para);
                        }
                        $input = str_replace($f_temp, $f_input, $input);
                        break;
                        break;
                    default:
                        $sql = "SELECT sid FROM game1 where uid = '$op'";
                        $cxjg = $db->query($sql);
                        if (!$cxjg) {
                        die('查询失败: ' . $db->error);
                        }
                        $row = $cxjg->fetch_assoc();
                        $temp_sid = $row['sid'];
                        $op = str_replace(array("'", "\"\""), '0', $op);
                        $op = str_replace("f({$match})", "u", $f_temp);
                        if($temp_sid){
                        $f_input = process_string($op, $temp_sid, $oid, $mid, $jid, $type, $para);
                        }
                        $input = str_replace($f_temp, $f_input, $input);
                        break;
                }
            }
        }
    }
}
    // 进行其他逻辑处理
    // ...
    
    $matches_3 = [];
    if($input){
    preg_match_all('/stru\(([\w.]+)\)/', $input, $matches_3);
    if (!empty($matches_3[1])) {
        foreach ($matches_3[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1,$attr2,$sid, $oid, $mid,$jid,$type,$db,$para);
                if(is_numeric($op)){
                    $op = convertNumber($op);
                }
                if($op =='' || $op == "" || $op ==null){
                    $op = "\"\"";
                }
                $op = str_replace(array("''", "\"\""), '0', $op);

                $input = str_replace("{stru({$match})}", $op, $input);
            }
        }
    }
}
if($input){
$input = evaluate_expression($input,$db,$sid,$oid,$mid,$jid,$type,$para);
}
// 使用 preg_replace_callback 进行匹配和替换
if($input){
$input = preg_replace_callback('/#"(.*?)"/', function ($matches) use ($sid, $oid, $mid, $jid, $type, $db, $para) {
    // 获取原内容
    //var_dump($matches);
   $op = str_replace(array("'"), '', $matches[1]);
   $op = "'".$op."'";
   return $op;
}, $input);
}
    return $input;
}

function convertNumber($op) {
    // 转换成整数以避免浮点数问题
    $op = intval($op);
    
    // 计算亿和万的部分
    $yi = floor($op / 100000000); // 亿
    $wan = floor(($op % 100000000) / 10000); // 万
    $ge = $op % 10000; // 个位

    // 构建结果字符串
    $result = '';
    if ($yi > 0) {
        $result .= $yi . '亿';
    }
    if ($wan > 0) {
        $result .= $wan . '万';
    }
    if ($ge > 0) {
        $result .= $ge;
    }

    return $result;
}



//上为主对被，下为被对主。

function evaluate_expression_2($expr, $db, $gid,$oid,$mid,$jid,$type,$para=null){
$expr = preg_replace_callback('/\{eval\(([^)]+)\)\}/', function($matches) use ($db, $gid,$oid,$mid,$jid,$type,$para) {
    $eval_expr = $matches[1]; // 获取 eval 中的表达式
    $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
    return $eval_result; // 返回计算结果
}, $expr);
//var_dump($expr);
$expr = preg_replace_callback('/\{([^}]+)\}/', function($matches) use ($db, $gid,$oid,$mid,$jid,$type,$para) {
    $attr = $matches[1]; // 获取匹配到的变量名
            $firstDotPosition = strpos($attr, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($attr, 0, $firstDotPosition);
                $attr2 = substr($attr, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute_2($attr1,$attr2,$gid, $oid, $mid,$jid,$type,$db,$para);
                // 替换字符串中的变量
            }
        
    // 在这里根据变量名获取对应的值，例如从数据库中查询
    // 假设你从数据库中获取了 $attr_value
    
    $temp = $op;
    if (strpos($temp, '"') === false){
    $op = "\"".$temp."\"";
    }
    $op = str_replace(array("''", "\"\""), '0', $op);
    // 使用正则表达式，去掉内部的单引号
    $op = preg_replace("/'(.*?)'/", '$1', $op);
    $op = str_replace(array("\""), '\'', $op);
    return $op;
}, $expr);
//var_dump($expr);
// 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
$result = $expr;
try{

//$result = eval("return $expr;");
}catch (ParseError $e){
                print("语法错误: ". $e->getMessage());
                
            }
            catch (Error $e){
                print("执行错误: ". $e->getMessage());
}
return $result;
}

function process_attribute_2($attr1, $attr2,$gid, $oid, $mid,$jid,$type,$db,$para=null) {
            switch ($attr1) {
                case 'u':
                    if (strpos($attr2, "env.") === 0) {
                    $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                    switch($attr3){
                        case 'user_count':
                        // 构建 SQL 查询语句
                        $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = ?)";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $gid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["count"];
                        break;
                        case 'npc_count':
                        $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $gid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        // 处理结果
                        $totalNpcCount = 0;
                        while ($row = $result->fetch_assoc()) {
                            $mnpc = $row["mnpc_now"];
                            $npcs = explode(",", $mnpc); // 拆分成每个npc项
                            foreach ($npcs as $npc) {
                                $npc_show_cond = urldecode(explode("|", $npc)[2]);
                                //$show_cond = checkTriggerCondition($npc_show_cond,$dblj,$gid,$oid,$mid);
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
                        $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $gid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        // 处理结果
                        $totalItemCount = 0;
                        while ($row = $result->fetch_assoc()) {
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
                    }
                    elseif(strpos($attr2, "equips.") === 0){
                    $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
                    if (strpos($attr3, 'b.') === 0) {
                        $attr3 = substr($attr3, 2); // 提取 "b." 后面的部分
                        $bid = $attr3;
                        $sql = "SELECT nequips FROM system_npc_midguaiwu WHERE ngid = ?";

                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$gid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                        $row = $result->fetch_assoc();
                        $op = $row["nequips"];
                        $pattern = '/兵器_\d+_(\d+)/';
                        
                        preg_match_all($pattern, $op, $matches);
                        
                        if (!empty($matches[1])) {
                            // 获取最后一个匹配的数值
                            $equip_bid = end($matches[1]);
                        }
                        if(!$equip_bid){
                            $op = "\"\"";
                        }else{
                        $bid = "i".$bid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = '$equip_bid'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($attr3 =="count"){
                            $op = $op?1:0;
                        }else{
                            $op = nl2br($row[$bid]);
                        if ($row === null||$row =='') {
                        $op = "\"\""; // 或其他默认值
                        }
                        }
                        }
                        $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    }
                    elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $equiped_pos = rtrim($prefix, ".");
                        $attr4 = $matches[2]; // 匹配到的剩余部分
                        // SQL 查询语句
                        $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";
                        
                        // 执行查询并检查是否有结果
                        $result = $db->query($sql);
                        
                        if ($result->num_rows > 0) {
                            // 初始化数组
                            $idArray = array();
                        
                            // 将查询结果存入数组
                            while ($row = $result->fetch_assoc()) {
                                $idArray[] = $row["id"];
                            }
                        }
                        $equiped_pos = $idArray[$equiped_pos];

                        $fid = $attr4;
                        $sql = "SELECT nequips FROM system_npc_midguaiwu WHERE ngid = ?";

                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$gid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                        $row = $result->fetch_assoc();

                        $op = $row["nequips"];
                        $pattern = '/防具_' . preg_quote($equiped_pos) . '_(\d+)/';
                        
                        preg_match_all($pattern, $op, $matches);
                        
                        if (!empty($matches[1])) {
                            // 获取第一个匹配的数值
                            $equip_xid = end($matches[1]);
                        }
                        if(!$equip_xid){
                            $op = "\"\"";
                        }else{
                        $fid = "i".$fid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = '$equip_xid'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($attr4 =="count"){
                            $op = $op?1:0;
                        }else{
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$fid]);
                        }
                        }
                        
                        }
                        $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    }
                    }
                    elseif(strpos($attr2, "refresh_time") === 0){
                    $sql = "SELECT mgtime,mrefresh_time FROM system_map WHERE mid = (SELECT nmid FROM system_npc_midguaiwu WHERE ngid = ?)";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $gid);
                    
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $nowdate = date('Y-m-d H:i:s');
                    $mid_time = $row["mgtime"];
                    $mid_refresh_time = $row['mrefresh_time'];
                    $op= $mid_refresh_time - floor((strtotime($nowdate)-strtotime($mid_time))/60);//获取刷新分钟剩余
                    }else{
                    $attr3 = "n".$attr2;
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $gid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null||$row =='') {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    }
                    break;
                case 'ut':
                    switch($attr2){
                        case 'cut_hp':
                        // 构建 SQL 查询语句
                        $sql = "SELECT SUM(hurt_hp) as total_hurt_hp FROM game2 WHERE gid = ?";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("i", $gid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["total_hurt_hp"];
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        break;
                        case 'fight_umsg':
                        $sql = "SELECT * FROM game2 WHERE gid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $gid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["fight_omsg"];
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        break;
                        case 'fight_omsg':
                        $sql = "SELECT * FROM game2 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $gid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["fight_umsg"];
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        break;
                    }
                    break;
                case 'ot':
                    switch($attr2){
                        case 'cut_hp':
                        // 构建 SQL 查询语句
                        
                        if($oid=="monstertouser"){
                        
                        $sql = "SELECT * FROM game2 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        
                        // 执行查询
                        $stmt->execute();
                        }else{
                        $sql = "SELECT * FROM game2 WHERE pid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        
                        // 执行查询
                        $stmt->execute();
                        }
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["cut_hp"];
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        break;
                    }
                    break;
                case 'o':
                    switch($oid){
                        case 'scene':
                            $attr3 = 'm'.$attr2;
                            $sql = "SELECT * FROM system_map WHERE mid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'npc':
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $gid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            
                            if ($attr2 == "skills_cmmt") {
                                $skills_cmmt = $row['nskills'];
                                $skill_cmmt = explode(',', $skills_cmmt);
                                if ($skills_cmmt) {
                                    foreach ($skill_cmmt as $skill_cmmt_detail) {
                                        $skill_para = explode('|', $skill_cmmt_detail);
                                        $skill_id = $skill_para[0];
                                        $skill_lvl = $skill_para[1];
                                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $skill_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "," . $row['jname'] . "({$skill_lvl})";
                                    }
                                    $row_result = ltrim($row_result, ",");
                                }
                            } elseif ($attr2 == "equips_cmmt") {
                                $equips_cmmt = $row['nequips'];
                                $equip_cmmt = explode(',', $equips_cmmt);
                                if ($equips_cmmt) {
                                    foreach ($equip_cmmt as $equips_cmmt_id) {
                                        $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $equips_cmmt_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "," . $row['iname'];
                                    }
                                    $row_result = ltrim($row_result, ",");
                                }
                            } else {
                                $row_result = $row[$attr3];
}


                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                                
                                
                            $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'item':
                            $attr3 = 'i'.$attr2;
                            if($attr3 =="icount"){
                                $sql = "SELECT * FROM system_item WHERE item_true_id = ? and sid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("ss", $mid,$sid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }else{
                                $sql = "SELECT * FROM system_item_module WHERE iid = ( SELECT iid from system_item where item_true_id = ? and sid = ?)";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("ss", $mid,$sid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            $row_result = $row[$attr3];
                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'scene_oplayer':
                            $attr3 = 'u'.$attr2;
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
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_2($op,$sid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'monstertouser':
                            $attr3 = 'u'.$attr2;
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
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'monstertopet':
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_pet_scene WHERE npid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        default:
                            $attr3 = 'u'.$attr2;
                            // 检查字段是否存在
                            $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$attr3'");
                            $result_2 = $db->query("SELECT value from system_addition_attr where name = '$attr3' and sid = '$mid'");
                            // 如果字段存在，则更新字段值
                            if ($result->num_rows > 0 ) {
                                            $sql = "SELECT * FROM game1 WHERE sid = ?";
                                            $stmt = $db->prepare($sql);
                                            $stmt->bind_param("s",$mid);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if (!$result) {
                                                die('查询失败: ' . $db->error);
                                            }
                                            $row = $result->fetch_assoc();
                            } elseif($result_2->num_rows > 0){
                                            $sql = "SELECT value FROM system_addition_attr WHERE sid = ? and name = ?";
                                            $stmt = $db->prepare($sql);
                                            $stmt->bind_param("ss",$mid,$attr3);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if (!$result) {
                                                die('查询失败: ' . $db->error);
                                            }
                                            $row = $result->fetch_assoc();
                                            $attr3 = "value";
                            }
                            
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                    }
                    break;
                case 'm':
                    $monster_skills_lvls="";
                    $attr3 = 'j'.$attr2;
                    if($attr3 =="jlvl"){
                        $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $gid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $row_result = $row['nskills'];
                        $monster_skills_lvls = explode(',',$row_result);
                        foreach($monster_skills_lvls as $monster_skills_lvl){
                            $monster_skills_detail = explode('|',$monster_skills_lvl);
                            if($jid == $monster_skills_detail[0]){
                                $op = $monster_skills_detail[1];
                                $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                                break;
                            }
                        }
                    }else{
                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $jid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $row_result = $row[$attr3];
                    if ($row_result === null ||$row_result ==='') {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row_result);
                        }
                    $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    }
                    break;
                case 'c':
                    switch($attr2){
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
                            $op = 1 *date('s');
                            break;
                        case 'online_user_count':
                            
                            break;
                            default:
                            $game_id = '19980925';
                            $attr4 = 'game_';
                            $attr3 = $attr4.$attr2;
                            $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $game_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                                
                                
                        }
                    // 使用正则表达式匹配字符串中的时间格式部分
                    $pattern = '/nowtime_([UNYnjGHhist:]+)/';
                    if (preg_match($pattern, $attr2, $matches)) {
                        // 获取当前时间，并根据格式解析为具体时间信息
                        $op = date($matches[1]);
                    }
                    $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'g':
                    $sql = "SELECT * FROM global_data WHERE gid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row['value']);
                        }
                    $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'e':
                    $sql = "SELECT * FROM system_exp_def WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    // 替换字符串中的变量
                    $op = process_string_2($op,$gid,$oid,$mid,$jid,$type,$para);
                    $op = @eval("return $op;");
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'r':
                    if(!is_numeric($attr2)){
                        $attr2 = "{".$attr2."}";
                    }
                    $attr2 = process_string_2($attr2,$gid,$oid,$mid,$jid,$type,$para);

                    $op = rand(1,(int)$attr2)-1;
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
function process_string_2($input, $gid, $oid = null, $mid = null, $jid = null, $type = null, $para = null) {
    $db = DB::conn();
    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);

    if (!empty($matches[1])) {
        foreach ($matches[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute_2($attr1,$attr2,$gid, $oid, $mid,$jid,$type,$db,$para);
                if($op =='' || $op == "" || $op ==null){
                    $op = "\"\"";
                }
                $op = str_replace(array("'", "\"\""), '0', $op);
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
            }
        }
    }

    // 进行其他逻辑处理
    // ...
$input = evaluate_expression_2($input,$db,$gid,$oid,$mid,$jid,$type,$para);
    return $input;
}

//上为被对主，下为宠对被。

function evaluate_expression_3($expr, $db, $pid,$oid,$mid,$jid,$type,$para=null){
$expr = preg_replace_callback('/\{eval\(([^)]+)\)\}/', function($matches) use ($db, $pid,$oid,$mid,$jid,$type,$para) {
    $eval_expr = $matches[1]; // 获取 eval 中的表达式
    $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
    return $eval_result; // 返回计算结果
}, $expr);
//var_dump($expr);
$expr = preg_replace_callback('/\{([^}]+)\}/', function($matches) use ($db, $pid,$oid,$mid,$jid,$type,$para) {
    $attr = $matches[1]; // 获取匹配到的变量名
            $firstDotPosition = strpos($attr, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($attr, 0, $firstDotPosition);
                $attr2 = substr($attr, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute_3($attr1,$attr2,$pid, $oid, $mid,$jid,$type,$db,$para);
                // 替换字符串中的变量
            }
        
    // 在这里根据变量名获取对应的值，例如从数据库中查询
    // 假设你从数据库中获取了 $attr_value
    
    $temp = $op;
    if (strpos($temp, '"') === false){
    $op = "\"".$temp."\"";
    }
    $op = str_replace(array("''", "\"\""), '0', $op);
    // 使用正则表达式，去掉内部的单引号
    $op = preg_replace("/'(.*?)'/", '$1', $op);
    $op = str_replace(array("\""), '\'', $op);
    return $op;
}, $expr);
//var_dump($expr);
// 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
$result = $expr;
try{

//$result = eval("return $expr;");
}catch (ParseError $e){
                print("语法错误: ". $e->getMessage());
                
            }
            catch (Error $e){
                print("执行错误: ". $e->getMessage());
}
return $result;
}

function process_attribute_3($attr1, $attr2,$pid, $oid, $mid,$jid,$type,$db,$para=null) {
            switch ($attr1) {
                case 'u':
                    if (strpos($attr2, "env.") === 0) {
                    $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                    switch($attr3){
                        case 'user_count':
                        // 构建 SQL 查询语句
                        $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nmid FROM system_pet_scene WHERE npid = ?)";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $pid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["count"];
                        break;
                        case 'npc_count':
                        $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nmid FROM system_pet_scene WHERE npid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $pid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        // 处理结果
                        $totalNpcCount = 0;
                        while ($row = $result->fetch_assoc()) {
                            $mnpc = $row["mnpc_now"];
                            $npcs = explode(",", $mnpc); // 拆分成每个npc项
                            foreach ($npcs as $npc) {
                                $npc_show_cond = urldecode(explode("|", $npc)[2]);
                                $show_cond = checkTriggerCondition($npc_show_cond,$dblj,$sid);
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
                        $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nmid FROM system_pet_scene WHERE npid = ?)";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $pid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        // 处理结果
                        $totalItemCount = 0;
                        while ($row = $result->fetch_assoc()) {
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
                    }
                    elseif(strpos($attr2, "equips.") === 0){
                    $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
                    if (strpos($attr3, 'b.') === 0) {
                        $attr3 = substr($attr3, 2); // 提取 "b." 后面的部分
                        $bid = $attr3;
                        $sql = "SELECT nequips FROM system_pet_scene WHERE npid = ?";

                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$pid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                        $row = $result->fetch_assoc();

                        $op = $row["nequips"];
                        $pattern = '/兵器_\d+_(\d+)/';
                        
                        preg_match_all($pattern, $op, $matches);
                        
                        if (!empty($matches[1])) {
                            // 获取最后一个匹配的数值
                            $equip_bid = end($matches[1]);
                        }
                        if(!$equip_bid){
                            $op = "\"\"";
                        }else{
                        $bid = "i".$bid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = $equip_bid";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($attr3 =="count"){
                            $op = $op?1:0;
                        }else{
                            $op = nl2br($row[$bid]);
                        if ($row === null||$row =='') {
                        $op = "\"\""; // 或其他默认值
                        }
                        }
                        }
                        $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    }
                    elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
                        $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                        $equiped_pos = rtrim($prefix, ".");
                        $attr4 = $matches[2]; // 匹配到的剩余部分
                        // SQL 查询语句
                        $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";
                        
                        // 执行查询并检查是否有结果
                        $result = $db->query($sql);
                        
                        if ($result->num_rows > 0) {
                            // 初始化数组
                            $idArray = array();
                        
                            // 将查询结果存入数组
                            while ($row = $result->fetch_assoc()) {
                                $idArray[] = $row["id"];
                            }
                        }
                        $equiped_pos = $idArray[$equiped_pos];

                        $fid = $attr4;
                        $sql = "SELECT nequips FROM system_pet_scene WHERE npid = ?";

                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s",$pid);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                        $row = $result->fetch_assoc();

                        $op = $row["nequips"];
                        $pattern = '/防具_' . preg_quote($equiped_pos) . '_(\d+)/';
                        
                        preg_match_all($pattern, $op, $matches);
                        
                        if (!empty($matches[1])) {
                            // 获取第一个匹配的数值
                            $equip_xid = end($matches[1]);
                        }
                        if(!$equip_xid){
                            $op = "\"\"";
                        }else{
                        $fid = "i".$fid;
                        $sql = "SELECT * FROM system_item_module WHERE iid = '$equip_xid'";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($attr4 =="count"){
                            $op = $op?1:0;
                        }else{
                        if ($row === null||$row =='') {
                            $op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$fid]);
                        }
                        }
                        
                        }
                        $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    }
                    }
                    elseif(strpos($attr2, "refresh_time") === 0){
                    $sql = "SELECT mgtime,mrefresh_time FROM system_map WHERE mid = (SELECT nmid FROM system_pet_scene WHERE npid = ?)";
                    
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $pid);
                    
                    // 执行查询
                    $stmt->execute();
                    
                    // 获取查询结果
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $nowdate = date('Y-m-d H:i:s');
                    $mid_time = $row["mgtime"];
                    $mid_refresh_time = $row['mrefresh_time'];
                    $op= $mid_refresh_time - floor((strtotime($nowdate)-strtotime($mid_time))/60);//获取刷新分钟剩余
                    }else{
                    $attr3 = "n".$attr2;
                    $sql = "SELECT * FROM system_pet_scene WHERE npid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $pid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null||$row =='') {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    }
                    break;
                case 'ot':
                    switch($attr2){
                        case 'cut_hp':
                        // 构建 SQL 查询语句
                        $sql = "SELECT * FROM game2 WHERE pid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $pid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["hurt_hp"];
                        if ($op === null||$op =='') {
                            $op = "\"\""; // 或其他默认值
                            }
                        break;
                    }
                    break;
                case 'o':
                    switch($oid){
                        case 'scene':
                            $attr3 = 'm'.$attr2;
                            $sql = "SELECT * FROM system_map WHERE mid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'pet_fight':
                            $attr3 = 'n'.$attr2;
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            
                            if ($attr2 == "skills_cmmt") {
                                $skills_cmmt = $row['nskills'];
                                $skill_cmmt = explode(',', $skills_cmmt);
                                if ($skills_cmmt) {
                                    foreach ($skill_cmmt as $skill_cmmt_detail) {
                                        $skill_para = explode('|', $skill_cmmt_detail);
                                        $skill_id = $skill_para[0];
                                        $skill_lvl = $skill_para[1];
                                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $skill_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "," . $row['jname'] . "({$skill_lvl})";
                                    }
                                    $row_result = ltrim($row_result, ",");
                                }
                            } elseif ($attr2 == "equips_cmmt") {
                                $equips_cmmt = $row['nequips'];
                                $equip_cmmt = explode(',', $equips_cmmt);
                                if ($equips_cmmt) {
                                    foreach ($equip_cmmt as $equips_cmmt_id) {
                                        $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                        $stmt = $db->prepare($sql);
                                        $stmt->bind_param("s", $equips_cmmt_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $row_result .= "," . $row['iname'];
                                    }
                                    $row_result = ltrim($row_result, ",");
                                }
                            } else {
                                $row_result = $row[$attr3];
}


                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                                
                                
                            $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'item':
                            $attr3 = 'i'.$attr2;
                            
                            $sql = "SELECT * FROM system_item_module WHERE iid = ( SELECT iid from system_item where item_true_id = ? and sid = ?)";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("ss", $mid,$pid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            $row_result = $row[$attr3];
                            if ($row_result === null ||$row_result ==='') {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                        default:
                            $attr3 = 'n'.$attr2;
                            
                            
                            // 检查字段是否存在
                            $result = $db->query("SHOW COLUMNS FROM system_npc_midguaiwu LIKE '$attr3'");
                            $result_2 = $db->query("SELECT value from system_addition_attr where name = '$attr3' and oid = '$mid'");
                            // 如果字段存在，则更新字段值
                            if ($result->num_rows > 0 ) {
                                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                                            $stmt = $db->prepare($sql);
                                            $stmt->bind_param("s",$mid);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if (!$result) {
                                                die('查询失败: ' . $db->error);
                                            }
                                            $row = $result->fetch_assoc();
                            } elseif($result_2->num_rows > 0){
                                            $sql = "SELECT value FROM system_addition_attr WHERE oid = ? and name = ?";
                                            $stmt = $db->prepare($sql);
                                            $stmt->bind_param("ss",$mid,$attr3);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if (!$result) {
                                                die('查询失败: ' . $db->error);
                                            }
                                            $row = $result->fetch_assoc();
                                            $attr3 = "value";
                            }
                            
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                    }
                    break;
                case 'm':
                    $monster_skills_lvls="";
                    $attr3 = 'j'.$attr2;
                    if($attr3 =="jlvl"){
                        $sql = "SELECT * FROM system_pet_scene WHERE npid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $pid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $row_result = $row['nskills'];
                        $monster_skills_lvls = explode(',',$row_result);
                        foreach($monster_skills_lvls as $monster_skills_lvl){
                            $monster_skills_detail = explode('|',$monster_skills_lvl);
                            if($jid == $monster_skills_detail[0]){
                                $op = $monster_skills_detail[1];
                                $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                                break;
                            }
                        }
                    }else{
                        $sql = "SELECT * FROM system_skill WHERE jid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $jid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $row_result = $row[$attr3];
                    if ($row_result === null ||$row_result ==='') {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row_result);
                        }
                    $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    }
                    break;
                case 'c':
                    switch($attr2){
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
                            $op = 1 *date('s');
                            break;
                        case 'online_user_count':
                            
                            break;
                            default:
                            $game_id = '19980925';
                            $attr4 = 'game_';
                            $attr3 = $attr4.$attr2;
                            $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $game_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                                
                                
                        }
                    // 使用正则表达式匹配字符串中的时间格式部分
                    $pattern = '/nowtime_([UNYnjGHhist:]+)/';
                    if (preg_match($pattern, $attr2, $matches)) {
                        // 获取当前时间，并根据格式解析为具体时间信息
                        $op = date($matches[1]);
                    }
                    $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'g':
                    $sql = "SELECT * FROM global_data WHERE gid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row['value']);
                        }
                    $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'e':
                    $sql = "SELECT * FROM system_exp_def WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    // 替换字符串中的变量
                    $op = process_string_3($op,$pid,$oid,$mid,$jid,$type,$para);
                    $op = @eval("return $op;");
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'r':
                    if(!is_numeric($attr2)){
                        $attr2 = "{".$attr2."}";
                    }
                    $attr2 = process_string_3($attr2,$pid,$oid,$mid,$jid,$type,$para);

                    $op = rand(1,(int)$attr2)-1;
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
function process_string_3($input, $pid, $oid = null, $mid = null, $jid = null, $type = null, $para = null) {
    $db = DB::conn();
    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);
    if (!empty($matches[1])) {
        foreach ($matches[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute_3($attr1,$attr2,$pid, $oid, $mid,$jid,$type,$db,$para);
                if($op =='' || $op == "" || $op ==null){
                    $op = "\"\"";
                }
                $op = str_replace(array("'", "\"\""), '0', $op);
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
            }
        }
    }

    // 进行其他逻辑处理
    // ...
$input = evaluate_expression_3($input,$db,$pid,$oid,$mid,$jid,$type,$para);
    return $input;
}



function color_string($input) {
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

function generate_image_link($hashtag) {
    // 生成图片链接的逻辑
    // 创建数据库连接
    $para = explode("|",$hashtag);
    $para_1 = $para[0];
    $para_2 = $para[1];
    $db = DB::conn();
    
    $sql = "SELECT photo_url from system_photo where id = '$para_2' and type = '$para_1'";
    $result = $db ->query($sql);
    $row = $result->fetch_assoc();
    $photo_url = $row['photo_url'];
    $imageLink = urlencode($photo_url);
    return $imageLink;
}

function generate_image_style($hashtag){
    // 生成图片样式的逻辑
    // 创建数据库连接
    $para = explode("|",$hashtag);
    $para_1 = $para[0];
    $para_2 = $para[1];
    $db = DB::conn();
    
    $sql = "SELECT photo_style from system_photo where id = '$para_2' and type = '$para_1'";
    $result = $db ->query($sql);
    $row = $result->fetch_assoc();
    $imageStyle = $row['photo_style'];
    return $imageStyle;
}

function process_photoshow($input) {
    $input = str_replace(array("'", "\""), '', $input);
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