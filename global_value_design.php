<?php
$global_value_design = $encode->encode("cmd=global_value_design&para=post&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");

$change_html = "[公共数据管理]<br/>";

if($delete_canshu){
    echo "删除成功！已成功删除ID为{$delete_canshu}的公共属性！<br/>";
    $dblj->exec("delete from global_data where gid = '$delete_canshu'");
}
if($reboot_canshu){
    echo "清空成功！已成功清空ID为{$reboot_canshu}的公共属性！<br/>";
    $dblj->exec("update global_data set gvalue = '' where gid = '$reboot_canshu'");
}

if($_POST['change_value']){
    $new_value = $_POST['change_value'];
    $gid = $_POST['change_id'];
    $dblj->exec("update global_data set gvalue = '$new_value' where gid = '$gid'");
    echo "修改成功！已成功修改ID为{$gid}的公共属性值！<br/>";
}

if(!$cmd_canshu){
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
    $delete_op = $encode->encode("cmd=global_value_design&cmd_canshu=1&gid=$gid&sid=$sid");
    $delete_all = $encode->encode("cmd=global_value_design&cmd_canshu=2&gid=$gid&sid=$sid");
    $change_op = $encode->encode("cmd=global_value_design&cmd_canshu=3&gid=$gid&gvalue=$gvalue&sid=$sid");
    $change_html .= "ID: {$gid}，VALUE：{$gvalue}<a href='?cmd=$change_op'>修改</a>|<a href='?cmd=$delete_all'>清空</a>|<a href='?cmd=$delete_op'>删除</a><br/>";
}
}elseif ($cmd_canshu==1) {
    $delete_sure = $encode->encode("cmd=global_value_design&delete_canshu=$gid&sid=$sid");
    $last_page =  $encode->encode("cmd=global_value_design&sid=$sid");
    $change_html .=<<<HTML
是否要删除{$gid}?<br/>
<a href="?cmd=$delete_sure">删除</a>|<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}elseif ($cmd_canshu==2) {
    $delete_sure = $encode->encode("cmd=global_value_design&reboot_canshu=$gid&sid=$sid");
    $last_page =  $encode->encode("cmd=global_value_design&sid=$sid");
    $change_html .=<<<HTML
是否要清空{$gid}的值?<br/>
<a href="?cmd=$delete_sure">清空</a>|<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}elseif ($cmd_canshu==3) {
    $last_page =  $encode->encode("cmd=global_value_design&sid=$sid");
    $change_post = $encode->encode("cmd=global_value_design&sid=$sid");
    $change_html .=<<<HTML
<form action="?cmd=$change_post" method="post">
<input type="hidden" name="change_id" value="$gid">
正在修改{$gid}的值{$gvalue}?<br/>
修改值:<textarea name="change_value" maxlength="1024" rows="4" cols="40" >{$gvalue}</textarea><br/>
<input type="submit" value="确定修改"><br/>
</form>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}

$gm_html =<<<HTML
$change_html
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $gm_html;


?>