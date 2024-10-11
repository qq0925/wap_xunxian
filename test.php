<?php
require 'class/player.php';
include 'pdo.php';
require __DIR__ . '/vendor/autoload.php';
include 'class/global_event_step_change.php';
use React\EventLoop\Loop;

$b = 60; // 定时器的间隔时间（秒）
$sid = '959c9277a3e15eacff9e5f117e51f5bb'; // 这个是从你的系统传入的玩家 sid
$cmd = 'some_command'; // 当前命令

$loop = Loop::get();

// 定义一个定时函数，用于检查并更新玩家状态
$loop->addPeriodicTimer($b, function () use ($sid, $dblj, $cmd) {
    // 获取玩家信息
    $player = \player\getplayer($sid, $dblj);
    $nowdate = date('Y-m-d H:i:s');
    
    // 获取游戏配置
    $gameconfig = \player\getgameconfig($dblj);
    $system_now_minute_time = $gameconfig->game_player_regular_minute;

    // 计算时间差

    $system_offline_time = $gameconfig->offline_time;

    // 循环检查条件，并更新数据库
    if (floor($cmd != 'login' && $cmd != 'cjplayer' && $cmd != 'cj')) {

        // 执行全局事件（可选部分）
         \player\exec_global_event(24, 'null', null, $sid, $dblj);
        // 更新玩家的 minutetime
        //$player->minutetime = date('Y-m-d H:i:s', strtotime($player->minutetime) + 5); // 增加 60 秒

        // 更新数据库中的 minutetime
        $sql = "UPDATE game1 SET minutetime = DATE_ADD(minutetime, INTERVAL 1 MINUTE) WHERE sid = '$sid'";
        $dblj->exec($sql);

        // 刷新输出
        // ob_flush();
        // flush();
    }

    echo "Player state updated at " . date('Y-m-d H:i:s') . "\n";
});

// 运行服务器（假设你有 HTTP 服务器逻辑）
$http = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) {
    return React\Http\Message\Response::plaintext(
        "Game server is running.\n"
    );
});

$socket = new React\Socket\SocketServer('0.0.0.0:8787', [], $loop);
$http->listen($socket);

echo "Server running at http://0.0.0.0:8787" . PHP_EOL;

// 启动事件循环
$loop->run();
