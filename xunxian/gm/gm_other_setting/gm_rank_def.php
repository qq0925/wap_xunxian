<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");

if($_POST){
    if(!$create_id){
    $sql = "update system_rank set rank_name = '$rank_name',rank_exp='$rank_exp',show_count='$show_count',show_cond='$show_cond',show_obj='$show_obj' where rank_id='$rank_id'";
    }else{
    $sql = "insert into system_rank(rank_name,rank_exp,show_count,show_cond,show_obj)values('$rank_name','$rank_exp','$show_count','$show_cond','$show_obj')";
    }
    $dblj->exec($sql);
}
if($delete_canshu){
    $dblj->exec("delete from system_rank where rank_id = '$delete_canshu'");
}

if(!$rank_canshu){
$sql = "select * from system_rank";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($ret)+1;$i++){
$rank_id = $ret[$i-1]['rank_id'];
$rank_name = $ret[$i-1]['rank_name'];
$rank_detail = $encode->encode("cmd=gm_game_othersetting&canshu=7&rank_canshu=$rank_id&sid=$sid");
$rank_delete = $encode->encode("cmd=gm_game_othersetting&canshu=7&delete_canshu=$rank_id&sid=$sid");
$rank_list .=<<<HTML
[$i].<a href="?cmd=$rank_detail">{$rank_name}</a><a href="?cmd=$rank_delete">删除</a><br/>
HTML;
}
$creat_rank = $encode->encode("cmd=gm_game_othersetting&canshu=7&create_canshu=1&sid=$sid");
$rank_html = <<<HTML
[排行榜管理]<br/>
$rank_list
<br/><a href="?cmd=$creat_rank">创建排行榜</a><br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}

if($create_canshu ==1){
$last_page = $encode->encode("cmd=gm_game_othersetting&canshu=7&sid=$sid");
$rank_html = <<<HTML
<form method="post">
<input name="create_id" type="hidden" value="1">
<input name="create_canshu" type="hidden" value="0">
排行榜名称:<input name="rank_name" type="text" maxlength="20" value=""><br/>
排行值表达式:<textarea name="rank_exp" maxlength="1024" rows="4" cols="40">{u.lvl}</textarea><br/>
排行位数:<input name="show_count" type="text" value="10" maxlength="3"/><br/>
排行类别:<select name="show_obj" value="0">
<option value="0">玩家</option>
<option value="1">宠物</option>
</select><br/>
显示条件:<textarea name="show_cond" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="修改" value="修改"></form><br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}


if($rank_canshu){
$sql = "select * from system_rank where rank_id = '$rank_canshu'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$rank_id = $ret['rank_id'];
$rank_name = $ret['rank_name'];
$rank_exp = $ret['rank_exp'];
$show_count = $ret['show_count'];
$show_obj = $ret['show_obj'];
$rank_selected = $ret['show_obj'] ==1?"selected":"";
$show_cond = $ret['show_cond'];
$last_page = $encode->encode("cmd=gm_game_othersetting&canshu=7&sid=$sid");
$rank_html = <<<HTML
<form method="post">
<input name="rank_id" type="hidden" value="{$rank_id}">
排行榜名称:<input name="rank_name" type="text" maxlength="20" value="{$rank_name}"><br/>
排行值表达式:<textarea name="rank_exp" maxlength="1024" rows="4" cols="40">{$rank_exp}</textarea><br/>
排行位数:<input name="show_count" type="text" value="{$show_count}" maxlength="3"/><br/>
排行类别:<select name="show_obj" value="{$show_obj}">
<option value="0">玩家</option>
<option value="1" {$rank_selected}>宠物</option>
</select><br/>
显示条件:<textarea name="show_cond" maxlength="1024" rows="4" cols="40">{$show_cond}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改"></form><br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}
echo $rank_html;
?>