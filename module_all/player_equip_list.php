 <?php

// require_once 'class/player.php';
// require_once 'class/encode.php';
// require_once 'class/gm.php';
// include_once 'pdo.php';
// // require_once 'class/lexical_analysis.php';
require 'class/basic_function_todo.php';

$sql = "select iid from system_item where sid = '$sid' and item_true_id = '$equip_true_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetch(PDO::FETCH_ASSOC) : [];
$equip_id = $ret['iid'];
$equip_arr = \player\getitem($equip_id,$dblj);
$equip_name = $equip_arr->iname??0;
$equip_name = \lexical_analysis\color_string($equip_name);
$equip_desc = $equip_arr->idesc??0;
$equip_desc = \lexical_analysis\color_string($equip_desc);

$equip_iattack_value = $equip_arr->iattack_value==''?0:$equip_arr->iattack_value;
$equip_irecovery_value = $equip_arr->irecovery_value==''?0:$equip_arr->irecovery_value;
$equip_iembed_count = $equip_arr->iembed_count ==''?0:$equip_arr->iembed_count;
$equip_photo_url = $equip_arr->iimage ==''?0:$equip_arr->iimage;
if($equip_photo_url){
    $equip_photo_url = "#".$equip_photo_url."#";
    $equip_photo = \lexical_analysis\process_photoshow($equip_photo_url);
}
$equip_value = $equip_arr->itype =="兵器"?"【攻击力】：{$equip_iattack_value}<br/>":"【防御力】：{$equip_irecovery_value}<br/>";
$parents_page = $currentFilePath;
$encode = new \encode\encode();
$player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$uis_designer = $player->uis_designer;
$game_main = '';
$get_main_page = \gm\get_equip_page($dblj);
$br = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $show_ret = \lexical_analysis\process_string($main_show_cond,$sid);
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
    if($main_target_event !=0 &&$ret_bool ==0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $i;
        $main_target_event = $encode->encode("cmd=main_target_event&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0 &&$ret_bool ==0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,0,6,$cmid);
    }elseif ($main_target_func ==0) {
        $main_target_func = $encode->encode("cmd=func_no_define&parents_page=$parents_cmd=$cmd&parents_page&sid=$sid");
    }
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
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if($uis_designer ==1){
$equips_module = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=6&sid=$sid");
$designer_html = <<<HTML
<a href="?cmd=$equips_module">设计装备模板</a><br/>
HTML;
}

$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main<br/>
$designer_html
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $all;

?>