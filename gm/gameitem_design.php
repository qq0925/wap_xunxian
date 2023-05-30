<p>[物品设计]</p>
<p>请选择物品类别：<br/></p>
<?php
$_SERVER['PHP_SELF'];
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_html = <<<HTML
<button onclick = "window.location.assign('?cmd=$gm')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>