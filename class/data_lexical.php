<?php
require_once 'lexical_analysis.php';
require_once 'encode.php';
// 在用户登录时，检查是否有其他设备已登录，并强制其下线


function check_if_logged($sid){
    $servername = "127.0.0.1";
    $username = "xunxian";
    $password = "123456";
    $dbname = "xunxian";
    $db = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT session_id FROM user_sessions WHERE sid = ? and is_active = 1";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $sid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0){
        $row = $result->fetch_assoc();
        return $row['session_id'];
    } else {
        return $_SESSION['sessionID'];
    }
}


function login($sid, $sessionId,$deviceInfo) {
    $servername = "127.0.0.1";
    $username = "xunxian";
    $password = "123456";
    $dbname = "xunxian";
    $db = new mysqli($servername, $username, $password, $dbname);

    // 在 user_sessions 表中记录当前会话
    $insertQuery = "INSERT INTO user_sessions (sid, session_id, is_active,device_info) VALUES (?, ?, 1,?)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bind_param("sss", $sid, $sessionId,$deviceInfo);
    $insertStmt->execute();
}

// 在用户退出登录时，标记会话为无效
function logout($sid) {
    $servername = "127.0.0.1";
    $username = "xunxian";
    $password = "123456";
    $dbname = "xunxian";
    $db = new mysqli($servername, $username, $password, $dbname);
    // 假设已经连接到数据库 $db
    $updateQuery = "UPDATE user_sessions SET is_active = 0 WHERE sid = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param("s", $sid);
    $updateStmt->execute();
    // 用户退出登录成功
}


// 检验触发条件的函数
function checkTriggerCondition($condition,$dblj=null,$sid,$oid=null,$mid=null) {
    $ret = lexical_analysis\process_string($condition,$sid,$oid,$mid);
    @$ret = eval("return $ret;");
    // 返回布尔值，表示条件是否满足
    return $ret;
}

function attrsetting($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);

// 使用逗号分割字符串
$keyValuePairs = explode(",", $input);

foreach ($keyValuePairs as $pair) {
    // 使用等号分割键值对
    $split = explode("=", $pair);

    if (count($split) >= 2) {
        $ele_1 = $split[0];
        $ele_2 = $split[1];
        $parts = explode(".", $ele_1);
        if (count($parts) >= 2) {
            $ele_1_1 = $parts[0]; // 小数点左边的内容
            $ele_1_2 = $parts[1]; // 小数点右边的内容
            } else {
            echo "无法匹配到小数点 '.'<br/>";
            }
        $ele_2 =lexical_analysis\process_string($ele_2,$sid,$oid,$mid);
        @$ele_2 = eval("return $ele_2;");
        switch ($ele_1_1) {
            case 'u':
                if(strpos($ele_1_2, "c_msg") === 0){
                    $sql = "select uname,uid from game1 where sid ='$sid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_name = $row['uname'];
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $sql = "insert into system_chat_data (name,msg,send_time,uid)values('$player_name','$ele_2','$send_time','$player_uid')";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                elseif(strpos($ele_1_2, "p_msg") === 0){
                    $sql = "select uid from game1 where sid ='$sid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $sql = "insert into system_chat_data (name,msg,send_time,uid,imuid,chat_type)values('系统通知','$ele_2','$send_time','0','$player_uid','1')";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                else{
                $sql = "select name from gm_game_attr where value_type =1 and id = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_name = $row['name'];
                $ele_1_2 = $ele_1_1.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");
                $result_2 = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and sid = '$sid'");
                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0 ) {
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                } elseif($result_2->num_rows > 0){
                    $updateQuery = "UPDATE system_addition_attr SET value = '$ele_2' WHERE sid = '$sid' and name = '$ele_1_2'";
                    $db->query($updateQuery);
                } else{
                    // 字段不存在，添加新字段并更新值
                    $alterQuery = "INSERT INTO system_addition_attr(name,value,sid)values('$ele_1_2','$ele_2','$sid')";
                    $db->query($alterQuery);
                }
}
                break;
            case 'o':
                // 检查字段是否存在
                if(strpos($ele_1_2, "c_msg") === 0){
                    $sql = "select uname,uid from game1 where sid ='$oid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_name = $row['uname'];
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $sql = "insert into system_chat_data (name,msg,send_time,uid)values('$player_name','$ele_2','$send_time','$player_uid')";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                elseif(strpos($ele_1_2, "p_msg") === 0){
                    $sql = "select uid from game1 where sid ='$oid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $sql = "insert into system_chat_data (name,msg,send_time,uid,imuid,chat_type)values('系统通知','$ele_2','$send_time','0','$player_uid','1')";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                else{
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                } else {
                    // 字段不存在，添加新字段并更新值
                    $alterQuery = "ALTER TABLE game1 ADD $ele_1_2 VARCHAR(255)";
                    $db->query($alterQuery);

                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                }
                }
                break;
            case 'g':
                // 检查表中是否存在 gid=$ele_1_2 的数据
                $checkQuery = "SELECT * FROM global_data WHERE gid = '$ele_1_2'";
                $result = $db->query($checkQuery);
            
                // 如果存在，执行更新操作
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE global_data SET gvalue = '$ele_2' WHERE gid = '$ele_1_2'";
                    $db->query($updateQuery);
                } else {
                    // 不存在，执行插入操作
                    $insertQuery = "INSERT INTO global_data (gid,gvalue) VALUES ('$ele_1_2', '$ele_2')";
                    $db->query($insertQuery);
                }
                break;
            case 'c':
                if(strpos($ele_1_2, "c_msg") === 0){
                    $send_time = date('Y-m-d H:i:s');
                    $sql = "insert into system_chat_data (name,msg,send_time,uid)values('系统通知','$ele_2','$send_time','')";
                    // 使用预处理语句
                    $stmt = $db->prepare($sql);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                break;
            default:
                break;
        }
        // echo "ele_1: " . $ele_1 . "<br/>";
        // echo "ele_2: " . $ele_2 . "<br/>";
        //这里要获取到属性字段表中玩家属性类别下id等于$ele_1的name名称
    } else {
        //echo "无法匹配到键值对<br/>";
        break;
    }
}

return 1;
}

function attrchanging($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);

// 使用逗号分割字符串
$keyValuePairs = explode(",", $input);

foreach ($keyValuePairs as $pair) {
    // 使用等号分割键值对
    $split = explode("=", $pair);

    if (count($split) >= 2) {
        $ele_1 = $split[0];
        $ele_2 = $split[1];
        $parts = explode(".", $ele_1);
        if (count($parts) >= 2) {
            $ele_1_1 = $parts[0]; // 小数点左边的内容
            $ele_1_2 = $parts[1];// 小数点右边的内容
            } else {
            echo "无法匹配到小数点 '.'<br/>";
            }
        $ele_2 =lexical_analysis\process_string($ele_2,$sid,$oid,$mid);
        @$ele_2 = eval("return $ele_2;");
        switch ($ele_1_1) {
            case 'u':
                $sql = "select name from gm_game_attr where value_type =1 and id = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_name = $row['name'];
                $ele_1_2 = $ele_1_1.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");
                $result_2 = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and sid = '$sid'");
                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = $ele_1_2 + '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                }elseif($result_2->num_rows > 0){
                $updateQuery = "UPDATE system_addition_attr SET value = value + '$ele_2' WHERE sid = '$sid' and name = '$ele_1_2'";
                $db->query($updateQuery);
                } else {
                    // 字段不存在，添加新字段并更新值,这边还要做判断
                    $alterQuery = "INSERT INTO system_addition_attr(name,value,sid)values('$ele_1_2','$ele_2','$sid')";
                    $db->query($alterQuery);
                }
                if($ele_2 >=0 && $attr_name){
                echo "{$attr_name}+{$ele_2}<br/>";
                }elseif($ele_2 <0 && $attr_name){
                echo "{$attr_name}{$ele_2}<br/>";
                }
                break;
            case 'g':
                // 检查表中是否存在 gid=$ele_1_2 的数据
                $checkQuery = "SELECT * FROM global_data WHERE gid = '$ele_1_2'";
                $result = $db->query($checkQuery);
            
                // 如果存在，执行更新操作
                if ($result->num_rows > 0) {
                    if (is_numeric($ele_2)) {
                        $updateQuery = "UPDATE global_data SET gvalue = gvalue + '$ele_2' WHERE gid = '$ele_1_2'";
                    } else {
                        $updateQuery = "UPDATE global_data SET gvalue = CONCAT(gvalue, '$ele_2') WHERE gid = '$ele_1_2'";
                    }
                    $db->query($updateQuery);
                } else {
                     // 不存在，执行插入操作
                    $insertQuery = "INSERT INTO global_data (gid,gvalue) VALUES ('$ele_1_2', '$ele_2')";
                    $db->query($insertQuery);
                }
                break;

            default:
                break;
        }
         "ele_1: " . $ele_1 . "<br/>";
         "ele_2: " . $ele_2 . "<br/>";
    } else {
        //echo "无法匹配到键值对<br/>";
        break;
    }
}

return 1;
}

function itemchanging($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);

//做负重判断

// 使用逗号分割字符串

$keyValuePairs = explode(",", $input);

foreach ($keyValuePairs as $pair) {
    // 使用|分割键值对
    $item_true_id = '';
    $split = explode("|", $pair);
    if (count($split) >= 2) {
        $ele_1 = $split[0];
        $ele_2 = $split[1];
        $ele_2 =lexical_analysis\process_string($ele_2,$sid,$oid,$mid);
        @$ele_2 = eval("return $ele_2;");
        $sql = "select iid,iname,itype,iweight from system_item_module where iid = '$ele_1'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $iname = $row['iname'];
        $item_type = $row['itype'];
        $iid = $row['iid'];
        $iweight = $row['iweight'];
        $sql = "SELECT item_true_id FROM system_item WHERE sid = ? AND iid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('si', $sid, $iid);
        $stmt->execute();
        $result = $stmt->get_result();
        $ret = $result->fetch_assoc();
        $item_true_id = $ret['item_true_id'];
        if($ele_2 >0){
        if (!is_null($item_true_id)) {
            if ($item_type != "兵器" && $item_type != "防具") {
                $sql = "UPDATE system_item SET icount = icount + ? WHERE sid = ? AND iid = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('isi', $ele_2, $sid, $iid);
                $stmt->execute();
            } elseif ($item_type == "兵器" || $item_type == "防具") {
                for ($i = 0; $i < $ele_2; $i++) {
                    $sql = "INSERT INTO system_item (icount, sid, iid) VALUES (1, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('si', $sid, $iid);
                    $stmt->execute();
                }
            }
        } else {
            if ($item_type != "兵器" && $item_type != "防具") {
                $sql = "INSERT INTO system_item (icount, sid, iid) VALUES (?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('isi', $ele_2, $sid, $iid);
                $stmt->execute();
            } elseif ($item_type == "兵器" || $item_type == "防具") {
                for ($i = 0; $i < $ele_2; $i++) {
                    $sql = "INSERT INTO system_item (icount, sid, iid) VALUES (1, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('si', $sid, $iid);
                    $stmt->execute();
                }
            }
        }
        }elseif($ele_2 <0){
        $sql = "UPDATE system_item SET icount = icount + ? WHERE sid = ? AND item_true_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('iss', $ele_2, $sid, $item_true_id);
        $stmt->execute();

    // 检查是否需要删除记录
    $sql_check = "SELECT icount FROM system_item WHERE sid = ? AND item_true_id = ?";
    $stmt_check = $db->prepare($sql_check);
    $stmt_check->bind_param('ss', $sid, $item_true_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $now_ret = $result_check->fetch_assoc();

    if ($now_ret && $now_ret['icount'] <= 0) {
        $sql_delete = "DELETE FROM system_item WHERE sid = ? AND item_true_id = ?";
        $stmt_delete = $db->prepare($sql_delete);
        $stmt_delete->bind_param('ss', $sid, $item_true_id);
        $stmt_delete->execute();
    }
    }
    
        $iname = lexical_analysis\color_string($iname);
        //这里进行结果文本输出,查询物品对应名称
        if($ele_2 >=0){
        echo "获得了：{$iname}x{$ele_2}<br/>";
        \player\addplayersx('uburthen',$ele_2*$iweight,$sid,null,$db);
        }else{
        \player\addplayersx('uburthen',$ele_2*$iweight,$sid,null,$db);
        $ele_2 = abs($ele_2);
        echo "失去了：{$iname}x{$ele_2}<br/>";
        }
    } else {
        //echo "无法匹配到键值对<br/>";
        break;
    }
}

return 1;
}

function skillschanging($input, $sid, $type, $oid = null, $mid = null, $para = null){
    // 创建数据库连接
    $servername = "127.0.0.1";
    $username = "xunxian";
    $password = "123456";
    $dbname = "xunxian";
    $db = new mysqli($servername, $username, $password, $dbname);

    // 使用逗号分割字符串
    $keyValuePairs = explode(",", $input);
    foreach ($keyValuePairs as $pair) {
        if ($pair) {
            $query = "SELECT jname FROM system_skill WHERE jid = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $pair);  // "i"表示绑定一个整数参数
            $stmt->execute();
            $stmt->bind_result($jname);  // 绑定结果到$jname变量
            $stmt->fetch();
            $stmt->free_result();
            switch ($type) {
                case '1':
                    // 检查字段是否存在
                    $checkQuery = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("is", $pair, $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows == 0) {
                        // 不存在该数据，进行插入操作
                        $insertQuery = "INSERT IGNORE INTO system_skill_user (jsid, jid, jlvl) VALUES (?, ?, '1')";
                        $insertStmt = $db->prepare($insertQuery);
                        $insertStmt->bind_param("si", $sid, $pair);
                        $insertResult = $insertStmt->execute();

                        if ($insertResult) {
                            echo "学会了{$jname}<br/>";
                        } else {
                            echo "没有学会{$jname}<br/>";
                        }
                    }
                    else{
                        echo "你已经学会了{$jname}<br/>";
                    }
                    break;

                case '2':
                    // 检查字段是否存在
                    $checkQuery = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("is", $pair, $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows > 0) {
                        // 存在数据，进行删除操作
                        $deleteQuery = "DELETE FROM system_skill_user WHERE jid = ? and jsid = ?";
                        $deleteStmt = $db->prepare($deleteQuery);
                        $deleteStmt->bind_param("is", $pair, $sid);
                        $deleteResult = $deleteStmt->execute();

                        if ($deleteResult) {
                            echo "废除了{$jname}<br/>";
                        } else {
                            echo "没有废除{$jname}<br/>";
                        }
                    } else {
                        echo "你没有学会{$jname}！<br/>";
                    }
                    break;
            }
        }
    }

    return 1;
}

function taskschanging($input, $sid, $type, $oid = null, $mid = null, $para = null){
    // 创建数据库连接
    $servername = "127.0.0.1";
    $username = "xunxian";
    $password = "123456";
    $dbname = "xunxian";
    $db = new mysqli($servername, $username, $password, $dbname);

    // 使用逗号分割字符串
    $keyValuePairs = explode(",", $input);
    foreach ($keyValuePairs as $pair) {
        if ($pair) {
            $query = "SELECT tname FROM system_task WHERE tid = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $pair);  // "i"表示绑定一个整数参数
            $stmt->execute();
            $stmt->bind_result($tname);  // 绑定结果到$jname变量
            $stmt->fetch();
            $stmt->free_result();
            switch ($type) {
                case '1':
                    // 检查字段是否存在
                    $checkQuery = "SELECT * FROM system_task_user WHERE tid = ? and sid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("is", $pair, $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();
                    if ($checkResult->num_rows == 0) {
                        // 不存在该任务，进行插入操作
                        //这里对接后续的非npc触发任务
                        //\player\inserttask($pair,$sid,$dblj);
                        //events_steps_change($task_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module_all/main_page.php','npc',$nid,$para);
                    }
                    break;

                case '2':
                    // 检查字段是否存在
                    $checkQuery = "SELECT * FROM system_task_user WHERE tid = ? and sid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("is", $pair, $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows > 0) {
                        // 存在数据，进行删除操作
                        $deleteQuery = "UPDATE system_task_user set tstate = 2 WHERE tid = ? and sid = ?";
                        $deleteStmt = $db->prepare($deleteQuery);
                        $deleteStmt->bind_param("is", $pair, $sid);
                        $deleteResult = $deleteStmt->execute();
                    }
                    break;
            }
        }
    }

    return 1;
}

function destsing($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
global $encode;
$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);

$mid = \lexical_analysis\process_string($input,$sid);
$sql = "SELECT COUNT(*) AS count FROM system_map WHERE mid = ?";
$stmt = $db->prepare($sql);

$stmt->bind_param("i", $mid);
$stmt->execute();

$stmt->bind_result($count);
$stmt->fetch();

if ($count == 0) {
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $just_page = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
    $page_url =<<<HTML
    表达式有误！<br/>
    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
    return $page_url;
}else{
$updateQuery = "UPDATE game1 SET nowmid = '$mid' WHERE sid = '$sid'";
$db->query($updateQuery);
return $mid;
}
}

?>