<?php
// require_once 'lexical_analysis.php';
// require_once 'encode.php';
// require_once 'pdo.php';
// 在用户登录时，检查是否有其他设备已登录，并强制其下线


function check_if_logged($sid){
    $db = DB::conn();
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
    $db = DB::conn();

    // 在 user_sessions 表中记录当前会话
    $insertQuery = "INSERT INTO user_sessions (sid, session_id, is_active,device_info) VALUES (?, ?, 1,?)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bind_param("sss", $sid, $sessionId,$deviceInfo);
    $insertStmt->execute();
}

// 在用户退出登录时，标记会话为无效
function logout($sid) {
    $db = DB::conn();
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
$db = DB::conn();

// 使用逗号分割字符串
$keyValuePairs = explode(",", $input);

foreach ($keyValuePairs as $pair) {
    // 使用等号分割键值对
    $firstEqualsPos = strpos($pair, '=');
    if ($firstEqualsPos !== false) {
        $ele_1 = substr($pair, 0, $firstEqualsPos);
        $ele_2 = substr($pair, $firstEqualsPos + 1);
        //$parts = explode(".", $ele_1);
        
        if(preg_match('/f\(([\w.]+)\)/', $ele_1, $matches)){
            $prefix = "{".$matches[1]."}"; // 匹配到的前缀部分（数字加点号)
            $prefix_value = lexical_analysis\process_string($prefix,$sid,$oid,$mid);
                $sql = "SELECT sid FROM game1 where uid = '$prefix_value'";
                $cxjg = $db->query($sql);
                if (!$cxjg) {
                die('查询失败: ' . $db->error);
                }
                $row = $cxjg->fetch_assoc();
                $ele_1 = str_replace("$matches[0]", "u", $ele_1);
                $temp_sid = $row['sid'];
                $sid = $temp_sid;
            }
        $SecondEqualsPos = strpos($ele_1, '.');
        if ($SecondEqualsPos !== false){
        $ele_1_1 = substr($ele_1, 0, $SecondEqualsPos);
        $ele_1_2 = substr($ele_1, $SecondEqualsPos + 1);
        // var_dump($ele_1_1);
        // var_dump($ele_1_2);
        $ele_1_2 =lexical_analysis\process_string($ele_1_2,$sid,$oid,$mid);
        //@$ele_1_2 = eval("return $ele_1_2;");
        $ele_1_2 = str_replace('.', '', $ele_1_2);
        }else{
            echo "错误语法警告！<br/>";
        }
        
        
        // if (count($parts) >= 2) {
        //     $ele_1_1 = $parts[0]; // 小数点左边的内容
        //     $ele_1_2 = $parts[1]; // 小数点右边的内容
        //     } else {
        //     echo "无法匹配到小数点 '.'<br/>";
        //     }
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
                elseif($oid =='pet'){
                $reg = "p".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_pet_player LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_pet_player SET $reg = '$ele_2' WHERE psid = '$sid' and pid = $mid";
                    $db->query($updateQuery);
                }
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
            case 'ut':
                $sql = "select attr_value from player_temp_attr where obj_id = '$sid' and obj_type = 1 and attr_name = '$ele_1_2'";
                $result = $db->query($sql);
                // 检查数据是否存在
                // 如果数据存在，更新该数据
                if ($result->num_rows > 0 ) {
                    $updateQuery = "UPDATE player_temp_attr SET attr_value = '$ele_2' WHERE obj_id = '$sid' and obj_type = 1 and attr_name = '$ele_1_2'";
                    $db->query($updateQuery);
                }else{
                    // 数据不存在，插入数据并更新值
                    $alterQuery = "INSERT INTO player_temp_attr(obj_id,obj_type,attr_name,attr_value)values('$sid',1,'$ele_1_2',$ele_2)";
                    $db->query($alterQuery);
                }
                break;
            case 'ot':
                $sql = "select attr_value from player_temp_attr where obj_oid = '$mid' and obj_type = 2 and attr_name = '$ele_1_2'";
                $result = $db->query($sql);
                // 检查数据是否存在
                // 如果数据存在，更新该数据
                if ($result->num_rows > 0 ) {
                    $updateQuery = "UPDATE player_temp_attr SET attr_value = '$ele_2' WHERE obj_oid = '$mid' and obj_type = 2 and attr_name = '$ele_1_2'";
                    $db->query($updateQuery);
                }else{
                    // 数据不存在，插入数据并更新值
                    $alterQuery = "INSERT INTO player_temp_attr(obj_id,obj_oid,obj_type,attr_name,attr_value)values('$sid','$mid',2,'$ele_1_2',$ele_2)";
                    $db->query($alterQuery);
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
$db = DB::conn();

// 使用逗号分割字符串
$keyValuePairs = explode(",", $input);
$old_sid = $sid;
foreach ($keyValuePairs as $pair) {
    // 找到第一个等号的位置
$sid = $old_sid;
    $firstEqualsPos = strpos($pair, '=');
    if ($firstEqualsPos !== false) {
        $ele_1 = substr($pair, 0, $firstEqualsPos);
        $ele_2 = substr($pair, $firstEqualsPos + 1);
        //$parts = explode(".", $ele_1);
        if(preg_match('/f\(([\w.]+)\)/', $ele_1, $matches)){
            $prefix = "{".$matches[1]."}"; // 匹配到的前缀部分（数字加点号)
            $prefix_value = lexical_analysis\process_string($prefix,$sid,$oid,$mid);
                $sql = "SELECT sid FROM game1 where uid = '$prefix_value'";
                $cxjg = $db->query($sql);
                if (!$cxjg) {
                die('查询失败: ' . $db->error);
                }
                $row = $cxjg->fetch_assoc();
                $ele_1 = str_replace("$matches[0]", "u", $ele_1);
                $temp_sid = $row['sid'];
                $sid = $temp_sid;
            }
            if($old_sid ==$sid){
                $echo_type = "self";
            }else{
                $echo_type = "other";
            }
        $SecondEqualsPos = strpos($ele_1, '.');
        if ($SecondEqualsPos !== false){
        $ele_1_1 = substr($ele_1, 0, $SecondEqualsPos);
        $ele_1_2 = substr($ele_1, $SecondEqualsPos + 1);
        $ele_1_2 =lexical_analysis\process_string($ele_1_2,$sid,$oid,$mid);
        //@$ele_1_2 = eval("return $ele_1_2;");
        $ele_1_2 = str_replace('.', '', $ele_1_2);
        }else{
            echo "错误语法警告！<br/>";
        }
        // if (count($parts) >= 2) {
        //     $ele_1_1 = $parts[0]; // 小数点左边的内容
        //     $ele_1_2 = $parts[1];// 小数点右边的内容
        //     } else {
        //     echo "无法匹配到小数点 '.'<br/>";
        //     }
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
                include "pdo.php";
                if($echo_type !="self"){
                if($ele_2 >=0 && $attr_name){
                $echo_mess =  "{$attr_name}+{$ele_2}";
                \player\update_message_sql($sid,$dblj,$echo_mess);
                }elseif($ele_2 <0 && $attr_name){
                $echo_mess =  "{$attr_name}{$ele_2}";
                \player\update_message_sql($sid,$dblj,$echo_mess);
                }
                }else{
                if($ele_2 >=0 && $attr_name){
                $echo_mess =  "{$attr_name}+{$ele_2}";
                echo $echo_mess."<br/>";
                \player\update_message_sql($sid,$dblj,$echo_mess,1);
                }elseif($ele_2 <0 && $attr_name){
                $echo_mess =  "{$attr_name}{$ele_2}";
                echo $echo_mess."<br/>";
                \player\update_message_sql($sid,$dblj,$echo_mess,1);
                }
                }
                break;
            case 'o':
                if($oid =='pet'){
                $reg = "p".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_pet_player LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_pet_player SET $reg = $reg + '$ele_2' WHERE psid = '$sid' and pid = $mid";
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
            case 'ut':
                $sql = "select attr_value from player_temp_attr where obj_id = '$sid' and obj_type = 1 and attr_name = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_value = $row['attr_value'];
                // 检查数据是否存在
                // 如果数据存在，更新该数据
                if ($result->num_rows > 0 ) {
                    $updateQuery = "UPDATE player_temp_attr SET attr_value = attr_value + '$ele_2' WHERE obj_id = '$sid' and obj_type = 1 and attr_name = '$ele_1_2'";
                    $db->query($updateQuery);
                }else{
                    // 数据不存在，插入数据并更新值
                    $alterQuery = "INSERT INTO player_temp_attr(obj_id,obj_type,attr_name,attr_value)values('$sid',1,'$ele_1_2',$ele_2)";
                    $db->query($alterQuery);
                }
                break;
            case 'ot':
                $sql = "select attr_value from player_temp_attr where obj_id = '$mid' and obj_type = 2 and attr_name = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_value = $row['attr_value'];
                // 检查数据是否存在
                // 如果数据存在，更新该数据
                if ($result->num_rows > 0 ) {
                    $updateQuery = "UPDATE player_temp_attr SET attr_value = attr_value + '$ele_2' WHERE obj_id = '$mid' and obj_type = 2 and attr_name = '$ele_1_2'";
                    $db->query($updateQuery);
                }else{
                    // 数据不存在，插入数据并更新值
                    $alterQuery = "INSERT INTO player_temp_attr(obj_id,obj_oid,obj_type,attr_name,attr_value)values('$sid','$mid',2,'$ele_1_2',$ele_2)";
                    $db->query($alterQuery);
                }
                break;
            default:
                break;
        }
        if($ele_1_1 !='ut'){
         "ele_1: " . $ele_1 . "<br/>";
         "ele_2: " . $ele_2 . "<br/>";
        }
    } else {
        //echo "无法匹配到键值对<br/>";
        break;
    }
}

return 1;
}

function itemchanging($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$db = DB::conn();

//做负重判断

// 使用逗号分割字符串

$keyValuePairs = explode(",", $input);

foreach ($keyValuePairs as $pair) {
    // 使用|分割键值对
    $item_true_id = '';
    $firstEqualsPos = strpos($pair, '|');
    if ($firstEqualsPos !== false) {
        $ele_1 = substr($pair, 0, $firstEqualsPos);
        $ele_2 = substr($pair, $firstEqualsPos + 1);
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
    $db = DB::conn();

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
    $db = DB::conn();

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

function adoptpeting($input, $sid, $type, $oid = null, $mid = null, $para = null){
    // 创建数据库连接
    $db = DB::conn();

    // 使用逗号分割字符串
    $keyValuePairs = explode(",", $input);
    foreach ($keyValuePairs as $pair) {
        if ($pair) {
            $query = "SELECT nname,npet_event_id,nid,nskills FROM system_npc WHERE nid = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $pair);  // "i"表示绑定一个整数参数
            $stmt->execute();
            $stmt->bind_result($nname,$npet_event_id,$pet_root_id,$pet_default_skills);  // 绑定结果到变量
            $stmt->fetch();
            $stmt->free_result();
            switch ($type) {
                case '1':
                    // 检查收养数量是否超过最大数量，这里的8先写死
                    $checkQuery = "SELECT * FROM system_pet_player WHERE psid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("s", $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows <= 8) {
                        // 判断对应npc有无被收养事件，进行插入操作
                        
                        $insertQuery = "INSERT IGNORE INTO system_pet_player (pnid,pname, psid, plvl,php,pmaxhp) VALUES (?,?,?,'1','1','1')";
                        $insertStmt = $db->prepare($insertQuery);
                        $insertStmt->bind_param("iss", $pet_root_id,$nname,$sid);
                        $insertResult = $insertStmt->execute();
                        $lastInsertedId = $db->insert_id;
                        
                        if($pet_default_skills){
                        $pet_default_skills_para = explode(',',$pet_default_skills);
                        foreach ($pet_default_skills_para as $pet_default_skills_one){
                            $pet_default_skill = explode('|',$pet_default_skills_one);
                            $pet_default_skill_id = $pet_default_skill[0];
                            $insertQuery = "INSERT IGNORE INTO system_skill_user (jsid,jid,jlvl, jpid) VALUES (?,?,1,?)";
                            $insertStmt = $db->prepare($insertQuery);
                            $insertStmt->bind_param("sii",$sid, $pet_default_skill_id,$lastInsertedId);
                            $insertResult = $insertStmt->execute();
                        }
                        }
                        
                        if($npet_event_id !=0){
                        include_once 'events_steps_change.php';
                        include 'pdo.php';
                        events_steps_change($npet_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','pet',$lastInsertedId,$para);
}
                        if ($insertResult) {
                            echo "收养了{$nname}<br/>";
                        }
                    }
                    else{
                        echo "收养{$nname}失败，可能数量已达上限!<br/>";
                    }
                    break;

                case '2':
                    // 检查字段是否存在
                    $checkQuery = "SELECT * FROM system_pet_player WHERE psid = ? and pid = ? and pstate = 0";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("si", $sid,$pair);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows > 0) {
                        // 存在数据，进行删除操作
                        $deleteQuery = "DELETE FROM system_pet_player WHERE pid = ? and psid = ?";
                        $deleteStmt = $db->prepare($deleteQuery);
                        $deleteStmt->bind_param("is", $pair, $sid);
                        $deleteResult = $deleteStmt->execute();

                        if ($deleteResult) {
                            echo "放生了{$nname}<br/>";
                        }
                    } else {
                        echo "你没有{$nname}或正在出战！<br/>";
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
$db = DB::conn();

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