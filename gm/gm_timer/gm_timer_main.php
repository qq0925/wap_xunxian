<p>[定时器定义]<br/>
<?php


$gm = $encode->encode("cmd=gm&sid=$sid");
$timer_html = <<<HTML
全局玩家定时器：<br/>
全局系统定时器：<br/>

全局场景定时器：<br/>
特定场景定时器：<br/>

全局物品定时器：<br/>
特定物品定时器：<br/>

全局NPC定时器：<br/>
特定NPC定时器：<br/>

<a href="?cmd=$add_timer">添加一组定时器</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $timer_html;
?>