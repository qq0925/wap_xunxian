<?php
$player = player\getplayer($sid,$dblj);
$gm = $encode->encode("cmd=gm&sid=$sid");
$map = '';
$hangshu = 0;
if($list_page){
$dblj->exec("update system_designer_assist set op_target = 'npc_design',op_canshu = '$list_page' where sid = '$sid'");
}else{
$dblj->exec("update system_designer_assist set op_target = 'npc_design',op_canshu = '' where sid = '$sid'");
}
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
      $target_mid = $encode->encode("cmd=gm_npc_first&post_canshu=1&qy_id=0&qy_name=未分区&sid=$sid");
        $no_area =<<<HTML
        <a href="?cmd=$target_mid" >未分区</a><br/>
HTML;
  }elseif($qy_id !=0){
        $hangshu +=1;
        $target_mid = $encode->encode("cmd=gm_npc_first&hangshu=$hangshu&post_canshu=1&qy_id=$qy_id&qy_name=$qyname&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname(a{$qy_id})</a><br/>
HTML;
  }}
$allmap = <<<HTML
[电脑人物设计]<br/>
请选择区域：<br/>
$map
$no_area<br/>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
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
    
    
    $re_area = $encode->encode("cmd=gm_npc_first&gm_post_canshu=0&sid=$sid");
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
        $npc_ncreat_event = $cxallnpc[$i]['ncreat_event_id'];
        $nlook_event = $cxallnpc[$i]['nlook_event_id'];
        $nattack_event = $cxallnpc[$i]['nattack_event_id'];
        $npet_event = $cxallnpc[$i]['npet_event_id'];
        $nshop_event = $cxallnpc[$i]['nshop_event_id'];
        $nup_event = $cxallnpc[$i]['nup_event_id'];
        $nheart_event = $cxallnpc[$i]['nheart_event_id'];
        $nminute_event = $cxallnpc[$i]['nminute_event_id'];
        $npc_event_count = ($npc_ncreat_event ? 1 : 0) +
                   ($nlook_event ? 1 : 0) +
                   ($nattack_event ? 1 : 0) +
                   ($npet_event ? 1 : 0) +
                   ($nshop_event ? 1 : 0) +
                   ($nup_event ? 1 : 0) +
                   ($nheart_event ? 1 : 0) +
                   ($nminute_event ? 1 : 0);

        $target_mid = $encode->encode("cmd=gm_npc_second&qy_id=$qy_id&npc_id=$npc_nid&sid=$sid");
        $npc_html .=<<<HTML
        <a href="?cmd=$target_mid">$hangshu.{$npc_nname}(n{$npc_nid})</a>[{$npc_event_count}]<br/>
HTML;
    }
}
$npc_add = $encode->encode("cmd=gm_npc_second&npc_add_canshu=1&qy_id=$qy_id&qy_name=$qy_name&sid=$sid");
$npc_data_out = $encode->encode("cmd=gm_npc_second&out_canshu=1&qy_id=$qy_id&qy_name=$qy_name&sid=$sid");
if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=gm_npc_first&qy_id=$qy_id&post_canshu=1&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=gm_npc_first&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=gm_npc_first&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=gm_npc_first&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}
if($totalPages >1){
    $page_html .="<br/>";
}

$allmap = <<<HTML
<a href="?cmd=$npc_data_out" >导出{$qy_name}的npc->excel</a><br/>
[电脑人物设计]<br/>
{$qy_name}(a$qy_id)区域下的npc：<br/>
{$npc_html}
$page_html<br/>
<a href="?cmd=$npc_add" >增加npc</a><br/>
<a href="?cmd=$re_area" >返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $allmap;
}
?>