<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$doc_edit_post = $encode->encode("cmd=gm_design_guide&edit_canshu=1&sid=$sid");

// 获取当前脚本所在的目录
$current_dir = dirname(__FILE__);
$edit_file_path = $current_dir .'/design_help.txt';

if($_POST['gm_doc_text']){
$gm_doc_text_post = $_POST['gm_doc_text'] ?? '';
// 写入文件
if (file_put_contents($edit_file_path, $gm_doc_text_post) !== false) {
    echo "doc文件已成功更新。";
} else {
    echo "更新doc文件时出错。";
}
}
if (file_exists($edit_file_path)) {
    // 读取文件内容并赋值给变量
    $gm_edit_text = htmlspecialchars(file_get_contents($edit_file_path));
    $gm_edit_text_ord = file_get_contents($edit_file_path);
}

if($edit_canshu == '1'){
$ret_doc = $encode->encode("cmd=gm_design_guide&sid=$sid");
$html =<<<HTML
<a href="?cmd=$ret_doc">返回文档</a><br/>
<form action="?cmd=$doc_edit_post" method="POST">
<textarea name="gm_doc_text" maxlength="-1" rows="20" cols="80" >{$gm_edit_text_ord}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改" >
</form>
<a href="?cmd=$gm_main">返回设计大厅</a>
HTML;
}else{
$doc_edit = $encode->encode("cmd=gm_design_guide&edit_canshu=1&sid=$sid");
$html =<<<HTML
<a href="?cmd=$doc_edit">编辑文档(不明情况者勿点！)</a><br/>
HTML;
$html .= $gm_edit_text;
$html .=<<<HTML
<br/><a href="?cmd=$gm_main">返回设计大厅</a>
HTML;
$html = nl2br(html_entity_decode($html));
}

echo $html;
?>