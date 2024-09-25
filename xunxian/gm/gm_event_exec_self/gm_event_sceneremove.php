<?php

if($midexp){
    $mid = $mid;
}

if($mid){
// 检查 dests 字段是否为空
$query = "SELECT dests FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['dests'])) {
    // dests 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs_self SET dests = :new_value where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $mid);
    $stmt->execute();
} elseif(!in_array($mid, explode(',',$result['dests']))) {
    // dests 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs_self SET dests = CONCAT(dests, ',', :new_value) where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $mid);
    $stmt->execute();
}
}
if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT dests FROM system_event_evs_self WHERE belong = '$event_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $dests = $row['dests'];
} else {
    echo "查询失败";
}
$string_old = $remove_id;
$elements = explode(",", $dests);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET dests = :newstring WHERE belong = '$event_id' and id = '$step_id'";

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


// 查询 system_event_evs_self 表获取 dests 字段的值
$query = "SELECT dests FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_dests_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_dests_add = $encode->encode("cmd=game_event_destsadd_self&scene_post_canshu=1&event_id=$event_id&step_id=$step_id&sid=$sid");
$index_dests_addexp = $encode->encode("cmd=game_event_destsadd_self&scene_post_canshu=3&event_id=$event_id&step_id=$step_id&sid=$sid");
if($rows){
$row = explode(',',$rows['dests']);
foreach ($row as $row_para){
$i++;
if($row_para!=''){
$dests_id = $row_para;
$sql = "SELECT * from system_map where mid = '$dests_id'";
$stmt = $dblj->query($sql);
$dests_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$dests_name = $dests_rows['mname'];
if(!$dests_name){
    $dests_name = $dests_id;
}
$dests_remove = $encode->encode("cmd=game_event_destsadd_self&remove_id=$dests_id&event_id=$event_id&step_id=$step_id&sid=$sid");
$dests_list .=<<<HTML
{$i}.{$dests_name}<a href="?cmd=$dests_remove">移除</a><br/>
HTML;
}
    }
}
$dests_html =<<<HTML
<p>定义事件步骤的移动目标<br/>
$dests_list
<a href="?cmd=$index_dests_add">增加场景</a><br/>
<a href="?cmd=$index_dests_addexp">增加场景表达式</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_dests_last">返回上级</a><br/>
</p>
HTML;
echo $dests_html;
?>