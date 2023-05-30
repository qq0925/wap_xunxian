<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/22
 * Time: 22:30
 */
$player = \player\getplayer($sid,$dblj);
$tupocmd = $encode->encode("cmd=tupo&canshu=tupo&sid=$sid");
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$tupo = \player\istupo($sid,$dblj);
$tplshtml="";
$tpls = 0;
if ($tupo == 1 ){
    $tpls = $player->ulv * $player->ulv * $player->ulv * 6;
}elseif($tupo == 2){
    $tpls = $player->ulv * ($player->ulv+1) * 4;
}
if ($tupo != 0 ){
    $tplshtml =  "突破需要灵石：$tpls/$player->uyxb<a href='?cmd=$tupocmd'>突破</a> <br/>";
    $upgj = 0;
    $upfy = 0;
    $uphp = 0;
    if (isset($canshu)){
        switch ($canshu){
            case"tupo":
                $ret = \player\changeyxb(2,$tpls,$sid,$dblj);
                if ($ret){
                    $sjs = mt_rand(1,10);
                    if ($sjs <= 5){
                        echo "突破失败<br/>";
                        break;
                    }
                    if ($tupo == 2){
                        $uphp = 2+ round($player->uhp/20);
                        $upgj = 1+ round($player->ugj/12);
                        $upfy = 1+ round($player->ufy/10);
                    }elseif ($tupo == 1){
                        if ($sjs<8){
                            echo "突破失败<br/>";
                            break;
                        }
                        $uphp = 4+ round($player->uhp/16);
                        $upgj = 2+ round($player->ugj/8);
                        $upfy = 3+ round($player->ufy/6);
                    }
                    \player\upplayerlv($sid,$dblj);
                    \player\addplayersx("umaxhp",$uphp,$sid,$dblj);
                    \player\addplayersx("ugj",$upgj,$sid,$dblj);
                    \player\addplayersx("ufy",$upfy,$sid,$dblj);
                    $player = \player\getplayer($sid,$dblj);
                    echo "突破成功获得属性：<br/>攻击+$upgj<br/>防御+$upfy<br/>气血+$uphp<br/>";
                }else{
                    echo "灵石不足<br/>突破需要灵石：$tpls<br/>";
                }
                break;
        }
    }
}

$tupohtml = <<<HTML
======突破======<br/>
当前境界：$player->jingjie$player->cengci<br/>
$tplshtml
<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $tupohtml;
?>

