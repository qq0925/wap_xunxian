<?php

$equipchoosehtml = '';
if($eq_type ==1){
$sql = "SELECT si.item_true_id, sim.iname FROM system_item si
JOIN system_item_module sim ON si.iid = sim.iid
WHERE si.sid = '$sid' AND sim.itype = '兵器';
";
$equipchoosehtml = "可装备在手持的装备：<br/>";
}else{
$sql = "SELECT si.item_true_id, sim.iname FROM system_item si 
INNER JOIN system_item_module sim ON si.iid = sim.iid
WHERE sim.itype = '防具' AND sim.isubtype = '$eq_subtype' AND si.sid = '$sid';
";
$equipchoosehtml = "可装备在{$equip_typename}的装备：<br/>";
}

$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetchAll(PDO::FETCH_ASSOC) : [];
if(!$ret){
$equipchoosehtml .="没有对应部位的装备。<br/>";
}
for($i=1;$i<@count($ret) +1;$i++){
$equip_name = \lexical_analysis\color_string($ret[$i-1]['iname']);
$equip_true_id = $ret[$i-1]['item_true_id'];
$equipitem = $encode->encode("cmd=equip_op_basic&target_event=use&ucmd=$cmid&equip_true_id=$equip_true_id&sid=$sid");
$equipchoosehtml .= <<<HTML
{$i}.{$equip_name} | <a href="?cmd=$equipitem">[装备]</a><br/>
HTML;
}
$cmid++;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid++;
$cdid[] = $cmid;
$player_state = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");
$cmid++;
$cdid[] = $cmid;
$player_equip_list = $encode->encode("cmd=player_equip&ucmd=$cmid&sid=$sid");

$choosehtml = <<<HTML
【我的装备】<a href="?cmd=$player_equip_list">返回列表</a><br/>
$equipchoosehtml<br/>
<a href="?cmd=$player_state">我的状态</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;

echo $choosehtml;
?>