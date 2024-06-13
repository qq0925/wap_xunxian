 <?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");




if($reward_def ==0){
if($delete_id !=0){
    echo "加上删除确认，确保当前时间不在开放与关闭时间之间<br/>";
    $sql = "delete from system_draw where id ='$delete_id'";
    //$dblj->exec($sql);
}
if(isset($_POST['add_name'])){
    $add_name = $_POST['add_name'];
    $sql = "select name from system_draw where name = '$add_name'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('name',$true_name);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    if(!$ret){
    $sql = "insert into system_draw(name) values ('$add_name')";
    $dblj->exec($sql);
    }else{
        echo "名称重复！<br/>";
    }
}


$add_html = <<<HTML
<form method = "post">
ID：<input type="text" name="add_name" size="17" placeholder="请输入抽奖项目名称：">
<input name="submit" type="submit" title="添加属性" value="添加"/><br/>
</form>
HTML;
$sql = "select name,id from system_draw";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=0;$i<@count($ret);$i++){
    $hangshu = $i +1;
    $name = $ret[$i]['name'];
    $id = $ret[$i]['id'];
    $delete = $encode->encode("cmd=gm_game_othersetting&canshu=5&delete_id=$id&sid=$sid");
    $detail = $encode->encode("cmd=gm_game_othersetting&canshu=5&reward_def=$id&sid=$sid");
    $reward_detail .=<<<HTML
    <p>{$hangshu}.<a href="?cmd=$detail">[{$name}]</a>(ID:{$id})<a href="?cmd=$delete">删除</a></p>
HTML;
}
$reward_html = <<<HTML
[抽奖管理]<br/>
$reward_detail
$add_html<br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $reward_html;
}else{
    $last_page = $encode->encode("cmd=gm_game_othersetting&canshu=5&sid=$sid");
    $sql = "select * from system_draw where id = '$reward_def'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $reward_id = $ret['id'];
    if ($ret['cons_type'] == 1) {
        $cons_type = "金钱";
    } elseif ($ret['cons_type'] == 2) {
        $cons_type = "物品";
    } else {
        $cons_type = "属性";
    }
    // 获取抽奖项目的开放和关闭时间
    $consOpenTime = strtotime($ret['cons_open_time']);
    $consCloseTime = strtotime($ret['cons_close_time']);
    
    // 获取当前时间戳
    $currentTimestamp = time();
    
    // 判断当前时间是否在抽奖项目开放时间范围内
    if ($currentTimestamp >= $consOpenTime && $currentTimestamp <= $consCloseTime) {
        $status = "开启";
    } else {
        $status = "关闭";
    }

    $cons_type_detail = explode("|",$ret['cons_count'])[0];
$reward_def_change = $encode->encode("cmd=gm_game_othersetting&canshu=5&reward_change=$reward_id&sid=$sid");
$reward_html = <<<HTML
<div style = "text-align: center;color: red">[{$ret['name']}-(ID：{$reward_id})]</div><br/><br/>
<table style="font-size:14px;border:1px solid black;width:100%;padding:12px 12px 10px;">
<tr>
<td style="border:1px solid black;text-align:center;">ID</td>
<td style="border:1px solid black;text-align:center;">消耗分类</td>
<td style="border:1px solid black;text-align:center;">消耗ID|数量</td>

<td style="border:1px solid black;text-align:center;">状态</td>
<td style="border:1px solid black;text-align:center;">操作</td>
</tr>
<tr>
<td style="text-align:center;">{$reward_id}</td>
<td style="text-align:center;">{$cons_type}</td>
<td style="text-align:center;">{$ret['cons_count']}</td>

<td style="text-align:center;">{$status}</td>
<td style="text-align:center;"><a href="?cmd=$reward_def_change">修改</a></td>
</tr>
<tr>
<td colspan="6" style="color:#ffffff;">.</td>
</tr>
<tr>
<td colspan="6" style="color:#ffffff;">.</td>
</tr>
<tr>
</tr>
</table>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $reward_html;
}


?>