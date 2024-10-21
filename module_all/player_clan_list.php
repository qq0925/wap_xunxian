<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
//$clan_max_count = \player\getgameconfig($dblj)->clan_max_count;
$clan_max_count = 10;
$sql = "select * from system_clan_list";
$cxjg = $dblj->query($sql);
if ($cxjg){
    $clan = $cxjg->fetchAll(PDO::FETCH_ASSOC);
}
$uclan_id = \player\getplayer($sid,$dblj)->uclan_id;
for($i=1;$i<@count($clan) + 1;$i++){
    $clan_name = $clan[$i-1]['clan_name'];
    $clan_id = $clan[$i-1]['clan_id'];
    
    if($clan_id==$uclan_id){
    $clan_detail = $encode->encode("cmd=player_clan&clan_id=$clan_id&ucmd=$cmid&sid=$sid");
    }else{
    $clan_detail = $encode->encode("cmd=player_clan_html&clan_id=$clan_id&canshu=view&ucmd=$cmid&sid=$sid");
    }
    $clan_chairman = $clan[$i-1]['clan_chairman'];
    $clan_master_name = \player\getplayer(null,$dblj,$clan_chairman)->uname;
    $clan_members = $clan[$i-1]['clan_members'];
    $clan_member_count = @count(explode(',',$clan_members));
    $clan_list_html .=<<<HTML
{$i}.帮名：<a href="?cmd=$clan_detail">{$clan_name}</a>({$clan_member_count}/{$clan_max_count})帮主：{$clan_master_name}<br/>
HTML;
}
$creat_clan = $encode->encode("cmd=player_clan_html&canshu=creat&ucmd=$cmid&sid=$sid");
$clan_list = <<<HTML
[目前有以下帮派]:<br/>
$clan_list_html
<a href="?cmd=$creat_clan">创建帮派</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
echo $clan_list;
?>