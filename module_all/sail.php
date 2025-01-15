<?php

function generateAreaLinks($dblj, $currentBelong, $encode, $cmid, $mid, $sid) {
    // 获取所有区域
    $sql = "SELECT `id`,`name` FROM `system_region` WHERE `sail_hide` = 0 and `id` != 0 ORDER BY `pos` ASC";
    $regions = $dblj->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $links = '';
    foreach ($regions as $region) {
        $id = $region['id'];
        $name = $region['name'];
        if ($id == $currentBelong) {
            // 当前区域显示为普通文本
            $links .= "{$name}";
        } else {
            // 生成区域链接
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $clj[] = $cmd;
            $encodedCmd = $encode->encode("cmd=sail_html&choose_area_belong=$id&ucmd=$cmid&mid=$mid&sid=$sid");
            $links .= "<a href=\"?cmd=$encodedCmd\">{$name}</a> ";
        }
    }
    return $links . '<br/>';
}

$cycle_name = \player\getcycle($sid,$dblj,2)['boat_name'];
if($cycle_name){
$map_name = \lexical_analysis\color_string(\player\getmid($mid,$dblj)->mname);
$map_dire = \player\getmid($mid,$dblj)->mdire;
$map_area_id = \player\getmid($mid,$dblj)->marea_id;
$map_area_belong = \gm\getqy($dblj,$map_area_id)['belong'];

// 生成区域链接
if($choose_area_belong){
$sail_area_html = generateAreaLinks($dblj, $choose_area_belong, $encode, $cmid, $mid, $sid);
}else{
$sail_area_html = generateAreaLinks($dblj, $map_area_belong, $encode, $cmid, $mid, $sid);
}

$sail_list = \player\getoutgoing($mid,$choose_area_belong,$dblj,2);
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
出航：请选择你要航行的目的地<br/>
$sail_city
点击选择其他地区:<br/>
$sail_area_html
<a href="?cmd=$gonowmid">返回{$map_name}</a><br/>
报时：($now_time)<br/>
HTML;
if($city_id){
$cycle = \player\getcycle($sid,$dblj,2);
$cycle_name = $cycle['boat_name'];
$cycle_cons = $cycle['boat_cons'];
$cycle_speed = $cycle['boat_speed'];
$cycle_durable = $cycle['boat_durable'];
$cycle_max_durable = $cycle['boat_max_durable'];
$cycle_total_cons = ceil($distance/100*$cycle_cons);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gojust = $encode->encode("cmd=sail_html&mid=$mid&choose_area_belong=$choose_area_belong&ucmd=$cmid&sid=$sid");
$gonow = $encode->encode("cmd=sailing_html&canshu=1&begin_id=$mid&over_id=$city_id&distance=$distance&ucmd=$cmid&sid=$sid");
$sail_html = <<<HTML
{$map_name}<br/>
你即将驾驶【{$cycle_name}】航行至：{$city_name}<br/>
距离：{$distance} 海里<br/>
百里能耗：{$cycle_cons}<br/>
速度：{$cycle_speed}海里/秒<br/>
耐久度：{$cycle_durable}/{$cycle_max_durable}<br/>
全程需要动能晶石：{$cycle_total_cons}块 <br/>
<a href="?cmd=$gonow">立即出发</a><br/><br/>
<a href="?cmd=$gojust">返回出发界面</a><br/>
<a href="?cmd=$gonowmid">返回{$map_name}</a><br/>
报时：($now_time)<br/>
HTML;
}
}else{
$map_name = \lexical_analysis\color_string(\player\getmid($mid,$dblj)->mname);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$sail_html = "你没有海上交通工具！<br/>
<a href='?cmd=$gonowmid'>返回{$map_name}</a><br/>";
}
echo $sail_html;
?>