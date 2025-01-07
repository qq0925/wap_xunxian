QQ：792774502，Lin.

环境配置（请严格按照此环境配置，尤其是数据库版本）：
nginx1.25(可选)
mysql5.5(必选，低版本会出现未知错误，高版本部分数据库语句会不支持)
php7.4(必选。低版本不支持部分函数，高版本部分函数弃用直接报错！)

请开启：opcache+redis插件，这将极大提升游戏体验和服务器效率！

使用前必须导入数据库：xunxian.sql，
数据库的配置如下
表名：xunxian
用户名：xunxian
密码：123456

数据库地址：127.0.0.1(测试在小皮环境中localhost会极度卡顿，服务端无视，若有类似问题可搜索修改)

为了保证定时事件执行，请执行以下操作：
修改MySQL的配置文件my.ini，这个文件在MySQL文件夹下
找到[mysqld]节点，在下面添加一行配置项即可
event_scheduler=ON

设计者账号和密码可自行前往数据库user_info表中修改

大厅设计文档有教程。
频繁回退容易产生bug。