<?php

if($delete_sure_event_id){
    switch($delete_event_type){
        case 'npc_creat':
            $delete_type = "ncreat_event_id";
            break;
        case 'npc_look':
            $delete_type = "nlook_event_id";
            break;
        case 'npc_attack':
            $delete_type = "nattack_event_id";
            break;
        case 'npc_win':
            $delete_type = "nwin_event_id";
            break;
        case 'npc_defeat':
            $delete_type = "ndefeat_event_id";
            break;
        case 'npc_pet':
            $delete_type = "npet_event_id";
            break;
        case 'npc_shop':
            $delete_type = "nshop_event_id";
            break;
        case 'npc_up':
            $delete_type = "nup_event_id";
            break;
        case 'npc_heart':
            $delete_type = "nheart_event_id";
            break;
        case 'npc_minute':
            $delete_type = "nminute_event_id";
            break;
    }
    echo "已删除“{$delete_event_name}”！";
    $dblj->exec("delete from system_event_evs_self where belong = '$delete_sure_event_id'");
    $dblj->exec("delete from system_event_self where id = '$delete_sure_event_id'");
    $dblj->exec("update system_npc set `$delete_type` = '' where nid = '$npc_id'");
}

$cxnpc = \gm\get_npc_detail($dblj,$npc_id);
$br = 0;
$npc_name = $cxnpc[0]['nname'];
$npc_id = $cxnpc[0]['nid'];
$marea_id = $cxnpc[0]['narea_id'];
$marea_name = $cxnpc[0]['narea_name'];
$npc_kill = $cxnpc[0]['nkill'];


if($npc_kill ==0){
$ncreat_event_id = $cxnpc[0]['ncreat_event_id'];
$nlook_event_id = $cxnpc[0]['nlook_event_id'];
$nattack_event_id = $cxnpc[0]['nattack_event_id'];
$npet_event_id = $cxnpc[0]['npet_event_id'];
$nshop_event_id = $cxnpc[0]['nshop_event_id'];
$nup_event_id = $cxnpc[0]['nup_event_id'];
$nheart_event_id = $cxnpc[0]['nheart_event_id'];
$nminute_event_id = $cxnpc[0]['nminute_event_id'];

$event_links = [
    '创建事件' => ['cmd' => 'game_main_event', 'add_event' => $ncreat_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '创建', 'gm_post_canshu' => 'npc_creat', 'main_id' => $npc_id, 'event_id' => $ncreat_event_id],
    '查看事件' => ['cmd' => 'game_main_event', 'add_event' => $nlook_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '查看', 'gm_post_canshu' => 'npc_look', 'main_id' => $npc_id, 'event_id' => $nlook_event_id],
    '被攻击事件' => ['cmd' => 'game_main_event', 'add_event' => $nattack_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '被攻击', 'gm_post_canshu' => 'npc_attack', 'main_id' => $npc_id, 'event_id' => $nattack_event_id],
    '被收养事件' => ['cmd' => 'game_main_event', 'add_event' => $npet_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '被收养', 'gm_post_canshu' => 'npc_pet', 'main_id' => $npc_id, 'event_id' => $npet_event_id],
    '交易事件' => ['cmd' => 'game_main_event', 'add_event' => $nshop_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '交易', 'gm_post_canshu' => 'npc_shop', 'main_id' => $npc_id, 'event_id' => $nshop_event_id],
    '升级事件' => ['cmd' => 'game_main_event', 'add_event' => $nup_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '升级', 'gm_post_canshu' => 'npc_up', 'main_id' => $npc_id, 'event_id' => $nup_event_id],
    '心跳事件' => ['cmd' => 'game_main_event', 'add_event' => $nheart_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '心跳', 'gm_post_canshu' => 'npc_heart', 'main_id' => $npc_id, 'event_id' => $nheart_event_id],
    '分钟定时事件' => ['cmd' => 'game_main_event', 'add_event' => $nminute_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '分钟定时', 'gm_post_canshu' => 'npc_minute', 'main_id' => $npc_id, 'event_id' => $nminute_event_id],
];
}else{
$ncreat_event_id = $cxnpc[0]['ncreat_event_id'];
$nlook_event_id = $cxnpc[0]['nlook_event_id'];
$nattack_event_id = $cxnpc[0]['nattack_event_id'];
$nwin_event_id = $cxnpc[0]['nwin_event_id'];
$ndefeat_event_id = $cxnpc[0]['ndefeat_event_id'];
$npet_event_id = $cxnpc[0]['npet_event_id'];
$nshop_event_id = $cxnpc[0]['nshop_event_id'];
$nup_event_id = $cxnpc[0]['nup_event_id'];
$nheart_event_id = $cxnpc[0]['nheart_event_id'];
$nminute_event_id = $cxnpc[0]['nminute_event_id'];

$event_links = [
    '创建事件' => ['cmd' => 'game_main_event', 'add_event' => $ncreat_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '创建', 'gm_post_canshu' => 'npc_creat', 'main_id' => $npc_id, 'event_id' => $ncreat_event_id],
    '查看事件' => ['cmd' => 'game_main_event', 'add_event' => $nlook_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '查看', 'gm_post_canshu' => 'npc_look', 'main_id' => $npc_id, 'event_id' => $nlook_event_id],
    '被攻击事件' => ['cmd' => 'game_main_event', 'add_event' => $nattack_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '被攻击', 'gm_post_canshu' => 'npc_attack', 'main_id' => $npc_id, 'event_id' => $nattack_event_id],
    '战胜事件' => ['cmd' => 'game_main_event', 'add_event' => $nwin_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '战胜', 'gm_post_canshu' => 'npc_win', 'main_id' => $npc_id, 'event_id' => $nwin_event_id],
    '战败事件' => ['cmd' => 'game_main_event', 'add_event' => $ndefeat_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '战败', 'gm_post_canshu' => 'npc_defeat', 'main_id' => $npc_id, 'event_id' => $ndefeat_event_id],
    '被收养事件' => ['cmd' => 'game_main_event', 'add_event' => $npet_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '被收养', 'gm_post_canshu' => 'npc_pet', 'main_id' => $npc_id, 'event_id' => $npet_event_id],
    '交易事件' => ['cmd' => 'game_main_event', 'add_event' => $nshop_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '交易', 'gm_post_canshu' => 'npc_shop', 'main_id' => $npc_id, 'event_id' => $nshop_event_id],
    '升级事件' => ['cmd' => 'game_main_event', 'add_event' => $nup_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '升级', 'gm_post_canshu' => 'npc_up', 'main_id' => $npc_id, 'event_id' => $nup_event_id],
    '心跳事件' => ['cmd' => 'game_main_event', 'add_event' => $nheart_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '心跳', 'gm_post_canshu' => 'npc_heart', 'main_id' => $npc_id, 'event_id' => $nheart_event_id],
    '分钟定时事件' => ['cmd' => 'game_main_event', 'add_event' => $nminute_event_id == 0 ? 1 : 0, 'add_value' => $npc_name . '分钟定时', 'gm_post_canshu' => 'npc_minute', 'main_id' => $npc_id, 'event_id' => $nminute_event_id],
];
}


if(!$delete_canshu){
$event_html = "<p>定义NPC“{$npc_name}”的事件<br/>";
$last_page = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
foreach ($event_links as $linkName => $linkParams) {
    $linkParams['sid'] = $sid;
    $linkEvent = $linkParams['add_event'];
    $linkUrl = $encode->encode(http_build_query($linkParams, '', '&', PHP_QUERY_RFC3986));
    if($linkEvent ==1){
    $event_html .= $linkName."：<a href=\"?cmd=$linkUrl\">定义事件</a><br/>";
    }else{
    $linkEventId = $linkParams['event_id'];
    $linkEventType = $linkParams['gm_post_canshu'];
    $linkDelete = $encode->encode("cmd=gm_type_npc&delete_canshu=1&delete_event_type=$linkEventType&delete_event_id=$linkEventId&delete_event_name=$linkName&gm_post_canshu=$gm_post_canshu&npc_id=$npc_id&sid=$sid");
    $event_html .= $linkName."：<a href=\"?cmd=$linkUrl\">修改事件</a><a href='?cmd=$linkDelete'>删除</a><br/>";
    }
}
$event_html .= "<a href=\"?cmd=$last_page\">返回上级</a><br/></p>";
}elseif($delete_canshu==1){
$sure_main = $encode->encode("cmd=gm_type_npc&delete_sure_event_id=$delete_event_id&delete_event_name=$delete_event_name&delete_event_type=$delete_event_type&gm_post_canshu=$gm_post_canshu&npc_id=$npc_id&sid=$sid");
$cancel_main = $encode->encode("cmd=gm_type_npc&gm_post_canshu=$gm_post_canshu&npc_id=$npc_id&sid=$sid");
$event_html = "<p>是否删除NPC“{$npc_name}”的[{$delete_event_name}]<br/>";
$event_html .= "<a href='?cmd=$sure_main'>确定</a> | <a href='?cmd=$cancel_main'>取消</a><br/>";
$event_html .= "<a href=\"?cmd=$cancel_main\">返回上级</a><br/>";
}
echo $event_html;
?>