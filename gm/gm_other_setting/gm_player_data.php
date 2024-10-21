<?php

if($delete_id !=0){
    $sql = "DELETE FROM game1 WHERE uid = '$delete_id' or (imuid = '$delete_id' and send_type = 0);";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_chat_data WHERE uid = '$delete_id';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_fight_quick WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_item WHERE uid = '$delete_id';";
    $dblj->exec($sql);
    $sql = "DELETE FROM forum_text WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM forum_res WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM game2 WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM game3 WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM game4 WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM player_temp_attr WHERE obj_id = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM player_clan_apply WHERE apply_sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_addition_attr WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_designer_assist WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_equip_user WHERE eqsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_npc_midguaiwu WHERE nsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_black WHERE usid = '$u_sid' or osid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_boat WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_pet_scene WHERE nsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_friend WHERE usid = '$u_sid' or osid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_inputs WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_setting WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_skill_user WHERE jsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_storage WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_storage_locked WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_task_user WHERE sid = '$u_sid';";
    $dblj->exec($sql);
//组队删除未设定
    echo "已删除[ID:{$delete_id}]的玩家数据！<br/>";
}

if($refresh_id !=0){
    $sql = "DELETE FROM game1 WHERE uid = '$refresh_id' or (imuid = '$refresh_id' and send_type = 0);";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_chat_data WHERE uid = '$refresh_id';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_fight_quick WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_item WHERE uid = '$refresh_id';";
    $dblj->exec($sql);
    $sql = "DELETE FROM forum_text WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM forum_res WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM game2 WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM game3 WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM game4 WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM player_temp_attr WHERE obj_id = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM player_clan_apply WHERE apply_sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_addition_attr WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_designer_assist WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_equip_user WHERE eqsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_npc_midguaiwu WHERE nsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_black WHERE usid = '$u_sid' or osid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_boat WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_pet_scene WHERE nsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_friend WHERE usid = '$u_sid' or osid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_inputs WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_player_setting WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_skill_user WHERE jsid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_storage WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_storage_locked WHERE sid = '$u_sid';";
    $dblj->exec($sql);
    $sql = "DELETE FROM system_task_user WHERE sid = '$u_sid';";
    $dblj->exec($sql);
//组队删除未设定
    $sql = "insert into game1(uid,uis_designer,sid,token) value('$uid','$uis_designer','$sid','$token')";
    $dblj->exec($sql);
    echo "已清空{$u_name}[ID:{$refresh_id}]的玩家数据！<br/>";
}

if($delete_all !=0){
$tables = [
    "game1",
    "system_chat_data",
    "system_fight_quick",
    "system_item",
    "forum_text",
    "forum_res",
    "game2",
    "game3",
    "game4",
    "player_equip_mosaic",
    "player_temp_attr",
    "player_clan_apply",
    "system_addition_attr",
    "system_designer_assist",
    "system_equip_user",
    "system_npc_midguaiwu",
    "system_player_black",
    "system_player_boat",
    "system_pet_scene",
    "system_player_friend",
    "system_player_inputs",
    "system_player_setting",
    "system_skill_user",
    "system_storage",
    "system_storage_locked",
    "system_task_user"
];

try {
    foreach ($tables as $table) {
        $sql = "TRUNCATE TABLE $table";
        $dblj->exec($sql);
    }
    echo "已清空所有玩家数据！<br/>";
} catch (PDOException $e) {
    echo "清空所有玩家数据失败: " . $e->getMessage()."<br/>";
}
}

$sql = "select * from game1";
$cxjg = $dblj ->query($sql);
$playerData = $cxjg ->fetchAll(PDO::FETCH_ASSOC);
$index = 0;
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$delete_all_url = $encode->encode("cmd=gm_game_othersetting&canshu=4&delete_all=1&sid=$sid");
if($playerData){
foreach ($playerData as $player) {
$index = $index + 1;
$uid = $player['uid'];
$uname = $player['uname'];
$refresh_url = $encode->encode("cmd=gm_game_othersetting&canshu=4&refresh_id=$uid&sid=$sid");
$delete_url = $encode->encode("cmd=gm_game_othersetting&canshu=4&delete_id=$uid&sid=$sid");
$player_data_detail .= <<<HTML
<tr>
<td>{$index}</td>
<td>{$uid}</td>
<td>{$player['token']}</td>
<td>{$uname}</td>
<td>{$player['ulvl']}</td>
<td>{$player['sid']}</td>
<td>
<button onclick="myFunction(this)" drump_url="{$refresh_url}" id="{$uid}" name="{$uname}">清空</button>
<button onclick="myFunction1(this)" drump_url="{$delete_url}" id="{$uid}" name="{$uname}">删除</button>
</td>
</tr>
HTML;
        }

$table_frame = <<<HTML
<div id="playerData">
<table border="1px solid black" style="width:100%;padding:10px 10px 10px;text-align:center;">
<tr>
<td>编号</td>
<td>ID</td>
<td>用户token</td>
<td>角色名</td>
<td>等级</td>
<td>用户识别码</td>
<td>功能设置</td>
</tr>
HTML;
$player_data_html = <<<HTML
$table_frame
$player_data_detail
</table><br/>
<button onclick="myFunction2(this)" drump_url="{$delete_all_url}">删除所有玩家数据</button><br/><br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
</div>
HTML;
}else{
$player_data_html = <<<HTML
当前没有任何玩家数据！<br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}
echo $player_data_html;
?>

    <script>
        function myFunction(obj){
        var r=confirm("是否清空角色:"+obj.name);
        if (r==true){
            var drumpUrl = obj.getAttribute("drump_url");
            href = "?cmd=" + drumpUrl;
        window.location.href= href;
        }
        else{
        }
        }
        function myFunction1(obj){
        var r=confirm("是否删除角色及ID:"+obj.name+"(id:"+obj.id+")");
        if (r==true){
            var drumpUrl = obj.getAttribute("drump_url");
            href = "?cmd=" + drumpUrl;
        window.location.href= href;
        }
        else{
        }
        }
        function myFunction2(obj){
        var r=confirm("是否要清空所有玩家数据");
        if (r==true){
            var drumpUrl = obj.getAttribute("drump_url");
            href = "?cmd=" + drumpUrl;
        window.location.href= href;
        }
        else{
        }
        }
    </script>


