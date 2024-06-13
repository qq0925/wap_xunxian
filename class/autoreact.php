<?php
include_once 'pdo.php';
function player_minute(){
    global $dblj;
    $nowdate = date('Y-m-d H:i:s');
    $sql = "update gm_game_basic set game_player_regular_minute = '$nowdate'";
    $dblj->exec($sql);
    return $nowdate;
}

// function npc_minute(){
//     echo "你好！";
// }

// function item_minute(){
//     echo "你好！";
// }

// function scene_minute(){
//     echo "你好！";
// }

// function system_minute(){
//     echo "你好！";
// }
?>