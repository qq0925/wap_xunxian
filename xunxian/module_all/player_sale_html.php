<?php

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$chakanitem = $encode->encode("cmd=iteminfo_new&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&itemid=$iid&uid=$player->uid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_html = $encode->encode("cmd=item_html&canshu=$canshu&ucmd=$cmid&sid=$sid");

if(!$_POST){
$player = \player\getplayer($sid,$dblj);
$item_para = \player\getitem($iid,$dblj);
$item_name = $item_para->iname;
$item_type = $item_para->itype;
if($item_type == "兵器"||$item_type == "防具"){
$equip_tips = "挂售装备将会默认清空镶嵌位！<br/>";
}
$item_name = \lexical_analysis\color_string($item_name);
$item_value = $item_para->iprice;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$sale_son_html = <<<HTML
$equip_tips
<p>请输入{$item_name}的销售价格(原价{$item_value}{$gm_post->money_measure}{$gm_post->money_name})：<br/>
</p><form method="post">
<input name="ucmd" type="hidden" value="{$cmid}">
<input name="item_name" type="hidden" value="{$item_para->iname}">
价格:<input name="price" type="text" value="{$item_value}" maxlength="13"><br/>
有效期:<input name="time" type="number" value="24" maxlength="5">小时<br/>
<input name="submit" type="submit" title="挂出销售" value="挂出销售">
</form><br/>
HTML;
}else{
$sale_list = $encode->encode("cmd=item_sale_list&canshu=$canshu&ucmd=$cmid&sid=$sid");
$item_name = \lexical_analysis\color_string($item_name);
$nowdate = date('Y-m-d H:i:s');
// 将指定时间字符串转换为时间戳
$specifiedTimestamp = strtotime($nowdate);
// 添加指定的小时数
$newTimestamp = $specifiedTimestamp + ($time * 3600); // 3600秒 = 1小时
// 格式化新时间
$newDatetime = date('Y-m-d H:i:s', $newTimestamp);
$dblj->exec("update system_item set isale_state = 1,isale_price = '$price',isale_time ='$time',icreate_sale_time  = '$nowdate',iexpire_sale_time = '$newDatetime' where item_true_id = '$item_true_id' and sid = '$sid';");
echo "已把{$item_name}挂牌销售列表，销售价格为{$price}{$gm_post->money_measure}{$gm_post->money_name}，销售时长为{$time}小时<br/>";
$dblj->exec("DELETE from player_equip_mosaic where equip_id = '$item_true_id'");
$sale_son_html = <<<HTML
<a href="?cmd=$sale_list">挂牌物品列表</a><br/>
HTML;
}
$sale_html = <<<HTML
$sale_son_html
----------<br/>
<a href="?cmd=$chakanitem">返回{$item_name}</a><br/>
<a href="?cmd=$item_html">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
HTML;
echo $sale_html;
?>