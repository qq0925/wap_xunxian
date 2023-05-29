<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
require_once 'class/lexical_analysis.php';

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_main_page($dblj);
$br = 0;
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$logout = $encode->encode("cmd=logout&sid=$sid");
//var_dump($sid);
//echo "<pre>";
//var_dump($get_main_page);
//echo "</pre>";
//echo "<br/>";
for ($i=0;$i<count($get_main_page);$i++){
    //$hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_value = nl2br($main_value);
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    
    
    //var_dump($main_value);
    $main_value=process_string($main_value,$sid);
   // echo $main_value_2;
    
    
    
    switch ($main_type) {
        case '1':
    $game_main .=<<<HTML
    $main_value
HTML;
            break;
        case '2':
                $game_main .=<<<HTML
    <a href="?cmd=$mian_target_event" >$main_value</a>
HTML;
            break;
        case '3':
                $game_main .=<<<HTML
    <a href="?cmd=$mian_target_func" >$main_value</a>
HTML;
            break;
        case '4':
                $game_main .=<<<HTML
    <a href="?cmd=$mian_link_value" >$main_value</a>
HTML;
            break;
    }
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main<br/><br/>
<a href="game.php?cmd=$gm_main">设计大厅</a><br/>
<a href="game.php?cmd=$logout">退出游戏</a><br/>
HTML;
echo $all;
?>