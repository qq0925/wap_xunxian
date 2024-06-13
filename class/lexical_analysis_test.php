<?php
// 定义处理单个属性的函数
$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);

function evaluate_expression($expr, $db, $sid){
$expr = preg_replace_callback('/\{eval\(([^)]+)\)\}/', function($matches) use ($db, $sid) {
    $eval_expr = $matches[1]; // 获取 eval 中的表达式
    $eval_result = @eval("return $eval_expr;"); // 计算 eval 表达式的结果
    return $eval_result; // 返回计算结果
}, $expr);
//var_dump($expr);
$expr = preg_replace_callback('/\{([^}]+)\}/', function($matches) use ($db, $sid) {
    $attr = $matches[1]; // 获取匹配到的变量名
            $firstDotPosition = strpos($attr, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($attr, 0, $firstDotPosition);
                $attr2 = substr($attr, $firstDotPosition + 1);
                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1,$attr2,$sid, $oid, $mid);
                // 替换字符串中的变量
            }
        
    // 在这里根据变量名获取对应的值，例如从数据库中查询
    // 假设你从数据库中获取了 $attr_value
    return $op;
}, $expr);
//var_dump($expr);
// 现在 $expr 中的 {eval(...)} 和 {...} 部分已经被替换成了对应的值
$result = $expr;
try{

//$result = eval("return $expr;");
}catch (ParseError $e){
                print("语法错误: ". $e->getMessage());
                
            }
            catch (Error $e){
                print("执行错误: ". $e->getMessage());
}
return $result;
}

function process_attribute($attr1, $attr2,$sid, $oid, $mid) {
    global $db; // 引用全局数据库连接
            switch ($attr1) {
                case 'u':
                    $attr3 = $attr1.$attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    break;
                default:
                    return $op;
                    break;
            }
    // 在这里根据属性的不同进行处理
    // ...
    // 返回属性值，处理过程中可能会嵌套调用 process_string
    return $op;
}

// 定义处理字符串的函数
function process_string($input, $sid, $oid = null, $mid = null, $uid = null, $type = null, $para = null) {
    global $db; // 引用全局数据库连接

    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);

    if (!empty($matches[1])) {
        foreach ($matches[1] as $match) {
            $firstDotPosition = strpos($match, '.');
            if (!empty($firstDotPosition)) {
                $attr1 = substr($match, 0, $firstDotPosition);
                $attr2 = substr($match, $firstDotPosition + 1);

                // 使用 process_attribute 处理单个属性
                $op = process_attribute($attr1,$attr2,$sid, $oid, $mid);
                // 替换字符串中的变量
                $input = str_replace("v({$match})", $op, $input);
            }
        }
    }

    // 进行其他逻辑处理
    // ...
$input = evaluate_expression($input,$db,$sid);
    return $input;
}

// 使用示例
if($_POST){
$input = $_POST['lexical_text'];
$sid = "c2853ea53cf2b2731616d4f3e26a50b7";

$expr = process_string($input, $sid, $oid, $mid);
echo "本次代码结果:".$expr;
}
$lexical_html = <<<HTML
<form method="post">
测试解析字符串:<textarea name="lexical_text" maxlength="4096" rows="4" cols="40"></textarea><br/>
<input type="submit" value="提交">
</form>
HTML;
echo $lexical_html;
?>


function process_string($input, $sid,$oid=null,$mid=null,$uid=null,$type=null,$para=null) {
// 创建数据库连接
$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);

    $matches = [];
    preg_match_all('/v\(([\w.]+)\)/', $input, $matches);
    var_dump($matches);
    if (!empty($matches[1])) {
        $input = str_replace("{eval(", "", $input);
        $input = str_replace(")}", "", $input);
        foreach ($matches[1] as $match) {
        $firstDotPosition = strpos($match, '.');
        if (!empty($firstDotPosition)) {
            $attr1 = substr($match, 0, $firstDotPosition);
            $attr2 = substr($match, $firstDotPosition+1);
            if ($db->connect_error) {
                die("连接数据库失败: " . $db->connect_error);
            }
            switch ($attr1) {
                case 'u':
                    $attr3 = $attr1.$attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("v({$match})", $op, $input);
                       $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                       $matches = array();
                       if (preg_match_all($pattern, $input, $matches)) {
                           $results = $matches[1]; // 提取所有子模式的内容
                           foreach ($results as $result) {
                               $input = eval("return '$input';");
                           }
                           
                       } else {
                           var_dump($input);
                           @$input = eval("return $input;");
                           
                       }
                            //$input = eval("return \"$output\";")
                    break;
                case 'o':
                    switch($oid){
                        case 'scene':
                            $attr3 = 'm'.$attr2;
                            $sql = "SELECT * FROM system_map WHERE mid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string($op,$sid);
                            // 替换字符串中的变量
                            $input = str_replace("v({$match})", $op, $input);
                            $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                            $matches = array();
                            if (preg_match_all($pattern, $input, $matches)) {
                                $results = $matches[1]; // 提取所有子模式的内容
                                foreach ($results as $result) {
                                    $input = eval("return '$input';");
                                 }
                             } else {
                           @$input = eval("return $input;");
                           
                       }
                            break;
                        case 'npc':
                            $attr3 = 'n'.$attr2;
                            if (is_numeric($mid)){
                            $sql = "SELECT * FROM system_npc WHERE nid = ?";
                            }else{
                            $data_mid = explode("|",$mid);
                            $mid = $data_mid[1];
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            }
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string($op,$sid);
                            // 替换字符串中的变量
                            $input = str_replace("v({$match})", $op, $input);
                            $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                            $matches = array();
                            if (preg_match_all($pattern, $input, $matches)) {
                                $results = $matches[1]; // 提取所有子模式的内容
                                foreach ($results as $result) {
                                    $input = eval("return '$input';");
                                 }
                             } else {
                           @$input = eval("return $input;");
                       } 
                            break;
                        case 'item':
                            $attr3 = 'i'.$attr2;
                            if($attr3 =="icount"){
                                $sql = "SELECT * FROM system_item WHERE iid = ? and sid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("ss", $mid,$sid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }else{
                                $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $mid);
                                $stmt->execute();
                                $result = $stmt->get_result();                               
                            }
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string($op,$sid);
                            // 替换字符串中的变量
                            $input = str_replace("v({$match})", $op, $input);
                            $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                            $matches = array();
                            if (preg_match_all($pattern, $input, $matches)) {
                                $results = $matches[1]; // 提取所有子模式的内容
                                foreach ($results as $result) {
                                    $input = eval("return '$input';");
                                 }
                             } else {
                           @$input = eval("return $input;");
                           
                       }
                            break;
                        case 'scene_oplayer':
                    $attr3 = 'u'.$attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("v({$match})", $op, $input);
                       $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                       $matches = array();
                       if (preg_match_all($pattern, $input, $matches)) {
                           $results = $matches[1]; // 提取所有子模式的内容
                           foreach ($results as $result) {
                               $input = eval("return '$input';");
                           }
                           
                       } else {
                           @$input = eval("return $input;");
                           
                       }
                    break;
                    }
                    break;
                case 'c':
                    $game_id = '19980925';
                    $attr4 = 'game_';
                    $attr3 = $attr4.$attr2;
                    $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $game_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("v({$match})", $op, $input);
                       $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                       $matches = array();
                       if (preg_match_all($pattern, $input, $matches)) {
                           $results = $matches[1]; // 提取所有子模式的内容
                           foreach ($results as $result) {
                               $input = eval("return '$input';");
                           }
                           
                       } else {
                           @$input = eval("return $input;");
                           
                       }
                    break;
                case 'g':
                    $sql = "SELECT * FROM global_data WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row['value']);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("v({$match})", $op, $input);
                       $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                       $matches = array();
                       if (preg_match_all($pattern, $input, $matches)) {
                           $results = $matches[1]; // 提取所有子模式的内容
                           foreach ($results as $result) {
                               $input = eval("return '$input';");
                           }
                           
                       } else {
                           @$input = eval("return $input;");
                           
                       }
                    break;
                case 'e':
                    $sql = "SELECT * FROM system_exp_def WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    // 替换字符串中的变量
                    $op = process_string($op,$sid);
                    $op = "(".$op.")";
                    $input = str_replace("v({$match})", $op, $input);
                    $pattern = '/\[(.*?)\]/'; // 匹配方括号中的内容，并将内容作为第一个子模式
                    $matches = array();
                    if (preg_match_all($pattern, $input, $matches)) {
                           $results = $matches[1]; // 提取所有子模式的内容
                           foreach ($results as $result) {
                               $input = eval("return '$input';");
                           }
                           
                       } else {
                           @$input = eval("return $input;");
                           
                       }
                    break;
                case 'r':
                    if(!is_numeric($attr2)){
                        $attr2 = "{".$attr2."}";
                    }
                    $attr2 = process_string($attr2,$sid);
                    $input = rand(1,$attr2)-1;
                    return $input;
                    break;
                default:
                    return $input;
                    break;
            }
        }
    }    
} else {
    goto b;
}

    
    b:
    preg_match_all('/\{([^}]+)\}/', $input, $matches);
    foreach ($matches[1] as $match) {
        $firstDotPosition = strpos($match, '.');
        if (!empty($firstDotPosition)) {
            $attr1 = substr($match, 0, $firstDotPosition);
            $attr2 = substr($match, $firstDotPosition+1);
            if ($db->connect_error) {
                die("连接数据库失败: " . $db->connect_error);
            }

            switch ($attr1) {
                case 'u':
                    $attr3 = $attr1.$attr2;
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'o':
                    switch($oid){
                        case 'scene':
                            $attr3 = 'm'.$attr2;
                            $sql = "SELECT * FROM system_map WHERE mid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string($op,$sid);
                            // 替换字符串中的变量
                            $input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'npc':
                            $attr3 = 'n'.$attr2;
                            if (is_numeric($mid)){
                            $sql = "SELECT * FROM system_npc WHERE nid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            }else{
                            $data_mid = explode("|",$mid);
                            $mid2 = $data_mid[1];
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid2);
                            }
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            $row_result = $row[$attr3];
                            if ($row_result === null ||$row_result ==='') {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid);
                            // 替换字符串中的变量
                            $input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'item':
                            $attr3 = 'i'.$attr2;
                            if($attr3 =="icount"){
                                $sql = "SELECT * FROM system_item WHERE iid = ? and sid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("ss", $mid,$sid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }else{
                                $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $mid);
                                $stmt->execute();
                                $result = $stmt->get_result();                               
                            }
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            $row_result = $row[$attr3];
                            if ($row_result === null ||$row_result ==='') {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
                            $op = process_string($op,$sid,$oid,$mid);
                            // 替换字符串中的变量
                            $input = str_replace("{{$match}}", $op, $input);
                            break;
                        case 'scene_oplayer':
                            $attr3 = 'u'.$attr2;
                            $sql = "SELECT * FROM game1 WHERE sid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            if ($row === null) {
                                $op = 0; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            $op = process_string($op,$sid);
                            // 替换字符串中的变量
                            $input = str_replace("{{$match}}", $op, $input);
                            break;
                    }
                    break;
                case 'c':
                    $game_id = '19980925';
                    $attr4 = 'game_';
                    $attr3 = $attr4.$attr2;
                    $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $game_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row[$attr3]);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'g':
                    $sql = "SELECT * FROM global_data WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        $op = 0; // 或其他默认值
                        }else{
                    $op = nl2br($row['value']);
                        }
                    $op = process_string($op,$sid);
                    // 替换字符串中的变量
                    $input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'e':
                    $sql = "SELECT * FROM system_exp_def WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    // 替换字符串中的变量
                    var_dump($op);
                    $op = process_string($op,$sid);
                    $input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'r':
                    if(!is_numeric($attr2)){
                        $attr2 = "{".$attr2."}";
                    }
                    $attr2 = process_string($attr2,$sid);
                    $input = rand(1,$attr2)-1;
                    return $input;
                    break;
                default:
                    return $input;
                    break;
            }

        }
    }
    $db->close();
    return $input;
}
