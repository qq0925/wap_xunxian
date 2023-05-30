<p>[表达式定义]</p>
<?php


$sql = "select * from system_exp_def";
$def_post_canshu = 0;
//var_dump($sql);
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
$attr_html = '';
//$hangshu = 0;
for ($i=0;$i<count($gm_ret);$i++){
    //var_dump($gm_retdj);
    $def_id = $gm_ret[$i]['id'];
   // var_dump($gm_djname);
    $def_type = $gm_ret[$i]['type'];
    $def_value = $gm_ret[$i]['value'];
    $hangshu += 1;
    $def_url = $encode->encode("cmd=gm_exp_def&def_post_canshu=2&def_id=$def_id&sid=$sid");
    $attr_html .=<<<HTML
    <a href="?cmd=$def_url">{$hangshu}.{$def_id}</a><br/>
HTML;
}
$def_post_canshu = 0;
$_SERVER['PHP_SELF'];
$gm_exp_def = $encode->encode("cmd=gm_exp_def&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_html = <<<HTML
$attr_html
<a href="?cmd=$gm_exp_def">增加表达式</a><br/>
<form>
快速搜索：<br/>
<input name="submit" type="hidden" title="提交" value="提交" />
<input name="kw" type="text" /><br/>
<input type="submit" value="提交" /></form><br /><br/>
<button onclick = "window.location.assign('?cmd=$gm')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>