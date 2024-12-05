<?php

$region_add = $encode->encode("cmd=region_post&gm_post_canshu=0&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");
$ret_last = $encode->encode("cmd=gm_map_2&sid=$sid");

$conn = DB::conn();

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}


$sql = "SELECT id, name, pos FROM system_region ORDER BY pos ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    $region_all = ""; // 用于存储所有区域的HTML
    $last_id = 0; // 初始化最后一个id
    $i=1;
    // 使用 while 循环遍历所有行
    while ($row = $result->fetch_assoc()) {
        // 更新最后一个ID
        $last_id = $row['id'];

        // 构建每个区域的HTML
        $region_name = $row['name'];
        $remove_region = $encode->encode("cmd=region_post&gm_post_canshu=2&remove_id=$last_id&sid=$sid");
        $rename_region = $encode->encode("cmd=region_post&gm_post_canshu=4&rename_id=$last_id&rename_name=$region_name&sid=$sid");
        if($last_id =="0"){
        $region_all .= "[$i].{$region_name}({$area_count})<a href='?cmd=$rename_region'>修改</a>(默认大区域，不可移除)<br/>";
        }else{
        $region_all .= "[$i].{$region_name}({$area_count})<a href='?cmd=$rename_region'>修改</a><a href='?cmd=$remove_region'>移除</a><br/>";
        }
        $i++;
    }

    // 输出所有区域
    //echo $region_all;
    
    // 如果需要可以输出最后一个ID
    //echo "最后一个ID: " . ($last_id + 1);
} else {
    echo "表中没有数据";
}


// 关闭连接
$conn->close();
$last_id ++;
//进行重复区域名称检测
$area_html = <<<HTML
<p>[地图大区域设计]<br/>
$region_all<br/></p>
增加大区域<br/>
<form action="?cmd=$region_add" method="post">
<input name="last_id" type="hidden" title="id" value="$last_id"/>
大区域名称:<input name="name" type="text" maxlength="50"/><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$ret_last">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $area_html;
?>