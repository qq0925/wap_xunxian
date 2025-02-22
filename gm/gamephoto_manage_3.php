<?php
$gm_photo_type_list = \gm\getphoto_type($dblj);

$sql = "select * from system_photo where id = '$id'";
$result = $dblj->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$id = $row['id'];
$name = $row['name'];
$type = $row['type'];
$format_type = $row['format_type'];
$image_style = $row['photo_style'];
$image_url = "$type"."-"."$id"."-"."$name".".$format_type";
$imageSrc = "images/"."$type"."/".$image_url;

// 检查文件是否存在
if (file_exists($imageSrc)) {
    // 获取文件大小（以字节为单位）
    $fileSize = filesize($imageSrc);

    // 如果大于 1 MB
    if ($fileSize >= 1024 * 1024) {
        $fileSizeMB = $fileSize / (1024 * 1024); // 转换为 MB
        $fileSizeShow = round($fileSizeMB, 1) . " MB"; // 保留1位小数
    } else {
        $fileSizeKB = $fileSize / 1024; // 转换为 KB
        $fileSizeShow = round($fileSizeKB, 0) . " KB";; // 显示为整数 KB
    }
} else {
    echo "文件不存在";
}

$select = '图片类别:<select name="type">';
foreach ($gm_photo_type_list as $gm_photo_type) {
    $selected = ($gm_photo_type['name'] == $type) ? ' selected' : '';
    $select .= '<option value="' . htmlspecialchars($gm_photo_type['name']) . '"' . $selected . '>' . htmlspecialchars($gm_photo_type['name']) . '</option>';
}
$select .= '</select><br/>';



$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=photo_detail&type=$type&sid=$sid");
$last_page_2 = $encode->encode("cmd=gm_game_photomanage&sid=$sid");
$photo_upload = $encode->encode("cmd=photo_detail&upload=2&type=$type&sid=$sid");
$delete_photo = $encode->encode("cmd=photo_detail&type=$type&upload=3&id=$id&sid=$sid");
$upload_html = <<<HTML
<script>
    function changeStyleToHeight4em() {
        document.getElementById('photo_style').value = 'height: 4em';
    }

    function changeStyleToHeight72pxWidth128px() {
        document.getElementById('photo_style').value = 'height: 72px; width: 128px';
    }
</script>

<form action="?cmd=$photo_upload" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="{$id}">
<input name="sid" type="hidden" value="$sid">
<input name="old_type" type="hidden" value="{$type}">
<input name="format_type" type="hidden" value="{$format_type}">
<input name="old_url" type="hidden" value="{$imageSrc}">
标识:{$id}<br/>
大小:{$fileSizeShow}<br/>
名称:<input name="name" type="text" maxlength="20" value = "$name"><br/>
$select
样式:<input name="photo_style" id="photo_style" type="text" maxlength="100" value = "{$image_style}"><br/>
<button type="button" onclick="changeStyleToHeight4em()">默认样式1</button>
<button type="button" onclick="changeStyleToHeight72pxWidth128px()">默认样式2</button><br/>
<img style="{$image_style};" src="$imageSrc"><br/>
<input name="submit" type="submit" title="确定修改" value="确定修改"/><input name="submit" type="hidden" title="确定修改" value="确定修改"/></form><br/>
<a href="?cmd=$delete_photo">删除图片</a><br/><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$last_page_2">返回类别列表</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $upload_html;

?>