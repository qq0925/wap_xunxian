<?php

if(!empty($_POST)){
$key=$_POST['key'];
$old_key=$_POST['old_key'];
$text=$_POST['text'];
$old_text=$_POST['old_text'];
$type=$_POST['type'];
$old_type=$_POST['old_type'];
$max_len=$_POST['max_len'];
$old_max_len=$_POST['old_max_len'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];
$string_old = $old_key."|".$old_text."|".$old_type."|".$old_max_len;
$string_new = $key."|".$text."|".$type."|".$max_len;
}
if($old_key && !empty($key)){
// 准备 SQL 查询语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET inputs = REPLACE(inputs, :old_value, :new_value) WHERE belong = :belong AND id = :id";
// 准备并执行预处理语句
$stmt = $dblj->prepare($query);
// 绑定参数值
$stmt->bindParam(':old_value', $string_old);
$stmt->bindParam(':new_value', $string_new);
$stmt->bindParam(':belong', $event_id);
$stmt->bindParam(':id', $step_id);
// 执行查询
$stmt->execute();
}elseif(!$old_key && !empty($key)){
// 检查 inputs 字段是否为空
$query = "SELECT inputs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['inputs'])) {
    // inputs 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs_self SET inputs = :new_value where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
} else {
    // inputs 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs_self SET inputs = CONCAT(inputs, ',', :new_value) where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}
}
if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT inputs FROM system_event_evs_self WHERE belong = '$event_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $inputs = $row['inputs'];
} else {
    echo "查询失败";
}
$string_old = $remove_id."|".$remove_text."|".$remove_type."|".$remove_max_len;
$elements = explode(",", $inputs);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET inputs = :newstring WHERE belong = '$event_id' and id = '$step_id'";

// 准备并执行预处理语句
$stmt = $dblj->prepare($query);

// 绑定参数值
$stmt->bindParam(':newstring', $newString);

// 执行更新
if ($stmt->execute()) {
    echo "更新成功";
} else {
    echo "更新失败";
}
}


// 查询 system_event_evs_self 表获取 inputs 字段的值
$query = "SELECT inputs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_inputs_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_inputs_add = $encode->encode("cmd=game_event_inputs_self&add=1&event_id=$event_id&step_id=$step_id&sid=$sid");
if($rows){
$row = explode(',',$rows['inputs']);
foreach ($row as $row_detail){
$i++;
$row_para = explode('|',$row_detail);
if($row_para[0] !=''){
$inputs_id = $row_para[0];
$inputs_text = $row_para[1];
$inputs_type = $row_para[2];
$inputs_max_len = $row_para[3];
$inputs_change = $encode->encode("cmd=game_event_inputs_self&change=1&inputs_id=$inputs_id&inputs_text=$inputs_text&inputs_type=$inputs_type&inputs_max_len=$inputs_max_len&event_id=$event_id&step_id=$step_id&sid=$sid");
$inputs_remove = $encode->encode("cmd=game_event_inputs_self&remove_id=$inputs_id&remove_text=$inputs_text&remove_type=$inputs_type&remove_max_len=$inputs_max_len&event_id=$event_id&step_id=$step_id&sid=$sid");
$inputs_list .=<<<HTML
{$i}.<a href="?cmd=$inputs_change">{$inputs_text}({$inputs_id})</a><a href="?cmd=$inputs_remove">移除</a><br/>
HTML;
}
    }
}
$inputs_html =<<<HTML
<p>定义事件步骤的用户输入字段<br/>
$inputs_list
<a href="?cmd=$index_inputs_add">增加输入字段</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_inputs_last">返回上级</a><br/>
</p>
HTML;
echo $inputs_html;
?>