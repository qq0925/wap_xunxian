<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/27 0027
 * Time: 11:49
 */
$clublist = '';
$allclub = \player\getclub_all($dblj);
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");

if ($allclub){
    $i = 0;
    foreach ($allclub as $club){
        $i++;
        $clubcmd = $encode->encode("cmd=club&clubid={$club['clubid']}&sid=$sid");
        $clublist .= "[$i]<a href='?cmd=$clubcmd' >{$club['clubname']}</a><br/>";
    }
}

$clubhtml =<<<HTML
===========门派天榜===========
      <br/>
      $clublist<br/>
      <button onClick="javascript :history.back(-1);">返回上一页</button><br/>
      <a href="?cmd=$gonowmid">返回游戏</a> 
HTML;



echo $clubhtml;