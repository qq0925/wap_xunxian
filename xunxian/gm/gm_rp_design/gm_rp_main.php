<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$rp_html = "[资源点设计]<br/>";
if($rp_canshu==0){
    
if($add_rp_id){
    echo "绑定成功！<br/>";
    $dblj->exec("update system_rp set rp_item_root = '$add_rp_id' where rp_id = '$rp_id'");
}
if($delete_rp_id){
    echo "已删除{$delete_rp_name}!<br/>";
    $dblj->exec("delete from system_rp where rp_id = '$delete_rp_id'");
}
$add_rp = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=3&sid=$sid");
$rp_ret = \player\getrp_all($dblj);
for($i=1;$i<@count($rp_ret)+1;$i++){
    $rp_id = $rp_ret[$i-1]['rp_id'];
    $rp_name = $rp_ret[$i-1]['rp_name'];
    $rp_rarity = $rp_ret[$i-1]['rp_rarity'];
    $rp_desc = $rp_ret[$i-1]['rp_desc'];
    $rp_desc = $rp_desc==""?"暂无简介":$rp_desc;
    $rp_item_true = $rp_ret[$i-1]['rp_item_root'];
    $rp_item_iid = \player\getitem($rp_item_true, $dblj)->iid;
    $rp_item_iname = \player\getitem($rp_item_true, $dblj)->iname;
    $rp_item_iname = \lexical_analysis\color_string($rp_item_iname);
    $bd_item = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=4&rp_id=$rp_id&sid=$sid");
    if($rp_item_true ==0){
    $bd_item_url = "<a href='?cmd=$bd_item'>点此绑定</a>";
    }else{
    $bd_item_url = "<a href='?cmd=$bd_item'>修改绑定</a>";
    }
    $rp_item_status = $rp_item_iid == 0 ? "未绑定物品id{$bd_item_url}" : "绑定id：{$rp_item_iid}「{$rp_item_iname}」{$bd_item_url}";
    $modify = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=1&rp_id=$rp_id&sid=$sid");
    $delete = $encode->encode("cmd=gm_game_rpdesign&rp_name=$rp_name&rp_canshu=2&rp_id=$rp_id&sid=$sid");
    $rp_list .= <<<HTML
[$i].({$rp_item_status}){$rp_name}(稀有度：{$rp_rarity}级)<a href="?cmd=$modify">修改</a><a href="?cmd=$delete">删除</a><br/>
「{$rp_desc}」<br/>
HTML;
}

$rp_html .= <<<HTML
$rp_list<br/>
<a href="?cmd=$add_rp">增加资源</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($rp_canshu==1){
if($_POST['rp_op_type'] ==1){
    $dblj->exec("update system_rp set rp_name = '$rp_name',rp_rarity = '$rp_rarity',rp_renew_time = '$rp_renew_time',rp_pick_cond = '$rp_pick_cond',rp_action_name = '$rp_action_name',rp_desc = '$rp_desc' where rp_id = '$rp_id'");
    echo "修改成功!<br/>";
}elseif($_POST['rp_op_type'] ==2){
    $dblj->exec("insert into system_rp(rp_name,rp_rarity,rp_renew_time,rp_pick_cond,rp_action_name,rp_desc)values('$rp_name','$rp_rarity','$rp_renew_time','$rp_pick_cond','$rp_action_name','$rp_desc')");
    $rp_id = $dblj->lastInsertId();
    echo "新增成功!<br/>";
}
$ret_now = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=0&sid=$sid");
$rp_detail = \player\getrp_detail($rp_id,$dblj);
$rp_id = $rp_detail->rp_id;
$rp_name = $rp_detail->rp_name;
$rp_rarity = $rp_detail->rp_rarity;
$rp_desc = $rp_detail->rp_desc;
$rp_rarity = $rp_detail->rp_rarity;
$rp_renew_time = $rp_detail->rp_renew_time;
$rp_action_name = $rp_detail->rp_action_name;
$rp_pick_cond = $rp_detail->rp_pick_cond;

// 构建 select 元素的 HTML 代码
$select = '<select name="rp_rarity">';
for ($i = 1; $i <= 9; $i++) {
    $selected = ($rp_rarity == $i) ? 'selected' : '';
    $select .= '<option value="' . $i . '"' . $selected . '>' . $i."级" . '</option>';
}
$select .= '</select><br/>';

$rp_html .= <<<HTML
<form method="POST">
<input name="rp_op_type" type="hidden" value="1">
<input name="$rp_id" type="hidden" value="{$rp_id}">
资源id：{$rp_id}<br/>
资源名称：<input name="rp_name" type="text" maxlength="10" value="{$rp_name}"><br/>
资源介绍：<textarea name="rp_desc" maxlength="1024" rows="4" cols="40" >{$rp_desc}</textarea><br/>
资源稀有度：{$select}
资源刷新时间(秒)：<input name="rp_renew_time" type="num" maxlength="10" value="{$rp_renew_time}">秒<br/>
采集动作名称：<input name="rp_action_name" type="text" maxlength="10" value="{$rp_action_name}"><br/>
采集条件表达式：<textarea name="rp_pick_cond" maxlength="1024" rows="4" cols="40" >{$rp_pick_cond}</textarea><br/>
<input name="submit" type="submit" title="提交" value="提交"><br/>
</form><br/>
<a href="?cmd=$ret_now">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($rp_canshu==2){
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=0&sid=$sid");
$sure_update = $encode->encode("cmd=gm_game_rpdesign&delete_rp_name=$rp_name&delete_rp_id=$rp_id&rp_canshu=0&sid=$sid");
$rp_html .= <<<HTML
<p>是否删除资源点：[{$rp_name}]<br/>
<a href="?cmd=$sure_update">确定删除</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
}elseif($rp_canshu==3){
$ret_now = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=0&sid=$sid");
$rp_add = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=1&sid=$sid");
$rp_html .= <<<HTML
<form action="?cmd=$rp_add" method="POST">
<input name="rp_op_type" type="hidden" value="2">
资源id：<br/>
资源名称：<input name="rp_name" type="text" maxlength="10" value="未命名"><br/>
资源介绍：<textarea name="rp_desc" maxlength="1024" rows="4" cols="40" ></textarea><br/>
资源稀有度：<select name="rp_rarity">
<option value="1">1级</option>
<option value="2">2级</option>
<option value="3">3级</option>
<option value="4">4级</option>
<option value="5">5级</option>
<option value="6">6级</option>
<option value="7">7级</option>
<option value="8">8级</option>
<option value="9">9级</option>
</select><br/>
资源刷新时间(秒)：<input name="rp_renew_time" type="num" maxlength="10" value="30">秒<br/>
采集动作名称：<input name="rp_action_name" type="text" maxlength="10" value="采集未命名"><br/>
采集条件表达式：<textarea name="rp_pick_cond" maxlength="1024" rows="4" cols="40" ></textarea><br/>
<input name="submit" type="submit" title="提交" value="提交"><br/>
</form><br/>
<a href="?cmd=$ret_now">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
}elseif($rp_canshu==4){
$ret_now = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=0&sid=$sid");
$rp_html .="[选择资源点绑定物品]<br/>";
$cxall_rp = \gm\get_item_list($dblj,"任务物品");
for ($i=0;$i<count($cxall_rp);$i++){
    $hangshu +=1;
    $iname = $cxall_rp[$i]['iname'];
    $iid = $cxall_rp[$i]['iid'];
    $br++;
    $target_iid = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=0&rp_id=$rp_id&add_rp_id=$iid&sid=$sid");
    $rp_html .=<<<HTML
        <a href="?cmd=$target_iid" >$hangshu.{$iname}(i{$iid})</a><br/>
HTML;
}
$rp_html .="<a href='?cmd=$ret_now'>返回上级</a><br/>";
$rp_html .="<a href='?cmd=$gm'>返回设计大厅</a><br/>";
}
echo $rp_html;
?>