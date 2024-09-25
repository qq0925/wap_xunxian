<?php
//新手村村长
$player = player\getplayer($sid,$dblj);
$rehp = $encode->encode("cmd=npc&nid=$nid&canshu=rehp&sid=$sid");
$npchtml =<<<HTML
游戏错误
 <p><a href="?cmd=$gonowmid">返回游戏</a></p>;
HTML;
$xiaohao = round($player->ulv*(8.2 + $player->ulv/2));
if ($nid!=''){
    if (isset($canshu)){
        switch ($canshu){
            case 'rehp':
                if ($player->uhp<=0){
                    \player\changeyxb(2,$xiaohao,$sid,$dblj);
                    \player\changeplayersx('uhp',$player->umaxhp,$sid,$dblj);
                    $player = player\getplayer($sid,$dblj);
                    $gnhtml =<<<HTML
                    <br/>$npc->nname:少侠，你的的气血已经恢复了！<br/>
                    生命：$player->uhp/$player->umaxhp<br/>
HTML;
                }else{
                    $gnhtml ="<br/>我这里只接待重伤人士<br/>";
                }
                break;
        }
    }else{
        $gnhtml =<<<HTML
        <br/><a href="?cmd=$rehp">生命恢复需要[$xiaohao]灵石(没有灵石不收费)</a><br/>
HTML;
        }
}
?>