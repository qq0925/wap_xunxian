<?php

function generateAreaLinks($dblj, $currentBelong, $encode, $cmid, $mid, $sid) {
    // 获取所有区域
    $sql = "SELECT `id`,`name`,`change_cond`,`cmmt2` FROM `system_region` WHERE `road_hide` = 0 ORDER BY `pos` ASC";
    $regions = $dblj->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $links = '';
    foreach ($regions as $region) {
        $id = $region['id'];
        $name = $region['name'];
        $change_cond = $region['change_cond'];
        $cmmt2 = $region['cmmt2'];
        if ($id == $currentBelong) {
            // 当前区域显示为普通文本
            $links .= "{$name}";
        } else {
            // 生成区域链接
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $clj[] = $cmd;
            $change_ret = $change_cond !== '' 
                ? \lexical_analysis\process_string($change_cond, $sid, $oid, $mid, null, null, "check_cond") 
                : 1;
            @$ret = eval("return $change_ret;");
            $ret_bool = ($ret !== false && $ret !== null) ? 0 : 1;
            if($ret_bool ==0){
            $encodedCmd = $encode->encode("cmd=road_html&choose_area_belong=$id&ucmd=$cmid&mid=$mid&sid=$sid");
            $links .= "<a href=\"?cmd=$encodedCmd\">{$name}</a> ";
            }else{
            $cmmt2 = \lexical_analysis\process_string($cmmt2,$sid,$oid,$mid);
            $links .=<<<HTML
<a href="#" onclick="return alert_tips('{$cmmt2}')">{$name}</a>
HTML;
            }
        }
    }
    return $links . '<br/>';
}

$cycle_name = \player\getcycle($sid,$dblj,1)['land_name'];
if($cycle_name){
$map_name = \lexical_analysis\color_string(\player\getmid($mid,$dblj)->mname);
$map_dire = \player\getmid($mid,$dblj)->mdire;
$map_area_id = \player\getmid($mid,$dblj)->marea_id;
$map_area_belong = \gm\getqy($dblj,$map_area_id)['belong'];

// 生成区域链接
if(isset($choose_area_belong)){
$road_area_html = generateAreaLinks($dblj, $choose_area_belong, $encode, $cmid, $mid, $sid);
}else{
$choose_area_belong = $map_area_belong;
$road_area_html = generateAreaLinks($dblj, $choose_area_belong, $encode, $cmid, $mid, $sid);
}

$road_list = \player\getoutgoing($mid,$choose_area_belong,$dblj,1);
for($i=0;$i<@count($road_list);$i++){
$road_city_name = $road_list[$i]['marea_name'];
$road_city_dire = $road_list[$i]['mdire'];
$road_city_id = $road_list[$i]['mid'];
$road_city_area_belong = \gm\getqy($dblj,$road_city_area_id)['belong'];
$distance = \gm\calculateDistance($map_dire,$road_city_dire);
$roadto = $encode->encode("cmd=road_html&distance=$distance&city_name=$road_city_name&city_id=$road_city_id&choose_area_belong=$choose_area_belong&ucmd=$cmid&mid=$mid&sid=$sid");
$road_city .=<<<HTML
<a href="?cmd=$roadto">{$road_city_name}（{$distance}公里）</a><br/>
HTML;
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$now_time = date('H:i:s');
$road_html = <<<HTML
{$map_name}<br/>
出发：请选择你要出发的目的地<br/>
$road_city
点击选择其他地区:<br/>
$road_area_html
<a href="?cmd=$gonowmid">返回{$map_name}</a><br/>
报时：($now_time)<br/>
HTML;
if($city_id){
$cycle = \player\getcycle($sid,$dblj,1);
$cycle_name = $cycle['land_name'];
$cycle_cons = $cycle['land_cons'];
$cycle_speed = $cycle['land_speed'];
$cycle_durable = $cycle['land_durable'];
$cycle_max_durable = $cycle['cycle_max_durable'];
$cycle_total_cons = ceil($distance/100*$cycle_cons);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gojust = $encode->encode("cmd=road_html&mid=$mid&choose_area_belong=$choose_area_belong&ucmd=$cmid&sid=$sid");
$gonow = $encode->encode("cmd=roading_html&canshu=1&begin_id=$mid&over_id=$city_id&distance=$distance&ucmd=$cmid&sid=$sid");
$road_html = <<<HTML
{$map_name}<br/>
你即将驾驶【{$cycle_name}】出行至：{$city_name}<br/>
距离：{$distance} 公里<br/>
百里能耗：{$cycle_cons}<br/>
速度：{$cycle_speed}公里/秒<br/>
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
$road_html = "你没有陆行交通工具！<br/>
<a href='?cmd=$gonowmid'>返回{$map_name}</a><br/>";
}
echo $road_html;
?>
<script>
function alert_tips(tips) {
    alert(tips);
}
</script>