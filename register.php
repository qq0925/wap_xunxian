<?php
include 'pdo.php';
require_once 'class/encode.php';
require_once 'class/gm.php';

// 初始化变量和对象
$dblj = DB::pdo();
$encode = new \encode\encode();
$gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
$errors = [];
$success = false;

// 处理表单提交
if (isset($_POST['submit']) && $_POST['submit']) {
    // 获取并清理表单数据
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $userpass = isset($_POST['userpass']) ? trim($_POST['userpass']) : '';
    $userpass2 = isset($_POST['userpass2']) ? trim($_POST['userpass2']) : '';
    
    // 表单验证
    if (empty($username) || empty($userpass) || empty($userpass2)) {
        $errors[] = '请填写所有必填字段';
    } else {
        // 验证用户名和密码长度
        if (strlen($username) < 6) {
            $errors[] = '账号长度请大于或等于6位';
        }
        
        if (strlen($userpass) < 6) {
            $errors[] = '密码长度请大于或等于6位';
        }
        
        // 验证两次密码是否一致
        if ($userpass !== $userpass2) {
            $errors[] = '两次输入密码不一致';
        }
        
        // 检查用户名是否已存在
        try {
            $check_sql = "SELECT * FROM userinfo WHERE username = ?";
            $check_stmt = $dblj->prepare($check_sql);
            $check_stmt->execute([$username]);
            $existing_user = $check_stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existing_user) {
                $errors[] = "注册失败，账号 {$username} 已经存在";
            }
        } catch (PDOException $e) {
            $errors[] = "数据库查询错误: " . $e->getMessage();
            error_log("Registration check error: " . $e->getMessage());
        }
        
        // 如果验证通过，执行注册
        if (empty($errors)) {
            try {
                // 生成安全的密码哈希和令牌
                $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);
                $token = md5($username . $userpass . microtime());
                
                // 准备插入语句
                $insert_sql = "INSERT INTO userinfo (username, userpass, token) VALUES (?, ?, ?)";
                $insert_stmt = $dblj->prepare($insert_sql);
                
                if ($insert_stmt->execute([$username, $userpass, $token])) {
                    $success = true;
                    
                    // 重定向到登录标记页
                    header("refresh:2;URL=login_mark.php?token=$token");
                } else {
                    $errors[] = "注册失败，请稍后再试";
                }
            } catch (PDOException $e) {
                $errors[] = "数据库错误: " . $e->getMessage();
                error_log("Registration insert error: " . $e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php echo htmlspecialchars($gm_post->game_name); ?> - 用户注册</title>
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
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
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
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <div><?php echo htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                注册成功！正在跳转到登录页面...
            </div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="username">账号</label>
                <input type="text" id="username" name="username" minlength="6" required
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="userpass">密码</label>
                <input type="password" id="userpass" name="userpass" minlength="6" required>
            </div>
            
            <div class="form-group">
                <label for="userpass2">确认密码</label>
                <input type="password" id="userpass2" name="userpass2" minlength="6" required>
            </div>
            
            <div class="btn-group">
                <input type="submit" name="submit" class="btn btn-primary" value="注册">
                <a href="index.php" class="btn btn-secondary">返回登录</a>
            </div>
        </form>
        
        <div class="footer">
            <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 验证两次密码是否一致
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('userpass').value;
            const password2 = document.getElementById('userpass2').value;
            
            if (password !== password2) {
                e.preventDefault();
                alert('两次输入的密码不一致！');
            }
        });
    });
    </script>
</body>
</html>