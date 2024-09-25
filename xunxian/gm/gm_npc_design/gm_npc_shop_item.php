<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");

if($_POST['change_this_id']){
    $old = $_POST['change_this_id']."|".$_POST['change_this_count'];
    $new = $_POST['change_this_id']."|".$_POST['count'];
    $sql = "UPDATE system_npc SET nshop_item_id = REPLACE(nshop_item_id, '$old', '$new') where nid = '$npc_id'";
    $dblj->exec($sql);
}

if($_POST['add_this_id']){
    // 获取原始字段值
    $stmt = $dblj->prepare("SELECT nshop_item_id FROM system_npc WHERE nid = '$npc_id'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldData = $result["nshop_item_id"];
    if($oldData ==''){
        if($_POST['add_count'] ==''){
            $_POST['add_count'] = 1;
        }
        $new = $_POST['add_this_id']."|".$_POST['add_count'];
    }else{
        if($_POST['add_count'] ==''){
            $_POST['add_count'] = 1;
        }
        $new = $oldData.",".$_POST['add_this_id']."|".$_POST['add_count'];
    }
    $sql = "UPDATE system_npc SET nshop_item_id = '$new' where nid = '$npc_id'";
    $dblj->exec($sql);
}

if($remove_id){
    if($npc_item_count ==1){
    $old = $remove_id."|".$remove_count;
    }elseif($npc_item_count !=1 && $pos ==1){
    $old = $remove_id."|".$remove_count.",";
    }else{
    $old = ",".$remove_id."|".$remove_count;
    }
    $sql = "UPDATE system_npc SET nshop_item_id = REPLACE(nshop_item_id, '$old', '') where nid = '$npc_id'";
    $dblj->exec($sql);
}

$pos = 0;
$clnid = player\getnpc($npc_id,$dblj);
$npc_name = $clnid ->nname;
$npc_item = explode(',',$clnid ->nshop_item_id);
$npc_item_count = @count($npc_item);
$add_item = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&post_canshu=-1&canshu=additem&npc_item_count=$npc_item_count&npc_id=$npc_id&sid=$sid");
if (!empty($npc_item[0])){
foreach ($npc_item as $item_detail){
    $pos +=1;
    $item_list = explode('|',$item_detail);
    $item_id = $item_list[0];
    $item_count = $item_list[1];
    $item_para = player\getitem($item_id,$dblj);
    $item_name = $item_para ->iname;
    $item_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_id=$npc_id&change_id=$item_id&change_old_count=$item_count&sid=$sid");
    $item_remove = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&pos=$pos&npc_item_count=$npc_item_count&npc_id=$npc_id&remove_id=$item_id&remove_count=$item_count&sid=$sid");
    //{$item_count}后续用，藏起来的数量
    $item_list_html .= <<<HTML
    <a href="?cmd=$item_change">{$item_name}</a> <a href="?cmd=$item_remove">移除</a><br/>
HTML;
    }
}
$item_html = <<<HTML
<p>定义npc“{$npc_name}”的销售物品<br/>
$item_list_html
<a href="?cmd=$add_item">添加物品</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
if($change_id !=0){
$item_para = player\getitem($change_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_id=$npc_id&sid=$sid");
$item_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_id=$npc_id&sid=$sid");
$item_html = <<<HTML
<p>修改npc“{$npc_name}”的销售物品“{$item_name}”<br/>
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
        $add_item_type[$i] = $encode->encode("cmd=gm_type_npc&post_canshu=$i&gm_post_canshu=12&canshu=additem&npc_item_count=$npc_item_count&npc_id=$npc_id&sid=$sid");
    }
$item_html = <<<HTML
[定义npc“{$npc_name}”的销售物品]<br/>
请选择物品的类型：<br/>
<a href="?cmd={$add_item_type[0]}">消耗品</a><br/>
<a href="?cmd={$add_item_type[1]}">兵器</a><br/>
<a href="?cmd={$add_item_type[2]}">防具</a><br/>
<a href="?cmd={$add_item_type[3]}">书籍</a><br/>
<a href="?cmd={$add_item_type[4]}">兵器镶嵌物</a><br/>
<a href="?cmd={$add_item_type[5]}">防具镶嵌物</a><br/>
<a href="?cmd={$add_item_type[6]}">任务物品</a><br/>
<a href="?cmd={$add_item_type[7]}">其它</a><br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上一页</a><br/>
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
    $cxallnpc = \gm\get_item_list($dblj,$item_type);
    for ($i=0;$i<count($cxallnpc);$i++){
    $hangshu +=1;
    $iname = $cxallnpc[$i]['iname'];
    $iid = $cxallnpc[$i]['iid'];
    $br++;
        //$target_nid = $encode->encode("cmd=target_nidnid&new_target_nid=$nid&sid=$sid");
    $target_iid = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&canshu=additem_edit&add_item_id=$iid&npc_item_count=$npc_item_count&npc_id=$npc_id&sid=$sid");
    $item_list_detail .=<<<HTML
        <a href="?cmd=$target_iid" >$hangshu.$iname(i{$iid})</a><br/>
HTML;
}
$item_html = <<<HTML
请选择物品<br/>
$item_list_detail<br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上一页</a><br/>
HTML;
}    
}

if($canshu == 'additem_edit'){
$item_para = player\getitem($add_item_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_id=$npc_id&sid=$sid");
$item_change = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_id=$npc_id&sid=$sid");
$item_add = $encode->encode("cmd=gm_type_npc&gm_post_canshu=12&npc_item_count=$npc_item_count&npc_id=$npc_id&sid=$sid");
$item_html = <<<HTML
<p>新增npc“{$npc_name}”的销售物品“{$item_name}”<br/>
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