<?php
if($equip_add_id){
// 检查 nequips 字段是否为空
$string_new = $equip_type."_".$equip_subtype."_".$equip_add_id;

$query = "SELECT nequips FROM system_npc where nid = '$npc_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['nequips'])) {
    // nequips 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_npc SET nequips = :new_value where nid = '$npc_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
} elseif(!in_array($string_new, explode(',',$result['nequips']))) {
    // nequips 字段不为空，在原有值后面加上逗号和 $string_new
    $stmt = $dblj->prepare("SELECT nequips FROM system_npc where nid = '$npc_id'");
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $pattern = '/(' . preg_quote($equip_type) . '.*_' . preg_quote($equip_subtype) . '_)(\d+)/';
    $nequips = $results['nequips'];
    
    // 使用回调函数进行替换，并检查是否有匹配
    $new_nequips = preg_replace_callback($pattern, function($matches) use ($equip_add_id) {
        return $matches[1] . $equip_add_id;
    }, $nequips, -1, $count);

    // 检查是否有进行替换，如果有替换，则更新数据库
    if ($count > 0) {
        $update_stmt = $dblj->prepare("UPDATE system_npc SET nequips = :new_nequips WHERE nid = '$npc_id'");
        $update_stmt->bindParam(':new_nequips', $new_nequips);
        $update_stmt->execute();
    }else{
    $query = "UPDATE system_npc SET nequips = CONCAT(nequips, ',', :new_value) where nid = '$npc_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
    }
}
}

if($clear_canshu){
    $dblj->exec("UPDATE system_npc set nequips = '' where nid = '$npc_id'");
    echo "已清空！<br/>";
}

if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT nequips FROM system_npc where nid= '$npc_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $nequips = $row['nequips'];
} else {
    echo "查询失败";
}
$string_old = $remove_type."_".$remove_subtype."_".$remove_id;
$elements = explode(",", $nequips);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_npc SET nequips = :newstring where nid= '$npc_id'";

// 准备并执行预处理语句
$stmt = $dblj->prepare($query);

// 绑定参数值
$stmt->bindParam(':newstring', $newString);
$npc_id = $npc_id;
// 执行更新
if ($stmt->execute()) {
    echo "更新成功<br/>";
} else {
    echo "更新失败<br/>";
}
}

$area_main = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
$gm_npc_post = $encode->encode("cmd=gm_equip_submit&gm_npc_canshu=1&sid=$sid");

$sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':npc_id', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];
$npc_equips_list = $row['nequips'];
$npc_equip_attack = 0;
$npc_equip_recovery = 0;
$equips = explode(",",$npc_equips_list);
if($npc_equips_list){
for ($i = 0; $i < @count($equips); $i++){
        $equip = explode('_',$equips[$i])[2];
        
        if(!$equip){
$equip_clear = $encode->encode("cmd=gm_type_npc&gm_post_canshu=6&npc_id=$npc_id&clear_canshu=1&sid=$sid");
$clear_html =  <<<HTML
<a href="?cmd=$equip_clear">点此清空该npc的装备配置</a></br>
HTML;
        }
        
        $index = $i + 1;
        $sql = "SELECT * FROM system_item_module WHERE iid = :id";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':id', $equip,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $equip_name = \lexical_analysis\color_string($row['iname']);
        $equip_id = $row['iid'];
        $equip_attack = $row['iattack_value'];
        $equip_recovery = $row['irecovery_value'];
        $equip_type = $row['itype'];
        $equip_subtype = $row['isubtype'];
        $npc_equip_attack = $equip_attack!=0?$npc_equip_attack + $equip_attack:$npc_equip_attack;
        $npc_equip_recovery = $equip_recovery!=0?$npc_equip_recovery + $equip_recovery:$npc_equip_recovery;
        //$equip_list_detail = $encode->encode("cmd=system_npc_equip_detail&equip_id=$equip_id&add_type=3&npc_id=$npc_id&sid=$sid");
        $equip_delete = $encode->encode("cmd=gm_type_npc&gm_post_canshu=6&npc_id=$npc_id&remove_type=$equip_type&remove_subtype=$equip_subtype&remove_id=$equip_id&sid=$sid");
        $hangshu += 1;
        if($equip_type =="兵器"){
            $equip_mark = "兵器";
        }else{
            $equip_mark = "防具";
        }
        $equip_list .=<<<HTML
        {$hangshu}.{$equip_name}({$equip_mark})<a href = "?cmd=$equip_delete">删除</a><br/>
HTML;
            }
}
//<a href="?cmd=$equip_list_detail">
$add_equip_1 = $encode->encode("cmd=system_npc_equip_detail&add_type=1&npc_id=$npc_id&sid=$sid");
$add_equip_2 = $encode->encode("cmd=system_npc_equip_detail&add_type=2&npc_id=$npc_id&sid=$sid");
$npc_equip_list =<<<HTML
$clear_html
伤害总和:{$npc_equip_attack}<br/>
防御总和:{$npc_equip_recovery}<br/>
<p>定义npc“{$npc_name}”的身上装备<br/>
{$equip_list}
<a href="?cmd=$add_equip_1">添加兵器</a><br/>
<a href="?cmd=$add_equip_2">添加防具</a><br/>
<a href="?cmd=$area_main">返回上级</a><br/>
</p>
HTML;

echo $npc_equip_list;
?>