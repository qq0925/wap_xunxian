<?php
$player =  player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$player->sid");
$cxmid = \player\getmid($player->nowmid,$dblj);
$cxqy = \player\getqy($cxmid->mqy,$dblj);

$gorehpmid = $encode->encode("cmd=gomid&newmid=$cxqy->mid&sid=$player->sid");
$rwts = '';
$cwhtml='';
$pgjcmd = $encode->encode("cmd=pvegj&gid=$gid&sid=$player->sid&nowmid=$nowmid");
$guaiwu = player\getguaiwu($gid,$dblj);
$yguaiwu = new \player\guaiwu();
if ($guaiwu->gyid){
    $yguaiwu = player\getyguaiwu($guaiwu->gyid,$dblj);
}

$huode = '';
$useyp1 = $encode->encode("cmd=pve&canshu=useyp&ypid=$player->yp1&sid=$sid&gid=$gid&nowmid=$nowmid");
$useyp2 = $encode->encode("cmd=pve&canshu=useyp&ypid=$player->yp2&sid=$sid&gid=$gid&nowmid=$nowmid");
$useyp3 = $encode->encode("cmd=pve&canshu=useyp&ypid=$player->yp3&sid=$sid&gid=$gid&nowmid=$nowmid");

$usejn1 = $encode->encode("cmd=pvegj&canshu=usejn&jnid=$player->jn1&sid=$sid&gid=$gid&nowmid=$nowmid");
$usejn2 = $encode->encode("cmd=pvegj&canshu=usejn&jnid=$player->jn2&sid=$sid&gid=$gid&nowmid=$nowmid");
$usejn3 = $encode->encode("cmd=pvegj&canshu=usejn&jnid=$player->jn3&sid=$sid&gid=$gid&nowmid=$nowmid");

$ypname1 = '药品1';
$ypname2 = '药品2';
$ypname3 = '药品3';

$jnname1 = '符箓1';
$jnname2 = '符箓2';
$jnname3 = '符箓3';

$cwhurt = '';
$tishihtml='';
if ($nowmid!=$player->nowmid){
    $html = <<<HTML
        请正常玩游戏！<br/>
        <br/>
        <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
    echo $html;
    exit();
}

if (($guaiwu->sid!=$player->sid && $guaiwu->sid!='') || ($guaiwu->gid=='')){
        $html = <<<HTML
        怪物已经被其他人攻击了！<br/>
        请少侠练习一下手速哦
        <br/>
        <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
        exit($html);
}
$pvebj = '';
$pvexx = '';

if (isset($canshu)){

    if ($canshu == 'useyp'){
        $ret = \player\useyaopin($ypid,1,$sid,$dblj);
        $player =  player\getplayer($sid,$dblj);
    }
}

if($cmd=='pve' && $guaiwu->sid==''){

    if ($player->ulv >= 10 && $player->uhp <=0){
        $zdjg = -1;
    }else{
        $sql = "update midguaiwu set sid = '$sid' WHERE id='$gid'";
        $dblj->exec($sql);
        $cw = \player\getchongwu($player->cw,$dblj);
        \player\changecwsx('cwhp',$cw->cwmaxhp,$player->cw,$dblj);
        if($player->ulv <= 10){
            \player\changeplayersx('uhp',$player->umaxhp,$sid,$dblj);
            $player =  player\getplayer($sid,$dblj);
        }
    }

}elseif ($cmd == 'pvegj' && $gid != 0){
    //普通攻击
    $hurt = false;
    $ghurt = 0;
    $jineng = new \player\jineng();

    if (isset($canshu)){
        switch ($canshu){
            case 'usejn':
                $ret = \player\delejnsum($jnid,1,$sid,$dblj);
                if ($ret){
                    $jineng = \player\getplayerjineng($jnid,$sid,$dblj);
                    $tishihtml = "使用技能：$jineng->jnname<br/>";
                }else{
                    $tishihtml = "技能数量不足<br/>";
                }

                break;
        }
    }

    $player->ugj +=$jineng->jngj;
    $player->ufy +=$jineng->jnfy;
    $player->ubj +=$jineng->jnbj;
    $player->uxx +=$jineng->jnxx;

    $lvc = $player->ulvl - $guaiwu->glv;
    if ($lvc <= 0){
        $lvc = 0;
    }

    $phurt = 0 ;

    $phurt = round($guaiwu->ggj - ($player->ufy * 0.75),0);
    if ($phurt<$guaiwu->ggj*0.15){
        $phurt = round($guaiwu->ggj*0.15);
    }

    $ran = mt_rand(1,100);
    if ($player->ubj >= $ran){
        $player->ugj = round($player->ugj * 1.72);
        $pvebj = '暴击';
    }

    $gphurt = round($player->ugj - ($guaiwu->gfy * 0.75),0);
    if ($gphurt < $player->ugj*0.15){
        $gphurt = round( $player->ugj * 0.15);
    }
    $pvexx = ceil($gphurt * ($player->uxx/100) );

    if ($phurt <= 0){
        $hurt = true;
    }

    if ($phurt < $pvexx){
        $pvexx = $phurt - 7;

        if ($pvexx<0){
            $pvexx = 0;
        }
    }

    $sql = "update midguaiwu set ghp = ghp - {$gphurt} WHERE id='$gid'";
    $dblj->exec($sql);
    $guaiwu = player\getguaiwu($gid,$dblj);
    if ($guaiwu->ghp<=0){//怪物死亡
        $sql = "delete from midguaiwu where id = $gid AND sid='$player->sid'";
        $dblj->exec($sql);

        $yxb = round($guaiwu->glv/2.9) + 1;
        if ($hurt || $lvc >=5){
            $yxb = 0;
        }

        $ret = \player\changeyxb(1,$yxb,$sid,$dblj);
        if ($ret){
            $huode .= "获得灵石:$yxb<br/>";
        }
        $taskarr = \player\getplayerrenwu($sid,$dblj);
        \player\changerwyq1(2,$guaiwu->gyid,1,$sid,$dblj);
        for ($i=0;$i<count($taskarr);$i++){
            $rwyq = $taskarr[$i]['rwyq'];
            $rwid = $taskarr[$i]['rwid'];
            $rwzl = $taskarr[$i]['rwzl'];
            $rwzt = $taskarr[$i]['rwzt'];
            if ($rwyq==$guaiwu->gyid && $rwzl==2 && $rwzt!=3){
                $rwnowcount = $taskarr[$i]['rwnowcount']+ 1;
                $rwts = $taskarr[$i]['rwname'].'('.$rwnowcount."/".$taskarr[$i]['rwcount'].')<br/>';
                break;
            }
        }

        $sjjv = mt_rand(1,120);
        if ($yguaiwu->dljv >=$sjjv && $yguaiwu->gzb != ''){
            $sql = "select * from zhuangbei WHERE zbid in ($yguaiwu->gzb)";
            $cxdljg = $dblj->query($sql);
            if ($cxdljg){
                $retzb = $cxdljg->fetchAll(PDO::FETCH_ASSOC);
                $sjdl = mt_rand(0,count($retzb)-1);
                $zbname = $retzb[$sjdl]['zbname'];
                $zbid = $retzb[$sjdl]['zbid'];
                $zbnowid = player\addzb($sid,$zbid,$dblj);
                $chakanzb = $encode->encode("cmd=chakanzb&zbnowid=$zbnowid&uid=$player->uid&sid=$sid");
                $huode .= "获得:<div class='zbys'>".'<a href="?cmd='.$chakanzb.'">'.$zbname .'</a></div>';
            }
        }
        $sjjv = mt_rand(1,180);
        if ($yguaiwu->djjv >= $sjjv && $yguaiwu->gdj != ''){
            $sql = "select * from daoju WHERE djid in ($yguaiwu->gdj)";
            $cxdljg = $dblj->query($sql);
            if ($cxdljg){
                $retdj = $cxdljg->fetchAll(PDO::FETCH_ASSOC);
                $sjdj = mt_rand(0,count($retdj)-1);
                $djname = $retdj[$sjdj]['djname'];
                $djid = $retdj[$sjdj]['djid'];
                if ($djid == 1 && $lvc == 0){
                    goto yp;
                }
                $djsum = mt_rand(1,2);
                \player\adddj($sid,$djid,$djsum,$dblj);
                $huode .= "获得:<div class='djys'>$djname x$djsum</div>";

                for ($i=0;$i<count($taskarr);$i++){
                    $rwyq = $taskarr[$i]['rwyq'];
                    $rwid = $taskarr[$i]['rwid'];
                    $rwzl = $taskarr[$i]['rwzl'];
                    $rwzt = $taskarr[$i]['rwzt'];
                    if ($rwyq==$djid && $rwzl==1 && $rwzt!=3){
                        $rwnowcount = $taskarr[$i]['rwnowcount']+ $djsum;
                        $rwts = $taskarr[$i]['rwname'].'('.$rwnowcount."/".$taskarr[$i]['rwcount'].')<br/>';
                        break;
                    }
                }

            }
        }
        yp:
        $sjjv = mt_rand(1,100);
        if ($yguaiwu->ypjv >= $sjjv && $yguaiwu->gyp != ''){
            $sql = "select * from yaopin WHERE ypid in ($yguaiwu->gyp)";
            $cxdljg = $dblj->query($sql);
            $retyp = $cxdljg->fetchAll(PDO::FETCH_ASSOC);
            $sjdj = mt_rand(0, count($retyp) - 1);
            $ypname = $retyp[$sjdj]['ypname'];
            $ypid = $retyp[$sjdj]['ypid'];
            $ypsum = mt_rand(1, 2);
            \player\addyaopin($sid,$ypid,$ypsum,$dblj);
            $huode .= "获得:<div class='ypys'>$ypname x$ypsum</div>";
        }

        $guaiwu->gexp = round($guaiwu->gexp / ($lvc+1),0);//经验计算
        if($guaiwu->gexp < 3){
            $guaiwu->gexp = 3;
        }
        $zdjg = 1;
    }
    $pzssh = $phurt - $pvexx;
    $sql = "update game1 set uhp = uhp - $pzssh  WHERE sid = '$sid'";
    $dblj->exec($sql);
    $player =  player\getplayer($sid,$dblj);
    if ($player->uhp > $player->umaxhp){
        $sql = "update game1 set uhp = $player->umaxhp WHERE sid = '$sid'";
        $dblj->exec($sql);
        $player->uhp = $player->umaxhp;
    }
    if ($player->uhp <= 0){
        $zdjg = 0;
    }
}

if ($player->yp1!=0){
    $yaopin = \player\getplayeryaopin($player->yp1,$sid,$dblj);
    $ypname1 = $yaopin->ypname.'('.$yaopin->ypsum.')';
}
if ($player->yp2!=0){
    $yaopin = \player\getplayeryaopin($player->yp2,$sid,$dblj);
    $ypname2 = $yaopin->ypname.'('.$yaopin->ypsum.')';
}
if ($player->yp3!=0){
    $yaopin = \player\getplayeryaopin($player->yp3,$sid,$dblj);
    $ypname3 = $yaopin->ypname.'('.$yaopin->ypsum.')';
}

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

if (isset($zdjg)){
    switch ($zdjg){
        case 1:

            player\changeexp($sid,$dblj,$guaiwu->gexp);
            $huode.='获得修为:'.$guaiwu->gexp.'<br/>';

            $html = <<<HTML
            战斗结果:<br/>
            你打死了$guaiwu->gname<br/>
            战斗胜利！<br/>
            $huode
            $rwts<br/>
            <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            break;
        case 0:
            $html = <<<HTML
            战斗结果:<br/>
            你被$guaiwu->gname 打死了<br/>
            战斗失败！<br/>
            请少侠重来<br/>
            <br/>
            <a href="?cmd=$gorehpmid">返回游戏</a>
HTML;
            break;
        case -1:
            $html = <<<HTML
            战斗结果:<br/>
            你已经重伤，无法再次进行战斗！<br/>
            请少侠恢复之后重来<br/>
            <br/>
            <a href="?cmd=$gorehpmid">返回游戏</a>
HTML;
            break;
    }
}else{
    if (isset($gphurt) && $gphurt>0){
        $ghurt='-'.$gphurt;
    }else{
        $ghurt='';
    }
    if (isset($cwhurt) && $cwhurt>0){
        $cwhurt='-'.$cwhurt;
    }else{
        $cwhurt='';
    }
    if (isset($phurt) && $phurt>0){
        $phurt='-'.$phurt;
    }else{
        $phurt='';
    }

    if ($pvexx>0){
        $pvexx="(+".$pvexx.')';
    }else{
        $pvexx = '';
    }

//    if ($player->cw!=0){
//        $cw = \player\getchongwu($player->cw,$dblj);
//        if ($cwhurt!='' || $cw->cwhp>0){
//            $cwhtml=<<<HTML
//            ===============<br/>
//            宠物:$cw->cwname[lv:$cw->cwlv]<br/>
//            气血:(<div class="hpys" style="display: inline">$cw->cwhp</div>/<div class="hpys" style="display: inline">$cw->cwmaxhp</div>)$cwhurt<br/>
//            攻击:($cw->cwgj)<br/>
//            防御:($cw->cwfy)<br/>
//HTML;
//        }
//
//    }
    
$html = <<<HTML
==战斗==<br/>
$guaiwu->gname [lv:$guaiwu->glv]<br/>
气血:(<div class="hpys" style="display: inline">$guaiwu->ghp</div>/<div class="hpys" style="display: inline">$guaiwu->gmaxhp</div>)$pvebj$ghurt<br/>
攻击:($guaiwu->ggj)<br/>
防御:($guaiwu->gfy)<br/>
===================<br/>
$player->uname [lv:$player->ulvl]<br/>
气血:(<div class="hpys" style="display: inline">$player->uhp</div>/<div class="hpys" style="display: inline">$player->umaxhp</div>)$phurt$pvexx<br/>
攻击:($player->ugj)<br/>
防御:($player->ufy)<br/>
$tishihtml
<br/>
<ul>
<li><a href="?cmd=$gonowmid">逃跑</a></li><br/>
<li><a href="?cmd=$pgjcmd">攻击</a></li>
</ul>
<a href="?cmd=$usejn1">$jnname1</a>.<a href="?cmd=$usejn2">$jnname2</a>.<a href="?cmd=$usejn3">$jnname3</a><br/>
<a href="?cmd=$useyp1">$ypname1</a>.<a href="?cmd=$useyp2">$ypname2</a>.<a href="?cmd=$useyp3">$ypname3</a><br/>
<br/>
HTML;
}
echo $html;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/11
 * Time: 12:09
 */
?>