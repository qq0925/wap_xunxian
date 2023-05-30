<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/20
 * Time: 18:39
 */
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$tishi = '';
if (isset($dhm)){
    $dhm = htmlspecialchars($dhm);
    $duihuan = \player\getduihuan($dhm,$dblj);
    if ($duihuan){
        $sql = "delete from duihuan WHERE dhm = '$dhm'";
        $dblj->exec($sql);
        //及时删除兑换码， 最好采用开启事务
        $tishi = "兑换{$duihuan->dhname}兑换码成功，获得:<br/>";
        $retallzb = explode(',',$duihuan->dhzb);
        foreach ($retallzb as $zb){
            if ($zb){
                \player\addzb($sid,$zb,$dblj);
                $zhuangbei = \player\getzbkzb($zb,$dblj);
                $tishi .= "$zhuangbei->zbname<br/>";
            }
        }
        $djitem = explode(',',$duihuan->dhdj);
        foreach ($djitem as $djinfo){
            if ($djinfo){
                $dj = explode('|',$djinfo);
                $djid = $dj[0];
                $djcount = $dj[1];
                \player\adddj($sid,$djid,$djcount,$dblj);
                $daoju = \player\getdaoju($djid,$dblj);
                $tishi .= "{$daoju->djname}x{$djcount}<br/>";
                \player\changerwyq1(1,$djid,$djcount,$sid,$dblj);
            }
        }
        $ypitem = explode(',',$duihuan->dhyp);
        foreach ($ypitem as $ypinfo){
            if ($ypinfo){
                $yp = explode('|',$ypinfo);
                $ypid = $yp[0];
                $ypcount = $yp[1];
                \player\addyaopin($sid,$ypid,$ypcount,$dblj);
                $yaopin = \player\getyaopinonce($ypid,$dblj);
                $tishi .= "{$yaopin->ypname}x{$ypcount}<br/>";
            }
        }
        if ($duihuan->dhyxb){
            \player\changeyxb(1,$duihuan->dhyxb,$sid,$dblj);
            $tishi .= "灵石：$duihuan->dhyxb<br/>";
        }
        if ($duihuan->dhczb){
            \player\changeczb(1,$duihuan->dhczb,$sid,$dblj);
            $tishi .= "极品灵石：$duihuan->dhczb<br/>";
        }
        if ($duihuan->dhexp){
            \player\changeexp($sid,$dblj,$duihuan->dhexp);
            $tishi .= "经验：$duihuan->dhexp<br/>";
        }

    }else{
        $tishi =  '兑换失败<br/>';
    }

}



$dhhtml =<<<HTML
==========兑换页面==========
<form>
    <input type="hidden" name="cmd" value="duihuan">
    <input type="hidden" name="sid" value="$sid">
    兑换码:<br/>
    <input name="dhm"> <input type="submit" value="兑换"><br/><br/>
</form>
$tishi
<button onClick="javascript :history.back(-1);">返回上一页</button><br/> 
<a href='?cmd=$gonowmid'>返回游戏</a>

HTML;
echo $dhhtml;
?>

