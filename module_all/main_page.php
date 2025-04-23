<?php
//20-23ms
//require_once 'class/lexical_analysis_test.php';
require_once 'class/basic_function_todo.php';
// require_once 'class/player.php';
// require_once 'class/encode.php';
// require_once 'class/gm.php';
// include_once 'pdo.php';
// // require_once 'class/lexical_analysis.php';
// include_once 'class/global_event_step_change.php';
include_once 'class/events_steps_change.php';

$parents_page = $currentFilePath;
$parents_cmd = 'gm_scene_new';
// $encode = new \encode\encode();
// $player = new \player\player();

$player = \player\getplayer($sid,$dblj);
$gm_html = '';
$game_main = '';

$get_main_page = \gm\get_scene_page($dblj);
$cj_para = \gm\get_global_page_cj($dblj,1);
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
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$change_scenemodule = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=1&sid=$sid");
$old_scene = $encode->encode("cmd=gm_scene_new&newmid=$player->nowmid&sid=$sid");
//$midguai = \player\getmidguai($player->nowmid,$dblj);

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$player->nowmid&sid=$sid");

$u_sailing = $player->uis_sailing;
$u_roading = $player->uis_roading;
$u_skying = $player->uis_skying;
$u_pve = $player->uis_pve;
if($u_sailing ==1){
    $cmd = 'sailing_html';
    include 'module_all/sailing.php';
}elseif($u_roading ==1){
    $cmd = 'roading_html';
    include 'module_all/roading.php';
}elseif($u_skying ==1){
    $cmd = 'skying_html';
    include 'module_all/skying.php';
}elseif($u_pve ==1 &&$player->uhp >0){
    $cmd = 'pve_fight';
    include 'module_all/scene_fight.php';
}else{

if($player->tpsmid!=0){
\player\changeplayersx('tpsmid',0,$sid,$dblj);
}





$ret = global_event_data_get(48,$dblj);
if($ret){
global_events_steps_change(48,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php',null,null,$para);
}



// if($player->ucmd){
//     \player\changeplayersx('ucmd','',$sid,$dblj);
//     $player = \player\getplayer($sid,$dblj);
// }


 if ($player->uhp<=0){
     \player\changeplayersx('uhp',1,$sid,$dblj);
 }




if (isset($newmid) && $player->nowmid != $newmid) {
    // 获取新地图信息
    $clmid = player\getmid($newmid, $dblj);
    
    // 批量更新数据库操作
    try {
        $dblj->beginTransaction();
        
        // 更新宠物场景
        $dblj->exec("UPDATE system_pet_scene SET nmid = '$newmid' WHERE nsid = '$sid' AND nstate = 1");
        
        // 处理进入地图事件
        if ($clmid->minto_event_id != 0) {
            events_steps_change(
                $clmid->minto_event_id,
                $sid,
                $dblj,
                $just_page,
                $steps_page,
                $cmid,
                'module_all/main_page.php',
                'scene',
                $clmid->mid,
                $para
            );
            
            // 重新获取可能被事件改变的玩家数据
            $player = player\getplayer($sid, $dblj);
            $tpsmid = $player->tpsmid;
        } else {
            $tpsmid = 0;
        }
        
        // 处理全局事件
        global_events_steps_change(49, $sid, $dblj, $just_page, $steps_page, $cmid, 'module_all/main_page.php', null, null, $para);
        
        // 更新玩家位置信息
        if ($tpsmid != 0) {
            // 批量更新玩家状态
            $updates = [
                ['justmid', $player->nowmid],
                ['nowmid', $tpsmid],
                ['tpsmid', 0]
            ];
        } else {
            $oldclmid = player\getmid($player->nowmid, $dblj);
            $updates = [
                ['justmid', $player->nowmid],
                ['nowmid', $newmid]
            ];
            
            // 处理离开地图事件
            if ($oldclmid->mout_event_id != 0) {
                events_steps_change(
                    $oldclmid->mout_event_id,
                    $sid,
                    $dblj,
                    $just_page,
                    $steps_page,
                    $cmid,
                    'module_all/main_page.php',
                    'scene',
                    $oldclmid->mid,
                    $para
                );
                
                // 检查事件是否改变了玩家位置
                $player = player\getplayer($sid, $dblj);
                if ($player->tpsmid != 0) {
                    $updates = [
                        ['justmid', $player->nowmid],
                        ['nowmid', $player->tpsmid],
                        ['tpsmid', 0]
                    ];
                }
            }
        }
        
        // 批量执行玩家状态更新
        foreach ($updates as [$field, $value]) {
            \player\changeplayersx($field, $value, $sid, $dblj);
        }
        
        $dblj->commit();
    } catch (Exception $e) {
        $dblj->rollback();
        error_log("Error in map change: " . $e->getMessage());
    }
    
    // 最后更新玩家信息
    $player = player\getplayer($sid, $dblj);
} else if (!isset($newmid)) {
    \player\changeplayersx('justmid', $player->nowmid, $sid, $dblj);
}


$clmid = player\getmid($player->nowmid,$dblj);
if($clmid->mlook_event_id !=0){
events_steps_change($clmid->mlook_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','scene',$clmid->mid,$para);
}
$sql = "select uname,sid,endtime,uis_designer from game1 where nowmid='$player->nowmid' AND sfzx = 1 AND sid !='$sid' and uis_sailing = 0 and uis_skying = 0 and uis_roading = 0";//获取当前地图玩家
$cxjg = $dblj->query($sql);
$playerhtml = '';
if ($cxjg){
    $gameconfig = \player\getgameconfig($dblj);
    $system_offline_time = $gameconfig->offline_time;
    $cxallplayer = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    $cxallplayer_count = @count($cxallplayer);
    $nowdate = date('Y-m-d H:i:s');
    for ($i = 1;$i<$cxallplayer_count +1;$i++){
        if ($cxallplayer[$i-1]['uname']!=""){
            $cxtime = $cxallplayer[$i-1]['endtime'];
            $cxdesigner = $cxallplayer[$i-1]['uis_designer'];
            $cxsid = $cxallplayer[$i-1]['sid'];
            $minute=floor((strtotime($nowdate)-strtotime($cxtime))/60);//获取刷新分钟间隔
            if ($minute>=$system_offline_time &&$cxdesigner==0 &&$system_offline_time !=0){
                $sql = "update game1 set sfzx=0 WHERE sid='$cxsid'";
                $dblj->exec($sql);
            }
        }
    }
}

$nowdate = date('Y-m-d H:i:s');
$minute=floor((strtotime($nowdate)-strtotime($clmid->mgtime))/60);//获取刷新分钟间隔

if($minute >= $clmid->mrefresh_time){


$sql = "update system_map set mgtime='$nowdate' WHERE mid='$player->nowmid'";
$dblj->exec($sql);
if($clmid->mnpc!=''){
    $data = $clmid->mnpc;
    $npc_s = explode(",", $data); // 使用逗号分隔字符串，得到每个项
    foreach ($npc_s as &$npc_a) {
        $parts = explode("|", $npc_a); // 使用竖线分隔每个项
        if (count($parts) === 2||count($parts) === 3) {
            $id = $parts[0];
            $npc_count = $parts[1];
            $npc_show_cond = $parts[2];
            $npc_count = \lexical_analysis\process_string($npc_count,$sid);
            @$npc_count = eval("return $npc_count;");
            // 更新处理后的值
            $npc_a = "$id|$npc_count|$npc_show_cond";
        }
    }
    // 将处理后的数据重新组合成字符串
    $climb_npc_count = implode(",", $npc_s);
    $sql = "update system_map set mnpc_now = '$climb_npc_count' WHERE mid='$player->nowmid'";
    $dblj->exec($sql);
    $clmid = player\getmid($player->nowmid,$dblj);
    $retgw = explode(",",$clmid->mnpc_now);
    foreach ($retgw as $itemgw){
        $gwinfo = explode("|",$itemgw);
        $npc_id = $gwinfo[0];
        $npc_count = $gwinfo[1];
        $npc_para = \player\getnpc($npc_id,$dblj);
        
        // 准备 SQL 查询
        $sql = "SELECT 1 FROM system_npc_scene WHERE nid = :npc_id AND nmid = :nowmid";
        
        // 预处理查询语句
        $stmt = $dblj->prepare($sql);
        
        // 绑定参数
        $stmt->bindParam(':npc_id', $npc_id, PDO::PARAM_INT);
        $stmt->bindParam(':nowmid', $player->nowmid, PDO::PARAM_INT);
        
        // 执行查询
        $stmt->execute();
        
        // 获取所有记录
        $cxnpcall = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // 获取记录数量
        $npc_temp_count = count($cxnpcall);
        $diff =  $npc_count - $npc_temp_count;
        if($diff >0){
        for ($n=0;$n<$diff;$n++){
            // 要复制的数据行id
            $nid = $npc_para->nid;
            $nmid = $player->nowmid;
            // 1. 查询列名并缓存结果以减少重复查询
            if (empty($columns)) {
                $stmt = $dblj->query("SHOW COLUMNS FROM system_npc");
                $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
            // 2. 移除不必要的列（如果有）
            $cols = implode(", ", $columns);
            
            // 3. 动态构建 SQL 语句
            $sql = "INSERT INTO system_npc_scene ($cols, nmid) 
                    SELECT $cols, :nmid 
                    FROM system_npc 
                    WHERE nid = :nid;";
            
            // 4. 预编译 SQL 语句
            $stmt = $dblj->prepare($sql);
            
            // 5. 绑定参数并执行
            $stmt->bindParam(':nmid', $nmid, PDO::PARAM_INT);
            $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
            $stmt->execute();
            // 获取最后插入记录的自增 ID
            $lastInsertId = $dblj->lastInsertId();
            
            $npc_scene_creat_event = $npc_para->ncreat_event_id;
            if($npc_scene_creat_event!=0){
            events_steps_change($npc_scene_creat_event,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc_scene',$lastInsertId,$para);
            }

            $ret = global_event_data_get(26,$dblj);
            if($ret){
            global_events_steps_change(26,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc_scene',$lastInsertId,$para);
            }

    }
}
    }
}
if($clmid->mitem!=''){
    $data = $clmid->mitem;
    $items = explode(",", $data); // 使用逗号分隔字符串，得到每个项
    foreach ($items as &$item) {
        $parts = explode("|", $item); // 使用竖线分隔每个项
        if (count($parts) >= 2) {
            $id = $parts[0];
            $item_count = $parts[1];
            $item_count = \lexical_analysis\process_string($item_count,$sid);
            @$item_count = eval("return $item_count;");
            
            // 更新处理后的值
            $item = "$id|$item_count";
        }
    }
    // 将处理后的数据重新组合成字符串
    $climb_item_count = implode(",", $items);
    $sql = "update system_map set mitem_now = '$climb_item_count' WHERE mid='$player->nowmid'";
    $dblj->exec($sql);
    }

}

$scene_drop_item = \player\getscenedropitem($clmid->mid,$dblj);
if($scene_drop_item){
// 获取当前时间
$nowtime = new \DateTime(); // 获取当前时间
$drop_disappear_time = \player\getgameconfig($dblj)->drop_disappear_time; // 获取配置中的消失时间
$scene_id = $clmid->mid;
 // 准备 SQL 语句
$sql = "
    DELETE FROM system_npc_drop_list
    WHERE drop_mid = $scene_id and (drop_item_data IS NULL
    OR TIMESTAMPDIFF(SECOND, drop_time, NOW()) > :drop_disappear_time
)";

    $stmt = $dblj->prepare($sql);

    // 绑定参数
    $stmt->bindParam(':drop_disappear_time', $drop_disappear_time, \PDO::PARAM_INT);

    // 执行 SQL 语句
    $stmt->execute();
}

$map_detail = $encode->encode("cmd=map_detail&mid=$player->nowmid&sid=$sid");

if($player->nowmid !=0){
$change_nowmid = $encode->encode("cmd=gm_post_4&target_midid=$player->nowmid&sid=$sid");
}else{
$change_nowmid = $encode->encode("cmd=gm_map_2&sid=$sid");
}

//30-60ms

if($player->ucmd != "pve_fight"){
//30-70ms
$page_count = count($get_main_page);
$oid = 'scene';
$mid = $player->nowmid;
for ($i=0;$i<$page_count;$i++){
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
    //$main_value = process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    
    if($main_target_event !=0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $main_target_event = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }else {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0 ){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,1,$cmid);
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
}

//100+ms
//渲染页面的函数是吃性能大头。

if($player->uis_designer ==1){
$gm_html = <<<HTML
----------<br/>
<a href="?cmd=$change_nowmid">修改当前场景</a><br/>
<a href="?cmd=$change_scenemodule">设计场景模板</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
----------<br/>
HTML;
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
$css_add
</head>
$game_main
$js_add
$gm_html
HTML;
if($player->ucmd != "pve_fight"){
echo $all;
}else{
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$all =<<<HTML
对方已离开！<br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
HTML;
echo $all;
}
}
?>