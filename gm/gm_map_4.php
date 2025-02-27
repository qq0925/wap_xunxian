<?php

$gm = $encode->encode("cmd=gm&sid=$sid");

if(!$rename_canshu){
$region_add = $encode->encode("cmd=region_post&gm_post_canshu=0&sid=$sid");

$ret_last = $encode->encode("cmd=gm_map_2&sid=$sid");

$conn = DB::conn();

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}



if($_POST['old_name']){
    $old_name = $_POST['old_name'];
    $new_name = $_POST['name']?:$old_name;
    $new_road_hide = $_POST['road_hide'];
    $new_sail_hide = $_POST['sail_hide'];
    $new_sky_hide = $_POST['sky_hide'];
    echo "修改成功！<br/>";
    $conn->query("UPDATE system_region SET name='$new_name',road_hide='$new_road_hide',sail_hide='$new_sail_hide',sky_hide='$new_sky_hide' WHERE id = '$rename_id'");
}

$sql = "SELECT * FROM system_region ORDER BY pos ASC";
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
        $area_count = \gm\getregion_qy($dblj,$last_id)['area_count'];
        // 构建每个区域的HTML
        $region_name = $row['name'];
        $rename_road_hide = $row['road_hide'] == '0'?'[陆]':'[隐]';
        $rename_sail_hide = $row['sail_hide'] == '0'?'[海]':'[隐]';
        $rename_sky_hide = $row['sky_hide'] == '0'?'[空]':'[隐]';
        $remove_region = $encode->encode("cmd=region_post&gm_post_canshu=2&remove_id=$last_id&sid=$sid");
        $del_url = "game.php?cmd=$remove_region";
        $rename_region = $encode->encode("cmd=region_post&gm_post_canshu=1&rename_canshu=1&rename_id=$last_id&rename_name=$region_name&rename_road_hide=$rename_road_hide&rename_sail_hide=$rename_sail_hide&rename_sky_hide=$rename_sky_hide&sid=$sid");
        if($last_id =="0"){
        $region_all .= "[$i].{$rename_road_hide}{$rename_sail_hide}{$rename_sky_hide}{$region_name}({$area_count})<a href='?cmd=$rename_region'>修改</a>(默认大区域，不可移除)<br/>";
        }else{
        $region_all .=<<<HTML
[$i].{$rename_road_hide}{$rename_sail_hide}{$rename_sky_hide}{$region_name}({$area_count})<a href='?cmd=$rename_region'>修改</a><a href="#" onclick="return confirmAction('$del_url', '{$region_name}')">移除</a><br/>
HTML;
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
TIPS:若移除将会将内含区域的所属大区域置为失落之地。<br/>
若大区域为隐藏，则在对应航线上不会出现。<br/>
$region_all<br/></p>
增加大区域<br/>
<form action="?cmd=$region_add" method="post">
<input name="last_id" type="hidden" title="id" value="$last_id"/>
大区域名称:<input name="name" type="text" maxlength="50"/><br/>
切换条件:<textarea name="change_cond" maxlength="200" rows="4" cols="20"></textarea><br/>
不满足提示语:<textarea name="cmmt2" maxlength="200" rows="4" cols="20"></textarea><br/>
陆:<select name="road_hide">
<option value="0" >显</option>
<option value="1" >隐</option>
</select>
海:<select name="sail_hide">
<option value="0" >显</option>
<option value="1" >隐</option>
</select>
空:<select name="sky_hide">
<option value="0" >显</option>
<option value="1" >隐</option>
</select><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$ret_last">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}else{
$region_rename_sure = $encode->encode("cmd=region_post&gm_post_canshu=1&rename_id=$rename_id&sid=$sid");
$ret_last = $encode->encode("cmd=region_post&gm_post_canshu=1&sid=$sid");
$road_selected = $rename_road_hide == '[隐]'?'selected':'';
$sail_selected = $rename_sail_hide == '[隐]'?'selected':'';
$sky_selected = $rename_sky_hide == '[隐]'?'selected':'';
$area_html = <<<HTML
<p>[地图大区域设计]<br/>
你想要把{$rename_name}改成什么?<br/>
<form action="?cmd=$region_rename_sure" method="post">
<input name="old_name" type="hidden" title="id" value="{$rename_name}">
大区域名称:<input name="name" placeholder="{$rename_name}" type="text" maxlength="50"/><br/>
切换条件:<textarea name="change_cond" maxlength="200" rows="4" cols="20">{$change_cond}</textarea><br/>
不满足提示语:<textarea name="cmmt2" maxlength="200" rows="4" cols="20">{$cmmt2}</textarea><br/>
陆:<select name="road_hide">
<option value="0" >显</option>
<option value="1" {$road_selected}>隐</option>
</select>
海:<select name="sail_hide">
<option value="0" >显</option>
<option value="1" {$sail_selected}>隐</option>
</select>
空:<select name="sky_hide">
<option value="0" >显</option>
<option value="1" {$sky_selected}>隐</option>
</select><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$ret_last">返回上级</a><br/>
HTML;
}
echo $area_html;
?>
<script>
function confirmAction(del_url, step_order) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要移除 “" + step_order + "” 这个大区域吗？")) {
        // 使用传入的具体删除链接
        window.location.href = del_url;
    }
    return false;
}
</script>