<?php

$oplayer = player\getplayer($oid,$dblj);
$item_para = player\getitem_true($item_true_id,$dblj);
$item_name = $item_para ->iname;
$item_name = \lexical_analysis\color_string($item_name);
$item_desc = $item_para ->idesc;
$item_count = player\getitem_true_count($item_true_id,$sid,$dblj);

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gift_form = $encode->encode("cmd=player_gift&gift_canshu=1&oid=$oid&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
if(!$list_page){
$item_html = $encode->encode("cmd=player_gift&oid=$oid&canshu=$canshu&ucmd=$cmid&sid=$sid");
}else{
$item_html = $encode->encode("cmd=player_gift&oid=$oid&list_page=$list_page&canshu=$canshu&ucmd=$cmid&sid=$sid");
}


$shop_html = <<<HTML
「物品赠送」<br/>
你正在向「{$oplayer->uname}」赠送物品...<br/>
{$item_name}x{$item_count}<br/>
{$item_desc}<br/>

<form action="?cmd=$gift_form" method="post">
<input name="item_true_id" type="hidden" value="{$item_true_id}">
<input name="iid" type="hidden" value="{$itemid}">
<input name="now_count" type="hidden" value="{$item_count}">
请输入你要赠送的数量：<input name="count" type="tel" value="1" format="*N" style="-wap-input-format:*N" maxlength="5"/><br/>
<input name="submit" type="submit" title="赠送" value="赠送"/></form><br/>
<a href="?cmd=$item_html">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;

echo $shop_html;
?>