<?php
$gm_ret = \player\getqy_all($dblj);
if($scene_post_canshu ==1){
$gm_game_selfeventdefine_scene_last = $encode->encode("cmd=game_event_destsadd_self&event_id=$event_id&step_id=$step_id&sid=$sid");
for ($i=0;$i<count($gm_ret);$i++){
    $hangshu +=1;
    $qy_name = $gm_ret[$i]['name'];
    $qy_id = $gm_ret[$i]['id'];
        $target_mid = $encode->encode("cmd=game_event_destsadd_self&event_id=$event_id&step_id=$step_id&scene_post_canshu=2&qy_id=$qy_id&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qy_name</a><br/>
HTML;
}
$allmap = <<<HTML
[请选择事件步骤的目标场景所属区域]<br/>
$map<br/>
<a href="?cmd=$gm_game_selfeventdefine_scene_last">返回上级</a><br/>
HTML;
echo $allmap;
}elseif($scene_post_canshu==2){
    $gm_game_selfeventdefine_scene_last = $encode->encode("cmd=game_event_destsadd_self&scene_post_canshu=1&event_id=$event_id&step_id=$step_id&sid=$sid");
    $hangshu = 0;
    $cxallmap = \player\getmid_detail($dblj,$qy_id);
    if(empty($_POST['kw'])){
    }elseif (isset($_POST['kw'])) {
        $keyword = $_POST['kw'];
        // 构建查询语句，使用过滤条件
        $sql = "select * from system_map where mname LIKE :keyword";
        $stmt = $dblj->prepare($sql);
        $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        $stmt->execute();
    
        // 显示过滤后的数据
        if ($stmt){
        $cxallmap = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $midname = $cxallmap[$i]['mname'];
    $mid = $cxallmap[$i]['mid'];
    $br++;;
    $target_mid = $encode->encode("cmd=game_event_destsadd_self&scene_post_canshu=add&event_id=$event_id&step_id=$step_id&mid=$mid&sid=$sid");
    $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$midname(s$mid)</a><br/>
HTML;
}
$allmap = <<<HTML
[请选择事件步骤的目标场景]<br/>
<form method="post">
快速搜索：<br/>
<input name="scene_post_canshu" type="hidden" value="2">
<input name="submit" type="hidden" title="提交" value="提交" />
<input name="kw" type="text" /><br/>
<input type="submit" value="提交" /></form><br /><br/>
$map<br/>
<a href="?cmd=$gm_game_selfeventdefine_scene_last">返回上级</a><br/>
HTML;
echo $allmap;
}
elseif($scene_post_canshu==3){
$ret_now = $encode->encode("cmd=game_event_destsadd_self&event_id=$event_id&step_id=$step_id&sid=$sid");
$game_event_destsadd = $encode->encode("cmd=game_event_destsadd_self&midexp=1&event_id=$event_id&step_id=$step_id&sid=$sid");
$allmap = <<<HTML
<p>请输入目标场景id表达式<br/>
</p>
<form action="?cmd=$game_event_destsadd" method="post">
场景id表达式:<textarea name="mid" maxlength="4096" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$ret_now">返回列表</a><br/>
HTML;
echo $allmap;
}
?>