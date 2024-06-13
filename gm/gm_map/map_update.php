<?php
$scene_id = $target_midid;
$clmid = player\getmid($scene_id,$dblj);
$scene_name = $clmid ->mname;

//更新将直接执行一次场景刷新事件
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");
$sure_update = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&update=1&sid=$sid");
$update_html = <<<HTML
<p>是否更新“{$scene_name}[{$scene_id}]”场景<br/>
<a href="?cmd=$sure_update">确定更新</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="game.php?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
echo $update_html;

?>