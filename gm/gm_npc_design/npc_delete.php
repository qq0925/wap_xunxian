<?php
if($delete_canshu ==1){
    $cancel_main = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
    $sure_main = $encode->encode("cmd=gm_npc_second&qy_id=$qy_id&delete_canshu=1&npc_id=$npc_id&sid=$sid");
    $text =<<<HTML
    是否删除$npc_name<br/>
<a href="game.php?cmd=$sure_main">确定</a> | <a href="game.php?cmd=$cancel_main">取消</a><br/>
HTML;
}
echo $text;
?>