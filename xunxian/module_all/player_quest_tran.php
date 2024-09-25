<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$oplayer = \player\getplayer($oid,$dblj);
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$utran_state = $player->utran_state;
$otran_state = $oplayer->utran_state;

$sql = "select * from system_tran_user where (tran_sid ='$sid' or tran_oid = '$sid') and tran_state = 0";
$cxjg=$dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$tran_sid = $ret['tran_sid'];
$tran_oid = $ret['tran_oid'];

if($utran_state ==0 && $otran_state==0 &&!$ret){
\player\changeplayersx('utran_state',1,$sid,$dblj);
\player\changeplayersx('utran_state',1,$oid,$dblj);
$tran_html = <<<HTML
你正在请求与【{$oplayer->uname}】进行交易！<br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}elseif($utran_state ==2 && $otran_state==2 &&!$ret){
$dblj->exec("insert into ");
$tran_html = <<<HTML
你正在与【{$oplayer->uname}】进行交易！<br/>
$tran_text
$tran_info
<a href="">添加物品</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}elseif($utran_state ==0 && $otran_state==0){
$tran_html = <<<HTML
请求交易失败！对方正在进行交易！<br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
echo $tran_html;
?>