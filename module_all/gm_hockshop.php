<?php
if($_POST['iid']){
    $item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
    if($count >0){
    if($item_now_count >=($_POST['count'])){
        $total = ($_POST['count'])*($_POST['item_value']);
        $item_name = \player\getitem($_POST['iid'],$dblj)->iname;
        $sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$item_true_id' and name = 'iname'";
        $stmt = $dblj->query($sql_2);
        if($stmt->rowCount() >0){
        $item_name = $stmt->fetchColumn();
        }
        $item_name = \lexical_analysis\color_string($item_name);
        $item_total_weight =  \player\getitem_true($item_true_id,$dblj)->iweight *$count ;
        \player\changeplayeritem($item_true_id,-$_POST['count'],$sid,$dblj);
        $sql = "update game1 set umoney = umoney +  '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        echo "出售成功，你出售了{$item_name}x{$count}，获得了{$total}{$gm_post->money_measure}{$gm_post->money_name}!<br/>";
        \player\addplayersx('uburthen',-$item_total_weight,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "出售失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}

if($canshu == 'hockshop'){
    $item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
    if($item_now_count >0){
    if($item_now_count){
        $total = ($item_now_count)*($item_value);
        $item_name = \player\getitem($iid,$dblj)->iname;
        $sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$item_true_id' and name = 'iname'";
        $stmt = $dblj->query($sql_2);
        if($stmt->rowCount() >0){
        $item_name = $stmt->fetchColumn();
        }
        $item_type = \player\getitem($iid,$dblj)->itype;
        $item_weight_total = \player\getitem($iid,$dblj)->iweight * $item_now_count;
        $item_name = \lexical_analysis\color_string($item_name);
        \player\changeplayeritem($item_true_id,-$item_now_count,$sid,$dblj);
        $sql = "update game1 set umoney = umoney +  '$total' where sid = '$sid' ";
        $dblj->exec($sql);
        
        if($item_type =="兵器"||$item_type =="防具"){
            $dblj->exec("DELETE from player_equip_mosaic where equip_id = '$item_true_id'");
        }
        
        echo "出售成功，你出售了{$item_name}x{$item_now_count}，获得了{$total}{$gm_post->money_measure}{$gm_post->money_name}!<br/>";
        \player\addplayersx('uburthen',-$item_weight_total,$sid,$dblj);
        $player = \player\getplayer($sid,$dblj);
    }else{
        echo "出售失败!<br/>";
    }
    }else{
        echo "请不要输入负数!<br/>";
    }
    
}
if(!$gm_post_canshu){
$pos = 0;
$list_row = \player\getgameconfig($dblj)->list_row;

// 当前页码
if ($list_page) {
    $currentPage = intval($list_page);
} else {
    $currentPage = 1;
}

// 计算偏移量
$offset = ($currentPage - 1) * $list_row;

$user_item_para = player\getitem_user($sid,$dblj,$offset,$list_row);
$totalRows = player\getitem_user_count($sid,$dblj,$offset,$list_row);

// 计算总页数
$totalPages = ceil($totalRows / $list_row);
if($currentPage > $totalPages&&$totalPages>0){
    $currentPage = $totalPages;
// 重新计算偏移量
$offset = ($currentPage - 1) * $list_row;

$user_item_para = player\getitem_user($sid,$dblj,$offset,$list_row);
$totalRows =player\getitem_user_count($sid,$dblj,$offset,$list_row);
// 计算总页数
$totalPages = ceil($totalRows / $list_row);
}
if (!empty($user_item_para)){
for ($i = 0;$i < count($user_item_para);$i++) {
    $item_detail = $user_item_para[$i];
    $hangshu = $offset + $i + 1;
    $item_id = $item_detail['iid'];
    $item_true_id = $item_detail['item_true_id'];
    $item_name = $item_detail['iname'];
    $sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$item_true_id' and name = 'iname'";
    $stmt = $dblj->query($sql_2);
    if($stmt->rowCount() >0){
    $item_name = $stmt->fetchColumn();
    }
    $item_count = $item_detail['icount'];
    $item_name = \lexical_analysis\color_string($item_name);
    $item_type = $item_detail['itype'];
    if($item_type =='兵器'||$item_type == '防具'){
    $result = $db->query("SELECT value from system_addition_attr where oid = 'item' and mid = '$item_true_id' and name = 'iprice'");
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $item_value =  $row['value'];
    }else{
    $item_value = $item_detail['iprice'];
    }
    }else{
    $item_value = $item_detail['iprice'];
    }
    $item_weight = $item_detail['iweight'];
    $item_desc = $item_detail['idesc'];
    $item_desc = \lexical_analysis\process_string($item_desc,$sid);
    $item_equiped = $item_detail['iequiped'];
    $item_sale_state = $item_detail['isale_state'];
    $item_no_out = $item_detail['ino_out'];
    if($item_no_out==0&&$item_equiped==0&&$item_sale_state==0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $item_hockshop = $encode->encode("cmd=gm_hockshop&gm_post_canshu=1&list_page=$list_page&ucmd=$cmid&item_true_id=$item_true_id&iid=$item_id&mid=$mid&sid=$sid");
    $hockshop_item_list .= <<<HTML
    <a href="?cmd=$item_hockshop">{$hangshu}.{$item_name}({$item_value}{$gm_post->money_measure})</a>你拥有({$item_count})<br/>
HTML;
}
    }

if ($currentPage > 2 && $currentPage <= $totalPages) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $list_page = $currentPage -  1;
    
    if($kw){
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=$list_page&sid=$sid");
    }else{
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=$list_page&sid=$sid");
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
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=$list_page&sid=$sid");
    }else{
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=$list_page&sid=$sid");
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
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=$list_page&sid=$sid");
    }else{
    $main_page = $encode->encode("cmd=gm_hockshop&ucmd=$cmid&list_page=$list_page&sid=$sid");
    }
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}

if($totalPages >1){
    $page_html .="<br/>";
}

}
else{
$hockshop_item_list ="暂时没有可以出售的物品！<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$shop_html = <<<HTML
<p>出售装备将会清空镶嵌物！<br/>
<p>此处所有物品回收折扣率为100.0%<br/>
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/>
请选择你要出售的物品：<br/>
$hockshop_item_list
$page_html
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
if($gm_post_canshu ==1){
$item_now_count = \player\getitem_true_count($item_true_id,$sid,$dblj);
$item_para = player\getitem($iid,$dblj);
$item_name = $item_para ->iname;
$sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$item_true_id' and name = 'iname'";
$stmt = $dblj->query($sql_2);
if($stmt->rowCount() >0){
$item_name = $stmt->fetchColumn();
}
$item_name = \lexical_analysis\color_string($item_name);

$item_type = $item_para ->itype;
if($item_type =='兵器'||$item_type == '防具'){
$result = $db->query("SELECT value from system_addition_attr where oid = 'item' and mid = '$item_true_id' and name = 'iprice'");
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$item_value =  $row['value'];
}else{
$item_value = $item_para ->iprice;
}
}else{
$item_value = $item_para ->iprice;
}

$item_weight = $item_para ->iweight;
$item_desc = $item_para ->idesc;
$item_desc = \lexical_analysis\process_string($item_desc,$sid);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$hockshop_all = $encode->encode("cmd=gm_hockshop&canshu=hockshop&ucmd=$cmid&list_page=$list_page&item_true_id=$item_true_id&iid=$iid&item_value=$item_value&count=$item_now_count&mid=$mid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$hockshop_form = $encode->encode("cmd=gm_hockshop&list_page=$list_page&ucmd=$cmid&mid=$mid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobacklist = $encode->encode("cmd=gm_hockshop&list_page=$list_page&ucmd=$cmid&mid=$mid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$shop_html = <<<HTML
{$item_name}x1<br/>
重量:{$item_weight}<br/>
价格:{$item_value}<br/>
介绍:{$item_desc}<br/>
你身上有{$gm_post->money_name}:{$player->umoney}{$gm_post->money_measure}<br/>
负重:{$player->uburthen}/{$player->umax_burthen}<br/><br/>
<form action="?cmd=$hockshop_form" method="post">
<input name="iid" type="hidden" value="{$iid}">
<input name="item_true_id" type="hidden" value="{$item_true_id}">
<input name="item_value" type="hidden" value="{$item_value}">
请输入你要出售的数量(一共:{$item_now_count})：<input name="count" type="tel" value="{$item_now_count}" format="*N" style="-wap-input-format:*N" maxlength="5"/><br/>
<input name="submit" type="submit" title="出售" value="出售"/></form><br/>
<a href="?cmd=$hockshop_all">出售全部</a><br/>
<a href="?cmd=$gobacklist">返回列表</a><br/>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</p>
HTML;
}
echo $shop_html;
?>