<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$map = '';
$cxamap = \gm\getmap_detail($dblj,$target_midid);
$clmid = player\getmid($target_midid,$dblj);


$map_mcreat_event = $clmid->mcreat_event_id ? 1 : 0;
$map_mlook_event = $clmid->mlook_event_id ? 1 : 0;
$map_minto_event = $clmid->minto_event_id ? 1 : 0;
$map_mout_event = $clmid->mout_event_id ? 1 : 0;
$map_mminute_event = $clmid->mminute_event_id ? 1 : 0;
$map_event_count = $map_mcreat_event + $map_mlook_event + $map_minto_event + $map_mout_event + $map_mminute_event;


$designer_para = \gm\getdesigner($sid,$dblj);
$designer_canshu = $designer_para['op_canshu'];
$designer_target = $designer_para['op_target'];
$map_op = $clmid->mop_target;
if($map_op){
$map_op_count = @count(explode(",",$map_op));
}else{
$map_op_count = 0;
}

$map_task = $clmid->mtask_target;
if($map_task){
$map_task_count = @count(explode(",",$map_task));
}else{
$map_task_count = 0;
}

$sql = "SELECT
    mid,
    IF(mup <> 0, 1, 0) +
    IF(mdown <> 0, 1, 0) +
    IF(mleft <> 0, 1, 0) +
    IF(mright <> 0, 1, 0) AS count_not_zero
FROM system_map
WHERE mid = '$target_midid';";
$stmt = $dblj->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$map_out_count = $result['count_not_zero'];


$map_npc = $clmid->mnpc;
if($map_npc){
$map_npc_count = @count(explode(",",$map_npc));
}else{
$map_npc_count = 0;
}

$map_item = $clmid->mitem;
if($map_item){
$map_item_count = @count(explode(",",$map_item));
}else{
$map_item_count = 0;
}


$map_shop_item = $clmid->mshop_item_id;
if($map_shop_item){
$map_shop_item_count = @count(explode(",",$map_shop_item));
}else{
$map_shop_item_count = 0;
}

$nowdate = date('Y-m-d H:i:s');
if ($update ==1){
    echo "更新成功！<br/>";
    //$excludeFields = ['mname', 'mop_target', 'mid', 'mup', 'mdown', 'mleft', 'mright'];
    $dblj->exec("update system_map set mgtime='$nowdate' WHERE mid='$target_midid'");
    $dblj->exec("delete from system_npc_scene where nmid = '$target_midid'");
    if($clmid->mnpc!=''){
        
        $data = $clmid->mnpc;
        $npc_s = explode(",", $data); // 使用逗号分隔字符串
        
        foreach ($npc_s as &$npc_a) {
            $parts = explode("|", $npc_a); // 使用竖线分隔每个项
            if (count($parts) >= 2) {
                list($id, $npc_count, $npc_show_cond) = $parts;
                
                // 对 npc_count 进行处理
                $npc_count = \lexical_analysis\process_string($npc_count, $sid);//考虑传入更多参数
                
                // 安全地处理表达式解析，避免 eval（如有安全风险，考虑使用其他解析工具）
                if (is_numeric($npc_count)) {
                    $npc_count = (int) $npc_count; // 如果是数字，直接转换为整型
                } else {
                    @$npc_count = eval("return $npc_count;"); // eval 要特别小心
                }
        
                // 更新处理后的值
                $npc_a = "{$id}|{$npc_count}|{$npc_show_cond}";
            }
        }
        
        // 将处理后的数据重新组合成字符串
        $clmid_npc_count = implode(",", $npc_s);
        
        // 获取 mid 数据
        $clmid = player\getmid($target_midid, $dblj);
        
        // 分割处理后的数据
        $retgw = explode(",", $clmid_npc_count);

    foreach ($retgw as $itemgw){
        $gwinfo = explode("|",$itemgw);
        $npc_para = \player\getnpc($gwinfo[0],$dblj);
        $npc_id = $gwinfo[0];
        
        for ($n=0;$n<$gwinfo[1];$n++){
            // 要复制的数据行id
            $nid = $npc_para->nid;
            // 1. 查询列名并缓存结果以减少重复查询
            if (empty($columns)) {
                $stmt = $dblj->query("SHOW COLUMNS FROM system_npc");
                $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
            // 2. 移除不必要的列（如果有）
            $cols = implode(", ", $columns);
            
            // 3. 动态构建 SQL 语句
            $sql = "INSERT INTO system_npc_scene ($cols, nmid) 
                    SELECT $cols, :nmid 
                    FROM system_npc 
                    WHERE nid = :nid;";
            
            // 4. 预编译 SQL 语句
            $stmt = $dblj->prepare($sql);
            
            // 5. 绑定参数并执行
            
            $stmt->bindParam(':nmid', $target_midid, PDO::PARAM_INT);
            $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
            $stmt->execute();
            // 获取最后插入记录的自增 ID
            $lastInsertId = $dblj->lastInsertId();
            
            $npc_scene_creat_event = $npc_para->ncreat_event_id;
            if($npc_scene_creat_event!=0){
            include_once 'class/events_steps_change.php';
            events_steps_change($npc_scene_creat_event,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc_scene',$lastInsertId,$para);
            }
            $ret = global_event_data_get(26,$dblj);
            if($ret){
            global_events_steps_change(26,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc_scene',$lastInsertId,$para);
            }
            
            
        }

    }
    $sql = "update system_map set mnpc_now = '$clmid_npc_count' WHERE mid='$target_midid'";
    $dblj->exec($sql);
}
    else{
    $sql = "update system_map set mnpc_now = '' WHERE mid='$target_midid'";
    $dblj->exec($sql);
}
    if($clmid->mitem!=''){
    $data = $clmid->mitem;
    $items = explode(",", $data); // 使用逗号分隔字符串，得到每个项
    foreach ($items as &$item) {
        $parts = explode("|", $item); // 使用竖线分隔每个项
        if (count($parts) >= 2) {
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
    $sql = "update system_map set mitem_now = '$clmid_item_count' WHERE mid='$target_midid'";
    $dblj->exec($sql);
    }
    else{
    $sql = "update system_map set mitem_now = '' WHERE mid='$target_midid'";
    $dblj->exec($sql);
    }
}
$br = 0;
$map_name = $cxamap[0]['mname'];
$map_id = $cxamap[0]['mid'];
$marea_id = $cxamap[0]['marea_id'];
$marea_shop = $cxamap[0]['mshop'];
$mis_rp = $cxamap[0]['mis_rp'];
if($marea_shop ==1){
    $scene_shop = $encode->encode("cmd=gm_type_map&gm_post_canshu=12&target_midid=$target_midid&sid=$sid");
    $shop_html = <<<HTML
<a href="?cmd=$scene_shop">出售物品列表</a>({$map_shop_item_count})<br/>
HTML;
}
if($mis_rp ==1){
    $rp_url = $encode->encode("cmd=gm_type_map&gm_post_canshu=13&target_midid=$target_midid&sid=$sid");
    $rp_html = <<<HTML
<a href="?cmd=$rp_url">定义资源点</a><br/>
HTML;
}

if($designer_canshu&&$designer_target=="map_design"){
$area_main = $encode->encode("cmd=gm_map_2&post_canshu=1&list_page=$designer_canshu&qy_id=$marea_id&sid=$sid");
}else{
$area_main = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=$marea_id&sid=$sid");
}

  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
$target_mid = $encode->encode("cmd=gm_map_2&hangshu=$hangshu&post_canshu=1&qy_id=$qy_id&qy_name=$qyname&sid=$sid");
$delete_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=9&map_name=$map_name&area_id=$marea_id&target_midid=$target_midid&sid=$sid");
$map =<<<HTML
        设计场景-{$map_name}(s{$map_id})<br/>
HTML;

$attr_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=1&target_midid=$target_midid&sid=$sid");
$op_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=2&target_midid=$target_midid&sid=$sid");
$event_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=3&target_midid=$target_midid&sid=$sid");
$task_def = $encode->encode("cmd=gm_type_map&gm_post_canshu=4&target_midid=$target_midid&sid=$sid");
$map_out = $encode->encode("cmd=gm_type_map&gm_post_canshu=5&target_midid=$target_midid&sid=$sid");
$npc_who = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$item_what = $encode->encode("cmd=gm_type_map&gm_post_canshu=7&target_midid=$target_midid&sid=$sid");
$copy_scene = $encode->encode("cmd=gm_type_map&copy_name=$map_name&gm_post_canshu=8&target_midid=$target_midid&sid=$sid");
$update_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=10&target_midid=$target_midid&sid=$sid");
$entrance_scene = $encode->encode("cmd=gm_type_map&gm_post_canshu=11&newmid=$target_midid&sid=$sid");
    
    
    
$map_design =<<<HTML
<p>[地图设计]<br/>
$map
<a href="game.php?cmd=$attr_def">定义属性</a><br/>
<a href="game.php?cmd=$event_def">定义事件</a>({$map_event_count})<br/>
$rp_html
<a href="game.php?cmd=$op_def">定义操作</a>({$map_op_count})<br/>
<a href="game.php?cmd=$task_def">任务设定</a>({$map_task_count})<br/>
<a href="game.php?cmd=$map_out">定义出口</a>({$map_out_count})<br/>
<a href="game.php?cmd=$npc_who">放置电脑人物</a>({$map_npc_count})<br/>
<a href="game.php?cmd=$item_what">放置地上物品</a>({$map_item_count})<br/>
$shop_html
<a href="game.php?cmd=$update_scene">更新该场景</a><br/>
<a href="game.php?cmd=$entrance_scene">进入该场景</a><br/>
<a href="game.php?cmd=$copy_scene">复制该场景</a><br/>
<a href="game.php?cmd=$delete_scene">删除该场景</a><br/>
<a href="game.php?cmd=$area_main">返回区域</a><br/>
<a href="game.php?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
echo $map_design;
?>