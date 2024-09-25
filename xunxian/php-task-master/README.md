 
##### 项目介绍
 
 基于PHP开发的秒级任务定时器, 配置简单, 具体使用请往下看
 
##### 项目结构
 
``` 
├─ Task            项目目录
│  ├─ cmd          定时任务配置目录
│  │  ├─ cmd.php   定时任务配置文件
│  │  ├─ ...       定时任务配置文件
│  ├─ libs         类库目录
│  │  ├─ task.php  类库文件
│  ├─ img          效果图目录
│  │  ├─ ...       效果图
│  ├─  run.php     入口文件
|  |─  task.pid    定时器进程PID文件
|  |─  task.log    定时器日志文件
|  |─  nohup.out   可能会生成该文件
```

> 初次运行项目时,会生成`task.pid` 和 `task.log` 这两个文件

##### 环境要求

- PHP需要开启PCNTL扩展
- PHP需要在CLI模式运行
- 需要linux 或 macos系统, windows系统不支持

> 说明: 此项目在Linux环境下测试过,可以正常运行

##### cd命令进入项目后
 
 > 执行以下命令管理定时任务
 
 - 启动定时任务, 将尝试退出上一次任务进程
 
 ``` 
 php run.php start
 ```
 
 > 提示: 此时会生成 `nohup.out`文件, 如果不想生成 `nohup.out` 文件, 如下
 
 ``` 
  php run.php start > /dev/null
 ```
- 关闭正在运行的定时任务
  
```
php run.php stop
```  
- 脱离终端窗口运行
 
 ```shell
 nohup php run.php start  > /dev/null &
```

> 默认定时器是开启日志记录的,如需关闭用`--log=false`参数

``` 
 php run.php start --log=false
```

或

``` 
nohup php run.php start --log=false > /dev/null &
```

##### 定时任务配置

> 进入cmd目录,建立一个或多个以php为后缀的文件, 如cmd.php, 文件内容格式如下:

``` 
/**
 * 任务列表
 * 格式:[执行间隔秒数, 要执行的命令]
 */
return
[
    //每隔1秒输出当前系统日期
    [1, "date"],
    //每隔5秒输出PHP-FPM运行情况
    [5, "ps aux | grep 'php-fpm'"],
    // 更多定时任务...
];
```
> 注意配置格式不能错误, 不正确的配置会被忽略, 每个任务的配置为一个数组

``` 
array(要间隔多少秒执行, 要执行的命令)
```

> [提示] 请确保项目目录拥有读写权限

##### 运行效果图

请查看 `img`目录