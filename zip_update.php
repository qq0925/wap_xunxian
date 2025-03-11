<?php
function compressToZip($excludeFiles = [], $excludeDirs = []) {
    global $encode, $sid;
    $currentDir = getcwd(); // 获取当前目录
    $zipFile = "xunxian.zip"; // 压缩后的文件名
    $zip = new ZipArchive();

    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        // 遍历当前目录下的所有文件和文件夹
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($currentDir, RecursiveDirectoryIterator::SKIP_DOTS));

        foreach ($iterator as $file) {
            $relativePath = str_replace($currentDir . DIRECTORY_SEPARATOR, '', $file->getPathname());

            // 排除指定文件和文件夹
            if (!in_array($relativePath, $excludeFiles) && !isExcludedDir($file->getPath(), $excludeDirs)) {
                // 添加文件到压缩包中
                $zip->addFile($file->getPathname(), $relativePath);
            }
        }

        // 关闭并创建压缩包
        $zip->close();
        $gm_zip_update = $encode->encode("cmd=gm_game_zipfile&type=update&download=1&sid=$sid");
        echo "压缩成功: <a href='?cmd=$gm_zip_update'>点击下载</a><br/>";
    } else {
        echo "无法创建压缩包。<br/>";
    }
}

// 判断是否为排除的文件夹
function isExcludedDir($filePath, $excludeDirs) {
    foreach ($excludeDirs as $excludeDir) {
        if (strpos($filePath, $excludeDir) !== false) {
            return true;
        }
    }
    return false;
}

$gm_main = $encode->encode("cmd=gm&sid=$sid");

if (isset($download) && $download == 1) {
    $zipFile = "xunxian.zip"; // 压缩后的文件名
    if (file_exists($zipFile)) {
        // 确保输出缓冲区清理干净
        ob_clean();
        flush();
        
        // 设置适当的响应头以触发下载
        header('Content-Description: File Transfer');
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($zipFile) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zipFile));
        readfile($zipFile);
        unlink($zipFile);
        exit;
    } else {
        echo "文件不存在。<br/>";
    }
} else {
    $excludeFiles = ['favicon.php', 'xunxian.zip']; // 排除的文件
    $excludeDirs = ['.git', '.well-known', 'ache', 'cache', 'css', 'images', 'js','out_data','in_data']; // 排除的文件夹
    compressToZip($excludeFiles, $excludeDirs);
}

echo "<a href='?cmd=$gm_main'>返回设计大厅</a><br/>";
?>
