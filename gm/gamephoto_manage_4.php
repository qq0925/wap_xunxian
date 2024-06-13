<?php
$gm_photo_type_list = \gm\getphoto_type($dblj);

$select = '图片类别:<select name="type">';
foreach ($gm_photo_type_list as $gm_photo_type) {
    $selected = ($gm_photo_type['name'] == $photo_type_name) ? ' selected' : '';
    $select .= '<option value="' . htmlspecialchars($gm_photo_type['name']) . '"' . $selected . '>' . htmlspecialchars($gm_photo_type['name']) . '</option>';
}
$select .= '</select><br/>';

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=photo_detail&type=$photo_type_name&sid=$sid");
$last_page_2 = $encode->encode("cmd=gm_game_photomanage&sid=$sid");
$photo_upload = $encode->encode("cmd=photo_detail&upload=1&type=$photo_type_name&sid=$sid");
$upload_html = <<<HTML
<form action="?cmd=$photo_upload" method="post" enctype="multipart/form-data">
<input name="sid" type="hidden" value="$sid">
标识:<input name="id" type="text" maxlength="30"/><br/>
名称:<input name="name" type="text" maxlength="20"/><br/>
$select
样式:<input name="photo_style" type="text" maxlength="100" value = "height: 4em"><br/>
上传图片(5000k内):<input name="file" type="file"/><br/>
<input name="submit" type="submit" title="上传" value="上传"/><input name="submit" type="hidden" title="上传" value="上传"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$last_page_2">返回类别列表</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $upload_html;

?>