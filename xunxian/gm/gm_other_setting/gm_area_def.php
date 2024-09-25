<?php



$sql = "select game_id,game_status_string,game_desc,game_open_time,game_creat_time from gm_game_basic";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);


$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$area_html = <<<HTML
[游戏分区]<br/><br/>
<table style="font-size:14px;border:1px solid black;width:100%;padding:12px 12px 10px;">
<tr>
<td style="border:1px solid black;text-align:center;">ID</td>
<td style="border:1px solid black;text-align:center;">分区标识</td>
<td style="border:1px solid black;text-align:center;">创建时间</td>
<td style="border:1px solid black;text-align:center;">开区时间</td>
<td style="border:1px solid black;text-align:center;">状态</td>
<td style="border:1px solid black;text-align:center;">操作</td>
</tr>
<tr>
<td style="text-align:center;">1区</td>
<td style="text-align:center;">{$ret['game_id']}</td>
<td style="text-align:center;">{$ret['game_creat_time']}</td>
<td style="text-align:center;">{$ret['game_open_time']}</td>
<td style="text-align:center;">{$ret['game_status_string']}</td>
<td style="text-align:center;"><a href="">修改</a></td>
</tr>
<tr>
<td colspan="6" style="color:#ffffff;">.</td>
</tr>
<tr>
<td colspan="6" style="color:#ffffff;">.</td>
</tr>
<tr>
<td colspan="6" style="border:1px solid black;text-align:center;width:100%;background-color:  #d0d0d0 ;">
<form method="post">
<a style="color: #F75000 ;">【删区】</a>:<select name="delete_area_id">
<option value = 0 selected="selected">选择删除分区</option>
<option value = 1 >[1区]寻仙</option>
</select>
<input name="submit" type="submit" title="确定删除" value="确定删除"/><br/>
</form>
</td>
</tr>
</table>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $area_html;
?>