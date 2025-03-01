<?php

if($canshu == 'buy'){
    if($count >0){
    $player = \player\getplayer($sid,$dblj);
    $item_weight = \player\getitem($iid,$dblj)->iweight;
    $item_total_weight = $count * $item_weight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    $money_count = unitmoneycount($sid,$money_name,$db);
    if($money_count >=($count)*($item_value)&&$player_last_burthen >=$item_total_weight){
        $total = ($count)*($item_value);
        $item_name = \player\getitem($iid,$dblj)->iname;
        $item_name = \lexical_analysis\color_string($item_name);
        \player\additem($sid,$iid,$count,$dblj);
        $buy_result = calcmoney($sid,$money_name,$total,$db);

        $sql = "select rname,runit from system_money_type where rid = '$money_name'";
        $cxjg = $dblj->query($sql);
        $money_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        $pay_type = $money_ret['rname'];
        $pay_runit = $money_ret['runit'];

        echo "购买成功，你花了{$total}{$pay_type}{$pay_runit}购买了{$item_name}x{$count}!<br/>";
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "购买失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}

$pos = 0;
$clmid = player\getmid($mid,$dblj);
$scene_name = $clmid ->mname;
$scene_item = explode(',',$clmid ->mshop_item_id);
$scene_item_count = @count($scene_item);

if (!empty($scene_item[0])){
foreach ($scene_item as $item_detail){
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
    $item_weight = $item_para ->iweight;
    $item_desc = $item_para ->idesc;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $item_buy = $encode->encode("cmd=gm_shop&gm_post_canshu=1&ucmd=$cmid&money_type=$item_money_type&item_money_name=$pay_type&item_money_unit=$pay_runit&iid=$item_id&mid=$mid&sid=$sid");
    $shop_item_list .= <<<HTML
    <a href="?cmd=$item_buy">{$pos}.{$item_name}({$item_value}{$pay_runit}{$pay_type})</a>剩余：(∞)<br/>
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
请选择你要购买的物品：<br/>
$shop_item_list
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;

if($gm_post_canshu ==1){
$item_para = player\getitem($iid,$dblj);
$item_name = $item_para ->iname;
$item_name = \lexical_analysis\color_string($item_name);
$item_value = $item_para ->iprice;
$item_weight = $item_para ->iweight;
$item_desc = $item_para ->idesc?:'无';

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$buy_form = $encode->encode("cmd=gm_shop&iid=$iid&item_value=$item_value&money_name=$money_type&ucmd=$cmid&mid=$mid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobacklist = $encode->encode("cmd=gm_shop&ucmd=$cmid&mid=$mid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$mid&sid=$sid");
$item_money_player = unitmoneycount($sid,$money_type,$db);
$shop_html = <<<HTML
{$item_name}x1<br/>
重量:{$item_weight}<br/>
价格:{$item_value}<br/>
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

function calcmoney($sid,$money_name,$total,$db){
    $name = 'u'.$money_name;
    $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$name'");
    $result_2 = $db->query("SELECT value from system_addition_attr where name = '$name' and sid = '$sid'");
    if ($result->num_rows > 0) {
            // 字段存在于 game1 表
        $sql = "UPDATE game1 SET $name = $name - ? WHERE sid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('is', $total, $sid);
        $stmt->execute();
        return true;
    }elseif ($result_2->num_rows > 0){
            // 字段存在于 addition 表
        $sql = "UPDATE system_addition_attr SET value = value - ? WHERE name = ? and sid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('iss', $total,$name, $sid);
        $stmt->execute();
        return true;
    }else{
        return 0;
    }
}

function unitmoneycount($sid,$name,$db){
    $name = 'u'.$name;
    $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$name'");
    $result_2 = $db->query("SELECT value from system_addition_attr where name = '$name' and sid = '$sid'");
    if ($result->num_rows > 0) {
            // 字段存在于 game1 表
        $sql = "SELECT `$name` from game1 where sid = '$sid'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return $row[$name];
    }elseif ($result_2->num_rows > 0){
            // 字段存在于 addition 表
        $row_2 = $result_2->fetch_assoc();
        return $row_2['value'];
    }else{
        return 0;
    }
}


?>