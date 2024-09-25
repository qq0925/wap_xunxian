<?php


if($_POST &&$add ==0){
    $gm_event_cmmt = htmlspecialchars($cmmt);
    $gm_event_cmmt_2 = htmlspecialchars($cmmt2);
    $sql = "UPDATE system_event_evs_self SET cond = '$cond', exec_cond = '$exec_cond',
    cmmt = '$gm_event_cmmt',cmmt2 = '$gm_event_cmmt_2', not_return_link = '$not_return_link',
    just_return = '$just_return', view_user_exp = '$view_user_exp', page_name = '$page_name', 
    refresh_scene_npcs = '$refresh_scene_npcs', refresh_scene_items = '$refresh_scene_items' WHERE belong ='$event_id' and id = '$step_id'";
    // var_dump($sql);
    $cxjg = $dblj->exec($sql);
    echo "修改成功!<br/>";
}

if($add ==1){
    $sql = "INSERT INTO system_event_evs_self set id = '$max_id',belong = '$event_id';";
    $cxjg =$dblj->exec($sql);
    $sql = "SELECT link_evs FROM system_event_self WHERE `id` = '$event_id'";
    $stmt = $dblj->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $link_evs = $rows[0]['link_evs'];
    if (empty($link_evs)) {
        $link_evs = $max_id;
    } else {
        $link_evs .= ',' . $max_id;
    }
    $sql = "UPDATE system_event_self SET link_evs = '$link_evs' WHERE `id` = '$event_id'";
    $cxjg =$dblj->exec($sql);
    $step_id = $max_id;
    $add = 0;
}

$query = "SELECT `desc`,link_evs FROM system_event_self WHERE `id` = '$event_id'";
$stmt = $dblj->query($query);
// 获取结果
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$event_name = $row['desc'];
$event_link_evs = $row['link_evs'];
$event_link_evs = explode(',',$event_link_evs);
$step_index = array_search($step_id, $event_link_evs) + 1;



$query = "SELECT * FROM system_event_evs_self WHERE `id` = :id and `belong` = :belong_id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $step_id);
$stmt->bindParam(':belong_id', $event_id);
$stmt->execute();

// 获取结果
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$step_belong = $row['belong'];
$step_id = $row['id'];
$step_cond = $row['cond'];
$step_exec_cond = $row['exec_cond'];
$step_cmmt = $row['cmmt'];
$step_cmmt2 = $row['cmmt2'];
$step_not_return_link = $row['not_return_link'];
$step_just_return = $row['just_return'];
$step_a_adopt = $row['a_adopt'];
$step_r_adopt = $row['r_adopt'];
    $s_attrs_count = 0;
    if (!empty($row['s_attrs'])) {
    $s_attrs_count = explode(',', $row['s_attrs']);
    $s_attrs_count = count($s_attrs_count);
}

    $m_attrs_count = 0;
    if (!empty($row['m_attrs'])) {
    $m_attrs_count = explode(',', $row['m_attrs']);
    $m_attrs_count = count($m_attrs_count);
}

    $items_count = 0;
    if (!empty($row['items'])) {
    $items_count = explode(',', $row['items']);
    $items_count = count($items_count);
}

    $a_skills_count = 0;
    if (!empty($row['a_skills'])) {
    $a_skills_count = explode(',', $row['a_skills']);
    $a_skills_count = count($a_skills_count);
}

    $r_skills_count = 0;
    if (!empty($row['r_skills'])) {
    $r_skills_count = explode(',', $row['r_skills']);
    $r_skills_count = count($r_skills_count);
}

    $r_tasks_count = 0;
    if (!empty($row['r_tasks'])) {
    $r_tasks_count = explode(',', $row['r_tasks']);
    $r_tasks_count = count($r_tasks_count);
}

    $r_fight_count = 0;
    if (!empty($row['fight_npcs'])) {
    $r_fight_count = explode(',', $row['fight_npcs']);
    $r_fight_count = count($r_fight_count);
}

    $dests_count = 0;
    if (!empty($row['dests'])) {
    $dests_count = explode(',', $row['dests']);
    $dests_count = count($dests_count);
}

    $inputs_count = 0;
    if (!empty($row['inputs'])) {
    $inputs_count = explode(',', $row['inputs']);
    $inputs_count = count($inputs_count);
}

    $a_adopt_count = 0;
    if (!empty($row['a_adopt'])) {
    $a_adopt_count = explode(',', $row['a_adopt']);
    $a_adopt_count = count($a_adopt_count);
}

    $r_adopt_count = 0;
    if (!empty($row['r_adopt'])) {
    $r_adopt_count = explode(',', $row['r_adopt']);
    $r_adopt_count = count($r_adopt_count);
}


    $step_view_user_exp = $row['view_user_exp'];
    $step_page_name = $row['page_name'];
    $step_refresh_scene_npcs = $row['refresh_scene_npcs'];
    $step_refresh_scene_items = $row['refresh_scene_items'];
    $gm_select_1 = $step_not_return_link ==1?"selected":"";
    $gm_select_2 = $step_just_return ==1?"selected":"";
    
$gm_main = $encode->encode("cmd=game_event_page_2&event_id=$event_id&sid=$sid");
$gm_game_selfeventdefine_attrset = $encode->encode("cmd=game_event_attrset_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_attrchange = $encode->encode("cmd=game_event_attrchange_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_itemchange = $encode->encode("cmd=game_event_itemchange_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_skilladd = $encode->encode("cmd=game_event_skilladd_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_skillremove = $encode->encode("cmd=game_event_skillremove_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_taskremove = $encode->encode("cmd=game_event_taskremove_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_scenemove = $encode->encode("cmd=game_event_destsadd_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_inputs = $encode->encode("cmd=game_event_inputs_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_fightchange = $encode->encode("cmd=game_event_fight_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$gm_game_selfeventdefine_petadd = $encode->encode("cmd=game_event_pet_self&event_id=$event_id&step_id=$step_id&sid=$sid");

$gm_html =<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<p>定义事件[{$event_name}](id:{$event_id})的步骤{$step_index}<br/>
</p>
<form method="post">
<input type="hidden" name="step_id" value="$step_id">
<input type="hidden" name="event_id" value="$event_id">
<input type="hidden" name="add" value="0">
触发条件:<textarea name="cond" maxlength="4096" rows="4" cols="40">$step_cond</textarea><br/>
执行条件:<textarea name="exec_cond" maxlength="4096" rows="4" cols="40">$step_exec_cond</textarea><br/>
触发时提示语:<textarea name="cmmt" maxlength="4096" rows="4" cols="40">$step_cmmt</textarea><button type="button" onclick="insertTextAtCursor()">插入「」</button><br/>
不满足条件提示语:<textarea name="cmmt2" maxlength="4096" rows="4" cols="40">$step_cmmt2</textarea><br/>
返回游戏链接:<select name="not_return_link" value="$step_not_return_link">
<option value="0">允许</option>
<option value="1" {$gm_select_1}>不允许</option>
</select><br/>
执行此步骤后立刻返回:<select name="just_return" value="$step_just_return">
<option value="0" >否</option>
<option value="1" {$gm_select_2}>是</option>
</select><br/>
设置属性:<a href="?cmd=$gm_game_selfeventdefine_attrset">修改({$s_attrs_count})</a><br/>
更改属性:<a href="?cmd=$gm_game_selfeventdefine_attrchange">修改({$m_attrs_count})</a><br/>
更改物品:<a href="?cmd=$gm_game_selfeventdefine_itemchange">修改({$items_count})</a><br/>
学会技能:<a href="?cmd=$gm_game_selfeventdefine_skilladd">修改({$a_skills_count})</a><br/>
废除技能:<a href="?cmd=$gm_game_selfeventdefine_skillremove">修改({$r_skills_count})</a><br/>
触发任务:<a href="">修改(0)</a>！！<br/>
删除任务:<a href="?cmd=$gm_game_selfeventdefine_taskremove">修改({$r_tasks_count})</a><br/>
挑战人物:<a href="?cmd=$gm_game_selfeventdefine_fightchange">修改({$r_fight_count})</a><br/>
收养宠物对象:<a href="?cmd=$gm_game_selfeventdefine_petadd">添加({$a_adopt_count})</a><br/>
删除宠物对象:<a href="">添加({$r_adopt_count})</a><br/>
移动目标:<a href="?cmd=$gm_game_selfeventdefine_scenemove">修改({$dests_count})</a><br/>
查看玩家的ID表达式:<textarea name="view_user_exp" maxlength="4096" rows="4" cols="40">$step_view_user_exp</textarea><br/>
显示页面模板:<input name="page_name" type="text" maxlength="20" value="{$step_page_name}"><br/>
刷新场景NPC:<input name="refresh_scene_npcs" type="text" value="$step_refresh_scene_npcs"/><br/>
刷新场景物品:<input name="refresh_scene_items" type="text" value="$step_refresh_scene_items"/><br/>
用户输入:<a href="?cmd=$gm_game_selfeventdefine_inputs">修改({$inputs_count})</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
HTML;
echo $gm_html;

?>