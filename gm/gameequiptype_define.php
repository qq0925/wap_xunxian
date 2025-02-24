<p>[装备类型定义]<br/>
<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_game_equiptype_1 = $encode->encode("cmd=gm_game_equiptypedefine&gm_post_canshu=1&sid=$sid");
$gm_game_equiptype_2 = $encode->encode("cmd=gm_game_equiptypedefine&gm_post_canshu=2&sid=$sid");
$gm_game_equiptype_3 = $encode->encode("cmd=gm_game_equiptypedefine&gm_cover=1&sid=$sid");
$cover_url = "game.php?cmd=$gm_game_equiptype_3";
$last_page = $encode->encode("cmd=gm_game_equiptypedefine&gm_post_canshu=0&sid=$sid");
$equip_html = '';
if($gm_post_canshu == 0){
$gm_html = <<<HTML
<a href="?cmd=$gm_game_equiptype_1">定义兵器类型</a><br/>
<a href="?cmd=$gm_game_equiptype_2">定义防具类型</a><br/><br/>
<a href="#" onclick="confirmCover()">还原基本类型</a><br/>
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
    $del_url = "game.php?cmd=$delete_url";
    $equip_html .=<<<HTML
    {$def_name}<a href="#" onclick="return confirmAction('$del_url','$def_name')">删除</a><br/>
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
    $del_url = "game.php?cmd=$delete_url";
    $equip_html .=<<<HTML
    {$def_name}<a href="#" onclick="return confirmAction('$del_url','$def_name')">删除</a><br/>
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
<script>

function confirmAction(del_url, step_order) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要删除 “" + step_order + "” 这个类型吗？")) {
        // 使用传入的具体删除链接
        window.location.href = del_url;
    }
    return false;
}

function confirmCover() {
    // 弹出确认框
    if (confirm("你确定要还原成所有基本类型吗？")) {
        // 如果点击“确认”，则跳转到PHP传递的链接
        window.location.href = "<?php echo $cover_url; ?>";
    } else {
        // 如果点击“取消”，则什么也不做
        return false;
    }
}

</script>