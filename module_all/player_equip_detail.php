<?php
// require_once 'class/player.php';
// require_once 'class/encode.php';
// require_once 'class/gm.php';
// include_once 'pdo.php';
// // require_once 'class/lexical_analysis.php';
require 'class/basic_function_todo.php';

$sql = "select iid from system_item where sid = '$sid' and item_true_id = '$equip_true_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetch(PDO::FETCH_ASSOC) : [];
$equip_id = $ret['iid'];
$equip_arr = \player\getitem($equip_id,$dblj);
$equip_name = $equip_arr->iname??0;
$equip_name = \lexical_analysis\color_string($equip_name);
$equip_desc = $equip_arr->idesc??0;
$equip_desc = \lexical_analysis\color_string($equip_desc);

$equip_iattack_value = $equip_arr->iattack_value==''?0:$equip_arr->iattack_value;
$equip_irecovery_value = $equip_arr->irecovery_value==''?0:$equip_arr->irecovery_value;
$equip_iembed_count = $equip_arr->iembed_count ==''?0:$equip_arr->iembed_count;
$equip_photo_url = $equip_arr->iimage ==''?0:$equip_arr->iimage;
if($equip_photo_url){
    $equip_photo_url = "#".$equip_photo_url."#";
    $equip_photo = \lexical_analysis\process_photoshow($equip_photo_url);
}
$equip_value = $equip_arr->itype =="兵器"?"【攻击力】：{$equip_iattack_value}<br/>":"【防御力】：{$equip_irecovery_value}<br/>";

$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid++;
$cdid[] = $cmid;
$player_equip_list = $encode->encode("cmd=player_equip&ucmd=$cmid&sid=$sid");

$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
{$equip_photo}
{$equip_name}<br/>
【重量】：{$equip_arr->iweight}<br/>
{$equip_value}
【镶嵌孔数】：{$equip_iembed_count}<br/>
【介绍】：{$equip_desc}<br/>
<a href="?cmd=$player_equip_list">返回列表</a><br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $all;
?>