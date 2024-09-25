<?php
$sqlname='xunxian';
$sqlpass='lwd54088';
$dbhost='localhost';
$dbname='xunxian';
$dsn="mysql:host=$dbhost;dbname=$dbname;";
$dblj = new PDO($dsn,$sqlname,$sqlpass,array(PDO::ATTR_PERSISTENT=>true));
$dblj->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dblj->query("SET NAMES utf8mb4");
$draw_center_mid = $mid;
$gonowmid = $encode->encode("cmd=gm_scene_new&sid=$sid");
// 创建一张空白的图像
$image = imagecreatetruecolor(640, 440);



function sql_get($draw_center_mid,$dblj){
$sql = "SELECT * FROM mid WHERE mid = :mid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $draw_center_mid,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row;
}


function draw_map($draw_center_mid,$dblj,$default_X,$default_Y){
global $image;
$row = sql_get($draw_center_mid,$dblj);
$nowmid = $row['mid'];
$center_name = $row['mname'];
$left_id = $row['mleft'];
$right_id = $row['mright'];
$up_id = $row['mup'];
$down_id = $row['mdown'];
if(!empty($right_id)){
$row_2=sql_get($right_id,$dblj);
$right_nowmid = $row_2['mid'];
$right_name = $row_2['mname'];
$right_left_id = $row_2['mleft'];
$right_right_id = $row_2['mright'];
}

if(!empty($left_id)){
$row_3=sql_get($left_id,$dblj);
$left_nowmid = $row_3['mid'];
$left_name = $row_3['mname'];
$left_left_id = $row_3['mleft'];
$left_right_id = $row_3['mright'];
}

if(!empty($up_id)){
$row_4=sql_get($up_id,$dblj);
$up_nowmid = $row_4['mid'];
$up_name = $row_4['mname'];
$up_left_id = $row_4['mleft'];
$up_right_id = $row_4['mright'];
}

if(!empty($down_id)){
$row_5=sql_get($down_id,$dblj);
$down_nowmid = $row_5['mid'];
$down_name = $row_5['mname'];
$down_left_id = $row_5['mleft'];
$down_right_id = $row_5['mright'];
}

// 设置背景颜色为白色
$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);

// 设置文本颜色为黑色
$black = imagecolorallocate($image, 0, 0, 0);

// 设置边框颜色为红色
$red = imagecolorallocate($image, 255, 0, 0);

// 设置字体文件路径（替换为你自己的字体文件路径）
$fontFile = '方正楷体简体.ttf';

// 设置字符编码为UTF-8
imagecolortransparent($image, $white);
imagealphablending($image, false);
imagesavealpha($image, true);

// 绘制中心地点
$pointA = ['x' => $default_X, 'y' => $default_Y];
$pointAName = $center_name;
$pointANameWidth = imagettfbbox(12, 0, $fontFile, $pointAName)[2] - imagettfbbox(12, 0, $fontFile, $pointAName)[0];
$pointANameHeight = imagettfbbox(12, 0, $fontFile, $pointAName)[1] - imagettfbbox(12, 0, $fontFile, $pointAName)[5];

// 计算中心点 名称外框的位置
$pointABoundingBoxX1 = $pointA['x'] - $pointANameWidth / 2 - 5;  // 5是留白边距
$pointABoundingBoxY1 = $pointA['y'] - $pointANameHeight - 5;  // 5是留白边距
$pointABoundingBoxX2 = $pointA['x'] + $pointANameWidth / 2 + 5;  // 5是留白边距
$pointABoundingBoxY2 = $pointA['y'] + 5;  // 5是留白边距

// 绘制中心点 名称外框
imagerectangle($image, $pointABoundingBoxX1, $pointABoundingBoxY1, $pointABoundingBoxX2, $pointABoundingBoxY2, $red);

// 绘制中心点 名称
imagettftext($image, 12, 0, $pointA['x'] - $pointANameWidth / 2, $pointA['y'], $black, $fontFile, $pointAName);

if(!empty($right_id)){
// 计算右出口 的位置
$pointBName = $right_name;
$pointBNameWidth = imagettfbbox(12, 0, $fontFile, $pointBName)[2] - imagettfbbox(12, 0, $fontFile, $pointBName)[0];
$pointBNameHeight = imagettfbbox(12, 0, $fontFile, $pointBName)[1] - imagettfbbox(12, 0, $fontFile, $pointBName)[5];
$pointB = ['x' => $pointA['x'] + $pointANameWidth + $pointBNameWidth / 2 + 20, 'y' => $pointA['y']];

// 计算右出口 名称外框的位置
$pointBBoundingBoxX1 = $pointB['x'] - $pointBNameWidth / 2 - 5;  // 5是留白边距
$pointBBoundingBoxY1 = $pointB['y'] - $pointBNameHeight - 5;  // 5是留白边距
$pointBBoundingBoxX2 = $pointB['x'] + $pointBNameWidth / 2 + 5;  // 5是留白边距
$pointBBoundingBoxY2 = $pointB['y'] + 5;  // 5是留白边距

// 绘制右出口 名称外框
imagerectangle($image, $pointBBoundingBoxX1, $pointBBoundingBoxY1, $pointBBoundingBoxX2, $pointBBoundingBoxY2, $red);

// 绘制右出口 名称
imagettftext($image, 12, 0, $pointB['x'] - $pointBNameWidth / 2, $pointB['y'], $black, $fontFile, $pointBName);

// 计算连接线的位置
$lineStartX = $pointA['x'] + $pointANameWidth / 2;
$lineStartY = $pointA['y'] - $pointANameHeight / 2;
$lineEndX = $pointB['x'] - $pointBNameWidth / 2;
$lineEndY = $pointB['y'] - $pointBNameHeight / 2;

// 计算连接线和红框之间的距离
$distance = 5;

// 根据距离调整连接线的位置
if ($lineStartX < $lineEndX) {
    $lineStartX += $distance;
    $lineEndX -= $distance;
} else {
    $lineStartX -= $distance;
    $lineEndX += $distance;
}

// 绘制连接线
imageline($image, $lineStartX, $lineStartY, $lineEndX, $lineEndY, $black);
}

if(!empty($left_id)){
// 计算左出口的位置
$pointBName = $left_name;
$pointBNameWidth = imagettfbbox(12, 0, $fontFile, $pointBName)[2] - imagettfbbox(12, 0, $fontFile, $pointBName)[0];
$pointBNameHeight = imagettfbbox(12, 0, $fontFile, $pointBName)[1] - imagettfbbox(12, 0, $fontFile, $pointBName)[5];
$pointB = ['x' => $pointA['x'] - $pointANameWidth - $pointBNameWidth / 2 - 20, 'y' => $pointA['y']];

// 计算左出口名称外框的位置
$pointBBoundingBoxX1 = $pointB['x'] - $pointBNameWidth / 2 - 5;  // 5是留白边距
$pointBBoundingBoxY1 = $pointB['y'] - $pointBNameHeight - 5;  // 5是留白边距
$pointBBoundingBoxX2 = $pointB['x'] + $pointBNameWidth / 2 + 5;  // 5是留白边距
$pointBBoundingBoxY2 = $pointB['y'] + 5;  // 5是留白边距

// 绘制左出口名称外框
imagerectangle($image, $pointBBoundingBoxX1, $pointBBoundingBoxY1, $pointBBoundingBoxX2, $pointBBoundingBoxY2, $red);

// 绘制左出口名称
imagettftext($image, 12, 0, $pointB['x'] - $pointBNameWidth / 2, $pointB['y'], $black, $fontFile, $pointBName);

// 计算连接线的位置
$lineStartX = $pointA['x'] - $pointANameWidth / 2;
$lineStartY = $pointA['y'] - $pointANameHeight / 2;
$lineEndX = $pointB['x'] + $pointBNameWidth / 2;
$lineEndY = $pointB['y'] - $pointBNameHeight / 2;

// 计算连接线和红框之间的距离
$distance = 5;

// 根据距离调整连接线的位置
if ($lineStartX < $lineEndX) {
    $lineStartX += $distance;
    $lineEndX -= $distance;
} else {
    $lineStartX -= $distance;
    $lineEndX += $distance;
}

// 绘制连接线
imageline($image, $lineStartX, $lineStartY, $lineEndX, $lineEndY, $black);
}


if(!empty($up_id)){
// 计算上出口的位置
$pointCName = $up_name;
$pointCNameWidth = imagettfbbox(12, 0, $fontFile, $pointCName)[2] - imagettfbbox(12, 0, $fontFile, $pointCName)[0];
$pointCNameHeight = imagettfbbox(12, 0, $fontFile, $pointCName)[1] - imagettfbbox(12, 0, $fontFile, $pointCName)[5];
$pointC = ['x' => $pointA['x'], 'y' => $pointA['y'] - $pointANameHeight - $pointCNameHeight / 2 - 20];

// 计算上出口的名称外框位置
$pointCBoundingBoxX1 = $pointC['x'] - $pointCNameWidth / 2 - 5;  // 5是留白边距
$pointCBoundingBoxY1 = $pointC['y'] - $pointCNameHeight - 5;  // 5是留白边距
$pointCBoundingBoxX2 = $pointC['x'] + $pointCNameWidth / 2 + 5;  // 5是留白边距
$pointCBoundingBoxY2 = $pointC['y'] + 5;  // 5是留白边距

// 绘制上出口的名称外框
imagerectangle($image, $pointCBoundingBoxX1, $pointCBoundingBoxY1, $pointCBoundingBoxX2, $pointCBoundingBoxY2, $red);

// 绘制上出口的名称
imagettftext($image, 12, 0, $pointC['x'] - $pointCNameWidth / 2, $pointC['y'], $black, $fontFile, $pointCName);

// 计算连接线的位置
$lineStartX = $pointA['x'];
$lineStartY = $pointABoundingBoxY1;
$lineEndX = $pointC['x'];
$lineEndY = $pointCBoundingBoxY2;

// 绘制连接线
imageline($image, $lineStartX, $lineStartY, $lineEndX, $lineEndY, $black);
}
if(!empty($down_id)){
// 计算下出口的位置
$pointDName = $down_name;
$pointDNameWidth = imagettfbbox(12, 0, $fontFile, $pointDName)[2] - imagettfbbox(12, 0, $fontFile, $pointDName)[0];
$pointDNameHeight = imagettfbbox(12, 0, $fontFile, $pointDName)[1] - imagettfbbox(12, 0, $fontFile, $pointDName)[5];
$pointD = ['x' => $pointA['x'], 'y' => $pointA['y'] + $pointANameHeight + $pointDNameHeight / 2 + 20];

// 计算下出口的名称外框位置
$pointDBoundingBoxX1 = $pointD['x'] - $pointDNameWidth / 2 - 5;  // 5是留白边距
$pointDBoundingBoxY1 = $pointD['y'] - $pointDNameHeight - 5;  // 5是留白边距
$pointDBoundingBoxX2 = $pointD['x'] + $pointDNameWidth / 2 + 5;  // 5是留白边距
$pointDBoundingBoxY2 = $pointD['y'] + 5;  // 5是留白边距

// 绘制下出口的名称外框
imagerectangle($image, $pointDBoundingBoxX1, $pointDBoundingBoxY1, $pointDBoundingBoxX2, $pointDBoundingBoxY2, $red);

// 绘制下出口的名称
imagettftext($image, 12, 0, $pointD['x'] - $pointDNameWidth / 2, $pointD['y'], $black, $fontFile, $pointDName);

// 计算连接线的位置
$lineStartX = $pointA['x'];
$lineStartY = $pointABoundingBoxY2;
$lineEndX = $pointD['x'];
$lineEndY = $pointDBoundingBoxY1;

// 绘制连接线
imageline($image, $lineStartX, $lineStartY, $lineEndX, $lineEndY, $black);
}


$imagePath = '/images/map_detail/image.png';
imagepng($image, $imagePath);

// 释放图像资源
imagedestroy($image);
}

$randomValue = mt_rand(); // 使用 mt_rand() 函数生成随机数
// 图像URL
$imageUrl = '/images/map_detail/image.png?random=' . $randomValue;


draw_map($draw_center_mid,$dblj,320,220);
$map_detail =<<<HTML
<p><img src="{$imageUrl}" alt="绘制的图像"><br/>
<a href="gCmd.do?cmd=22&amp;sid=sea3ke5zx14vwbr9nltut&amp;gid=g2" accesskey="6">往东移→</a><br/>
<a href="gCmd.do?cmd=23&amp;sid=sea3ke5zx14vwbr9nltut&amp;gid=g2" accesskey="8">往南移↓</a><br/>
<a href="gCmd.do?cmd=24&amp;sid=sea3ke5zx14vwbr9nltut&amp;gid=g2" accesskey="4">往西移←</a><br/>
<a href="gCmd.do?cmd=25&amp;sid=sea3ke5zx14vwbr9nltut&amp;gid=g2" accesskey="2">往北移↑</a><br/>
<a href="gCmd.do?cmd=26&amp;sid=sea3ke5zx14vwbr9nltut&amp;gid=g2" accesskey="3">缩小</a><br/>
<a href="gCmd.do?cmd=27&amp;sid=sea3ke5zx14vwbr9nltut&amp;gid=g2" accesskey="1">横向扩展显示</a><br/>
<font color="green">长南村</font>的<font color="red">中心地带</font>，<font color="yellow">经常</font>有<font color="blue">村民</font>在此<font color="maroon">休息</font>。<br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
提示：横向扩展显示表示除中心位置以外的所有地点只显示东、西两边的地点，<br/>
此时如果标示红色的地点表示它南、北两边可能还有地点未显示；<br/>
纵向扩展显示与之相反，即除中心位置以外的所有地点只显示南、北两边的地点，<br/>
此时如果标示红色的地点表示它东、西两边可能还有地点未显示。<br/>
其中默认为纵向扩展显示<br/>
</p>
HTML;
echo $map_detail;


?>