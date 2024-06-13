<?php
$lexical_test = $encode->encode("cmd=lexical_post&para=post&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");

$gm_html =<<<HTML
<form action="?cmd=$lexical_test" method="post">
测试解析字符串:<textarea name="lexical_text" maxlength="4096" rows="4" cols="40">{$lexical_text }</textarea><br/>
<input type="submit" value="提交">
</form>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $gm_html;


?>