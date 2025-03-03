<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");

if(isset($_POST['add_name'])){
    $add_name = $_POST['add_name'];
    $sql = "select shop_name from system_shop where shop_name = '$add_name'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('shop_name',$true_name);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    if(!$ret){
    $page_count = \player\getgameconfig($dblj)->list_row;
    $sql = "insert into system_shop(shop_name,one_page_count) values ('$add_name','$page_count')";
    $dblj->exec($sql);
    }else{
        echo "名称重复！<br/>";
    }
}
if($delete_canshu){
    $dblj->exec("delete from system_shop where shop_id = '$delete_canshu'");
    $dblj->exec("delete from system_shop_item where belong = '$delete_canshu'");
    echo "已删除！<br/>";
}

if(!$shop_canshu){
$sql = "select shop_id,shop_name from system_shop";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($ret)+1;$i++){
$shop_id = $ret[$i-1]['shop_id'];
$shop_name = $ret[$i-1]['shop_name'];
$shop_detail = $encode->encode("cmd=gm_game_othersetting&canshu=11&shop_change=$shop_id&sid=$sid");
$shop_delete = $encode->encode("cmd=gm_game_othersetting&canshu=11&delete_canshu=$shop_id&sid=$sid");
$del_url = "game.php?cmd=$shop_delete";
$shop_list .=<<<HTML
[$i].<a href="?cmd=$shop_detail">{$shop_name}</a>(ID:{$shop_id})<a href="#" onclick="return confirmAction('$del_url', '{$shop_name}')">删除</a><br/>
HTML;
}

$add_html = <<<HTML
<form method = "post">
商城名称：<input type="text" name="add_name" size="17" placeholder="请输入商城名称：">
<input name="submit" type="submit" title="添加属性" value="添加"/><br/>
</form>
HTML;

$creat_shop = $encode->encode("cmd=gm_game_othersetting&canshu=11&create_canshu=1&sid=$sid");
$shop_html = <<<HTML
[商城管理]<br/>
$shop_list
$add_html
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}

if($create_canshu ==1){
$last_page = $encode->encode("cmd=gm_game_othersetting&canshu=11&sid=$sid");
$shop_html = <<<HTML
<form method="post">
<input name="create_id" type="hidden" value="1">
<input name="create_canshu" type="hidden" value="0">
商城名称:<input name="shop_name" type="text" maxlength="20" value=""><br/>
商城备注:<textarea name="shop_desc" maxlength="1024" rows="4" cols="40"></textarea><br/>
item_list物品列表<br/>
buy_input_pos购买输入框位置<br/>
one_page_count单页显示商品数量<br/>
one_css单个商品的样式<br/>
<input name="submit" type="submit" title="修改" value="修改">
</form><br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}


if($shop_canshu){
$sql = "select * from system_shop where shop_id = '$shop_canshu'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$shop_id = $ret['shop_id'];
$shop_name = $ret['shop_name'];
$shop_exp = $ret['shop_exp'];
$show_count = $ret['show_count'];
$show_obj = $ret['show_obj'];
$shop_selected = $ret['show_obj'] ==1?"selected":"";
$show_cond = $ret['show_cond'];
$last_page = $encode->encode("cmd=gm_game_othersetting&canshu=11&sid=$sid");
$shop_html = <<<HTML
<form method="post">
<input name="shop_id" type="hidden" value="{$shop_id}">
商城名称:<input name="shop_name" type="text" maxlength="20" value="{$shop_name}"><br/>
排行值表达式:<textarea name="shop_exp" maxlength="1024" rows="4" cols="40">{$shop_exp}</textarea><br/>
排行位数:<input name="show_count" type="text" value="{$show_count}" maxlength="3"/><br/>
排行类别:<select name="show_obj" value="{$show_obj}">
<option value="0">玩家</option>
<option value="1" {$shop_selected}>宠物</option>
</select><br/>
显示条件:<textarea name="show_cond" maxlength="1024" rows="4" cols="40">{$show_cond}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改"></form><br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}
echo $shop_html;
?>
<script>
function confirmAction(del_url, step_order) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要删除 “" + step_order + "” 这个商城吗？")) {
        // 使用传入的具体删除链接
        window.location.href = del_url;
    }
    return false;
}
</script>