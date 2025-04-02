<?php

if(!empty($_POST)){
    $type_name = $_POST['name'];
    $sql = "select name from system_photo_type where name = '$type_name'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    if(!$ret['name']){
    echo "新增成功！<br/>";
    $sql = "insert into system_photo_type (name,contains) values ('$type_name',0)";
    $cxjg = $dblj->exec($sql);
    $targetDirectory = 'images/'.$type_name;
    mkdir($targetDirectory, 0777, true);
    }else{
    echo "已存在该类别！<br/>";
    }
}

if($delete_name){
    $targetDirectory = 'images/'.$delete_name;
    rmdir($targetDirectory);
    echo "已删除该类别！<br/>";
    $sql = "delete from system_photo_type where name = '$delete_name'";
    $cxjg = $dblj->exec($sql);
}

if($flush_name){
    // 过滤目录名防止路径遍历
    $flush_name = basename($flush_name);
    $targetDirectory = 'images/'.$flush_name;
    
    $fileCount = 0;  // 初始化计数器
    $dbOperationMessage = ""; // 数据库操作结果

    // 执行数据库删除操作（无论文件是否存在都会执行）
    $sql = "DELETE FROM system_photo WHERE type = :name";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':name', $flush_name);
    $dbSuccess = $stmt->execute();

    if (is_dir($targetDirectory)) {
        // 扫描目录并过滤特殊目录
        $files = array_diff(scandir($targetDirectory), ['.', '..']);
        
        foreach ($files as $file) {
            $filePath = $targetDirectory.'/'.$file;
            // 只删除文件不处理目录
            if (is_file($filePath) && unlink($filePath)) {
                $fileCount++;
            }
        }

        if ($fileCount > 0) {
            echo "已移除{$fileCount}个图片文件，";
        } else {
            echo "文件夹内未存在文件，";
        }
    } else {
        echo "文件夹内未存在文件，";
    }

    // 根据数据库操作结果输出
    if ($dbSuccess) {
        echo "已移除数据库记录。<br/>";
    } else {
        echo "数据库删除失败，请联系管理员！<br/>";
    }
}


$_SERVER['PHP_SELF'];
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$gm =new \gm\gm();
$gm_photo_type = \gm\getphoto_type($dblj);

$photo_html = '';
$photo_type_add = $encode->encode("cmd=photo_type_add&gm_type_add=1&sid=$sid");
$last_page = $encode->encode("cmd=photo_type_add&gm_type_add=0&sid=$sid");
for ($i=0;$i<count($gm_photo_type);$i++){
    $photo_type_name = $gm_photo_type[$i]['name'];
    $photo_type_count = $gm_photo_type[$i]['contains'];
    $hangshu += 1;
    $photo_detail = $encode->encode("cmd=photo_detail&type=$photo_type_name&sid=$sid");
    if($photo_type_count>0){
    $photo_html .=<<<HTML
    <a href="?cmd=$photo_detail">{$hangshu}.{$photo_type_name}[{$photo_type_count}张]</a><br/>
HTML;
}else{
    $photo_type_delete = $encode->encode("cmd=gm_game_photomanage&delete_name=$photo_type_name&sid=$sid");
    $photo_html .=<<<HTML
    <a href="?cmd=$photo_detail">{$hangshu}.{$photo_type_name}[{$photo_type_count}张]</a><a href="?cmd=$photo_type_delete">删除类别</a><br/>
HTML;
}
}

if($gm_type_add ==0){
$login_define = $encode->encode("cmd=addition_photo&canshu=1&sid=$sid");
$ico_define = $encode->encode("cmd=addition_photo&canshu=2&sid=$sid");
$gm_html = <<<HTML
<p>[图片管理]</p>
$photo_html<br/>
<a href="?cmd=$photo_type_add">增加图片类别</a><br/>
----------<br/>
<a href="?cmd=$login_define">定义登录页图片</a><br/>
<a href="?cmd=$ico_define">定义网页图标</a><br/>
----------<br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
}elseif($gm_type_add ==1){
$add_post = $encode->encode("cmd=photo_type_add&gm_type_add=0&sid=$sid");
$gm_html = <<<HTML
<p>请输入要增加的类别的名称<br/>
</p>
<form action="?cmd=$add_post" method="post">
类别名称:<input name="name" type="text" maxlength="20"/><br/>
<input name="submit" type="submit" title="增加" value="增加"/><input name="submit" type="hidden" title="增加" value="增加"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
}
echo $gm_html;
?>