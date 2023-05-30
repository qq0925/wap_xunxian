<?php

//$game_main = new \gm\gm();
$player = \player\getplayer($sid,$dblj);
$get_main_page = \gm\get_main_page($dblj);

$op_type = 0;
$last_pos = 0;
if(!empty($main_id)){
$sql="select * from game_main_page where id='$main_id'";
$cxjg = $dblj->query($sql);
$cxjg->bindColumn('value',$main_value);
$cxjg->bindColumn('show_cond',$main_cond);
$cxjg->bindColumn('id',$last_pos);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$op_type = 1;
}else{
$last_pos = count($get_main_page)+1;
$op_type = 0;
}
echo $last_pos;
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$game_main = "?cmd=gm_game_pagemoduledefine&gm_post_canshu=11&sid=$sid";
$page=<<<HTML
<form action="$game_main" method="post">
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><br/>
位置:<input name="position" maxlength="3" value="$last_pos"><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="op_type" type="hidden" title="确定" value="$op_type"/>
</form><br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $page;
?>