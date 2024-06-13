<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$money_add = $encode->encode("cmd=gm_game_othersetting&canshu=6&sid=$sid");

if(!empty($_POST) && !$change_basic_id){
$sql = "insert into system_money_type(rid,rname,runit) values('$money_id','$money_name','$money_unit')";
$cxjg = $dblj->exec($sql);
}

if($delete_id){
$sql = "delete from system_money_type where rid = '$delete_id'";
$cxjg = $dblj->exec($sql);
}

if($change_basic_id){
$sql = "update system_money_type set rname='$money_name',runit='$money_unit' where rid='$change_basic_id'";
$cxjg = $dblj->exec($sql);
$sql = "update gm_game_basic set money_name='$money_name',money_measure='$money_unit' where game_id='19980925'";
$cxjg = $dblj->exec($sql);
}

$sql = "select * from system_money_type";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);

if($ret){
for($i=0;$i<@count($ret);$i++){
    $hangshu = $i +1;
    $rname = $ret[$i]['rname'];
    $rid = $ret[$i]['rid'];
    $runit = $ret[$i]['runit'];
    $rif_default = $ret[$i]['rif_default'];
    $delete = $encode->encode("cmd=gm_game_othersetting&canshu=6&delete_id=$rid&sid=$sid");
    $change = $encode->encode("cmd=gm_game_othersetting&canshu=6&change_id=$rid&change_name=$rname&change_unit=$runit&sid=$sid");
    if($rif_default ==0){
    $money_list .=<<<HTML
    <p>{$hangshu}.(ID:{$rid})[{$rname}](单位：{$runit})<a href="?cmd=$delete">删除</a></p>
HTML;
}else{
    $money_list .=<<<HTML
    <font color="red"><p>{$hangshu}.(ID:{$rid})[{$rname}](单位：{$runit})[默认货币]<a href="?cmd=$change">修改</a></p></font>
HTML;
}
}
}


$money_html = <<<HTML
[货币管理]<br/><br/>
$money_list
<form action="?cmd=$money_add" method="POST">
币种名称：<input name="money_name" size="5"><br/>
币种标识：<input name="money_id" size="5"><br/>
币种单位：<input name="money_unit" size="5"><br/>
<input name="submit" type="submit" title="保存" value="创建币种" />
</form>
<br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;

if($change_id){
$money_change = $encode->encode("cmd=gm_game_othersetting&change_basic_id=$change_id&canshu=6&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&canshu=6&sid=$sid");
$money_html = <<<HTML
[货币管理]-修改默认货币<br/><br/>
<form action="?cmd=$money_change" method="POST">
币种标识：<input name="money_id" size="5" value="{$change_id}" disabled><br/>
币种名称：<input name="money_name" size="5" value="{$change_name}" ><br/>
币种单位：<input name="money_unit" size="5" value="{$change_unit}"><br/>
<input name="submit" type="submit" title="保存" value="修改" />
</form>
<br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}




echo $money_html;
?>