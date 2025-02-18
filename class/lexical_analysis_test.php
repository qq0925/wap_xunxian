<?php
// $start_time = microtime(true);

class LexicalAnalyzer {
    private string $input;
    private int $position;
    private int $length;
    private array $validObjects = ['u', 'o', 'e', 'c', 'm', 'g' , 'r'];
    private $db;
    private $sid;
    private $oid;
    private $mid;
    private $jid;
    private $type;
    private $para;
    private $redis;

    public function __construct(string $input, $db = null, $sid = null, $oid = null, $mid = null, $jid = null, $type = null, $para = null, $redis = null) {
        $this->input = $input;
        $this->position = 0;
        $this->length = strlen($input);
        $this->db = $db;
        $this->sid = $sid;
        $this->oid = $oid;
        $this->mid = $mid;
        $this->jid = $jid;
        $this->type = $type;
        $this->para = $para;
        $this->redis = $redis;
    }

    public function analyze(): array {
        $tokens = [];
        
        while ($this->position < $this->length) {
            $currentChar = $this->input[$this->position];
            
            if ($currentChar === '{') {
                $this->position++; // 跳过 '{'
                $content = '';
                $nestedLevel = 0;
                
                while ($this->position < $this->length) {
                    $char = $this->input[$this->position];
                    if ($char === '{') {
                        $nestedLevel++;
                    } else if ($char === '}') {
                        if ($nestedLevel === 0) {
                            break;
                        }
                        $nestedLevel--;
                    }
                    $content .= $char;
                    $this->position++;
                }
                
                if ($this->position < $this->length && $this->input[$this->position] === '}') {
                    $this->position++; // 跳过 '}'
                    $tokens[] = ['type' => 'EXPRESSION', 'value' => $content];
                }
            }
            else {
                // 收集普通文本
                $text = '';
                while ($this->position < $this->length && 
                       $this->input[$this->position] !== '{') {
                    $text .= $this->input[$this->position];
                    $this->position++;
                }
                if ($text !== '') {
                    $tokens[] = ['type' => 'TEXT', 'value' => $text];
                }
            }
        }
        
        return $tokens;
    }

    public function parse(): string {
        $tokens = $this->analyze();
        $result = '';
        
        foreach ($tokens as $token) {
            if ($token['type'] === 'TEXT') {
                $result .= $token['value'];
            } else if ($token['type'] === 'EXPRESSION') {
                $value = $this->evaluateExpression($token['value']);
                $result .= $value;
            }
        }
        
        return $result;
    }

    private function evaluateExpression(string $expression): string {
        //echo "解析 '{$expression}' 开始：<br/>";
        
        // 首先处理 eval() 函数
        if (preg_match('/^eval\((.*?)\)$/', $expression, $matches)) {
            $evalContent = $matches[1];
            //echo "- 发现eval()函数，内容: {$evalContent}<br/>";
            
            // 将所有 {xxx} 转换为 v(xxx)
            $evalContent = preg_replace('/\{([^}]+)\}/', 'v($1)', $evalContent);
            //echo "- 转换花括号后: {$evalContent}<br/>";
            
            // 处理所有的 v() 函数
            while (preg_match('/v\((.*?)\)/', $evalContent, $vMatches)) {
                $fullMatch = $vMatches[0];
                $innerContent = $vMatches[1];
                
                //echo "- 处理v()函数: {$fullMatch}<br/>";
                $evaluated = $this->processVFunction($innerContent);
                //echo "- v()函数结果: {$evaluated}<br/>";
                
                // 检查结果是否是一个新的表达式
                if (preg_match('/^\{(.*)\}$/', $evaluated, $expMatches)) {
                    // 如果是表达式，递归解析它
                    $newExpression = $expMatches[1];
                    //echo "- 发现新表达式: {$newExpression}<br/>";
                    $evaluated = $this->evaluateExpression($newExpression);
                    //echo "- 新表达式解析结果: {$evaluated}<br/>";
                }
                
                // 如果结果不是数字，用引号包裹
                if (!is_numeric($evaluated)) {
                    $evaluated = '"' . addslashes($evaluated) . '"';
                }
                
                $evalContent = str_replace($fullMatch, $evaluated, $evalContent);
                //echo "- 替换后的表达式: {$evalContent}<br/>";
            }
            
            // 检查是否是纯数学表达式或条件表达式
            if (preg_match('/^[\d\s\+\-\*\/\(\)\.]+$/', $evalContent) || 
                strpos($evalContent, '?') !== false) {  // 添加对三元运算符的支持
                // 计算表达式
                try {
                    $result = eval("return " . $evalContent . ";");
                    //echo "- eval计算结果: {$result}<br/><br/>";
                    return (string)$result;
                } catch (Exception $e) {
                    //echo "- eval计算错误: {$e->getMessage()}<br/><br/>";
                    return "0";
                }
            } else {
                // 检查是否是带引号的字符串
                if (preg_match('/^".*"$/', $evalContent)) {
                    // 带引号的字符串，去掉引号返回
                    $result = trim($evalContent, '"');
                    //echo "- 字符串表达式结果: {$result}<br/><br/>";
                    return $result;
                } else {
                    // 不带引号的非数学表达式返回0
                    //echo "- 无效表达式结果: 0<br/><br/>";
                    return "0";
                }
            }
        }
        
        // 处理普通的 v() 调用
        while (preg_match('/v\((.*?)\)/', $expression, $matches)) {
            $fullMatch = $matches[0];
            $innerContent = $matches[1];
            
            //echo "- 发现v()函数: {$fullMatch}<br/>";
            
            // 递归处理内部表达式
            $evaluated = $this->processVFunction($innerContent);
            //echo "- v()函数处理结果: {$evaluated}<br/>";
            
            // 替换原始表达式中的v()部分，保持外部的花括号
            $expression = str_replace($fullMatch, $evaluated, $expression);
            //echo "- 替换后的表达式: {$expression}<br/>";
        }

        // 检查是否是对象属性访问格式，允许更多的字符
        if (preg_match('/^[a-zA-Z]+\.[-a-zA-Z0-9_:. ]+$/', $expression)) {
            $result = $this->getVariableValue($expression);
            //echo "- 最终结果: {$result}<br/><br/>";
            return $result;
        }

        // 如果不是对象属性访问格式，返回0
        //echo "- 最终结果: 0<br/><br/>";
        return "0";
    }

    private function processVFunction(string $content): string {
        $parts = explode('.', $content);
        
        // 如果只有一个部分，检查是否是有效对象类型
        if (count($parts) <= 1) {
            return "0";  // 单个部分都视为无效
        }

        // 检查第一个部分是否是有效对象类型
        if (!in_array($parts[0], $this->validObjects)) {
            return "0";
        }

        // 获取变量值
        return $this->getVariableValue($content);
    }

    private function getVariableValue(string $path): string {
        $parts = explode('.', $path);
        if (count($parts) < 2 || !in_array($parts[0], $this->validObjects)) {
            return "0";
        }

        // 使用 process_attribute 处理属性
        $result = process_attribute(
            $parts[0],          // attr1
            $parts[1],          // attr2
            $this->sid,         // sid
            $this->oid,         // oid
            $this->mid,         // mid
            $this->jid,         // jid
            $this->type,        // type
            $this->db,          // db
            $this->para,        // para
            $this->redis       // redis
        );

        // 如果是 e 类型且返回的是 eval 表达式，需要继续解析
        if ($parts[0] === 'e' && preg_match('/^\{eval\((.*?)\)\}$/', $result, $matches)) {
            //echo "- 发现eval表达式，继续解析<br/>";
            return $this->evaluateExpression('eval(' . $matches[1] . ')');
        }

        return (string)$result;
    }
}

function process_string($main_value, $sid, $oid=null, $mid=null, $jid=null, $type=null, $para = null) {
    // 创建数据库连接
    $db = new mysqli("localhost", "xunxian", "123456", "xunxian");
    if ($db->connect_error) {
        die("连接失败: " . $db->connect_error);
    }

    // 创建Redis连接
    $redis = new Redis();
    try {
        $redis->connect('127.0.0.1', 6379);
    } catch (Exception $e) {
        die("Redis连接失败: " . $e->getMessage());
    }

    // 创建解析器实例
    $analyzer = new LexicalAnalyzer(
        $main_value,    // input
        $db,            // db
        $sid,           // sid
        $oid,           // oid
        $mid,           // mid
        $jid,           // jid
        $type,          // type
        $para,          // para
        $redis          // 添加redis实例
    );

    // 解析字符串
    $result = $analyzer->parse();

    // 关闭连接
    $db->close();
    $redis->close();

    return $result;
}

// 修改测试代码
function test() {
    $testCases = [
        "简单计算：{eval(1+2+3)}",
        "变量计算：{eval(v(u.level)*5)}",
        "复杂计算：{eval(v(u.level)*2+10/2)}",
        "嵌套花括号：{eval({u.level}*5)}",
        "多个变量：{eval({u.level}+{c.minute})}",
        "无效表达式：{eval(abc)}",
        "原始表达式：1+2+3",
        "原始变量：{u.level}*5",
        "现在是{c.time}，今天是星期{c.day}",
        "当前在线人数：{c.online_user_count}人",
        "测试e：{eval(v(e.test_name))}",
        '{e.time_name}好！
        {e.greeting_text}',
        "随机100：{r.100}",
        "随机c.time(从右往左计算):{r.c.time}",
        "随机c.time：{r.v(c.time)}"
    ];

    echo "详细解析过程：<br/><br/>";
    
    foreach ($testCases as $case) {
        echo "原始句子: {$case}<br/>";
        $result = process_string(
            $case,          // main_value
            'sid_value',    // sid
            'oid_value',    // oid
            'mid_value',    // mid
            'jid_value',    // jid
            'type_value',   // type
            null            // para
        );
        echo "解析结果: {$result}<br/><br/>";
    }
}

function process_attribute($attr1, $attr2, $sid, $oid, $mid, $jid, $type, $db, $para, $redis = null) {
    // 生成缓存键
    $cache_key = "attr_{$attr1}_{$attr2}_{$sid}_{$oid}_{$mid}_{$jid}_{$type}";
    
    // 如果Redis可用，先尝试从缓存获取
    if ($redis) {
        $cached_value = $redis->get($cache_key);
        if ($cached_value !== false) {
            return $cached_value;
        }
    }
    switch ($attr1) {
        case 'u':
            switch($oid){
            case 'mosaic_equip':
            $attr3 = 'i'.$attr2;
            $sql = "SELECT $attr3 FROM system_item_module WHERE iid = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if (!$result) {
                die('查询失败: ' . $db->error);
            }
            $row = $result->fetch_assoc();
            $row_result = $row[$attr3];
            $op = nl2br($row_result);
                break;
            default:
            if (strpos($attr2, "env.") === 0) {
            $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
            switch($attr3){
                case 'user_count':
                // 构建 SQL 查询语句
                $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = ?) and uis_sailing = 0";
                
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["count"];
                break;
                case 'npc_count':
                $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                // 处理结果
                $totalNpcCount = 0;
                
                while ($row = $result->fetch_assoc()) {
                    $mnpc = $row["mnpc_now"];
                    $npcs = explode(",", $mnpc); // 拆分成每个npc项
                    foreach ($npcs as $npc) {
                        $npc_show_cond = urldecode(explode("|", $npc)[2]);
                        $show_cond = checkTriggerCondition($npc_show_cond,$dblj,$sid);
                        if(is_null($show_cond)){
                        $show_cond = true;
                        }
                        if($show_cond){
                        list(, $npcCount) = explode("|", $npc);
                        $totalNpcCount += (int)$npcCount; // 将每个npc的数量累加
                        }
                        
                    }
                }
                
                $op = $totalNpcCount;
                break;
                case 'alive_npc_count':
                $sql = "SELECT COUNT(*) as count FROM system_npc_scene WHERE nmid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                // 处理结果
                $op = $row['count'];
                break;
                case 'monster_count':
                $sql = "SELECT COUNT(*) as count FROM system_npc_midguaiwu WHERE nsid = '' and nmid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                // 处理结果
                $op = $row["count"];
                break;
                case 'pet_count':
                $sql = "SELECT COUNT(*) as count FROM system_pet_scene WHERE nmid = (SELECT nowmid FROM game1 WHERE sid = ?) and nstate = 1";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                // 处理结果
                $op = $row["count"];
                break;
                case 'item_count':
                $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                // 处理结果
                $totalItemCount = 0;
                while ($row = $result->fetch_assoc()) {
                    $mitem = $row["mitem_now"];
                    $items = explode(",", $mitem); // 拆分成每个item项
                    foreach ($items as $item) {
                        list(, $itemCount) = explode("|", $item);
                        $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                    }
                }
                
                $sql = "SELECT drop_item_data FROM system_npc_drop_list WHERE drop_mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                // 处理结果
                while ($row = $result->fetch_assoc()) {
                    $mitem = $row["drop_item_data"];
                    $items = explode(",", $mitem); // 拆分成每个item项
                    foreach ($items as $item) {
                        list(, $itemCount) = explode("|", $item);
                        $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                    }
                }
                
                $op = $totalItemCount;
                break;
                case 'justmid':
                // 构建 SQL 查询语句
                $sql = "SELECT justmid FROM game1 WHERE sid = ?";
                
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["justmid"];
                break;
                case 'nowmid':
                // 构建 SQL 查询语句
                $sql = "SELECT nowmid FROM game1 WHERE sid = ?";
                
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["nowmid"];
                break;
                case 'name':
                // 构建 SQL 查询语句
                $sql = "SELECT mname from system_map where mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["mname"];
                $sql = "SELECT uis_sailing from game1 where sid = ?";
                
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $sid);
                
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $is_sailing = $row["uis_sailing"];
                if($is_sailing ==1){
                $op = "茫茫大海";
                }
                break;
            }
            }
            elseif(strpos($attr2, "land.") === 0){
            $attr3 = 'land_'.substr($attr2, 5);
            // 构建 SQL 查询语句
            $sql = "SELECT $attr3 FROM system_player_land WHERE sid = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row[$attr3];
            }
            elseif(strpos($attr2, "boat.") === 0){
            $attr3 = 'boat_'.substr($attr2, 5);
            // 构建 SQL 查询语句
            $sql = "SELECT $attr3 FROM system_player_boat WHERE sid = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row[$attr3];
            }
            elseif(strpos($attr2, "craft.") === 0){
            $attr3 = 'aircraft_'.substr($attr2, 6);
            // 构建 SQL 查询语句
            $sql = "SELECT $attr3 FROM system_player_aircraft WHERE sid = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row[$attr3];
            }
            elseif(strpos($attr2, "input.") === 0){
            $attr3 = substr($attr2, 6); // 提取 "input." 后面的部分
            // 构建 SQL 查询语句
            $sql = "SELECT value FROM system_player_inputs WHERE sid = ? and id = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $sid,$attr3);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row['value'];
            }
            elseif(strpos($attr2, "refresh_time") === 0){
            $sql = "SELECT mgtime,mrefresh_time FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $nowdate = date('Y-m-d H:i:s');
            $mid_time = $row["mgtime"];
            $mid_refresh_time = $row['mrefresh_time'];
            $op= $mid_refresh_time - floor((strtotime($nowdate)-strtotime($mid_time))/60);//获取刷新分钟剩余
            }elseif(strpos($attr2, "team_member_count") === 0){
            $sql = "SELECT team_member FROM system_team_user WHERE team_member in (SELECT uid FROM game1 WHERE sid = ?)";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $team_member = $row["team_member"];
            $op= @count(explode(',',$team_member));
            }elseif(strpos($attr2, "team_members") === 0){
            $attr3 = substr($attr2, 13); // 提取 "team_members." 后面的部分
            $para = explode(".",$attr3);
            $order = $para[0];
            $attr_player = "u".$para[1];
            $sql = "
SELECT g1.*
FROM game1 g1
JOIN system_team_user stu ON FIND_IN_SET(g1.uid, stu.team_member) > 0
WHERE EXISTS (
SELECT uid
FROM game1
WHERE sid = ?
)
ORDER BY FIND_IN_SET(g1.uid, stu.team_member);
";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            // 移动指针到第 $order+1 行
            for ($i = 0; $i < $order; $i++) {
                $row = $result->fetch_assoc();
            }
            $op = $row[$attr_player];

            
            }elseif(strpos($attr2, "tasks.") === 0){
            $attr3 = substr($attr2, 6); // 提取 "tasks." 后面的部分
            if (strpos($attr3, "count") === 0){
            $sql = "select * from system_task_user WHERE sid='$sid' AND tstate !=2";
            $cxjg = $db->query($sql);
            $wtjrw = $cxjg->fetch_all(MYSQLI_ASSOC);
            $op = count($wtjrw);
            }elseif (strpos($attr3, 't') === 0) {
            $attr3 = substr($attr3, 1); // 去掉开头的 "t"
            $tid = $attr3;
            $sql = "SELECT ttype from system_task where tid = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $tid);
            // 执行查询
            $stmt->execute();
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $ttype = $row["ttype"];
            $sql = "SELECT tstate FROM system_task_user WHERE tid =  ? and sid = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $tid,$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row["tstate"];
            }
            
            if($ttype ==3){
            $op = 2;
            }
            
            }elseif(strpos($attr2, "ic.") === 0){
            $attr3 = substr($attr2, 3); // 提取 "ic." 后面的部分
            if (strpos($attr3, 'i') === 0) {
                $attr3 = substr($attr3, 1); // 去掉开头的 "i"
            }
            $iid = $attr3;
            $sql = "SELECT icount FROM system_item WHERE iid =  ? and sid = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $iid,$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row["icount"];
            }elseif(strpos($attr2, "jv.") === 0){
            $attr3 = substr($attr2, 3); // 提取 "jv." 后面的部分
            if (strpos($attr3, 'j') === 0) {
                $attr3 = substr($attr3, 1); // 去掉开头的 "j"
            }
            $jid = $attr3;
            $sql = "SELECT jlvl FROM system_skill_user WHERE jid =  ? and jsid = ?";
            
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $jid,$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row["jlvl"];
            }elseif(strpos($attr2, "enemys.") === 0){
            $attr3 = substr($attr2, 7); // 提取 "enemys." 后面的部分
            $jid = $attr3;
            if($attr3 =="count"){
            $sql = "SELECT count(*) as enemys_count FROM system_npc_midguaiwu WHERE nsid = ?";
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s",$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row["enemys_count"];
            }else{
            $para = explode(".",$attr3);
            $order = $para[0];
            $attr_guai = "n".$para[1];
            $sql = "SELECT $attr_guai FROM system_npc_midguaiwu WHERE nsid = ?";
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s",$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            // 移动指针到第 $order+1 行
            for ($i = 0; $i < $order; $i++) {
                $row = $result->fetch_assoc();
            }
            $op = $row[$attr_guai];
            }
            }elseif(strpos($attr2, "alive_enemys.") === 0){
            $attr3 = substr($attr2, 13); // 提取 "alive_enemys." 后面的部分
            $jid = $attr3;
            if($attr3 =="count"){
            $sql = "SELECT count(*) as alive_enemys_count FROM system_npc_midguaiwu WHERE nhp > 0 and nsid = ?";
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s",$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $op = $row["alive_enemys_count"];
            }else{
            $para = explode(".",$attr3);
            $order = $para[0];
            $attr_guai = "n".$para[1];
            $sql = "SELECT $attr_guai FROM system_npc_midguaiwu WHERE nhp > 0 and nsid = ?";
            // 使用预处理语句
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s",$sid);
            // 执行查询
            $stmt->execute();
            
            // 获取查询结果
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            // 移动指针到第 $order+1 行
            for ($i = 0; $i < $order; $i++) {
                $row = $result->fetch_assoc();
            }
            $op = $row[$attr_guai];
            }
            }elseif(strpos($attr2, "equips.") === 0){
            $attr3 = substr($attr2, 7); // 提取 "equips." 后面的部分
            if (strpos($attr3, 'b.') === 0) {
                $attr4 = substr($attr3, 2); // 提取 "b." 后面的部分
                $bid = $attr4;
                $sql = "SELECT eq_true_id FROM system_equip_user WHERE eq_type =  1 and eqsid = ? and eqpid = 0";
            
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s",$sid);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["eq_true_id"];
                if (strpos($attr4, 'embed.') === 0){
                //镶物属性相关
                $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                if(preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $mosaic_pos = rtrim($prefix, ".");
                
                $attr6 = $matches[2]; // 匹配到的剩余部分
                }
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mosaic_list = $row['equip_mosaic'];
                $mosaic_para = explode('|',$mosaic_list);
                if(!$mosaic_para[$mosaic_pos]){
                    //$op = "\"\"";
                }else{
                $mosaic_id = $mosaic_para[$mosaic_pos];
                $xid = "i".$attr6;
                $sql = "SELECT $xid FROM system_item_module WHERE iid = '$mosaic_id'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if ($row === null||$row =='') {
                    //$op = "\"\""; // 或其他默认值
                }else{
                    $op = nl2br($row[$xid]);
                }
                }
                //镶物属性相关
                
                
                }else{
                $bid = "i".$bid;
                $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$op')";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if($attr4 =="count"){
                    $op = $op?1:0;
                }elseif($attr4 =="embed_count"){
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if($row){
                $op = count(explode('|',$row['equip_mosaic']));
                }else{
                //$op = "\"\"";
                }
                }else{
                if ($row === null||$row =='') {
                    //$op = "\"\""; // 或其他默认值
                }else{
                    $op = nl2br($row[$bid]);
                }
                }
                }
                }elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $equiped_pos = rtrim($prefix, ".");
                $attr4 = $matches[2]; // 匹配到的剩余部分
                // SQL 查询语句
                $sql = "SELECT id FROM system_equip_def WHERE type = 2 ORDER BY id";
                
                // 执行查询并检查是否有结果
                $result = $db->query($sql);
                
                if ($result->num_rows > 0) {
                    // 初始化数组
                    $idArray = array();
                
                    // 将查询结果存入数组
                    while ($row = $result->fetch_assoc()) {
                        $idArray[] = $row["id"];
                    }
                }
                $equiped_pos = $idArray[$equiped_pos];

                $fid = $attr4;
                $sql = "SELECT eq_true_id FROM system_equip_user WHERE eq_type =  2 and equiped_pos_id = ? and eqsid = ? and eqpid = 0";
            
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("ss",$equiped_pos,$sid);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["eq_true_id"];

                if (strpos($attr4, 'embed.') === 0){
                $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                if(preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $mosaic_pos = rtrim($prefix, ".");
                
                $attr6 = $matches[2]; // 匹配到的剩余部分
                }
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mosaic_list = $row['equip_mosaic'];
                $mosaic_para = explode('|',$mosaic_list);
                if(!$mosaic_para[$mosaic_pos]){
                    //$op = "\"\"";
                }else{
                $mosaic_id = $mosaic_para[$mosaic_pos];
                $xid = "i".$attr6;
                $sql = "SELECT * FROM system_item_module WHERE iid = '$mosaic_id'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if ($row === null||$row =='') {
                    //$op = "\"\""; // 或其他默认值
                }else{
                    $op = nl2br($row[$xid]);
                }
                }
                //镶物属性相关
                }else{
                $fid = "i".$fid;
                $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$op')";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if($attr4 =="count"){
                    $op = $op?1:0;
                }elseif($attr4 =="embed_count"){
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if($row){
                $op = count(explode('|',$row['equip_mosaic']));
                }else{
                //$op = "\"\"";
                }
                }else{
                if ($row === null||$row =='') {
                    //$op = "\"\""; // 或其他默认值
                }else{
                    $op = nl2br($row[$fid]);
                }
                }
                }
            }
            }elseif(strpos($attr2, "callout_adopt.") === 0){
            $attr3 = substr($attr2, 14); // 提取 "callout_adopt." 后面的部分
            if (strpos($attr3, 'count') === 0) {
                $sql = "SELECT COUNT(*) as total_callout FROM system_pet_scene WHERE nstate =  1 and nsid = ?";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s",$sid);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = $row["total_callout"];
            }
            elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $pet_pos = rtrim($prefix, ".");
                $attr4 = $matches[2]; // 匹配到的剩余部分
                // SQL 查询语句
                $sql = "SELECT npid FROM system_pet_scene WHERE nsid = ? ORDER BY npid";

                // 使用预处理语句
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s",$sid);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($result->num_rows > 0) {
                    // 初始化数组
                    $idArray = array();
                
                    // 将查询结果存入数组
                    while ($row = $result->fetch_assoc()) {
                        $idArray[] = $row["npid"];
                    }
                }
                $pet_pos = $idArray[$pet_pos];

                $fid = $attr4;
                
                if (strpos($attr4, 'cut_hp') === 0){
                $attr5 = substr($attr4, 6); // 提取 "embed." 后面的部分
                if(preg_match('/^(\d+\.)?(.*)/', $attr5, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $mosaic_pos = rtrim($prefix, ".");
                
                $attr6 = $matches[2]; // 匹配到的剩余部分
                }
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$op'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mosaic_list = $row['equip_mosaic'];
                $mosaic_para = explode('|',$mosaic_list);
                if(!$mosaic_para[$mosaic_pos]){
                    //$op = "\"\"";
                }else{
                $mosaic_id = $mosaic_para[$mosaic_pos];
                $xid = "i".$attr6;
                $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$mosaic_id')";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = nl2br($row[$xid]);
                }
                //镶物属性相关
                }else{
                $pid = "p".$fid;
                $sql = "SELECT * FROM system_pet_player WHERE pid = '$pet_pos'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $op = nl2br($row[$pid]);
                }
            }
            }else{
            $attr3 = $attr1.$attr2;
            $attr3 = str_replace('.', '', $attr3);
            $sql = "SHOW COLUMNS FROM game1 LIKE '$attr3'";
            $result = $db->query($sql);
            if($result->num_rows >0){
            $sql = "SELECT * FROM game1 WHERE sid = ?";
            }else{
            $sql = "SELECT * FROM system_addition_attr WHERE sid = ? and name = '$attr3'";
            $attr_type = 1;
            }
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $sid);
            $stmt->execute();
            $result_2 = $stmt->get_result();
            if (!$result_2) {
                
                die('查询失败: ' . $db->error);
            }
            $row = $result_2->fetch_assoc();
            if($attr_type !=1){
            $op = nl2br($row[$attr3]);
            }else{
            $op = nl2br($row['value']);
                }
            }
            break;
            }
            break;
        case 'o':
            switch($oid){
                case 'scene':
                    // 匹配字符串格式 exit_x.xx，不限制.xx的具体值
                    // 匹配字符串格式 exit_x.xx
                    if (preg_match('/exit_([nswe])\.(.+)/', $attr2, $matches)) {
                        $exitType = $matches[1];  // 匹配到的x (n, s, w, e)
                        $xxValue = 'm' . $matches[2];   // 匹配到的.xx的值加上'm'前缀
                        // 将x映射到对应的字段
                        $fieldMapping = [
                            'n' => 'mup',
                            's' => 'mdown',
                            'w' => 'mleft',
                            'e' => 'mright',
                        ];
                        
                        $field = $fieldMapping[$exitType];  // 获取对应字段名称
                    
                        // 查询system_map表，获取对应字段（up, down, left, right）对应的mid
                        $sql = "SELECT $field FROM system_map WHERE mid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('i', $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result && $row = $result->fetch_assoc()) {
                            $targetMid = $row[$field];
                    
                            // 根据targetMid获取.xx字段的值
                            $sql2 = "SELECT $xxValue FROM system_map WHERE mid = ?";
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->bind_param('i', $targetMid);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();
                    
                            if ($result2 && $row2 = $result2->fetch_assoc()) {
                                if($xxValue =='mid'){
                                $op = 's'.$row2[$xxValue];
                                }else{
                                $op = $row2[$xxValue];
                                }
                            }
                        }
                    }
                    else{
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
                    $op = nl2br($row[$attr3]);
                        }
                    break;
                case 'pet':
                    if ($attr2 == "skills_cmmt") {
                        
                        $sql = "SELECT * FROM system_skill_user WHERE jpid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        while($row = $result->fetch_assoc()){
                        
                            $skill_id = $row['jid'];
                            $skill_lvl = $row['jlvl'];
                            $sql2 = "SELECT * FROM system_skill WHERE jid = ?";
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->bind_param("s", $skill_id);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();
                            $row2 = $result2->fetch_assoc();
                            $row_result .= "，" . $row2['jname'] ."(". "{$skill_lvl}".")";
                            
                            $skill_final = ltrim($row_result, "，");
                            if(!$skill_final){
                                $op = "无";
                            }else{
                                $op = $skill_final;
                            }
                        }
                    }elseif($attr2 == "equips_cmmt") {
$sql = "SELECT * FROM system_equip_def WHERE type = '1'";
$cxjg = $db->query($sql);
$ret = $cxjg ? $cxjg->fetch_all(MYSQLI_ASSOC) : [];

$equipbid = null;
foreach ($ret as $row) {
$equiptypeid = $row['id'];
$equiptypename = $row['name'];
$sql = "SELECT * FROM system_equip_user WHERE eq_type = 1 AND equiped_pos_id = '$equiptypeid' AND eqsid = '$sid' AND eqpid = '$mid'";
$cxjg = $db->query($sql);
if ($cxjg) {
    $row = $cxjg->fetch_assoc();
    if ($row) {
        $equipbid = $row['eq_true_id'];
        break;
    }
}
}

if ($equipbid) {
$sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$equipbid')";
$cxjg = $db->query($sql);
if ($cxjg) {
    $row = $cxjg->fetch_assoc();
    if ($row) {
        $equipbname = \lexical_analysis\color_string($row['iname']);
        $equipbhtml = $equipbname . ",";
    }
}
}

$sql = "SELECT * FROM system_equip_def WHERE type = 2";
$cxjg = $db->query($sql);
$ret = $cxjg ? $cxjg->fetch_all(MYSQLI_ASSOC) : [];

$equipfhtml = '';
foreach ($ret as $row) {
$equiptypeid = $row['id'];
$equiptypename = $row['name'];
$sql = "SELECT * FROM system_equip_user WHERE eq_type = 2 AND equiped_pos_id = '$equiptypeid' AND eqsid = '$sid' AND eqpid = '$mid'";
$cxjg = $db->query($sql);
if ($cxjg) {
    $row = $cxjg->fetch_assoc();
    if ($row) {
        $equipfid = $row['eq_true_id'];
        if ($equipfid) {
            $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$equipfid')";
            $cxjg = $db->query($sql);
            if ($cxjg) {
                $row = $cxjg->fetch_assoc();
                if ($row) {
                    $equipfname = \lexical_analysis\color_string($row['iname']);
                }
            }
        }
        $equipfhtml .= $equipfname . ",";
    }
}
}

$equipbhtml = rtrim($equipbhtml,',');
$equipfhtml = rtrim($equipfhtml,',');
$bagequiphtml = $equipbhtml.",".$equipfhtml;
$bagequiphtml = rtrim($bagequiphtml,',');

if(!$bagequiphtml){
$op = "无";
}else{
$op = $bagequiphtml;
}
                    }else{
                    $attr3 = 'n'.$attr2;
                    $sql = "SELECT * FROM system_pet_scene WHERE npid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row[$attr3]);
                    if ($attr2 == "is_adopt") {
                        $op = $row['ncan_shouyang'];
                    } 
                        }
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
                    if ($attr2 == "skills_cmmt") {
                        $skills_cmmt = $row['nskills'];
                        $skill_cmmt = explode(',', $skills_cmmt);
                        if ($skills_cmmt) {
                            foreach ($skill_cmmt as $skill_cmmt_detail) {
                                $skill_para = explode('|', $skill_cmmt_detail);
                                $skill_id = $skill_para[0];
                                $skill_lvl = $skill_para[1];
                                $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $skill_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $row_result .= "，" . $row['jname'] ."(". "{$skill_lvl}".")";
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } elseif ($attr2 == "equips_cmmt") {
                        $equips_cmmt = $row['nequips'];
                        $equip_cmmt = explode(',', $equips_cmmt);
                        if ($equips_cmmt) {
                            foreach ($equip_cmmt as $equips_cmmt_para) {
                                $equips_cmmt_id = explode('_',$equips_cmmt_para)[2];
                                $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $equips_cmmt_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $row_result .= "，" . $row['iname'];
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } elseif ($attr2 == "is_adopt") {
                        $row_result = $row['ncan_shouyang'];
                    } else {
                        $row_result = $row[$attr3];
}
                    $op = nl2br($row_result);
                    break;
                case 'npc_monster':
                    $attr3 = 'n'.$attr2;
                    $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($attr2 == "skills_cmmt") {
                        $skills_cmmt = $row['nskills'];
                        $skill_cmmt = explode(',', $skills_cmmt);
                        if ($skills_cmmt) {
                            foreach ($skill_cmmt as $skill_cmmt_detail) {
                                $skill_para = explode('|', $skill_cmmt_detail);
                                $skill_id = $skill_para[0];
                                $skill_lvl = $skill_para[1];
                                $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $skill_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $row_result .= "，" . $row['jname'] ."(". "{$skill_lvl}".")";
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } elseif ($attr2 == "equips_cmmt") {
                        $equips_cmmt = $row['nequips'];
                        $equip_cmmt = explode(',', $equips_cmmt);
                        if ($equips_cmmt) {
                            foreach ($equip_cmmt as $equips_cmmt_para) {
                                $equips_cmmt_id = explode('_',$equips_cmmt_para)[2];
                                $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $equips_cmmt_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $row_result .= "，" . $row['iname'];
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } else {
                        $row_result = $row[$attr3];
}
                    $op = nl2br($row_result);
                    break;
                case 'npc_scene':
                    $attr3 = 'n'.$attr2;
                    $sql = "SELECT * FROM system_npc_scene WHERE ncid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($attr2 == "skills_cmmt") {
                        $skills_cmmt = $row['nskills'];
                        $skill_cmmt = explode(',', $skills_cmmt);
                        if ($skills_cmmt) {
                            foreach ($skill_cmmt as $skill_cmmt_detail) {
                                $skill_para = explode('|', $skill_cmmt_detail);
                                $skill_id = $skill_para[0];
                                $skill_lvl = $skill_para[1];
                                $sql = "SELECT * FROM system_skill WHERE jid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $skill_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $row_result .= "，" . $row['jname'] ."(". "{$skill_lvl}".")";
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } elseif ($attr2 == "equips_cmmt") {
                        $equips_cmmt = $row['nequips'];
                        $equip_cmmt = explode(',', $equips_cmmt);
                        if ($equips_cmmt) {
                            foreach ($equip_cmmt as $equips_cmmt_para) {
                                $equips_cmmt_id = explode('_',$equips_cmmt_para)[2];
                                $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                                $stmt = $db->prepare($sql);
                                $stmt->bind_param("s", $equips_cmmt_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $row_result .= "，" . $row['iname'];
                            }
                            $row_result = ltrim($row_result, "，");
                        }
                    } elseif ($attr2 == "is_adopt") {
                        $row_result = $row['ncan_shouyang'];
                    }  else {
                        $row_result = $row[$attr3];
}
                    $op = nl2br($row_result);
                    break;
                case 'item':
                    $attr3 = 'i'.$attr2;
                    if($attr3 =="icount"||$attr3 =="iroot"){
                        $sql = "SELECT * FROM system_item WHERE item_true_id = ? and sid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("ss", $mid,$sid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                    }elseif(strpos($attr3, 'iembed.') === 0){
                //镶物属性相关
                $attr4 = substr($attr3, 7); // 提取 "embed." 后面的部分
                if(preg_match('/^(\d+\.)?(.*)/', $attr4, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $mosaic_pos = rtrim($prefix, ".");
                
                $attr5 = $matches[2]; // 匹配到的剩余部分
                }
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$mid'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mosaic_list = $row['equip_mosaic'];
                $mosaic_para = explode('|',$mosaic_list);
                if(!$mosaic_para[$mosaic_pos]){
                    //$op = "\"\"";
                }else{
                $mosaic_id = $mosaic_para[$mosaic_pos];
                $xid = "i".$attr5;
                $sql = "SELECT * FROM system_item_module WHERE iid = '$mosaic_id'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $attr3 = $xid;
                }
                //镶物属性相关
                    }else{
                        $sql = "SHOW COLUMNS FROM system_item_module LIKE '$attr3'";
                        $result = $db->query($sql);
                        if($result->num_rows >0){
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$mid')";
                        }else{
                        $sql = "SELECT * FROM system_addition_attr WHERE oid = 'item' and mid = '$mid' and name = '$attr3'";
                        $attr_type = 1;
                        }
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $result_2 = $stmt->get_result();
                        if (!$result_2) {
                            die('查询失败: ' . $db->error);
                        }
                        $row = $result_2->fetch_assoc();
                    }
                    
                    if($attr_type ==1){
                    $row_result = $row['value'];
                    }else{
                    $row_result = $row[$attr3];
                    }
                    if($attr3 =="iroot"){
                        $item_para = explode("|",$row_result);
                        $para_1 = $item_para[0];
                        $para_2 = $item_para[1];
                        if($para_1 ==1){
                        $sql = "SELECT nname FROM system_npc WHERE nid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $para_2);
                        $stmt->execute();
                        $result_npc = $stmt->get_result();
                        $row_npc = $result_npc->fetch_assoc();
                        $row_npc_name = $row_npc['nname'];
                        $row_result = "怪物掉落"."|".$row_npc_name;
                        }else{
                        $row_result = "未知来源";
                        }
                    }
                    $op = nl2br($row_result);
                    break;
                case 'mosaic_equip':
                    $attr3 = 'i'.$attr2;
                    if($attr3 =="icount"||$attr3 =="iroot"){
                        $sql = "SELECT * FROM system_item WHERE item_true_id = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                    }elseif(strpos($attr3, 'iembed.') === 0){
                //镶物属性相关
                $attr4 = substr($attr3, 7); // 提取 "embed." 后面的部分
                if(preg_match('/^(\d+\.)?(.*)/', $attr4, $matches)){
                $prefix = $matches[1]; // 匹配到的前缀部分（数字加点号)
                $mosaic_pos = rtrim($prefix, ".");
                
                $attr5 = $matches[2]; // 匹配到的剩余部分
                }
                $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE equip_id = '$mid'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $mosaic_list = $row['equip_mosaic'];
                $mosaic_para = explode('|',$mosaic_list);
                $mosaic_id = $mosaic_para[$mosaic_pos];
                $xid = "i".$attr5;
                $sql = "SELECT * FROM system_item_module WHERE iid = '$mosaic_id'";
                // 使用预处理语句
                $stmt = $db->prepare($sql);
                // 执行查询
                $stmt->execute();
                
                // 获取查询结果
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $attr3 = $xid;
                //镶物属性相关
                    }else{
                        $sql = "SHOW COLUMNS FROM system_item_module LIKE '$attr3'";
                        $result = $db->query($sql);
                        if($result->num_rows >0){
                        $sql = "SELECT * FROM system_item_module WHERE iid = (SELECT iid FROM system_item WHERE item_true_id = '$mid')";
                        }else{
                        $sql = "SELECT * FROM system_addition_attr WHERE oid = 'item' and mid = '$mid' and name = '$attr3'";
                        $attr_type = 1;
                        }
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $result_2 = $stmt->get_result();
                        if (!$result_2) {
                            die('查询失败: ' . $db->error);
                        }
                        $row = $result_2->fetch_assoc();
                    }
                    
                    if($attr_type ==1){
                    $row_result = $row['value'];
                    }else{
                    $row_result = $row[$attr3];
                    }
                    if($attr3 =="iroot"){
                        $item_para = explode("|",$row_result);
                        $para_1 = $item_para[0];
                        $para_2 = $item_para[1];
                        if($para_1 ==1){
                        $sql = "SELECT nname FROM system_npc WHERE nid = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $para_2);
                        $stmt->execute();
                        $result_npc = $stmt->get_result();
                        $row_npc = $result_npc->fetch_assoc();
                        $row_npc_name = $row_npc['nname'];
                        $row_result = "怪物掉落"."|".$row_npc_name;
                        }else{
                        $row_result = "未知来源";
                        }
                    }
                    $op = nl2br($row_result);
                    break;
                case 'item_module':
                    $attr3 = 'i'.$attr2;
                    $sql = "SELECT * FROM system_item_module WHERE iid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if($attr_type !=1){
                    $row_result = $row[$attr3];
                    }else{
                    $row_result = $row['value'];
                    }
                    $op = nl2br($row_result);
                    break;
                case 'scene_oplayer':
                    if (strpos($attr2, "env.") === 0) {
                        $attr3 = substr($attr2, 4); // 提取 "env." 后面的部分
                        switch($attr3){
                            case 'user_count':
                            // 构建 SQL 查询语句
                            $sql = "SELECT COUNT(*) as count FROM game1 WHERE sfzx=1 and nowmid IN (SELECT nowmid FROM game1 WHERE sid = ?)";
                            
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $op = $row["count"];
                            break;
                            case 'npc_count':
                            $sql = "SELECT mnpc_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            // 处理结果
                            $totalNpcCount = 0;
                            while ($row = $result->fetch_assoc()) {
                                $mnpc = $row["mnpc_now"];
                                $npcs = explode(",", $mnpc); // 拆分成每个npc项
                                foreach ($npcs as $npc) {
                                    list(, $npcCount) = explode("|", $npc);
                                    $totalNpcCount += (int)$npcCount; // 将每个npc的数量累加
                                }
                            }
                            $op = $totalNpcCount;
                            break;
                            case 'monster_count':
                            $sql = "SELECT COUNT(*) as count FROM system_npc_midguaiwu WHERE nsid = '' and nmid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            // 处理结果
                            $op = $row["count"];
                            break;
                            case 'item_count':
                            $sql = "SELECT mitem_now FROM system_map WHERE mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            // 处理结果
                            $totalItemCount = 0;
                            while ($row = $result->fetch_assoc()) {
                                $mitem = $row["mitem_now"];
                                $items = explode(",", $mitem); // 拆分成每个item项
                                foreach ($items as $item) {
                                    list(, $itemCount) = explode("|", $item);
                                    $totalItemCount += (int)$itemCount; // 将每个item的数量累加
                                }
                            }
                            $op = $totalItemCount;
                            break;
                            case 'justmid':
                            // 构建 SQL 查询语句
                            $sql = "SELECT justmid FROM game1 WHERE sid = ?";
                            
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $op = $row["justmid"];
                            break;
                            case 'nowmid':
                            // 构建 SQL 查询语句
                            $sql = "SELECT nowmid FROM game1 WHERE sid = ?";
                            
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $op = $row["nowmid"];
                            break;
                            case 'name':
                            // 构建 SQL 查询语句
                            $sql = "SELECT mname from system_map where mid = (SELECT nowmid FROM game1 WHERE sid = ?)";
                            
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $op = $row["mname"];
                            $sql = "SELECT uis_sailing from game1 where sid = ?";
                            
                            // 使用预处理语句
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $mid);
                            
                            // 执行查询
                            $stmt->execute();
                            
                            // 获取查询结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $is_sailing = $row["uis_sailing"];
                            if($is_sailing ==1){
                            $op = "茫茫大海";
                            }
                            break;
                        }
            }
                    else{
                    $attr3 = 'u'.$attr2;
                    $sql = "SHOW COLUMNS FROM game1 LIKE '$attr3'";
                    $result = $db->query($sql);
                    if($result->num_rows >0){
                    $sql = "SELECT * FROM game1 WHERE sid = ?";
                    }else{
                    $sql = "SELECT * FROM system_addition_attr WHERE sid = ? and name = '$attr3'";
                    $attr_type = 1;
                    }
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result_2 = $stmt->get_result();
                    if (!$result_2) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result_2->fetch_assoc();
                    if($attr_type !=1){
                    $op = nl2br($row[$attr3]);
                    }else{
                    $op = nl2br($row['value']);
                    }
                    break;
            }
                    break;
                default:
                    $attr3 = 'n'.$attr2;
                    $sql = "SELECT * FROM system_npc_scene WHERE ncid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $mid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row[$attr3]);
                    break;
            }
            break;
        case 'r':
            $op = rand(0, intval($attr2) - 1); // 随机数不缓存
            break;
        case 'g':
            // 使用缓存处理全局数据
            if ($redis) {
                $cache_key = "global_data_{$attr2}";
                $op = $redis->get($cache_key);
                if ($op === false) {
                    $sql = "SELECT * FROM global_data WHERE gid = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    // 缓存结果，设置过期时间为1小时
                    $redis->setex($cache_key, 3600, $op);
                }
            }
            break;
        case 'e':
            // 使用缓存处理表达式定义
            if ($redis) {
                $cache_key = "exp_def_{$attr2}";
                $op = $redis->get($cache_key);
                if ($op === false) {
                    $sql = "SELECT value,type FROM system_exp_def WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("s", $attr2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    $op = nl2br($row['value']);
                    // 缓存结果，设置过期时间为5分钟
                    $redis->setex($cache_key, 300, $op);
                }
            }
            break;
        case 'c':
            switch($attr2) {
                case 'time':
                case 'day':
                case 'year':
                case 'month':
                case 'date':
                case 'hour':
                case 'minute':
                case 'second':
                    // 时间相关的不缓存
                    $op = handle_time_attribute($attr2);
                    break;
                case 'online_user_count':
                    // 在线用户数缓存10秒
                    if ($redis) {
                        $cache_key = "online_user_count";
                        $op = $redis->get($cache_key);
                        if ($op === false) {
                            $query = "SELECT COUNT(*) FROM game1 WHERE sfzx = 1";
                            $result = $db->query($query);
                            $op = $result->fetch_row()[0];
                            $redis->setex($cache_key, 10, $op);
                        }
                    }
                    break;
                default:
                    // 游戏基本信息缓存1小时
                    if ($redis) {
                        $cache_key = "game_basic_{$attr2}";
                        $op = $redis->get($cache_key);
                        if ($op === false) {
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
                            $op = nl2br($row[$attr3]);
                            $redis->setex($cache_key, 3600, $op);
                        }
                    }
            }
            break;
        default:
            return 0;
    }

    return $op;
}

// 辅助函数：处理时间相关的属性
function handle_time_attribute($attr) {
    switch($attr) {
        case 'time': return date('U');
        case 'day': return date('N');
        case 'year': return date('Y');
        case 'month': return date('n');
        case 'date': return date('j');
        case 'hour': return date('G');
        case 'minute': return 1 * date('i');
        case 'second': return 1 * date('s');
        default: return 0;
    }
}
//test();
// $end_time = microtime(true);
// $execution_time = ceil(($end_time - $start_time) * 1000);
// echo "<br/>执行时间：" . $execution_time . "ms";
?>