<?php

$playertask = \player\getplayertask($sid,$dblj);
$taskhtml='【我的任务】<br/>';
for ($n=0;$n<@count($playertask);$n++){
    $rwid = $playertask[$n]['tid'];
    $rwnowcount = $playertask[$n]['tnowcount'];
    $rwtype = $playertask[$n]['ttype'];
    $rw_paras = explode(',',$playertask[$n]['ttarget_obj']);
    $rw_player_paras = explode(',',$rwnowcount);
    $rw_check_count = @count($rw_paras);
    $rw_check_done = 0;
    
    $rwstate = $playertask[$n]['tstate'];
    for($i=0;$i<$rw_check_count;$i++){
    $rw_para = explode('|',$rw_paras[$i]);
    $rwtarget_id = $rw_para[0];
    $rwcount = $rw_para[1];
    if($rwtype ==2){
    $rwnowcount = \player\getitem_count($rwtarget_id,$sid,$dblj)['icount'];
    }
    if($rwtype ==1){
    $rw_player_para = explode('|',$rw_player_paras[$i]);
    $rwnowcount = $rw_player_para[1];
    }
    if($rwnowcount >=$rwcount){
    $rw_check_done ++;
    }
    
    }
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $mytaskinfo = $encode->encode("cmd=mytask_info&ucmd=$cmid&rwid=$rwid&sid=$sid");
    $rwname = $playertask[$n]['tname'];
    $rwlx = $playertask[$n]['ttype2'];
    if ($rwlx==1){
        $taskhtml .='[主线]';
    }
    if ($rwlx==2){
        $taskhtml .='[支线]';
    }
    if ($rwlx==3){
        $taskhtml .='[日常]';
    }
if($rw_check_done <$rw_check_count &&$rwstate ==1 ||$rwtype ==3){
    $taskhtml .=<<<HTML
<img src="images/wen.gif"/><a href="?cmd=$mytaskinfo">$rwname</a><br/>
HTML;
}elseif($rw_check_done ==$rw_check_count &&$rwstate ==1 &&$rwtype !=3){
    $taskhtml .=<<<HTML
<img src="images/tan.gif"/><a href="?cmd=$mytaskinfo">$rwname</a><br/>
HTML;
}
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$taskhtml .= <<<HTML
<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $taskhtml;
?>