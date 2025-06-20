<?php
namespace player;
class player
{
    var $uis_designer;//后台权限
    var $uname;//昵称
    var $unick_name;//昵称
    var $ucmd;//验证cmd
    var $utran_state;//验证交易状态
    var $ulast_cmd;//最后页面cmd
    var $uid;//玩家id
    var $sid;//sid
    var $ulvl;//等级
    var $umoney;//游戏币
    var $uburthen;//负重
    var $umax_burthen;//最大负重
    var $ustorage;//仓库负重
    var $uczb;//充值币
    var $uexp;//经验
    var $ukill;//是否可pk
    var $uis_pve;//是否正在打怪
    var $uauto_fight;//是否自动战斗
    var $uauto_sailing;//是否自动航行
    var $uis_sailing;//是否正在航行
    var $uauto_roading;//
    var $uis_roading;//
    var $uauto_skying;//
    var $uis_skying;//
    var $uteam_id;//队伍id
    var $uteam_putin_id;//申请中的队伍id
    var $uteam_invited_id;//被邀请的队伍id
    var $uclan_id;//帮派id
    var $umaxexp;//经验上限
    var $uhp;//生命
    var $umaxhp;//最大生命
    var $ump;//法力
    var $umaxmp;//最大法力
    var $uspeed;//出招速度
    var $ugj;//攻击
    var $ufy;//防御
    var $usex;//性别
    var $nowmid;//当前地图
    var $justmid;//上一地图
    var $tpsmid;//传送地图
    var $endtime;
    var $minutetime;
    var $sfzx;
    var $allchattime;
    var $cw;
    var $ispvp;
}


class clmid{}

class npc{}

class npc_scene{}

class midguai{}

class guaiwu{}

class npcguaiwu{
    var $nid;
    var $nhp;
    var $nmp;
    var $nname;
    var $ndrop_exp;
    var $ndrop_money;
    var $ndrop_item;
    var $ndrop_item_type;
    var $nmid;
}

class skill{}

class item{}

class task{}

class gamesystem{
    var $promotion_exp;
    var $promotion_cond;
}

function getplayer($sid,$dblj,$uid=null){
    if($uid){
    $sql="select sid from game1 where uid='$uid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $sid = $ret['sid'];
    }
    $player = new player();
    $sql="select * from game1 where sid='$sid'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('uis_designer',$player->uis_designer);
    $cxjg->bindColumn('uname',$player->uname);
    $cxjg->bindColumn('utran_state',$player->utran_state);
    $cxjg->bindColumn('unick_name',$player->unick_name);
    $cxjg->bindColumn('sid',$player->sid);
    $cxjg->bindColumn('ucmd',$player->ucmd);
    $cxjg->bindColumn('ulast_cmd',$player->ulast_cmd);
    $cxjg->bindColumn('uid',$player->uid);
    $cxjg->bindColumn('ulvl',$player->ulvl);
    $cxjg->bindColumn('umoney',$player->umoney);
    $cxjg->bindColumn('uburthen',$player->uburthen);
    $cxjg->bindColumn('umax_burthen',$player->umax_burthen);
    $cxjg->bindColumn('ustorage',$player->ustorage);
    $cxjg->bindColumn('ukill',$player->ukill);
    $cxjg->bindColumn('uis_pve',$player->uis_pve);
    $cxjg->bindColumn('uauto_fight',$player->uauto_fight);
    $cxjg->bindColumn('uis_sailing',$player->uis_sailing);
    $cxjg->bindColumn('uauto_sailing',$player->uauto_sailing);
    $cxjg->bindColumn('uis_roading',$player->uis_roading);
    $cxjg->bindColumn('uauto_roading',$player->uauto_roading);
    $cxjg->bindColumn('uis_skying',$player->uis_skying);
    $cxjg->bindColumn('uauto_skying',$player->uauto_skying);
    $cxjg->bindColumn('uteam_id',$player->uteam_id);
    $cxjg->bindColumn('uteam_putin_id',$player->uteam_putin_id);
    $cxjg->bindColumn('uteam_invited_id',$player->uteam_invited_id);
    $cxjg->bindColumn('uclan_id',$player->uclan_id);
    $cxjg->bindColumn('uexp',$player->uexp);
    $cxjg->bindColumn('uhp',$player->uhp);
    $cxjg->bindColumn('umaxhp',$player->umaxhp);
    $cxjg->bindColumn('ump',$player->ump);
    $cxjg->bindColumn('umaxmp',$player->umaxmp);
    $cxjg->bindColumn('uspeed',$player->uspeed);
    $cxjg->bindColumn('ugj',$player->ugj);
    $cxjg->bindColumn('ufy',$player->ufy);
    $cxjg->bindColumn('usex',$player->usex);
    $cxjg->bindColumn('nowmid',$player->nowmid);
    $cxjg->bindColumn('justmid',$player->justmid);
    $cxjg->bindColumn('tpsmid',$player->tpsmid);
    $cxjg->bindColumn('endtime',$player->endtime);
    $cxjg->bindColumn('minutetime',$player->minutetime);
    $cxjg->bindColumn('allchattime',$player->allchattime);
    $cxjg->bindColumn('citychattime',$player->citychattime);
    $cxjg->bindColumn('areachattime',$player->areachattime);
    $cxjg->bindColumn('cw',$player->cw);
    $cxjg->bindColumn('sfzx',$player->sfzx);
    $cxjg->bindColumn('ispvp',$player->ispvp);
    $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $player;
}

function getplayer_db($sid, $db, $uid=null) {
    if(!$db) {
        $db = DB::conn();
    }
    
    if($uid) {
        $sql = "SELECT sid FROM game1 WHERE uid=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $ret = $result->fetch_assoc();
        $sid = $ret['sid'];
    }
    
    $player = new player();
    $sql = "SELECT * FROM game1 WHERE sid=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $sid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // 将结果赋值给player对象
    foreach($row as $key => $value) {
        if(property_exists($player, $key)) {
            $player->$key = $value;
        }
    }
    
    return $player;
}


function getplayer_apply($sid,$dblj){
    $sql="select apply_clan_id from player_clan_apply where apply_sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $row = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $clan_id = $row['apply_clan_id'];
    return $clan_id;
}

function getnowround($sid,$dblj,$db=null){

if (!$db) {
    // 使用 PDO 查询最大 round
    $sql = "SELECT MAX(round) AS max_round FROM game2 WHERE sid = '$sid'";
    $stmt = $dblj->query($sql); // 获取结果
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    $latestRound = $row['max_round'];  
} else {
    // 使用 MySQLi 查询最大 round
    $sql = "SELECT MAX(round) AS max_round FROM game2 WHERE sid = ?";
    $stmt = $db->prepare($sql);
    
    // 绑定参数
    $stmt->bind_param('s', $sid); // 's' 表示字符串类型
    $stmt->execute();
    
    // 获取结果
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $latestRound = $row['max_round'];
    
    $stmt->close(); // 关闭语句
}

if(!$latestRound){
    $latestRound = 0;
}
return (int)$latestRound;
}

function get_temp_attr($obj_id,$attr_name,$obj_type,$dblj){
    
if($obj_type ==1){
$sql="select attr_value from player_temp_attr where obj_id='$obj_id' and obj_type = '$obj_type' and attr_name = '$attr_name'";
}else{
$sql="select attr_value from player_temp_attr where obj_oid='$obj_id' and obj_type = '$obj_type' and attr_name = '$attr_name'";
}
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(\PDO::FETCH_ASSOC);
$attr_value = $row['attr_value'];
return $attr_value;
}

function update_message_sql($sid,$dblj,$input,$view_type=null){
    $nowdate = date('Y-m-d H:i:s');
    $imuid = getplayer($sid,$dblj)->uid;

    $input = htmlspecialchars($input);
    if($view_type){
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time,viewed) values('系统','$input',-1,{$imuid},6,'$nowdate',1)";
    }else{
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('系统','$input',-1,{$imuid},6,'$nowdate')";
    }
    $dblj->exec($sql);

}

function update_fight_msg($sid,$pid,$gid,$round,$type,$dblj){
    $checkStmt = $dblj->prepare("
        SELECT 1
        FROM system_fight_state 
        WHERE sid = :sid
          AND pid = :pid
          AND gid = :gid
          AND round = :round
          AND type = :type
        LIMIT 1
    ");

    // 绑定检查参数
    $checkStmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
    $checkStmt->bindParam(':pid', $pid, \PDO::PARAM_STR);
    $checkStmt->bindParam(':gid', $gid, \PDO::PARAM_STR);
    $checkStmt->bindParam(':round', $round, \PDO::PARAM_INT);
    $checkStmt->bindParam(':type', $type, \PDO::PARAM_INT);

    $checkStmt->execute();

    if($checkStmt->rowCount() === 0) {
        $update_hp = '0';
        $update_mp = '0';
        
        switch($type){
            case '1':
                $sql = "SELECT uhp,ump from game1 where sid = :sid";
                $stmt = $dblj->prepare($sql);
                $stmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
                $stmt->execute();
                $ret = $stmt->fetch(\PDO::FETCH_ASSOC);
                $update_hp = $ret['uhp'] ?? '0';
                $update_mp = $ret['ump'] ?? '0';
                break;
            case '2':
                $sql = "SELECT nhp,nmp from system_pet_scene where nsid = :sid and npid = :pid";
                $stmt = $dblj->prepare($sql);
                $stmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
                $stmt->bindParam(':pid', $pid, \PDO::PARAM_STR);
                $stmt->execute();
                $ret = $stmt->fetch(\PDO::FETCH_ASSOC);
                $update_hp = $ret['nhp'] ?? '0';
                $update_mp = $ret['nmp'] ?? '0';
                break;
            case '3':
                $sql = "SELECT nhp,nmp from system_npc_midguaiwu where nsid = :sid and ngid = :gid";
                $stmt = $dblj->prepare($sql);
                $stmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
                $stmt->bindParam(':gid', $gid, \PDO::PARAM_STR);
                $stmt->execute();
                $ret = $stmt->fetch(\PDO::FETCH_ASSOC);
                $update_hp = $ret['nhp'] ?? '0';
                $update_mp = $ret['nmp'] ?? '0';
                break;
        }

        // 确保数值为字符串，以支持超大数
        $update_hp = (string)$update_hp;
        $update_mp = (string)$update_mp;

        $insertStmt = $dblj->prepare("
            INSERT INTO system_fight_state(
                sid, pid, gid, round, 
                type, now_hp, now_mp
            ) VALUES (
                :sid, :pid, :gid, :round, 
                :type, :now_hp, :now_mp
            )
        ");
        
        // 绑定插入参数，使用PDO::PARAM_STR确保字符串处理超大数
        $insertStmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
        $insertStmt->bindParam(':pid', $pid, \PDO::PARAM_STR);
        $insertStmt->bindParam(':gid', $gid, \PDO::PARAM_STR);
        $insertStmt->bindParam(':round', $round, \PDO::PARAM_INT);
        $insertStmt->bindParam(':type', $type, \PDO::PARAM_INT);
        $insertStmt->bindParam(':now_hp', $update_hp, \PDO::PARAM_STR); // 改为PARAM_STR
        $insertStmt->bindParam(':now_mp', $update_mp, \PDO::PARAM_STR); // 改为PARAM_STR
        
        $insertStmt->execute();
    }
}

function put_system_message_sql($uid,$dblj){
$sql = "SELECT msg,id FROM system_chat_data where uid = -1 and imuid = '$uid' and viewed = 0 and chat_type = 6  ORDER BY id DESC";//系统未读信息获取
$ltcxjg = $dblj->query($sql);
$lthtml='';
if ($ltcxjg){
    $ret = $ltcxjg->fetchAll(\PDO::FETCH_ASSOC);
    for ($i=0;$i < count($ret);$i++){
        $umsg = $ret[$i]['msg'];
        $mid = $ret[$i]['id'];
        echo $umsg."<br/>";
        $dblj->exec("update system_chat_data set viewed = 1 where id = '$mid'");
    }
}
}

function update_temp_attr($obj_id,$attr_name,$obj_type,$dblj,$op_type,$change_value){
if($op_type==1){
        //设属
if($obj_type ==1){
$sql="update player_temp_attr set attr_value = '$change_value' where obj_id='$obj_id' and obj_type = '$obj_type' and attr_name = '$attr_name'";
}elseif($obj_type ==2){
$sql="update player_temp_attr set attr_value = '$change_value' where obj_oid='$obj_id' and obj_type = '$obj_type' and attr_name = '$attr_name'";
}else{
$sql="update player_temp_attr set attr_value = '$change_value' where obj_id='$obj_id' and attr_name = '$attr_name'";
}
}elseif($op_type ==2){
    //更属
if($obj_type ==1){
$sql="update player_temp_attr set attr_value = attr_value + '$change_value' where obj_id='$obj_id' and obj_type = '$obj_type' and attr_name = '$attr_name'";
}elseif($obj_type ==2){
$sql="update player_temp_attr set attr_value = attr_value + '$change_value' where obj_oid='$obj_id' and obj_type = '$obj_type' and attr_name = '$attr_name'";
}else{
$sql="update player_temp_attr set attr_value = attr_value + '$change_value' where obj_id='$obj_id' and attr_name = '$attr_name'";
}
}
$cxjg = $dblj->query($sql);

}

function get_player_equip_mosaic_all($sid,$dblj,$kw=null){
    if(!$kw){
$sql = "select * from player_equip_mosaic where belong_sid = '$sid' and equip_id in (select item_true_id from system_item where sid = '$sid' and iequiped = 0 and iid in (select iid from system_item_module))";
$cxjg = $dblj->query($sql);

}else{
$sql = "select * from player_equip_mosaic where belong_sid = '$sid' and equip_id in (select item_true_id from system_item where sid = '$sid' and iequiped = 0 and iid in (select iid from system_item_module where iname LiKE :keyword))";
$cxjg = $dblj->prepare($sql);
$cxjg->bindValue(':keyword', "%$kw%", \PDO::PARAM_STR);
$cxjg->execute();
}

$row = $cxjg->fetchAll(\PDO::FETCH_ASSOC);

return $row;
}



function get_player_equip_mosaic_once($item_true_id,$sid,$dblj){
$sql="select equip_mosaic from player_equip_mosaic where belong_sid = '$sid' and equip_id = '$item_true_id'";
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(\PDO::FETCH_ASSOC);
return $row;
}

function get_player_equip_detail($mosaic_id,$sid,$dblj){
$sql="select iname,idesc,iembed_count,itype from system_item_module where iid = (select iid from system_item where sid = '$sid' and item_true_id = '$mosaic_id' and isale_state !=1)";
$cxjg = $dblj->query($sql);
$row = $cxjg->fetch(\PDO::FETCH_ASSOC);
return $row;
}

function get_player_all_equip_enable($sid,$dblj,$kw=null){
    if(!$kw){
$sql = "SELECT m.iname,m.iid,m.idesc,m.iembed_count,i.item_true_id,i.iequiped FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and i.isale_state != 1 and i.iequiped = 0 and m.iembed_count >0 AND NOT EXISTS(SELECT 1 FROM player_equip_mosaic WHERE belong_sid = '$sid' AND equip_id = i.item_true_id)";
$cxjg = $dblj->query($sql);
}else{
$sql = "SELECT m.iname,m.iid,m.idesc,m.iembed_count,i.item_true_id,i.iequiped FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and m.iname LIKE :keyword and i.isale_state != 1 and i.iequiped = 0 and m.iembed_count >0 AND NOT EXISTS(SELECT 1 FROM player_equip_mosaic WHERE belong_sid = '$sid' AND equip_id = i.item_true_id)";
$cxjg = $dblj->prepare($sql);
$cxjg->bindValue(':keyword', "%$kw%", \PDO::PARAM_STR);
$cxjg->execute();
}
$row = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
return $row;
}

function get_player_all_mosaic($type,$sid,$dblj){
    if($type =="兵器"){
$sql = "SELECT m.iname,m.iid,i.item_true_id,i.iequiped,i.icount FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and i.isale_state !=1 and m.itype = '兵器镶嵌物' and i.icount >0";
}else{
$sql = "SELECT m.iname,m.iid,i.item_true_id,i.iequiped,i.icount FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and i.isale_state !=1 and m.itype = '防具镶嵌物' and i.icount >0";
}
$cxjg = $dblj->query($sql);
$row = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
return $row;
}



// ... existing code ...

/**
 * 更新物品总重量
 * @param string $sid 系统ID
 * @param PDO $dblj 数据库连接
 * @return string 总重量
 * @throws Exception 当数据库操作失败时抛出异常
 */
function update_item_burthen($sid, $dblj) {
        // 设置bcmath精度
        bcscale(0);
        
        // 查询物品ID和数量
        $query = "SELECT iid, icount FROM system_item WHERE sid = :sid";
        $stmt = $dblj->prepare($query);
        $stmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
        $stmt->execute();
        
        $totalWeight = '0';
        
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $itemId = $row['iid'];
            $itemCount = $row['icount'];
            
            // 获取物品重量
            $subQuery = "SELECT iweight FROM system_item_module WHERE iid = :iid";
            $subStmt = $dblj->prepare($subQuery);
            $subStmt->bindParam(':iid', $itemId, \PDO::PARAM_INT);
            $subStmt->execute();
            
            if ($subRow = $subStmt->fetch(\PDO::FETCH_ASSOC)) {
                $itemWeight = $subRow['iweight'];
                // 计算当前物品的总重量并加到总重量中
                $itemTotalWeight = bcmul($itemWeight, $itemCount);
                $totalWeight = bcadd($totalWeight, $itemTotalWeight);
            }
        }
        
        return $totalWeight;
}

function getsystem($dblj){
$system = new gamesystem();
$sql="select * from gm_game_basic where game_id='19980925'";
$cxjg = $dblj->query($sql);
$cxjg->bindColumn('promotion_exp',$system->promotion_exp);
$cxjg->bindColumn('promotion_cond',$system->promotion_cond);
$cxjg->fetch(\PDO::FETCH_ASSOC);
return $system;
}

function getteam($team_id,$dblj){
$sql = "select * from system_team_user where team_id = '$team_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
return $ret;
}

function getselfeventid($eid,$dblj,$para=null){
$sql = "select id from system_event_self where belong = '$eid' and module_id = '$para'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
$eventid = $ret['id'];
return $eventid;
}

function inserttask($taskid,$tnowcount,$sid,$dblj){
    // SQL 语句使用占位符来表示参数
    $sql = "INSERT INTO system_task_user (tid, tnowcount, sid, tstate) VALUES (:taskid, :tnowcount, :sid, '1')";
    
    // 准备 SQL 语句
    $stmt = $dblj->prepare($sql);
    
    // 绑定参数
    $stmt->bindParam(':taskid', $taskid);
    $stmt->bindParam(':tnowcount', $tnowcount);
    $stmt->bindParam(':sid', $sid);
    
    // 执行语句
    $stmt->execute();
}

function updatettask_state($para,$taskid,$sid,$dblj){
    $sql = "update system_task_user set tstate = '$para' where tid = '$taskid' and sid = '$sid'";
    $dblj->exec($sql);
}

function updatettask_tcount($para,$taskid,$sid,$dblj){
    $sql = "update system_task_user set tnowcount = '$para' where tid = '$taskid' and sid = '$sid'";
    $dblj->exec($sql);
}

function getglobaleventid($eid,$dblj,$para=null){
$sql = "select id from system_event where id = '$eid' and module_id = '$para'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
$eventid = $ret['id'];
return $eventid;
}

function upplayerlvl($sid,$dblj){
    //require_once 'lexical_analysis.php';
    $player = getplayer($sid,$dblj);
    $system = getsystem($dblj);
    $exp = $player->uexp;
    $upexp = $system->promotion_exp;
    $up_cond = $system->promotion_cond;
    $upexp = \lexical_analysis\process_string($upexp,$sid);
    $upexp = @eval("return $upexp;");
    $up_cond = \lexical_analysis\process_string($up_cond,$sid);
    $up_cond = @eval("return $up_cond;");
    if ($exp >= $upexp &&$up_cond){
        $sql = "update game1 set uexp = uexp - $upexp,ulvl = ulvl + 1 where sid='$sid'";
        $dblj->exec($sql);
        
        //升级事件
        $player = getplayer($sid,$dblj);
        echo "升级了，你当前等级为：{$player->ulvl}<br/>";
        return 1;
    }
    return 0;
}

function getplayer1($oid,$dblj){
    $player = new player();
    $sql="select * from game1 where uid='$oid'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('sid',$player->sid);
    $cxjg->fetch(\PDO::FETCH_ASSOC);
    $player = getplayer($player->sid,$dblj);
    return $player;
}

function getplayersession($sid,$dblj,$session_id){
    $sql="select * from user_sessions where sid='$sid' and is_active = 1";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret;
}

function getguaiwu_alive($gid,$dblj){//获取怪物
    $guaiwu = new guaiwu();
    $sql = "select * from system_npc_midguaiwu where ngid = '$gid' and nhp > 0";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        @$guaiwu->{$propertyName} = $propertyValue;
    }
    return $guaiwu;
}

function getguaiwu_all($sid,$dblj){//获取怪物
    $sql = "SELECT * from system_npc_midguaiwu where nsid = '$sid'";
    $result = $dblj->query($sql);
    $row = $result->fetchAll(\PDO::FETCH_ASSOC);
    return $row;
}

function getnpc($nid,$dblj){
    $npc = new npc();
    $sql = "select * from system_npc where nid = '$nid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $npc->{$propertyName} = $propertyValue;
    }
    return $npc;
}

function getnpc_scene($ncid,$dblj){
    $npc_scene = new npc_scene();
    $sql = "select * from system_npc_scene where ncid = '$ncid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $npc_scene->{$propertyName} = $propertyValue;
    }
    return $npc_scene;
}

function getmidguai($mid,$dblj){
    $midguai = new midguai();
    $sql = "select * from system_npc_midguaiwu where nmid = '$mid' and nhp >0";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        @$midguai->{$propertyName} = $propertyValue;
    }
    return $midguai;
}

function getskill($jid,$dblj){
    $npc = new skill();
    $sql = "select * from system_skill where jid = '$jid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        @$skill->{$propertyName} = $propertyValue;
    }
    return $skill;
}
function getskill_all($dblj){
    $sql = "select * from `system_skill`";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}
function getskill_default($dblj,$sid){
    $sql = "select * from `system_skill_user` where jdefault = 1 and jsid = '$sid' and jpid = 0";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret;
}
function getmoney_type_all($dblj,$type=null){
    if(!$type){
    $sql = "select * from `system_money_type`";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    }else{
    $sql = "select * from `system_money_type` where rid = '$type'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    }
    return $ret;
}



function getitem($iid,$dblj){
    $item = new item();
    $sql = "select * from system_item_module where iid = '$iid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $item->{$propertyName} = $propertyValue;
    }
    return $item;
}

function getownitem($item_true_id,$iid,$attr,$dblj){
$sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$item_true_id' and name = '$attr'";
$stmt = $dblj->query($sql_2);
if($stmt->rowCount() >0){
$result = $stmt->fetchColumn();
}else{
$sql = "select $attr from system_item_module where iid = '$iid'";
$cxjg = $dblj->query($sql);
if ($cxjg ->rowCount()>0) {
    $row = $cxjg->fetch(\PDO::FETCH_ASSOC);
    if ($row) {
        $result = $row[$attr];
        }
}
}
return $result;
}

function getitem_root($item_true_id,$sid,$dblj){
    $sql = "select iid from `system_item` where item_true_id = '$item_true_id' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret['iid'];
}


function getitem_user($sid,$dblj,$offset,$list_row){
    $sql = "SELECT m.*,i.item_true_id,i.icount,i.iequiped,i.isale_state FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' LIMIT $offset,$list_row";;
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $data;
}

function getitem_user_count($sid,$dblj,$offset,$list_row){
    $sql = "SELECT count(*) as total FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid'";;
    $cxjg = $dblj->query($sql);
    $countRow = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $totalRows = $countRow['total'];
    return $totalRows;
}

function getitem_true($item_true_id,$dblj){
    $item = new item();
    $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$item_true_id')";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $item->{$propertyName} = $propertyValue;
    }
    return $item;
}

function getitem_count($iid,$sid,$dblj){
    $sql = "select icount from `system_item` where iid = '$iid' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret;
}

function getitem_true_count($item_true_id,$sid,$dblj){
    $sql = "select icount from `system_item` where item_true_id = '$item_true_id' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $value = $ret['icount'];
    return $value;
}

function getstore_item_true_count($mid,$item_true_id,$sid,$dblj){
    $sql = "select icount from `system_storage` where item_true_id = '$item_true_id' and sid = '$sid' and ibelong_mid = '$mid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $value = $ret['icount'];
    return $value;
}

function getscenedropitem($mid,$dblj){
    $sql = "select * from `system_npc_drop_list` where drop_mid = '$mid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}


function getsaleitem_true_count($item_true_id,$sid,$dblj){
    $sql = "select icount from `system_item` where isale_state = 1 and item_true_id = '$item_true_id' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $value = $ret['icount'];
    return $value;
}

function getitem_sale_state($item_true_id,$sid,$dblj){
    $sql = "select isale_state from `system_item` where item_true_id = '$item_true_id' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $value = $ret['isale_state'];
    return $value;
}

function getitem_equip_state($item_true_id,$sid,$dblj){
    $sql = "select iequiped from `system_item` where item_true_id = '$item_true_id' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $value = $ret['iequiped'];
    return $value;
}

function getnpcguaiwu($nid,$dblj){
    $npcguaiwu = new npc();
    $sql = "select * from system_npc_midguaiwu where ngid = '$nid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $npcguaiwu->{$propertyName} = $propertyValue;
    }
    return $npcguaiwu;
}

function getnpcguaiwu_attr($nid,$dblj){
    $npcguaiwu = new npcguaiwu();
    $sql = "select nid,ngid,nname,nhp,nmp,nwin_event_id,ndefeat_event_id,ndrop_exp,ndrop_money,ndrop_item,ndrop_item_type,nmid from system_npc_midguaiwu where ngid = '$nid'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('nid',$npcguaiwu->nid);
    $cxjg->bindColumn('ngid',$npcguaiwu->ngid);
    $cxjg->bindColumn('nname',$npcguaiwu->nname);
    $cxjg->bindColumn('nhp',$npcguaiwu->nhp);
    $cxjg->bindColumn('nmp',$npcguaiwu->nmp);
    $cxjg->bindColumn('nwin_event_id',$npcguaiwu->nwin_event_id);
    $cxjg->bindColumn('ndefeat_event_id',$npcguaiwu->ndefeat_event_id);
    $cxjg->bindColumn('ndrop_exp',$npcguaiwu->ndrop_exp);
    $cxjg->bindColumn('ndrop_money',$npcguaiwu->ndrop_money);
    $cxjg->bindColumn('ndrop_item',$npcguaiwu->ndrop_item);
    $cxjg->bindColumn('ndrop_item_type',$npcguaiwu->ndrop_item_type);
    $cxjg->bindColumn('nmid',$npcguaiwu->nmid);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    return $npcguaiwu;
}


function getnowequiptrueid($eq_true_id,$sid,$dblj){ 
    $sql = "select eq_true_id,equiped_pos_id from system_equip_user where eqsid = '$sid' and eq_true_id = '$eq_true_id'";
    $stmt = $dblj->query($sql);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if(!is_numeric($result['equiped_pos_id'])){
        //装备位置错误文本修正
    $sql = "UPDATE system_equip_user set equiped_pos_id = (select isubtype from system_item_module where iid = (select iid from system_item where sid = '$sid' and item_true_id = '$eq_true_id')) where eqsid = '$sid' and eq_true_id = '$eq_true_id'";
    $dblj->exec($sql);
    }
    if($result['eq_true_id']){
        return 1;
    }else{
        return 0;
    }
}


function changeequipstate($sid,$dblj,$equip_root_id,$equip_id,$type){
    $equip = getitem($equip_root_id,$dblj);
    $equip_type = $equip->itype;
    $equip_subtype = $equip->isubtype;
    if($equip_type =="兵器"){
        $equip_add_gj = $equip->iattack_value;
        switch($type){
            case '1':
                $ret = changeplayerequip($sid,$dblj,$equip_add_gj,$equip_id,$equip_subtype,1);
                if($ret =='-1'){
                    return -1;
                }
                break;
            case '2':
                changeplayerequip($sid,$dblj,$equip_add_gj,$equip_id,$equip_subtype,2);
                break;
        }
    }
    elseif($equip_type =="防具"){
        $equip_add_fy = $equip->irecovery_value;
        switch($type){
            case '1':
                $ret = changeplayerequip($sid,$dblj,$equip_add_fy,$equip_id,$equip_subtype,3);
                if($ret =='-1'){
                    return -1;
                }
                break;
            case '2':
                changeplayerequip($sid,$dblj,$equip_add_fy,$equip_id,$equip_subtype,4);
                break;
        }
    }
}

function changeplayerequip($sid,$dblj,$equip_add_canshu,$equip_id,$equip_pos_id,$type){
    switch($type){
        case '1':
            // 检查是否存在符合条件的记录
            $sql = "SELECT eq_true_id FROM system_equip_user WHERE eqsid = ? AND eq_type = 1";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                // 记录已存在，获取 eq_true_id 的值
                $eq_true_id = $result['eq_true_id'];

                $equip_mosaic_link = \player\getgameconfig($dblj)->equip_mosaic_link;
                if($equip_mosaic_link ==1){
                try {
                    // 查询装备嵌套信息
                    $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute([':sid' => $sid, ':equip_id' => $eq_true_id]);
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            
                    if ($row) {
                        $diss_count = count($row);
                        $player = \player\getplayer($sid,$dblj);
                        $player_last_burthen = $player->umax_burthen - $player->uburthen;
                        $weight = 0;
                        
                        $diss_para = explode('|',$row['equip_mosaic']);
                        
                        // 计算总负重
                        foreach ($diss_para as $diss_para_id) {
                            $weight += \player\getitem($diss_para_id, $dblj)->iweight ?? 0;
                        }
                        
                        if ($player_last_burthen >= $weight && $player_last_burthen > 0) {
                            // 将装备拆卸到背包
            
                            $event_data = global_event_data_get(43,$dblj);
                            $event_cond = $event_data['system_event']['cond'];
                            $event_cmmt = $event_data['system_event']['cmmt'];
            
                            foreach ($diss_para as $diss_para_id) {
                                
                            $register_triggle = checkTriggerCondition($event_cond,$dblj,$diss_para_id,'mosaic_equip',$eq_true_id);
                            if(is_null($register_triggle)){
                                $register_triggle =1;
                            }
                        
                            if(!$register_triggle){
                            echo "拆卸失败！<br/>";
                            if($event_cmmt){
                            echo $event_cmmt.'<br/>';
                            }
                            }
                            else{
                            if(!empty($event_data['system_event']['link_evs'])){
                                $system_event_evs = $event_data["system_event_evs"];
                                foreach ($system_event_evs as $index => $event) {
                                $step_cond = $event['cond'];
                                $step_cmmt = $event['cmmt'];
                                $step_cmmt2 = $event['cmmt2'];
                                $step_s_attrs = $event['s_attrs'];
                                $step_m_attrs = $event['m_attrs'];
                                $step_triggle = checkTriggerCondition($step_cond,$dblj,$diss_para_id,'mosaic_equip',$eq_true_id);
                                if(is_null($step_triggle)){
                                $step_triggle =1;
                                    }
                                if(!$step_triggle){
                                    if($step_cmmt2){
                                    echo $step_cmmt2."<br/>";
                                    }
                                    }elseif($step_triggle){
                                    if($step_cmmt){
                                    echo $step_cmmt."<br/>";
                                    }
                                    $ret = attrsetting($step_s_attrs,$diss_para_id,'mosaic_equip',$eq_true_id);
                                    $ret = attrchanging($step_m_attrs,$diss_para_id,'mosaic_equip',$eq_true_id);
                                    }
                                }
                        
                            }
                            }
                            \player\additem($sid, $diss_para_id, 1, $dblj);
                            }
                            // 删除嵌套信息
                            $delete_sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = :sid and equip_id = :equip_id";
                            $delete_stmt = $dblj->prepare($delete_sql);
                            $delete_stmt->execute([':sid' => $sid, ':equip_id' => $eq_true_id]);
            
                        } else {
                            echo "请检测背包负重后再进行操作！<br/>";
                            return -1;
                        }
                    }
                } catch (Exception $e) {
                    echo "操作失败: " . $e->getMessage();
                }

                }
                
                
                $dblj->exec("UPDATE system_equip_user set eq_true_id = '$equip_id' where eq_true_id = '$eq_true_id' and eqsid = '$sid' and eq_type = 1");
                $sql = "select iattack_value,iname,itake_off from system_item_module where iid = (select iid from system_item where item_true_id = '$eq_true_id' and sid = '$sid')";
                $sub_tmt = $dblj->query($sql);
                $sub_result = $sub_tmt->fetch(\PDO::FETCH_ASSOC);
                $sub_value = -intval($sub_result['iattack_value']);
                $iequip_take_off = $sub_result['itake_off'];
                $equip_name = \lexical_analysis\color_string($sub_result['iname']);
                \player\addplayersx('ugj',$sub_value,$sid,$dblj);
                \player\addplayersx('ugj',$equip_add_canshu,$sid,$dblj);
                $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$eq_true_id' and sid = '$sid'");
                echo "你卸下了{$equip_name}<br/>";
                $mosaic_list = \player\get_player_equip_mosaic_once($eq_true_id,$sid,$dblj)['equip_mosaic'];
                if($mosaic_list){
                    $mosaic_ones = explode("|",$mosaic_list);
                    foreach ($mosaic_ones as $mosaic_one){
                    $iembed_off = \player\getitem($mosaic_one,$dblj)->iembed_off;
                    if($iembed_off !=0){
                    \player\exec_self_event($iembed_off,'item_module',$mosaic_one,$sid,$dblj);
                    }
                    \player\exec_global_event(43,'item_module',$mosaic_one,$sid,$dblj);
                    }
                }
                
                \player\exec_global_event(41,'item',$eq_true_id,$sid,$dblj);//卸装事件
                if($iequip_take_off !=0){
                \player\exec_self_event($iequip_take_off,'item',$eq_true_id,$sid,$dblj);
                }
            } else {
                // 记录不存在，插入新记录
                $sql = "INSERT INTO system_equip_user (eqsid, eq_true_id, eq_type, equiped_pos_id) VALUES (?, ?, 1, ?)";
                $stmt = $dblj->prepare($sql);
                $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
                $stmt->bindParam(2, $equip_id, \PDO::PARAM_INT);
                $stmt->bindParam(3, $equip_pos_id, \PDO::PARAM_INT);
                
                if ($stmt->execute()) {
                    // 插入成功，获取新插入记录的 eq_true_id
                $eq_root_id = $dblj->lastInsertId();
                \player\addplayersx('ugj',$equip_add_canshu,$sid,$dblj);
                } else {
                    // 插入失败，进行错误处理
                    echo "装备失败!<br/>";
                }
            }
        break;
        case '2':
            $sql = "SELECT eq_true_id FROM system_equip_user WHERE eqsid = ? AND eq_type = 1";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                // 记录已存在，获取 eq_true_id 的值
                $eq_true_id = $result['eq_true_id'];
                $sql = "select iattack_value from system_item_module where iid = (select iid from system_item where item_true_id = '$eq_true_id' and sid = '$sid')";
                $sub_tmt = $dblj->query($sql);
                $sub_result = $sub_tmt->fetch(\PDO::FETCH_ASSOC);
                $sub_value = -intval($sub_result['iattack_value']);
                
                \player\addplayersx('ugj',$sub_value,$sid,$dblj);

                $dblj->exec("delete from system_equip_user where eqsid = '$sid' AND eq_type = 1");
            } else {
                echo "非法操作！<br/>";
            }
        break;
        case '3':
            $sql = "SELECT eq_true_id FROM system_equip_user WHERE eqsid = ? AND eq_type = 2 and equiped_pos_id = '$equip_pos_id'";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                // 记录已存在，获取 eq_true_id 的值
                $eq_true_id = $result['eq_true_id'];
                
                
                $equip_mosaic_link = \player\getgameconfig($dblj)->equip_mosaic_link;
                if($equip_mosaic_link ==1){
                try {
                    // 查询装备嵌套信息
                    $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute([':sid' => $sid, ':equip_id' => $eq_true_id]);
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            
                    if ($row) {
                        $diss_count = count($row);
                        $player = \player\getplayer($sid,$dblj);
                        $player_last_burthen = $player->umax_burthen - $player->uburthen;
                        $weight = 0;
                        
                        $diss_para = explode('|',$row['equip_mosaic']);
                        
                        // 计算总负重
                        foreach ($diss_para as $diss_para_id) {
                            $weight += \player\getitem($diss_para_id, $dblj)->iweight ?? 0;
                        }
                        
                        if ($player_last_burthen >= $weight && $player_last_burthen > 0) {
                            // 将装备拆卸到背包
            
                            $event_data = global_event_data_get(43,$dblj);
                            $event_cond = $event_data['system_event']['cond'];
                            $event_cmmt = $event_data['system_event']['cmmt'];
            
                            foreach ($diss_para as $diss_para_id) {
                                
                            $register_triggle = checkTriggerCondition($event_cond,$dblj,$diss_para_id,'mosaic_equip',$eq_true_id);
                            if(is_null($register_triggle)){
                                $register_triggle =1;
                            }
                        
                            if(!$register_triggle){
                            echo "拆卸失败！<br/>";
                            if($event_cmmt){
                            echo $event_cmmt.'<br/>';
                            }
                            }
                            else{
                            if(!empty($event_data['system_event']['link_evs'])){
                                $system_event_evs = $event_data["system_event_evs"];
                                foreach ($system_event_evs as $index => $event) {
                                $step_cond = $event['cond'];
                                $step_cmmt = $event['cmmt'];
                                $step_cmmt2 = $event['cmmt2'];
                                $step_s_attrs = $event['s_attrs'];
                                $step_m_attrs = $event['m_attrs'];
                                $step_triggle = checkTriggerCondition($step_cond,$dblj,$diss_para_id,'mosaic_equip',$eq_true_id);
                                if(is_null($step_triggle)){
                                $step_triggle =1;
                                    }
                                if(!$step_triggle){
                                    if($step_cmmt2){
                                    echo $step_cmmt2."<br/>";
                                    }
                                    }elseif($step_triggle){
                                    if($step_cmmt){
                                    echo $step_cmmt."<br/>";
                                    }
                                    $ret = attrsetting($step_s_attrs,$diss_para_id,'mosaic_equip',$eq_true_id);
                                    $ret = attrchanging($step_m_attrs,$diss_para_id,'mosaic_equip',$eq_true_id);
                                    }
                                }
                        
                            }
                            }
                            \player\additem($sid, $diss_para_id, 1, $dblj);
                            }
                            // 删除嵌套信息
                            $delete_sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = :sid and equip_id = :equip_id";
                            $delete_stmt = $dblj->prepare($delete_sql);
                            $delete_stmt->execute([':sid' => $sid, ':equip_id' => $eq_true_id]);
            
                        } else {
                            echo "请检测背包负重后再进行操作！<br/>";
                            return -1;
                        }
                    }
                } catch (Exception $e) {
                    echo "操作失败: " . $e->getMessage();
                }

                }
                
                
                $dblj->exec("UPDATE system_equip_user set eq_true_id = '$equip_id' where eq_true_id = '$eq_true_id' and eqsid = '$sid' and eq_type = 2");
                $sql = "select irecovery_value,iname,itake_off from system_item_module where iid = (select iid from system_item where item_true_id = '$eq_true_id' and sid = '$sid')";
                $sub_tmt = $dblj->query($sql);
                $sub_result = $sub_tmt->fetch(\PDO::FETCH_ASSOC);
                $sub_value = -intval($sub_result['irecovery_value']);
                $iequip_take_off = $sub_result['itake_off'];
                $equip_name = \lexical_analysis\color_string($sub_result['iname']);
                \player\addplayersx('ufy',$sub_value,$sid,$dblj);
                \player\addplayersx('ufy',$equip_add_canshu,$sid,$dblj);
                $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$eq_true_id' and sid = '$sid'");
                echo "你卸下了{$equip_name}<br/>";
                $mosaic_list = \player\get_player_equip_mosaic_once($eq_true_id,$sid,$dblj)['equip_mosaic'];
                if($mosaic_list){
                    $mosaic_ones = explode("|",$mosaic_list);
                    foreach ($mosaic_ones as $mosaic_one){
                    $iembed_off = \player\getitem($mosaic_one,$dblj)->iembed_off;
                    if($iembed_off !=0){
                    \player\exec_self_event($iembed_off,'item_module',$mosaic_one,$sid,$dblj);
                    }
                    \player\exec_global_event(43,'item_module',$mosaic_one,$sid,$dblj);
                    }
                }
                
                \player\exec_global_event(41,'item',$eq_true_id,$sid,$dblj);//卸装事件
                if($iequip_take_off !=0){
                \player\exec_self_event($iequip_take_off,'item',$eq_true_id,$sid,$dblj);
                }
            } else {
                // 记录不存在，插入新记录
                $sql = "INSERT INTO system_equip_user (eqsid, eq_true_id, eq_type, equiped_pos_id) VALUES (?, ?, 2, ?)";
                $stmt = $dblj->prepare($sql);
                $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
                $stmt->bindParam(2, $equip_id, \PDO::PARAM_INT);
                $stmt->bindParam(3, $equip_pos_id, \PDO::PARAM_INT);
                 
                if ($stmt->execute()) {
                    // 插入成功，获取新插入记录的 eq_true_id
                    $eq_root_id = $dblj->lastInsertId();
                    \player\addplayersx('ufy',$equip_add_canshu,$sid,$dblj);
                } else {
                    // 插入失败，进行错误处理
                    echo "装备失败!<br/>";
                }
            }
        break;
        case '4':
            $sql = "SELECT eq_true_id FROM system_equip_user WHERE eqsid = ? AND eq_type = 2 and equiped_pos_id = '$equip_pos_id'";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                // 记录已存在，获取 eq_true_id 的值
                $eq_true_id = $result['eq_true_id'];
                $sql = "select irecovery_value from system_item_module where iid = (select iid from system_item where item_true_id = '$eq_true_id' and sid = '$sid')";
                $sub_tmt = $dblj->query($sql);
                $sub_result = $sub_tmt->fetch(\PDO::FETCH_ASSOC);
                $sub_value = -intval($sub_result['irecovery_value']);
                \player\addplayersx('ufy',$sub_value,$sid,$dblj);
                $dblj->exec("delete from system_equip_user where eqsid = '$sid' AND eq_type = 2 and equiped_pos_id = '$equip_pos_id'");
            } else {
                echo "非法操作！<br/>";
            }
        break;
}
}

function additem($sid,$iid,$icount,$dblj){
    //在这个函数加入任务物品的增减变化检测判断
    $player = getplayer($sid,$dblj);
    $item_para = getitem($iid,$dblj);
    $item_type = $item_para->itype;
    $iweight = $item_para->iweight;
    $ino_give = $item_para->ino_give;
    $ino_out = $item_para->ino_out;
    $icreat_event_id = $item_para->icreat_event_id;
    $itotal_weight = $icount*$iweight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    if($player_last_burthen >=$itotal_weight && $player_last_burthen>0){
    $sql = "select item_true_id from system_item where sid='$sid' and iid = '$iid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    if ($ret['item_true_id']){
        $item_true_id = -2;
        if($item_type !="兵器"&&$item_type !="防具"){
        $sql = "update system_item set icount = icount + $icount where sid='$sid' and iid = '$iid'";
        $dblj->exec($sql);
        // exec_global_event(37,'item',$ret['item_true_id'],$sid,$dblj);
        }elseif($item_type =="兵器"||$item_type =="防具"){
        for($i=0;$i<$icount;$i++){
        $sql = "insert into system_item(icount,sid,uid,iid,ino_give,ino_out) VALUES (1,'$sid','$player->uid','$iid','$ino_give','$ino_out')";
        $dblj->exec($sql);
        $item_true_id = $dblj->lastInsertId();
        exec_global_event(37,'item',$item_true_id,$sid,$dblj);
        if($icreat_event_id>0){
        exec_self_event($icreat_event_id,'item',$item_true_id,$sid,$dblj);
        }
            }
        }
    }
    else{
        if($item_type !="兵器"&&$item_type !="防具"){
        $sql = "insert into system_item(icount,sid,uid,iid,ino_give,ino_out) VALUES ('$icount','$sid','$player->uid','$iid','$ino_give','$ino_out')";
        $dblj->exec($sql);
        // 获取自增ID
        $item_true_id = $dblj->lastInsertId();
        // exec_global_event(37,'item',$item_true_id,$sid,$dblj);
        
        // if($icreat_event_id>0){
        
        
        // }
        
        }elseif($item_type =="兵器"||$item_type =="防具"){
        for($i=0;$i<$icount;$i++){
        $sql = "insert into system_item(icount,sid,uid,iid,ino_give,ino_out) VALUES (1,'$sid','$player->uid','$iid','$ino_give','$ino_out')";
        $dblj->exec($sql);
        $item_true_id = $dblj->lastInsertId();
        exec_global_event(37,'item',$item_true_id,$sid,$dblj);
        if($icreat_event_id>0){
        exec_self_event($icreat_event_id,'item',$item_true_id,$sid,$dblj);
        }
            }
        }
    }
        \player\addplayersx('uburthen',$itotal_weight,$sid,$dblj);
        return $item_true_id;
}
    else{
        echo "你已经无法再装下任何东西了！<br/>";
        return -1;
    }
}

function changeitem_ower($sid,$oid,$item_true_id,$dblj){
    $oplayer_uid = getplayer($oid,$dblj)->uid;
    $cxjg = $dblj->exec("update system_item set sid = '$oid',uid = '$oplayer_uid' where sid = '$sid' and item_true_id = '$item_true_id'");
    if($cxjg){
        return 1;
    }else{
        return 0;
    }
}

function getsceneitem_state($mid,$iid,$dblj){
    $check_para = $iid."|";
    $sql = "select mitem_now from system_map where mid = '$mid' AND (mitem_now LIKE '%$check_para%' OR mitem_now LIKE '%,$check_para%' OR mitem_now LIKE '%$check_para,%')";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $mitem_now = $ret['mitem_now'];
    if ($ret){
        // 使用正则表达式匹配对应的值
        $pattern = "/$iid\|(\d+)/";
        preg_match($pattern, $mitem_now, $matches);
        return $matches[1];
    }else{
        return -1;
    }
}

function getscenedropitem_state($mid,$drop_id,$sid,$iid,$dblj){
    $check_para = $iid."|";
    $sql = "select drop_item_data,drop_time,drop_player_sid from system_npc_drop_list where drop_mid = '$mid' AND drop_id = '$drop_id' AND (drop_item_data LIKE '%$check_para%' OR drop_item_data LIKE '%,$check_para%' OR drop_item_data LIKE '%$check_para,%')";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $mitem_now = $ret['drop_item_data'];
    if ($ret){
        $drop_time = $ret['drop_time'];
        $nowtime = new \DateTime(); // 获取当前时间
        $drop_time_obj = new \DateTime($drop_time); // 将 'Y-m-d H:i:s' 字符串转换为 DateTime 对象
        $drop_disappear_time = \player\getgameconfig($dblj)->drop_disappear_time;
        // 计算时间差（秒）
        $interval = $nowtime->getTimestamp() - $drop_time_obj->getTimestamp();
        if($interval < $drop_disappear_time){
        $drop_protect_time = \player\getgameconfig($dblj)->drop_protect_time;
        
        if($interval < $drop_protect_time){
        $drop_sid = $ret['drop_player_sid'];
        
        if($sid ==$drop_sid){
        // 使用正则表达式匹配对应的值
        $pattern = "/$iid\|(\d+)/";
        preg_match($pattern, $mitem_now, $matches);
        return $matches[1];
        }else{
            return -2;
        }
        
        }else{
        // 使用正则表达式匹配对应的值
        $pattern = "/$iid\|(\d+)/";
        preg_match($pattern, $mitem_now, $matches);
        return $matches[1];
        }
        
        }else{
            return -1;
        }
}
else{
    return 0;
}
}


function getsceneitem($sid,$iid,$mid,$iname,$icount,$dblj){
    $player = getplayer($sid,$dblj);
    $get_item_iweight = getitem($iid,$dblj)->iweight;
    $get_item_total_weight = $icount * $get_item_iweight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    if($player_last_burthen >=$get_item_total_weight && $player_last_burthen>0){
        echo "你捡起了:{$iname}x{$icount}<br/>";
        \player\additem($sid,$iid,$icount,$dblj);
        \player\removesceneitem($mid,$iid,$icount,null,$dblj,1);
    }elseif($player_last_burthen >0 &&$player_last_burthen < $get_item_total_weight){
        $maxpick = floor(($player_last_burthen)/($get_item_iweight));
        if($maxpick>0){
        $least_pick = $icount - $maxpick;
        echo "你捡起了:{$iname}x{$maxpick}";
        \player\additem($sid,$iid,$maxpick,$dblj);
        \player\removesceneitem($mid,$iid,$icount,$least_pick,$dblj,2);
        }else{
        echo "你已经无法再装下任何{$iname}了！<br/>";
        }
    }else{
        echo "你已经无法再装下任何{$iname}了！<br/>";
    }
}

function getscenedropitem_action($drop_id,$sid,$iid,$mid,$iname,$icount,$dblj){
    $player = getplayer($sid,$dblj);
    $get_item_iweight = getitem($iid,$dblj)->iweight;
    $get_item_total_weight = $icount * $get_item_iweight;
    $player_last_burthen = $player->umax_burthen - $player->uburthen;
    if($player_last_burthen >=$get_item_total_weight && $player_last_burthen>0){
        echo "你捡起了:{$iname}x{$icount}<br/>";
        \player\additem($sid,$iid,$icount,$dblj);
        \player\removescenedropitem($drop_id,$mid,$iid,$icount,null,$dblj,1);
    }elseif($player_last_burthen >0 &&$player_last_burthen < $get_item_total_weight){
        $maxpick = floor(($player_last_burthen)/($get_item_iweight));
        if($maxpick>0){
        $least_pick = $icount - $maxpick;
        echo "你捡起了:{$iname}x{$maxpick}";
        \player\additem($sid,$iid,$maxpick,$dblj);
        \player\removescenedropitem($drop_id,$mid,$iid,$icount,$least_pick,$dblj,2);
        }else{
        echo "你已经无法再装下任何{$iname}了！<br/>";
        }
    }else{
        echo "你已经无法再装下任何{$iname}了！<br/>";
    }
}

function removesceneitem($mid,$iid,$icount,$maxpick=null,$dblj,$para=null){
    if($para ==1){
    $string = $iid."|"."$icount";
    $sql = "UPDATE system_map SET mitem_now = REPLACE(mitem_now, ',$string', ''),mitem_now = REPLACE(mitem_now, '$string,', ''),mitem_now = REPLACE(mitem_now, '$string', '') WHERE mitem_now LIKE '%,$string%' OR mitem_now LIKE '%$string,%' OR mitem_now = '$string' and mid = '$mid';";
    }elseif($para ==2){
    $old_string = $iid."|"."$icount";
    $new_string = $iid."|"."$maxpick";
    $sql = "UPDATE system_map SET mitem_now = REPLACE(mitem_now, '$old_string', '$new_string') WHERE mitem_now LIKE '%$old_string%';";
    }
    $dblj->exec($sql);
    
}

function removescenedropitem($drop_id,$mid,$iid,$icount,$maxpick=null,$dblj,$para=null){
    if($para ==1){
    $string = $iid."|"."$icount";
    $sql = "UPDATE system_npc_drop_list SET drop_item_data = REPLACE(drop_item_data, ',$string', ''),drop_item_data = REPLACE(drop_item_data, '$string,', ''),drop_item_data = REPLACE(drop_item_data, '$string', '') WHERE drop_item_data LIKE '%,$string%' OR drop_item_data LIKE '%$string,%' OR drop_item_data = '$string' and drop_mid = '$mid' and drop_id = '$drop_id';";
    }elseif($para ==2){
    $old_string = $iid."|"."$icount";
    $new_string = $iid."|"."$maxpick";
    $sql = "UPDATE system_npc_drop_list SET drop_item_data = REPLACE(drop_item_data, '$old_string', '$new_string') WHERE drop_item_data LIKE '%$old_string%' and drop_id = '$drop_id';";
    }
    $dblj->exec($sql);
    
}


function getgm_attr(){
    
}


function useitem($sid,$iid,$icount,$dblj){
    $player = getplayer($sid,$dblj);
    $sql = "select * from system_item_module where iid = '$iid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $use_attr = $ret['iuse_attr'];
    $u_attr = "u".$use_attr;
    $use_value = $ret['iuse_value'];
    $attr_name = \gm\get_gm_attr_info(1,$use_attr,$dblj)['name'];
    if($use_value >0){
    $cmmt = $attr_name." + ".$use_value."<br/>";
    \player\addplayersx($u_attr,$use_value,$sid,$dblj);
    }elseif($use_value<0){
    $cmmt = $attr_name." - ".$use_value."<br/>";
    \player\addplayersx($u_attr,$use_value,$sid,$dblj);
    }else{
    $cmmt = "没有产生任何效果！<br/>";
    }
    return $cmmt;
}


function getplayeritem_attr($attr,$sid,$iid,$dblj){
    $sql = "select $attr from system_item where iid = '$iid' AND sid='$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    if ($ret){
        return $ret;
    }else{
        return false;
    }

}

function changeplayersx($sx,$gaibian,$sid,$dblj){
    $current = $dblj->query("SELECT $sx FROM game1 WHERE sid = '$sid'")->fetchColumn();
    if ($current != $gaibian) {
        $dblj->exec("UPDATE game1 SET $sx = '$gaibian' WHERE sid = '$sid'");
        return true; // 实际更新
    }
        return false; // 跳过更新
}

function changeplayertable($db,$sx,$gaibian,$sid,$dblj){
    $current = $dblj->query("SELECT $sx FROM `$db` WHERE sid = '$sid'")->fetchColumn();
    if ($current != $gaibian) {
        $dblj->exec("UPDATE `$db` SET $sx = '$gaibian' WHERE sid = '$sid'");
        return true; // 实际更新
    }
        return false; // 跳过更新
}

function addplayertable($db,$sx,$gaibian,$sid,$dblj){
    if($gaibian!=0){
    $sql = "update `$db` set $sx = $sx + '$gaibian' WHERE sid='$sid'";//增减玩家任意表属性
    $dblj->exec($sql);
    return true;
    }
    return false;
}

function addmonstertable($sx,$gaibian,$gid,$dblj){
    if($gaibian!=0){
    $sql = "update `system_npc_midguaiwu` set $sx = $sx + '$gaibian' WHERE ngid='$gid'";//增减怪物表属性
    $dblj->exec($sql);
    return true;
    }
    return false;
}
function addpettable($sx,$gaibian,$gid,$dblj){
    if($gaibian!=0){
    $sql = "update `system_pet_scene` set $sx = $sx + '$gaibian' WHERE npid='$gid'";//增减宠物表表属性
    $dblj->exec($sql);
    return true;
    }
    return false;
}

function changepetsx($sx,$gaibian,$petid,$sid,$dblj){
    $current = $dblj->query("SELECT $sx FROM `system_pet_player` WHERE petid='$petid' and sid = '$sid'")->fetchColumn();
    if ($current != $gaibian) {
        $dblj->exec("update system_pet_player set $sx = '$gaibian' WHERE petid='$petid' and petsid = '$sid'");
        return true; // 实际更新
    }
        return false; // 跳过更新
}

function addcwsx($sx,$gaibian,$petid,$sid,$dblj){
    $sql = "update system_pet_player set $sx = $sx + '$gaibian' WHERE petid='$petid' and petsid = '$sid'";//增加cw属性
    $ret = $dblj->exec($sql);
}

bcscale(0);

function safebc_check($value) {
    // 更严格地检查值是否为有效的数字或数字字符串
    // 去除空格并处理可能的null值
    if ($value === null) {
        return '0';
    }
    
    // 如果是数组或对象，返回0
    if (is_array($value) || is_object($value)) {
        return '0';
    }
    
    // 处理字符串值，清除任何可能导致BCMath出错的字符
    if (is_string($value)) {
        // 去除所有非数字、小数点和符号字符
        $value = trim($value);
        // 检查是否为数字格式字符串
        if (preg_match('/^[-+]?[0-9]*\.?[0-9]+$/', $value)) {
            return (string)$value;
        }
        return '0';
    }
    
    // 如果是数字类型，直接转换成字符串返回
    if (is_numeric($value)) {
        return (string)$value;
    }
    
    // 默认返回0
    return '0';
}

function safebc_add($left, $right) {
    $left = safebc_check($left);
    $right = safebc_check($right);
    return bcadd($left, $right, 0);
}

function safebc_mul($left, $right) {
    $left = safebc_check($left);
    $right = safebc_check($right);
    return bcmul($left, $right, 0);
}

// 新增一个安全的bccomp函数封装
function safebc_comp($left, $right, $scale = 0) {
    $left = safebc_check($left);
    $right = safebc_check($right);
    return bccomp($left, $right, $scale);
}

// 新增一个安全的bcsub函数封装
function safebc_sub($left, $right, $scale = 0) {
    $left = safebc_check($left);
    $right = safebc_check($right);
    return bcsub($left, $right, $scale);
}



function addplayersx($sx,$gaibian,$sid,$dblj,$db=null){
    // 检查数据库连接
    if($db) {
        $player = getplayer_db($sid, $db);
    } else {
        $player = getplayer($sid, $dblj);
    }
    
    switch($sx){
        case 'uhp':
            $umaxhp = $player->umaxhp;
            $uhp = $player->uhp;
            
            // 使用BCMath确保精确计算
            $gaibian = safebc_check($gaibian);
            $uhp = safebc_check($uhp);
            $umaxhp = safebc_check($umaxhp);
            
            // 在PHP中计算新值
            $new_hp = safebc_add($uhp, $gaibian);
            
            // 检查是否超过最大值
            if(safebc_comp($new_hp, $umaxhp) > 0) {
                $new_hp = $umaxhp;
            }
            
            // 构建安全的SQL，直接设置新值而不是让数据库进行计算
            $sql = "UPDATE game1 SET uhp = ? WHERE sid = ?";
            
            if(!$db) {
                $stmt = $dblj->prepare($sql);
                $stmt->execute([$new_hp, $sid]);
                $ret = $stmt->rowCount();
            } else {
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ss', $new_hp, $sid);
                $stmt->execute();
                $ret = $stmt->affected_rows;
            }
            break;
            
        case 'ump':
            $umaxmp = $player->umaxmp;
            $ump = $player->ump;
            
            // 使用BCMath确保精确计算
            $gaibian = safebc_check($gaibian);
            $ump = safebc_check($ump);
            $umaxmp = safebc_check($umaxmp);
            
            // 在PHP中计算新值
            $new_mp = safebc_add($ump, $gaibian);
            
            // 检查是否超过最大值
            if(safebc_comp($new_mp, $umaxmp) > 0) {
                $new_mp = $umaxmp;
            }
            
            // 构建安全的SQL，直接设置新值而不是让数据库进行计算
            $sql = "UPDATE game1 SET ump = ? WHERE sid = ?";
            
            if(!$db) {
                $stmt = $dblj->prepare($sql);
                $stmt->execute([$new_mp, $sid]);
                $ret = $stmt->rowCount();
            } else {
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ss', $new_mp, $sid);
                $stmt->execute();
                $ret = $stmt->affected_rows;
            }
            break;
            
        default:
            // 获取当前属性值
            $current_value = safebc_check($player->$sx ?? '0');
            $gaibian = safebc_check($gaibian);
            
            // 在PHP中计算新值
            $new_value = safebc_add($current_value, $gaibian);
            
            // 构建安全的SQL，直接设置新值而不是让数据库进行计算
            $sql = "UPDATE game1 SET $sx = ? WHERE sid = ?";
            
            if(!$db) {
                $stmt = $dblj->prepare($sql);
                $stmt->execute([$new_value, $sid]);
                $ret = $stmt->rowCount();
            } else {
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ss', $new_value, $sid);
                $stmt->execute();
                $ret = $stmt->affected_rows;
            }
            break;
    }
    
    if($ret){
        return true;
    }else{
        return false;
    }
}

function addpetsx($sx,$gaibian,$sid,$pet_id,$dblj,$db=null){
    switch($sx){
        case 'nhp':
            $nmaxhp = getpet_once($sid,$dblj,$pet_id)['nmaxhp'];
            $nhp = getpet_once($sid,$dblj,$pet_id)['nhp'];
            if(($gaibian + $nhp) >$nmaxhp){
            $sql = "update system_pet_scene set nhp = $umaxhp WHERE sid='$sid'";//增加cw属性
            }else{
            $sql = "update system_pet_scene set nhp = nhp + '$gaibian' WHERE sid='$sid'";//增加cw属性
            }
            break;
        case 'nmp':
            $nmaxmp = getpet_once($sid,$dblj,$pet_id)['nmaxmp'];
            $nmp = getpet_once($sid,$dblj,$pet_id)['nmp'];
            if(($gaibian + $nmp) >$nmaxmp){
            $sql = "update system_pet_scene set nmp = $nmaxmp WHERE npid='$pet_id'";//增加cw属性
            }else{
            $sql = "update system_pet_scene set nmp = nmp + '$gaibian' WHERE npid='$pet_id'";//增加cw属性
            }
            break;
        default:
            $sql = "update system_pet_scene set $sx = $sx + '$gaibian' WHERE npid='$pet_id'";//增加cw属性
            break;
    }
    if(!$db){
    $ret = $dblj->exec($sql);
    }else{
    $ret = $db->query($sql);
    }
    if($ret){
        return true;
    }else{
        return false;
    }
}


function changeplayeritem($item_true_id,$gaibian,$sid,$dblj){
    if($gaibian !="all"){

        $gaibian_str = strval($gaibian);
        

        $curr = $dblj->query("select CAST(icount AS CHAR) as icount from system_item WHERE sid='$sid' and item_true_id = '$item_true_id';");
        $curr_ret = $curr->fetch(\PDO::FETCH_ASSOC);
        $curr_count = isset($curr_ret['icount']) ? $curr_ret['icount'] : '0';
        

        $new_count = bcadd($curr_count, $gaibian_str, 0);
        
        $sql = "update system_item set icount = '$new_count' WHERE sid='$sid' and item_true_id = '$item_true_id'";
        $out_count = $gaibian_str;
    }elseif($gaibian =="all"){
        $out = $dblj->query("select CAST(icount AS CHAR) as icount from system_item WHERE sid='$sid' and item_true_id = '$item_true_id';");
        $out_ret = $out->fetch(\PDO::FETCH_ASSOC);

        $out_count = isset($out_ret['icount']) ? bcmul($out_ret['icount'], '-1', 0) : '0';
        $sql = "delete from system_item WHERE sid='$sid' and item_true_id = '$item_true_id'";
    }
    $ret = $dblj->exec($sql);
    $nowcount = $dblj->query("select CAST(icount AS CHAR) as icount from system_item WHERE sid='$sid' and item_true_id = '$item_true_id';");
    $now_ret = $nowcount->fetch(\PDO::FETCH_ASSOC);
    $now_count = isset($now_ret['icount']) ? $now_ret['icount'] : '0';
    

    if($now_ret && bccomp($now_count, '0', 0) <= 0){
        $sql = "delete from system_item WHERE sid='$sid' and item_true_id = '$item_true_id'";
        $ret = $dblj->exec($sql);
        $sql = "delete from system_addition_attr WHERE oid='item' and mid = '$item_true_id'";
        $ret = $dblj->exec($sql);
    }
    if($ret){
        return $out_count;
    }else{
        return false;
    }
}

function changeitem_belong($item_true_id,$root_type,$root_id,$dblj){
    $root_para = $root_type."|".$root_id;
    $sql = "update system_item set iroot = '$root_para' WHERE item_true_id='$item_true_id'";
    $ret = $dblj->exec($sql);
}


function changetask1($ttype,$troot_id,$rwtarget_id,$change,$sid,$dblj){
    if ($ttype == 1){

        // 获取当前 tnowcount 值
        $stmt = $dblj->query("SELECT tnowcount FROM system_task_user WHERE sid = '$sid' AND tid = '$troot_id' AND tstate = 1");
        $tnowcount = $stmt->fetchColumn();
        // 对获取的 tnowcount 进行处理
        $new_tnowcount = '';
        $entries = explode(',', $tnowcount);
        
        foreach ($entries as $entry) {
            list($id, $value) = explode('|', $entry);
        
            // 根据条件更新值
            if ($id == $rwtarget_id) {
                $value += $change;
            }
        
            // 拼接更新后的字符串
            $new_tnowcount .= $id . '|' . $value . ',';
        }
        
        // 去掉末尾的逗号
        $new_tnowcount = rtrim($new_tnowcount, ',');
        // 更新数据表
        $stmt = $dblj->prepare("UPDATE system_task_user SET tnowcount = :new_tnowcount WHERE sid = '$sid' AND tid = '$troot_id' AND tstate = 1");
        $stmt->bindParam(':new_tnowcount', $new_tnowcount);
        $stmt->execute();

    }elseif($ttype == 2){
        $item_count = getitem_count($rwtarget_id,$sid,$dblj)->icount;
        $sql = "update system_task_user set tnowcount = $item_count WHERE sid = '$sid' AND tid = '$troot_id' AND tstate = 1";
        $rwt = $dblj->exec($sql);
    }
}


function getplayertaskinfo($dblj, $tid, $tnowcount,$tstate) {
    $sql = "select * from system_task where tid = '$tid'";
    $cxjg = $dblj->query($sql);
    $task = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    
    // 将 tnowcount 添加到 $task[0] 中
    $task[0]['tnowcount'] = $tnowcount;
    $task[0]['tstate'] = $tstate;
    return $task;
}

function getplayertask($sid,$dblj,$taskid=null){
    if(is_null($taskid)){
    $sql = "select * from system_task_user WHERE sid='$sid'";
    }else{
    $sql = "select * from system_task_user WHERE sid='$sid' and tid='$taskid'";
    }
    $cxjg = $dblj->query($sql);
    $task = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    $task_count = count($task);
    for($i=0;$i<$task_count;$i++){
        $tid = $task[$i]['tid'];
        $tstate = $task[$i]['tstate'];
        $tnowcount = $task[$i]['tnowcount'];
        if ($tstate == 1) {
            $taskInfo = getplayertaskinfo($dblj, $tid, $tnowcount,$tstate);
            $allTasks[] = $taskInfo[0];
        }
    }
    return $allTasks;
}

function update_task($sid,$dblj,$drop_id=null,$monster_id=null,$monster_name=null){

$taskarr = getplayertask($sid,$dblj);//任务相关
if($taskarr){
$taskarr_count = @count($taskarr);
}
if($drop_id){
for ($l=0;$l<$taskarr_count;$l++){
    $rwtype = $taskarr[$l]['ttype'];
    $rw_paras = explode(',',$taskarr[$l]['ttarget_obj']);
    $rw_check_count = @count($rw_paras);
    $rw_check_done = 0;
    for($i=0;$i<$rw_check_count;$i++){
    $rw_para = explode('|',$rw_paras[$i]);
    $rwtarget_id = $rw_para[0];
    $rwcount = $rw_para[1];
    //$rwid = $taskarr[$l]['tid'];
    $rwzt = $taskarr[$l]['tstate'];
    if ($rwtarget_id==$drop_id && $rwtype==2 && $rwzt!=2){
        $rw_obj_name = getitem($rwtarget_id,$dblj)->iname;
        $rw_obj_name = \lexical_analysis\color_string($rw_obj_name);
        $rwnowcount = getitem_count($rwtarget_id,$sid,$dblj)['icount'];
        $rwts .= "任务：".$taskarr[$l]['tname']."<br/>{$rw_obj_name}".'('.$rwnowcount."/".$rwcount.')<br/>';
        break;
    }
    }
}
}
if($monster_id){
for ($k=0;$k<$taskarr_count;$k++){
    $rwnpc_id = $taskarr[$k]['tnpc_id'];
    $rwtype = $taskarr[$k]['ttype'];
    $rwid = $taskarr[$k]['tid'];
    $rwret = getplayertaskonce($sid,$rwid,$dblj);
    $rwstate = $rwret[0]['tstate'];
    $rwzt = $taskarr[$k]['tstate'];
    
    $rw_paras = explode(',',$taskarr[$k]['ttarget_obj']);
    for($i=0;$i<@count($rw_paras);$i++){
    $rw_para = explode('|',$rw_paras[$i]);
    $rwtarget_id = $rw_para[0];
    $rwcount = $rw_para[1];
    
    
    if ($rwtarget_id==$monster_id && $rwtype==1 && $rwstate!=2){
        \player\changetask1($rwtype,$rwid,$rwtarget_id,1,$sid,$dblj);
        $rwnowparas = explode(',',$taskarr[$k]['tnowcount']);
        $rwnowcount = explode('|',$rwnowparas[$i])[1] + 1;
        $rwts .= "任务：".$taskarr[$k]['tname']."<br/>{$monster_name}".'('.$rwnowcount."/".$rwcount.')<br/>';
        break;
    }
    }
}
}

return $rwts;
}


function gettask($tid,$dblj){
    $task = new task();
    $sql = "select * from system_task where tid = '$tid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $task->{$propertyName} = $propertyValue;
    }
    return $task;
}
function getplayertaskonce($sid,$tid,$dblj){
    $sql = "select * from system_task_user where tid = '$tid' and sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $task = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $task;
}

function scene_task_show($taskid,$npc_id,$sid,$dblj){
    $nowrw = gettask($taskid,$dblj);
    $rwret = getplayertaskonce($sid,$taskid,$dblj);
    $rwnowcount = $rwret[0]['tnowcount'];
    $rwstate = $rwret[0]['tstate'];
    $rw_cond = $nowrw->tcond;
    $rw_type = $nowrw->ttype;
    $rw_npc_id = $nowrw->tnpc_id;
    $rw_trigger_cond = checkTriggerCondition($rw_cond,$dblj,$sid);
    //这里加入是否可放弃的判定
    if(is_null($rw_trigger_cond)){
    $rw_trigger_cond = true;
    }
    if($rw_trigger_cond){
    $rw_paras = explode(',',$nowrw->ttarget_obj);
    $rw_player_paras = explode(',',$rwnowcount);
    $rw_check_count = @count($rw_paras);
    $rw_check_done = 0;
    
    for($i=0;$i<$rw_check_count;$i++){
    $rw_para = explode('|',$rw_paras[$i]);
    $rwtarget_id = $rw_para[0];
    $rwcount = $rw_para[1];
    
    if($rw_type ==2&&$rwstate ==1){
    $rwnowcount = \player\getitem_count($rwtarget_id,$sid,$dblj)['icount'];
    }
    if($rw_type ==1&&$rwstate ==1){
    $rw_player_para = explode('|',$rw_player_paras[$i]);
    $rwnowcount = $rw_player_para[1];
    }
    if($rwnowcount >=$rwcount){
    $rw_check_done ++;
    }
    }
    if ($rw_type &&$rw_npc_id == $npc_id&&$rwstate!=2){
        if(!$rwstate||($rwstate==1&&$rw_type!=3 &&$rw_check_done &&$rw_check_done==$rw_check_count)){
            return 1;
        }elseif($rw_type ==3 ||$rwstate==1 ||($rw_check_done &&$rw_check_done<$rw_check_count)){
            return 2;
        }else{
            return 3;
        }
    }
    }
}


class boss{
    var $boss_name;
    var $boss_lvl;
    var $boss_id;
    // var $bosstime;
    // var $bs;
    // var $bossinfo;
    // var $bosshp;
    // var $bossmaxhp;
    // var $bossgj;
    // var $bossfy;
    // var $bossbj;
    // var $bossxx;
    // var $bossdj;
    // var $bosszb;
}
function getboss($boss_id,$dblj){
    $boss = new boss();
    $sql = "select * from system_boss WHERE boss_id='$boss_id'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('boss_name',$boss->boss_name);
    $cxjg->bindColumn('boss_id',$boss->boss_id);
    $cxjg->bindColumn('boss_lv',$boss->boss_lv);
    // $cxjg->bindColumn('bosstime',$boss->bosstime);
    // $cxjg->bindColumn('bs',$boss->bs);
    // $cxjg->bindColumn('bossinfo',$boss->bossinfo);
    // $cxjg->bindColumn('bosshp',$boss->bosshp);
    // $cxjg->bindColumn('bossgj',$boss->bossgj);
    // $cxjg->bindColumn('bossfy',$boss->bossfy);
    // $cxjg->bindColumn('bossbj',$boss->bossbj);
    // $cxjg->bindColumn('bossxx',$boss->bossxx);
    // $cxjg->bindColumn('bossdj',$boss->bossdj);
    // $cxjg->bindColumn('bosszb',$boss->bosszb);
    $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $boss;
}

class mqy{
    var $name;
    var $id;
    var $belong;
}

function getqy($qyid,$dblj){
    $qy = new mqy();
    $sql = "select * from `system_area` WHERE id='$qyid'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('name',$qy->name);
    $cxjg->bindColumn('id',$qy->id);
    $cxjg->bindColumn('belong',$qy->belong);
    $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $qy;
}
function getqy_all($dblj){
    $sql = "select * from `system_area` ORDER BY pos";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}
function getmid($mid,$dblj){
    $clmid = new clmid();
    $sql = "select * from system_map where mid='$mid'";
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetch(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        @$clmid->{$propertyName} = $propertyValue;
    }
    return $clmid;
}

function getoutgoing($mid,$area_belong,$dblj,$type){
    $sql = "select * from `system_map` where mid != '$mid' and mis_tp =1 and mtp_type = '$type' and marea_id in (select id from system_area where belong = '$area_belong')";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getcycle($sid,$dblj,$type){
    switch($type){
        case '1':
            $sql = "select * from `system_player_land` where sid = '$sid'";
            break;
        case '2':
            $sql = "select * from `system_player_boat` where sid = '$sid'";
            break;
        case '3':
            $sql = "select * from `system_player_aircraft` where sid = '$sid'";
            break;
    }
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret;
}

function getmid_detail($dblj,$qy_id){
    $sql = "select * from `system_map` where marea_id = '$qy_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}
class gameconfig{
    var $entrance_id;
    var $default_skill_id;
    var $game_name;
    var $pet_max_count;
    var $team_max_count;
    var $game_max_char;
    var $scene_message_count;
    var $scene_chat_time;
    var $long_exist_message;
    var $can_input;
    var $offline_time;
    var $can_verify;
    var $item_head;
    var $chat_head;
    var $fight_head;
    var $int_long;
    var $flush_limit;
    var $fight_mod;
    var $npc_seg;
    var $player_send_global_msg_interval;
    var $near_player_show;
    var $equip_mosaic_link;
    var $scene_op_br;
    var $npc_op_br;
    var $npc_list_br;
    var $item_op_br;
    var $list_row;
    var $drop_protect_time;
    var $drop_disappear_time;
}

function getgameconfig($dblj){
    $gameconfig = new gameconfig();
    $sql = "select * from gm_game_basic where game_id = '19980925'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('entrance_id',$gameconfig->entrance_id);
    $cxjg->bindColumn('default_skill_id',$gameconfig->default_skill_id);
    $cxjg->bindColumn('game_name',$gameconfig->game_name);
    $cxjg->bindColumn('pet_max_count',$gameconfig->pet_max_count);
    $cxjg->bindColumn('team_max_count',$gameconfig->team_max_count);
    $cxjg->bindColumn('game_max_char',$gameconfig->game_max_char);
    $cxjg->bindColumn('scene_message_count',$gameconfig->scene_message_count);
    $cxjg->bindColumn('scene_chat_time',$gameconfig->scene_chat_time);
    $cxjg->bindColumn('long_exist_message',$gameconfig->long_exist_message);
    $cxjg->bindColumn('can_input',$gameconfig->can_input);
    $cxjg->bindColumn('player_offline_time',$gameconfig->offline_time);
    $cxjg->bindColumn('can_verify',$gameconfig->can_verify);
    $cxjg->bindColumn('item_head',$gameconfig->item_head);
    $cxjg->bindColumn('chat_head',$gameconfig->chat_head);
    $cxjg->bindColumn('fight_head',$gameconfig->fight_head);
    $cxjg->bindColumn('flush_limit',$gameconfig->flush_limit);
    $cxjg->bindColumn('int_long',$gameconfig->int_long);
    $cxjg->bindColumn('fight_mod',$gameconfig->fight_mod);
    $cxjg->bindColumn('npc_seg',$gameconfig->npc_seg);
    $cxjg->bindColumn('player_send_global_msg_interval',$gameconfig->player_send_global_msg_interval);
    $cxjg->bindColumn('near_player_show',$gameconfig->near_player_show);
    $cxjg->bindColumn('equip_mosaic_link',$gameconfig->equip_mosaic_link);
    $cxjg->bindColumn('scene_op_br',$gameconfig->scene_op_br);
    $cxjg->bindColumn('npc_op_br',$gameconfig->npc_op_br);
    $cxjg->bindColumn('npc_list_br',$gameconfig->npc_list_br);
    $cxjg->bindColumn('item_op_br',$gameconfig->item_op_br);
    $cxjg->bindColumn('list_row',$gameconfig->list_row);
    $cxjg->bindColumn('default_storage',$gameconfig->default_storage);
    $cxjg->bindColumn('game_player_regular_minute',$gameconfig->game_player_regular_minute);
    $cxjg->bindColumn('game_temp_notice',$gameconfig->game_temp_notice);
    $cxjg->bindColumn('game_temp_notice_time',$gameconfig->game_temp_notice_time);
    $cxjg->bindColumn('drop_protect_time',$gameconfig->drop_protect_time);
    $cxjg->bindColumn('drop_disappear_time',$gameconfig->drop_disappear_time);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $gameconfig;
}

function getfightpara($sid,$dblj){
    $sql = "SELECT ngid,nid,nname,nlvl,nhp,nmp,ndesc,nspeed from system_npc_midguaiwu where nsid = '$sid' and nhp >0";
    $result = $dblj->query($sql);
    $row = $result->fetchAll(\PDO::FETCH_ASSOC);
    return $row;
}


function getfighthm($sid, $gid, $pid, $round, $dblj,$type1, $type2) {
    // 查询 game2 表中的 cut_hp
    $sql_game2 = "SELECT SUM(cut_hp) AS total_cut_hp
                  FROM game2
                  WHERE sid = :sid
                    AND type = :type1
                    AND round = :round
                    AND pid = :pid";
    
    // 查询 game3 表中的 cut_mp
    $sql_game3 = "SELECT cut_mp AS total_cut_mp
                  FROM game3
                  WHERE sid = :sid
                    AND type = :type2
                    AND round = :round
                    AND pid = :pid";
    
    // 执行 game2 查询
    $stmt_game2 = $dblj->prepare($sql_game2);
    $stmt_game2->bindParam(':sid', $sid);
    $stmt_game2->bindParam(':round', $round);
    $stmt_game2->bindParam(':type1', $type1);
    $stmt_game2->bindParam(':pid', $pid);
    $stmt_game2->execute();
    $result_game2 = $stmt_game2->fetch(\PDO::FETCH_ASSOC);

    // 执行 game3 查询
    $stmt_game3 = $dblj->prepare($sql_game3);
    $stmt_game3->bindParam(':sid', $sid);
    $stmt_game3->bindParam(':round', $round);
    $stmt_game3->bindParam(':type2', $type2);
    $stmt_game3->bindParam(':pid', $pid);
    $stmt_game3->execute();
    $result_game3 = $stmt_game3->fetch(\PDO::FETCH_ASSOC);
    
    // 返回结果，对大数值进行安全处理
    return [
        'total_cut_hp' => $result_game2['total_cut_hp'] ?? '0', // 如果没有结果，返回字符串'0'而不是数字0
        'total_cut_mp' => $result_game3['total_cut_mp'] ?? '0'  // 如果没有结果，返回字符串'0'而不是数字0
    ];
}


function getpet_fight($sid,$dblj,$para=null){
    if($para =='alive'){
    $sql = "SELECT * from system_pet_scene where nsid = '$sid' and nhp >0 and nstate = 1";
    }elseif($para =='dead'){
    $sql = "SELECT * from system_pet_scene where nsid = '$sid' and nhp <=0 and nstate = 1";
    }else{
    $sql = "SELECT * from system_pet_scene where nsid = '$sid' and nstate = 1";
    }
    $result = $dblj->query($sql);
    $row = $result->fetchAll(\PDO::FETCH_ASSOC);
    return $row;
}

function getpet_once($sid,$dblj,$pid){
    $sql = "SELECT * from system_pet_scene where nsid = '$sid' and npid = '$pid'";
    $result = $dblj->query($sql);
    $row = $result->fetch(\PDO::FETCH_ASSOC);
    return $row;
}

function getplayer_pet_count($sid,$dblj,$para=null){
    if($para=='out'){
    $sql = "SELECT COUNT(*) as out_count from system_pet_scene where nsid = '$sid' and nstate = 1";
    $result = $dblj->query($sql);
    $row = $result->fetch(\PDO::FETCH_ASSOC);
    $count = $row['out_count'];
    }else{
    $sql = "SELECT COUNT(*) as all_count from system_pet_scene where nsid = '$sid'";
    $result = $dblj->query($sql);
    $row = $result->fetch(\PDO::FETCH_ASSOC);
    $count = $row['all_count'];
    }
    return $count;
}

class getbasicgmdata{
    var $skill_count;
    var $map_count;
    var $item_count;
    var $npc_count;
    var $photo_count;
    var $exp_count;
    var $task_count;
    var $boss_count;
    var $buff_count;
    var $online_count;
    var $global_chat_count;
    var $global_system_chat_count;
    var $player_count;
    var $fb_count;
    var $rp_count;
    var $lp_count;
    var $mk_count;
}

class getplayercitystorage{
    var $now_city_storage;
    var $now_store_lock;
}

function getbasicgmdata($dblj){
    $gamebasic = new getbasicgmdata();
    $sql = "SELECT 
                    (SELECT COUNT(*) FROM system_skill) AS skill_count,
                    (SELECT COUNT(*) FROM system_map) AS map_count,
                    (SELECT COUNT(*) FROM system_item_module) AS item_count,
                    (SELECT COUNT(*) FROM system_npc) AS npc_count,
                    (SELECT COUNT(*) FROM system_photo) AS photo_count,
                    (SELECT COUNT(*) FROM system_task) AS task_count,
                    (SELECT COUNT(*) FROM system_boss) AS boss_count,
                    (SELECT COUNT(*) FROM system_buff) AS buff_count,
                    (SELECT COUNT(*) FROM system_fb) AS fb_count,
                    (SELECT COUNT(*) FROM system_rp) AS rp_count,
                    (SELECT COUNT(*) FROM system_lp) AS lp_count,
                    (SELECT COUNT(*) FROM system_mk) AS mk_count,
                    (SELECT COUNT(*) FROM game1 where sfzx = 1) AS online_count,
                    (SELECT COUNT(*) FROM system_chat_data where chat_type = 0) AS global_chat_count,
                    (SELECT COUNT(*) FROM system_chat_data where chat_type = 6 AND uid = 0) AS global_system_chat_count,
                    (SELECT COUNT(*) FROM game1) AS player_count,
                    (SELECT COUNT(*) FROM system_exp_def) AS exp_count";
        // 执行查询并获取结果
        $result = $dblj->query($sql);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        // 分配给$gamebasic对象的属性
        $gamebasic->skill_count = $row['skill_count'];
        $gamebasic->map_count = $row['map_count'];
        $gamebasic->item_count = $row['item_count'];
        $gamebasic->npc_count = $row['npc_count'];
        $gamebasic->photo_count = $row['photo_count'];
        $gamebasic->exp_count = $row['exp_count'];
        $gamebasic->task_count = $row['task_count'];
        $gamebasic->boss_count = $row['boss_count'];
        $gamebasic->buff_count = $row['buff_count'];
        $gamebasic->online_count = $row['online_count'];
        $gamebasic->global_chat_count = $row['global_chat_count'];
        $gamebasic->global_system_chat_count = $row['global_system_chat_count'];
        $gamebasic->player_count = $row['player_count'];
        $gamebasic->fb_count = $row['fb_count'];
        $gamebasic->rp_count = $row['rp_count'];
        $gamebasic->lp_count = $row['lp_count'];
        $gamebasic->mk_count = $row['mk_count'];
        return $gamebasic;
}


function getcitystorage($mid, $sid, $dblj) {
    $storage = new getplayercitystorage();
    
    $sql = "SELECT 
    SUM(ss.icount) AS now_city_storage, 
    locked.istate AS now_store_lock 
FROM 
    system_storage ss
LEFT JOIN 
    system_storage_locked locked 
    ON ss.ibelong_mid = locked.ibelong_mid AND ss.sid = locked.sid
WHERE 
    ss.ibelong_mid = '$mid' AND ss.sid = '$sid';
;
";
    // 执行查询并获取结果
    $result = $dblj->query($sql);
    $row = $result->fetch(\PDO::FETCH_ASSOC);

    // 分配给$gamebasic对象的属性
    $storage->now_city_storage = $row['now_city_storage'];
    $storage->now_store_lock = $row['now_store_lock'];

    return $storage;
}


function getauc_once($lx,$payid,$dblj){
    switch ($lx){
        case "cons":
            $sql = "select * from `system_auc_data` WHERE auc_id = $payid";
            $redj = $dblj->query($sql);
            $dj = $redj->fetch(\PDO::FETCH_ASSOC);
            return $dj;
        case "zhuangbei":
            $sql = "select * from `fangshi_zb` WHERE payid = $payid";
            $redj = $dblj->query($sql);
            $redj->bindColumn('zbnowid',$fszb->zbnowid);
            $redj->bindColumn('payid',$fszb->payid);
            $redj->bindColumn('uid',$fszb->uid);
            $redj->bindColumn("pay",$fszb->pay);
            $zb = $redj->fetch(\PDO::FETCH_ASSOC);
            if ($zb){
                return $fszb;
            }
            return $zb;
    }

}

function getauc_city($dblj,$area_id,$auc_id=null){
    if(!$auc_id){
    $sql = "select * from `system_auc` where auc_area = '$area_id'";
    $retl = $dblj->query($sql);
    $ret = $retl->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
    }else{
    $sql = "select * from `system_auc` where auc_area = '$area_id' and auc_id = '$auc_id'";
    $retl = $dblj->query($sql);
    $ret = $retl->fetch(\PDO::FETCH_ASSOC);
    return $ret;
    }
}


function getauc_city_detail($lx,$dblj,$auc_id){
    switch ($lx){
        case "cons":
            $sql = "select * from `system_auc_data` where auc_item_type = '消耗品' and belong = '$auc_id'";
            $redj = $dblj->query($sql);
            $dj = $redj->fetchAll(\PDO::FETCH_ASSOC);
            return $dj;
        case "equipb":
            $sql = "select * from `system_auc_data` where auc_item_type = '兵器' and belong = '$auc_id'";
            $redj = $dblj->query($sql);
            $dj = $redj->fetchAll(\PDO::FETCH_ASSOC);
            return $dj;
        case "equipf":
            $sql = "select * from `system_auc_data` where auc_item_type = '防具' and belong = '$auc_id'";
            $redj = $dblj->query($sql);
            $dj = $redj->fetchAll(\PDO::FETCH_ASSOC);
            return $dj;
        case "dimond":
            $sql = "select * from `system_auc_data` where (auc_item_type = '兵器镶嵌物' or auc_item_type = '防具镶嵌物') and belong = '$auc_id'";
            $redj = $dblj->query($sql);
            $dj = $redj->fetchAll(\PDO::FETCH_ASSOC);
            return $dj;
        case "book":
            $sql = "select * from `system_auc_data` where auc_item_type = '书籍' and belong = '$auc_id'";
            $redj = $dblj->query($sql);
            $dj = $redj->fetchAll(\PDO::FETCH_ASSOC);
            return $dj;
        case "other":
            $sql = "select * from `system_auc_data` where auc_item_type = '其它' and belong = '$auc_id'";
            $redj = $dblj->query($sql);
            $dj = $redj->fetchAll(\PDO::FETCH_ASSOC);
            return $dj;
    }

}

class rp{
    var $rp_id;
    var $rp_name;
    var $rp_rarity;
    var $rp_action_name;
    var $rp_renew_time;
    var $rp_item_id;
    var $rp_pick_cond;
    var $rp_desc;
}

function getrp_all($dblj){
    $sql = "select * from `system_rp`";
    $retr = $dblj->query($sql);
    $ret = $retr->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getrp_detail($rp_id,$dblj){
    $rp = new rp();
    $sql = "select * from `system_rp` WHERE rp_id = '$rp_id'";
    $retr = $dblj->query($sql);
    $retr->bindColumn("rp_id",$rp->rp_id);
    $retr->bindColumn("rp_name",$rp->rp_name);
    $retr->bindColumn("rp_action_name",$rp->rp_action_name);
    $retr->bindColumn("rp_renew_time",$rp->rp_renew_time);
    $retr->bindColumn("rp_rarity",$rp->rp_rarity);
    $retr->bindColumn("rp_item_root",$rp->rp_item_id);
    $retr->bindColumn("rp_pick_cond",$rp->rp_pick_cond);
    $retr->bindColumn("rp_desc",$rp->rp_desc);
    $retr->fetch(\PDO::FETCH_ASSOC);
    return $rp;
}

class lp{
    var $lp_id;
    var $lp_name;
    var $lp_desc;
}

function getlp_all($dblj){
    $sql = "select * from `system_lp`";
    $retl = $dblj->query($sql);
    $ret = $retl->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getauc_all($dblj){
    $sql = "select * from `system_auc`";
    $retl = $dblj->query($sql);
    $ret = $retl->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getlp_detail($lp_id,$dblj){
    $lp = new lp();
    $sql = "select * from `system_lp` WHERE lp_id = '$lp_id'";
    $retl = $dblj->query($sql);
    $retl->bindColumn("lp_id",$lp->lp_id);
    $retl->bindColumn("lp_name",$lp->lp_name);
    $retl->bindColumn("lp_desc",$lp->lp_desc);
    $retl->fetch(\PDO::FETCH_ASSOC);
    return $lp;
    
}

function exec_global_event($event_id,$event_type,$event_obj,$sid,$dblj){
$event_data = global_event_data_get($event_id,$dblj);
$event_cond = $event_data['system_event']['cond'];
$event_cmmt = $event_data['system_event']['cmmt'];
$register_triggle = checkTriggerCondition($event_cond,$dblj,$sid,$event_type,$event_obj);
if(is_null($register_triggle)){
    $register_triggle =1;
}
if(!$register_triggle){
}elseif($register_triggle){
if(!empty($event_data['system_event']['link_evs'])){
    $system_event_evs = $event_data["system_event_evs"];
    foreach ($system_event_evs as $index => $event) {
    $step_cond = $event['cond'];
    $step_cmmt = $event['cmmt'];
    $step_cmmt2 = $event['cmmt2'];
    $step_s_attrs = $event['s_attrs'];
    $step_m_attrs = $event['m_attrs'];
    $step_items = $event['items'];
    $step_a_skills = $event['a_skills'];
    $step_r_skills = $event['r_skills'];
    $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid,$event_type,$event_obj);
    if(is_null($step_triggle)){
    $step_triggle =1;
        }
    if(!$step_triggle){
        if($step_cmmt2){
        echo \lexical_analysis\process_photoshow(\lexical_analysis\process_string($step_cmmt2,$sid,$event_type,$event_obj))."<br/>";
        }
        }elseif($step_triggle){
            if($step_cmmt){
        echo \lexical_analysis\process_photoshow(\lexical_analysis\process_string($step_cmmt,$sid,$event_type,$event_obj))."<br/>";
            }
        if($step_s_attrs){
        $ret = attrsetting($step_s_attrs,$sid,$event_type,$event_obj);
        }
        if($step_m_attrs){
        $ret = attrchanging($step_m_attrs,$sid,$event_type,$event_obj);
        }
        if($step_items){
        $ret = itemchanging($step_items,$sid,$event_type,$event_obj);
        }
        if($step_a_skills){
        $ret = skillschanging($step_a_skills,$sid,1,$event_type,$event_obj);
        }
        if($step_r_skills){
        $ret = skillschanging($step_r_skills,$sid,2,$event_type,$event_obj);
        }
        }
    }
}
}
}

function exec_self_event($event_id,$event_type,$event_obj,$sid,$dblj){
$event_data = self_event_data_get($event_id,$dblj);
$event_cond = $event_data['system_event']['cond'];
$event_cmmt = $event_data['system_event']['cmmt'];
$register_triggle = checkTriggerCondition($event_cond,$dblj,$sid,$event_type,$event_obj);
if(is_null($register_triggle)){
    $register_triggle =1;
}
if(!$register_triggle){
}elseif($register_triggle){
if(!empty($event_data['system_event']['link_evs'])){
    $system_event_evs = $event_data["system_event_evs"];
    foreach ($system_event_evs as $index => $event) {
    $step_cond = $event['cond'];
    $step_cmmt = $event['cmmt'];
    $step_cmmt2 = $event['cmmt2'];
    $step_s_attrs = $event['s_attrs'];
    $step_m_attrs = $event['m_attrs'];
    $step_items = $event['items'];
    $step_a_skills = $event['a_skills'];
    $step_r_skills = $event['r_skills'];
    $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid,$event_type,$event_obj);
    if(is_null($step_triggle)){
    $step_triggle =1;
        }
    if(!$step_triggle){
        if($step_cmmt2){
        echo \lexical_analysis\process_photoshow(\lexical_analysis\process_string($step_cmmt2,$sid,$event_type,$event_obj))."<br/>";
        }
        }elseif($step_triggle){
            if($step_cmmt){
        echo \lexical_analysis\process_photoshow(\lexical_analysis\process_string($step_cmmt,$sid,$event_type,$event_obj))."<br/>";
            }
        if($step_s_attrs){
        $ret = attrsetting($step_s_attrs,$sid,$event_type,$event_obj);
        }
        if($step_m_attrs){
        $ret = attrchanging($step_m_attrs,$sid,$event_type,$event_obj);
        }
        if($step_items){
        $ret = itemchanging($step_items,$sid,$event_type,$event_obj);
        }
        if($step_a_skills){
        $ret = skillschanging($step_a_skills,$sid,1,$event_type,$event_obj);
        }
        if($step_r_skills){
        $ret = skillschanging($step_r_skills,$sid,2,$event_type,$event_obj);
        }
        }
    }
}
}
}

