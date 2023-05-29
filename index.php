<?php
include 'pdo.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
//header('Access-Control-Allow-Origin:*');

$encode = new \encode\encode();
$a = '';
$gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
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
    if ((strlen($username) < 6 || strlen($userpass) < 6) && !$exeres){
        $a = '账号或密码错误';
    }elseif ($cxusername == $username && $cxuserpass == $userpass){

        $sql = "select * from game1 where token='$cxtoken'";
        $cxjg = $dblj->query($sql);
        $cxjg->bindColumn('sid',$sid);
        $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($sid==null){
            $cmd = "cmd=cj&token=$cxtoken";
        }else{
            $cmd = "cmd=login&sid=$sid";
            $nowdate = date('Y-m-d H:i:s');

            $sql = "update game1 set endtime = '$nowdate',sfzx=1 WHERE sid=?";
            $stmt = $dblj->prepare($sql);
            $stmt->execute(array($sid));
        }
        $cmd = $encode->encode($cmd);
        header("refresh:0;url=game.php?cmd=$cmd");
    }

}
?>
<html lang="en">
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport" />
    <title><?php echo $gm_post->game_name ?></title>
    <link rel="stylesheet" href="css/gamecss.css">
    <link rel="shortcut icon" href="http://xunxian.txsj.ink/images/favicons.ico"/>
</head>
<body>
<img src="images/11.jpg" width="320" height="200"><br/>
<?php echo "<div id='mainfont'>".nl2br($gm_post->game_desc)."</div>"?>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
    账号：<br/>
    <input type="text" name="username"><br/>
    密码：<br/>
    <input type="password" name="userpass"><br/>
    <?php echo $a ?>
    <p><input type="submit" name="submit" value="登陆"> <a href="reguser.php" id="btn">注册</a></p>
</form>

</body>
<footer>
    <?php echo date('Y-m-d H:i:s') ?>
</footer>
</html>