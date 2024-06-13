<?php

$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_main = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=0&sid=$sid");


if($delete_sure){
$dblj->exec("delete from system_event_evs where belong = '$delete_event_id'");
$dblj->exec("update system_event set cond = '',cmmt = '' ,link_evs = '' where id = '$delete_event_id'");
echo "删除成功!<br/>";
}

if(!$delete_id){
switch($gm_post_canshu) {
case '1':
    $sql = "select * from system_event where belong = 1;";
    $cxjg = $dblj->query($sql);
    $rows = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $event_desc = $row['desc'];
        $event_id = $row['id'];
        $event_link_evs = $row['link_evs'];
        $gm_game_globalevent_detail = $encode->encode("cmd=game_event_page_1&gm_post_canshu=1&gm_post_canshu_2=$event_id&sid=$sid");
        if($event_link_evs){
        $gm_game_globalevent_delete = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=1&delete_id=$event_link_evs&event_id=$event_id&event_desc=$event_desc&sid=$sid");
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">修改事件</a> <a href = "?cmd=$gm_game_globalevent_delete">删除</a><br/>
HTML;
}else{
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">定义事件</a><br/>
HTML;
}
    }
    if($gm_post_canshu_2==0){
$gm_html = <<<HTML
<p>定义玩家公共事件<br/>
$global_event_page
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}
break;
case '2':
    $sql = "select * from system_event where belong = 2;";
    $cxjg = $dblj->query($sql);
    $rows = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $event_desc = $row['desc'];
        $event_id = $row['id'];
        $event_link_evs = $row['link_evs'];
        $gm_game_globalevent_detail = $encode->encode("cmd=game_event_page_1&gm_post_canshu=2&gm_post_canshu_2=$event_id&sid=$sid");
        if($event_link_evs){
        $gm_game_globalevent_delete = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=2&delete_id=$event_link_evs&event_id=$event_id&event_desc=$event_desc&sid=$sid");
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">修改事件</a> <a href = "?cmd=$gm_game_globalevent_delete">删除</a><br/>
HTML;
}else{
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">定义事件</a><br/>
HTML;
}
}
    if($gm_post_canshu_2==0){
$gm_html = <<<HTML
<p>定义电脑人物公共事件<br/>
$global_event_page
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}
break;
case '3':
    $sql = "select * from system_event where belong = 3;";
    $cxjg = $dblj->query($sql);
    $rows = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $event_desc = $row['desc'];
        $event_id = $row['id'];
        $event_link_evs = $row['link_evs'];
        $gm_game_globalevent_detail = $encode->encode("cmd=game_event_page_1&gm_post_canshu=3&gm_post_canshu_2=$event_id&sid=$sid");
        if($event_link_evs){
        $gm_game_globalevent_delete = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=3&delete_id=$event_link_evs&event_id=$event_id&event_desc=$event_desc&sid=$sid");
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">修改事件</a> <a href = "?cmd=$gm_game_globalevent_delete">删除</a><br/>
HTML;
}else{
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">定义事件</a><br/>
HTML;
}
}
    if($gm_post_canshu_2==0){
$gm_html = <<<HTML
<p>[定义物品公共事件]</p>
$global_event_page
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
break;
case '4':
    $sql = "select * from system_event where belong = 4;";
    $cxjg = $dblj->query($sql);
    $rows = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $event_desc = $row['desc'];
        $event_id = $row['id'];
        $event_link_evs = $row['link_evs'];
        $gm_game_globalevent_detail = $encode->encode("cmd=game_event_page_1&gm_post_canshu=4&gm_post_canshu_2=$event_id&sid=$sid");
        if($event_link_evs){
        $gm_game_globalevent_delete = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=4&delete_id=$event_link_evs&event_id=$event_id&event_desc=$event_desc&sid=$sid");
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">修改事件</a> <a href = "?cmd=$gm_game_globalevent_delete">删除</a><br/>
HTML;
}else{
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">定义事件</a><br/>
HTML;
}
}
 if($gm_post_canshu_2==0){
$gm_html = <<<HTML
<p>[定义场景公共事件]</p>
$global_event_page
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
break;
case '5':
    $sql = "select * from system_event where belong = 5;";
    $cxjg = $dblj->query($sql);
    $rows = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $event_desc = $row['desc'];
        $event_id = $row['id'];
        $event_link_evs = $row['link_evs'];
        $gm_game_globalevent_detail = $encode->encode("cmd=game_event_page_1&gm_post_canshu=5&gm_post_canshu_2=$event_id&sid=$sid");
        if($event_link_evs){
        $gm_game_globalevent_delete = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=5&delete_id=$event_link_evs&event_id=$event_id&event_desc=$event_desc&sid=$sid");
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">修改事件</a> <a href = "?cmd=$gm_game_globalevent_delete">删除</a><br/>
HTML;
}else{
        $global_event_page .=<<<HTML
        {$event_desc}事件：<a href = "?cmd=$gm_game_globalevent_detail">定义事件</a><br/>
HTML;
}
$gm_game_globaleventdefine_minute = $encode->encode("cmd=game_event_page_1&gm_post_canshu=5&gm_post_canshu_2=1&gm_post_canshu_3=系统分钟定时&sid=$sid");
}
if($gm_post_canshu_2==0){
$gm_html = <<<HTML
<p>[定义系统公共事件]</p>
$global_event_page
<button onclick = "window.location.assign('?cmd=$gm_main')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
}
}elseif ($delete_id) {
$cancel_main = $encode->encode("cmd=gm_game_globaleventdefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
$sure_main = $encode->encode("cmd=gm_game_globaleventdefine&delete_event_id=$event_id&delete_sure=$delete_id&gm_post_canshu=$gm_post_canshu&sid=$sid");
$text =<<<HTML
    是否删除{$event_desc}事件(ID:{$event_id})<br/>
<a href="?cmd=$sure_main">确定</a> | <a href="?cmd=$cancel_main">取消</a><br/>
HTML;

echo $text;
}
?>