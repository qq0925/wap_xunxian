<?php
$player = player\getplayer($sid,$dblj);
$backcmd=$encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
if ($nowmid!=$player->nowmid){
    $html = <<<HTML
        请正常玩游戏！<br/>
        <br/>
        <a href="?cmd=$backcmd">返回游戏</a>
HTML;
    echo $html;
    exit();
}
if (isset($gid)){
    $guaiwu = player\getguaiwu($gid,$dblj);
    $yguaiwu = \player\getyguaiwu($gyid,$dblj);
    $pvecmd=$encode->encode("cmd=pve&gid=$gid&sid=$sid&nowmid=$nowmid");
    if ($yguaiwu->ginfo==''){
        $yguaiwu->ginfo = '没有任何名气';
    }
    
    if ($guaiwu->sid !='' or $guaiwu->gname==''){
        $html = <<<HTML
        怪物已经被其他人攻击了！<br/>
        请少侠练习一下手速哦
        <br/>
        <a href="?cmd=$backcmd">返回游戏</a>
HTML;
    }  else{
        $dlhtml = '';
        $zbhtml = '';
        $djhtml = '';
        $yphtml = '';
        if ($yguaiwu->gzb!=''){
            $zbarr = explode(',',$yguaiwu->gzb);
            foreach($zbarr as $newstr){
                $zbkzb = \player\getzbkzb($newstr,$dblj);
                $zbcmd = $encode->encode("cmd=zbinfo_sys&zbid=$zbkzb->zbid&sid=$sid");
                $zbhtml .= "<div class=\"zbys\"><a href='?cmd=$zbcmd'>$zbkzb->zbname</a> </div>";
            }
            $dlhtml .=$zbhtml;
        }
        if ($yguaiwu->gdj!=''){
            $djarr = explode(',',$yguaiwu->gdj);
            foreach($djarr as $newstr){
                $dj = \player\getdaoju($newstr,$dblj);
                $djinfo = $encode->encode("cmd=djinfo&djid=$dj->djid&sid=$sid");
                $djhtml .= "<div class='djys'><a href='?cmd=$djinfo'>$dj->djname</a></div>";
            }
            $dlhtml .=$djhtml;
        }
        if ($yguaiwu->gyp!=''){
            $yparr = explode(',',$yguaiwu->gyp);
            foreach($yparr as $newstr){
                $yp = \player\getyaopinonce($newstr,$dblj);
                $ypinfo = $encode->encode("cmd=ypinfo&ypid=$yp->ypid&sid=$sid");

                $yphtml .= "<div class='ypys'><a href='?cmd=$ypinfo'>$yp->ypname<a/></div>";
            }
            $dlhtml .=$yphtml;
        }

        if ($dlhtml == ''){
            $dlhtml = '该怪物没有物品掉落<br/>';
        }
        $html = <<<HTML
        [$yguaiwu->gname]<br/>
        等级:$yguaiwu->glv<br/>
        性别:$yguaiwu->gsex<br/>
        信息:$yguaiwu->ginfo<br/>
        境界:$guaiwu->jingjie<br/>
        <br/>
        掉落：
        $dlhtml<br/>
        <a href="?cmd=$pvecmd">攻击</a><a href="?cmd=$backcmd">返回游戏</a>
HTML;
    }
}
echo $html;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/11
 * Time: 10:08
 */
?>

