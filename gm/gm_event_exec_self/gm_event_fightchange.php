<?php

if(!empty($_POST)){
$key=$_POST['npc_id'];
$old_count=$_POST['old_count'];
$count=$_POST['value'];
$event_id=$_POST['event_id'];
$step_id=$_POST['step_id'];
$string_old = $key."|".$old_count;
$string_new = $key."|".$count;
}
if($change && !empty($key)){
// 准备 SQL 查询语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET fight_npcs = REPLACE(fight_npcs, :old_value, :new_value) WHERE belong = :belong AND id = :id";
// 准备并执行预处理语句
$stmt = $dblj->prepare($query);
// 绑定参数值
$stmt->bindParam(':old_value', $string_old);
$stmt->bindParam(':new_value', $string_new);
$stmt->bindParam(':belong', $event_id);
$stmt->bindParam(':id', $step_id);
// 执行查询
$stmt->execute();
}elseif($add && !empty($key)){
// 检查 fight_npcs 字段是否为空
$query = "SELECT fight_npcs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['fight_npcs'])) {
    // fight_npcs 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_event_evs_self SET fight_npcs = :new_value where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
} else {
    // fight_npcs 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_event_evs_self SET fight_npcs = CONCAT(fight_npcs, ',', :new_value) where belong = '$event_id' and id = '$step_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}
}
if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT fight_npcs FROM system_event_evs_self WHERE belong = '$event_id' and id = '$step_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $fight_npcs = $row['fight_npcs'];
} else {
    echo "查询失败";
}
$string_old = $remove_id."|".$remove_count;
$elements = explode(",", $fight_npcs);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_event_evs_self SET fight_npcs = :newstring WHERE belong = '$event_id' and id = '$step_id'";

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


// 查询 system_event_evs_self 表获取 fight_npcs 字段的值
$query = "SELECT fight_npcs FROM system_event_evs_self where belong = '$event_id' and id = '$step_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$gm_game_selfeventdefine_npc_last = $encode->encode("cmd=gm_game_selfeventdefine_steps&event_id=$event_id&step_id=$step_id&sid=$sid");
// 输出 HTML 锚点链接
$index_npc_add = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&sid=$sid");
if($rows){
$row = explode(',',$rows['fight_npcs']);
foreach ($row as $row_detail){
$i++;
$row_para = explode('|',$row_detail);
if($row_para[0] !=''){
$npc_id = $row_para[0];
$npc_count = $row_para[1];
$npc_post_count = urlencode($npc_count);
$sql = "SELECT * from system_npc where nid = '$npc_id'";
$stmt = $dblj->query($sql);
$npc_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$npc_name = $npc_rows['nname'];
$npc_change = $encode->encode("cmd=game_event_fightchange_self&npc_id=$npc_id&npc_name=$npc_name&npc_count=$npc_post_count&event_id=$event_id&step_id=$step_id&sid=$sid");
$npc_remove = $encode->encode("cmd=game_event_fightchange_self&change=1&remove_id=$npc_id&remove_count=$npc_post_count&event_id=$event_id&step_id=$step_id&sid=$sid");
$npc_list .=<<<HTML
<a href="?cmd=$npc_change">{$i}.{$npc_name}({$npc_count})</a><a href="?cmd=$npc_remove">移除</a><br/>
HTML;
}
    }
}
$npc_html =<<<HTML
<p>定义事件步骤的挑战人物<br/>
$npc_list
<a href="?cmd=$index_npc_add">增加人物</a><br/>
<a href="?cmd=$gm_game_selfeventdefine_npc_last">返回上级</a><br/>
</p>
HTML;
echo $npc_html;
?>