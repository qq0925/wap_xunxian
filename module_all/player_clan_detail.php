<?php 


if($_POST['creat']){
$clan_name = $_POST['clan_name'];
$clan_desc = $_POST['clan_desc'];
if($clan_name &&$clan_desc){

try {
    // 准备 SQL 插入语句
    $sql = "INSERT INTO system_clan_list (clan_name, clan_desc) VALUES (:clan_name, :clan_desc)";
    
    // 使用 PDO 预处理语句
    $stmt = $dblj->prepare($sql);

    // 绑定参数并执行
    $stmt->bindParam(':clan_name', $clan_name, PDO::PARAM_STR);
    $stmt->bindParam(':clan_desc', $clan_desc, PDO::PARAM_STR);
    
    // 执行插入操作
    if($stmt->execute()) {
        echo "创建成功！<br/>";
        $insert_clan_id = $dblj->lastInsertId();
        $dblj->exec("update game1 set uclan_id = '$insert_clan_id' where sid = '$sid'");
    } else {
        echo "创建失败！<br/>";
    }
} catch (PDOException $e) {
    // 如果发生错误，显示错误信息
    echo "错误: " . $e->getMessage();
}
}else{
    echo "帮派名称和帮会宣言都不能为空!<br/>";
}

}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$clan_id = \player\getplayer($sid,$dblj)->uclan_id;

if($clan_id ==0){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$goclanlist = $encode->encode("cmd=clan_list&ucmd=$cmid&sid=$sid");
$clan_html = <<<HTML
你还没有加入帮派!<br/>
<a href="?cmd=$goclanlist">返回帮派列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}else{
$clan_data = \gm\getclan($clan_id,$dblj);
$clan_name = $clan_data['clan_name'];
$clan_desc = $clan_data['clan_desc'];
$clan_lvl = $clan_data['clan_lvl'];
$clan_money = $clan_data['clan_money'];
$clan_exp = $clan_data['clan_exp'];
$clan_maxexp = $clan_data['clan_max_exp'];
$clan_chairman = \player\getplayer($sid,$dblj,$clan_data['clan_chairman'])->uname;
$clan_vice_chairman = $clan_data['clan_vice_chairman'];

$clan_html = <<<HTML
[帮会名称]:{$clan_name}<br/>
[帮会ID]:{$clan_id}<br/>
[帮会宣言]:{$clan_desc}<br/>
[帮会等级]:{$clan_lvl}<br/>
[帮会经验]:{$clan_exp}/{$clan_maxexp}<br/>
[帮会资金]:{$clan_money}<br/>
[帮主]:{$clan_chairman}<br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
echo $clan_html;

?>