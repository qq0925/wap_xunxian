<?php

if(!empty($_POST)){
$old_key=$_POST['old_key'];
$old_value=$_POST['old_value'];
$key=$_POST['key'];
$value=$_POST['value'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];
$string_old = $old_key."=".$old_value;
$string_new = $key."=".$value;
}
if(!empty($old_key) && !empty($key)){
// 准备 SQL 查询语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET m_attrs = REPLACE(m_attrs, :old_value, :new_value) WHERE belong = :belong AND id = :id";
// 准备并执行预处理语句
$stmt = $dblj->prepare($query);
// 绑定参数值
$stmt->bindParam(':old_value', $string_old);
$stmt->bindParam(':new_value', $string_new);
$stmt->bindParam(':belong', $event_id);
$stmt->bindParam(':id', $step_id);
// 执行查询
$stmt->execute();
}elseif(empty($old_key) && !empty($key)){
// 检查 m_attrs 字段是否为空
$query = "SELECT m_attrs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['m_attrs'])) {
    // m_attrs 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs_self SET m_attrs = :new_value where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
} else {
    // m_attrs 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs_self SET m_attrs = CONCAT(m_attrs, ',', :new_value) where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}
}
elseif(!empty($old_key) && $key ==0){
// 准备 SQL 查询语句
$query = "SELECT m_attrs FROM system_event_evs_self WHERE belong = '$event_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $m_attrs = $row['m_attrs'];
} else {
    echo "查询失败";
}
$elements = explode(",", $m_attrs);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET m_attrs = :newstring WHERE belong = '$event_id' and id = '$step_id'";

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

// 假设你已经连接到数据库并获取了数据

// 查询 system_event_evs_self 表获取 s_attrs 字段的值
$query = "SELECT m_attrs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_attr_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&step_id=$step_id&event_id=$event_id&sid=$sid");
// 输出 HTML 锚点链接
foreach ($rows as $row) {
    $m_attrs = $row['m_attrs'];
    $attrs = explode(',', $m_attrs);
    foreach ($attrs as $index => $attr) {
        $attr = trim($attr);
        $equalPos = strpos($attr, '=');
        $key = substr($attr, 0, $equalPos);
        $value = substr($attr, $equalPos + 1);
        $key = urlencode($key);
        $value = urlencode($value);
        $index_attr = $encode->encode("cmd=game_event_attrchange_2_self&event_id=$event_id&step_id=$step_id&attr_key=$key&attr_value=$value&sid=$sid");
        $index_attr_add = $encode->encode("cmd=game_event_attradd_self&event_id=$event_id&step_id=$step_id&post_type=1&sid=$sid");
        $attr_html .=<<<HTML
        <a href="?cmd=$index_attr">$attr</a><br/>
HTML;
    }
}

// 关闭数据库连接等清理操作

$gm_html =<<<HTML
<p>定义事件步骤的更改属性<br/>
$attr_html
<a href="?cmd=$index_attr_add">增加属性</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_attr_last">返回上级</a><br/>
</p>
HTML;
echo $gm_html;
?>