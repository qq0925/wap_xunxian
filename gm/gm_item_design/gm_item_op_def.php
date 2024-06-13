<?php
if($gm_item_canshu == "1"){
$post_tishi = '修改成功';
}

if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT iop_target FROM system_item_module where iid= '$op_belong'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $iop_target = $row['iop_target'];
} else {
    echo "查询失败";
}
$string_old = $remove_id;
$elements = explode(",", $iop_target);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_item_module SET iop_target = :newstring where iid= '$op_belong'";

// 准备并执行预处理语句
$stmt = $dblj->prepare($query);

// 绑定参数值
$stmt->bindParam(':newstring', $newString);

$query = "delete from system_item_op where belong = '$op_belong' and id = '$remove_id'";
$dblj->exec($query);

$sql = "SELECT id from system_event_self where belong = '$remove_id' and module_id = 'item_op'";
$cxjg=$dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$event_id = $ret['id'];
$query = "delete from system_event_evs_self where belong = '$event_id'";
$dblj->exec($query);

$query = "delete from system_event_self where belong = '$remove_id' and module_id = 'item_op'";
$dblj->exec($query);

$item_id = $op_belong;
// 执行更新
if ($stmt->execute()) {
    echo "更新成功";
} else {
    echo "更新失败";
}
}

$area_main = $encode->encode("cmd=game_item_list&item_id=$item_id&sid=$sid");
$gm_item_post = $encode->encode("cmd=gm_op_submit&gm_item_canshu=1&sid=$sid");


if($now_pos !=0 && $next_pos !=0){
    echo "操作成功！<br/>";
    $query = "SELECT iop_target FROM system_item_module WHERE `iid` = '$item_id'";
    $stmt = $dblj->query($query);
    // 获取结果
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $event_link_evs = $row['iop_target'];
    $event_link_evs = explode(',',$event_link_evs);
    $nowposIndex = array_search($now_pos, $event_link_evs);
    $nextposIndex = array_search($next_pos, $event_link_evs);
    $temp = $event_link_evs[$nowposIndex];
    $event_link_evs[$nowposIndex] = $event_link_evs[$nextposIndex];
    $event_link_evs[$nextposIndex] = $temp;
    $newString = implode(",", $event_link_evs);
    $sql = "update system_item_module set iop_target = '$newString' where `iid` = '$item_id'";
    $dblj->exec($sql);
}



$sql = "SELECT * FROM system_item_module WHERE iid = :iid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':iid', $item_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$item_id = $row['iid'];
$item_name = $row['iname'];
$item_op_list = $row['iop_target'];
$ops = explode(",",$item_op_list);
if($item_op_list){
for ($i = 0; $i < @count($ops); $i++){
        $op = $ops[$i];
        $index = $i + 1;
        $sql = "SELECT * FROM system_item_op WHERE id = :id";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':id', $op,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $op_name = $row['name'];
        $op_id = $row['id'];
        $op_belong = $row['belong'];
        $op_list_detail = $encode->encode("cmd=system_item_op_detail&op_id=$op_id&sid=$sid");
        $op_delete = $encode->encode("cmd=gm_type_item&gm_post_canshu=2&op_belong=$op_belong&remove_id=$op_id&sid=$sid");
        $hangshu += 1;
        $op_list .=<<<HTML
        <a href="?cmd=$op_list_detail">{$hangshu}.{$op_name}</a><a href = "?cmd=$op_delete">删除</a>
HTML;
    if($index ==1 && count($ops)>1){
    $next_pos = $ops[1];
    $move_next = $encode->encode("cmd=gm_type_item&item_id=$item_id&now_pos=$op_id&next_pos=$next_pos&gm_post_canshu=2&sid=$sid");
    $op_list .=<<<HTML
    [ <font color ="red">上移</font> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}elseif ($index ==count($ops) && count($ops)>1) {
    $next_pos = $ops[$index -2];
    $move_last = $encode->encode("cmd=gm_type_item&item_id=$item_id&now_pos=$op_id&next_pos=$next_pos&gm_post_canshu=2&sid=$sid");
    $op_list .=<<<HTML
    [ <a href="?cmd=$move_last">上移</a> <font color ="red">下移</font> ]<br/>
HTML;
}elseif($index !=1 && $index !=count($ops) && count($ops)>1){
    $last_pos = $ops[$index -2];
    $next_pos = $ops[$index];
    $move_last = $encode->encode("cmd=gm_type_item&item_id=$item_id&now_pos=$op_id&next_pos=$last_pos&gm_post_canshu=2&sid=$sid");
    $move_next = $encode->encode("cmd=gm_type_item&item_id=$item_id&now_pos=$op_id&next_pos=$next_pos&gm_post_canshu=2&sid=$sid");
    $op_list .=<<<HTML
    [ <a href="?cmd=$move_last">上移</a> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}else{
    $op_list .=<<<HTML
    [ <font color ="red">上移 下移</font> ]<br/>
HTML;
}
            }
}
$sql = "SELECT MAX(id) AS max_id FROM system_item_op;";
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(PDO::FETCH_ASSOC);
$max_id = $row['max_id'] +1;
$add_op = $encode->encode("cmd=system_item_op_detail&op_belong=$item_id&add=1&max_id=$max_id&sid=$sid");
$item_op_list =<<<HTML
<p>定义物品“{$item_name}”的操作<br/>
{$op_list}
<a href="?cmd=$add_op">增加操作</a><br/>
<a href="?cmd=$area_main">返回上级</a><br/>
</p>
HTML;

echo $item_op_list;
?>