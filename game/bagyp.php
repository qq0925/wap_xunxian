<?php
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$getbagzbcmd = $encode->encode("cmd=getbagzb&sid=$sid");
$getbagdjcmd = $encode->encode("cmd=getbagdj&sid=$sid");
$getbagjncmd = $encode->encode("cmd=getbagjn&sid=$sid");
$yaopin = player\getplayeryaopinall($sid,$dblj);
$allyp= '';
$suoyin = 0;
if ($yaopin){
    foreach ($yaopin as $yp){
        $ypsum = $yp['ypsum'];
        if ($ypsum > 0){
            $suoyin += 1;
            $ypid = $yp['ypid'];
            $ypname = $yp['ypname'];
            $ypcmd = $encode->encode("cmd=ypinfo&ypid=$ypid&sid=$sid");
            $allyp .= <<<HTML
            [$suoyin].<a href="?cmd=$ypcmd">{$ypname}x$ypsum</a><br/>
HTML;
        }
    }
}

$bagyphtml =<<<HTML
【<a href="?cmd=$getbagzbcmd">装备</a>|<a href="?cmd=$getbagdjcmd">道具</a>|药品|<a href="?cmd=$getbagjncmd">符箓</a>】<br/>
<br/>
$allyp
<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $bagyphtml;

?>