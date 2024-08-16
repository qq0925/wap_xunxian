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
    $show_ret = \lexical_analysis\process_string($main_show_cond,$sid,null,$mid);
    @$ret = eval("return $show_ret;");
    $ret_bool = $ret ? '0' : '1';
    if(is_null($ret)){
        $ret_bool = 0;
    }
    
    $main_value = nl2br($main_value);
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    try{
        $matches = array();
                $pattern = '/\[([^\[\]]*)\]/';
                $main_value = preg_replace_callback($pattern, function($matches) {
                    $content = $matches[1]; // 获取方括号中的内容
                    // 进行处理，例如将内容转换为大写
                    $processedContent = @eval("return $content;");
                    return '[' . $processedContent . ']'; // 将处理后的内容放回原字符串中
                    }, $main_value);
            }
            catch (ParseError $e){
                print("语法错误: ". $e->getMessage());
                
            }
            catch (Error $e){
                print("执行错误: ". $e->getMessage());
}
    if($main_target_event !=0 &&$ret_bool ==0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
        $main_target_event = $encode->encode("cmd=main_target_event&mid=$mid&oid=$oid&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&ucmd=$cmid&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,7,$cmid);
    }elseif ($main_target_func ==0) {
        $main_target_func = $encode->encode("cmd=func_no_define&parents_page=$parents_page&$parents_cmd=$cmd&ucmd=$cmid&sid=$sid");
    }
    switch ($main_type) {
        case '1':
            if($ret_bool ==0){
                $game_main .=<<<HTML
$main_value
HTML;
}
            break;
        case '2':
            if($ret_bool ==0){
                $game_main .=<<<HTML
<a href="?cmd=$main_target_event" >$main_value</a>
HTML;
}
            break;
        case '3':
            if($ret_bool ==0){
                $game_main .=<<<HTML
$main_target_func
HTML;
}
            break;
        case '4':
            if($ret_bool ==0){
                $game_main .=<<<HTML
<a href="$main_link_value" >$main_value</a>
HTML;
}
            break;
    }
}
if($player->uis_designer ==1){
$gm_now_module = $encode->encode("cmd=game_self_page&self_id=$page_id&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$gm_html = <<<HTML
<a href="?cmd=$gm_now_module">设计当前模板</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main<br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
$gm_html
HTML;
echo $all;
?>