<?php
$npc_html = '';
$designer_para = \gm\getdesigner($sid,$dblj);
$designer_canshu = $designer_para['op_canshu'];
$designer_target = $designer_para['op_target'];
$cxnpc = \gm\get_npc_detail($dblj,$npc_id);
$br = 0;
$npc_name = $cxnpc[0]['nname'];
$npc_id = $cxnpc[0]['nid'];
$marea_id = $cxnpc[0]['narea_id'];
$marea_name = $cxnpc[0]['narea_name'];
$npc_op = $cxnpc[0]['nop_target'];
$npc_task = $cxnpc[0]['ntask_target'];
$npc_ncreat_event = $cxnpc[0]['ncreat_event_id'];
$nlook_event = $cxnpc[0]['nlook_event_id'];
$nattack_event = $cxnpc[0]['nattack_event_id'];
$nwin_event = $cxnpc[0]['nwin_event_id'];
$ndefeat_event = $cxnpc[0]['ndefeat_event_id'];
$npet_event = $cxnpc[0]['npet_event_id'];
$nshop_event = $cxnpc[0]['nshop_event_id'];
$nup_event = $cxnpc[0]['nup_event_id'];
$nheart_event = $cxnpc[0]['nheart_event_id'];
$nminute_event = $cxnpc[0]['nminute_event_id'];
$npc_event_count = ($npc_ncreat_event ? 1 : 0) +
                   ($nlook_event ? 1 : 0) +
                   ($nattack_event ? 1 : 0) +
                   ($nwin_event ? 1 : 0) +
                   ($ndefeat_event ? 1 : 0) +
                   ($npet_event ? 1 : 0) +
                   ($nshop_event ? 1 : 0) +
                   ($nup_event ? 1 : 0) +
                   ($nheart_event ? 1 : 0) +
                   ($nminute_event ? 1 : 0);

$npc_skill = $cxnpc[0]['nskills'];
$npc_equip = $cxnpc[0]['nequips'];
$npc_shop_item = $cxnpc[0]['nshop_item_id'];
$nshop = $cxnpc[0]['nshop'];
if($npc_op){
$npc_op_count = @count(explode(",",$npc_op));
}else{
$npc_op_count = 0;
}

if($npc_task){
$npc_task_count = @count(explode(",",$npc_task));
}else{
$npc_task_count = 0;
}

if($npc_skill){
$npc_skill_count = @count(explode(",",$npc_skill));
}else{
$npc_skill_count = 0;
}

if($npc_equip){
$npc_equip_count = @count(explode(",",$npc_equip));
}else{
$npc_equip_count = 0;
}

if($npc_shop_item){
$npc_shop_item_count = @count(explode(",",$npc_shop_item));
}else{
$npc_shop_item_count = 0;
}

if($nshop ==1){
    $npc_shop = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_id=$npc_id&sid=$sid");
    $shop_html = <<<HTML
<a href="game.php?cmd=$npc_shop">出售物品列表</a>({$npc_shop_item_count})<br/>
HTML;
}
if($designer_canshu&&$designer_target=="npc_design"){
$area_main = $encode->encode("cmd=gm_npc_first&post_canshu=1&list_page=$designer_canshu&qy_id=$marea_id&qy_name=$marea_name&sid=$sid");
}else{
$area_main = $encode->encode("cmd=gm_npc_first&post_canshu=1&qy_id=$marea_id&qy_name=$marea_name&sid=$sid");
}

$delete_npc = $encode->encode("cmd=gm_type_npc&qy_id=$marea_id&gm_post_canshu=9&npc_name=$npc_name&npc_id=$npc_id&sid=$sid");
$npc_main =<<<HTML
        设计电脑人物-{$npc_name}(n{$npc_id})<br/>
HTML;

$gm = $encode->encode("cmd=gm&sid=$sid");
$attr_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=1&npc_id=$npc_id&sid=$sid");
$op_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=2&npc_id=$npc_id&sid=$sid");
$event_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=3&npc_id=$npc_id&sid=$sid");
$task_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&npc_id=$npc_id&sid=$sid");
$skill_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=5&npc_id=$npc_id&sid=$sid");
$equip_def = $encode->encode("cmd=gm_type_npc&gm_post_canshu=6&npc_id=$npc_id&sid=$sid");
$dead_drop_def = $encode->encode("cmd=gm_type_npc&canshu=1&gm_post_canshu=7&npc_id=$npc_id&sid=$sid");
$copy_npc = $encode->encode("cmd=gm_type_npc&copy_name=$npc_name&gm_post_canshu=8&npc_id=$npc_id&sid=$sid");
$update_scene = $encode->encode("cmd=gm_type_npc&gm_post_canshu=10&npc_id=$npc_id&sid=$sid");
$entrance_scene = $encode->encode("cmd=gm_type_npc&gm_post_canshu=11&npc_id=$npc_id&sid=$sid");

$gm_main = $encode->encode("cmd=gm&sid=$sid");


$npc_design =<<<HTML
<p>[电脑人物设计]<br/>
$npc_main
<a href="game.php?cmd=$attr_def">定义属性</a><br/>
<a href="game.php?cmd=$event_def">定义事件</a>({$npc_event_count})<br/>
<a href="game.php?cmd=$op_def">定义操作</a>({$npc_op_count})<br/>
<a href="game.php?cmd=$task_def">任务设定</a>({$npc_task_count})<br/>
<a href="game.php?cmd=$skill_def">技能设定</a>({$npc_skill_count})<br/>
<a href="game.php?cmd=$equip_def">放置装备</a>({$npc_equip_count})<br/>
$shop_html
<a href="game.php?cmd=$dead_drop_def">死后掉落定义</a><br/>
<a href="game.php?cmd=$copy_npc">复制该人物</a><br/>
<a href="game.php?cmd=$delete_npc">删除该人物</a><br/>
<a href="game.php?cmd=$area_main">返回区域</a><br/>
<a href="game.php?cmd=$gm_main">返回设计大厅</a><br/>
HTML;

if($npc_designer_mid){
    $gm_scene_new = $encode->encode("cmd=gm_scene_new&sid=$sid");
    $npc_design .=<<<HTML
    <br/><a href="?cmd=$gm_scene_new">返回对方所在区域</a><br/>
HTML;
}

echo $npc_design;
?>