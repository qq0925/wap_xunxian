<?php
// 假设已经连接到数据库
$dblj = DB::pdo(); 

switch ($ret_canshu) {
    case 'map':
        $ret_url = $encode->encode("cmd=gm_type_map&gm_post_canshu=1&target_midid=$ret_id&sid=$sid");
        break;
    case 'item':
        $ret_url = $encode->encode("cmd=gm_type_item&gm_post_canshu=1&item_id=$ret_id&sid=$sid");
        break;
    case 'npc':
        $ret_url = $encode->encode("cmd=gm_type_npc&gm_post_canshu=1&npc_id=$ret_id&sid=$sid");
        break;
    default:
        $ret_url = $encode->encode("cmd=gm&sid=$sid");
        break;
}

if(!$photo_type){
// 获取 DISTINCT type 值
$query = "SELECT DISTINCT type FROM system_photo";
$types = $dblj->query($query)->fetchAll(PDO::FETCH_ASSOC);
$choose_html ="请选择图片分类:<br/>";
// 打印 type 值作为链接
foreach ($types as $type) {
    $typeValue = htmlspecialchars($type['type']);
    $photo_detail = $encode->encode("cmd=photo_choose&ret_canshu=$ret_canshu&ret_id=$ret_id&photo_type=$typeValue&sid=$sid");
    $choose_html.=<<<HTML
<a href="?cmd=$photo_detail">$typeValue</a><br>
HTML;
}
$choose_html .="<br/><a href='?cmd={$ret_url}'>返回上级</a>";
}else{
// 获取 ID 值
$query = "SELECT id,type,photo_url,photo_style FROM system_photo where type = '$photo_type'";
$photos = $dblj->query($query)->fetchAll(PDO::FETCH_ASSOC);
$choose_html ="请选择图片:<br/>";
// 打印 type 值作为链接
foreach ($photos as $photo) {
    $photoId = htmlspecialchars($photo['id']);
    $photoType = htmlspecialchars($photo['type']);
    $photo_url = $photo['photo_url'];
    $photo_style = $photo['photo_style'];
    $photo_post = $photoType."|".$photoId;
    
    
switch ($ret_canshu) {
    case 'map':
        $photo_choose = $encode->encode("cmd=gm_type_map&photo_post=$photo_post&gm_post_canshu=1&target_midid=$ret_id&sid=$sid");
        break;
    case 'item':
        $photo_choose = $encode->encode("cmd=gm_type_item&photo_post=$photo_post&gm_post_canshu=1&item_id=$ret_id&sid=$sid");
        break;
    case 'npc':
        $photo_choose = $encode->encode("cmd=gm_type_npc&photo_post=$photo_post&gm_post_canshu=1&npc_id=$ret_id&sid=$sid");
        break;
    default:
        $photo_choose = $encode->encode("cmd=gm&sid=$sid");
        break;
}
    $choose_html.=<<<HTML
<img src="$photo_url" style="$photo_style"><a href="?cmd=$photo_choose">$photoId</a><br>
HTML;
}
$ret_url = $encode->encode("cmd=photo_choose&ret_canshu=$ret_canshu&ret_id=$ret_id&sid=$sid");
$choose_html .="<br/><a href='?cmd={$ret_url}'>返回上级</a>";
}
echo $choose_html;
?>