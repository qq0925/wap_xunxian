<?php
$gm_game_globaleventdefine_input_last = $encode->encode("cmd=game_event_inputs&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$input_post = $encode->encode("cmd=game_event_inputs&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
//$attr_value_2 = htmlspecialchars($attr_value, ENT_QUOTES, 'UTF-8');
$selected = $inputs_type == 1?"selected":"";
$inputs_max_len = $inputs_max_len ? $inputs_max_len :10;
$input_html =<<<HTML
<form action="?cmd=$input_post" method="post">
<input type="hidden" name="step_belong_id" value="$step_belong_id">
<input type="hidden" name="step_id" value="$step_id">
<input name="old_key" type="hidden" value="{$inputs_id}"/>
<input name="old_text" type="hidden" value="{$inputs_text}"/>
<input name="old_max_len" type="hidden" value="{$inputs_max_len}"/>
<input name="old_type" type="hidden" value="{$inputs_type}"/>
字段标识:<input name="key" type="text" value="{$inputs_id}" maxlength="20"/><br/>
字段名称:<input name="text" type="text" value="{$inputs_text}" maxlength="20"/><br/>
最大长度:<input name="max_len" type="text" value="{$inputs_max_len}" maxlength="4"/><br/>
值类型:<select name="type" value="0">
<option value="0">字符串</option>
<option value="1" {$selected}>数值</option>
</select><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_game_globaleventdefine_input_last">返回字段列表</a><br/>
HTML;
echo $input_html;
?>