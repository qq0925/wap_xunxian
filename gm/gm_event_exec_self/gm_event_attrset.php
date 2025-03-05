<?php

if(!empty($_POST)){
if($canshu =='update'){
$key=$_POST['key'];
$old_key = $_POST['old_key'];
$value=$_POST['value'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];

$sql = "SELECT s_attrs FROM system_event_evs_self WHERE belong = ? and id = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$event_id,$step_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true);

if(!$key){
unset($data[$old_key]); // 移除该项数组
echo "删除完成！<br/>";
if($data ===[]){
unset($data);
}
}else{
$data[$key] = $value; // 自动覆盖重复键
echo "更新完成！<br/>";
}


}elseif($canshu == 'add'){

$key=$_POST['key'];
$value=$_POST['value'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];

$sql = "SELECT s_attrs FROM system_event_evs_self WHERE belong = ? and id = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$event_id,$step_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true)??[];

if(!$key){
echo "键不能为空！<br/>";
}else{
$data[$key] = $value; // 自动覆盖重复键
}
echo "新增完成！<br/>";

}
if($data){
$newJson = json_encode($data,true);
}else{
$newJson = '';
}
$updateSql = "UPDATE system_event_evs_self SET s_attrs = ? WHERE belong = ? and id = ?";
$updateStmt = $dblj->prepare($updateSql);
$updateStmt->execute([$newJson,$event_id, $step_id]);
}

// 查询 system_event_evs_self 表获取 s_attrs 字段的值
$query = "SELECT s_attrs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$row = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_attr_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$s_attrs = $row['s_attrs'];
$attrs = json_decode($s_attrs, true);
if($attrs){
foreach ($attrs as $key => $value) {
    $attr = $key.'='.$value;
    $key = urlencode($key);
    $value = urlencode($value);
    $index_attr = $encode->encode("cmd=game_event_attrset_2_self&event_id=$event_id&step_id=$step_id&attr_key=$key&attr_value=$value&canshu=update&sid=$sid");
    $attr_html .=<<<HTML
    <a href="?cmd=$index_attr">$attr</a><br/>
HTML;
    
}
}

$index_attr_add = $encode->encode("cmd=game_event_attrset_2_self&event_id=$event_id&step_id=$step_id&canshu=add&sid=$sid");

$gm_html =<<<HTML
<p>定义事件步骤的设置属性<br/>
$attr_html
<a href="?cmd=$index_attr_add">增加属性</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_attr_last">返回上级</a><br/>
</p>
HTML;
echo $gm_html;
?>