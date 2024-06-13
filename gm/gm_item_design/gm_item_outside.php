<?php

// 引入 Composer 的 autoloader
require 'vendor/autoload.php';

try {
    // 查询数据
    $stmt = $dblj->query("SELECT * FROM system_item_module");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(!empty($data)){
        // 创建 Excel
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

    // 设置表头
    $column = 0;
    $row = 1;
    foreach ($data[0] as $key => $value) {
        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($column);
        $spreadsheet->getActiveSheet()->setCellValue($colLetter . $row, $key);
        $column++;
    }

    // 设置数据
    $row = 2;
    foreach ($data as $item) {
        $column = 0;
        foreach ($item as $value) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($column);
            $spreadsheet->getActiveSheet()->setCellValue($colLetter . $row, $value);
            $column++;
        }
        $row++;
    }

    // 保存 Excel 文件
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $excelFileName = 'out_data/'.'system_item_module_export.xlsx';
    $writer->save($excelFileName);
    // 生成下载链接
    $downloadLink = '<a href="' . $excelFileName . '" download>下载 Excel 文件</a><br/>';
    echo 'Excel 文件已导出成功。<br/>' . $downloadLink;
    $item_main = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
    $last = "<a href='?cmd=$item_main'>返回上级</a><br/>";
    echo $last;
}else{
    echo "并没有数据！<br/>";
    $item_main = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
    $last = "<a href='?cmd=$item_main'>返回上级</a><br/>";
    echo $last;
    
}
} catch (PDOException $e) {
    echo '连接数据库失败: ' . $e->getMessage();
}
?>
