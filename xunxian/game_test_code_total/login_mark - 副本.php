<?php
include_once 'pdo.php';

// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");
//header('Access-Control-Allow-Origin: https://xunxian.txsj.ink http://xunxian.txsj.ink');//只允许特定域名访问

$uid = $_GET['uid'] ?? null;
$token = $_GET['token'] ?? null;

if(isset($token)){
    $sql = "select sid,username from userinfo where token='$token'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('sid',$sid);
    $cxjg->bindColumn('username',$username);
    $cxjg->fetch(PDO::FETCH_ASSOC);
    if ($sid==null){
        $username = htmlspecialchars($username);
        $sid = md5($username.$token.'19980925');
        $sql = "update userinfo set sid = '$sid' WHERE username='$username'";
        $stmt = $dblj->exec($sql);
    }
        session_start();
        $_SESSION['uid'] = $uid;
        $_SESSION['sid'] = $sid;
        $lifetime = 60 * 60 * 24 * 365 * 10;
        setcookie(session_name(),session_id(),time()+$lifetime);
        $login_html =<<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>主页</title>
</head>
<body>
尊敬的{$username}，欢迎您回来!<br/><br/>

<a href="game.php?uid=$uid&cmd=0&sid=$sid">快速进入游戏</a><br/><br/>

<b>注意: 请存此页为书签,方便下次直接登陆!</b><br/>
</body>
</html>
HTML;
}
echo $login_html;
?>