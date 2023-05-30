<?php
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$getbagzbcmd = $encode->encode("cmd=getbagzb&sid=$sid");
$getbagdjcmd = $encode->encode("cmd=getbagdj&sid=$sid");
$getbagypcmd = $encode->encode("cmd=getbagyp&sid=$sid");
$jineng = \player\getplayerjineng_all($sid,$dblj);

$alljn= '';
$suoyin = 0;
if ($jineng){
    foreach ($jineng as $jn){
        $jnsum = $jn['jncount'];
        if ($jnsum > 0){
            $suoyin += 1;
            $jnid = $jn['jnid'];
            $jnname = $jn['jnname'];
            $jncmd = $encode->encode("cmd=jninfo&jnid=$jnid&sid=$sid");
            $alljn .= <<<HTML
            [$suoyin].<a href="?cmd=$jncmd">$jnname x$jnsum</a><br/>
HTML;
        }
    }
}

$bagyphtml =<<<HTML
【<a href="?cmd=$getbagzbcmd">装备</a>|<a href="?cmd=$getbagdjcmd">道具</a>|<a href="?cmd=$getbagypcmd">药品</a>|符箓】<br/>
<br/>
$alljn
<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $bagyphtml;

?>