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
    if($task_item_count ==1){
    $old = $remove_id."|".$remove_count;
    }elseif($task_item_count !=1 && $pos ==1){
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
$task_item = explode(',',$cltask ->ttarget_obj);
$task_item_count = @count($task_item);
$add_item = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&post_canshu=-1&canshu=additem&task_item_count=$task_item_count&task_id=$task_id&sid=$sid");
if (!empty($task_item[0])){
foreach ($task_item as $item_detail){
    $pos +=1;
    $item_list = explode('|',$item_detail);
    $item_id = $item_list[0];
    $item_count = $item_list[1];
    $item_fliter_count = urlencode($item_list[1]);
    $item_para = player\getitem($item_id,$dblj);
    $item_name = $item_para ->iname;
    $item_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=2&task_id=$task_id&change_id=$item_id&change_old_count=$item_fliter_count&sid=$sid");
    $item_remove = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=2&pos=$pos&task_item_count=$task_item_count&task_id=$task_id&remove_id=$item_id&remove_count=$item_count&sid=$sid");
    $item_list_html .= <<<HTML
    <a href="?cmd=$item_change">{$item_name}({$item_count})</a> <a href="?cmd=$item_remove">移除</a><br/>
HTML;
    }
}
$item_html = <<<HTML
<p>定义“{$task_name}”的任务物品<br/>
$item_list_html
<a href="?cmd=$add_item">添加物品</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
if($change_id !=0){
$item_para = player\getitem($change_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_type_npc&canshu=2&gm_post_canshu=4&task_id=$task_id&sid=$sid");
$item_change = $encode->encode("cmd=gm_type_npc&canshu=2&gm_post_canshu=4&task_id=$task_id&sid=$sid");
$item_html = <<<HTML
<p>修改“{$item_name}”的任务物品表达式<br/>
<form action="?cmd=$item_change" method="post">
<input name="change_this_id" type="hidden" title="确定" value="{$change_id}">
<input name="change_this_count" type="hidden" title="确定" value="{$change_old_count}">
数量表达式:<textarea name="count" maxlength="1024" rows="4" cols="40">{$change_old_count}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

if($canshu == 'additem'){
if($post_canshu == -1){
    $add_item_type = array(); // 创建一个空的关联数组
    for($i=0;$i<8;$i++){
        $add_item_type[$i] = $encode->encode("cmd=gm_type_npc&post_canshu=$i&gm_post_canshu=4&canshu=additem&task_item_count=$task_item_count&task_id=$task_id&sid=$sid");
    }
$last_page = $encode->encode("cmd=gm_type_npc&canshu=2&gm_post_canshu=4&task_id=$task_id&sid=$sid");
$item_html = <<<HTML
[定义任务条件物品]<br/>
请选择物品的类型：<br/>
<a href="?cmd={$add_item_type[0]}">消耗品</a><br/>
<a href="?cmd={$add_item_type[1]}">兵器</a><br/>
<a href="?cmd={$add_item_type[2]}">防具</a><br/>
<a href="?cmd={$add_item_type[3]}">书籍</a><br/>
<a href="?cmd={$add_item_type[4]}">兵器镶嵌物</a><br/>
<a href="?cmd={$add_item_type[5]}">防具镶嵌物</a><br/>
<a href="?cmd={$add_item_type[6]}">任务物品</a><br/>
<a href="?cmd={$add_item_type[7]}">其它</a><br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}else{
switch ($post_canshu) {
    case 0:
        $item_type = "消耗品";
        break;
    case 1:
        $item_type = "兵器";
        break;
    case 2:
        $item_type = "防具";
        break;
    case 3:
        $item_type = "书籍";
        break;
    case 4:
        $item_type = "兵器镶嵌物";
        break;
    case 5:
        $item_type = "防具镶嵌物";
        break;
    case 6:
        $item_type = "任务物品";
        break;
    case 7:
        $item_type = "其它";
        break;
    default:
        $item_type = "未知"; // 可以添加默认情况
}
    $cxallmap = \gm\get_item_list($dblj,$item_type);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $iname = $cxallmap[$i]['iname'];
    $iid = $cxallmap[$i]['iid'];
    $br++;
        //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
    $target_iid = $encode->encode("cmd=gm_type_npc&gm_post_canshu=4&canshu=additem_edit&add_item_id=$iid&task_item_count=$task_item_count&task_id=$task_id&sid=$sid");
    $item_list_detail .=<<<HTML
        <a href="?cmd=$target_iid" >$hangshu.$iname(i{$iid})</a><br/>
HTML;
}
$last_page = $encode->encode("cmd=gm_type_npc&canshu=additem&post_canshu=-1&gm_post_canshu=4&task_id=$task_id&sid=$sid");
$item_html = <<<HTML
请选择物品<br/>
$item_list_detail<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
}    
}

if($canshu == 'additem_edit'){
$item_para = player\getitem($add_item_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_type_npc&canshu=2&gm_post_canshu=4&task_id=$task_id&sid=$sid");
$item_change = $encode->encode("cmd=gm_type_npc&canshu=2&gm_post_canshu=4&task_id=$task_id&sid=$sid");
$item_add = $encode->encode("cmd=gm_type_npc&canshu=2&gm_post_canshu=4&task_item_count=$task_item_count&task_id=$task_id&sid=$sid");
$item_html = <<<HTML
<p>新增任务“{$item_name}”的物品数量表达式<br/>
<form action="?cmd=$item_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$add_item_id}">
数量表达式:<textarea name="add_count" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
}

echo $item_html;
?>