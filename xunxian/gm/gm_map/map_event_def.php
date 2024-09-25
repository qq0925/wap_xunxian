<?php

if($delete_sure_event_id){
    switch($delete_event_type){
        case 'map_creat':
            $delete_type = "mcreat_event_id";
            break;
        case 'map_look':
            $delete_type = "mlook_event_id";
            break;
        case 'map_into':
            $delete_type = "minto_event_id";
            break;
        case 'map_out':
            $delete_type = "mout_event_id";
            break;
        case 'map_minute':
            $delete_type = "mminute_event_id";
            break;
    }
    echo "已删除“{$delete_event_name}”！";
    $dblj->exec("delete from system_event_evs_self where belong = '$delete_sure_event_id'");
    $dblj->exec("delete from system_event_self where id = '$delete_sure_event_id'");
    $dblj->exec("update system_map set `$delete_type` = '' where mid = '$target_midid'");
}


$cxamap = \gm\getmap_detail($dblj, $target_midid);
$map_name = $cxamap[0]['mname'];
$map_id = $cxamap[0]['mid'];
$marea_id = $cxamap[0]['marea_id'];
$mcreat_event_id = $cxamap[0]['mcreat_event_id'];
$mlook_event_id = $cxamap[0]['mlook_event_id'];
$minto_event_id = $cxamap[0]['minto_event_id'];
$mout_event_id = $cxamap[0]['mout_event_id'];
$mminute_event_id = $cxamap[0]['mminute_event_id'];

$event_links = [
    '创建事件' => ['cmd' => 'game_main_event', 'add_event' => $mcreat_event_id == 0 ? 1 : 0, 'add_value' => $map_name . '创建', 'gm_post_canshu' => 'map_creat', 'main_id' => $map_id, 'event_id' => $mcreat_event_id],
    '查看事件' => ['cmd' => 'game_main_event', 'add_event' => $mlook_event_id == 0 ? 1 : 0, 'add_value' => $map_name . '查看', 'gm_post_canshu' => 'map_look', 'main_id' => $map_id, 'event_id' => $mlook_event_id],
    '进入事件' => ['cmd' => 'game_main_event', 'add_event' => $minto_event_id == 0 ? 1 : 0, 'add_value' => $map_name . '进入', 'gm_post_canshu' => 'map_into', 'main_id' => $map_id, 'event_id' => $minto_event_id],
    '离开事件' => ['cmd' => 'game_main_event', 'add_event' => $mout_event_id == 0 ? 1 : 0, 'add_value' => $map_name . '离开', 'gm_post_canshu' => 'map_out', 'main_id' => $map_id, 'event_id' => $mout_event_id],
    '分钟定时事件' => ['cmd' => 'game_main_event', 'add_event' => $mminute_event_id == 0 ? 1 : 0, 'add_value' => $map_name . '分钟定时', 'gm_post_canshu' => 'map_minute', 'main_id' => $map_id, 'event_id' => $mminute_event_id],
];

if(!$delete_canshu){
$event_html = "<p>定义场景“{$map_name}”的事件<br/>";
$last_page = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");
foreach ($event_links as $linkName => $linkParams) {
    $linkParams['sid'] = $sid;
    $linkEvent = $linkParams['add_event'];
    $linkUrl = $encode->encode(http_build_query($linkParams, '', '&', PHP_QUERY_RFC3986));
    if($linkEvent ==1){
    $event_html .= $linkName."：<a href=\"?cmd=$linkUrl\">定义事件</a><br/>";
    }else{
    $linkEventId = $linkParams['event_id'];
    $linkEventType = $linkParams['gm_post_canshu'];
    $linkDelete = $encode->encode("cmd=gm_type_map&delete_canshu=1&delete_event_type=$linkEventType&delete_event_id=$linkEventId&delete_event_name=$linkName&gm_post_canshu=$gm_post_canshu&target_midid=$target_midid&sid=$sid");
    $event_html .= $linkName."：<a href=\"?cmd=$linkUrl\">修改事件</a><a href='?cmd=$linkDelete'>删除</a><br/>";
    }
}
$event_html .= "<a href=\"?cmd=$last_page\">返回上级</a><br/></p>";
}elseif($delete_canshu==1){
$sure_main = $encode->encode("cmd=gm_type_map&delete_sure_event_id=$delete_event_id&delete_event_name=$delete_event_name&delete_event_type=$delete_event_type&gm_post_canshu=$gm_post_canshu&target_midid=$target_midid&sid=$sid");
$cancel_main = $encode->encode("cmd=gm_type_map&gm_post_canshu=$gm_post_canshu&target_midid=$target_midid&sid=$sid");
$event_html = "<p>是否删除场景“{$map_name}”的[{$delete_event_name}]<br/>";
$event_html .= "<a href='?cmd=$sure_main'>确定</a> | <a href='?cmd=$cancel_main'>取消</a><br/>";
$event_html .= "<a href=\"?cmd=$cancel_main\">返回上级</a><br/>";
}
echo $event_html;
?>
