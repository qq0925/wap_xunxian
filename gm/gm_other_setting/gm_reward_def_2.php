<?php

if(!$op_canshu){
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&reward_def=$reward_change&canshu=5&sid=$sid");
$other_set = $encode->encode("cmd=gm_game_othersetting&canshu=5&reward_change=$reward_change&sid=$sid");
$all_page = $encode->encode("cmd=gm_game_othersetting&canshu=5&sid=$sid");
$edit_cons = $encode->encode("cmd=gm_game_othersetting&op_canshu=1&post_canshu=-1&reward_change=$reward_change&canshu=5&sid=$sid");
$edit_gift = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&reward_change=$reward_change&canshu=5&sid=$sid");
if(!empty($_POST)&&$_POST['submit']!="增加奖品"){
echo "修改成功！<br/>";
if($cons_id){
$cons_para = $cons_id."|".$cons_count;

// 准备 UPDATE 语句
$sql = "UPDATE system_draw SET name = :reward_name, cons_count = :cons_para, cons_open_time = :open_time, cons_close_time = :close_time, cons_type = :cons_type where id = :reward_change";

// 使用 prepare 方法预处理 SQL 语句
$stmt = $dblj->prepare($sql);

// 绑定参数
$stmt->bindParam(':reward_name', $reward_name);
$stmt->bindParam(':cons_para', $cons_para);
$stmt->bindParam(':open_time', $open_time);
$stmt->bindParam(':close_time', $close_time);
$stmt->bindParam(':cons_type', $cons_type);
$stmt->bindParam(':reward_change', $reward_change);
// 执行语句
$stmt->execute();
}else{

// 准备 UPDATE 语句
$sql = "UPDATE system_draw SET name = :reward_name, cons_open_time = :open_time, cons_close_time = :close_time, cons_type = :cons_type where id = :reward_change";

// 使用 prepare 方法预处理 SQL 语句
$stmt = $dblj->prepare($sql);

// 绑定参数
$stmt->bindParam(':reward_name', $reward_name);
$stmt->bindParam(':open_time', $open_time);
$stmt->bindParam(':close_time', $close_time);
$stmt->bindParam(':cons_type', $cons_type);
$stmt->bindParam(':reward_change', $reward_change);
// 执行语句
$stmt->execute();
    
    
}

}
if($cons_item_id){
// 从数据库中获取原始的 cons_count 值
$sql_select = "SELECT cons_count FROM system_draw WHERE id = :record_id";
$stmt_select = $dblj->prepare($sql_select);
$stmt_select->bindParam(':record_id', $reward_change);
$stmt_select->execute();
$original_cons_count = $stmt_select->fetchColumn();

// 使用 explode 函数拆分原始值
$cons_count_parts = explode('|', $original_cons_count);

// 将新的物品id替换掉旧的物品id
$cons_count_parts[0] = $cons_item_id;

// 使用 implode 函数将数组合并为新的 cons_count 值
$new_cons_count = implode('|', $cons_count_parts);

// 构建 SQL 语句，使用占位符来防止 SQL 注入
$sql_update = "UPDATE system_draw SET cons_count = :new_cons_count,cons_type = 2 WHERE id = :record_id";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':new_cons_count', $new_cons_count);
$stmt_update->bindParam(':record_id', $reward_change);
$stmt_update->execute();
}

$sql = "select * from system_draw where id = '$reward_change'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$reward_id = $ret['id'];
$reward_name = $ret['name'];
$reward_cons_type = $ret['cons_type'];
$reward_cons = $ret['cons_count'];
$reward_gift = $ret['draw_reward'];
$reward_cons_open_time = $ret['cons_open_time'];
$reward_cons_close_time = $ret['cons_close_time'];
$reward_gift_para = explode(",",$reward_gift);
for($i=0;$i<@count($reward_gift_para);$i++){
    $reward_gift_detail = $reward_gift_para[$i];
    $reward_gift_detail_para = explode("|",$reward_gift_detail);
    $reward_gift_id = $reward_gift_detail_para[0];
    $reward_gift_count = $reward_gift_detail_para[1];
    $reward_gift_probability = $reward_gift_detail_para[2];
    $reward_gift_name = \player\getitem($reward_gift_id,$dblj)->iname;
    $reward_gift_name = \lexical_analysis\color_string($reward_gift_name);
    if($reward_gift_id){
    $reward_gift_html .="{$reward_gift_name}x{$reward_gift_count}({$reward_gift_probability}%),";
}else{
    $reward_gift_html = "无";
}
}


$reward_gift_html = rtrim($reward_gift_html,",");
$reward_cons_para = explode("|",$reward_cons);
$reward_cons_id = $reward_cons_para[0];
$reward_cons_count = $reward_cons_para[1];


$reward_cons_type_detail_html_1 ="<select name = 'cons_id' id='cons_id'>";
$reward_cons_type_detail_sql = "select * from system_money_type";
$cxjg = $dblj->query($reward_cons_type_detail_sql);
$cx_data = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
if($cx_data){
     foreach ($cx_data as $option) {
         if($reward_cons_id ==$option['rid']){
        $reward_cons_type_detail_html_1 .= "<option value='{$option['rid']}' selected>{$option['rname']}</option>";
         }else{
        $reward_cons_type_detail_html_1 .= "<option value='{$option['rid']}'>{$option['rname']}</option>";
         }
    }
}
$reward_cons_type_detail_html_1 .="</select>";
$reward_cons_type_detail_html_2 ="<select name = 'cons_id' id='cons_id'>";
$reward_cons_type_detail_sql_2 = "select * from gm_game_attr where value_type = '1' and if_item_use_attr = '1'";
$cxjg_2 = $dblj->query($reward_cons_type_detail_sql_2);
$cx_data_2 = $cxjg_2->fetchAll(\PDO::FETCH_ASSOC);

if($cx_data_2){
     foreach ($cx_data_2 as $option_2) {
         if($reward_cons_id ==$option_2['id']){
        $reward_cons_type_detail_html_2 .= "<option value='{$option_2['id']}' selected>{$option_2['name']}</option>";
         }else{
        $reward_cons_type_detail_html_2 .= "<option value='{$option_2['id']}'>{$option_2['name']}</option>";
         }
    }
}
$reward_cons_type_detail_html_2 .="</select>";


$reward_cons_type_html = "<select name='cons_type' id = 'cons_type'>";
if ($reward_cons_type == 1) {
        $reward_cons_type_html .= <<<HTML
<option value="1" selected>金钱</option>
<option value="2">物品</option>
<option value="3">属性</option>
HTML;
    } elseif ($reward_cons_type == 2) {
        
        $reward_cons_name = \player\getitem($reward_cons_id,$dblj)->iname;
        //$reward_cons_name = \lexical_analysis\color_string($reward_cons_name);
        $reward_cons_type_html .= <<<HTML
<option value="1">金钱</option>
<option value="2" selected>物品</option>
<option value="3">属性</option>
HTML;
    } else {
        $reward_cons_type_html .= <<<HTML
<option value="1">金钱</option>
<option value="2">物品</option>
<option value="3" selected>属性</option>
HTML;
    }
$reward_cons_type_html .= "</select>";

$other_html = <<<HTML
<link rel="stylesheet" href="/css/flatpickr.min.css">
<script src="/js/flatpickr.js"></script>
[抽奖设置]<br/>
<form action="?cmd=$other_set" method="POST">
抽奖项目名称：<input type="text" name="reward_name" value="{$reward_name}"><br/>
消耗类别：{$reward_cons_type_html}<br/>
消耗具体信息：<span name='cons_id_root' id='cons_id_root'></span><br/>
消耗数量（多少/次）：<input type="tel" name="cons_count" value="{$reward_cons_count}"><br/>
奖品信息：{$reward_gift_html}<a href="?cmd=$edit_gift">编辑</a><br/>
开放时间：<input type="text" id="openTime" name="open_time" value="{$reward_cons_open_time}"><br/>
关闭时间：<input type="text" id="closeTime" name="close_time" value="{$reward_cons_close_time}"><br/>
<input type="submit" value="保存">

</form>
<br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$all_page">抽奖列表</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>

<script>
    flatpickr("#openTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    flatpickr("#closeTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    // 等待文档加载完成后执行
    document.addEventListener('DOMContentLoaded', function (){
    
    // 获取选择框和结果容器
        var mySelect = document.getElementById('cons_type');
        var linkContainer = document.getElementById('cons_id_root');
        // 获取选择框的初始值
        var initialSelectedValue = mySelect.value;

        switch (initialSelectedValue) {
            case '1':
                // 生成第一个选择框
                // 添加选项...
                linkContainer.innerHTML = "$reward_cons_type_detail_html_1";
                break;
            case '2':
                // 生成链接变量
                linkContainer.textContent = "$reward_cons_name";
                var linkElement = document.createElement('a');
                linkElement.href = "?cmd=$edit_cons"; // 替换为实际的链接地址
                linkElement.textContent = '编辑'; // 替换为实际的链接文本
                linkContainer.appendChild(linkElement);
                break;
            case '3':
                // 生成第二个选择框
                // 添加选项...
                linkContainer.innerHTML = "$reward_cons_type_detail_html_2";
                break;
            default:
                linkUrl = '#';
        }
    
    
    // 获取选择框和链接容器
    var linkTypeSelect = document.getElementById('cons_type');
    var linkContainer = document.getElementById('cons_id_root');

    // 监听选择框的变化事件
    linkTypeSelect.addEventListener('change', function () {
        // 获取选择框的当前值
        var selectedValue = linkTypeSelect.value;
    // 清空链接容器
        linkContainer.innerHTML = '';
        // 根据选择的值生成相应的链接
        var linkUrl;
        switch (selectedValue) {
            case '1':
                // 生成第一个选择框
                linkContainer.innerHTML = "$reward_cons_type_detail_html_1";
                break;
            case '2':
                // 生成链接变量
                linkContainer.textContent = "$reward_cons_name";
                var linkUrl = "?cmd=$edit_cons"; // 替换为实际的 PHP 变量
                var linkElement = document.createElement('a');
                linkElement.href = linkUrl;
                linkElement.textContent = '编辑'; // 这里可以根据需要修改链接的文本
                linkContainer.appendChild(linkElement);
                break;
            case '3':
                // 生成第二个选择框
                linkContainer.innerHTML = "$reward_cons_type_detail_html_2";
                break;
            default:
                linkUrl = '#';
        }
    });
    });
</script>


HTML;
echo $other_html;
}elseif($op_canshu ==1){
    

if($post_canshu == -1){
    $add_item_type = array(); // 创建一个空的关联数组
    for($i=0;$i<8;$i++){
        $add_item_type[$i] = $encode->encode("cmd=gm_game_othersetting&op_canshu=1&post_canshu=$i&reward_change=$reward_change&canshu=5&sid=$sid");
    }
$item_html = <<<HTML
[定义抽奖的消耗物品]<br/>
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
    $cxallmap = \gm\get_item_list($dblj,$item_type);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $iname = $cxallmap[$i]['iname'];
    $iid = $cxallmap[$i]['iid'];
    $br++;
    $target_iid = $encode->encode("cmd=gm_game_othersetting&cons_item_id=$iid&post_canshu=$post_canshu&reward_change=$reward_change&canshu=5&sid=$sid");
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

echo $item_html;
    
}elseif($op_canshu ==2){
$last_page = $encode->encode("cmd=gm_game_othersetting&reward_change=$reward_change&canshu=5&sid=$sid");

if($remove_para){
    echo "移除成功！<br/>";
// 构建 SQL 语句，使用占位符来防止 SQL 注入
$sql_select = "SELECT draw_reward FROM system_draw WHERE id = :record_id";
$stmt_select = $dblj->prepare($sql_select);
$stmt_select->bindParam(':record_id', $reward_change);
$stmt_select->execute();
$original_values = $stmt_select->fetchColumn();

// 使用 explode 函数拆分原始值
$array_values = explode(',', $original_values);

// 在数组中查找并移除值 $valueToRemove
$keyToRemove = array_search($remove_para, $array_values);
if ($keyToRemove !== false) {
    unset($array_values[$keyToRemove]);
}

// 将数组合并为新的值
$new_values = implode(',', $array_values);

// 更新数据库中的记录
$sql_update = "UPDATE system_draw SET draw_reward = :new_values WHERE id = :record_id";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':new_values', $new_values);
$stmt_update->bindParam(':record_id', $reward_change);
$stmt_update->execute();
    
}
if($_POST['submit'] == "增加奖品"){
    echo "新增成功！<br/>";
    $add_para = $add_this_id."|".$add_this_count."|".$add_this_probability;
    
// 从数据库中获取原始的 draw_reward 值
$sql_select = "SELECT draw_reward FROM system_draw WHERE id = :record_id";
$stmt_select = $dblj->prepare($sql_select);
$stmt_select->bindParam(':record_id', $reward_change);
$stmt_select->execute();
$original_draw_reward = $stmt_select->fetchColumn();
$original_draw_reward .= ",".$add_para;
$original_draw_reward = ltrim($original_draw_reward,",");
// 构建 SQL 语句，使用占位符来防止 SQL 注入
$sql_update = "UPDATE system_draw SET draw_reward = :original_draw_reward WHERE id = :record_id";
$stmt_update = $dblj->prepare($sql_update);
$stmt_update->bindParam(':original_draw_reward', $original_draw_reward);
$stmt_update->bindParam(':record_id', $reward_change);
$stmt_update->execute();
    
}

$sql = "select * from system_draw where id = '$reward_change'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$reward_name = $ret['name'];

$reward_gift = $ret['draw_reward'];

$reward_gift_para = explode(",",$reward_gift);
for($i=0;$i<@count($reward_gift_para);$i++){
    $reward_gift_detail = $reward_gift_para[$i];
    $item_remove = $encode->encode("cmd=gm_game_othersetting&remove_para=$reward_gift_detail&op_canshu=2&reward_change=$reward_change&canshu=5&sid=$sid");
    $reward_gift_detail_para = explode("|",$reward_gift_detail);
    $reward_gift_id = $reward_gift_detail_para[0];
    $reward_gift_count = $reward_gift_detail_para[1];
    $reward_gift_probability = $reward_gift_detail_para[2];
    $reward_gift_name = \player\getitem($reward_gift_id,$dblj)->iname;
    $reward_gift_name = \lexical_analysis\color_string($reward_gift_name);
    if($reward_gift_id){
    $reward_gift_html .="{$reward_gift_name}($reward_gift_count)[概率：{$reward_gift_probability}%]<a href='?cmd=$item_remove'>移除</a><br/>";
}else{
    $reward_gift_html = "无<br/>";
}
}


$reward_gift_html = rtrim($reward_gift_html,",");
$add_item = $encode->encode("cmd=gm_game_othersetting&post_canshu=-1&edit_canshu=additem&op_canshu=2&reward_change=$reward_change&canshu=5&sid=$sid");
$item_html = <<<HTML
<p>定义抽奖[{$reward_name}]的奖品<br/>
$reward_gift_html
<a href="?cmd=$add_item">添加物品</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
</p>
HTML;
if($edit_canshu == 'additem'){
if($post_canshu == -1){
    $add_item_type = array(); // 创建一个空的关联数组
    for($i=0;$i<8;$i++){
        $add_item_type[$i] = $encode->encode("cmd=gm_game_othersetting&edit_canshu=additem&op_canshu=2&post_canshu=$i&reward_change=$reward_change&canshu=5&sid=$sid");
    }
$item_html = <<<HTML
[定义抽奖的奖品]<br/>
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
    $cxallmap = \gm\get_item_list($dblj,$item_type);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $iname = $cxallmap[$i]['iname'];
    $iid = $cxallmap[$i]['iid'];
    $br++;
    $target_iid = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&edit_canshu=additem_edit&reward_item_id=$iid&post_canshu=$post_canshu&reward_change=$reward_change&canshu=5&sid=$sid");
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

if($edit_canshu == 'additem_edit'){
$item_para = player\getitem($reward_item_id,$dblj);
$item_name = $item_para ->iname;
$last_page = $encode->encode("cmd=gm_game_othersetting&edit_canshu=additem&post_canshu=$post_canshu&op_canshu=2&canshu=$canshu&reward_change=$reward_change&&sid=$sid");
$item_add = $encode->encode("cmd=gm_game_othersetting&op_canshu=2&reward_change=$reward_change&canshu=$canshu&sid=$sid");
$item_html = <<<HTML
<p>新增奖品“{$item_name}”<br/>
<form action="?cmd=$item_add" method="post">
<input name="add_this_id" type="hidden" title="确定" value="{$reward_item_id}">
数量:<input name="add_this_count" type="text" value="1"><br/>
概率(%):<input name="add_this_probability" type="text" value="10"><br/>
<input name="submit" type="submit" title="确定" value="增加奖品"/></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
</p>
HTML;
}

echo $item_html;

}
?>
