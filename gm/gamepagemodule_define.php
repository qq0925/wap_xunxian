<?php
header('Content-Type:text/html;charset=utf-8');
$last_page = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=0&sid=$sid");
$sql = '';
if(!empty($_POST) && $gm_post_canshu !=13){
$text = $_POST['text'];
$cond = $_POST['cond'];
$position = $_POST['position'];
$link_value = $_POST['link_value'];
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
echo "文本值：".$text."<br/>"."显示条件：".$cond."<br/>"."当前位置：".$position."<br/>"."元素类别：".$op_value;
echo "<br/>";
}
}
if (!empty($text)){
    if($op_type ==0){
    echo "新建成功!<br/>";
    $module_type = '';
    switch ($gm_post_canshu) {
        case '1':
            $module_type = 'game_scene_page';
            break;
        case '2':
            $module_type = 'game_npc_page';
            break;
        case '3':
            $module_type = 'game_pet_page';
            break;
        case '4':
            $module_type = 'game_item_page';
            break;
        case '5':
            $module_type = 'game_oplayer_page';
            break;
        case '6':
            $module_type = 'game_equip_page';
            break;
        case '7':
            $module_type = 'game_player_page';
            break;
        case '8':
            $module_type = 'game_skill_page';
            break;
        case '9':
            $module_type = 'game_function_page';
            break;
        case '10':
            $module_type = 'game_pve_page';
            break;
        case '11':
            $module_type = 'game_main_page';
            break;
        default:
            break;
    }
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
    switch ($gm_post_canshu) {
        case '1':
            $module_type = 'game_scene_page';
            break;
        case '2':
            $module_type = 'game_npc_page';
            break;
        case '3':
            $module_type = 'game_pet_page';
            break;
        case '4':
            $module_type = 'game_item_page';
            break;
        case '5':
            $module_type = 'game_oplayer_page';
            break;
        case '6':
            $module_type = 'game_equip_page';
            break;
        case '7':
            $module_type = 'game_player_page';
            break;
        case '8':
            $module_type = 'game_skill_page';
            break;
        case '9':
            $module_type = 'game_function_page';
            break;
        case '10':
            $module_type = 'game_pve_page';
            break;
        case '11':
            $module_type = 'game_main_page';
            break;
        default:
            break;
    }
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
    $query = "SELECT * FROM system_event_self WHERE `belong` = :belong and module_id = '$gm_post_canshu'";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':belong', $ele_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $event_desc = $row['desc'];
    if($event_desc !=$text){
    $sql = "UPDATE system_event_self SET `desc` = '$text' WHERE `belong` = '$ele_id' and module_id = '$gm_post_canshu';";
    $cxjg = $dblj->exec($sql);
    }
    }
}
}

$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_game_pagemoduledefine_1 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=1&sid=$sid");
$gm_game_pagemoduledefine_2 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=2&sid=$sid");
$gm_game_pagemoduledefine_3 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=3&sid=$sid");
$gm_game_pagemoduledefine_4 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=4&sid=$sid");
$gm_game_pagemoduledefine_5 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=5&sid=$sid");
$gm_game_pagemoduledefine_6 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=6&sid=$sid");
$gm_game_pagemoduledefine_7 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=7&sid=$sid");
$gm_game_pagemoduledefine_8 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=8&sid=$sid");
$gm_game_pagemoduledefine_9 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=9&sid=$sid");
$gm_game_pagemoduledefine_10 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=10&sid=$sid");
$gm_game_pagemoduledefine_11 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=11&sid=$sid");
$gm_game_pagemoduledefine_12 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=12&sid=$sid");
$gm_game_pagemoduledefine_13 = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=13&sid=$sid");
$gm_game_pagemoduledefine_change_function_name = $encode->encode("cmd=gm_function_change&sid=$sid");

if($gm_post_canshu == 0){
$gm_html = <<<HTML
<p>[页面模板定义]</p>
<a href="?cmd=$gm_game_pagemoduledefine_1">定义查看场景页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_2">定义查看电脑人物页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_3">定义查看宠物页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_4">定义查看物品页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_5">定义查看玩家页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_6">定义查看我的装备模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_7">定义查看自己状态页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_8">定义查看技能页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_9">定义功能页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_10">定义战斗页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_11">定义首页页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_13">自定义页面模板</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine_change_function_name">修改功能点名称(好像不是很有必要)</a><br/><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
}elseif ($gm_post_canshu == 1) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_1_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=1&main_type=1&sid=$sid");
$game_page_1_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=1&main_type=2&sid=$sid");
$game_page_1_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=1&main_type=3&sid=$sid");
$game_page_1_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=1&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_scene_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_scene_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
    $order = array("\r\n", "\n", "\r");
    $replace = "↓<br/>";
    $main_value=str_replace($order, $replace, $main_value);
    $game_main .=<<<HTML
    <a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
}
$all = <<<HTML
<p>定义查看场景页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_1_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_1_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_1_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_1_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 2) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_2_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=2&main_type=1&sid=$sid");
$game_page_2_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=2&main_type=2&sid=$sid");
$game_page_2_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=2&main_type=3&sid=$sid");
$game_page_2_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=2&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_npc_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_npc_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
    $order = array("\r\n", "\n", "\r");
    $replace = "↓<br/>";
    $main_value=str_replace($order, $replace, $main_value);
    $game_main .=<<<HTML
<a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
}
$all = <<<HTML
<p>定义查看电脑人物页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_2_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_2_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_2_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_2_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 3) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_3_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=3&main_type=1&sid=$sid");
$game_page_3_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=3&main_type=2&sid=$sid");
$game_page_3_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=3&main_type=3&sid=$sid");
$game_page_3_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=3&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_pet_page($dblj);
$hangshu =0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_pet_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&sid=$sid");
    $order = array("\r\n", "\n", "\r");
    $replace = "↓<br/>";
    $main_value=str_replace($order, $replace, $main_value);
    $game_main .=<<<HTML
    <a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
}
$all = <<<HTML
<p>定义查看宠物页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_3_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_3_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_3_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_3_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 4) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_4_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=4&main_type=1&sid=$sid");
$game_page_4_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=4&main_type=2&sid=$sid");
$game_page_4_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=4&main_type=3&sid=$sid");
$game_page_4_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=4&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_item_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_item_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
    $order = array("\r\n", "\n", "\r");
    $replace = "↓<br/>";
    $main_value=str_replace($order, $replace, $main_value);
    $game_main .=<<<HTML
    <a href="?cmd=$attr_url" >$hangshu.$main_value</a>
HTML;
}
$all = <<<HTML
<p>定义查看物品页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_4_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_4_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_4_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_4_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 5) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_5_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=5&main_type=1&sid=$sid");
$game_page_5_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=5&main_type=2&sid=$sid");
$game_page_5_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=5&main_type=3&sid=$sid");
$game_page_5_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=5&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_oplayer_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_oplayer_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
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
$all = <<<HTML
<p>定义查看玩家页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_5_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_5_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_5_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_5_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 6) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_6_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=6&main_type=1&sid=$sid");
$game_page_6_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=6&main_type=2&sid=$sid");
$game_page_6_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=6&main_type=3&sid=$sid");
$game_page_6_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=6&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_equip_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_equip_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
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
$all = <<<HTML
<p>定义查我的装备模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_6_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_6_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_6_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_6_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 7) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_7_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=7&main_type=1&sid=$sid");
$game_page_7_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=7&main_type=2&sid=$sid");
$game_page_7_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=7&main_type=3&sid=$sid");
$game_page_7_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=7&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_player_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_player_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
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
$all = <<<HTML
<p>定义查看自己状态页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_7_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_7_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_7_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_7_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 8) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_8_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=8&main_type=1&sid=$sid");
$game_page_8_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=8&main_type=2&sid=$sid");
$game_page_8_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=8&main_type=3&sid=$sid");
$game_page_8_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=8&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_skill_page($dblj);
$hangshu = 0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_skill_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&target_func=$main_target_func&sid=$sid");
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
$all = <<<HTML
<p>定义查看技能页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_8_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_8_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_8_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_8_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 9) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_9_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=9&main_type=1&sid=$sid");
$game_page_9_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=9&main_type=2&sid=$sid");
$game_page_9_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=9&main_type=3&sid=$sid");
$game_page_9_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=9&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_function_page($dblj);
$hangshu =0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_function_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&sid=$sid");
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
$all = <<<HTML
<p>定义功能页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_9_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_9_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_9_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_9_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 10) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_10_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=10&main_type=1&sid=$sid");
$game_page_10_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=10&main_type=2&sid=$sid");
$game_page_10_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=10&main_type=3&sid=$sid");
$game_page_10_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=10&main_type=4&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_pve_page($dblj);
$hangshu =0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_pve_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&sid=$sid");
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
$all = <<<HTML
<p>定义战斗页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_10_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_10_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_10_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_10_4">添加链接元素</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 11) {
$encode = new \encode\encode();
$player = new \player\player();
$game_main = new \gm\gm();
$game_page_11_1 = $encode->encode("cmd=game_page_2&gm_post_canshu=11&main_type=1&sid=$sid");
$game_page_11_2 = $encode->encode("cmd=game_page_2&gm_post_canshu=11&main_type=2&sid=$sid");
$game_page_11_3 = $encode->encode("cmd=game_page_2&gm_post_canshu=11&main_type=3&sid=$sid");
$game_page_11_4 = $encode->encode("cmd=game_page_2&gm_post_canshu=11&main_type=4&sid=$sid");
$game_page_11_5 = $encode->encode("cmd=game_page_2&gm_post_canshu=11&main_type=5&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_main_page($dblj);
$hangshu =0;
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $main_id = $get_main_page[$i]['id'];
    $main_position = $get_main_page[$i]['position'];
        if($main_position !=$hangshu){
        $sql = "UPDATE game_main_page SET position = '$hangshu' where id = $main_id;";
        $cxjg =$dblj->exec($sql);
    }
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_text = $get_main_page[$i]['target_text'];
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $attr_url = $encode->encode("cmd=game_page_2&main_id=$main_id&gm_post_canshu=$gm_post_canshu&main_type=$main_type&sid=$sid");
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
$all = <<<HTML
<p>定义首页页面模板<br/>
============<br/>
$game_main<br/>
============<br/>
<a href="?cmd=$game_page_11_1">添加文本元素</a><br/>
<a href="?cmd=$game_page_11_2">添加操作元素</a><br/>
<a href="?cmd=$game_page_11_3">添加功能元素</a><br/>
<a href="?cmd=$game_page_11_4">添加链接元素</a><br/>
<a href="?cmd=$game_page_11_5">添加输入框元素(敬请期待)</a><br/><br/>
HTML;
}elseif ($gm_post_canshu == 13) {
$add_self_module = $encode->encode("cmd=game_self_page_add&sid=$sid");
if(empty($_POST['kw'])){
$get_main_page = \gm\get_self_page_list($dblj);
}elseif (isset($_POST['kw'])) {
$keyword = $_POST['kw'];
// 构建查询语句，使用过滤条件
$sql = "SELECT * FROM `system_self_define_module` where id LIKE :keyword OR name LIKE :keyword_2 ORDER BY pos ASC;";
$stmt = $dblj->prepare($sql);
$keyword = "%$keyword%";
$stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$stmt->bindParam(':keyword_2', $keyword, PDO::PARAM_STR);
$stmt->execute();
// 显示过滤后的数据
$get_main_page = $stmt->fetchAll(PDO::FETCH_ASSOC);
}    
$game_main = '';
for ($i=0;$i<count($get_main_page);$i++){
    $hangshu +=1;
    $self_id = $get_main_page[$i]['id'];
    $self_name = $get_main_page[$i]['name'];
    $main_position = $get_main_page[$i]['pos'];
    if($main_position !=$hangshu){
        $sql = "UPDATE system_self_define_module SET pos = '$hangshu' where id = $self_id;";
        $cxjg =$dblj->exec($sql);
    }
    $module_url = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
    $delete_url = $encode->encode("cmd=game_self_page&delete_sure_id=1&self_id=$self_id&sid=$sid");
    $self_module_page .=<<<HTML
    <a href="?cmd=$module_url" >$hangshu.ct_{$self_id}[{$self_name}]</a><a href="?cmd=$delete_url">删除</a><br/>
HTML;
}

$all = <<<HTML
<p>[自定义页面模板]</p>
<p>当前自定义模板有：<br/>
$self_module_page
<a href="?cmd=$add_self_module">增加模板</a><br/>
</p>
<form method="post">
快速搜索(不带ct_)：<br/>
<input name="kw" type="text"/><br/>
<input name="gm_post_canshu" type="hidden" value="13"/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
HTML;

}
if($gm_post_canshu !=0){
$gm_html_2 =<<<HTML
$all
<a href="?cmd=$last_page">返回上一级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html_2;
}
?>