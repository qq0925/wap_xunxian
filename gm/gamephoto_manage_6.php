<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_photomanage&sid=$sid");

// images文件夹路径
$imageDir = 'images/';
$gm_html .="首页图片管理<br/>";
// 处理文件上传逻辑
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // 获取上传的文件名和扩展名
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    // 获取文件扩展名
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // 设置新文件名为login.后缀
    $newFileName = $imageDir . 'login.' . $fileExtension;

    // 移动上传的文件到指定目录
    if (move_uploaded_file($fileTmpName, $newFileName)) {
        echo "图片上传成功!<br>";
    } else {
        echo "图片上传失败!<br>";
    }
}

// 使用glob函数查找login开头的图片，后缀不限
$files = glob($imageDir . 'login.*');

// 检查是否有login图片
if (count($files) > 0) {
    // 如果有图片，获取图片路径并加上时间戳参数
    $loginImage = $files[0];
    $timestamp = time(); // 获取当前时间戳，防止缓存
    // 生成显示图片的HTML
    $gm_html = <<<HTML
    <img src="$loginImage?$timestamp" alt="Login Image" style="max-width: 200px;"><br>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">点击上传新图片:</label><br>
        <input type="file" name="file" id="file"><br>
        <input type="submit" value="上传图片">
    </form>
HTML;
} else {
    // 如果没有图片，生成上传按钮的HTML
    $gm_html = <<<HTML
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">没有图片，点击上传:</label><br>
        <input type="file" name="file" id="file"><br>
        <input type="submit" value="上传图片">
    </form>
HTML;
}
$gm_html .= <<<HTML
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $gm_html;

?>