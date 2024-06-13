<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$map_name = \player\getmid($mid,$dblj)->mname;
$map_pick_time = \player\getmid($mid,$dblj)->mpick_time;
$rp_refresh_time = \player\getrp_detail($rp_id,$dblj)->rp_renew_time;
$rp_item_id = \player\getrp_detail($rp_id,$dblj)->rp_item_id;
$rp_name = \player\getrp_detail($rp_id,$dblj)->rp_name;
$time1_timestamp = strtotime($map_pick_time);
// 获取当前时间的时间戳
$current_timestamp = time();
// 计算差值
$time_difference = $current_timestamp - $time1_timestamp;
if ($time_difference < $rp_refresh_time){
$least_time = $rp_refresh_time - $time_difference;
$pick_text = "「{$map_name}」<br/>没有任何东西!<br/>大约还要{$least_time}秒「{$rp_name}」才会重生!<br/>";
}else{
// 将时间戳转化为日期时间格式
$current_timestamp = date("Y-m-d H:i:s", $current_timestamp);
$rand_count = rand(1,5);
$ret = \player\additem($sid,$rp_item_id,$rand_count,$dblj);
if($ret !=-1){
$item_name = \player\getitem($rp_item_id,$dblj)->iname;
$item_name = \lexical_analysis\color_string($item_name);
echo "「{$map_name}」<br/>你得到了：{$item_name}x{$rand_count}<br/>";
$dblj->exec("update system_map set mpick_time = '$current_timestamp' where mid = '$mid'");
}
//先进行挖掘条件判定（包括挖掘等级，挖掘装备是否装备，挖掘装备是否损坏，挖掘体力是否足够）
//减去耐久度，获得铜矿，并将当前场景的mpick_time置为当前时间
}
$pick_html = <<<HTML
$pick_text
<a href="?cmd=$gonowmid">返回{$map_name}</a><br/>
HTML;
echo $pick_html;
?>