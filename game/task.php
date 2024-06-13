<?php
$task = \player\gettask($rwid,$dblj);
$player = \player\getplayer($sid,$dblj);
$ptask = \player\getplayerrenwuonce($sid,$rwid,$dblj);
$rwdjarr = explode(',',$task->rwdj);
$rwyparr = explode(',',$task->rwyp);
$rwjlhtml = '任务奖励：<br/>';
$jldjidarr = array();
$jldjslarr = array();
$jlypidarr = array();
$jlypslarr = array();
$jlzbslarr = array();

$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$jieshourw = $encode->encode("cmd=task&nid=$nid&canshu=jieshou&rwid=$rwid&sid=$sid");
$tijiaorw = $encode->encode("cmd=task&nid=$nid&canshu=tijiao&rwid=$rwid&sid=$sid");
$rwhtml = '';
$tishi = '';
if ($ptask){
    if ($ptask->rwzt == 3){
        echo "<a href=\"?cmd=$gonowmid\">返回游戏</a>";
        exit();
    }
}

if ($task->rwdj!=''){
    for ($i=0;$i<count($rwdjarr);$i++){
        $djarr = explode('|',$rwdjarr[$i]);
        $djid = $djarr[0];
        $djcount = $djarr[1];
        array_push($jldjidarr,$djid);
        array_push($jldjslarr,$djcount);
        $rwdj = \player\getdaoju($djid,$dblj);
        $djinfo = $encode->encode("cmd=djinfo&djid=$rwdj->djid&sid=$sid");
        $rwjlhtml .="<div class='djys'><a href='?cmd=$djinfo'>$rwdj->djname</a>x$djcount</div>";
    }
}

if ($task->rwyp!=''){
    for ($i=0;$i<count($rwyparr);$i++){
        $yparr = explode('|',$rwyparr[$i]);
        $ypid = $yparr[0];
        $ypcount = $yparr[1];
        array_push($jlypidarr,$ypid);
        array_push($jlypslarr,$ypcount);
        $rwyp = \player\getyaopinonce($ypid,$dblj);
        $ypcmd = $encode->encode("cmd=ypinfo&ypid=$ypid&sid=$sid");
        $rwjlhtml .= "<div class='ypys'><a href='?cmd=$ypcmd'>$rwyp->ypname</a>x$ypcount</div>";
    }
}

if ($task->rwzb!=''){
    $sql = "select * from zhuangbei where zbid IN ($task->rwzb)";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0;$i<count($ret);$i++){
        $zbid = $ret[$i]['zbid'];
        $zbname = $ret[$i]['zbname'];
        array_push($jlzbslarr,$zbid);
        $zbkzb = \player\getzbkzb($zbid,$dblj);
        $zbcmd = $encode->encode("cmd=zbinfo_sys&zbid=$zbkzb->zbid&sid=$sid");
        $rwjlhtml.="<div class='zbys'><a href='?cmd=$zbcmd'>$zbname</a></div>";
    }
}
if ($task->rwexp!=''){
    $rwjlhtml.="经验：$task->rwexp<br/>";
}
if ($task->rwyxb!=''){
    $rwjlhtml.="灵石：$task->rwyxb<br/>";
}


if (isset($canshu)){
    switch ($canshu){
        case 'jieshou':
            if ($ptask){
                $tishi = '请不要重复接取任务';
                break;
            }
            $day = 0;
            if ($task->rwlx==2){
                $day = date('d');
            }
            $sql = "insert into playerrenwu(rwname,rwzl,rwdj,rwzb,rwexp,rwyxb,sid,rwzt,rwid,rwyq,rwcount,rwlx,`data`) VALUES ('$task->rwname','$task->rwzl','$task->rwdj','$task->rwzb','$task->rwexp','$task->rwyxb','$sid','1','$rwid','$task->rwyq','$task->rwcount','$task->rwlx',$day)";
            $ret = $dblj->exec($sql);
            $tishi = '接受成功';
            if ($task->rwzl==1){
                $daoju = \player\getplayerdaoju($sid,$task->rwyq,$dblj);
                if ($daoju){
                    if ($daoju->djsum>0){
                        \player\changerwyq($rwid,$daoju->djsum,$sid,$dblj);
                    }
                }
            }
            if ($task->rwzl==3){
                $sql = "update `playerrenwu` set rwzt = 2 WHERE rwid = $rwid and sid ='$sid'";
                $dblj->exec($sql);
            }
            break;
        case 'tijiao':
            if ($ptask->rwid==$rwid && $ptask->rwzt == 2){
                if ($ptask->rwnowcount>= $ptask->rwcount || $ptask->rwzl == 3){
                    $sql = "update playerrenwu set rwzt=3,rwnowcount=0 WHERE sid='$sid' AND rwid = $rwid";
                    $dblj->exec($sql);
                    \player\changeexp($sid,$dblj,$task->rwexp);
                    \player\changeyxb(1,$task->rwyxb,$sid,$dblj);
                    if ($ptask->rwzl==1){
                        \player\deledjsum($ptask->rwyq,$ptask->rwcount,$sid,$dblj);
                    }
                    for ($i=0;$i<count($jldjidarr);$i++){
                        \player\adddj($sid,$jldjidarr[$i],$jldjslarr[$i],$dblj);
                    }
                    for ($i=0;$i<count($jlypidarr);$i++){
                        \player\addyaopin($sid,$jlypidarr[$i],$jlypslarr[$i],$dblj);
                    }
                    foreach ($jlzbslarr as $jlzbid){
                        \player\addzb($sid,$jlzbid,$dblj);
                    }
                    echo "任务完成,获得：<br/>$rwjlhtml<a href=\"?cmd=$gonowmid\">返回游戏</a>";
                    exit();
                }

            }
            break;

    }
}

switch ($task->rwzl){
    case 1://收集
        $rwyq = \player\getdaoju($task->rwyq,$dblj);
        $rwhtml ="收集$task->rwcount$rwyq->djname";
        break;
    case 2://打怪
        $gwmid = new \player\clmid();
        $rwyq = \player\getyguaiwu($task->rwyq,$dblj);
        $rwhtml ="击杀$task->rwcount$rwyq->gname";
        break;
    case 3://对话
        $tjnpc = \player\getnpc($task->rwcount,$dblj);
        $rwhtml ="去找$tjnpc->nname";
        break;
}
$ptask = \player\getplayerrenwuonce($sid,$rwid,$dblj);
$rwzthtml='';
    if ($ptask){
        if($ptask->rwzl != 3){
            $rwzthtml = "进度：$ptask->rwnowcount/$ptask->rwcount<br/>";
            $rwzthtml.= '<a href="?cmd='.$tijiaorw.'">提交</a>';
        }elseif($ptask->rwcount == $nid){
            $rwzthtml.= '<a href="?cmd='.$tijiaorw.'">提交</a>';
        }
    }else{
        $rwzthtml = <<<HTML
        <a href="?cmd=$jieshourw">接受</a>
HTML;
    }

$taskhtml = <<<HTML
【$task->rwname 】:<br/>
$task->rwinfo<br/>
$rwhtml<br/>
$tishi<br/>
$rwjlhtml<br/>
$rwzthtml<br/>
<a href="?cmd=$gonowmid">返回游戏</a>

HTML;
echo $taskhtml;
?>