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

// Add BCMath helper functions at the top of the file
// Set BCMath scale to ensure precision
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

// 新增一个安全的bcdiv函数封装
function safebc_div($left, $right, $scale = 0) {
    $left = safebc_check($left);
    $right = safebc_check($right);
    // 避免除以零错误
    if ($right == '0') {
        return '0';
    }
    return bcdiv($left, $right, $scale);
}

function attrsetting($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$db = DB::conn();
$can_redis = $GLOBALS['can_redis'];
if($can_redis == 1){
global $redis;
}
$updateAll = [];

$data = json_decode($input, true);
if($data){
foreach ($data as $ele_1 => $ele_2) {
    // 使用等号分割键值对
        if($can_redis == 1){
        $check_cache = \gm\check_redis($db,$ele_1,$sid,$oid,$mid,$jid,$type,$para);
        }
        if(!is_numeric($ele_2)){
        if($can_redis == 1){
        $redis->del($check_cache);
        }
        $ele_2 =lexical_analysis\process_string($ele_2,$sid,$oid,$mid);
        @$ele_2 = eval("return $ele_2;");
        $ele_2 = str_replace("'", '', $ele_2);
        }else{
            if($can_redis == 1){
            $redis->set($check_cache,$ele_2);
            }
            
        }
        if(preg_match('/pusharr.\(([\w.]+)\)/', $ele_1, $matches)){
            $new_recur_1 = $matches[1];
            $try_recur = '{'.$new_recur_1.'}'; // 匹配到的前缀部分（数字加点号)
            $try_recur_value = lexical_analysis\process_string($try_recur,$sid,$oid,$mid);
            $try_recur_value = str_replace("'",'', $try_recur_value);
            // 创建JSON格式而不是字符串键值对
            if($try_recur_value){
                // 创建一个关联数组
                $json_array = [
                    $new_recur_1 => '"'.$try_recur_value . '|' . $ele_2.'"'
                ];
                $new_recur = json_encode($json_array);
            } else {
                // 创建一个关联数组
                $json_array = [
                    $new_recur_1 => $ele_2
                ];
                $new_recur = json_encode($json_array);
            }
            attrsetting($new_recur,$sid,$oid,$mid,$para);
            return;
            }

        if(preg_match('/delarr.\(([\w.]+)\)/', $ele_1, $matches)){
            $new_recur_1 = $matches[1];
            $try_recur = '{'.$new_recur_1.'}'; // 匹配到的前缀部分（数字加点号)
            $try_recur_value = lexical_analysis\process_string($try_recur,$sid,$oid,$mid);
            $try_recur_value = str_replace("'",'', $try_recur_value);
            $temp_arr = explode('|',$try_recur_value);
            $arr_count = count($temp_arr);
            $to_count = $ele_2-1;
            if($to_count <$arr_count&&$to_count >=0){
            unset($temp_arr[$to_count]);
            $temp_arr = implode('|',$temp_arr);
            }else{
                echo "数组元素不存在！<br/>";
                return;
            }
                // 创建一个关联数组
                if($temp_arr){
                $json_array = [
                    $new_recur_1 => '"'.$temp_arr.'"'
                ];
                }else{
                $json_array = [
                    $new_recur_1 => ''
                ];
                }
                $new_recur = json_encode($json_array);
            attrsetting($new_recur,$sid,$oid,$mid,$para);
            return;
            }


        if(preg_match('/f\(([\w.]+)\)/', $ele_1, $matches)){
            $prefix = "{".$matches[1]."}"; // 匹配到的前缀部分（数字加点号)
            $prefix_value = lexical_analysis\process_string($prefix,$sid,$oid,$mid);
                $sql = "SELECT sid FROM game1 where uid = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('s', $prefix_value);
                $stmt->execute();
                $cxjg = $stmt->get_result();
                if (!$cxjg) {
                die('查询失败: ' . $db->error);
                }
                $row = $cxjg->fetch_assoc();
                $temp_sid = $row['sid'];
                if($temp_sid ==$sid){
                $ele_1 = str_replace("$matches[0]", "u", $ele_1);
                }else{
                $ele_1 = str_replace("$matches[0]", "o", $ele_1);
                $oid = "scene_oplayer";
                $mid = $temp_sid;
                }
            }
        $SecondEqualsPos = strpos($ele_1, '.');
        if ($SecondEqualsPos !== false){

        $ele_1_1 = substr($ele_1, 0, $SecondEqualsPos);
        $ele_1_2 = substr($ele_1, $SecondEqualsPos + 1);
        $ele_1_2 =lexical_analysis\process_string($ele_1_2,$sid,$oid,$mid);
        //@$ele_1_2 = eval("return $ele_1_2;");
        $ele_1_2 = str_replace(array(".","'"), '', $ele_1_2);
        
        }else{
            echo "错误语法警告！<br/>";
        }
        
        
        // if (count($parts) >= 2) {
        //     $ele_1_1 = $parts[0]; // 小数点左边的内容
        //     $ele_1_2 = $parts[1]; // 小数点右边的内容
        //     } else {
        //     echo "无法匹配到小数点 '.'<br/>";
        //     }
        switch ($ele_1_1) {
            case 'u':
                if(strpos($ele_1_2, "c_msg") === 0){
                    $sql = "select uname,uid from game1 where sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('s', $sid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $player_name = $row['uname'];
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $updateQuery = "insert into system_chat_data (name,msg,send_time,uid,chat_type)values(?,?,?,?,6)";
                    // 使用预处理语句
                    $stmt = $db->prepare($updateQuery);
                    $stmt->bind_param('sssi', $player_name, $ele_2, $send_time, $player_uid);
                    // 执行查询
                    $stmt->execute();
                    $sql_type = 'insert';
                    $op_sql = 'system_chat_data';
                    }
                elseif(strpos($ele_1_2, "p_msg") === 0){
                    $sql = "select uid from game1 where sid ='$sid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $updateQuery = "insert into system_chat_data (name,msg,send_time,uid,imuid,chat_type)values('系统','$ele_2','$send_time','0','$player_uid','1')";
                    // 使用预处理语句
                    $stmt = $db->prepare($updateQuery);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                elseif(strpos($ele_1_2, "g_msg") === 0){
                    $sql = "select uid,uname from game1 where sid ='$sid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_uid = $row['uid'];
                    $player_uname = $row['uname'];
                    $ltmsg = htmlspecialchars($ele_2, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $send_time = date('Y-m-d H:i:s');
                    $updateQuery = "insert into system_chat_data(name,msg,uid,send_time) values(?,?,?,?)";

                    // 使用预处理语句
                    $stmt = $db->prepare($updateQuery);
                    $stmt->bind_param("ssis", $player_uname, $ltmsg, $player_uid, $send_time);
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
                if ($result->num_rows > 0) {
                    // 字段存在于 game1 表
                    $sql = "UPDATE game1 SET `$ele_1_2` = ? WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('ss', $ele_2, $sid);
                    $stmt->execute();
                } elseif ($result_2->num_rows > 0) {
                    // 记录存在于 system_addition_attr 表
                    $sql = "UPDATE system_addition_attr SET value = ? WHERE sid = ? AND name = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('sss', $ele_2, $sid, $ele_1_2);
                    $stmt->execute();
                } else {
                    // 需要插入新记录
                    $sql = "INSERT INTO system_addition_attr(name, value, sid) VALUES (?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('sss', $ele_1_2, $ele_2, $sid);
                    $stmt->execute();
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
                    $updateQuery = "insert into system_chat_data (name,msg,send_time,uid,chat_type)values('$player_name','$ele_2','$send_time','$player_uid',6)";
                    // 使用预处理语句
                    $stmt = $db->prepare($updateQuery);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                elseif(strpos($ele_1_2, "p_msg") === 0){
                    $sql = "select uid from game1 where sid ='$oid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_uid = $row['uid'];
                    
                    $send_time = date('Y-m-d H:i:s');
                    $updateQuery = "insert into system_chat_data (name,msg,send_time,uid,imuid,chat_type)values('系统','$ele_2','$send_time','0','$player_uid','1')";
                    // 使用预处理语句
                    $stmt = $db->prepare($updateQuery);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                elseif(strpos($ele_1_2, "g_msg") === 0){
                    $sql = "select uid,uname from game1 where sid ='$oid'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $player_uid = $row['uid'];
                    $player_uname = $row['uname'];
                    $ltmsg = htmlspecialchars($ele_2, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $send_time = date('Y-m-d H:i:s');
                    $updateQuery = "insert into system_chat_data(name,msg,uid,send_time) values(?,?,?,?)";

                    // 使用预处理语句
                    $stmt = $db->prepare($updateQuery);
                    $stmt->bind_param("ssis", $player_uname, $ltmsg, $player_uid, $send_time);
                    // 执行查询
                    $stmt->execute();
                    
                    }
                elseif($oid =='pet'){
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_pet_scene LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_pet_scene SET $reg = '$ele_2' WHERE nsid = '$sid' and npid = $mid";
                    $db->query($updateQuery);
                }
                }
                elseif($oid =='npc'){
                if(!is_numeric($mid)){
                    $guai_id = explode("|",$mid)[1];
                }
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_npc_midguaiwu LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_npc_midguaiwu SET $reg = '$ele_2' WHERE ngid = '$guai_id' and nsid = ''";
                    $db->query($updateQuery);
                }}
                elseif($oid =='npc_scene'){
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_npc_scene LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_npc_scene SET $reg = '$ele_2' WHERE ncid = '$mid'";
                    $db->query($updateQuery);
                }
                }elseif($oid =='npc_monster'){
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_npc_midguaiwu LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_npc_midguaiwu SET $reg = '$ele_2' WHERE ngid = '$mid'";
                    $db->query($updateQuery);
                }
                }elseif($oid =='item'){
                $ele_1_2 = 'i'.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and oid = 'item' and mid = '$mid'");
                // 如果字段存在，则更新字段值
                if($result->num_rows > 0){
                    $updateQuery = "UPDATE system_addition_attr SET value = '$ele_2' WHERE name = '$ele_1_2' and oid = 'item' and mid = '$mid'";
                    $db->query($updateQuery);
                } else{
                    // 字段不存在，添加新字段并更新值
                    $updateQuery = "INSERT INTO system_addition_attr(name,value,oid,mid)values('$ele_1_2','$ele_2','item','$mid')";
                    $db->query($updateQuery);
                }
                
                }elseif($oid =='mosaic_equip'){
                // $sql = "select name from gm_game_attr where value_type =4 and id = '$ele_1_2'";
                // $result = $db->query($sql);
                // $row = $result->fetch_assoc();
                // $attr_name = $row['name'];
                $ele_1_2 = 'i'.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and oid = 'item' and mid = '$mid'");
                // 如果字段存在，则更新字段值
                if($result->num_rows > 0){
                    $updateQuery = "UPDATE system_addition_attr SET value = '$ele_2' WHERE name = '$ele_1_2' and oid = 'item' and mid = '$mid'";
                    $db->query($updateQuery);
                } else{
                    // 字段不存在，添加新字段并更新值
                    $alterQuery = "INSERT INTO system_addition_attr(name,value,oid,mid)values('$ele_1_2','$ele_2','item','$mid')";
                    $db->query($alterQuery);
                }
                
                }elseif($oid =='scene_oplayer'){
                $sql = "select name,if_show from gm_game_attr where value_type =1 and id = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_name = $row['name'];
                $attr_show = $row['if_show'];
                $ele_1_2 = 'u'.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");
                $result_2 = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and sid = '$mid'");
                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$ele_2' WHERE sid = '$mid'";
                    $db->query($updateQuery);
                }elseif($result_2->num_rows > 0){
                $updateQuery = "UPDATE system_addition_attr SET value = '$ele_2' WHERE sid = '$mid' and name = '$ele_1_2'";
                $db->query($updateQuery);
                } else {
                    // 字段不存在，添加新字段并更新值,这边还要做判断
                    $updateQuery = "INSERT INTO system_addition_attr(name,value,sid)values('$ele_1_2','$ele_2','$mid')";
                    $db->query($updateQuery);
                }
                }else{
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                } else {
                    // 字段不存在，添加新字段并更新值
                    $updateQuery = "ALTER TABLE game1 ADD $ele_1_2 VARCHAR(255)";
                    $db->query($updateQuery);

                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                }
                }
                break;
                case 'g':
                    // 先检查是否存在
                    $sql = "SELECT COUNT(*) as count FROM global_data WHERE gid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('s', $ele_1_2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $stmt->close();
                    
                    if ($row['count'] > 0) {
                        // 存在则更新
                        $sql = "UPDATE global_data SET gvalue = ? WHERE gid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('ss', $ele_2, $ele_1_2);
                    } else {
                        // 不存在则插入
                        $sql = "INSERT INTO global_data (gid, gvalue) VALUES (?, ?)";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('ss', $ele_1_2, $ele_2);
                    }
                    $stmt->execute();
                    $stmt->close();
                    break;
            case 'c':
                if(strpos($ele_1_2, "c_msg") === 0){
                    $send_time = date('Y-m-d H:i:s');
                    $sql = "insert into system_chat_data (name,msg,send_time,uid,chat_type)values('系统通知','$ele_2','$send_time',0,6)";
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
                    $updateQuery = "INSERT INTO player_temp_attr(obj_id,obj_type,attr_name,attr_value)values('$sid',1,'$ele_1_2',$ele_2)";
                    $db->query($updateQuery);
                }
                break;
            case 'uland':
                $checkQuery = "SELECT * FROM system_player_land WHERE sid = '$sid'";
                $result = $db->query($checkQuery);
                $new_value = 'land_'.$ele_1_2;
                // 如果存在，执行更新操作
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_player_land SET $new_value = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                } else {
                    // 不存在，执行插入操作
                    $updateQuery = "INSERT INTO system_player_land (sid,$new_value) VALUES ('$sid','$ele_2')";
                    $db->query($updateQuery);
                }
                break;
            case 'uboat':
                $checkQuery = "SELECT * FROM system_player_boat WHERE sid = '$sid'";
                $result = $db->query($checkQuery);
                $new_value = 'boat_'.$ele_1_2;
                // 如果存在，执行更新操作
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_player_boat SET $new_value = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                } else {
                    // 不存在，执行插入操作
                    $updateQuery = "INSERT INTO system_player_boat (sid,$new_value) VALUES ('$sid','$ele_2')";
                    $db->query($updateQuery);
                }
                break;
            case 'ucraft':
                $checkQuery = "SELECT * FROM system_player_aircraft WHERE sid = '$sid'";
                $result = $db->query($checkQuery);
                $new_value = 'aircraft_'.$ele_1_2;
                // 如果存在，执行更新操作
                if ($result->num_rows > 0) {
                    $updateQuery = "UPDATE system_player_aircraft SET $new_value = '$ele_2' WHERE sid = '$sid'";
                    $db->query($updateQuery);
                } else {
                    // 不存在，执行插入操作
                    $updateQuery = "INSERT INTO system_player_aircraft (sid,$new_value) VALUES ('$sid','$ele_2')";
                    $db->query($updateQuery);
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
                    $updateQuery = "INSERT INTO player_temp_attr(obj_id,obj_oid,obj_type,attr_name,attr_value)values('$sid','$mid',2,'$ele_1_2',$ele_2)";
                    $db->query($updateQuery);
                }
                break;
            default:
                break;
        }
        $updateAll [] = $updateQuery;
        // echo "ele_1: " . $ele_1 . "<br/>";
        // echo "ele_2: " . $ele_2 . "<br/>";
        //这里要获取到属性字段表中玩家属性类别下id等于$ele_1的name名称
}
}
// if($updateAll){
// 开启一个事务
// $db->autocommit(false);
// foreach($updateAll as $onesql){
// if($onesql){
// $db->query($onesql);
// }
// }
// $db->commit();
// // 重新开启自动提交
// $db->autocommit(true);
 
//var_dump($updateAll);
// }
return 1;
}

function attrchanging($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$db = DB::conn();
$dblj = DB::pdo();
// 使用逗号分割字符串
$can_redis = $GLOBALS['can_redis'];
if($can_redis == 1){
global $redis;
}
$updateAll = [];
$data = json_decode($input, true);
$old_sid = $sid;
if($data){
foreach ($data as $ele_1 => $ele_2) {
    // 找到第一个等号的位置
        $sid = $old_sid;
        if($can_redis == 1){
        $check_cache = \gm\check_redis($db,$ele_1,$sid,$oid,$mid,$jid,$type,$para);
        }

        if(preg_match('/f\(([\w.]+)\)/', $ele_1, $matches)){
            $prefix = "{".$matches[1]."}"; // 匹配到的前缀部分（数字加点号)
            $prefix_value = lexical_analysis\process_string($prefix,$sid,$oid,$mid);
                $sql = "SELECT sid FROM game1 where uid = $prefix_value";
                $cxjg = $db->query($sql);
                if (!$cxjg) {
                die('查询失败: ' . $db->error);
                }
                $row = $cxjg->fetch_assoc();
                $ele_1 = str_replace("$matches[0]", "u", $ele_1);
                $temp_sid = $row['sid'];
                $sid = $temp_sid;
                if($temp_sid ==$sid){
                $ele_1 = str_replace("$matches[0]", "u", $ele_1);
                }else{
                $ele_1 = str_replace("$matches[0]", "o", $ele_1);
                $oid = "scene_oplayer";
                $mid = $temp_sid;
                }
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
        $ele_1_2 = str_replace('\'', '', $ele_1_2);

        $ThirdEqualsPos = strpos($ele_1_2, '.');
        if ($ThirdEqualsPos !== false){
            $ele_1_3 = substr($ele_1_2, 0, $ThirdEqualsPos);
        if($ele_1_3 == 'icc'){
            $ele_1_4 = substr($ele_1_2, $ThirdEqualsPos + 1);
        }else{
        $ele_1_2 = str_replace('.', '', $ele_1_2);
        }
        }else{
        $ele_1_2 = str_replace('.', '', $ele_1_2);
        }
        }

        if(!is_numeric($ele_2)){
            if($can_redis == 1){
        $redis->del($check_cache);
            }
        $ele_2 =lexical_analysis\process_string($ele_2,$sid,$oid,$mid);
        @$ele_2 = eval("return $ele_2;");
        $ele_2 = str_replace(array("'", "\""), '', $ele_2);
        }else{
            if($can_redis == 1){
            $redis->del($check_cache);
            }
        }

        switch ($ele_1_1) {
            case 'u':
                if($ele_1_3 =='icc'){
                $last_para = $ele_1_4.'|'.$ele_2;
                $ret = itemchanging($last_para,$sid,$oid,$mid,$para);
                }else{
                $sql = "select name,if_show from gm_game_attr where value_type =1 and id = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_name = $row['name'];
                $attr_show = $row['if_show'];
                $ele_1_2 = $ele_1_1.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");
                $result_2 = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and sid = '$sid'");
                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT $ele_1_2 FROM game1 WHERE sid = '$sid'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get[$ele_1_2];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$new_value' WHERE sid = '$sid'";
                    //$db->query($updateQuery);
                }elseif($result_2->num_rows > 0){
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT value FROM system_addition_attr WHERE sid = '$sid' and name = '$ele_1_2'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get['value'];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_addition_attr SET value = '$new_value' WHERE sid = '$sid' and name = '$ele_1_2'";
                    //$db->query($updateQuery);
                } else {
                    // 字段不存在，添加新字段并更新值,这边还要做判断
                    $updateQuery = "INSERT INTO system_addition_attr(name,value,sid)values('$ele_1_2','$ele_2','$sid')";
                    //$db->query($updateQuery);
                }
                if($echo_type !="self"){
                if(safebc_comp($ele_2, 0) > 0 && $attr_name && $attr_show){
                $echo_mess =  "{$attr_name}+{$ele_2}";
                \player\update_message_sql($sid,$dblj,$echo_mess);
                }elseif(safebc_comp($ele_2, 0) < 0 && $attr_name && $attr_show){
                $echo_mess =  "{$attr_name}{$ele_2}";
                \player\update_message_sql($sid,$dblj,$echo_mess);
                }
                }else{
                if(safebc_comp($ele_2, 0) > 0 && $attr_name && $attr_show){
                $echo_mess =  "{$attr_name}+{$ele_2}";
                echo $echo_mess."<br/>";
                \player\update_message_sql($sid,$dblj,$echo_mess,1);
                }elseif(safebc_comp($ele_2, 0) < 0 && $attr_name && $attr_show){
                $echo_mess =  "{$attr_name}{$ele_2}";
                echo $echo_mess."<br/>";
                \player\update_message_sql($sid,$dblj,$echo_mess,1);
                }
                }
                }
                break;
            case 'o':
                if($oid =='pet'){
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_pet_scene LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT $reg FROM system_pet_scene WHERE nsid = '$sid' and npid = $mid";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get[$reg];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_pet_scene SET $reg = '$new_value' WHERE nsid = '$sid' and npid = $mid";
                    //$db->query($updateQuery);
                }
                }
                elseif($oid =='npc'){
                if(!is_numeric($mid)){
                    $guai_id = explode("|",$mid)[1];
                }
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_npc_midguaiwu LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT $reg FROM system_npc_midguaiwu WHERE ngid = '$guai_id' and nsid = ''";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get[$reg];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_npc_midguaiwu SET $reg = '$new_value' WHERE ngid = '$guai_id' and nsid = ''";
                    //$db->query($updateQuery);
                }
                }
                elseif($oid =='npc_scene'){
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_npc_scene LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT $reg FROM system_npc_scene WHERE ncid = '$mid'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get[$reg];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_npc_scene SET $reg = '$new_value' WHERE ncid = '$mid'";
                    //$db->query($updateQuery);
                }
                }
                elseif($oid =='npc_monster'){
                $reg = "n".$ele_1_2;
                $result = $db->query("SHOW COLUMNS FROM system_npc_midguaiwu LIKE '$reg'");

                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT $reg FROM system_npc_midguaiwu WHERE ngid = '$mid'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get[$reg];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_npc_midguaiwu SET $reg = '$new_value' WHERE ngid = '$mid'";
                    //$db->query($updateQuery);
                }
                }
                elseif($oid =='item'){
                // $sql = "select name from gm_game_attr where value_type =4 and id = '$ele_1_2'";
                // $result = $db->query($sql);
                // $row = $result->fetch_assoc();
                // $attr_name = $row['name'];
                $ele_1_2 = 'i'.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and oid = 'item' and mid ='$mid'");
                // 如果字段存在，则更新字段值
                if($result->num_rows > 0){
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT value FROM system_addition_attr WHERE name = '$ele_1_2' and oid = 'item' and mid = '$mid'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get['value'];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_addition_attr SET value = '$new_value' WHERE name = '$ele_1_2' and oid = 'item' and mid = '$mid'";
                    //$db->query($updateQuery);
                } else{
                $result_2 = $db->query("SELECT $ele_1_2 from system_item_module where iid = (SELECT iid from system_item where item_true_id = '$mid' and sid = '$sid')");
                if($result_2->num_rows > 0){
                    $row_2 = $result_2->fetch_assoc();
                    $root_attr = $row_2[$ele_1_2];
                    $ele_2 = safebc_add($ele_2, $root_attr);
                }
                    // 字段不存在，添加新字段并更新值
                    $updateQuery = "INSERT INTO system_addition_attr(name,value,oid,mid)values('$ele_1_2','$ele_2','item','$mid')";
                    //$db->query($updateQuery);
                }
                
                }
                elseif($oid =='mosaic_equip'){
                // $sql = "select name from gm_game_attr where value_type =4 and id = '$ele_1_2'";
                // $result = $db->query($sql);
                // $row = $result->fetch_assoc();
                // $attr_name = $row['name'];
                $ele_1_2 = 'i'.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and oid = 'item' and mid = '$mid'");
                // 如果字段存在，则更新字段值
                if($result->num_rows > 0){
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT value FROM system_addition_attr WHERE name = '$ele_1_2' and oid = 'item' and mid = '$mid'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get['value'];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_addition_attr SET value = '$new_value' WHERE name = '$ele_1_2' and oid = 'item' and mid = '$mid'";
                    //$db->query($updateQuery);
                } else{
                    // 字段不存在，添加新字段并更新值
                    $updateQuery = "INSERT INTO system_addition_attr(name,value,oid,mid)values('$ele_1_2','$ele_2','item','$mid')";
                    //$db->query($updateQuery);
                }
                
                }
                elseif($oid =='scene_oplayer'){
                $sql = "select name,if_show from gm_game_attr where value_type =1 and id = '$ele_1_2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $attr_name = $row['name'];
                $attr_name = \lexical_analysis\color_string($attr_name);
                $attr_show = $row['if_show'];
                $ele_1_2 = 'u'.$ele_1_2;
                // 检查字段是否存在
                $result = $db->query("SHOW COLUMNS FROM game1 LIKE '$ele_1_2'");
                $result_2 = $db->query("SELECT value from system_addition_attr where name = '$ele_1_2' and sid = '$mid'");
                // 如果字段存在，则更新字段值
                if ($result->num_rows > 0) {
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT $ele_1_2 FROM game1 WHERE sid = '$mid'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get[$ele_1_2];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE game1 SET $ele_1_2 = '$new_value' WHERE sid = '$mid'";
                    //$db->query($updateQuery);
                }elseif($result_2->num_rows > 0){
                    // 使用BCMath进行大数运算
                    $sql_get = "SELECT value FROM system_addition_attr WHERE sid = '$mid' and name = '$ele_1_2'";
                    $result_get = $db->query($sql_get);
                    $row_get = $result_get->fetch_assoc();
                    $current_value = $row_get['value'];
                    $new_value = safebc_add($current_value, $ele_2);
                    $updateQuery = "UPDATE system_addition_attr SET value = '$new_value' WHERE sid = '$mid' and name = '$ele_1_2'";
                    //$db->query($updateQuery);
                } else {
                    // 字段不存在，添加新字段并更新值,这边还要做判断
                    $updateQuery = "INSERT INTO system_addition_attr(name,value,sid)values('$ele_1_2','$ele_2','$mid')";
                    //$db->query($updateQuery);
                }
                if(safebc_comp($ele_2, 0) > 0 && $attr_name && $attr_show){
                $echo_mess =  "{$attr_name}+{$ele_2}";
                \player\update_message_sql($mid,$dblj,$echo_mess,0);
                }elseif(safebc_comp($ele_2, 0) < 0 && $attr_name && $attr_show){
                $echo_mess =  "{$attr_name}{$ele_2}";
                \player\update_message_sql($mid,$dblj,$echo_mess,0);
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
                        // 使用BCMath进行大数运算
                        $sql_get = "SELECT gvalue FROM global_data WHERE gid = '$ele_1_2'";
                        $result_get = $db->query($sql_get);
                        $row_get = $result_get->fetch_assoc();
                        $current_value = $row_get['gvalue'];
                        $new_value = safebc_add($current_value, $ele_2);
                        $updateQuery = "UPDATE global_data SET gvalue = '$new_value' WHERE gid = '$ele_1_2'";
                    } else {
                        $updateQuery = "UPDATE global_data SET gvalue = CONCAT(gvalue, '$ele_2') WHERE gid = '$ele_1_2'";
                    }
                    //$db->query($updateQuery);
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
                    // 使用BCMath进行大数运算
                    $new_value = safebc_add($attr_value, $ele_2);
                    $updateQuery = "UPDATE player_temp_attr SET attr_value = '$new_value' WHERE obj_id = '$sid' and obj_type = 1 and attr_name = '$ele_1_2'";
                    //$db->query($updateQuery);
                }else{
                    // 数据不存在，插入数据并更新值
                    $updateQuery = "INSERT INTO player_temp_attr(obj_id,obj_type,attr_name,attr_value)values('$sid',1,'$ele_1_2',$ele_2)";
                    //$db->query($updateQuery);
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
                    // 使用BCMath进行大数运算
                    $new_value = safebc_add($attr_value, $ele_2);
                    $updateQuery = "UPDATE player_temp_attr SET attr_value = '$new_value' WHERE obj_id = '$mid' and obj_type = 2 and attr_name = '$ele_1_2'";
                    //$db->query($updateQuery);
                }else{
                    // 数据不存在，插入数据并更新值
                    $updateQuery = "INSERT INTO player_temp_attr(obj_id,obj_oid,obj_type,attr_name,attr_value)values('$sid','$mid',2,'$ele_1_2',$ele_2)";
                    //$db->query($updateQuery);
                }
                break;
            default:
                break;
        }
        $updateAll [] = $updateQuery;
        if($ele_1_1 !='ut'){
         "ele_1: " . $ele_1 . "<br/>";
         "ele_2: " . $ele_2 . "<br/>";
        }

}
}
if($updateAll){
// 开启一个事务
$db->autocommit(false);
foreach($updateAll as $onesql){
if($onesql){
$db->query($onesql);
}
}
$db->commit();
// 重新开启自动提交
$db->autocommit(true);
}
return 1;
}

function itemchanging($input,$sid,$oid=null,$mid=null,$para=null){
    // 创建数据库连接
$db = DB::conn();

$data = json_decode($input, true);
if($data){
foreach ($data as $ele_1 => $ele_2) {
    try {
        // 使用|分割键值对
        $ele_2 = lexical_analysis\process_string($ele_2,$sid,$oid,$mid);
        
        // 安全地执行eval，确保它返回数值
        if (!is_numeric($ele_2)) {
            $original_ele_2 = $ele_2;
            @$ele_2 = eval("return $ele_2;");
            // 确保eval后的结果是数值型
            if (!is_numeric($ele_2) && $ele_2 !== null) {
                $ele_2 = $original_ele_2;
            }
        }
        
        // 获取物品信息
        $stmt = $db->prepare("SELECT iid, iname, itype, iweight FROM system_item_module WHERE iid = ?");
        $stmt->bind_param('s', $ele_1);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result || $result->num_rows == 0) {
            // 如果找不到物品，记录错误并继续下一个循环
            error_log("物品ID不存在: $ele_1");
            continue;
        }
        
        $row = $result->fetch_assoc();
        $iname = $row['iname'];
        $item_type = $row['itype'];
        $iid = $row['iid'];
        $iweight = safebc_check($row['iweight']); // 确保重量是BCMath兼容格式
        
        // 获取物品true_id
        $sql = "SELECT item_true_id FROM system_item WHERE sid = ? AND iid = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('si', $sid, $iid);
        $stmt->execute();
        $result = $stmt->get_result();
        $ret = $result->fetch_assoc();
        $item_true_id = $ret ? $ret['item_true_id'] : null;
        
        // 确保ele_2是合法的BCMath参数
        $ele_2 = safebc_check($ele_2);
        
        // 物品增加操作
        if(safebc_comp($ele_2, '0') > 0){
            if (!is_null($item_true_id)) {
                // 已有物品记录
                if ($item_type != "兵器" && $item_type != "防具") {
                    // 非装备类物品累加数量
                    $sql = "UPDATE system_item SET icount = CAST(COALESCE(icount, '0') AS DECIMAL(65,0)) + ? WHERE sid = ? AND iid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('ssi', $ele_2, $sid, $iid);
                    $stmt->execute();
                } elseif ($item_type == "兵器" || $item_type == "防具") {
                    // 装备类物品每个独立添加
                    $ele_2_int = max(0, (int)$ele_2); // 确保是非负整数
                    for ($i = 0; $i < $ele_2_int; $i++) {
                        $sql = "INSERT INTO system_item (icount, sid, iid) VALUES (1, ?, ?)";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('si', $sid, $iid);
                        $stmt->execute();
                    }
                }
            } else {
                // 没有物品记录，需要创建
                if ($item_type != "兵器" && $item_type != "防具") {
                    // 非装备类物品存为一条记录
                    $sql = "INSERT INTO system_item (icount, sid, iid) VALUES (?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('ssi', $ele_2, $sid, $iid);
                    $stmt->execute();
                } elseif ($item_type == "兵器" || $item_type == "防具") {
                    // 装备类物品每个独立添加
                    $ele_2_int = max(0, (int)$ele_2); // 确保是非负整数
                    for ($i = 0; $i < $ele_2_int; $i++) {
                        $sql = "INSERT INTO system_item (icount, sid, iid) VALUES (1, ?, ?)";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('si', $sid, $iid);
                        $stmt->execute();
                    }
                }
            }
            
            // 更新物品重量并显示获得信息
            $iname = lexical_analysis\color_string($iname);
            echo "获得了：{$iname}x{$ele_2}<br/>";
            $weight_increase = safebc_mul($ele_2, $iweight);
            \player\addplayersx('uburthen', $weight_increase, $sid, null, $db);
            
        // 物品减少操作
        } elseif(safebc_comp($ele_2, '0') < 0) {
            // 确保物品记录存在
            if (is_null($item_true_id)) {
                error_log("尝试移除不存在的物品: $ele_1");
                continue;
            }
            
            // 更新物品数量
            $sql = "UPDATE system_item SET icount = CAST(COALESCE(icount, '0') AS DECIMAL(65,30)) + ? WHERE sid = ? AND item_true_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $ele_2, $sid, $item_true_id);
            $stmt->execute();

            // 检查是否需要删除记录
            $sql_check = "SELECT icount FROM system_item WHERE sid = ? AND item_true_id = ?";
            $stmt_check = $db->prepare($sql_check);
            $stmt_check->bind_param('ss', $sid, $item_true_id);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
            
            if ($result_check && $result_check->num_rows > 0) {
                $now_ret = $result_check->fetch_assoc();
                $current_count = safebc_check($now_ret['icount']);
                
                if (safebc_comp($current_count, '0') <= 0) {
                    $sql_delete = "DELETE FROM system_item WHERE sid = ? AND item_true_id = ?";
                    $stmt_delete = $db->prepare($sql_delete);
                    $stmt_delete->bind_param('ss', $sid, $item_true_id);
                    $stmt_delete->execute();
                }
            }
            
            // 更新物品重量并显示失去信息
            $iname = lexical_analysis\color_string($iname);
            $weight_decrease = safebc_mul($ele_2, $iweight);
            \player\addplayersx('uburthen', $weight_decrease, $sid, null, $db);
            $absolute_ele_2 = safebc_sub('0', $ele_2, 0); // 获取绝对值
            echo "失去了：{$iname}x{$absolute_ele_2}<br/>";
        }
    } catch (Exception $e) {
        // 记录错误但不中断处理
        error_log("物品处理错误: " . $e->getMessage());
        continue;
    }
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
                    if($oid == 'npc_scene') {
    $string_new = $pair . "|" . "1";

    // 查询 nskills 字段
    $query = "SELECT nskills FROM system_npc_scene WHERE ncid = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $mid);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (empty($result['nskills'])) {
        // 如果 nskills 为空，直接赋值为 $string_new
        $query = "UPDATE system_npc_scene SET nskills = ? WHERE ncid = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $string_new, $mid);
        $stmt->execute();
    } elseif (!in_array($string_new, explode(',', $result['nskills']))) {
        // 如果 nskills 不为空，在原有值后面加上逗号和 $string_new
        $query = "UPDATE system_npc_scene SET nskills = CONCAT(nskills, ',', ?) WHERE ncid = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $string_new, $mid);
        $stmt->execute();
    }
}
                    elseif($oid == 'npc_monster') {
                        $string_new = $pair . "|" . "1";
                    
                        // 查询 nskills 字段
                        $query = "SELECT nskills FROM system_npc_midguaiwu WHERE ngid = ?";
                        $stmt = $db->prepare($query);
                        $stmt->bind_param('s', $mid);
                        $stmt->execute();
                        $result = $stmt->get_result()->fetch_assoc();
                    
                        if (empty($result['nskills'])) {
                            // 如果 nskills 为空，直接赋值为 $string_new
                            $query = "UPDATE system_npc_midguaiwu SET nskills = ? WHERE ngid = ?";
                            $stmt = $db->prepare($query);
                            $stmt->bind_param('ss', $string_new, $mid);
                            $stmt->execute();
                        } elseif (!in_array($string_new, explode(',', $result['nskills']))) {
                            // 如果 nskills 不为空，在原有值后面加上逗号和 $string_new
                            $query = "UPDATE system_npc_midguaiwu SET nskills = CONCAT(nskills, ',', ?) WHERE ngid = ?";
                            $stmt = $db->prepare($query);
                            $stmt->bind_param('ss', $string_new, $mid);
                            $stmt->execute();
                        }
                    }
                    elseif($oid =='pet'){
                    
                    $checkQuery = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("isi", $pair, $sid,$mid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows == 0) {
                        // 不存在该数据，进行插入操作
                        $insertQuery = "INSERT IGNORE INTO system_skill_user (jsid, jid, jlvl,jpid) VALUES (?, ?, '1',?)";
                        $insertStmt = $db->prepare($insertQuery);
                        $insertStmt->bind_param("sii", $sid, $pair,$mid);
                        $insertResult = $insertStmt->execute();
                    }
                    
                    }else{
                    $checkQuery = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = 0";
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
                    }
                    break;

                case '2':
                    // 检查字段是否存在
                    $checkQuery = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = 0";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("is", $pair, $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows > 0) {
                        // 存在数据，进行删除操作
                        $deleteQuery = "DELETE FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = 0";
                        $deleteStmt = $db->prepare($deleteQuery);
                        $deleteStmt->bind_param("is", $pair, $sid);
                        $deleteResult = $deleteStmt->execute();

                        $oldValue = '1|' . $pair; // 拼接旧值
                        // 准备预处理语句
                        $stmt = $db->prepare("
                            UPDATE system_fight_quick 
                            SET quick_value = '' 
                            WHERE sid = ? 
                            AND quick_value = ?
                        ");
                        
                        // 绑定参数（假设 sid 是整型）
                        $stmt->bind_param('ss', $sid, $oldValue);
                        
                        // 执行更新
                        $result = $stmt->execute();
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
                    $checkQuery = "SELECT * FROM system_pet_scene WHERE nsid = ?";
                    $checkStmt = $db->prepare($checkQuery);
                    $checkStmt->bind_param("s", $sid);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult->num_rows <= 8) {
                        // 判断对应npc有无被收养事件，进行插入操作
                        
                        
                    // 1. 查询列名并缓存结果以减少重复查询
                    if (empty($columns)) {
                        $result = $db->query("SHOW COLUMNS FROM system_npc");
                        $columns = [];
                        while ($row = $result->fetch_assoc()) {
                            $columns[] = $row['Field'];
                        }
                    }
                    
                    // 2. 移除不必要的列（如果有）
                    $cols = implode(", ", $columns);
                    
                    // 3. 动态构建 SQL 语句
                    $sql = "INSERT INTO system_pet_scene ($cols, nmid,nsid) 
                            SELECT $cols, ?, ?
                            FROM system_npc 
                            WHERE nid = ?";
                    // 4. 预编译 SQL 语句
                    $stmt = $db->prepare($sql);
                    
                    // 5. 绑定参数并执行
                    $nmid = 0;  // 对应的 nmid 值
                    $stmt->bind_param("isi", $nmid, $sid, $pet_root_id);
                    $stmt->execute();
                    
                    // 获取最后插入记录的自增 ID
                    $lastInsertId = $db->insert_id;

                        
                        
                        if($pet_default_skills){
                        $pet_default_skills_para = explode(',',$pet_default_skills);
                        foreach ($pet_default_skills_para as $pet_default_skills_one){
                            $pet_default_skill = explode('|',$pet_default_skills_one);
                            $pet_default_skill_id = $pet_default_skill[0];
                            $insertQuery = "INSERT IGNORE INTO system_skill_user (jsid,jid,jlvl, jpid) VALUES (?,?,1,?)";
                            $insertStmt = $db->prepare($insertQuery);
                            $insertStmt->bind_param("sii",$sid, $pet_default_skill_id,$lastInsertId);
                            $insertResult = $insertStmt->execute();
                        }
                        }
                        $dblj = DB::pdo();
                        if($npet_event_id !=0){
                        events_steps_change($npet_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','pet',$lastInsertId,$para);
}
                        $ret = $ret ?? global_event_data_get(32, $dblj);
                        if ($ret) {
                            global_events_steps_change(32, $sid, $dblj, $just_page, $steps_page, $cmid, 'module/gm_scene_new', 'pet', $lastInsertId, $para);
                        }


                        if ($lastInsertId) {
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
$mid = \lexical_analysis\process_string($input,$sid,$oid,$mid);
$mid = str_replace(array("'", "\""), '', $mid);

if(!is_numeric($mid)){
    $mid = ltrim($mid,'s');
}

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