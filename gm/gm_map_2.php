<?php

if($list_page){
$dblj->exec("update system_designer_assist set op_target = 'map_design',op_canshu = '$list_page' where sid = '$sid'");
}else{
$dblj->exec("update system_designer_assist set op_target = 'map_design',op_canshu = '' where sid = '$sid'");
}
$player = player\getplayer($sid,$dblj);
$gm = $encode->encode("cmd=gm&sid=$sid");
$map = '';
$hangshu = 0;
$br = 0;
$area_add = $encode->encode("cmd=area_post&gm_post_canshu=1&sid=$sid");
if($post_canshu ==0){
    
if($delete_id){
        $sql = "delete from system_area where id ='$delete_id'";
        $dblj->exec($sql);
    }
    
if(isset($now_pos)&&isset($next_pos)){
    $sql = "update system_area set pos = 19980925 where pos = '$now_pos'";
    $dblj->exec($sql);
    $sql = "update system_area set pos = '$now_pos' where pos = '$next_pos'";
    $dblj->exec($sql);
    $sql = "update system_area set pos = '$next_pos' where pos = 19980925";
    $dblj->exec($sql);
}
    
$cxallqy = \gm\getqy_all($dblj);
for ($i=0;$i<count($cxallqy);$i++){
    $qyname = $cxallqy[$i]['name'];
    $qy_id = $cxallqy[$i]['id'];
    $qy_pos = $cxallqy[$i]['pos'];
if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_area` where name LIKE :keyword ORDER BY pos ASC";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $cxallqy = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $qyname = $cxallqy[$i]['name'];
    $qy_id = $cxallqy[$i]['id'];
    $qy_pos = $cxallqy[$i]['pos'];
}
  if($qy_id ==0){
      $cxallmaps = \gm\getmid_detail($dblj,0);
      $qy_map_count = @count($cxallmaps);
      $target_mid = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=0&sid=$sid");
        $no_area =<<<HTML
        <a href="?cmd=$target_mid" >未分区($qy_map_count)</a><br/>
HTML;
  }elseif($qy_id !=0){
        $cxallmaps = \gm\getmid_detail($dblj,$qy_id);
        $qy_map_count = @count($cxallmaps);
        $hangshu +=1;
        $target_mid = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=$qy_id&sid=$sid");
    if($hangshu ==1 && count($cxallqy)>2){
    $next_pos = $cxallqy[2]['pos'];
    $move_next = $encode->encode("cmd=gm_map_2&now_pos=$qy_pos&next_pos=$next_pos&sid=$sid");
    $map .=<<<HTML
    <a href="?cmd=$target_mid" >{$hangshu}.{$qyname}(a{$qy_id})($qy_map_count)</a>[ <font color ="red">上移</font> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}elseif ($hangshu ==count($cxallqy)-1 && count($cxallqy)>2) {
    $next_pos = $cxallqy[$hangshu -1]['pos'];
    $move_last = $encode->encode("cmd=gm_map_2&now_pos=$qy_pos&next_pos=$next_pos&sid=$sid");
    $map .=<<<HTML
    <a href="?cmd=$target_mid" >{$hangshu}.{$qyname}(a{$qy_id})($qy_map_count)</a>[ <a href="?cmd=$move_last">上移</a> <font color ="red">下移</font> ]<br/>
HTML;
}elseif($hangshu !=1 && $hangshu !=count($cxallqy)-1 && count($cxallqy)>2){
    $last_pos = $cxallqy[$hangshu -1]['pos'];
    $next_pos = $cxallqy[$hangshu +1]['pos'];
    $move_last = $encode->encode("cmd=gm_map_2&now_pos=$qy_pos&next_pos=$last_pos&sid=$sid");
    $move_next = $encode->encode("cmd=gm_map_2&now_pos=$qy_pos&next_pos=$next_pos&sid=$sid");
    $map .=<<<HTML
    <a href="?cmd=$target_mid" >{$hangshu}.{$qyname}(a{$qy_id})($qy_map_count)</a>[ <a href="?cmd=$move_last">上移</a> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}else{
    $map .=<<<HTML
    <a href="?cmd=$target_mid" >{$hangshu}.{$qyname}(a{$qy_id})($qy_map_count)</a>[ <font color ="red">上移 下移</font> ]<br/>
HTML;
}
  }}




$allmap = <<<HTML
[地图设计]<br/>
目前定义了如下区域：<br/>
$map
$no_area<br/>
<a href="?cmd=$area_add" >增加区域</a><br/>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $allmap;
}
elseif($post_canshu ==1){

if ($update ==2){
    $nowdate = date('Y-m-d H:i:s');
    $sql = "SELECT mid from system_map where marea_id ='$qy_id'";
    $stmt = $dblj->query($sql);
    $map_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($map_ids as $map_id_s){
    $map_id = $map_id_s['mid'];
    $sql = "update system_map set mgtime='$nowdate' WHERE mid='$map_id'";
    $dblj->exec($sql);
    $clmid = '';
    $npc_s = '';
    $data_n = '';
    $clmid_npc_count = '';
    $clmid_item_count = '';
    $clmid = player\getmid($map_id,$dblj);
    if($clmid->mnpc!=''){
    $data_n = $clmid->mnpc;
    $npc_s = explode(",", $data_n); // 使用逗号分隔字符串，得到每个项
    foreach ($npc_s as &$npc_a) {
        $parts = explode("|", $npc_a); // 使用竖线分隔每个项
        if (count($parts) === 2||count($parts) === 3) {
            $id = $parts[0];
            $npc_count = $parts[1];
            $npc_show_cond = $parts[2];
            $npc_count = \lexical_analysis\process_string($npc_count,$sid);
            $npc_count = \lexical_analysis\process_string($npc_count,$sid);
            @$npc_count = eval("return $npc_count;");
            
            // 更新处理后的值
            $npc_a = "$id|$npc_count|$npc_show_cond";
        }
    }
    // 将处理后的数据重新组合成字符串
    $clmid_npc_count = implode(",", $npc_s);
    $clmid = player\getmid($map_id,$dblj);
    $retgw = explode(",",$clmid_npc_count);
    foreach ($retgw as $itemgw){
        $gwinfo = explode("|",$itemgw);
        $guaiwu = \player\getnpc($gwinfo[0],$dblj);
        $guaiwu->nid = $gwinfo[0];
        if($guaiwu->nkill ==1){
        $sql = " delete from system_npc_midguaiwu where nid = '$guaiwu->nid' and nmid = '$map_id' and nsid = ''";
        $cxjg =$dblj->exec($sql);
        for ($n=0;$n<$gwinfo[1];$n++){
            // 要复制的数据行id
            $nid = $guaiwu->nid;
            $nmid = $map_id;
            // 获取旧表字段列表
            $stmt = $dblj->prepare("SHOW COLUMNS FROM system_npc");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            // 构建动态插入语句
            $cols = implode(", ",$columns);
            $nowdate = date('Y-m-d H:i:s');
            $sql = "INSERT INTO system_npc_midguaiwu ($cols, nmid,ncreate_time) SELECT $cols, :nmid ,:nowdate FROM system_npc WHERE nid = :nid;";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':nmid', $nmid, PDO::PARAM_INT);
            $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
            $stmt->bindParam(':nowdate', $nowdate, PDO::PARAM_INT);
            $stmt->execute();
        }
}
    }
}
    if($clmid->mitem!=''){
    $data_i = $clmid->mitem;
    $items = explode(",", $data_i); // 使用逗号分隔字符串，得到每个项
    foreach ($items as &$item) {
        $parts = explode("|", $item); // 使用竖线分隔每个项
        if (count($parts) === 2||count($parts) === 3) {
            $id = $parts[0];
            $item_count = $parts[1];
            $item_count = \lexical_analysis\process_string($item_count,$sid);
            $item_count = \lexical_analysis\process_string($item_count,$sid);
            @$item_count = eval("return $item_count;");
            
            // 更新处理后的值
            $item = "$id|$item_count";
        }
    }
    // 将处理后的数据重新组合成字符串
    $clmid_item_count = implode(",", $items);
    }
    $sql = "update system_map set mgtime='$nowdate',mitem_now = '$clmid_item_count',mnpc_now = '$clmid_npc_count' WHERE mid='$map_id'";
    $dblj->exec($sql);
    }
    echo "已更新该区域所有场景对象！请勿刷新当前页面，否则会二次刷新!<br/>";
}
    if($_POST['modify'] ==1){
        // 获取表单参数
        $marea_name = $_POST['marea_name'];
        $qy_id = $_POST['qy_id'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $kill = $_POST['kill'];
        $map_x = $_POST['map_x'];
        $map_y = $_POST['map_y'];
        $withcoord = $_POST['withcoord'];
// 在地图插入循环之前创建一个地图数据结构
$mapData = [];

for ($i = 1; $i <= $map_x; $i++) {
    for ($j = 1; $j <= $map_y; $j++) {
        // 构建 SQL 插入语句
        $sql = "INSERT INTO system_map (marea_name, marea_id, mname, mdesc, mkill)
                VALUES (:marea_name, :marea_id, :mname, :mdesc, :mkill)";
        
        // 准备并执行插入语句
        $stmt = $dblj->prepare($sql);
        if($withcoord ==1){
        $stmt->execute([
            'marea_name' => $marea_name,
            'marea_id' => $qy_id,
            'mname' => $name."({$i},{$j})",
            'mdesc' => $desc,
            'mkill' => $kill,
        ]);
        }else{
        $stmt->execute([
            'marea_name' => $marea_name,
            'marea_id' => $qy_id,
            'mname' => $name,
            'mdesc' => $desc,
            'mkill' => $kill,
        ]);
        }

        // 获取当前插入的地图ID
        $currentMapId = $dblj->lastInsertId();

        // 更新相邻坐标的链接字段
        if (isset($mapData[$i][$j + 1])) {
            $dblj->query("UPDATE system_map SET mup = {$mapData[$i][$j + 1]} WHERE mid = {$currentMapId}");
            $dblj->query("UPDATE system_map SET mdown = {$currentMapId} WHERE mid = {$mapData[$i][$j + 1]}");
        }

        if (isset($mapData[$i][$j - 1])) {
            $dblj->query("UPDATE system_map SET mdown = {$mapData[$i][$j - 1]} WHERE mid = {$currentMapId}");
            $dblj->query("UPDATE system_map SET mup = {$currentMapId} WHERE mid = {$mapData[$i][$j - 1]}");
        }

        if (isset($mapData[$i + 1][$j])) {
            $dblj->query("UPDATE system_map SET mright = {$mapData[$i + 1][$j]} WHERE mid = {$currentMapId}");
            $dblj->query("UPDATE system_map SET mleft = {$currentMapId} WHERE mid = {$mapData[$i + 1][$j]}");
        }

        if (isset($mapData[$i - 1][$j])) {
            $dblj->query("UPDATE system_map SET mleft = {$mapData[$i - 1][$j]} WHERE mid = {$currentMapId}");
            $dblj->query("UPDATE system_map SET mright = {$currentMapId} WHERE mid = {$mapData[$i - 1][$j]}");
        }

        // 更新地图数据结构
        $mapData[$i][$j] = $currentMapId;
    }
}

    }
    elseif($_POST['modify'] ==2){
        $marea_name = $_POST['marea_name'];
        $qy_id = $_POST['qy_id'];
        $sql = "update system_area set name = '$marea_name' where id = '$qy_id'";
        $dblj->exec($sql);
        $sql = "update system_map set marea_name = '$marea_name' where marea_id = '$qy_id'";
        $dblj->exec($sql);
    }
    elseif($_POST['modify'] ==3){
    $cxalladdmaps = \player\getmid_detail($dblj,$qy_id);
    for($i=0;$i<@count($cxalladdmaps);$i++){
        $addmapmid = $cxalladdmaps[$i]['mid'];
        // 获取原始字段值
        $stmt = $dblj->prepare("SELECT mnpc FROM system_map WHERE mid = '$addmapmid'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $oldData = $result["mnpc"];
        if($oldData ==''){
            $new = $_POST['add_this_id']."|".$_POST['add_count'];
        }else{
            $new = $oldData.",".$_POST['add_this_id']."|".$_POST['add_count'];
        }
        $sql = "UPDATE system_map SET mnpc = '$new' where mid = '$addmapmid'";
        $dblj->exec($sql);
    }
    echo "已向该区域批量添加了NPC!请勿刷新当前页面，否则会二次添加!<br/>";
    }
    elseif($_POST['modify'] ==4){
    echo "更新成功！<br/>";
    $dblj->exec("UPDATE system_area set belong = '$area_belong' where id = '$qy_id'");
    }
    $re_area = $encode->encode("cmd=gm_map_2&post_canshu=0&sid=$sid");
    $hangshu = 0;
    $cxthe_qy = \gm\getqy($dblj,$qy_id);
    $cxallmaps = \gm\getmid_detail($dblj,$qy_id);
    $marea_name = $cxthe_qy['name'];
    $qy_id = $cxthe_qy['id'];
    if($delete_id == 'no'){
        if($qy_id ==0){
        echo "不能删除未分区区域!<br/>";
        }else{
        echo "区域内还有场景，不能删除该区域!<br/>";
        }
    }
    if(!$cxallmaps){
    $area_delete = $encode->encode("cmd=gm_map_2&delete_id=$qy_id&post_canshu=0&sid=$sid");
    }else{
    $area_delete = $encode->encode("cmd=gm_map_2&delete_id=no&qy_id=$qy_id&post_canshu=1&sid=$sid");
    }
    
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
    $sqlCount = "SELECT COUNT(*) as total FROM system_map where marea_id = '$qy_id'";
    $countResult = $dblj->query($sqlCount);
    $countRow = $countResult->fetch(PDO::FETCH_ASSOC);
    $totalRows = $countRow['total'];
    
    
    // 计算总页数
    $totalPages = ceil($totalRows / $list_row);
    $cxallmaps = \gm\getmid_detail($dblj,$qy_id,$offset,$list_row);
    $hangshu = $offset;
    foreach ($cxallmaps as $row) {
        // 输出数据
            $id = $row["mid"];
            $name = $row["mname"];
            $qy_id = $row["marea_id"];
            $map_mcreat_event = $row['mcreat_event_id'];
            $map_mlook_event = $row['mlook_event_id'];
            $map_minto_event = $row['minto_event_id'];
            $map_mout_event = $row['mout_event_id'];
            $map_mminute_event = $row['mminute_event_id'];
            $map_event_count = ($map_mcreat_event ? 1 : 0) + ($map_mlook_event ? 1 : 0) + ($map_minto_event ? 1 : 0) + ($map_mout_event ? 1 : 0) + ($map_mminute_event ? 1 : 0);
            $hangshu +=1;
            $target_mid = $encode->encode("cmd=gm_post_4&target_midid=$id&target_midname=$name&qy_id=$qy_id&sid=$sid");
            $map .=<<<HTML
        <a href="?cmd=$target_mid" >{$hangshu}.{$name}(s{$id})</a>[{$map_event_count}]<br/>
HTML;
}
$map_out = $encode->encode("cmd=gm_post_4&out_canshu=1&marea_name=$marea_name&qy_id=$qy_id&sid=$sid");
$map_in = $encode->encode("cmd=gm_post_4&in_canshu=1&marea_name=$marea_name&qy_id=$qy_id&sid=$sid");
$map_add = $encode->encode("cmd=gm_post_4&map_add_canshu=1&marea_name=$marea_name&qy_id=$qy_id&sid=$sid");
$map_add_batch = $encode->encode("cmd=gm_post_4&add_batch=1&post_canshu=2&marea_name=$marea_name&qy_id=$qy_id&sid=$sid");
$npc_add_batch = $encode->encode("cmd=gm_post_4&add_batch=1&canshu=1&post_canshu=4&qy_id=$qy_id&sid=$sid");
$update_all_data = $encode->encode("cmd=gm_post_4&update=2&post_canshu=1&qy_id=$qy_id&sid=$sid");
if($qy_id !=0){
$area_modify = $encode->encode("cmd=gm_post_4&area_modify=1&post_canshu=3&marea_name=$marea_name&qy_id=$qy_id&sid=$sid");
$area_belong = \gm\getqy($dblj,$qy_id)['belong'];
$selectedOption1 = ($area_belong == "1") ? 'selected' : '';
$selectedOption2 = ($area_belong == "2") ? 'selected' : '';
$selectedOption3 = ($area_belong == "3") ? 'selected' : '';
$area_change_html .= <<<HTML
<form method="post">
<input type="hidden" name="marea_name" value="{$marea_name}">
<input type="hidden" name="qy_id" value="{$qy_id}">
<input type="hidden" name="post_canshu" value="1">
<input name="modify" type="hidden" title="确定" value="4"/>
所属大区域:<select name="area_belong">
<option value="0" >失落之地</option>
<option value="1" $selectedOption1>日出之地</option>
<option value="2" $selectedOption2>灼热之地</option>
<option value="3" $selectedOption3>日落之地</option>
<option value="4" $selectedOption3>极寒之地</option>
<option value="5" $selectedOption3>湿热之地</option>
</select>
<input type="submit" value="提交"><br/>
HTML;
$area_change_html .= "<a href='?cmd=$area_modify' >修改区域名称</a><br/>";

}

if ($currentPage > 2) {
$main_page = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&list_page=1&sid=$sid");
$page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
$list_page = $currentPage -  1;
$main_page = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
$page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
$list_page = $currentPage +  1;
$main_page = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
$page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
$list_page = $totalPages;
$main_page = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&list_page=$list_page&sid=$sid");
$page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}
if($list_page){
    $page_html .="<br/>";
}
$allmap = <<<HTML
<a href="?cmd=$map_out" >导出{$marea_name}场景->excel</a><br/>
<a href="?cmd=$map_in" >导入{$marea_name}场景<-excel</a><br/>
[地图设计]<br/>
{$marea_name}(a{$qy_id})区域的场景：<br/>
$map
$page_html
<a href="?cmd=$map_add" >增加场景</a><br/>
<a href="?cmd=$map_add_batch" >批量生成场景</a><br/>
<a href="?cmd=$npc_add_batch" >批量添加npc</a><br/>
<a href="?cmd=$update_all_data" >更新该区域内所有对象</a><br/><br/>
$area_change_html
<a href="?cmd=$area_delete" >删除该区域</a><br/><br/>
<a href="?cmd=$re_area" >返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $allmap;
}
elseif($post_canshu ==2){
$last_page = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=$qy_id&sid=$sid");
$allmap = <<<HTML
[批量添加地图]<br/><br/>
<form method="post">
    <input type="hidden" name="marea_name" value="{$marea_name}">
    <input type="hidden" name="qy_id" value="{$qy_id}">
    <input type="hidden" name="post_canshu" value="1">
    
    <label for="name">名称:</label>
    <textarea name="name" id="name" maxlength="99999" rows="1" cols="40"></textarea><br/>
    
    <label for="desc">描述:</label>
    <textarea name="desc" id="desc" maxlength="99999" rows="4" cols="40"></textarea><br/>
    
    <label for="kill">是否PK：</label>
    <select name="kill" id="kill">
        <option value="0">否</option>
        <option value="1">是</option>
    </select><br/>

    <label for="withcoord">是否带坐标：</label>
    <select name="withcoord" id="withcoord">
        <option value="0">否</option>
        <option value="1">是</option>
    </select><br/>
    
    <label for="map_x">地图x:</label>
    <input type="text" name="map_x" id="map_x"><br/>
    
    <label for="map_y">地图y:</label>
    <input type="text" name="map_y" id="map_y"><br/>
    
    <input name="submit" type="submit" title="确定" value="确定"/><br/>
    <input name="modify" type="hidden" title="确定" value="1"/>
</form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>

HTML;
echo $allmap;
}
elseif($post_canshu ==3){
$last_page = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=$qy_id&sid=$sid");
$allmap = <<<HTML
[修改区域名称]<br/>
</p>
<form method="post">
<input name="qy_id" type="hidden" title="确定" value="{$qy_id}"/>
<input type="hidden" name="post_canshu" value="1">
区域名称:<input name="marea_name" type="text" value="{$marea_name}" maxlength="50"/><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
<input name="modify" type="hidden" title="确定" value="2"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $allmap;
}
elseif($post_canshu ==4){
$marea_name = \player\getqy($qy_id,$dblj)->name;
if($canshu==1){
$last_page = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=$qy_id&sid=$sid");
$cxallmap = \player\getqy_all($dblj);
$br = 0;
for ($i=0;$i<@count($cxallmap);$i++){
    $hangshu +=1;
    $npc_qy_name = $cxallmap[$i]['name'];
    $npc_qy_id = $cxallmap[$i]['id'];
    $target_mid = $encode->encode("cmd=gm_map_2&marea_name=$marea_name&post_canshu=4&add_batch=1&gm_post_canshu=6&qy_id=$qy_id&npc_qy_id=$npc_qy_id&canshu=addnpc&sid=$sid");
    $area_list .=<<<HTML
    <a href="?cmd=$target_mid" >$hangshu.$npc_qy_name</a><br/>
HTML;
}
$npc_html = <<<HTML
[请选择要添加到区域：“{$marea_name}”的所有场景的NPC所属区域]<br/>
$area_list
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}

if($canshu=='addnpc'){
    $hangshu = 0;
    $cxallmap = \gm\get_npc_list($dblj,$npc_qy_id);
    $npc_qy_name = \player\getqy($npc_qy_id,$dblj)->name;
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $nname = $cxallmap[$i]['nname'];
    $nid = $cxallmap[$i]['nid'];
    $br++;
    $target_nid = $encode->encode("cmd=gm_map_2&npc_qy_id=$npc_qy_id&npc_name=$nname&post_canshu=4&canshu=addnpc_edit&add_npc_id=$nid&qy_id=$qy_id&sid=$sid");
    $npc_list_detail .=<<<HTML
        <a href="?cmd=$target_nid" >$hangshu.$nname(n{$nid})</a><br/>
HTML;
}
$last_page = $encode->encode("cmd=gm_post_4&npc_qy_id=$npc_qy_id&canshu=1&post_canshu=4&add_batch=1&qy_id=$qy_id&sid=$sid");
$npc_html = <<<HTML
[请选择要添加到区域：“{$marea_name}”的所有场景的NPC]<br/>
NPC所属区域：{$npc_qy_name}<br/>
$npc_list_detail<br/>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}

if($canshu == 'addnpc_edit'){
$npc_para = player\getnpc($add_npc_id,$dblj);
$npc_name = $npc_para ->nname;
$last_page = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&npc_qy_id=$npc_qy_id&canshu=addnpc&post_canshu=4&add_batch=1&sid=$sid");
$npc_add = $encode->encode("cmd=gm_map_2&qy_id=$qy_id&post_canshu=1&sid=$sid");
$npc_html = <<<HTML
[请选择要添加到区域：“{$marea_name}”的所有场景的NPC“{$npc_name}”的数量]<br/>
<form action="?cmd=$npc_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$add_npc_id}">
<input name="modify" type="hidden" title="确定" value="3">
数量表达式:<textarea name="add_count" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

echo $npc_html;
}
?>