<?php
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$zhuangbei = new \player\zhuangbei();
$zhuangbei = player\getzbkzb($zbid,$dblj);

$html = <<<HTML
装备名称:$zhuangbei->zbname<br/>
装备攻击:$zhuangbei->zbgj<br/>
装备防御:$zhuangbei->zbfy<br/>
增加气血:$zhuangbei->zbhp<br/>
装备暴击:$zhuangbei->zbbj%<br/>
装备吸血:$zhuangbei->zbxx%<br/>
装备信息:$zhuangbei->zbinfo<br/><br/>
提示：装备不限制种类！<br/><br/>

<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $html;
?>