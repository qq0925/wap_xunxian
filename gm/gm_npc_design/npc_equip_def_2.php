<?php

$sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':npc_id', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];



if($add_canshu ==''){
$area_main = $encode->encode("cmd=gm_type_npc&gm_post_canshu=6&npc_id=$npc_id&sid=$sid");
$equip_html = "放置NPC“{$npc_name}”的装备<br/>";
$equip_html .= $add_type ==1?"请选择兵器类型:<br/>":"请选择防具类型:<br/>";
$sql = "select * from system_equip_def where type = '$add_type'";
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
for ($i=1;$i<count($gm_ret) +1;$i++){
    $def_name = $gm_ret[$i-1]['name'];
    $def_pos = $gm_ret[$i-1]['id'];
    $type_url = $encode->encode("cmd=system_npc_equip_detail&def_pos=$def_pos&type_name=$def_name&add_canshu=1&add_type=$add_type&npc_id=$npc_id&sid=$sid");
    $equip_html .=<<<HTML
    [$i].<a href="?cmd=$type_url">{$def_name}</a><br/>
HTML;
}
    $equip_html .=<<<HTML
<a href="?cmd=$area_main">返回上级</a><br/>
HTML;

}elseif($add_canshu ==1){
$area_main = $encode->encode("cmd=system_npc_equip_detail&add_type=$add_type&gm_post_canshu=6&npc_id=$npc_id&sid=$sid");
$equip_html = "放置NPC“{$npc_name}”的装备<br/>";
$equip_html .= $add_type ==1?"请选择兵器($type_name):<br/>":"请选择防具($type_name):<br/>";

if($add_type ==1){
    $sql = "select * from system_item_module where itype = '兵器' and isubtype = '$def_pos'";
}else{
    $sql = "select * from system_item_module where itype = '防具' and isubtype = '$def_pos'";
}
$gm_cxjg = $dblj->query($sql);

if(empty($_POST['kw']) && $_POST){
    echo "输入有误！<br/>";
}elseif (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from system_item_module where iname LIKE :keyword and isubtype = '$def_pos'";
    $gm_cxjg = $dblj->prepare($sql);
    $gm_cxjg->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $gm_cxjg->execute();
}


if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
for ($i=1;$i<count($gm_ret) +1;$i++){
    $equip_name = $gm_ret[$i-1]['iname'];
    $equip_id = $gm_ret[$i-1]['iid'];
    $equip_type = $gm_ret[$i-1]['itype'];
    $equip_subtype = $gm_ret[$i-1]['isubtype'];
    $equip_url = $encode->encode("cmd=gm_type_npc&gm_post_canshu=6&equip_type=$equip_type&equip_subtype=$equip_subtype&equip_add_id=$equip_id&npc_id=$npc_id&sid=$sid");
    $equip_list .=<<<HTML
    [$i].<a href="?cmd=$equip_url">{$equip_name}</a><br/>
HTML;
}

$equip_html .=<<<HTML
<form method="post">
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" value="搜索"/>
</form>
$equip_list
<a href="?cmd=$area_main">返回上级</a><br/>
HTML;
}
echo $equip_html;
?>