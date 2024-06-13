<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=system_task_detail&task_id=$task_id&sid=$sid");

if($_POST['change_this_id']){
    $old = $_POST['change_this_id']."|".$_POST['change_this_count'];
    $new = $_POST['change_this_id']."|".$_POST['count'];
    $sql = "UPDATE system_task SET ttarget_obj = REPLACE(ttarget_obj, '$old', '$new') where tid = '$task_id'";
    $dblj->exec($sql);
}

if($_POST['add_this_id']){
    // 获取原始字段值
    $stmt = $dblj->prepare("SELECT ttarget_obj FROM system_task WHERE tid = '$task_id'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldData = $result["ttarget_obj"];
    if($oldData ==''){
        $new = $_POST['add_this_id']."|".$_POST['add_count'];
    }else{
        $new = $oldData.",".$_POST['add_this_id']."|".$_POST['add_count'];
    }
    $sql = "UPDATE system_task SET ttarget_obj = '$new' where tid = '$task_id'";
    $dblj->exec($sql);
}

if($remove_id){
    if($task_npc_count ==1){
    $old = $remove_id."|".$remove_count;
    }elseif($task_npc_count !=1 && $pos ==1){
    $old = $remove_id."|".$remove_count.",";
    }else{
    $old = ",".$remove_id."|".$remove_count;
    }
    $sql = "UPDATE system_task SET ttarget_obj = REPLACE(ttarget_obj, '$old', '') where tid = '$task_id'";
    $dblj->exec($sql);
}

$pos = 0;
$cltask = player\gettask($task_id,$dblj);
$task_name = $cltask ->tname;
$task_npc = explode(',',$cltask ->ttarget_obj);
$task_npc_count = @count($task_npc);
$add_npc = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=addnpc&task_npc_count=$task_npc_count&task_id=$task_id&sid=$sid");
if (!empty($task_npc[0])){
foreach ($task_npc as $npc_detail){
    $pos +=1;
    $npc_list = explode('|',$npc_detail);
    $npc_id = $npc_list[0];
    $npc_count = $npc_list[1];
    $npc_count_2 = urlencode($npc_count);
    $npc_para = player\getnpc($npc_id,$dblj);
    $npc_name = $npc_para ->nname;
    $npc_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&change_id=$npc_id&change_old_count=$npc_count_2&sid=$sid");
    $npc_remove = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&pos=$pos&task_npc_count=$task_npc_count&task_id=$task_id&remove_id=$npc_id&remove_count=$npc_count_2&sid=$sid");
    $npc_list_html .= <<<HTML
    <a href="?cmd=$npc_change">{$npc_name}({$npc_count})</a> <a href="?cmd=$npc_remove">移除</a><br/>
HTML;
    }
}
$npc_html = <<<HTML
<p>定义任务“{$task_name}”的杀人人物<br/>
$npc_list_html
<a href="?cmd=$add_npc">添加人物</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
if($change_id !=0){
$npc_para = player\getnpc($change_id,$dblj);
$npc_name = $npc_para ->nname;
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&sid=$sid");
$npc_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&sid=$sid");
$npc_html = <<<HTML
<p>修改任务人物“{$npc_name}”的杀人数量<br/>
<form action="?cmd=$npc_change" method="post">
<input name="change_this_id" type="hidden" title="确定" value="{$change_id}">
<input name="change_this_count" type="hidden" title="确定" value="{$change_old_count}">
数量表达式:<textarea name="count" maxlength="1024" rows="4" cols="40">{$change_old_count}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

if($canshu == 'addnpc'){
$cxallmap = \player\getqy_all($dblj);
$br = 0;
if($hanghsu == 0 && $post_canshu ==0){
for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
        $target_mid = $encode->encode("cmd=gm_type_npc&hangshu=$hangshu&post_canshu=1&gm_post_canshu=4&qy_id=$qy_id&canshu=addnpc&task_npc_count=$task_npc_count&task_id=$task_id&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname</a><br/>
HTML;
}
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&sid=$sid");
$npc_html = <<<HTML
[定义任务的杀人人物]<br/>
请选择电脑人物所属区域：<br/>
$map<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}elseif($post_canshu==1){
    $hangshu = 0;
    $cxallmap = \gm\get_npc_list($dblj,$qy_id);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $nname = $cxallmap[$i]['nname'];
    $nid = $cxallmap[$i]['nid'];
    $br++;
        //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
    $target_nid = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=addnpc_edit&add_npc_id=$nid&task_npc_count=$task_npc_count&task_id=$task_id&sid=$sid");
    $npc_list_detail .=<<<HTML
        <a href="?cmd=$target_nid" >$hangshu.$nname(n{$nid})</a><br/>
HTML;
}
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=addnpc&task_id=$task_id&sid=$sid");
$npc_html = <<<HTML
[基本信息设置]<br/>
请选择电脑人物<br/>
$npc_list_detail<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}    
}

if($canshu == 'addnpc_edit'){
$npc_para = player\getnpc($add_npc_id,$dblj);
$npc_name = $npc_para ->nname;
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&sid=$sid");
$npc_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_id=$task_id&sid=$sid");
$npc_add = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=1&task_npc_count=$task_npc_count&task_id=$task_id&sid=$sid");
$npc_html = <<<HTML
<p>新增任务的“{$npc_name}”的杀人人物<br/>
<form action="?cmd=$npc_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$add_npc_id}">
数量表达式:<textarea name="add_count" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

echo $npc_html;
?>