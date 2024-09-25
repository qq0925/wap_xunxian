<?php
/**
 * PHP定时任务
 * @author wuquanyao <git@yeahphp.com>
 * @link http://www.yeahphp.com
 */

$args   = $_SERVER["argv"];
$script = array_shift($args);

if(empty($args)) {
    exit("\033[41;33m php {$script} start|stop \033[0m\r\n");
}

require "libs/task.php";

$task = new Task();

if(isset($args[1]) && "--log=false" == $args[1]) {
    $task->printLog(false);
}

switch ($args[0]) {
    case "start" :
        $task->kill()->run();
        break;
    case "stop" :
        $task->kill();
        break;
    default :
        echo "\033[41;33m unknown command, valid option [start|stop] \033[0m\r\n";
}

