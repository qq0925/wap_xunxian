<?php
// 创建事件基
$base = new EventBase();

// 创建定时器事件（每隔1秒触发，持续执行）
$event = new Event(
    $base, // EventBase实例
    -1,    // 文件描述符（定时器用-1）
    Event::TIMEOUT | Event::PERSIST, // 标志：定时器且持续触发
    function () { // 回调函数
        echo "定时器触发于 " . microtime(true) . PHP_EOL;
    }
);

// 添加定时器，1秒后开始，每隔1秒触发
$event->add(1.0);

// 运行事件循环
$base->loop();