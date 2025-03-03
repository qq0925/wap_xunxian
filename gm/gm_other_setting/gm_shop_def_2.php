<?php

if(!$op_canshu){
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$other_set = $encode->encode("cmd=gm_game_othersetting&canshu=11&shop_change=$shop_change&sid=$sid");
$all_page = $encode->encode("cmd=gm_game_othersetting&canshu=11&sid=$sid");
$edit_gift = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&shop_change=$shop_change&canshu=11&sid=$sid");
if(!empty($_POST)&&$_POST['submit']!="增加商品"){
echo "修改成功！<br/>";
// 准备 UPDATE 语句
$sql = "UPDATE system_shop SET shop_name = :shop_name, shop_desc = :shop_desc, buy_input_pos = :buy_input_pos, one_page_count = :one_page_count,one_css = :one_css,one_detail_css = :one_detail_css where shop_id = :shop_change";

// 使用 prepare 方法预处理 SQL 语句
$stmt = $dblj->prepare($sql);

// 绑定参数
$stmt->bindParam(':shop_name', $shop_name);
$stmt->bindParam(':shop_desc', $shop_desc);
$stmt->bindParam(':buy_input_pos', $buy_input_pos);
$stmt->bindParam(':one_page_count', $one_page_count);
$stmt->bindParam(':one_css', $one_css);
$stmt->bindParam(':one_detail_css', $one_detail_css);
$stmt->bindParam(':shop_change', $shop_change);
// 执行语句
$stmt->execute();

}
$sql = "select * from system_shop where shop_id = '$shop_change'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$shop_id = $ret['shop_id'];
$shop_name = $ret['shop_name'];
$shop_buy_input_pos = $ret['buy_input_pos'];
$shop_item_arr = $ret['item_list'];
$shop_one_page_count = $ret['one_page_count'];
$shop_one_css = $ret['one_css'];
$shop_one_detail_css = $ret['one_detail_css'];
$shop_item_list = explode(",",$shop_item_arr);
for($i=0;$i<@count($shop_item_list);$i++){
    $shop_gift_id = $shop_item_list[$i];
    $shop_gift_name = \player\getitem($shop_gift_id,$dblj)->iname;
    $shop_gift_name = \lexical_analysis\color_string($shop_gift_name);
    if($shop_gift_name){
    $shop_gift_html .="{$shop_gift_name},";
}else{
    $shop_gift_html = "无";
}
}
$shop_gift_html = rtrim($shop_gift_html,",");
$shop_cons_type_html = "<select name='buy_input_pos'>";
if ($shop_buy_input_pos == 0) {
        $shop_cons_type_html .= <<<HTML
<option value="0" selected>列表页</option>
<option value="1">商品页</option>
HTML;
    } elseif ($shop_buy_input_pos == 1) {
        $shop_cons_type_html .= <<<HTML
<option value="0">列表页</option>
<option value="1" selected>商品页</option>
HTML;
    }
$shop_cons_type_html .= "</select>";

$other_html = <<<HTML
[商城设计](ID:{$shop_id})<br/>
<form action="?cmd=$other_set" method="POST">
商城名称：<input type="text" name="shop_name" value="{$shop_name}"><br/>
商城备注：<input type="text" name="shop_desc" value="{$shop_desc}"><br/>
商品信息：{$shop_gift_html}<a href="?cmd=$edit_gift">编辑</a><br/>
购买输入框位置：$shop_cons_type_html<br/>
单页商品显示数量：<input type="text" name="one_page_count" value="{$shop_one_page_count}"><br/>
单件商品样式：<textarea type = "text" name="one_css" style="width: 320px; height: 100px">{$shop_one_css}</textarea><br/>
商品详情页样式：<textarea type = "text" name="one_detail_css" style="width: 320px; height: 100px">{$shop_one_detail_css}</textarea><br/>
<input type="submit" value="保存">
</form>
<br/>
<a href="?cmd=$all_page">商城列表</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $other_html;
}elseif($op_canshu ==2){
$last_page = $encode->encode("cmd=gm_game_othersetting&shop_change=$shop_change&canshu=11&sid=$sid");

if($remove_para){
    echo "移除成功！<br/>";
// 构建 SQL 语句，使用占位符来防止 SQL 注入
$sql_select = "SELECT item_list FROM system_shop WHERE shop_id = :record_id";
$stmt_select = $dblj->prepare($sql_select);
$stmt_select->bindParam(':record_id', $shop_change);
$stmt_select->execute();
$original_values = $stmt_select->fetchColumn();

// 使用 explode 函数拆分原始值
$array_values = explode(',', $original_values);

// 在数组中查找并移除值 $valueToRemove
$keyToRemove = array_search($remove_para, $array_values);
if ($keyToRemove !== false) {
    unset($array_values[$keyToRemove]);
}

// 将数组合并为新的值
$new_values = implode(',', $array_values);

// 更新数据库中的记录
$sql_update = "UPDATE system_shop SET item_list = :new_values WHERE shop_id = :record_id";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':new_values', $new_values);
$stmt_update->bindParam(':record_id', $shop_change);
$stmt_update->execute();
$dblj->exec("delete from system_shop_item where bind_iid = '$remove_para' and belong = '$shop_change'");


}
if($_POST['submit'] == "增加商品"){
    echo "新增成功！<br/>";
$sql_select = "SELECT item_list FROM system_shop WHERE shop_id = :record_id";
$stmt_select = $dblj->prepare($sql_select);
$stmt_select->bindParam(':record_id', $shop_change);
$stmt_select->execute();
$original_draw_shop = $stmt_select->fetchColumn();
$original_draw_shop .= ",".$add_this_id;
$original_draw_shop = ltrim($original_draw_shop,",");
// 构建 SQL 语句，使用占位符来防止 SQL 注入
$sql_update = "UPDATE system_shop SET item_list = :original_draw_shop WHERE shop_id = :record_id";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':original_draw_shop', $original_draw_shop);
$stmt_update->bindParam(':record_id', $shop_change);
$stmt_update->execute();
$sql_update = "insert into system_shop_item(belong,bind_iid,sale_open_time,sale_close_time,sale_money_type,sale_money,sale_discount)values(:record_id,:item_id,:sale_open_time,:sale_close_time,:sale_money_type,:sale_money,:sale_discount)";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':item_id', $add_this_id);
$stmt_update->bindParam(':record_id', $shop_change);
$stmt_update->bindParam(':sale_open_time', $sale_open_time);
$stmt_update->bindParam(':sale_close_time', $sale_close_time);
$stmt_update->bindParam(':sale_money_type', $sale_money_type);
$stmt_update->bindParam(':sale_money', $sale_money);
$stmt_update->bindParam(':sale_discount', $sale_discount);
$stmt_update->execute();

}

if($_POST['submit'] == "修改商品"){
    echo "修改成功！<br/>";
$sql_update = "UPDATE system_shop_item 
               SET sale_open_time = :sale_open_time, 
                   sale_close_time = :sale_close_time, 
                   sale_money_type = :sale_money_type, 
                   sale_money = :sale_money, 
                   sale_discount = :sale_discount where bind_iid = :item_id and belong = :record_id";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':item_id', $modify_id);
$stmt_update->bindParam(':record_id', $shop_change);
$stmt_update->bindParam(':sale_open_time', $sale_open_time);
$stmt_update->bindParam(':sale_close_time', $sale_close_time);
$stmt_update->bindParam(':sale_money_type', $sale_money_type);
$stmt_update->bindParam(':sale_money', $sale_money);
$stmt_update->bindParam(':sale_discount', $sale_discount);
$stmt_update->execute();

}

$sql = "select shop_name from system_shop where shop_id = '$shop_change'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$shop_name = $ret['shop_name'];

$sql = "select * from system_shop_item where belong = '$shop_change'";
$cxjg = $dblj->query($sql);
$item_ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($item_ret) +1;$i++){
    $shop_item_id = $item_ret[$i-1]['bind_iid'];
    $item_modify = $encode->encode("cmd=gm_game_othersetting&modify_id=$shop_item_id&edit_canshu=additem_modify&op_canshu=2&shop_change=$shop_change&canshu=11&sid=$sid");
    $item_remove = $encode->encode("cmd=gm_game_othersetting&remove_para=$shop_item_id&op_canshu=2&shop_change=$shop_change&canshu=11&sid=$sid");
    $shop_gift_name = \player\getitem($shop_item_id,$dblj)->iname;
    $shop_gift_name = \lexical_analysis\color_string($shop_gift_name);
    if($shop_gift_name){
    $shop_gift_html .="[{$i}].<a href='?cmd=$item_modify'>{$shop_gift_name}</a><a href='?cmd=$item_remove'>移除</a><br/>";
}else{
    $shop_gift_html = "无<br/>";
}
}


$shop_gift_html = rtrim($shop_gift_html,",");
$add_item = $encode->encode("cmd=gm_game_othersetting&post_canshu=-1&edit_canshu=additem&op_canshu=2&shop_change=$shop_change&canshu=11&sid=$sid");
$item_html = <<<HTML
<p>定义商城[{$shop_name}]的商品<br/>
$shop_gift_html
<a href="?cmd=$add_item">添加物品</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
</p>
HTML;
if($edit_canshu == 'additem'){
if($post_canshu == -1){
    $add_item_type = array(); // 创建一个空的关联数组
    for($i=0;$i<8;$i++){
        $add_item_type[$i] = $encode->encode("cmd=gm_game_othersetting&edit_canshu=additem&op_canshu=2&post_canshu=$i&shop_change=$shop_change&canshu=11&sid=$sid");
    }
$ret_last = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&shop_change=$shop_change&canshu=11&sid=$sid");
$item_html = <<<HTML
[定义商城的商品]<br/>
请选择物品的类型：<br/>
<a href="?cmd={$add_item_type[0]}">消耗品</a><br/>
<a href="?cmd={$add_item_type[1]}">兵器</a><br/>
<a href="?cmd={$add_item_type[2]}">防具</a><br/>
<a href="?cmd={$add_item_type[3]}">书籍</a><br/>
<a href="?cmd={$add_item_type[4]}">兵器镶嵌物</a><br/>
<a href="?cmd={$add_item_type[5]}">防具镶嵌物</a><br/>
<a href="?cmd={$add_item_type[6]}">任务物品</a><br/>
<a href="?cmd={$add_item_type[7]}">其它</a><br/>
<a href="?cmd=$ret_last" >返回上一页</a><br/>
HTML;
}else{
switch ($post_canshu) {
    case 0:
        $item_type = "消耗品";
        break;
    case 1:
        $item_type = "兵器";
        break;
    case 2:
        $item_type = "防具";
        break;
    case 3:
        $item_type = "书籍";
        break;
    case 4:
        $item_type = "兵器镶嵌物";
        break;
    case 5:
        $item_type = "防具镶嵌物";
        break;
    case 6:
        $item_type = "任务物品";
        break;
    case 7:
        $item_type = "其它";
        break;
    default:
        $item_type = "未知"; // 可以添加默认情况
}
    $cxallmap = \gm\get_item_list($dblj,$item_type);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $iname = $cxallmap[$i]['iname'];
    $iid = $cxallmap[$i]['iid'];
    $br++;
    $target_iid = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&edit_canshu=additem_edit&target_id=$iid&post_canshu=$post_canshu&shop_change=$shop_change&canshu=11&sid=$sid");
    $item_list_detail .=<<<HTML
        <a href="?cmd=$target_iid" >$hangshu.$iname(i{$iid})</a><br/>
HTML;
}
$ret_last = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&edit_canshu=additem&post_canshu=-1&shop_change=$shop_change&canshu=11&sid=$sid");
$item_html = <<<HTML
请选择物品<br/>
$item_list_detail<br/>
<a href="?cmd=$ret_last" >返回上一页</a><br/>
HTML;
}
}
if($edit_canshu == 'additem_edit'){

$item_para = player\getitem($target_id,$dblj);
$item_name = $item_para ->iname;
$item_price = $item_para ->iprice;

$stmt = $dblj->prepare('SELECT * FROM system_money_type');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 构建 select 元素的 HTML 代码
$select = '货币类型：<select name="sale_money_type">';
foreach ($data as $money_row) {
    $select .= '<option value="' . htmlspecialchars($money_row['rid']) . '" ' . '>' . htmlspecialchars($money_row['rname']) . '</option>';
}
$select .= '</select><br/>';


$last_page = $encode->encode("cmd=gm_game_othersetting&edit_canshu=additem&post_canshu=$post_canshu&op_canshu=2&canshu=$canshu&shop_change=$shop_change&&sid=$sid");
$item_add = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&shop_change=$shop_change&canshu=$canshu&sid=$sid");
$default_time = date('Y-m-d H:i');

$item_html = <<<HTML
<link rel="stylesheet" href="/css/flatpickr.min.css">
<script src="/js/flatpickr.js"></script>
<p>新增商品“{$item_name}”<br/>
<form action="?cmd=$item_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$target_id}">
{$select}
商品价格：<input name="sale_money" value="{$item_price}"><br/>
折扣：<input name="sale_discount" value="100">%<br/>
开放销售时间：<input type="text" id="openTime" name="sale_open_time" value ="$default_time"><br/>
关闭销售时间：<input type="text" id="closeTime" name="sale_close_time" value ="$default_time"><br/>
<input name="submit" type="submit" title="确定" value="增加商品"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
</p>
<script>
    flatpickr("#openTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    flatpickr("#closeTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
HTML;
}

if($edit_canshu == 'additem_modify'){
$item_para = player\getitem($modify_id,$dblj);
$item_name = $item_para ->iname;

$sql = "select * from system_shop_item where belong = '$shop_change' and bind_iid = '$modify_id'";
$cxjg = $dblj->query($sql);
$item_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$one_sale_money = $item_ret['sale_money'];
$one_sale_money_type = $item_ret['sale_money_type'];
$one_sale_open_time = $item_ret['sale_open_time'];
$one_sale_close_time = $item_ret['sale_close_time'];
$one_sale_discount = $item_ret['sale_discount'];
$stmt = $dblj->prepare('SELECT * FROM system_money_type');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 构建 select 元素的 HTML 代码
$select = '货币类型：<select name="sale_money_type">';
foreach ($data as $money_row) {
    $selected = ($money_row['rid'] == $one_sale_money_type) ? 'selected' : '';
    $select .= '<option value="' . htmlspecialchars($money_row['rid']) . '" ' . $selected . '>' . htmlspecialchars($money_row['rname']) . '</option>';
}
$select .= '</select><br/>';


$last_page = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&canshu=$canshu&shop_change=$shop_change&&sid=$sid");
$item_modify_sure = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&shop_change=$shop_change&canshu=$canshu&sid=$sid");
$one_sale_open_time = $default_time?: date('Y-m-d H:i');
$item_html = <<<HTML
<link rel="stylesheet" href="/css/flatpickr.min.css">
<script src="/js/flatpickr.js"></script>
<p>修改商品“{$item_name}”<br/>
<form action="?cmd=$item_modify_sure" method="post">
<input name="modify_id" type="hidden" title="确定" value="{$modify_id}">
{$select}
商品价格：<input name="sale_money" value="{$one_sale_money}"><br/>
折扣：<input name="sale_discount" value="{$one_sale_discount}">%<br/>
开放销售时间：<input type="text" id="openTime" name="sale_open_time" value ="{$one_sale_open_time}"><br/>
关闭销售时间：<input type="text" id="closeTime" name="sale_close_time" value ="{$one_sale_close_time}"><br/>
<input name="submit" type="submit" title="确定" value="修改商品"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
</p>
<script>
    flatpickr("#openTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    flatpickr("#closeTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
HTML;
}
echo $item_html;

}
?>
