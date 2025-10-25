<?php

if(!empty($_POST) || $canshu == 'remove'){
if($canshu =='change'){
$key=$_POST['item_id'];
$value=$_POST['new_count'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];

$sql = "SELECT items FROM system_event_evs_self WHERE belong = ? and id = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$event_id,$step_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true);

$data[$key] = $value; // 自动覆盖重复键
echo "更新完成！<br/>";

}elseif($canshu == 'add'){
$key=$_POST['item_id'];
$value=$_POST['new_count'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];

$sql = "SELECT items FROM system_event_evs_self WHERE belong = ? and id = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$event_id,$step_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true)??[];
$data[$key] = $value; // 自动覆盖重复键
echo "新增完成！<br/>";
}
elseif($canshu == 'remove'){
$sql = "SELECT items FROM system_event_evs_self WHERE belong = ? and id = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$event_id,$step_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true)??[];
unset($data[$item_id]); // 移除该项数组
echo "删除完成！<br/>";
}
if($data){
$newJson = json_encode($data);
}else{
$newJson = '';
}
$updateSql = "UPDATE system_event_evs_self SET items = ? WHERE belong = ? and id = ?";
$updateStmt = $dblj->prepare($updateSql);
$updateStmt->execute([$newJson,$event_id, $step_id]);
}

// 查询 system_event_evs_self 表获取 items 字段的值
$query = "SELECT items FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$row = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_item_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_item_add = $encode->encode("cmd=game_event_itemchange_self&add_action=1&event_id=$event_id&step_id=$step_id&sid=$sid");

$r_items = $row['items'];
$items = json_decode($r_items, true);
if($items){
foreach ($items as $key => $value) {
    $key = urlencode($key);
    $show_value = $value;
    $value = urlencode($value);
    $sql = "SELECT iname from system_item_module where iid = '$key'";
    $stmt = $dblj->query($sql);
    $item_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
    $item_name = $item_rows['iname'];
    $item_change = $encode->encode("cmd=game_event_itemchange_self&item_id=$key&item_name=$item_name&item_count=$value&event_id=$event_id&step_id=$step_id&sid=$sid");
    $item_remove = $encode->encode("cmd=game_event_itemchange_self&item_id=$key&event_id=$event_id&step_id=$step_id&canshu=remove&sid=$sid");
    $item_list .=<<<HTML
<a href="?cmd=$item_change">{$item_name}({$show_value})</a><a href="?cmd=$item_remove">移除</a><br/>
HTML;
    
}
}
$item_html =<<<HTML
<p>定义事件步骤的更改物品<br/>
$item_list
<a href="?cmd=$index_item_add">增加物品</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_item_last">返回上级</a><br/>
</p>
HTML;
echo $item_html;
?>