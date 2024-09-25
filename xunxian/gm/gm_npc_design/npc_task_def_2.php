<?php

if($_POST){
    
if($old_ttype != $ttype){
    $dblj->exec("UPDATE system_task SET ttarget_obj = '' where tid= '$task_id'");
}

if($old_tname !=$task_name){
    $dblj->exec("UPDATE system_event_self SET `desc` = REPLACE(`desc`, '$old_tname', '$task_name') WHERE `desc` LIKE '%$old_tname%' and belong = '$task_id' and module_id LIKE 'npc_task\_%'");
}

$sql = "UPDATE system_task SET ttype = :ttype,ttype2 = :ttype2, tname = :task_name, tgiveup = :tgiveup,tcond = :tcond ,taccept_cond = :taccept_cond ,tcmmt1 = :tcmmt1 ,tcmmt2 = :tcmmt2 WHERE `tid` = :task_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':ttype', $ttype);
$stmt->bindParam(':ttype2', $ttype2);
$stmt->bindParam(':task_name', $task_name);
$stmt->bindParam(':tgiveup', $tgive_up);
$stmt->bindParam(':tcond', $tcond);
$stmt->bindParam(':taccept_cond', $taccept_cond);
$stmt->bindParam(':tcmmt1', $tcmmt1);
$stmt->bindParam(':tcmmt2', $tcmmt2);
$stmt->bindParam(':task_id', $task_id);
$stmt->execute();
echo "修改成功！<br/>";
}

if($add ==1){
$sql = "insert into system_task(`tnpc_id`,`tid`,`tname`,`ttype`)values('$task_tnpc_id','$max_id','未命名','1')";
$cxjg = $dblj->exec($sql);
$task_id = $max_id;

// 检查 a_skills 字段是否为空
$query = "SELECT ntask_target FROM system_npc where nid= '$task_tnpc_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['ntask_target'])) {
    // a_skills 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_npc SET ntask_target = :new_value where nid= '$task_tnpc_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $max_id);
    $stmt->execute();
} elseif(!in_array($max_id, explode(',',$result['ntask_target']))) {
    // a_skills 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_npc SET ntask_target = CONCAT(ntask_target, ',', :new_value) where nid= '$task_tnpc_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $max_id);
    $stmt->execute();
}
}


$sql = "select * from system_task where tid = '$task_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$task_name = $ret['tname'];
$task_id = $ret['tid'];
$task_tnpc_id = $ret['tnpc_id'];
$task_cond = $ret['tcond'];
$task_accept_cond = $ret['taccept_cond'];
$task_cmmt1 = $ret['tcmmt1'];
$task_cmmt2 = $ret['tcmmt2'];
$task_type = $ret['ttype'];
$task_type2 = $ret['ttype2'];
$task_obj = $ret['ttarget_obj'];

$task_event_accept = $ret['ttarget_event_accept'];
$task_event_giveup = $ret['ttarget_event_giveup'];
$task_event_finish = $ret['ttarget_event_finish'];

$task_giveup = $ret['tgiveup'];
$task_giveup_select = $task_giveup ==1?"selected" :"";
$task_type2_select_1 = $task_type2 ==1?"selected" :"";
$task_type2_select_2 = $task_type2 ==2?"selected" :"";
$task_type2_select_3 = $task_type2 ==3?"selected" :"";
if($task_obj){
$task_obj_count = @count(explode(",",$task_obj));
}else{
$task_obj_count = 0;
}

switch ($task_type) {
    case '1':
        $task_type_text = <<<HTML
任务类型:<select name="ttype" value="{$task_type}">
<option value="1" selected>杀人任务</option>
<option value="2">寻物任务</option>
<option value="3">办事任务</option>
</select><br/>
HTML;
$task_type_kill_count = $task_obj_count;
$task_type_kill_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&sid=$sid");
        $task_type_info = <<<HTML
杀人任务人物列表:<a href="?cmd=$task_type_kill_def">修改({$task_type_kill_count})</a><br/>
HTML;
        break;
    case '2':
        $task_type_text = <<<HTML
任务类型:<select name="ttype" value="{$task_type}">
<option value="1">杀人任务</option>
<option value="2" selected>寻物任务</option>
<option value="3">办事任务</option>
</select><br/>
HTML;
$task_type_item_count = $task_obj_count;
$task_type_item_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=2&task_id=$task_id&sid=$sid");
        $task_type_info = <<<HTML
寻物任务物品列表:<a href="?cmd=$task_type_item_def">修改({$task_type_item_count})</a><br/>
HTML;
        break;
    case '3':
        $task_type_text = <<<HTML
任务类型:<select name="ttype" value="{$task_type}">
<option value="1">杀人任务</option>
<option value="2">寻物任务</option>
<option value="3" selected>办事任务</option>
</select><br/>
HTML;
$task_type_mark = $task_obj;
        $task_type_info = <<<HTML
办事任务标识名称:<input name="dosth_flag" type="text" value="t{$task_id}" maxlength="50" disabled/><br/>
HTML;
        break;
}
if($task_event_accept ==0){
$task_name_event = "[".$task_name."]"."的接受";
$npc_task_events_1 = $encode->encode("cmd=game_main_event&add_event=1&add_value=$task_name_event&gm_post_canshu=npc_task_accept&main_id=$task_id&event_id=$task_event_accept&sid=$sid");
}else{
$npc_task_events_1 = $encode->encode("cmd=game_main_event&gm_post_canshu=npc_task_accept&main_id=$task_id&event_id=$task_event_accept&sid=$sid");
}

if($task_event_giveup ==0){
$task_name_event = "[".$task_name."]"."的放弃";
$npc_task_events_2 = $encode->encode("cmd=game_main_event&add_event=1&add_value=$task_name_event&gm_post_canshu=npc_task_giveup&main_id=$task_id&event_id=$task_event_giveup&sid=$sid");
}else{
$npc_task_events_2 = $encode->encode("cmd=game_main_event&gm_post_canshu=npc_task_giveup&main_id=$task_id&event_id=$task_event_giveup&sid=$sid");
}

if($task_event_finish ==0){
$task_name_event = "[".$task_name."]"."的完成";
$npc_task_events_3 = $encode->encode("cmd=game_main_event&add_event=1&add_value=$task_name_event&gm_post_canshu=npc_task_finish&main_id=$task_id&event_id=$task_event_finish&sid=$sid");
}else{
$npc_task_events_3 = $encode->encode("cmd=game_main_event&gm_post_canshu=npc_task_finish&main_id=$task_id&event_id=$task_event_finish&sid=$sid");
}

$task_list = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&npc_id=$task_tnpc_id&sid=$sid");

$task_html =<<<HTML
<p>定义任务：{$task_name}<br/>
</p>
<form method="post">
<input name="add" type="hidden" value="0">
<input name="old_ttype" type="hidden" value="{$task_type}">
<input name="old_tname" type="hidden" value="{$task_name}">
<input name="task_id" type="hidden" value="{$task_id}">
任务标识:t{$task_id}<br/>
任务名称:<input name="task_name" type="text" value="{$task_name}" maxlength="50"/><br/>
$task_type_text
任务类别:<select name="ttype2" value="{$task_type2}">
<option value="1" {$task_type2_select_1}>主线</option>
<option value="2" {$task_type2_select_2}>支线</option>
<option value="3" {$task_type2_select_3}>日常</option>
</select><br/>
是否可放弃:<select name="tgive_up" value="0">
<option value="0">否</option>
<option value="1" {$task_giveup_select}>是</option>
</select><br/>
触发条件:<textarea name="tcond" maxlength="1024" rows="4" cols="40">{$task_cond}</textarea><br/>
接受条件:<textarea name="taccept_cond" maxlength="1024" rows="4" cols="40">{$task_accept_cond}</textarea><br/>
不能接受提示语:<textarea name="tcmmt1" maxlength="200" rows="4" cols="40">{$task_cmmt1}</textarea><br/>
未完成提示语:<textarea name="tcmmt2" maxlength="200" rows="4" cols="40">{$task_cmmt2}</textarea><br/>
$task_type_info
接受事件：<a href="?cmd=$npc_task_events_1">定义事件</a><br/>
放弃事件：<a href="?cmd=$npc_task_events_2">定义事件</a><br/>
完成事件：<a href="?cmd=$npc_task_events_3">定义事件</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$task_list">返回任务列表</a><br/>
HTML;
echo $task_html;
?>