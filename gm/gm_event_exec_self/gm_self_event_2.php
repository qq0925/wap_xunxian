<?php

if($_POST){
$sql = "UPDATE system_event_self SET cond = :cond, cmmt = :cmmt WHERE `id` = :id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':cond', $cond);
$stmt->bindParam(':cmmt', $cmmt);
$stmt->bindParam(':id', $event_id);
$stmt->execute();
echo "修改成功！<br/>";
}



switch ($gm_post_canshu) {
    case '1':
        $module_type = 'game_scene_page';
        break;
    case '2':
        $module_type = 'game_npc_page';
        break;
    case '3':
        $module_type = 'game_pet_page';
        break;
    case '4':
        $module_type = 'game_item_page';
        break;
    case '5':
        $module_type = 'game_oplayer_page';
        break;
    case '6':
        $module_type = 'game_equip_page';
        break;
    case '7':
        $module_type = 'game_player_page';
        break;
    case '8':
        $module_type = 'game_skill_page';
        break;
    case '9':
        $module_type = 'game_function_page';
        break;
    case '10':
        $module_type = 'game_pve_page';
        break;
    case '11':
        $module_type = 'game_main_page';
        break;
    case 'skill_default_use':
        $module_type = 'system_skill_module';
        break;
    case 'skill_use':
        $module_type = 'system_skill';
        break;
    case 'skill_default_up':
        $module_type = 'system_skill_module';
        break;
    case 'skill_up':
        $module_type = 'system_skill';
        break;
    case 'map_creat':
        $module_type = 'system_map';
        $module_event_id = "mcreat_event_id";
        break;
    case 'map_look':
        $module_type = 'system_map';
        $module_event_id = "mlook_event_id";
        break;
    case 'map_into':
        $module_type = 'system_map';
        $module_event_id = "minto_event_id";
        break;
    case 'map_out':
        $module_type = 'system_map';
        $module_event_id = "mout_event_id";
        break;
    case 'map_minute':
        $module_type = 'system_map';
        $module_event_id = "mminute_event_id";
        break;
    case 'item_creat':
        $module_type = 'system_item_module';
        $module_event_id = "icreat_event_id";
        break;
    case 'item_look':
        $module_type = 'system_item_module';
        $module_event_id = "ilook_event_id";
        break;
    case 'item_use':
        $module_type = 'system_item_module';
        $module_event_id = "iuse_event_id";
        break;
    case 'item_minute':
        $module_type = 'system_item_module';
        $module_event_id = "iminute_event_id";
        break;
    case 'npc_creat':
        $module_type = 'system_npc';
        $module_event_id = "ncreat_event_id";
        break;
    case 'npc_look':
        $module_type = 'system_npc';
        $module_event_id = "nlook_event_id";
        break;
    case 'npc_attack':
        $module_type = 'system_npc';
        $module_event_id = "nattack_event_id";
        break;
    case 'npc_win':
        $module_type = 'system_npc';
        $module_event_id = "nwin_event_id";
        break;
    case 'npc_defeat':
        $module_type = 'system_npc';
        $module_event_id = "ndefeat_event_id";
        break;
    case 'npc_pet':
        $module_type = 'system_npc';
        $module_event_id = "npet_event_id";
        break;
    case 'npc_up':
        $module_type = 'system_npc';
        $module_event_id = "nup_event_id";
        break;
    case 'npc_shop':
        $module_type = 'system_npc';
        $module_event_id = "nshop_event_id";
        break;
    case 'npc_heart':
        $module_type = 'system_npc';
        $module_event_id = "nheart_event_id";
        break;
    case 'npc_minute':
        $module_type = 'system_npc';
        $module_event_id = "nminute_event_id";
        break;
    case 'npc_task_accept':
        $module_type = 'system_task';
        $module_event_id = "ttarget_event_accept";
        break;
    case 'npc_task_giveup':
        $module_type = 'system_task';
        $module_event_id = "ttarget_event_giveup";
        break;
    case 'npc_task_finish':
        $module_type = 'system_task';
        $module_event_id = "ttarget_event_finish";
        break;
    case 'map_op':
        $module_type = 'system_map_op';
        break;
    case 'item_op':
        $module_type = 'system_item_op';
        break;
    case 'npc_op':
        $module_type = 'system_npc_op';
        break;
    default:
        $module_type = $gm_post_canshu;
        $gm_post_canshu = "game_self_page_".$module_type;
        break;
}


if($add_event ==1){
    $sql = "SELECT MAX(id) AS max_id FROM system_event_self;";
    $cxjg = $dblj->query($sql);
    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
    $max_id = $row['max_id'] +1;
    $sql = "insert into system_event_self(`belong`,`id`,`desc`,`module_id`)values('$main_id','$max_id','$add_value','$gm_post_canshu')";
    $cxjg = $dblj->exec($sql);
    if($gm_post_canshu >=1 &&$gm_post_canshu <=11){
    $sql = "update `$module_type` set target_event = '$max_id' where id = '$main_id'";
    }elseif($gm_post_canshu =='skill_default_use' ||$gm_post_canshu =='skill_use'){
    $sql = "update `$module_type` set jevent_use_id = '$max_id' where jid = '$main_id'";
    }elseif($gm_post_canshu =='skill_default_up' ||$gm_post_canshu =='skill_up'){
    $sql = "update `$module_type` set jevent_up_id = '$max_id' where jid = '$main_id'";
    }elseif($gm_post_canshu == 'map_creat' || $gm_post_canshu == 'map_look' || $gm_post_canshu == 'map_into' || $gm_post_canshu == 'map_out' || $gm_post_canshu == 'map_minute'){
    $sql = "update `$module_type` set $module_event_id = '$max_id' where mid = '$main_id'";
    }elseif($gm_post_canshu == 'item_creat' || $gm_post_canshu == 'item_look' || $gm_post_canshu == 'item_use' || $gm_post_canshu == 'item_minute'){
    $sql = "update `$module_type` set $module_event_id = '$max_id' where iid = '$main_id'";
    }elseif($gm_post_canshu == 'npc_creat' || $gm_post_canshu == 'npc_look' || $gm_post_canshu == 'npc_attack' || $gm_post_canshu == 'npc_win' || $gm_post_canshu == 'npc_defeat' || $gm_post_canshu == 'npc_minute' || $gm_post_canshu == 'npc_up' || $gm_post_canshu == 'npc_shop' || $gm_post_canshu == 'npc_heart' || $gm_post_canshu == 'npc_pet'){
    $sql = "update `$module_type` set $module_event_id = '$max_id' where nid = '$main_id'";
    }elseif($gm_post_canshu == 'map_op' || $gm_post_canshu == 'item_op' ||$gm_post_canshu == 'npc_op'){
    $sql = "update `$module_type` set link_event = '$max_id' where id = '$main_id'";
    }elseif($gm_post_canshu == 'npc_task_accept' || $gm_post_canshu == 'npc_task_giveup' ||$gm_post_canshu == 'npc_task_finish'){
    $sql = "update `$module_type` set $module_event_id = '$max_id' where tid = '$main_id'";
    }else{
    $sql = "update `$gm_post_canshu` set target_event = '$max_id' where id = '$main_id'";
    }
    
    $cxjg = $dblj->exec($sql);
    $add_event = 0;
    $event_id = $max_id;
}

if($now_pos !=0 && $next_pos !=0){
    echo "操作成功！<br/>";
    $query = "SELECT link_evs FROM system_event_self WHERE `id` = '$event_id'";
    $stmt = $dblj->query($query);
    // 获取结果
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $event_link_evs = $row['link_evs'];
    $event_link_evs = explode(',',$event_link_evs);
    $nowposIndex = array_search($now_pos, $event_link_evs);
    $nextposIndex = array_search($next_pos, $event_link_evs);
    $temp = $event_link_evs[$nowposIndex];
    $event_link_evs[$nowposIndex] = $event_link_evs[$nextposIndex];
    $event_link_evs[$nextposIndex] = $temp;
    $newString = implode(",", $event_link_evs);
    $sql = "update system_event_self set link_evs = '$newString' where `id` = '$event_id'";
    $dblj->exec($sql);
    }




//传进来一个event_id
$query = "SELECT * FROM system_event_self WHERE `id` = :id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $event_id);
$stmt->execute();
$tishi = '';
$i = 0;
if ($if_delete ==1){
    $tishi = "删除成功！";
}
// 获取结果
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$link_evs = $rows[0]['link_evs'];
$main_id = $rows[0]['belong'];
$gm_post_canshu = $rows[0]['module_id'];


if($gm_post_canshu >=1 &&$gm_post_canshu <=11){
$gm_main = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&sid=$sid");
}elseif($gm_post_canshu =='skill_default_use'||$gm_post_canshu =='skill_default_up'){
$gm_main = $encode->encode("cmd=gm_skill_def&skill_post_canshu=5&sid=$sid");
}elseif($gm_post_canshu =='skill_use'||$gm_post_canshu =='skill_up'){
$gm_main = $encode->encode("cmd=gm_skill_def&skill_id=$main_id&skill_post_canshu=2&sid=$sid");
}elseif($gm_post_canshu == 'map_creat' || $gm_post_canshu == 'map_look' || $gm_post_canshu == 'map_into' || $gm_post_canshu == 'map_out' || $gm_post_canshu == 'map_minute'){
$gm_main = $encode->encode("cmd=gm_type_map&target_midid=$main_id&gm_post_canshu=3&sid=$sid");
}elseif($gm_post_canshu == 'item_creat' || $gm_post_canshu == 'item_look' || $gm_post_canshu == 'item_use' || $gm_post_canshu == 'item_minute'){
$gm_main = $encode->encode("cmd=gm_type_item&item_id=$main_id&gm_post_canshu=3&sid=$sid");
}elseif($gm_post_canshu == 'npc_creat' || $gm_post_canshu == 'npc_look' || $gm_post_canshu == 'npc_attack' || $gm_post_canshu == 'npc_win' || $gm_post_canshu == 'npc_defeat' || $gm_post_canshu == 'npc_minute' || $gm_post_canshu == 'npc_up' || $gm_post_canshu == 'npc_shop' || $gm_post_canshu == 'npc_heart' || $gm_post_canshu == 'npc_pet'){
$gm_main = $encode->encode("cmd=gm_type_npc&npc_id=$main_id&gm_post_canshu=3&sid=$sid");
}elseif($gm_post_canshu == 'map_op'){
$gm_main = $encode->encode("cmd=system_map_op_detail&op_id=$main_id&sid=$sid");
}elseif($gm_post_canshu == 'item_op'){
$gm_main = $encode->encode("cmd=system_item_op_detail&op_id=$main_id&sid=$sid");
}elseif($gm_post_canshu == 'npc_op'){
$gm_main = $encode->encode("cmd=system_npc_op_detail&op_id=$main_id&sid=$sid");
}elseif($gm_post_canshu == 'npc_task_accept' || $gm_post_canshu == 'npc_task_giveup'||$gm_post_canshu == 'npc_task_finish'){
$gm_main = $encode->encode("cmd=system_task_detail&task_id=$main_id&sid=$sid");
}else{
$prefix = "game_self_page_";
if (strpos($gm_post_canshu, $prefix) === 0) {
    $gm_post_canshu = str_replace($prefix, "", $gm_post_canshu);
}
$gm_main = $encode->encode("cmd=game_self_page_2&main_id=$main_id&self_id=$gm_post_canshu&sid=$sid");
}



$link_evs_array = explode(",", $link_evs);
if(empty($link_evs_array)){
}else{
@$last_pos = end($link_evs_array) + 1;
}



// 判断 link_evs 的值并输出相应的步骤信息
foreach ($rows as $row) {
    $link_evs = $row['link_evs'];
    $event_name = $row['desc'];
    $event_id = $row['id'];
    $event_cond = $row['cond'];
    $event_cmmt = $row['cmmt'];
    $event_module_id = $row['module_id'];
    if (empty($link_evs)) {
        continue;
    }
    $steps = explode(',', $link_evs);
    for ($i = 0; $i < count($steps); $i++) {
        $step = $steps[$i];
        $index = $i + 1;
        $gm_steps_detail = $encode->encode("cmd=gm_game_selfeventdefine_steps&main_id=$main_id&step_id=$step&event_id=$event_id&sid=$sid");
        $gm_steps_delete = $encode->encode("cmd=gm_game_selfeventdefine_steps_delete&event_id=$event_id&step_id=$step&if_delete=1&sid=$sid");
        $gm_steps .= <<<HTML
            步骤{$index}:<a href="?cmd=$gm_steps_detail">修改</a>
            <a href="?cmd=$gm_steps_delete">删除</a>
HTML;
        if($index ==1 && count($steps)>1){
        $next_pos = $steps[1];
        $move_next = $encode->encode("cmd=game_main_event&now_pos=$step&event_id=$event_id&next_pos=$next_pos&sid=$sid");
        $gm_steps .=<<<HTML
[ <font color ="red">上移</font> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
        }elseif ($index ==count($steps) && count($steps)>1){
        $next_pos = $steps[$index -2];
        $move_last = $encode->encode("cmd=game_main_event&now_pos=$step&event_id=$event_id&next_pos=$next_pos&sid=$sid");
        $gm_steps .=<<<HTML
[ <a href="?cmd=$move_last">上移</a> <font color ="red">下移</font> ]<br/>
HTML;
        }
        elseif($index !=1 && $index !=count($steps) && count($steps)>1){
        $last_pos = $steps[$index -2];
        $next_pos = $steps[$index];
        $move_last = $encode->encode("cmd=game_main_event&now_pos=$step&event_id=$event_id&next_pos=$last_pos&sid=$sid");
        $move_next = $encode->encode("cmd=game_main_event&now_pos=$step&event_id=$event_id&next_pos=$next_pos&sid=$sid");
        $gm_steps .=<<<HTML
[ <a href="?cmd=$move_last">上移</a><a href="?cmd=$move_next">下移</a> ]<br/>
HTML;

        }
        else{
    $gm_steps .=<<<HTML
[ <font color ="red">上移 下移</font> ]<br/>
HTML;
}
    }

}
$sql = "SELECT MAX(id) AS max_id FROM system_event_evs_self;";
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(PDO::FETCH_ASSOC);
$max_id = $row['max_id'] +1;

$gm_game_selfeventdefine_addsteps = $encode->encode("cmd=gm_game_selfeventdefine_addsteps&add=1&main_id=$main_id&event_id=$event_id&max_id=$max_id&sid=$sid");
$gm_game_selfeventdefine_data = $encode->encode("cmd=gm_game_selfeventdefine_data&data_id=$event_id&event_id=$event_id&data_type=events&sid=$sid");
$gm_html =<<<HTML
$tishi
<p>[专属事件定义]<br/>
[定义操作“{$event_name}”的事件(id:{$event_id})]<br/>
</p>
<form method="post">
<input name="event_id" type="hidden" value="{$event_id}">
触发条件:<textarea name="cond" maxlength="4096" rows="4" cols="40">{$event_cond}</textarea><br/>
不满足条件提示语:<textarea name="cmmt" maxlength="1024" rows="4" cols="40">{$event_cmmt}</textarea><br/>
$gm_steps
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_game_selfeventdefine_addsteps">添加步骤</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_data">查看定义数据</a><br/>
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
</p>
HTML;
echo $gm_html;
?>