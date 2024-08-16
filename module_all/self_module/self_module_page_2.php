<?php

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$player = \player\getplayer($sid,$dblj);

$get_main_page = '';
$get_main_page = \gm\get_self_page($dblj,$self_id);
$table_id = "game_self_page_".$self_id;
if($delete_canshu==0 &&$delete_all ==0){
$op_type = 0;
$last_pos = 0;
if(!empty($main_id)){
$sql = '';
$sql="select * from `$table_id` where id='$main_id'";
$cxjg = $dblj->query($sql);
$cxjg->bindColumn('value',$main_value);
$cxjg->bindColumn('show_cond',$main_cond);
$cxjg->bindColumn('type',$main_type);
$cxjg->bindColumn('target_event',$target_event);
$cxjg->bindColumn('link_value',$link_value);
$cxjg->bindColumn('target_func',$target_func);
$cxjg->bindColumn('position',$last_pos);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
if($target_func !=0){
    $sql="select name from system_function where id='$target_func'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('name',$ele_func_name);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
}
$op_type = 1;
}else{
    $sql = "SELECT MAX(id) AS max_id FROM `$table_id`;";
    $cxjg = $dblj->query($sql);
    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
    $max_id = $row['max_id'] +1;
    $last_pos = @count($get_main_page)+1;
}
$delete_ele = $encode->encode("cmd=delete_ele_self&delete_value=$main_value&self_id=$self_id&delete_id=$main_id&delete_type=$main_type&delete_canshu=1&sid=$sid");
if($main_value ==''){
    $main_value = "未命名";
}
if($link_value ==''){
    $link_value = "http://";
}
switch($main_type){
    case '1':
        $game_main = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
        $page=<<<HTML
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><br/>
位置:<input name="position" maxlength="3" value="$last_pos"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
    case '2':
        if(!empty($target_event) && !empty($main_id)){
        $game_main_event = $encode->encode("cmd=game_main_event&main_position=$main_position&event_name=$main_value&main_id=$main_id&main_type=$main_type&event_id=$target_event&sid=$sid");
        }else{
        $game_main_event = $encode->encode("cmd=game_main_event&add_event=1&add_value=$main_value&gm_post_canshu=$self_id&main_id=$main_id&main_type=$main_type&sid=$sid");
        }
        $game_main = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
        $page=<<<HTML
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><br/>
触发事件:<a href="?cmd=$game_main_event">定义事件</a><br/>
触发任务:<a href="">定义任务</a><br/>
位置:<input name="position" maxlength="3" value="$last_pos"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
    case '3':
        $query = "SELECT name,id FROM system_function WHERE id = :target_func";
        $stmt = $dblj->prepare($query);
        $stmt->bindParam(':target_func', $target_func);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $ele_func_name = $result['name'];
        if(empty($func_id)){
            $func_id = $result['id'];
            $func_name = $ele_func_name;
        }
        $game_main_func = $encode->encode("cmd=game_main_func&self_id=$self_id&main_position=$main_position&func_name=$ele_func_name&gm_post_canshu=13&main_id=$main_id&main_type=$main_type&func_id=1&sid=$sid");
        $game_main = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
        $page=<<<HTML
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
<input type="hidden" name="func_id" value="$func_id"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><br/>
元素功能:<a href="?cmd=$game_main_func">{$func_name}</a><br/>
位置:<input name="position" maxlength="3" value="{$last_pos}"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
    case '4':
        $game_main = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
        $page=<<<HTML
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><br/>
链接地址:<input name="link_value" type="text" size="40" maxlength="200"/ value="{$link_value}"><br/>
位置:<input name="position" maxlength="3" value="$last_pos"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
}
if(!empty($main_id)){
$gm_html =<<<HTML
$page
<a href="?cmd=$delete_ele">删除该元素</a><br/>
<a href="?cmd=$game_main">返回上一级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
}else{
$gm_html =<<<HTML
$page
<a href="?cmd=$game_main">返回上一级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
HTML;
}
echo $gm_html;
}elseif ($delete_canshu==1 &&$delete_all ==0) {
    $last_page = $encode->encode("cmd=game_self_page_2&self_id=$self_id&main_id=$delete_id&main_type=$delete_type&sid=$sid");
    $sure_delete = $encode->encode("cmd=game_self_page_2&delete_sure_id=$delete_id&self_id=$self_id&main_type=$delete_type&sid=$sid");
    $module_page = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
    $gm_html =<<<HTML
    <p>确定要删除"{$delete_value}"元素吗？<br/>
<a href="?cmd=$sure_delete">确定删除</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$module_page">返回页面模板</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}elseif($delete_all ==1){
    $last_page = $encode->encode("cmd=game_self_page&gm_post_canshu=13&self_id=$self_id&sid=$sid");
    $sure_delete = $encode->encode("cmd=game_self_page_2&delete_all_canshu=1&self_id=$self_id&sid=$sid");
    $module_page = $encode->encode("cmd=game_self_page&gm_post_canshu=13&self_id=$self_id&sid=$sid");
    $gm_html =<<<HTML
    <p>确定要清空"{$self_name}模板[id:{$self_id}]"的所有元素吗？<br/>
<a href="?cmd=$sure_delete">确定删除</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$module_page">返回页面模板</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}
?>