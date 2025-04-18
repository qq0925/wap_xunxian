<?php

if($_POST){
    echo "修改成功！<br/>";
    $sql = "update  gm_game_basic set fight_head = '$head_css' where game_id = 19980925";
    $dblj->exec($sql);
}

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$fight_head = \player\getgameconfig($dblj)->fight_head;

$pre_value = create_head($fight_head, $sid, $cmid, $dblj, '哥布林');

$head_html = <<<HTML
预览效果：<br/>
{$pre_value}<br/>
战斗结算页面自定义<br/>
<form method="post">
样式代码:<textarea name="head_css" maxlength="1024" rows="4" cols="40" style="width: 480px; height: 250px";>{$fight_head}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改"></form>
{{fight_win_*}}：战斗胜利文本，仅在胜利页面显示。<br/>
{{fight_lose_*}}：战斗失败文本，仅在失败页面显示。<br/>
{{fight_nofight_*}}：无法开启战斗文本，仅在无法开启战斗页面显示。<br/>
*是：战斗结果文本<br/>
{{monster_final_name}}：获取最后一个怪物的名称。<br/>
{{monster_final_hurt}}：获取最后一个怪物造成的伤害。<br/>
{{monster_list_*}}：获取怪物列表名称，其中，*代表怪物间的分隔符。<br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $head_html;

function create_head($head_value, $sid, $cmid, $dblj, $canshu) {
    global $encode;
    $ret_url = $head_value;
    $now_nav = $channels[$canshu];
    $ret_url = str_replace('{{fight_now_nav}}', $now_nav, $ret_url);
    $fight_flush_url ="刷新";
    $ret_url = str_replace('{{fight_flush_url}}', $fight_flush_url, $ret_url);
    // 处理物品类型模式
    $ret_url = preg_replace_callback('/\{\{fight_type_([^}]+)\}\}/', function($matches) use ($encode,$channels, $sid, &$cmid, $canshu) {
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