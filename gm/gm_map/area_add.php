<?php

require_once 'pdo.php';

$area_add = $encode->encode("cmd=area_post&gm_post_canshu=0&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");


$conn = DB::pdo();

$sql = "SELECT id FROM system_area ORDER BY id DESC LIMIT 1";
$stmt = $conn->query($sql);
if ($stmt->rowCount() > 0) {
    // 获取数据
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $last_id = $row["id"] + 1;
} else {
    echo "表中没有数据";
}

//进行重复区域名称检测

$area_html = <<<HTML
<p>[地图设计]<br/>
增加区域<br/>
</p>
<form action="?cmd=$area_add" method="post">
<input name="last_id" type="hidden" title="id" value="$last_id"/>
区域名称:<input name="name" type="text" maxlength="50"/><br/>
所属大区域:<select name="area_belong">
<option value="0" >失落之地</option>
<option value="1" >日出之地</option>
<option value="2" >灼热之地</option>
<option value="3" >日落之地</option>
<option value="4" >极寒之地</option>
<option value="5" >湿热之地</option>
</select>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<button onClick="javascript:history.back(-1);">返回上级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $area_html;
?>