
<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_game_globaleventdefine_1 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=1&sid=$sid");
$gm_game_globaleventdefine_2 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=2&sid=$sid");
$gm_game_globaleventdefine_3 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=3&sid=$sid");
$gm_game_globaleventdefine_4 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=4&sid=$sid");
$gm_game_globaleventdefine_5 = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=5&sid=$sid");

if($gm_post_canshu == 0){
$gm_html = <<<HTML
<p>[公共事件定义]</p>
<a href="?cmd=$gm_game_globaleventdefine_1">玩家事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_2">电脑人物事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_3">物品事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_4">场景事件</a><br/>
<a href="?cmd=$gm_game_globaleventdefine_5">系统事件</a><br/><br/>
<button onclick = "window.location.assign('?cmd=$gm')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 1) {
$gm_game_globaleventdefine_register = $encode->encode("cmd=game_event_page_1&gm_post_canshu=1&gm_post_canshu_2=1&sid=$sid");
if($gm_post_canshu_2==0){
$gm_html = <<<HTML
<p>定义玩家公共事件<br/>
注册事件：<a href="?cmd=$gm_game_globaleventdefine_register">修改事件</a> <a href="gCmd.do?cmd=8c&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
登录事件：<a href="gCmd.do?cmd=8d&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=8e&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
上传形象照检测事件：<a href="gCmd.do?cmd=8f&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
PK事件：<a href="gCmd.do?cmd=90&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=91&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
出招事件：<a href="gCmd.do?cmd=92&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=93&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
被攻击事件：<a href="gCmd.do?cmd=94&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
战胜事件：<a href="gCmd.do?cmd=95&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=96&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
战败事件：<a href="gCmd.do?cmd=97&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=98&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
自创技能检测事件：<a href="gCmd.do?cmd=99&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=9a&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
自创技能创建事件：<a href="gCmd.do?cmd=9b&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=9c&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
废除技能事件：<a href="gCmd.do?cmd=9d&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
自创帮派检测事件：<a href="gCmd.do?cmd=9e&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=9f&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
自创帮派创建事件：<a href="gCmd.do?cmd=a0&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=a1&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
自创帮派战胜事件：<a href="gCmd.do?cmd=a2&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
自创帮派升级事件：<a href="gCmd.do?cmd=a3&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=a4&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
自创帮派分钟定时事件：<a href="gCmd.do?cmd=a5&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
帮派技能分钟定时事件：<a href="gCmd.do?cmd=a6&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=a7&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
加入帮派检测事件：<a href="gCmd.do?cmd=a8&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=a9&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
加入帮派事件：<a href="gCmd.do?cmd=aa&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
退出帮派检测事件：<a href="gCmd.do?cmd=ab&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=ac&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
退出帮派事件：<a href="gCmd.do?cmd=ad&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=ae&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
升级事件：<a href="gCmd.do?cmd=af&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=b0&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
心跳事件：<a href="gCmd.do?cmd=b1&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
分钟定时事件：<a href="gCmd.do?cmd=b2&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改事件</a> <a href="gCmd.do?cmd=b3&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">取消</a><br/>
购买商城物品事件：<a href="gCmd.do?cmd=b4&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">设置事件</a><br/>
<button onclick = "window.location.assign('?cmd=$gm')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}elseif($gm_post_canshu_2 ==1){
$event_main = "?cmd=gameglobalevent_define_registerdefine&gm_post_canshu=11&sid=$sid";
$gm_html = <<<HTML
<p>[公共事件定义]<br/>
定义玩家公共事件：注册事件<br/>
</p>
<form action="$event_main" method="post">
触发条件:<textarea name="cond" maxlength="4096" rows="4" cols="40"></textarea><br/>
不满足条件提示语:<textarea name="cmmt" maxlength="1024" rows="4" cols="40"></textarea><br/>
步骤1:<a href="gCmd.do?cmd=f8&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">修改</a> <a href="gCmd.do?cmd=f9&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">删除</a> <a href="gCmd.do?cmd=fa&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">上移</a><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="gCmd.do?cmd=fc&amp;sid=srkkz25xn9ffwq1p98h9v&amp;gid=g2">添加步骤</a><br/>
<button onclick = "window.location.assign('?cmd=$gm')">返回上一级</button><br/>
</p>
HTML;
}
echo $gm_html;
}elseif ($gm_post_canshu == 2) {
$gm_html = <<<HTML
<p>[定义电脑人物公共事件]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 3) {
$gm_html = <<<HTML
<p>[定义物品公共事件]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 4) {
$gm_html = <<<HTML
<p>[定义场景公共事件]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 5) {
$gm_html = <<<HTML
<p>[定义系统公共事件]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
?>