<?php
// require_once 'class/lexical_analysis.php';

// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
// $gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
$game_config = \player\getgameconfig($dblj);
$list_row = $game_config->list_row;

$itemhtml = '';
$hangshu = 0;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_1 = $encode->encode("cmd=item_html&canshu=全部&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_2 = $encode->encode("cmd=item_html&canshu=装备&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_3 = $encode->encode("cmd=item_html&canshu=镶物&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_4 = $encode->encode("cmd=item_html&canshu=药品&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_5 = $encode->encode("cmd=item_html&canshu=书籍&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_6 = $encode->encode("cmd=item_html&canshu=任务&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_7 = $encode->encode("cmd=item_html&canshu=其它&ucmd=$cmid&sid=$sid");
$sqlCount = '';
if(!$canshu){
    $canshu = '全部';
}

// 当前页码
if ($list_page) {
    $currentPage = intval($list_page);
} else {
    $currentPage = 1;
}

// 计算偏移量
$offset = ($currentPage - 1) * $list_row;

// 条件和 URL 映射
$conditions = [
    '全部' => "(iname like :keyword)",
    '装备' => "((itype = '兵器' OR itype = '防具') and iname like :keyword)",
    '镶物' => "((itype = '兵器镶嵌物' OR itype = '防具镶嵌物') and iname like :keyword)",
    '药品' => "(itype = '消耗品' and iname like :keyword)",
    '书籍' => "(itype = '书籍' and iname like :keyword)",
    '任务' => "(itype = '任务物品' and iname like :keyword)",
    '其它' => "(itype = '其它' and iname like :keyword)",
    
];



$urls = [
    '全部' =>"<a href=\"?cmd=$item_choose_url_1\">全部</a>",
    '装备' =>"<a href=\"?cmd=$item_choose_url_2\">装备</a>",
    '镶物' => "<a href=\"?cmd=$item_choose_url_3\">镶物</a>",
    '药品' => "<a href=\"?cmd=$item_choose_url_4\">药品</a>",
    '书籍' => "<a href=\"?cmd=$item_choose_url_5\">书籍</a>",
    '任务' => "<a href=\"?cmd=$item_choose_url_6\">任务</a>",
    '其它' => "<a href=\"?cmd=$item_choose_url_7\">其它</a>"
];

// 处理链接和文本替换
$links = [];
foreach ($urls as $key => $url) {
    if ($key === $canshu) {
        // 替换被点击的分类链接为文本
        $links[] = "{$key}";
    } else {
        $links[] = $url;
    }
}

// 将链接用 '|' 隔开，并每三项后换行
$formatted_links = '';
$chunks = array_chunk($links, 3);
foreach ($chunks as $chunk) {
    $formatted_links .= implode(' | ', $chunk) . "<br/>";
}



// 默认是'全部'
$condition = $conditions['全部'];
$item_choose_url = implode(" ", $urls) . "<br/>";

// 替换 switch case
if (isset($conditions[$canshu])) {
    $condition = $conditions[$canshu];
    $item_choose_url = str_replace($urls[$canshu], $urls[$canshu] , $formatted_links);
}

if (isset($kw)) {

if($_POST['kw']){
$currentPage = 1;
// 计算偏移量
$offset = ($currentPage - 1) * $list_row;
}
// 构建 SQL 查询
$ret = getitem_all($sid,$offset,$list_row,$condition,$dblj,$kw);
$totalRows =getitem_count($sid,$offset,$list_row,$condition,$dblj,$kw);
}else{
$kw = "%";
$ret = getitem_all($sid,$offset,$list_row,$condition,$dblj,$kw);
$totalRows = getitem_count($sid,$offset,$list_row,$condition,$dblj,$kw);
}

// 计算总页数
$totalPages = ceil($totalRows / $list_row);

if($currentPage > $totalPages&&$totalPages>0){
    $currentPage = $totalPages;
// 重新计算偏移量
$offset = ($currentPage - 1) * $list_row;
if (isset($kw)) {

if($_POST['kw']){
// 计算偏移量
$offset = ($currentPage - 1) * $list_row;
}
// 构建 SQL 查询
$ret = getitem_all($sid,$offset,$list_row,$condition,$dblj,$kw);
$totalRows =getitem_count($sid,$offset,$list_row,$condition,$dblj,$kw);
}else{
$kw = "%";
$ret = getitem_all($sid,$offset,$list_row,$condition,$dblj,$kw);
$totalRows = getitem_count($sid,$offset,$list_row,$condition,$dblj,$kw);
}
// 计算总页数
$totalPages = ceil($totalRows / $list_row);
}




$item_type_sum = 0;
if($ret){
for ($i=0;$i<@$totalRows;$i++){
    $itemid = $ret[$i]['iid'];
    $itemsum = $ret[$i]['icount'];
    $item_iequiped = $ret[$i]['iequiped'];
    $item_true_id = $ret[$i]['item_true_id'];
    $isale_state = $ret[$i]['isale_state'];
    $item_type_sum +=$itemsum;
    $conditions = [
    '全部' => "iid = '$itemid'",
    '装备' => "iid = '$itemid' and (itype = '兵器' || itype = '防具')",  
    '镶物' => "iid = '$itemid' and (itype = '兵器镶嵌物' || itype = '防具镶嵌物')",
    '药品' => "iid = '$itemid' and itype = '消耗品'",
    '书籍' => "iid = '$itemid' and itype = '书籍'",
    '任务' => "iid = '$itemid' and itype = '任务物品'",
    '其它' => "iid = '$itemid' and itype = '其它'",
];

$sql = "SELECT * FROM system_item_module WHERE " . ($conditions[$canshu] ?? $conditions['全部']);



$cxjg = $dblj->query($sql);
$retitem = $cxjg->fetch(PDO::FETCH_ASSOC);
$itemid = $retitem['iid'];
$itemname = $retitem['iname'];
$itemtype = $retitem['itype'];
$itemname = \lexical_analysis\process_photoshow($itemname);
$itemname = \lexical_analysis\color_string($itemname);

    if ($itemsum>0 &&$retitem && $canshu){
        $isale_text = $isale_state ==1?"(在售)":"";
        $hangshu = $offset + $i + 1;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $chakanitem = $encode->encode("cmd=iteminfo_new&list_page=$list_page&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&itemid=$itemid&uid=$player->uid&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $useitem = $encode->encode("cmd=item_op_basic&target_event=use&canshu=$canshu&list_page=$list_page&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&parents_cmd=iteminfo_new&sid=$sid");
        $removeitem = $encode->encode("cmd=item_op_basic&target_event=remove&canshu=$canshu&list_page=$list_page&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&parents_cmd=iteminfo_new&sid=$sid");
        $sale_state = \player\getitem_sale_state($item_true_id,$sid,$dblj);
        if($item_iequiped ==1&&$sale_state==0){
        $itemhtml .="{$isale_text}<a href='?cmd=$chakanitem'>{$hangshu}.{$itemname}x{$itemsum}</a>[装]|<a href='?cmd=$removeitem'>卸下</a><br/>";
        }elseif($sale_state==0){
        $itemhtml .="{$isale_text}<a href='?cmd=$chakanitem'>{$hangshu}.{$itemname}x{$itemsum}</a>|<a href='?cmd=$useitem'>使用</a><br/>";
        }else{
        $itemhtml .="{$isale_text}<a href='?cmd=$chakanitem'>{$hangshu}.{$itemname}x{$itemsum}</a><br/>";
        }
    }
}
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomystate = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomyequip = $encode->encode("cmd=player_equip&ucmd=$cmid&sid=$sid");

if ($currentPage > 2 && $currentPage == $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&kw=$kw&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage -  1;
    
    if($kw){
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&kw=$kw&list_page=$list_page&sid=$sid");
    }else{
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    }
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage +  1;
    if($kw){
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&kw=$kw&list_page=$list_page&sid=$sid");
    }else{
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    }
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $totalPages;
    if($kw){
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&kw=$kw&list_page=$list_page&sid=$sid");
    }else{
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    }
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}

if($totalPages >1){
    $page_html .="<br/>";
}

if($item_type_sum ==0){
$itemhtml .="该分类下没有物品！<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomysale = $encode->encode("cmd=item_sale_list&canshu=$canshu&ucmd=$cmid&sid=$sid");
if($keyword =="%"){
    $keyword = "";
}


//里面要加入自定义币种
$bagitemhtml =<<<HTML
{$gm_post->money_name}：{$player->umoney}{$gm_post->money_measure}<br/>
总负重：{$player->uburthen}|{$player->umax_burthen}<br/>
$item_choose_url<br/>
<form method="post">
<input name="ucmd" type="hidden" value="{$cmid}">
<input name="kw" type="text" value="{$keyword}"><br/>
<input name="submit" type="submit" title="物品搜索" value="物品搜索">
</form>
你身上有物品:<br/>
$itemhtml
$page_html
<a href="?cmd=$gomysale">挂牌物品列表</a><br/>
----------
<br/><a href="?cmd=$gomystate">我的状态</a><br/>
<a href="?cmd=$gomyequip">我的装备</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $bagitemhtml;


function getitem_all($sid,$offset,$list_row,$condition,$dblj,$kw=null){

$sql = "SELECT * FROM system_item WHERE sid = '$sid' AND iid IN (SELECT iid FROM system_item_module WHERE $condition) ORDER BY iequiped DESC LIMIT $offset,$list_row";
if($kw){
    $keyword = $kw;
}
    // 构建查询语句，使用过滤条件
    $cxjg = $dblj->prepare($sql);
    $cxjg->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
$cxjg->execute();
if ($cxjg){
    $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
}
return $ret;
}

function getitem_count($sid,$offset,$list_row,$condition,$dblj,$kw=null){
$sqlCount = "SELECT COUNT(*) as total FROM system_item WHERE sid = '$sid' AND iid IN (SELECT iid FROM system_item_module WHERE $condition)";
if($kw){
    $keyword = $kw;
}
    $countResult = $dblj->prepare($sqlCount);
    $countResult->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $countResult->execute();
    $countRow = $countResult->fetch(PDO::FETCH_ASSOC);
    $totalRows = $countRow['total'];
    return $totalRows;
}


?>