<?php


$query = "SELECT * FROM system_event_evs WHERE `id` = :id and `belong` = :belong_id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $gm_post_canshu);
$stmt->bindParam(':belong_id', $gm_belong_id);
$stmt->execute();

// 获取结果
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    $event_belong = $row['belong'];
    $event_id = $row['id'];
    $event_cond = $row['cond'];
    $event_exec_cond = $row['exec_cond'];
    $event_cmmt = $row['cmmt'];
    $event_cmmt2 = $row['cmmt2'];
    $event_not_return_link = $row['not_return_link'];
    $event_just_return = $row['just_return'];
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

    
    $event_view_user_exp = $row['view_user_exp'];
    $event_page_name = $row['page_name'];
    $event_refresh_scene_npcs = $row['refresh_scene_npcs'];
    $event_refresh_scene_items = $row['refresh_scene_items'];
    if($event_not_return_link=="0"){
    $gm_select_0 = "selected";
}elseif ($event_not_return_link=="1") {
    $gm_select_1 = "selected";
}

    if($event_just_return=="0"){
    $gm_select_2 = "selected";
}elseif ($event_just_return=="1") {
    $gm_select_3 = "selected";
}





}

$query = "SELECT `desc` FROM system_event WHERE `id` = $event_belong";
$stmt = $dblj->query($query);
// 获取结果
$rows_2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows_2 as $row_2) {
    $gm_post_canshu_3 = $row_2['desc'];
}


$gm_main = $encode->encode("cmd=game_event_page_1&gm_post_canshu=1&gm_post_canshu_2=1&gm_post_canshu_3=$gm_post_canshu_3&sid=$sid");
$gm_game_globaleventdefine_attrset = $encode->encode("cmd=game_event_attrset&gm_post_canshu=$event_belong&gm_post_canshu_2=$event_id&sid=$sid");
$gm_game_globaleventdefine_attrchange = $encode->encode("cmd=game_event_attrchange&gm_post_canshu=$event_belong&gm_post_canshu_2=$event_id&sid=$sid");

$gm_html =<<<HTML
<p>定义事件[id:{$event_belong}]的步骤{$step_index}<br/>
</p>
<form>
<input type="hidden" name="cmd" value="gm_event_step_post">
<input type="hidden" name="gm_post_canshu" value="$gm_post_canshu">
<input type="hidden" name="gm_belong_id" value="$event_belong">
<input type="hidden" name="sid" value="$sid">
触发条件:<textarea name="cond" maxlength="4096" rows="4" cols="40">$event_cond</textarea><br/>
执行条件:<textarea name="exec_cond" maxlength="4096" rows="4" cols="40">$event_exec_cond</textarea><br/>
触发时提示语:<textarea name="cmmt" maxlength="4096" rows="4" cols="40">$event_cmmt</textarea><br/>
不满足条件提示语:<textarea name="cmmt2" maxlength="4096" rows="4" cols="40">$event_cmmt2</textarea><br/>
返回游戏链接:<select name="not_return_link" value="$event_not_return_link">
<option value="0" $gm_select_0>允许</option>
<option value="1" $gm_select_1>不允许</option>
</select><br/>
执行此步骤后立刻返回:<select name="just_return" value="$event_just_return">
<option value="0" $gm_select_2>否</option>
<option value="1" $gm_select_3>是</option>
</select><br/>
设置属性:<a href="?cmd=$gm_game_globaleventdefine_attrset">修改({$s_attrs_count})</a><br/>
更改属性:<a href="?cmd=$gm_game_globaleventdefine_attrchange">修改({$m_attrs_count})</a><br/>
更改物品:<a href="">修改(0)</a><br/>
学会技能:<a href="">修改(0)</a><br/>
废除技能:<a href="">修改(0)</a><br/>
触发任务:<a href="">修改(0)</a><br/>
删除任务:<a href="">修改(0)</a><br/>
删除已完成任务:<a href="">修改(0)</a><br/>
删除已放弃任务:<a href="">修改(0)</a><br/>
挑战人物:<a href="">增加</a><br/>
收养宠物对象:<a href="">添加</a><br/>
删除宠物对象:<a href="">添加</a><br/>
移动目标:<a href="">修改(0)</a><br/>
查看玩家的ID表达式:<textarea name="view_user_exp" maxlength="4096" rows="4" cols="40">$event_view_user_exp</textarea><br/>
显示页面模板:<input name="page_name" type="text" maxlength="20" value="$event_page_name"/><br/>
刷新场景NPC:<input name="refresh_scene_npcs" type="text" value="$event_refresh_scene_npcs"/><br/>
刷新场景物品:<input name="refresh_scene_items" type="text" value="$event_refresh_scene_items"/><br/>
用户输入:<a href="">修改(0)</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
HTML;
echo $gm_html;

?>