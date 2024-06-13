[属性定义]<br/>
<?php
$player = \player\getplayer($sid,$dblj);
$_SERVER['PHP_SELF'];
$gm = $encode->encode("cmd=gm&sid=$sid");
//$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=$gm_post_canshu&gm_post_canshu_2=$gm_post_canshu_2&sid=$sid");
$gm_game_attrdefine_1 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=1&sid=$sid");
$gm_game_attrdefine_3 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=3&sid=$sid");
$gm_game_attrdefine_4 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=4&sid=$sid");
$gm_game_attrdefine_5 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=5&sid=$sid");
$gm_game_attrdefine_6 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=6&sid=$sid");
$gm_game_attrdefine_7 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=7&sid=$sid");
$hangshu = 0;
//$gm_post_canshu =$gm_post_tishi;
if($gm_post_canshu >0&&$gm_post_canshu <7){
    if($now_pos !=0 && $next_pos !=0){
        $sql = "update gm_game_attr set pos = 19980925 where pos = '$now_pos'";
        $dblj->exec($sql);
        $sql = "update gm_game_attr set pos = '$now_pos' where pos = '$next_pos'";
        $dblj->exec($sql);
        $sql = "update gm_game_attr set pos = '$next_pos' where pos = 19980925";
        $dblj->exec($sql);
    }
    
    
$sql = "select * from gm_game_attr where value_type = '$gm_post_canshu' ORDER BY pos ASC";
//var_dump($sql);
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}
$attr_html = '';
//$hangshu = 0;
for ($i=0;$i<count($gm_ret);$i++){
    //var_dump($gm_retdj);
    $gm_djname = $gm_ret[$i]['name'];
   // var_dump($gm_djname);
    $gm_djid = $gm_ret[$i]['id'];
    $gm_djpos = $gm_ret[$i]['pos'];
    $gm_djvalue_type = $gm_ret[$i]['value_type'];
    $gm_djattr_type = $gm_ret[$i]['attr_type'];
    $gm_djdefault_value = $gm_ret[$i]['default_value'];
    $gm_djshow = $gm_ret[$i]['if_show'];
    $gm_if_basic = $gm_ret[$i]['if_basic'];
    $hangshu += 1;
    $gm_game_attrdefine_8 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=7&gm_post_canshu_2=$hangshu&gm_post_type=$gm_djattr_type&gm_post_type_2=$gm_djvalue_type&sid=$sid");
    if($hangshu ==1 && count($gm_ret)>1){
    $next_pos = $gm_ret[1]['pos'];
    $move_next = $encode->encode("cmd=gm_game_attrdefine&value_type=$gm_djvalue_type&now_pos=$gm_djpos&next_pos=$next_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $attr_html .=<<<HTML
    <a href="?cmd=$gm_game_attrdefine_8">{$gm_djname}[{$gm_djid}]</a>[ <font color ="red">上移</font> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}elseif ($hangshu ==count($gm_ret) && count($gm_ret)>1) {
    $next_pos = $gm_ret[$hangshu -2]['pos'];
    $move_last = $encode->encode("cmd=gm_game_attrdefine&value_type=$gm_djvalue_type&now_pos=$gm_djpos&next_pos=$next_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $attr_html .=<<<HTML
    <a href="?cmd=$gm_game_attrdefine_8">{$gm_djname}[{$gm_djid}]</a>[ <a href="?cmd=$move_last">上移</a> <font color ="red">下移</font> ]<br/>
HTML;
}elseif($hangshu !=1 && $hangshu !=count($gm_ret) && count($gm_ret)>1){
    $last_pos = $gm_ret[$hangshu -2]['pos'];
    $next_pos = $gm_ret[$hangshu]['pos'];
    $move_last = $encode->encode("cmd=gm_game_attrdefine&value_type=$gm_djvalue_type&now_pos=$gm_djpos&next_pos=$last_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $move_next = $encode->encode("cmd=gm_game_attrdefine&value_type=$gm_djvalue_type&now_pos=$gm_djpos&next_pos=$next_pos&gm_post_canshu=$gm_post_canshu&sid=$sid");
    $attr_html .=<<<HTML
    <a href="?cmd=$gm_game_attrdefine_8">{$gm_djname}[{$gm_djid}]</a>[ <a href="?cmd=$move_last">上移</a> <a href="?cmd=$move_next">下移</a> ]<br/>
HTML;
}else{
    $attr_html .=<<<HTML
    <a href="?cmd=$gm_game_attrdefine_8">{$gm_djname}[{$gm_djid}]</a>[ <font color ="red">上移 下移</font> ]<br/>
HTML;
}
}
}
switch ($gm_post_canshu) {
case '0':
    $gm_html = <<<HTML
<a href="?cmd=$gm_game_attrdefine_1">定义玩家属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_3">定义电脑人物属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_4">定义物品属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_5">定义场景属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_6">定义技能属性</a><br/>
---<br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;

case '1':
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=8&gm_post_type_2=1&gm_post_canshu_2=$gm_post_canshu&sid=$sid");
$gm_game_attrdefine_2 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&sid=$sid");
$gm_html = <<<HTML
[当前定义的玩家属性]<br/>
$attr_html
---<br/>
<a href="?cmd=$gm_game_attrdefine">增加属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_2">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
case '3':
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=8&gm_post_type_2=3&gm_post_canshu_2=$gm_post_canshu&sid=$sid");
$gm_game_attrdefine_2 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&sid=$sid");
$gm_html = <<<HTML
[当前定义的电脑人物属性]<br/>
$attr_html
---<br/>
<a href="?cmd=$gm_game_attrdefine">增加属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_2">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
case '4':
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=8&gm_post_type_2=4&gm_post_canshu_2=$gm_post_canshu&sid=$sid");
$gm_game_attrdefine_2 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&sid=$sid");
$gm_html = <<<HTML
[当前定义的物品属性]<br/>
$attr_html
---<br/>
<a href="?cmd=$gm_game_attrdefine">增加属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_2">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
case '5':
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=8&gm_post_type_2=5&gm_post_canshu_2=$gm_post_canshu&sid=$sid");
$gm_game_attrdefine_2 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&sid=$sid");
$gm_html = <<<HTML
[当前定义的场景属性]<br/>
$attr_html
---<br/>
<a href="?cmd=$gm_game_attrdefine">增加属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_2">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
case '6':
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=8&gm_post_type_2=6&gm_post_canshu_2=$gm_post_canshu&sid=$sid");
$gm_game_attrdefine_2 = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&sid=$sid");
$gm_html = <<<HTML
[当前定义的技能显示属性]<br/>
$attr_html
---<br/>
<a href="?cmd=$gm_game_attrdefine">增加属性</a><br/>
<a href="?cmd=$gm_game_attrdefine_2">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
case '7':
    $gm_post_canshu_2 -= 1;
    $sql = "select * from gm_game_attr where value_type = '$gm_post_type_2' limit $gm_post_canshu_2,1";
    $gm_post_canshu_2 += 1;
    $gm_cx = $dblj->query($sql);
    $gm_ret = $gm_cx->fetchAll(PDO::FETCH_ASSOC);
    $gm_game_attr_id = $gm_ret[0]['id'];
    $gm_game_attr_type = '';
    switch ($gm_ret[0]['attr_type']) {
        case '0':
            $gm_game_attr_type = '数值型';
            break;
        case '1':
            $gm_game_attr_type = '字符串型';
        break;
        case '2':
            $gm_game_attr_type = '逻辑值型';
        break;
}

    
    $gm_game_attr_name = $gm_ret[0]['name'];
    $gm_game_default_value = $gm_ret[0]['default_value'];
    $gm_game_show = $gm_ret[0]['if_show'];
    $gm_if_basic = $gm_ret[0]['if_basic'];
    if($gm_game_show=="0"){
        $gm_select_1 = "selected";
    }else {
        $gm_select_2 = "selected";
    }
    if($gm_post_canshu_3!=0){
$post_tishi = '修改成功';
}
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=$gm_post_type_2&sid=$sid");
if($gm_if_basic ==1){
    $gm_if_basic_html = <<<HTML
    <font color = "red">【系统关键属性】</font><br/>
HTML;
}
$gm_delete_attr = $encode->encode("cmd=gm_delete_attr&gm_game_attr_id=$gm_game_attr_id&gm_if_basic=$gm_if_basic&gm_post_canshu=$gm_post_type_2&sid=$sid");
$gm_post_change = $encode->encode("cmd=gm_post_2&gm_post_canshu=$gm_post_canshu&gm_post_canshu_2=$gm_post_canshu_2&gm_post_canshu_3=1&gm_post_type_2=$gm_post_type_2&sid=$sid");
$gm_html = <<<HTML
修改属性<br/>
$post_tishi<br/>
<form action="?cmd=$gm_post_change" method="post">
<input type="hidden" name="sid" value="$sid">
$gm_if_basic_html
<input name="gm_id" type="hidden" value="$gm_game_attr_id">属性标识:$gm_game_attr_id<br/>
<input name="gm_attr_type" type="hidden" value="$gm_game_attr_type">类型:$gm_game_attr_type<br/>
属性名称:<input name="gm_name" type="text" value="$gm_game_attr_name" maxlength="50"><br/>
初始值:<input name="gm_default_value" type="text" maxlength="200" value = "$gm_game_default_value"><br/>
是否显示:<select name="gm_attr_hidden" value="$gm_game_show">
<option value="0" $gm_select_1>隐藏</option>
<option value="1" $gm_select_2>显示</option>
</select><br/>
<input type="submit" value="确定"></form><br/>
<a href="?cmd=$gm_delete_attr">删除属性</a><br/>
<a href="?cmd=$gm_game_attrdefine">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
case '8':
    switch($gm_post_type_2){
        case '1':
            $page_name = '玩家属性';
            break;
        case '2':
            $page_name = '查看玩家显示属性';
            break;
        case '3':
            $page_name = '电脑人物属性';
            break;
        case '4':
            $page_name = '物品属性';
            break;
        case '5':
            $page_name = '场景属性';
            break;
        case '6':
            $page_name = '技能属性';
            break;
    }
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=$gm_post_type_2&sid=$sid");
$gm_post_add = $encode->encode("cmd=gm_post_2&gm_post_canshu=8&gm_post_canshu_2=$gm_post_type_2&gm_post_type_2=$gm_post_type_2&sid=$sid");
$gm_html = <<<HTML
增加$page_name</p><br/>
<form action="?cmd=$gm_post_add" method="post">
<input type="hidden" name="sid" value="$sid">
属性标识:<input name="gm_id" type="text" value=""><br/>
属性名称:<input name="gm_name" type="text" value="" maxlength="50"><br/>
值类型:<select name="gm_attr_type" value="">
<option value="0" "selected">数值</option>
<option value="1" >字符串</option>
<option value="2" >逻辑值</option>
</select><br/>
初始值:<input name="gm_default_value" type="text" maxlength="200" value = ""><br/>
是否显示:<select name="gm_attr_hidden" value="1">
<option value="0" >隐藏</option>
<option value="1" "selected">显示</option>
</select><br/>
<input type="submit" value="确定"></form><br/>
<a href="?cmd=$gm_game_attrdefine">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
break;
}
?>