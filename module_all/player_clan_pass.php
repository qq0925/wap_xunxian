<?php 

if($canshu=='pass'){
echo "你同意了一个入帮请求！<br/>";
$dblj->exec("update game1 set uclan_id = '$clan_id' where sid = '$pass_id'");
$members_uid = \player\getplayer($pass_id,$dblj)->uid;

// 更新查询语句
$sql = "UPDATE system_clan_list SET clan_members = CONCAT(clan_members,',',:members_uid) WHERE clan_id = :clan_id";

// 预处理SQL语句
$stmt = $dblj->prepare($sql);

// 绑定参数
$stmt->bindParam(':members_uid', $members_uid, PDO::PARAM_INT);
$stmt->bindParam(':clan_id', $clan_id, PDO::PARAM_INT);
$stmt->execute();

$dblj->exec("delete from player_clan_apply where apply_sid = '$pass_id'");
}
if($canshu=='refuse'){
echo "你拒绝了一个入帮请求！<br/>";
$dblj->exec("delete from player_clan_apply where apply_sid = '$refuse_id'");
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$goclan = $encode->encode("cmd=player_clan&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$sql = "select apply_sid from player_clan_apply where apply_clan_id = '$clan_id'";
$Result = $dblj->query($sql);
$apply_members = $Result->fetchAll(PDO::FETCH_ASSOC);
$apply_members_count = count($apply_members);
for($i=1;$i<$apply_members_count +1;$i++){
    $apply_sid = $apply_members[$i-1]['apply_sid'];
    $apply_name = \player\getplayer($apply_sid,$dblj)->uname;
$pass_apply = $encode->encode("cmd=clan_pass&canshu=pass&pass_id=$apply_sid&clan_id=$clan_id&ucmd=$cmid&sid=$sid");
$refuse_apply = $encode->encode("cmd=clan_pass&canshu=refuse&refuse_id=$apply_sid&clan_id=$clan_id&ucmd=$cmid&sid=$sid");
$apply_html .= <<<HTML
[$i].{$apply_name}<a href="?cmd=$pass_apply">同意</a>|<a href="?cmd=$refuse_apply">拒绝</a><br/>
HTML;
}
$clan_html = <<<HTML
[申请入帮成员]<br/>
$apply_html
<a href="?cmd=$goclan">返回帮派</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;

echo $clan_html;

?>