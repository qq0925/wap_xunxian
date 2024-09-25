<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';

$parents_page = $currentFilePath;
// $encode = new \encode\encode();
// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_skill_page($dblj);
$br = 0;
$player = player\getplayer($sid,$dblj);
$uis_designer = $player->uis_designer;
for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'skill_pet';
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $mid = $pet_id;
    $jid = $skill_id;
    $show_ret = \lexical_analysis\process_string($main_show_cond,$sid,$oid,$mid,$jid,'fight');
    @$ret = eval("return $show_ret;");
    $ret_bool = $ret ? '0' : '1';
    if(is_null($ret)){
        $ret_bool = 0;
    }
    
    $main_value = nl2br($main_value);
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid,$jid,'fight');
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid,$jid,'fight');
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
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,8,$cmid);
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
$cmid = $cmid + 1;
$cdid[] = $cmid;
$goskilllist = $encode->encode("cmd=player_petskill&pet_id=$pet_id&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotopet = $encode->encode("cmd=player_petinfo&pet_id=$pet_id&ucmd=$cmid&sid=$sid");

if($player->uis_designer ==1){
$change_skill = $encode->encode("cmd=gm_skill_def&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
$change_skillmodule = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=8&sid=$sid");
$gm_html = <<<HTML
<a href="?cmd=$change_skill">设计当前技能</a><br/>
<a href="?cmd=$change_skillmodule">设计技能模板</a><br/>
HTML;
}

$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main
$gm_html
<a href="?cmd=$goskilllist">返回技能列表</a><br/>
<a href="?cmd=$gotopet">返回宠物页面</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;

echo $all;
?>