<?php
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();


if($reboot_id){
$sql = "UPDATE system_self_define_module set call_sum = 0 where id = '$reboot_id'";
$cxjg = $dblj->query($sql);
echo "已清空调用次数！<br/>";
}

if($_POST['change_module_name']&&$change_name){
$sql = "UPDATE system_self_define_module set name = '$change_name' where id = '$change_self_id'";
$cxjg = $dblj->query($sql);
echo "更改成功！<br/>";
$self_id = $change_self_id;
}

if($_POST['change_module_id']&&$change_id){
$old_id = 'ct_'.$change_self_id;
$new_id = 'ct_'.$change_id;
$old_table_id = 'game_self_page_'.$change_self_id;
$new_table_id = 'game_self_page_'.$change_id;
$sql = "RENAME TABLE `$old_table_id` TO `$new_table_id`";;
$cxjg = $dblj->exec($sql);
$sql = "UPDATE system_event_self set module_id = '$new_table_id' where module_id = '$old_table_id'";
$cxjg = $dblj->query($sql);
$sql = "UPDATE system_event_evs set page_name = '$new_id' where page_name = '$old_id'";
$cxjg = $dblj->query($sql);
$global_affect = $cxjg->rowCount();
echo "受影响的公共事件步骤数量：$global_affect".'<br/>';
$sql = "UPDATE system_event_evs_self set page_name = '$new_id' where page_name = '$old_id'";
$cxjg = $dblj->query($sql);
$self_affect = $cxjg->rowCount();
echo "受影响的私有事件步骤数量：$self_affect".'<br/>';
$sql = "UPDATE system_self_define_module set id = '$change_id' where id = '$change_self_id'";
$cxjg = $dblj->query($sql);
echo "更改成功！<br/>";
$self_id = $change_id;
}

if($_POST['change_not_return']){
$sql = "UPDATE system_self_define_module set not_return = '$not_return' where id = '$change_self_id'";
$cxjg = $dblj->query($sql);
echo "更改成功！<br/>";
}

if($_POST['post_type'] == 'cj'){

if($change_type == 'css'){
    $sql = "UPDATE `system_self_define_module` set css = :update_css where id = :update_id";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':update_css', $change_css_text);
    $stmt->bindParam(':update_id', $module_id);
    $stmt->execute();
    echo "更新了css文件！<br/>";
}elseif($change_type == 'js'){
    $sql = "UPDATE `system_self_define_module` set js = :update_js where id = :update_id";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':update_js', $change_js_text);
    $stmt->bindParam(':update_id', $module_id);
    $stmt->execute();
    echo "更新了js文件！<br/>";
}

}

if(!empty($_POST) &&!$_POST['change_module_name']&&$_POST['post_type']!='cj'){
$text = $_POST['text'];
$cond = $_POST['cond'];
$position = $_POST['position'];
$op_type = $_POST['op_type'];
if($gm_post_canshu!=0){
if ($main_type == 1) {
    $op_value = "文本元素";
} elseif ($main_type == 2) {
    $op_value = "操作元素";
} elseif ($main_type == 3) {
    $op_value = "功能元素";
} elseif ($main_type == 4) {
    $op_value = "链接元素";
}

if(!empty($main_type)){
echo "<br/>";
echo "文本值：".nl2br($text)."<br/>"."显示条件：".$cond."<br/>"."当前位置：".$position."<br/>"."元素类别：".$op_value;
echo "<br/>";
}
}
if (!empty($text)){
    if($op_type ==0){
    echo "新建成功!<br/>";
    $module_type = "game_self_page_".$self_id;
    $sql = "INSERT INTO `$module_type` (position, type, show_cond, value, target_func,link_value) VALUES (:position, :main_type, :cond, :text, 12,:link_value)";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':main_type', $main_type);
    $stmt->bindParam(':cond', $cond);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':link_value', $link_value);
    $stmt->execute();
    $sql = "UPDATE `$module_type` SET position = position + 1 WHERE position >= '$position' and id !='$add_id';";
    $cxjg = $dblj->exec($sql);
    }elseif($op_type ==1){
    echo "修改成功!<br/>";
    $module_type = "game_self_page_".$self_id;
    $sql = "UPDATE `$module_type` SET position = :position, value = :text, type = :main_type, show_cond = :cond, target_func = :func_id ,link_value = :link_value WHERE id = :ele_id";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':main_type', $main_type);
    $stmt->bindParam(':cond', $cond);
    $stmt->bindParam(':func_id', $func_id);
    $stmt->bindParam(':link_value', $link_value);
    $stmt->bindParam(':ele_id', $ele_id);
    $stmt->execute();    
    $sql = "UPDATE `$module_type` SET position = position + 1 WHERE position >= '$position' and id !='$ele_id';";
    $cxjg = $dblj->exec($sql);
    $table_id = "game_self_page_".$self_id;
    $query = "SELECT * FROM system_event_self WHERE `belong` = :belong and module_id = '$table_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':belong', $ele_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $event_desc = $row['desc'];
    if($event_desc !=$text){
    $sql = "UPDATE system_event_self SET `desc` = '$text' WHERE `belong` = '$ele_id' and module_id = '$table_id';";
    $cxjg = $dblj->exec($sql);
    }    
    }
}
}


$game_page_13_1 = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_type=1&sid=$sid");
$game_page_13_2 = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_type=2&sid=$sid");
$game_page_13_3 = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_type=3&sid=$sid");
$game_page_13_4 = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_type=4&sid=$sid");
$game_page_13_5 = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_type=5&sid=$sid");

$gm = $encode->encode("cmd=gm&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_self_page_list($dblj,$self_id)[0];
$self_name = $get_main_page['name'];
$self_call_sum = $get_main_page['call_sum'];
$self_id = $get_main_page['id'];
$not_return = $get_main_page['not_return'];
$module_css_text = htmlspecialchars($get_main_page['css']);
$module_js_text = htmlspecialchars($get_main_page['js']);

if($not_return ==0){
    $choose_html = <<<HTML
    <select name="not_return" id="not_return">
        <option value="0" selected>是</option>
        <option value="1" >否</option>
    </select>
HTML;
}else{
    $choose_html = <<<HTML
    <select name="not_return" id="not_return">
        <option value="0" >是</option>
        <option value="1" selected>否</option>
    </select>
HTML;
}

$get_main_page = \gm\get_self_page($dblj,$self_id);
$table_id = "game_self_page_".$self_id;
$sql_id = "ct_".$self_id;
$sql = "SELECT count(*) as self_call_count from system_event_evs_self where page_name = '$sql_id'";
$cxjg = $dblj->query($sql);
$page_mid_count = $cxjg->fetch(PDO::FETCH_ASSOC);
$page_count = $page_mid_count['self_call_count'];
$hangshu =0;
$last_page = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=13&sid=$sid");
$game_page_13_6 = $encode->encode("cmd=game_self_page_2&self_name=$self_name&delete_all=1&self_id=$self_id&sid=$sid");

for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE `$table_id` SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_id=$main_id&main_position=$main_position&self_id=$self_id&main_type=$main_type&sid=$sid");
    $order = array("\r\n", "\n", "\r");
    $replace = "↓<br/>";
    $original_value = $main_value; // 保存原始值
    $main_value=str_replace($order, $replace, $main_value);
    if ($original_value !== $main_value) {
    // 替换发生了
        $game_main .=<<<HTML
<a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
} else {
    // 没有发生替换
        $game_main .=<<<HTML
<a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
}
}
$self_test = $encode->encode("cmd=self_module_api&page_name=$sql_id&sid=$sid");
$reboot = $encode->encode("cmd=game_self_page&reboot_id=$self_id&self_id=$self_id&sid=$sid");
$css_update = $encode->encode("cmd=game_self_page&change_type=css&module_id=$self_id&sid=$sid");
$js_update = $encode->encode("cmd=game_self_page&change_type=js&module_id=$self_id&sid=$sid");
$all = <<<HTML
定义[{$self_name}]<form method="post">
<input type="hidden" name="change_self_id" value="{$self_id}">
<input name="change_name" placeholder="{$self_name}" size="20"">
<input name="change_module_name" type="submit" title="更名" value="更名"/>
</form>
<form method="post">
<input type="hidden" name="change_self_id" value="{$self_id}">
<input name="change_id" placeholder="{$self_id}" size="20"">
<input name="change_module_id" type="submit" title="修改id" value="更ID"/>
</form>
是否生成返回链接:<form method="post">
<input type="hidden" name="change_self_id" value="{$self_id}">
$choose_html
<input name="change_not_return" type="submit" title="修改" value="修改"/>
</form>
模板：ct_{$self_id}[调用个数：{$page_count},调用次数：{$self_call_sum}<a href="?cmd=$reboot">清空</a>|<a href="?cmd=$self_test" >测试</a>]<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_13_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_13_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_13_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_13_4">添加链接元素</a><br/>
<a href="?cmd=$game_page_13_5">添加输入框元素</a><br/>
<a href="?cmd=$game_page_13_6">清空所有元素</a><br/>
css样式:<br/>
<form action="?cmd=$css_update" method="POST">
<textarea name="change_css_text" maxlength="-1" rows="6" cols="30" >{$module_css_text}</textarea>
<input name="post_type" hidden value="cj">
<input name="submit" type="submit" title="保存" value="保存">
</form>
js代码:<br/>
<form action="?cmd=$js_update" method="POST">
<textarea name="change_js_text" maxlength="-1" rows="6" cols="30" >{$module_js_text}</textarea>
<input name="post_type" hidden value="cj">
<input name="submit" type="submit" title="保存" value="保存">
</form><br/>
<a href="?cmd=$last_page">返回上一级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $all;
?>