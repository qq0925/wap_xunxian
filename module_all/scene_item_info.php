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
$get_main_page = \gm\get_item_page($dblj);
$br = 0;
if($mid){
    $item_true_id = $mid;
}
for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'item';
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $mid = $item_true_id;
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
        $main_target_event = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0 &&$ret_bool ==0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,3,$cmid);
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

$gm_main = $encode->encode("cmd=gm&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
if(!$list_page){
$item_html = $encode->encode("cmd=item_html&canshu=$canshu&ucmd=$cmid&sid=$sid");
}else{
$item_html = $encode->encode("cmd=item_html&list_page=$list_page&canshu=$canshu&ucmd=$cmid&sid=$sid");
}

if($ck_sale==1){
$gomysale = $encode->encode("cmd=item_sale_list&canshu=$canshu&ucmd=$cmid&sid=$sid");
$game_main .= "<a href='?cmd=$gomysale'>返回挂售列表</a><br/>";
}

$cmid = $cmid + 1;
$cdid[] = $cmid;

$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if($player->uis_designer ==1){
    $modify = $encode->encode("cmd=game_item_list&item_id=$itemid&sid=$sid");
    $gm_item_design = <<<HTML
    <a href = "?cmd=$modify">设计该物品</a><br/>
HTML;
}

$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main
$gm_item_design
<a href="?cmd=$item_html">返回列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
$nowcount = \player\getitem_true_count($item_true_id,$sid,$dblj);
if($nowcount <=0){
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
没有该物品<br/>
<a href="?cmd=$item_html">返回列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}

echo $all;
?>