<?php
// 输入的表达式
$input = '星期{eval(v(c.day)==1?"一":(v(c.day)==2?"二":(v(c.day)==3?"三":(v(c.day)==4?"四":(v(c.day)==5?"五":(v(c.day)==6?"六":"日"))))))}';

// 定义词法规则
$patterns = array(
    '/(\{[^\}]+\})/',        // 匹配取值操作标记
    '/([+\-*/><=]|==|!=)/',  // 匹配操作符标记
    '/([()])/',              // 匹配括号标记
    '/("[^"]*")/',           // 匹配字符串标记
    '/(\?.+?:.+?(?=[+\-*/><=()]|$))/', // 匹配三目运算符标记
    '/([a-zA-Z]\w*)/',       // 匹配变量标记
    '/(\d+)/',               // 匹配数字标记
);

// 执行词法解析
$tokens = array();
foreach ($patterns as $pattern) {
    preg_match_all($pattern, $input, $matches);
    $tokens = array_merge($tokens, $matches[0]);
}

// 输出词法分析结果
foreach ($tokens as $token) {
    echo $token . "<br/>";
}
?>
