<?php
require __DIR__.'/../../pdo.php';
// 允许无限执行，防止超时
set_time_limit(0);
ignore_user_abort(true);
$dblj = DB::pdo();
// 无限循环，每分钟执行一次
while (true) {
    // 获取当前活跃玩家
    $stmt = $dblj->query("SELECT sid FROM game1 WHERE endtime >= NOW() - INTERVAL 1 MINUTE");//并且now-endtime小于设定的离线时长
    $players = $stmt->fetchAll();
//获取所有now-endtime小于设定的离线时长的玩家，将其在线状态置为0
    if ($players) {
        foreach ($players as $player) {
            $playerId = $player['sid'];

            // 让 `player_task.php` 处理单个玩家任务
            runAsyncProcess(__DIR__ . "/player_task.php $playerId");
        }
    } else {
        error_log("无在线玩家，跳过本次任务");
    }

    // 休眠 60 秒
    sleep(60);
}

// 让任务以后台进程运行（支持 Windows & Linux）
function runAsyncProcess($cmd) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        pclose(popen("start /B php " . escapeshellarg($cmd), "r"));
    } else {
        shell_exec("php74 " . escapeshellarg($cmd) . " > /dev/null 2>&1 &");
    }
}
?>
