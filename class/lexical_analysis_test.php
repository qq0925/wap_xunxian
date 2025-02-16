<?php
$start_time = microtime(true);

class Token {
    public $type;
    public $value;

    public function __construct($type, $value) {
        $this->type = $type;
        $this->value = $value;
    }
}

class VariableStore {
    private static $variables = [];

    public static function set($name, $value) {
        // 检查是否是数组特殊操作
        if (preg_match('/^arr\.(create|get|set|put|del)\(([^)]+)\)(?:\.(\d+))?$/', $name, $matches)) {
            $operation = $matches[1];
            $arrayName = $matches[2];
            $index = isset($matches[3]) ? (int)$matches[3] : null;
            
            // 解析数组名（可能包含变量引用）
            if (strpos($arrayName, '{') === 0 && substr($arrayName, -1) === '}') {
                $arrayName = self::get(substr($arrayName, 1, -1));
            }
            
            switch ($operation) {
                case 'create':
                    if (!is_array($value)) {
                        throw new Exception("create 操作需要数组值");
                    }
                    self::$variables[$arrayName] = $value;
                    return $value;
                    
                case 'get':
                    if (!isset(self::$variables[$arrayName])) {
                        self::$variables[$arrayName] = [];
                    }
                    if ($index !== null) {
                        return isset(self::$variables[$arrayName][$index]) 
                            ? self::$variables[$arrayName][$index] 
                            : 0;
                    }
                    return self::$variables[$arrayName];
                    
                case 'set':
                    if (!isset(self::$variables[$arrayName])) {
                        self::$variables[$arrayName] = [];
                    }
                    if ($index !== null) {
                        self::$variables[$arrayName][$index] = $value;
                    }
                    return $value;
                    
                case 'put':
                    if (!isset(self::$variables[$arrayName])) {
                        self::$variables[$arrayName] = [];
                    }
                    $newIndex = count(self::$variables[$arrayName]);
                    self::$variables[$arrayName][$newIndex] = $value;
                    return self::$variables[$arrayName][$newIndex];
                    
                case 'del':
                    if (!isset(self::$variables[$arrayName])) {
                        return 0;
                    }
                    if ($index !== null && isset(self::$variables[$arrayName][$index])) {
                        $value = self::$variables[$arrayName][$index];
                        unset(self::$variables[$arrayName][$index]);
                        // 重新索引数组
                        self::$variables[$arrayName] = array_values(self::$variables[$arrayName]);
                        return $value;
                    }
                    return 0;
            }
        }
        
        // 检查是否是数组访问
        if (preg_match('/^([a-zA-Z][a-zA-Z0-9_]*)\[([^\]]+)\]$/', $name, $matches)) {
            $arrayName = $matches[1];
            $index = $matches[2];
            
            // 如果数组不存在，创建它
            if (!isset(self::$variables[$arrayName]) || !is_array(self::$variables[$arrayName])) {
                self::$variables[$arrayName] = [];
            }
            
            // 处理索引
            if (is_numeric($index)) {
                $index = (int)$index;
            } else {
                // 去掉引号（如果有的话）
                $index = trim($index, "'\"");
            }
            
            self::$variables[$arrayName][$index] = $value;
            return $value;
        }
        
        // 检查是否包含点运算符
        if (strpos($name, '.') !== false) {
            $parts = explode('.', $name);
            $obj = &self::$variables;
            
            // 遍历除最后一个部分外的所有部分
            for ($i = 0; $i < count($parts) - 1; $i++) {
                $part = $parts[$i];
                if (!isset($obj[$part]) || !is_array($obj[$part])) {
                    $obj[$part] = [];
                }
                $obj = &$obj[$part];
            }
            
            // 设置最后一个部分的值
            $obj[$parts[count($parts) - 1]] = $value;
        } else {
            // 如果是数组初始化
            if (is_array($value)) {
                self::$variables[$name] = $value;
        } else {
            self::$variables[$name] = $value;
            }
        }
    }

    public static function get($name) {
        // 检查是否是数组特殊操作
        if (preg_match('/^arr\.(get)\(([^)]+)\)(?:\.(\d+))?$/', $name, $matches)) {
            $arrayName = $matches[2];
            $index = isset($matches[3]) ? (int)$matches[3] : null;
            
            // 解析数组名（可能包含变量引用）
            if (strpos($arrayName, '{') === 0 && substr($arrayName, -1) === '}') {
                $arrayName = self::get(substr($arrayName, 1, -1));
            }
            
            if (!isset(self::$variables[$arrayName])) {
                return 0;
            }
            
            if ($index !== null) {
                return isset(self::$variables[$arrayName][$index]) 
                    ? self::$variables[$arrayName][$index] 
                    : 0;
            }
            
            return self::$variables[$arrayName];
        }
        
        // 检查是否是数组访问
        if (preg_match('/^([a-zA-Z][a-zA-Z0-9_]*)\[([^\]]+)\]$/', $name, $matches)) {
            $arrayName = $matches[1];
            $index = $matches[2];
            
            // 如果数组不存在，返回0
            if (!isset(self::$variables[$arrayName])) {
                return 0;
            }
            
            // 处理索引
            if (is_numeric($index)) {
                $index = (int)$index;
            } else {
                // 去掉引号（如果有的话）
                $index = trim($index, "'\"");
            }
            
            return isset(self::$variables[$arrayName][$index]) 
                ? self::$variables[$arrayName][$index] 
                : 0;
        }
        
        // 检查是否包含点运算符
        if (strpos($name, '.') !== false) {
            $parts = explode('.', $name);
            $value = self::$variables;
            
            // 遍历所有部分
            foreach ($parts as $part) {
                if (!isset($value[$part])) {
                    return 0; // 如果属性不存在，返回0而不是抛出异常
                }
                $value = $value[$part];
            }
            
            return $value;
        }
        
        // 如果变量不存在，返回0而不是抛出异常
        return isset(self::$variables[$name]) ? self::$variables[$name] : 0;
    }

    public static function clear() {
        self::$variables = [];
    }
}

class Lexer {
    private $input;
    private $position;
    private $currentChar;

    public function __construct($input) {
        $this->input = $input;
        $this->position = 0;
        $this->currentChar = $this->input[0] ?? null;
    }

    private function advance() {
        $this->position++;
        $this->currentChar = $this->position < strlen($this->input) 
            ? $this->input[$this->position] 
            : null;
    }

    private function skipWhitespace() {
        while ($this->currentChar !== null && ctype_space($this->currentChar)) {
            $this->advance();
        }
    }

    private function number() {
        $result = '';
        while ($this->currentChar !== null && (ctype_digit($this->currentChar) || $this->currentChar === '.')) {
            $result .= $this->currentChar;
            $this->advance();
        }
        
        if ($this->currentChar !== null && strtolower($this->currentChar) === 'e') {
            $result .= $this->currentChar;
            $this->advance();
            
            if ($this->currentChar === '+' || $this->currentChar === '-') {
                $result .= $this->currentChar;
                $this->advance();
            }
            
            while ($this->currentChar !== null && ctype_digit($this->currentChar)) {
                $result .= $this->currentChar;
                $this->advance();
            }
        }
        
        return floatval($result);
    }

    private function variable() {
        $result = '';
        $this->advance(); // 跳过开始的 {
        
        // 检查是否是 eval
        if (substr($this->input, $this->position, 4) === 'eval') {
            $this->position += 4; // 跳过 'eval'
            $this->currentChar = $this->input[$this->position] ?? null;
            
            if ($this->currentChar !== '(') {
                throw new Exception("eval 后必须跟随括号");
            }
            
            $this->advance(); // 跳过 '('
            $nestedExpr = '';
            $parenCount = 1;
            $inString = false;
            $stringChar = '';
            
            while ($this->currentChar !== null && $parenCount > 0) {
                // 处理字符串
                if (($this->currentChar === '"' || $this->currentChar === "'") && 
                    (!$inString || $stringChar === $this->currentChar)) {
                    if ($inString) {
                        $inString = false;
                    } else {
                        $inString = true;
                        $stringChar = $this->currentChar;
                    }
                }
                
                if (!$inString) {
                    if ($this->currentChar === '(') {
                        $parenCount++;
                    } elseif ($this->currentChar === ')') {
                        $parenCount--;
                    }
                }
                
                if ($parenCount > 0) {
                    // 保留 v() 的完整语法
                    if ($this->currentChar === '{' && 
                        isset($this->input[$this->position + 1]) && 
                        $this->input[$this->position + 1] === 'v' &&
                        isset($this->input[$this->position + 2]) && 
                        $this->input[$this->position + 2] === '(') {
                        $nestedExpr .= '{v(';
                        $this->advance(); // 跳过 {
                        $this->advance(); // 跳过 v
                        $this->advance(); // 跳过 (
                        continue;
                    }
                    $nestedExpr .= $this->currentChar;
                }
                $this->advance();
            }
            
            if ($parenCount > 0) {
                throw new Exception("eval 表达式未闭合");
            }
            
            if ($this->currentChar !== '}') {
                throw new Exception("eval 表达式后必须是 }");
            }
            
            $this->advance(); // 跳过 }
            return 'eval(' . $nestedExpr . ')';
        }
        
        // 检查是否是 v 运算符
        if ($this->currentChar === 'v' && 
            isset($this->input[$this->position + 1]) && 
            $this->input[$this->position + 1] === '(') {
            
            $this->advance(); // 跳过 'v'
            $this->advance(); // 跳过 '('
            
            $varName = '';
            while ($this->currentChar !== null && $this->currentChar !== ')') {
                $varName .= $this->currentChar;
                $this->advance();
            }
            
            if ($this->currentChar !== ')') {
                throw new Exception("v() 运算符缺少右括号");
            }
            
            $this->advance(); // 跳过 ')'
            
            if ($this->currentChar !== '}') {
                throw new Exception("变量引用后必须是 }");
            }
            
            $this->advance(); // 跳过 }
            return 'v(' . $varName . ')';
        }
        
        // 原有的变量处理逻辑
        while ($this->currentChar !== null && $this->currentChar !== '}') {
            $result .= $this->currentChar;
            $this->advance();
        }
        
        if ($this->currentChar !== '}') {
            throw new Exception("语法错误：变量标识符未闭合");
        }
        
        $this->advance(); // 跳过结束的 }
        return $result;
    }

    private function string() {
        $quote = $this->currentChar; // 保存引号类型（单引号或双引号）
        $this->advance(); // 跳过开始的引号
        $result = '';
        
        while ($this->currentChar !== null && $this->currentChar !== $quote) {
            if ($this->currentChar === '\\') {
                $this->advance();
                switch ($this->currentChar) {
                    case 'n': $result .= "\n"; break;
                    case 't': $result .= "\t"; break;
                    case 'r': $result .= "\r"; break;
                    default: $result .= $this->currentChar; // 包括 \\ \' \"
                }
            } else {
                $result .= $this->currentChar;
            }
            $this->advance();
        }
        
        if ($this->currentChar !== $quote) {
            throw new Exception("语法错误：字符串未闭合");
        }
        
        $this->advance(); // 跳过结束的引号
        return $result;
    }

    public function getNextToken() {
        while ($this->currentChar !== null) {
            if (ctype_space($this->currentChar)) {
                $this->skipWhitespace();
                continue;
            }

            // 添加对 && 和 || 的识别
            if ($this->currentChar === '&' && $this->peek() === '&') {
                $this->advance();
                $this->advance();
                return new Token('AND', '&&');
            }

            if ($this->currentChar === '|' && $this->peek() === '|') {
                $this->advance();
                $this->advance();
                return new Token('OR', '||');
            }

            if (ctype_digit($this->currentChar)) {
                return new Token('NUMBER', $this->number());
            }

            switch ($this->currentChar) {
                case '+':
                    $this->advance();
                    return new Token('PLUS', '+');
                case '-':
                    $this->advance();
                    return new Token('MINUS', '-');
                case '*':
                    $this->advance();
                    return new Token('MULTIPLY', '*');
                case '/':
                    $this->advance();
                    return new Token('DIVIDE', '/');
                case '(':
                    $this->advance();
                    return new Token('LPAREN', '(');
                case ')':
                    $this->advance();
                    return new Token('RPAREN', ')');
                case '^':
                    $this->advance();
                    return new Token('POWER', '^');
                case '%':
                    $this->advance();
                    return new Token('MOD', '%');
                case '?':
                    $this->advance();
                    return new Token('QUESTION', '?');
                case ':':
                    $this->advance();
                    return new Token('COLON', ':');
                case '>':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return new Token('GTE', '>=');
                    }
                    return new Token('GT', '>');
                case '<':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return new Token('LTE', '<=');
                    }
                    return new Token('LT', '<');
                case '=':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return new Token('EQ', '==');
                    }
                    throw new Exception("无效字符: =");
                case '!':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return new Token('NEQ', '!=');
                    }
                    throw new Exception("无效字符: !");
                case '{':
                    return new Token('VARIABLE', $this->variable());
                case '"':
                case "'":
                    return new Token('STRING', $this->string());
                default:
                    throw new Exception("无效字符: " . $this->currentChar);
            }
        }
        return new Token('EOF', null);
    }

    // 添加一个辅助方法来查看下一个字符
    private function peek() {
        $peekPos = $this->position + 1;
        if ($peekPos >= strlen($this->input)) {
            return null;
        }
        return $this->input[$peekPos];
    }
}

class Parser {
    private $lexer;
    private $currentToken;

    public function __construct($lexer) {
        $this->lexer = $lexer;
        $this->currentToken = $this->lexer->getNextToken();
    }

    private function eat($tokenType) {
        if ($this->currentToken->type === $tokenType) {
            $this->currentToken = $this->lexer->getNextToken();
        } else {
            throw new Exception("语法错误");
        }
    }

    private function factor() {
        $token = $this->currentToken;
        
        if ($token->type === 'MINUS') {
            $this->eat('MINUS');
            return -$this->factor();
        }
        
        if ($token->type === 'NUMBER') {
            $this->eat('NUMBER');
            return $token->value;
        } elseif ($token->type === 'STRING') {
            $this->eat('STRING');
            return $token->value;
        } elseif ($token->type === 'LPAREN') {
            $this->eat('LPAREN');
            $result = $this->expr();
            $this->eat('RPAREN');
            return $result;
        } elseif ($token->type === 'VARIABLE') {
            $varName = $token->value;
            $this->eat('VARIABLE');
            
            // 处理 v() 运算符
            if (strpos($varName, 'v(') === 0) {
                $innerVarName = substr($varName, 2, -1); // 去掉 v( 和 )
                // 如果内部是变量引用，先解析变量
                if (strpos($innerVarName, '{') === 0 && substr($innerVarName, -1) === '}') {
                    $innerVarName = substr($innerVarName, 1, -1);
                }
                // 只获取一次变量值，不进行嵌套解析
                return VariableStore::get($innerVarName);
            }
            
            // 处理 eval
            if (strpos($varName, 'eval(') === 0) {
                $expr = substr($varName, 5, -1);
                return calculate($expr);
            }
            
            return VariableStore::get($varName);
        }
        
        throw new Exception("语法错误：意外的标记 " . $token->type);
    }

    private function power() {
        $result = $this->factor();

        while ($this->currentToken->type === 'POWER') {
            if (is_string($result)) {
                throw new Exception("不能对字符串执行幂运算");
            }
            $this->eat('POWER');
            $exponent = $this->factor();
            if (is_string($exponent)) {
                throw new Exception("不能使用字符串作为幂");
            }
            $result = pow($result, $exponent);
        }

        return $result;
    }

    private function term() {
        $result = $this->power();

        while (in_array($this->currentToken->type, ['MULTIPLY', 'DIVIDE', 'MOD'])) {
            if (is_string($result)) {
                throw new Exception("不能对字符串执行乘除或取模运算");
            }
            
            $token = $this->currentToken;
            if ($token->type === 'MULTIPLY') {
                $this->eat('MULTIPLY');
                $nextFactor = $this->power();
                if (is_string($nextFactor)) {
                    throw new Exception("不能对字符串执行乘法运算");
                }
                $result *= $nextFactor;
            } elseif ($token->type === 'DIVIDE') {
                $this->eat('DIVIDE');
                $divisor = $this->power();
                if (is_string($divisor)) {
                    throw new Exception("不能用字符串作为除数");
                }
                if ($divisor == 0) {
                    throw new Exception("除数不能为零");
                }
                $result /= $divisor;
            } elseif ($token->type === 'MOD') {
                $this->eat('MOD');
                $modulus = $this->power();
                if (is_string($modulus)) {
                    throw new Exception("不能用字符串作为取模数");
                }
                $result %= $modulus;
            }
        }

        return $result;
    }

    private function comparison() {
        $result = $this->term();

        while (in_array($this->currentToken->type, ['GT', 'LT', 'GTE', 'LTE', 'EQ', 'NEQ'])) {
            $token = $this->currentToken;
            $this->eat($token->type);
            $right = $this->term();
            
            switch ($token->type) {
                case 'GT':
                    $result = $result > $right;
                    break;
                case 'LT':
                    $result = $result < $right;
                    break;
                case 'GTE':
                    $result = $result >= $right;
                    break;
                case 'LTE':
                    $result = $result <= $right;
                    break;
                case 'EQ':
                    $result = $result == $right;
                    break;
                case 'NEQ':
                    $result = $result != $right;
                    break;
            }
        }

        return $result;
    }

    private function logical() {
        $result = $this->comparison();  // 先处理比较运算

        while (in_array($this->currentToken->type, ['AND', 'OR'])) {
            $token = $this->currentToken;
            $this->eat($token->type);
            $right = $this->comparison();
            
            switch ($token->type) {
                case 'AND':
                    $result = ($result && $right);
                    break;
                case 'OR':
                    $result = ($result || $right);
                    break;
            }
        }

        return $result;
    }

    private function ternary() {
        $result = $this->logical();  // 先处理逻辑运算

        if ($this->currentToken->type === 'QUESTION') {
            $this->eat('QUESTION');
            $trueExpr = $this->expr();
            
            if ($this->currentToken->type !== 'COLON') {
                throw new Exception("语法错误：缺少冒号");
            }
            
            $this->eat('COLON');
            $falseExpr = $this->expr();
            
            return $result ? $trueExpr : $falseExpr;
        }

        return $result;
    }

    public function expr() {
        $result = $this->ternary();  // 改为从三元运算符开始
        return $result;
    }
}



function processObjectReference($op,$sid, $oid, $mid,$jid,$type,$para=null) {
        $db = DB::conn();
        if (preg_match('/^([uomceg])\.(.+)$/', $op, $matches)){
        $attr1 = $matches[1];
        $attr2 = $matches[2];
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
                    if ($row_result === null ||$row_result ==='') {
                        //$op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row_result);
                        }

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
                    if ($op === null||$op =='') {
                        //$op = "\"\""; // 或其他默认值
                        }
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
                    if ($op === null||$op =='') {
                        //$op = "\"\""; // 或其他默认值
                        }
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
                    if ($op === null||$op =='') {
                        //$op = "\"\""; // 或其他默认值
                        }
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
                    if ($op === null||$op =='') {
                        //$op = "\"\""; // 或其他默认值
                        }
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
                    if(is_null($op)){
                        //$op = "\"\"";
                    }else{
                        if($ttype ==3){
                        $op = 2;
                        }
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
                    if(is_null($op)){
                        //$op = "\"\"";
                    }
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
                    if(is_null($op)){
                        //$op = "\"\"";
                    }
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
                    if(is_null($op)){
                        //$op = "\"\"";
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
                    if(is_null($op)){
                        //$op = "\"\"";
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
                        if(!$op){
                            //$op = "\"\"";
                        }else{
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
                        }
    
                    }
                    elseif(preg_match('/^(\d+\.)?(.*)/', $attr3, $matches)){
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
                        if(!$op){
                            //$op = "\"\"";
                        }else{
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
                        if(!$op){
                            //$op = "\"\"";
                        }
    
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
                        if ($row === null||$row =='') {
                            //$op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$xid]);
                        }
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
                        
                        if ($row === null||$row =='') {
                            //$op = "\"\""; // 或其他默认值
                        }else{
                            $op = nl2br($row[$pid]);
                        }
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
                    if ($row === null||$row =='') {
                        //$op = "\"\""; // 或其他默认值
                        }else{
                            if($attr_type !=1){
                    $op = nl2br($row[$attr3]);
                            }else{
                    $op = nl2br($row['value']);
                            }
                        }

                    // 替换字符串中的变量
                    }
                    break;
                    }
                    break;
                case 'ut':
                    switch($attr2){
                        case 'is_computer':
                        $userAgent = $_SERVER['HTTP_USER_AGENT'];
                        if (strpos($userAgent, 'Mobile') !== false) {
                            // 用户正在使用移动设备（手机或平板）
                            //$op = "\"\"";
                        } else {
                            // 用户正在使用桌面设备（电脑）
                            $op = 1;
                        }
                            break;
                        case 'fight_show_cut':
                        $sql = "SELECT ucmd FROM game1 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($row){
                        $ucmd = $row["ucmd"];
                        }
                            if($ucmd =="pve_fighting"){
                                $op = 1;
                            }else{
                                $op = 0;
                            }
        
                            break;
                        case 'cut_hp':
                        $db = DB::conn();
                        $round = \player\getnowround($sid,$dblj,$db);
                        // 构建 SQL 查询语句
                        $sql = "SELECT SUM(cut_hp) AS total_cut_hp FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        
                        // 关闭第一个查询的结果集
                        $stmt->close();
                        
                        // 获取总和并处理结果
                        $total_cut_hp = $row["total_cut_hp"];
                        $op = $total_cut_hp;
                        if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
                            }
    
                        break;
                        case 'cut_mp':
                        $db = DB::conn();
                        $round = \player\getnowround($sid,$dblj,$db);
                        // 构建 SQL 查询语句
                        $sql = "SELECT SUM(cut_mp) as total_cut_mp FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        
                        // 关闭第一个查询的结果集
                        $stmt->close();
                        
                        // 获取总和并处理结果
                        $total_cut_mp = $row["total_cut_mp"];
                        
                        $op = $total_cut_mp;
                        
                        if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
                            }
    
                        break;
                        case 'busy':
                        $sql = "SELECT attr_value FROM player_temp_attr WHERE obj_id = ? and obj_type = 1 and attr_name = 'busy'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        if($row){
                        $op = $row["attr_value"];
                        }
                        if ($op === null||$op =='') {
                            $op = "0"; // 或其他默认值
                            }
    
                        break;
                        case 'fight_umsg':
                        $dblj = DB::pdo();
                        $round = \player\getnowround($sid,$dblj);
                        $sql = "SELECT fight_umsg FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                        $op .= $row["fight_umsg"];
                        }
                        if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($op);
                            }
    
                        break;
                        case 'fight_omsg':
                        $dblj = DB::pdo();
                        $round = \player\getnowround($sid,$dblj);
                        $sql = "SELECT fight_omsg FROM game2 WHERE sid = ? and pid = 0 and round = '$round'";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                        $op .= $row["fight_omsg"];
                        }
                        if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($op);
                            }
    
                        break;
                    }
                    break;
                case 'ot':
                    switch($attr2){
                        case 'is_computer':
                        $sql = "SELECT sfzx from game1 where sid = ?";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $sfzx = $row["sfzx"];
                        if($sfzx ==1){
                        $sql = "SELECT device_agent FROM game4 WHERE sid = ?";
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $mid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $userAgent = $row["device_agent"];
                        if (strpos($userAgent, 'Mobile') !== false) {
                            // 用户正在使用移动设备（手机或平板）
                            //$op = "\"\"";
                        } else {
                            // 用户正在使用桌面设备（电脑）
                            $op = 1;
                        }
                        }else{
                            // 用户离线
                            $op = 2;
                        }
                            break;
                        case 'cut_hp':
                        // 构建 SQL 查询语句
                        $sql = "SELECT * FROM game2 WHERE sid = ?";
                        
                        // 使用预处理语句
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("s", $sid);
                        
                        // 执行查询
                        $stmt->execute();
                        
                        // 获取查询结果
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $op = $row["hurt_hp"];
                        if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
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
                                if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
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
                            if ($row == null||$row =='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                            if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
                            }
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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
                            
                            
                            if ($row == null||$row =='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                            if ($attr2 == "is_adopt") {
                                $op = $row['ncan_shouyang'];
                            } 
                                }
                            if ($op === null||$op =='') {
                            //$op = "\"\""; // 或其他默认值
                            }
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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

                            if ($row_result === null ||$row_result ==='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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

                            if ($row_result === null ||$row_result ==='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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

                            if ($row_result === null ||$row_result ==='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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
                            if ($row_result === null ||$row_result ==='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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
                            if ($row_result === null ||$row_result ==='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
        
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
                            if ($row_result === null ||$row_result ==='') {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row_result);
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
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
                            if ($row == null) {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                                    if($attr_type !=1){
                            $op = nl2br($row[$attr3]);
                                    }else{
                            $op = nl2br($row['value']);
                                    }
                                }
                                if($op ==''){
                                    //$op = "\"\"";
                                }
        
                            // 替换字符串中的变量
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
                            if ($row === null) {
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
        
                            // 替换字符串中的变量
                            //$input = str_replace("{{$match}}", $op, $input);
                            break;
                    }
                    break;
                case 'm':
                    if($para !=1){
                    switch($type){
                    case 'fight':
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl" ||$attr3 == "jpoint" ||$attr3=="jdefault"){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ?";
                            if($oid =='skill_pet'){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = '$mid'";
                            }
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("ss", $jid,$sid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if (!$result) {
                                die('查询失败: ' . $db->error);
                            }
                            $row = $result->fetch_assoc();
                            $row_result = $row[$attr3];
                        }else{
                            // 首先从 system_skill 表中查询
                            $sql = "SELECT $attr3 FROM system_skill WHERE jid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $jid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            $row_result = null; // 初始化结果
                            
                            if ($result && $result->num_rows > 0) {
                                // 如果 system_skill 表中有数据
                                $row = $result->fetch_assoc();
                                if (!empty($row[$attr3])) {
                                    $row_result = $row[$attr3]; // 获取 $attr3 字段的值
                                }
                            }
                            $exclude_attr = in_array($attr3,['jname','jid','jdesc','joccasion','jimage','jhurt_mod','jgroup_attack']);
                            // 如果 $row_result 仍然为 null，查询 system_skill_module 表
                            if ($row_result === null&&!$exclude_attr) {
                                $sql = "SELECT $attr3 FROM system_skill_module WHERE jid = 2";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            
                                if ($result && $result->num_rows > 0) {
                                    // 如果 system_skill_module 表中有数据
                                    $row = $result->fetch_assoc();
                                    if (!empty($row[$attr3])) {
                                        $row_result = $row[$attr3]; // 获取 $attr3 字段的值
                                    }
                                }
                            }
                        }
                        
                        if ($row_result === null ||$row_result ==='') {
                            //$op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($row_result);
                            }
                        //功能表达式处理方式
                        if($attr3 == 'jpromotion'){
    
                        $op = str_replace(array("'",), '', $op);
                        $op = @eval("return $op;");
                        }
    
                        if($attr3 == "jgroup_attack"){
                            if($row_result == -1){
                                $op = "群体";
                            }elseif ($row_result == 1) {
                                $op = "单体";
                            }
                        }elseif($attr3 =="jhurt_attr" || $attr3 =="jdeplete_attr"){
                            // 查询获取 name 字段值
                        $query = "SELECT name FROM gm_game_attr WHERE value_type = 1 AND id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->bind_param("s", $row_result);  // 绑定字符串型参数
                        $stmt->execute();
                        $stmt->bind_result($op);  // 绑定结果到 $op 变量
                        $stmt->fetch();
                        // 释放查询结果
                        $stmt->free_result();
                        }
                        
                        // 替换字符串中的变量
                        //$input = str_replace("{{$match}}", $op, $input);
                        break;
                        default:
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl" ||$attr3 == "jpoint"||$attr3 =="jdefault"){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ?";
                            if($oid =='skill_pet'){
                            $sql = "SELECT * FROM system_skill_user WHERE jid = ? and jsid = ? and jpid = '$mid'";
                            }
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("ss", $jid,$sid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        }else{
                            $sql = "SELECT * FROM system_skill WHERE jid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $jid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        }
                        if (!$result) {
                            die('查询失败: ' . $db->error);
                        }
                        $row = $result->fetch_assoc();
                        $row_result = $row[$attr3];
                        if ($row_result === null ||$row_result ==='') {
                            //$op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($row_result);
                            }
    
                        if($attr3 == "jgroup_attack"){
                            if($row_result == -1){
                                $op = "群体";
                            }elseif ($row_result == 1) {
                                $op = "单体";
                            }
                        }elseif($attr3 =="jhurt_attr" || $attr3 =="jdeplete_attr"){
                            // 查询获取 name 字段值
                        $query = "SELECT name FROM gm_game_attr WHERE value_type = 1 AND id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->bind_param("s", $row_result);  // 绑定字符串型参数
                        $stmt->execute();
                        $stmt->bind_result($op);  // 绑定结果到 $op 变量
                        $stmt->fetch();
                        // 释放查询结果
                        $stmt->free_result();
                        }
                            
                        break;
                    }
                    }elseif($para ==1){
                        $attr3 = 'j'.$attr2;
                        if($attr3 =="jlvl"){
                            $sql = "SELECT * FROM system_npc_midguaiwu WHERE ngid = ?";
                            $stmt = $db->prepare($sql);
                            $stmt->bind_param("s", $oid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $row_result = $row['nskills'];
                            $monster_skills_lvl = explode(',',$row_result);
                        }else{
                            $sql = "SELECT * FROM system_skill WHERE jid = ?";
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
                        if($para !=1){
                        $row_result = $row[$attr3];
                        }
                        if ($row_result === null ||$row_result ==='') {
                            //$op = "\"\""; // 或其他默认值
                            }else{
                        $op = nl2br($row_result);
                            }
    
                    }
                    break;
                case 'c':
                    switch($attr2){
                        case 'time':
                            $op = date('U');
                            break;
                        case 'day':
                            $op = date('N');
                            break;
                        case 'year':
                            $op = date('Y');
                            break;
                        case 'month':
                            $op = date('n');
                            break;
                        case 'date':
                            $op = date('j');
                            break;
                        case 'hour':
                            $op = date('G');
                            break;
                        case 'minute':
                            $op = 1 * date('i');
                            break;
                        case 'second':
                            $op = 1 *date('s');
                            break;
                        case 'online_user_count':
                            $query = "SELECT COUNT(*) FROM game1 WHERE sfzx = 1";
                        
                            // 执行查询语句并获取结果
                            $result = $db->query($query);
                        
                            // 获取行数
                            $op = $result->fetch_row()[0];
                            break;
                            default:
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
                                //$op = "\"\""; // 或其他默认值
                                }else{
                            $op = nl2br($row[$attr3]);
                                }
                                
                                
                        }
                    // 使用正则表达式匹配字符串中的时间格式部分
                    $pattern = '/nowtime_([UNYnjGHhist:]+)/';
                    if (preg_match($pattern, $attr2, $matches)) {
                        // 获取当前时间，并根据格式解析为具体时间信息
                        $op = date($matches[1]);
                    }

                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'g':
                    $sql = "SELECT gvalue FROM global_data where gid = '$attr2'";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        die('查询失败: ' . $db->error);
                    }
                    $row = $result->fetch_assoc();
                    if ($row === null) {
                        //$op = "\"\""; // 或其他默认值
                        }else{
                    $op = nl2br($row['gvalue']);
                        }

                    // 替换字符串中的变量
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'e':
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
                    $e_type = $row['type'];
                    // 替换字符串中的变量
                    if($e_type ==1){
                    
                    //$op = str_replace(array("'"), '', $op);
                    //$op = @eval("return $op;");
                    $op = $op?"'".$op."'":"''";
                    }elseif($e_type ==2){
                    $op = str_replace(array("'"), '', $op);
                    $op = $op?"'".$op."'":"''";
                    //$op = @eval("return $op;");
                    }elseif($e_type ==3){
                    $op = str_replace(array("'"), '', $op);
                    $op = $op?"'".$op."'":"''";
                    //$op = @eval("return $op;");
                    //$op = @eval("return $op;");
                    }
                    //$input = str_replace("{{$match}}", $op, $input);
                    break;
                case 'r':
                    if(!is_numeric($attr2)){
                        $attr2 = "{".$attr2."}";
                    }
                    $attr2 = process_string($attr2,$sid,$oid,$mid,$jid,$type,$para);
                    if(intval($attr2) <=0){
                    $attr2 = 1;
                    }
                    $op = rand(0, intval($attr2) - 1); // 生成随机整数
                    //$op = "\"$op\"";
                    break;
                case 'gph':
                    $attr_para = explode(".","$attr2");
                    $attr_id = $attr_para[0];
                    $attr_pos = $attr_para[1];
                    $attr_attr = $attr_para[2];
                    // 提取获取排名数据的函数
                    if (!function_exists('lexical_analysis\getRankData')){
                    function getRankData($db) {
                        $sql = "SELECT * FROM system_rank";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                        if (!$result) {
                            die('查询失败: ' . $db->error);
                        }
                    
                        $rankData = [];
                        while ($row = $result->fetch_assoc()) {
                            $rankData[] = $row;
                        }
                    
                        return $rankData;
                    }
                    }
                    
                    // 提取获取用户数据的函数
                    if (!function_exists('lexical_analysis\getUserData')){
                    function getUserData($db, $rankExp, $showCond) {
                        $sql = "SELECT uname, sid,uid FROM game1";
                        $cxjg = $db->query($sql);
                    
                        if (!$cxjg) {
                            die('查询失败: ' . $db->error);
                        }
                    
                        $userData = [];
                        while ($row = $cxjg->fetch_assoc()) {
                            $userSid = $row['sid'];
                            $userExp = (int)process_string($rankExp, $userSid);
                            $userShowCond = checkTriggerCondition($showCond, $db, $userSid);
                    
                            if (is_null($userShowCond)) {
                                $userShowCond = 1;
                            }
                    
                            if ($userShowCond) {
                                $user_name = $row['uname'];
                                $userUid = $row['uid'];
                                $userData[] = [
                                    'score' => $userExp,
                                    'id' => $userUid,
                                    'name' => $user_name
                                ];
                            }
                        }
                    
                        return $userData;
                    }
                    }
                    // 获取排名数据
                    $rankData = getRankData($db);
                    
                    $counter = 0;
                    foreach ($rankData as $row) {
                        $rankExp = $row['rank_exp'];
                        $show_cond = $row['show_cond'];
                        $userData = getUserData($db, $rankExp, $show_cond);
                        usort($userData, function ($a, $b) {
                            return $b['score'] - $a['score'];
                        });

                        if ($attr_id == $counter) {
                            $op = isset($userData[$attr_pos][$attr_attr]) ? $userData[$attr_pos][$attr_attr] : 0;
                        }
                        $counter++;
                    }
                    $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                    break;
                    case 'gphn':
                        $attr_para = explode(".", "$attr2");
                        $attr_name = $attr_para[0];
                        $attr_pos = $attr_para[1];
                        $attr_attr = $attr_para[2];
                    
                        // 缓存的键名
                        $rankCacheKey = "rankData_$attr_name";
                        $userCacheKey = "userData_$attr_name";
                    
                        // 提取获取排名数据的函数
                        if (!function_exists('lexical_analysis\getRankData2')) {
                            function getRankData2($db, $rank_name) {
                                $sql = "SELECT * FROM system_rank where rank_name = '$rank_name'";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            
                                if (!$result) {
                                    die('查询失败: ' . $db->error);
                                }
                            
                                $rankData = [];
                                while ($row = $result->fetch_assoc()) {
                                    $rankData[] = $row;
                                }
                            
                                return $rankData;
                            }
                        }
                    
                        // 提取获取用户数据的函数
                        if (!function_exists('lexical_analysis\getUserData2')) {
                            function getUserData2($db, $rankExp, $showCond) {
                                $sql = "SELECT uname, sid, uid FROM game1";
                                $cxjg = $db->query($sql);
                            
                                if (!$cxjg) {
                                    die('查询失败: ' . $db->error);
                                }
                            
                                $userData = [];
                                while ($row = $cxjg->fetch_assoc()) {
                                    $userSid = $row['sid'];
                                    $userExp = (int)process_string($rankExp, $userSid);
                                    $userShowCond = checkTriggerCondition($showCond, $db, $userSid);
                            
                                    if (is_null($userShowCond)) {
                                        $userShowCond = 1;
                                    }
                            
                                    if ($userShowCond) {
                                        $user_name = $row['uname'];
                                        $userUid = $row['uid'];
                                        $userData[] = [
                                            'score' => $userExp,
                                            'id' => $userUid,
                                            'name' => $user_name
                                        ];
                                    }
                                }
                            
                                return $userData;
                            }
                        }
                    
                        // 从缓存获取排名数据
                        $rankData = Cache::get($rankCacheKey);
                        if ($rankData === false) {
                            $rankData = getRankData2($db, $attr_name);
                            Cache::set($rankCacheKey, $rankData, 1); // 缓存1秒
                        }
                    
                        foreach ($rankData as $row) {
                            $rankExp = $row['rank_exp'];
                            $show_cond = $row['show_cond'];
                            
                            // 从缓存获取用户数据
                            $userData = Cache::get($userCacheKey);
                            if ($userData === false) {
                                $userData = getUserData2($db, $rankExp, $show_cond);
                                Cache::set($userCacheKey, $userData, 1); // 缓存1秒
                            }
                    
                            usort($userData, function ($a, $b) {
                                return $b['score'] - $a['score'];
                            });
                            $op = $userData[$attr_pos][$attr_attr] ?? 0;
                        }
                        $op = process_string($op, $sid, $oid, $mid, $jid, $type, $para);
                        break;
                default:
                    return 0;
                    break;
            }
    // 在这里根据属性的不同进行处理
    // ...
    // 返回属性值，处理过程中可能会嵌套调用 process_string
    return $op;
}




function calculate($expression, $sid = null, $oid = null, $mid = null, $jid = null, $type = null, $para = null) {
    try {
        // 检查是否是带花括号的赋值语句（这种语法不再支持）
        if (preg_match('/^\s*\{[^}]+\}\s*=/', $expression)) {
            throw new Exception("无效的赋值语句，变量名不应该包含花括号");
        }

        // 处理数组特殊操作的赋值和删除
        if (preg_match('/^\s*arr\.(create|set|put|del)\(([^)]+)\)(?:\.(\d+))?\s*(?:=\s*(.+))?$/', $expression, $matches)) {
            $operation = $matches[1];
            $arrayName = $matches[2];
            $index = isset($matches[3]) ? $matches[3] : null;
            $valueExpr = isset($matches[4]) ? $matches[4] : null;
            
            // 如果数组名中包含花括号，先解析它
            if (strpos($arrayName, '{') !== false) {
                throw new Exception("无效的赋值语句，数组名不应该包含花括号");
            }
            
            // 如果是 put 操作
            if ($operation === 'put' && $valueExpr !== null) {
                $value = calculate($valueExpr, $sid, $oid, $mid, $jid, $type, $para);
                $varName = "arr.put($arrayName)";
                return VariableStore::set($varName, $value);
            }
            
            // 如果是删除操作
            if ($operation === 'del') {
                $varName = "arr.del($arrayName)" . ($index !== null ? ".$index" : "");
                return VariableStore::set($varName, null);
            }
            
            // 如果是 create 操作，解析数组值
            if ($operation === 'create') {
                if (!preg_match('/^\[(.*)\]$/', $valueExpr, $arrayMatches)) {
                    throw new Exception("create 操作需要数组值");
                }
                
                $elements = $arrayMatches[1];
                $values = [];
                if (!empty($elements)) {
                    $elements = explode(',', $elements);
                    foreach ($elements as $element) {
                        $element = trim($element);
                        $values[] = calculate($element, $sid, $oid, $mid, $jid, $type, $para);
                    }
                }
                
                $varName = "arr.create($arrayName)";
                VariableStore::set($varName, $values);
                return implode(', ', $values);
            }
            
            // 处理其他操作
            $value = calculate($valueExpr, $sid, $oid, $mid, $jid, $type, $para);
            $varName = "arr.$operation($arrayName)" . ($index !== null ? ".$index" : "");
            return VariableStore::set($varName, $value);
        }
        
        // 处理数组元素访问
        if (preg_match('/^\s*arr\.get\(([^)]+)\)\.(\d+)\s*$/', $expression, $matches)) {
            $arrayName = $matches[1];
            $index = (int)$matches[2];
            
            // 解析数组名（可能包含变量引用）
            if (strpos($arrayName, '{') === 0 && substr($arrayName, -1) === '}') {
                $arrayName = calculate(substr($arrayName, 1, -1), $sid, $oid, $mid, $jid, $type, $para);
            }
            
            return VariableStore::get("arr.get($arrayName).$index");
        }

        // 检查是否是赋值表达式（不带花括号）
        if (preg_match('/^\s*([a-zA-Z][a-zA-Z0-9_.]*(?:\s*\.\s*v\([^)]+\))?)\s*=\s*(.+)$/', $expression, $matches)) {
            $varName = $matches[1];
            $expression = $matches[2];
            
            // 如果变量名中包含 v()，需要先解析它
            if (strpos($varName, 'v(') !== false) {
                preg_match('/(.+)\.v\(([^)]+)\)/', $varName, $vMatches);
                if ($vMatches) {
                    $prefix = $vMatches[1];
                    $innerVar = $vMatches[2];
                    if (preg_match('/^\{([^}]+)\}$/', $innerVar, $bracketMatches)) {
                        $innerVar = $bracketMatches[1];
                    }
                    $varName = $prefix . '.' . VariableStore::get($innerVar);
                }
            }
            
            $lexer = new Lexer($expression);
            $parser = new Parser($lexer);
            $result = $parser->expr();
            
            VariableStore::set($varName, $result);
            return $result;
        }
        
        // 处理 eval 表达式
        if (preg_match('/^\{eval\((.*)\)\}$/', $expression, $matches)) {
            $innerExpr = $matches[1];
            // 先处理内部的变量引用
            $innerExpr = preg_replace_callback(
                '/\{([^}]+)\}/',
                function($matches) use ($sid, $oid, $mid, $jid, $type, $para) {
                    $varName = $matches[1];
                    // 先通过 processObjectReference 处理对象引用
                    $processedName = processObjectReference($varName, $sid, $oid, $mid, $jid, $type, $para);
                    
                    // 如果 processObjectReference 返回的不是原始表达式，说明是对象引用的结果
                    if ($processedName !== $varName) {
                        return $processedName;  // 直接返回处理结果
                    }
                    
                    $value = VariableStore::get($processedName);
                    if (is_string($value)) {
                        return "'" . addslashes($value) . "'";
                    }
                    return $value;
                },
                $innerExpr
            );
            
            // 处理 v() 操作符
            $innerExpr = preg_replace_callback(
                '/v\(([^)]+)\)/',
                function($matches) use ($sid, $oid, $mid, $jid, $type, $para) {
                    $varName = trim($matches[1]);
                    
                    // 检查是否是对象引用（如 c.hour）
                    if (preg_match('/^([uomceg])\.(.+)$/', $varName, $objMatches)) {
                        // 直接处理对象引用，不需要再通过 VariableStore::get
                        $processedValue = processObjectReference($varName, $sid, $oid, $mid, $jid, $type, $para);
                        return $processedValue;
                    }
                    
                    // 如果不是对象引用，按原来的方式处理
                    $processedName = processObjectReference($varName, $sid, $oid, $mid, $jid, $type, $para);
                    $value = VariableStore::get($processedName);
                    if (is_string($value)) {
                        return "'" . addslashes($value) . "'";
                    }
                    return $value;
                },
                $innerExpr
            );
            
            return calculate($innerExpr, $sid, $oid, $mid, $jid, $type, $para);
        }
        
        // 处理 v() 操作符
        if (preg_match('/^\{v\(([^)]+)\)\}$/', $expression, $matches)) {
            $varName = trim($matches[1]);
            if (preg_match('/^\{([^}]+)\}$/', $varName, $bracketMatches)) {
                $varName = $bracketMatches[1];
            }
            return VariableStore::get(VariableStore::get($varName));
        }
        
        // 处理表达式中的变量引用
        $expression = preg_replace_callback(
            '/\{([^}]+)\}/',
            function($matches) use ($sid, $oid, $mid, $jid, $type, $para) {
                $varName = $matches[1];
                // 先通过 processObjectReference 处理对象引用
                $processedName = processObjectReference($varName, $sid, $oid, $mid, $jid, $type, $para);
                
                if (strpos($processedName, 'eval(') === 0) {
                    $innerExpr = substr($processedName, 5, -1);
                    return calculate("{eval($innerExpr)}", $sid, $oid, $mid, $jid, $type, $para);
                } elseif (strpos($processedName, 'v(') === 0) {
                    $innerVar = substr($processedName, 2, -1);
                    // 处理 v() 中的对象引用
                    $processedInner = processObjectReference($innerVar, $sid, $oid, $mid, $jid, $type, $para);
                    return VariableStore::get(VariableStore::get($processedInner));
                }
                
                // 如果 processObjectReference 返回的不是原始表达式，说明是对象引用的结果
                if ($processedName !== $varName) {
                    return $processedName;  // 直接返回处理结果
                }
                
                // 如果是原始表达式，当作普通变量处理
                $value = VariableStore::get($processedName);
                if (is_string($value)) {
                    return "'" . addslashes($value) . "'";
                }
                return $value;
            },
            $expression
        );
        
        // 处理 v() 操作符
        $expression = preg_replace_callback(
            '/v\(([^)]+)\)/',
            function($matches) use ($sid, $oid, $mid, $jid, $type, $para) {  // 添加 use 语句
                $varName = trim($matches[1]);
                
                // 检查是否是对象引用（如 c.hour）
                if (preg_match('/^([uomceg])\.(.+)$/', $varName, $objMatches)) {
                    // 直接处理对象引用，不需要再通过 VariableStore::get
                    $processedValue = processObjectReference($varName, $sid, $oid, $mid, $jid, $type, $para);
                    return $processedValue;
                }
                
                // 如果不是对象引用，按原来的方式处理
                $processedName = processObjectReference($varName, $sid, $oid, $mid, $jid, $type, $para);
                $value = VariableStore::get($processedName);
                if (is_string($value)) {
                    return "'" . addslashes($value) . "'";
                }
                return $value;
            },
            $expression
        );
        
        $lexer = new Lexer($expression);
        $parser = new Parser($lexer);
        return $parser->expr();
    } catch (Exception $e) {
        return "错误: " . $e->getMessage();
    }
}

// 测试代码
$tests = [
    "3 + 4",
    "2 * 3 + 4",
    "2 + 3 * 4",
    "(2 + 3) * 4",
    "10 / 2 + 3",
    "1 + 2 + 3 * 4 / 2",
    "2 ^ 3",         // 幂运算
    "10 % 3",        // 取模运算
    "-5 + 3",        // 一元负号
    "2.5e-3 * 1000", // 科学记数法
    "2 ^ -2",        // 负数幂
    "-(3 + 2)",      // 括号内一元负号
    "1 ? 2 : 3",     // 结果应该是 2
    "0 ? 2 : 3",     // 结果应该是 3
    "5 > 3 ? 1 : 0", // 结果应该是 1
    "2 + (1 ? 4 : 5)",// 结果应该是 6
    "5 < 3 ? 1 : 0",       // 结果应该是 0
    "5 >= 5 ? 1 : 0",      // 结果应该是 1
    "4 <= 3 ? 1 : 0",      // 结果应该是 0
    "5 == 5 ? 1 : 0",      // 结果应该是 1
    "5 != 5 ? 1 : 0",      // 结果应该是 0
    "2 + 3 > 4 ? 1 : 0",   // 结果应该是 1
    "a = 5",                         // 新的变量赋值语法
    "b = 10",                        // 新的变量赋值语法
    "c = a + b",                     // 使用变量进行计算
    "name = 'value'",                // 字符串赋值
    "pointer = 'name'",              // 设置指向变量名的变量
    "u = 'parent'",                  // 设置普通变量
    "u.a = 'child'",                 // 设置对象属性
    "u.b = 'another'",               // 设置另一个属性
    "o.b = 'test'",                  // 设置另一个对象的属性
    "u.x.y = 'nested'",              // 嵌套属性设置
    "u.v(pointer) = 'dynamic'",      // 动态属性设置
    "2 * ({a} + {b})",       // 变量在复杂表达式中
    "{d}",                    // 未定义变量
    "'Hello, World!'",                    // 简单字符串
    '"Hello, World!"',                    // 双引号字符串
    "{str} = 'Hello'",                    // 字符串赋值给变量
    "{str} + ' World'",                   // 字符串连接
    "'Hello' + ' ' + 'World'",            // 多个字符串连接
    "'特殊字符: \\n\\t\\\\'",             // 转义字符
    "\"双引号中的'单引号'\"",              // 引号嵌套
    "'数字和字符串：' + 123",              // 字符串和数字混合
    "{eval(2 + 3)}",                    // 简单的 eval
    "{eval(1 + 2 * 3)}",               // 复杂的 eval
    "{x} = 5",                         // 设置变量
    "{eval({x} + 3)}",                // eval 中使用变量
    "{eval(2 > 1 ? 10 : 20)}",        // eval 中使用条件表达式
    "{eval('Hello' + ' World')}",      // eval 中使用字符串
    "{eval({eval(1 + 2)} + 3)}",      // 嵌套的 eval
    "{v(pointer)}",                      // 使用 v() 获取 pointer 指向的变量的值
    "{v(name)}",                         // 直接使用 v() 获取变量值
    "{u.lvl}",
    "{a} = 'hello'",                     // 设置变量 a
    "{b} = 'a'",                         // 设置变量 b 为 'a'
    "{v(b)} + ' world'",                 // 使用 v(b) 获取 a 的值并拼接
    "{eval(v(b) + ' world')}",           // 在 eval 中使用 v()
    "{v({b})}",                          // 嵌套使用变量引用
    "{u.a} + ' and ' + {o.b}",          // 直接使用属性进行字符串连接
    "arr = [1, 2, 3, 4, 5]",                    // 数组初始化
    "arr[0]",                                    // 数组访问
    "arr[1] + arr[2]",                          // 数组元素运算
    "arr[{i}]",                                 // 使用变量作为索引
    "i = 2",                                    // 设置索引变量
    "arr[i]",                                   // 使用变量作为索引
    "arr2 = ['hello', 'world']",               // 字符串数组
    "arr2[0] + ' ' + arr2[1]",                 // 字符串数组连接
    "arr[0] = 10",                             // 修改数组元素
    "arr[0]",                                   // 查看修改后的值
    "assoc = ['name': 'John', 'age': 25]",     // 关联数组
    "assoc['name']",                           // 访问关联数组
    "arr3 = [1 + 2, {x}, arr[1]]",            // 复杂数组初始化
    "nested = [[1, 2], [3, 4]]",              // 嵌套数组
    "nested[0][1]",                            // 访问嵌套数组
    "arr.create(test) = [1, 2, 3, 4]",          // 创建数组
    "arr.get(test).0",                          // 获取数组元素
    "arr.set(test).1 = 5",                      // 设置数组元素
    "arr.get(test).1",                          // 验证设置的值
    "arr.put(test) = 6",                        // 追加元素
    "arr.get(test).4",                          // 验证追加的值
    "u.a = 'myarray'",                          // 设置变量
    "arr.create({u.a}) = [1, 2, 3, 4]",        // 使用变量创建数组
    "arr.get({u.a}).0",                         // 使用变量获取数组元素
    "arr.set({u.a}).1 = 4",                     // 使用变量设置数组元素
    "arr.put({u.a}) = 5",                       // 使用变量追加元素
    "arr.del(test).3",                          // 删除第4个元素
    "arr.put(test) = 6",                        // 追加元素
    "arr.get(test).3",                          // 验证新的第4个元素
];

// 清除之前的变量
// VariableStore::clear();

// // 更新测试用例，移除原始数组操作的测试
// $tests = array_filter($tests, function($test) {
//     return !preg_match('/^\s*[a-zA-Z][a-zA-Z0-9_]*\s*=\s*\[/', $test) &&
//           !preg_match('/^\s*[a-zA-Z][a-zA-Z0-9_]*\[[^\]]+\]/', $test);
// });

foreach ($tests as $test) {
    //echo "表达式: $test = " . calculate($test) . "<br/>";
}

$end_time = microtime(true);
$execution_time = ceil(($end_time - $start_time) * 1000);// 单位是毫秒
echo "执行时间：" . $execution_time . "ms"; // 输出结果
?>