<?php
$gm = $encode->encode("cmd=gm&sid=$sid");

if($list_page){
$dblj->exec("update system_designer_assist set op_target = 'item_design',op_canshu = '$list_page' where sid = '$sid'");
}else{
$dblj->exec("update system_designer_assist set op_target = 'item_design',op_canshu = '' where sid = '$sid'");
}

if($gm_post_canshu ==""){
$gm_game_itemdefine_1 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=消耗品&sid=$sid");
$gm_game_itemdefine_2 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=兵器&sid=$sid");
$gm_game_itemdefine_3 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=防具&sid=$sid");
$gm_game_itemdefine_4 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=书籍&sid=$sid");
$gm_game_itemdefine_5 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=兵器镶嵌物&sid=$sid");
$gm_game_itemdefine_6 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=防具镶嵌物&sid=$sid");
$gm_game_itemdefine_7 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=任务物品&sid=$sid");
$gm_game_itemdefine_8 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=其它&sid=$sid");
$gm_game_itemdefine_9 = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=导出&sid=$sid");
$gm_html = <<<HTML
<a href="?cmd=$gm_game_itemdefine_9">导出物品数据到->excel</a><br/>
<p>[物品设计]<br/>
请选择物品类别：<br/>
<a href="?cmd=$gm_game_itemdefine_1">消耗品</a><br/>
<a href="?cmd=$gm_game_itemdefine_2">兵器</a><br/>
<a href="?cmd=$gm_game_itemdefine_3">防具</a><br/>
<a href="?cmd=$gm_game_itemdefine_4">书籍</a><br/>
<a href="?cmd=$gm_game_itemdefine_5">兵器镶嵌物</a><br/>
<a href="?cmd=$gm_game_itemdefine_6">防具镶嵌物</a><br/>
<a href="?cmd=$gm_game_itemdefine_7">任务物品</a><br/>
<a href="?cmd=$gm_game_itemdefine_8">其它</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}else{


if(($gm_post_canshu=="兵器"||$gm_post_canshu=="防具")&&$sub_canshu==""){

if($gm_post_canshu=="兵器"){
$equip_html ="请选择兵器类型：<br/>";
$sql = "select * from system_equip_def where type = '1'";
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
}elseif($gm_post_canshu=="防具"){
$equip_html ="请选择防具类型：<br/>";
$sql = "select * from system_equip_def where type = '2'";
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
}

for ($i=1;$i<count($gm_ret) + 1;$i++){
    $def_name = $gm_ret[$i-1]['name'];
    $def_id = $gm_ret[$i-1]['id'];
    $view_detail = $encode->encode("cmd=gm_game_itemdefine&sub_canshu=$def_id&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $equip_html .=<<<HTML
    {$i}.<a href="?cmd=$view_detail">{$def_name}</a><br/>
HTML;
}
$goall =$encode->encode("cmd=gm_game_itemdefine&sub_canshu=all&gm_post_canshu=$gm_post_canshu&sid=$sid");
$equip_html .="{$i}.<a href='?cmd=$goall'>全部</a><br/>";
$gomain = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
$equip_html .="<a href='?cmd=$gomain'>返回物品设计</a><br/>";
echo $equip_html;
}else{

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
$sqlCount = "SELECT COUNT(*) as total FROM system_item_module where itype ='$gm_post_canshu'";
// 如果 $sub_canshu 存在，添加附加条件
if ($sub_canshu&&$sub_canshu!="all") {
    $sqlCount .= " AND isubtype = '$sub_canshu'";
}
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
$page_subtype = 0;
if(empty($_POST['kw'])){
$get_item_list = \gm\get_item_list($dblj,$gm_post_canshu,$offset,$list_row,$sub_canshu);
}
if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_item_module` where itype ='$gm_post_canshu' AND iname LIKE :keyword";
    
    if ($sub_canshu) {
    $sql .= " AND isubtype = '$sub_canshu'";
}
    
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $get_item_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$hangshu = $offset;
$back_list = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
for ($i=0;$i<count($get_item_list);$i++){
    $hangshu +=1;
    $item_id = $get_item_list[$i]['iid'];
    $item_area_id = $get_item_list[$i]['iarea_id'];
    $item_name = $get_item_list[$i]['iname'];
    $item_type = $get_item_list[$i]['itype'];
    $item_subtype = $get_item_list[$i]['isubtype'];
    $item_icreat_event = $get_item_list[$i]['icreat_event_id'];
    $item_ilook_event = $get_item_list[$i]['ilook_event_id'];
    $item_iuse_event = $get_item_list[$i]['iuse_event_id'];
    $item_iminute_event = $get_item_list[$i]['iminute_event_id'];
    $item_event_count = ($item_icreat_event ? 1 : 0) + ($item_ilook_event ? 1 : 0) + ($item_iuse_event ? 1 : 0) + ($item_iminute_event ? 1 : 0);
    $item_url = $encode->encode("cmd=game_item_list&item_id=$item_id&item_type=$gm_post_canshu&item_subtype=$page_subtype&sid=$sid");
    $item_list .=<<<HTML
    <a href="?cmd=$item_url" >$hangshu.{$item_name}(i{$item_id})</a>[{$item_event_count}]<br/>
HTML;
}
$item_add = $encode->encode("cmd=game_item_list&add_canshu=1&item_type=$gm_post_canshu&item_subtype=$page_subtype&sid=$sid");

if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=gm_game_itemdefine&sub_canshu=$sub_canshu&gm_post_canshu=$gm_post_canshu&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=gm_game_itemdefine&sub_canshu=$sub_canshu&gm_post_canshu=$gm_post_canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=gm_game_itemdefine&sub_canshu=$sub_canshu&gm_post_canshu=$gm_post_canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=gm_game_itemdefine&sub_canshu=$sub_canshu&gm_post_canshu=$gm_post_canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}

if($totalPages >1){
    $page_html .="<br/>";
}

if($sub_canshu){
    $back_son_list = $encode->encode("cmd=gm_game_itemdefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $back_list = $encode->encode("cmd=gm_game_itemdefine&sid=$sid");
    $go_sub_page = "<a href='?cmd=$back_son_list'>返回子类别列表</a><br/>";
}

$gm_html =<<<HTML
<p>{$gm_post_canshu}类物品列表：<br/>
$item_list
$page_html
</p>
<a href="?cmd=$item_add">增加物品</a><br/>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
$go_sub_page
<a href="?cmd=$back_list">返回类别列表</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
}
?>