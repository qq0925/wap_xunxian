<?php

if(!empty($_POST) ||$op_canshu == 'remove'){
if($op_canshu =='change'){
$key=$_POST['change_this_id'];
$value=$_POST['count'];
$npc_id=$_POST['npc_id'];

$sql = "SELECT ndrop_item FROM system_npc WHERE nid = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$npc_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true);

$data[$key] = $value; // 自动覆盖重复键
echo "更新完成！<br/>";

}elseif($op_canshu == 'add'){
$key=$_POST['add_this_id'];
$value=$_POST['add_count'];
$npc_id=$_POST['npc_id'];

$sql = "SELECT ndrop_item FROM system_npc WHERE nid = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$npc_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true)??[];

$data[$key] = $value; // 自动覆盖重复键
echo "新增完成！<br/>";

}
elseif($op_canshu == 'remove'){
$sql = "SELECT ndrop_item FROM system_npc WHERE nid = ?"; 
$stmt = $dblj->prepare($sql);
$stmt->execute([$npc_id]);
$currentJson = $stmt->fetchColumn();
// 3. 解析JSON并更新键值
$data = json_decode($currentJson, true)??[];
unset($data[$remove_id]); // 移除该项数组
echo "删除完成！<br/>";
}
if($data){
$newJson = json_encode($data,true);
}else{
$newJson = '';
}
$updateSql = "UPDATE system_npc SET ndrop_item = ? WHERE nid = ?";
$updateStmt = $dblj->prepare($updateSql);
$updateStmt->execute([$newJson,$npc_id]);
}



if($canshu ==1){

if($change_basic){
    $update_exp = $_POST['exp'];
    $update_money = $_POST['money'];
    $update_drop_type = $_POST['drop_type'];
    
    // 验证输入数据
    $formula_error = false;
    
    // 验证经验公式
    try {
        // 执行简单测试以检查公式语法
        $promotion_exp_check = $update_exp !== '' 
        ? \lexical_analysis\process_string($update_exp, $sid, $oid, $mid, null, null, "check_cond") 
        : 1;
        @$ret = eval("return $promotion_exp_check;");
    } catch (ParseError $e) {
        $formula_error = true;
        echo "经验掉落公式语法错误: " . $e->getMessage() . "<br/>";
    }
    
    // 验证金钱公式
    try {
        $promotion_money_check = $update_money !== '' 
        ? \lexical_analysis\process_string($update_money, $sid, $oid, $mid, null, null, "check_cond") 
        : 1;
        // 执行简单测试以检查公式语法
        @$ret = eval("return $promotion_money_check;");
    } catch (ParseError $e) {
        $formula_error = true;
        echo "金钱掉落公式语法错误: " . $e->getMessage() . "<br/>";
    }
    
    // 如果没有公式错误，执行更新
    if (!$formula_error) {
        try {
            // 使用预处理语句更新数据库
            $sql = "UPDATE system_npc SET 
                    ndrop_exp = :drop_exp, 
                    ndrop_money = :drop_money,
                    ndrop_item_type = :drop_type
                    WHERE nid = :npc_id";
            
            $stmt = $dblj->prepare($sql);
            
            // 绑定参数
            $stmt->bindParam(':drop_exp', $update_exp);
            $stmt->bindParam(':drop_money', $update_money);
            $stmt->bindParam(':drop_type', $update_drop_type, PDO::PARAM_INT);
            $stmt->bindParam(':npc_id', $npc_id);
            
            // 执行更新
            $stmt->execute();
            
            echo "NPC掉落设置已成功更新<br/>";
            
            // 刷新数据以显示更新后的值
            $sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':npc_id', $npc_id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $npc_drop_exp = $row['ndrop_exp'];
            $npc_drop_money = $row['ndrop_money'];
            $npc_drop_type = $row['ndrop_item_type'];
            $select_para = $npc_drop_type == 1 ? "selected" : "";
        } catch (PDOException $e) {
            echo "数据库更新错误: " . $e->getMessage() . "<br/>";
        }
    } else {
        echo "由于公式错误，未执行数据库更新<br/>";
    }
}

$area_main = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
$drop_item_modify = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':npc_id', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];
$npc_drop_exp = $row['ndrop_exp'];
$npc_drop_money = $row['ndrop_money'];
$npc_drop_item = $row['ndrop_item'];
$npc_drop_type = $row['ndrop_item_type'];
$select_para = $npc_drop_type ==1?"selected" :"";
if($npc_drop_item){
$npc_drop_item_count = @count(explode(",",$npc_drop_item));
}else{
$npc_drop_item_count = 0;
}
$dead_html = <<<HTML
NPC“{$npc_name}”死后掉落定义<br/>
<form method="post">
<input name="change_basic" type="hidden" value="1">
掉经验值表达式:<textarea name="exp" maxlength="1024" rows="4" cols="40">{$npc_drop_exp}</textarea><br/>
掉钱表达式:<textarea name="money" maxlength="1024" rows="4" cols="40">{$npc_drop_money}</textarea><br/>
掉落物品:<a href="?cmd=$drop_item_modify">修改({$npc_drop_item_count})</a><br/>
掉落物品方式:<select name="drop_type">
<option value = "0">直接到背包</option><br/>
<option value = "1" $select_para>直接到地上</option><br/>
</select><br/>
<input name="submit" type="submit" title="确定" value="确定"><br/><br/>
</form>
<a href="?cmd=$area_main">返回上级</a><br/>
HTML;
}elseif ($canshu ==2) {

$area_main = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=1&npc_id=$npc_id&sid=$sid");
$sql = "SELECT * FROM system_npc WHERE nid = :npc_id";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':npc_id', $npc_id,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$npc_id = $row['nid'];
$npc_name = $row['nname'];
$npc_drop_list = $row['ndrop_item'];
$drops = json_decode($npc_drop_list,true);
if($drops){
foreach ($drops as $drop_target=>$drop_count){
        $drop_fliter_count = urlencode($drop_count);
        $sql = "SELECT * FROM system_item_module WHERE iid = :id";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':id', $drop_target,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $drop_name = $row['iname'];
        $drop_id = $row['iid'];
        $drop_list_detail = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=3&drop_id=$drop_id&drop_name=$drop_name&drop_count=$drop_fliter_count&npc_id=$npc_id&sid=$sid");
        $drop_delete = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&op_canshu=remove&remove_id=$drop_id&npc_id=$npc_id&sid=$sid");
        $drop_list .=<<<HTML
        <a href="?cmd=$drop_list_detail">{$drop_name}({$drop_count})</a><a href = "?cmd=$drop_delete">移除</a><br/>
HTML;
            }
}
$add_drop = $encode->encode("cmd=gm_type_npc&post_canshu=-1&gm_post_canshu=7&canshu=additem&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
放置电脑人物“{$npc_name}”的死后掉落物品<br/>
<form method="post">
$drop_list
</form>
<a href="?cmd=$add_drop">增加物品</a><br/>
<a href="?cmd=$area_main">返回上级</a><br/>
HTML;
}elseif($canshu ==3){
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
设置物品的数量<br/>
<form method="post">
<input name="change_this_id" type="hidden" value="{$drop_id}">
<input name="canshu" type="hidden" value="2">
<input name="op_canshu" type="hidden" value="change">
<input name="npc_id" type="hidden" value="{$npc_id}">
物品:{$drop_name}<br/>
数量表达式:<textarea name="count" maxlength="1024" rows="4" cols="40">{$drop_count}</textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"><br/>
</form>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}

if($canshu == 'additem'){
if($post_canshu == -1){
    $add_item_type = array(); // 创建一个空的关联数组
    for($i=0;$i<8;$i++){
        $add_item_type[$i] = $encode->encode("cmd=gm_type_npc&post_canshu=$i&gm_post_canshu=7&canshu=additem&npc_id=$npc_id&sid=$sid");
    }
    $last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
[定义NPC的死后掉落物品]<br/>
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
    $target_iid = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&post_canshu=$post_canshu&canshu=additem_edit&add_item_id=$iid&npc_id=$npc_id&sid=$sid");
    $item_list_detail .=<<<HTML
        <a href="?cmd=$target_iid" >$hangshu.$iname(i{$iid})</a><br/>
HTML;
}
$last_page = $encode->encode("cmd=gm_type_npc&post_canshu=-1&gm_post_canshu=7&canshu=additem&npc_id=$npc_id&sid=$sid");
$last_main = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
请选择物品<br/>
$item_list_detail<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
<a href="?cmd=$last_main">返回最上级</a><br/>
HTML;
}    
}

if($canshu == 'additem_edit'){
$item_para = player\getitem($add_item_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&post_canshu=$post_canshu&canshu=additem&npc_id=$npc_id&sid=$sid");
$last_main = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&canshu=2&npc_id=$npc_id&sid=$sid");
$item_add = $encode->encode("cmd=gm_type_npc&gm_post_canshu=7&op_canshu=add&canshu=2&npc_id=$npc_id&sid=$sid");
$dead_html = <<<HTML
定义NPC的死后掉落物品“{$item_name}”<br/>
<form action="?cmd=$item_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$add_item_id}">
<input name="npc_id" type="hidden" value="{$npc_id}">
数量表达式:<textarea name="add_count" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/></form><br/>
</form>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$last_main">返回最上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}

echo $dead_html;
?>