<?php


if($sale_cancel){
$nowcount = \player\getsaleitem_true_count($item_true_id,$sid,$dblj);
if($nowcount >0){
$item_name = \lexical_analysis\process_photoshow($item_name);
$item_mod_name = \lexical_analysis\color_string($item_name);
echo "你撤销了{$item_mod_name}的出售<br/>";
$dblj->exec("update system_item set isale_state = 0,isale_price = '',isale_time ='',icreate_sale_time  = '' where item_true_id = '$item_true_id' and sid = '$sid';");
}else{
$item_name = \lexical_analysis\process_photoshow($item_name);
$item_mod_name = \lexical_analysis\color_string($item_name);
echo "{$item_mod_name}已销售完!<br/>";
}
}

if($cancel_all){
echo "你撤销了所有上架物品的出售<br/>";
$dblj->exec("update system_item set isale_state = 0,isale_price = '',isale_time ='',icreate_sale_time  = '' where isale_state = 1 and sid = '$sid';");
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_html = $encode->encode("cmd=item_html&canshu=$canshu&ucmd=$cmid&sid=$sid");
$sql = "select * from system_item where sid = '$sid' and isale_state = 1";
$cxjg=$dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);

if(!$ret){
$sale_html = <<<HTML
你没有挂出任何销售物品<br/>
HTML;
}else{
for($i = 1;$i<@count($ret)+1;$i++){
$item_iid = $ret[$i-1]['iid'];
$item_price = $ret[$i-1]['isale_price'];
$item_count = $ret[$i-1]['icount'];
$item_true_id = $ret[$i-1]['item_true_id'];

$icreat_sale_time = $ret[$i-1]['icreat_sale_time'];
$isale_time = $ret[$i-1]['isale_time'];
$iexpire_sale_time = $ret[$i-1]['iexpire_sale_time'];
$currentDatetime = date('Y-m-d H:i:s'); // 获取当前时间
// 将时间字符串转换为时间戳
$currentTimestamp = strtotime($currentDatetime);
$specifiedTimestamp = strtotime($iexpire_sale_time);
// 计算时间差（以秒为单位）
$timeDifference = $specifiedTimestamp - $currentTimestamp;
if($timeDifference >0){
    // 计算时、分、秒
$hours = floor($timeDifference / 3600);
$minutes = floor(($timeDifference - ($hours * 3600)) / 60);
$seconds = $timeDifference % 60;
}else{
$hours = 0;
$minutes = 0;
$seconds = 0;
}
$item_name = \player\getitem($item_iid,$dblj)->iname;
$item_name = \lexical_analysis\process_photoshow($item_name);
$item_mod_name = \lexical_analysis\color_string($item_name);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$ckitem = $encode->encode("cmd=iteminfo_new&ck_sale=1&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&item_name=$item_name&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$cancel = $encode->encode("cmd=item_sale_list&sale_cancel=1&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&item_name=$item_name&iid=$item_iid&sid=$sid");
$sale_item_info .=<<<HTML
[$i].<a href="?cmd=$ckitem">[{$hours}时{$minutes}分{$seconds}秒]{$item_mod_name}({$item_price}{$gm_post->money_measure}x{$item_count})</a><a href="?cmd=$cancel">撤销</a><br/>
HTML;
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$cancel_all = $encode->encode("cmd=item_sale_list&cancel_all=1&canshu=$canshu&ucmd=$cmid&sid=$sid");
$sale_html = <<<HTML
你挂出销售的物品有:<br/>
$sale_item_info
----------<br/>
<a href="?cmd=$cancel_all">撤销全部</a><br/>
HTML;
}
$sale_text = <<<HTML
$sale_html
----------<br/>
<a href="?cmd=$item_html">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
HTML;
echo $sale_text;
?>