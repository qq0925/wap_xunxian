<?php

if($_POST){
$sql = "UPDATE system_npc_op SET show_cond = :show_cond, name = :op_name WHERE `id` = :id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':show_cond', $show_cond);
$stmt->bindParam(':op_name', $op_name);
$stmt->bindParam(':id', $op_id);
$stmt->execute();
$sql = "UPDATE system_event_self SET `desc` = :desc WHERE `belong` = :id and module_id = 'npc_op'";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':desc', $op_name);
$stmt->bindParam(':id', $op_id);
$stmt->execute();
echo "修改成功！<br/>";
}

if($add ==1){
$sql = "insert into system_npc_op(`belong`,`id`,`name`)values('$op_belong','$max_id','未命名')";
$cxjg = $dblj->exec($sql);
$op_id = $max_id;

// 检查 a_skills 字段是否为空
$query = "SELECT nop_target FROM system_npc where nid= '$op_belong'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['nop_target'])) {
    // a_skills 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_npc SET nop_target = :new_value where nid= '$op_belong'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $max_id);
    $stmt->execute();
} elseif(!in_array($max_id, explode(',',$result['nop_target']))) {
    // a_skills 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_npc SET nop_target = CONCAT(nop_target, ',', :new_value) where nid= '$op_belong'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $max_id);
    $stmt->execute();
}
}


$sql = "select * from system_npc_op where id = '$op_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$op_name = $ret['name'];
$op_id = $ret['id'];
$op_belong = $ret['belong'];
$op_show_cond = $ret['show_cond'];
$op_link_event = $ret['link_event'];
$op_link_task = $ret['link_task'];

if($op_link_event ==0){
$npc_op_events = $encode->encode("cmd=game_main_event&add_event=1&add_value=$op_name&gm_post_canshu=npc_op&main_id=$op_id&event_id=$op_link_event&sid=$sid");
}else{
$npc_op_events = $encode->encode("cmd=game_main_event&gm_post_canshu=npc_op&main_id=$op_id&event_id=$op_link_event&sid=$sid");
}

$op_list = $encode->encode("cmd=gm_type_npc&gm_post_canshu=2&npc_id=$op_belong&sid=$sid");

$op_html =<<<HTML
<p>定义操作：{$op_name}<br/>
</p>
<form method="post">
<input name="add" type="hidden" value="0">
<input name="op_id" type="hidden" value="{$op_id}">
操作提示:<input name="op_name" type="text" value="{$op_name}" maxlength="50"/><br/>
出现条件:<textarea name="show_cond" maxlength="1024" rows="4" cols="40">{$op_show_cond}</textarea><br/>
触发事件:<a href="?cmd=$npc_op_events">定义事件</a><br/>
<br/>
触发任务:<a href="?cmd=$npc_op_tasks">定义任务</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$op_list">返回操作列表</a><br/>
HTML;
echo $op_html;
?>