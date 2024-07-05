<?php
if($_POST['iid']){
    $item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
    if($count >0){
    if($item_now_count >=($_POST['count'])){
        $total = ($_POST['count'])*($_POST['item_value']);
        $item_name = \player\getitem($_POST['iid'],$dblj)->iname;
        $item_name = \lexical_analysis\color_string($item_name);
        $item_total_weight =  \player\getitem_true($item_true_id,$dblj)->iweight *$count ;
        \player\changeplayeritem($item_true_id,-$_POST['count'],$sid,$dblj);
        $sql = "update game1 set umoney = umoney +  '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        echo "出售成功，你出售了{$item_name}x{$count}，获得了{$total}{$gm_post->money_measure}{$gm_post->money_name}!<br/>";
        \player\addplayersx('uburthen',-$item_total_weight,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "出售失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}

if($canshu == 'hockshop'){
    $item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
    if($item_now_count >0){
    if($item_now_count){
        $total = ($item_now_count)*($item_value);
        $item_name = \player\getitem($iid,$dblj)->iname;
        $item_type = \player\getitem($iid,$dblj)->itype;
        $item_name = \lexical_analysis\color_string($item_name);
        \player\changeplayeritem($item_true_id,-$item_now_count,$sid,$dblj);
        $sql = "update game1 set umoney = umoney +  '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        
        if($item_type =="兵器"||$item_type =="防具"){
            $dblj->exec("DELETE from player_equip_mosaic where equip_id = '$item_true_id'");
        }
        
        echo "出售成功，你出售了{$item_name}x{$item_now_count}，获得了{$total}{$gm_post->money_measure}{$gm_post->money_name}!<br/>";
        \player\addplayersx('uburthen',-$item_now_count,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "出售失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}
if(!$gm_post_canshu){
$pos = 0;
$user_item_para = player\getitem_user($sid,$dblj);
if (!empty($user_item_para)){
foreach ($user_item_para as $item_detail){
    $pos +=1;
    $item_id = $item_detail['iid'];
    $item_true_id = $item_detail['item_true_id'];
    //$item_para = player\getitem($item_id,$dblj);
    $item_name = $item_detail['iname'];
    $item_count = $item_detail['icount'];
    $item_name = \lexical_analysis\color_string($item_name);
    $item_value = $item_detail['iprice'];
    $item_weight = $item_detail['iweight'];
    $item_desc = $item_detail['idesc'];
    $item_desc = \lexical_analysis\process_string($item_desc,$sid);
    $item_equiped = $item_detail['iequiped'];
    $item_sale_state = $item_detail['isale_state'];
    $item_no_out = $item_detail['ino_out'];
if($item_no_out==0&&$item_equiped==0&&$item_sale_state==0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $item_hockshop = $encode->encode("cmd=gm_hockshop&gm_post_canshu=1&ucmd=$cmid&item_true_id=$item_true_id&iid=$item_id&mid=$mid&sid=$sid");
    $hockshop_item_list .= <<<HTML
    <a href="?cmd=$item_hockshop">{$pos}.{$item_name}({$item_value}{$gm_post->money_measure})</a>你拥有({$item_count})<br/>
HTML;
}else{
    $pos -=1;
}
    }
}
else{
$hockshop_item_list ="暂时没有可以出售的物品！<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$mid&sid=$sid");
$shop_html = <<<HTML
<p>出售装备将会清空镶嵌物！<br/>
<p>此处所有物品回收折扣率为100.0%<br/>
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/>
请选择你要出售的物品：<br/>
$hockshop_item_list
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
if($gm_post_canshu ==1){
$item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
$item_para = player\getitem($iid,$dblj);
$item_name = $item_para ->iname;
$item_name = \lexical_analysis\color_string($item_name);
$item_value = $item_para ->iprice;
$item_weight = $item_para ->iweight;
$item_desc = $item_para ->idesc;
$item_desc = \lexical_analysis\process_string($item_desc,$sid);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$hockshop_all = $encode->encode("cmd=gm_hockshop&canshu=hockshop&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&item_value=$item_value&count=$item_now_count&mid=$mid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$hockshop_form = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&mid=$mid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobacklist = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&mid=$mid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$mid&sid=$sid");
$shop_html = <<<HTML
{$item_name}x1<br/>
重量:{$item_weight}<br/>
价格:{$item_value}<br/>
介绍:{$item_desc}<br/>
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/><br/>
<form action="?cmd=$hockshop_form" method="post">
<input name="iid" type="hidden" value="{$iid}">
<input name="item_true_id" type="hidden" value="{$item_true_id}">
<input name="item_value" type="hidden" value="{$item_value}">
请输入你要出售的数量(一共:{$item_now_count})：<input name="count" type="tel" value="{$item_now_count}" format="*N" style="-wap-input-format:*N" maxlength="5"/><br/>
<input name="submit" type="submit" title="出售" value="出售"/></form><br/>
<a href="?cmd=$hockshop_all">出售全部</a><br/>
<a href="?cmd=$gobacklist">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
echo $shop_html;
?>