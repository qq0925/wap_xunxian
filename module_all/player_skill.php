<?php
// require_once 'class/lexical_analysis.php';


if($set_default_id){
    echo "已经【{$default_name}】设为默认技能！<br/>";
    $dblj->exec("update system_skill_user set jdefault = 0 where jsid = '$sid' and jpid = 0");
    $dblj->exec("update system_skill_user set jdefault = 1 where jsid = '$sid' and jid = '$set_default_id' and jpid = 0");
}

// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$sql = "select * from system_skill_user WHERE jsid = '$sid' and jpid = 0";
$cxjg = $dblj->query($sql);
if ($cxjg){
    $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
}
$skillshtml = '';
$hangshu = 0;
if(@count($ret) ==0){
    $skillshtml .='你还没有学会任何技能。<br/>'; 
}
for ($i=0;$i<@count($ret);$i++){
    $skillsid = $ret[$i]['jid'];
    $skillslvl = $ret[$i]['jlvl'];
    $skillsdefault = $ret[$i]['jdefault'];
    //$skillspoint = $ret[$i]['jpoint'];
    $sql = "select * from system_skill WHERE jid = '$skillsid'";
    $cxjg = $dblj->query($sql);
    $retskills = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for ($j=0;$j<count($retskills);$j++){
    $skillsid = $retskills[$j]['jid'];
    $skillsname = $retskills[$j]['jname'];
    $skillsname = \lexical_analysis\process_photoshow($skillsname);
    $skillsname = \lexical_analysis\color_string($skillsname);
    $hangshu = $hangshu + 1;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $chakanskills = $encode->encode("cmd=player_skillinfo&ucmd=$cmid&skill_id=$skillsid&uid=$player->uid&sid=$sid");
    if($skillsdefault==1){
    $skillshtml .="[$hangshu]<a href='?cmd=$chakanskills'>{$skillsname}:[等级{$skillslvl}]</a>[默认技能]<br/>";
    }else{
    $setdefault = $encode->encode("cmd=player_skill&ucmd=$cmid&default_name=$skillsname&set_default_id=$skillsid&uid=$player->uid&sid=$sid");
    $skillshtml .="[$hangshu]<a href='?cmd=$chakanskills'>{$skillsname}:[等级{$skillslvl}]</a>  <a href='?cmd=$setdefault'>设为默认</a><br/>";
    }
}

}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$skillshtml_total =<<<HTML
【你当前已学会的技能:】<br/>
<br/>
$skillshtml
<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $skillshtml_total;
?>