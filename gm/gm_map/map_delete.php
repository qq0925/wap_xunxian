<?php
if($delete_canshu ==1){
    $cancel_main = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");
    $sure_main = $encode->encode("cmd=gm_post_4&delete_canshu=1&target_midid=$target_midid&area_id=$area_id&sid=$sid");
    $text =<<<HTML
    是否删除$map_name<br/>
<a href="game.php?cmd=$sure_main">确定</a> | <a href="game.php?cmd=$cancel_main">取消</a><br/>
HTML;
}
echo $text;
?>