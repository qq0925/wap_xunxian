<?php
session_start();
$start_time = microtime(true);
//error_reporting(0);
//ini_set('display_errors', '0');
require 'class/player.php';
require 'class/encode.php';
require 'class/gm.php';
include 'pdo.php';
require 'class/lexical_analysis.php';
require 'class/event_data_get.php';
require 'class/data_lexical.php';
include 'class/iniclass.php';
include 'class/global_event_step_change.php';
// require_once 'class/autoreact.php';
// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");
if(!$encode){
$encode = new \encode\encode();
}
if(!$player){
$player = new \player\player();
}
if(!$gm_post){
$gm_post = new \gm\gm();
$gm_post = \gm\gm_post($dblj);
}
if(!$guaiwu){
$guaiwu = new \player\guaiwu();
}
if(!$clmid){
$clmid = new \player\clmid();
}
if(!$npc){
$npc = new \player\npc();
}

//3-4ms


$Dcmd = $_SERVER['QUERY_STRING'];

$allow_sep = "300";//间隔时间，单位毫秒。

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

//@parse_str($Dcmd);//解析Dcmd转为变量

if (isset($Dcmd)) {
    parse_str($Dcmd, $variables); // $variables 是解析后的变量数组
    // 这里可以对 $variables 数组进行操作
}
$cmd = $variables['cmd'];
if (isset($cmd)&&!isset($sid)){
    $Dcmd = $encode->decode($cmd);

    parse_str($Dcmd,$variables);
    extract($variables);
    if (!empty($_POST)) {
        extract($_POST);
    }
    // 使用 parse_str 解析字符串
    parse_str($Dcmd, $parsedVars);
    // 获取当前页面的所有变量
    $allVars = get_defined_vars();
    // 存储 parse_str 解析后的变量
    $parsedVariables = [];
        
    // 遍历所有变量，将 parse_str 解析结果与当前页面变量进行比较
    $player = \player\getplayer($sid,$dblj);
    $uis_designer = $player->uis_designer;
    if($uis_designer ==1){
    foreach ($allVars as $name => $value) {
        if (isset($parsedVars[$name])) {
            $parsedVariables[$name] = $parsedVars[$name];
        }
    }
    foreach ($parsedVariables as $name => $value) {
        $is_designer_parse_str .= "{$name}={$value}<br/>";
    }
    $designer_para_cmd = $cmd;
    }

//3-4ms

while (\player\upplayerlvl($sid, $dblj) == 1) {
    $cacheKey = 'user:'.$sid.':'.'u.lvl';
    $redis->del($cacheKey);
    $parents_cmd = 'gm_scene_new';
    $ret = $ret ?? global_event_data_get(22, $dblj);
    if ($ret) {
        global_events_steps_change(22, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', null, null, $para);
    }
}



//10-11ms

if($cmd !='main_target_event'||!$para){
$sql = "delete from system_player_inputs where sid = '$sid'";
$dblj->exec($sql);
}
if($cmd !="pve_fighting"&&$cmd !="pve_fight"&&$player->uis_pve==0){
$sql = "delete from game2 where sid = '$sid'";
$dblj->exec($sql);
$sql = "delete from game3 where gid = '$sid'";
$dblj->exec($sql);
}
if($cmd =='logout'){
//logout($sid);
$nowdate = date('Y-m-d H:i:s');
echo $player->uname."已成功退出登陆！";
$sql = "update game1 set endtime='$nowdate',sfzx=0,uis_pve=0,ucmd='' WHERE sid='$sid'";
$dblj->exec($sql);
$sql = "update game4 set device_agent='' WHERE sid='$sid'";
$dblj->exec($sql);
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="1;URL=index.php">
HTML;
echo $refresh_html;
//header("refresh:1;url=index.php");
exit();
}

 if((!isset($sid)||!$sid) &&$cmd !='cj' &&$cmd !='cjplayer'){
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="0;URL=index.php">
HTML;
echo $refresh_html;
    // header("refresh:0;url=index.php");
exit();
 }


// 10-11ms

    ///////////分割处理线，上为Dcmd解析，下为cmd关键逻辑

// $ucmd = $player->ucmd;
// if($ucmd == 0){
// $ucmd = 1;
// \player\changeplayersx('ucmd',$ucmd,$sid,$dblj);
// }
// \player\changeplayersx('ulast_cmd',$ucmd,$sid,$dblj);

//$ucmd = (int)$ucmd;


$wjid = $player->uid;
$is_Designer = $player->uis_designer;

// $if_online = $player->sfzx;
// if($if_online ==1){
    
// }
// 设置文件路径，使用相对路径
$file = sprintf("./ache/%s/user.ini", $wjid);

include("./ini/user_ini.php"); // 包含用户配置文件的逻辑

if($refresh_cmid==1){
    $iniFile->updItem('验证信息', ['xcmid值' => 1, 'dcmid值' => 1]);
}


//来源页面信息
$kcmid = $iniFile->getItem('验证信息', 'cmid值');
if ($kcmid == 0) {
$kcmid = 1;
$iniFile->updItem('验证信息', ['cmid值' => $kcmid]);
}
$iniFile->updItem('最后页面id', ['页面id' => $kcmid]);


//当前页面信息
$cljid = $iniFile->getItem('超链接值', $ucmd);
if ($cljid == "") {
$cljid = 1;
}
$iniFile->updItem('验证信息', ['cmid值' => $cljid]);
$show_cmid = $iniFile->getItem('验证信息', 'cmid值');
                $user = $iniFile->getCategory('验证信息');
                if($player->uis_designer ==1){
                $test_code_text = $user;
                include_once 'gm/gm_test_code_show/gm_test_code_user.php';//user测试代码显示
                }
                $xyid = "";
                $xyid = $user['uid'] ?? 0;
                $b1 = $user['年'];
                $b2 = $user['月'];
                $b3 = $user['日'];
                $b4 = $user['时'];
                $b5 = $user['分'];
                $b6 = $user['秒'];
                $cid = $user['cmid值'];
                $xcid = $user['xcmid值'];
                $dcid = $user['dcmid值'];
                if ($cid == 0) {
                    $cid = 1;
                }

                // 初始化链接数组
                $cdid = $clj = [];
                //最小值
                $a4 = $dcid + 1;
                //cmd及超链接值
                $cmid = $dcid + 1;
                $cdid[] = $cmid;
                $clj[] = 'gm_game_firstpage';
                if ($ucmd >= $xcid && $ucmd <= $dcid || $ucmd == 1) {
                    
                $cmdd = $cid;
                $y = date('Y') * 1;
                $m = date('m') * 1;
                $d = date('d') * 1;
                $h = date('H') * 1;
                $i = date('i') * 1;
                $s = date('s') * 1;
                $iniFile->updItem('验证信息', ['年' => $y, '月' => $m, '日' => $d, '时' => $h, '分' => $i, '秒' => $s]);
            } else {
                $yymid = ($iniFile->getItem('最后页面id', '页面id'));
                if($cmd =='cj' || $cmd == 'cjplayer' ||$cmd =='login'){
                    goto THEMAINTASK;
                }
                elseif ($yymid == 0){
                    $cmdd = 1;
                }else{
                    if($is_Designer ==0){
                    $cmid = $cmid + 1;
                    $cdid[] = $cmid;
                    $clj[] = $cmd;
                    if($cmd =='gm_game_firstpage'){
                    $gonowmid = $encode->encode("cmd=gm_game_firstpage&ucmd=$cmid&sid=$sid");
                    }else{
                    $gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
                    }
                    $html = <<<HTML
                    <link rel="stylesheet" href="css/gamecss.css">
                    <br/><font color = "red">禁止非法回退及恶意刷新操作，错误代码:{$cmid}</font><br/>
                    <br/>
                    <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
                    $a5 = $cmid;
                    $iniFile->updItem('验证信息', ['xcmid值' => $a4, 'dcmid值' => $a5]);
                    //$html_2 = file_get_contents('temporary_page.html'); // 读取文件内容
                    exit($html); // 输出文件内容并终止脚本执行
                    }
                }
                $iniFile->updItem('验证信息', ['cmid值' => $cmdd]);
            }

            if($cmdd >=1){
                // 13-15ms
            if($ucmd >10000){
                echo "触发防挂验证<br/>";
                $refresh_cmid = $encode->encode("cmd=$cmd&ucmd=1&refresh_cmid=1&sid=$sid");
                $html = <<<HTML
                <link rel="stylesheet" href="css/gamecss.css">
                <br/><font color = "red">点击清除验证，返回游戏</font><br/>
                <br/>
                <a href="?cmd=$refresh_cmid">清除验证</a>
HTML;
                exit($html);
            }
            goto THEMAINTASK;
            }else{
                //路径
                $path = 'ache/' . $wjid;
                //ini文件名字
                $inina = "user.ini";
                $ininame = $path . "/" . $inina;
                $iniFile = new iniFile($ininame);
            }

THEMAINTASK:
    switch ($cmd){
        case 'cj'://创建账号
            $ym = 'game/cj.php';
            break;
        case 'login'://登录
            $player = \player\getplayer($sid,$dblj);
            // 用户登录成功后生成并存储会话标识
            // $ret = check_if_logged($sid);
            // $deviceInfo = $_SERVER['HTTP_USER_AGENT'];// 使用设备信息作为标识
            // if(!$ret || $ret !=$_SESSION['sessionID']){
            // session_start();
            // $sessionID = uniqid();
            // $_SESSION['sessionID'] = $sessionID;
            // //logout($sid);
            // //login($sid,$_SESSION['sessionID'],$deviceInfo);
            // }else{
            // //login($sid,$_SESSION['sessionID'],$deviceInfo);
            // }
            
            
            $event_data = global_event_data_get(2,$dblj);
            $event_cond = $event_data['system_event']['cond'];
            $event_cmmt = $event_data['system_event']['cmmt'];
            $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid);
            if(is_null($register_triggle)){
                $register_triggle =1;
            }
            if(!$register_triggle){
            echo $event_cmmt."<br/>";
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="1;URL=index.php">
HTML;
echo $refresh_html;
            //header("refresh:1;url=index.php");
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
                $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid);
                if(is_null($step_triggle)){
                $step_triggle =1;
                    }
                if(!$step_triggle){
                    echo $step_cmmt2."<br/>";
                    }elseif($step_triggle){
                    echo $step_cmmt."<br/>";
                    $ret = attrsetting($step_s_attrs,$sid);
                    $ret = attrchanging($step_m_attrs,$sid);
                    $ret = itemchanging($step_items,$sid);
                    $ret = skillschanging($step_a_skills,$sid,1);
                    $ret = skillschanging($step_r_skills,$sid,2);
                    }
                }
                        
            }
            $gofirst = $encode->encode("cmd=gm_game_firstpage&ucmd=1&sid=$sid");
            $dblj->exec("DELETE from system_npc_midguaiwu where nsid = '$sid'");
            $item_burthen = \player\update_item_burthen($sid,$dblj);
            $nowdate = date('Y-m-d H:i:s');
            $sql = "update game1 set endtime='$nowdate',minutetime = '$nowdate',sfzx=1,uis_pve = 0,uburthen = '$item_burthen' WHERE sid='$sid'";
            $cxjg = $dblj->exec($sql);
            $sql = "UPDATE game1 SET minutetime = DATE_ADD(minutetime, INTERVAL 1 MINUTE) WHERE sid = '$sid'";
            $dblj->exec($sql);
            // 清空所有临时变量
            $dblj->exec("DELETE from player_temp_attr where obj_id = '$sid'");
            echo '正在进入游戏...<br/>';
            $refresh_html =<<<HTML
            <meta http-equiv="refresh" content="1;URL=?cmd=$gofirst">
HTML;
            //header("refresh:1;url=?cmd=$gofirst");
            echo $refresh_html;
            }
            break;
        case 'cjplayer'://具体创建写入
            if (isset($token) && isset($username) && isset($sex)){
                if(strlen($username)<6 || strlen($username)>12){
                    echo "用户名不能太短或者太长";
                    $ym = 'game/cj.php';
                    break;
                }
                
                $sql="select uname from game1 where uname='$username'";
                $cxjg = $dblj->query($sql);
                $name_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
                if($name_ret['uname']){
                    echo "用户名已被使用！";
                    $ym = 'game/cj.php';
                    break;
                }
                $username = htmlspecialchars($username);
                $sid = md5($username.$token.'19980925');
                $sql="select * from game1 where token='$token'";
                $cxjg = $dblj->query($sql);
                $cxjg->bindColumn('sid',$player->sid);
                $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
                $nowdate = date('Y-m-d H:i:s');
                if ($player->sid ==''){
                    $gameconfig = \player\getgameconfig($dblj);
                    $firstmid = $gameconfig->entrance_id;
                    
                    $gofirst = $encode->encode("cmd=gm_game_firstpage&ucmd=1&sid=$sid");
                    $sql = "insert into game1(token,sid,uname,usex,nowmid,endtime,sfzx) values(?,?,?,?,?,?,?)";
                    //默认用户表技能更新
                    
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute(array($token,$sid,$username,$sex,$firstmid,$nowdate,1));
                    
                    $sql = "select designer from userinfo where token='$token'";
                    $cxjg = $dblj->query($sql);
                    $cxjg->bindColumn('designer',$designer);
                    $cxjg->fetch(PDO::FETCH_ASSOC);
                    
                    if($designer ==1){
                    $sql = "update game1 set uis_designer = '1' WHERE sid=?";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute(array($sid));
                    }
                    
                    $userAgent = $_SERVER['HTTP_USER_AGENT'];
                    $dblj->exec("insert into game4 (device_agent,sid)values('$userAgent','$sid')");
                    //注册事件逻辑
                    $event_data = global_event_data_get(1,$dblj);
                    $event_cond = $event_data['system_event']['cond'];
                    $event_cmmt = $event_data['system_event']['cmmt'];
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
                        $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid);
                        if(is_null($step_triggle)){
                        $step_triggle =1;
                    }
                        if(!$step_triggle){
                            echo $step_cmmt2."<br/>";
                            }elseif($step_triggle){
                            echo $step_cmmt."<br/>";
                            $ret = attrsetting($step_s_attrs,$sid);
                            $ret = attrchanging($step_m_attrs,$sid);
                            $ret = itemchanging($step_items,$sid);
                            $ret = skillschanging($step_a_skills,$sid,1);
                            $ret = skillschanging($step_r_skills,$sid,2);
                            }
                        }
                        
                    }
                    $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid);
                    if(is_null($register_triggle)){
                        $register_triggle =1;
                    }
                    if(!$register_triggle){
                    echo $event_cmmt."<br/>";
                    $sql = "DELETE FROM game1 WHERE sid = '$sid';";
                    $stmt = $dblj->exec($sql);
                    try {// 获取当前最大自增值
                    $query = "SELECT MAX(uid) as max_uid FROM game1";
                    $result = $dblj->query($query);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $maxUid = $row["max_uid"];
                    // 更新表的自增值
                    $query = "ALTER TABLE game1 AUTO_INCREMENT = " . ($maxUid - 1);
                    $dblj->exec($query);
                    } catch(PDOException $e) {
                        echo "错误: " . $e->getMessage();
}
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="1;URL=index.php">
HTML;
echo $refresh_html;
                    //header("refresh:1;url=index.php");
                    }elseif($register_triggle){
                    echo $username.","."欢迎来到".$gameconfig->game_name."<br/>";
                    \gm\insertsystemmsg('系统',"万中无一的{$username}踏上了旅途",'0',$dblj);
                    $sql = "update game1 set endtime='$nowdate',minutetime = '$nowdate',sfzx=1 WHERE sid='$sid'";
                    $cxjg = $dblj->exec($sql);
                    for($i = 1;$i <8;$i++){
                    $sql = "insert into system_fight_quick(sid,quick_pos) values(?,?)";
                    $stmt = $dblj->prepare($sql);
                    $stmt->execute(array("{$sid}","{$i}"));
                    }
                    $sql = "UPDATE game1 SET minutetime = DATE_ADD(minutetime, INTERVAL 1 MINUTE) WHERE sid = '$sid'";
                    $dblj->exec($sql);
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="1;URL=?cmd=$gofirst">
HTML;
echo $refresh_html;
                    //header("refresh:1;url=?cmd=$gofirst");
                }
            }else{
                echo "非法操作：疑似重复注册，请文明游戏！<br/>";
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="3;URL=index.php">
HTML;
echo $refresh_html;
                //header("refresh:3;url=index.php");
                exit();
            }
            }
            break;
        case 'get_system_time'://获取系统时间
            $ym = 'game/game_detail_time.php';
            break;
        case 'gm_cheat'://GM修改器
            
            // 检查是否有 POST 请求
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 获取输入框的值
            $id = $_POST['id'];
            $attr_name = $_POST['attr_name'];
            $attr_value = $_POST['attr_value'];
            // 查询数据

            // 检查字段是否存在
            $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$attr_name'");
            $result_2 = $db->query("SELECT value from system_addition_attr where name = '$attr_name' and sid = '$sid'");
            // 如果字段存在，则更新字段值
            if ($result->num_rows > 0 ) {
                $updateQuery = "UPDATE game1 SET $attr_name = '$attr_value' WHERE sid = '$sid'";
                $db->query($updateQuery);
                echo "标准属性值更新成功。<br/>";
                $cmd = "gm_scene_new";
            } elseif($result_2->num_rows > 0){
                $updateQuery = "UPDATE system_addition_attr SET value = '$attr_value' WHERE sid = '$sid' and name = '$attr_name'";
                $db->query($updateQuery);
            echo "自定属性值更新成功。<br/>";
            $cmd = "gm_scene_new";
            } else{
                // 字段不存在，添加新字段并更新值
                $alterQuery = "INSERT INTO system_addition_attr(name,value,sid)values('$attr_name','$attr_value','$sid')";
                $db->query($alterQuery);
            echo "自定属性添加并更新成功。<br/>";
            $cmd = "gm_scene_new";
            }
            $ym = 'module_all/main_page.php';
        }else{
            $ym = 'gm/gm_cheat.php';
        }
            break;
        case 'gm_design_guide'://帮助文档
            $ym = 'gm/design_help.php';
            break;
        case 'gm_game_firstpage'://游戏首页
            $ym = 'game_main.php';
            break;
        case 'gm_global_notice'://游戏公告
            $ym = 'gm/gameglobal_notice.php';
            break;
        case 'pve_fight'://打怪事件,一次打一个
        
            // 查找以 user:$sid 开头的所有键
            $keys = $redis->keys("user:$sid*");
            // 删除所有匹配的键
            if (!empty($keys)) {
                $redis->del($keys);
            }
            $player = \player\getplayer($sid,$dblj);
            $pet = \player\getpet_fight($sid,$dblj);
            if($auto_canshu ==1){
                \player\changeplayersx('uauto_fight',1,$sid,$dblj);
            }elseif($auto_canshu ==2){
                \player\changeplayersx('uauto_fight',0,$sid,$dblj);
            }
            if($player->uis_pve ==0){
            
            $nmid = $player->nowmid;
            // 获取旧表字段列表
            $stmt = $dblj->prepare("SHOW COLUMNS FROM system_npc");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            // 需要排除的字段
            $exclude_columns = ['ncid']; // 需要排除的字段
            // 使用 array_diff 排除不需要的字段
            $columns = array_diff($columns, $exclude_columns);
            // 构建动态插入语句
            $cols = implode(", ",$columns);
            $nowdate = date('Y-m-d H:i:s');
            $sql = "INSERT INTO system_npc_midguaiwu ($cols, nmid,ncreate_time,nsid) SELECT $cols, :nmid ,:nowdate ,:nsid FROM system_npc_scene WHERE ncid = :ncid;";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':nmid', $nmid, PDO::PARAM_INT);
            $stmt->bindParam(':ncid', $ncid, PDO::PARAM_INT);
            $stmt->bindParam(':nowdate', $nowdate, PDO::PARAM_STR);
            $stmt->bindParam(':nsid', $sid, PDO::PARAM_STR);
            // 执行SQL
            if ($stmt->execute()) {
                // 获取受影响的行数
                $rowCount = $stmt->rowCount();
                
                // 检查是否有插入的行
                if ($rowCount > 0) {
                    $ngid = $dblj->lastInsertId();  // 获取最后插入的ID
                    if($nnot_dead ==0){
                        $dblj->exec("DELETE FROM system_npc_scene where ncid = '$ncid'");
                    }
                    \player\changeplayersx('uis_pve',1,$sid,$dblj);
                    $ym = 'module_all/scene_fight.php';
                }else{
                $be_feat = 1;
                }
}
            }
            $ym = 'module_all/scene_fight.php';
            break;
        case 'pve_fighting'://打怪事件
            // 查找以 user:$sid 开头的所有键
            $keys = $redis->keys("user:$sid*");
            // 删除所有匹配的键
            if (!empty($keys)) {
                $redis->del($keys);
            }
            $ym = 'module_all/scene_fight.php';
            break;
        case 'quick_set'://调用快捷键设置事件
            $ym = 'module_all/player_fight_quick_set.php';
            break;
       case 'sendliaotian'://发送聊天功能
            $player = player\getplayer($sid,$dblj);
            $nowdate = date('Y-m-d H:i:s');
            //$msg_interval = \player\getgameconfig($dblj)->player_send_global_msg_interval;
            if (isset($ltlx) && isset($ltmsg)&&$ltmsg!=""){
                switch ($ltlx){
                    case 'all':
                        //$second=floor((strtotime($nowdate)-strtotime($player->allchattime))%86400);//获取刷新间隔&& $second > $msg_interval
                        if ($player->uname!=''){//间隔公共聊天
                            $ltmsg = htmlspecialchars($ltmsg);
                            $sql = "insert into system_chat_data(name,msg,uid,send_time) values(?,?,?,?)";
                            $stmt = $dblj->prepare($sql);
                            $exeres = $stmt->execute(array($player->uname,$ltmsg,$player->uid,$nowdate));
                            // $sql = "UPDATE game1 set allchattime = '$nowdate' where sid = '$sid'";
                            // $stmt = $dblj->exec($sql);
                            $ltmsg = \lexical_analysis\color_string($ltmsg);
                            echo "你对大家说：".$ltmsg."<br/>";
                        }else{
                            $least_time = $msg_interval - $second;
                            echo "每{$msg_interval}秒才能发言一次！下次发言还需要{$least_time}秒！<br/>";
                        }
                        $ym = 'module_all/liaotian.php';
                        break;
                    case "im":
                        $check_uid = \player\getplayer(null,$dblj,$imuid)->uid;
                        if ($player->uname!='' &&$player->uid !=$imuid &&$check_uid){
                            $ltmsg = htmlspecialchars($ltmsg);
                                $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','$ltmsg',$player->uid,{$imuid},1,'$nowdate')";
                            $cxjg = $dblj->exec($sql);
                            $oid = $imuid;
                            $ltmsg = \lexical_analysis\color_string($ltmsg);
                            echo "发送成功!"."你对对方说：".$ltmsg."<br/>";
                            $ym = 'module_all/scene_oplayer_detail.php';
                        }else{
                            echo "发送失败！用户不存在！<br/>";
                            $ltlx = 'im';
                            $ym = 'module_all/liaotian.php';
                        }
                        break;
                    case "city":
                        //$second=floor((strtotime($nowdate)-strtotime($player->citychattime))%86400);//获取刷新间隔 && $second > $msg_interval
                        if ($player->uname!=''){
                        if ($player->uname!=''){
                            $ltmsg = htmlspecialchars($ltmsg);
                                $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','$ltmsg',$player->uid,{$imuid},2,'$nowdate')";
                            $cxjg = $dblj->exec($sql);
                            $oid = $imuid;
                            $sql = "UPDATE game1 set citychattime = '$nowdate' where sid = '$sid'";
                            $stmt = $dblj->exec($sql);
                            $ltmsg = \lexical_analysis\color_string($ltmsg);
                            echo "发送成功!"."你对大家说：".$ltmsg."<br/>";
                        }else{
                            echo "发送失败！<br/>";
                            $ltlx = 'city';
                        }
                        }else{
                            $least_time = $msg_interval - $second;
                            echo "每{$msg_interval}秒才能发言一次！下次发言还需要{$least_time}秒！<br/>";
                        }
                        $ym = 'module_all/liaotian.php';
                        break;
                    case "area":
                        //$second=floor((strtotime($nowdate)-strtotime($player->areachattime))%86400);//获取刷新间隔&& $second > $msg_interval
                        if ($player->uname!='' ){
                        if ($player->uname!=''){
                            $ltmsg = htmlspecialchars($ltmsg);
                                $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','$ltmsg',$player->uid,{$imuid},3,'$nowdate')";
                            $cxjg = $dblj->exec($sql);
                            $oid = $imuid;
                            $sql = "UPDATE game1 set areachattime = '$nowdate' where sid = '$sid'";
                            $stmt = $dblj->exec($sql);
                            $ltmsg = \lexical_analysis\color_string($ltmsg);
                            echo "发送成功!"."你对大家说：".$ltmsg."<br/>";
                        }else{
                            echo "发送失败！<br/>";
                            $ltlx = 'area';
                        }
                        }else{
                            $least_time = $msg_interval - $second;
                            echo "每{$msg_interval}秒才能发言一次！下次发言还需要{$least_time}秒！<br/>";
                        }
                        $ym = 'module_all/liaotian.php';
                        break;
                    case "team":
                        if ($player->uname!=''&&$player->uteam_id!=0){
                            $ltmsg = htmlspecialchars($ltmsg);
                                $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','$ltmsg',$player->uid,{$imuid},4,'$nowdate')";
                            $cxjg = $dblj->exec($sql);
                            $oid = $imuid;
                            $ltmsg = \lexical_analysis\color_string($ltmsg);
                            echo "发送成功!"."你对大家说：".$ltmsg."<br/>";
                        }else{
                            echo "发送失败！<br/>";
                            $ltlx = 'team';
                        }
                        $ym = 'module_all/liaotian.php';
                        break;
                }
            }
            else{
                echo "输入内容不能为空！<br/>";
                $ym = 'module_all/liaotian.php';
                break;
            }
            break;
        case 'liaotian'://聊天
            $ym ='module_all/liaotian.php';
            break;
        case 'getoplayerinfo'://查看对方玩家事件
            $player = player\getplayer($sid,$dblj);
            if($uid == $player->uid){
            $ym ='module_all/scene_player_detail.php';
            }else{
                if(!$oid){
                $oid = $uid;
                }
            //查看对方玩家事件
            $ym ='module_all/scene_oplayer_detail.php';
            }
            break;
        case 'getalloplayerinfo'://查看当前场景所有玩家
            $ym ='module_all/scene_alloplayer_list.php';
            break;
        case 'gm'://设计大厅
            $player = player\getplayer($sid,$dblj);
            $uis_designer = $player->uis_designer;
            //进行设计者判断。
            if($uis_designer ==1){
            $ym ='gm/main.php';
            }else{
                $old_scene = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$player->nowmid&sid=$sid");
                exit("你没有权限！<br/>".'<a href="?cmd='.$old_scene.'">返回游戏</a>');
            }
            break;
        case 'gm_shop'://场景商店
            $ym = 'module_all/gm_shop.php';
            break;
        case 'gm_hockshop'://场景回收
            $ym = 'module_all/gm_hockshop.php';
            break;
        case 'gm_storage'://场景仓库
            $ym = 'module_all/scene_storage.php';
            break;
        case 'gm_shop_npc'://npc商店
            $npc = player\getnpc_scene($mid,$dblj);
            $npc_name = $npc ->nname;
            $npc_shop_cond = $npc ->nshop_cond;
            $shop_triggle = checkTriggerCondition($npc_shop_cond,$dblj,$sid,$nid);
            if(is_null($shop_triggle)){
                $shop_triggle =1;
            }
            if(!$shop_triggle){
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $old_scene = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
            echo "{$npc_name}似乎并不想理你！"."<br/>";
            echo "<a href='?cmd=$old_scene'>返回游戏</a><br/>";
            }elseif($shop_triggle){
                if(!$iid){
            echo "{$npc_name}:你好啊！{$player->uname}，想买点什么呢？<br/>";
                }elseif(!$_POST['submit']){
            echo "{$npc_name}:我这卖的都是好货，买了不会后悔的！<br/>";
                }
            $ym = 'module_all/gm_shop_npc.php';
            }
            break;
        case 'scene_npc'://npc
            $ym = 'module_all/scene_npc.php';
            break;
        case 'event_no_define'://操作事件未定义
            echo "该操作未被正确定义！<br/>";
            $cmd = $parents_cmd;
            $parents_cmd = $cmd;
            $ym = $parents_page;
            break;
        case 'func_no_define'://功能事件未定义
            echo "该功能未被正确定义！<br/>";
            $cmd = $parents_cmd;
            $parents_cmd = $cmd;
            $ym = $parents_page;
            break;
        case 'game_event_no_define'://操作事件未定义
            echo "该操作未被正确定义！<br/>";
            $ym = 'gm/gamepagemodule_define.php';
            break;
        case 'game_func_no_define'://功能事件未定义
            echo "该功能未被正确定义！<br/>";
            $ym = 'gm/gamepagemodule_define.php';
            break;
        case 'game_main_event'://步骤相关
            $ym = 'gm/gm_event_exec_self/gm_self_event_2.php';
            break;
        case 'game_main_func'://功能相关
            $ym = 'gm/gm_func_exec/gm_func_exec.php';
            break;
        case 'just_event_page'://模板跳转相关
            $ym = 'gm/game_page_2.php';
            break;
        case 'gm_exp_def'://表达式定义实现
            if($def_post_canshu ==0 ||$def_post_canshu ==2||$def_post_canshu ==3){
            $ym = 'gm/gameexp_define_2.php';
            }elseif($def_post_canshu ==1){
                $key = $_POST['key'];
                $exp_type = $_POST['exp_type'];
                $exp = $_POST['exp'];
                if($key){
                $sql = "INSERT INTO system_exp_def(id, type, value) VALUES ('$key', '$exp_type', '$exp')";
                $cxjg = $dblj->exec($sql);
                }else{
                echo "ID不能为空！<br/>";
                }
                $ym = 'gm/gameexp_define.php';
            }elseif($def_post_canshu ==4){
            $def_post_canshu =2;
            $ym = 'gm/gameexp_define_2.php';
            }elseif($def_post_canshu ==6){
            echo "已删除“{$def_id}”！<br/>";
            $sql = "DELETE FROM system_exp_def WHERE id = '$def_id'";
            $cxjg =$dblj->exec($sql);
            $ym ='gm/gameexp_define.php';
            }elseif($def_post_canshu ==5){
                $old_key = $_POST['okey'];
                $key = $_POST['key'];
                $exp_type = $_POST['def_type'];
                $exp = $_POST['exp'];
                $sql = "UPDATE system_exp_def set id = '$key',type = '$exp_type',value = '$exp' WHERE id = '$old_key'";
                $cxjg = $dblj->exec($sql);
                $ym ='gm/gameexp_define.php';
            }
            break;
        case 'gm_skill_def'://技能表达式定义实现
            if($skill_post_canshu ==0){
            $ym = 'gm/gameskill_define.php';
            }elseif($skill_post_canshu ==1){
                $ym = 'gm/gm_skill_design/gm_skill_main.php';
            }elseif($skill_post_canshu ==2){
            $skill_post_canshu =2;
            $ym = 'gm/gm_skill_design/gm_skill_main.php';
            }elseif($skill_post_canshu ==3){
            $sql = "DELETE FROM system_skill WHERE jid = '$def_id'";
            $cxjg =$dblj->exec($sql);
            $ym ='gm/gameskill_define.php';
            }elseif($skill_post_canshu ==4){
            $ym ='gm/gm_skill_design/gm_skill_add.php';
            }elseif($skill_post_canshu ==5){
            $ym = 'gm/gm_skill_design/gm_skill_default.php';
            }
            break;
        case 'gm_equip_def'://装备类型定义实现
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
        case 'gm_post_1'://定义游戏基本信息过程实现
            if($gm_post_canshu == "1"){
            $game_name = htmlspecialchars($game_name);
            $game_desc = htmlspecialchars($game_desc);
            if($game_status=="0"){
                $game_status_string = "开发中";
            }elseif ($game_status=="1") {
                $game_status_string = "维护中";
            }elseif ($game_status=="2") {
                $game_status_string= "内测";
            }elseif ($game_status=="3") {
                $game_status_string = "公测";
            }
            $sql = "UPDATE gm_game_basic SET game_name = '$game_name', game_desc = '$game_desc', promotion_exp = '$promotion_exp',
            promotion_cond = '$promotion_cond', mod_promotion_exp = '$mod_promotion_exp', mod_promotion_cond = '$mod_promotion_cond', 
            clan_promotion_exp = '$clan_promotion_exp', clan_promotion_cond = '$clan_promotion_cond', game_status = '$game_status',game_status_string = '$game_status_string',pet_max_count = '$pet_max_count',team_max_count = '$team_max_count'";
            $cxjg = $dblj->exec($sql);
            echo '修改成功<br/>';
            }
            $ym ='gm/gamebasic_info.php';
            break;
        case 'gm_map_submit'://地图更新相关事件
            $target_midid = $_POST['id'];
            $sql = "SELECT name from system_area where id = '$area_id'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $area_name = $ret['name'];
            if($gm_map_canshu == 1){
                foreach ($_POST as $column_name => $column_value) {
                    $column_name = 'm' . $column_name;
                    if (strpos($column_value, '"') !== false) {
                        $column_value = preg_replace('/"([^"]*)"/', '“${1}”', $column_value);
                    }
                    if (strpos($column_value, "'") !== false) {
                        $column_value = str_replace("'", "", $column_value);
                    }



                $sql2 = "UPDATE system_map SET $column_name = :column_value WHERE mid = :mid";
                $stmt = $dblj->prepare($sql2);
                $stmt->bindParam(':column_value', $column_value);
                $stmt->bindParam(':mid', $target_midid);
                $stmt->execute();
                }
                $sql = "UPDATE system_map SET marea_name = '$area_name' WHERE mid ='$target_midid'";
                $stmt = $dblj->exec($sql);

            }
            $ym = 'gm/gm_map/map_attr_def.php';
            break;
        case 'gm_npc_submit'://npc更新相关事件
            $npc_id = $_POST['id'];
            $sql = "SELECT name from system_area where id = '$area_id'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $area_name = $ret['name'];
            if($gm_npc_canshu == 1){
                foreach ($_POST as $column_name => $column_value) {
                    $column_name = 'n' . $column_name;
                    $sql2 = "UPDATE system_npc SET $column_name = '$column_value' WHERE nid ='$npc_id'";
                            $stmt = $dblj->exec($sql2);
                }
                $sql = "UPDATE system_npc SET narea_name = '$area_name' WHERE nid ='$npc_id'";
                $stmt = $dblj->exec($sql);
            }
            $ym = 'gm/gm_npc_design/npc_attr_def.php';
            break;
        case 'system_map_op_detail'://地图操作相关事件
            $ym = 'gm/gm_map/map_op_def_2.php';
            break;
        case 'system_item_op_detail'://物品操作相关事件
            $ym = 'gm/gm_item_design/gm_item_op_def_2.php';
            break;
        case 'system_npc_op_detail'://npc操作相关事件
            $ym = 'gm/gm_npc_design/npc_op_def_2.php';
            break;
        case 'system_npc_equip_detail'://npc身上装备
            $ym = 'gm/gm_npc_design/npc_equip_def_2.php';
            break;
        case 'system_task_detail'://npc任务相关
            $ym = 'gm/gm_npc_design/npc_task_def_2.php';
            break;
        case 'gm_game_basicinfo'://游戏基本信息
            $ym ='gm/gamebasic_info.php';
            break;
        case 'gm_game_othersetting'://其他设置
            switch($canshu){
                case '1':
                    $ym = 'gm/gm_other_setting/gm_area_def.php';
                    break;
                case '2':
                    $ym = 'gm/gm_other_setting/gm_designer_def.php';
                    break;
                case '3':
                    $ym = 'gm/gm_other_setting/gm_other_def.php';
                    break;
                case '4':
                    $ym = 'gm/gm_other_setting/gm_player_data.php';
                    break;
                case '5':
                    if(!$reward_change){
                    $ym = 'gm/gm_other_setting/gm_reward_def.php';
                    }else{
                    $ym = 'gm/gm_other_setting/gm_reward_def_2.php';
                    }
                    break;
                case '6':
                    $ym = 'gm/gm_other_setting/gm_money_def.php';
                    break;
                case '7':
                    $ym = 'gm/gm_other_setting/gm_rank_def.php';
                    break;
                case '8':
                    $ym = 'gm/gm_other_setting/gm_battle_def.php';
                    break;
                case '9':
                    $ym = 'gm/gm_other_setting/gm_auc_def.php';
                    break;
                case '10':
                    $ym = 'gm/gm_other_setting/reboot_all.php';
                    break;
                case 'other':
                    echo "更新成功！<br/>";
                    $ym = 'gm/gm_other_setting/gm_other_def.php';
                    break;
                default:
                    $ym = 'gm/gameother_setting.php';
                    break;
            }
            break;
        case 'gm_game_expdefine'://表达式定义
            $ym ='gm/gameexp_define.php';
            break;
        case 'gm_game_attrdefine'://属性定义
            $ym = 'gm/gameattr_define.php';
            break;
        case 'gm_delete_attr'://属性删除
            if($gm_if_basic ==1){
                echo "此为基础属性，不可删除！<br/>";
                $ym = 'gm/gameattr_define.php';
            }else{
            //属性删除过程实现
            $sql = "DELETE FROM gm_game_attr WHERE id = '$gm_game_attr_id' AND value_type = '$gm_post_canshu'";
            $cxjg =$dblj->exec($sql);
            switch($gm_post_canshu){
                case '1':
                    $delete_column = "u".$gm_game_attr_id;
                    $sql = "ALTER TABLE game1 DROP COLUMN $delete_column;";
                    break;
                case '3':
                    $delete_column = "n".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_npc DROP COLUMN $delete_column;";
                    $sql2 = "ALTER TABLE system_npc_midguaiwu DROP COLUMN $delete_column;";
                    $cxjg =$dblj->exec($sql2);
                    $sql3 = "ALTER TABLE system_npc_scene DROP COLUMN $delete_column;";
                    $cxjg =$dblj->exec($sql3);
                    $sql4 = "ALTER TABLE system_pet_scene DROP COLUMN $delete_column;";
                    $cxjg =$dblj->exec($sql4);
                    break;
                case '4':
                    $delete_column = "i".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_item DROP COLUMN $delete_column;";
                    $sql2 = "ALTER TABLE system_item_module DROP COLUMN $delete_column;";
                    $cxjg =$dblj->exec($sql2);
                    break;
                case '5':
                    $delete_column = "m".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_map DROP COLUMN $delete_column;";
                    break;
                case '6':
                    $delete_column = "j".$gm_game_attr_id;
                    $sql = "ALTER TABLE system_skill DROP COLUMN $delete_column;";
                    $sql2 = "ALTER TABLE system_skill_module DROP COLUMN $delete_column;";
                    $cxjg =$dblj->exec($sql2);
                    break;
            }
            $cxjg =$dblj->exec($sql);
            if($cxjg){
            echo "已删除“{$gm_game_attr_id}”属性<br/>";
            }else{
            echo "没有“{$gm_game_attr_id}”属性！<br/>";
            }
            $ym = 'gm/gameattr_define.php';
            }
            break;
        case 'gm_post_2':
            $gm_default_value = $gm_default_value ?: 0;
            if(isset($gm_post_canshu_2) && $gm_post_canshu !=8){
            //属性更新过程实现

            $sql = "UPDATE gm_game_attr SET name = :gm_name, 
                    default_value = :gm_default_value, if_show = :gm_attr_hidden 
                    WHERE id = :gm_id AND value_type = :gm_post_type_2";
            $stmt = $dblj->prepare($sql);
            
            $stmt->bindParam(':gm_name', $gm_name);
            $stmt->bindParam(':gm_default_value', $gm_default_value);
            $stmt->bindParam(':gm_attr_hidden', $gm_attr_hidden);
            $stmt->bindParam(':gm_id', $gm_id);
            $stmt->bindParam(':gm_post_type_2', $gm_post_type_2);
            
            $cxjg = $stmt->execute();
            
            switch($gm_post_type_2){
                case '1':
                    $update_column = "u".$gm_id;
                    $sql = "ALTER TABLE game1 ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    break;
                case '3':
                    $update_column = "n".$gm_id;
                    $sql = "ALTER TABLE system_npc ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $sql2 = "ALTER TABLE system_npc_midguaiwu ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $cxjg =$dblj->exec($sql2);
                    $sql3 = "ALTER TABLE system_npc_scene ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $cxjg =$dblj->exec($sql3);
                    $sql4 = "ALTER TABLE system_pet_scene ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $cxjg =$dblj->exec($sql4);
                    break;
                case '4':
                    $update_column = "i".$gm_id;
                    $sql = "ALTER TABLE system_item ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $sql2 = "ALTER TABLE system_item_module ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $cxjg =$dblj->exec($sql2);
                    break;
                case '5':
                    $update_column = "m".$gm_id;
                    $sql = "ALTER TABLE system_map ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    break;
                case '6':
                    $update_column = "j".$gm_id;
                    $sql = "ALTER TABLE system_skill ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $sql2 = "ALTER TABLE system_skill_module ALTER COLUMN `$update_column` SET DEFAULT '$gm_default_value';";
                    $cxjg =$dblj->exec($sql2);
                    break;
            }
            $cxjg =$dblj->exec($sql);
            }elseif ($gm_post_canshu == 8) {
            
            // 检查数据是否存在
            $check_column_sql = "SELECT id FROM `gm_game_attr` WHERE value_type = :gm_post_canshu_2 and id = :gm_id";
            $stmt = $dblj->prepare($check_column_sql);
            $stmt->bindParam(':gm_post_canshu_2', $gm_post_canshu_2, PDO::PARAM_STR);
            $stmt->bindParam(':gm_id', $gm_id, PDO::PARAM_STR);
            $stmt->execute();
            $column_exists = $stmt->rowCount() > 0;
            if ($column_exists) {
                // 字段存在，报错
            echo "不能添加重复的属性标识！<br/>";
            } else {
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
                    $sql = "ALTER TABLE game1 ADD `$update_column` $add_type NOT NULL;";
                    //$sql2 = "ALTER TABLE system_player ADD `$update_column` $add_type NOT NULL;";
                    //$cxjg =$dblj->exec($sql);
                    break;
                case '3':
                    $update_column = "n".$gm_id;
                    $sql = "ALTER TABLE system_npc ADD `$update_column` $add_type NOT NULL;";
                    $sql2 = "ALTER TABLE system_npc_midguaiwu ADD `$update_column` $add_type NOT NULL;";
                    $cxjg =$dblj->exec($sql2);
                    $sql3 = "ALTER TABLE system_npc_scene ADD `$update_column` $add_type NOT NULL;";
                    $cxjg =$dblj->exec($sql3);
                    $sql4 = "ALTER TABLE system_pet_scene ADD `$update_column` $add_type NOT NULL;";
                    $cxjg =$dblj->exec($sql4);
                    break;
                case '4':
                    $update_column = "i".$gm_id;
                    $sql = "ALTER TABLE system_item ADD `$update_column` $add_type NOT NULL;";
                    $sql2 = "ALTER TABLE system_item_module ADD `$update_column` $add_type NOT NULL;";
                    $cxjg =$dblj->exec($sql2);
                    break;
                case '5':
                    $update_column = "m".$gm_id;
                    $sql = "ALTER TABLE system_map ADD `$update_column` $add_type NOT NULL;";
                    break;
                case '6':
                    $update_column = "j".$gm_id;
                    $sql = "ALTER TABLE system_skill ADD `$update_column` $add_type NOT NULL;";
                    $sql2 = "ALTER TABLE system_skill_module ADD `$update_column` $add_type NOT NULL;";
                    $cxjg =$dblj->exec($sql2);
                    break;
            }
            $cxjg =$dblj->exec($sql);
            $sql = "INSERT INTO gm_game_attr(id, name, value_type, default_value, if_show, attr_type) VALUES ('$gm_id', '$gm_name', '$gm_post_canshu_2', '$gm_default_value', '$gm_attr_hidden', '$gm_attr_type')";
            $cxjg =$dblj->exec($sql);
            $gm_post_canshu = $gm_post_canshu_2;
            echo "新增属性“{$gm_id}”成功！<br/>";
            }
            }
            $ym = 'gm/gameattr_define.php';
            break;
        case 'game_page_2'://模板事件
            if($delete_sure_id !=0){
                echo "删除成功！<br/>";
                $sql = '';
                switch($gm_post_canshu){
                    case '1':
                        $sql = "DELETE FROM game_scene_page WHERE id = '$delete_sure_id'";
                        break;
                    case '2':
                        $sql = "DELETE FROM game_npc_page WHERE id = '$delete_sure_id'";
                        break;
                    case '3':
                        $sql = "DELETE FROM game_pet_page WHERE id = '$delete_sure_id'";
                        break;
                    case '4':
                        $sql = "DELETE FROM game_item_page WHERE id = '$delete_sure_id'";
                        break;
                    case '5':
                        $sql = "DELETE FROM game_oplayer_page WHERE id = '$delete_sure_id'";
                        break;
                    case '6':
                        $sql = "DELETE FROM game_equip_page WHERE id = '$delete_sure_id'";
                        break;
                    case '7':
                        $sql = "DELETE FROM game_player_page WHERE id = '$delete_sure_id'";
                        break;
                    case '8':
                        $sql = "DELETE FROM game_skill_page WHERE id = '$delete_sure_id'";
                        break;
                    case '9':
                        $sql = "DELETE FROM game_function_page WHERE id = '$delete_sure_id'";
                        break;
                    case '10':
                        $sql = "DELETE FROM game_pve_page WHERE id = '$delete_sure_id'";
                        break;
                    case '11':
                        $sql = "DELETE FROM game_main_page WHERE id = '$delete_sure_id'";
                        break;
                    case '14':
                        $sql = "DELETE FROM game_equip_detail_page WHERE id = '$delete_sure_id'";
                        break;
                }
            $cxjg =$dblj->exec($sql);
            $sql = "SELECT id from system_event_self where belong = '$delete_sure_id' and module_id = '$gm_post_canshu'";
            $cxjg=$dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $event_id = $ret['id'];
            $dblj->exec("DELETE from system_event_evs_self where belong = '$event_id'");
            $dblj->exec("DELETE from system_event_self where id = '$event_id'");
            $ym = 'gm/gamepagemodule_define.php';
            }else{
            $ym = 'gm/game_page_2.php';
            }
            break;
       case 'game_self_page'://自定义模板事件
            if($delete_sure_id !=0){
                $delete_table = "game_self_page_".$self_id;
                // 检测表是否有元素
                $stmt = $dblj->query("SELECT COUNT(*) FROM `$delete_table`");
                $count = $stmt->fetchColumn();
                // 如果记录数为0，则删除表
                if ($count == "0") {
                    $dblj->exec("DROP TABLE `$delete_table`");
                    $dblj->exec("DELETE FROM `system_self_define_module` WHERE id = '$self_id'");
                    echo "模板已成功删除<br/>";
                } else {
                    echo "模板中还有元素，不能删除！<br/>";
                }
                $gm_post_canshu = 13;
            $ym = 'gm/gamepagemodule_define.php';
            }else{
            $ym = 'module_all/self_module/self_module_page.php';
            }
            break;
       case 'game_self_page_2'://自定义模板删除事件
            if($delete_sure_id !=0){
                echo "删除成功！<br/>";
                $delete_table = "game_self_page_".$self_id;
                $sql = "DELETE FROM `$delete_table` WHERE id = '$delete_sure_id'";
                $cxjg = $dblj->exec($sql);
                
                $sql = "SELECT id from system_event_self where belong = '$delete_sure_id' and module_id = '$delete_table'";
                $cxjg=$dblj->query($sql);
                $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
                $event_id = $ret['id'];
                $dblj->exec("DELETE from system_event_evs_self where belong = '$event_id'");
                $dblj->exec("DELETE from system_event_self where id = '$event_id'");
                
            $ym = 'module_all/self_module/self_module_page.php';
            }elseif($delete_all_canshu ==1){
            // 清空表的所有元素
            $delete_table = "game_self_page_".$self_id;
            $dblj->exec("DELETE FROM `$delete_table`");
            // 将自增值置为 0
            $dblj->exec("ALTER TABLE `$delete_table` AUTO_INCREMENT = 1");
            echo "当前模板元素已成功清空！<br/>";
            //还要把事件对应的event_evs表中值清空
            $sql = "SELECT id from system_event_self where module_id = '$delete_table'";
            $cxjg=$dblj->query($sql);
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
            for($i=0;$i<@count($ret);$i++){
            $event_id = $ret[$i]['id'];
            $dblj->exec("DELETE from system_event_evs_self where belong = '$event_id'");
            $dblj->exec("DELETE from system_event_self where id = '$event_id'");
            }

            $ym = 'module_all/self_module/self_module_page.php';
            }elseif($delete_all ==1){
            $ym = 'module_all/self_module/self_module_page_2.php';
            }else{
            $ym = 'module_all/self_module/self_module_page_2.php';
            }
            break;
        case 'game_self_page_add'://自定义模板新增事件
            if($add_canshu ==0){
            $ym = 'module_all/self_module/self_module_page_add.php';
            }else{
                $id = $_POST['key'];
                $name = $_POST['name'];
                if (strpos($id, "ct_") === 0) {
                    $page_id = substr($id, 3); // 去除前缀"ct_"
                    } else {
                    echo "输入有误！";
                    exit; // 没有前缀"ct_"，终止程序
                }
            $sql = "INSERT INTO system_self_define_module(id,name,call_sum) values ('$page_id','$name','0')";
            $cxjg = $dblj->exec($sql);
            $self_id = $page_id;
            $newTable = "game_self_page_".$page_id;

            $sql = "CREATE TABLE `$newTable` (
              `position` int(4) NOT NULL,
              `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
              `type` varchar(255) DEFAULT '1',
              `show_cond` varchar(255) DEFAULT NULL,
              `value` text,
              `target_tasks` varchar(255) DEFAULT NULL,
              `target_event` varchar(255) DEFAULT '0',
              `target_func` varchar(255) DEFAULT '0',
              `link_value` varchar(255) DEFAULT '0'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            $stmt = $dblj->prepare($sql);
            $stmt->execute();
            $ym = 'module_all/self_module/self_module_page.php';
            }
            break;
        case 'game_event_page_1'://公共事件
            $ym = 'gm/gm_event_exec/gm_public_event_2.php';
            break;
        case 'game_event_page_2'://非公共事件
            $ym = 'gm/gm_event_exec_self/gm_self_event_2.php';
            break;
        case 'main_target_event'://操作事件实现
            \player\changeplayersx('ulast_cmd',$parents_cmd,$sid,$dblj);
            $ym = 'class/events_steps_change.php';
            break;
        case 'main_target_func'://功能相关
            $ym = 'class/func_steps_change.php';
            break;
        case 'npc_op_event'://npc事件未定义
            $ym = 'class/events_npc_steps_change.php';
            break;
        case 'game_event_attradd'://步骤属性新增
            if($post_type ==0){
                $ym = 'gm/gm_event_exec/gm_event_attrset_2.php';
            }else{
                $ym = 'gm/gm_event_exec/gm_event_attrchange_2.php';
            }
            break;
        case 'game_event_attradd_self'://步骤属性新增
            if($post_type ==0){
                $ym = 'gm/gm_event_exec_self/gm_event_attrset_2.php';
            }else{
                $ym = 'gm/gm_event_exec_self/gm_event_attrchange_2.php';
            }
            break;
        case 'game_event_attrset'://步骤属性更新
            $ym = 'gm/gm_event_exec/gm_event_attrset.php';
            break;
        case 'game_event_attrset_self':
            $ym = 'gm/gm_event_exec_self/gm_event_attrset.php';
            break;
        case 'game_event_attrset_2'://步骤相关
            $ym = 'gm/gm_event_exec/gm_event_attrset_2.php';
            break;
        case 'game_event_attrset_2_self'://步骤相关
            $ym = 'gm/gm_event_exec_self/gm_event_attrset_2.php';
            break;
        case 'game_event_attrchange'://步骤属性更新
            $ym = 'gm/gm_event_exec/gm_event_attrchange.php';
            break;
        case 'game_event_attrchange_2'://步骤属性更新
            $ym = 'gm/gm_event_exec/gm_event_attrchange_2.php';
            break;
        case 'game_event_attrchange_self'://步骤属性更新
            $ym = 'gm/gm_event_exec_self/gm_event_attrchange.php';
            break;
        case 'game_event_attrchange_2_self'://步骤属性更新
            $ym = 'gm/gm_event_exec_self/gm_event_attrchange_2.php';
            break;
        case 'game_event_itemchange'://步骤属性更新
        if($item_name){
            $ym = 'gm/gm_event_exec/gm_event_itemchange_2.php';
        }else{
            $ym = 'gm/gm_event_exec/gm_event_itemchange.php';
        }
            break;
        case 'game_event_itemadd':
            $ym = 'gm/gm_event_exec/gm_event_itemchange_3.php';
            break;
        case 'game_event_skilladd':
            if($add ==1){
            $ym = 'gm/gm_event_exec/gm_event_skilladd2.php';
            }else{
            $ym = 'gm/gm_event_exec/gm_event_skilladd.php';
            }
            break;
        case 'game_event_skillremove':
            if($add ==1){
            $ym = 'gm/gm_event_exec/gm_event_skillremove2.php';
            }else{
            $ym = 'gm/gm_event_exec/gm_event_skillremove.php';
            }
            break;
        case 'game_event_destsadd':
            if($scene_post_canshu ==1||$scene_post_canshu ==2 ||$scene_post_canshu ==3){
            $ym = 'gm/gm_event_exec/gm_event_sceneremove2.php';
            }else{
            $ym = 'gm/gm_event_exec/gm_event_sceneremove.php';
            }
            break;
        case 'game_event_inputs':
            if($add || $change){
            $ym = 'gm/gm_event_exec/gm_event_inputs2.php';
            }else{
            $ym = 'gm/gm_event_exec/gm_event_inputs.php';
            }
            break;
        case 'game_event_itemchange_self'://步骤属性更新
        if($item_name){
            $ym = 'gm/gm_event_exec_self/gm_event_itemchange_2.php';
        }else{
            $ym = 'gm/gm_event_exec_self/gm_event_itemchange.php';
        }
            break;
        case 'game_event_itemadd_self':
            $ym = 'gm/gm_event_exec_self/gm_event_itemchange_3.php';
            break;
        case 'game_event_skilladd_self':
            if($add ==1){
            $ym = 'gm/gm_event_exec_self/gm_event_skilladd2.php';
            }else{
            $ym = 'gm/gm_event_exec_self/gm_event_skilladd.php';
            }
            break;
        case 'game_event_skillremove_self':
            if($add ==1){
            $ym = 'gm/gm_event_exec_self/gm_event_skillremove2.php';
            }else{
            $ym = 'gm/gm_event_exec_self/gm_event_skillremove.php';
            }
            break;
        case 'game_event_taskremove_self':
            if($add ==1){
            $ym = 'gm/gm_event_exec_self/gm_event_taskremove2.php';
            }else{
            $ym = 'gm/gm_event_exec_self/gm_event_taskremove.php';
            }
            break;
        case 'game_event_destsadd_self':
            if($scene_post_canshu ==1||$scene_post_canshu ==2 ||$scene_post_canshu ==3){
            $ym = 'gm/gm_event_exec_self/gm_event_sceneremove2.php';
            }else{
            $ym = 'gm/gm_event_exec_self/gm_event_sceneremove.php';
            }
            break;
        case 'game_event_inputs_self':
            if($add || $change){
            $ym = 'gm/gm_event_exec_self/gm_event_inputs2.php';
            }else{
            $ym = 'gm/gm_event_exec_self/gm_event_inputs.php';
            }
            break;
        case 'game_event_fight_self':
            if($item_name){
                $ym = 'gm/gm_event_exec_self/gm_event_fightchange_2.php';
            }else{
                $ym = 'gm/gm_event_exec_self/gm_event_fightchange.php';
            }
            break;
        case 'game_event_fightadd_self':
            $ym = 'gm/gm_event_exec_self/gm_event_fightchange_3.php';
            break;
        case 'game_event_fightchange_self':
        if($npc_name){
            $ym = 'gm/gm_event_exec_self/gm_event_fightchange_2.php';
        }else{
            $ym = 'gm/gm_event_exec_self/gm_event_fightchange.php';
        }
            break;
        case 'game_event_pet_self':
            if($pet_id){
                $ym = 'gm/gm_event_exec_self/game_event_pet_self_2.php';
            }else{
                $ym = 'gm/gm_event_exec_self/game_event_pet_self.php';
            }
            break;
        case 'game_event_pet':
            if($pet_id){
                $ym = 'gm/gm_event_exec/game_event_pet_2.php';
            }else{
                $ym = 'gm/gm_event_exec/game_event_pet.php';
            }
            break;
        case 'gm_post_4'://地图添加相关事件
            if($map_add_canshu == 1){
                $sql = "INSERT INTO system_map (marea_name, mname, marea_id) VALUES ('$marea_name', '未命名', $qy_id)";
                $cxjg =$dblj->exec($sql);
                $target_midid = $dblj->lastInsertId();
                $ym = 'gm/gm_map_3.php';
            }elseif($delete_canshu == 1){
                
                //地图删除相关事件
                
                $post_canshu = 1;
                $marea_id = $area_id;
                // 删除system_map表中指定mid的数据
                $deleteSql = "DELETE FROM system_map WHERE mid = '$target_midid'";
                $deleteStmt = $dblj->exec($deleteSql);
                $ym = 'gm/gm_map_2.php';
            }elseif($add_batch ==1 ||$area_modify ==1||$update ==2){
            $ym = 'gm/gm_map_2.php';
                }elseif($out_canshu ==1){
            $ym = 'gm/gm_map/map_data_out.php';
                }elseif($in_canshu ==1){
            $ym = 'gm/gm_map/map_data_in.php';
                }else{
            $ym = 'gm/gm_map_3.php';
            }
            break;
        case 'gm_npc_first'://npc页面
            $ym = 'gm/gamenpc_design.php';
            break;
        case 'gm_npc_second'://npc页面
            if($npc_add_canshu == 1){
                $sql = "INSERT INTO system_npc (narea_name, nname, narea_id) VALUES ('$qy_name', '未命名', $qy_id)";
                $cxjg =$dblj->exec($sql);
                $npc_id = $dblj->lastInsertId();
                $ym = 'gm/gm_npc_design/gm_npc_first.php';
            }elseif($delete_canshu == 1){
                echo "已删除！请勿刷新该页面避免错误！<br/>";
                $post_canshu = 1;
                $qy_id = $qy_id;
                $deleteSql = "DELETE FROM system_npc WHERE nid = '$npc_id'";
                $deleteStmt = $dblj->exec($deleteSql);
                $ym = 'gm/gamenpc_design.php';
            }elseif($out_canshu ==1){
            $ym = 'gm/gm_npc_design/npc_data_out.php';
            }else{
            $ym = 'gm/gm_npc_design/gm_npc_first.php';
            }
            break;
        case 'gm_game_equiptypedefine'://装备类别
            if($gm_cover ==1){
            // 删除 system_equip_def 表中的所有数据
            $dblj->exec("DELETE FROM system_equip_def");
            //将 system_equip_default 表的内容插入到 system_equip_def 表中
            $dblj->exec("INSERT INTO system_equip_def SELECT * FROM system_equip_default");
            $query = "SELECT MAX(id) as max_id FROM system_equip_def";
            $result = $dblj->query($query);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $max_id = $row["max_id"];
            // 更新表的自增值
            $query = "ALTER TABLE system_equip_def AUTO_INCREMENT = " . ($max_id - 1);
            $dblj->exec($query);
            
            echo "已还原基本类型！ <br/>";
            }
            $ym = 'gm/gameequiptype_define.php';
            break;
        case 'gm_game_globaleventdefine'://公共事件
            if($gm_post_canshu ==0){
            $ym = 'gm/gameglobalevent_define.php';
            }else{
            $ym = 'gm/gameglobalevent_define_2.php';
            }
            break;
        case 'gm_game_globaleventdefine_steps'://公共事件步骤相关
            $ym = 'gm/gm_event_exec/gm_event_steps.php';
            break;
        case 'gm_game_selfeventdefine_steps'://非公共事件步骤相关
            $ym = 'gm/gm_event_exec_self/gm_event_steps.php';
            break;
        case 'gm_game_selfeventdefine_addsteps'://非公共事件步骤新增
            $ym = 'gm/gm_event_exec_self/gm_event_steps.php';
            break;
        case 'gm_game_selfeventdefine_steps_delete'://非公共事件步骤删除
            if ($if_delete ==1){
            $deleteSql = "DELETE FROM system_event_evs_self WHERE id = '$step_id' AND belong = '$event_id'";
            $deleteStmt = $dblj->exec($deleteSql);
            if ($deleteStmt !== false && $deleteStmt !== 0){
            $query = "SELECT link_evs FROM system_event_self WHERE id = '$event_id'";
            $stmt = $dblj->prepare($query);
            $stmt->execute();
            $link_evs = $stmt->fetchColumn();

            // 将 link_evs 字段的值转换为数组
            $link_evs_array = explode(',', $link_evs);
        
        
            // 检查数组是否只有一个元素，并将表置空
            if (count($link_evs_array) === 1) {
                $query = "UPDATE system_event_self SET link_evs = '' WHERE id = '$event_id'";
                $stmt = $dblj->prepare($query);
                $stmt->execute();
            }else{
            // 执行删除操作，并更新 link_evs 字段的值
            $link_evs_array = array_diff($link_evs_array, [$step_id]);
            $new_link_evs = implode(',', $link_evs_array);
        
            $query = "UPDATE system_event_self SET link_evs = :link_evs WHERE id = '$event_id'";
            $stmt = $dblj->prepare($query);
            $stmt->bindParam(':link_evs', $new_link_evs);
            $stmt->execute();
            }
            }
            }
            $ym = 'gm/gm_event_exec_self/gm_self_event_2.php';
            break;
        case 'gm_game_globaleventdefine_data'://以json显示公共数据
            $ym = 'class/data_define.php';
            break;
        case 'gm_game_selfeventdefine_data'://以json显示非公共数据
            $ym = 'class/data_define_2.php';
            break;
        case 'gm_game_pagemoduledefine'://模板事件
            $ym = 'gm/gamepagemodule_define.php';
            break;
        case 'gm_game_itemdefine'://物品设计
            if($gm_post_canshu=="导出"){
            $ym = 'gm/gm_item_design/gm_item_outside.php';
            }else{
            $ym = 'gm/gameitem_design.php';
            }
            break;
        case 'gm_game_rpdesign'://资源点设计
            $ym = 'gm/gm_rp_design/gm_rp_main.php';
            break;
        case 'gm_game_lpdesign'://生活职业设计
            $ym = 'gm/gm_lp_design/gm_lp_main.php';
            break;
        case 'gm_game_zipfile'://源文件压缩
            if($type =='update'){
                $ym = 'zip_update.php';
            }else{
                $ym = 'zip_all.php';
            }
            break;
        case 'delete_ele'://元素删除
            $ym = 'gm/game_page_2.php';
            break;
        case 'delete_ele_self'://非公共元素删除
            $ym = 'module_all/self_module/self_module_page_2.php';
            break;
        case 'gm_game_photomanage'://图片管理
            $ym = 'gm/gamephoto_manage.php';
            break;
        case 'gm_game_skilldefine'://技能设计
            $ym = 'gm/gameskill_define.php';
            break;
        case 'gm_game_itemdesign'://物品设计
            $ym = 'gm/gameitem_design.php';
            break;
        case 'gm_game_npcdesign'://npc设计
            $ym = 'gm/gamenpc_design.php';
            break;
        case 'gm_game_taskdesign':
            $ym = 'gm/gametask_design.php';
            break;
        case 'gm_scene_new'://游戏场景
            $ym = 'module_all/main_page.php';
            break;
        case 'game_forum'://游戏论坛
            $ym = 'module_all/game_forum.php';
            break;
        case 'map_detail'://场景地图
            $ym = 'module_all/map_detail.php';
            break;
        case 'sail_html'://出航
            $ym = 'module_all/sail.php';
            break;
        case 'pick_html'://采集资源
            $ym = 'module_all/pick.php';
            break;
        case 'mosaic_html'://镶嵌装备
            $ym = 'module_all/player_equip_mosaic.php';
            break;
        case 'sailing_html'://出航途中
            $player = \player\getplayer($sid,$dblj);
            if($canshu ==1){
            \player\changeplayersx('uis_sailing',1,$sid,$dblj);
            \player\changeplayertable('system_player_boat','boat_distance',$distance,$sid,$dblj);
            \player\changeplayertable('system_player_boat','boat_begin_id',$begin_id,$sid,$dblj);
            \player\changeplayertable('system_player_boat','boat_over_id',$over_id,$sid,$dblj);
            }
            if($boat_speed){
            \player\addplayertable('system_player_boat','boat_distance',-$boat_speed,$sid,$dblj);
            }
            $boat = \player\getboat($sid,$dblj);
            if($boat['boat_distance'] <=0 && $player->uis_sailing ==1){
            $over_name = \lexical_analysis\color_string(\player\getmid($over_id,$dblj)->mname);
            \player\changeplayersx('uis_sailing',0,$sid,$dblj);
            \player\changeplayersx('nowmid',$over_id,$sid,$dblj);
            \player\changeplayertable('system_player_boat','boat_distance',0,$sid,$dblj);
            echo "已到达{$over_name}!<br/>";
            $cmd = 'gm_scene_new';
            $ym = 'module_all/main_page.php';
            }else{
            $ym = 'module_all/sailing.php';
            }
            break;
        case 'player_state'://状态
            $ym = 'module_all/scene_player_detail.php';
            break;
        case 'player_pet'://宠物
            $ym = 'module_all/player_pet_list.php';
            break;
        case 'pet_view'://宠物场景查看
            $ym = 'module_all/scene_pet_view.php';
            break;
        case 'player_petequip'://宠物装备列表
            $ym = 'module_all/player_pet_equip_list.php';
            break;
        case 'player_petinfo'://宠物详情
            $ym = 'module_all/player_pet_detail.php';
            break;
        case 'clan_list'://帮派列表
            $ym = 'module_all/player_clan_list.php';
            break;
        case 'clan_pass'://成员审批
            $ym = 'module_all/player_clan_pass.php';
            break;
        case 'player_clan'://我的帮派
            $ym = 'module_all/player_clan_detail.php';
            break;
        case 'player_petskill'://宠物技能
            $ym = 'module_all/player_pet_skill.php';
            break;
        case 'player_petskillinfo'://宠物技能详情
            $ym = 'module_all/player_petskill_detail.php';
            break;
        case 'player_skill'://技能
            $ym = 'module_all/player_skill.php';
            break;
        case 'player_skillinfo'://技能详情
            $ym = 'module_all/player_skill_detail.php';
            break;
        case 'player_equip'://装备
            $ym = 'module_all/player_equip_list.php';
            break;
        case 'gm_type_map'://地图设计相关
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
                    $excludeFields = ['mname', 'mop_target', 'mid', 'mup', 'mdown', 'mleft', 'mright'];
                    $copy_name .= "(未命名)";
                    // 获取除排除字段外的其他字段
                    $fields = [];
                    $queryFields = $dblj->query("SHOW COLUMNS FROM system_map");
                    while ($row = $queryFields->fetch(PDO::FETCH_ASSOC)) {
                        if (!in_array($row['Field'], $excludeFields)) {
                            $fields[] = $row['Field'];
                        }
                    }
                    
                    // 构建插入语句
                    $insertFields = implode(',', $fields);
                    $sql = "INSERT INTO system_map ($insertFields, mname)
                            SELECT $insertFields, :copy_name
                            FROM system_map
                            WHERE mid = :target_midid";
                    $stmt = $dblj->prepare($sql);
                    $stmt->bindParam(':copy_name', $copy_name, PDO::PARAM_STR);
                    $stmt->bindParam(':target_midid', $target_midid, PDO::PARAM_INT);

                    try {
                        $stmt->execute();
                        $lastInsertedId = $dblj->lastInsertId();
                        $target_midid = $lastInsertedId;
                    } catch (PDOException $e) {
                        echo "插入失败：" . $e->getMessage();
                    }
                    $ym = 'gm/gm_map_3.php';
                    break;
                case '9':
                    $delete_canshu = 1;
                    $ym = 'gm/gm_map/map_delete.php';
                    break; 
                case '10':
                    $ym = 'gm/gm_map/map_update.php';
                    break;
                case '11':
                    $cmd = "gm_scene_new";
                    $ym = 'module_all/main_page.php';
                    break;
                case '12':
                    $ym = 'gm/gm_map/map_shop_item.php';
                    break; 
                case '13':
                    $ym = 'gm/gm_map/map_rp_def.php';
                    break;
            }
            break;
        case 'gm_type_npc'://npc设计相关
            switch($gm_post_canshu){
                
                //npc各类元素定义跳转实现
                
                case '1':
                    $ym = 'gm/gm_npc_design/npc_attr_def.php';
                    break;
                case '2':
                    $ym = 'gm/gm_npc_design/npc_op_def.php';
                    break;
                case '3':
                    $ym = 'gm/gm_npc_design/npc_event_def.php';
                    break; 
                case '4':
                    if($canshu ==1 ||$canshu =='addnpc' || $canshu =='addnpc_edit'){
                    $ym = 'gm/gm_npc_design/npc_task_def_kill.php';
                    }elseif($canshu ==2 ||$canshu =='additem' || $canshu =='additem_edit'){
                    $ym = 'gm/gm_npc_design/npc_task_def_item.php';
                    }
                    else{
                    $ym = 'gm/gm_npc_design/npc_task_def.php';
                    }
                    break; 
                case '5':
                    if($add ==1){
                    $ym = 'gm/gm_npc_design/npc_skill_def2.php';
                    }elseif($add ==2){
                    $ym = 'gm/gm_npc_design/npc_skill_def3.php';
                    }else{
                    $ym = 'gm/gm_npc_design/npc_skill_def.php';
                    }
                    break;
                case '6':
                    $ym = 'gm/gm_npc_design/npc_equip_def.php';
                    break;
                case '7':
                    $ym = 'gm/gm_npc_design/npc_dead_def.php';
                    break;
                case '8':
                    $excludeFields = ['ncreat_event_id','nlook_event_id','nattack_event_id','nwin_event_id','ndefeat_event_id','npet_event_id','nshop_event_id','nup_event_id','nheart_event_id','nminute_event_id','nname', 'nid', 'nstate', 'nop_target','ntask_target','nop_list', 'ntaskid', 'ntask_list'];
                    $copy_name .= "(未命名)";
                    // 获取除排除字段外的其他字段
                    $fields = [];
                    $queryFields = $dblj->query("SHOW COLUMNS FROM system_npc");
                    while ($row = $queryFields->fetch(PDO::FETCH_ASSOC)) {
                        if (!in_array($row['Field'], $excludeFields)) {
                            $fields[] = $row['Field'];
                        }
                    }
                    
                    // 构建插入语句
                    $insertFields = implode(',', $fields);
                    $sql = "INSERT INTO system_npc ($insertFields, nname)
                            SELECT $insertFields, :copy_name
                            FROM system_npc
                            WHERE nid = :npc_id";
                    $stmt = $dblj->prepare($sql);
                    $stmt->bindParam(':copy_name', $copy_name, PDO::PARAM_STR);
                    $stmt->bindParam(':npc_id', $npc_id, PDO::PARAM_INT);

                    try {
                        $stmt->execute();
                        $lastInsertedId = $dblj->lastInsertId();
                        $npc_id = $lastInsertedId;
                    } catch (PDOException $e) {
                        echo "插入失败：" . $e->getMessage();
                    }
                    $ym = 'gm/gm_npc_design/gm_npc_first.php';
                    break;
                case '9':
                    $delete_canshu = 1;
                    $ym = 'gm/gm_npc_design/npc_delete.php';
                    break; 
                case '10':
                    $ym = 'gm/gm_npc_design/gm_npc_first.php';
                    break;
                case '11':
                    $ym = 'gm/gm_npc_design/gm_npc_first.php';
                    break;
                case '12':
                    $ym = 'gm/gm_npc_design/gm_npc_shop_item.php';
                    break;
            }
            break;
        case 'gm_type_item'://物品设计相关
            switch($gm_post_canshu){
                
                //npc各类元素定义跳转实现
                
                case '1':
                    $ym = 'gm/gm_item_design/gm_item_attr_def.php';
                    break;
                case '2':
                    $ym = 'gm/gm_item_design/gm_item_op_def.php';
                    break;
                case '3':
                    $ym = 'gm/gm_item_design/gm_item_event_def.php';
                    break; 
                case '4':
                    $ym = 'gm/gm_item_design/gm_item_task_def.php';
                    break; 
                case '5':
                    // 要排除的字段
                    $excludeFields = ['icreat_event_id','ilook_event_id','iuse_event_id','iminute_event_id','iname','iop_target', 'iid','itask_target'];
                    $copy_name .= "(未命名)";
                    // 获取除排除字段外的其他字段
                    $fields = [];
                    $queryFields = $dblj->query("SHOW COLUMNS FROM system_item_module");
                    while ($row = $queryFields->fetch(PDO::FETCH_ASSOC)) {
                        if (!in_array($row['Field'], $excludeFields)) {
                            $fields[] = $row['Field'];
                        }
                    }
                    
                    // 构建插入语句
                    $insertFields = implode(', ', $fields);
                    $sql = "INSERT INTO system_item_module ($insertFields,iname)
                            SELECT $insertFields,:copy_name
                            FROM system_item_module
                            WHERE iid = :item_id";
                    $stmt = $dblj->prepare($sql);
                    $stmt->bindParam(':copy_name', $copy_name, PDO::PARAM_STR);
                    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
                    try {
                        $stmt->execute();
                        $lastInsertedId = $dblj->lastInsertId();
                        $item_id = $lastInsertedId;
                    } catch (PDOException $e) {
                        echo "插入失败：" . $e->getMessage();
                    }
                    $ym = 'gm/gm_item_design/gm_item_main_page.php';
                    break;
                case '6':
                    $delete_canshu = 1;
                    // 查询记录的 itype 字段值
                    $ym = 'gm/gm_item_design/gm_item_delete.php';
                    break; 
            }
            break;
        case 'lexical_post'://词法解析测试
            $ym = 'lexical_test.php';
            break;
        case 'global_value_design'://公共数据设计
            $ym = 'global_value_design.php';
            break;
        case 'self_module_api'://自定义模板调用测试
            if($_POST){
                $str = $_POST['page_name'];
                $prefix = 'ct_'; // 要去掉的前缀
                $result = str_replace($prefix, '', $str);
                $table_name = "game_self_page_".$result;
                $sql = "SHOW TABLES LIKE '$table_name'";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                $rowCount = $stmt->rowCount();
                if($rowCount > 0){
                    $page_id = $result;
                    $ym = 'module_all/self_page.php';
                }elseif($rowCount == 0){
                    echo "模板不存在！<br/>";
                    $ym = 'self_module_api.php';
                }
            }else{
            $ym = 'self_module_api.php';
            }
            break;
        case 'npc_html'://npc
            $ym = "module_all/scene_npc.php";
            break;
        case 'item_html'://背包页面
            $ym = "module_all/scene_item.php";
            break;
        case 'function_html'://功能页面
            $ym = "module_all/player_function.php";
            break;
        case 'equip_html'://装备详情页面
            $ym = "module_all/player_equip_detail.php";
            break;
        case 'function_quick_html'://功能快捷键设置页面
        if($canshu !=0){
            $ym = "module_all/player_function_quick_2.php";
        }else{
            
            if($choose_canshu !=0){
                $set_value = $choose_canshu."|".$choose_id;
                $sql = "UPDATE system_fight_quick set quick_value = '$set_value' where quick_pos = '$pos'";
                $dblj->exec($sql);
                
            }
            $ym = "module_all/player_function_quick.php";
        }
            break;
        case 'function_show_html':
            $ym = "module_all/player_function_show.php";
            break;
        case 'function_phone_html':
            $ym = "module_all/player_phone.php";
            break;
        case 'fight_escape':
            $dblj->exec("update system_pet_scene set nhp = nmaxhp where nsid = '$sid' and nstate = 1");
            \player\update_temp_attr($sid,'busy',3,$dblj,1,0);
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            $dblj->exec("DELETE from system_npc_midguaiwu where nsid = '$sid'");
            $ym = 'module_all/main_page.php';
            break;
        case 'iteminfo_new'://物品信息
            $ym = "module_all/scene_item_info.php";
            break;
        case 'item_sale_list'://挂售物品列表
            $ym = "module_all/player_sale_list.php";
            break;
        case 'item_op_basic'://物品操作相关
            // $player = \player\getplayer($sid,$dblj);
            // $uid = $player->uid;
            // $itemid = $iid;
            $sale_state = \player\getitem_sale_state($item_true_id,$sid,$dblj);
            $equip_state = \player\getitem_equip_state($item_true_id,$sid,$dblj);
            $item = \player\getitem_true($item_true_id,$dblj);
            $itype = $item->itype;
            $iname = $item->iname;
            $ino_out = $item->ino_out;
            $ino_give = $item->ino_give;
            $iweight = $item->iweight;
            // 确定$canshu的值
            if($canshu!="全部"||!$canshu){
            if ($itype == "消耗品") {
                $canshu = "药品";
            } elseif ($itype == "兵器" || $itype == "防具") {
                $canshu = "装备";
            } elseif ($itype == "兵器镶嵌物" || $itype == "防具镶嵌物") {
                $canshu = "镶物";
            } elseif ($itype == "书籍") {
                $canshu = "书籍";
            } elseif ($itype == "任务物品") {
                $canshu = "任务";
            } elseif ($itype == "其它") {
                $canshu = "其它";
            }
            }else{
                $canshu = "全部";
            }
            $iname = \lexical_analysis\color_string($iname);
            switch($target_event){
                case 'use':
                    switch($itype){
                        case '消耗品':
                            $iuse_attr = "u".$item->iuse_attr;
                            $iuse_value = $item->iuse_value;
                            $ret = \player\addplayersx($iuse_attr,$iuse_value,$sid,$dblj);
                            \player\changeplayeritem($item_true_id,-1,$sid,$dblj);
                            
                            if($ret){
                                echo "你使用了{$iname}x1<br/>";
                                $sql = "select name,if_show from gm_game_attr where value_type = 1 and id = '$item->iuse_attr'";
                                $stmt = $dblj->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $attr_name = $result['name'];
                                $attr_show = $result['if_show'];
                                if($iuse_value >0){
                                    $iuse_value = "+".$iuse_value."<br/>";
                                }
                                \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
                                if($attr_show){
                                echo "{$attr_name}".$iuse_value;
                                }
                            }else{
                                \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
                                echo "没有任何效果！<br/>";
                            }
                            break;
                        case '兵器':
                            $result = \player\getnowequiptrueid($item_true_id,$sid,$dblj);
                            if($result ==0){
                            \player\changeequipstate($sid,$dblj,$iid,$item_true_id,1);
                            $dblj->exec("UPDATE system_item set iequiped = 1 where item_true_id = '$item_true_id' and sid = '$sid'");
                            echo "你装备了{$iname}<br/>";
                            
                            $mosaic_list = \player\get_player_equip_mosaic_once($item_true_id,$sid,$dblj)['equip_mosaic'];
                            if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(42,'item_module',$mosaic_one,$sid,$dblj);
                                }
                            }
                            
                            \player\exec_global_event(40,'item',$item_true_id,$sid,$dblj);
                            }else{
                            echo "你已经装备了{$iname}！<br/>";
                            }
                            break;
                        case '防具':
                            $result = \player\getnowequiptrueid($item_true_id,$sid,$dblj);
                            if($result ==0){
                            \player\changeequipstate($sid,$dblj,$iid,$item_true_id,1);
                            $dblj->exec("UPDATE system_item set iequiped = 1 where item_true_id = '$item_true_id' and sid = '$sid'");
                            echo "你装备了{$iname}<br/>";
                            $mosaic_list = \player\get_player_equip_mosaic_once($item_true_id,$sid,$dblj)['equip_mosaic'];
                            if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(42,'item_module',$mosaic_one,$sid,$dblj);
                                }
                            }
                            \player\exec_global_event(40,'item',$item_true_id,$sid,$dblj);
                            }else{
                            echo "你已经装备上了{$iname}！<br/>";
                            }
                            break;
                        case '其它':
                            if($item->iuse_event_id!=0){
                            include 'class/events_steps_change.php';
                            $parents_cmd = 'iteminfo_new';
                            events_steps_change($item->iuse_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/scene_item.php',null,$iid,$para);
                            }else{
                            echo "你想使用{$iname}，但好像没什么头绪。<br/>";
                            }
                            break;
                        case '书籍':
                            $target_event = "look_book";
                            //书籍系统
                            break;
                        default:
                            echo "{$iname}不能直接使用<br/>";
                            break;
                    }
                    break;
                case 'out':
                    if($ino_out==0){
                    if($itype =="兵器"||$itype =="防具"){
                    $result = \player\getnowequiptrueid($item_true_id,$sid,$dblj);
                    if($result ==1){
                    echo "你已经穿上了{$iname}!不能丢弃!<br/>";
                    }else{
                    \player\changeplayeritem($item_true_id,-1,$sid,$dblj);
                    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
                    $dblj->exec("DELETE from player_equip_mosaic where equip_id = '$item_true_id'");
                    echo "你丢掉了{$iname}<br/>";
                    }
                    }else{
                    \player\changeplayeritem($item_true_id,-1,$sid,$dblj);
                    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
                    echo "你丢掉了{$iname}x1<br/>";
                    }
                    }else{
                    echo "{$iname}不可丢弃!<br/>";
                    }
                    break;
                case 'outall':
                    if($ino_out==0){
                    if($itype =="兵器"||$itype =="防具"){
                    
                    $result = \player\getnowequiptrueid($item_true_id,$sid,$dblj);
                    if($result ==1){
                    echo "你已经穿上了{$iname}!不能丢弃!<br/>";
                    }else{
                    \player\changeplayeritem($item_true_id,-1,$sid,$dblj);
                    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
                    $dblj->exec("DELETE from player_equip_mosaic where equip_id = '$item_true_id'");
                    echo "你丢掉了所有的{$iname}<br/>";
                    }
                    }else{
                    $out_count = \player\changeplayeritem($item_true_id,"all",$sid,$dblj);
                    $out_burthen = $out_count * $iweight;
                    \player\addplayersx('uburthen',$out_burthen,$sid,$dblj);
                    echo "你丢掉了所有的{$iname}<br/>";
                    }
                    }else{
                    echo "{$iname}不可丢弃!<br/>";
                    }
                    break;
                case 'remove':
                    switch($itype){
                    case '兵器':
                        \player\changeequipstate($sid,$dblj,$iid,$item_true_id,2);
                        $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$item_true_id' and sid = '$sid'");
                        echo "你卸下了{$iname}<br/>";
                        $mosaic_list = \player\get_player_equip_mosaic_once($item_true_id,$sid,$dblj)['equip_mosaic'];
                        if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(43,'item_module',$mosaic_one,$sid,$dblj);
                                }
                            }
                            \player\exec_global_event(41,'item',$item_true_id,$sid,$dblj);
                        break;
                    case '防具':
                        \player\changeequipstate($sid,$dblj,$iid,$item_true_id,2);
                        $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$item_true_id' and sid = '$sid'");
                        echo "你卸下了{$iname}<br/>";
                        $mosaic_list = \player\get_player_equip_mosaic_once($item_true_id,$sid,$dblj)['equip_mosaic'];
                        if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(43,'item_module',$mosaic_one,$sid,$dblj);
                                    
                                }
                            }
                        \player\exec_global_event(41,'item',$item_true_id,$sid,$dblj);
                        break;
                    }
                    break;
            }
            if($target_event =='sale'){
                
                if($ino_give==0){
                if($sale_cancel ==1){
            $nowcount = \player\getsaleitem_true_count($item_true_id,$sid,$dblj);
            if($nowcount >0){
            $dblj->exec("update system_item set isale_state = 0,isale_price = '',isale_time ='',icreate_sale_time  = '' where item_true_id = '$item_true_id' and sid = '$sid';");
            echo "你撤销了{$iname}的出售。<br/>";
            $ym = "module_all/scene_item_info.php";
            }else{
            $iname = \lexical_analysis\color_string($iname);
            echo "{$iname}已销售完!<br/>";
            $ym = "module_all/scene_item.php";
            }
                }else{
            $ym = "module_all/player_sale_html.php";
                }
                }else{
                echo "{$iname}不能挂出销售。<br/>";
                $ym = "module_all/scene_item.php";
                }
            }elseif($target_event =='look_book'){
            $ym = "module_all/gm_book_details.php";
                }else{
                    
            $ym = "module_all/scene_item.php";
            }
            break;
        case 'equip_op_basic'://装备相关操作
        
            if(!$pet_id){
                $pet_id = 0;
            }
            $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equip_true_id')";
            $cxjg = $dblj->query($sql);
            if ($cxjg) {
                $row = $cxjg->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $iid = $row['iid'];
                    $itype = $row['itype'];
                    $iname = \lexical_analysis\color_string($row['iname']);
                }
            }
            switch($target_event){
                case 'choose':
                    $ym = "module_all/player_equip_list_choose.php";
                    break;
                case 'use':
                    switch($itype){
                        case '兵器':
                            \player\changeequipstate($sid,$dblj,$iid,$equip_true_id,1,$pet_id);
                            $dblj->exec("UPDATE system_item set iequiped = 1 where item_true_id = '$equip_true_id' and sid = '$sid'");
                            $canshu = '装备';
                            
                            if(!$pet_id){
                            echo "你装备了{$iname}<br/>";
                            }else{
                            echo "宠物装备了{$iname}<br/>";
                            }
                            
                            if(!$pet_id){
                            $mosaic_list = \player\get_player_equip_mosaic_once($equip_true_id,$sid,$dblj)['equip_mosaic'];
                            if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(42,'item_module',$mosaic_one,$sid,$dblj);
                                }
                            }
                                \player\exec_global_event(40,'item',$equip_true_id,$sid,$dblj);
                            }
                            break;
                        case '防具':
                            \player\changeequipstate($sid,$dblj,$iid,$equip_true_id,1,$pet_id);
                            $dblj->exec("UPDATE system_item set iequiped = 1 where item_true_id = '$equip_true_id' and sid = '$sid'");
                            $canshu = '装备';
                            if(!$pet_id){
                            echo "你装备了{$iname}<br/>";
                            }else{
                            echo "宠物装备了{$iname}<br/>";
                            }
                            if(!$pet_id){
                            $mosaic_list = \player\get_player_equip_mosaic_once($equip_true_id,$sid,$dblj)['equip_mosaic'];
                            if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(42,'item_module',$mosaic_one,$sid,$dblj);
                                    
                                }
                            }
                                \player\exec_global_event(40,'item',$equip_true_id,$sid,$dblj);
                            }
                            break;
                        default:
                            echo "{$iname}不能直接使用<br/>";
                            break;
                    }
                    
                    if(!$pet_id){
                    $ym = "module_all/player_equip_list.php";
                    }else{
                    $ym = "module_all/player_pet_equip_list.php";
                    }
                    break;
                case 'remove':
                    switch($itype){
                    case '兵器':
                        \player\changeequipstate($sid,$dblj,$iid,$equip_true_id,2,$pet_id);
                        $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$equip_true_id' and sid = '$sid'");
                        $canshu = '装备';
                        if(!$pet_id){
                        echo "你卸下了{$iname}<br/>";
                        }else{
                        echo "宠物卸下了{$iname}<br/>";
                        }
                        if(!$pet_id){
                            $mosaic_list = \player\get_player_equip_mosaic_once($equip_true_id,$sid,$dblj)['equip_mosaic'];
                            if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                \player\exec_global_event(43,'item_module',$mosaic_one,$sid,$dblj);
                                }
                            }
                        
                                \player\exec_global_event(41,'item',$equip_true_id,$sid,$dblj);
                        }
                        break;
                    case '防具':
                        \player\changeequipstate($sid,$dblj,$iid,$equip_true_id,2,$pet_id);
                        $dblj->exec("UPDATE system_item set iequiped = 0 where item_true_id = '$equip_true_id' and sid = '$sid'");
                        if(!$pet_id){
                        echo "你卸下了{$iname}<br/>";
                        }else{
                        echo "宠物卸下了{$iname}<br/>";
                        }if(!$pet_id){
                            $mosaic_list = \player\get_player_equip_mosaic_once($equip_true_id,$sid,$dblj)['equip_mosaic'];
                            if($mosaic_list){
                                $mosaic_ones = explode("|",$mosaic_list);
                                foreach ($mosaic_ones as $mosaic_one){
                                    
                                \player\exec_global_event(43,'item_module',$mosaic_one,$sid,$dblj);
                                    
                                }
                            }
                                \player\exec_global_event(41,'item',$equip_true_id,$sid,$dblj);
                        }
                        break;
                    }
                    
                    if(!$pet_id){
                    $ym = "module_all/player_equip_list.php";
                    }else{
                    $ym = "module_all/player_pet_equip_list.php";
                    }
                    break;
            }
            break;
        case 'get_item_ret'://拾取地面物品
            $icount = \player\getsceneitem_state($mid,$iid,$dblj);
            $cmd = "gm_scene_new";
            if($icount >0){
            \player\getsceneitem($sid,$iid,$mid,$iname,$icount,$dblj);
            }else{
            echo "没有该物品!<br/>";
            }
            $ym = "module_all/main_page.php";
            break;
        case 'photo_detail'://照片相关
            if($upload ==1){
            if(empty($_POST['id'])||empty($_POST['name'])){
                echo "id和name都不能为空！";
                exit;
            }
            $id = $_POST['id'];
            $name = $_POST['name'];
            
            $repeat_cxjg = $dblj->query("select id,name from system_photo where (id = '$id' || name = '$name') and type = '$type'");
            $repeat_ret = $repeat_cxjg->fetch(PDO::FETCH_ASSOC);
            if($repeat_ret['name'] ||$repeat_ret['id']){
                echo "当前id或名称已存在！";
                exit;
            }
            
            $photo_style = $_POST['photo_style'];
            $photo_zip_level = $_POST['zip_level'];
            $sql = "select * from system_photo_type where name ='$type'";
            $stmt = $dblj->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $file = $_FILES['file'];
            $fileType = $file['type'];
            $fileSize = $file['size'];
            // 验证文件类型为图片
            $allowedTypes = ['image/jpeg','image/jpg','image/webp', 'image/png', 'image/gif'];
            if (!in_array($fileType, $allowedTypes)) {
                echo '只允许上传图片文件(jpeg,jpg,webp,png,gif)';
                exit;
            }
            // 验证文件大小在5000KB以下
            $maxSize = 5000 * 1024; // 5000KB
            if ($fileSize > $maxSize) {
                echo '图片大小不能超过5M';
                exit;
            }
            if ($photo_zip_level < 0 ||$photo_zip_level >100) {
                echo '压缩参数有误！';
                exit;
            }
            
            
            function compressImage($sourcePath, $destinationPath, $quality = 75, $compressionLevel = 6) {
                // 获取图片的 MIME 类型
                $imageInfo = getimagesize($sourcePath);
                $mime = $imageInfo['mime'];
            
                switch ($mime) {
                    case 'image/jpeg':
                        $sourceImage = imagecreatefromjpeg($sourcePath);
                        imagejpeg($sourceImage, $destinationPath, $quality);
                        break;
            
                    case 'image/png':
                        $sourceImage = imagecreatefrompng($sourcePath);
                        imagepng($sourceImage, $destinationPath, $compressionLevel);
                        break;
            
                    case 'image/gif':
                        $sourceImage = imagecreatefromgif($sourcePath);
                        imagegif($sourceImage, $destinationPath);
                        break;
                    case 'image/webp':
                        $sourceImage = imagecreatefromgif($sourcePath);
                        imagewebp($sourceImage, $destinationPath, $quality);
                        break;
                    default:
                        echo '不支持的图片类型';
                        return;
                }
            
                // 释放图像资源
                imagedestroy($sourceImage);
            
                echo '图片压缩完成！';
            }

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = $type."-"."$id"."-".$name.".".$extension;
            $targetDirectory = 'images/'.$type;
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }
            $targetPath = $targetDirectory .'/'. $fileName;
            $sql = "INSERT INTO system_photo set id = '$id',type = '$type',name = '$name',photo_url = '$targetPath',photo_style = '$photo_style',format_type = '$extension';";
            $cxjg = $dblj->exec($sql);
            // 移动上传文件到目标路径
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                if($photo_zip_level!=100){
                compressImage($targetPath, $targetPath,$photo_zip_level);
                }
                echo '文件上传成功<br/>';
                $sql = "UPDATE system_photo_type set contains = contains + 1 where name = '$type'";
                $cxjg = $dblj->exec($sql);
            } else {
                echo '文件上传失败<br/>';
            }
            }elseif($upload ==2){
                if(empty($_POST['name'])){
                echo "name不能为空！";
                exit;
            }
            $id = $_POST['id'];
            $type = $_POST['type'];
            $old_type = $_POST['old_type'];
            $name = $_POST['name'];
            $format_type = $_POST['format_type'];
            $photo_style = $_POST['photo_style'];
            $sql = "UPDATE system_photo SET type = '$type',name = '$name',photo_style = '$photo_style' where id = '$id';";
            $cxjg = $dblj->exec($sql);
            $sql = "UPDATE system_photo_type SET contains = contains - 1 where name = '$old_type';";
            $cxjg = $dblj->exec($sql);
            $sql = "UPDATE system_photo_type SET contains = contains + 1 where name = '$type';";
            $cxjg = $dblj->exec($sql);
            $oldFileName = $_POST['old_url']; // 旧文件路径和名称
            $image_url = "$type"."-"."$id"."-"."$name".".$format_type";
            $newFileName = "images/"."$type"."/".$image_url;// 新文件路径和名称
            $sql = "UPDATE system_photo SET photo_url = '$newFileName' where id = '$id';";
            $cxjg = $dblj->exec($sql);
            if(rename($oldFileName, $newFileName)){
            echo "修改成功！<br/>";
            }else{
            echo "修改失败！<br/>";
            }
            }elseif($upload ==3){
            $sql = "select * from system_photo where id ='$id' and type = '$type'";
            $stmt = $dblj->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $filePath = $row['photo_url']; // 图片文件路径
            $type = $row['type'];
            if (unlink($filePath)) {
            $sql = "DELETE FROM system_photo WHERE id = '$id' and type = '$type'";
            $cxjg = $dblj->exec($sql);
            $sql = "UPDATE system_photo_type SET contains = contains - 1 where name = '$type';";
            $cxjg = $dblj->exec($sql);
            echo "图片删除成功。<br/>";
            } else {
            echo "图片删除失败。<br/>";
                }
            }
            $ym = 'gm/gamephoto_manage_2.php';
            break;
        case 'photo_type_add'://照片类别
            $ym = 'gm/gamephoto_manage.php';
            break;
        case 'photo_upload'://照片上传
            $ym = 'gm/gamephoto_manage_4.php';
            break;
        case 'photo_change'://照片更新
            $ym = 'gm/gamephoto_manage_3.php';
            break;
        case 'photo_choose'://照片选择
            $ym = 'gm/gamephoto_manage_5.php';
            break;
        case 'login_photo'://登录页图片
            $ym = 'gm/gamephoto_manage_6.php';
            break;
        case 'target_mid'://区域设计
            $ym = 'gm/gm_map.php';
            break;
        case 'gm_map'://地图设计
            $ym = 'gm/gm_map.php';
            break;
        case 'gm_skill'://技能设计
            $ym = 'gm/gm_skill.php';
            break;
        case 'gm_skill_appoint_choose':
            $ym = 'gm/gm_skill_design/gm_skill_equip_appoint.php';
            break;
        case 'map_out_choose'://地图出口
            if($update_canshu ==1){
                switch($map_out_canshu){
                    case '1':
                        $sql = "UPDATE system_map set mright ='$target_mid' where mid = '$center_id'";
                        $sql2 = "UPDATE system_map set mleft ='$center_id' where mid = '$target_mid'";
                    break;
                    case '2':
                        $sql = "UPDATE system_map set mdown ='$target_mid' where mid = '$center_id'";
                        $sql2 = "UPDATE system_map set mup ='$center_id' where mid = '$target_mid'";
                    break;
                    case '3':
                        $sql = "UPDATE system_map set mleft ='$target_mid' where mid = '$center_id'";
                        $sql2 = "UPDATE system_map set mright ='$center_id' where mid = '$target_mid'";
                    break;
                    case '4':
                        $sql = "UPDATE system_map set mup ='$target_mid' where mid = '$center_id'";
                        $sql2 = "UPDATE system_map set mdown ='$center_id' where mid = '$target_mid'";
                    break;
                }
                $cxjg = $dblj->exec($sql);
                $cxjg = $dblj->exec($sql2);
                $target_midid = $center_id;
                echo "更新成功!<br/>";
            $ym = 'gm/gm_map/map_out.php';
            }elseif($update_canshu ==2){
                switch($map_out_canshu){
                    case '1':
                        $sql = "UPDATE system_map set mright ='' where mid = '$target_midid'";
                    break;
                    case '2':
                        $sql = "UPDATE system_map set mdown ='' where mid = '$target_midid'";
                    break;
                    case '3':
                        $sql = "UPDATE system_map set mleft ='' where mid = '$target_midid'";
                    break;
                    case '4':
                        $sql = "UPDATE system_map set mup ='' where mid = '$target_midid'";
                    break;
                }
                $cxjg = $dblj->exec($sql);
                echo "更新成功!<br/>";
                $ym = 'gm/gm_map/map_out.php';
            }elseif($update_canshu ==3){
                $sql = "SELECT * from system_map where mid ='$target_midid'";
                $cxjg = $dblj->query($sql);
                $row = $cxjg->fetch(PDO::FETCH_ASSOC);
                $marea_name = $row['marea_name'];
                $qy_id = $row['marea_id'];
                $sql = "INSERT INTO system_map (marea_name, mname, marea_id) VALUES ('$marea_name', '未命名', $qy_id)";
                $cxjg =$dblj->exec($sql);
                $target_midid_new = $dblj->lastInsertId();
                switch($map_out_canshu){
                    case 1:
                        $sql = "UPDATE system_map set mleft = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mright = '$target_midid_new' where mid = '$target_midid'";
                        break;
                    case 2:
                        $sql = "UPDATE system_map set mup = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mdown = '$target_midid_new' where mid = '$target_midid'";
                        break;
                    case 3:
                        $sql = "UPDATE system_map set mright = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mleft = '$target_midid_new' where mid = '$target_midid'";
                        break;
                    case 4:
                        $sql = "UPDATE system_map set mdown = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mup = '$target_midid_new' where mid = '$target_midid'";
                        break;
                }
                $dblj->exec($sql);
                $dblj->exec($sql2);
                // 查询语句
                $ym = 'gm/gm_map/map_out.php';
            }elseif($update_canshu ==4){
                $sql = "SELECT * from system_map where mid ='$target_midid'";
                $cxjg = $dblj->query($sql);
                $row = $cxjg->fetch(PDO::FETCH_ASSOC);
                $marea_name = $row['marea_name'];
                $map_name = $row['mname'];
                $mdesc = $row['mdesc'];
                $qy_id = $row['marea_id'];
                $sql = "INSERT INTO system_map (marea_name, mname,mdesc, marea_id) VALUES ('$marea_name', '$map_name','$mdesc', $qy_id)";
                $cxjg =$dblj->exec($sql);
                $target_midid_new = $dblj->lastInsertId();
                switch($map_out_canshu){
                    case 1:
                        $sql = "UPDATE system_map set mleft = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mright = '$target_midid_new' where mid = '$target_midid'";
                        break;
                    case 2:
                        $sql = "UPDATE system_map set mup = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mdown = '$target_midid_new' where mid = '$target_midid'";
                        break;
                    case 3:
                        $sql = "UPDATE system_map set mright = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mleft = '$target_midid_new' where mid = '$target_midid'";
                        break;
                    case 4:
                        $sql = "UPDATE system_map set mdown = '$target_midid' where mid = '$target_midid_new'";
                        $sql2 = "UPDATE system_map set mup = '$target_midid_new' where mid = '$target_midid'";
                        break;
                }
                $dblj->exec($sql);
                $dblj->exec($sql2);
                // 查询语句
                $ym = 'gm/gm_map/map_out.php';
            }else{
                $ym = 'gm/gm_map/map_out_choose.php';
            }
            break;
        case 'gm_map_2'://地图相关
            $ym = 'gm/gm_map_2.php';
            break;
        case 'area_post'://区域更新相关事件
            if($gm_post_canshu ==1){
            $ym = 'gm/gm_map/area_add.php';
            break;
            }elseif($gm_post_canshu ==0){
            $sql = "select MAX(pos) as max_pos from `system_area`";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $max_pos = $ret['max_pos'] + 1;
            $last_id = $_POST['last_id'];
            $name = $_POST['name'];
            $belong_name =$_POST['area_belong']; 
            $sql = "INSERT INTO system_area set pos = '$max_pos',id = '$last_id',name = '$name',belong = '$belong_name';";
            $cxjg =$dblj->exec($sql);
            $ym = 'gm/gm_map_2.php';
            break;
            }
        case 'game_task_list'://任务设计相关
            if($add_canshu ==1){
                $sql = "INSERT INTO system_task set tname = '未命名',ttype ='$task_type';";
                $cxjg = $dblj->exec($sql);
                $task_id = $dblj->lastInsertId();
            }
            $ym = 'gm/gm_task_design/gm_task_main.php';
            break;
        case 'game_item_list'://物品设计相关
            if($add_canshu ==1){
                $sql = "INSERT INTO system_item_module set iname = '未命名',iarea_name = '未分区',itype ='$item_type',isubtype = '$item_subtype';";
                $cxjg = $dblj->exec($sql);
                $item_id = $dblj->lastInsertId();
                $ym = 'gm/gm_item_design/gm_item_main_page.php';
            }elseif($delete_canshu ==1){

                    $query = $dblj->prepare("SELECT itype FROM system_item_module WHERE iid = :item_id");
                    $query->bindParam(':item_id', $item_id, PDO::PARAM_INT);
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    
                    if ($row) {
                        $gm_post_canshu = $row['itype']; // 将 itype 字段值赋给变量 $gm_post_canshu
                        // 删除记录
                        $deleteQuery = $dblj->prepare("DELETE FROM system_item_module WHERE iid = :item_id");
                        $deleteQuery->bindParam(':item_id', $item_id, PDO::PARAM_INT);
                        if ($deleteQuery->execute()) {
                            echo "物品删除成功！<br/>";
                        } else {
                            echo "物品删除失败：<br/>" . $deleteQuery->errorInfo();
                        }
                    } else {
                        echo "找不到要删除的记录。<br/>";
                    }
                $ym = 'gm/gameitem_design.php';
            }
            else{
                $ym = 'gm/gm_item_design/gm_item_main_page.php';
            }
            break;
        case 'item_attr_def'://物品属性相关
            $ym = 'gm/gm_item_design/gm_item_attr_def.php';
            break;
        case 'mytask_2'://任务
            $ym = 'module_all/task.php';
            break;
        case 'mytask_info'://任务信息
            $ym = 'module_all/task_info.php';
            break;
        case 'player_friend_html':
            $ym = "module_all/player_friend.php";
            break;
        case 'player_team_html':
        if($canshu){
            $ym = "module_all/player_team.php";
        }else{
            $ym = "module_all/player_team_list.php";
        }
            break;
        case 'player_clan_html':
            switch($canshu){
                case 'creat':
                    $ym = "module_all/player_clan_creat.php";
                    break;
                case 'view':
                    $ym = "module_all/player_other_clan.php";
                    break;
                case 'join':
                    $ym = "module_all/player_other_clan.php";
                    break;
            }
            break;
        case 'player_team_invite'://邀请组队
            $send_time = date('Y-m-d H:i:s');
            if($canshu ==1){
            $sql = "select * from game1 where sid = '$oid'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $invited_state = $ret['uteam_invited_id'];
            $team_id = \player\getplayer($sid,$dblj)->uteam_id;
            if($invited_state==0&&$team_id!=0){
            \player\changeplayersx('uteam_invited_id',$team_id,$oid,$dblj);
            $oid = $ret['uid'];
            $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','邀请你加入队伍!请打开队伍页面进行确认!<br/>',$player->uid,{$oid},1,'$send_time')";
            $cxjg = $dblj->exec($sql);
            echo "你邀请对方加入你的队伍！<br/>";
            }elseif($team_id==0){
            echo "请创建队伍后再来邀请!<br/>";
                }{
            echo "对方正被其他小队邀请!<br/>";
            }
            }
            $ym = "module_all/scene_oplayer_detail.php";
            break;
        case 'player_delete_friend':
            $send_time = date('Y-m-d H:i:s');
            if($canshu ==1){
            $sql = "delete from system_player_friend where usid = '$sid' and osid = '$oid'";
            $cxjg = $dblj->exec($sql);
            $sql = "select * from game1 where sid = '$oid'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $oid = $ret['uid'];
            echo "已将对方移出好友列表！<br/>";
            }elseif($canshu ==2){
            $sql = "INSERT into system_player_friend (usid,osid)values ('$sid','$oid')";
            $cxjg = $dblj->exec($sql);
            $sql = "select * from game1 where sid = '$oid'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $oid = $ret['uid'];
            $player = \player\getplayer($sid,$dblj);
            $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','加你为好友了!',$player->uid,{$oid},1,'$send_time')";
            $cxjg = $dblj->exec($sql);
            echo "已将对方加入好友列表！<br/>";
            }
            $ym = "module_all/scene_oplayer_detail.php";
            break;
        case 'player_delete_black':
            $send_time = date('Y-m-d H:i:s');
            if($canshu ==1){
            $sql = "delete from system_player_black where usid = '$sid' and osid = '$oid'";
            $cxjg = $dblj->exec($sql);
            $sql = "select * from game1 where sid = '$oid'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $oid = $ret['uid'];
            echo "已将对方移出黑名单！<br/>";
            }elseif($canshu ==2){
            $sql = "INSERT into system_player_black (usid,osid)values ('$sid','$oid')";
            $cxjg = $dblj->exec($sql);
            $sql = "select * from game1 where sid = '$oid'";
            $cxjg = $dblj->query($sql);
            $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
            $oid = $ret['uid'];
            $player = \player\getplayer($sid,$dblj);
            $sql = "insert into system_chat_data(name,msg,uid,imuid,chat_type,send_time) values('$player->uname','我们恩断义绝吧!',$player->uid,{$oid},1,'$send_time')";
            $cxjg = $dblj->exec($sql);
            echo "已将对方加入黑名单！<br/>";
            }
            $ym = "module_all/scene_oplayer_detail.php";
            break;
        case 'system_reward':
            $ym = "module_all/gm_reward_action.php";
            break;
        case "nowonline"://当前在线人数
            $ym = "module_all/nowonline_player.php";
            break;
        case 'auc_page'://拍卖行
            $ym = "module_all/gm_auc_page.php";
            break;
        case 'rank_page'://排行榜
            $ym = "module_all/gm_rank_page.php";
            break;
        case 'get_time_page'://获取详细时间
            $ym = "game/game_detail_time.php";
            break;
        case 'player_quest_tran'://交易
            $ym = "module_all/player_quest_tran.php";
            break;
        case 'player_buy'://货架购买
            $ym = "module_all/gm_shop_player.php";
            break;
        case 'player_gift'://玩家赠送
            $ym = "module_all/gm_gift_player.php";
            break;
        case 'player_gift_info'://玩家赠送物品信息
            $ym = "module_all/gm_gift_info.php";
            break;
    }
// 13-17ms

    $currentFilePath = $ym;

    if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
       $is_designer_post_str .= $key . ' = ' . $value . '<br>';
    }
}

    
//$usersession = \player\getplayersession($sid,$dblj,$_SESSION['sessionID']);

//if($usersession['session_id'] && $usersession['session_id'] !=$_SESSION['sessionID']){
//$nowdate = date('Y-m-d H:i:s');
//echo $player->uname."已下线！原因：顶号登录！";
//$sql = "update game1 set endtime='$nowdate',sfzx=0 WHERE sid='$sid'";
//$dblj->exec($sql);
//header("refresh:1;url=index.php");
//exit();
// }

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
// 20-27ms

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <title><?php echo $gm_post->game_name ?></title>
    <link rel="stylesheet" href="css/gamecss.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>
<?php
            $player = \player\getplayer($sid,$dblj);
            if($player->uis_designer ==1){
                $htmlContent_2 = <<<HTML
parse解析变量：<br/>
{$is_designer_parse_str}
HTML;
            $test_code_text = $htmlContent_2;
            include_once 'gm/gm_test_code_show/gm_test_code_cmd.php';
            if(!empty($is_designer_post_str)){
        $htmlContent_3 = <<<HTML
        _POST解析后的变量：<br>
{$is_designer_post_str}
HTML;
        $test_code_text = $htmlContent_3;
        include_once 'gm/gm_test_code_show/gm_test_code_post.php';
            }
            }
            $getgameconfig = \player\getgameconfig($dblj);
            if ($getgameconfig->game_temp_notice_time != 0) {
                $temp_notice = $getgameconfig->game_temp_notice;
                $noticeContent = <<<HTML
                <font color='red'>[临时公告]：{$temp_notice}</font><br/>
HTML;
echo $noticeContent;
            }



    if (!$ym==''){
        //23-27ms
    if (!isset($sid) || $sid=='' ){
        if ($cmd!='cj' && $cmd!=='cjplayer'){
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="0;URL=index.php">
HTML;
echo $refresh_html;
            //header("refresh:0;url=index.php");
            exit();
        }
        else{
            include "$ym";
        }
        }else{
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $dblj->exec("update game4 set device_agent = '$userAgent' where sid = '$sid'");
        $player = \player\getplayer($sid,$dblj);
        $nowdate = date('Y-m-d H:i:s');
        $gameconfig = \player\getgameconfig($dblj);
        $system_now_minute_time = $gameconfig->game_player_regular_minute;
        $minute=floor((strtotime($nowdate)-strtotime($player->endtime))/60);//获取刷新分钟间隔
        $system_offline_time = $gameconfig->offline_time;
        while(floor((strtotime($player->endtime)-strtotime($player->minutetime))/60 >0) &&$cmd!='login' && $cmd!='cjplayer' &&$cmd !='cj'){
        $parents_cmd = $cmd;
        \player\exec_global_event(24,'null',null,$sid,$dblj);
        // $ret = global_event_data_get(24,$dblj);
        // if($ret){
        // global_events_steps_change(24,$sid,$dblj,$just_page,$steps_page,$cmid,$currentFilePath,null,null,$para);
        // }
        $player->minutetime = date('Y-m-d H:i:s', strtotime($player->minutetime) + 60); // 增加 60 秒
        $sql = "UPDATE game1 SET minutetime = DATE_ADD(minutetime, INTERVAL 1 MINUTE) WHERE sid = '$sid'";
        $dblj->exec($sql);
        // ob_flush();
        // flush();
        }
        
        if ($minute>=$system_offline_time &&$player->uis_designer==0 &&$system_offline_time !=0||($player->sfzx==0&&$player->uis_designer==0)){
            //单位是秒
            echo '<meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">';
            echo "【哎呀！你好像进入了虚无领域!】<br/>".$player->uname."离线时间过长，请重新登陆";
            //logout($sid);
            $sql = "update game1 set endtime='$nowdate',sfzx=0,ucmd='' WHERE sid='$sid'";
            $dblj->exec($sql);
            
            // 查找以 user:$sid 开头的所有键
            $keys = $redis->keys("user:$sid*");
            
            // 删除所有匹配的键
            if (!empty($keys)) {
                $redis->del($keys);
            }
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=index.php">
HTML;
echo $refresh_html;
        }else{
            \player\put_system_message_sql($player->uid,$dblj);
            $dblj->exec("update game1 set ucmd = '$cmd' where sid = '$sid'");
            include "$ym";
            $dblj->exec("update game1 set endtime='$nowdate',sfzx=1 WHERE sid='$sid'");
        }
    }
    
}else{
    
    if($cmd !='login'&&$cmd !='cjplayer'){
    //如果一切都不符合条件，就跳转到注册界面。
    echo "出错了！你可能正常尝试进行跨域访问！系统已记录此次行为！<br/>";
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=index.php">
HTML;
echo $refresh_html;
    //header("refresh:2;url=index.php");
    exit();
    }
}

//$system_detail_time_page = $encode->encode("cmd=get_system_time&sid=$sid");

        //这里的include是吃性能大户
        //80-599ms
    }?>
</body>
<footer>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    
    <?php 
    $player = \player\getplayer($sid,$dblj);
    $now_time = date('H:i:s');
    if($player->uis_designer ==1){
    $gm_ret = $encode->encode("cmd=gm_scene_new&sid=$sid");
    $gm_cheat = $encode->encode("cmd=gm_cheat&sid=$sid");
    $gm_cheat_html .=<<<HTML
<a href="?cmd={$gm_cheat}">GM修改器</a><br/>
<a href="?cmd={$gm_ret}">前往场景</a><br/>
HTML;
}
echo $gm_cheat_html;

    ?>
</footer>
</html>
<?php
 //调用user.ini是否存在
include("./ini/user_ini.php");
$bugym = ($iniFile->getItem('最后页面id', '页面id'));
//最大值
$a5 = $cmid;
//将cmd最小最大值写入
$end_time = microtime(true);
$execution_time = ceil(($end_time - $start_time) * 1000);// 单位是毫秒
echo "页面执行时间为：{$execution_time} 毫秒<br/>";
echo 'Memory usage: ' . memory_get_usage() . ' bytes';
if($player->uis_designer ==1){
    $gm_other_code = <<<HTML
当前php路径：{$currentFilePath}<br/>
a4的值赋值给xcmid：{$a4}<br/>
cmid值赋值给a5的值赋值给dcmid：{$a5}<br/>
cmid的值为：{$cmid}<br/>
HTML;
$test_code_text = $gm_other_code;
echo "<br/>";
include_once 'gm/gm_test_code_show/gm_test_code_other.php';
}
$iniFile->updItem('验证信息', ['xcmid值' => $a4, 'dcmid值' => $a5]);
//写入超链接及其所对应的值
$iniFile->delCategory('超链接值');
$aa = $a5 - $a4 + 1;
for ($x = 0; $x < $aa; $x++) {
$q3 = $cdid[$x];
if (empty($q3)) {
    continue;
}
$q4 = $clj[$x];
# 添加一个子项(如果子项存在，则覆盖;)
$iniFile->addItem('超链接值', [$q3 => $q4]);
}
global $redis;

$redis->flushAll($cacheKey);

// echo '<pre>';
// print_r(get_defined_vars());
// echo '</pre>';
?>