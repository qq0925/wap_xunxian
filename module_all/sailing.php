<?php
$player = \player\getplayer($sid,$dblj);


$boat = \player\getboat($sid,$dblj);
$distance = $boat['boat_distance'];
$boat_speed = $boat['boat_speed'];
$begin_id = $boat['boat_begin_id'];
$over_id = $boat['boat_over_id'];
$begin_name = \player\getmid($begin_id,$dblj)->marea_name;
$over_name = \player\getmid($over_id,$dblj)->marea_name;

$boat_last_time = 2 *ceil($distance/$boat_speed);
$gonow = $encode->encode("cmd=sailing_html&boat_speed=$boat_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$boat_name = $boat['boat_name'];

if(isset($auto)){
\player\changeplayersx('uauto_sailing',$auto,$sid,$dblj);
$player = \player\getplayer($sid,$dblj);
}

if($player->uauto_sailing ==0){
$open_auto_sailing = $encode->encode("cmd=sailing_html&auto=1&boat_speed=$boat_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_sail_html = <<<HTML
<a href="?cmd=$open_auto_sailing">开启自动航行</a><br/>
HTML;
}else{
$auto_sail_to = $encode->encode("cmd=sailing_html&boat_speed=$boat_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_sail_url = "?cmd=$auto_sail_to"; // 构建完整的 URL
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=$auto_sail_url">
HTML;
echo $refresh_html;
//header("refresh:2;url={$auto_sail_url}");//这里的2是默认间隔
$close_auto_sailing = $encode->encode("cmd=sailing_html&auto=0&boat_speed=$boat_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_sail_html = <<<HTML
<a href="?cmd=$close_auto_sailing">关闭自动航行</a><br/>
HTML;
}

$sail_html = <<<HTML
【{$boat_name}】<br/>
船员|水手|船员|大副<br/>
航线：{$begin_name}->{$over_name}<br/>
航行中，距{$over_name} 还有 {$distance}海里, 预计到站还有{$boat_last_time}秒;<br/>
<a href="?cmd=$gonow">继续航行</a><br/><br/>
$auto_sail_html
<a href="?cmd=$gonow">返航</a><a href="?cmd=$gonow">钓鱼</a><a href="?cmd=$gonow">潜水</a><br/>
HTML;
echo $sail_html;
?>