<?php

$area_add = "?cmd=area_post&gm_post_canshu=0&sid=$sid";
$gm = $encode->encode("cmd=gm&sid=$sid");


$username='xunxian';
$password='lwd54088';
$dbname='xunxian';
$servername = "localhost";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}


$sql = "SELECT id FROM system_area ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    $row = $result->fetch_assoc();
    $last_id = $row["id"] + 1;
} else {
    echo "表中没有数据";
}

// 关闭连接
$conn->close();

//进行重复区域名称检测

$area_html = <<<HTML
<p>[地图设计]<br/>
增加区域<br/>
</p>
<form action="$area_add" method="post">
<input name="last_id" type="hidden" title="id" value="$last_id"/>
区域名称:<input name="name" type="text" maxlength="50"/><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onClick="javascript:history.back(-1);">返回上级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $area_html;
?>