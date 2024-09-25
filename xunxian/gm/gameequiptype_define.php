<p>[装备类型定义]<br/>
<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_game_equiptype_1 = $encode->encode("cmd=gm_game_equiptypedefine&gm_post_canshu=1&sid=$sid");
$gm_game_equiptype_2 = $encode->encode("cmd=gm_game_equiptypedefine&gm_post_canshu=2&sid=$sid");
$gm_game_equiptype_3 = $encode->encode("cmd=gm_game_equiptypedefine&gm_cover=1&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_equiptypedefine&gm_post_canshu=0&sid=$sid");
$equip_html = '';
if($gm_post_canshu == 0){
$gm_html = <<<HTML
<a href="?cmd=$gm_game_equiptype_1">定义兵器类型</a><br/>
<a href="?cmd=$gm_game_equiptype_2">定义防具类型</a><br/><br/>
<a href="?cmd=$gm_game_equiptype_3">还原所有基本类型</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 1) {
$sql = "select * from system_equip_def where type = '1'";
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
for ($i=0;$i<count($gm_ret);$i++){
    $def_name = $gm_ret[$i]['name'];
    $delete_url = $encode->encode("cmd=gm_equip_def&def_post_canshu=1&equip_id=$def_name&sid=$sid");
    $equip_html .=<<<HTML
    {$def_name}<a href="?cmd=$delete_url">删除</a><br/>
HTML;
}
$add_url = $encode->encode("cmd=gm_equip_def&def_post_canshu=2&sid=$sid");
$gm_html = <<<HTML
<p>[当前定义的兵器类型]</p>
$equip_html
<a href="?cmd=$add_url">增加类型</a><br/>
<a href="?cmd=$last_page">返回上一级</button></a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 2) {
$sql = "select * from system_equip_def where type = '2'";
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
for ($i=0;$i<count($gm_ret);$i++){
    $def_name = $gm_ret[$i]['name'];
    $delete_url = $encode->encode("cmd=gm_equip_def&def_post_canshu=4&equip_id=$def_name&sid=$sid");
    $equip_html .=<<<HTML
    {$def_name}<a href="?cmd=$delete_url">删除</a><br/>
HTML;
}
$add_url = $encode->encode("cmd=gm_equip_def&def_post_canshu=5&sid=$sid");

$gm_html = <<<HTML
<p>[当前定义的防具类型]</p>
$equip_html
<a href="?cmd=$add_url">增加类型</a><br/>
<a href="?cmd=$last_page">返回上一级</button></a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
?>