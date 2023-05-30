
<?php
//$arr = get_defined_vars();
//echo '<pre>';
//print_r(array_keys(get_defined_vars()));
//print($target_midid);
//print($target_midname);
//print($qy_id);
//print($qy_name);



$attr_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=1&target_midid=$target_midid&sid=$sid");
$op_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=2&target_midid=$target_midid&sid=$sid");
$event_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=3&target_midid=$target_midid&sid=$sid");
$task_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=4&target_midid=$target_midid&sid=$sid");
$map_out = $encode->encode("cmd=gm_type_map&gm_post_canshu=5&target_midid=$target_midid&sid=$sid");
$npc_who = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$item_what = $encode->encode("cmd=gm_type_map&gm_post_canshu=7&target_midid=$target_midid&sid=$sid");
$copy_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=8&target_midid=$target_midid&sid=$sid");
$update_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=10&target_midid=$target_midid&sid=$sid");
$entrance_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=11&target_midid=$target_midid&sid=$sid");

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$map = '';
$cxamap = \gm\getmap_detail($dblj,$target_midid);
$br = 0;
$map_name = $cxamap[0]['mname'];
$map_id = $cxamap[0]['mid'];
$marea_id = $cxamap[0]['marea_id'];
$area_main = $encode->encode("cmd=gm_map_2&post_canshu=1&marea_id=$marea_id&sid=$sid");


  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
$target_mid = $encode->encode("cmd=gm_map_2&hangshu=$hangshu&post_canshu=1&qy_id=$qy_id&qy_name=$qyname&sid=$sid");
$delete_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=9&map_name=$map_name&area_id=$marea_id&target_midid=$target_midid&sid=$sid");
$map =<<<HTML
        设计场景-${map_name}(s{$map_id})<br/>
HTML;
    /*if ($br >= 3){
        $br = 0;
        $map.="<br/>"  ;
    }*/
$map_design =<<<HTML
<p>[地图设计]<br/>
$map
<a href="game.php?cmd=$attr_def">定义属性</a><br/>
<a href="game.php?cmd=$op_def">定义操作</a><br/>
<a href="game.php?cmd=$event_def">定义事件</a><br/>
<a href="game.php?cmd=$task_def">任务设定</a><br/>
<a href="game.php?cmd=$map_out">定义出口</a><br/>
<a href="game.php?cmd=$npc_who">放置电脑人物</a><br/>
<a href="game.php?cmd=$item_what">放置物品</a><br/>
<a href="game.php?cmd=$copy_scene">复制该场景</a><br/>
<a href="game.php?cmd=$delete_scene">删除该场景</a><br/>
<a href="game.php?cmd=$update_scene">更新该场景</a><br/>
<a href="game.php?cmd=$entrance_scene">进入该场景</a><br/>
<a href="game.php?cmd=$area_main">返回区域</a><br/>
<a href="game.php?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $map_design;
?>