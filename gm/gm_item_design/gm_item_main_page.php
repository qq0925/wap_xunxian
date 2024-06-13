<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$get_item_detail = \gm\get_item_detail($dblj,$item_id);

$designer_para = \gm\getdesigner($sid,$dblj);
$designer_canshu = $designer_para['op_canshu'];
$designer_target = $designer_para['op_target'];

$item_id = $get_item_detail[0]['iid'];
$item_area_id = $get_item_detail[0]['iarea_id'];
$item_name = $get_item_detail[0]['iname'];
$item_type = $get_item_detail[0]['itype'];
$item_subtype = $get_item_detail[0]['isubtype'];
$item_op = $get_item_detail[0]['iop_target'];
$item_task = $get_item_detail[0]['itask_target'];

$item_icreat_event = $get_item_detail[0]['icreat_event_id'];
$item_ilook_event = $get_item_detail[0]['ilook_event_id'];
$item_iuse_event = $get_item_detail[0]['iuse_event_id'];
$item_iminute_event = $get_item_detail[0]['iminute_event_id'];
$item_event_count = ($item_icreat_event ? 1 : 0) + ($item_ilook_event ? 1 : 0) + ($item_iuse_event ? 1 : 0) + ($item_iminute_event ? 1 : 0);

if($item_op){
$item_op_count = @count(explode(",",$item_op));
}else{
$item_op_count = 0;
}

if($item_task){
$item_task_count = @count(explode(",",$item_task));
}else{
$item_task_count = 0;
}

$item_task = $clmid->mtask_target;
if($map_task){
$map_task_count = @count(explode(",",$map_task));
}else{
$map_task_count = 0;
}
if($designer_canshu&&$designer_target=="item_design"){
$goback_list = $encode->encode("cmd=gm_game_itemdesign&list_page=$designer_canshu&gm_post_canshu=$item_type&sid=$sid");
}else{
$goback_list = $encode->encode("cmd=gm_game_itemdesign&gm_post_canshu=$item_type&sid=$sid");
}
$attr_def = $encode->encode("cmd=gm_type_item&gm_post_canshu=1&item_id=$item_id&sid=$sid");
$op_def = $encode->encode("cmd=gm_type_item&gm_post_canshu=2&item_id=$item_id&sid=$sid");
$event_def = $encode->encode("cmd=gm_type_item&gm_post_canshu=3&item_id=$item_id&sid=$sid");
$task_def = $encode->encode("cmd=gm_type_item&gm_post_canshu=4&item_id=$item_id&sid=$sid");
$item_copy = $encode->encode("cmd=gm_type_item&gm_post_canshu=5&copy_name=$item_name&item_id=$item_id&sid=$sid");
$item_delete = $encode->encode("cmd=gm_type_item&gm_post_canshu=6&item_name=$item_name&item_id=$item_id&sid=$sid");
$item_html =<<<HTML
<p>[物品设计]<br/>
设计物品-{$item_name}(i{$item_id})<br/>
<a href="?cmd=$attr_def">定义属性</a><br/>
<a href="?cmd=$event_def">定义事件</a>({$item_event_count})<br/>
<a href="?cmd=$op_def">定义操作</a>({$item_op_count})<br/>
<a href="?cmd=$task_def">任务设定</a>({$item_task_count})<br/>
<a href="?cmd=$item_copy">复制该物品</a><br/>
<a href="?cmd=$item_delete">删除该物品</a><br/>
<a href="?cmd=$goback_list">返回物品列表</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $item_html;
?>