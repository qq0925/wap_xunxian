<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/17
 * Time: 16:01
 */
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
if (isset($canshu)){
    $getyxb = 0;
    if ($canshu == "maichu1"){
        $ret = \player\deledjsum($djid,1,$sid,$dblj);
        if ($ret){
            $daoju = \player\getdaoju($djid,$dblj);
            \player\changeyxb(1,$daoju->djyxb,$sid,$dblj);
            $getyxb = $daoju->djyxb;
        }
    }
    if ($canshu == "maichu5"){
        $ret = \player\deledjsum($djid,5,$sid,$dblj);
        if ($ret){
            $daoju = \player\getdaoju($djid,$dblj);
            \player\changeyxb(1,$daoju->djyxb*5 ,$sid,$dblj);
            $getyxb = $daoju->djyxb*5;
        }
    }
    if ($canshu == "maichu10"){
        $ret = \player\deledjsum($djid,10,$sid,$dblj);
        if ($ret){
            $daoju = \player\getdaoju($djid,$dblj);
            \player\changeyxb(1,$daoju->djyxb*10 ,$sid,$dblj);
            $getyxb = $daoju->djyxb*10;
        }
    }
    echo "卖出成功，获得{$getyxb}灵石<br/>";
}

$sql = "select * from playerdaoju WHERE sid = '$sid'";
$cxjg = $dblj->query($sql);
if ($cxjg){
    $retdj = $cxjg->fetchAll(PDO::FETCH_ASSOC);
}
$djhtml = '';
$hangshu = 0;
for ($i=0;$i<count($retdj);$i++){
    $djname = $retdj[$i]['djname'];
    $djid = $retdj[$i]['djid'];
    $djsum = $retdj[$i]['djsum'];
    if ($djsum>0){
        $hangshu = $hangshu + 1;
        $chakandj = $encode->encode("cmd=djinfo&djid=$djid&uid=$player->uid&sid=$sid");
        $maichu1 = $encode->encode("cmd=getbagdj&canshu=maichu1&djid=$djid&uid=$player->uid&sid=$sid");
        $maichu5 = $encode->encode("cmd=getbagdj&canshu=maichu5&djid=$djid&uid=$player->uid&sid=$sid");
        $maichu10 = $encode->encode("cmd=getbagdj&canshu=maichu10&djid=$djid&uid=$player->uid&sid=$sid");
        $djhtml .="[$hangshu]<a href='?cmd=$chakandj'>{$djname}x{$djsum}</a><a href='?cmd=$maichu1'>卖出1</a><a href='?cmd=$maichu5'>卖出5</a><a href='?cmd=$maichu10'>卖出10</a><br/>";
    }

}
$getbagzbcmd = $encode->encode("cmd=getbagzb&sid=$sid");
$getbagypcmd = $encode->encode("cmd=getbagyp&sid=$sid");
$getbagjncmd = $encode->encode("cmd=getbagjn&sid=$sid");
$bagdjhtml =<<<HTML
【<a href="?cmd=$getbagzbcmd">装备</a>|道具|<a href="?cmd=$getbagypcmd">药品</a>|<a href="?cmd=$getbagjncmd">符箓</a>】<br/>
<br/>
$djhtml
<br/>
<button onClick="javascript :history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $bagdjhtml;