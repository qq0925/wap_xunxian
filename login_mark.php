<?php
require_once 'class/player.php';
require_once 'class/encode.php';
include_once 'pdo.php';
include_once 'class/iniclass.php';
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

$encode = new \encode\encode();//创建一个名为 $encode 的新对象，并使用命名空间 \encode\encode() 实例化该对象。


$Dcmd = $_SERVER['QUERY_STRING'];
$result = array();
parse_str($Dcmd, $result);
$token = $result['token'];
try{
if(isset($token)){

    $sql = "select uid,sid,uis_designer from game1 where token='$token'";
    $cxjg = $dblj->query($sql);
if($cxjg){
    $cxjg->bindParam(':token', $token);
    $cxjg->execute();

// 获取结果
$result = $cxjg->fetch(PDO::FETCH_ASSOC);
}
if ($result) {
    $uid = $result['uid'];
    $sid = $result['sid'];
    $uis_designer = $result['uis_designer'];
}

    $wjid = $uid;

    include './ini/xuser_ini.php';
    $a10 = ($iniFile->getItem('验证信息', 'xcmid值'));
    // 检查表是否存在 designer 字段
    $sql = "SHOW COLUMNS FROM userinfo LIKE 'designer'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果 designer 字段不存在，执行添加字段操作
        $sql = "ALTER TABLE userinfo ADD COLUMN designer INT DEFAULT 0";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }
    
    // 检查表是否存在 nwin和ndefeat 字段
    $sql = "SHOW COLUMNS FROM system_npc LIKE 'nwin_event_id'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果 designer 字段不存在，执行添加字段操作
        $sql = "ALTER TABLE system_npc
ADD nwin_event_id int(11) NOT NULL  
AFTER nattack_event_id,  
ADD ndefeat_event_id int(11) NOT NULL  
AFTER nwin_event_id ;";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "ALTER TABLE system_npc_midguaiwu
ADD nwin_event_id int(11) NOT NULL  
AFTER nattack_event_id,  
ADD ndefeat_event_id int(11) NOT NULL  
AFTER nwin_event_id ;";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }

    // 检查player_temp_attr表是否存在
    $result = $dblj->query("SHOW TABLES LIKE 'player_temp_attr'");
    if ($result->rowCount() == 0) {
        // 表不存在，创建表
        $sql = "CREATE TABLE player_temp_attr (
            obj_id TEXT NOT NULL,
            obj_oid TEXT NOT NULL,
            obj_type  INT NOT NULL,
            attr_name VARCHAR(255) NOT NULL,
            attr_value VARCHAR(255) NOT NULL
        )";
        $dblj->exec($sql);
    }

$sql = "SELECT username, designer FROM userinfo WHERE token = :token";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':token', $token);
$stmt->execute();


// 获取结果
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $username = $result['username'];
    $designer = $result['designer'];
}
    if ($sid==null){
        $cmd = "cmd=cj&token=$token";
    }else{
        
        if($designer ==1&&$uis_designer ==0){
        $sql = "update game1 set uis_designer = '1' WHERE sid=?";
        $stmt = $dblj->prepare($sql);
        $stmt->execute(array($sid));
        }
        
        $cmd = "cmd=login&ucmd=0&sid=$sid";
        $nowdate = date('Y-m-d H:i:s');
        $sql = "update game1 set endtime = '$nowdate',sfzx=1 WHERE sid=?";
        $stmt = $dblj->prepare($sql);
        $stmt->execute(array($sid));
    }
        $cmd = $encode->encode($cmd);
        $now_time = date('m-d H:i:s');
        $login_html =<<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="css/gamecss.css">
    <title>主页</title>
</head>
<body>
尊敬的{$username}，欢迎您回来!<br/><br/>

<image src="images/login.gif"><a href="game.php?cmd=$cmd">快速进入游戏</a><br/><br/>

<b>注意: 请存此页为书签,方便下次直接登陆!</b><br/>
----------------<br/>
客服电话: 暂无<br/>
官方Q①群: 暂无<br/><br/>
<a href="index.php">登录界面</a>|<a href="password_change.php?uid=$username&token=$token" >修改密码</a><br/>
$now_time<br/>
</body>
</html>
HTML;
}
}
catch (Exception $e){
        header("Location: index.php", true, 302);
        exit;
}
echo $login_html;
?>