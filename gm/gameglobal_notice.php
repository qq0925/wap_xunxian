<?php

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$notice_post = $encode->encode("cmd=gm_global_notice&canshu=post&sid=$sid");

if(!empty($_POST)){
if($temp_msg && $temp_time){
    echo "发布了临时公告：<br/>$temp_msg<br/>";
    $sql = "UPDATE gm_game_basic SET game_temp_notice = '$temp_msg',game_temp_notice_time = '$temp_time'";
    $dblj->exec($sql);
}else{
    echo "输入有误！<br/>";
}

}



$notice_html = <<<HTML
<p>[发布临时公告]<br/>
</p>
<form action="?cmd=$notice_post" method="post">
公告内容:<textarea name="temp_msg" maxlength="200" rows="4" cols="40" placeholder = "请输入临时公告"></textarea><br/>
持续时间:<input name="temp_time" size="5" value="30">分钟<br/>
<input name="submit" type="submit" title="发布" value="发布"/><input name="submit" type="hidden" title="发布" value="发布"/></form><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $notice_html;
?>