<?php


if($equip_type ==1){
$gm = $encode->encode("cmd=gm&sid=$sid");
$equip_main = $encode->encode("cmd=gm_equip_def&def_post_canshu=3&gm_post_canshu=1&sid=$sid");
$equip_html = <<<HTML
<p>[装备类型定义]<br/>
增加兵器类别<br/>
</p>
<form action="?cmd=$equip_main" method="post">
类别名称:<input name="name" type="text" maxlength="50"/><br/>
<input name="submit" type="submit" title="增加" value="增加"/><input name="submit" type="hidden" title="增加" value="增加"/></form><br/>
<button onClick="javascript:history.back(-1);">返回上级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif ($equip_type ==2) {
$gm = $encode->encode("cmd=gm&sid=$sid");
$equip_main = $encode->encode("cmd=gm_equip_def&def_post_canshu=3&gm_post_canshu=2&sid=$sid");
$equip_html = <<<HTML
<p>[装备类型定义]<br/>
增加防具类别<br/>
</p>
<form action="?cmd=$equip_main" method="post">
类别名称:<input name="name" type="text" maxlength="50"/><br/>
<input name="submit" type="submit" title="增加" value="增加"/><input name="submit" type="hidden" title="增加" value="增加"/></form><br/>
<button onClick="javascript:history.back(-1);">返回上级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}
echo $equip_html;
?>