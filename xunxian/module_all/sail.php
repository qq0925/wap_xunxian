<?php

$cmid = $cmid + 1;
$cdid[] = $cmid;    
$clj[] = $cmd;
$sail_choose_1 = $encode->encode("cmd=sail_html&choose_area_belong=1&ucmd=$cmid&mid=$mid&sid=$sid");
$sail_choose_2 = $encode->encode("cmd=sail_html&choose_area_belong=2&ucmd=$cmid&mid=$mid&sid=$sid");
$sail_choose_3 = $encode->encode("cmd=sail_html&choose_area_belong=3&ucmd=$cmid&mid=$mid&sid=$sid");
$sail_choose_4 = $encode->encode("cmd=sail_html&choose_area_belong=4&ucmd=$cmid&mid=$mid&sid=$sid");
$sail_choose_5 = $encode->encode("cmd=sail_html&choose_area_belong=5&ucmd=$cmid&mid=$mid&sid=$sid");
$map_name = \lexical_analysis\color_string(\player\getmid($mid,$dblj)->mname);
$map_dire = \player\getmid($mid,$dblj)->mdire;
$map_area_id = \player\getmid($mid,$dblj)->marea_id;
$map_area_belong = \gm\getqy($dblj,$map_area_id)['belong'];

if(!$choose_area_belong){
$choose_area_belong = $map_area_belong;
}
switch($choose_area_belong){
    case '1':
$sail_area_html = <<<HTML
日出之地 <a href="?cmd=$sail_choose_2">灼热之地</a> <a href="?cmd=$sail_choose_3">日落之地</a> <a href="?cmd=$sail_choose_4">极寒之地</a> <a href="?cmd=$sail_choose_5">湿热之地</a><br/>
HTML;
        break;
    case '2':
$sail_area_html = <<<HTML
<a href="?cmd=$sail_choose_1">日出之地</a> 灼热之地 <a href="?cmd=$sail_choose_3">日落之地</a> <a href="?cmd=$sail_choose_4">极寒之地</a> <a href="?cmd=$sail_choose_5">湿热之地</a><br/>
HTML;
        break;
    case '3':
$sail_area_html = <<<HTML
<a href="?cmd=$sail_choose_1">日出之地</a> <a href="?cmd=$sail_choose_2">灼热之地</a> 日落之地 <a href="?cmd=$sail_choose_4">极寒之地</a> <a href="?cmd=$sail_choose_5">湿热之地</a><br/>
HTML;
        break;
    case '4':
$sail_area_html = <<<HTML
<a href="?cmd=$sail_choose_1">日出之地</a> <a href="?cmd=$sail_choose_2">灼热之地</a> <a href="?cmd=$sail_choose_3">日落之地</a> 极寒之地 <a href="?cmd=$sail_choose_5">湿热之地</a><br/>
HTML;
        break;
    case '5':
$sail_area_html = <<<HTML
<a href="?cmd=$sail_choose_1">日出之地</a> <a href="?cmd=$sail_choose_2">灼热之地</a> <a href="?cmd=$sail_choose_3">日落之地</a> <a href="?cmd=$sail_choose_4">极寒之地</a> 湿热之地 <br/>
HTML;
        break;
}

$sail_list = \player\getsail($mid,$choose_area_belong,$dblj);
for($i=0;$i<@count($sail_list);$i++){
$sail_city_name = $sail_list[$i]['marea_name'];
$sail_city_dire = $sail_list[$i]['mdire'];
$sail_city_id = $sail_list[$i]['mid'];
$sail_city_area_belong = \gm\getqy($dblj,$sail_city_area_id)['belong'];
$distance = \gm\calculateDistance($map_dire,$sail_city_dire);
$sailto = $encode->encode("cmd=sail_html&distance=$distance&city_name=$sail_city_name&city_id=$sail_city_id&choose_area_belong=$choose_area_belong&ucmd=$cmid&mid=$mid&sid=$sid");
$sail_city .=<<<HTML
<a href="?cmd=$sailto">{$sail_city_name}（{$distance}海里）</a><br/>
HTML;
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$now_time = date('H:i:s');
$sail_html = <<<HTML
{$map_name}<br/>
出航：请选择你要出航的目的地<br/>
$sail_city
点击选择其他地区:<br/>
$sail_area_html
<a href="?cmd=$gonowmid">返回{$map_name}</a><br/>
报时：($now_time)<br/>
HTML;
if($city_id){
$boat = \player\getboat($sid,$dblj);
$boat_name = $boat['boat_name'];
$boat_cons = $boat['boat_cons'];
$boat_speed = $boat['boat_speed'];
$boat_durable = $boat['boat_durable'];
$boat_max_durable = $boat['boat_max_durable'];
$boat_total_cons = ceil($distance/100*$boat_cons);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gojust = $encode->encode("cmd=sail_html&mid=$mid&choose_area_belong=$choose_area_belong&ucmd=$cmid&sid=$sid");
$gonow = $encode->encode("cmd=sailing_html&canshu=1&begin_id=$mid&over_id=$city_id&distance=$distance&ucmd=$cmid&sid=$sid");
$sail_html = <<<HTML
{$map_name}<br/>
你即将驾驶【{$boat_name}】航海至：{$city_name}<br/>
距离：{$distance} 海里<br/>
百里能耗：{$boat_cons}<br/>
船速：{$boat_speed}海里/秒<br/>
耐久度：{$boat_durable}/{$boat_max_durable}<br/>
全程需要动能晶石：{$boat_total_cons}块 <br/>
<a href="?cmd=$gonow">立即出发</a><br/><br/>
<a href="?cmd=$gojust">返回出发界面</a><br/>
<a href="?cmd=$gonowmid">返回{$map_name}</a><br/>
报时：($now_time)<br/>
HTML;
}
echo $sail_html;
?>