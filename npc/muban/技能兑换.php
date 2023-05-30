<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/11
 * Time: 16:14
 */
$jnlistcmd = $encode->encode("cmd=npc&nid=$nid&canshu=jnlist&sid=$sid");
$jnlist='<br/>========兑换列表========<br/>';
$gnhtml = <<<HTML
<br/><a href="?cmd=$jnlistcmd">符箓兑换</a><br/>
HTML;
$suoyin = 0;
if (isset($canshu)){
    switch ($canshu){
        case 'jnlist':
            $retjn = \player\getjineng_all($dblj);
            foreach ($retjn as $jn){
                $suoyin += 1;
                $jnid = $jn['jnid'];
                $jnname= $jn['jnname'];
                $jncmd = $encode->encode("cmd=jninfo&jnid=$jnid&sid=$sid");
                $jnlist .= "[$suoyin]<a href='?cmd=$jncmd'>$jnname</a><br/>";
            }
            $gnhtml = $jnlist;
            break;
    }

}