<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/26 0026
 * Time: 18:37
 */
$clubplayer = \player\getclubplayer_once($sid,$dblj);
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$clubhtml= '';
$clubmenu = '';
$renzhihtml='';
$playerlist='';
if (isset($canshu)){
    switch ($canshu){
        case "joinclub":
            if ($clubplayer){
                echo "你已经有门派了<br/>";
                break;
            }
            $sql = "insert into clubplayer(clubid, uid, sid, uclv) VALUES ($clubid,$player->uid,'$sid',6)";
            $row = $dblj->exec($sql);
            $clubplayer = \player\getclubplayer_once($sid,$dblj);
            echo "恭喜你成功加入<br/>";
            break;
        case "outclub":
            if ($clubplayer){
                $sql="delete from clubplayer WHERE sid='$sid'";
                $row = $dblj->exec($sql);
                $clubplayer = \player\getclubplayer_once($sid,$dblj);
            }
            break;
        case "deleteclub":
            if ($clubplayer){
                if ($clubplayer->uclv == 1){
                    $sql="delete from club WHERE clubid='$clubplayer->clubid'";
                    $row = $dblj->exec($sql);
                    $sql="delete from clubplayer WHERE clubid='$clubplayer->clubid'";
                    $row = $dblj->exec($sql);
                    echo "门派解散成功<br/>";
                }
            }
            break;
        case "renzhi":
            if ($clubplayer){
                if (isset($zhiwei)){
                    $sql="select uid from clubplayer WHERE clubid=$clubplayer->clubid AND uclv > $clubplayer->uclv";
                    $ret = $dblj->query($sql);
                    $retuid = $ret->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($retuid as $uiditem){
                        $uid = $uiditem['uid'];
                        if ($uid==$player->uid){
                            continue;
                        }
                        $otherplayer = \player\getplayer1($uid,$dblj);
                        $ucmd = $encode->encode("cmd=club&canshu=zhiwei&zhiwei=$zhiwei&uid=$uid&sid=$sid");
                        $playerlist .= "<a href='?cmd=$ucmd'>{$otherplayer->uname}</a><br/>";

                    }
                   $renzhihtml =  "=========选择任职人员=========<br/>$playerlist<button onClick='javascript :history.back(-1);'>返回上一页</button><br/><a href='?cmd=$gonowmid'>返回游戏</a>";
                    exit($renzhihtml);
                }

                if ($clubplayer->uclv == 1){
                    $no2cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=2&sid=$sid");
                    $no3cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=3&sid=$sid");
                    $no4cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=4&sid=$sid");
                    $no5cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=5&sid=$sid");
                    $no6cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=6&sid=$sid");
                    $renzhihtml = "<a href='?cmd=$no2cmd'>任职副掌门</a><br/><a href='?cmd=$no3cmd'>任职长老</a><br/><a href='?cmd=$no4cmd'>任职执事</a><br/><a href='?cmd=$no5cmd'>任职精英</a><br/><a href='?cmd=$no6cmd'>任职弟子</a><br/>";
                }
                if ($clubplayer->uclv == 2){
                    $no3cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=3&sid=$sid");
                    $no4cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=4&sid=$sid");
                    $no5cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=5&sid=$sid");
                    $no6cmd = $encode->encode("cmd=club&canshu=renzhi&zhiwei=6&sid=$sid");
                    $renzhihtml = "<a href='?cmd=$no3cmd'>任职长老</a><br/><a href='?cmd=$no4cmd'>任职执事</a><br/><a href='?cmd=$no5cmd'>任职精英</a><br/><a href='?cmd=$no6cmd'>任职弟子</a><br/>";
                }
            }
            break;
        case "zhiwei":
            $sql="update clubplayer set uclv = $zhiwei WHERE uid=$uid AND clubid = $clubplayer->clubid";
            $dblj->exec($sql);

    }
}

if (isset($clubid) || $clubplayer){
    if ($clubplayer){
        if (isset($clubid)){
            if ($clubplayer->clubid != $clubid){
                goto noclub;
            }
        }else{
            $clubid = $clubplayer->clubid;
        }
        $outclubcmd = $encode->encode("cmd=club&canshu=outclub&sid=$sid");
        $clubmenu = "<a href='?cmd=$outclubcmd'>判出</a>";
        if ($clubplayer->uclv==1){
            $outclubcmd = $encode->encode("cmd=club&canshu=deleteclub&sid=$sid");
            $renzhicmd = $encode->encode("cmd=club&canshu=renzhi&sid=$sid");
            $clubmenu = "<a href='?cmd=$renzhicmd'>任职</a> <a href='?cmd=$outclubcmd'>解散</a>";
        }
    }else{
        $joincmd = $encode->encode("cmd=club&clubid=$clubid&canshu=joinclub&sid=$sid");
        $clubmenu = "<a href='?cmd=$joincmd'>申请加入</a>";
    }
    noclub:
    $club = \player\getclub($clubid,$dblj);
    $cboss = \player\getplayer1($club->clubno1,$dblj);
    $cbosscmd = $encode->encode("cmd=getplayerinfo&uid=$club->clubno1&sid=$sid");
    $clublist = $encode->encode("cmd=clublist&sid=$sid");
    
    $sql="select uid,uclv from clubplayer WHERE clubid=$clubid ORDER BY uclv ASC ";
    $ret = $dblj->query($sql);
    $retuid = $ret->fetchAll(PDO::FETCH_ASSOC);
    foreach ($retuid as $uiditem){
        $uid = $uiditem['uid'];
        $uclv = $uiditem['uclv'];
        $chenhao = "[弟子]";
        switch ($uclv){
            case 1:
                $chenhao = "[掌门]";
                break;
            case 2:
                $chenhao = "[副掌门]";
                break;
            case 3:
                $chenhao = "[长老]";
                break;
            case 4:
                $chenhao = "[执事]";
                break;
            case 5:
                $chenhao = "[精英]";
                break;
        }
        $otherplayer = \player\getplayer1($uid,$dblj);
        if($uid ==$player->uid){
        $club_msg = "亲爱的"."$chenhao"."，欢迎回到".$club->clubname;
        }
        $ucmd = $encode->encode("cmd=getplayerinfo&uid=$uid&sid=$player->sid");
        $playerlist .= "<a href='?cmd=$ucmd'>{$chenhao}{$otherplayer->uname}</a><br/>";
    }

    $clubhtml =<<<HTML
$club_msg<br/>
门派:$club->clubname<br/>
创建者:<a href="?cmd=$cbosscmd" >$cboss->uname</a><br/>
门派资金:灵石[$club->clubyxb] 极品灵石[$club->clubczb]<br/>
建设度:$club->clubexp<br/>
门派介绍:<br/>$club->clubinfo<br/>
$clubmenu
<a href="?cmd=$clublist">门派列表</a><br/>
$renzhihtml
门派成员：<br/>
$playerlist
<br/>
<button onClick="javascript :history.back(-1);">返回上一页</button><br/> 
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
    //exit($clubhtml);

}

if (!$clubplayer){
    $clublist = $encode->encode("cmd=clublist&sid=$sid");
    $clubhtml =<<<HTML
你现在还没有门派呢！<br/>
<a href="?cmd=$clublist">加入门派</a>
<br/>
<br/>
<a href="?cmd=$gonowmid">返回游戏</a> 
HTML;

}
echo $clubhtml;
?>