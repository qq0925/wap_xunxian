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


if(isset($_POST['change_count'])){
    if($change_count >0 && is_int((int)$change_count)){
    echo "修改成功!<br/>";
    $dblj->exec("update system_item set icount = '$change_count' where item_true_id = '$item_true_id' and sid = '$sid'");
    $item_burthen = \player\update_item_burthen($sid,$dblj);
    $sql = "update game1 set uburthen = '$item_burthen' WHERE sid='$sid'";
    $cxjg = $dblj->exec($sql);
    }else{
    echo "不能输入负数，小数，0！<br/>";
    }
}

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
//     try{
//         $matches = array();
//                 $pattern = '/\[([^\[\]]*)\]/';
//                 $main_value = preg_replace_callback($pattern, function($matches) {
//                     $content = $matches[1]; // 获取方括号中的内容
//                     // 进行处理，例如将内容转换为大写
//                     $processedContent = @eval("return $content;");
//                     return '[' . $processedContent . ']'; // 将处理后的内容放回原字符串中
//                     }, $main_value);
//             }
//             catch (ParseError $e){
//                 print("语法错误: ". $e->getMessage());
                
//             }
//             catch (Error $e){
//                 print("执行错误: ". $e->getMessage());
// }
    if($main_target_event !=0){
        
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $i;
        $main_target_event = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }else{
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,3,$cmid);
        //var_dump($main_target_func);
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
    $itemid = \player\getitem_root($item_true_id,$sid,$dblj);
    $item_type = \player\getitem($itemid,$dblj)->itype;
    $modify = $encode->encode("cmd=game_item_list&item_id=$itemid&sid=$sid");
    $modify_module = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=4&sid=$sid");
    if($item_type !="兵器"&&$item_type !="防具"){
    $itemcount = \player\getitem_count($itemid,$sid,$dblj)['icount'];
    $modify_count = $encode->encode("cmd=iteminfo_new&item_id=$itemid&uid=$uid&canshu=$canshu&list_page=$list_page&item_true_id=$item_true_id&sid=$sid");
    $gm_count_html = <<<HTML
    <form action="?cmd=$modify_count" method="post">
    数量：<input name="change_count" type="TEXT" value="{$itemcount}" size="5">
    <input type="submit" value="修改">
    </form>
HTML;
}
    $gm_item_design = <<<HTML
----------<br/>
    <a href = "?cmd=$modify">设计该物品</a><br/>
    <a href = "?cmd=$modify_module">设计物品模板</a><br/>
----------<br/>
HTML;
}

$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$gm_count_html
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