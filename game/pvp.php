<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/21
 * Time: 22:22
 */
//if (!isset($uid)){
//
//}
$cxmid = \player\getmid($player->nowmid,$dblj);
$cxqy = \player\getqy($cxmid->mqy,$dblj);
$gorehpmid = $encode->encode("cmd=gomid&newmid=$cxqy->mid&sid=$player->sid");
$player = \player\getplayer($sid,$dblj);
$pvper = \player\getplayer1($uid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$player->sid");
if ($cxmid->ispvp == 0){
    \player\changeplayersx("ispvp",0,$sid,$dblj);
    $tishihtml = '当前地图不允许PK<br/><br/>'.
        '<a href="?cmd='.$gonowmid.'">返回游戏</a>';
    exit($tishihtml);;
}

if ($pvper->sfzx == 0){
    \player\changeplayersx("ispvp",0,$sid,$dblj);
    $tishihtml = '该玩家没有在线<br/><br/>'.
        '<a href="?cmd='.$gonowmid.'">返回游戏</a>';
    exit($tishihtml);;
}
if ($pvper->nowmid != $player->nowmid){
    \player\changeplayersx("ispvp",0,$sid,$dblj);
    $tishihtml = '该玩家没在该地图<br/><br/>'.
        '<a href="?cmd='.$gonowmid.'">返回游戏</a>';
    exit($tishihtml);
}
if ($player->uhp<=0){
    \player\changeplayersx("ispvp",0,$sid,$dblj);
    $tishihtml = '你是重伤之身,无法进行战斗<br/><br/>'.
        '<a href="?cmd='.$gorehpmid.'">返回游戏</a>';
    exit($tishihtml);
}
if ($pvper->uhp<=0){
    \player\changeplayersx("ispvp",0,$sid,$dblj);
    $tishihtml = '该玩家已经死亡<br/><br/>'.
        '<a href="?cmd='.$gonowmid.'">返回游戏</a>';
    exit($tishihtml);
}
//\player\changeplayersx("ispvp",$pvper->uid,$sid,$dblj);
\player\changeplayersx("ispvp",$player->uid,$pvper->sid,$dblj);
$pvperhurt = '';
$tishihtml = '';
$pvpbj = '';
if (isset($canshu)){
    switch ($canshu){
        case 'gj':
            $jineng = new \player\jineng();
            if (isset($jnid)){
                $ret = \player\delejnsum($jnid,1,$sid,$dblj);
                if ($ret){
                    $jineng = \player\getplayerjineng($jnid,$sid,$dblj);
                    $tishihtml = "使用技能：$jineng->jnname<br/>";
                }else{
                    $tishihtml = "技能数量不足<br/>";
                }
            }
            $player->ugj +=$jineng->jngj;
            $player->ufy +=$jineng->jnfy;
            $player->ubj +=$jineng->jnbj;
            $player->uxx +=$jineng->jnxx;

            $ran = mt_rand(1,100);
            if ($player->ubj >= $ran){
                $player->ugj = round($player->ugj * 1.82);
                $pvpbj = '暴击';
            }

            $pvperhurt = round($player->ugj - $pvper->ufy * 0.75,0);
            if ($pvperhurt < $player->ugj * 0.05){
                $pvperhurt = round($player->ugj*0.05);
            }

            $pvpxx = round($pvperhurt*($player->uxx/100));

            $sql = "update game1 set uhp = uhp - $pvperhurt  WHERE sid = '$pvper->sid'";
            $dblj->exec($sql);


            \player\addplayersx("uhp",$pvpxx,$sid,$dblj);

            $player =  player\getplayer($sid,$dblj);
            if ($player->uhp > $player->umaxhp){
                \player\changeplayersx("uhp",$player->umaxhp,$sid,$dblj);
                $player =  player\getplayer($sid,$dblj);
            }
            $pvper = \player\getplayer1($uid,$dblj);
            $pvperhurt = '-'.$pvperhurt;
            if ($pvper->uhp<=0){
                \player\changeplayersx("ispvp",0,$sid,$dblj);
                \player\changeplayersx("ispvp",0,$pvper->sid,$dblj);
                $dieinfo = ["听说 $player->uname 打死了 $pvper->uname","$pvper->uname 被 $player->uname 打的落花流水"," $player->uname 把 $pvper->uname 打得生活不能自理"];
                $randdie = mt_rand(0,count($dieinfo)-1);
                $msg = $dieinfo[$randdie];
                $sql = "insert into ggliaotian(name,msg,uid) values('百晓生','$msg','0')";
                $cxjg = $dblj->exec($sql);
                $html = '
                    战斗结果:<br/>
                    你打死了'.$pvper->uname.'<br/>
                    战斗胜利！<br/>
                    <a href="?cmd='.$gonowmid.'">返回游戏</a>';
                exit($html);
            }
            break;
    }
}

if ($player->uhp<=0){
    $cxmid = \player\getmid($player->nowmid,$dblj);
    $cxqy = \player\getqy($cxmid->mqy,$dblj);
    \player\changeplayersx("ispvp",0,$sid,$dblj);
    \player\changeplayersx("ispvp",0,$pvper->sid,$dblj);
    $html = <<<HTML
            战斗结果:<br/>
            你被$guaiwu->gname 打死了<br/>
            战斗失败！<br/>
            请少侠重来<br/>
            <br/>
            <a href="?cmd=$gorehpmid">返回游戏</a>
HTML;
    exit($html);
}

$pgjcmd = $encode->encode("cmd=pvp&canshu=gj&uid=$uid&sid=$player->sid");

$usejn1 = $encode->encode("cmd=pvp&canshu=usejn&jnid=$player->jn1&sid=$sid&uid=$uid");
$usejn2 = $encode->encode("cmd=pvp&canshu=usejn&jnid=$player->jn2&sid=$sid&uid=$uid");
$usejn3 = $encode->encode("cmd=pvp&canshu=usejn&jnid=$player->jn3&sid=$sid&uid=$uid");

$jnname1 = '符箓1';
$jnname2 = '符箓2';
$jnname3 = '符箓3';


if ($player->jn1!=0){
    $jineng = \player\getplayerjineng($player->jn1,$sid,$dblj);
    if ($jineng){
        $jnname1 = $jineng->jnname.'('.$jineng->jncount.')';
    }
}
if ($player->jn2!=0){
    $jineng = \player\getplayerjineng($player->jn2,$sid,$dblj);
    if ($jineng){
        $jnname2 = $jineng->jnname.'('.$jineng->jncount.')';
    }
}
if ($player->jn3!=0){
    $jineng = \player\getplayerjineng($player->jn3,$sid,$dblj);;
    if ($jineng){
        $jnname3 = $jineng->jnname.'('.$jineng->jncount.')';
    }
}

$html = <<<HTML
==战斗==<br/>
$pvper->uname [lv:$pvper->ulv]<br/>
气血:(<div class="hpys" style="display: inline">$pvper->uhp</div>/<div class="hpys" style="display: inline">$pvper->umaxhp</div>)$pvpbj $pvperhurt<br/>
攻击:($pvper->ugj)<br/>
防御:($pvper->ufy)<br/>
===================<br/>
$player->uname [lv:$player->ulv]<br/>
气血:(<div class="hpys" style="display: inline">$player->uhp</div>/<div class="hpys" style="display: inline">$player->umaxhp</div>)<br/>
攻击:($player->ugj)<br/>
防御:($player->ufy)<br/>
$tishihtml
<ul>
<li><a href="?cmd=$pgjcmd">攻击</a></li><br/>
<li><a href="?cmd=$gonowmid">逃跑</a></li>
</ul>
<a href="?cmd=$usejn1">$jnname1</a>.<a href="?cmd=$usejn2">$jnname2</a>.<a href="?cmd=$usejn3">$jnname3</a><br/>
<br/>
HTML;
echo $html;
