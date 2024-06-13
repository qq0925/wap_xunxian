<?php

if($_POST){
$sql = "UPDATE system_event SET cond = :cond, cmmt = :cmmt WHERE `id` = :id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':cond', $cond);
$stmt->bindParam(':cmmt', $cmmt);
$stmt->bindParam(':id', $gm_post_canshu_2);
$stmt->execute();
echo "修改成功！<br/>";
}

if ($if_delete ==1 && !$_POST){
$deleteSql = "DELETE FROM system_event_evs WHERE id = '$step_id' AND belong = '$step_belong_id'";
$deleteStmt = $dblj->exec($deleteSql);
if ($deleteStmt !== false && $deleteStmt !== 0){
$query = "SELECT link_evs FROM system_event WHERE id = '$step_belong_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$link_evs = $stmt->fetchColumn();

// 将 link_evs 字段的值转换为数组
$link_evs_array = explode(',', $link_evs);


// 检查数组是否只有一个元素，并将表置空
if (count($link_evs_array) === 1) {
    $query = "UPDATE system_event SET link_evs = '' WHERE id = '$step_belong_id'";
    $stmt = $dblj->prepare($query);
    $stmt->execute();
}else{
// 要删除的值
$value_to_delete = $step_id;

// 执行删除操作，并更新 link_evs 字段的值
$link_evs_array = array_diff($link_evs_array, [$value_to_delete]);
$new_link_evs = implode(',', $link_evs_array);

$query = "UPDATE system_event SET link_evs = :link_evs WHERE id = '$step_belong_id'";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':link_evs', $new_link_evs);
$stmt->execute();
}
}
}

$sql = "SELECT MAX(id) AS max_id FROM system_event_evs";
$result = $dblj->query($sql);
$pos_row = $result->fetch(\PDO::FETCH_ASSOC);

@$last_pos = $pos_row['max_id'] +1;


$query = "SELECT * FROM system_event WHERE `id` = :id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $gm_post_canshu_2);
$stmt->execute();
$tishi = '';
$i = 0;

// 获取结果
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

$event_belong = $rows['belong'];
switch ($event_belong) {
    case '1':
        $event_type = "玩家";
        break;
    case '2':
        $event_type = "电脑人物";
        break;
    case '3':
        $event_type = "物品";
        break;
    case '4':
        $event_type = "场景";
        break;
    case '5':
        $event_type = "系统";
        break;
    default:
        // code...
        break;
}

$link_evs_array = explode(",", $rows['link_evs']);
if(!$link_evs_array[0]){
@$step_indexs = 0;
}else{
@$step_indexs = count($link_evs_array);
}



$gm_main = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=$event_belong&gm_post_canshu_2=0&sid=$sid");

// 判断 link_evs 的值并输出相应的步骤信息
    if($rows) {
    $link_evs = $rows['link_evs'];
    $event_name = $rows['desc'];
    $event_id = $rows['id'];
    $event_cond = $rows['cond'];
    $event_cmmt = $rows['cmmt'];
    if (!empty($link_evs)) {
    $steps = explode(',', $link_evs);
    for ($i = 1; $i < count($steps) +1; $i++) {
        $step = $steps[$i-1];
        $gm_steps_detail = $encode->encode("cmd=gm_game_globaleventdefine_steps&step_belong_id=$event_id&step_id=$step&sid=$sid");
        $gm_steps_delete = $encode->encode("cmd=game_event_page_1&gm_post_canshu_2=$gm_post_canshu_2&step_belong_id=$event_id&step_id=$step&if_delete=1&sid=$sid");
        $gm_steps .= <<<HTML
        步骤{$i}:<a href="?cmd=$gm_steps_detail">修改</a>
        <a href="?cmd=$gm_steps_delete">删除</a><br/>
HTML;
}
    }
}
$gm_game_globaleventdefine_addsteps = $encode->encode("cmd=gm_game_globaleventdefine_steps&add=1&step_id=$last_pos&step_belong_id=$gm_post_canshu_2&last_pos=$last_pos&sid=$sid");
$gm_game_globaleventdefine_data = $encode->encode("cmd=gm_game_globaleventdefine_data&data_id=$event_id&data_type=events&sid=$sid");

$gm_html =<<<HTML
<p>[公共事件定义]<br/>
[定义{$event_type}公共事件：“{$event_name}”事件(id:{$event_id})]<br/>
</p>
<form method="post"> 
<input name="gm_post_canshu_2" type="hidden" value="{$gm_post_canshu_2}">
触发条件:<textarea name="cond" maxlength="4096" rows="4" cols="40">{$event_cond}</textarea><br/>
不满足条件提示语:<textarea name="cmmt" maxlength="1024" rows="4" cols="40">{$event_cmmt}</textarea><br/>
$gm_steps
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_game_globaleventdefine_addsteps">添加步骤</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_data">查看定义数据</a><br/><br/>
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
</p>
HTML;
echo $gm_html;
?>