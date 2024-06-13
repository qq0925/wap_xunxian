<?php
$gm = $encode->encode("cmd=gm&sid=$sid");

if($delete_auc_id){
    echo "已删除{$delete_auc_name}!<br/>";
    $dblj->exec("delete from system_auc where auc_id = '$delete_auc_id'");
}
if($_POST['auc_op_type'] ==1){
    $dblj->exec("update system_auc set auc_name = '$auc_name',auc_desc = '$auc_desc',auc_fee = '$auc_fee',auc_money = '$auc_money' where auc_id = '$auc_id'");
    echo "修改成功!<br/>";
}elseif($_POST['auc_op_type'] ==2){
    $dblj->exec("insert into system_auc(auc_name,auc_desc,auc_area,auc_money,auc_fee)values('$auc_name','$auc_desc','$area_id','$auc_money','$auc_fee')");
    $auc_id = $dblj->lastInsertId();
    echo "新增成功!<br/>";
}


$auc_html = "[拍卖行设计]<br/>";
if($auc_canshu==0){

$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$cxallmap = \player\getqy_all($dblj);
for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
    $target_mid = $encode->encode("cmd=gm_game_othersetting&canshu=9&auc_canshu=1&area_id=$qy_id&sid=$sid");
    $map .=<<<HTML
[$hangshu].<a href="?cmd=$target_mid" >$qyname</a><br/>
HTML;
}
$auc_html .= <<<HTML
请选择拍卖行所属的区域：<br/>
$map<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}elseif($auc_canshu==1){
$ret_now = $encode->encode("cmd=gm_game_othersetting&canshu=9&auc_canshu=0&sid=$sid");
$add_auc = $encode->encode("cmd=gm_game_othersetting&area_id=$area_id&canshu=9&auc_canshu=3&sid=$sid");

$auc_ret = \player\getauc_city($dblj,$area_id);
for($i=1;$i<@count($auc_ret)+1;$i++){
    $auc_id = $auc_ret[$i-1]['auc_id'];
    $auc_name = $auc_ret[$i-1]['auc_name'];
    $auc_desc = $auc_ret[$i-1]['auc_desc'];
    $auc_desc = $auc_desc==""?"暂无简介":$auc_desc;
    $modify = $encode->encode("cmd=gm_game_othersetting&canshu=9&area_id=$area_id&auc_canshu=2&auc_id=$auc_id&sid=$sid");
    $delete = $encode->encode("cmd=gm_game_othersetting&canshu=9&area_id=$area_id&auc_name=$auc_name&auc_canshu=4&auc_id=$auc_id&sid=$sid");
    $auc_list .= <<<HTML
[$i].{$auc_name}<a href="?cmd=$modify">修改</a><a href="?cmd=$delete">删除</a><br/>
「{$auc_desc}」<br/>
HTML;
}
$auc_html .= <<<HTML
$auc_list<br/>
<a href="?cmd=$add_auc">增加拍卖行</a><br/>
<a href="?cmd=$ret_now">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($auc_canshu==2){

$last_page = $encode->encode("cmd=gm_game_othersetting&area_id=$area_id&canshu=9&auc_canshu=1&sid=$sid");

$auc_detail = \player\getauc_city($dblj,$area_id,$auc_id);
$money_arr = \player\getmoney_type_all($dblj);
$auc_id = $auc_detail['auc_id'];
$auc_name = $auc_detail['auc_name'];
$auc_desc = $auc_detail['auc_desc'];
$auc_money = $auc_detail['auc_money'];
$auc_fee = $auc_detail['auc_fee'];
$select_html = "<select name = 'auc_money'>";
foreach ($money_arr as $currency) {
    $rid = $currency['rid'];
    $rname = $currency['rname'];
    $selected = ($rid == $auc_money) ? 'selected' : '';

    $select_html .= "<option value=\"$rid\" $selected>$rname</option>";
}
$select_html .= "</select><br/>";


$auc_html .= <<<HTML
<form method="POST">
<input name="auc_op_type" type="hidden" value="1">
<input name="auc_id" type="hidden" value="{$auc_id}">
拍卖行id：{$auc_id}<br/>
拍卖行名称：<input name="auc_name" type="text" maxlength="10" value="{$auc_name}"><br/>
拍卖行介绍：<textarea name="auc_desc" maxlength="1024" rows="4" cols="40" >{$auc_desc}</textarea><br/>
拍卖行货币：$select_html
拍卖行手续费：<input name="auc_fee" type="text" maxlength="10" value="{$auc_fee}">%<br/>
<input name="submit" type="submit" title="提交" value="提交"><br/>
</form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($auc_canshu==3){
$ret_now = $encode->encode("cmd=gm_game_othersetting&canshu=9&area_id=$area_id&auc_canshu=1&sid=$sid");
$auc_add = $encode->encode("cmd=gm_game_othersetting&canshu=9&area_id=$area_id&auc_canshu=1&sid=$sid");

$money_arr = \player\getmoney_type_all($dblj);
$select_html = "<select name = 'auc_money'>";
foreach ($money_arr as $currency) {
    $rid = $currency['rid'];
    $rname = $currency['rname'];
    $select_html .= "<option value=\"$rid\" >$rname</option>";
}
$select_html .= "</select><br/>";


$auc_html .= <<<HTML
<form action="?cmd=$auc_add" method="POST">
<input name="auc_op_type" type="hidden" value="2">
拍卖行id：<br/>
拍卖行名称：<input name="auc_name" type="text" maxlength="10" value="未命名"><br/>
拍卖行介绍：<textarea name="auc_desc" maxlength="1024" rows="4" cols="40" ></textarea><br/>
拍卖行货币：$select_html
拍卖行手续费：<input name="auc_fee" type="text" maxlength="10" value="10">%<br/>
<input name="submit" type="submit" title="提交" value="提交"><br/>
</form><br/>
<a href="?cmd=$ret_now">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($auc_canshu==4){
$last_page = $encode->encode("cmd=gm_game_othersetting&area_id=$area_id&canshu=9&auc_canshu=1&sid=$sid");
$sure_update = $encode->encode("cmd=gm_game_othersetting&area_id=$area_id&canshu=9&delete_auc_name=$auc_name&delete_auc_id=$auc_id&auc_canshu=1&sid=$sid");
$auc_html .= <<<HTML
<p>是否删除拍卖行：[{$auc_name}]<br/>
<a href="?cmd=$sure_update">确定删除</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
}
echo $auc_html;
?>