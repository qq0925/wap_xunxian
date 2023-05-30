<p>[技能定义]</p>
<?php
$_SERVER['PHP_SELF'];
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_html = <<<HTML
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>