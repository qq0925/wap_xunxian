<?php

$player = player\getplayer($sid,$dblj);//获取玩家信息
$lastmid = $player->nowmid;
$gotothefirst = $encode->encode("cmd=gm_game_firstpage&sid=$sid");

if (isset($newmid)){
    if ($player->nowmid!=$newmid){
        $clmid = player\getmid($newmid,$dblj); //获取即将走的地图信息
        $playerinfo = $player->uname."向$clmid->mname 走去";
        if ($playerinfo != $clmid->playerinfo){
            $sql = "update mid set playerinfo='$playerinfo' WHERE mid='$lastmid'";
            $dblj->exec($sql);
        }
        if ($player->uhp<=0){
            $retmid = \player\getmid($player->nowmid,$dblj);
            $retqy = \player\getqy($retmid->mqy,$dblj);
            $gonowmid = $encode->encode("cmd=gomid&newmid=$retqy->mid&sid=$sid");
            if ($newmid != $retqy->mid){
                exit("你已经重伤请治疗<br/>".'<a href="?cmd='.$gonowmid.'">返回游戏</a>');
            }

        }
        \player\changeplayersx('nowmid',$newmid,$sid,$dblj);
        $player = player\getplayer($sid,$dblj);//获取玩家信息
    }

}

if ($player->nowmid=='' || $player->nowmid==0){//判断角色是否出现在非法地图
    $gameconfig = \player\getgameconfig($dblj);
    $sql = "update game1 set nowmid='$gameconfig->firstmid' WHERE sid='$sid'";
    $dblj->exec($sql);
    $player->nowmid=$gameconfig->firstmid;
}
$clmid = player\getmid($player->nowmid,$dblj); //获取地图信息
if ($clmid->playerinfo != ''){
    $clmid->playerinfo .='<br/>';
}
$pvphtml = "[安全区]";
if ($clmid->ispvp){
    $pvphtml = "[PVP]";
}


$ztcmd = $encode->encode("cmd=zhuangtai&sid=$sid");
$goliaotian = $encode->encode("cmd=liaotian&ltlx=all&sid=$sid");
$gonowmid = $encode->encode("cmd=gomid&newmid=$clmid->mid&sid=$sid");
$phcmd = $encode->encode("cmd=paihang&sid=$sid");
$getbagcmd = $encode->encode("cmd=getbagzb&sid=$sid");
$cwcmd = $encode->encode("cmd=chongwu&sid=$sid");
$cxall = '';

$upmidlj = $encode->encode("cmd=gomid&newmid=$clmid->upmid&sid=$sid");//上地图
$downmidlj = $encode->encode("cmd=gomid&newmid=$clmid->downmid&sid=$sid");
$leftmidlj = $encode->encode("cmd=gomid&newmid=$clmid->leftmid&sid=$sid");
$rightmidlj = $encode->encode("cmd=gomid&newmid=$clmid->rightmid&sid=$sid");
$upmid = player\getmid($clmid->upmid,$dblj);
$downmid = player\getmid($clmid->downmid,$dblj);
$leftmid = player\getmid($clmid->leftmid,$dblj);
$rightmid = player\getmid($clmid->rightmid,$dblj);

$lukouhtml ='';
$bosshtml = '';
if ($clmid->midinfo == ''){
    $clmid->midinfo = $clmid->mname;
}


if ($clmid->midboss != 0){
    $boss = \player\getboss($clmid->midboss,$dblj);
    $bossinfo = $encode->encode("cmd=boss&bossid=$boss->bossid&sid=$sid");
    $bosshtml = <<<HTML
    BOSS:<a href="?cmd=$bossinfo">$boss->bossname</a><br/>
HTML;
}
if ($upmid->mname!=''){
    $lukouhtml .= <<<HTML
    北:<a href="?cmd=$upmidlj">$upmid->mname ↑</a><br/>
HTML;
}

if ($leftmid->mname!=''){
    $lukouhtml .= <<<HTML
    西:<a href="?cmd=$leftmidlj">$leftmid->mname ←</a><br/>
HTML;
}

if ($rightmid->mname!=''){
    $lukouhtml .= <<<HTML
    东:<a href="?cmd=$rightmidlj">$rightmid->mname →</a><br/>
HTML;
}

if ($downmid->mname!=''){
    $lukouhtml .= <<<HTML
    南:<a href="?cmd=$downmidlj">$downmid->mname ↓</a><br/>
HTML;
}

$sql = "select * from midguaiwu where mid='$player->nowmid' AND sid = ''";//获取当前地图怪物
$cxjg = $dblj->query($sql);
$cxallguaiwu = $cxjg->rowCount();
$nowdate = date('Y-m-d H:i:s');
$second=floor((strtotime($nowdate)-strtotime($clmid->mgtime))%86400);//获取刷新间隔
if ($second > $clmid->ms  && $cxallguaiwu== 0 && $clmid->mgid!=''){//刷新怪物

    $sql = "update mid set mgtime='$nowdate' WHERE mid='$player->nowmid'";
    $dblj->exec($sql);
    $retgw = explode(",",$clmid->mgid);
    foreach ($retgw as $itemgw){
        $gwinfo = explode("|",$itemgw);
        $guaiwu = \player\getyguaiwu($gwinfo[0],$dblj);
        $guaiwu->gyid = $gwinfo[0];
        $sjexp = mt_rand(6,8) + 0.5;
        $guaiwu->gexp = round($guaiwu->glv * $sjexp,0);
        for ($n=0;$n<$gwinfo[1];$n++){
            $sql = "insert into midguaiwu(mid,gname,glv,ghp,ggj,gfy,gbj,gxx,gexp,gyid,gmaxhp) 
                    values('$player->nowmid',
                    '$guaiwu->gname',
                    '$guaiwu->glv',
                    '$guaiwu->ghp',
                    '$guaiwu->ggj',
                    '$guaiwu->gfy',
                    '$guaiwu->gbj',
                    '$guaiwu->gxx',
                    '$guaiwu->gexp',
                    '$guaiwu->gyid',
                    '$guaiwu->ghp')";
            $cxjg = $dblj->exec($sql);
        }

    }
}
$sql = "select * from midguaiwu where mid='$player->nowmid' AND sid = ''";//获取当前地图怪物
$cxjg = $dblj->query($sql);
$cxallguaiwu = $cxjg->fetchAll(PDO::FETCH_ASSOC);


$gwhtml = '';
for ($i = 0;$i<count($cxallguaiwu);$i++){
    $gwcmd = $encode->encode("cmd=getginfo&gid=".$cxallguaiwu[$i]['id']."&gyid=".$cxallguaiwu[$i]['gyid']."&sid=$sid&nowmid=$player->nowmid");
    $gwhtml .="<a href='?cmd=$gwcmd'>".$cxallguaiwu[$i]['gname']."</a> ";
}

$sql = "select * from game1 where nowmid='$player->nowmid' AND sfzx = 1";//获取当前地图玩家
$cxjg = $dblj->query($sql);
$playerhtml = '';
if ($cxjg){
    $cxallplayer = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    $nowdate = date('Y-m-d H:i:s');
    for ($i = 0;$i<count($cxallplayer);$i++){
        if ($cxallplayer[$i]['uname']!=""){
            $cxtime = $cxallplayer[$i]['endtime'];
            $cxuid = $cxallplayer[$i]['uid'];
            $cxsid = $cxallplayer[$i]['sid'];
            $cxuname = $cxallplayer[$i]['uname'];
            $cxuname = $cxallplayer[$i]['uname'];
            $second=floor((strtotime($nowdate)-strtotime($cxtime))%86400);//获取刷新间隔
            if ($second > 300){
                $sql = "update game1 set sfzx=0 WHERE sid='$cxsid'";
                $dblj->exec($sql);
            }else{
                $clubp = \player\getclubplayer_once($cxsid,$dblj);
                if ($clubp){
                    $club = \player\getclub($clubp->clubid,$dblj);
                    $club->clubname ="[$club->clubname]";
                }else{
                    $club = new \player\club();
                    $club->clubname ="";
                }
                $playercmd = $encode->encode("cmd=getplayerinfo&uid=$cxuid&sid=$sid");
                $playerhtml .="<a href='?cmd=$playercmd'>{$club->clubname}$cxuname</a>";
            }

        }
    }
}


$npchtml='';
$task = \player\getplayerrenwu($sid,$dblj);//玩家任务数组

$sql = "select * from playerrenwu WHERE sid='$sid' AND rwlx = 2";
$cxjg = $dblj->query($sql);
$mrrw = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for ($n=0;$n<count($mrrw);$n++){
    if ($mrrw[$n]['data']!=date('d') ){
        $rwid = $mrrw[$n]['rwid'];
        $sql="delete from playerrenwu WHERE rwid=$rwid AND sid='$sid'";
        $dblj->exec($sql);
    }
}

$sql = "select * from playerrenwu WHERE sid='$sid' AND rwzt!=3";
$cxjg = $dblj->query($sql);
$wtjrw = $cxjg->fetchAll(PDO::FETCH_ASSOC);
$taskcount = count($wtjrw);

if ($clmid->mnpc !=""){
    $sql = "select * from npc where id in ($clmid->mnpc)";//获取npc
    $cxjg = $dblj->query($sql);
    $cxnpcall = $cxjg->fetchAll(PDO::FETCH_ASSOC);

    for ($i=0;$i < count($cxnpcall);$i++){
        $nname = $cxnpcall[$i]['nname'];
        $nid = $cxnpcall[$i]['id'];
        $taskid = $cxnpcall[$i]['taskid'];
        $taskarr = explode(',',$taskid);
        $yrw = false;
        if ($taskid!=''){
            for ($l=0;$l<count($taskarr);$l++){
                $nowrw = \player\gettask($taskarr[$l],$dblj);
                $rwret = \player\getplayerrenwuonce($sid,$taskarr[$l],$dblj);
                $lastrwid = $nowrw->lastrwid;

                if ($nowrw->rwlx == 1 || $nowrw->rwlx == 2){
                    if (!$rwret){
                        if ($nowrw->rwzl != 3){
                            $npchtml .='<img src="images/wen.gif" />';
                        }elseif($nowrw->rwyq == $nid){
                            $npchtml .='<img src="images/wen.gif" />';
                        }else{
                            continue;
                        }
                    }elseif ($rwret->rwzt==2){
                        if ($nowrw->rwzl != 3){
                            $npchtml .='<img src="images/tan.gif" />';
                        }elseif ($nowrw->rwcount == $nid){
                            $npchtml .='<img src="images/tan.gif" />';
                        }else{
                            continue;
                        }

                    }
                }
                if ($nowrw->rwlx == 3){
                    if ($rwret){
                        if ($rwret->rwzt==2){
                            if ($nowrw->rwzl != 3){
                                $npchtml .='<img src="images/tan.gif" />';
                            }elseif ($nowrw->rwcount == $nid){
                                $npchtml .='<img src="images/tan.gif" />';
                            }else{
                                continue;
                            }
                        }
                    }else{
                        if ($lastrwid<=0 ){
                            if ($nowrw->rwzl != 3){
                                $npchtml .='<img src="images/wen.gif" />';
                            }elseif ($nowrw->rwyq == $nid){
                                $npchtml .='<img src="images/wen.gif" />';
                            }else{
                                continue;
                            }
                        }else{
                            $rwret = \player\getplayerrenwuonce($sid,$lastrwid,$dblj);
                            if ($rwret){
                                if ($rwret->rwzt==3){
                                    if ($nowrw->rwzl != 3){
                                        $npchtml .='<img src="images/wen.gif" />';
                                    }elseif ($nowrw->rwyq == $nid){
                                        $npchtml .='<img src="images/wen.gif" />';
                                    }else{
                                        continue;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $npccmd = $encode->encode("cmd=npc&nid=$nid&sid=$player->sid");
        $npchtml.=<<<HTML
        <a href="?cmd=$npccmd">$nname</a><br/>
HTML;
    }
}


$sql = 'SELECT * FROM ggliaotian ORDER BY id DESC LIMIT 2';//聊天列表获取
$ltcxjg = $dblj->query($sql);
$lthtml='';
if ($ltcxjg){
    $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0;$i < count($ret);$i++){
        $uname = $ret[count($ret) - $i-1]['name'];
        $umsg = $ret[count($ret) - $i-1]['msg'];
        $uid = $ret[count($ret) - $i-1]['uid'];
        $ucmd = $encode->encode("cmd=getplayerinfo&uid=$uid&sid=$player->sid");
        if ($uid){
            $lthtml .="[公共]<a href='?cmd=$ucmd''>$uname</a>:$umsg<br/>";
        }else{
            $lthtml .="[公共]<div class='hpys' style='display: inline'>$uname:</div>$umsg<br/>";
        }

    }
}
$mapcmd = $encode->encode("cmd=allmap&sid=$sid");
$xiuliancmd = $encode->encode("cmd=goxiulian&sid=$sid");
$mytask = $encode->encode("cmd=mytask&sid=$sid");
$getbagjncmd = $encode->encode("cmd=getbagjn&sid=$sid");
$fangshi = $encode->encode("cmd=fangshi&fangshi=daoju&sid=$sid");
$clubcmd = $encode->encode("cmd=club&sid=$sid");
$duihuancmd = $encode->encode("cmd=duihuan&sid=$sid");
$imcmd = $encode->encode("cmd=im&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");
$nowhtml = <<<HTML
当前地图:$clmid->mname$pvphtml<a href="?cmd=$mytask">任务($taskcount)</a><a href="?cmd=$gonowmid">刷新</a> <br/>
$npchtml
$bosshtml
你看到:$gwhtml<br/>
请选择路口:<br/>
$lukouhtml
$clmid->mname 的玩家:$playerhtml<br/>
【<a href="?cmd=$mapcmd">查看地图</a>】<br/>
$clmid->playerinfo
<div id="ltmsg">
$lthtml
</div>
$clmid->midinfo<br/>
<a href="?cmd=$ztcmd">状态</a>.<a href="?cmd=$getbagcmd" >包裹</a>.<a href="?cmd=$goliaotian" >聊天</a>.<a href="?cmd=$getbagjncmd" >符箓</a>
<br/>
<a href="?cmd=$phcmd" >排行</a>.<a href="?cmd=$xiuliancmd" >修炼</a>.<a href="?cmd=$fangshi" >坊市</a>.<a href="?cmd=$clubcmd" >门派</a>
<br/>
<a href="?cmd=$imcmd" >好友</a>.<a href="?cmd=$duihuancmd" >兑换码</a>.
<!--.<a href="?cmd=$cwcmd" >宠物</a>.-->
<!--<a href="http://121.40.200.78/alipay/?id=9&user_id=$player->uid" target="_blank">充值</a>-->
<a href="?cmd=$gm" >设计大厅</a>
<br/>
<a href="?cmd=$gotothefirst" >返回首页</a><br/>
HTML;
echo $nowhtml;
?>