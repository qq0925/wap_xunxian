<?php


if($_POST['change_this_id']){
    $old = $_POST['change_this_id']."|".$_POST['change_this_count'];
    $new = $_POST['change_this_id']."|".$_POST['count'];
    $sql = "UPDATE system_npc SET ndrop_item = REPLACE(ndrop_item, '$old', '$new') where nid = '$npc_id'";
    $dblj->exec($sql);
}

if($_POST['add_this_id']){
    // 获取原始字段值
    $stmt = $dblj->prepare("SELECT ndrop_item FROM system_npc WHERE nid = '$npc_id'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldData = $result["ndrop_item"];
    if($oldData ==''){
        $new = $_POST['add_this_id']."|".$_POST['add_count'];
    }else{
        $new = $oldData.",".$_POST['add_this_id']."|".$_POST['add_count'];
    }
    $sql = "UPDATE system_npc SET ndrop_item = '$new' where nid = '$npc_id'";
    $dblj->exec($sql);
}

if($remove_id){
    if($npc_drop_item_count ==1){
    $old = $remove_id."|".$remove_count;
    }elseif($npc_drop_item_count !=1 && $pos ==1){
    $old = $remove_id."|".$remove_count.",";
    }else{
    $old = ",".$remove_id."|".$remove_count;
    }
    $sql = "UPDATE system_npc SET ndrop_item = REPLACE(ndrop_item, '$old', '') where nid = '$npc_id'";
    $dblj->exec($sql);
}

if($_POST['change_basic']){
    $dblj->exec("update system_npc set ndrop_exp = '$exp',ndrop_money = '$money',ndrop_item_type = '$drop_type' where nid = '$npc_id'");
}

if($canshu ==1){
$area_main = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
$drop_item_modify = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':npc_id', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];
$npc_drop_exp = $row['ndrop_exp'];
$npc_drop_money = $row['ndrop_money'];
$npc_drop_item = $row['ndrop_item'];
$npc_drop_type = $row['ndrop_item_type'];
$select_para = $npc_drop_type ==1?"selected" :"";
if($npc_drop_item){
$npc_drop_item_count = @count(explode(",",$npc_drop_item));
}else{
$npc_drop_item_count = 0;
}
$dead_html = <<<HTML
<p>NPC“{$npc_name}”死后掉落定义<br/>
</p>
<form method="post">
<input name="change_basic" type="hidden" value="1">
掉经验值表达式:<textarea name="exp" maxlength="1024" rows="4" cols="40">{$npc_drop_exp}</textarea><br/>
掉钱表达式:<textarea name="money" maxlength="1024" rows="4" cols="40">{$npc_drop_money}</textarea><br/>
掉落物品:<a href="?cmd=$drop_item_modify">修改({$npc_drop_item_count})</a><br/>
掉落物品方式:<select name="drop_type">
<option value = "0">直接到背包</option><br/>
<option value = "1" $select_para>直接到地上</option><br/>
</select><br/>
<input name="submit" type="submit" title="确定" value="确定"><br/><br/>
<a href="?cmd=$area_main">返回上级</a><br/>
HTML;
}elseif ($canshu ==2) {

if($_POST){
    $dblj->exec("update system_npc set ndrop_exp = '$exp',ndrop_money = '$money',ndrop_item_type = '$drop_type' where nid = '$npc_id'");
}


$area_main = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=1&npc_id=$npc_id&sid=$sid");
$sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':npc_id', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];
$npc_drop_list = $row['ndrop_item'];
$drops = explode(",",$npc_drop_list);
$npc_drop_item_count = @count($drops);
if($npc_drop_list){
for ($i = 0; $i < @count($drops); $i++){
        $drop = $drops[$i];
        $drop_para = explode("|",$drop);
        $drop_target = $drop_para[0];
        $drop_count = $drop_para[1];
        $drop_fliter_count = urlencode($drop_para[1]);
        $index = $i + 1;
        $sql = "SELECT * FROM system_item_module WHERE iid = :id";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':id', $drop_target,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $drop_name = $row['iname'];
        $drop_id = $row['iid'];
        $drop_list_detail = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=3&drop_id=$drop_id&drop_name=$drop_name&drop_count=$drop_fliter_count&npc_id=$npc_id&sid=$sid");
        $drop_delete = $encode->encode("cmd=gm_type_npc&pos=$index&npc_drop_item_count=$npc_drop_item_count&gm_post_canshu=7&canshu=2&remove_count=$drop_count&remove_id=$drop_id&npc_id=$npc_id&sid=$sid");
        $hangshu += 1;
        $drop_list .=<<<HTML
        <a href="?cmd=$drop_list_detail">{$hangshu}.{$drop_name}({$drop_count})</a><a href = "?cmd=$drop_delete">移除</a><br/>
HTML;
            }
}
$add_drop = $encode->encode("cmd=gm_type_npc&npc_drop_item_count=$npc_drop_item_count&post_canshu=-1&gm_post_canshu=7&canshu=additem&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
<p>放置电脑人物“{$npc_name}”的死后掉落物品<br/>
</p>
<form method="post">
$drop_list
<a href="?cmd=$add_drop">增加物品</a><br/>
<a href="?cmd=$area_main">返回上级</a><br/>
HTML;
}elseif($canshu ==3){
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
<p>设置物品的数量<br/>
</p>
<form method="post">
<input name="change_this_id" type="hidden" value="{$drop_id}">
<input name="change_this_count" type="hidden" value="{$drop_count}">
<input name="canshu" type="hidden" value="2">
物品:{$drop_name}<br/>
数量表达式:<textarea name="count" maxlength="1024" rows="4" cols="40">{$drop_count}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}


if($canshu == 'additem'){
if($post_canshu == -1){
    $add_item_type = array(); // 创建一个空的关联数组
    for($i=0;$i<8;$i++){
        $add_item_type[$i] = $encode->encode("cmd=gm_type_npc&post_canshu=$i&gm_post_canshu=7&canshu=additem&npc_drop_item_count=$npc_drop_item_count&npc_id=$npc_id&sid=$sid");
    }
$dead_html = <<<HTML
[定义NPC的死后掉落物品]<br/>
请选择物品的类型：<br/>
<a href="?cmd={$add_item_type[0]}">消耗品</a><br/>
<a href="?cmd={$add_item_type[1]}">兵器</a><br/>
<a href="?cmd={$add_item_type[2]}">防具</a><br/>
<a href="?cmd={$add_item_type[3]}">书籍</a><br/>
<a href="?cmd={$add_item_type[4]}">兵器镶嵌物</a><br/>
<a href="?cmd={$add_item_type[5]}">防具镶嵌物</a><br/>
<a href="?cmd={$add_item_type[6]}">任务物品</a><br/>
<a href="?cmd={$add_item_type[7]}">其它</a><br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上一页</a><br/>
HTML;
}else{
switch ($post_canshu) {
    case 0:
        $item_type = "消耗品";
        break;
    case 1:
        $item_type = "兵器";
        break;
    case 2:
        $item_type = "防具";
        break;
    case 3:
        $item_type = "书籍";
        break;
    case 4:
        $item_type = "兵器镶嵌物";
        break;
    case 5:
        $item_type = "防具镶嵌物";
        break;
    case 6:
        $item_type = "任务物品";
        break;
    case 7:
        $item_type = "其它";
        break;
    default:
        $item_type = "未知"; // 可以添加默认情况
}
    $cxallmap = \gm\get_item_list($dblj,$item_type);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $iname = $cxallmap[$i]['iname'];
    $iid = $cxallmap[$i]['iid'];
    $br++;
    $target_iid = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=additem_edit&npc_drop_item_count=$npc_drop_item_count&add_item_id=$iid&npc_id=$npc_id&sid=$sid");
    $item_list_detail .=<<<HTML
        <a href="?cmd=$target_iid" >$hangshu.$iname(i{$iid})</a><br/>
HTML;
}
$dead_html = <<<HTML
请选择物品<br/>
$item_list_detail<br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上一页</a><br/>
HTML;
}    
}

if($canshu == 'additem_edit'){
$item_para = player\getitem($add_item_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$item_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$item_add = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&npc_drop_item_count=$npc_drop_item_count&canshu=2&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
<p>定义NPC的死后掉落物品“{$item_name}”<br/>
<form action="?cmd=$item_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$add_item_id}">
数量表达式:<textarea name="add_count" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}




echo $dead_html;
?>