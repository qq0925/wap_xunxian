<?php
// 下载 Excel 模板
require 'vendor/autoload.php';

$item_main = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 设置Excel表头
$sheet->setCellValue('A1', '物品名称');
$sheet->setCellValue('B1', '物品描述');
$sheet->setCellValue('C1', '物品类别');
$sheet->setCellValue('D1', '子类别');
$sheet->setCellValue('E1', '物品重量');
$sheet->setCellValue('F1', '物品价格');

// 生成并保存Excel文件
$excelFileName = 'in_data/item_import_template_eg' . '.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save($excelFileName);

// 生成下载链接
$downloadLink = '<a href="' . $excelFileName . '" download>下载Excel导入模板文件</a><br/>';
$last = "<a href='?cmd=$item_main'>返回上级</a><br/>";

// 处理Excel导入
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $errors = [];
    $processedRows = 0;

    // SQL语句，插入操作
    $insert_sql = "INSERT INTO system_item_module (iname, idesc,itype,isubtype,iweight,iprice) VALUES (:iname, :idesc, :itype, :isubtype, :iweight, :iprice)";
    $stmt = $dblj->prepare($insert_sql);

    for ($row = 2; $row <= $highestRow; $row++) {
        $item_name = !is_null($sheet->getCell('A' . $row)->getValue()) ? $sheet->getCell('A' . $row)->getValue() : '未命名';
        $item_desc = $sheet->getCell('B' . $row)->getValue();
        
        $item_type = !is_null($sheet->getCell('C' . $row)->getValue()) ? $sheet->getCell('C' . $row)->getValue() : '其它';
        $item_subtype = !is_null($sheet->getCell('D' . $row)->getValue()) ? $sheet->getCell('D' . $row)->getValue() : '未知';
        $item_weight = !is_null($sheet->getCell('E' . $row)->getValue()) ? $sheet->getCell('E' . $row)->getValue() : 1;
        $item_price = !is_null($sheet->getCell('F' . $row)->getValue()) ? $sheet->getCell('F' . $row)->getValue() : 0;

        // 跳过完全空行 (只检查必填字段)
        if (empty($item_name) && empty($item_desc)) {
            continue;
        }

        $processedRows++;

        // 数据校验
        if (empty($item_name) || empty($item_desc) || !is_numeric($item_weight) || !is_numeric($item_price)) {
            $errors[] = "第 {$row} 行数据无效：物品名称、描述或其他必填字段为空或格式不正确<br/>";
            continue;
        }

        // 检查item_name是否已经存在
        $check_stmt = $dblj->prepare("SELECT COUNT(*) FROM system_item_module WHERE iname = :iname");
        $check_stmt->bindParam(':iname', $item_name);
        $check_stmt->execute();
        $count = $check_stmt->fetchColumn();

        if ($count > 0) {
            $errors[] = "第 {$row} 行数据无效：物品名称 {$item_name} 已存在，不能重复插入";
            continue;
        }

        // 绑定参数并执行插入
        $stmt->bindParam(':iname', $item_name);
        $stmt->bindParam(':idesc', $item_desc);
        $stmt->bindParam(':itype', $item_type);
        $stmt->bindParam(':isubtype', $item_subtype);
        $stmt->bindParam(':iweight', $item_weight);
        $stmt->bindParam(':iprice', $item_price);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $errors[] = "第 {$row} 行插入失败：" . $e->getMessage();
        }
    }

    // 输出错误或成功信息
    if (!empty($errors)) {
        echo "<p>共处理了 {$processedRows} 行有效数据</p>";
        foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        }
    } else {
        echo "<p>导入成功！共处理了 {$processedRows} 行数据</p>";
    }
}

// 上传表单
$up = <<<HTML
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".xlsx"><br/>
    <button type="submit" class="btn btn-success">导入Excel文件</button>
</form>
<p><small>注意：Excel中空行将被自动跳过。请确保删除行时使用"删除行"功能而不仅是清空内容。</small></p>
HTML;

// 综合HTML输出
$html = <<<HTML
物品模板导入<br/>
$downloadLink<br/>
$up
$last
HTML;

echo $html;
?>
