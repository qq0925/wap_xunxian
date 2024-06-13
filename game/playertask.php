<?php

$playertask = \player\getplayerrenwu($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$mytaskinfo = '';
$taskhtml='';
$rwzt='';
for ($n=0;$n<count($playertask);$n++){
    $rwid = $playertask[$n]['rwid'];
    $mytaskinfo = $encode->encode("cmd=mytaskinfo&rwid=$rwid&sid=$sid");
    $rwname = $playertask[$n]['rwname'];
    $rwlx = $playertask[$n]['rwlx'];
    if ($rwlx==2 && $playertask[$n]['rwzt']!=3){
        $taskhtml .='[每日]';
    }
    if ($rwlx==3 && $playertask[$n]['rwzt']!=3){
        $taskhtml .='[主线]';
    }
    if ($rwlx==1 && $playertask[$n]['rwzt']!=3){
        $taskhtml .='[普通]';
    }
    switch ($playertask[$n]['rwzt']){
        case 1:
            $taskhtml .=<<<HTML
            <img src="images/wen.gif"/><a href="?cmd=$mytaskinfo">$rwname</a><br/>
HTML;
            break;
        case 2:
            $taskhtml .=<<<HTML
            <img src="images/tan.gif"/><a href="?cmd=$mytaskinfo">$rwname</a><br/>
HTML;
            break;
        case 3:
            break;
    }
}
$taskhtml .= <<<HTML
<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $taskhtml;