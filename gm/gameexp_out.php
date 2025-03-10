<?php

// 引入 Composer 的 autoloader
require 'vendor/autoload.php';

try {
    // 查询数据
    $stmt = $dblj->query("SELECT * FROM system_exp_def");
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
    foreach ($data as $expr) {
        $column = 0;
        foreach ($expr as $value) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($column);
            $spreadsheet->getActiveSheet()->setCellValue($colLetter . $row, $value);
            $column++;
        }
        $row++;
    }

    // 保存 Excel 文件
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $excelFileName = 'out_data/'.'system_expr_export_all.xlsx';
    $writer->save($excelFileName);
    // 生成下载链接
    $downloadLink = '<a href="' . $excelFileName . '" download>下载 Excel 文件</a><br/>';
    echo "全部表达式的Excel 文件已导出成功。<br/>" . $downloadLink;
    $expr_main = $encode->encode("cmd=gm_game_expdefine&sid=$sid");
    $last = "<a href='?cmd=$expr_main'>返回上级</a><br/>";
    echo $last;
}else{
    echo "并没有数据！<br/>";
    $expr_main = $encode->encode("cmd=gm_game_expdefine&sid=$sid");
    $last = "<a href='?cmd=$expr_main'>返回上级</a><br/>";
    echo $last;
}
} catch (PDOException $e) {
    echo '连接数据库失败: ' . $e->getMessage();
}
?>
