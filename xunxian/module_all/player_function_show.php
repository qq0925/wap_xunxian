<?php


$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_function = $encode->encode("cmd=function_html&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");


$show_html = <<<HTML
<p>显示图片 <a href="">关闭</a><br/>
公共信息 <a href="">关闭</a><br/>
帮派信息 <a href="">关闭</a><br/>
私聊信息 <a href="">关闭</a><br/>
游戏公告(场景中) <a href="">关闭</a><br/>
游戏公告(战斗中) <a href="">关闭</a><br/>
</p>
<form action="" method="post">
保留最后发送信息：<select name="stay_last_send_msg" value="1">
<option value="1" selected="selected">保留</option>
<option value="0">不保留</option>
</select><br/>
显示信息条数(1~20)：<input name="msg_count" type="text" value="3" maxlength="2"/><br/>
每页列表行数(1~40)：<input name="list_size" type="text" value="8" maxlength="2"/><br/>
<input name="submit" type="submit" title="设置" value="设置"/><input name="submit" type="hidden" title="设置" value="设置"/></form><br/>
<a href="?cmd=$ret_function">返回功能设置</a><br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>


HTML;
echo $show_html;

?>