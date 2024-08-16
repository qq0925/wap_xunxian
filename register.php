<?php
include 'pdo.php';
require_once 'class/encode.php';
require_once 'class/gm.php';

$dblj = DB::pdo();
$encode = new \encode\encode();
$a = '';
$gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
    if (isset($_POST[ 'submit']) && $_POST['submit'] ){
        $username = $_POST['username'];
        $userpass = $_POST['userpass'];
        $userpass2 = $_POST['userpass2'];
        $username = htmlspecialchars($username);
        $userpass = htmlspecialchars($userpass);
        $sql = "select * from userinfo where username=?";
        $stmt = $dblj->prepare($sql);
        $stmt->execute(array($username));
        $stmt->bindColumn('username',$cxusername);
        $ret = $stmt->fetch(PDO::FETCH_ASSOC);

        if($userpass2 != $userpass){
            $a = '两次输入密码不一致<br/>';
            echo $a;
        }elseif (strlen($username) < 6 or strlen($userpass)< 6){
            $a = '账号或密码长度请大于或等于6位<br/>';
            echo $a;
        }elseif ($ret){
            $a = '注册失败,账号'.$cxusername.'已经存在<br/>';
            echo $a;
        }else{
            $token = md5("$username.$userpass".strtotime(date('Y-m-d H:i:s')));
            $sql = "insert into userinfo(username,userpass,token) values('$username','$userpass','$token')";
            $cxjg = $dblj->exec($sql);
            echo "注册成功！<br/>";
            header("location=login_mark.php?token=$token");
        }
    }

    ?>
<html lang="en">
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <title><?php echo $gm_post->game_name ?></title>

    <link rel="stylesheet" href="css/gamecss.css">
</head>
<body>
<img src="images/11.png" width="320" height="200">
<?php echo "<div id='mainfont'>".nl2br($gm_post->game_desc)."</div>"?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    账号：<br/>
    <input type="text" name="username"><br/>
    密码：<br/>
    <input type="password" name="userpass"><br/>
    确认密码：<br/>
    <input type="password" name="userpass2"><br/>
    <p><input type="submit" name="submit" id="register" value="注册"> <a href="index.php" id="btn">登陆</a></p>
</form>
</body>
<?php echo date('Y-m-d H:i:s') ?>
</html>