<?php
$player = \player\getplayer($sid,$dblj);
$gm_post = \gm\gm_post($dblj);

if($post_canshu =='map'){
    $sql = "UPDATE gm_game_basic SET entrance_id = '$target_mid'";
    $cxjg =$dblj->exec($sql);
}

if($post_canshu =='skill'){
    $sql = "update gm_game_basic set default_skill_id = '$skill_id'";
    $dblj->exec($sql);
}

$gameconfig = \player\getgameconfig($dblj);

$default_skill_id = $gameconfig->default_skill_id;

if($default_skill_id ==0){
    $default_skill_total = "选择";
}else{
    $default_skill = \player\getskill($default_skill_id,$dblj);
    $default_skill_total = "{$default_skill->jname}(ID:j{$default_skill_id})";
}

$default_mid_id = $gameconfig->entrance_id;

if($default_mid_id ==0){
    $default_mid_total = "选择";
}else{
    $default_mid = \player\getmid($default_mid_id,$dblj);
    $default_mid_total = "{$default_mid->mname}(ID:s{$default_mid_id})";
}

$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_skill_cmd = $encode->encode("cmd=gm_skill&sid=$sid");
$gm_map_cmd = $encode->encode("cmd=gm_map&sid=$sid");
$game_post = $encode->encode("cmd=gm_post_1&sid=$sid");
if($gm_post->game_status=="0"){
    $gm_select_0 = "selected";
}elseif ($gm_post->game_status=="1") {
    $gm_select_1 = "selected";
}elseif ($gm_post->game_status=="2") {
    $gm_select_2= "selected";
}elseif ($gm_post->game_status=="3") {
    $gm_select_3 = "selected";
}

$gm_html = <<<HTML
<p>[基本信息设置]</p>
$post_tishi
<form action="?cmd=$game_post" method="post">
<input type="hidden" name="gm_post_canshu" value="1">
<input type="hidden" name="sid" value="$sid">
游戏名称:<input name="game_name" type="text" value="$gm_post->game_name" maxlength="25" /><br/>
游戏简介:<br/><textarea type="text" name="game_desc" id="text" class="text" maxlength="400" rows="4" cols="40">$gm_post->game_desc</textarea><br/>
游戏状态:<select name="game_status" value="$gm_post->game_status">
<option value="0" $gm_select_0>开发中</option>
<option value="1" $gm_select_1>维护中</option>
<option value="2" $gm_select_2>内测</option>
<option value="3" $gm_select_3>公测</option>
</select><br/>
货币名称:<input name="money_name" type="text" value="$gm_post->money_name" maxlength="10" disabled/><br/>
货币单位:<input name="money_measure" type="text" value="$gm_post->money_measure" maxlength="10" disabled/><br/>
宠物出战上限:<input name="pet_max_count" type="text" value="$gameconfig->pet_max_count" maxlength="10" /><br/>
组队人数上限:<input name="team_max_count" type="text" value="$gameconfig->team_max_count" maxlength="10" /><br/>
升级公式:<textarea name="promotion_exp" maxlength="1024" rows="4" cols="40" >$gm_post->promotion_exp</textarea><br/>
升级条件:<textarea name="promotion_cond" maxlength="1024" rows="4" cols="40" >$gm_post->promotion_cond</textarea><br/>
自创技能伤害系数升级公式:<textarea name="mod_promotion_exp" maxlength="1024" rows="4" cols="40" >$gm_post->mod_promotion_exp</textarea><br/>
自创技能伤害系数升级条件:<textarea name="mod_promotion_cond" maxlength="1024" rows="4" cols="40" >$gm_post->mod_promotion_cond</textarea><br/>
帮派升级公式:<textarea name="clan_promotion_exp" maxlength="1024" rows="4" cols="40" >$gm_post->clan_promotion_exp</textarea><br/>
帮派升级条件:<textarea name="clan_promotion_cond" maxlength="1024" rows="4" cols="40" >$gm_post->clan_promotion_cond</textarea><br/>
入口场景:<a href="?cmd=$gm_map_cmd">{$default_mid_total}</a><br/>
默认技能:<a href="?cmd=$gm_skill_cmd">{$default_skill_total}</a><br/>
<input type="submit" value="修改">
</form>
<br/>
<a href="?cmd=$gm">返回设计大厅</a>
HTML;
echo $gm_html;
?>
