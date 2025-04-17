<?php

if($_POST){
    echo "修改成功！<br/>";
    $sql = "update  gm_game_basic set chat_head = '$head_css' where game_id = 19980925";
    $dblj->exec($sql);
}

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$chat_head = \player\getgameconfig($dblj)->chat_head;
$gochat = $encode->encode("cmd=liaotian&ltlx=all&sid=$sid");
$pre_value = create_head($chat_head, $sid, $cmid, $dblj, 'all');

$head_html = <<<HTML
预览效果：<br/>
{$pre_value}<br/>
聊天栏栏头部自定义<a href="?cmd=$gochat">GO</a><br/>
<form method="post">
样式代码:<textarea name="head_css" maxlength="1024" rows="4" cols="40" style="width: 480px; height: 250px";>{$chat_head}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改"></form>
{{chat_type_*}}：生成一个指向该类别的链接，且点击后会用文本替换原有链接位置。<br/>
*可以是：all(公共)，im(私聊)，city(城聊)，area(区聊)，team(队聊)，system(系聊)。<br/>
注：必须有一个公共的链接。<br/>
{{chat_flush_url}}：生成一个指向当前类别的刷新链接。<br/>
{{chat_now_nav}}：生成一个文本，显示为当前频道提示。<br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $head_html;

function create_head($head_value, $sid, $cmid, $dblj, $canshu) {
    global $encode;
    $ret_url = $head_value;
    $channels = [
        'all' => '公共',
        'im' => '私聊',
        'city' => '城聊',
        'area' => '区聊',
        'team' => '队聊',
        'system' => '系聊'
    ];
    $now_nav = $channels[$canshu];
    $ret_url = str_replace('{{chat_now_nav}}', $now_nav, $ret_url);
    $chat_flush_url ="刷新";
    $ret_url = str_replace('{{chat_flush_url}}', $chat_flush_url, $ret_url);
    // 处理物品类型模式
    $ret_url = preg_replace_callback('/\{\{chat_type_([^}]+)\}\}/', function($matches) use ($encode,$channels, $sid, &$cmid, $canshu) {
    $type = $matches[1];
    $lx_name = $channels[$type];
        $cmid++;
        return $lx_name;
    }, $ret_url);

    $ret_url = \lexical_analysis\process_string($ret_url,$sid,$oid,$mid);
    $ret_url = \lexical_analysis\process_photoshow($ret_url);
    $ret_url =\lexical_analysis\color_string($ret_url);
    return nl2br($ret_url);
} 


?>
<script>
function confirmAction(del_url) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要重置为默认模板吗？")) {
        // 使用传入的具体删除链接
        window.location.href = del_url;
    }
    return false;
}
</script>