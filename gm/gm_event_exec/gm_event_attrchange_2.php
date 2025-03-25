<?php
if($canshu == 'in'){
// 下载 Excel 模板
require 'vendor/autoload.php';

$gm_game_globaleventdefine_attr_last = $encode->encode("cmd=game_event_attrchange&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 设置Excel表头
$sheet->setCellValue('A1', '键');
$sheet->setCellValue('B1', '值');

// 生成并保存Excel文件
$excelFileName = 'in_data/attr_modding.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save($excelFileName);

// 生成下载链接
$downloadLink = '<a href="' . $excelFileName . '" download>下载Excel导入模板文件</a><br/>';
$last = "<a href='?cmd=$gm_game_globaleventdefine_attr_last'>返回上级</a><br/>";

// 处理Excel导入
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    
    // 首先获取当前的m_attrs值
    $query = "SELECT m_attrs FROM system_event_evs WHERE belong = :evs_belong AND id = :evs_id";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':evs_belong', $step_belong_id);
    $stmt->bindParam(':evs_id', $step_id);
    $stmt->execute();
    $current_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 解析当前的JSON数据为数组，如果为空则初始化为空数组
    $attrs_array = [];
    if (!empty($current_data['m_attrs'])) {
        // 尝试解析JSON
        $decoded = json_decode($current_data['m_attrs'], true);
        if (is_array($decoded)) {
            $attrs_array = $decoded;
        }
    }
    
    // 加载Excel文件
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $errors = [];
    $processedRows = 0;
    
    // 处理Excel中的每一行，更新到attrs_array
    for ($row = 2; $row <= $highestRow; $row++) {
        $attr_key = trim($sheet->getCell('A' . $row)->getValue());
        
        // 跳过空行（检查必填字段）
        if (empty($attr_key)) {
            continue;
        }
        
        $attr_value = $sheet->getCell('B' . $row)->getValue();
        // 确保值不为null
        if ($attr_value === null) {
            $attr_value = '';
        }
        
        // 更新属性数组
        $attrs_array[$attr_key] = $attr_value;
        $processedRows++;
    }
    
    // 将处理后的数组转换为JSON
    $new_m_attrs = json_encode($attrs_array, JSON_UNESCAPED_UNICODE);
    
    // 更新数据库
    $update_sql = "UPDATE system_event_evs SET m_attrs = :m_attrs WHERE belong = :evs_belong AND id = :evs_id";
    $stmt = $dblj->prepare($update_sql);
    $stmt->bindParam(':m_attrs', $new_m_attrs);
    $stmt->bindParam(':evs_belong', $step_belong_id);
    $stmt->bindParam(':evs_id', $step_id);
    
    try {
        $stmt->execute();
        echo "<div style='color:green;'>导入成功！共更新了 {$processedRows} 个属性</div>";
        echo "<div>更新后的属性数据：<pre>" . htmlspecialchars($new_m_attrs) . "</pre></div>";
    } catch (PDOException $e) {
        echo "<div style='color:red;'>更新失败：" . $e->getMessage() . "</div>";
    }
}

// 获取当前属性数据用于显示
$query = "SELECT m_attrs FROM system_event_evs WHERE belong = :evs_belong AND id = :evs_id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':evs_belong', $step_belong_id);
$stmt->bindParam(':evs_id', $step_id);
$stmt->execute();
$current_data = $stmt->fetch(PDO::FETCH_ASSOC);

$current_attrs_html = '<p>当前属性数据：';
if (!empty($current_data['m_attrs'])) {
    $current_attrs_html .= '<pre>' . htmlspecialchars($current_data['m_attrs']) . '</pre>';
} else {
    $current_attrs_html .= '<em>无数据</em>';
}
$current_attrs_html .= '</p>';

// 上传表单
$up = <<<HTML
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".xlsx"><br/>
    <button type="submit" class="btn btn-success">导入Excel文件</button>
</form>
<p><small>注意：Excel中的键值对将被导入并合并到现有属性中。空行将被自动跳过。相同的键会被新值覆盖。</small></p>
HTML;

// 综合HTML输出
$gm_html = <<<HTML
<h3>属性设置导入</h3>
$current_attrs_html
$downloadLink<br/>
$up
$last
HTML;
}else{
$gm_game_globaleventdefine_attr_last = $encode->encode("cmd=game_event_attrchange&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$attrchange_post = $encode->encode("cmd=game_event_attrchange&step_belong_id=$step_belong_id&step_id=$step_id&sid=$sid");
$attr_value_2 = htmlspecialchars($attr_value, ENT_QUOTES, 'UTF-8');

$gm_html =<<<HTML
<p>修改事件步骤的更改属性的值<br/>
</p>
<form action="?cmd=$attrchange_post" method="post">
<input type="hidden" name="step_belong_id" value="$step_belong_id">
<input type="hidden" name="step_id" value="$step_id">
<input type="hidden" name="canshu" value="$canshu">
<input name="old_key" type="hidden" value="{$attr_key}"/>
属性名:<input name="key" type="text" value="$attr_key" maxlength="50"/><br/>
属性值表达式(以""包裹起来表示字符串表达式):<textarea name="value" maxlength="4096" rows="4" cols="40">{$attr_value}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_game_globaleventdefine_attr_last">返回上级</a><br/>
HTML;
}
echo $gm_html;
?>