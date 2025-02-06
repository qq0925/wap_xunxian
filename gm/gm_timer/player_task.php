<?php
require __DIR__.'/../../class/lexical_analysis.php';
require __DIR__.'/../../class/data_lexical.php';
require __DIR__.'/../../class/gm.php';
require __DIR__.'/../../class/event_data_get.php';
require __DIR__.'/../../pdo.php';
$dblj = DB::pdo();

if ($argc < 2) {
    exit("缺少玩家 ID 参数\n");
}

$sid = $argv[1]; // 获取传入的玩家 ID
\player\exec_global_event(24,'null',null,$sid,$dblj);
$uid = \player\getplayer($sid,$dblj)->uid;
\player\put_system_message_sql($uid,$dblj);
?>
