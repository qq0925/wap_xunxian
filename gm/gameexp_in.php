<?php
// 下载 Excel 模板
require 'vendor/autoload.php';

$expr_main = $encode->encode("cmd=gm_game_expdefine&sid=$sid");
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 设置Excel表头
$sheet->setCellValue('A1', '表达式ID');
$sheet->setCellValue('B1', '表达式类型');
$sheet->setCellValue('C1', '表达式值');

// 生成并保存Excel文件
$excelFileName = 'in_data/expr_import_template_one.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save($excelFileName);

// 生成下载链接
$downloadLink = '<a href="' . $excelFileName . '" download>下载Excel导入模板文件</a><br/>';
$last = "<a href='?cmd=$expr_main'>返回上级</a><br/>";

// 处理Excel导入
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $errors = [];

    // SQL语句，插入操作
    $insert_sql = "INSERT INTO system_exp_def (id, type, value) VALUES (:expr_id, :expr_type, :expr_value)";
    $stmt = $dblj->prepare($insert_sql);

    // SQL语句，检查是否存在相同的expr_id
    $check_sql = "SELECT COUNT(*) FROM system_exp_def WHERE id = :expr_id";
    $check_stmt = $dblj->prepare($check_sql);

    for ($row = 2; $row <= $highestRow; $row++) {
        $expr_id = $sheet->getCell('A' . $row)->getValue();
        $expr_type = $sheet->getCell('B' . $row)->getValue();
        $expr_value = $sheet->getCell('C' . $row)->getValue();
        
        // 数据校验
        if (empty($expr_id) || empty($expr_name) || !is_numeric($refresh_interval)) {
            $errors[] = "第 {$row} 行数据无效：表达式ID、类型以及值格式不正确<br/>";
            continue;
        }

        // 检查expr_id是否已经存在
        $check_stmt->bindParam(':expr_id', $expr_id);
        $check_stmt->execute();
        $count = $check_stmt->fetchColumn();

        if ($count > 0) {
            $errors[] = "第 {$row} 行数据无效：表达式ID {$expr_id} 已存在，不能重复插入";
            continue;
        }

        // 绑定参数并执行插入
        $stmt->bindParam(':expr_id', $expr_id);
        $stmt->bindParam(':expr_type', $expr_type);
        $stmt->bindParam(':expr_value', $expr_value);

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
$downloadLink<br/>
$up
$last
HTML;

echo $html;
?>
