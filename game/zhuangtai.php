<?php
$player = player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$getbagzbcmd = $encode->encode("cmd=getbagzb&sid=$sid");
//$clubplayer = \player\getclubplayer_once($sid,$dblj);
//if ($clubplayer){
//    $club = \player\getclub($clubplayer->clubid,$dblj);
//    $clubcmd = $encode->encode("cmd=club&sid=$sid");
//    $clubname ="<a href='?cmd=$clubcmd'>$club->clubname</a>";
//}else{
//    $clubname = "无门无派";
//}
if ($cmd == 'xxzb'){
    if (isset($zbwz)){
        $sql = "update game1 set tool$zbwz = 0 WHERE sid = '$sid'";
        $dblj->exec($sql);
        $player = player\getplayer($sid,$dblj);
    }
}
if ($cmd == 'setzbwz'){
    $arr = array($player->tool1,$player->tool2,$player->tool3,$player->tool4,$player->tool5,$player->tool6);
    if (isset($zbnowid) && isset($zbwz)){
        if (!in_array($zbnowid,$arr)){
            $nowzb = \player\getzb($zbnowid,$dblj);
            if ($nowzb->uid != $player->uid){
                echo "你没有该装备，无法装备<br/>";

            }elseif($nowzb->zblv - $player->ulvl > 5){
                echo "装备大于玩家等级，无法装备<br/>";
            }elseif($nowzb->tool!=$zbwz && $nowzb->tool){
                echo "装备种类不符合,无法装备<br/>";
            }else{
                $sql = "update game1 set tool{$zbwz} = $zbnowid WHERE sid = '$sid'";
                $dblj->exec($sql);
                $player = player\getplayer($sid,$dblj);
            }

        }
    }
}

$tool1 = '';
$tool2 = '';
$tool3 = '';
$tool4 = '';
$tool5 = '';
$tool6 = '';

if ($player->tool1!=0){
    $zhuangbei = player\getzb($player->tool1,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $xxzb1 = '<a href="?cmd='.$encode->encode("cmd=xxzb&zbwz=1&sid=$sid").'">卸下</a>';
    $tool1 = '<a href="?cmd='.$encode->encode("cmd=chakanzb&zbnowid=$player->tool1&uid=$player->uid&sid=$sid").'">'.$zhuangbei->zbname.$qhs.'</a>'.$xxzb1;
}
if ($player->tool2!=0){
    $zhuangbei = player\getzb($player->tool2,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $xxzb2 = '<a href="?cmd='.$encode->encode("cmd=xxzb&zbwz=2&sid=$sid").'">卸下</a>';
    $tool2 = '<a href="?cmd='.$encode->encode("cmd=chakanzb&zbnowid=$player->tool2&uid=$player->uid&sid=$sid").'">'.$zhuangbei->zbname.$qhs.'</a>'.$xxzb2;
}
if ($player->tool3!=0){
    $zhuangbei = player\getzb($player->tool3,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $xxzb3 = '<a href="?cmd='.$encode->encode("cmd=xxzb&zbwz=3&sid=$sid").'">卸下</a>';
    $tool3 = '<a href="?cmd='.$encode->encode("cmd=chakanzb&zbnowid=$player->tool3&uid=$player->uid&sid=$sid").'">'.$zhuangbei->zbname.$qhs.'</a>'.$xxzb3;
}
if ($player->tool4!=0){
    $zhuangbei = player\getzb($player->tool4,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $xxzb4 = '<a href="?cmd='.$encode->encode("cmd=xxzb&zbwz=4&sid=$sid").'">卸下</a>';
    $tool4 = '<a href="?cmd='.$encode->encode("cmd=chakanzb&zbnowid=$player->tool4&uid=$player->uid&sid=$sid").'">'.$zhuangbei->zbname.$qhs.'</a>'.$xxzb4;
}
if ($player->tool5!=0){
    $zhuangbei = player\getzb($player->tool5,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $xxzb5 = '<a href="?cmd='.$encode->encode("cmd=xxzb&zbwz=5&sid=$sid").'">卸下</a>';
    $tool5 = '<a href="?cmd='.$encode->encode("cmd=chakanzb&zbnowid=$player->tool5&uid=$player->uid&sid=$sid").'">'.$zhuangbei->zbname.$qhs.'</a>'.$xxzb5;
}
if ($player->tool6!=0){
    $zhuangbei = player\getzb($player->tool6,$dblj);
    $qhs = '';
    if ($zhuangbei->qianghua>0){
        $qhs = '+'.$zhuangbei->qianghua;
    }
    $xxzb6 = '<a href="?cmd='.$encode->encode("cmd=xxzb&zbwz=6&sid=$sid").'">卸下</a>';
    $tool6 = '<a href="?cmd='.$encode->encode("cmd=chakanzb&zbnowid=$player->tool6&uid=$player->uid&sid=$sid").'">'.$zhuangbei->zbname.$qhs.'</a>'.$xxzb6;

}

$html = <<<HTML
==寻仙纪 状态==<br/>
昵称:[$player->unick_name]$player->uname<br/>
id:$player->uid<br/>
境界:$player->jingjie$player->cengci<br/>
等级:$player->ulvl<br/>
修为:$player->uexp/$player->umaxexp<br/>
灵石:$player->umoney<br/>
极品灵石:$player->uczb<br/>
气血:$player->uhp/$player->umaxhp<br/>
攻击:$player->ugj<br/>
防御:$player->ufy<br/>
暴击:$player->ubj%<br/>
吸血:$player->uxx%<br/>
=========<br/>
武器:$tool1<br/>
头饰:$tool2<br/>
衣服:$tool3<br/>
腰带:$tool4<br/>
首饰:$tool5<br/>
鞋子:$tool6<br/><br/>
<a href="?cmd=$getbagzbcmd">装备</a>
<br/><br/>
<button onClick="javascript :history.back(-1);">返回上一页</button><br/>
<a href="game.php?cmd=$gonowmid">返回游戏</a>
HTML;
echo $html;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/10
 * Time: 17:34
 */?>