<?php


if($canshu =="lexical"){
    $ret = \lexical_analysis\process_string($lexical_text,$sid);
    echo "解析结果：".$ret."<br/>";
    // 将表达式结果转换为字符串输出
    //$ret = $ret ? '为真' : '为假';
    if(!$ret){
        $ret = $ret ? '真' : '假';
        echo "<br/>运算结果：返回了一个布尔值：".$ret."<br/><br/>";
    }else{
    echo "<br/>运算结果：".$ret."<br/><br/>";
    }
}

if($canshu =="eval"){
    echo("原语句：".$eval_test."<br/>");
    $ret = eval("return $eval_test;");
    if(!$ret){
        $ret = $ret ? '真' : '假';
        echo "<br/>运算结果：返回了一个布尔值：".$ret."<br/><br/>";
    }else{
    echo "<br/>运算结果：".$ret."<br/><br/>";
    }
}


$lexical_test = $encode->encode("cmd=lexical_post&canshu=lexical&para=post&sid=$sid");
$eval_test = $encode->encode("cmd=lexical_post&canshu=eval&para=post&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");

$gm_html =<<<HTML
<form action="?cmd=$lexical_test" method="post">
测试解析字符串:<textarea name="lexical_text" maxlength="4096" rows="4" cols="40">{$lexical_text}</textarea><br/>
<input type="submit" value="提交">
</form><br/>
<form action="?cmd=$eval_test" method="post">
测试eval:<textarea name="eval_test" maxlength="4096" rows="4" cols="40">{$eval_text}</textarea><br/>
<input type="submit" value="提交">
</form>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $gm_html;


?>