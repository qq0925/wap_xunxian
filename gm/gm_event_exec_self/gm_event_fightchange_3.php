<?php
$last_page = $encode->encode("cmd=game_event_fight_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$map = '';
$hangshu = 0;

$cxallmap = \gm\getqy_all($dblj);
$br = 0;

if($post_canshu ==0){
for ($i=0;$i<count($cxallmap);$i++){
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_area` where name LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $cxallmap = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
}
  if($qy_id ==0){
      $target_mid = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&post_canshu=1&qy_id=0&sid=$sid");
        $no_area =<<<HTML
        <a href="?cmd=$target_mid" >未分区</a><br/>
HTML;
  }elseif($qy_id !=0){
        $hangshu +=1;
        $target_mid = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&post_canshu=1&qy_id=$qy_id&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname(a{$qy_id})</a><br/>
HTML;
  }}
$allmap = <<<HTML
[事件挑战电脑人物设计]<br/>
请选择所属区域：<br/>
$map
$no_area<br/>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$last_page" >返回上级</a><br/>
HTML;
echo $allmap;
}
elseif($post_canshu ==1){
    $game_config = \player\getgameconfig($dblj);
    $list_row = $game_config->list_row;
    // 当前页码
    if ($list_page) {
        $currentPage = intval($list_page);
    } else {
        $currentPage = 1;
    }
    // 计算偏移量
    $offset = ($currentPage - 1) * $list_row;
    
    
    // 计算总行数
    $sqlCount = "SELECT COUNT(*) as total FROM system_npc where narea_id ='$qy_id'";
    $countResult = $dblj->query($sqlCount);
    $countRow = $countResult->fetch(PDO::FETCH_ASSOC);
    $totalRows = $countRow['total'];
    
    // 计算总页数
    $totalPages = ceil($totalRows / $list_row);
    
    $re_area = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu=0&sid=$sid");
    $hangshu = $offset;
    if(isset($qy_id)){
    $cxthe_qy = \gm\getqy($dblj,$qy_id);
    $qy_name = $cxthe_qy['name'];
    $qy_id = $cxthe_qy['id'];
    $cxallnpc = \gm\get_npc_list($dblj,$qy_id,$offset,$list_row);
    for ($i=0;$i<count($cxallnpc);$i++){
        $hangshu +=1;
        $npc_nname = $cxallnpc[$i]['nname'];
        $npc_nid = $cxallnpc[$i]['nid'];
        $qy_name = $cxallnpc[$i]['narea_name'];
        $target_mid = $encode->encode("cmd=game_event_fightchange_self&event_id=$event_id&step_id=$step_id&npc_name=$npc_nname&qy_id=$qy_id&npc_id=$npc_nid&sid=$sid");
        $npc_html .=<<<HTML
        <a href="?cmd=$target_mid">$hangshu.{$npc_nname}(n{$npc_nid})</a><br/>
HTML;
    }
}

if ($currentPage > 2 && $currentPage == $totalPages) {
    $main_page = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=game_event_fightadd_self&event_id=$event_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}


$allmap = <<<HTML
[事件挑战电脑人物设计]<br/>
{$qy_name}(a$qy_id)区域下的npc：<br/>
{$npc_html}<br/>
$page_html<br/>
<a href="?cmd=$re_area" >返回上级</a><br/>
HTML;
echo $allmap;
}
?>