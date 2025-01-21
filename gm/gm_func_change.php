<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");


if(!$change_canshu){
$last_page = $encode->encode("cmd=gm_game_pagemoduledefine&sid=$sid");

if($_POST['change_id']){
    
    if($new_name){
        echo "修改成功！<br/>";
        $dblj->exec("update system_function set name = '$new_name' where id = '$change_id'");
    }else{
        echo "请不要输入空字符！<br/>";
    }
    
}

if($reboot_default == 1){
        echo "已将功能点名称恢复成默认值！<br/>";
        $dblj->exec("update system_function set name = default_value");
}

if(!$kw){
    $sql="select id,name from system_function";
}else{
    $sql="select id,name from system_function where name like '%$kw%'";
}
    $cxjg = $dblj->query($sql);
    $rows = $cxjg->fetchAll(\PDO::FETCH_ASSOC);

for($i=1;$i<count($rows)+1;$i++){
    $func_id = $rows[$i-1]['id'];
    $func_name = $rows[$i-1]['name'];
    $detail_url = $encode->encode("cmd=gm_function_change&change_canshu=1&change_id=$func_id&sid=$sid");
    $function_detail .=<<<HTML
    {$i}.<a href="?cmd=$detail_url">{$func_name}</a><br/>
HTML;
}
$reboot_func = $encode->encode("cmd=gm_function_change&change_canshu=2&sid=$sid");
$function_html = <<<HTML
[修改功能点名称]<br/>
$function_detail
<a href="?cmd=$reboot_func">还原所有默认功能点名称</a><br/><br/>
快速搜索:<br/>
<form method="POST">
<input name="kw" type="text" placeholder="请输入关键字" >
<input name="submit" type="submit" title="提交" value="提交" >
</form>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
HTML;
}elseif($change_canshu=='1'){
    
$sql="select * from system_function where id = '$change_id'";
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(\PDO::FETCH_ASSOC);
$func_name = $row['name'];
$func_id = $row['id'];
$func_belong = $row['belong'];
$default_value = $row['default_value'];
// 将字符串 $func_belong 转换为数组
$a_array = explode(',', $func_belong);
$belong_params = [
    '1' => '场景',
    '2' => 'NPC',
    '3' => '宠物',
    '4' => '物品',
    '5' => '玩家',
    '6' => '装备列表',
    '7' => '自己状态',
    '8' => '技能',
    '9' => '功能',
    '10' => '战斗',
    '11' => '首页',
    '14' => '装备页面',
];

// 使用 array_map 结合 $belong_params 输出对应的值
$b = array_map(function($item) use ($belong_params) {
    return isset($belong_params[$item]) ? $belong_params[$item] : null;
}, $a_array);

// 使用 implode 拼接数组值
$suit_module = implode('、', array_filter($b)); // array_filter 去掉 null 值
$last_page = $encode->encode("cmd=gm_function_change&sid=$sid");
$change_post = $encode->encode("cmd=gm_function_change&sid=$sid");
$function_html = <<<HTML
[功能点名称]:
<form action="?cmd=$change_post" method="POST">
<input name="change_id" type="hidden" value="{$change_id}">
<input name="new_name" type="text" value="{$func_name}" >
<input name="submit" type="submit" title="提交" value="提交" >
</form>
原始值：{$default_value}<br/>
适用模板：{$suit_module}<br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
HTML;

}elseif($change_canshu=='2'){
$last_page = $encode->encode("cmd=gm_function_change&sid=$sid");
$sure = $encode->encode("cmd=gm_function_change&reboot_default=1&sid=$sid");
$function_html = <<<HTML
你确定要还原所有已修改过的功能点名称吗？<br/>
<a href="?cmd=$sure">确定</a>|<a href="?cmd=$last_page">取消</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}
$function_html .="<a href='?cmd=$gm_main'>设计大厅</a><br/>";
echo $function_html;
?>