<?php
$player = player\getplayer($sid,$dblj);
$tishi = '';
if (isset($canshu)){
    if ($canshu=='maichu'){
        $mczb = \player\getzb($zbnowid,$dblj);
        $sxzz = $mczb->zbgj + $mczb->zbfy + $mczb->zbbj * 5 + $mczb->zbxx * 5 + $mczb->qianghua*3;
        $mcls = round($sxzz);
        $sql = "delete from playerzhuangbei where zbnowid =$zbnowid AND sid='$sid'";//删除装备
        $mcret = $dblj->exec($sql);
        if ($mcret){
            $ret = \player\changeyxb(1,$sxzz/2,$sid,$dblj);
            $tishi = "卖出$mczb->zbname 成功，获得灵石:$mcls<br/>";
        }
    }
}
if (!isset($yeshu)){
    $yeshu = 0;
}
if ($cmd == 'delezb'){
    $zhuangbei = \player\getzb($zbnowid,$dblj);
    $fjls = $zhuangbei->qianghua * 20 + 20;
    $ret = \player\changeyxb(2,$fjls,$sid,$dblj);
    if ($ret){
        $sql = "delete from playerzhuangbei where zbnowid =$zbnowid AND sid='$sid'";//删除装备
        $dblj->exec($sql);
        $qhs = round($zhuangbei->qianghua*$zhuangbei->qianghua);
        $sjs = mt_rand(1,100);
        if ($sjs <= 30){
            $sjs = mt_rand(1,100);
            if ($sjs>90){
                $qhs = $qhs + 3;
            }elseif($sjs>80){
                $qhs = $qhs + 2;
            }elseif ($sjs>70){
                $qhs = $qhs + 1;
            }
        }
        \player\adddj($sid,1,$qhs,$dblj);
        $tishi = '分解成功!<br/>';
        if ($qhs > 0){
            $tishi .= "获得强化石:".$qhs."!<br/>";
        }
    }else{
        $tishi = "灵石不足!<br/>";
    }
}

$sql = "select * from playerzhuangbei  WHERE sid = '$sid' ORDER BY zbid DESC LIMIT $yeshu,10";
$cxjg = $dblj->query($sql);
$retzb = $cxjg->fetchAll(PDO::FETCH_ASSOC);

$sql = "select count(*) from playerzhuangbei where sid = '$sid'";
$cxjg = $dblj->query($sql);
$zbcount = $cxjg->fetchColumn();

$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$zbhtml = '';
$fanye='';
if ($yeshu!=0){
    $shangcanshu=$yeshu-10;
    $shangyiye = $encode->encode("cmd=getbagzb&yeshu=$shangcanshu&sid=$sid");
    $fanye = '<a href="?cmd='.$shangyiye.'">上一页</a>';
}
if ($yeshu +10 < $zbcount){
    $xiacanshu=$yeshu+10;
    $xiayiye = $encode->encode("cmd=getbagzb&yeshu=$xiacanshu&sid=$sid");
    $fanye .= '<a href="?cmd='.$xiayiye.'">下一页</a>';
}
if ($fanye!=''){
    $fanye = '<br/>'.$fanye.'<br/>';
}
$hangshu = 0;
for ($i=0;$i<count($retzb);$i++){
    $zbnowid = $retzb[$i]['zbnowid'];
    $arr = array($player->tool1,$player->tool2,$player->tool3,$player->tool4,$player->tool5,$player->tool6);
    $hangshu = $hangshu + 1;

    $zbname = $retzb[$i]['zbname'];
    $zbnowid = $retzb[$i]['zbnowid'];
    $zbqh = $retzb[$i]['qianghua'];
    $qhhtml = '';
    if($zbqh>0){
        $qhhtml="+".$zbqh;
    }
    $chakanzb = $encode->encode("cmd=chakanzb&zbnowid=$zbnowid&uid=$player->uid&sid=$sid");
    if (!in_array($zbnowid,$arr)){
        $mczb = $encode->encode("cmd=getbagzb&canshu=maichu&yeshu=$yeshu&zbnowid=$zbnowid&sid=$sid");
        $delezb = $encode->encode("cmd=delezb&zbnowid=$zbnowid&sid=$sid");
        $zbhtml .= <<<HTML
        [$hangshu].<a href="?cmd=$chakanzb">$zbname$qhhtml</a><a href="?cmd=$mczb">卖出</a><a href="?cmd=$delezb">分解</a><br/>
HTML;
    }else{
        $zbhtml .= <<<HTML
        [$hangshu].<a href="?cmd=$chakanzb">$zbname$qhhtml</a>(已装备)<br/>
HTML;
    }
}
$getbagdjcmd = $encode->encode("cmd=getbagdj&sid=$sid");
$getbagypcmd = $encode->encode("cmd=getbagyp&sid=$sid");
$getbagjncmd = $encode->encode("cmd=getbagjn&sid=$sid");
$toolhtml =<<<HTML
$tishi
【装备|<a href="?cmd=$getbagdjcmd">道具</a>|<a href="?cmd=$getbagypcmd">药品</a>|<a href="?cmd=$getbagjncmd">符箓</a>】<br/>
<br/>
$zbhtml
$fanye
<br/>
<button onClick="javascript :history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $toolhtml;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 17:56
 */?>

