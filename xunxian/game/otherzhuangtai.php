<?php
$player = player\getplayer($sid,$dblj);
$player1 = player\getplayer1($uid,$dblj);
$immenu='';

$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$pkcmd = $encode->encode("cmd=pvp&uid=$uid&sid=$sid");
$clubplayer = \player\getclubplayer_once($player1->sid,$dblj);
if (isset($canshu)){
    if ($canshu == "addim"){
        \player\addim($uid,$sid,$dblj);
    }
}

if ($clubplayer){
    $club = \player\getclub($clubplayer->clubid,$dblj);
    $clubcmd = $encode->encode("cmd=club&clubid=$club->clubid&sid=$sid");
    $clubname ="<a href='?cmd=$clubcmd'>$club->clubname</a>";
}else{
    $clubname = "无门无派";
}
if ($player->sid != $player1->sid){
    $im_post = $encode->encode("cmd=sendliaotian&sid=$sid");
    $immenu = "<br/><a href='?cmd=$pkcmd'>攻击</a><br/>";
    $ret = \player\isim($uid,$sid,$dblj);
    if (!$ret){
        $addim=  $encode->encode("cmd=getplayerinfo&canshu=addim&uid=$uid&sid=$sid");
        $immenu.="<a href='?cmd=$addim'>加为好友</a><br/>";
    }else{
        $chat=  $encode->encode("cmd=getplayerinfo&canshu=addim&uid=$uid&sid=$sid");
        $deim=  $encode->encode("cmd=im&canshu=deim&uid=$uid&sid=$sid");
        $immenu.=<<<HTML
        </a><a href='?cmd=$deim'>删除好友</a>
<form action="?cmd=$im_post" method="post">
<input type="hidden" name="ltlx" value="im">
<input type="hidden" name="sid" value="$sid">
<input type="hidden" name="imuid" value="$uid">
<input name="ltmsg">
<input type="submit" value="发送私聊">
</form>

HTML;
    }
    $immenu .= "<br/>";
}

$tool1 = '';
$tool2 = '';
$tool3 = '';
$tool4 = '';
$tool5 = '';
$tool6 = '';

if ($player1->tool1!=0){
    $zhuangbei = player\getzb($player1->tool1,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $zbcmd = $encode->encode("cmd=chakanzb&zbnowid=$player1->tool1&uid=$player1->uid&sid=$sid");
    $tool1 = "武器:<a href='?cmd=$zbcmd'>{$zhuangbei->zbname}{$qhs}</a><br/>";

}
if ($player1->tool2!=0){
    $zhuangbei = player\getzb($player1->tool2,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $zbcmd = $encode->encode("cmd=chakanzb&zbnowid=$player1->tool2&uid=$player1->uid&sid=$sid");
    $tool2 = "头饰:<a href='?cmd=$zbcmd'>{$zhuangbei->zbname}{$qhs}</a><br/>";
}
if ($player1->tool3!=0){
    $zhuangbei = player\getzb($player1->tool3,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $zbcmd = $encode->encode("cmd=chakanzb&zbnowid=$player1->tool3&uid=$player1->uid&sid=$sid");
    $tool3 = "衣服:<a href='?cmd=$zbcmd'>{$zhuangbei->zbname}{$qhs}</a><br/>";
}
if ($player1->tool4!=0){
    $zhuangbei = player\getzb($player1->tool4,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $zbcmd = $encode->encode("cmd=chakanzb&zbnowid=$player1->tool4&uid=$player1->uid&sid=$sid");
    $tool4 = "腰带:<a href='?cmd=$zbcmd'>{$zhuangbei->zbname}{$qhs}</a><br/>";
}
if ($player1->tool5!=0){
    $zhuangbei = player\getzb($player1->tool5,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $zbcmd = $encode->encode("cmd=chakanzb&zbnowid=$player1->tool5&uid=$player1->uid&sid=$sid");
    $tool5 = "首饰:<a href='?cmd=$zbcmd'>{$zhuangbei->zbname}{$qhs}</a><br/>";;
}
if ($player1->tool6!=0){
    $zhuangbei = player\getzb($player1->tool6,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $zbcmd = $encode->encode("cmd=chakanzb&zbnowid=$player1->tool6&uid=$player1->uid&sid=$sid");
    $tool6 = "鞋子:<a href='?cmd=$zbcmd'>{$zhuangbei->zbname}{$qhs}</a><br/>";;
}

$html = <<<HTML
==寻仙纪 状态==<br/>
昵称:$player1->uname<br/>
id:$player1->uid<br/>
门派:$clubname<br/>
境界:$player1->jingjie$player1->cengci<br/>
等级:$player1->ulv<br/>
修为:$player1->uexp/$player1->umaxexp<br/>
灵石:$player1->uyxb<br/>
极品灵石:$player1->uczb<br/>
气血:$player1->uhp/$player1->umaxhp<br/>
攻击:$player1->ugj<br/>
防御:$player1->ufy<br/>
暴击:$player1->ubj%<br/>
吸血:$player1->uxx%<br/>
========<br/>
$tool1
$tool2
$tool3
$tool4
$tool5
$tool6
$immenu
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="game.php?cmd=$gonowmid">返回游戏</a>
HTML;
echo $html;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/14
 * Time: 18:10
 */?>