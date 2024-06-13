<?php
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$cwhtml='';
$cwnamehtml= '';
$chouqucmd = $encode->encode("cmd=chongwu&canshu=chouqu&sid=$sid");

if (isset($canshu)){
    switch ($canshu) {
        case 'chouqu':
            if (\player\changeczb(2, 50, $sid, $dblj)) {
                \player\addchongwu($sid, $dblj);
            } else {
                echo "极品灵石不足<br/>";
            }
            break;
        case 'chuzhan':
            \player\changeplayersx('cw',$cwid,$sid,$dblj);
            $player = \player\getplayer($sid,$dblj);
            break;
        case 'shouhui':
            \player\changeplayersx('cw',0,$sid,$dblj);
            $player = \player\getplayer($sid,$dblj);
            break;
        case 'fangsheng':
            \player\delechongwu($cwid,$sid,$dblj);
            break;
        case 'cwinfo':
            $chongwu = \player\getchongwu($cwid, $dblj);
            $pzarr = array('普通', '优秀', '卓越', '非凡', '完美', '逆天');
            $cwpz = $pzarr[$chongwu->cwpz];
            $chongwu->cwpz = $chongwu->cwpz * 10;
            $cwhtml = <<<HTML
            名字:[$chongwu->cwname]<br/>
            等级:$chongwu->cwlv<br/>
            品质:$cwpz<br/>
            经验:$chongwu->cwexp/$chongwu->cwmaxexp<br/>
            气血:($chongwu->cwhp/$chongwu->cwmaxhp)<br/>
            攻击:$chongwu->cwgj<br/>
            防御:$chongwu->cwfy<br/>
            暴击:$chongwu->cwbj<br/>
            吸血:$chongwu->cwxx<br/>
            <br/>
            气血成长:$chongwu->uphp<br/>
            攻击成长:$chongwu->upgj<br/>
            防御成长:$chongwu->upfy<br/>
            品质[$cwpz]在升级时加成$chongwu->cwpz%<br/>
            <br/><br/>
            <button onClick="javascript :history.back(-1);">返回上一页</button><br/>
            <a href="game.php?cmd=$gonowmid">返回游戏</a>
HTML;
            echo $cwhtml;
            exit();
            break;
    }
}

$allcw = \player\getchongwuall($sid,$dblj);
if ($allcw){
    foreach ($allcw as $cw){
        $cwid = $cw['cwid'];
        $czcmd='';
        if ($cwid!=$player->cw){
            $czcmd = $encode->encode("cmd=chongwu&canshu=chuzhan&cwid=$cwid&sid=$sid");
            $fscmd = $encode->encode("cmd=chongwu&canshu=fangsheng&cwid=$cwid&sid=$sid");
            $czcmd = '<a href="?cmd='.$czcmd.'">出战<a/>';
            $fscmd = '<a href="?cmd='.$fscmd.'">放生<a/>';
            $gncmd = $czcmd.$fscmd;
        }else{
            $shcmd = $encode->encode("cmd=chongwu&canshu=shouhui&cwid=$cwid&sid=$sid");
            $shcmd = '<a href="?cmd='.$shcmd.'">收回<a/>';
            $gncmd = '(已出战)'.$shcmd;
        }
        $cwinfo = $encode->encode("cmd=chongwu&cwid=$cwid&canshu=cwinfo&sid=$sid");
        $cwnamehtml.="[宠物]".'<a href="?cmd='.$cwinfo.'">'.$cw['cwname'].'</a>'.$gncmd.'<br/>';
        
    }
}else{
    $cwnamehtml= '你当前没有宠物';
}
$cwhtml = <<<HTML
$cwnamehtml
<br/>
<a href="?cmd=$chouqucmd">抽取宠物[极品灵石50]</a>
<br/><br/>
<button onClick="javascript :history.back(-1);">返回上一页</button><br/>
<a href="game.php?cmd=$gonowmid">返回游戏</a>
HTML;
echo $cwhtml;