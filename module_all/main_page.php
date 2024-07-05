<?php
//20-23ms


require 'class/basic_function_todo.php';
// require_once 'class/player.php';
// require_once 'class/encode.php';
// require_once 'class/gm.php';
// include_once 'pdo.php';
// // require_once 'class/lexical_analysis.php';
// include_once 'class/global_event_step_change.php';
include_once 'class/events_steps_change.php';

$parents_page = $currentFilePath;
// $encode = new \encode\encode();
// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$gm_html = '';
$game_main = '';


// // 定义缓存文件路径
// $cacheDir = 'cache';
// $cacheFile = $cacheDir . '/get_main_page.cache';
// $cacheTime = 3600; // 缓存时间，单位为秒（这里设置为1小时）

// // 检查缓存目录是否存在，如果不存在则创建
// if (!is_dir($cacheDir)) {
//     mkdir($cacheDir, 0777, true); // 0777 表示目录权限，true 表示递归创建目录
// }

// // 检查缓存文件是否存在且未过期
// if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
//     // 从缓存文件中读取数据
//     $get_main_page = unserialize(file_get_contents($cacheFile));
// } else {
//     // 从数据源获取数据
//     $get_main_page = \gm\get_scene_page($dblj);

//     // 将数据写入缓存文件
//     file_put_contents($cacheFile, serialize($get_main_page));
// }


$get_main_page = \gm\get_scene_page($dblj);
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
$u_pve = $player->uis_pve;
if($u_sailing ==1){
    $cmd = 'sailing_html';
    include 'module_all/sailing.php';
}elseif($u_pve ==1 &&$player->uhp >0){
    $cmd = 'pve_fighting';
    include 'module_all/scene_fight.php';
}else{
if($player->tpsmid!=0){
\player\changeplayersx('tpsmid',0,$sid,$dblj);
}
$parents_cmd = 'gm_scene_new';
$ret = global_event_data_get(48,$dblj);
if($ret){
global_events_steps_change(48,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php',null,null,$para);
}
if($player->ucmd){
    \player\changeplayersx('ucmd',"",$sid,$dblj);
    $player = \player\getplayer($sid,$dblj);
}
if (isset($newmid)){
    if ($player->nowmid!=$newmid){
        $clmid = player\getmid($newmid,$dblj); //获取即将走的地图信息
        if($clmid->minto_event_id !=0){
        $parents_cmd = 'gm_scene_new';
        events_steps_change($clmid->minto_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','scene',$clmid->mid,$para);
        $player = player\getplayer($sid,$dblj);//获取玩家信息
        $tpsmid = $player->tpsmid;
        }
        if ($player->uhp<=0){
            $retmid = \player\getmid($player->nowmid,$dblj);
            $retqy = \player\getqy($retmid->id,$dblj);
            echo("你已经重伤请治疗<br/>");
        }else{
            $parents_cmd = 'gm_scene_new';
            global_events_steps_change(49,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php',null,null,$para);
            if($tpsmid!=0){
            \player\changeplayersx('justmid',$player->nowmid,$sid,$dblj);//更新玩家justmid
            \player\changeplayersx('nowmid',$tpsmid,$sid,$dblj);//更新玩家nowmid
            \player\changeplayersx('tpsmid',0,$sid,$dblj);
            }else{
            \player\changeplayersx('justmid',$player->nowmid,$sid,$dblj);//更新玩家justmid
            \player\changeplayersx('nowmid',$newmid,$sid,$dblj);//更新玩家nowmid
            }
        }
        $player = player\getplayer($sid,$dblj);//获取玩家信息
    }

}
else{
\player\changeplayersx('justmid',$player->nowmid,$sid,$dblj);//更新玩家justmid
}

$clmid = player\getmid($player->nowmid,$dblj);
if($clmid->mlook_event_id !=0){
$parents_cmd = 'gm_scene_new';
events_steps_change($clmid->mlook_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','scene',$clmid->mid,$para);
}
$sql = "select uname,sid,endtime,uis_designer from game1 where nowmid='$player->nowmid' AND sfzx = 1 AND sid !='$sid' and uis_sailing =0";//获取当前地图玩家
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
if (($clmid->mnpc!=''||$clmid->mitem!='') && $minute >= $clmid->mrefresh_time){
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
            $npc_count = \lexical_analysis\process_string($npc_count,$sid);
            $npc_count = \lexical_analysis\process_string($npc_count,$sid);
            @$npc_count = eval("return $npc_count;");
            
            // 更新处理后的值
            $npc_a = "$id|$npc_count";
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
        $guaiwu = \player\getnpc($gwinfo[0],$dblj);
        $guaiwu->nid = $gwinfo[0];
        if($guaiwu->nkill ==1){
        $sql = " delete from system_npc_midguaiwu where nid = '$guaiwu->nid' and nmid = '$player->nowmid' and nsid = ''";
        $cxjg =$dblj->exec($sql);
        for ($n=0;$n<$gwinfo[1];$n++){
            // 要复制的数据行id
            $nid = $guaiwu->nid;
            $nmid = $player->nowmid;
            // 获取旧表字段列表
            $stmt = $dblj->prepare("SHOW COLUMNS FROM system_npc");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            // 构建动态插入语句
            $cols = implode(", ",$columns);
            $nowdate = date('Y-m-d H:i:s');
            $sql = "INSERT INTO system_npc_midguaiwu ($cols, nmid,ncreate_time) SELECT $cols, :nmid ,:nowdate FROM system_npc WHERE nid = :nid;";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':nmid', $nmid, PDO::PARAM_INT);
            $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
            $stmt->bindParam(':nowdate', $nowdate, PDO::PARAM_INT);
            $stmt->execute();
        }
}
    }
    }
    
    if($clmid->mitem!=''){
    $data = $clmid->mitem;
    $items = explode(",", $data); // 使用逗号分隔字符串，得到每个项
    foreach ($items as &$item) {
        $parts = explode("|", $item); // 使用竖线分隔每个项
        if (count($parts) === 2||count($parts) === 3) {
            $id = $parts[0];
            $item_count = $parts[1];
            $item_count = \lexical_analysis\process_string($item_count,$sid);
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
elseif($minute >= $clmid->mrefresh_time){
$sql = "update system_map set mgtime='$nowdate' WHERE mid='$player->nowmid'";
$dblj->exec($sql);
}

$map_detail = $encode->encode("cmd=map_detail&mid=$player->nowmid&sid=$sid");
$change_nowmid = $encode->encode("cmd=gm_post_4&target_midid=$player->nowmid&sid=$sid");

//30-60ms

if($player->ucmd != "pve_fight"){
//30-70ms
for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'scene';
    $mid = $player->nowmid;
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    //var_dump($main_show_cond."<br/>");

    $show_ret = $main_show_cond !== '' 
        ? \lexical_analysis\process_string($main_show_cond, $sid, $oid, $mid, null, null, null) 
        : 1;
    //由于.在php中会被识别为函数省略
    // 将 . 替换为 。
        
    $show_ret = str_replace('.', '。', $show_ret);
    $ret = @eval("return $show_ret;");
    $ret_bool = ($ret !== false && $ret !== null) ? 0 : 1;
    if($ret_bool ==0){
    $main_value = nl2br($main_value);
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    }else{
    $main_value = nl2br($main_value);
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
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
if($ret_bool ==0){
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
    }else {
        $main_target_func = $encode->encode("cmd=func_no_define&parents_page=$parents_page&$parents_cmd=$cmd&sid=$sid");
    }
}
    if($ret_bool ==0){
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
}
}

//100+ms
//渲染页面的函数是吃性能大头。

if($player->uis_designer ==1){
$gm_html = <<<HTML
<a href="?cmd=$change_nowmid">修改当前场景</a><br/>
<a href="?cmd=$change_scenemodule">设计场景模板</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$game_main<br/>
<br/>
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