<?php

if($_POST){
$sql = "UPDATE system_map_op SET show_cond = :show_cond, name = :op_name WHERE `id` = :id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':show_cond', $show_cond);
$stmt->bindParam(':op_name', $op_name);
$stmt->bindParam(':id', $op_id);
$stmt->execute();
$sql = "UPDATE system_event_self SET `desc` = :desc WHERE `belong` = :id and module_id = 'map_op'";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':desc', $op_name);
$stmt->bindParam(':id', $op_id);
$stmt->execute();
echo "修改成功！<br/>";
}

if($add ==1){
$sql = "insert into system_map_op(`belong`,`id`,`name`)values('$op_belong','$max_id','未命名')";
$cxjg = $dblj->exec($sql);
$op_id = $max_id;

// 检查 a_skills 字段是否为空
$query = "SELECT mop_target FROM system_map where mid= '$op_belong'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['mop_target'])) {
    // a_skills 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_map SET mop_target = :new_value where mid= '$op_belong'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $max_id);
    $stmt->execute();
} elseif(!in_array($max_id, explode(',',$result['mop_target']))) {
    // a_skills 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_map SET mop_target = CONCAT(mop_target, ',', :new_value) where mid= '$op_belong'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $max_id);
    $stmt->execute();
}
}


$sql = "select * from system_map_op where id = '$op_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$op_name = $ret['name'];
$op_id = $ret['id'];
$op_belong = $ret['belong'];
$op_show_cond = $ret['show_cond'];
$op_link_event = $ret['link_event'];
$op_link_task = $ret['link_task'];

if($op_link_event ==0){
$map_op_events = $encode->encode("cmd=game_main_event&add_event=1&add_value=$op_name&gm_post_canshu=map_op&main_id=$op_id&event_id=$op_link_event&sid=$sid");
}else{
$map_op_events = $encode->encode("cmd=game_main_event&gm_post_canshu=map_op&main_id=$op_id&event_id=$op_link_event&sid=$sid");
}

$op_list = $encode->encode("cmd=gm_type_map&gm_post_canshu=2&target_midid=$op_belong&sid=$sid");

$op_html =<<<HTML
<p>定义操作：{$op_name}<br/>
</p>
<form method="post">
<input name="add" type="hidden" value="0">
<input name="op_id" type="hidden" value="{$op_id}">
操作提示:<input name="op_name" type="text" value="{$op_name}" maxlength="50"/><br/>
出现条件:<textarea name="show_cond" maxlength="1024" rows="4" cols="40">{$op_show_cond}</textarea><br/>
触发事件:<a href="?cmd=$map_op_events">定义事件</a><br/>
<br/>
触发任务:<a href="?cmd=$map_op_tasks">定义任务</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$op_list">返回操作列表</a><br/>
HTML;
echo $op_html;
?>