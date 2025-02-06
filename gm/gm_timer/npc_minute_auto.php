<?php
// 允许脚本无限执行，避免超时
set_time_limit(0);
ignore_user_abort(true);

// 无限循环，每分钟执行一次
while (true) {
    // 获取当前需要执行事件的 NPC（例如 "上次更新时间" 超过 1 分钟）
    $stmt = $pdo->query("SELECT id, name, type FROM npc WHERE last_update <= NOW() - INTERVAL 1 MINUTE");
    $npcs = $stmt->fetchAll();

    if ($npcs) {
        foreach ($npcs as $npc) {
            $npcId = $npc['id'];
            $npcName = $npc['name'];

            // 让 `npc_task.php` 异步执行 NPC 任务
            runAsyncProcess(__DIR__ . "/npc_task.php $npcId");
            error_log("NPC {$npcName} (ID: {$npcId}) 开始执行定时任务");
        }

        // 更新 NPC 的 "last_update" 时间
        $pdo->exec("UPDATE npc SET last_update = NOW() WHERE last_update <= NOW() - INTERVAL 1 MINUTE");
    } else {
        error_log("无 NPC 需要执行分钟事件");
    }

    // 休眠 60 秒
    sleep(60);
}

// 让任务以后台进程运行（支持 Windows & Linux）
function runAsyncProcess($cmd) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        pclose(popen("start /B php " . escapeshellarg($cmd), "r"));
    } else {
        shell_exec("php " . escapeshellarg($cmd) . " > /dev/null 2>&1 &");
    }
}
?>
