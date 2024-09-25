<p>[请选择事件步骤的删除任务]</p>
<?php
$sql = "select * from system_task";
$task_post_canshu = 0;
$gm_cxjg = $dblj->query($sql);
$gm_game_globaleventdefine_task_last = $encode->encode("cmd=game_event_taskremove_self&event_id=$event_id&step_id=$step_id&sid=$sid");
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}

if(empty($_POST['kw'])){
}elseif (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from system_task where tname LIKE :keyword";
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
    $task_id = $gm_ret[$i]['tid'];
   // var_dump($gm_djname);
    $task_name = $gm_ret[$i]['tname'];
    $hangshu += 1;
    $task_url = $encode->encode("cmd=game_event_taskremove_self&task_remove_id=$task_id&event_id=$event_id&step_id=$step_id&sid=$sid");
    $attr_html .=<<<HTML
    [{$hangshu}].<a href="?cmd=$task_url">{$task_name}(t{$task_id})</a><br/>
HTML;
}
$task_post_canshu = 0;
$gm_html = <<<HTML
$attr_html
<form method="post">
快速搜索：<br/>
<input name="submit" type="hidden" title="提交" value="提交" />
<input name="kw" type="text" /><br/>
<input type="submit" value="提交" /></form><br /><br/>
<a href="?cmd=$gm_game_globaleventdefine_task_last">返回上级</a><br/>
HTML;
echo $gm_html;
?>