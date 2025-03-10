<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require 'class/gm.php';
include_once 'pdo.php';
include_once 'class/iniclass.php';
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

$encode = new \encode\encode();//创建一个名为 $encode 的新对象，并使用命名空间 \encode\encode() 实例化该对象。
$dblj = DB::pdo();
if(!$gm_post){
    $gm_post = new \gm\gm();
    $gm_post = \gm\gm_post($dblj);
}

$Dcmd = $_SERVER['QUERY_STRING'];
$result = array();
parse_str($Dcmd, $result);
$token = isset($result['token']) ? $result['token'] : null;
$login_html = '';

try {
    if(isset($token)) {
        // 使用预处理语句防止SQL注入
        $sql = "SELECT uid, sid, uis_designer FROM game1 WHERE token = :token";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user_result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // 检查是否找到用户
        if ($user_result) {
            $uid = $user_result['uid'];
            $sid = $user_result['sid'];
            $uis_designer = $user_result['uis_designer'];
            $wjid = $uid;
            
            // 包含用户初始化文件
            include './ini/xuser_ini.php';
            $a10 = ($iniFile->getItem('验证信息', 'xcmid值'));
            
            // 获取额外用户信息
            $sql = "SELECT username, designer FROM userinfo WHERE token = :token";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // 检查是否找到用户信息
            if ($user_info) {
                $username = $user_info['username'];
                $designer = $user_info['designer'];
                
                // 确定命令
                if ($sid == null) {
                    $cmd = "cmd=cj&token=$token";
                } else {
                    // 处理设计师状态
                    if ($designer == 1 && $uis_designer == 0) {
                        $update_sql = "UPDATE game1 SET uis_designer = '1' WHERE sid = :sid";
                        $update_stmt = $dblj->prepare($update_sql);
                        $update_stmt->bindParam(':sid', $sid);
                        $update_stmt->execute();
                    }
                    
                    // 包含SQL更新如果是设计师
                    if ($designer == 1) {
                        include 'sql_update.php';
                    }
                    
                    $cmd = "cmd=login&ucmd=0&sid=$sid";
                    $nowdate = date('Y-m-d H:i:s');
                    
                    // 更新用户最后活动时间
                    $update_sql = "UPDATE game1 SET endtime = :nowdate, sfzx = 1 WHERE sid = :sid";
                    $update_stmt = $dblj->prepare($update_sql);
                    $update_stmt->bindParam(':nowdate', $nowdate);
                    $update_stmt->bindParam(':sid', $sid);
                    $update_stmt->execute();
                }
                
                // 编码命令
                $cmd = $encode->encode($cmd);
                $now_time = date('m-d H:i:s');
                
                // 生成HTML
                $login_html = <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$gm_post->game_name}的主页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="css/gamecss.css">
</head>
<body>
尊敬的{$username}，欢迎您回来!<br/><br/>

<image src="images/login_arrow.gif"><a href="game.php?cmd=$cmd">快速进入游戏</a><br/><br/>

<b>注意: 请存此页为书签,方便下次直接登陆!</b><br/>
----------------<br/>
客服电话: 暂无<br/>
官方Q①群: 暂无<br/><br/>
<a href="index.php">登录界面</a>|<a href="password_change.php?uid=$username&token=$token" >修改密码</a><br/>
$now_time<br/>
</body>
</html>
HTML;
            } else {
                throw new Exception("找不到用户信息");
            }
        } else {
            throw new Exception("用户验证失败");
        }
    } else {
        throw new Exception("缺少Token参数");
    }
} catch (Exception $e) {
    //错误日志记录
    error_log("Login error: " . $e->getMessage());
    
    //重定向到登录页
    header("Location: index.php", true, 302);
    exit;
}

// 输出登录HTML
echo $login_html;
?>