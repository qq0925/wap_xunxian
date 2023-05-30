<p>[基本信息设置]<br/></p>
<?php
$player = \player\getplayer($sid,$dblj);
$gm_post = \gm\gm_post($dblj);
$gameconfig = \player\getgameconfig($dblj);
$firstmid = $gameconfig->firstmid;
$firstmidname = $gameconfig->firstmidname;
//$sql_2 = "update gm_game_basic set entrance_id ='$firstmid',entrance_map ='$firstmidname' where game_id = '19980925'";
//$_SERVER['PHP_SELF'];
$gm = $encode->encode("cmd=gm&sid=$sid");
$gm_map_cmd = $encode->encode("cmd=gm_map&sid=$sid");

if($gm_post->game_status=="0"){
    $gm_select_0 = "selected";
}elseif ($gm_post->game_status=="1") {
    $gm_select_1 = "selected";
}elseif ($gm_post->game_status=="2") {
    $gm_select_2= "selected";
}elseif ($gm_post->game_status=="3") {
    $gm_select_3 = "selected";
}
if($gm_post_canshu == "1"){
$post_tishi = '修改成功';
}
$gm_html = <<<HTML
$post_tishi<br/>
<form>
<input type="hidden" name="cmd" value="gm_post_1">
<input type="hidden" name="gm_post_canshu" value="1">
<input type="hidden" name="sid" value="$sid">
<input type="hidden" name="firstmid" value="$firstmid">
<input type="hidden" name="firstmidname" value="$firstmidname">
游戏名称:<input name="game_name" type="text" value="$gm_post->game_name" maxlength="25" /><br />
游戏简介:<textarea name="game_desc" maxlength="400" rows="4" cols="40">$gm_post->game_desc</textarea><br />
货币名称:<input name="money_name" type="text" value="$gm_post->money_name" maxlength="10" /><br />
货币单位:<input name="money_measure" type="text" value="$gm_post->money_measure" maxlength="10" /><br />
升级公式:<textarea name="promotion_exp" maxlength="1024" rows="4" cols="40" >$gm_post->promotion_exp</textarea><br />
升级条件:<textarea name="promotion_cond" maxlength="1024" rows="4" cols="40" >$gm_post->promotion_cond</textarea><br />
自创技能伤害系数升级公式:<textarea name="mod_promotion_exp" maxlength="1024" rows="4" cols="40" >$gm_post->mod_promotion_exp</textarea><br />
自创技能伤害系数升级条件:<textarea name="mod_promotion_cond" maxlength="1024" rows="4" cols="40" >$gm_post->mod_promotion_cond</textarea><br />
帮派升级公式:<textarea name="clan_promotion_exp" maxlength="1024" rows="4" cols="40" >$gm_post->clan_promotion_exp</textarea><br />
帮派升级条件:<textarea name="clan_promotion_cond" maxlength="1024" rows="4" cols="40" >$gm_post->clan_promotion_cond</textarea><br />
<!--默认技能:<a href="gCmd.do?cmd=2f&amp;sid=xdyiav5r81o75k6o014un&amp;gid=g2">$gm_post->default_skill</a><br />-->
入口场景:<a href="?cmd=$gm_map_cmd">$firstmidname</a><br/>
游戏状态:<select name="game_status" value="$gm_post->game_status">
<option value="0" $gm_select_0>开发中</option>
<option value="1" $gm_select_1>维护中</option>
<option value="2" $gm_select_2>内测</option>
<option value="3" $gm_select_3>公测</option>
</select><br />
<input type="submit" value="修改">
</form>
<br/>
<button onclick = "window.location.assign('?cmd=$gm')">返回上一级</button><br/>
<a href="?cmd=$gm">返回设计大厅</a>
HTML;
echo $gm_html;
?>
