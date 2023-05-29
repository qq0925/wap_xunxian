<?php
$start_time = microtime(true);

require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$encode = new \encode\encode();
$player = new \player\player();
$gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
$guaiwu = new \player\guaiwu();
$clmid = new \player\clmid();
$npc = new \player\npc();
$ym = 'game/nowmid.php';
$Dcmd = $_SERVER['QUERY_STRING'];
$pvpts ='';
$tpts = '';
session_start();

$allow_sep = "100";//间隔时间，单位毫秒。
function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($t1) + floatval($t2)) * 1000);
}
if (isset($_SESSION["post_sep"]))
{

    if (getMillisecond() - $_SESSION["post_sep"] < $allow_sep)
    {

        $msg = '<meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">你点击太快了^_^!<br/><a href="?'.$Dcmd.'">继续</a>';
        exit($msg);
    }
    else
    {
        $_SESSION["post_sep"] = getMillisecond();
    }
}
else
{
    $_SESSION["post_sep"] = getMillisecond();
}

@parse_str($Dcmd);//解析Dcmd转为变量
if (isset($cmd)){
    if ($cmd == 'djinfo'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'zbinfo'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'npc'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'duihuan'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'sendliaotian'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    
    if ($cmd == 'gm'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    
    $Dcmd = $encode->decode($cmd);
    var_dump($Dcmd);
    echo '<br/>';
    @parse_str($Dcmd);
    echo'cmd参数名：'.$cmd.'<br/>';
    switch ($cmd){
        case 'cj':
            $ym = 'game/cj.php';
            break;
        case 'login':
            $player = \player\getplayer($sid,$dblj);
            
            //玩家登录事件在此实现。
            
            $gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
            $nowdate = date('Y-m-d H:i:s');
            $sql = "update game1 set endtime='$nowdate',sfzx=1 WHERE sid='$sid'";
            $cxjg = $dblj->exec($sql);
            echo '正在进入游戏...';
            header("refresh:1;url=?cmd=$gonowmid");
            exit();
            break;
        case 'logout':
            $nowdate = date('Y-m-d H:i:s');
            echo $player->uname."已成功退出登陆！";
            $sql = "update game1 set endtime='$nowdate',sfzx=0 WHERE sid='$sid'";
            $dblj->exec($sql);
            header("refresh:1;url=index.php");
            exit();
            break;
        case 'zhuangtai':
            $ym = 'game/zhuangtai.php';
            break;
        case 'cjplayer':

            if (isset($token) && isset($username) && isset($sex)){
                if(strlen($username)<6 || strlen($username)>12){
                    echo "用户名不能太短或者太长";
                    $ym = 'game/cj.php';

                    break;
                }
                $username = htmlspecialchars($username);
                $sid = md5($username.$token.'229');
                $sql="select * from game1 where token='$token'";
                $cxjg = $dblj->query($sql);
                $cxjg->bindColumn('sid',$player->sid);
                $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
                $nowdate = date('Y-m-d H:i:s');
                if ($player->sid ==''){
                    $gameconfig = \player\getgameconfig($dblj);
                    $firstmid = $gameconfig->firstmid;
                    
                    
                    //这里写人物注册事件
                    
                    
                    $sql = "insert into game1(token,sid,uname,ulv,uyxb,uczb,uexp,uhp,umaxhp,ugj,ufy,uwx,usex,vip,nowmid,endtime,sfzx) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute(array($token,$sid,$username,'1','2000','100','0','35','35','12','5','0',$sex,'0',$firstmid,$nowdate,1));

                    $gonowmid = $encode->encode("cmd=gomid&newmid=$gameconfig->firstmid&sid=$sid");
                    echo '<meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">';
                    echo $username."欢迎来到".$game_name;
                    $sql = "insert into ggliaotian(name,msg,uid) values(?,?,?)";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute(array('系统通知',"万中无一的{$username}踏上了仙途",'0'));
                    header("refresh:1;url=?cmd=$gonowmid");
                }
                exit();
            }
            break;
            case 'gm_game_firstpage':
                $ym = 'game_main.php';
                break;
        case 'gomid':
            
            //场景事件。
            
            $ym = 'game/nowmid.php';
            break;
        case 'getginfo':
            $ym = 'game/ginfo.php';
            break;
        case 'pve':
            $ym = 'game/pve.php';
            break;
        case 'pvp':
            $ym = 'game/pvp.php';
            break;
        case 'pvegj':
            $ym = 'game/pve.php';
            break;
       case 'sendliaotian':
            if (isset($ltlx) && isset($ltmsg)){
                switch ($ltlx){
                    case 'all':
                        $player = player\getplayer($sid,$dblj);
                        if ($player->uname!=''){
                            $ltmsg = htmlspecialchars($ltmsg);
                            $sql = "insert into ggliaotian(name,msg,uid) values(?,?,?)";
                            $stmt = $dblj->prepare($sql);
                            $exeres = $stmt->execute(array($player->uname,$ltmsg,$player->uid));
                        }
                        $ym = 'game/liaotian.php';
                        break;
                    case "im":
                        $player = player\getplayer($sid,$dblj);
                        if ($player->uname!=''){
                            $ltmsg = htmlspecialchars($ltmsg);
                            $sql = "insert into imliaotian(name,msg,uid,imuid) values('$player->uname','$ltmsg',$player->uid,{$imuid})";
                            $cxjg = $dblj->exec($sql);
                            
                        }
                        $ym = 'game/liaotian.php';
                        break;
                }
            }
            break;
        case 'liaotian':
            $ym ='game/liaotian.php';
            break;
        case 'getplayerinfo':
            
            //查看对方玩家事件
            
            $ym ='game/otherzhuangtai.php';
            break;
        case 'gm':
            
            //进行设计者判断。
            
            $ym ='gm/main.php';
            break;
        case 'gm_exp_def':
            
            //表达式定义实现。
            
            if($def_post_canshu ==0){
            $ym = 'gm/gameexp_define_2.php';
            }elseif($def_post_canshu ==1){
                $key = $_POST['key'];
                $exp_type = $_POST['exp_type'];
                $exp = $_POST['exp'];
                $sql = "INSERT INTO system_exp_def(id, type, value) VALUES ('$key', '$exp_type', '$exp')";
                $cxjg = $dblj->exec($sql);
                $ym = 'gm/gameexp_define.php';
            }elseif($def_post_canshu ==2){
            $def_post_canshu =2;
            $ym = 'gm/gameexp_define_2.php';
            }elseif($def_post_canshu ==3){
            $sql = "DELETE FROM system_exp_def WHERE id = '$def_id'";
            $cxjg =$dblj->exec($sql);
            $ym ='gm/gameexp_define.php';
            }elseif($def_post_canshu ==4){
                $old_key = $_POST['okey'];
                $key = $_POST['key'];
                $exp_type = $_POST['def_type'];
                $exp = $_POST['exp'];
                $sql = "UPDATE system_exp_def set id = '$key',type = '$exp_type',value = '$exp' WHERE id = '$old_key'";
                $cxjg = $dblj->exec($sql);
                $ym ='gm/gameexp_define.php';
            }
            break;
        case 'gm_equip_def':
            
            //装备类型定义实现
            
            if($def_post_canshu ==1){
            $sql = "DELETE FROM system_equip_def WHERE name = '$equip_id' and type ='1'";
            $cxjg =$dblj->exec($sql);
            $gm_post_canshu = 1;
            $ym ='gm/gameequiptype_define.php';
            }elseif($def_post_canshu ==2){
                $equip_type = 1;
                $ym ='gm/gameequiptype_2.php';
            }elseif($def_post_canshu ==3){
                $key = $_POST['name'];
                if($gm_post_canshu ==1){
                $sql = "INSERT INTO system_equip_def(name, type) VALUES ('$key', '1')";
                $cxjg = $dblj->exec($sql);
                }elseif($gm_post_canshu ==2){
                $sql = "INSERT INTO system_equip_def(name, type) VALUES ('$key', '2')";
                $cxjg = $dblj->exec($sql);
                }
                $ym ='gm/gameequiptype_define.php';
            }elseif($def_post_canshu ==4){
                $sql = "DELETE FROM system_equip_def WHERE name = '$equip_id' and type ='2'";
                $cxjg =$dblj->exec($sql);
                $gm_post_canshu = 2;
                $ym ='gm/gameequiptype_define.php';
            }elseif($def_post_canshu ==5){
                $equip_type = 2;
                $ym ='gm/gameequiptype_2.php';
            }
            
            break;
        case 'gm_post_1':
            
            //定义游戏基本信息过程实现。
            
            if($gm_post_canshu == "1"){
            $game_name = htmlspecialchars($game_name);
            $game_desc = htmlspecialchars($game_desc);
            $sql = "UPDATE gm_game_basic SET game_name = '$game_name', game_desc = '$game_desc',
            money_name = '$money_name',money_measure = '$money_measure', promotion_exp = '$promotion_exp',
            promotion_cond = '$promotion_cond', mod_promotion_exp = '$mod_promotion_exp', mod_promotion_cond = '$mod_promotion_cond', 
            clan_promotion_exp = '$clan_promotion_exp', clan_promotion_cond = '$clan_promotion_cond',
            default_skill = '$default_skill', entrance_id = '$firstmid', entrance_map = '$firstmidname', game_status = '$game_status'";
            $cxjg = $dblj->exec($sql);
            }
            $ym ='gm/gamebasic_info.php';
            break;
        case 'gm_map_submit':
            
            //地图更新相关事件。
            
            $target_midid = $_POST['id'];
            $old_area_id = $_POST['old_area_id'];
            if($gm_map_canshu == 1){
                foreach ($_POST as $column_name => $column_value) {
                    $column_name = 'm' . $column_name;
                    switch($column_name){
                        case 'msid':
                            break;
                        case 'mold_area_id':
                            break;
                        case 'marea_id':
                            //查询旧区域id和mapid字段值
                            $sql = "SELECT mapid FROM system_area WHERE id = $old_area_id";
                            $stmt = $dblj->query($sql);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $old_mapid = $row['mapid'];
                            //更新新区域的mapid字段
                            $sql = "UPDATE system_map SET marea_id = '$column_value' WHERE mid ='$target_midid'";
                            $stmt = $dblj->exec($sql);
                            if ($old_area_id != $column_value) {
                                //如果旧区域中mapid只有一个值，则直接将该值删除
                                if ($old_mapid == $target_midid) {
                                    $sql = "UPDATE system_area SET mapid = NULL WHERE id = $old_area_id";
                                    } else {
                                        //如果旧区域中mapid有多个值，则将目标地图id从mapid中移除
                                        $mapid_arr = explode(',', $old_mapid);
                                        $index = array_search($target_midid, $mapid_arr);
                                        if ($index !== false) {
                                            array_splice($mapid_arr, $index, 1);
                                            $new_mapid = implode(',', $mapid_arr);
                                            $sql = "UPDATE system_area SET mapid = '$new_mapid' WHERE id = $old_area_id";
                                        }
                                        
                                    }
                                    $stmt = $dblj->exec($sql);
                                
                            
                            //更新新区域的mapid字段
                                //查询新区域的mapid字段值
                                $sql = "SELECT mapid FROM system_area WHERE id = $column_value";
                                $stmt = $dblj->query($sql);
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $area_mapid = $row['mapid'];
                                //如果新区域中mapid为空，则直接将目标地图id赋值给mapid
                                if (empty($area_mapid)) {
                                    $new_mapid = $target_midid;
                                } else {
                                    //如果新区域中mapid不为空，则在mapid末尾加上目标地图id
                                    $mapid_arr = explode(',', $area_mapid);
                                    if (!in_array($target_midid, $mapid_arr)) {
                                        $mapid_arr[] = $target_midid;
                                        $new_mapid = implode(',', $mapid_arr);
                                        
                                    }
                                    
                                }
                                //更新新区域的mapid字段
                                $sql = "UPDATE system_area SET mapid = '$new_mapid' WHERE id = $column_value";
                                $stmt = $dblj->exec($sql);
                                //更新map表中area_name
                                $sql = "select name from system_area where id = $column_value";
                                $stmt = $dblj->query($sql);
                                $stmt->bindColumn('name',$area_name);
                                $area_name = $stmt->fetchColumn();
                                $sql = "UPDATE system_map SET marea_name = '$area_name' where mid = $target_midid";
                                $stmt = $dblj->exec($sql);
                            }
                                break;
                        case 'marea_name':
                            break;
                        default:
                            $sql2 = "UPDATE system_map SET $column_name = '$column_value' WHERE mid ='$target_midid'";
                            //var_dump($sql2);
                            $stmt = $dblj->exec($sql2);
                            break;
                    }
                    
}
            }
            $ym = 'gm/gm_map/map_attr_def.php';
            break;
        case 'gm_game_basicinfo':
            $ym ='gm/gamebasic_info.php';
            break;
        case 'gm_game_expdefine':
            $ym ='gm/gameexp_define.php';
            break;
        case 'gm_game_attrdefine':
            $ym = 'gm/gameattr_define.php';
            break;
        case 'gm_delete_attr':
            
            //属性删除过程实现
            
            $sql = "DELETE FROM gm_game_attr WHERE id = '$gm_game_attr_id' AND value_type = '$gm_post_canshu'";
            $cxjg =$dblj->exec($sql);
            switch($gm_post_canshu){
                case '1':
                    $delete_column = "u".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_player DROP COLUMN $delete_column;";
                    break;
                case '3':
                    $delete_column = "n".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_npc DROP COLUMN $delete_column;";
                    break;
                case '4':
                    $delete_column = "i".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_item DROP COLUMN $delete_column;";
                    break;
                case '5':
                    $delete_column = "m".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_map DROP COLUMN $delete_column;";
                    break;
                case '6':
                    $delete_column = "j".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_skill DROP COLUMN $delete_column;";
                    break;
            }
            $cxjg =$dblj->exec($sql);
            $ym = 'gm/gameattr_define.php';
            break;
        case 'gm_post_2':
            
            //属性更新过程实现
            
            if(isset($gm_post_canshu_2) && $gm_post_canshu !=8){
            $sql = "UPDATE gm_game_attr SET  name = '$gm_name',
            default_value = '$gm_default_value',if_show = '$gm_attr_hidden' where id = '$gm_id' AND value_type = '$gm_post_canshu_2';";
            $cxjg =$dblj->exec($sql);
            }elseif ($gm_post_canshu == 8) {
                //var_dump($gm_default_value);
                switch($gm_attr_type){
                    case '0':
                        $add_type = "INT DEFAULT '{$gm_default_value}'";
                        break;
                    case '1':
                        $add_type = "VARCHAR(255) DEFAULT '{$gm_default_value}'";
                        break;
                    case '2':
                        /*if(intval($gm_default_value) != 0||intval($gm_default_value) != 1)
                        {
                        $ym = 'gm/gameattr_define.php';
                        break;
                        }else{
                        $add_type = "TINYINT(1) DEFAULT {$gm_default_value}";
                        }*/
                        $add_type = "TINYINT(1) DEFAULT '{$gm_default_value}'";
                        break;
                }
                
            switch($gm_post_canshu_2){
                case '1':
                    $update_column = "u".$gm_id;
                    //var_dump($update_column);
                    //var_dump($add_type);
                    $sql = "ALTER TABLE system_player ADD `$update_column` $add_type;";
                    //var_dump($sql);
                    break;
                case '3':
                    $update_column = "n".$gm_id;
                    $sql = "ALTER TABLE system_npc ADD `$update_column` $add_type;";
                    break;
                case '4':
                    $update_column = "i".$gm_id;
                    $sql = "ALTER TABLE system_item ADD `$update_column` $add_type;";
                    break;
                case '5':
                    $update_column = "m".$gm_id;
                    $sql = "ALTER TABLE system_map ADD `$update_column` $add_type;";
                    var_dump($sql);
                    break;
                case '6':
                    $update_column = "j".$gm_id;
                    $sql = "ALTER TABLE system_skill ADD `$update_column` $add_type;";
                    break;
            }
            $cxjg =$dblj->exec($sql);
            //这边要做一个具体大表的列名插入
            //如：$sql = "ALTER TABLE $这边判断是哪个大表 CHANGE 旧表名 新表名 这边是字段类型;";
            $sql = "INSERT INTO gm_game_attr(id, name, value_type, default_value, if_show, attr_type) VALUES ('$gm_id', '$gm_name', '$gm_post_canshu_2', '$gm_default_value', '$gm_attr_hidden', '$gm_attr_type')";
            $gm_post_canshu=$gm_post_canshu_2;
            $cxjg =$dblj->exec($sql);
            }
            $ym = 'gm/gameattr_define.php';
            break;
        case 'gm_post_3':
            
            //定义游戏默认入口实现
            
            $sql = "UPDATE gm_game_basic SET entrance_id = '$target_mid',
            entrance_map = '$target_midname'";
            $cxjg =$dblj->exec($sql);
            $ym = 'gm/gamebasic_info.php';
            break;
        case 'game_page_2':
            $ym = 'gm/game_page_2.php';
            break;
        case 'game_event_page_1':
            $ym = 'gm/game_event_page_1.php';
            break;
        case 'gm_post_4':
            
            //地图添加相关事件
            
            if($map_add_canshu == 1){
                $sql = "INSERT INTO system_map (marea_name, mname, marea_id) VALUES ('$marea_name', '未命名', $qy_id)";
                $cxjg =$dblj->exec($sql);
                $target_midid = $dblj->lastInsertId();
                // 查询语句
                $sql = "SELECT mapid FROM system_area WHERE id = '$qy_id'";
                $stmt = $dblj->query($sql);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    // 获取当前mapid字段值
                    $current_mapid = $row['mapid'];
                    // 更新mapid字段
                    if (empty($current_mapid)) {
                        // 如果mapid为空，则直接赋值为$target_midid
                        $new_mapid = $target_midid;
                        
                    } else {
                        // 如果mapid不为空，则在后面加上逗号和$target_midid
                        $new_mapid = $current_mapid . ',' . $target_midid;
                        
                    }
                    // 执行更新操作
                    $updateSql = "UPDATE system_area SET mapid = '$new_mapid' WHERE id = '$qy_id'";
                    $updateStmt = $dblj->exec($updateSql);
                    $ym = 'gm/gm_map_3.php';
}  
            }elseif($delete_canshu == 1){
                
                //地图删除相关事件
                
                $post_canshu = 1;
                $marea_id = $area_id;
                $sql = "SELECT mapid FROM system_area WHERE id = $marea_id";
                $stmt = $dblj->query($sql);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $delete_mapid = $row['mapid'];
                var_dump($delete_mapid);
                //如果旧区域中mapid只有一个值，则直接将该值删除
                if ($delete_mapid == $target_midid) {
                    $sql = "UPDATE system_area SET mapid = NULL WHERE id = $marea_id";
                    $stmt = $dblj->exec($sql);
                    } else {
                     //如果旧区域中mapid有多个值，则将目标地图id从mapid中移除
                      $mapid_arr = explode(',', $delete_mapid);
                      $index = array_search($target_midid, $mapid_arr);
                      if ($index !== false) {
                      array_splice($mapid_arr, $index, 1);
                      $new_mapid = implode(',', $mapid_arr);
                      $sql = "UPDATE system_area SET mapid = '$new_mapid' WHERE id = $marea_id";
                            }
                      $stmt = $dblj->exec($sql);
                            }
                            // 删除system_map表中指定mid的数据
                            $deleteSql = "DELETE FROM system_map WHERE mid = '$target_midid'";
                            $deleteStmt = $dblj->exec($deleteSql);
                            $ym = 'gm/gm_map_2.php';
            }else{
            $ym = 'gm/gm_map_3.php';
            }
            break;
        case 'gm_game_equiptypedefine':
            $ym = 'gm/gameequiptype_define.php';
            break;
        case 'gm_game_globaleventdefine':
            $ym = 'gm/gameglobalevent_define.php';
            break;
        case 'gm_game_pagemoduledefine':
            $ym = 'gm/gamepagemodule_define.php';
            break;
        case 'gm_game_photomanage':
            $ym = 'gm/gamephoto_manage.php';
            break;
        case 'gm_game_skilldefine':
            $ym = 'gm/gameskill_define.php';
            break;
        case 'gm_game_itemdesign':
            $ym = 'gm/gameitem_design.php';
            break;
        case 'gm_game_npcdesign':
            $ym = 'gm/gamenpc_design.php';
            break;
        case 'gm_type_map':
            switch($gm_post_canshu){
                
                //地图各类元素定义跳转实现
                
                case '1':
                    $ym = 'gm/gm_map/map_attr_def.php';
                    break;
                case '2':
                    $ym = 'gm/gm_map/map_op_def.php';
                    break;                    
                case '3':
                    $ym = 'gm/gm_map/map_event_def.php';
                    break; 
                case '4':
                    $ym = 'gm/gm_map/map_task_def.php';
                    break; 
                case '5':
                    $ym = 'gm/gm_map/map_out.php';
                    break;                     
                case '6':
                    $ym = 'gm/gm_map/map_npc_who.php';
                    break;                     
                case '7':
                    $ym = 'gm/gm_map/map_item_what.php';
                    break;                     
                case '8':
                    $ym = 'gm/gm_map/map_copy.php';
                    break;                     
                case '9':
                    $delete_canshu = 1;
                    $ym = 'gm/gm_map/map_delete.php';
                    break; 
                case '10':
                    $ym = 'gm/gm_map/map_update.php';
                    break;                     
                case '11':
                    $ym = 'gm/gm_map/map_entrance.php';
                    break;                     
            }
            break;
        case 'zbinfo':
            $ym = 'game/zbinfo.php';
            break;
        case 'npc':
            $ym = "npc/npc.php";
            break;
        case 'paihang';
            $ym = 'game/paihang.php';
            break;
        case 'chakanzb':
            $ym = 'game/zbinfo.php';
            break;
        case 'djinfo':
            $ym = 'game/djinfo.php';
            break;
        case 'getbagzb':
            $ym = 'game/bagzb.php';
            break;
        case 'getbagyp':
            $ym = 'game/bagyp.php';
            break;
        case 'getbagjn':
            $ym = 'game/bagjn.php';
            break;
        case 'xxzb':
            $ym = 'game/zhuangtai.php';
            break;
        case 'setzbwz':
            $ym = 'game/zhuangtai.php';
            break;
        case 'allmap':
            $ym = 'game/allmap.php';
            break;
        case 'target_mid':
            $ym = 'gm/gm_map.php';
            break;
        case 'gm_map':
            $ym = 'gm/gm_map.php';
            break;
        case 'gm_map_2':
            $ym = 'gm/gm_map_2.php';
            break;
        case 'area_post':
            
            //区域更新相关事件
            
            if($gm_post_canshu ==1){
            $ym = 'gm/gm_map/area_add.php';
            break;
            }elseif($gm_post_canshu ==0){
            $last_id = $_POST['last_id'];
            $name = $_POST['name'];
            $sql = "INSERT INTO system_area set id = '$last_id',name = '$name';";
            $cxjg =$dblj->exec($sql);
            $ym = 'gm/gm_map_2.php';
            break;                
            }
        case 'delezb':
            $ym = 'game/bagzb.php';
            break;
        case 'getbagdj':
            $ym = 'game/bagdj.php';
            break;
        case 'upzb':
            $ym = 'game/zbinfo.php';
            break;
        case 'goxiulian':
            $ym = 'game/xiulian.php';
            break;
        case 'startxiulian':
            $ym = 'game/xiulian.php';
            break;
        case 'endxiulian':
            $ym = 'game/xiulian.php';
            break;
        case 'task':
            $ym = 'game/task.php';
            break;
        case 'mytask':
            $ym = 'game/playertask.php';
            break;
        case 'mytaskinfo':
            $ym = 'game/playertaskinfo.php';
            break;
        case 'boss':
            $ym = 'game/bossinfo.php';
            break;
        case 'ypinfo':
            $ym = 'game/ypinfo.php';
            break;
        case 'pvb':
            $ym = 'game/boss.php';
            break;
        case 'chongwu':
            $ym = 'game/chongwu.php';
            break;
        case 'jninfo':
            $ym = 'game/jninfo.php';
            break;
        case "zbinfo_sys":
            $ym = 'game/zbinfo_sys.php';
            break;
        case "tupo":
            $ym = 'game/tupo.php';
            break;
        case "fangshi":
            $ym = "game/fangshi.php";
            break;
        case "club":
            $ym = "game/club.php";
            break;
        case "clublist":
            $ym = "game/clublist.php";
            break;
        case "duihuan":
            $ym = "game/duihuan.php";
            break;
        case "im":
            $ym = "game/im.php";
            break;
        case "nowonline":
            $ym = "gm/nowonline_player.php";
            break;
    }
    
    
    
    if (!isset($sid) || $sid=='' ){

        if ($cmd!='cj' && $cmd!=='cjplayer'){
            header("refresh:0;url=index.php");
            exit();
        }
    }else{
        if ($cmd != 'pve' && $cmd!='pvegj'){
            $sql = "delete from midguaiwu where sid='$sid'";//删除地图该玩家已经被攻击怪物
            $dblj->exec($sql);
        }
        $player = \player\getplayer($sid,$dblj);
        if ($player->ispvp!=0){
            $pvper = \player\getplayer1($player->ispvp,$dblj);
            $pvpcmd = $encode->encode("cmd=pvp&uid=$pvper->uid&sid=$sid");
            $pvpcmd = "<a href='?cmd=$pvpcmd'>还击</a>";
            $pvpts = "$pvper->uname 正在攻击你：$pvpcmd<br/>";
        }
        if (\player\istupo($sid,$dblj) !=0 && $player->uexp >= $player->umaxexp){
            $tupocmd = $encode->encode("cmd=tupo&sid=$sid");
            $tupocmd = "<a href='?cmd=$tupocmd'>突破</a>";
            $tpts =  "你即将需要突破,否则将不能获得经验:$tupocmd<br/>";
        }
        $nowdate = date('Y-m-d H:i:s');
        
        
        
        
        //这里可以设置刷新间隔
        $second=floor((strtotime($nowdate)-strtotime($player->endtime))%86400);//获取刷新间隔
        if ($second>=600){
            //单位是秒
            echo '<meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">';
            echo $player->uname."离线时间过长，请重新登陆";
            $sql = "update game1 set endtime='$nowdate',sfzx=0 WHERE sid='$sid'";
            $dblj->exec($sql);
            header("refresh:1;url=index.php");
            exit();
        }else{
            $sql = "update game1 set endtime='$nowdate',sfzx=1 WHERE sid='$sid'";
            $dblj->exec($sql);
        }
    }
}else{
    
    //如果一切都不符合条件，就跳转到注册界面。
    
    header("refresh:0;url=index.php");
    exit();
}


$end_time = microtime(true);
$execution_time = ($end_time - $start_time) * 1000;// 单位是毫秒


/*$stmt = $dblj->query("SHOW OPEN TABLES");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) {
    echo $row['Database'] . " " . $row['Table'] . " " . $row['In_use'] . "<br>";
}
//pdo数据库性能调试工具。
$dbType = $dblj->getAttribute(PDO::ATTR_DRIVER_NAME);
$connInfo = $dblj->getAttribute(PDO::ATTR_SERVER_INFO);
// 输出结果
echo "Database type: " . $dbType . "<br>";
echo "Connection info: " . $connInfo . "<br>";
*/


?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <title><?php echo $gm_post->game_name ?></title>
    <link rel="stylesheet" href="css/gamecss.css">
    <link rel="shortcut icon" href="http://xunxian.txsj.ink/images/favicons.ico"/>
</head>
<body>
<?php

    if (!$ym==''){
        echo$tpts;
        if ($ym!="game/pvp.php"){
            echo $pvpts;
        }

        include "$ym";
    }?>
</body>
<footer>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <?php echo date('Y-m-d H:i:s');?><br/> 
    <?php echo "页面执行时间为：{$execution_time} 毫秒"; ?>
</footer>
</html>