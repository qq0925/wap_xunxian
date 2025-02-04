<?php

class PhpRunner {
    private $pidFile;
    private $lockFile;
    private $phpBinary;

    public function __construct() {
        $this->pidFile = __DIR__ . '/daemon.pid';  // 守护进程的PID文件
        $this->lockFile = __DIR__ . '/daemon.lock'; // 文件锁
        $this->phpBinary = 'php74'; // 你希望执行的 PHP 版本命令
    }

    // 启动守护进程
    public function startDaemon($scriptPath) {
        // 检查守护进程是否已经在运行
        if ($this->isDaemonRunning()) {
            echo "守护进程已经在运行！<br/>";
            return;
        }

        // 获取文件锁，确保任务不会重复执行
        $lock = fopen($this->lockFile, 'c');
        if (!flock($lock, LOCK_EX | LOCK_NB)) {  // 获取文件锁
            echo "任务正在运行中，退出。\n";
            exit;  // 退出当前进程，避免重复执行
        }

        // 执行命令，确保进程常驻后台
        $cmd = sprintf(
            'nohup %s %s > /dev/null 2>&1 & echo $!',
            escapeshellarg($this->phpBinary),  // PHP 命令
            escapeshellarg($scriptPath)        // 需要执行的 PHP 脚本
        );

        // 执行后台任务，并获取PID
        $pid = (int) shell_exec($cmd);
        if ($pid > 0) {
            file_put_contents($this->pidFile, $pid);  // 保存PID
            echo "守护进程已启动 (PID: $pid)<br/>";
        } else {
            echo "启动失败！权限不足或你正在使用windows环境！请注释掉或者删除php.ini中disable_functions的：shell_exec函数！<br/>";
        }

        // 释放文件锁
        flock($lock, LOCK_UN);
        fclose($lock);
    }

    // 检查守护进程是否运行
    public function isDaemonRunning() {
        if (!file_exists($this->pidFile)) return false;

        $pid = (int) file_get_contents($this->pidFile);
        if ($pid <= 0) return false;

        // 使用 posix_kill 检查进程是否存在
        return posix_kill($pid, 0);  // 如果进程存活，返回 true
    }

    // 停止守护进程
    public function stopDaemon() {
        if (!$this->isDaemonRunning()) {
            echo "守护进程没有运行<br/>";
            return;
        }

        $pid = (int) file_get_contents($this->pidFile);
        posix_kill($pid, SIGTERM);
        unlink($this->pidFile);
        echo "守护进程已停止<br/>";
    }
}

// 初始化控制类
$runner = new PhpRunner();
$action = $_POST['action'] ?? null;

if ($action === 'start') {
    // 启动守护进程
    $runner->startDaemon(__DIR__ . '/system_minute_auto.php');
} elseif ($action === 'stop') {
    // 停止守护进程
    $runner->stopDaemon();
}

// 获取守护进程的状态
$status = $runner->isDaemonRunning() ? 
    '<span style="color:green">运行中</span>' : 
    '<span style="color:red">已停止</span>';
$gm_main = $encode->encode("cmd=gm&sid=$sid");
echo <<<HTML
<h3>定时任务控制面板</h3>
当前守护进程状态: {$status}<br/>

<form method="post">
    <button type="submit" name="action" value="start">启动任务</button>
    <button type="submit" name="action" value="stop">停止任务</button>
</form>
<a href="game.php?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
?>
