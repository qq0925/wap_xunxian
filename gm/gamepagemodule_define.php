
<?php
header('Content-Type:text/html;charset=utf-8');
$text = $_POST['text'];
$cond = $_POST['cond'];
$position = $_POST['position'];
$op_type = $_POST['op_type'];
echo $text,$cond,$position,$op_type;
if (!empty($text)){
    if($op_type ==0){
    echo "新建成功!";
    $sql = "INSERT INTO game_main_page (id,type,show_cond,value) VALUES ('$position',1,'$cond','$text')";
    $cxjg = $dblj->exec($sql);
    }elseif($op_type ==1){
    echo "修改成功!";
    $sql = "update game_main_page set value = '$text',show_cond = '$cond' where id = '$position'";
    $cxjg = $dblj->exec($sql);
    }
}






$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_game_pagemoduledefine_1 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=1&sid=$sid");
$gm_game_pagemoduledefine_2 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=2&sid=$sid");
$gm_game_pagemoduledefine_3 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=3&sid=$sid");
$gm_game_pagemoduledefine_4 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=4&sid=$sid");
$gm_game_pagemoduledefine_5 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=5&sid=$sid");
$gm_game_pagemoduledefine_6 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=6&sid=$sid");
$gm_game_pagemoduledefine_7 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=7&sid=$sid");
$gm_game_pagemoduledefine_8 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=8&sid=$sid");
$gm_game_pagemoduledefine_9 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=9&sid=$sid");
$gm_game_pagemoduledefine_10 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=10&sid=$sid");
$gm_game_pagemoduledefine_11 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=11&sid=$sid");
$gm_game_pagemoduledefine_12 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=12&sid=$sid");
$gm_game_pagemoduledefine_13 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=13&sid=$sid");




if($gm_post_canshu == 0){
$gm_html = <<<HTML
<p>[页面模板定义]</p>
<a href="?cmd=$gm_game_pagemoduledefine_1">定义查看场景页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_2">定义查看电脑人物页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_3">定义查看宠物页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_4">定义查看物品页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_5">定义查看玩家页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_6">定义查看我的装备模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_7">定义查看自己状态页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_8">定义查看技能页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_9">定义功能页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_10">定义战斗页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_11">定义首页页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_12">修改功能点名称</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_13">自定义页面模板</a><br/><br/>

<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 1) {
$gm_html = <<<HTML
<p>[定义查看场景页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 2) {
$gm_html = <<<HTML
<p>[定义查看电脑人物页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 3) {
$gm_html = <<<HTML
<p>[定义查看宠物页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 4) {
$gm_html = <<<HTML
<p>[定义查看物品页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 5) {
$gm_html = <<<HTML
<p>[定义查看玩家页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 6) {
$gm_html = <<<HTML
<p>[定义查看我的装备模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 7) {
$gm_html = <<<HTML
<p>[定义查看自己状态页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 8) {
$gm_html = <<<HTML
<p>[定义查看技能页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 9) {
$gm_html = <<<HTML
<p>[定义功能页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 10) {
$gm_html = <<<HTML
<p>[定义战斗页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 11) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_2_1 = $encode->encode("cmd=game_page_2&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_main_page($dblj);
$br = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&sid=$sid");
    $order = array("\r\n", "\n", "\r");
    $replace = "↓<br/>";
    $main_value=str_replace($order, $replace, $main_value);
    $game_main .=<<<HTML
    <a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
}
$all = <<<HTML
<p>定义首页页面模板<br/>
============<br/>
$game_main<br/><br/>
<a href="?cmd=$game_page_2_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_2_2">添加功能元素</a><br/>
<a href="?cmd=$game_page_2_3">添加操作元素</a><br/>
<a href="?cmd=$game_page_2_4">添加链接元素</a><br/><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $all;
}elseif ($gm_post_canshu == 12) {
$gm_html = <<<HTML
<p>[修改功能点名称]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 13) {
$gm_html = <<<HTML
<p>[自定义页面模板]</p>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
?>