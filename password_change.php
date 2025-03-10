<?php
include_once 'pdo.php';
$dblj = DB::pdo();

// 初始化变量
$message = "";
$username = "";

// 获取URL参数
$Dcmd = $_SERVER['QUERY_STRING'];
$result = array();
parse_str($Dcmd, $result);
$token = isset($result['token']) ? $result['token'] : null;
$uid = isset($result['uid']) ? $result['uid'] : null;

// 处理密码修改请求
if(isset($_POST['change_password'])){
    // 获取表单数据
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $password_1 = isset($_POST['password_1']) ? trim($_POST['password_1']) : '';
    $password_2 = isset($_POST['password_2']) ? trim($_POST['password_2']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $form_token = isset($_POST['token']) ? trim($_POST['token']) : '';
    
    // 验证表单数据
    if(empty($password) || empty($password_1) || empty($password_2) || empty($username) || empty($form_token)) {
        $message = "所有字段都必须填写！";
    } 
    // 确保表单提交的token与URL中的token匹配
    else if($form_token !== $token) {
        $message = "安全验证失败，请重新尝试！";
    }
    else {
        try {
            // 获取用户信息
            $sql = "SELECT username, userpass FROM userinfo WHERE token = :token";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':token', $form_token, PDO::PARAM_STR);
            $stmt->execute();
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$user_data) {
                $message = "无效的用户信息！";
            }
            else if($username != $user_data['username']) {
                $message = "用户名不匹配！";
            }
            else if($user_data['userpass'] != $password) {
                $message = "旧密码输入有误！";
            }
            else if($password_1 != $password_2) {
                $message = "新密码与确认密码不一致！";
            }
            else if(strlen($password_1) < 6) {
                $message = "密码长度请大于或等于6位！";
            }
            else {
                // 更新密码
                $update_sql = "UPDATE userinfo SET userpass = :new_password WHERE username = :username AND token = :token";
                $update_stmt = $dblj->prepare($update_sql);
                $update_stmt->bindParam(':new_password', $password_1, PDO::PARAM_STR);
                $update_stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $update_stmt->bindParam(':token', $form_token, PDO::PARAM_STR);
                
                if($update_stmt->execute()) {
                    $message = "<span style='color:green'>修改密码成功！请牢记你的新密码。</span>";
                } else {
                    $message = "密码更新失败，请稍后再试！";
                }
            }
        } catch(PDOException $e) {
            $message = "数据库错误，请稍后再试！";
            error_log("Password change error: " . $e->getMessage());
        }
    }
}

// 显示页面
try {
    if(isset($token) && isset($uid)) {
        // 转义用于显示的变量
        $uid_display = htmlspecialchars($uid, ENT_QUOTES, 'UTF-8');
        $token_value = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');
        
        $change_html = <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="css/gamecss.css">
    <title>修改密码</title>
    <style>
        .message {
            color: red;
            margin: 10px 0;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .btn {
            padding: 5px 15px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>修改密码</h2>
    <p>你好，{$uid_display}！你正在进行密码修改...</p>
    
    <div class="message">{$message}</div>
    
    <form method="POST">
        <input type="hidden" name="change_password" value="change_password">
        <input type="hidden" name="username" value="{$uid_display}">
        <input type="hidden" name="token" value="{$token_value}">
        
        <div class="form-group">
            <input name="password" type="password" placeholder="旧密码" required>
        </div>
        
        <div class="form-group">
            <input name="password_1" type="password" placeholder="新密码" required>
        </div>
        
        <div class="form-group">
            <input name="password_2" type="password" placeholder="确认密码" required>
        </div>
        
        <input name="submit" type="submit" title="修改密码" value="修改密码" class="btn">
    </form>
    
    <hr>
    <p>
        <a href="login_mark.php?uid={$uid_display}&token={$token_value}">书签页</a> | 
        <a href="index.php">登录界面</a>
    </p>
</body>
</html>
HTML;
        echo $change_html;
    } else {
        // 缺少必要参数，重定向到登录页
        header("Location: index.php", true, 302);
        exit;
    }
} catch (Exception $e) {
    error_log("Password change page error: " . $e->getMessage());
    header("Location: index.php", true, 302);
    exit;
}
?>