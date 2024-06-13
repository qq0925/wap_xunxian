<?php
include_once 'pdo.php';
// Step 2: Query the Database and Generate the Table
$photo_type = "系统图片";
$sql = "SELECT * FROM system_photo where type = '$photo_type'";
$result = $dblj->query($sql);

// Step 3: Loop through each row of data and create table rows
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $identifier = $row['id'];
    $name = $row['name'];
    $image_url = "$photo_type"."-"."$identifier"."-"."$name".".jpg";
    $imageSrc = "images/"."$photo_type"."/".$image_url;
    $photo_change = "1";
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

$photo_html = <<<HTML
<!-- Start generating the HTML table -->
<table border="1" cellspacing="0" cellpadding="0" border-color="#b6ff00" style="text-align:center;">
<tr>
<td colspan="4" style="text-align:center;"><font color="orange" size="6px"><b>{$photo_type}</b></font></td>
</tr>
<tr>
<td>序号</td>
<td>标识</td>
<td>名称</td>
<td style="width:200px;">图片</td>
</tr>
$photo_detail_list
</table>
HTML;
echo $photo_html;
?>








<?php
$_SERVER['PHP_SELF'];
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_photomanage&sid=$sid");
$gm =new \gm\gm();
$gm_photo_detail = \gm\getphoto_detail($dblj,$type);
$photo_type_type = $type;
$photo_html = '';
$photo_type_add = $encode->encode("cmd=photo_type_add&sid=$sid");
$photo_upload = $encode->encode("cmd=photo_upload&photo_type_name=$type&sid=$sid");
if($photo_not_visible ==0){
$photo_change = $encode->encode("cmd=photo_detail&photo_not_visible=1&type=$type&sid=$sid");
$photo_change_name = "不显示图片";
}else {
$photo_change = $encode->encode("cmd=photo_detail&photo_not_visible=0&type=$type&sid=$sid");
$photo_change_name = "显示图片";
}

for ($i=0;$i<count($gm_photo_detail);$i++){
    $photo_type_name = $gm_photo_detail[$i]['name'];
    $photo_type_id = $gm_photo_detail[$i]['id'];
    $photo_type_type = $gm_photo_detail[$i]['type'];
    $photo_url = "$photo_type_type"."-".$photo_type_id."-".$photo_type_name."."."jpg";
    $hangshu += 1;
    $photo_detail_2 = $encode->encode("cmd=photo_detail&type=$photo_type_name&sid=$sid");
    if($photo_not_visible ==0){
    $photo_html .=<<<HTML
    <img src="images/{$photo_type_type}/{$photo_url}" alt="{$photo_type_name}"/><br/>
    <a href="?cmd=$photo_detail_2">{$hangshu}.{$photo_type_name}[{$photo_type_id}]</a><br/>
HTML;
}else{
    $photo_html .=<<<HTML
    <a href="?cmd=$photo_detail_2">{$hangshu}.{$photo_type_name}[{$photo_type_id}]</a><br/>
HTML;
}
}


$gm_html = <<<HTML
<p>{$photo_type_type}中的图片有：</p>
$photo_html<br/>
<a href="?cmd=$photo_change">{$photo_change_name}</a><br/>
<a href="?cmd=$photo_upload">上传图片</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>






