<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';
include_once 'class/events_steps_change.php';
$parents_cmd = 'gm_scene_new';
$parents_page = $currentFilePath;
// $encode = new \encode\encode();
// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_npc_page($dblj);
$cj_para = \gm\get_global_page_cj($dblj,2);
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
$br = 0;
$nowmid = $player->nowmid;
// 预处理 SQL 查询



$sql = "SELECT * FROM system_npc_scene WHERE ncid = :mid AND nmid = :nowmid";
$stmt = $dblj->prepare($sql);

// 绑定参数
$stmt->bindParam(':mid', $mid, PDO::PARAM_INT);
$stmt->bindParam(':nowmid', $nowmid, PDO::PARAM_STR);

// 执行查询
$stmt->execute();
// 获取结果
$cxnpcall = $stmt->fetch(PDO::FETCH_ASSOC);

if($cxnpcall){
$nname = $cxnpcall['nname'];
$nid = $cxnpcall['nid'];
$nkill = $cxnpcall['nkill'];
$ntaskid = $cxnpcall['ntask_target'];
$ntaskarr = explode(',',$ntaskid);
$order = 1;
if ($ntaskid!='' && $nkill ==0){
    for($order=1;$order <@count($ntaskarr) +1;$order ++){
        $nowrw = \player\gettask($ntaskarr[$order-1],$dblj);
        $rw_cond = $nowrw->tcond;
        $rw_type = $nowrw->ttype;
        $rw_accept_cond = $nowrw->taccept_cond;
        $rw_cmmt1 = $nowrw->tcmmt1;
        $rw_cmmt1 = \lexical_analysis\process_string($rw_cmmt1,$sid,$oid,$mid);
        $rw_accept_cond = checkTriggerCondition($rw_accept_cond,$dblj,$sid);
        if(is_null($rw_accept_cond)){
        $rw_accept_cond = true;
        }
        $rw_trigger_cond = checkTriggerCondition($rw_cond,$dblj,$sid);
        if(is_null($rw_trigger_cond)){
        $rw_trigger_cond = true;
        }
        
        
        if($rw_accept_cond && $rw_trigger_cond && $order !=@count($ntaskarr) +1){
        $task_event_id = \player\getselfeventid($ntaskarr[$order-1],$dblj,'npc_task_accept');
        $rwret = \player\getplayertaskonce($sid,$ntaskarr[$order-1],$dblj);
        $rwstate = $rwret[0]['tstate'];
        $rw_paras = explode(',',$nowrw->ttarget_obj);
        $rw_player_paras = explode(',',$rwret[0]['tnowcount']);
        
        $rw_check_count = @count($rw_paras);
        
        if ($nowrw->ttype){
            if (!$rwret){
                if($nowrw->tnpc_id == $nid){
                $player_tnowcount = preg_replace('/\|(\d+)/', '|0', $nowrw->ttarget_obj);
                \player\inserttask($ntaskarr[$order-1],$player_tnowcount,$sid,$dblj);
                //步骤中若放弃传值的问题
                events_steps_change($task_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc_scene',$mid,$para);
                $npc_hide = 1;
                break;
                }
            }elseif ($rwstate==1){
                if($nowrw->tnpc_id == $nid){
                $rw_check_done = 0;
                for($i=0;$i<$rw_check_count;$i++){
                    $rw_para = explode('|',$rw_paras[$i]);
                    $rwtarget_id = $rw_para[0];
                    $rwcount = $rw_para[1];
                    $rwnowcount = $rwret[0]['tnowcount'];
                    if($rw_type ==2){
                    $rwnowcount = \player\getitem_count($rwtarget_id,$sid,$dblj)['icount'];
                    }
                    if($rw_type ==1){
                    $rw_player_para = explode('|',$rw_player_paras[$i]);
                    $rwnowcount = $rw_player_para[1];
                    }
                    if($rwnowcount >=$rwcount){
                    $rw_check_done ++;
                    }
                }
                    
                    if($rw_check_done <$rw_check_count ||$rw_type ==3){
                    if($ret_npc ==0){
                    $npc_hide = 1;
                    }
                    
                    $cmid = $cmid + 1;
                    $cdid[] = $cmid;
                    if($npc_hide ==1){
                    $npc_url = $encode->encode("cmd=npc_html&ret_npc=1&ucmd=$cmid&nid=$nid&mid=$mid&sid=$sid");
                    $tcmmt2 = nl2br($nowrw->tcmmt2);
                    echo "$tcmmt2<br/>";
                    echo "<a href='?cmd=$npc_url'>返回{$nname}</a><br/>";
                    }
                    }
                    elseif($rw_check_done ==$rw_check_count &&$rw_type !=3){
                    //步骤中若放弃传值的问题
                    $task_finish_event_id = \player\getselfeventid($ntaskarr[$order-1],$dblj,'npc_task_finish');
                    events_steps_change($task_finish_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc_scene',$mid,$para);
                    \player\updatettask_state(2,$ntaskarr[$order-1],$sid,$dblj);
                    \player\updatettask_tcount($nowrw->ttarget_obj,$ntaskarr[$order-1],$sid,$dblj);
                    $npc_hide = 1;
                    }
                }
                break;
            }
        }
        
        
        }elseif($rw_trigger_cond &&(!$rw_accept_cond && $npc_hide!=2) && $order !=@count($ntaskarr) +1){
        continue;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        echo "接受任务失败！<br/><font color='red'>".$rw_cmmt1."</font><br/><br/>";
        $npc_hide = 1;
        $npc_url = $encode->encode("cmd=npc_html&ret_npc=1&npc_hide=2&ucmd=$cmid&nid=$nid&mid=$mid&sid=$sid");
        echo "<a href='?cmd=$npc_url'>返回{$nname}</a><br/>";
        break;
        
        }elseif($rw_trigger_cond &&(!$rw_accept_cond && $npc_hide!=2) && $order ==@count($ntaskarr) +1){
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        echo "接受任务失败！<br/><font color='red'>".$rw_cmmt1."</font><br/><br/>";
        $npc_hide = 1;
        $npc_url = $encode->encode("cmd=npc_html&ret_npc=1&npc_hide=2&ucmd=$cmid&nid=$nid&mid=$mid&sid=$sid");
        echo "<a href='?cmd=$npc_url'>返回{$nname}</a><br/>";
        break;
        }
    }
}


for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'npc_scene';
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
    //$ret_bool = $ret ? '0' : '1';
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
    //$main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
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
        $main_target_event = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }else{
        $main_target_event = $encode->encode("cmd=event_no_define&oid=$oid&mid=$mid&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,2,$cmid);
        $main_target_func = \lexical_analysis\color_string($main_target_func);
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
    $old_scene = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
$css_add
</head>
$game_main<br/>
$js_add
<a href="game.php?cmd=$old_scene">返回游戏</a><br/>
HTML;
if($player->uis_designer ==1){
$npc_design = $encode->encode("cmd=gm_npc_second&npc_id=$nid&npc_designer_mid=$player->nowmid&sid=$sid");
$npc_module_design = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=2&sid=$sid");
$all .=<<<HTML
----------<br/>
<a href="?cmd=$npc_design">设计当前人物</a><br/>
<a href="?cmd=$npc_module_design">设计电脑人物模板</a><br/>
----------<br/>
HTML;
}
if($npc_hide ==0 ||$npc_hide ==2){
echo $all;
}
}
else{
$cmid = $cmid + 1;
$cdid[] = $cmid;
$old_scene = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$player->nowmid&sid=$sid");
echo("对方已不在！<br/>".'<a href="?cmd='.$old_scene.'">返回游戏</a>');
}
?>