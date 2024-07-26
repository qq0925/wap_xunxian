<?php


$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$pet_html = <<<HTML
(未出战)【GM宠】|【<a href="?cmd=$ret_game">野兔</a>】...<br/>
【这里是宠物图片】<br/>
名称：小寻寻<br/>
小寻寻： 亲爱的主人……吃饱了！精神亢奋！咱是不是可以出去打架了？<br/>
生命:194/194<br/>
攻:1-7 | 防:1-2<br/>
饥饿：500 / 500 <a href="?cmd=$ret_game">喂食</a><br/>
清洁：500 / 500 <a href="?cmd=$ret_game">洗澡</a><br/>
心情：985 / 1000<br/>
状态：<a href="?cmd=$ret_game">附身</a> 取消附身<br/>
放生：<a href="?cmd=$ret_game">丢弃</a><br/>
成长:13/1000<br/>

================<br/>
兽栏：1/8<br/>
----------<br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $pet_html;
?>