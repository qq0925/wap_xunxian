<?php
$boss = \player\getboss($bossid,$dblj);
$player = \player\getplayer($sid,$dblj);
$nowmid=$player->nowmid;
$pgjcmd = $encode->encode("cmd=pvb&canshu=ptgj&bossid=$bossid&sid=$sid");
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$player->sid");
$useyp1 = $encode->encode("cmd=pve&canshu=useyp&ypid=$player->yp1&sid=$sid&gid=$bossid&nowmid=$nowmid");
$useyp2 = $encode->encode("cmd=pve&canshu=useyp&ypid=$player->yp2&sid=$sid&gid=$bossid&nowmid=$nowmid");
$useyp3 = $encode->encode("cmd=pve&canshu=useyp&ypid=$player->yp3&sid=$sid&gid=$bossid&nowmid=$nowmid");
$ypname1 = '药品1';
$ypname2 = '药品2';
$ypname3 = '药品3';
if ($player->yp1!=0){
    $yaopin = \player\getplayeryaopin($player->yp1,$sid,$dblj);
    $ypname1 = $yaopin->ypname.'('.$yaopin->ypsum.')';
}
if ($player->yp2!=0){
    $yaopin = \player\getplayeryaopin($player->yp2,$sid,$dblj);
    $ypname2 = $yaopin->ypname.'('.$yaopin->ypsum.')';
}
if ($player->yp3!=0){
    $yaopin = \player\getplayeryaopin($player->yp3,$sid,$dblj);
    $ypname3 = $yaopin->ypname.'('.$yaopin->ypsum.')';
}

$bosshtml=<<<HTML
当前攻击人数:<br/><br/>
$boss->bossname[lv:$boss->bosslv]<br/>
气血:($boss->bosshp)<br/>
攻击:($boss->bossgj)<br/>
防御:($boss->bossfy)<br/>
===========<br/>
$player->uname[lv:$player->ulv]<br/>
气血:($player->uhp)<br/>
攻击:($player->ugj)<br/>
防御:($player->ufy)<br/>
<br/>
<a href="?cmd=$pgjcmd">攻击</a>.<a href="?cmd=$gonowmid">逃跑</a><br/><br/>   
<a href="?cmd=$useyp1">$ypname1</a>.<a href="?cmd=$useyp2">$ypname2</a>.<a href="?cmd=$useyp3">$ypname3</a><br/>

HTML;
echo $bosshtml
?>