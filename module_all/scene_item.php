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
$item_choose_url_2 = $encode->encode("cmd=item_html&canshu=消耗品&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_3 = $encode->encode("cmd=item_html&canshu=装备&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_4 = $encode->encode("cmd=item_html&canshu=其它&ucmd=$cmid&sid=$sid");
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

switch($canshu){
        case '全部':
        $sql = "select * from system_item WHERE iid in (select iid from system_item_module where iname like :keyword) and sid = '$sid' ORDER BY iequiped DESC limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where iid in (select iid from system_item_module where iname like :keyword) and sid ='$sid'";
            
        $item_choose_url = <<<HTML
全部 <a href="?cmd=$item_choose_url_2">消耗品</a> <a href="?cmd=$item_choose_url_3">装备</a> <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '消耗品':
        $sql = "select * from system_item WHERE sid = '$sid' and iid in(select iid from system_item_module where itype = '消耗品' and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where sid ='$sid' and iid in(select iid from system_item_module where itype = '消耗品' and iname like :keyword)";
            
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> 消耗品 <a href="?cmd=$item_choose_url_3">装备</a> <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '装备':
        $sql = "select * from system_item WHERE sid = '$sid' and iid in(select iid from system_item_module where  (itype = '兵器' || itype = '防具') and iname like :keyword) ORDER BY iequiped DESC limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where sid ='$sid' and iid in(select iid from system_item_module where (itype = '兵器' || itype = '防具') and iname like :keyword)";
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> <a href="?cmd=$item_choose_url_2">消耗品</a> 装备 <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '其它':
        $sql = "select * from system_item WHERE sid = '$sid' and iid in(select iid from system_item_module where (itype != '消耗品' and itype != '兵器' and itype != '防具') and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where sid ='$sid' and iid in(select iid from system_item_module where (itype != '消耗品' and itype != '兵器' and itype != '防具') and iname like :keyword)";
            
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> <a href="?cmd=$item_choose_url_2">消耗品</a> <a href="?cmd=$item_choose_url_3">装备</a> 其它<br/>
<br/>
HTML;
            break;
    }

if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $cxjg = $dblj->prepare($sql);
    $cxjg->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $countResult = $dblj->prepare($sqlCount);
    $countResult->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
}else{
    $keyword = "%";
    // 构建查询语句，使用过滤条件
    $cxjg = $dblj->prepare($sql);
    $cxjg->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $countResult = $dblj->prepare($sqlCount);
    $countResult->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
}

$cxjg->execute();
if ($cxjg){
    $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
}
$countResult->execute();
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];

// 计算总页数
$totalPages = ceil($totalRows / $list_row);

$item_type_sum = 0;
if($ret){
for ($i=0;$i<@$totalRows;$i++){
    $itemid = $ret[$i]['iid'];
    $itemsum = $ret[$i]['icount'];
    $item_iequiped = $ret[$i]['iequiped'];
    $item_true_id = $ret[$i]['item_true_id'];
    $isale_state = $ret[$i]['isale_state'];
    $item_type_sum +=$itemsum;
    switch($canshu){
        case '全部':
            $sql = "select * from system_item_module WHERE iid = '$itemid' ";
            break;
        case '消耗品':
            $sql = "select * from system_item_module WHERE iid = '$itemid' and itype = '消耗品'";
            break;
        case '装备':
            $sql = "select * from system_item_module WHERE iid = '$itemid' and (itype = '兵器' || itype = '防具') ";
            break;
        case '其它':
            $sql = "select * from system_item_module WHERE iid = '$itemid' and itype != '消耗品' and itype != '兵器' and itype != '防具'";
            break;
    }


$cxjg = $dblj->query($sql);
$retitem = $cxjg->fetch(PDO::FETCH_ASSOC);
$itemid = $retitem['iid'];
$itemname = $retitem['iname'];
$itemtype = $retitem['itype'];
$itemname = \lexical_analysis\process_photoshow($itemname);
$itemname = \lexical_analysis\color_string($itemname);

    if ($itemsum>0 &&$retitem && $canshu){
        $isale_text = $isale_state ==1?"(在售)":"";
        $hangshu = $hangshu + 1;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $chakanitem = $encode->encode("cmd=iteminfo_new&list_page=$list_page&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&itemid=$itemid&uid=$player->uid&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $useitem = $encode->encode("cmd=item_op_basic&target_event=use&canshu=$canshu&list_page=$list_page&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&parents_cmd=iteminfo_new&sid=$sid");
        $removeitem = $encode->encode("cmd=item_op_basic&target_event=remove&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&parents_cmd=iteminfo_new&sid=$sid");
        $sale_state = \player\getitem_sale_state($item_true_id,$sid,$dblj);
        if($item_iequiped ==1&&$sale_state==0){
        $itemhtml .="{$isale_text}[$hangshu]<a href='?cmd=$chakanitem'>{$itemname}x{$itemsum}</a> [装] <a href='?cmd=$removeitem'>卸下</a><br/>";
        }elseif($sale_state==0){
        $itemhtml .="{$isale_text}[$hangshu]<a href='?cmd=$chakanitem'>{$itemname}x{$itemsum}</a> <a href='?cmd=$useitem'>使用</a><br/>";
        }else{
        $itemhtml .="{$isale_text}[$hangshu]<a href='?cmd=$chakanitem'>{$itemname}x{$itemsum}</a><br/>";
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
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=item_html&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
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



$bagitemhtml =<<<HTML
{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重：({$player->uburthen}|{$player->umax_burthen})<br/>
<br/>
$item_choose_url
<form method="post">
<input name="ucmd" type="hidden" value="{$cmid}">
<input name="kw" type="text" value="{$keyword}"><br/>
<input name="submit" type="submit" title="物品搜索" value="物品搜索">
</form><br/>
$itemhtml
$page_html
<a href="?cmd=$gomysale">挂牌物品列表</a><br/>
----------
<br/><a href="?cmd=$gomystate">我的状态</a><br/>
<a href="?cmd=$gomyequip">我的装备</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $bagitemhtml;


?>