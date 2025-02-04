<?php

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$notice_post = $encode->encode("cmd=gm_global_notice&canshu=post&sid=$sid");

if($flush_canshu){
    echo "已成功清除！<br/>";
    $sql = "UPDATE gm_game_basic SET game_temp_notice = '',game_temp_notice_time = ''";
    $dblj->exec($sql);
}

if(!empty($_POST)){
if($temp_msg && $temp_time){
    echo "发布了临时公告：<br/>$temp_msg<br/>";
    $sql = "UPDATE gm_game_basic SET game_temp_notice = '$temp_msg',game_temp_notice_time = '$temp_time'";
    $dblj->exec($sql);
}else{
    echo "输入有误！<br/>";
}

}

$flush_notice = $encode->encode("cmd=gm_global_notice&flush_canshu=1&sid=$sid");
$copy_url = "game.php?cmd=$flush_notice";
$notice_html = <<<HTML
<a href="#" onclick="confirmAction()">清除临时公告</a><br/>
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
<script>
function confirmAction() {
    // 弹出确认框
    if (confirm("你确定要清除吗？")) {
        // 如果点击“确认”，则跳转到PHP传递的链接
        window.location.href = "<?php echo $copy_url; ?>";
    } else {
        // 如果点击“取消”，则什么也不做
        return false;
    }
}
</script>
