<?php
/**
 * 增强版超大数字表达式解析器
 * 支持 +, -, *, /, %, ^, (, ), 比较运算符, 逻辑运算符, 变量, 函数调用等运算
 * 使用 bcmath 库进行计算
 */
class BigNumberExpressionParser {
    private $expression;
    private $position;
    private $currentToken;
    private $variables = [];
    private $precision = 10; // 默认精度
    
    // 可用数学函数映射
    private $functions = [
        'sqrt' => 'bcsqrt',
        'abs' => 'bcabs',
        'max' => 'bcmax',
        'min' => 'bcmin',
        'pow' => 'bcpow',
        'mod' => 'bcmod',
        'round' => 'bcround',
        'floor' => 'bcfloor',
        'ceil' => 'bcceil',
    ];
    
    public function __construct($expression, $precision = 10) {
        // 移除所有空格
        $this->expression = preg_replace('/\s+/', '', $expression);
        $this->position = 0;
        $this->currentToken = null;
        $this->precision = $precision;
        $this->getNextToken();
    }
    
    /**
     * 设置变量值
     */
    public function setVariable($name, $value) {
        $this->variables[$name] = $value;
        return $this;
    }
    
    /**
     * 设置精度
     */
    public function setPrecision($precision) {
        $this->precision = $precision;
        return $this;
    }
    
    /**
     * 词法分析：获取下一个标记
     */
    private function getNextToken() {
        // 如果到达表达式末尾
        if ($this->position >= strlen($this->expression)) {
            $this->currentToken = null;
            return;
        }
        
        $char = $this->expression[$this->position];
        
        // 检查双字符运算符 ?? (空合并运算符)
        if ($char === '?' && $this->position + 1 < strlen($this->expression) && 
            $this->expression[$this->position + 1] === '?') {
            $this->currentToken = ['type' => 'OPERATOR', 'value' => '??'];
            $this->position += 2;
            return;
        }
        
        // 如果是字符串（单引号或双引号）
        if ($char === "'" || $char === '"') {
            $quote = $char;
            $string = '';
            $this->position++; // 跳过开始的引号
            
            while ($this->position < strlen($this->expression) && $this->expression[$this->position] !== $quote) {
                // 处理转义字符
                if ($this->expression[$this->position] === '\\' && $this->position + 1 < strlen($this->expression)) {
                    $this->position++;
                    $string .= $this->expression[$this->position];
                } else {
                    $string .= $this->expression[$this->position];
                }
                $this->position++;
            }
            
            // 跳过结束的引号
            if ($this->position < strlen($this->expression)) {
                $this->position++;
            }
            
            $this->currentToken = ['type' => 'STRING', 'value' => $string];
            return;
        }
        
        // 如果是数字，提取完整数字
        if (ctype_digit($char) || $char === '.') {
            $number = '';
            while ($this->position < strlen($this->expression) && 
                  (ctype_digit($this->expression[$this->position]) || $this->expression[$this->position] === '.')) {
                $number .= $this->expression[$this->position];
                $this->position++;
            }
            $this->currentToken = ['type' => 'NUMBER', 'value' => $number];
            return;
        }
        
        // 如果是字母，可能是变量或函数
        if (ctype_alpha($char) || $char === '_') {
            $identifier = '';
            while ($this->position < strlen($this->expression) && 
                  (ctype_alnum($this->expression[$this->position]) || $this->expression[$this->position] === '_')) {
                $identifier .= $this->expression[$this->position];
                $this->position++;
            }
            
            // 检查是否是特殊关键字
            if (strtolower($identifier) === 'null') {
                $this->currentToken = ['type' => 'NULL', 'value' => 'null'];
                return;
            }
            
            // 检查是否是函数调用
            if ($this->position < strlen($this->expression) && $this->expression[$this->position] === '(') {
                $this->currentToken = ['type' => 'FUNCTION', 'value' => $identifier];
            } else {
                $this->currentToken = ['type' => 'VARIABLE', 'value' => $identifier];
            }
            return;
        }
        
        // 检查比较运算符和逻辑运算符
        if ($char === '=' || $char === '!' || $char === '<' || $char === '>' || $char === '&' || $char === '|') {
            $operator = $char;
            $this->position++;
            
            // 处理双字符运算符
            if ($this->position < strlen($this->expression)) {
                $nextChar = $this->expression[$this->position];
                if (($char === '=' && $nextChar === '=') ||
                    ($char === '!' && $nextChar === '=') ||
                    ($char === '<' && $nextChar === '=') ||
                    ($char === '>' && $nextChar === '=') ||
                    ($char === '&' && $nextChar === '&') ||
                    ($char === '|' && $nextChar === '|')) {
                    $operator .= $nextChar;
                    $this->position++;
                }
            }
            
            $this->currentToken = ['type' => 'OPERATOR', 'value' => $operator];
            return;
        }
        
        // 检查三字符运算符
        if ($char === '=' && $this->position + 1 < strlen($this->expression) && 
            $this->expression[$this->position + 1] === '=' && 
            $this->position + 2 < strlen($this->expression) && 
            $this->expression[$this->position + 2] === '=') {
            $this->currentToken = ['type' => 'OPERATOR', 'value' => '==='];
            $this->position += 3;
            return;
        }
        
        if ($char === '!' && $this->position + 1 < strlen($this->expression) && 
            $this->expression[$this->position + 1] === '=' && 
            $this->position + 2 < strlen($this->expression) && 
            $this->expression[$this->position + 2] === '=') {
            $this->currentToken = ['type' => 'OPERATOR', 'value' => '!=='];
            $this->position += 3;
            return;
        }
        
        // 如果是其他操作符
        switch ($char) {
            case '+':
            case '-':
            case '*':
            case '/':
            case '%':
            case '^':
            case '(':
            case ')':
            case ',':
            case ';':
            case '?':
            case ':':
                $this->currentToken = ['type' => 'OPERATOR', 'value' => $char];
                $this->position++;
                return;
            default:
                throw new Exception("无法识别的字符: $char 在位置 {$this->position}");
        }
    }
    
    /**
     * 语法分析入口
     */
    public function parse() {
        return $this->parseExpression();
    }
    
    /**
     * 处理条件表达式 (a ? b : c) 和 (a ?: b)
     */
    private function parseExpression() {
        $expr = $this->parseNullCoalesce();
        
        if ($this->currentToken !== null && 
            $this->currentToken['type'] === 'OPERATOR' && 
            $this->currentToken['value'] === '?') {
            $this->getNextToken();
            
            // 检查是否是简写形式的三元运算符 (a ?: b)
            if ($this->currentToken !== null && 
                $this->currentToken['type'] === 'OPERATOR' && 
                $this->currentToken['value'] === ':') {
                $this->getNextToken();
                $falseExpr = $this->parseExpression();
                
                // 简写形式相当于 $expr ? $expr : $falseExpr
                return ['type' => 'CONDITIONAL', 'condition' => $expr, 'true' => $expr, 'false' => $falseExpr];
            }
            
            // 标准三元运算符 (a ? b : c)
            $trueExpr = $this->parseExpression();
            
            if ($this->currentToken === null || 
                $this->currentToken['type'] !== 'OPERATOR' || 
                $this->currentToken['value'] !== ':') {
                throw new Exception("三元运算符缺少冒号");
            }
            
            $this->getNextToken();
            $falseExpr = $this->parseExpression();
            
            return ['type' => 'CONDITIONAL', 'condition' => $expr, 'true' => $trueExpr, 'false' => $falseExpr];
        }
        
        return $expr;
    }
    
    /**
     * 处理空合并运算符 (??)
     */
    private function parseNullCoalesce() {
        $left = $this->parseLogicalOr();
        
        if ($this->currentToken !== null && 
            $this->currentToken['type'] === 'OPERATOR' && 
            $this->currentToken['value'] === '??') {
            $this->getNextToken();
            $right = $this->parseNullCoalesce(); // 允许链式操作 a ?? b ?? c
            
            return ['type' => 'NULL_COALESCE', 'left' => $left, 'right' => $right];
        }
        
        return $left;
    }
    
    /**
     * 处理逻辑或运算
     */
    private function parseLogicalOr() {
        $left = $this->parseLogicalAnd();
        
        while ($this->currentToken !== null && 
               $this->currentToken['type'] === 'OPERATOR' && 
               ($this->currentToken['value'] === '||' || $this->currentToken['value'] === '|')) {
            $operator = $this->currentToken['value'];
            $this->getNextToken();
            $right = $this->parseLogicalAnd();
            
            $left = ['type' => 'LOGICAL_OR', 'left' => $left, 'right' => $right];
        }
        
        return $left;
    }
    
    /**
     * 处理逻辑与运算
     */
    private function parseLogicalAnd() {
        $left = $this->parseComparison();
        
        while ($this->currentToken !== null && 
               $this->currentToken['type'] === 'OPERATOR' && 
               ($this->currentToken['value'] === '&&' || $this->currentToken['value'] === '&')) {
            $operator = $this->currentToken['value'];
            $this->getNextToken();
            $right = $this->parseComparison();
            
            $left = ['type' => 'LOGICAL_AND', 'left' => $left, 'right' => $right];
        }
        
        return $left;
    }
    
    /**
     * 处理比较运算
     */
    private function parseComparison() {
        $left = $this->parseAdditive();
        
        if ($this->currentToken !== null && 
            $this->currentToken['type'] === 'OPERATOR' && 
            in_array($this->currentToken['value'], ['==', '!=', '===', '!==', '<', '>', '<=', '>='])) {
            $operator = $this->currentToken['value'];
            $this->getNextToken();
            $right = $this->parseAdditive();
            
            return ['type' => 'COMPARISON', 'operator' => $operator, 'left' => $left, 'right' => $right];
        }
        
        return $left;
    }
    
    /**
     * 处理加减法
     */
    private function parseAdditive() {
        $left = $this->parseMultiplicative();
        
        while ($this->currentToken !== null && 
               $this->currentToken['type'] === 'OPERATOR' && 
               ($this->currentToken['value'] === '+' || $this->currentToken['value'] === '-')) {
            $operator = $this->currentToken['value'];
            $this->getNextToken();
            $right = $this->parseMultiplicative();
            
            if ($operator === '+') {
                $left = ['type' => 'ADDITION', 'left' => $left, 'right' => $right];
            } else {
                $left = ['type' => 'SUBTRACTION', 'left' => $left, 'right' => $right];
            }
        }
        
        return $left;
    }
    
    /**
     * 处理乘除法和取模
     */
    private function parseMultiplicative() {
        $left = $this->parsePower();
        
        while ($this->currentToken !== null && 
               $this->currentToken['type'] === 'OPERATOR' && 
               ($this->currentToken['value'] === '*' || $this->currentToken['value'] === '/' || $this->currentToken['value'] === '%')) {
            $operator = $this->currentToken['value'];
            $this->getNextToken();
            $right = $this->parsePower();
            
            if ($operator === '*') {
                $left = ['type' => 'MULTIPLICATION', 'left' => $left, 'right' => $right];
            } else if ($operator === '/') {
                $left = ['type' => 'DIVISION', 'left' => $left, 'right' => $right];
            } else {
                $left = ['type' => 'MODULO', 'left' => $left, 'right' => $right];
            }
        }
        
        return $left;
    }
    
    /**
     * 处理指数运算
     */
    private function parsePower() {
        $left = $this->parseUnary();
        
        if ($this->currentToken !== null && 
            $this->currentToken['type'] === 'OPERATOR' && 
            $this->currentToken['value'] === '^') {
            $this->getNextToken();
            $right = $this->parsePower();
            return ['type' => 'POWER', 'left' => $left, 'right' => $right];
        }
        
        return $left;
    }
    
    /**
     * 处理一元运算符
     */
    private function parseUnary() {
        if ($this->currentToken !== null && 
            $this->currentToken['type'] === 'OPERATOR' && 
            ($this->currentToken['value'] === '+' || $this->currentToken['value'] === '-' || $this->currentToken['value'] === '!')) {
            $operator = $this->currentToken['value'];
            $this->getNextToken();
            $expression = $this->parseUnary();
            
            if ($operator === '-') {
                return ['type' => 'NEGATION', 'expression' => $expression];
            } else if ($operator === '!') {
                return ['type' => 'LOGICAL_NOT', 'expression' => $expression];
            }
            // 一元加法不做任何改变
            return $expression;
        }
        
        return $this->parsePrimary();
    }
    
    /**
     * 处理基本元素（数字、变量、函数调用和括号）
     */
    private function parsePrimary() {
        if ($this->currentToken === null) {
            throw new Exception("表达式不完整");
        }
        
        if ($this->currentToken['type'] === 'NUMBER') {
            $value = $this->currentToken['value'];
            $this->getNextToken();
            return ['type' => 'NUMBER', 'value' => $value];
        }
        
        if ($this->currentToken['type'] === 'STRING') {
            $value = $this->currentToken['value'];
            $this->getNextToken();
            return ['type' => 'STRING', 'value' => $value];
        }
        
        if ($this->currentToken['type'] === 'NULL') {
            $this->getNextToken();
            return ['type' => 'NULL', 'value' => null];
        }
        
        if ($this->currentToken['type'] === 'VARIABLE') {
            $name = $this->currentToken['value'];
            $this->getNextToken();
            return ['type' => 'VARIABLE', 'name' => $name];
        }
        
        if ($this->currentToken['type'] === 'FUNCTION') {
            $name = $this->currentToken['value'];
            $this->getNextToken();
            
            // 函数后面必须跟着左括号
            if ($this->currentToken === null || 
                $this->currentToken['type'] !== 'OPERATOR' || 
                $this->currentToken['value'] !== '(') {
                throw new Exception("函数 '$name' 后缺少左括号");
            }
            
            $this->getNextToken();
            $args = [];
            
            // 解析参数列表
            if ($this->currentToken !== null && 
                ($this->currentToken['type'] !== 'OPERATOR' || $this->currentToken['value'] !== ')')) {
                
                // 解析第一个参数
                $args[] = $this->parseExpression();
                
                // 解析剩余的参数
                while ($this->currentToken !== null && 
                       $this->currentToken['type'] === 'OPERATOR' && 
                       $this->currentToken['value'] === ',') {
                    $this->getNextToken();
                    $args[] = $this->parseExpression();
                }
            }
            
            // 参数列表后必须跟着右括号
            if ($this->currentToken === null || 
                $this->currentToken['type'] !== 'OPERATOR' || 
                $this->currentToken['value'] !== ')') {
                throw new Exception("函数 '$name' 缺少右括号");
            }
            
            $this->getNextToken();
            return ['type' => 'FUNCTION_CALL', 'name' => $name, 'arguments' => $args];
        }
        
        if ($this->currentToken['type'] === 'OPERATOR' && $this->currentToken['value'] === '(') {
            $this->getNextToken();
            $expression = $this->parseExpression();
            
            if ($this->currentToken === null || 
                $this->currentToken['type'] !== 'OPERATOR' || 
                $this->currentToken['value'] !== ')') {
                throw new Exception("缺少右括号");
            }
            
            $this->getNextToken();
            return $expression;
        }
        
        throw new Exception("意外的标记: " . json_encode($this->currentToken));
    }
    
    /**
     * 使用 bcmath 库的安全封装方法，确保参数是有效的数字字符串
     */
    private function safeBccomp($left, $right) {
        // 确保两个操作数都是有效数字，否则返回PHP标准比较结果
        if (!is_numeric($left) || !is_numeric($right)) {
            // 非数字值使用PHP标准比较
            if ($left == $right) return 0;
            return ($left < $right) ? -1 : 1;
        }
        
        // 格式化为数字字符串
        $left = (string)$left;
        $right = (string)$right;
        
        return bccomp($left, $right);
    }
    
    /**
     * 其他bcmath函数的安全封装
     */
    private function safeBcadd($left, $right) {
        if (!is_numeric($left) || !is_numeric($right)) {
            // 如果不是数字，尝试转换为数字
            $left = is_numeric($left) ? $left : 0;
            $right = is_numeric($right) ? $right : 0;
        }
        return bcadd((string)$left, (string)$right);
    }
    
    private function safeBcsub($left, $right) {
        if (!is_numeric($left) || !is_numeric($right)) {
            $left = is_numeric($left) ? $left : 0;
            $right = is_numeric($right) ? $right : 0;
        }
        return bcsub((string)$left, (string)$right);
    }
    
    private function safeBcmul($left, $right) {
        if (!is_numeric($left) || !is_numeric($right)) {
            $left = is_numeric($left) ? $left : 0;
            $right = is_numeric($right) ? $right : 0;
        }
        return bcmul((string)$left, (string)$right);
    }
    
    private function safeBcdiv($left, $right) {
        if (!is_numeric($left) || !is_numeric($right)) {
            $left = is_numeric($left) ? $left : 0;
            $right = is_numeric($right) ? $right : 1; // 避免除以0
        }
        if ($this->safeBccomp($right, '0') === 0) {
            throw new Exception("除数不能为零");
        }
        return bcdiv((string)$left, (string)$right);
    }
    
    private function safeBcmod($left, $right) {
        if (!is_numeric($left) || !is_numeric($right)) {
            $left = is_numeric($left) ? $left : 0;
            $right = is_numeric($right) ? $right : 1; // 避免除以0
        }
        if ($this->safeBccomp($right, '0') === 0) {
            throw new Exception("模运算的除数不能为零");
        }
        return bcmod((string)$left, (string)$right);
    }
    
    private function safeBcpow($left, $right) {
        if (!is_numeric($left) || !is_numeric($right)) {
            $left = is_numeric($left) ? $left : 0;
            $right = is_numeric($right) ? $right : 0;
        }
        return bcpow((string)$left, (string)$right);
    }
    
    /**
     * 使用 bcmath 库求值表达式树
     */
    public function evaluate($node) {
        // 设置 bcmath 精度
        bcscale($this->precision);
        
        switch ($node['type']) {
            case 'NUMBER':
                return $node['value'];
                
            case 'STRING':
                return $node['value'];
                
            case 'NULL':
                return null;
                
            case 'VARIABLE':
                if (!isset($this->variables[$node['name']])) {
                    throw new Exception("未定义的变量: " . $node['name']);
                }
                return $this->variables[$node['name']];
                
            case 'ADDITION':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                return $this->safeBcadd($left, $right);
                
            case 'SUBTRACTION':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                return $this->safeBcsub($left, $right);
                
            case 'MULTIPLICATION':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                return $this->safeBcmul($left, $right);
                
            case 'DIVISION':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                return $this->safeBcdiv($left, $right);
                
            case 'MODULO':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                return $this->safeBcmod($left, $right);
                
            case 'POWER':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                return $this->safeBcpow($left, $right);
                
            case 'NEGATION':
                $value = $this->evaluate($node['expression']);
                if (!is_numeric($value)) {
                    return 0; // 非数字值取反为0
                }
                return $this->safeBcmul($value, '-1');
                
            case 'LOGICAL_NOT':
                $value = $this->evaluate($node['expression']);
                if ($value === null || $value === '' || !is_numeric($value)) {
                    $valueResult = !($value === null || $value === '');
                } else {
                    $valueResult = ($this->safeBccomp($value, '0') !== 0);
                }
                return $valueResult ? '0' : '1';
                
            case 'LOGICAL_AND':
                $left = $this->evaluate($node['left']);
                // 短路求值
                if ($left === null || $left === '' || !is_numeric($left)) {
                    // 非数字值按PHP规则处理：null/空字符串为false，其他非数字字符串为true
                    $leftResult = !($left === null || $left === '');
                } else {
                    $leftResult = ($this->safeBccomp($left, '0') !== 0);
                }
                
                if (!$leftResult) {
                    return '0';
                }
                
                $right = $this->evaluate($node['right']);
                if ($right === null || $right === '' || !is_numeric($right)) {
                    $rightResult = !($right === null || $right === '');
                } else {
                    $rightResult = ($this->safeBccomp($right, '0') !== 0);
                }
                
                return $rightResult ? '1' : '0';
                
            case 'LOGICAL_OR':
                $left = $this->evaluate($node['left']);
                // 短路求值
                if ($left === null || $left === '' || !is_numeric($left)) {
                    $leftResult = !($left === null || $left === '');
                } else {
                    $leftResult = ($this->safeBccomp($left, '0') !== 0);
                }
                
                if ($leftResult) {
                    return '1';
                }
                
                $right = $this->evaluate($node['right']);
                if ($right === null || $right === '' || !is_numeric($right)) {
                    $rightResult = !($right === null || $right === '');
                } else {
                    $rightResult = ($this->safeBccomp($right, '0') !== 0);
                }
                
                return $rightResult ? '1' : '0';
                
            case 'COMPARISON':
                $left = $this->evaluate($node['left']);
                $right = $this->evaluate($node['right']);
                $result = null;
                
                switch ($node['operator']) {
                    case '==':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) === 0 ? '1' : '0';
                        } else {
                            $result = ($left == $right) ? '1' : '0';
                        }
                        break;
                    case '===':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) === 0 ? '1' : '0';
                        } else {
                            $result = ($left === $right) ? '1' : '0';
                        }
                        break;
                    case '!=':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) !== 0 ? '1' : '0';
                        } else {
                            $result = ($left != $right) ? '1' : '0';
                        }
                        break;
                    case '!==':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) !== 0 ? '1' : '0';
                        } else {
                            $result = ($left !== $right) ? '1' : '0';
                        }
                        break;
                    case '<':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) < 0 ? '1' : '0';
                        } else {
                            $result = ($left < $right) ? '1' : '0';
                        }
                        break;
                    case '>':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) > 0 ? '1' : '0';
                        } else {
                            $result = ($left > $right) ? '1' : '0';
                        }
                        break;
                    case '<=':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) <= 0 ? '1' : '0';
                        } else {
                            $result = ($left <= $right) ? '1' : '0';
                        }
                        break;
                    case '>=':
                        if (is_numeric($left) && is_numeric($right)) {
                            $result = $this->safeBccomp($left, $right) >= 0 ? '1' : '0';
                        } else {
                            $result = ($left >= $right) ? '1' : '0';
                        }
                        break;
                    default:
                        throw new Exception("不支持的比较运算符: " . $node['operator']);
                }
                
                return $result;
                
            case 'CONDITIONAL':
                $condition = $this->evaluate($node['condition']);
                // 检查条件是否为true（非零、非空）
                // 注意：我们将0、'0'、空字符串视为false
                $isTrue = false;
                
                if ($condition !== null && $condition !== '') {
                    if (is_numeric($condition)) {
                        $isTrue = ($this->safeBccomp($condition, '0') !== 0);
                    } else {
                        // 非数字值，如字符串，都视为true（除了空字符串）
                        $isTrue = true;
                    }
                }
                
                return $isTrue
                    ? $this->evaluate($node['true']) 
                    : $this->evaluate($node['false']);
                
            case 'FUNCTION_CALL':
                $name = $node['name'];
                
                // 处理自定义函数
                if (!isset($this->functions[$name])) {
                    throw new Exception("未定义的函数: $name");
                }
                
                $function = $this->functions[$name];
                $args = [];
                
                foreach ($node['arguments'] as $arg) {
                    $args[] = $this->evaluate($arg);
                }
                
                // 执行函数
                switch ($function) {
                    case 'bcsqrt':
                        if (count($args) !== 1) {
                            throw new Exception("sqrt函数需要1个参数");
                        }
                        if (!is_numeric($args[0])) {
                            return '0'; // 非数字返回0
                        }
                        if ($this->safeBccomp($args[0], '0') < 0) {
                            throw new Exception("sqrt函数参数不能为负数");
                        }
                        return $this->bcsqrt($args[0]);
                        
                    case 'bcabs':
                        if (count($args) !== 1) {
                            throw new Exception("abs函数需要1个参数");
                        }
                        if (!is_numeric($args[0])) {
                            return '0'; // 非数字返回0
                        }
                        return $this->safeBccomp($args[0], '0') < 0 ? $this->safeBcmul($args[0], '-1') : $args[0];
                        
                    case 'bcmax':
                        if (count($args) < 2) {
                            throw new Exception("max函数至少需要2个参数");
                        }
                        // 过滤非数字参数
                        $numericArgs = [];
                        foreach ($args as $arg) {
                            if (is_numeric($arg)) {
                                $numericArgs[] = $arg;
                            }
                        }
                        if (empty($numericArgs)) {
                            return '0'; // 如果没有数字参数，返回0
                        }
                        $max = $numericArgs[0];
                        for ($i = 1; $i < count($numericArgs); $i++) {
                            if ($this->safeBccomp($numericArgs[$i], $max) > 0) {
                                $max = $numericArgs[$i];
                            }
                        }
                        return $max;
                        
                    case 'bcmin':
                        if (count($args) < 2) {
                            throw new Exception("min函数至少需要2个参数");
                        }
                        // 过滤非数字参数
                        $numericArgs = [];
                        foreach ($args as $arg) {
                            if (is_numeric($arg)) {
                                $numericArgs[] = $arg;
                            }
                        }
                        if (empty($numericArgs)) {
                            return '0'; // 如果没有数字参数，返回0
                        }
                        $min = $numericArgs[0];
                        for ($i = 1; $i < count($numericArgs); $i++) {
                            if ($this->safeBccomp($numericArgs[$i], $min) < 0) {
                                $min = $numericArgs[$i];
                            }
                        }
                        return $min;
                        
                    case 'bcpow':
                        if (count($args) !== 2) {
                            throw new Exception("pow函数需要2个参数");
                        }
                        return $this->safeBcpow($args[0], $args[1]);
                        
                    case 'bcmod':
                        if (count($args) !== 2) {
                            throw new Exception("mod函数需要2个参数");
                        }
                        return $this->safeBcmod($args[0], $args[1]);
                        
                    case 'bcround':
                        if (count($args) < 1 || count($args) > 2) {
                            throw new Exception("round函数需要1或2个参数");
                        }
                        $precision = isset($args[1]) ? intval($args[1]) : 0;
                        return $this->bcround($args[0], $precision);
                        
                    case 'bcfloor':
                        if (count($args) !== 1) {
                            throw new Exception("floor函数需要1个参数");
                        }
                        if (!is_numeric($args[0])) {
                            return '0'; // 非数字返回0
                        }
                        $parts = explode('.', (string)$args[0]);
                        return $parts[0];
                        
                    case 'bcceil':
                        if (count($args) !== 1) {
                            throw new Exception("ceil函数需要1个参数");
                        }
                        if (!is_numeric($args[0])) {
                            return '0'; // 非数字返回0
                        }
                        $parts = explode('.', (string)$args[0]);
                        if (isset($parts[1]) && $this->safeBccomp('0.' . $parts[1], '0') > 0) {
                            return $this->safeBcadd($parts[0], '1');
                        }
                        return $parts[0];
                        
                    default:
                        throw new Exception("未实现的函数: $function");
                }
                
            case 'NULL_COALESCE':
                $left = null;
                
                // 尝试计算左侧表达式
                try {
                    $left = $this->evaluate($node['left']);
                    
                    // 检查是否为null（对于我们的情况，我们将空字符串或'null'视为null）
                    if ($left === null || $left === '' || (is_string($left) && strtolower($left) === 'null')) {
                        return $this->evaluate($node['right']);
                    }
                    return $left;
                } catch (Exception $e) {
                    // 如果左侧表达式计算失败（例如未定义的变量），则计算右侧表达式
                    return $this->evaluate($node['right']);
                }
                
            default:
                throw new Exception("未知节点类型: " . $node['type']);
        }
    }
    
    /**
     * 计算大数平方根
     */
    private function bcsqrt($operand) {
        // 确保操作数是有效数字
        if (!is_numeric($operand)) {
            $operand = '0';
        } else {
            $operand = (string)$operand;
        }
        
        // 增加临时精度以提高准确性
        $tempScale = bcscale();
        bcscale($tempScale + 6);
        
        if ($this->safeBccomp($operand, '0') === 0) {
            bcscale($tempScale);
            return '0';
        }
        
        // 使用牛顿迭代法求平方根
        $x = '1';
        $b = $operand;
        $lastX = null;
        
        while ($this->safeBccomp($x, $lastX ?? '0') !== 0) {
            $lastX = $x;
            $x = $this->safeBcdiv($this->safeBcadd($x, $this->safeBcdiv($b, $x)), '2');
        }
        
        // 恢复原始精度
        bcscale($tempScale);
        return $this->bcround($x, $tempScale);
    }
    
    /**
     * 四舍五入到指定精度
     */
    private function bcround($value, $precision) {
        // 确保值是有效数字
        if (!is_numeric($value)) {
            return '0';
        }
        
        $value = (string)$value;
        $precision = (int)$precision;
        
        $multiplier = $this->safeBcpow('10', (string)$precision);
        $value = $this->safeBcmul($value, $multiplier);
        
        // 计算小数部分
        $parts = explode('.', $value);
        $integerPart = $parts[0];
        $decimalValue = isset($parts[1]) ? '0.' . $parts[1] : '0';
        
        // 四舍五入
        if ($this->safeBccomp($decimalValue, '0.5') >= 0) {
            $integerPart = $this->safeBcadd($integerPart, '1');
        }
        
        return $this->safeBcdiv($integerPart, $multiplier);
    }
    
    /**
     * 解析并计算表达式
     */
    public function calculate() {
        $ast = $this->parse();
        return $this->evaluate($ast);
    }
}

// 示例使用
function calculateBigNumberExpression($expression, $variables = [], $precision = 10) {
    try {
        $parser = new BigNumberExpressionParser($expression, $precision);
        
        // 设置变量
        foreach ($variables as $name => $value) {
            $parser->setVariable($name, $value);
        }
        
        $result = $parser->calculate();
        return $result;
    } catch (Exception $e) {
        return "错误: " . $e->getMessage();
    }
}

// // 测试基本运算
// $expression = "99999999999999999+999999999999999999";
// echo "表达式: $expression<br/>";
// echo "结果: " . calculateBigNumberExpression($expression) . "<br/>";

// // 测试扩展功能
// $tests = [
//     // 基本算术运算
//     "123456789012345678901234567890+987654321098765432109876543210",
//     "9999999999999999-1",
//     "12345678901234567890*98765432109876543210",
//     "999999999999999999999999/3",
//     "(9999999999+1)*(9999999999-1)",
//     "9^18",
    
//     // 比较和逻辑运算
//     "99999 > 1000 ? 'true' : 'false'",
//     "99999 == 99999",
//     "1000 < 100 || 1000 > 100",
//     "!(1000 < 100) && 1000 > 100",
    
//     // 模运算
//     "123456789 % 9",
    
//     // 函数调用
//     "sqrt(9999999999)",
//     "abs(-12345678901234567890)",
//     "max(1000, 2000, 3000)",
//     "min(1000, 2000, 3000)",
//     "pow(10, 20)",
//     "round(123.456, 2)",
//     "floor(123.999)",
//     "ceil(123.001)"
// ];

// foreach ($tests as $test) {
//     echo "表达式: $test<br/>";
//     echo "结果: " . calculateBigNumberExpression($test) . "<br/>";
// }

// // 测试变量
// $variables = [
//     'x' => '1234567890123456789',
//     'y' => '9876543210987654321'
// ];
// $expression = "x + y * 2";
// echo "表达式: $expression (x={$variables['x']}, y={$variables['y']})<br/>";
// echo "结果: " . calculateBigNumberExpression($expression, $variables) . "<br/>";

// // 测试复杂表达式
// $complexTests = [
//     "sqrt(pow(3, 12)) + 10 * (5 - 2)",
//     "x^2 + 2*x + 1 > y ? max(x, y, 100) : min(x, y, 100)",
//     "(1 + 2) * 3 - 4 / 2",
//     "abs(-10) + sqrt(16) * pow(2, 3)"
// ];

// foreach ($complexTests as $test) {
//     echo "复杂表达式: $test<br/>";
//     echo "结果: " . calculateBigNumberExpression($test, $variables) . "<br/>";
// }

// // 测试新增的 ?: 和 ?? 运算符
// $newOperatorTests = [
//     // ?: 运算符测试
//     "100 ?: 200",                 // 返回 100，因为左侧不为空
//     "0 ?: 200",                   // 返回 200，因为左侧的0被视为假
//     "x ?: 0",                     // 返回 x 的值
    
//     // ?? 运算符测试
//     "undefined_var ?? 500",       // 返回 500，因为左侧变量未定义
//     "x ?? 999",                   // 返回 x 的值，因为它已定义
//     "null ?? 'fallback'",         // 返回 fallback
    
//     // 组合使用
//     "undefined_var1 ?? undefined_var2 ?? 'default'", // 链式使用??
//     "0 ?: (undefined_var ?? 300)",  // 组合使用 ?: 和 ??
//     "(x > y) ?: 'y is greater'"    // 条件结果与 ?: 组合
// ];

// echo "<h3>测试新增运算符：</h3>";
// foreach ($newOperatorTests as $test) {
//     echo "表达式: $test<br/>";
//     echo "结果: " . calculateBigNumberExpression($test, $variables) . "<br/>";
// }
?>