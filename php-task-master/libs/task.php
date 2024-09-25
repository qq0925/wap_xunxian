<?php
/**
 * PHP定时任务
 * @author wuquanyao <git@yeahphp.com>
 * @link http://www.yeahphp.com
 */

class Task
{
    /**
     * @var string 定时任务日志文件
     */
    protected $log       = "./task.log";

    /**
     * @var string 定时任务进程ID
     */
    protected $pid       = "./task.pid";

    /**
     * @var string 定时任务配置目录
     */
    protected $cmd       = "./cmd";

    /**
     * @var boolean 是否执行命令日志
     */
    protected $printLog  = true;

    /**
     * @var array
     */
    protected $command   = [];

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * 环境初始化
     */
    protected function init()
    {
        if(PATH_SEPARATOR == ";") {
            $this->warn("please run linux or mac system");
        }

        if(PHP_SAPI != "cli") {
            $this->warn("please run php-cli mode");
        }

        if(!is_dir($this->cmd)) {
            $this->warn("not found command dir: " . $this->cmd);
        }

        $this->command();
    }

    /**
     * 解析命令
     */
    protected function command()
    {
        $files = glob($this->cmd . "/*.php");

        foreach ($files as $file) {
            $cmds = include $file;

            if(!is_array($cmds)) {
                $this->warn("command return format:" . var_export([["second", "command"], "..."], true));
            }

            foreach ($cmds as $cmd) {
                if(!is_array($cmd) || count($cmd) != 2) {
                    continue;
                }

                if(!isset($cmd[0]) || !is_numeric($cmd[0]) || $cmd[0] < 1) {
                    continue;
                }

                if(!isset($cmd[1]) || !is_string($cmd[1]) || trim($cmd[0]) == "") {
                    continue;
                }

                $this->command[] = [intval($cmd[0]), $cmd[1], 0];
            }
        }
    }

    /**
     * 输出运行错误并退出
     * @param string $msg
     */
    protected function warn($msg)
    {
        exit("\033[41;33m {$msg} \033[0m \r\n");
    }

    /**
     * 定时任务处理器
     */
    protected function handler()
    {
        $time = time();

        foreach($this->command as &$cmd) {
            if($cmd[2] === 0 || ($time - $cmd[2] >= $cmd[0])) {
                system($cmd[1]);

                if(true === $this->printLog) {
                    file_put_contents(
                        $this->log,
                        "进程ID: " . getmypid() . ", 执行间隔:{$cmd[0]} 秒, 执行命令:{$cmd[1]}, 执行日期:" . date("Y-m-d H:i:s", $time) . "\r\n",
                        FILE_APPEND
                    );
                }

                $cmd[2] = $time;
            }
        }
    }

    /**
     * 安装信号处理器
     */
    protected function install()
    {
        pcntl_signal(SIGALRM, function() {
            $this->handler();
            pcntl_alarm(1);
        });
    }

    /**
     * 是否记录执行命令日志
     * @param boolean $print
     */
    public function printLog($print)
    {
        if(is_bool($print)) {
            $this->printLog = $print;
        }
    }

    /**
     * 读取上一个进程PID
     * @return int
     */
    public function pid()
    {
        if(is_file($this->pid)) {
            return file_get_contents($this->pid);
        }
    }

    /**
     * 杀死进程
     * @return Task
     */
    public function kill($pid = null)
    {
        $pid = $pid ? : trim($this->pid());

        if(is_numeric($pid) && posix_kill($pid, SIGKILL)) {
            echo "\033[41;30m 进程{$pid}退出成功 \033[0m \r\n";
        }

        return $this;
    }

    /**
     * 运行定时任务
     */
    public function run()
    {
        $pid = getmypid();

        echo sprintf("\033[42;30m 任务进程%s运行 \033[0m \r\n", $pid);

        //记录当前进程
        file_put_contents($this->pid, $pid);

        //安装信号处理器
        self::install();

        //向进程发送闹铃信号
        pcntl_alarm(1);

        while (true) {
            pcntl_signal_dispatch();
            sleep(1);
        }
    }
}