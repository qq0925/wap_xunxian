<?php

if($buy_canshu==2){
$buy_count = $_POST['buy_count'];
if($buy_count<=0){
    echo "输入有误！<br/>";
}else{
$pre_item = \gm\getshop_item($shop_id,$item_id,$dblj);
$buy_sale_money_type = $pre_item['sale_money_type'];
$buy_sale_money = $pre_item['sale_money'];
$buy_sale_discount = $pre_item['sale_discount'];
$need_count = floor($buy_sale_money *$buy_count*$buy_sale_discount/100);
$player = \player\getplayer($sid,$dblj);
$item_weight = \player\getitem($item_id,$dblj)->iweight;
$item_total_weight = $buy_count * $item_weight;
$player_last_burthen = $player->umax_burthen - $player->uburthen;
$player_money_count = \gm\unitmoneycount($sid,$buy_sale_money_type,$db);
if($player_last_burthen >=$item_total_weight){
if($player_money_count>=$need_count){
$item_name = \player\getitem($item_id,$dblj)->iname;
$item_name = \lexical_analysis\color_string($item_name);
\player\additem($sid,$item_id,$buy_count,$dblj);
$buy_result = \gm\calcmoney($sid,$buy_sale_money_type,$need_count,$db);
$sql = "select rname,runit from system_money_type where rid = '$buy_sale_money_type'";
$cxjg = $dblj->query($sql);
$money_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$pay_type = $money_ret['rname'];
$pay_runit = $money_ret['runit'];
echo "购买成功，你花了{$need_count}{$pay_runit}{$pay_type}购买了{$item_name}x{$buy_count}!<br/>";

}else{
    echo "你的对应货币不足！<br/>";
}
}else{
    echo "负重不足！<br/>";
}
}

}

$sql = "SELECT buy_input_pos,one_detail_css FROM system_shop WHERE shop_id = '$shop_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$shop_buy_input_pos = $ret['buy_input_pos'];
$shop_one_detail_css = $ret['one_detail_css'];

// 获取商品列表
$sql = "SELECT * FROM system_shop_item WHERE belong = :shop_id and bind_iid = :item_id";
$stmt = $dblj->prepare($sql);
$stmt->execute(['shop_id' => $shop_id,'item_id' => $item_id]);
$one_item = $stmt->fetch(PDO::FETCH_ASSOC);

// 解析模板并渲染商品
$rendered_html = '';

$item_template = $shop_one_detail_css;

$item_money_type = $one_item['sale_money_type'];
$money_type_para = \player\getmoney_type_all($dblj,$item_money_type);
$money_type_name = $money_type_para['rname'];
$money_type_unit = $money_type_para['runit'];
$item_para = \player\getitem($item_id,$dblj);
$item_name = \lexical_analysis\color_string($item_para->iname);
$item_desc = \lexical_analysis\color_string($item_para->idesc);
// 替换商品名称和价格
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$ret_page = $encode->encode("cmd=self_module_api&ucmd=$cmid&page_name=$page_name&sid=$sid");
$ret_url = "<a href='?cmd=$ret_page'>返回上一级</a>";

$item_template = str_replace('{item_name_text}', $item_name, $item_template);
$item_template = str_replace('{item_desc}', $item_desc, $item_template);
$item_template = str_replace('{item_money}', $one_item['sale_money'], $item_template);
$item_template = str_replace('{item_money_name}', $money_type_name, $item_template);
$item_template = str_replace('{item_money_unit}', $money_type_unit, $item_template);
$item_template = str_replace('{last_page}', $ret_url, $item_template);
$buy_sure_url = $encode->encode("cmd=check_shop_item&buy_canshu=2&shop_id=$shop_id&item_id=$item_id&ucmd=$cmid&page_name=$page_name&sid=$sid");
// 替换输入框
if (strpos($item_template, '{input_pos}') !== false) {
    $input_html = "<form action='?cmd=$buy_sure_url' method='post'>";
    $input_html .= "<input type='number' name='buy_count' min='1' value='1'>";
    $item_template = str_replace('{input_pos}', $input_html, $item_template);
}

// 替换提交按钮
if (strpos($item_template, '{submit_pos}') !== false) {
    $submit_html = "<input type='submit' value='购买'>";
    $item_template = str_replace('{submit_pos}', $submit_html, $item_template);
    $item_template .= "</form>";
}

$order = array("\r\n", "\n", "\r");
$replace = "<br/>";
$item_template=str_replace($order, $replace, $item_template);

$rendered_html .= $item_template;
echo $rendered_html;


?>