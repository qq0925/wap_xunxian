<?php
if($delete_canshu ==1){
    $cancel_main = $encode->encode("cmd=game_item_list&item_id=$item_id&sid=$sid");
    $sure_main = $encode->encode("cmd=game_item_list&item_id=$item_id&delete_canshu=1&sid=$sid");
    $text =<<<HTML
    是否删除$item_name<br/>
<a href="game.php?cmd=$sure_main">确定</a> | <a href="game.php?cmd=$cancel_main">取消</a><br/>
HTML;
}
echo $text;
?>