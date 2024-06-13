<?php
include_once 'class/events_steps_change.php';
$parents_page = $currentFilePath;

if($mid){
    $nid = $mid;
}


if($_POST['iid']){
    if($count >0){
    $item_weight = \player\getitem($_POST['iid'],$dblj)->iweight;
    $item_total_weight = ($_POST['count']) * $item_weight;
    $player = \player\getplayer($sid,$dblj);
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    if($player->umoney >=($_POST['count'])*($_POST['item_value'])&&$player_last_burthen >=$item_total_weight){
        $total = ($_POST['count'])*($_POST['item_value']);
        $item_name = \player\getitem($_POST['iid'],$dblj)->iname;
        $item_name = \lexical_analysis\color_string($item_name);
        \player\additem($sid,$_POST['iid'],$_POST['count'],$dblj);
        $sql = "update game1 set umoney = umoney - '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        echo "购买成功，你花了{$total}{$gm_post->money_measure}{$gm_post->money_name}购买了{$item_name}x{$count}!<br/>";
        $parents_cmd = 'gm_shop_npc';
        $event_id = \gm\get_self_event($dblj,$nid,'npc_shop');
        events_steps_change($event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/gm_shop_npc.php','npc',$nid,$para);
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "购买失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}

if($canshu == 'buy'){
    if($count >0){
    $player = \player\getplayer($sid,$dblj);
    $item_weight = \player\getitem($iid,$dblj)->iweight;
    $item_total_weight = $count * $item_weight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    if($player->umoney >=($count)*($item_value)&&$player_last_burthen >=$item_total_weight){
        $total = ($count)*($item_value);
        $item_name = \player\getitem($iid,$dblj)->iname;
        $item_name = \lexical_analysis\color_string($item_name);
        \player\additem($sid,$iid,$count,$dblj);
        $sql = "update game1 set umoney = umoney -  '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        echo "购买成功，你花了{$total}{$gm_post->money_measure}{$gm_post->money_name}购买了{$item_name}x{$count}!<br/>";
        $parents_cmd = 'gm_shop_npc';
        $event_id = \gm\get_self_event($dblj,$nid,'npc_shop');
        events_steps_change($event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/gm_shop_npc.php','npc',$nid,$para);
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "购买失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}

$pos = 0;
$npc = player\getnpc($nid,$dblj);
$npc_name = $npc ->nname;
$npc_shop_cond = $npc ->nshop_cond;
$npc_item = explode(',',$npc ->nshop_item_id);
$npc_item_count = @count($npc_item);

if (!empty($npc_item[0])){
foreach ($npc_item as $item_detail){
    $pos +=1;
    $item_id = explode('|',$item_detail)[0];
    $item_para = player\getitem($item_id,$dblj);
    $item_name = $item_para ->iname;
    $item_name = \lexical_analysis\color_string($item_name);
    $item_value = $item_para ->iprice;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $item_buy = $encode->encode("cmd=gm_shop_npc&nid=$nid&gm_post_canshu=1&ucmd=$cmid&iid=$item_id&sid=$sid");
    $shop_item_list .= <<<HTML
    <a href="?cmd=$item_buy">{$pos}.{$item_name}({$item_value}{$gm_post->money_measure})</a>剩余：(∞)<br/>
HTML;
    }
}
else{
$shop_item_list ="暂时没有可以购买的物品！<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$shop_html = <<<HTML
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/>
{$npc_name}身上可购买的物品:<br/>
$shop_item_list
<a href="?cmd=$gobackgame">返回游戏</a><br/>
HTML;

if($gm_post_canshu ==1){
$item_para = player\getitem($iid,$dblj);
$item_name = $item_para ->iname;
$item_name = \lexical_analysis\color_string($item_name);
$item_value = $item_para ->iprice;
$item_weight = $item_para ->iweight;
$item_desc = $item_para ->idesc;
if(!$item_desc){
    $item_desc = "无";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$buy_5 = $encode->encode("cmd=gm_shop_npc&nid=$nid&canshu=buy&ucmd=$cmid&iid=$iid&item_value=$item_value&count=5&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$buy_10 = $encode->encode("cmd=gm_shop_npc&nid=$nid&canshu=buy&ucmd=$cmid&iid=$iid&item_value=$item_value&count=10&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$buy_20 = $encode->encode("cmd=gm_shop_npc&nid=$nid&canshu=buy&ucmd=$cmid&iid=$iid&item_value=$item_value&count=20&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$buy_form = $encode->encode("cmd=gm_shop_npc&nid=$nid&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobacklist = $encode->encode("cmd=gm_shop_npc&nid=$nid&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$shop_html = <<<HTML
{$item_name}x1<br/>
重量:{$item_weight}<br/>
价格:{$item_value}<br/>
介绍:{$item_desc}<br/>
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/><br/>
<a href="?cmd=$buy_5">购买+5</a><br/>
<a href="?cmd=$buy_10">购买+10</a><br/>
<a href="?cmd=$buy_20">购买+20</a><br/>
<form action="?cmd=$buy_form" method="post">
<input name="iid" type="hidden" value="{$iid}">
<input name="item_value" type="hidden" value="{$item_value}">
请输入你要购买的数量：<input name="count" type="tel" value="1" format="*N" style="-wap-input-format:*N" maxlength="5"/><br/>
<input name="submit" type="submit" title="购买" value="购买"/></form><br/>
<a href="?cmd=$gobacklist">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
echo $shop_html;
?>