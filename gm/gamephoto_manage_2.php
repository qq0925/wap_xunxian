<?php
$_SERVER['PHP_SELF'];
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_photomanage&sid=$sid");
$gm =new \gm\gm();
$gm_photo_detail = \gm\getphoto_detail($dblj,$type);
$photo_type = $type;
$photo_html = '';
$photo_type_add = $encode->encode("cmd=photo_type_add&sid=$sid");
$photo_upload = $encode->encode("cmd=photo_upload&photo_type_name=$type&sid=$sid");

$sql = "SELECT * FROM system_photo where type = '$photo_type'";
$result = $dblj->query($sql);

$index = 0;
// Step 3: Loop through each row of data and create table rows
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $identifier = $row['id'];
    $name = $row['name'];
    $format_type = $row['format_type'];
    $image_url = "$photo_type"."-"."$identifier"."-"."$name".".$format_type";
    $imageSrc = "images/"."$photo_type"."/".$image_url;
    $photo_change = $encode->encode("cmd=photo_change&id=$identifier&sid=$sid");
    $index += 1;
$photo_detail_list .= <<<HTML
    <tr>
        <td>{$index}</td>
        <td><a href="?cmd=$photo_change">{$identifier}</a></td>
        <td>{$name}</td>
        <td style="height:50px;"><img style="width:160px;height:80px;" src="{$imageSrc}" /></td>
    </tr>
HTML;
}

if($index !=0){
$photo_html = <<<HTML
<!-- Start generating the HTML table -->
<table border="1" cellspacing="0" cellpadding="0" border-color="#b6ff00" style="text-align:center;">
<tr>
<td colspan="4" style="text-align:center;"><font color="orange" size="5px"><b>{$photo_type}</b></font></td>
</tr>
<tr>
<td>序号</td>
<td>标识</td>
<td>名称</td>
<td style="width:200px;">图片</td>
</tr>
$photo_detail_list
</table>
<a href="?cmd=$photo_upload">上传图片</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
}elseif($index ==0){
$photo_html = <<<HTML
{$photo_type}里面暂时没有图片<br/>
<a href="?cmd=$photo_upload">上传图片</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
}
echo $photo_html;
?>