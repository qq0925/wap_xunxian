<?php 

if($canshu=='join'){
    $apply_clan_id = \player\getplayer_apply($sid,$dblj);
    $belong_clan_id = \player\getplayer($sid,$dblj)->uclan_id;
    if(!$apply_clan_id &&!$belong_clan_id){
        echo "你申请加入帮派，请等待回复！<br/>";
        $dblj->exec("delete from player_clan_apply where apply_sid = '$sid'");
        $dblj->exec("insert into player_clan_apply(apply_sid,apply_clan_id)values('$sid','$clan_id')");
    }elseif($apply_clan_id&&!$belong_clan_id){
        echo "你已经有一个正在申请中的帮派！<br/>";
    }elseif(!$apply_clan_id&&$belong_clan_id){
        echo "你已经加入了一个帮派，请退出后重试！<br/>";
    }
    
}


$cmid = $cmid + 1;
$cdid[] = $cmid;
$goclanlist = $encode->encode("cmd=clan_list&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$clan_data = \gm\getclan($clan_id,$dblj);
$clan_id = $clan_data['clan_id'];
if($clan_id ==0){
$clan_html = <<<HTML
帮派不存在!<br/>
<a href="?cmd=$goclanlist">返回帮派列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}else{
$clan_name = $clan_data['clan_name'];
$clan_desc = $clan_data['clan_desc'];
$clan_lvl = $clan_data['clan_lvl'];
$clan_money = $clan_data['clan_money'];
$clan_exp = $clan_data['clan_exp'];
$clan_maxexp = $clan_data['clan_max_exp'];
$clan_chairman = \player\getplayer($sid,$dblj,$clan_data['clan_chairman'])->uname;
$clan_vice_chairman = $clan_data['clan_vice_chairman'];

$cmid = $cmid + 1;
$cdid[] = $cmid;
$join_clan = $encode->encode("cmd=player_clan_html&clan_id=$clan_id&canshu=join&ucmd=$cmid&sid=$sid");
$clan_html = <<<HTML
[帮会名称]:{$clan_name}<br/>
[帮会ID]:{$clan_id}<br/>
[帮会宣言]:{$clan_desc}<br/>
[帮会等级]:{$clan_lvl}<br/>
[帮会经验]:{$clan_exp}/{$clan_maxexp}<br/>
[帮会资金]:{$clan_money}<br/>
[帮主]:{$clan_chairman}<br/>
<a href="?cmd=$join_clan">加入帮派</a><br/>
<a href="?cmd=$goclanlist">返回帮派列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
echo $clan_html;

?>