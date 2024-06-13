<?php
$last_page = $encode->encode("cmd=game_event_itemchange_self&event_id=$event_id&step_id=$step_id&sid=$sid");

if($gm_post_canshu_2 ==""){
$game_event_itemadd_1 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=消耗品&sid=$sid");//
$game_event_itemadd_2 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=兵器&sid=$sid");
$game_event_itemadd_3 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=防具&sid=$sid");
$game_event_itemadd_4 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=书籍&sid=$sid");
$game_event_itemadd_5 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=兵器镶嵌物&sid=$sid");
$game_event_itemadd_6 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=防具镶嵌物&sid=$sid");
$game_event_itemadd_7 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=任务物品&sid=$sid");
$game_event_itemadd_8 = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&gm_post_canshu_2=其它&sid=$sid");//

$gm_html = <<<HTML
<p>[事件物品设计]<br/>
请选择物品类别：<br/>
<a href="?cmd=$game_event_itemadd_1">消耗品</a><br/>
<a href="?cmd=$game_event_itemadd_2">兵器</a><br/>
<a href="?cmd=$game_event_itemadd_3">防具</a><br/>
<a href="?cmd=$game_event_itemadd_4">书籍</a><br/>
<a href="?cmd=$game_event_itemadd_5">兵器镶嵌物</a><br/>
<a href="?cmd=$game_event_itemadd_6">防具镶嵌物</a><br/>
<a href="?cmd=$game_event_itemadd_7">任务物品</a><br/>
<a href="?cmd=$game_event_itemadd_8">其它</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
</p>
HTML;
echo $gm_html;
}else{
$last_page = $encode->encode("cmd=game_event_itemadd_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$page_subtype = 0;
if(empty($_POST['kw'])){
$get_item_list = \gm\get_item_list($dblj,$gm_post_canshu_2);
}
if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_item_module` where itype ='$gm_post_canshu_2' AND iname LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $get_item_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$hangshu =0;
for ($i=0;$i<count($get_item_list);$i++){
    $hangshu +=1;
    $item_id = $get_item_list[$i]['iid'];
    $item_area_id = $get_item_list[$i]['iarea_id'];
    $item_name = $get_item_list[$i]['iname'];
    $item_type = $get_item_list[$i]['itype'];
    $item_subtype = $get_item_list[$i]['isubtype'];
    $item_url = $encode->encode("cmd=game_event_itemchange_self&item_type=$item_type&event_id=$event_id&step_id=$step_id&item_name=$item_name&item_id=$item_id&sid=$sid");//
    $item_list .=<<<HTML
    <a href="?cmd=$item_url" >$hangshu.{$item_name}(i{$item_id})</a><br/>
HTML;
}
$gm_html =<<<HTML
<p>请选择{$gm_post_canshu}：<br/>
$item_list
</p>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
echo $gm_html;
}
?>