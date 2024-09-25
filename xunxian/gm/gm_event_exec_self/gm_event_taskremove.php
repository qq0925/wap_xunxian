<?php


if($task_remove_id){
// 检查 r_tasks 字段是否为空
$query = "SELECT r_tasks FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['r_tasks'])) {
    // r_tasks 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs_self SET r_tasks = :new_value where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $task_remove_id);
    $stmt->execute();
} elseif(!in_array($task_remove_id, explode(',',$result['r_tasks']))) {
    // r_tasks 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs_self SET r_tasks = CONCAT(r_tasks, ',', :new_value) where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $task_remove_id);
    $stmt->execute();
}
}
if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT r_tasks FROM system_event_evs_self WHERE belong = '$event_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $r_tasks = $row['r_tasks'];
} else {
    echo "查询失败";
}
$string_old = $remove_id;
$elements = explode(",", $r_tasks);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET r_tasks = :newstring WHERE belong = '$event_id' and id = '$step_id'";

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


// 查询 system_event_evs_self 表获取 r_tasks 字段的值
$query = "SELECT r_tasks FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_task_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_task_add = $encode->encode("cmd=game_event_taskremove_self&add=1&event_id=$event_id&step_id=$step_id&sid=$sid");
if($rows){
$row = explode(',',$rows['r_tasks']);
foreach ($row as $row_para){
$i++;
if($row_para!=''){
$task_id = $row_para;
$sql = "SELECT * from system_task where tid = '$task_id'";
$stmt = $dblj->query($sql);
$task_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$task_name = $task_rows['tname'];
$task_remove = $encode->encode("cmd=game_event_taskremove_self&change=1&remove_id=$task_id&event_id=$event_id&step_id=$step_id&sid=$sid");
$task_list .=<<<HTML
{$i}.{$task_name}<a href="?cmd=$task_remove">移除</a><br/>
HTML;
}
    }
}
$task_html =<<<HTML
<p>定义事件步骤的删除任务<br/>
$task_list
<a href="?cmd=$index_task_add">增加任务</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_task_last">返回上级</a><br/>
</p>
HTML;
echo $task_html;
?>