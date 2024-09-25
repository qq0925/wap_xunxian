<?php

$sid = $input_sid;//根据$sid用户标识不同生成不同内存json数组

$varKey = ftok(__FILE__, 'a'); // 生成一个key
$varId = shmop_open($varKey, 'c', 0644, 128); // 创建或打开共享内存段
 
// 写入变量到共享内存
shmop_write($varId, 'Hello, Shared Memory!', 0);
 
// 读取共享内存中的变量
$varValue = shmop_read($varId, 0, 128);

//检测内存中是否存在等于$sid变量的key，且view为0，如果有，那么echo。并将该条数据删去

echo $varValue; // 输出：Hello, Shared Memory!
 
// 关闭共享内存段
shmop_close($varId);
?>