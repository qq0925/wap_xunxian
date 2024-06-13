<?php


if($skill_add_id){
// 检查 a_skills 字段是否为空
$query = "SELECT a_skills FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['a_skills'])) {
    // a_skills 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs_self SET a_skills = :new_value where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $skill_add_id);
    $stmt->execute();
} elseif(!in_array($skill_add_id, explode(',',$result['a_skills']))) {
    // a_skills 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs_self SET a_skills = CONCAT(a_skills, ',', :new_value) where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $skill_add_id);
    $stmt->execute();
}
}
if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT a_skills FROM system_event_evs_self WHERE belong = '$event_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $a_skills = $row['a_skills'];
} else {
    echo "查询失败";
}
$string_old = $remove_id;
$elements = explode(",", $a_skills);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET a_skills = :newstring WHERE belong = '$event_id' and id = '$step_id'";

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


// 查询 system_event_evs_self 表获取 a_skills 字段的值
$query = "SELECT a_skills FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_skill_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_skill_add = $encode->encode("cmd=game_event_skilladd_self&add=1&event_id=$event_id&step_id=$step_id&sid=$sid");
if($rows){
$row = explode(',',$rows['a_skills']);
foreach ($row as $row_para){
$i++;
if($row_para!=''){
$skill_id = $row_para;
$sql = "SELECT * from system_skill where jid = '$skill_id'";
$stmt = $dblj->query($sql);
$skill_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$skill_name = $skill_rows['jname'];
$skill_remove = $encode->encode("cmd=game_event_skilladd_self&change=1&remove_id=$skill_id&event_id=$event_id&step_id=$step_id&sid=$sid");
$skill_list .=<<<HTML
{$i}.{$skill_name}<a href="?cmd=$skill_remove">移除</a><br/>
HTML;
}
    }
}
$skill_html =<<<HTML
<p>定义事件步骤的学会技能<br/>
$skill_list
<a href="?cmd=$index_skill_add">增加技能</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_skill_last">返回上级</a><br/>
</p>
HTML;
echo $skill_html;
?>