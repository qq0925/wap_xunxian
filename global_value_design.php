<?php
$global_value_design = $encode->encode("cmd=global_value_design&para=post&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");

$change_html = "[公共数据设计]<br/>";
// 使用接口$dblj获取global_data表中所有数据
$sql = "SELECT * FROM global_data";
$stmt = $dblj->prepare($sql);
$stmt->execute();

// 获取所有数据
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 遍历结果
foreach ($result as $row) {
    $gid = $row['gid'];  // 获取gid字段的值
    $gvalue = $row['gvalue'];  // 获取gvalue字段的值
    // 进行处理或输出
    $change_html .= "ID: {$gid}，VALUE：{$gvalue}<a href='?cmd=$gm_main'>修改</a>|<a href='?cmd=$gm_main'>清空</a>|<a href='?cmd=$gm_main'>删除</a><br/>";
}


$gm_html =<<<HTML
$change_html
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $gm_html;


?>