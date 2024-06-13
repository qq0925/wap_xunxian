<?php
$boss = \player\getboss($bossid,$dblj);
$pvb = $encode->encode("cmd=pvb&bossid=$bossid&sid=$sid");
$bossinfohtml = <<<HTML
$boss->bossname<br/>
$boss->bossinfo<br/>
<br/>
<a href="?cmd=$pvb">攻击</a><a href="">返回游戏</a> 
HTML;
echo $bossinfohtml;

?>