<?php
if($_POST['submit']){
if($telPhone){
    $result = validatePhone($_POST['telPhone']);
    if($result ==1){
    $sql = "update game1 set uphone = '$telPhone' where sid = '$sid'";
    $dblj->exec($sql);
    echo "修改成功！<br/>";
    }else{
    echo "输入格式有误！<br/>";
    }
}else{
    echo "请不要输入空白号码！<br/>";
}
}

function validatePhone($phone) {
    // 定义电话号码的正则表达式模式
    $pattern = "/^1[3456789]\d{9}$/";
  
    // 使用preg_match函数进行匹配
    if (preg_match($pattern, $phone)) {
        return 1;
    } else {
        return 0;
    }
}
 


$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$phone_html = <<<HTML
<form method="post">
填写你的手机号码<input name="telPhone" type="text" maxlength="11"/><br/>
<input name="ucmd" type="hidden" value="{$cmid}"/>
<input name="submit" type="submit" title="确定" value="确定"><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $phone_html;
?>