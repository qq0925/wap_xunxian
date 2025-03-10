<?php
include 'pdo.php';//导入pdo数据库模块
require_once 'class/encode.php';//导入加密算法模块
require_once 'class/gm.php';//导入后台管理员模块

// 初始化变量和对象
$dblj = DB::pdo();
$gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
$error_message = '';

// 处理登录表单提交
if (isset($_POST['submit']) && $_POST['submit']) {
    // 获取并清理表单数据
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $userpass = isset($_POST['userpass']) ? trim($_POST['userpass']) : '';
    
    // 表单验证
    if (empty($username) || empty($userpass)) {
        $error_message = '请输入账号和密码';
    } else {
        try {
            // 安全查询用户信息
            $sql = "SELECT * FROM userinfo WHERE username = ? AND userpass = ?";
            $stmt = $dblj->prepare($sql);
            $stmt->execute([$username, $userpass]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                $error_message = '账号或密码错误';
            } else {
                // 登录成功，重定向到书签页
                $cxtoken = $user['token'];
                header("Location: login_mark.php?uid=$username&token=$cxtoken");
                exit();
            }
        } catch (PDOException $e) {
            $error_message = '数据库错误，请稍后再试';
            error_log("Login error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php echo htmlspecialchars($gm_post->game_name); ?> - 用户登录</title>
    <link rel="stylesheet" href="css/gamecss.css">
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group input:focus {
            border-color: #4a90e2;
            outline: none;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #4a90e2;
            color: white;
        }
        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="images/login.png" alt="Logo" style="max-width: 100%; height: auto;">
        </div>
        
        <div id="mainfont">
            <?php echo html_entity_decode(nl2br($gm_post->game_desc)); ?>
        </div>
        
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="username">账号</label>
                <input type="text" id="username" name="username" required
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="userpass">密码</label>
                <input type="password" id="userpass" name="userpass" required>
            </div>
            
            <div class="btn-group">
                <input type="submit" name="submit" class="btn btn-primary" value="登录">
                <a href="register.php" class="btn btn-secondary">注册账号</a>
            </div>
        </form>
        
        <div class="footer">
            <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>
</body>
</html>