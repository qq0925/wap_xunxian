<?php
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$strxl = $encode->encode("cmd=startxiulian&canshu=1&sid=$sid");
$strxl1 = $encode->encode("cmd=startxiulian&canshu=2&sid=$sid");
$endxl = $encode->encode("cmd=endxiulian&sid=$sid");
$nowdate = date('Y-m-d H:i:s');
$xlsjc='尚未开始修炼';
$tishi = '';
$xlexp = 0;
$xiaohao = 32 * $player->ulvl;
$jpxiaohao = round(($player->ulvl+1)/2);


if ($cmd == 'startxiulian'){
    if ($player->sfxl == 1){
        $tishi = '你已经在 修炼中了<br/>';
    }else{
        if ($canshu == 1){
            $ret = \player\changemoney(2,$xiaohao,$sid,$dblj);
        }else{
            $ret = \player\changeczb(2,$jpxiaohao,$sid,$dblj);
        }
        if ($ret){
            \player\changeplayersx('xiuliantime',$nowdate,$sid,$dblj);
            \player\changeplayersx('sfxl',1,$sid,$dblj);
            $tishi = '开始修炼...<br/>';
            $xlsjc = 0;
            $player = \player\getplayer($sid,$dblj);
        }else{
            $tishi='灵石不足';
        }

    }
}elseif ($cmd == 'endxiulian'){
    if ($player->sfxl == 1){
        \player\changeexp($sid,$dblj,$xlexp);
        \player\changeplayersx('sfxl',0,$sid,$dblj);
        $xlsjc = '结束修炼...<br/>修炼时间：'.$xlsjc;
        $tishi = '获得修为:'.$xlexp.'<br/>';
        $xlexp = 0;
        $player = \player\getplayer($sid,$dblj);
    }else{
        $tishi = '你还没有开始修炼...<br/>';
    }
}

if ($player->sfxl == 1){
    $one = strtotime($nowdate) ;
    $tow = strtotime($player->xiuliantime);
    $xlsjc=floor(($one-$tow)/60);
    if ($xlsjc > 1440){
        $xlsjc = 1440;
    }
    $xlexp = round($xlsjc * $player->ulvl*1.2);

    $tishi = '修炼中<br/>';
    $xlcz = "<a href=?cmd=$endxl>结束修炼<a/><br/><br/>";
}else{
    $xlcz = "<a href=?cmd=$strxl>使用灵石修炼</a><a href=?cmd=$strxl1>使用极品灵石修炼</a><br/><br/>";
}



$xlhtml = <<<HTML
$player->uname<br/>
$player->jingjie($player->ulvl)<br/>
===============<br/>
修炼时间:$xlsjc 分钟<br/>
修炼收益:$xlexp 修为<br/>
===============<br/>
$tishi
注：最多修炼24小时，1440分钟<br/>
<br/>
修炼需要灵石：$xiaohao/$player->umoney<br/>
修炼需要极品灵石：$jpxiaohao/$player->uczb<br/>
$xlcz
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $xlhtml;
?>