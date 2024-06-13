<?php
if($gm_npc_canshu == "1"){
$post_tishi = '修改成功';
}

if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT ntask_target FROM system_npc where nid= '$task_tnpc_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $ntask_target = $row['ntask_target'];
} else {
    echo "查询失败";
}
$string_old = $remove_id;
$elements = explode(",", $ntask_target);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_npc SET ntask_target = :newstring where nid= '$task_tnpc_id'";

// 准备并执行预处理语句
$stmt = $dblj->prepare($query);

// 绑定参数值
$stmt->bindParam(':newstring', $newString);

$query = "delete from system_task where tnpc_id = '$task_tnpc_id' and tid = '$remove_id'";
$dblj->exec($query);

$sql = "SELECT id from system_event_self where belong = '$remove_id' and module_id = 'npc_task_accept' || module_id = 'npc_task_giveup' || module_id = 'npc_task_finish'";
$cxjg=$dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$event_id = $ret['id'];
$query = "delete from system_event_evs_self where belong = '$event_id'";
$dblj->exec($query);

$query = "delete from system_event_self where belong = '$remove_id' and module_id = 'npc_task_accept'";
$dblj->exec($query);
$query = "delete from system_event_self where belong = '$remove_id' and module_id = 'npc_task_giveup'";
$dblj->exec($query);
$query = "delete from system_event_self where belong = '$remove_id' and module_id = 'npc_task_finish'";
$dblj->exec($query);
$npc_id = $task_tnpc_id;
// 执行更新
if ($stmt->execute()) {
    echo "更新成功";
} else {
    echo "更新失败";
}
}


$area_main = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
$gm_npc_post = $encode->encode("cmd=gm_task_submit&gm_npc_canshu=1&sid=$sid");


if($now_pos !=0 && $next_pos !=0){
    echo "操作成功！<br/>";
    $query = "SELECT ntask_target FROM system_npc WHERE `nid` = '$npc_id'";
    $stmt = $dblj->query($query);
    // 获取结果
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $event_link_evs = $row['ntask_target'];
    $event_link_evs = explode(',',$event_link_evs);
    $nowposIndex = array_search($now_pos, $event_link_evs);
    $nextposIndex = array_search($next_pos, $event_link_evs);
    $temp = $event_link_evs[$nowposIndex];
    $event_link_evs[$nowposIndex] = $event_link_evs[$nextposIndex];
    $event_link_evs[$nextposIndex] = $temp;
    $newString = implode(",", $event_link_evs);
    $sql = "update system_npc set ntask_target = '$newString' where `nid` = '$npc_id'";
    $dblj->exec($sql);
}



$sql = "SELECT * FROM system_npc WHERE nid = :nid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':nid', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];
$npc_task_list = $row['ntask_target'];
$tasks = explode(",",$npc_task_list);
if($npc_task_list){
for ($i = 0; $i < @count($tasks); $i++){
        $task = $tasks[$i];
        $index = $i + 1;
        $sql = "SELECT * FROM system_task WHERE tid = :id";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':id', $task,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $task_name = $row['tname'];
        $task_id = $row['tid'];
        $task_tnpc_id = $row['tnpc_id'];
        $task_list_detail = $encode->encode("cmd=system_task_detail&task_id=$task_id&sid=$sid");
        $task_delete = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&task_tnpc_id=$task_tnpc_id&remove_id=$task_id&sid=$sid");
        $hangshu += 1;
        $task_list .=<<<HTML
        <a href="?cmd=$task_list_detail">{$hangshu}.{$task_name}</a><a href = "?cmd=$task_delete">删除</a>
HTML;
    if($index ==1 && count($tasks)>1){
    $next_pos = $tasks[1];
    $move_next = $encode->encode("cmd=gm_type_npc&npc_id=$npc_id&now_pos=$task_id&next_pos=$next_pos&gm_post_canshu=4&sid=$sid");
    $task_list .=<<<HTML
    [ <font color ="red">上移</font> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}elseif ($index ==count($tasks) && count($tasks)>1) {
    $next_pos = $tasks[$index -2];
    $move_last = $encode->encode("cmd=gm_type_npc&npc_id=$npc_id&now_pos=$task_id&next_pos=$next_pos&gm_post_canshu=4&sid=$sid");
    $task_list .=<<<HTML
    [ <a href="?cmd=$move_last">上移</a> <font color ="red">下移</font> ]<br/>
HTML;
}elseif($index !=1 && $index !=count($tasks) && count($tasks)>1){
    $last_pos = $tasks[$index -2];
    $next_pos = $tasks[$index];
    $move_last = $encode->encode("cmd=gm_type_npc&npc_id=$npc_id&now_pos=$task_id&next_pos=$last_pos&gm_post_canshu=4&sid=$sid");
    $move_next = $encode->encode("cmd=gm_type_npc&npc_id=$npc_id&now_pos=$task_id&next_pos=$next_pos&gm_post_canshu=4&sid=$sid");
    $task_list .=<<<HTML
    [ <a href="?cmd=$move_last">上移</a> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}else{
    $task_list .=<<<HTML
    [ <font color ="red">上移 下移</font> ]<br/>
HTML;
}
            }
}

$sql = "SELECT MAX(tid) AS max_id FROM system_task;";
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(PDO::FETCH_ASSOC);
$max_id = $row['max_id'] +1;
$add_task = $encode->encode("cmd=system_task_detail&task_tnpc_id=$npc_id&add=1&max_id=$max_id&sid=$sid");
$npc_task_list =<<<HTML
<p>定义npc“{$npc_name}”的任务<br/>
{$task_list}
<a href="?cmd=$add_task">增加任务</a><br/>
<a href="?cmd=$area_main">返回上级</a><br/>
</p>
HTML;

echo $npc_task_list;
?>