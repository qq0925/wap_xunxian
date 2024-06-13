<?php
if(!$qy_id){
$gm_game_selfeventdefine_fight_last = $encode->encode("cmd=game_event_fightchange_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$fight_post = $encode->encode("cmd=game_event_fightchange_self&change=1&event_id=$event_id&step_id=$step_id&sid=$sid");
}else{
$gm_game_selfeventdefine_fight_last = $encode->encode("cmd=game_event_fightadd_self&post_canshu=1&qy_id=$qy_id&event_id=$event_id&step_id=$step_id&sid=$sid");
$fight_post = $encode->encode("cmd=game_event_fightchange_self&add=1&event_id=$event_id&step_id=$step_id&sid=$sid");
$npc_count = 1;
}
$npc_count = htmlspecialchars($npc_count, ENT_QUOTES, 'UTF-8');

$gm_html =<<<HTML
<p>设置挑战NPC的数量<br/>
</p>
<form action="?cmd=$fight_post" method="post">
<input type="hidden" name="event_id" value="$event_id">
<input type="hidden" name="step_id" value="$step_id">
<input name="npc_id" type="hidden" value="{$npc_id}"/>
<input name="old_count" type="hidden" value="{$npc_count}">
NPC:{$npc_name}<br/>
数量表达式:<textarea name="value" maxlength="4096" rows="4" cols="40">{$npc_count}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_game_selfeventdefine_fight_last">返回上级</a><br/>
HTML;
echo $gm_html;
?>