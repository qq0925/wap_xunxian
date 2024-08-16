<?php
// 下载 Excel 模板
require 'vendor/autoload.php';

$map_main = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&sid=$sid");
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 设置Excel表头
$sheet->setCellValue('A1', '地图ID');
$sheet->setCellValue('B1', '地图名称');
$sheet->setCellValue('C1', '地图描述');
$sheet->setCellValue('D1', '刷新间隔');
$sheet->setCellValue('E1', '上出口ID');
$sheet->setCellValue('F1', '下出口ID');
$sheet->setCellValue('G1', '左出口ID');
$sheet->setCellValue('H1', '右出口ID');

// 生成并保存Excel文件
$excelFileName = 'in_data/map_import_template_' . $marea_name . '.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save($excelFileName);

// 生成下载链接
$downloadLink = '<a href="' . $excelFileName . '" download>下载Excel导入模板文件</a><br/>';
$last = "<a href='?cmd=$map_main'>返回上级</a><br/>";

// 处理Excel导入
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $errors = [];

    // SQL语句，插入操作
    $insert_sql = "INSERT INTO system_map (mid, mname, mdesc, mrefresh_time, mup, mdown, mleft, mright,marea_name,marea_id) VALUES (:map_id, :mname, :mdesc, :refresh_interval, :top_exit_id, :bottom_exit_id, :left_exit_id, :right_exit_id,'$marea_name','$qy_id')";
    $stmt = $dblj->prepare($insert_sql);

    // SQL语句，检查是否存在相同的map_id
    $check_sql = "SELECT COUNT(*) FROM system_map WHERE mid = :map_id";
    $check_stmt = $dblj->prepare($check_sql);

    for ($row = 2; $row <= $highestRow; $row++) {
        $map_id = $sheet->getCell('A' . $row)->getValue();
        $map_name = $sheet->getCell('B' . $row)->getValue();
        $map_desc = $sheet->getCell('C' . $row)->getValue();
        
        $refresh_interval = !is_null($sheet->getCell('D' . $row)->getValue()) ? $sheet->getCell('D' . $row)->getValue() : 1;
        $top_exit_id = !is_null($sheet->getCell('E' . $row)->getValue()) ? $sheet->getCell('E' . $row)->getValue() : 0;
        $bottom_exit_id = !is_null($sheet->getCell('F' . $row)->getValue()) ? $sheet->getCell('F' . $row)->getValue() : 0;
        $left_exit_id = !is_null($sheet->getCell('G' . $row)->getValue()) ? $sheet->getCell('G' . $row)->getValue() : 0;
        $right_exit_id = !is_null($sheet->getCell('H' . $row)->getValue()) ? $sheet->getCell('H' . $row)->getValue() : 0;


        // 数据校验
        if (empty($map_id) || empty($map_name) || !is_numeric($refresh_interval) || 
            !is_numeric($top_exit_id) || !is_numeric($bottom_exit_id) || !is_numeric($left_exit_id) || !is_numeric($right_exit_id)) {
            $errors[] = "第 {$row} 行数据无效：地图ID、名称或其他必填字段为空或格式不正确<br/>";
            continue;
        }

        // 检查map_id是否已经存在
        $check_stmt->bindParam(':map_id', $map_id);
        $check_stmt->execute();
        $count = $check_stmt->fetchColumn();

        if ($count > 0) {
            $errors[] = "第 {$row} 行数据无效：地图ID {$map_id} 已存在，不能重复插入";
            continue;
        }

        // 绑定参数并执行插入
        $stmt->bindParam(':map_id', $map_id);
        $stmt->bindParam(':mname', $map_name);
        $stmt->bindParam(':mdesc', $map_desc);
        $stmt->bindParam(':refresh_interval', $refresh_interval);
        $stmt->bindParam(':top_exit_id', $top_exit_id);
        $stmt->bindParam(':bottom_exit_id', $bottom_exit_id);
        $stmt->bindParam(':left_exit_id', $left_exit_id);
        $stmt->bindParam(':right_exit_id', $right_exit_id);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $errors[] = "第 {$row} 行插入失败：" . $e->getMessage();
        }
    }

    // 输出错误或成功信息
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        }
    } else {
        echo "导入成功！";
    }
}

// 上传表单
$up = <<<HTML
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".xlsx"><br/>
    <button type="submit" class="btn btn-success">导入Excel文件</button>
</form>
HTML;

// 综合HTML输出
$html = <<<HTML
区域：{$marea_name}<br/>
$downloadLink<br/>
$up
$last
HTML;

echo $html;
?>
