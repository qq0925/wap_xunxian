<?php

if($_POST &&$add ==0){
    $gm_event_cmmt = htmlspecialchars($cmmt);
    $gm_event_cmmt_2 = htmlspecialchars($cmmt2);
    $sql = "UPDATE system_event_evs SET cond = '$cond', exec_cond = '$exec_cond',
    cmmt = '$gm_event_cmmt',cmmt2 = '$gm_event_cmmt_2', not_return_link = '$not_return_link',
    just_return = '$just_return', view_user_exp = '$view_user_exp', page_name = '$page_name', 
    refresh_scene_npcs = '$refresh_scene_npcs', refresh_scene_items = '$refresh_scene_items' WHERE belong ='$step_belong_id' and id = '$step_id'";
    $cxjg = $dblj->exec($sql);
    echo "修改成功!<br/>";
}
if($add ==1){
    $sql = "INSERT INTO system_event_evs set id = '$step_id',belong = '$step_belong_id';";
    $cxjg =$dblj->exec($sql);
    $sql = "SELECT link_evs FROM system_event WHERE `id` = '$step_belong_id'";
    $stmt = $dblj->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $link_evs = $rows[0]['link_evs'];
    if (empty($link_evs)) {
        $link_evs = $step_id;
    } else {
        $link_evs .= ',' . $step_id;
    }
    $sql = "UPDATE system_event SET link_evs = '$link_evs' WHERE `id` = '$step_belong_id'";
    $cxjg =$dblj->exec($sql);
    $add = 0;
}

$query = "SELECT link_evs FROM system_event WHERE `id` = :id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $step_belong_id);
$stmt->execute();
$step_rows = $stmt->fetch(PDO::FETCH_ASSOC);
$step_rows_evs = $step_rows['link_evs'];
$step_array = explode(",", $step_rows_evs);
$step_search = $step_id;
$step_position = array_search($step_search, $step_array);
if ($position !== false) {
    $step_index = $step_position + 1;
}


$query = "SELECT * FROM system_event_evs WHERE `id` = :id and `belong` = :belong_id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $step_id);
$stmt->bindParam(':belong_id', $step_belong_id);
$stmt->execute();

// 获取结果
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
if($rows) {
    $event_belong = $rows['belong'];
    $event_id = $rows['id'];
    $event_cond = $rows['cond'];
    $event_exec_cond = $rows['exec_cond'];
    $event_cmmt = $rows['cmmt'];
    $event_cmmt2 = $rows['cmmt2'];
    $event_not_return_link = $rows['not_return_link'];
    $event_just_return = $rows['just_return'];
    $event_a_adopt = $rows['a_adopt'];
    $event_r_adopt = $rows['r_adopt'];
    $s_attrs_count = 0;
    if (!empty($rows['s_attrs'])) {
    $s_attrs_count = explode(',', $rows['s_attrs']);
    $s_attrs_count = count($s_attrs_count);
}

    $m_attrs_count = 0;
    if (!empty($rows['m_attrs'])) {
    $m_attrs_count = explode(',', $rows['m_attrs']);
    $m_attrs_count = count($m_attrs_count);
}

    $items_count = 0;
    if (!empty($rows['items'])) {
    $items_count = explode(',', $rows['items']);
    $items_count = count($items_count);
}

    $a_skills_count = 0;
    if (!empty($rows['a_skills'])) {
    $a_skills_count = explode(',', $rows['a_skills']);
    $a_skills_count = count($a_skills_count);
}

    $r_skills_count = 0;
    if (!empty($rows['r_skills'])) {
    $r_skills_count = explode(',', $rows['r_skills']);
    $r_skills_count = count($r_skills_count);
}

    $r_tasks_count = 0;
    if (!empty($row['r_tasks'])) {
    $r_tasks_count = explode(',', $row['r_tasks']);
    $r_tasks_count = count($r_tasks_count);
}

    $dests_count = 0;
    if (!empty($rows['dests'])) {
    $dests_count = explode(',', $rows['dests']);
    $dests_count = count($dests_count);
}

    $inputs_count = 0;
    if (!empty($rows['inputs'])) {
    $inputs_count = explode(',', $rows['inputs']);
    $inputs_count = count($inputs_count);
}

    $a_adopt_count = 0;
    if (!empty($rows['a_adopt'])) {
    $a_adopt_count = explode(',', $rows['a_adopt']);
    $a_adopt_count = count($a_adopt_count);
}

    $r_adopt_count = 0;
    if (!empty($rows['r_adopt'])) {
    $r_adopt_count = explode(',', $rows['r_adopt']);
    $r_adopt_count = count($r_adopt_count);
}


    $event_view_user_exp = $rows['view_user_exp'];
    $event_page_name = $rows['page_name'];
    $event_refresh_scene_npcs = $rows['refresh_scene_npcs'];
    $event_refresh_scene_items = $rows['refresh_scene_items'];
    $gm_select_1 = $event_not_return_link ==1?"selected":"";
    $gm_select_2 = $event_just_return ==1?"selected":"";
}


$gm_main = $encode->encode("cmd=game_event_page_1&gm_post_canshu_2=$step_belong_id&sid=$sid");
$gm_game_globaleventdefine_attrset = $encode->encode("cmd=game_event_attrset&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_attrchange = $encode->encode("cmd=game_event_attrchange&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_itemchange = $encode->encode("cmd=game_event_itemchange&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_skilladd = $encode->encode("cmd=game_event_skilladd&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_skillremove = $encode->encode("cmd=game_event_skillremove&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_scenemove = $encode->encode("cmd=game_event_destsadd&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_inputs = $encode->encode("cmd=game_event_inputs&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");
$gm_game_globaleventdefine_petadd = $encode->encode("cmd=game_event_pet&step_belong_id=$event_belong&step_id=$event_id&sid=$sid");


$gm_html =<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<p>定义事件[id:{$step_belong_id}]的步骤{$step_index}<br/>
</p>
<form method="post">
<input type="hidden" name="step_id" value="$event_id">
<input type="hidden" name="add" value="0">
<input type="hidden" name="step_belong_id" value="$event_belong">
触发条件:<textarea name="cond" maxlength="4096" rows="4" cols="40">{$event_cond}</textarea><br/>
执行条件:<textarea name="exec_cond" maxlength="4096" rows="4" cols="40">{$event_exec_cond}</textarea><br/>
触发时提示语:<textarea name="cmmt" maxlength="4096" rows="4" cols="40">{$event_cmmt}</textarea><button type="button" onclick="insertTextAtCursor()">插入「」</button><br/>
不满足条件提示语:<textarea name="cmmt2" maxlength="1024" rows="4" cols="40">{$event_cmmt2}</textarea><br/>
返回游戏链接:<select name="not_return_link" value="$event_not_return_link">
<option value="0" >允许</option>
<option value="1" {$gm_select_1}>不允许</option>
</select><br/>
执行此步骤后立刻返回:<select name="just_return" value="$event_just_return">
<option value="0" >否</option>
<option value="1" {$gm_select_2}>是</option>
</select><br/>
设置属性:<a href="?cmd=$gm_game_globaleventdefine_attrset">修改({$s_attrs_count})</a><br/>
更改属性:<a href="?cmd=$gm_game_globaleventdefine_attrchange">修改({$m_attrs_count})</a><br/>
更改物品:<a href="?cmd=$gm_game_globaleventdefine_itemchange">修改({$items_count})</a><br/>
学会技能:<a href="?cmd=$gm_game_globaleventdefine_skilladd">修改({$a_skills_count})</a><br/>
废除技能:<a href="?cmd=$gm_game_globaleventdefine_skillremove">修改({$r_skills_count})</a><br/>
触发任务:<a href="">修改(0)</a><br/>
删除任务:<a href="">修改({$r_tasks_count})</a><br/>
挑战人物:<a href="">增加</a><br/>
收养宠物对象:<a href="?cmd=$gm_game_globaleventdefine_petadd">添加({$a_adopt_count})</a><br/>
删除宠物对象:<a href="">添加({$r_adopt_count})</a><br/>
移动目标:<a href="?cmd=$gm_game_globaleventdefine_scenemove">修改({$dests_count})</a><br/>
查看玩家的ID表达式:<textarea name="view_user_exp" maxlength="4096" rows="4" cols="40">$event_view_user_exp</textarea><br/>
显示页面模板:<input name="page_name" type="text" maxlength="20" value="$event_page_name"/><br/>
刷新场景NPC:<input name="refresh_scene_npcs" type="text" value="$event_refresh_scene_npcs"/><br/>
刷新场景物品:<input name="refresh_scene_items" type="text" value="$event_refresh_scene_items"/><br/>
用户输入:<a href="?cmd=$gm_game_globaleventdefine_inputs">修改({$inputs_count})</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
HTML;
echo $gm_html;

?>