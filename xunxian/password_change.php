<?php
include_once 'pdo.php';
$dblj = DB::pdo();
$Dcmd = $_SERVER['QUERY_STRING'];
$result = array();
parse_str($Dcmd, $result);
$token = $result['token'];
$uid = $result['uid'];

if($_POST['change_password']){
    $password = $_POST['password'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $username = $_POST['username'];
    $token = $_POST['token'];
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $password_1 = htmlspecialchars($password_1);
    $password_2 = htmlspecialchars($password_2);
    
    $sql = "select username,userpass from userinfo where token='$token'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('username',$sql_username);
    $cxjg->bindColumn('userpass',$sql_userpass);
    $cxjg->fetch(PDO::FETCH_ASSOC);
    if($username ==$sql_username){
        if($sql_userpass == $password){
        if($password_1 != $password_2){
            echo "新密码与确认密码不一致！<br/>";
        }elseif (strlen($password_1) < 6 or strlen($password_2)< 6)
        {
            echo "密码长度请大于或等于6位！<br/>";
        }
        else{
            $dblj->exec("update userinfo set userpass = '$password_1' where username = '$username' and token = '$token'");
            echo "修改密码成功！请牢记你的新密码:{$password_1}<br/>";
        }
        }
        else{
        echo "旧密码输入有误！<br/>";
        }
    }else{
        echo "非法操作！<br/>";
    }
}

try{
    if(isset($token)){
$change_html = <<<HTML
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" href="css/gamecss.css">
<title>修改密码</title>
</head>
<h2>修改密码</h2>
你好，{$uid}！<br/>
你正在进行密码修改...<br/>
<form method="POST">
<input type="hidden" name="change_password" value="change_password">
<input type="hidden" name="username" value="$uid">
<input type="hidden" name="token" value="$token">
<input name="password" placeholder="旧密码"><br/>
<input name="password_1" placeholder="新密码"><br/>
<input name="password_2" placeholder="确认密码"><br/>
<input name="submit" type="submit" title="修改密码" value="修改密码" class="btn"><br/>
----------------<br/>
<a href="login_mark.php?uid=$uid&token=$token">书签页</a>|<a href="index.php">登录界面</a>
</form>
HTML;
echo $change_html;
}
else{
    header("Location: index.php", true, 302);
}
}catch (Exception $e){
        header("Location: index.php", true, 302);
        exit;
}
?>