<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_taskdesign&sid=$sid");

function gettaskcount($task_id,$dblj){
    $sql = "select COUNT(tbelong) as count from system_task where tbelong = '$task_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $count = $ret['count'];
    return $count;
}

if(isset($_POST['add_name'])){
    $add_name = $_POST['add_name'];
    $add_desc = $_POST['add_desc'];
    $sql = "select f_name from system_task_father where f_name = '$add_name'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('f_name',$true_name);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    if(!$ret){
        echo "添加成功！<br/>";
    $sql = "insert into system_task_father(f_name,f_desc) values ('$add_name','$add_desc')";
    $dblj->exec($sql);
    }else{
        echo "名称重复！<br/>";
    }
}
if($delete_canshu&&!$_POST){
    $dblj->exec("delete from system_task_father where f_id = '$delete_canshu'");
    echo "已删除！<br/>";
    unset($delete_canshu);
}

if($out_canshu&&!$_POST){
require 'vendor/autoload.php';
try {
    // 查询数据
    $stmt = $dblj->query("SELECT * FROM system_task where tbelong = '$out_canshu'");
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
    $excelFileName = 'out_data/'.'system_task_'.$out_name.'.xlsx';
    $writer->save($excelFileName);
    // 生成下载链接
    $downloadLink = '<a href="' . $excelFileName . '" download>下载 Excel 文件</a><br/>';
    echo '文件已导出成功。<br/>' . $downloadLink;
}else{
    echo "并没有数据！<br/>";
}
} catch (PDOException $e) {
    echo '连接数据库失败: ' . $e->getMessage().'<br/>';
}
}

if(!$task_canshu){
$sql = "select f_id,f_name,f_desc from system_task_father";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($ret)+1;$i++){
$task_id = $ret[$i-1]['f_id'];
$task_name = $ret[$i-1]['f_name'];
$task_desc = $ret[$i-1]['f_desc'];
$ow_task = gettaskcount($task_id,$dblj);
$task_out = $encode->encode("cmd=gm_game_taskdesign&gm_post_canshu=-1&out_canshu=$task_id&out_name=$task_name&sid=$sid");
$out_url = "game.php?cmd=$task_out";
if($task_id !='1'){
$task_delete = $encode->encode("cmd=gm_game_taskdesign&gm_post_canshu=-1&delete_canshu=$task_id&sid=$sid");
$del_url = "game.php?cmd=$task_delete";
$task_list .=<<<HTML
[$i].{$task_name}(ID:{$task_id},数量:{$ow_task})<a href="#" onclick="return confirmAction('$del_url', '{$task_name}')">删除</a>
<a href="#" onclick="return confirmAction_out('$out_url', '{$task_name}')">导出</a><br/>
简介：{$task_desc}<br/>
HTML;
}else{
$task_list .=<<<HTML
[$i].{$task_name}(ID:{$task_id},数量:{$ow_task})
<a href="#" onclick="return confirmAction_out('$out_url', '{$task_name}')">导出</a><br/>
简介：{$task_desc}<br/>
HTML;
}
}

$add_html = <<<HTML
<form method = "post">
任务系列名称：<input type="text" name="add_name" size="17" placeholder="请输入任务系列名称"><br/>
任务系列介绍：<textarea type="text" name="add_desc" size="17" placeholder="请输入任务系列介绍" style="width: 200px; height: 90px;"></textarea><br/>
<input name="submit" type="submit" title="添加系列" value="添加"/><br/>
</form>
HTML;

$task_html = <<<HTML
[任务系列设计]<br/>
$task_list
$add_html
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}

echo $task_html;
?>
<script>
function confirmAction(del_url, step_order) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要删除 “" + step_order + "” 这个系列名称吗？请确保系列下没有任务。")) {
        // 使用传入的具体删除链接
        window.location.href = del_url;
    }
    return false;
}
function confirmAction_out(out_url, step_order) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要导出 “" + step_order + "” 这个系列名称下的任务吗？")) {
        // 使用传入的具体删除链接
        window.location.href = out_url;
    }
    return false;
}
</script>
