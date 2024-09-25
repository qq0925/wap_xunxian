<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$team_max_count = \player\getgameconfig($dblj)->team_max_count;
$sql = "select * from system_team_user";
$cxjg = $dblj->query($sql);
if ($cxjg){
    $team = $cxjg->fetchAll(PDO::FETCH_ASSOC);
}
for($i=1;$i<@count($team) + 1;$i++){
    $team_name = $team[$i-1]['team_name'];
    $team_id = $team[$i-1]['team_id'];
    $team_detail = $encode->encode("cmd=player_team_html&team_id=$team_id&canshu=1&ucmd=$cmid&sid=$sid");
    $team_master = $team[$i-1]['team_master'];
    $team_master_name = \player\getplayer(null,$dblj,$team_master)->uname;
    $team_member = $team[$i-1]['team_member'];
    $team_member_count = @count(explode(',',$team_member));
    $team_list_html .=<<<HTML
队名：<a href="?cmd=$team_detail">{$team_name}</a>({$team_member_count}/{$team_max_count})队长：{$team_master_name}<br/>
HTML;
}
$creat_team = $encode->encode("cmd=player_team_html&canshu=creat&ucmd=$cmid&sid=$sid");
$team_list = <<<HTML
[目前有以下队伍]:<br/>
$team_list_html<br/>
<a href="?cmd=$creat_team">创建队伍</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
echo $team_list;
?>