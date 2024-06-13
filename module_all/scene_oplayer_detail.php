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
$oplayer = player\getplayer1($oid,$dblj);
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
$oplayer = player\getplayer1($oid,$dblj);
$imoid = $oplayer->uid;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$im_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
$send_msg.=<<<HTML
<form action="?cmd=$im_post" method="post">
<input type="hidden" name="ltlx" value="im">
<input type="hidden" name="sid" value="$sid">
<input type="hidden" name="imuid" value="$imoid">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20""></textarea>
<input type="submit" value="发送私聊">
</form>

HTML;

for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'scene_oplayer';
    $mid = $oplayer->sid;
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $show_ret = \lexical_analysis\process_string($main_show_cond,$sid,$oid,$mid);
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
    $clj[] = $i;
        $main_target_event = $encode->encode("cmd=main_target_event&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0 &&$ret_bool ==0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,5,$cmid);
        //var_dump($main_target_func);
    }elseif ($main_target_func ==0) {
        $main_target_func = $encode->encode("cmd=func_no_define&parents_page=$parents_page&$parents_cmd=$cmd&sid=$sid");
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
$oplayer_design = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=5&sid=$sid");
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$send_msg
$game_main
$friend_list
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
if($player->uis_designer ==1){
$all .=<<<HTML
<a href="?cmd=$oplayer_design">设计查看玩家模板</a><br/>
HTML;
}
echo $all;
?>