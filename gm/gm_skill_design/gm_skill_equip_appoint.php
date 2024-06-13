<?php
if(!$equip_type_id){
$stmt = $dblj->query("select id,name from system_equip_def where type = 1");
$equip_appoint = $stmt->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($equip_appoint) +1;$i++){
$equip_type_name = $equip_appoint[$i-1]['name'];
$equip_type_id = $equip_appoint[$i-1]['id'];
$equip_type_first = $encode->encode("cmd=gm_skill_appoint_choose&equip_type_id=$equip_type_id&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
$skill_equip_html .=<<<HTML
<a href="?cmd=$equip_type_first">{$i}.{$equip_type_name}</a><br/>
HTML;
}
$last_page = $encode->encode("cmd=gm_skill_def&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
$skill_html = <<<HTML
<p>[技能定义]<br/>
请选择技能特定兵器的类型：<br/>
$skill_equip_html
<a href="?cmd=$last_page">返回上级</a><br/>
</p>

HTML;
}else{
$last_page = $encode->encode("cmd=gm_skill_appoint_choose&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
$equip_sql =$dblj->query("select iid,iname from system_item_module where itype ='兵器' and isubtype = '$equip_type_id'");
$equip_list = $equip_sql->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_item_module` where itype ='兵器' and isubtype = '$equip_type_id' and iname LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $equip_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

for($i=1;$i<@count($equip_list) +1;$i++){
$equip_name = $equip_list[$i-1]['iname'];
$equip_id = $equip_list[$i-1]['iid'];
$equip_type_second = $encode->encode("cmd=gm_skill_def&add_equip_id=$equip_id&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
$skill_equip_html .=<<<HTML
<a href="?cmd=$equip_type_second">{$i}.{$equip_name}(i{$equip_id})</a><br/>
HTML;
}
$skill_html = <<<HTML
<p>[技能定义]<br/>
请选择技能特定兵器：<br/>
</p>
<form method="post">
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="搜索" value="搜索"/>
<input name="submit" type="hidden" title="搜索" value="搜索"/></form>
$skill_equip_html
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}

echo $skill_html;
?>