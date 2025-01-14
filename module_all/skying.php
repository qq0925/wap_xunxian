<?php
$player = \player\getplayer($sid,$dblj);


$aircraft = \player\getcycle($sid,$dblj,3);
$distance = $aircraft['aircraft_distance'];
$aircraft_speed = $aircraft['aircraft_speed'];
$begin_id = $aircraft['aircraft_begin_id'];
$over_id = $aircraft['aircraft_over_id'];
$begin_name = \player\getmid($begin_id,$dblj)->marea_name;
$over_name = \player\getmid($over_id,$dblj)->marea_name;

$aircraft_last_time = 2 *ceil($distance/$aircraft_speed);
$gonow = $encode->encode("cmd=skying_html&aircraft_speed=$aircraft_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$aircraft_name = $aircraft['aircraft_name'];

if(isset($auto)){
\player\changeplayersx('uauto_skying',$auto,$sid,$dblj);
$player = \player\getplayer($sid,$dblj);
}

if($player->uauto_skying ==0){
$open_auto_skying = $encode->encode("cmd=skying_html&auto=1&aircraft_speed=$aircraft_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_sky_html = <<<HTML
<a href="?cmd=$open_auto_skying">开启自动飞行</a><br/>
HTML;
}else{
$auto_sky_to = $encode->encode("cmd=skying_html&aircraft_speed=$aircraft_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_sky_url = "?cmd=$auto_sky_to"; // 构建完整的 URL
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=$auto_sky_url">
HTML;
echo $refresh_html;
//header("refresh:2;url={$auto_sky_url}");//这里的2是默认间隔
$close_auto_skying = $encode->encode("cmd=skying_html&auto=0&aircraft_speed=$aircraft_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_sky_html = <<<HTML
<a href="?cmd=$close_auto_skying">关闭自动飞行</a><br/>
HTML;
}

$sky_html = <<<HTML
【{$aircraft_name}】<br/>
航线：{$begin_name}->{$over_name}<br/>
飞行中，距{$over_name} 还有 {$distance}公里, 预计到站还有{$aircraft_last_time}秒;<br/>
<a href="?cmd=$gonow">继续飞行</a><br/><br/>
$auto_sky_html
<a href="?cmd=$gonow">返航</a><br/>
HTML;
echo $sky_html;
?>