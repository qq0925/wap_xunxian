<?php
include_once 'pdo.php';
$gm_post = \gm\gm_post($dblj);

$forum_gm_lists = explode(',',$gm_post->game_forum_gm_id);
if($gm_post->game_forum_gm_id){
foreach ($forum_gm_lists as $forum_gm_list){
    $gm_name = \player\getplayer($forum_gm_list,$dblj)->uname;
    $gm_uid = \player\getplayer($forum_gm_list,$dblj)->uid;
    $forum_gm_name .=<<<HTML
    $gm_name($gm_uid)
HTML;
}
}
if($forum_gm_name ==''){
    $forum_gm_name ="无";
}
$game_main = $encode->encode("cmd=gm_game_firstpage&ucmd=$cmid&sid=$sid");
$ret_forum = $encode->encode("cmd=game_forum&canshu=1&ucmd=$cmid&sid=$sid");
$mypost = $encode->encode("cmd=game_forum&canshu=1&ucmd=$cmid&sid=$sid");
// 插入数据
if (isset($_POST['submit']) && $canshu ==1) {
    
    if (strlen($title) > 5 && strlen($content) > 10){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_time = date('y-m-d H:i:s');
    try {
        $stmt = $dblj->prepare("INSERT INTO forum_text (sid, title, content,created_time) VALUES (:sid, :title, :content,:created_time)");
        $stmt->bindParam(':sid', $sid);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':created_time', $created_time);
        $stmt->execute();
    } catch (PDOException $e) {
        echo '帖子发布失败: ' . $e->getMessage();
    }
}
    else{
    echo "标题和内容必须分别大于5个字符和10个字符。<br/>";
}
}

if (isset($_POST['submit']) && $canshu ==3) {

    $content = $_POST['content'];
    $created_time = date('y-m-d H:i:s');
    try {
        $stmt = $dblj->prepare("INSERT INTO forum_res (sid, belong, content,created_time) VALUES (:sid, :belong, :content,:created_time)");
        $stmt->bindParam(':sid', $sid);
        $stmt->bindParam(':belong', $post_id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':created_time', $created_time);
        $stmt->execute();
        $stmt = $dblj->exec("update forum_text set response_count = response_count + 1 where id = '$post_id'");
    } catch (PDOException $e) {
        echo '回复失败: ' . $e->getMessage();
    }
}

if($delete_id && $canshu ==1){
    $sql = "delete from forum_text where id = '$delete_id'";
    $dblj->exec($sql);
    $sql = "delete from forum_res where belong = '$delete_id'";
    $dblj->exec($sql);
}

if($delete_id && $canshu ==3){
    $sql = "update forum_text set response_count = response_count - 1 where id = '$delete_id'";
    $dblj->exec($sql);
    $sql = "delete from forum_res where belong = '$delete_id' and sid = '$delete_sid'";
    $dblj->exec($sql);
    $post_id = $delete_id;
}

// 获取数据
if($canshu ==1){
try {
    $stmt = $dblj->query("SELECT * FROM forum_text ORDER BY id DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '获取帖子列表失败: ' . $e->getMessage();
}
if(count($posts) ==0){
    $forum_detail .="目前没有任何帖子。<br/>";
}
for($i=1;$i<@count($posts) +1;$i++){
    $delete_url ='';
    $post_id = $posts[$i-1]['id'];
    $title = $posts[$i-1]['title'];
    $res_count = $posts[$i-1]['response_count'];
    $view_count = $posts[$i-1]['view_count'];
    $author_sid = $posts[$i-1]['sid'];
    $author_name = \player\getplayer($author_sid,$dblj)->uname;
    $author_uid = \player\getplayer($author_sid,$dblj)->uid;
    $created_time = $posts[$i-1]['created_time'];
    // 使用strtotime将日期时间字符串转换为时间戳
    $timestamp = strtotime($created_time);
    // 使用date函数提取日期部分（不包括年份）
    $created_time = date("H:i:s", $timestamp);
    if($author_sid ==$sid || in_array($sid, $forum_gm_lists)){
        $delete_post = $encode->encode("cmd=game_forum&delete_id=$post_id&canshu=1&ucmd=$cmid&sid=$sid");
        $delete_url = "<a href ='?cmd=$delete_post'>删帖</a>";
    }
    $post_detail = $encode->encode("cmd=game_forum&view=1&ucmd=$cmid&canshu=3&post_id=$post_id&sid=$sid");
    $view_user = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$author_uid&sid=$sid");
    $forum_detail .=<<<HTML
    [$i].<a href="?cmd=$post_detail">{$title}</a>({$res_count}/{$view_count})<a href="?cmd=$view_user">{$author_name}($author_uid)</a>{$created_time}$delete_url
HTML;
$forum_detail .="<br/>";
}
$send_new = $encode->encode("cmd=game_forum&canshu=2&ucmd=$cmid&sid=$sid");
$mypost = $encode->encode("cmd=game_forum&canshu=5&ucmd=$cmid&sid=$sid");
$forum_html = <<<HTML
<p>{$gm_post->game_name}论坛<br/>
版主：{$forum_gm_name}<br/>
<a href="?cmd=$send_new">发新帖</a><br/>
$forum_detail
<a href="?cmd=$mypost">我的帖子</a><br/>
<br/>
HTML;
}elseif ($canshu ==2) {
$forum_html = <<<HTML
<form action="?cmd=$ret_forum" method="post">
标题：<input name="title" type="text" maxlength="50" required><br/>
内容：<textarea name="content" maxlength="3000" rows="4" cols="20" required></textarea><br/>
<input name="submit" type="submit" title="发送" value="发送"/><input name="submit" type="hidden" title="发送" value="发送"/></form><br/>
<a href="?cmd=$ret_forum">返回论坛</a><br/>
<br/>
HTML;
}elseif($canshu ==3){
    
    if($view){
    $stmt = $dblj->exec("update forum_text set view_count = view_count + 1 where id = '$post_id'");
    }
try {
    $stmt = $dblj->query("SELECT * FROM forum_text where id = '$post_id'");
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '获取帖子列表失败: ' . $e->getMessage();
}
$post_id = $posts['id'];
$title = $posts['title'];
$content = $posts['content'];
$res_count = $posts['response_count'];
$view_count = $posts['view_count'];
$author_sid = $posts['sid'];
$author_name = \player\getplayer($author_sid,$dblj)->uname;
$author_uid = \player\getplayer($author_sid,$dblj)->uid;
$created_time = $posts['created_time'];
if($author_sid ==$sid){
    $delete_post = $encode->encode("cmd=game_forum&delete_id=$post_id&canshu=1&ucmd=$cmid&sid=$sid");
    $delete_url = "<a href ='?cmd=$delete_post'>删帖</a>";
}
$response_url = $encode->encode("cmd=game_forum&post_id=$post_id&canshu=4&ucmd=$cmid&sid=$sid");
$response_text = "<a href='?cmd=$response_url'>回复帖子</a><br/>";

$stmt = $dblj->query("SELECT * FROM forum_res where belong = '$post_id'");
$response = $stmt->fetchAll(PDO::FETCH_ASSOC);

for($i=1;$i<@count($response) +1;$i++){
    $delete_url ='';
    $response_belong = $response[$i-1]['belong'];
    $response_content = $response[$i-1]['content'];
    $response_sid = $response[$i-1]['sid'];
    $response_name = \player\getplayer($response_sid,$dblj)->uname;
    $response_uid = \player\getplayer($response_sid,$dblj)->uid;
    $response_created_time = $response[$i-1]['created_time'];
    // 使用strtotime将日期时间字符串转换为时间戳
    $timestamp = strtotime($response_created_time);
    // 使用date函数提取日期部分（不包括年份）
    $response_created_time = date("H:i:s", $timestamp);
    if($response_sid ==$sid ||$author_sid ==$sid){
        $delete_post = $encode->encode("cmd=game_forum&delete_sid=$response_sid&delete_id=$post_id&canshu=3&ucmd=$cmid&sid=$sid");
        $delete_url = "<a href ='?cmd=$delete_post'>删除</a>";
    }
    $view_user = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$response_uid&sid=$sid");
    $response_text .=<<<HTML
    [{$i}楼].{$response_content}<a href="?cmd=$view_user">{$response_name}($response_uid)</a>{$response_created_time}$delete_url
HTML;
$response_text .="<br/>";
}

$view_author_user = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$author_uid&sid=$sid");
$forum_detail .=<<<HTML
【标题】：{$title}<br/>
【发布时间】：{$created_time}<br/>
【作者】：<a href="?cmd=$view_author_user">{$author_name}($author_uid)</a><br/>
【正文】：<br/>
$content<br/>
$response_text<br/>
<a href="?cmd=$ret_forum">返回论坛</a>
HTML;
$forum_detail .="<br/>";
$send_new = $encode->encode("cmd=game_forum&canshu=2&ucmd=$cmid&sid=$sid");
$forum_html = <<<HTML
$forum_detail
<br/>
HTML;
}elseif($canshu ==4){
$ret_post = $encode->encode("cmd=game_forum&canshu=3&post_id=$post_id&ucmd=$cmid&sid=$sid");
$forum_html = <<<HTML
<form action="?cmd=$ret_post" method="post">
内容：<textarea name="content" maxlength="300" rows="4" cols="20" placeholder = "请输入回复内容"></textarea><br/>
<input name="submit" type="submit" title="回复" value="回复"/><br/>
<a href="?cmd=$ret_post">返回主题</a><br/>
<a href="?cmd=$ret_forum">返回论坛</a><br/>
HTML;
}
elseif($canshu ==5){
$send_new = $encode->encode("cmd=game_forum&canshu=2&ucmd=$cmid&sid=$sid");
try {
    $stmt = $dblj->query("SELECT * FROM forum_text where sid = '$sid' ORDER BY id DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '获取帖子列表失败: ' . $e->getMessage();
}
if(count($posts) ==0){
    $forum_detail .="目前没有任何帖子。<br/>";
}
for($i=1;$i<@count($posts) +1;$i++){
    $delete_url ='';
    $post_id = $posts[$i-1]['id'];
    $title = $posts[$i-1]['title'];
    $res_count = $posts[$i-1]['response_count'];
    $view_count = $posts[$i-1]['view_count'];
    $author_sid = $posts[$i-1]['sid'];
    $author_name = \player\getplayer($author_sid,$dblj)->uname;
    $author_uid = \player\getplayer($author_sid,$dblj)->uid;
    $created_time = $posts[$i-1]['created_time'];
    // 使用strtotime将日期时间字符串转换为时间戳
    $timestamp = strtotime($created_time);
    // 使用date函数提取日期部分（不包括年份）
    $created_time = date("H:i:s", $timestamp);
    if($author_sid ==$sid || in_array($sid, $forum_gm_lists)){
        $delete_post = $encode->encode("cmd=game_forum&delete_id=$post_id&canshu=1&ucmd=$cmid&sid=$sid");
        $delete_url = "<a href ='?cmd=$delete_post'>删帖</a>";
    }
    $post_detail = $encode->encode("cmd=game_forum&view=1&ucmd=$cmid&canshu=3&post_id=$post_id&sid=$sid");
    $view_user = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$author_uid&sid=$sid");
    $forum_detail .=<<<HTML
    [$i].<a href="?cmd=$post_detail">{$title}</a>({$res_count}/{$view_count})<a href="?cmd=$view_user">{$author_name}($author_uid)</a>{$created_time}$delete_url
HTML;
$forum_detail .="<br/>";
}
$forum_html =<<<HTML
我发的帖子<br/>
<a href="?cmd=$send_new">发新帖</a><br/>
$forum_detail
<br/>
<a href="?cmd=$ret_forum">返回论坛</a><br/>
HTML;
}

$forum_html .= "<a href='?cmd=$game_main'>返回游戏首页</a>";
echo $forum_html;
?>