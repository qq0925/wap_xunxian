<?php
// 下载 Excel 模板
require 'vendor/autoload.php';

$npc_main = $encode->encode("cmd=gm_npc_first&qy_id=$qy_id&qy_name=$qy_name&post_canshu=1&sid=$sid");
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 设置Excel表头
$sheet->setCellValue('A1', '名称');
$sheet->setCellValue('B1', '性别');
$sheet->setCellValue('C1', '绰号');
$sheet->setCellValue('D1', '描述');
$sheet->setCellValue('E1', '等级');
$sheet->setCellValue('F1', '生命');
$sheet->setCellValue('G1', '最大生命');
$sheet->setCellValue('H1', '法力');
$sheet->setCellValue('I1', '最大法力');
$sheet->setCellValue('J1', '攻击');
$sheet->setCellValue('K1', '防御');
$sheet->setCellValue('L1', '出招速度');
$sheet->setCellValue('M1', '是否可杀');
// 生成并保存Excel文件
$excelFileName = 'in_data/npc_import_template_' . $qy_name . '.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save($excelFileName);

// 生成下载链接
$downloadLink = '<a href="' . $excelFileName . '" download>下载Excel导入模板文件</a><br/>';
$last = "<a href='?cmd=$npc_main'>返回上级</a><br/>";

// 处理Excel导入
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $errors = [];

    // SQL语句，插入操作
$insert_sql = "INSERT INTO system_npc (nname, nsex, nnick_name, ndesc, nlvl, nhp, nmaxhp, nmp, nmaxmp, ngj, nfy, nspeed, nkill, narea_name, narea_id) 
               VALUES (:npc_name, :npc_sex, :npc_nick_name, :npc_desc, :npc_lvl, :npc_hp, :npc_maxhp, :npc_mp, :npc_maxmp, :npc_gj, :npc_fy, :npc_speed, :npc_kill, :npc_area_name, :npc_area_id)";
$stmt = $dblj->prepare($insert_sql);

for ($row = 2; $row <= $highestRow; $row++) {
    $npc_name = $sheet->getCell('A' . $row)->getValue();  // 名称
    $npc_sex = $sheet->getCell('B' . $row)->getValue();  // 性别
    $npc_nick_name = $sheet->getCell('C' . $row)->getValue();  // 绰号
    $npc_desc = $sheet->getCell('D' . $row)->getValue();  // 描述
    $npc_lvl = $sheet->getCell('E' . $row)->getValue();  // 等级
    $npc_hp = $sheet->getCell('F' . $row)->getValue();  // 生命
    $npc_maxhp = $sheet->getCell('G' . $row)->getValue();  // 最大生命
    $npc_mp = $sheet->getCell('H' . $row)->getValue();  // 法力
    $npc_maxmp = $sheet->getCell('I' . $row)->getValue();  // 最大法力
    $npc_gj = $sheet->getCell('J' . $row)->getValue();  // 攻击
    $npc_fy = $sheet->getCell('K' . $row)->getValue();  // 防御
    $npc_speed = $sheet->getCell('L' . $row)->getValue();  // 出招速度
    $npc_kill = $sheet->getCell('M' . $row)->getValue();  // 是否可杀

    $npc_area_name = $qy_name;
    $npc_area_id = $qy_id;

    // 绑定参数并执行插入
    $stmt->bindParam(':npc_name', $npc_name);
    $stmt->bindParam(':npc_sex', $npc_sex);  // 需要获取性别值
    $stmt->bindParam(':npc_nick_name', $npc_nick_name);  // 需要获取昵称值
    $stmt->bindParam(':npc_desc', $npc_desc);
    $stmt->bindParam(':npc_lvl', $npc_lvl);  // 需要获取等级值
    $stmt->bindParam(':npc_hp', $npc_hp);  // 需要获取HP值
    $stmt->bindParam(':npc_maxhp', $npc_maxhp);  // 需要获取最大HP值
    $stmt->bindParam(':npc_mp', $npc_mp);  // 需要获取MP值
    $stmt->bindParam(':npc_maxmp', $npc_maxmp);  // 需要获取最大MP值
    $stmt->bindParam(':npc_gj', $npc_gj);  // 需要获取攻击值
    $stmt->bindParam(':npc_fy', $npc_fy);  // 需要获取防御值
    $stmt->bindParam(':npc_speed', $npc_speed);  // 需要获取速度值
    $stmt->bindParam(':npc_kill', $npc_kill);  // 需要获取击杀数
    $stmt->bindParam(':npc_area_name', $npc_area_name);
    $stmt->bindParam(':npc_area_id', $npc_area_id);

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
区域：{$qy_name}<br/>
$downloadLink<br/>
$up
$last
HTML;

echo $html;
?>
