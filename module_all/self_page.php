<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';

if(!$parents_page){
$parents_page = $currentFilePath;
}

if($parents_cmd){
$cmd = $parents_cmd;
}


// $encode = new \encode\encode();
// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_self_page($dblj,$page_id);
$page_para = \gm\get_self_page_list($dblj,$self_id);
$not_return = $page_para[0]['not_return'];
if($not_return ==0){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$ret_game = <<<HTML
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}

$br = 0;

$player = player\getplayer($sid,$dblj);

for ($i=0;$i<count($get_main_page);$i++){
    if(!$mid){
    $mid = $player->nowmid;
    }
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $show_ret = $main_show_cond !== '' 
        ? \lexical_analysis\process_string($main_show_cond, $sid, null, $mid, null, null, "check_cond") 
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
    //$main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    if($main_target_event !=0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
        $main_target_event = $encode->encode("cmd=main_target_event&mid=$mid&oid=$oid&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&ucmd=$cmid&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,7,$cmid);
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
    }
    }
}
if($player->uis_designer ==1){
$gm_now_module = $encode->encode("cmd=game_self_page&self_id=$page_id&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$gm_html = <<<HTML
----------<br/>
<a href="?cmd=$gm_now_module">设计当前模板</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
----------<br/>
HTML;
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main
$ret_game
$gm_html
HTML;
echo $all;
?>