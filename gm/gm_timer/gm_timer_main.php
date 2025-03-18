<?php
class PhpRunner {
    private $pidFile;
    private $lockFile;
    private $phpBinary;
    private $logFile;
    private $taskType;

    public function __construct($taskType) {
        $this->taskType = $taskType;
        // 根据任务类型生成不同的PID文件和锁文件
        $this->pidFile = __DIR__ . '/daemon_' . $taskType . '.pid';  // 守护进程的PID文件
        $this->lockFile = __DIR__ . '/daemon_' . $taskType . '.lock'; // 文件锁
        $this->logFile = __DIR__ . '/daemon_' . $taskType . '.log';   // 日志文件
        $this->phpBinary = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'php.exe' : 'php74'; // 自动选择 PHP 执行命令
        
        // 确保日志文件存在并包含UTF-8 BOM头（解决Windows中文乱码）
        if (!file_exists($this->logFile)) {
            file_put_contents($this->logFile, "\xEF\xBB\xBF"); // UTF-8 BOM头
        }
    }
    
    // 日志记录函数
    private function log($message) {
        $date = date('Y-m-d H:i:s');
        // 确保写入UTF-8编码
        file_put_contents($this->logFile, "[$date] $message\n", FILE_APPEND);
    }

    // 清理锁文件
    private function cleanLock() {
        if (file_exists($this->lockFile)) {
            $this->log("清理锁文件: {$this->lockFile}");
            @unlink($this->lockFile);
            return true;
        }
        return false;
    }

    // 启动守护进程
    public function startDaemon($scriptPath) {
        $this->log("尝试启动 {$this->taskType} 定时器...");
        
        // 检查脚本文件是否存在
        if (!file_exists($scriptPath)) {
            $errorMsg = "脚本文件不存在: $scriptPath";
            $this->log($errorMsg);
            echo $errorMsg . "<br/>";
            return;
        }

        // 检查守护进程是否已经在运行
        if ($this->isDaemonRunning()) {
            $this->log("守护进程已经在运行！");
            echo "守护进程已经在运行！<br/>";
            return;
        }

        // 检查锁文件是否存在但没有相应进程，如果是则清理
        if (file_exists($this->lockFile) && !$this->isDaemonRunning()) {
            $this->log("发现孤立的锁文件，进行清理");
            $this->cleanLock();
        }

        // 获取文件锁，确保任务不会重复执行
        $lock = fopen($this->lockFile, 'c');
        if (!flock($lock, LOCK_EX | LOCK_NB)) {  // 获取文件锁
            $this->log("任务正在运行中，退出");
            echo "另一个进程正在运行，退出。<br/>";
            
            // 提供强制清理选项
            echo '<form method="post">';
            echo '<input type="hidden" name="action" value="' . ($this->taskType == 'minute' ? 'mcleanlocks' : 'hcleanlocks') . '">';
            echo '<button type="submit">强制清理锁文件</button>';
            echo '</form>';
            
            fclose($lock);
            return;
        }

        $this->log("操作系统: " . PHP_OS);
        // 如果是 Windows 平台
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->log("使用Windows命令启动进程");
            
            // 创建一个VBS脚本来在后台运行PHP
            $vbsFile = __DIR__ . "/run_{$this->taskType}.vbs";
            $realScriptPath = realpath($scriptPath);
            $phpPath = realpath($this->phpBinary) ?: $this->phpBinary;
            
            // 创建VBS脚本内容 - 这种方式能够在Windows下保持长期运行
            $vbsContent = "Set WshShell = CreateObject(\"WScript.Shell\")\r\n";
            $vbsContent .= "WshShell.Run \"\"\"$phpPath\"\" \"\"$realScriptPath\"\"\", 0, False\r\n";
            
            file_put_contents($vbsFile, $vbsContent);
            $this->log("创建VBS脚本: $vbsFile");
            
            // 使用WScript执行VBS脚本
            $cmd = "cscript //NoLogo \"$vbsFile\"";
            $this->log("执行命令: $cmd");
            
            $output = array();
            exec($cmd, $output, $returnVar);
            $this->log("命令返回值: $returnVar, 输出: " . implode(", ", $output));
            
            if ($returnVar === 0) {
                // 等待一小段时间让进程启动
                sleep(2);
                
                // Windows下无法可靠地获取PID，使用固定的伪PID
                $pid = rand(10000, 99999);
                file_put_contents($this->pidFile, $pid);
                $this->log("保存伪PID文件，值为: $pid (Windows环境下仅用于状态指示)");
                
                // 写入一个标记文件表示定时器类型
                $markerFile = __DIR__ . "/daemon_{$this->taskType}_running.marker";
                file_put_contents($markerFile, date('Y-m-d H:i:s'));
                $this->log("创建标记文件: $markerFile");
                
                echo "守护进程已启动 (Windows模式)<br/>";
                echo "<div style='color:blue'>提示: Windows环境下无法获取实际PID，系统使用标记文件判断运行状态</div>";
            } else {
                // 启动失败，释放锁
                flock($lock, LOCK_UN);
                fclose($lock);
                @unlink($this->lockFile);
                
                $this->log("启动失败！Windows命令执行错误，返回值: $returnVar");
                echo "启动失败！Windows环境下命令执行错误<br/>";
                return;
            }
        } else {
            $this->log("使用Linux命令启动进程");
            // Linux 系统使用 nohup 运行命令
            $cmd = sprintf(
                'nohup %s %s > %s 2>&1 & echo $!',
                escapeshellarg($this->phpBinary),  // PHP 命令
                escapeshellarg($scriptPath),       // 需要执行的 PHP 脚本
                $this->logFile . ".output"         // 标准输出重定向到日志文件
            );
            $this->log("执行命令: $cmd");
            $pid = (int) shell_exec($cmd);
            $this->log("获取到PID: $pid");
            
            if ($pid > 0) {
                // 等待一小段时间让进程启动
                sleep(1);
                if ($this->isProcessRunning($pid)) {
                    file_put_contents($this->pidFile, $pid);  // 保存PID
                    $this->log("进程成功启动，PID: $pid");
                    echo "守护进程已启动 (PID: $pid)<br/>";
                } else {
                    // 启动失败，释放锁
                    flock($lock, LOCK_UN);
                    fclose($lock);
                    @unlink($this->lockFile);
                    
                    $this->log("进程启动失败，检查不到进程: $pid");
                    echo "启动失败！进程未能正常运行<br/>";
                    return;
                }
            } else {
                // 启动失败，释放锁
                flock($lock, LOCK_UN);
                fclose($lock);
                @unlink($this->lockFile);
                
                $this->log("启动失败！未能获取到有效PID");
                echo "启动失败！请放行php.ini中disable_functions的shell_exe！<br/>";
                return;
            }
        }

        // 释放文件锁（注意：成功启动后应保留锁文件作为标记）
        flock($lock, LOCK_UN);
        fclose($lock);
    }

    // 检查进程是否运行
    private function isProcessRunning($pid) {
        if ($pid <= 0) return false;

        // 在 Windows 上我们需要用 tasklist 来检查进程是否存在
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $output = shell_exec("tasklist /FI \"PID eq $pid\"");
            $this->log("检查PID $pid 是否存在: " . ($output ? "是" : "否"));
            return strpos($output, (string)$pid) !== false;
        }

        // 使用 posix_kill 检查进程是否存在（Linux）
        $result = posix_kill($pid, 0);
        $this->log("检查PID $pid 是否存在: " . ($result ? "是" : "否"));
        return $result;  // 如果进程存活，返回 true
    }

    // 检查守护进程是否运行
    public function isDaemonRunning() {
        // 特殊处理Windows环境 - 检查PID文件和标记文件
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $markerFile = __DIR__ . "/daemon_{$this->taskType}_running.marker";
            $isRunning = file_exists($this->pidFile) && file_exists($markerFile);
            
            // 检查标记文件的时间戳是否过期 (过期时间设为60分钟)
            if ($isRunning && file_exists($markerFile)) {
                $markerTime = filemtime($markerFile);
                if (time() - $markerTime > 3600) {
                    $this->log("标记文件已过期，认为进程已停止");
                    @unlink($this->pidFile);
                    @unlink($markerFile);
                    $isRunning = false;
                }
            }
            
            $this->log("Windows模式下检查运行状态: " . ($isRunning ? "是" : "否"));
            return $isRunning;
        }
        
        if (!file_exists($this->pidFile)) {
            $this->log("PID文件不存在");
            return false;
        }

        $pid = (int) file_get_contents($this->pidFile);
        $this->log("读取到PID: $pid");
        
        if (!$this->isProcessRunning($pid)) {
            // 如果进程不存在，删除PID文件
            $this->log("进程 $pid 不存在，删除PID文件");
            @unlink($this->pidFile);
            return false;
        }

        $this->log("进程 $pid 正在运行");
        return true;
    }

    // 强制清理所有锁和PID文件
    public function cleanLocks() {
        $this->log("强制清理所有锁和PID文件");
        
        if (file_exists($this->pidFile)) {
            @unlink($this->pidFile);
            $this->log("已删除PID文件: {$this->pidFile}");
        }
        
        if (file_exists($this->lockFile)) {
            @unlink($this->lockFile);
            $this->log("已删除锁文件: {$this->lockFile}");
        }
        
        // 清理Windows特有的标记文件
        $markerFile = __DIR__ . "/daemon_{$this->taskType}_running.marker";
        if (file_exists($markerFile)) {
            @unlink($markerFile);
            $this->log("已删除标记文件: {$markerFile}");
        }
        
        echo "已清理所有锁文件，可以重新尝试启动了<br/>";
    }

    // 停止守护进程
    public function stopDaemon() {
        $this->log("尝试停止 {$this->taskType} 定时器...");
        
        if (!$this->isDaemonRunning()) {
            $this->log("守护进程没有运行");
            echo "守护进程没有运行<br/>";
            
            // 尝试清理可能残留的锁文件
            $this->cleanLock();
            
            return;
        }

        // 在 Windows 上特殊处理
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->log("Windows环境下尝试停止进程");
            
            // 在Windows下，我们可以创建一个停止信号文件
            $stopFile = __DIR__ . "/stop_{$this->taskType}.signal";
            file_put_contents($stopFile, date('Y-m-d H:i:s'));
            $this->log("创建停止信号文件: $stopFile");
            
            // 清理所有相关文件
            @unlink($this->pidFile);
            $this->cleanLock();
            
            // 清理标记文件
            $markerFile = __DIR__ . "/daemon_{$this->taskType}_running.marker";
            if (file_exists($markerFile)) {
                @unlink($markerFile);
                $this->log("已删除标记文件: {$markerFile}");
            }
            
            // 尝试终止与脚本关联的所有PHP进程（可选，取决于环境）
            // 此处仅创建一个停止信号文件，实际脚本需要定期检查此文件以决定是否退出
            
            echo "守护进程已停止 (Windows模式)<br/>";
            echo "<div style='color:blue'>提示: Windows环境下进程可能需要一段时间才能完全退出</div>";
            return;
        }
        
        $pid = (int) file_get_contents($this->pidFile);
        $this->log("读取到PID: $pid");
        
        // Linux环境下的停止流程
        $this->log("尝试发送SIGTERM信号至进程 $pid");
        posix_kill($pid, SIGTERM);
        // 等待进程结束
        $timeout = 5;
        while ($timeout > 0 && $this->isProcessRunning($pid)) {
            $this->log("等待进程结束... $timeout");
            sleep(1);
            $timeout--;
        }
        if ($timeout <= 0) {
            $this->log("进程未在时限内结束，发送SIGKILL信号");
            posix_kill($pid, SIGKILL); // 强制结束
        }
        
        // 确保进程已经停止
        if (!$this->isProcessRunning($pid)) {
            $this->log("进程已成功停止，删除PID文件");
            @unlink($this->pidFile);
            $this->cleanLock(); // 确保清理锁文件
            echo "守护进程已停止<br/>";
        } else {
            $this->log("停止失败，进程仍在运行");
            echo "停止失败，请手动检查进程<br/>";
        }
    }
}

// 初始化两个独立的控制类实例
$minuteRunner = new PhpRunner('minute');
$hourRunner = new PhpRunner('hour');
$action = $_POST['action'] ?? null;

if ($action === 'mstart') {
    // 启动分钟守护进程
    $minuteRunner->startDaemon(__DIR__ . '/system_minute_auto.php');
} elseif ($action === 'mstop') {
    // 停止分钟守护进程
    $minuteRunner->stopDaemon();
} elseif ($action === 'mcleanlocks') {
    // 强制清理分钟守护进程的锁
    $minuteRunner->cleanLocks();
}

if ($action === 'hstart') {
    // 启动小时守护进程
    $hourRunner->startDaemon(__DIR__ . '/system_hour_auto.php');
} elseif ($action === 'hstop') {
    // 停止小时守护进程
    $hourRunner->stopDaemon();
} elseif ($action === 'hcleanlocks') {
    // 强制清理小时守护进程的锁
    $hourRunner->cleanLocks();
}

// 获取系统环境信息
$isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
$osInfo = $isWindows ? 'Windows' : 'Linux/Unix';

// 分别获取两个守护进程的状态
$mstatus = $minuteRunner->isDaemonRunning() ? 
    '<span style="color:green">运行中</span>' : 
    '<span style="color:red">已停止</span>';
$hstatus = $hourRunner->isDaemonRunning() ? 
    '<span style="color:green">运行中</span>' : 
    '<span style="color:red">已停止</span>';

$gm_main = $encode->encode("cmd=gm&sid=$sid");
echo <<<HTML
<h3>定时任务控制面板</h3>
<p>当前系统环境: <b>{$osInfo}</b></p>

当前系统分钟定时器状态: {$mstatus}
<form method="post">
    <button type="submit" name="action" value="mstart">启动</button>
    <button type="submit" name="action" value="mstop">停止</button>
    <button type="submit" name="action" value="mcleanlocks">清理锁</button>
</form>
当前系统小时定时器状态: {$hstatus}
<form method="post">
    <button type="submit" name="action" value="hstart">启动</button>
    <button type="submit" name="action" value="hstop">停止</button>
    <button type="submit" name="action" value="hcleanlocks">清理锁</button>
</form>

<h4>调试信息</h4>
<p>
如果定时器启动失败，请检查以下文件：<br>
- 分钟定时器日志: daemon_minute.log<br>
- 小时定时器日志: daemon_hour.log<br>
- 分钟定时器输出: daemon_minute.log.output<br>
- 小时定时器输出: daemon_hour.log.output<br>
</p>

<p>
<b>提示</b>: 如果看到"另一个进程正在运行，退出"的错误，请点击"清理锁"按钮，然后重新启动定时器。<br/>
<b>提示</b>: 如果一直启动失败，请在终端键入pkill php杀死所有php进程而后启动php。
</p>

HTML;

if ($isWindows) {
    echo <<<HTML
<div style="border:1px solid #ccc; padding:10px; margin-top:10px; background-color:#f8f8f8;">
<h4>Windows环境提示</h4>
<p>
1. Windows环境下，定时器使用VBS脚本在后台运行PHP进程<br>
2. 定时器状态通过特殊的标记文件判断，而非实际进程状态<br>
3. 如需定时器在服务器重启后自动运行，建议将启动命令添加到计划任务中<br>
4. Windows环境下系统日志文件使用UTF-8编码。
</p>
</div>
HTML;
}

echo '<a href="game.php?cmd=' . $gm_main . '">返回设计大厅</a><br/>';
?>
