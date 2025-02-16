<?php

$type = "玩家形象照";
$uid = \player\getplayer($sid,$dblj)->uid;

$photoSrc = "images/"."$type";
if(!is_dir($photoSrc)){
if (mkdir($photoSrc, 0777, true)) {
    $dblj->exec("insert into system_photo_type (name,contains)values('玩家形象照','0')");
    } else {
        echo "请联系管理员！<br/>";
    }

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$last_page = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$upload_html =<<<HTML
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=ret_game">返回游戏</a><br/>
HTML;
}
if(is_dir($photoSrc)){
$look_id = 'player_'.$uid;
$sql = "select * from system_photo where id = '$look_id'";
$result = $dblj->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$photo_id = $row['id'];
$photo_name = $row['name'];
$photo_type = $row['type'];
$format_type = $row['format_type'];

$image_url = "$type"."-"."$photo_id"."-"."$photo_name".".$format_type";
$imageSrc = "images/"."$type"."/".$image_url;

if($photo_id){
    $imageSrc = 
    $player_photo_url =<<<HTML
<img style="width:128px;height:128px;" src="$imageSrc"><br/>
HTML;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$del_url = $encode->encode("cmd=player_photo_upload&ucmd=$cmid&upload=2&uid=$uid&type=$type&sid=$sid");
$copy_url = "game.php?cmd=$del_url";
$del_html =<<<HTML
<a href="#" onclick="confirmAction()">删除形象照</a><br/>
HTML;
}else{
    $player_photo_url = "你目前没有形象照。<br/>";
}


$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$last_page = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$photo_upload = $encode->encode("cmd=player_photo_upload&ucmd=$cmid&upload=1&uid=$uid&type=$type&sid=$sid");
$upload_html = <<<HTML
[上传形象照](请勿上传非法,涉黄等图片.否则一切后果自负)<br/>
$player_photo_url
<form action="?cmd=$photo_upload" method="post" enctype="multipart/form-data">
<input name="sid" type="hidden" value="$sid">
上传图片(5000k内):<input name="file" type="file"/><br/>
<input name="submit" type="submit" title="上传" value="上传"/>
<input name="submit" type="hidden" title="上传" value="上传"/>
</form><br/>
$del_html
<a href="?cmd=$last_page">返回我的状态</a><br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
}
echo $upload_html;

?>
<script>
function confirmAction() {
    // 弹出确认框
    if (confirm("你确定要删除该形象照吗？")) {
        // 如果点击“确认”，则跳转到PHP传递的链接
        window.location.href = "<?php echo $copy_url; ?>";
    } else {
        // 如果点击“取消”，则什么也不做
        return false;
    }
}
</script>