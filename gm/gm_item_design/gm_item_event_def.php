<?php

if($delete_sure_event_id){
    switch($delete_event_type){
        case 'item_creat':
            $delete_type = "icreat_event_id";
            break;
        case 'item_look':
            $delete_type = "ilook_event_id";
            break;
        case 'item_use':
            $delete_type = "iuse_event_id";
            break;
        case 'item_minute':
            $delete_type = "iminute_event_id";
            break;
    }
    echo "已删除“{$delete_event_name}”！";
    $dblj->exec("delete from system_event_evs_self where belong = '$delete_sure_event_id'");
    $dblj->exec("delete from system_event_self where id = '$delete_sure_event_id'");
    $dblj->exec("update system_item_module set `$delete_type` = '' where iid = '$item_id'");
}

$get_item_detail = \gm\get_item_detail($dblj,$item_id);
$item_id = $get_item_detail[0]['iid'];
$item_area_id = $get_item_detail[0]['iarea_id'];
$item_name = $get_item_detail[0]['iname'];
$icreat_event_id = $get_item_detail[0]['icreat_event_id'];
$ilook_event_id = $get_item_detail[0]['ilook_event_id'];
$iuse_event_id = $get_item_detail[0]['iuse_event_id'];
$iminute_event_id = $get_item_detail[0]['iminute_event_id'];

$event_links = [
    '创建事件' => ['cmd' => 'game_main_event', 'add_event' => $icreat_event_id == 0 ? 1 : 0, 'add_value' => $item_name . '创建', 'gm_post_canshu' => 'item_creat', 'main_id' => $item_id, 'event_id' => $icreat_event_id],
    '查看事件' => ['cmd' => 'game_main_event', 'add_event' => $ilook_event_id == 0 ? 1 : 0, 'add_value' => $item_name . '查看', 'gm_post_canshu' => 'item_look', 'main_id' => $item_id, 'event_id' => $ilook_event_id],
    '使用事件' => ['cmd' => 'game_main_event', 'add_event' => $iuse_event_id == 0 ? 1 : 0, 'add_value' => $item_name . '使用', 'gm_post_canshu' => 'item_use', 'main_id' => $item_id, 'event_id' => $iuse_event_id],
    '分钟定时事件' => ['cmd' => 'game_main_event', 'add_event' => $iminute_event_id == 0 ? 1 : 0, 'add_value' => $item_name . '分钟定时', 'gm_post_canshu' => 'item_minute', 'main_id' => $item_id, 'event_id' => $iminute_event_id],
];


if(!$delete_canshu){
$event_html = "<p>定义物品“{$item_name}”的事件<br/>";
$last_page = $encode->encode("cmd=game_item_list&item_id=$item_id&sid=$sid");
foreach ($event_links as $linkName => $linkParams) {
    $linkParams['sid'] = $sid;
    $linkEvent = $linkParams['add_event'];
    $linkUrl = $encode->encode(http_build_query($linkParams, '', '&', PHP_QUERY_RFC3986));
    if($linkEvent ==1){
    $event_html .= $linkName."：<a href=\"?cmd=$linkUrl\">定义事件</a><br/>";
    }else{
    $linkEventId = $linkParams['event_id'];
    $linkEventType = $linkParams['gm_post_canshu'];
    $linkDelete = $encode->encode("cmd=gm_type_item&delete_canshu=1&delete_event_type=$linkEventType&delete_event_id=$linkEventId&delete_event_name=$linkName&gm_post_canshu=$gm_post_canshu&item_id=$item_id&sid=$sid");
    $event_html .= $linkName."：<a href=\"?cmd=$linkUrl\">修改事件</a><a href='?cmd=$linkDelete'>删除</a><br/>";
    }
}
$event_html .= "<a href=\"?cmd=$last_page\">返回上级</a><br/></p>";
}elseif($delete_canshu==1){
$sure_main = $encode->encode("cmd=gm_type_item&delete_sure_event_id=$delete_event_id&delete_event_name=$delete_event_name&delete_event_type=$delete_event_type&gm_post_canshu=$gm_post_canshu&item_id=$item_id&sid=$sid");
$cancel_main = $encode->encode("cmd=gm_type_item&gm_post_canshu=$gm_post_canshu&item_id=$item_id&sid=$sid");
$event_html = "<p>是否删除物品“{$item_name}”的[{$delete_event_name}]<br/>";
$event_html .= "<a href='?cmd=$sure_main'>确定</a> | <a href='?cmd=$cancel_main'>取消</a><br/>";
$event_html .= "<a href=\"?cmd=$cancel_main\">返回上级</a><br/>";
}
echo $event_html;
?>