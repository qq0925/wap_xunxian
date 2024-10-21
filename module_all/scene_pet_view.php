<?php
$sql = "select * from system_pet_scene where npid = '$petid'";
$cxjg = $dblj->query($sql);
if ($cxjg) {
    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
    $pet_name = $row['nname'];
}
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$pet_html = <<<HTML
{$pet_name}<br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $pet_html;
?>