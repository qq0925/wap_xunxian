<?php
$sql = "select * from system_pet_scene where npid = '$petid'";
$cxjg = $dblj->query($sql);
if ($cxjg) {
    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
    $pet_name = $row['nname'];
    $pet_sid = $row['nsid'];
    $pplayer = \player\getplayer($pet_sid,$dblj);
    $pet_master_name = $pplayer->uname;
}
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$pet_html = <<<HTML
{$pet_master_name}的{$pet_name}<br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $pet_html;
?>