<?php

$area_add = $encode->encode("cmd=area_post&gm_post_canshu=0&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");
$ret_last = $encode->encode("cmd=gm_map_2&sid=$sid");

$conn = DB::conn();

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

$sql = "SELECT * FROM system_region ORDER BY pos ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $select_region = '<select name="area_belong">';
    // 使用 while 循环遍历所有行
    while ($row = $result->fetch_assoc()) {
        // 更新最后一个ID
        $region_id = $row['id'];
        $region_name = $row['name'];

$select_region .=<<<HTML
<option value="$region_id" >{$region_name}</option>
HTML;
    }
    $select_region .= '</select>';
}
$area_html = <<<HTML
<p>[地图设计]<br/>
增加区域<br/>
</p>
<form action="?cmd=$area_add" method="post">
<input name="last_id" type="hidden" title="id" value="$last_id"/>
区域名称:<input name="name" type="text" maxlength="50"/><br/>
所属大区域:{$select_region}<br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$ret_last">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $area_html;
?>