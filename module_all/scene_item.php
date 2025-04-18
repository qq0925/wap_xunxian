<?php

$player = \player\getplayer($sid,$dblj);

if($player->uis_designer ==1){
$goto_url = $encode->encode("cmd=gm_game_othersetting&canshu=13&sid=$sid");
$goto_desi = "<a href='?cmd=$goto_url'>设计头部页面</a><br/>";
}

$gm_post = \gm\gm_post($dblj);
$game_config = \player\getgameconfig($dblj);
$item_head = $game_config->item_head;
$list_row = $game_config->list_row;

$itemhtml = '';
$hangshu = 0;
$cmid = $cmid + 1;
$cdid[] = $cmid;

$sqlCount = '';




if(!$canshu){
    $canshu = '全部';
}


if($item_head){
$item_choose_url = create_head($item_head, $sid, $cmid, $dblj, $canshu);
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
    '药品' => "(itype = '消耗品' and iname like :keyword)",
    '装备' => "((itype = '兵器' OR itype = '防具') and iname like :keyword)",
    '兵器' => "(itype = '兵器' and iname like :keyword)",
    '防具' => "(itype = '防具' and iname like :keyword)",
    '书籍' => "(itype = '书籍' and iname like :keyword)",
    '镶物' => "((itype = '兵器镶嵌物' OR itype = '防具镶嵌物') and iname like :keyword)",
    '兵镶' => "(itype = '兵器镶嵌物' and iname like :keyword)",
    '防镶' => "(itype = '防具镶嵌物' and iname like :keyword)",
    '任务' => "(itype = '任务物品' and iname like :keyword)",
    '其它' => "(itype = '其它' and iname like :keyword)",
];


// 默认是'全部'
$condition = $conditions[$canshu];

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
    '药品' => "iid = '$itemid' and itype = '消耗品'",
    '装备' => "iid = '$itemid' and (itype = '兵器' || itype = '防具')",
    '兵器' => "iid = '$itemid' and itype = '兵器'",
    '防具' => "iid = '$itemid' and itype = '防具'",
    '镶物' => "iid = '$itemid' and (itype = '兵器镶嵌物' || itype = '防具镶嵌物')",
    '兵镶' => "iid = '$itemid' and itype = '兵器镶嵌物'",
    '防镶' => "iid = '$itemid' and itype = '防具镶嵌物'",
    '书籍' => "iid = '$itemid' and itype = '书籍'",
    '任务' => "iid = '$itemid' and itype = '任务物品'",
    '其它' => "iid = '$itemid' and itype = '其它'",
];

$sql = "SELECT * FROM system_item_module WHERE " . ($conditions[$canshu] ?? $conditions['全部']);

$cxjg = $dblj->query($sql);
$retitem = $cxjg->fetch(PDO::FETCH_ASSOC);
$itemid = $retitem['iid'];
$itemname = $retitem['iname'];
$sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$item_true_id' and name = 'iname'";
$stmt = $dblj->query($sql_2);
if($stmt->rowCount() >0){
$itemname = $stmt->fetchColumn();
}
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

if ($currentPage > 2 && $currentPage <= $totalPages) {
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
$goto_desi
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

function create_head($head_value, $sid, &$cmid, $dblj, $canshu) {
    global $encode;
    $ret_url = $head_value;
    
    // 处理物品类型模式
    $ret_url = preg_replace_callback('/\{\{item_type_([^}]+)\}\}/', function($matches) use ($encode, $sid, &$cmid, $canshu) {
        $type = $matches[1];
        
        $cmid++;
        
        // 创建此类型的编码URL
        $item_choose_url = $encode->encode("cmd=item_html&canshu=$type&ucmd=$cmid&sid=$sid");
        
        // 如果这是当前选择的类型，只返回文本
        if ($type === $canshu) {
            return $type;
        } else {
            return "<a href=\"?cmd=$item_choose_url\">$type</a>";
        }
    }, $ret_url);
    
    // 处理物品子类型模式
    $ret_url = preg_replace_callback('/\{\{item_subtype_([^}]+)\}\}/', function($matches) use ($encode, $sid, &$cmid, $canshu, $dblj) {
        $subtype = $matches[1];
        
        $cmid++;
        
        // 检查子类型是数字（装备子类型）还是字符串（一般子类型）
        if (is_numeric($subtype)) {
            // 处理装备子类型（数字）
            $item_subtype_url = $encode->encode("cmd=item_html&canshu=装备&subtype=$subtype&ucmd=$cmid&sid=$sid");
            
            // 如果这是当前选择的子类型，只返回文本
            if (isset($_REQUEST['subtype']) && $_REQUEST['subtype'] == $subtype) {
                return "$subtype";
            } else {
                return "<a href=\"?cmd=$item_subtype_url\">$subtype</a>";
            }
        } else {
            // 处理一般子类型（字符串）
            // 查询以查找具有此子类型的所有物品
            $sql = "SELECT DISTINCT itype,isubtype FROM system_item_module WHERE isubtype = :subtype";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':subtype', $subtype, PDO::PARAM_STR);
            $stmt->execute();
            
            // 如果子类型存在
            if ($stmt->rowCount() > 0) {
                $item_subtype_url = $encode->encode("cmd=item_html&canshu=全部&subtype=$subtype&ucmd=$cmid&sid=$sid");
                
                // 如果这是当前选择的子类型，只返回文本
                if (isset($_REQUEST['subtype']) && $_REQUEST['subtype'] == $subtype) {
                    return $subtype;
                } else {
                    return "<a href=\"?cmd=$item_subtype_url\">$subtype</a>";
                }
            } else {
                return $matches[0]; // 如果找不到子类型，则返回原始内容
            }
        }
    }, $ret_url);
    $ret_url = \lexical_analysis\process_string($ret_url,$sid,$oid,$mid);
    $ret_url = \lexical_analysis\process_photoshow($ret_url);
    $ret_url =\lexical_analysis\color_string($ret_url);
    return nl2br($ret_url);
} 

?>