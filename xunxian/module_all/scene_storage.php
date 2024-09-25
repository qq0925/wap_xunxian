<?php
// require_once 'class/lexical_analysis.php';

// $player = new \player\player();

$player = \player\getplayer($sid,$dblj);
$player_nowmid = $player->nowmid;
$clmid = player\getmid($player_nowmid,$dblj);
$map_name = $clmid->mname;
$game_config = \player\getgameconfig($dblj);

if($lock_canshu ==1){

// 查询是否存在相应的数据
$stmt = $dblj->prepare("SELECT * FROM system_storage_locked WHERE ibelong_mid = :lock_mid AND sid = :sid");
$stmt->bindParam(':lock_mid', $lock_mid);
$stmt->bindParam(':sid', $sid);
$stmt->execute();

// 获取查询结果的行数
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    // 如果存在，更新 istate 为 1
    $updateStmt = $dblj->prepare("UPDATE system_storage_locked SET istate = 1 WHERE ibelong_mid = :lock_mid AND sid = :sid");
    $updateStmt->bindParam(':lock_mid', $lock_mid);
    $updateStmt->bindParam(':sid', $sid);
    $updateStmt->execute();
} else {
    // 如果不存在，插入新数据
    $insertStmt = $dblj->prepare("INSERT INTO system_storage_locked (ibelong_mid, sid, istate) VALUES (:lock_mid, :sid, 1)");
    $insertStmt->bindParam(':lock_mid', $lock_mid);
    $insertStmt->bindParam(':sid', $sid);
    $insertStmt->execute();
}
    
    echo "上锁成功！<br/>";
}elseif($lock_canshu ==2){
    
// 查询是否存在相应的数据
$stmt = $dblj->prepare("SELECT * FROM system_storage_locked WHERE ibelong_mid = :lock_mid AND sid = :sid");
$stmt->bindParam(':lock_mid', $lock_mid);
$stmt->bindParam(':sid', $sid);
$stmt->execute();

// 获取查询结果的行数
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    // 如果存在，更新 istate 为 1
    $updateStmt = $dblj->prepare("UPDATE system_storage_locked SET istate = 0 WHERE ibelong_mid = :lock_mid AND sid = :sid");
    $updateStmt->bindParam(':lock_mid', $lock_mid);
    $updateStmt->bindParam(':sid', $sid);
    $updateStmt->execute();
} else {
    // 如果不存在，插入新数据
    $insertStmt = $dblj->prepare("INSERT INTO system_storage_locked (ibelong_mid, sid, istate) VALUES (:lock_mid, :sid, 0)");
    $insertStmt->bindParam(':lock_mid', $lock_mid);
    $insertStmt->bindParam(':sid', $sid);
    $insertStmt->execute();
}
    
    echo "开锁成功！<br/>";
}


$getcitystorage = \player\getcitystorage($player_nowmid,$sid,$dblj);
$getstorelock = $getcitystorage->now_store_lock?:0;
$now_city_storage = $getcitystorage->now_city_storage?:0;

$list_row = $game_config->list_row;
$city_storage = $game_config->default_storage;
$itemhtml = '';
$hangshu = 0;

if($op_canshu){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_1 = $encode->encode("cmd=gm_storage&op_canshu=$op_canshu&canshu=全部&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_2 = $encode->encode("cmd=gm_storage&op_canshu=$op_canshu&canshu=消耗品&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_3 = $encode->encode("cmd=gm_storage&op_canshu=$op_canshu&canshu=装备&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_4 = $encode->encode("cmd=gm_storage&op_canshu=$op_canshu&canshu=其它&ucmd=$cmid&sid=$sid");
}else{
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_1 = $encode->encode("cmd=gm_storage&canshu=全部&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_2 = $encode->encode("cmd=gm_storage&canshu=消耗品&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_3 = $encode->encode("cmd=gm_storage&canshu=装备&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$item_choose_url_4 = $encode->encode("cmd=gm_storage&canshu=其它&ucmd=$cmid&sid=$sid");
}
$sqlCount = '';
if(!$canshu){
    $canshu = '全部';
}


if($getstorelock==0){
    $lock_op = $encode->encode("cmd=gm_storage&lock_mid=$player_nowmid&lock_canshu=1&canshu=$canshu&ucmd=$cmid&sid=$sid");
    $lock_html = "<a href='?cmd=$lock_op'>仓库上锁</a><br/>";
}else{
    $unlock_op = $encode->encode("cmd=gm_storage&lock_mid=$player_nowmid&lock_canshu=2&canshu=$canshu&ucmd=$cmid&sid=$sid");
    $lock_html = "<a href='?cmd=$unlock_op'>仓库开锁</a><br/>";
}


// 当前页码
if ($list_page) {
    $currentPage = intval($list_page);
} else {
    $currentPage = 1;
}
// 计算偏移量
$offset = ($currentPage - 1) * $list_row;
if(!$op_canshu){
    
    
if($target_event =="get"){
    $store_now_count = \player\getstore_item_true_count($player_nowmid,$item_true_id,$sid,$dblj);
    $item_name = \lexical_analysis\color_string($item_name);
    if($player->uburthen + $get_count <=$player->umax_burthen &&$get_count >0){
    if($get_count>=$store_now_count){
        $dblj->exec("delete from system_storage where ibelong_mid = '$player_nowmid' and item_true_id = '$item_true_id' and sid = '$sid'");
        \player\addplayersx('uburthen',$store_now_count,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
        $item_type = \player\getitem($iid,$dblj)->itype;
        if($item_type !="兵器"&&$item_type !="防具"){
        $sql = "select iid from system_item where sid = '$sid' and iid = '$iid'";
        $cxjg = $dblj->query($sql);
        $get_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        if($get_ret){
            $dblj->exec("update system_item set icount = icount + $store_now_count where iid = '$iid' and sid = '$sid'");
        }else{
            $dblj->exec("insert into system_item(sid,uid,iid,icount)values('$sid','$player->uid','$iid','$store_now_count')");
        }
        }else{
            $dblj->exec("insert into system_item(item_true_id,sid,uid,iid,icount)values('$item_true_id','$sid','$player->uid','$iid','$store_now_count')");
        }
    echo "你取出{$item_name}x{$get_count}<br/>";
    $getcitystorage = \player\getcitystorage($player_nowmid,$sid,$dblj);
    $now_city_storage = $getcitystorage->now_city_storage?:0;
    }elseif($get_count<$store_now_count&&$get_count>0){
        $dblj->exec("update system_storage set icount = icount - $get_count where ibelong_mid = '$player_nowmid' and item_true_id = '$item_true_id' and sid = '$sid'");
        \player\addplayersx('uburthen',$get_count,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
        $sql = "select item_true_id,icount from system_item where sid = '$sid' and item_true_id = '$item_true_id'";
        $cxjg = $dblj->query($sql);
        $get_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        if($get_ret){
            $dblj->exec("update system_item set icount = icount + $get_count where item_true_id = '$item_true_id' and sid = '$sid'");
        }else{
            $dblj->exec("insert into system_item(item_true_id,sid,uid,iid,icount)values('$item_true_id','$sid','$player->uid','$iid','$get_count')");
        }
    echo "你取出{$item_name}x{$get_count}<br/>";
    $getcitystorage = \player\getcitystorage($player_nowmid,$sid,$dblj);
    $now_city_storage = $getcitystorage->now_city_storage?:0;
    }else{
    echo "错误！<br/>";
    }
}else{
    echo "背包空间不足或输入有误！<br/>";
}
}
    
    
switch($canshu){
        case '全部':
        $sql = "select * from system_storage WHERE iid in (select iid from system_item_module where iname like :keyword) and ibelong_mid = '$player_nowmid' and sid = '$sid' limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_storage where iid in (select iid from system_item_module where iname like :keyword) and ibelong_mid = '$player_nowmid' and sid ='$sid'";
            
        $item_choose_url = <<<HTML
全部 <a href="?cmd=$item_choose_url_2">消耗品</a> <a href="?cmd=$item_choose_url_3">装备</a> <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '消耗品':
        $sql = "select * from system_storage WHERE sid = '$sid' and  ibelong_mid = '$player_nowmid' and iid in(select iid from system_item_module where itype = '消耗品' and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_storage where ibelong_mid = '$player_nowmid' and sid ='$sid' and iid in(select iid from system_item_module where itype = '消耗品' and iname like :keyword)";
            
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> 消耗品 <a href="?cmd=$item_choose_url_3">装备</a> <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '装备':
        $sql = "select * from system_storage WHERE ibelong_mid = '$player_nowmid' and sid = '$sid' and iid in(select iid from system_item_module where  (itype = '兵器' || itype = '防具') and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_storage where ibelong_mid = '$player_nowmid' and sid ='$sid' and iid in(select iid from system_item_module where (itype = '兵器' || itype = '防具') and iname like :keyword)";
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> <a href="?cmd=$item_choose_url_2">消耗品</a> 装备 <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '其它':
        $sql = "select * from system_storage WHERE ibelong_mid = '$player_nowmid' and sid = '$sid' and iid in(select iid from system_item_module where (itype != '消耗品' and itype != '兵器' and itype != '防具') and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_storage where ibelong_mid = '$player_nowmid' and sid ='$sid' and iid in(select iid from system_item_module where (itype != '消耗品' and itype != '兵器' and itype != '防具') and iname like :keyword)";
            
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
    $item_true_id = $ret[$i]['item_true_id'];
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
$item_bak_name = $itemname;
$itemtype = $retitem['itype'];
$itemname = \lexical_analysis\process_photoshow($itemname);
$itemname = \lexical_analysis\color_string($itemname);

    if ($itemsum>0 &&$retitem && $canshu){
        $hangshu = $hangshu + 1;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $chakanitem = $encode->encode("cmd=gm_storage&op_canshu=3&list_page=$list_page&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&uid=$player->uid&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $outitem = $encode->encode("cmd=gm_storage&item_name=$item_bak_name&target_event=get&get_count=1&&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&sid=$sid");
        if($getstorelock==0){
        $itemhtml .="[$hangshu]<a href='?cmd=$chakanitem'>{$itemname}x{$itemsum}</a> <a href='?cmd=$outitem'>取出</a><br/>";
        }else{
        $itemhtml .="[$hangshu]<a href='?cmd=$chakanitem'>{$itemname}x{$itemsum}</a> <br/>";
        }
    }
}
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if ($currentPage > 2 && $currentPage == $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&canshu=$canshu&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}

if($totalPages >1){
    $page_html .="<br/>";
}

if($item_type_sum ==0){
$itemhtml .="该分类下没有存放物品！<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gostorage = $encode->encode("cmd=gm_storage&op_canshu=1&ucmd=$cmid&sid=$sid");
if($keyword =="%"){
    $keyword = "";
}
$bagitemhtml =<<<HTML
[{$map_name}的仓库]<br/>
仓库负重：({$now_city_storage}|{$city_storage})<br/>
背包负重：({$player->uburthen}|{$player->umax_burthen})<br/>
<br/>
$item_choose_url
<form method="post">
<input name="ucmd" type="hidden" value="{$cmid}">
<input name="kw" type="text" value="{$keyword}"><br/>
<input name="submit" type="submit" title="物品搜索" value="物品搜索">
</form><br/>
你仓库有物品:<br/>
$itemhtml
$page_html
<a href="?cmd=$gostorage">存入物品</a><br/>
$lock_html
----------<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
}elseif ($op_canshu ==1) {
    
if($target_event =="store"){
    $item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
    $item_name = \lexical_analysis\color_string($item_name);
    if($now_city_storage + $store_count <=$city_storage &&$store_count >0){
    if($store_count>=$item_now_count){
        $dblj->exec("delete from system_item where item_true_id = '$item_true_id' and sid = '$sid'");
        \player\addplayersx('uburthen',-$item_now_count,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
        $sql = "select item_true_id,icount from system_storage where ibelong_mid = '$player_nowmid' and sid = '$sid' and item_true_id = '$item_true_id'";
        $cxjg = $dblj->query($sql);
        $store_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        if($store_ret){
            $dblj->exec("update system_storage set icount = icount + $item_now_count where item_true_id = '$item_true_id' and ibelong_mid = '$player_nowmid' and sid = '$sid'");
        }else{
            $dblj->exec("insert into system_storage(ibelong_mid,item_true_id,sid,uid,iid,icount)values('$player_nowmid','$item_true_id','$sid','$player->uid','$iid','$item_now_count')");
        }
    echo "你存入{$item_name}x{$item_now_count}<br/>";
    $getcitystorage = \player\getcitystorage($player_nowmid,$sid,$dblj);
    $now_city_storage = $getcitystorage->now_city_storage?:0;
    }elseif($store_count<$item_now_count&&$store_count>0){
        $dblj->exec("update system_item set icount = icount - $store_count where item_true_id = '$item_true_id' and sid = '$sid'");
        \player\addplayersx('uburthen',-$store_count,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
        $sql = "select item_true_id,icount from system_storage where ibelong_mid = '$player_nowmid' and sid = '$sid' and item_true_id = '$item_true_id'";
        $cxjg = $dblj->query($sql);
        $store_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
        if($store_ret){
            $dblj->exec("update system_storage set icount = icount + $store_count where item_true_id = '$item_true_id' and ibelong_mid = '$player_nowmid' and sid = '$sid'");
        }else{
            $dblj->exec("insert into system_storage(ibelong_mid,item_true_id,sid,uid,iid,icount)values('$player_nowmid','$item_true_id','$sid','$player->uid','$iid','$store_count')");
        }
        //这里更新item表中的物品数量，查询storage表中有无此类型数据，没有就插入一条数据，有就合并
    echo "你存入{$item_name}x{$store_count}<br/>";
    $getcitystorage = \player\getcitystorage($player_nowmid,$sid,$dblj);
    $now_city_storage = $getcitystorage->now_city_storage?:0;
    }else{
    echo "错误！<br/>";
    }
}else{
        echo "仓库空间不足或输入有误！<br/>";
}
}
    
switch($canshu){
        case '全部':
        $sql = "select * from system_item WHERE iid in (select iid from system_item_module where iname like :keyword) and sid = '$sid' and iequiped = 0 and isale_state = 0 limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where iid in (select iid from system_item_module where iname like :keyword) and sid ='$sid' and iequiped = 0 and isale_state = 0";
            
        $item_choose_url = <<<HTML
全部 <a href="?cmd=$item_choose_url_2">消耗品</a> <a href="?cmd=$item_choose_url_3">装备</a> <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '消耗品':
        $sql = "select * from system_item WHERE sid = '$sid' and iequiped = 0 and isale_state = 0 and iid in(select iid from system_item_module where itype = '消耗品' and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where sid ='$sid' and iequiped = 0 and isale_state = 0 and iid in(select iid from system_item_module where itype = '消耗品' and iname like :keyword)";
            
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> 消耗品 <a href="?cmd=$item_choose_url_3">装备</a> <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '装备':
        $sql = "select * from system_item WHERE sid = '$sid' and iequiped = 0 and isale_state = 0 and iid in(select iid from system_item_module where  (itype = '兵器' || itype = '防具') and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where sid ='$sid' and iequiped = 0 and isale_state = 0 and iid in(select iid from system_item_module where (itype = '兵器' || itype = '防具') and iname like :keyword)";
        $item_choose_url = <<<HTML
<a href="?cmd=$item_choose_url_1">全部</a> <a href="?cmd=$item_choose_url_2">消耗品</a> 装备 <a href="?cmd=$item_choose_url_4">其它</a><br/>
<br/>
HTML;
            break;
        case '其它':
        $sql = "select * from system_item WHERE sid = '$sid' and iequiped = 0 and isale_state = 0 and iid in(select iid from system_item_module where (itype != '消耗品' and itype != '兵器' and itype != '防具') and iname like :keyword) limit $offset,$list_row";
        // 计算总行数
        $sqlCount = "SELECT COUNT(*) as total FROM system_item where sid ='$sid' and iequiped = 0 and isale_state = 0 and iid in(select iid from system_item_module where (itype != '消耗品' and itype != '兵器' and itype != '防具') and iname like :keyword)";
            
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
    $item_true_id = $ret[$i]['item_true_id'];

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
$item_bak_name = $itemname;
$itemname = \lexical_analysis\color_string($itemname);
$itemname = \lexical_analysis\process_photoshow($itemname);

    if ($itemsum>0 &&$retitem && $canshu){
        $hangshu = $hangshu + 1;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $chakanitem = $encode->encode("cmd=gm_storage&op_canshu=4&list_page=$list_page&canshu=$canshu&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&uid=$player->uid&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $store_item = $encode->encode("cmd=gm_storage&op_canshu=1&item_name=$item_bak_name&target_event=store&store_count=1&ucmd=$cmid&item_true_id=$item_true_id&iid=$itemid&sid=$sid");
        $itemhtml .="[$hangshu]<a href='?cmd=$chakanitem'>{$itemname}x{$itemsum}</a> <a href='?cmd=$store_item'>存入</a><br/>";
    }
}
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if ($currentPage > 2 && $currentPage == $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&op_canshu=1&canshu=$canshu&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&op_canshu=1&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&op_canshu=1&canshu=$canshu&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=gm_storage&ucmd=$cmid&op_canshu=1&canshu=$canshu&list_page=$list_page&sid=$sid");
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
$gomystorage = $encode->encode("cmd=gm_storage&canshu=$canshu&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
if($keyword =="%"){
    $keyword = "";
}
$bagitemhtml =<<<HTML
[{$map_name}的仓库]<br/>
仓库负重：({$now_city_storage}|{$city_storage})<br/>
背包负重：({$player->uburthen}|{$player->umax_burthen})<br/>
<br/>
$item_choose_url
<form method="post">
<input name="ucmd" type="hidden" value="{$cmid}">
<input name="kw" type="text" value="{$keyword}"><br/>
<input name="submit" type="submit" title="物品搜索" value="物品搜索">
</form><br/>
你身上有物品:<br/>
$itemhtml
$page_html

----------
<br/><a href="?cmd=$gomystorage">返回仓库</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
}elseif($op_canshu ==3){
$item_para = \player\getitem($iid,$dblj);
$item_name = $item_para->iname;
$item_bak_name = $item_name;
$item_name = \lexical_analysis\color_string($item_name);
$item_desc = $item_para->idesc;
$item_desc = \lexical_analysis\process_string($item_desc,$sid);
$item_weight = $item_para->iweight;
$item_icount = \player\getstore_item_true_count($player_nowmid,$item_true_id,$sid,$dblj);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$get_post = $encode->encode("cmd=gm_storage&canshu=$canshu&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$get_all = $encode->encode("cmd=gm_storage&item_name=$item_bak_name&target_event=get&get_count=$item_icount&&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomystorage = $encode->encode("cmd=gm_storage&list_page=$list_page&canshu=$canshu&ucmd=$cmid&sid=$sid");


if($getstorelock==0){
    $get_out_html = <<<HTML
<form action="?cmd=$get_post" method="post">
<input type="hidden" name="item_true_id" value="$item_true_id">
<input type="hidden" name="iid" value="$iid">
<input type="hidden" name="target_event" value="get">
<input type="hidden" name="item_name" value="{$item_bak_name}">
请输入你要取出的数量(共{$item_icount}):<input name="get_count" type="text" value="{$item_icount}" maxlength="10"/><br/>
<input name="submit" type="submit" title="取出" value="取出">
</form><br/>
<a href="?cmd=$get_all">取出全部</a><br/>
HTML;
}else{
    $get_out_html = "仓库锁上了，暂时不能取出！<br/>";
}

$bagitemhtml = <<<HTML
{$item_name}x{$item_icount}<br/>
介绍:{$item_desc}<br/>
重量:{$item_weight}<br/>
你的仓库容量:{$now_city_storage}/{$city_storage}<br/>
你的负重:{$player->uburthen}/{$player->umax_burthen}<br/>
$get_out_html
----------<br/>
<a href="?cmd=$gomystorage">返回列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}elseif($op_canshu ==4){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$item_para = \player\getitem_true($item_true_id,$dblj);
$item_name = $item_para->iname;
$item_bak_name = $item_name;
$item_name = \lexical_analysis\color_string($item_name);
$item_desc = $item_para->idesc;
$item_desc = \lexical_analysis\process_string($item_desc,$sid);
$item_weight = $item_para->iweight;
$item_icount = \player\getitem_true_count($item_true_id,$sid,$dblj);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$store_post = $encode->encode("cmd=gm_storage&op_canshu=1&canshu=$canshu&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$store_all = $encode->encode("cmd=gm_storage&op_canshu=1&item_name=$item_bak_name&target_event=store&store_count=$item_icount&&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$golist = $encode->encode("cmd=gm_storage&op_canshu=1&&list_page=$list_page&canshu=$canshu&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomystorage = $encode->encode("cmd=gm_storage&list_page=$list_page&canshu=$canshu&ucmd=$cmid&sid=$sid");
$bagitemhtml = <<<HTML
{$item_name}x{$item_icount}<br/>
介绍:{$item_desc}<br/>
重量:{$item_weight}<br/>
你的仓库容量:{$now_city_storage}/{$city_storage}<br/>
你的负重:{$player->uburthen}/{$player->umax_burthen}<br/>
<form action="?cmd=$store_post" method="post">
<input type="hidden" name="item_true_id" value="{$item_true_id}">
<input type="hidden" name="iid" value="{$iid}">
<input type="hidden" name="target_event" value="store">
<input type="hidden" name="item_name" value="{$item_bak_name}">
请输入你要存入的数量(共{$item_icount}):<input name="store_count" type="text" value="{$item_icount}" maxlength="10"/><br/>
<input name="submit" type="submit" title="存入" value="存入">
</form><br/>
<a href="?cmd=$store_all">存入全部</a><br/>
----------<br/>
<a href="?cmd=$golist">返回列表</a><br/>
<a href="?cmd=$gomystorage">返回仓库</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
echo $bagitemhtml;
?>