<?php
require_once 'class/lexical_analysis.php';
require_once 'pdo.php';

$dblj = DB::pdo();

$nowmid_para = sql_first_get($mid, $dblj);
$nowmid_desc = $nowmid_para['mdesc'];
$nowmid_desc =\lexical_analysis\color_string($nowmid_desc);
$nowmid_name = $nowmid_para['mname'];
$east = $nowmid_para['mright'];
$south = $nowmid_para['mdown'];
$west = $nowmid_para['mleft'];
$north = $nowmid_para['mup'];
$mqy = $nowmid_para['marea_id'];

if(empty($new_w)){
$default_w = 320;
$default_h = 220;
}else{
$default_w = $new_w;
$default_h = $new_h;
}

// 创建图像
$imageWidth = $default_w;  // 图像宽度
$imageHeight = $default_h; // 图像高度
$image = imagecreatetruecolor($imageWidth, $imageHeight);

// 定义颜色
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);
imagefill($image, 0, 0, $white);

// 设置字体文件路径
$fontFile = '方正楷体简体.ttf';

// 初始化已访问节点数组
$visited = [];

// 绘制地图函数
function draw_map($mid,$mqy, $x, $y, $visited, $dblj,$if_main) {
    global $image, $fontFile, $red, $black,$blue;

    // 标记当前节点为已访问
    $visited[$mid] = true;

    // 从数据库获取节点信息
    $row = sql_get($mid,$mqy,$dblj);
    $pointName = $row['mname'];
if($pointName ==""){
    $pointName = "...";
} 
    // 绘制当前节点的红框
    $boxWidth = 100;  // 红框宽度
    $boxHeight = 50;  // 红框高度

    // 计算红框的坐标
    $boxX1 = $x - $boxWidth / 2;
    $boxY1 = $y - $boxHeight / 2;
    $boxX2 = $x + $boxWidth / 2;
    $boxY2 = $y + $boxHeight / 2;

    // 绘制红框
    if($if_main ==1){
    imagerectangle($image, $boxX1, $boxY1, $boxX2, $boxY2, $blue);
}else{
    imagerectangle($image, $boxX1, $boxY1, $boxX2, $boxY2, $red);
}
    // 绘制节点名称
    $textWidth = imagettfbbox(12, 0, $fontFile, $pointName)[2] - imagettfbbox(12, 0, $fontFile, $pointName)[0];
    $textHeight = imagettfbbox(12, 0, $fontFile, $pointName)[1] - imagettfbbox(12, 0, $fontFile, $pointName)[5];
    imagettftext($image, 12, 0, $x - $textWidth / 2, $y + $textHeight / 2, $black, $fontFile, $pointName);

    // 获取邻居节点信息
    $neighbors = [
        'up' => $row['mup'],
        'down' => $row['mdown'],
        'left' => $row['mleft'],
        'right' => $row['mright']
    ];

    // 遍历邻居节点并绘制连接线和邻居节点
    foreach ($neighbors as $direction => $neighbor) {
        if (!isset($visited[$neighbor]) && $neighbor != null) {
            // 绘制连接线
            switch ($direction) {
                case 'up':
                    $lineStartX = $x;
                    $lineStartY = $y - $boxHeight / 2;
                    $lineEndX = $x;
                    $lineEndY = $y - $boxHeight;
                    break;
                case 'down':
                    $lineStartX = $x;
                    $lineStartY = $y + $boxHeight / 2;
                    $lineEndX = $x;
                    $lineEndY = $y + $boxHeight;
                    break;
                case 'left':
                    $lineStartX = $x - $boxWidth / 2;
                    $lineStartY = $y;
                    $lineEndX = $x - $boxWidth;
                    $lineEndY = $y;
                    break;
                case 'right':
                    $lineStartX = $x + $boxWidth / 2;
                    $lineStartY = $y;
                    $lineEndX = $x + $boxWidth;
                    $lineEndY = $y;
                    break;
            }

            // 绘制连接线
            //imageline($image, $lineStartX, $lineStartY, $lineEndX, $lineEndY, $red);

            // 递归绘制邻居节点
            draw_map($neighbor,$mqy,$lineEndX, $lineEndY, $visited, $dblj,0);
        }
    }
}

// 获取数据库中节点信息
function sql_first_get($mid, $dblj) {
    // 这里根据你的实际数据库连接方式和查询语句获取节点信息
    // 返回一个包含节点信息的数组，例如：
    $sql = "SELECT * FROM system_map WHERE mid = :mid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':mid', $mid, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function sql_get($mid,$mqy,$dblj){
    // 这里根据你的实际数据库连接方式和查询语句获取节点信息
    // 返回一个包含节点信息的数组，例如：
    $sql = "SELECT * FROM system_map WHERE mid = :mid and marea_id = :mqy";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':mid', $mid, PDO::PARAM_STR);
    $stmt->bindParam(':mqy', $mqy, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

// 设置起始坐标
$startX = 160;  // 起始x坐标
$startY = 110;  // 起始y坐标

// 绘制地图
draw_map($mid,$mqy,$startX, $startY, $visited, $dblj,1);

// 输出图像
// 输出图像到浏览器
$imagePath = '/www/wwwroot/xunxian.txsj.ink/images/map_detail/image.png';
imagepng($image, $imagePath);
imagedestroy($image);

$randomValue = mt_rand(); // 使用 mt_rand() 函数生成随机数
// 图像URL
$imageUrl = 'http://xunxian.txsj.ink/images/map_detail/image.png?random=' . $randomValue;

if(!empty($east)){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
$goeast = $encode->encode("cmd=map_detail&mid=$east&ucmd=$cmid&imageWidth=$default_w&imageHeight=$default_h&sid=$sid");
$east_html =<<<HTML
<a href="?cmd=$goeast">往东移→</a><br/>
HTML;
}
if(!empty($south)){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
$gosouth = $encode->encode("cmd=map_detail&mid=$south&ucmd=$cmid&imageWidth=$default_w&imageHeight=$default_h&sid=$sid");
$south_html =<<<HTML
<a href="?cmd=$gosouth">往南移↓</a><br/>
HTML;
}
if(!empty($west)){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
$gowest = $encode->encode("cmd=map_detail&mid=$west&ucmd=$cmid&imageWidth=$default_w&imageHeight=$default_h&sid=$sid");
$west_html =<<<HTML
<a href="?cmd=$gowest">往西移←</a><br/>
HTML;
}
if(!empty($north)){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
$gonorth = $encode->encode("cmd=map_detail&mid=$north&ucmd=$cmid&imageWidth=$default_w&imageHeight=$default_h&sid=$sid");
$north_html =<<<HTML
<a href="?cmd=$gonorth">往北移↑</a><br/>
HTML;
}
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
$max_size = $encode->encode("cmd=map_detail&mid=$mid&ucmd=$cmid&new_w=1920&new_h=1080&sid=$sid");
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$map_detail =<<<HTML
<p><img src="{$imageUrl}" alt="绘制的图像"><br/>
$east_html
$south_html
$west_html
$north_html
$nowmid_desc<br/>

<a href="?cmd=$max_size">全图一览</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
</p>
HTML;
echo $map_detail;

?>