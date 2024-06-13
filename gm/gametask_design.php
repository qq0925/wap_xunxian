<?php
$gm = $encode->encode("cmd=gm&sid=$sid");

if($gm_post_canshu ==""){
$gm_game_taskdefine_1 = $encode->encode("cmd=gm_game_taskdesign&gm_post_canshu=1&sid=$sid");
$kill_task_count = @count(\gm\get_task_list($dblj,1));
$gm_game_taskdefine_2 = $encode->encode("cmd=gm_game_taskdesign&gm_post_canshu=2&sid=$sid");
$find_task_count = @count(\gm\get_task_list($dblj,2));
$gm_game_taskdefine_3 = $encode->encode("cmd=gm_game_taskdesign&gm_post_canshu=3&sid=$sid");
$do_task_count = @count(\gm\get_task_list($dblj,3));
$gm_html = <<<HTML
<p>[任务设计]<br/>
请选择任务类别：<br/>
<a href="?cmd=$gm_game_taskdefine_1">杀怪任务</a>($kill_task_count)<br/>
<a href="?cmd=$gm_game_taskdefine_2">寻物任务</a>($find_task_count)<br/>
<a href="?cmd=$gm_game_taskdefine_3">办事任务</a>($do_task_count)<br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}else{
$page_subtype = 0;
if(empty($_POST['kw'])){
$get_task_list = \gm\get_task_list($dblj,$gm_post_canshu);
}
if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_task` where ttype ='$gm_post_canshu' AND iname LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $get_task_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$hangshu =0;
$back_list = $encode->encode("cmd=gm_game_taskdesign&sid=$sid");
for ($i=0;$i<count($get_task_list);$i++){
    $hangshu +=1;
    $task_id = $get_task_list[$i]['tid'];
    $task_name = $get_task_list[$i]['tname'];
    $task_type = $get_task_list[$i]['ttype'];
    $task_type2 = $get_task_list[$i]['ttype2'];
    $task_url = $encode->encode("cmd=game_task_list&task_id=$task_id&task_type=$gm_post_canshu&tasktype2=$task_type2&sid=$sid");
    $task_list .=<<<HTML
    <a href="?cmd=$task_url" >$hangshu.{$task_name}(t{$task_id})</a><br/>
HTML;
}
$task_type_name = ($gm_post_canshu == 1) ? "杀怪" : (($gm_post_canshu == 2) ? "寻物" : "办事");

$gm_html =<<<HTML
<p>{$task_type_name}类任务列表：<br/>
$task_list
</p>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$back_list">返回类别列表</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}
?>