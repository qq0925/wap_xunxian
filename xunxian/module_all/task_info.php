<?php
$playertask = \player\getplayertask($sid,$dblj,$rwid);
$task_nowcount = $playertask[0]['tnowcount'];
$task_cmmt2 =  $playertask[0]['tcmmt2'];
$task_cmmt2 =\lexical_analysis\process_string($task_cmmt2,$sid);
$task_cmmt2 = nl2br($task_cmmt2);
$task_cmmt2 =\lexical_analysis\color_string($task_cmmt2);
$task_name = $playertask[0]['tname'];
$task_type = $playertask[0]['ttype'];
$task_objs = $playertask[0]['ttarget_obj'];

$task_obj = explode(",",$task_objs);
$task_now_obj = explode(",",$task_nowcount);

$rwhtml .="{$task_cmmt2}<br/>";

for ($i = 0; $i < count($task_obj); $i++) {
    $task_obj_infos = $task_obj[$i];
    $task_obj_now_infos = $task_now_obj[$i];
    $task_obj_info = explode("|", $task_obj_infos);
    $task_obj_now_info = explode("|", $task_obj_now_infos);
    $task_obj_id = $task_obj_info[0];
    $task_obj_now_id = $task_obj_now_info[0];
    $task_obj_now_count = $task_obj_now_info[1];
    $task_obj_now_count = $task_obj_now_count ==''?0:$task_obj_now_count;
    $task_obj_count = $task_obj_info[1];
    switch ($task_type) {
        case 1: // 打怪
            $task_obj_name = \player\getnpc($task_obj_id, $dblj);
            $task_obj_name = $task_obj_name->nname;
            $task_obj_name =\lexical_analysis\color_string($task_obj_name);
            $rwhtml .= "击杀[{$task_obj_name}({$task_obj_now_count}/{$task_obj_count})]<br/>";
            break;
        case 2: // 收集
            $task_obj_name = \player\getitem($task_obj_id, $dblj);
            $task_nowcount = \player\getitem_count($task_obj_id,$sid,$dblj)['icount'];
            $task_nowcount = $task_nowcount ==''?0:$task_nowcount;
            $task_obj_name = $task_obj_name->iname;
            $task_obj_name =\lexical_analysis\color_string($task_obj_name);
            $rwhtml .= "收集[{$task_obj_name}({$task_nowcount}/{$task_obj_count})]<br/>";
            break;
        case 3: // 对话
        $task_obj_name =\lexical_analysis\color_string($task_obj_name);
            break;
    }
}

$player = \player\getplayer($sid,$dblj);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$player->nowmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gotask_list = $encode->encode("cmd=mytask_2&ucmd=$cmid&sid=$sid");
$taskinfo = <<<HTML
【我的任务】<br/>
{$task_name}:<br/>
$rwhtml<br/>
<a href="?cmd=$gotask_list">返回任务列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $taskinfo;
?>