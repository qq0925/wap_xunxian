<?php
include 'pdo.php';//导入pdo数据库模块
require_once 'class/encode.php';//导入加密算法模块
require_once 'class/gm.php';//导入后台管理员模块


$encode = new \encode\encode();//创建一个名为 $encode 的新对象，并使用命名空间 \encode\encode() 实例化该对象。
$a = '';
$gm_post = new \gm\gm();//同上encode的理
$gm_post = \gm\gm_post($dblj);//调用一个名为 \gm\gm_post() 的函数，并将变量 $dblj 作为参数传递给该函数。


if (isset($_POST[ 'submit']) && $_POST['submit']){

    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $username = htmlspecialchars($username);
    $userpass = htmlspecialchars($userpass);
    $sql = "select * from userinfo where username = ? and userpass = ?";
    $stmt = $dblj->prepare($sql);
    $bool = $stmt->execute(array($username,$userpass));
    $stmt->bindColumn('username',$cxusername);
    $stmt->bindColumn('userpass',$cxuserpass);
    $stmt->bindColumn('token',$cxtoken);
    $exeres = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$exeres){
        $a = '账号或密码错误';
    }elseif ($cxusername == $username && $cxuserpass == $userpass){
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="0;URL=login_mark.php?uid=$username&token=$cxtoken">
HTML;
echo $refresh_html;
        //header("location=login_mark.php?uid=$username&token=$cxtoken");
        exit();
    }

}
?>

<html lang="en">
<head> 
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport" />
    <title><?php echo $gm_post->game_name ?></title>
    <link rel="stylesheet" href="css/gamecss.css">
    <link rel="shortcut icon" href="images/favicons.ico"/>
</head>
<body>
<img src="images/11.png" width="320" height="200"><br/>
<?php echo "<div id='mainfont'>".nl2br($gm_post->game_desc)."</div>"?>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
    账号：<br/>
    <input type="text" name="username"><br/>
    密码：<br/>
    <input type="password" name="userpass"><br/>
    <?php echo $a; ?>
    <p><input type="submit" name="submit" id="login" value="登陆"> <a href="register.php" id="btn">注册</a></p>
</form>
</body>
<footer>
    <?php echo date('Y-m-d H:i:s') ?>
</footer>
</html>