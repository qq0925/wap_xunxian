<?php

$get_exp_def_page = \gm\get_exp_def($dblj);



$exp_main = "?cmd=gm_exp_def&def_post_canshu=1&sid=$sid";
$update_def = "?cmd=gm_exp_def&def_post_canshu=4&sid=$sid";
$exp_delete = "?cmd=gm_exp_def&def_post_canshu=3&def_id=$def_id&sid=$sid";
$gm = $encode->encode("cmd=gm&sid=$sid");

//$op_type = 0;
//$last_pos = 0;
if(!empty($def_id)){
$sql = "select * from system_exp_def where id = '$def_id'";
$cxjg = $dblj->query($sql);
$cxjg->bindColumn('value',$def_value);
$cxjg->bindColumn('type',$def_type);
$cxjg->bindColumn('id',$def_id);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
//$op_type = 1;
}
if($def_post_canshu !=2){
$exp_html = <<<HTML
<p>[表达式定义]<br/>
增加表达式<br/>
</p>
<form action=$exp_main method="post">
表达式标识:<input name="key" type="text" maxlength="50"/><br/>
表达式类型:<select name="exp_type" value="1">
<option value="1" selected="selected">数值表达式</option>
<option value="2">条件表达式</option>
<option value="3">文本表达式</option>
</select><br/>
表达式:<textarea name="exp" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onClick="javascript:history.back(-1);">返回上级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif ($def_post_canshu ==2) {
    
    $exp_delete = "?cmd=gm_exp_def&def_post_canshu=3&def_id=$def_id&sid=$sid";
    if($def_type=="1"){
    $gm_select_1 = "selected";
}elseif ($def_type=="2") {
    $gm_select_2 = "selected";
}elseif ($def_type=="3") {
    $gm_select_3= "selected";
}
$exp_html = <<<HTML
<p>[表达式定义]<br/>
修改表达式<br/>
<a href=$exp_delete>删除该表达式</a><br/>
</p>
<form action=$update_def method="post">
<input name="okey" type="hidden" value="$def_id"/>表达式标识:<input name="key" type="text" value="$def_id" maxlength="50"/><br/>
表达式类型:<select name="def_type" value="$def_type">
<option value="1" $gm_select_1>数值表达式</option>
<option value="2" $gm_select_2>条件表达式</option>
<option value="3" $gm_select_3>文本表达式</option>
</select><br />
表达式:<textarea name="exp" maxlength="1024" rows="4" cols="40">$def_value</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onClick="javascript:history.back(-1);">返回上级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}
echo $exp_html;
?>