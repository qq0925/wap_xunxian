<?php

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$player = \player\getplayer($sid,$dblj);

if(isset($del_event)){
//删除操作元素事件，先删除事件步骤，然后删除事件表，最后将对应模板数据库中的target_event字段置0；
echo "已删除！<br/>";
$sql = "delete from system_event_evs_self where belong = '$del_event'";
$dblj->exec($sql);

$sql = "delete from system_event_self where id = '$del_event'";
$dblj->exec($sql);

switch($gm_post_canshu){
    case '1':
        $del_module = 'scene_page';
        break;
    case '2':
        $del_module = 'npc_page';
        break;
    case '3':
        $del_module = 'pet_page';
        break;
    case '4':
        $del_module = 'item_page';
        break;
    case '5':
        $del_module = 'oplayer_page';
        break;
    case '6':
        $del_module = 'equip_page';
        break;
    case '7':
        $del_module = 'player_page';
        break;
    case '8':
        $del_module = 'skill_page';
        break;
    case '9':
        $del_module = 'function_page';
        break;
    case '10':
        $del_module = 'pve_page';
        break;
    case '11':
        $del_module = 'main_page';
        break;
    case '14':
        $del_module = 'equip_detail_page';
        break;
}
$del_module = 'game_'.$del_module;
$sql = "update `$del_module` set target_event = 0 where target_event = '$del_event'";
$dblj->exec($sql);
}

$get_main_page = '';
switch($gm_post_canshu){
    case '1':
        $get_main_page = \gm\get_scene_page($dblj);
        break;
    case '2':
        $get_main_page = \gm\get_npc_page($dblj);
        break;
    case '3':
        $get_main_page = \gm\get_pet_page($dblj);
        break;
    case '4':
        $get_main_page = \gm\get_item_page($dblj);
        break;
    case '5':
        $get_main_page = \gm\get_oplayer_page($dblj);
        break;
    case '6':
        $get_main_page = \gm\get_equip_page($dblj);
        break;
    case '7':
        $get_main_page = \gm\get_player_page($dblj);
        break;
    case '8':
        $get_main_page = \gm\get_skill_page($dblj);
        break;
    case '9':
        $get_main_page = \gm\get_function_page($dblj);
        break;
    case '10':
        $get_main_page = \gm\get_pve_page($dblj);
        break;
    case '11':
        $get_main_page = \gm\get_main_page($dblj);
        break;
    case '14':
        $get_main_page = \gm\get_equip_detail_page($dblj);
        break;
}




if($delete_canshu==0){
$op_type = 0;
$last_pos = 0;
if(!empty($main_id)){
    $sql = '';
    switch($gm_post_canshu){
        case '1':
            $sql="select * from game_scene_page where id='$main_id'";
            break;
        case '2':
            $sql="select * from game_npc_page where id='$main_id'";
            break;
        case '3':
            $sql="select * from game_pet_page where id='$main_id'";
            break;
        case '4':
            $sql="select * from game_item_page where id='$main_id'";
            break;
        case '5':
            $sql="select * from game_oplayer_page where id='$main_id'";
            break;
        case '6':
            $sql="select * from game_equip_page where id='$main_id'";
            break;
        case '7':
            $sql="select * from game_player_page where id='$main_id'";
            break;
        case '8':
            $sql="select * from game_skill_page where id='$main_id'";
            break;
        case '9':
            $sql="select * from game_function_page where id='$main_id'";
            break; 
        case '10':
            $sql="select * from game_pve_page where id='$main_id'";
            break; 
        case '11':
            $sql="select * from game_main_page where id='$main_id'";
            break;
        case '14':
            $sql="select * from game_equip_detail_page where id='$main_id'";
            break;
    }
$cxjg = $dblj->query($sql);
$cxjg->bindColumn('value',$main_value);
$cxjg->bindColumn('show_cond',$main_cond);
$cxjg->bindColumn('type',$main_type);
$cxjg->bindColumn('target_event',$target_event);
$cxjg->bindColumn('target_func',$target_func);
$cxjg->bindColumn('link_value',$link_value);
$cxjg->bindColumn('position',$last_pos);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
if ($main_value === "\r\n") {
    $main_value = "\n\n"; // 直接替换整个字符串为两个换行符
}
if($target_func !=0){
    $sql="select name from system_function where id='$target_func'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('name',$ele_func_name);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
}
$op_type = 1;
}else{
    
    switch($gm_post_canshu){
        case '1':
            $sql = "SELECT MAX(id) AS max_id FROM game_scene_page;";
            break;
        case '2':
            $sql = "SELECT MAX(id) AS max_id FROM game_npc_page;";
            break;
        case '3':
            $sql = "SELECT MAX(id) AS max_id FROM game_pet_page;";
            break;
        case '4':
            $sql = "SELECT MAX(id) AS max_id FROM game_item_page;";
            break;
        case '5':
            $sql = "SELECT MAX(id) AS max_id FROM game_oplayer_page;";
            break;
        case '6':
            $sql = "SELECT MAX(id) AS max_id FROM game_equip_page;";
            break;
        case '7':
            $sql = "SELECT MAX(id) AS max_id FROM game_player_page;";
            break;
        case '8':
            $sql = "SELECT MAX(id) AS max_id FROM game_skill_page;";
            break;
        case '9':
            $sql = "SELECT MAX(id) AS max_id FROM game_function_page;";
            break;
        case '10':
            $sql = "SELECT MAX(id) AS max_id FROM game_pve_page;";
            break;
        case '11':
            $sql = "SELECT MAX(id) AS max_id FROM game_main_page;";
            break;
        case '14':
            $sql = "SELECT MAX(id) AS max_id FROM game_equip_detail_page;";
            break;
    }
    $cxjg = $dblj->query($sql);
    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
    $max_id = $row['max_id'] +1;
    $last_pos = @count($get_main_page)+1;
}
$delete_ele = $encode->encode("cmd=delete_ele&delete_value=$main_value&delete_id=$main_id&delete_type=$main_type&gm_post_canshu=$gm_post_canshu&delete_canshu=1&sid=$sid");
if($main_value ==''){
    $main_value = "未命名";
}
//$main_value = '&#8203;' . $main_value;
if($link_value ==''){
    $link_value = "http://";
}
switch($main_type){
    case '1':
        $game_main = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
        $page=<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
元素名称:<textarea style="white-space: pre-wrap" name="text" maxlength="1024" rows="4" cols="40 value = "未命名">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><button type="button" onclick="insertTextAtCursorDesigner()">插入设计者权限判断</button><br/>
位置:<input name="position" maxlength="3" value="$last_pos" size="5"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
    case '2':
        if(!empty($target_event) && !empty($main_id)){
        $game_main_event = $encode->encode("cmd=game_main_event&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&event_id=$target_event&sid=$sid");
        $game_main_event_del = $encode->encode("cmd=game_main_event&del_event=1&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&event_id=$target_event&sid=$sid");
        $event_show_text = <<<HTML
<a href="?cmd=$game_main_event">修改事件</a><a href="?cmd=$game_main_event_del">删除事件</a>
HTML;
        }elseif(empty($target_event) &&empty($main_id)){
        $event_show_text = <<<HTML
定义事件
HTML;
        }elseif(empty($target_event) && !empty($main_id)){
        $game_main_event = $encode->encode("cmd=game_main_event&add_event=1&add_value=$main_value&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&sid=$sid");
        $event_show_text = <<<HTML
<a href="?cmd=$game_main_event">定义事件</a>
HTML;
        }
        $game_main = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
        $page=<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="{$main_id}">
<input type="hidden" name="add_id" value="{$max_id}">
<input type="hidden" name="main_type" value="{$main_type}"> 
<input type="hidden" name="op_type" value="{$op_type}"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40 value="未命名">{$main_value}</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">{$main_cond}</textarea><button type="button" onclick="insertTextAtCursorDesigner()">插入设计者权限判断</button><br/>
触发事件:{$event_show_text}<br/>
触发任务:<a href="">定义任务</a><br/>
位置:<input name="position" maxlength="3" value="$last_pos" size="5"><br/>
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
        $game_main_func = $encode->encode("cmd=game_main_func&func_name=$ele_func_name&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&func_id=1&sid=$sid");
        $game_main = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
        $page=<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
<input type="hidden" name="func_id" value="$func_id"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40" value="未命名">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><button type="button" onclick="insertTextAtCursorDesigner()">插入设计者权限判断</button><br/>
元素功能:<a href="?cmd=$game_main_func">{$func_name}</a><br/>
位置:<input name="position" maxlength="3" value="{$last_pos}" size="5"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
    case '4':
        $game_main = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
        $page=<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="$main_id">
<input type="hidden" name="add_id" value="$max_id">
<input type="hidden" name="main_type" value="$main_type"> 
<input type="hidden" name="op_type" value="$op_type"> 
元素名称:<textarea name="text" maxlength="1024" rows="4" cols="40" value="未命名">$main_value</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">$main_cond</textarea><button type="button" onclick="insertTextAtCursorDesigner()">插入设计者权限判断</button><br/>
链接地址:<input name="link_value" type="text" size="40" maxlength="200"/ value="{$link_value}"><br/>
位置:<input name="position" maxlength="3" value="{$last_pos}" size="5"><br/>
<input name="submit" type="submit" title="确定" value="确定"/>
</form><br/>
HTML;
break;
    case '5':
        if(!empty($target_event) && !empty($main_id)){
        $game_main_event = $encode->encode("cmd=game_main_event&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&event_id=$target_event&sid=$sid");
        $game_main_event_del = $encode->encode("cmd=game_main_event&del_event=1&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&event_id=$target_event&sid=$sid");
        $event_show_text = <<<HTML
<a href="?cmd=$game_main_event">修改事件</a><a href="?cmd=$game_main_event_del">删除事件</a>
HTML;
        }elseif(empty($target_event) &&empty($main_id)){
        $event_show_text = <<<HTML
定义事件
HTML;
        }elseif(empty($target_event) && !empty($main_id)){
        $game_main_event = $encode->encode("cmd=game_main_event&add_event=1&add_value=$main_value&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&sid=$sid");
        $event_show_text = <<<HTML
<a href="?cmd=$game_main_event">定义事件</a>
HTML;
        }
        if($main_value=='未命名'){
            $main_value =<<<HTML
请输入：<input name ="test">
<input type ="submit">
HTML;
        }
        $game_main = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
        $page=<<<HTML
<script type="text/javascript" src="js/auto_insert.js"></script>
<form action="?cmd=$game_main" method="post">
<input type="hidden" name="ele_id" value="{$main_id}">
<input type="hidden" name="add_id" value="{$max_id}">
<input type="hidden" name="main_type" value="{$main_type}"> 
<input type="hidden" name="op_type" value="{$op_type}"> 
输入框表达式:<textarea name="text" maxlength="1024" rows="4" cols="40 value="输入框1">{$main_value}</textarea><br/>
显示条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">{$main_cond}</textarea><button type="button" onclick="insertTextAtCursorDesigner()">插入设计者权限判断</button><br/>
触发事件:{$event_show_text}<br/>
位置:<input name="position" maxlength="3" value="$last_pos" size="5"><br/>
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
}elseif ($delete_canshu==1) {
    $last_page = $encode->encode("cmd=game_page_2&main_id=$delete_id&gm_post_canshu=$gm_post_canshu&main_type=$delete_type&sid=$sid");
    $sure_delete = $encode->encode("cmd=game_page_2&delete_sure_id=$delete_id&gm_post_canshu=$gm_post_canshu&main_type=$delete_type&sid=$sid");
    $module_page = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $gm_html =<<<HTML
    <p>确定要删除"{$delete_value}"元素吗？<br/>
<a href="?cmd=$sure_delete">确定删除</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$module_page">返回页面模板</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
echo $gm_html;
}
?>