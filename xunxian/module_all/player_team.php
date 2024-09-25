<?php
$team_max_count = \player\getgameconfig($dblj)->team_max_count;
if($_POST){
    $nowdate = date('Y-m-d H:i:s');
    if($team_name==""){
    $team_name = $player->uname."的队伍";
    }
    $sql = "insert into system_team_user(team_name,team_decla,team_master,team_member,team_created_time,team_auto_pass) values ('$team_name','$team_decla','$team_master','$team_master','$nowdate','$team_auto_pass')";
    $dblj->exec($sql);
    $team_id = $dblj->lastInsertId();
    $sql = "update game1 set uteam_id = '$team_id' where sid = '$sid'";
    $dblj->exec($sql);
    $canshu = 1;
}

if($out_id){
    $o_team_id = \player\getplayer(null,$dblj,$out_id)->uteam_id;
    if($o_team_id == $team_id){
    echo "你将{$out_name}踢出了队伍!<br/>";
    $dblj->exec("update game1 set uteam_id = '' where uid ='$out_id'");
    $send_time = date('Y-m-d H:i:s');
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','已将你移出队伍 !',$player->uid,{$out_id},1,'$send_time')";
    $cxjg = $dblj->exec($sql);

    $remove_uid = $out_id;
    // 准备 SQL 查询语句
    $query = "SELECT team_member FROM system_team_user WHERE team_id = '$team_id'";
    
    // 执行查询
    $result = $dblj->query($query);
    
    // 获取结果
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $team_members = $row['team_member'];
    } else {
        echo "查询失败";
    }
    $string_old = $remove_uid;
    $elements = explode(",", $team_members);
    $index = array_search($string_old, $elements);
    if ($index !== false) {
        unset($elements[$index]);
    }
    $newString = implode(",", $elements);
                // 准备 SQL 更新语句，使用占位符代替变量
    $query = "UPDATE system_team_user SET team_member = :newstring WHERE team_id = '$team_id'";
    // 准备并执行预处理语句
    $stmt = $dblj->prepare($query);
    // 绑定参数值
    $stmt->bindParam(':newstring', $newString);
    $stmt->execute();
    }else{
    echo "{$out_name}已不在队伍中!<br/>";
    }
}

if($accpet_id){
    $team_members = \player\getteam($team_id,$dblj)['team_member'];
    $team_count = @count(explode(',',$team_members));
    if($team_count<$team_max_count){
    $player = \player\getplayer($sid,$dblj);
    $accpet_oid = \player\getplayer(null,$dblj,$accpet_id)->sid;
    $dblj->exec("update game1 set uteam_id = '$team_id',uteam_putin_id = '' where sid = '$accpet_oid'");
    $send_time = date('Y-m-d H:i:s');
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','通过了你的入队申请!',$player->uid,{$accpet_id},1,'$send_time')";
    $cxjg = $dblj->exec($sql);
    echo "你通过了{$accpet_name}的入队请求!<br/>";
    
    $query = "SELECT team_putin_id,team_member FROM system_team_user WHERE team_id = '$team_id'";
    
    // 执行查询
    $result = $dblj->query($query);
    
    // 获取结果
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $team_members = $row['team_member'];
        $team_putin_ids = $row['team_putin_id'];
    } else {
        echo "查询失败";
    }
    
    $string_new = $accpet_id;
    if(!in_array($string_new, explode(',',$team_members))) {
    //  字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_team_user SET team_member = CONCAT(team_member, ',', :new_value) where team_id = '$team_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}
    
    $string_old = $accpet_id;
    $elements = explode("|", $team_putin_ids);
    $index = array_search($string_old, $elements);
    if ($index !== false) {
        unset($elements[$index]);
    }
    $newString = implode(",", $elements);
    
                // 准备 SQL 更新语句，使用占位符代替变量
    $query = "UPDATE system_team_user SET team_putin_id = :newstring WHERE team_id = '$team_id'";
    
    // 准备并执行预处理语句
    $stmt = $dblj->prepare($query);
    
    // 绑定参数值
    $stmt->bindParam(':newstring', $newString);
    $stmt->execute();
}else{
echo "队伍人数已满!<br/>";
$team_putin_members = \player\getteam($team_id,$dblj)['team_putin_id'];
$team_putin_para = explode("|",$team_putin_members);
$team_putin_count = @count($team_putin_para);
for($i=0;$i<$team_putin_count;$i++){
    $team_putin_id = $team_putin_para[$i];
    $dblj->exec("update game1 set uteam_putin_id = '' where uid = '$team_putin_id'");
    $send_time = date('Y-m-d H:i:s');
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','队伍人数已满，你的申请已自动取消!',$player->uid,{$team_putin_id},1,'$send_time')";
    $cxjg = $dblj->exec($sql);
}
$dblj->exec("update system_team_user set team_putin_id = '' where team_id = '$team_id'");
}
}

if($reject_id){
    $team_members = \player\getteam($team_id,$dblj)['team_member'];
    $team_count = @count(explode(',',$team_members));
    if($team_count<$team_max_count){
    $reject_oid = \player\getplayer(null,$dblj,$reject_id)->sid;
    $dblj->exec("update game1 set uteam_putin_id = '$team_id' where sid = '$reject_oid'");
    $send_time = date('Y-m-d H:i:s');
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','拒绝了你的入队申请!',$player->uid,{$reject_id},1,'$send_time')";
    $cxjg = $dblj->exec($sql);
    
    echo "你拒绝了{$reject_name}的入队请求!<br/>";
    $query = "SELECT team_putin_id,team_member FROM system_team_user WHERE team_id = '$team_id'";
    
    // 执行查询
    $result = $dblj->query($query);
    
    // 获取结果
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $team_members = $row['team_member'];
        $team_putin_ids = $row['team_putin_id'];
    } else {
        echo "查询失败";
    }
    $string_old = $reject_id;
    $elements = explode("|", $team_putin_ids);
    $index = array_search($string_old, $elements);
    if ($index !== false) {
        unset($elements[$index]);
    }
    $newString = implode(",", $elements);
    
    // 准备 SQL 更新语句，使用占位符代替变量
    $query = "UPDATE system_team_user SET team_putin_id = :newstring WHERE team_id = '$team_id'";
    
    // 准备并执行预处理语句
    $stmt = $dblj->prepare($query);
    
    // 绑定参数值
    $stmt->bindParam(':newstring', $newString);
    $stmt->execute();
    }else{
echo "队伍人数已满!<br/>";
$team_putin_members = \player\getteam($team_id,$dblj)['team_putin_id'];
$team_putin_para = explode("|",$team_putin_members);
$team_putin_count = @count($team_putin_para);
for($i=0;$i<$team_putin_count;$i++){
    $team_putin_id = $team_putin_para[$i];
    $dblj->exec("update game1 set uteam_putin_id = '' where uid = '$team_putin_id'");
    $send_time = date('Y-m-d H:i:s');
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','队伍人数已满，你的申请已自动取消!',$player->uid,{$team_putin_id},1,'$send_time')";
    $cxjg = $dblj->exec($sql);
}
$dblj->exec("update system_team_user set team_putin_id = '' where team_id = '$team_id'");
}
}

if($canshu =="out"){
$o_team_id = \player\getplayer($sid,$dblj,null)->uteam_id;

if($o_team_id ==$team_id){
echo "你已退出队伍!<br/>";
$dblj->exec("update game1 set uteam_id = '' where sid ='$sid'");
$player = \player\getplayer($sid,$dblj);
$remove_uid = $player->uid;
// 准备 SQL 查询语句
$query = "SELECT team_member FROM system_team_user WHERE team_id = '$team_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $team_members = $row['team_member'];
} else {
    echo "查询失败";
}
$string_old = $remove_uid;
$elements = explode(",", $team_members);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_team_user SET team_member = :newstring WHERE team_id = '$team_id'";

// 准备并执行预处理语句
$stmt = $dblj->prepare($query);

// 绑定参数值
$stmt->bindParam(':newstring', $newString);
$stmt->execute();
}else{
    echo "你已不在队伍之中!<br/>";
}
}
if($canshu =="cancel"){
    $o_team_id = \player\getplayer(null,$dblj,$out_id)->uteam_id;
    if($o_team_id ==$team_id){
    echo "你已取消入队申请！<br/>";
    $dblj->exec("UPDATE game1 set uteam_putin_id = '' where sid ='$sid'");
    
    $query = "SELECT team_putin_id FROM system_team_user WHERE team_id = '$team_id'";
    
    // 执行查询
    $result = $dblj->query($query);
    
    // 获取结果
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $team_putin_ids = $row['team_putin_id'];
    } else {
        echo "查询失败";
    }
    $string_old = $cancel_id;
    $elements = explode("|", $team_putin_ids);
    $index = array_search($string_old, $elements);
    if ($index !== false) {
        unset($elements[$index]);
    }
    $newString = implode("|", $elements);
    
                // 准备 SQL 更新语句，使用占位符代替变量
    $query = "UPDATE system_team_user SET team_putin_id = :newstring WHERE team_id = '$team_id'";
    
    // 准备并执行预处理语句
    $stmt = $dblj->prepare($query);
    
    // 绑定参数值
    $stmt->bindParam(':newstring', $newString);
    $stmt->execute();
    }else{
    echo "你已不在队伍之中!<br/>";
    }
}
if($canshu =="diss"){
echo "你已解散队伍!<br/>";
$dblj->exec("delete from system_chat_data where chat_type = 4 and  imuid = '$team_id'");
$query = "SELECT team_member FROM system_team_user WHERE team_id = '$team_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $team_members = $row['team_member'];
} else {
    echo "查询失败";
}
$team_members = explode(',',$team_members);
foreach ($team_members as $team_member){
    $dblj->exec("UPDATE game1 set uteam_id = '',uteam_putin_id = '' where uid ='$team_member'");
    if($team_member !=$player->uid){
    $send_time = date('Y-m-d H:i:s');
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','我已经解散了队伍!',$player->uid,{$team_member},1,'$send_time')";
    $cxjg = $dblj->exec($sql);
    }
}
$dblj->exec("delete from system_team_user where team_id = '$team_id'");

$canshu = "creat";
}
if($canshu == "join"){
$team_count = @count(explode(',',\player\getteam($team_id,$dblj)['team_member']));
if($team_count<$team_max_count){
$team_putin_id = \player\getplayer($sid,$dblj)->uteam_putin_id;
if(!$team_putin_id||$team_putin_id==$team_id){
$sql = "SELECT team_putin_id,team_auto_pass FROM system_team_user where team_id = '$team_id'";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$team_auto_ret = $stmt->fetch(PDO::FETCH_ASSOC);
$team_auto_pass = $team_auto_ret['team_auto_pass'];
$team_putin_id = $team_auto_ret['team_putin_id'];
if($team_auto_pass==1){
echo "你已加入队伍!<br/>";

$dblj->exec("update game1 set uteam_id = '$team_id' where sid ='$sid'");
$player = \player\getplayer($sid,$dblj);
$join_uid = $player->uid;

$string_new = $join_uid;

$query = "SELECT team_member FROM system_team_user where team_id = '$team_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(!in_array($string_new, explode(',',$result['team_member']))) {
    //  字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_team_user SET team_member = CONCAT(team_member, ',', :new_value) where team_id = '$team_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}

}else{
$player = \player\getplayer($sid,$dblj);
$join_uid = $player->uid;
if(in_array($join_uid, explode('|',$team_putin_id))){
echo "你已提交过申请，请勿重复提交!<br/>";
}elseif($player->uteam_id == $team_id){
echo "你已经在队伍里了!<br/>";
}
else{
$send_time = date('Y-m-d H:i:s');
$string_new = $team_putin_id."|".$join_uid;
$string_new = ltrim($string_new,"|");
$dblj->exec("update system_team_user set team_putin_id = '$string_new' where team_id = '$team_id'");
echo "你申请加入对方的队伍!请等待确认!<br/>";
$dblj->exec("UPDATE game1 set uteam_putin_id = '$team_id' where sid ='$sid'");
$sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','申请加入你的队伍!',$player->uid,{$oid},1,'$send_time')";
$cxjg = $dblj->exec($sql);
}



}
}
else{
    echo "你有一个其它队伍的入队请求，请取消后再申请！<br/>";
}
}else{
echo "队伍人数已满!<br/>";
}
}


$player = \player\getplayer($sid,$dblj);
if(!$team_id){
$player_team_id = $player->uteam_id;
}else{
$player_team_id = $team_id;
}
$player_uid = $player->uid;
$player_putin_id = $player->uteam_putin_id;
if($canshu =="creat"){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$team_html = <<<HTML
<form method = "post">【创建队伍】<br/>
<input type="hidden" name="team_master" value="{$player_uid}">
<input type="hidden" name="ucmd" value="{$cmid}">
队伍名字: <input name = "team_name" type = "text"/><br/>
队伍宣言: <textarea type="text" name="team_decla" rows="4" cols="20"></textarea><br/>
是否自动允许加入:<select name="team_auto_pass">
<option value="0" >否</option>
<option value="1" >是</option>
</select><br/>
<input style="height:25px;"name = "submit" type = "submit" title = "创建队伍" value="创建队伍" /><br/><br/>
</form>
HTML;
}else{
$sql = "select * from system_team_user where team_id = '$player_team_id'";
$cxjg = $dblj->query($sql);
if ($cxjg){
    $team = $cxjg->fetch(PDO::FETCH_ASSOC);
    $team_name = $team['team_name'];
    $team_id = $team['team_id'];
    $team_decla = $team['team_decla'];
    $team_master = $team['team_master'];
    $team_auto_pass = $team['team_auto_pass'] ==0?"否":"是";
    $team_master_name = \player\getplayer(null,$dblj,$team_master)->uname;
    $team_created_time = $team['team_created_time'];
    $team_members = explode(',',$team['team_member']);
    $team_join_para = $team['team_putin_id'];
    $team_join_list = explode('|',$team_join_para);
    $team_member_count = @count($team_members);
    if($team_member_count){
        $i = 0;
        foreach ($team_members as $team_member){
            if($team_member !=$team_master){
            $i++;
            $team_member_info = $encode->encode("cmd=getoplayerinfo&oid=$team_member&ucmd=$cmid&sid=$sid");
            $team_member_name = \player\getplayer(null,$dblj,$team_member)->uname;
            $team_member_out = $encode->encode("cmd=player_team_html&canshu=1&team_id=$team_id&out_name=$team_member_name&out_id=$team_member&ucmd=$cmid&sid=$sid");
            if($player_uid ==$team_master){
            $team_member_html .=<<<HTML
队员{$i}：<a href="?cmd=$team_member_info">{$team_member_name}</a>|<a href="?cmd=$team_member_out">踢出队伍</a><br/>
HTML;
}else{
            $team_member_html .=<<<HTML
队员{$i}：<a href="?cmd=$team_member_info">{$team_member_name}</a><br/>
HTML;
}
}
        }
    }
    if($team_join_para&&$player_uid ==$team_master){
        $j = 0;
        foreach ($team_join_list as $team_join_list_one){
            $j++;
            $team_member_info = $encode->encode("cmd=getoplayerinfo&oid=$team_member&ucmd=$cmid&sid=$sid");
            $team_member_name = \player\getplayer(null,$dblj,$team_join_list_one)->uname;
            $accpet = $encode->encode("cmd=player_team_html&canshu=1&team_id=$team_id&accpet_name=$team_member_name&accpet_id=$team_join_list_one&ucmd=$cmid&sid=$sid");
            $reject = $encode->encode("cmd=player_team_html&canshu=1&team_id=$team_id&reject_name=$team_member_name&reject_id=$team_join_list_one&ucmd=$cmid&sid=$sid");
            $team_join_list_html .=<<<HTML
           [{$j}]：{$team_member_name}申请加入你的队伍<br/><a href="?cmd=$accpet">同意</a>|<a href="?cmd=$reject">拒绝<br/></a>
HTML;

        }
    }
    
    if($team_master ==$player_uid){
$diss_team = $encode->encode("cmd=player_team_html&team_id=$team_id&canshu=diss&ucmd=$cmid&sid=$sid");
        $team_op =<<<HTML
<a href="?cmd=$diss_team">解散队伍</a><br/>
HTML;
}elseif($team_master !=$player_uid &&in_array($player_uid, $team_members)){
$out_team = $encode->encode("cmd=player_team_html&team_id=$team_id&canshu=out&ucmd=$cmid&sid=$sid");
        $team_op =<<<HTML
<a href="?cmd=$out_team">退出队伍</a><br/>
HTML;
}elseif(!in_array($player_uid, $team_members) &&$player_putin_id != $team_id&&$team_member_count<$team_max_count){
$join_team = $encode->encode("cmd=player_team_html&oid=$team_master&team_id=$team_id&canshu=join&ucmd=$cmid&sid=$sid");
        $team_op =<<<HTML
<a href="?cmd=$join_team">加入队伍</a><br/>
HTML;
}elseif($player_putin_id == $team_id){
$cancel_team = $encode->encode("cmd=player_team_html&team_id=$team_id&cancel_id=$player_uid&canshu=cancel&ucmd=$cmid&sid=$sid");
        $team_op =<<<HTML
<a href="?cmd=$cancel_team">取消申请</a><br/>
HTML;
}
    if($team_master !=$player_uid){
    $team_master_info = $encode->encode("cmd=getoplayerinfo&oid=$team_member&ucmd=$cmid&sid=$sid");
    }else{
    $team_master_info = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");
    }
}
$team_html = <<<HTML
【队伍名】：{$team_name}<br/>
【创建时间】：{$team_created_time}<br/>
【当前成员数量】：({$team_member_count}/{$team_max_count})<br/>
【队伍宣言】：{$team_decla}<br/>
【自动允许加入】:{$team_auto_pass}<br/>
队长：<a href="?cmd=$team_master_info">{$team_master_name}</a><br/>
$team_member_html
$team_join_list_html
<br/>$team_op
HTML;
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$goteam_list = $encode->encode("cmd=player_team_html&ucmd=$cmid&sid=$sid");
$team_html .=<<<HTML
<a href="?cmd=$goteam_list">返回队伍列表</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
echo $team_html;
?>