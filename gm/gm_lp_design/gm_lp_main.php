<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$lp_html = "[生活职业设计]<br/>";
if($lp_canshu==0){
if($delete_lp_id){
    echo "已删除{$delete_lp_name}!<br/>";
    $dblj->exec("delete from system_lp where lp_id = '$delete_lp_id'");
}
$add_lp = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=3&sid=$sid");
$lp_ret = \player\getlp_all($dblj);
for($i=1;$i<@count($lp_ret)+1;$i++){
    $lp_id = $lp_ret[$i-1]['lp_id'];
    $lp_name = $lp_ret[$i-1]['lp_name'];
    $lp_desc = $lp_ret[$i-1]['lp_desc'];
    $lp_desc = $lp_desc==""?"暂无简介":$lp_desc;
    $modify = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=1&lp_id=$lp_id&sid=$sid");
    $delete = $encode->encode("cmd=gm_game_lpdesign&lp_name=$lp_name&lp_canshu=2&lp_id=$lp_id&sid=$sid");
    $lp_list .= <<<HTML
[$i].{$lp_name}<a href="?cmd=$modify">修改</a><a href="?cmd=$delete">删除</a><br/>
「{$lp_desc}」<br/>
HTML;
}

$lp_html .= <<<HTML
$lp_list<br/>
<a href="?cmd=$add_lp">增加生活职业</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($lp_canshu==1){
if($_POST['lp_op_type'] ==1){
    $dblj->exec("update system_lp set lp_name = '$lp_name',lp_desc = '$lp_desc' where lp_id = '$lp_id'");
    echo "修改成功!<br/>";
}elseif($_POST['lp_op_type'] ==2){
    $dblj->exec("insert into system_lp(lp_name,lp_desc)values('$lp_name','$lp_desc')");
    $lp_id = $dblj->lastInsertId();
    echo "新增成功!<br/>";
}
$ret_now = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=0&sid=$sid");
$lp_detail = \player\getlp_detail($lp_id,$dblj);
$lp_id = $lp_detail->lp_id;
$lp_name = $lp_detail->lp_name;
$lp_desc = $lp_detail->lp_desc;

$lp_html .= <<<HTML
<form method="POST">
<input name="lp_op_type" type="hidden" value="1">
<input name="$lp_id" type="hidden" value="{$lp_id}">
职业id：{$lp_id}<br/>
职业名称：<input name="lp_name" type="text" maxlength="10" value="{$lp_name}"><br/>
职业介绍：<textarea name="lp_desc" maxlength="1024" rows="4" cols="40" >{$lp_desc}</textarea><br/>
<input name="submit" type="submit" title="提交" value="提交"><br/>
</form><br/>
<a href="?cmd=$ret_now">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($lp_canshu==2){
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=0&sid=$sid");
$sure_update = $encode->encode("cmd=gm_game_lpdesign&delete_lp_name=$lp_name&delete_lp_id=$lp_id&lp_canshu=0&sid=$sid");
$lp_html .= <<<HTML
<p>是否删除职业：[{$lp_name}]<br/>
<a href="?cmd=$sure_update">确定删除</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
}elseif($lp_canshu==3){
$ret_now = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=0&sid=$sid");
$lp_add = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=1&sid=$sid");
$lp_html .= <<<HTML
<form action="?cmd=$lp_add" method="POST">
<input name="lp_op_type" type="hidden" value="2">
职业id：<br/>
职业名称：<input name="lp_name" type="text" maxlength="10" value="未命名"><br/>
职业介绍：<textarea name="lp_desc" maxlength="1024" rows="4" cols="40" ></textarea><br/>
<input name="submit" type="submit" title="提交" value="提交"><br/>
</form><br/>
<a href="?cmd=$ret_now">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}
echo $lp_html;
?>