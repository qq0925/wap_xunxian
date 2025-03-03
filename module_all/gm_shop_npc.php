<?php
include_once 'class/events_steps_change.php';
$parents_page = $currentFilePath;
if($canshu == 'buy'){
    if($count >0){
    $player = \player\getplayer($sid,$dblj);
    $item_weight = \player\getitem($iid,$dblj)->iweight;
    $item_total_weight = $count * $item_weight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    $money_count = \gm\unitmoneycount($sid,$money_name,$db);
    //后续加入数量判断以及购买数量变更。刷新随着场景刷新
    if($money_count >=($count)*($item_value)&&$player_last_burthen >=$item_total_weight){
        $total = ($count)*($item_value);
        $item_name = \player\getitem($iid,$dblj)->iname;
        $item_name = \lexical_analysis\color_string($item_name);
        \player\additem($sid,$iid,$count,$dblj);
        $buy_result = \gm\calcmoney($sid,$money_name,$total,$db);

        $sql = "select rname,runit from system_money_type where rid = '$money_name'";
        $cxjg = $dblj->query($sql);
        $money_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        $pay_type = $money_ret['rname'];
        $pay_runit = $money_ret['runit'];

        echo "购买成功，你花了{$total}{$pay_runit}{$pay_type}购买了{$item_name}x{$count}!<br/>";
        unset($_POST);
        $parents_cmd = 'gm_shop_npc';
        $event_id = \gm\get_self_event($dblj,$nid,'npc_shop');
        if($event_id){
        events_steps_change($event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/gm_shop_npc.php','npc_scene',$mid,$para);
        }
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "购买失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}

$pos = 0;
$npc_scene = player\getnpc_scene($mid,$dblj);
$npc_name = $npc_scene ->nname;
$npc_shop_cond = $npc_scene ->nshop_cond;
$npc_item = explode(',',$npc_scene ->nshop_item_id);
$npc_item_count = @count($npc_item);

if (!empty($npc_item[0])){
foreach ($npc_item as $item_detail){
    $pos +=1;
    $item_one = explode('|',$item_detail);
    $item_id = $item_one[0];
    $item_count = $item_one[1];
    $item_money_type = $item_one[2]?:'money';
    $sql = "select rname,runit from system_money_type where rid = '$item_money_type'";
    $cxjg = $dblj->query($sql);
    $money_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $pay_type = $money_ret['rname'];
    $pay_runit = $money_ret['runit'];
    
    $item_para = player\getitem($item_id,$dblj);
    $item_name = $item_para ->iname;
    $item_name = \lexical_analysis\color_string($item_name);
    $item_value = $item_para ->iprice;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $item_buy = $encode->encode("cmd=gm_shop_npc&mid=$mid&gm_post_canshu=1&ucmd=$cmid&money_type=$item_money_type&item_money_name=$pay_type&item_money_unit=$pay_runit&iid=$item_id&sid=$sid");
    $shop_item_list .= <<<HTML
    <a href="?cmd=$item_buy">{$pos}.{$item_name}({$item_value}{$pay_runit}{$pay_type})</a>剩余：({$item_count})<br/>
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
$item_desc = $item_para ->idesc?:'无';

// $cmid = $cmid + 1;
// $cdid[] = $cmid;
// $clj[] = $cmd;
// $buy_5 = $encode->encode("cmd=gm_shop_npc&mid=$mid&canshu=buy&ucmd=$cmid&iid=$iid&item_value=$item_value&count=5&sid=$sid");
// $cmid = $cmid + 1;
// $cdid[] = $cmid;
// $clj[] = $cmd;
// $buy_10 = $encode->encode("cmd=gm_shop_npc&mid=$mid&canshu=buy&ucmd=$cmid&iid=$iid&item_value=$item_value&count=10&sid=$sid");
// $cmid = $cmid + 1;
// $cdid[] = $cmid;
// $clj[] = $cmd;
// $buy_20 = $encode->encode("cmd=gm_shop_npc&mid=$mid&canshu=buy&ucmd=$cmid&iid=$iid&item_value=$item_value&count=20&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$buy_form = $encode->encode("cmd=gm_shop_npc&canshu=buy&mid=$mid&iid=$iid&item_value=$item_value&money_name=$money_type&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobacklist = $encode->encode("cmd=gm_shop_npc&mid=$mid&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$item_money_player = \gm\unitmoneycount($sid,$money_type,$db);
//<a href="?cmd=$buy_5">购买+5</a><br/>
// <a href="?cmd=$buy_10">购买+10</a><br/>
// <a href="?cmd=$buy_20">购买+20</a><br/>
$shop_html = <<<HTML
{$item_name}x1<br/>
重量:{$item_weight}<br/>
价格:{$item_value}{$item_money_unit}{$item_money_name}<br/>
剩余数量:{$item_count}<br/>
介绍:{$item_desc}<br/>
你身上有{$item_money_name}:{$item_money_player}{$item_money_unit}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/><br/>
<form action="?cmd=$buy_form" method="post">
请输入你要购买的数量：<input name="count" type="tel" value="1" format="*N" style="-wap-input-format:*N" maxlength="5"/><br/>
<input name="submit" type="submit" title="购买" value="购买"/></form><br/>
<a href="?cmd=$gobacklist">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
echo $shop_html;

?>