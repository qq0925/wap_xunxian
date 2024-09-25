<?php

if(!empty($_POST)){
$key=$_POST['item_id'];
$old_count=$_POST['old_count'];
$count=$_POST['value'];
$step_belong_id=$_POST['step_belong_id'];
$step_id=$_POST['step_id'];
$string_old = $key."|".$old_count;
$string_new = $key."|".$count;
}
if($change && !empty($key)){
// 准备 SQL 查询语句，使用占位符代替变量
$query = "UPDATE system_event_evs SET items = REPLACE(items, :old_value, :new_value) WHERE belong = :belong AND id = :id";
// 准备并执行预处理语句
$stmt = $dblj->prepare($query);
// 绑定参数值
$stmt->bindParam(':old_value', $string_old);
$stmt->bindParam(':new_value', $string_new);
$stmt->bindParam(':belong', $step_belong_id);
$stmt->bindParam(':id', $step_id);
// 执行查询
$stmt->execute();
}elseif($add && !empty($key)){
// 检查 items 字段是否为空
$query = "SELECT items FROM system_event_evs where belong = '$step_belong_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['items'])) {
    // items 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs SET items = :new_value where belong = '$step_belong_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
} else {
    // items 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs SET items = CONCAT(items, ',', :new_value) where belong = '$step_belong_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}
}
if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT items FROM system_event_evs WHERE belong = '$step_belong_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $items = $row['items'];
} else {
    echo "查询失败";
}
$string_old = $remove_id."|".$remove_count;
$elements = explode(",", $items);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs SET items = :newstring WHERE belong = '$step_belong_id' and id = '$step_id'";

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


// 查询 system_event_evs 表获取 items 字段的值
$query = "SELECT items FROM system_event_evs where belong = '$step_belong_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_globaleventdefine_item_last = $encode->encode("cmd=gm_game_globaleventdefine_steps&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_item_add = $encode->encode("cmd=game_event_itemadd&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
if($rows){
$row = explode(',',$rows['items']);
foreach ($row as $row_detail){
$i++;
$row_para = explode('|',$row_detail);
if($row_para[0] !=''){
$item_id = $row_para[0];
$item_count = $row_para[1];
$item_post_count = urlencode($item_count);
$sql = "SELECT * from system_item_module where iid = '$item_id'";
$stmt = $dblj->query($sql);
$item_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$item_name = $item_rows['iname'];
$item_change = $encode->encode("cmd=game_event_itemchange&item_id=$item_id&item_name=$item_name&item_count=$item_post_count&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$item_remove = $encode->encode("cmd=game_event_itemchange&change=1&remove_id=$item_id&remove_count=$item_post_count&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$item_list .=<<<HTML
<a href="?cmd=$item_change">{$i}.{$item_name}({$item_count})</a><a href="?cmd=$item_remove">移除</a><br/>
HTML;
}
    }
}
$item_html =<<<HTML
<p>定义事件步骤的更改物品<br/>
$item_list
<a href="?cmd=$index_item_add">增加物品</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_item_last">返回上级</a><br/>
</p>
HTML;
echo $item_html;
?>