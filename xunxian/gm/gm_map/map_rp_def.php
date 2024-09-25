<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");




$rp_html = <<<HTML
<p>定义场景的资源点<br/>
$rp_list
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $rp_html;
?>