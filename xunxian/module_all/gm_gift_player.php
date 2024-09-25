<?php


if($_POST['item_true_id']){
    $oplayer = \player\getplayer($oid,$dblj);
    $oplayer_bag = ($oplayer->umax_burthen)-($oplayer->uburthen);
    $player = \player\getplayer($sid,$dblj);
    $item_name = \player\getitem_true($_POST['item_true_id'],$dblj)->iname;
    $item_weight = \player\getitem_true($_POST['item_true_id'],$dblj)->iweight;
    $item_total_weight = ($_POST['count']) * $item_weight;
    $item_bak_name = $item_name;
    $item_name = \lexical_analysis\color_string($item_name);
    if($count >0){
    if(($_POST['now_count']) >=($_POST['count'])&&$oplayer_bag>=$item_total_weight){
        $item_type = \player\getitem($_POST['iid'],$dblj)->itype;
        if($item_type !="兵器"&&$item_type !="防具"){
        \player\additem($oid,$_POST['iid'],$_POST['count'],$dblj);
        $out_count = \player\changeplayeritem($item_true_id,-$_POST['count'],$sid,$dblj);
        \player\addplayersx('uburthen',-$item_total_weight,$sid,$dblj);
        }else{
        \player\changeitem_ower($sid,$oid,$_POST['item_true_id'],$dblj);
        \player\addplayersx('uburthen',-$item_total_weight,$sid,$dblj);
        \player\addplayersx('uburthen',$item_total_weight,$oid,$dblj);
        }
        echo "赠送成功，你向{$oplayer->uname}赠送了{$item_name}x{$count}!<br/>";
        $send_time = date('Y-m-d H:i:s');
        $ltmsg = "我向你赠送了{$item_bak_name}x{$count}!";
        $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','$ltmsg','$player->uid','{$oplayer->uid}',1,'$send_time')";
        $cxjg = $dblj->exec($sql);
        $player = \player\getplayer($sid,$dblj);
        $oplayer = \player\getplayer($oid,$dblj);
    }else{
        echo "赠送失败!你没有这么多{$item_name}或者对方装不下这么多{$item_name}!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}



$oplayer = \player\getplayer($oid,$dblj);
$player = \player\getplayer($sid,$dblj);

$game_config = \player\getgameconfig($dblj);
$list_row = $game_config->list_row;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$goplayer = $encode->encode("cmd=getoplayerinfo&oid=$oplayer->uid&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$itemhtml = '';
$hangshu = 0;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_1 = $encode->encode("cmd=player_gift&oid=$oid&canshu=全部&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_2 = $encode->encode("cmd=player_gift&oid=$oid&canshu=装备&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_3 = $encode->encode("cmd=player_gift&oid=$oid&canshu=镶物&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_4 = $encode->encode("cmd=player_gift&oid=$oid&canshu=药品&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_5 = $encode->encode("cmd=player_gift&oid=$oid&canshu=书籍&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_6 = $encode->encode("cmd=player_gift&oid=$oid&canshu=任务&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_7 = $encode->encode("cmd=player_gift&oid=$oid&canshu=其它&ucmd=$cmid&sid=$sid");

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
    $ibind = $ret[$i]['ibind'];
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
$item_ino_give = $retitem['ino_give'];
$itemname = \lexical_analysis\process_photoshow($itemname);
$itemname = \lexical_analysis\color_string($itemname);
    if ($itemsum>0 &&$retitem && $canshu){
        $hangshu = $offset + $i + 1;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $chakanitem = $encode->encode("cmd=player_gift_info&oid=$oid&list_page=$list_page&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&itemid=$itemid&uid=$player->uid&sid=$sid");

        $sale_state = \player\getitem_sale_state($item_true_id,$sid,$dblj);
        if($item_iequiped ==1){
        $itemhtml .="$hangshu.{$itemname}x{$itemsum} [装] <br/>";
        }elseif($sale_state==1){
        $itemhtml .="$hangshu.{$itemname}x{$itemsum} [售] <br/>";
        }elseif($ibind ==1||$item_ino_give==1){
        $itemhtml .="$hangshu.{$itemname}x{$itemsum} [绑] <br/>";
        }else{
        $itemhtml .="{$isale_text}<a href='?cmd=$chakanitem'>$hangshu.{$itemname}x{$itemsum}</a><br/>";
        }
    }
}
}

if ($currentPage > 2 && $currentPage == $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $main_page = $encode->encode("cmd=player_gift&ucmd=$cmid&oid=$oid&canshu=$canshu&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=player_gift&ucmd=$cmid&oid=$oid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=player_gift&ucmd=$cmid&oid=$oid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=player_gift&ucmd=$cmid&oid=$oid&canshu=$canshu&list_page=$list_page&sid=$sid");
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

if($keyword =="%"){
    $keyword = "";
}




$gift_html = <<<HTML
「物品赠送」<br/>
你正在向「{$oplayer->uname}」赠送物品...<br/>
$item_choose_url
<form method="post">
<input name="ucmd" type="hidden" value="{$cmid}">
<input name="kw" type="text" value="{$keyword}"><br/>
<input name="submit" type="submit" title="物品搜索" value="物品搜索">
</form><br/>
$itemhtml
$page_html
----------<br/>
<a href="?cmd=$goplayer">返回{$oplayer->uname}</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
echo $gift_html;

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