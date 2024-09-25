<?php
include_once 'class/events_steps_change.php';
$parents_page = $currentFilePath;

if($mid){
    $oid = $mid;
}

if($_POST['iid']){
    $now_item_count = \player\getsaleitem_true_count($item_true_id,$oid,$dblj);
    $item_weight = \player\getitem_true($item_true_id,$dblj)->iweight;
    $item_total_weight = ($_POST['count']) * $item_weight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    if($now_item_count>=($_POST['count'])){
    if($count >0){
    if(($_POST['count'])<=($_POST['item_max_count'])&&$player->umoney >=($_POST['count'])*($_POST['item_price'])&&$player_last_burthen>=$item_total_weight){
        $total = ($_POST['count'])*($_POST['item_price']);
        $item_name = \player\getitem($_POST['iid'],$dblj)->iname;
        $item_mod_name = \lexical_analysis\color_string($item_name);
        \player\additem($sid,$_POST['iid'],$_POST['count'],$dblj);
        \player\changeplayeritem($item_true_id,-$_POST['count'],$oid,$dblj);
        \player\addplayersx('uburthen',-$item_total_weight,$oid,$dblj);
        $sql = "update game1 set umoney = umoney - '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        $sql = "update game1 set umoney = umoney + '$total' where sid = '$oid' ";
        $dblj->exec($sql);
        $send_time = date('Y-m-d H:i:s');
        echo "购买成功，你花了{$total}{$gm_post->money_measure}{$gm_post->money_name}购买了{$item_mod_name}x{$count}!<br/>";
        $buy_text = "我花了{$total}{$gm_post->money_measure}{$gm_post->money_name}向你购买了{$item_name}x{$_POST['count']}";
        $player = \player\getplayer($sid,$dblj);
        $ouid = \player\getplayer($oid,$dblj)->uid;
        $dblj->exec("insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','$buy_text','$player->uid','$ouid',1,'$send_time')");
    }else{
        echo "购买失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    }
    else{
    echo "对方当前售卖物品数量不足或者你没有足够的空间！<br/>";
    }
}

$pos = 0;
$oplayer = player\getplayer($oid,$dblj);
$oplayer_name = $oplayer ->uname;
$ouid = $oplayer ->uid;
$sql = "select * from system_item where isale_state = 1 and sid = '$oid'";
$cxjg = $dblj->query($sql);
$sale_ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);

if (!empty($sale_ret)){
foreach ($sale_ret as $sale_ret_detail){
    $pos +=1;
    $item_true_id = $sale_ret_detail['item_true_id'];
    $item_id = $sale_ret_detail['iid'];
    $item_count = $sale_ret_detail['icount'];
    $icreat_sale_time = $sale_ret_detail['icreat_sale_time'];
    $isale_time = $sale_ret_detail['isale_time'];
    $iexpire_sale_time = $sale_ret_detail['iexpire_sale_time'];
    $currentDatetime = date('Y-m-d H:i:s'); // 获取当前时间
    // 将时间字符串转换为时间戳
    $currentTimestamp = strtotime($currentDatetime);
    $specifiedTimestamp = strtotime($iexpire_sale_time);
    // 计算时间差（以秒为单位）
    $timeDifference = $specifiedTimestamp - $currentTimestamp;
        // 计算时、分、秒
    $hours = floor($timeDifference / 3600);
    $minutes = floor(($timeDifference - ($hours * 3600)) / 60);
    $seconds = $timeDifference % 60;
    $item_para = player\getitem($item_id,$dblj);
    $item_name = $item_para ->iname;
    $item_name = \lexical_analysis\color_string($item_name);
    $item_value = $item_para ->iprice;
    $item_price = $sale_ret_detail['isale_price'];
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $item_buy = $encode->encode("cmd=player_buy&diff_time=$timeDifference&oid=$oid&gm_post_canshu=1&ucmd=$cmid&item_true_id=$item_true_id&iid=$item_id&sid=$sid");
    $shop_item_list .= <<<HTML
    <a href="?cmd=$item_buy">{$pos}.{$item_name}({$item_price}{$gm_post->money_measure}x{$item_count})[{$hours}时{$minutes}分{$seconds}秒]</a><br/>
HTML;
    }
}
else{
$shop_item_list ="{$oplayer_name}身上暂时没有可以购买的物品！<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackoplayer = $encode->encode("cmd=getoplayerinfo&oid=$ouid&ucmd=$cmid&sid=$sid");

$shop_html = <<<HTML
<p>你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/>
「{$oplayer_name}」身上可购买的物品:<br/>
$shop_item_list
<a href="?cmd=$gobackoplayer">返回{$oplayer_name}</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
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
$buy_form = $encode->encode("cmd=player_buy&oid=$oid&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobacklist = $encode->encode("cmd=player_buy&oid=$oid&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$hours = floor($diff_time / 3600);
$minutes = floor(($diff_time - ($hours * 3600)) / 60);
$seconds = $diff_time % 60;
$shop_html = <<<HTML
{$item_name}x{$item_count}[剩余时长：{$hours}时{$minutes}分{$seconds}秒]<br/>
重量:{$item_weight}<br/>
价格:{$item_value}{$gm_post->money_measure}<br/>
销售价格:{$item_price}{$gm_post->money_measure}<br/>
介绍:{$item_desc}<br/>
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/><br/>
<form action="?cmd=$buy_form" method="post">
<input name="iid" type="hidden" value="{$iid}">
<input name="item_true_id" type="hidden" value="{$item_true_id}">
<input name="item_max_count" type="hidden" value="{$item_count}">
<input name="item_price" type="hidden" value="{$item_price}">
请输入你要购买的数量(最多{$item_count})：<input name="count" type="tel" value="1" format="*N" style="-wap-input-format:*N" maxlength="5"/><br/>
<input name="submit" type="submit" title="购买" value="购买"/></form><br/>
<a href="?cmd=$gobacklist">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
echo $shop_html;
?>