<p>[请选择事件步骤的废除技能]</p>
<?php
$sql = "select * from system_skill";
$skill_post_canshu = 0;
$gm_cxjg = $dblj->query($sql);
$gm_game_globaleventdefine_skill_last = $encode->encode("cmd=game_event_skillremove_self&event_id=$event_id&step_id=$step_id&sid=$sid");
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}

if(empty($_POST['kw'])){
}elseif (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from system_skill where jname LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // 显示过滤后的数据
    if ($stmt){
    $gm_ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


$attr_html = '';
//$hangshu = 0;
for ($i=0;$i<count($gm_ret);$i++){
    //var_dump($gm_retdj);
    $skill_id = $gm_ret[$i]['jid'];
   // var_dump($gm_djname);
    $skill_name = $gm_ret[$i]['jname'];
    $hangshu += 1;
    $skill_url = $encode->encode("cmd=game_event_skillremove_self&skill_remove_id=$skill_id&event_id=$event_id&step_id=$step_id&sid=$sid");
    $attr_html .=<<<HTML
    [{$hangshu}].<a href="?cmd=$skill_url">{$skill_name}(j{$skill_id})</a><br/>
HTML;
}
$skill_post_canshu = 0;
$gm_html = <<<HTML
$attr_html
<form method="post">
快速搜索：<br/>
<input name="submit" type="hidden" title="提交" value="提交" />
<input name="kw" type="text" /><br/>
<input type="submit" value="提交" /></form><br /><br/>
<a href="?cmd=$gm_game_globaleventdefine_skill_last">返回上级</a><br/>
HTML;
echo $gm_html;
?>