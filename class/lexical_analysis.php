<?php


//解析各个地方传来的{}。


require_once 'class/player.php';
$player = \player\getplayer($sid,$dblj);
function process_string($input, $sid) {
    $matches = [];
    preg_match_all('/\{([^}]+)\}/', $input, $matches);
    foreach ($matches[1] as $match) {
        $parts = explode('.', $match);
        if (count($parts) > 1) {
            $attr1 = substr($parts[0], 0, 1);
            $attr2 = substr($parts[1], 0);
            //var_dump($attr2);
            $servername = "localhost"; // 数据库服务器名
            $username = "xunxian"; // 数据库用户名
            $password = "lwd54088"; // 数据库密码
            $dbname = "xunxian"; // 数据库名称
                // 创建连接
            $db = new mysqli($servername, $username, $password, $dbname);
                // 检查连接是否成功
            if ($db->connect_error) {
                    die("连接失败: " . $db->connect_error);
                }
            
            switch ($attr1) {
                case 'u':
                    // code...                
                    $attr3 = $attr1.$attr2;
                    //var_dump($attr3);
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $sid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                        
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row[$attr3]);
                
                    // 替换字符串中的变量
                    $input = str_replace("{{$match}}", $op, $input);
                    break;
                    case 'c':
                    // code...                
                    $game_id = '19980925';
                    $attr4 = 'game_';
                    $attr3 = $attr4.$attr2;
                    //var_dump($attr3);
                    $sql = "SELECT * FROM gm_game_basic WHERE game_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $game_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                        
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row[$attr3]);
                    //var_dump($op);
                    // 替换字符串中的变量
                    $input = str_replace("{{$match}}", $op, $input);
                        break;
                    default:
                    // code...
                    return $input;
                    break;
            }
        }
    }
    return $input;
}

//$input = '[{u.name}]-{c.status_string}.';
//$output = process_string($input, $sid);
//echo $output;
?>