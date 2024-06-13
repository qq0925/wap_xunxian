
<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_game_globaleventdefine_1 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=1&sid=$sid");
$gm_game_globaleventdefine_2 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=2&sid=$sid");
$gm_game_globaleventdefine_3 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=3&sid=$sid");
$gm_game_globaleventdefine_4 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=4&sid=$sid");
$gm_game_globaleventdefine_5 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=5&sid=$sid");

$gm_html = <<<HTML
<p>[公共事件定义]</p>
<a href="?cmd=$gm_game_globaleventdefine_1">玩家事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_2">电脑人物事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_3">物品事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_4">场景事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_5">系统事件</a><br/><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>