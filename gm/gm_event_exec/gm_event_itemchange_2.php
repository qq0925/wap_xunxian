<?php
if(!$item_type){
$gm_game_globaleventdefine_item_last = $encode->encode("cmd=game_event_itemchange&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$item_post = $encode->encode("cmd=game_event_itemchange&canshu=change&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
}else{
$gm_game_globaleventdefine_item_last = $encode->encode("cmd=game_event_itemchange&add_action=1&gm_post_canshu_2=$item_type&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$item_post = $encode->encode("cmd=game_event_itemchange&canshu=add&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$item_count = 1;
}
$item_count = htmlspecialchars($item_count, ENT_QUOTES, 'UTF-8');

$gm_html =<<<HTML
<p>设置物品的数量<br/>
</p>
<form action="?cmd=$item_post" method="post">
<input type="hidden" name="step_belong_id" value="$step_belong_id">
<input type="hidden" name="step_id" value="$step_id">
<input name="item_id" type="hidden" value="{$item_id}"/>
物品:{$item_name}<br/>
数量表达式:<textarea name="new_count" maxlength="4096" rows="4" cols="40">{$item_count}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_game_globaleventdefine_item_last">返回上级</a><br/>
HTML;
echo $gm_html;
?>