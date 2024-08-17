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
    var $uteam_id;//队伍id
    var $uteam_putin_id;//申请中的队伍id
    var $uteam_invited_id;//被邀请的队伍id
    var $umaxexp;//经验上限
    var $uhp;//生命
    var $umaxhp;//生命
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

class midguai{}

class guaiwu{}

class npcguaiwu{
    var $nid;
    var $nhp;
    var $nname;
    var $ndrop_exp;
    var $ndrop_money;
    var $ndrop_item;
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
    $cxjg->bindColumn('uteam_id',$player->uteam_id);
    $cxjg->bindColumn('uteam_putin_id',$player->uteam_putin_id);
    $cxjg->bindColumn('uteam_invited_id',$player->uteam_invited_id);
    $cxjg->bindColumn('uexp',$player->uexp);
    $cxjg->bindColumn('uhp',$player->uhp);
    $cxjg->bindColumn('umaxhp',$player->umaxhp);
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
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time,viewed) values('系统信息','$input',0,{$imuid},1,'$nowdate',1)";
    }else{
    $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('系统信息','$input',0,{$imuid},1,'$nowdate')";
    }
    $dblj->exec($sql);

}

function put_system_message_sql($uid,$dblj){
$sql = "SELECT msg,id FROM system_chat_data where uid = 0 and imuid = '$uid' and viewed = 0  ORDER BY id DESC";//系统未读信息获取
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
$sql = "select * from player_equip_mosaic where belong_sid = '$sid'";
$cxjg = $dblj->query($sql);

}else{
$sql = "select * from player_equip_mosaic where belong_sid = '$sid' and equip_id in (select item_true_id from system_item where sid = '$sid' and iid in (select iid from system_item_module where iname LiKE :keyword))";
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
$sql = "SELECT m.iname,m.iid,m.idesc,m.iembed_count,i.item_true_id,i.iequiped FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and i.isale_state != 1 and  m.iembed_count >0 AND NOT EXISTS(SELECT 1 FROM player_equip_mosaic WHERE belong_sid = '$sid' AND equip_id = i.item_true_id)";
$cxjg = $dblj->query($sql);
}else{
$sql = "SELECT m.iname,m.iid,m.idesc,m.iembed_count,i.item_true_id,i.iequiped FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and m.iname LIKE :keyword and i.isale_state != 1 and  m.iembed_count >0 AND NOT EXISTS(SELECT 1 FROM player_equip_mosaic WHERE belong_sid = '$sid' AND equip_id = i.item_true_id)";
$cxjg = $dblj->prepare($sql);
$cxjg->bindValue(':keyword', "%$kw%", \PDO::PARAM_STR);
$cxjg->execute();
}
$row = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
return $row;
}

function get_player_all_mosaic($type,$sid,$dblj){
    if($type =="兵器"){
$sql = "SELECT m.iname,m.iid,i.item_true_id,i.iequiped,i.icount FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and i.iequiped =0 and m.itype = '兵器镶嵌物' and i.icount >0";
}else{
$sql = "SELECT m.iname,m.iid,i.item_true_id,i.iequiped,i.icount FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid' and i.iequiped =0 and m.itype = '防具镶嵌物' and i.icount >0";
}
$cxjg = $dblj->query($sql);
$row = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
return $row;
}


function update_item_burthen($sid,$dblj){
    $query = "SELECT iid, icount FROM system_item WHERE sid = :sid";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':sid', $sid, \PDO::PARAM_STR);
    $stmt->execute();
    
    $value = 0;
    
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $iid = $row['iid'];
        $icount = $row['icount'];
        
        // 获取system_item_module表中等于iid的iweight值
        $subQuery = "SELECT iweight FROM system_item_module WHERE iid = :iid";
        $subStmt = $dblj->prepare($subQuery);
        $subStmt->bindParam(':iid', $iid, \PDO::PARAM_INT);
        $subStmt->execute();
        
        if ($subRow = $subStmt->fetch(\PDO::FETCH_ASSOC)) {
            $iweight = $subRow['iweight'];
            $value += $iweight * $icount;
        }
    }
    return $value;
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
    while ($exp >= $upexp &&$up_cond){
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

function getmoney_type_all($dblj){
    $sql = "select * from `system_money_type`";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
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


function getitem_user($sid,$dblj){
    $item = new item();
    $sql = "SELECT m.*,i.item_true_id,i.icount,i.iequiped,i.isale_state FROM system_item_module m JOIN system_item i ON m.iid = i.iid WHERE i.sid = '$sid'
    ";;
    $cxjg = $dblj->query($sql);
    $data = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    // 循环遍历数组，动态生成类的属性并赋值
    if(is_bool($data)){
        return;
    }
    foreach ($data as $propertyName => $propertyValue) {
        $item->{$propertyName} = $propertyValue;
    }
    return $item;
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
    $sql = "select nid,nname,nhp,nwin_event_id,ndefeat_event_id,ndrop_exp,ndrop_money,ndrop_item from system_npc_midguaiwu where ngid = '$nid'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('nid',$npcguaiwu->nid);
    $cxjg->bindColumn('nname',$npcguaiwu->nname);
    $cxjg->bindColumn('nhp',$npcguaiwu->nhp);
    $cxjg->bindColumn('nwin_event_id',$npcguaiwu->nwin_event_id);
    $cxjg->bindColumn('ndefeat_event_id',$npcguaiwu->ndefeat_event_id);
    $cxjg->bindColumn('ndrop_exp',$npcguaiwu->ndrop_exp);
    $cxjg->bindColumn('ndrop_money',$npcguaiwu->ndrop_money);
    $cxjg->bindColumn('ndrop_item',$npcguaiwu->ndrop_item);
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
                changeplayerequip($sid,$dblj,$equip_add_gj,$equip_id,$equip_subtype,1);
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
                changeplayerequip($sid,$dblj,$equip_add_fy,$equip_id,$equip_subtype,3);
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
            $sql = "SELECT * FROM system_equip_user WHERE eqsid = ? AND eq_type = 1";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                // 记录已存在，获取 eq_true_id 的值
                $eq_true_id = $result['eq_true_id'];
                $dblj->exec("UPDATE system_equip_user set eq_true_id = '$equip_id' where eq_true_id = '$eq_true_id' and eqsid = '$sid' and eq_type = 1");
                $sql = "select iattack_value from system_item_module where iid = (select iid from system_item where item_true_id = '$eq_true_id' and sid = '$sid')";
                $sub_tmt = $dblj->query($sql);
                $sub_result = $sub_tmt->fetch(\PDO::FETCH_ASSOC);
                $sub_value = -intval($sub_result['iattack_value']);
                \player\addplayersx('ugj',$sub_value,$sid,$dblj);
                \player\addplayersx('ugj',$equip_add_canshu,$sid,$dblj);
                $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$eq_true_id' and sid = '$sid'");
                $event_data = global_event_data_get(41,$dblj);
                $event_cond = $event_data['system_event']['cond'];
                $event_cmmt = $event_data['system_event']['cmmt'];
                $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid,'item',$eq_true_id);
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
                    $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid,'item',$eq_true_id);
                    if(is_null($step_triggle)){
                    $step_triggle =1;
                        }
                    if(!$step_triggle){
                        echo $step_cmmt2."<br/>";
                        }elseif($step_triggle){
                        if($step_cmmt){
                        echo $step_cmmt."<br/>";
                        }
                        $ret = attrsetting($step_s_attrs,$sid,'item',$eq_true_id);
                        $ret = attrchanging($step_m_attrs,$sid,'item',$eq_true_id);
                        $ret = itemchanging($step_items,$sid,'item',$eq_true_id);
                        $ret = skillschanging($step_a_skills,$sid,1,'item',$eq_true_id);
                        $ret = skillschanging($step_r_skills,$sid,2,'item',$eq_true_id);
                        }
                    }
                }
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
            $sql = "SELECT * FROM system_equip_user WHERE eqsid = ? AND eq_type = 1";
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
            $sql = "SELECT * FROM system_equip_user WHERE eqsid = ? AND eq_type = 2 and equiped_pos_id = '$equip_pos_id'";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(1, $sid, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                // 记录已存在，获取 eq_true_id 的值
                $eq_true_id = $result['eq_true_id'];
                $dblj->exec("UPDATE system_equip_user set eq_true_id = '$equip_id' where eq_true_id = '$eq_true_id' and eqsid = '$sid' and eq_type = 2");
                $sql = "select irecovery_value from system_item_module where iid = (select iid from system_item where item_true_id = '$eq_true_id' and sid = '$sid')";
                $sub_tmt = $dblj->query($sql);
                $sub_result = $sub_tmt->fetch(\PDO::FETCH_ASSOC);
                $sub_value = -intval($sub_result['irecovery_value']);
                \player\addplayersx('ufy',$sub_value,$sid,$dblj);
                \player\addplayersx('ufy',$equip_add_canshu,$sid,$dblj);
                $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$eq_true_id' and sid = '$sid'");
                $event_data = global_event_data_get(41,$dblj);
                $event_cond = $event_data['system_event']['cond'];
                $event_cmmt = $event_data['system_event']['cmmt'];
                $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid,'item',$eq_true_id);
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
                    $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid,'item',$eq_true_id);
                    if(is_null($step_triggle)){
                    $step_triggle =1;
                        }
                    if(!$step_triggle){
                        echo $step_cmmt2."<br/>";
                        }elseif($step_triggle){
                        echo $step_cmmt."<br/>";
                        $ret = attrsetting($step_s_attrs,$sid,'item',$eq_true_id);
                        $ret = attrchanging($step_m_attrs,$sid,'item',$eq_true_id);
                        $ret = itemchanging($step_items,$sid,'item',$eq_true_id);
                        $ret = skillschanging($step_a_skills,$sid,1,'item',$eq_true_id);
                        $ret = skillschanging($step_r_skills,$sid,2,'item',$eq_true_id);
                        }
                    }
                }
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
            $sql = "SELECT * FROM system_equip_user WHERE eqsid = ? AND eq_type = 2 and equiped_pos_id = '$equip_pos_id'";
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
    $item_type = getitem($iid,$dblj)->itype;
    $iweight = getitem($iid,$dblj)->iweight;
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
        }elseif($item_type =="兵器"||$item_type =="防具"){
        for($i=0;$i<$icount;$i++){
        $sql = "insert into system_item(icount,sid,uid,iid) VALUES (1,'$sid','$player->uid',$iid)";
        $dblj->exec($sql);
            }
        }
    }
    else{
        if($item_type !="兵器"&&$item_type !="防具"){
        $sql = "insert into system_item(icount,sid,uid,iid) VALUES ($icount,'$sid','$player->uid',$iid)";
        $dblj->exec($sql);
        // 获取自增ID
        $item_true_id = $dblj->lastInsertId();
        }elseif($item_type =="兵器"||$item_type =="防具"){
        for($i=0;$i<$icount;$i++){
        $sql = "insert into system_item(icount,sid,uid,iid) VALUES (1,'$sid','$player->uid',$iid)";
        $dblj->exec($sql);
        $item_true_id = $dblj->lastInsertId();
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
    $sql = "select mitem_now from system_map where mid = '$mid' AND mitem_now LIKE '%$check_para%' OR mitem_now LIKE '%,$check_para%' OR mitem_now LIKE '%$check_para,%'";
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


function useitem($sid,$iid,$icount,$dblj){
    $player = getplayer($sid,$dblj);
    $sql = "select * from system_item_module where iid = '$iid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $use_attr = $ret['iuse_attr'];
    $u_attr = "u".$use_attr;
    $use_value = $ret['iuse_value'];
    $sql = "select name from gm_game_attr where value_type = 1 and id = '$use_attr'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $attr_name = $ret['name'];
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
    $sql = "update game1 set $sx = '$gaibian' WHERE sid='$sid'";//改变玩家属性
    $ret = $dblj->exec($sql);
}

function changeplayertable($db,$sx,$gaibian,$sid,$dblj){
    $sql = "update `$db` set $sx = '$gaibian' WHERE sid='$sid'";//改变玩家任意表的属性
    $ret = $dblj->exec($sql);
}

function addplayertable($db,$sx,$gaibian,$sid,$dblj){
    $sql = "update `$db` set $sx = $sx + '$gaibian' WHERE sid='$sid'";//增减玩家任意表属性
    $ret = $dblj->exec($sql);
    if($ret){
        return true;
    }else{
        return false;
    }
}

function changepetsx($sx,$gaibian,$petid,$sid,$dblj){
    $sql = "update system_pet_player set $sx = '$gaibian' WHERE petid='$petid' and petsid = '$sid'";//改变宠物属性
    $ret = $dblj->exec($sql);
}

function addcwsx($sx,$gaibian,$petid,$sid,$dblj){
    $sql = "update system_pet_player set $sx = $sx + '$gaibian' WHERE petid='$petid' and petsid = '$sid'";//增加cw属性
    $ret = $dblj->exec($sql);
}


function addplayersx($sx,$gaibian,$sid,$dblj,$db=null){
    switch($sx){
        case 'uhp':
            $umaxhp = getplayer($sid,$dblj)->umaxhp;
            $uhp = getplayer($sid,$dblj)->uhp;
            if(($gaibian + $uhp) >$umaxhp){
            $sql = "update game1 set uhp = $umaxhp WHERE sid='$sid'";//增加玩家属性
            }else{
            $sql = "update game1 set uhp = uhp + '$gaibian' WHERE sid='$sid'";//增加玩家属性
            }
            break;
        default:
            $sql = "update game1 set $sx = $sx + '$gaibian' WHERE sid='$sid'";//增加玩家属性
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
    $sql = "update system_item set icount = icount + '$gaibian' WHERE sid='$sid' and item_true_id = '$item_true_id'";
    $out_count = $gaibian;
    }elseif($gaibian =="all"){
    $out = $dblj->query("select icount from system_item WHERE sid='$sid' and item_true_id = '$item_true_id';");
    $out_ret = $out->fetch(\PDO::FETCH_ASSOC);
    $out_count = -$out_ret['icount'];
    $sql = "delete from system_item WHERE sid='$sid' and item_true_id = '$item_true_id'";
    }
    $ret = $dblj->exec($sql);
    $nowcount = $dblj->query("select icount from system_item WHERE sid='$sid' and item_true_id = '$item_true_id';");
    $now_ret = $nowcount->fetch(\PDO::FETCH_ASSOC);
    $now_count = $now_ret['icount'];
    if($now_ret && $now_count <=0){
    $sql = "delete from system_item WHERE sid='$sid' and item_true_id = '$item_true_id'";
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
$taskarr_count = @count($taskarr);
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

function getsail($mid,$area_belong,$dblj){
    $sql = "select * from `system_map` where mid != '$mid' and mis_tp =1 and mtp_type = 1 and marea_id in (select id from system_area where belong = '$area_belong')";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getboat($sid,$dblj){
    $sql = "select * from `system_player_boat` where sid = '$sid'";
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
    var $offline_time;
    var $player_send_global_msg_interval;
    var $near_player_show;
    var $scene_op_br;
    var $npc_op_br;
    var $item_op_br;
    var $list_row;
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
    $cxjg->bindColumn('player_offline_time',$gameconfig->offline_time);
    $cxjg->bindColumn('player_send_global_msg_interval',$gameconfig->player_send_global_msg_interval);
    $cxjg->bindColumn('near_player_show',$gameconfig->near_player_show);
    $cxjg->bindColumn('scene_op_br',$gameconfig->scene_op_br);
    $cxjg->bindColumn('npc_op_br',$gameconfig->npc_op_br);
    $cxjg->bindColumn('item_op_br',$gameconfig->item_op_br);
    $cxjg->bindColumn('list_row',$gameconfig->list_row);
    $cxjg->bindColumn('default_storage',$gameconfig->default_storage);
    $cxjg->bindColumn('game_player_regular_minute',$gameconfig->game_player_regular_minute);
    $cxjg->bindColumn('game_temp_notice',$gameconfig->game_temp_notice);
    $cxjg->bindColumn('game_temp_notice_time',$gameconfig->game_temp_notice_time);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $gameconfig;
}

function getfightpara($sid,$dblj){
    $sql = "SELECT ngid,nname,nlvl,nhp,ndesc from system_npc_midguaiwu where nsid = '$sid' and nhp >0";
    $result = $dblj->query($sql);
    $row = $result->fetchAll(\PDO::FETCH_ASSOC);
    return $row;
}

function getpet_fight($sid,$dblj){
    $sql = "SELECT * from system_pet_player where psid = '$sid' and php >0 and pstate = 1";
    $result = $dblj->query($sql);
    $row = $result->fetchAll(\PDO::FETCH_ASSOC);
    return $row;
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