<?php
// require_once 'class/player.php';
// require_once 'class/encode.php';
// require_once 'class/gm.php';
// include_once 'pdo.php';

// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';
include_once 'class/events_steps_change.php';
//include_once 'class/global_event_step_change.php';

$parents_page = $currentFilePath;
$parents_cmd = 'gm_scene_new';
$player = \player\getplayer($sid,$dblj);
$pet = \player\getpet_fight($sid,$dblj,'alive');//活着的宠物
$clmid = player\getmid($player->nowmid,$dblj);
$fight_arr = player\getfightpara($sid,$dblj);
$can_redis = $GLOBALS['can_redis'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if(!$be_feat){
    $round = \player\getnowround($sid,$dblj);
    $next_round = $round + 1;
    $fight_final_arr = [
        'player' => [$sid => $player->uspeed],
        'pet' => [],
        'monster' => []
    ];

if($round ==0&&$cmd =='pve_fight'){
    \player\update_fight_msg($sid,'0','0',0,1,$dblj);
}


    // 优化宠物处理
    if($pet) {
        $npid_arr = [];
        foreach($pet as $p) {
            $fight_final_arr['pet'][$p['npid']] = $p['nspeed'];
            $npid_arr[] = $p['npid'];
            if($round ==0&&$cmd =='pve_fight'){
                \player\update_fight_msg($sid,$p['npid'],'0',0,2,$dblj);
            }
        }
        $npid = implode(',', $npid_arr);
    }

    // 优化怪物处理 
    if($fight_arr) {
        $ngid_arr = [];
        foreach($fight_arr as $m) {
            $fight_final_arr['monster'][$m['ngid']] = $m['nspeed'];
            $ngid_arr[] = $m['ngid'];
            if($round ==0&&$cmd =='pve_fight'){
                \player\update_fight_msg($sid,'0',$m['ngid'],0,3,$dblj);
            }
        }
        $ngid = implode(',', $ngid_arr);
    }

    // 3. 优化掉落物品处理
    $item_drops = [];
    $total_exp = 0;
    $total_money = 0;

    //此变量用于获取你所战斗的仍然活着的怪物基本属性
    $fight_arr_count = @count($fight_arr);
    if($fight_arr_count){
    $ngid = "";
    for($i=0;$i<$fight_arr_count;$i++){
        $fight_gid = $fight_arr[$i]['ngid'];
        $fight_speed = $fight_arr[$i]['nspeed'];
        $fight_final_arr['monster'][$fight_gid] = $fight_speed;
        $ngid .=$fight_gid.",";
    }
    $ngid = rtrim($ngid,',');
    }
    //$scene_npc = explode(',',$clmid ->mnpc_now);
    $huode = '';
    $rwts = '';
    $game_main = '';

    $get_main_page = \gm\get_pve_page($dblj);
    $br = 0;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;

    if($cmd=='pve_fight'){
        //如果玩家的血量小于等于0，则直接返回战斗结果
        if ($player->uhp <=0){
            $zdjg = -1;
        }
    }elseif ($cmd == 'pve_fighting'){
        //技能攻击

        // 将多维数组扁平化到一个数组中，每个元素包含 type、id 和 speed（转换为整数）
        $flattened = array();
        foreach ($fight_final_arr as $type => $items) {
            foreach ($items as $id => $speed) {
                $flattened[] = array(
                    'type'  => $type,
                    'id'    => $id,
                    'speed' => (int)$speed
                );
            }
        }
        // 根据 speed 从大到小排序，如果 speed 相等，则随机返回 1 或 -1
        usort($flattened, function($a, $b) {
            if ($a['speed'] == $b['speed']) {
                return mt_rand(0, 1) ? 1 : -1;
            }
            return ($a['speed'] > $b['speed']) ? -1 : 1;
        });

        if($qtype ==1){
        
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;

    // 遍历排序后的数组，执行对应逻辑
    foreach ($flattened as $item) {
        //刷新战场表，移除死亡对象，考虑用redis记录
        
        // 例如，根据角色类型执行不同的伤害计算逻辑
        if ($item['type'] == 'player') {
            // 处理玩家的逻辑
            $busy = \player\get_temp_attr($sid,'busy',1,$dblj);
            if($busy >0){
            $dblj->exec("update game2 set hurt_hp = '' where sid = '$sid'");
            \player\update_temp_attr($sid,'busy',1,$dblj,2,-1);
            echo "你不能动弹！预计还要{$busy}回合！<br/>";
            }else{
            \lexical_analysis\hurt_calc($sid,$ngid,1,$dblj,$next_round,$qtype_id,null);//你对怪的伤害
        }
            $test_text .= "玩家（ID: {$item['id']}）出手，速度：{$item['speed']}<br/>";
        } elseif ($item['type'] == 'monster') {
            \lexical_analysis\hurt_calc($sid,$item['id'],2,$dblj,$next_round,null,$npid);//怪对你的伤害,单体判别
            $test_text .= "怪物（ID: {$item['id']}）出手，速度：{$item['speed']}<br/>";
        } elseif ($item['type'] == 'pet') {
            \lexical_analysis\hurt_calc($sid,$ngid,3,$dblj,$next_round,null,$item['id']);//宠对怪的伤害
            $test_text .= "宠物（ID: {$item['id']}）出手，速度：{$item['speed']}<br/>";
        }
    }

    if($player->uis_designer==1){
        echo $test_text;
    }

        }elseif($qtype ==2){
        
        
    // 遍历排序后的数组，执行对应逻辑
    foreach ($flattened as $item) {
        // 例如，根据角色类型执行不同的伤害计算逻辑
        if ($item['type'] == 'player') {
            // 处理玩家的逻辑
            $busy = \player\get_temp_attr($sid,'busy',1,$dblj);
            if($busy >0){
            $dblj->exec("update game2 set hurt_hp = '' where sid = '$sid'");
            $busy = \player\update_temp_attr($sid,'busy',1,$dblj,2,-1);
            echo "你不能动弹！预计还要{$busy}回合！<br/>";
            }else{
            $sql = "select iuse_value,iuse_attr,iname,iweight from system_item_module where iid = '$qtype_id'";
            $cxjg = $dblj->query($sql);
            if ($cxjg){
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $use_item_name = $ret['iname'];
            $use_item_iweight = $ret['iweight'];
            $use_attr = $ret['iuse_attr'];
            $use_value = (int)$ret['iuse_value'];
            $use_item_name = \lexical_analysis\color_string($use_item_name);
            echo "使用了{$use_item_name}<br/>";
            $use_cmmt = \player\useitem($sid,$qtype_id,1,$dblj);
            $use_cmmt = \lexical_analysis\color_string($use_cmmt);
            echo $use_cmmt;
            $player = \player\getplayer($sid,$dblj);

            $item_true_id = \player\getplayeritem_attr('item_true_id',$sid,$qtype_id,$dblj)['item_true_id'];
            \player\changeplayeritem($item_true_id,-1,$sid,$dblj);
            \player\addplayersx('uburthen',-$use_item_iweight,$sid,$dblj);
            $sql = "SELECT * from system_item where iid = :qtype_id and sid = :sid";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':qtype_id', $qtype_id,PDO::PARAM_STR);
            $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_count = $row['icount'];
            if($quick_count <=0||!$quick_count){
            echo "你的{$use_item_name}已耗尽！<br/>";
            }
            }
            }
            $test_text .= "玩家（ID: {$item['id']}）使用物品，速度：{$item['speed']}<br/>";
        } elseif ($item['type'] == 'monster') {

            \lexical_analysis\hurt_calc($sid,$item['id'],2,$dblj,$next_round,null,$npid);//怪对你的伤害,单体判别
            $test_text .= "怪物（ID: {$item['id']}）出手，速度：{$item['speed']}<br/>";
        } elseif ($item['type'] == 'pet') {
                \lexical_analysis\hurt_calc($sid,$ngid,3,$dblj,$next_round,null,$item['id']);//宠对怪的伤害
            $test_text .= "宠物（ID: {$item['id']}）出手，速度：{$item['speed']}<br/>";
        }
    }
    if($player->uis_designer==1){
        echo $test_text;
    }
        }
        
        foreach ($flattened as $item) {
            if ($item['type'] == 'player') {
                \player\update_fight_msg($sid,'0','0',$next_round,1,$dblj);
            } elseif ($item['type'] == 'monster') {
                \player\update_fight_msg($sid,'0',$item['id'],$next_round,3,$dblj);
            } elseif ($item['type'] == 'pet') {
                \player\update_fight_msg($sid,$item['id'],'0',$next_round,2,$dblj);
            }
        }
        
        $player =  player\getplayer($sid,$dblj);
        //以下获取的怪物id均是活着的怪物id
        $monster_ids = explode(',',$ngid);
        $monster_count = count($monster_ids);
        $item_counts = []; // 用于记录物品数量
        //此处任务逻辑可能导致程序卡死
        for($i=0;$i<$monster_count;$i++){
        $monster_id = $monster_ids[$i];
        $alive_monster = player\getnpcguaiwu_attr($monster_id,$dblj);
        if ($alive_monster->nhp<=0 &&$player->uhp>0){//怪物死亡
            $alive_id = $alive_monster->nid;
            $defeat_id = $alive_monster->ndefeat_event_id;
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $clj[] = $cmd;
            $ret = global_event_data_get(7,$dblj);
            if($ret){
            global_events_steps_change(7,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_id,$para);
            }
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $clj[] = $cmd;
            $ret = global_event_data_get(31,$dblj);
            if($ret){
            global_events_steps_change(31,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_id,$para);
            }
            if($defeat_id!=0){
            include_once 'class/events_steps_change.php';
            events_steps_change($defeat_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_id,$para);
            }
            $drop_exp = $alive_monster->ndrop_exp;//掉落相关
            $drop_money = $alive_monster->ndrop_money;
            $drop_items = $alive_monster->ndrop_item;
            $drop_item_type = $alive_monster->ndrop_item_type;
            $drop_map_id = $alive_monster->nmid;
            if($drop_exp){
            $drop_exp = \lexical_analysis\process_string($drop_exp,$sid);
            }
            if($drop_money){
            $drop_money = \lexical_analysis\process_string($drop_money,$sid);
            }
            if($drop_items){
            $items_para = json_decode($drop_items, true);
            if($drop_item_type ==1){
            $drop_add_map_item = [];
            if($items_para){
            foreach($items_para as $drop_id=>$drop_count){
                $drop_item_name = \player\getitem($drop_id,$dblj)->iname;
                $drop_item_name = \lexical_analysis\color_string($drop_item_name);
                $drop_count = \lexical_analysis\process_string($drop_count,$sid);
                $drop_count = @eval("return $drop_count;");
                    // 更新地图掉落物品字符串
                $drop_add_map_item[] = "$drop_id|$drop_count";
                if (isset($item_counts[$drop_item_name])) {
                        $item_counts[$drop_item_name] += $drop_count;
                    } else {
                        $item_counts[$drop_item_name] = $drop_count;
                    }
            }
            }
            if($drop_add_map_item){
                // 拼接掉落物品字符串
            $drop_add_map_item_str = implode(',', $drop_add_map_item);
            // 使用参数化查询，避免 SQL 注入，同时处理 mitem_now 为空的情况
            $nowdate = date('Y-m-d H:i:s');
            $stmt = $dblj->prepare("insert into system_npc_drop_list(drop_npc_id,drop_item_data,drop_player_sid,drop_time,drop_mid)values(?,?,?,?,?)");
            $stmt->execute([$alive_id,$drop_add_map_item_str,$sid,$nowdate,$drop_map_id]);
            }
            }else{
            if($items_para){
            foreach ($items_para as $drop_id=>$drop_count){
                $drop_count = \lexical_analysis\process_string($drop_count,$sid);
                $drop_count = @eval("return $drop_count;");
                $drop_weight = \player\getitem($drop_id,$dblj)->iweight;
                $drop_total_weight = $drop_count * $drop_weight;
                $player = \player\getplayer($sid,$dblj);
                $player_last_burthen = $player->umax_burthen - $player->uburthen;
                if($drop_count >0 && $player_last_burthen >=$drop_total_weight && $player_last_burthen>0){
                    $get_ret = \player\additem($sid,$drop_id,$drop_count,$dblj);
                    if($get_ret>0){
                    \player\changeitem_belong($get_ret,1, $alive_monster->nid,$dblj);//更新物品掉落
                    $drop_item_name = \player\getownitem($get_ret,$drop_id,'iname',$dblj);
                    $drop_item_name = \lexical_analysis\color_string($drop_item_name);
                    }
                    else{
                    $drop_item_name = \player\getownitem($get_ret,$drop_id,'iname',$dblj);
                    $drop_item_name = \lexical_analysis\color_string($drop_item_name);
                    }
                        // 更新物品数量
                    if (isset($item_counts[$drop_item_name])) {
                        $item_counts[$drop_item_name] += $drop_count;
                    } else {
                        $item_counts[$drop_item_name] = $drop_count;
                    }
                    $rwts_item = \player\update_task($sid,$dblj,$drop_id,null,null);
                    $rwts .= $rwts_item;
                }elseif($drop_count <0){
                    $item_true_id = \player\getplayeritem_attr('item_true_id',$sid,$drop_id,$dblj)['item_true_id'];
                    \player\changeplayeritem($item_true_id,$drop_count,$sid,$dblj);
                    \player\addplayersx('uburthen',-$drop_total_weight,$sid,$dblj);
                        // 更新物品数量
                    if (isset($item_counts[$drop_item_name])) {
                        $item_counts[$drop_item_name] -= $drop_count;
                    } else {
                        $item_counts[$drop_item_name] = -$drop_count;
                    }
                }
            }
            }
            }
            }
            }
            if($drop_exp!=""){
                $drop_exp = @eval("return $drop_exp;");
                \player\addplayersx('uexp',$drop_exp,$sid,$dblj);
                    // 更新经验和金钱
                $total_exp += $drop_exp;
            }
            if($drop_money!=""){
                $drop_money = @eval("return $drop_money;");
                \player\addplayersx('umoney',$drop_money,$sid,$dblj);
                $total_money += $drop_money;
            }

            $rwts_kill = \player\update_task($sid,$dblj,null,$alive_monster->nid,$alive_monster->nname);
            $rwts .= $rwts_kill;

        }
    }

$fight_arr = player\getfightpara($sid,$dblj);
if(empty($fight_arr)){
$zdjg = 1;
}
while (\player\upplayerlvl($sid, $dblj) == 1) {
    if($can_redis == 1){
    $redis->flushAll($cacheKey);
    }
    $ret = $ret ?? global_event_data_get(22, $dblj);
    if ($ret) {
        global_events_steps_change(22, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', null, null, $para);
    }
}
if ($player->uhp <= 0){
    $zdjg = 0;
}

if($rwts){
    $rwts .="<br/>";
}


if (isset($zdjg) &&empty($fight_arr) ||$player->uhp<=0){
    $dblj->exec("update system_pet_scene set nhp = nmaxhp where nsid = '$sid' and nstate = 1");
    $exp_name = \gm\get_gm_attr_info(1,'exp',$dblj)['name'];
    $money_measure = \gm\gm_post($dblj)->money_measure;
    $money_name = \gm\gm_post($dblj)->money_name;

    // 在循环外部生成输出字符串
    if($drop_item_type ==1){
    if($item_counts){
    foreach ($item_counts as $item_name => $count) {
        if($count >0&&$item_name){
        $huode .= "你看到：{$item_name} x {$count}掉落在地上！ <br/>";
        }
    }
    }
    }else{
    if($item_counts){
    foreach ($item_counts as $item_name => $count) {
        if($count >0&&$item_name){
        $huode .= "得到：{$item_name} x {$count} <br/>";
        }elseif($count<0&&$item_name){
        $huode .= "失去：{$item_name} x {$count} <br/>";
        }
    }
    }
    }
    if($total_exp){
    $total_exp = $total_exp>0?"+".$total_exp:$total_exp;
    // 添加经验和金钱输出
    $huode .= "{$exp_name}{$total_exp} <br/>";
    }
    if($total_money){
    $total_money = $total_money>0?"+".$total_money:$total_money;
    $huode .= "{$money_name}{$total_money}{$money_measure} <br/>";
    }
    $dblj->exec("DELETE from player_temp_attr where obj_id = '$sid' and attr_name = 'busy'");
    $monster_name = \lexical_analysis\color_string($alive_monster->nname);
    switch ($zdjg){
        case 1:
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            $sql = "delete from system_npc_midguaiwu where nsid='$sid'";
            $dblj->exec($sql);
            $player = \player\getplayer($sid,$dblj);
            if($player->uhp<=0){
            \player\changeplayersx('uhp',1,$sid,$dblj);
            $player = \player\getplayer($sid,$dblj);
            }
            \player\changeplayersx('ucmd','',$sid,$dblj);
            $fight_html = <<<HTML
战斗胜利！<br/>
你打死了{$monster_name}<br/>
你生命：({$player->uhp}/{$player->umaxhp})<br/>
$pets
$huode
$rwts
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            break;
        case 0:
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            $sql = "delete from system_npc_midguaiwu where nsid='$sid'";
            $dblj->exec($sql);
            \player\changeplayersx('uhp',1,$sid,$dblj);
            $ret = global_event_data_get(8,$dblj);
            if($ret){
            global_events_steps_change(8,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_monster->nid,$para);
            }
            \player\changeplayersx('ucmd','',$sid,$dblj);
            $ret = global_event_data_get(30,$dblj);
            if($ret){
            global_events_steps_change(30,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_monster->nid,$para);
            }
            if($alive_monster->nwin_event_id!=0){
            include_once 'class/events_steps_change.php';
            events_steps_change($alive_monster->nwin_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_monster->nid,$para);
            }
            $player = \player\getplayer($sid,$dblj);
            //战败事件
            $fight_html = <<<HTML
战斗失败！<br/>
你被{$monster_name} 狠狠地教训了一顿!<br/>
你生命：({$player->uhp}/{$player->umaxhp})<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            break;
        case -1:
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            \player\changeplayersx('ucmd','',$sid,$dblj);
            $fight_html = <<<HTML
你已经重伤，无法再次进行战斗！<br/>
你生命：({$player->uhp}/{$player->umaxhp})<br/>
请恢复之后重来<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            break;
    }
}

if(!isset($zdjg)){
$oid = 'npc_monster';
$mid = $ngid;
for ($i=0;$i<count($get_main_page);$i++){
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $show_ret = $main_show_cond !== '' 
        ? \lexical_analysis\process_string($main_show_cond, $sid, $oid, $mid, null, null, "check_cond") 
        : 1;
    try{
        @$ret = eval("return $show_ret;");
    }
    catch (ParseError $e){
    $index = $i+1;
    print("第{$index}个元素的显示条件语法错误: ". $e->getMessage()."<br/>");
}
    catch (Error $e){
    $index = $i+1;
    print("第{$index}个元素的显示条件执行错误: ". $e->getMessage()."<br/>");
}
    $ret_bool = ($ret !== false && $ret !== null) ? 0 : 1;
    if($ret_bool ==0){
    if($main_type !=1){
    list($main_value,$br_count) = trimTrailingNewlinesAndCount($main_value);
    // 使用 str_repeat() 来生成多个 <br/> 标签
    $br_count_html = str_repeat("<br/>", $br_count);
    }else{
    $main_value = nl2br($main_value);
    }
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    // $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    if($main_target_event !=0){
        $main_target_event = $encode->encode("cmd=main_target_event&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&ucmd=$cmid&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,10,$cmid);
        if(!filter_var($main_target_func, FILTER_VALIDATE_URL,FILTER_FLAG_QUERY_REQUIRED)){
        $main_target_func = \lexical_analysis\color_string($main_target_func);
        }
    }
    switch ($main_type) {
        case '1':
                $game_main .=<<<HTML
{$main_value}
HTML;

            break;
        case '2':
                $game_main .=<<<HTML
<a href="?cmd=$main_target_event" >{$main_value}</a>{$br_count_html}
HTML;
            break;
        case '3':
        if($main_target_func){
                $game_main .=<<<HTML
{$main_target_func}{$br_count_html}
HTML;
}
            break;
        case '4':
                $game_main .=<<<HTML
<a href="$main_link_value" >{$main_value}</a>{$br_count_html}
HTML;
            break;
        case '5':
                $game_main .=<<<HTML
<form action="?cmd={$main_target_event}" method="POST">
{$main_value}{$br_count_html}
</form>
HTML;
            break;
    }
}
}
}


if(!isset($zdjg) &&!empty($fight_arr)){
if($player->uauto_fight ==1 &&$look_canshu !=1){
    $sql = "select * from system_skill_user WHERE jsid = '$sid' and jdefault = 1 and jpid = 0";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
        $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    }
    $default_id = $ret['jid'];
    $default_id = $default_id ==0?1:$default_id;
    $quick_to = $encode->encode("cmd=pve_fighting&ucmd=$cmid&qtype=1&qtype_id=$default_id&sid=$sid");
    $quick_url = "?cmd=$quick_to"; // 构建完整的 URL
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=$quick_url">
HTML;
echo $refresh_html;
    //header("refresh:2;url={$quick_url}");//这里的2是默认间隔
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$huode<br/>
==【{$clmid->mname}】==<br/>
$game_main<br/>
HTML;
}elseif(empty($fight_arr) ||$player->uhp <=0||$zdjg ==0){
    $all = $fight_html;
}

if($look_canshu==1){
$attr_lvl_name = \gm\get_gm_attr_info('1','lvl',$dblj)['name'];
$attr_hp_name = \gm\get_gm_attr_info('1','hp',$dblj)['name'];
$attr_mp_name = \gm\get_gm_attr_info('1','mp',$dblj)['name'];
$attr_speed_name = \gm\get_gm_attr_info('1','speed',$dblj)['name'];
$goback_fight = $encode->encode("cmd=pve_fight&ucmd=$cmid&sid=$sid");
$fight_arr = player\getfightpara($sid,$dblj);
$all = "";
for($i=1;$i<@count($fight_arr) +1;$i++){
    $guai_name = $fight_arr[$i-1]['nname'];
    $guai_lvl = $fight_arr[$i-1]['nlvl'];
    $guai_hp = $fight_arr[$i-1]['nhp'];
    $guai_mp = $fight_arr[$i-1]['nmp'];
    $guai_speed = $fight_arr[$i-1]['nspeed'];
    $guai_desc = $fight_arr[$i-1]['ndesc'];
    $all .= <<<HTML
[$i]名称：{$guai_name}<br/>
{$attr_lvl_name}：{$guai_lvl}<br/>
{$attr_hp_name}：{$guai_hp}<br/>
{$attr_mp_name}：{$guai_mp}<br/>
{$attr_speed_name}：{$guai_speed}<br/>
简介：{$guai_desc}<br/>
HTML;
}
$all .="<a href='?cmd=$goback_fight'>返回战斗</a>";
}
}else{
$all = <<<HTML
对方已经被其他人攻击了！<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
}
echo $all;
?>