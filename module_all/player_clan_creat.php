<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$player_uid = \player\getplayer($sid,$dblj)->uid;
$cmid = $cmid + 1;
$cdid[] = $cmid;

$creat_sure = $encode->encode("cmd=player_clan&ucmd=$cmid&sid=$sid");

$clan_html = <<<HTML
<form action="?cmd=$creat_sure" method = "post">【创建帮派】<br/>
<input type="hidden" name="clan_master" value="{$player_uid}">
<input type="hidden" name="ucmd" value="{$cmid}">
帮派名字: <input name = "clan_name" type = "text"/><br/>
帮派宣言: <textarea type="text" name="clan_desc" rows="4" cols="20"></textarea><br/>
<input style="height:25px;"name = "creat" type = "submit" title = "创建帮派" value="创建帮派" /><br/><br/>
</form>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;

echo $clan_html;

?>