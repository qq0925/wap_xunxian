<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';

$parents_page = $currentFilePath;
// $encode = new \encode\encode();
// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$uid = $player->uid;
$oplayer = player\getplayer($mid,$dblj);
$cj_para = \gm\get_global_page_cj($dblj,5);
$css_text = $cj_para['css'];
$js_text = $cj_para['js'];
if($css_text){
    $css_add = <<<HTML
<style>
$css_text
</style>
HTML;
}

if($js_text){
    $js_add = <<<HTML
<script>
$js_text
</script>
HTML;
}
if(!$oplayer->sid){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$all =<<<HTML
该用户不存在！<br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}else{
$game_main = '';
$get_main_page = \gm\get_oplayer_page($dblj);
$br = 0;

$imoid = $oplayer->uid;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$im_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
$send_msg.=<<<HTML
<form action="?cmd=$im_post" method="post">
<input type="hidden" name="ltlx" value="im">
<input type="hidden" name="sid" value="$sid">
<input type="hidden" name="imuid" value="$imoid">
<input name="ltmsg" maxlength="200"></input>
<input type="submit" value="发送私聊">
</form>

HTML;

for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'scene_oplayer';
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $show_ret = $main_show_cond !== '' 
        ? \lexical_analysis\process_string($main_show_cond, $sid, $oid, $mid, null, null, "check_cond") 
        : 1;
    try{
        @$ret = eval("return $show_ret;");
    }
    catch (ParseError $e){
    $index = $i+1;
    print("第{$index}个元素的显示条件语法错误: ". $e->getMessage()."<br/>");
}
    catch (Error $e){
    $index = $i+1;
    print("第{$index}个元素的显示条件执行错误: ". $e->getMessage()."<br/>");
}
    $ret_bool = ($ret !== false && $ret !== null) ? 0 : 1;
    if($ret_bool ==0){
    if($main_type !=1){
    list($main_value,$br_count) = trimTrailingNewlinesAndCount($main_value);
    // 使用 str_repeat() 来生成多个 <br/> 标签
    $br_count_html = str_repeat("<br/>", $br_count);
    }else{
    $main_value = nl2br($main_value);
    }
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    if($main_target_event !=0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
        $main_target_event = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&target_event=$main_target_event&ucmd=$cmid&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&oid=$oid&mid=$mid&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,5,$cmid);
    }
    switch ($main_type) {
        case '1':
                $game_main .=<<<HTML
{$main_value}
HTML;

            break;
        case '2':
                $game_main .=<<<HTML
<a href="?cmd=$main_target_event" >{$main_value}</a>{$br_count_html}
HTML;
            break;
        case '3':
        if($main_target_func){
                $game_main .=<<<HTML
{$main_target_func}{$br_count_html}
HTML;
}
            break;
        case '4':
                $game_main .=<<<HTML
<a href="$main_link_value" >{$main_value}</a>{$br_count_html}
HTML;
            break;
        case '5':
                $game_main .=<<<HTML
<form action="?cmd={$main_target_event}" method="POST">
{$main_value}{$br_count_html}
</form>
HTML;
            break;
    }
    }
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
if($friend_canshu ==1){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gofriend_list = $encode->encode("cmd=player_friend_html&canshu=1&ucmd=$cmid&sid=$sid");
$friend_list = <<<HTML
<a href="?cmd=$gofriend_list">返回好友列表</a><br/>
HTML;
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
$css_add
</head>
$send_msg
$game_main
$friend_list
$js_add
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
if($player->uis_designer ==1){
$oplayer_design = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=5&sid=$sid");
$all .=<<<HTML
<a href="?cmd=$oplayer_design">设计查看玩家模板</a><br/>
HTML;
}
echo $all;
?>