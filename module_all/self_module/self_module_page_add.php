<?php
$last_page = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=13&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");
$add_page_sure = $encode->encode("cmd=game_self_page_add&add_canshu=1&sid=$sid");

$add_html =<<<HTML
<form action="?cmd=$add_page_sure" method="post">
模板id(必须以ct_开头)<input name="key" type="text" value="ct_" maxlength="20"/><br/>
模板名称<input name="name" type="text" value="" maxlength="20"/><br/>
<input name="submit" type="submit" title="增加" value="增加"/><input name="submit" type="hidden" title="增加" value="增加"/></form><br/>
<a href="?cmd=$last_page">返回上一级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $add_html;
?>