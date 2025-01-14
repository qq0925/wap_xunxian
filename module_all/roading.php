<?php
$player = \player\getplayer($sid,$dblj);


$land = \player\getcycle($sid,$dblj,1);
$distance = $land['land_distance'];
$land_speed = $land['land_speed'];
$begin_id = $land['land_begin_id'];
$over_id = $land['land_over_id'];
$begin_name = \player\getmid($begin_id,$dblj)->marea_name;
$over_name = \player\getmid($over_id,$dblj)->marea_name;

$land_last_time = 2 *ceil($distance/$land_speed);
$gonow = $encode->encode("cmd=roading_html&land_speed=$land_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$land_name = $land['land_name'];

if(isset($auto)){
\player\changeplayersx('uauto_roading',$auto,$sid,$dblj);
$player = \player\getplayer($sid,$dblj);
}

if($player->uauto_roading ==0){
$open_auto_roading = $encode->encode("cmd=roading_html&auto=1&land_speed=$land_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_road_html = <<<HTML
<a href="?cmd=$open_auto_roading">开启自动航行</a><br/>
HTML;
}else{
$auto_road_to = $encode->encode("cmd=roading_html&land_speed=$land_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_road_url = "?cmd=$auto_road_to"; // 构建完整的 URL
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=$auto_road_url">
HTML;
echo $refresh_html;
//header("refresh:2;url={$auto_road_url}");//这里的2是默认间隔
$close_auto_roading = $encode->encode("cmd=roading_html&auto=0&land_speed=$land_speed&begin_id=$begin_id&over_id=$over_id&distance=$distance&ucmd=$cmid&sid=$sid");
$auto_road_html = <<<HTML
<a href="?cmd=$close_auto_roading">关闭自动航行</a><br/>
HTML;
}

$road_html = <<<HTML
【{$land_name}】<br/>
路线：{$begin_name}->{$over_name}<br/>
出行中，距{$over_name} 还有 {$distance}公里, 预计到站还有{$land_last_time}秒;<br/>
<a href="?cmd=$gonow">继续出行</a><br/><br/>
$auto_road_html
<a href="?cmd=$gonow">返回</a><a href="?cmd=$gonow">挖掘</a><a href="?cmd=$gonow">堪舆</a><br/>
HTML;
echo $road_html;
?>