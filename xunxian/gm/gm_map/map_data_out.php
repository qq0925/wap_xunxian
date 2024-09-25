<?php

// 引入 Composer 的 autoloader
require 'vendor/autoload.php';

try {
    // 查询数据
    $stmt = $dblj->query("SELECT * FROM system_map where marea_id = '$qy_id'");
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
    foreach ($data as $map) {
        $column = 0;
        foreach ($map as $value) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($column);
            $spreadsheet->getActiveSheet()->setCellValue($colLetter . $row, $value);
            $column++;
        }
        $row++;
    }

    // 保存 Excel 文件
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $excelFileName = 'out_data/'.'system_map_export_'.$marea_name.'.xlsx';
    $writer->save($excelFileName);
    // 生成下载链接
    $downloadLink = '<a href="' . $excelFileName . '" download>下载 Excel 文件</a><br/>';
    echo "{$marea_name}区域地图的Excel 文件已导出成功。<br/>" . $downloadLink;
    $map_main = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&sid=$sid");
    $last = "<a href='?cmd=$map_main'>返回上级</a><br/>";
    echo $last;
}else{
    echo "并没有数据！<br/>";
    $map_main = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&sid=$sid");
    $last = "<a href='?cmd=$map_main'>返回上级</a><br/>";
    echo $last;
}
} catch (PDOException $e) {
    echo '连接数据库失败: ' . $e->getMessage();
}
?>
