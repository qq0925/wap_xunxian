<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");
$nowmid = $target_midid;

if($remove_monster){
    $dblj->exec("delete from system_npc_midguaiwu where nsid='' and nmid = '$target_midid'");
    $dblj->exec("update system_map set mnpc_now = '' where mid = '$target_midid'");
    echo "已清空场景NPC！<br/>";
}

if($_POST['change_this_id']){
    $old = $_POST['change_this_id']."|".$_POST['change_this_count']."|".$_POST['change_this_show_cond'];
    
    // 查询mnpc字段是否包含$old
    $sql_check = "SELECT * FROM system_map WHERE mnpc LIKE ?";
    $stmt = $dblj->prepare($sql_check);
    $stmt->execute(["%$old%"]);
    if ($stmt->rowCount() == 0) {
    $old = $_POST['change_this_id']."|".$_POST['change_this_count'];
    }
    $new = $_POST['change_this_id']."|".$_POST['count']."|".urlencode($_POST['show_cond']);
    $sql = "UPDATE system_map SET mnpc = REPLACE(mnpc, '$old', '$new') where mid = '$nowmid'";
    $dblj->exec($sql);
}

if($_POST['add_this_id']){
    // 获取原始字段值
    $stmt = $dblj->prepare("SELECT mnpc FROM system_map WHERE mid = '$nowmid'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldData = $result["mnpc"];
    if($oldData ==''){
        $new = $_POST['add_this_id']."|".$_POST['add_count']."|".urlencode($_POST['add_show_cond']);
    }else{
        $new = $oldData.",".$_POST['add_this_id']."|".$_POST['add_count']."|".urlencode($_POST['add_show_cond']);
    }
    $sql = "UPDATE system_map SET mnpc = '$new' where mid = '$nowmid'";
    $dblj->exec($sql);
}

if($remove_id){
    if($scene_npc_count ==1){
        
    $old = $remove_id."|".$remove_count."|".$remove_show_cond;
    
    // 查询mnpc字段是否包含$old
    $sql_check = "SELECT * FROM system_map WHERE mnpc LIKE ?";
    $stmt = $dblj->prepare($sql_check);
    $stmt->execute(["%$old%"]);
    if ($stmt->rowCount() == 0) {
    $old = $remove_id."|".$remove_count;
    }
    }elseif($scene_npc_count !=1 && $pos ==1){
    $old = $remove_id."|".$remove_count."|".$remove_show_cond.",";
    // 查询mnpc字段是否包含$old
    $sql_check = "SELECT * FROM system_map WHERE mnpc LIKE ?";
    $stmt = $dblj->prepare($sql_check);
    $stmt->execute(["%$old%"]);
    if ($stmt->rowCount() == 0) {
    $old = $remove_id."|".$remove_count.",";
    }
    }else{
    $old = ",".$remove_id."|".$remove_count."|".$remove_show_cond;
    // 查询mnpc字段是否包含$old
    $sql_check = "SELECT * FROM system_map WHERE mnpc LIKE ?";
    $stmt = $dblj->prepare($sql_check);
    $stmt->execute(["%$old%"]);
    if ($stmt->rowCount() == 0) {
    $old = ",".$remove_id."|".$remove_count;
    }
    }
    $sql = "UPDATE system_map SET mnpc = REPLACE(mnpc, '$old', '') where mid = '$nowmid'";
    $dblj->exec($sql);
}

$pos = 0;
$clmid = player\getmid($nowmid,$dblj);
$scene_name = $clmid ->mname;
$scene_npc = explode(',',$clmid ->mnpc);

if(isset($now_pos)&& isset($next_pos)){
    // 使用临时变量进行交换
    $temp = $scene_npc[$now_pos];
    $scene_npc[$now_pos] = $scene_npc[$next_pos];
    $scene_npc[$next_pos] = $temp;
    $newarr = implode(",",$scene_npc);
    $sql = "update system_map set mnpc = '$newarr' where mid = '$nowmid'";
    $dblj->exec($sql);
}

$scene_npc_count = @count($scene_npc);
$add_npc = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&canshu=addnpc&scene_npc_count=$scene_npc_count&target_midid=$target_midid&sid=$sid");
if (!empty($scene_npc[0])){
foreach ($scene_npc as $npc_detail){
    $now_temp_pos = $pos;
    $pos +=1;
    $npc_list = explode('|',$npc_detail);
    $npc_id = $npc_list[0];
    $npc_count = $npc_list[1];
    $npc_show_cond = $npc_list[2];
    $npc_count_2 = urlencode($npc_count);
    $npc_show_cond_2 = urlencode($npc_show_cond);
    $npc_para = player\getnpc($npc_id,$dblj);
    $npc_name = $npc_para ->nname;
    
    $npc_change = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&change_id=$npc_id&change_old_count=$npc_count_2&change_old_show_cond=$npc_show_cond_2&sid=$sid");
    $npc_remove = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&pos=$pos&scene_npc_count=$scene_npc_count&target_midid=$target_midid&remove_id=$npc_id&remove_count=$npc_count_2&remove_show_cond=$npc_show_cond_2&sid=$sid");
    
    if($pos ==1 && $scene_npc_count>1){
    $next_pos = $now_temp_pos + 1;
    $move_next = $encode->encode("cmd=gm_type_map&target_midid=$target_midid&now_pos=$now_temp_pos&next_pos=$next_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $npc_list_html .=<<<HTML
    <a href="?cmd=$npc_change">{$npc_name}({$npc_count})</a> <a href="?cmd=$npc_remove">移除</a>[ <font color ="red">上移</font> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}elseif ($pos ==$scene_npc_count && $scene_npc_count>1) {
    $next_pos = $now_temp_pos - 1;
    $move_last = $encode->encode("cmd=gm_type_map&target_midid=$target_midid&now_pos=$now_temp_pos&next_pos=$next_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $npc_list_html .=<<<HTML
    <a href="?cmd=$npc_change">{$npc_name}({$npc_count})</a> <a href="?cmd=$npc_remove">移除</a>[ <a href="?cmd=$move_last">上移</a> <font color ="red">下移</font> ]<br/>
HTML;
}elseif($pos !=1 && $pos !=$scene_npc_count && $scene_npc_count>1){
    $last_pos = $now_temp_pos - 1;
    $next_pos = $now_temp_pos + 1;
    $move_last = $encode->encode("cmd=gm_type_map&target_midid=$target_midid&now_pos=$now_temp_pos&next_pos=$last_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $move_next = $encode->encode("cmd=gm_type_map&target_midid=$target_midid&now_pos=$now_temp_pos&next_pos=$next_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $npc_list_html .=<<<HTML
    <a href="?cmd=$npc_change">{$npc_name}({$npc_count})</a> <a href="?cmd=$npc_remove">移除</a>[ <a href="?cmd=$move_last">上移</a> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}else{
    $npc_list_html .=<<<HTML
    <a href="?cmd=$npc_change">{$npc_name}({$npc_count})</a> <a href="?cmd=$npc_remove">移除</a>[ <font color ="red">上移 下移</font> ]<br/>
HTML;
}
    }
}
$removemonster = $encode->encode("cmd=gm_type_map&remove_monster=1&target_midid=$target_midid&gm_post_canshu=$gm_post_canshu&sid=$sid");
$npc_html = <<<HTML
<p>定义场景“{$scene_name}”的电脑人物<br/>
$npc_list_html
<a href="?cmd=$add_npc">添加人物</a><br/><br/>
<a href="?cmd=$removemonster">清除场景NPC</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
if($change_id !=0){
$npc_para = player\getnpc($change_id,$dblj);
$npc_name = $npc_para ->nname;

$change_old_show_cond_2 = urldecode($change_old_show_cond);
$last_page = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$npc_change = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$npc_html = <<<HTML
<p>修改场景电脑人物“{$npc_name}”的电脑人物<br/>
<form action="?cmd=$npc_change" method="post">
<input name="change_this_id" type="hidden" title="确定" value="{$change_id}">
<input name="change_this_count" type="hidden" title="确定" value="{$change_old_count}">
<input name="change_this_show_cond" type="hidden" title="确定" value="{$change_old_show_cond}">
数量表达式:<textarea name="count" maxlength="1024" rows="4" cols="40">{$change_old_count}</textarea><br/>
显示条件表达式(为空则默认显示):<textarea name="show_cond" maxlength="1024" rows="4" cols="40">{$change_old_show_cond_2}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

if($canshu == 'addnpc'){
$last_page = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$cxallmap = \player\getqy_all($dblj);
$br = 0;
if($hanghsu == 0 && $post_canshu ==0){
for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
        $target_mid = $encode->encode("cmd=gm_type_map&hangshu=$hangshu&post_canshu=1&gm_post_canshu=6&qy_id=$qy_id&canshu=addnpc&scene_npc_count=$scene_npc_count&target_midid=$target_midid&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname</a><br/>
HTML;
    /*if ($br >= 3){
        $br = 0;
        $map.="<br/>"  ;
    }*/
}
$npc_html = <<<HTML
[定义场景的电脑人物]<br/>
请选择电脑人物所属区域：<br/>
$map<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}elseif($post_canshu==1){
    $last_page = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&canshu=addnpc&scene_npc_count=$scene_npc_count&target_midid=$target_midid&sid=$sid");
    $hangshu = 0;
    $cxallmap = \gm\get_npc_list($dblj,$qy_id);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $nname = $cxallmap[$i]['nname'];
    $nid = $cxallmap[$i]['nid'];
    $br++;
        //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
    $target_nid = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&canshu=addnpc_edit&add_npc_id=$nid&scene_npc_count=$scene_npc_count&target_midid=$target_midid&sid=$sid");
    $npc_list_detail .=<<<HTML
        <a href="?cmd=$target_nid" >$hangshu.$nname(n{$nid})</a><br/>
HTML;
}
$npc_html = <<<HTML
[基本信息设置]<br/>
请选择电脑人物<br/>
$npc_list_detail<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}    
}

if($canshu == 'addnpc_edit'){
$npc_para = player\getnpc($add_npc_id,$dblj);
$npc_name = $npc_para ->nname;
$last_page = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$npc_change = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&target_midid=$target_midid&sid=$sid");
$npc_add = $encode->encode("cmd=gm_type_map&gm_post_canshu=6&scene_npc_count=$scene_npc_count&target_midid=$target_midid&sid=$sid");
$npc_html = <<<HTML
<p>新增场景的“{$npc_name}”的电脑人物<br/>
<form action="?cmd=$npc_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$add_npc_id}">
数量表达式:<textarea name="add_count" maxlength="1024" rows="4" cols="40">1</textarea><br/>
显示条件表达式(为空则默认显示):<textarea name="add_show_cond" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

echo $npc_html;
?>