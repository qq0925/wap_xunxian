<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// 清除单个键的值
//$redis->del('xunxian_all_data');

// 获取缓存中的数据
$cacheKey = 'xunxian_all_data';
$data = $redis->get($cacheKey);

if ($data) {
    // 将 JSON 数据转换为 PHP 数组
    $dataArray = json_decode($data, true);
    print_r($dataArray); // 打印缓存中的数据
} else {
    echo "缓存中没有数据";
}



$start_time = hrtime(true);

class Token {
    const PLUS = 'PLUS';//+
    const MINUS = 'MINUS';//-
    const MUL = 'MUL';//*
    const DIV = 'DIV';// /
    const LPAREN = 'LPAREN';  // (
    const RPAREN = 'RPAREN';  // )
    const LCURLY = 'LCURLY';  // {
    const RCURLY = 'RCURLY';  // }
    const DOT = 'DOT';// 取值运算符 .
    const DECIMAL = 'DECIMAL'; // 小数点
    const QUESTION = 'QUESTION';//三元表达式?
    const COLON = 'COLON';//三元表达式:
    const OR = 'OR';//||
    const AND = 'AND';//&&
    const GT = 'GT';
    const GTE = 'GTE';
    const LT = 'LT';
    const LTE = 'LTE';
    const EQ = 'EQ';
    const NEQ = 'NEQ';
    const IDENTIFIER = 'IDENTIFIER';//标识
    const NUMBER = 'NUMBER';//数字
    const STRING = 'STRING';//字符串
    const FUNCTION = 'FUNCTION';  // v
    const EVAL = 'EVAL';          // eval
    const EOF = 'EOF';//结束符
}

class Lexer {
    private $input;
    private $position;
    private $currentChar;
    private $bracketStack;  // 栈，用于跟踪括号 () 和 {}

    public function __construct($input) {
        $this->input = $input;
        $this->position = 0;
        $this->currentChar = $input[$this->position];
        $this->bracketStack = [];
    }

    private function advance() {
        $this->position++;
        if ($this->position >= strlen($this->input)) {
            $this->currentChar = null; // End of input
        } else {
            $this->currentChar = $this->input[$this->position];
        }
    }

    private function skipWhitespace() {
        while ($this->currentChar !== null && ctype_space($this->currentChar)) {
            $this->advance();
        }
    }

    private function createToken($type, $value) {
        return ["type" => $type, "value" => $value];
    }

    public function getNextToken() {
        while ($this->currentChar !== null) {
            if (ctype_space($this->currentChar)) {
                $this->skipWhitespace();
                continue;
            }

            if (ctype_alpha($this->currentChar) || $this->currentChar === '_') {
                return $this->identifier();
            }

            if (ctype_digit($this->currentChar)) {
                return $this->number();
            }

            if ($this->currentChar === '"') {
                return $this->string();
            }

            switch ($this->currentChar) {
                case '+':
                    $this->advance();
                    return $this->createToken(Token::PLUS, '+');
                case '-':
                    $this->advance();
                    return $this->createToken(Token::MINUS, '-');
                case '*':
                    $this->advance();
                    return $this->createToken(Token::MUL, '*');
                case '/':
                    $this->advance();
                    return $this->createToken(Token::DIV, '/');
                case '(':
                    $this->advance();
                    array_push($this->bracketStack, '(');
                    return $this->createToken(Token::LPAREN, '(');
                case ')':
                    $this->advance();
                    array_pop($this->bracketStack);
                    return $this->createToken(Token::RPAREN, ')');
                case '{':
                    $this->advance();
                    array_push($this->bracketStack, '{');
                    return $this->createToken(Token::LCURLY, '{');
                case '}':
                    $this->advance();
                    array_pop($this->bracketStack);
                    return $this->createToken(Token::RCURLY, '}');
                case '.':
                    // 如果当前不在括号内，则识别为小数点，否则为链式调用的点运算符
                    if ($this->inBracketScope()) {
                        $this->advance();
                        return $this->createToken(Token::DOT, '.'); // 链式调用的点运算符
                    } else {
                        $this->advance();
                        return $this->createToken(Token::DECIMAL, '.'); // 小数点
                    }
                case '?':
                    $this->advance();
                    return $this->createToken(Token::QUESTION, '?');
                case ':':
                    $this->advance();
                    return $this->createToken(Token::COLON, ':');
                case '|':
                    $this->advance();
                    if ($this->currentChar === '|') {
                        $this->advance();
                        return $this->createToken(Token::OR, '||');
                    }
                    throw new Exception("未知字符: |");
                case '&':
                    $this->advance();
                    if ($this->currentChar === '&') {
                        $this->advance();
                        return $this->createToken(Token::AND, '&&');
                    }
                    throw new Exception("未知字符: &");
                case '>':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return $this->createToken(Token::GTE, '>=');
                    }
                    return $this->createToken(Token::GT, '>');
                case '<':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return $this->createToken(Token::LTE, '<=');
                    }
                    return $this->createToken(Token::LT, '<');
                case '=':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return $this->createToken(Token::EQ, '==');
                    }
                    throw new Exception("未知字符: =");
                case '!':
                    $this->advance();
                    if ($this->currentChar === '=') {
                        $this->advance();
                        return $this->createToken(Token::NEQ, '!=');
                    }
                    throw new Exception("未知字符: !");
                default:
                    throw new Exception("未知字符: " . $this->currentChar);
            }
        }

        return $this->createToken(Token::EOF, null);
    }

    private function identifier() {
        $result = '';
        while ($this->currentChar !== null && (ctype_alnum($this->currentChar) || $this->currentChar === '_')) {
            $result .= $this->currentChar;
            $this->advance();
        }
        if ($result === 'v') {
            return $this->createToken(Token::FUNCTION, 'v');
        } elseif ($result === 'eval') {
            return $this->createToken(Token::EVAL, 'eval');
        }
        return $this->createToken(Token::IDENTIFIER, $result);
    }

    private function number() {
        $result = '';
        $hasDecimalPoint = false;

        while ($this->currentChar !== null && (ctype_digit($this->currentChar) || $this->currentChar === '.')) {
            if ($this->currentChar === '.') {
                if ($hasDecimalPoint) {
                    break; // 第二个小数点，停止解析
                }
                $hasDecimalPoint = true;
            }
            $result .= $this->currentChar;
            $this->advance();
        }

        return $this->createToken(Token::NUMBER, $result);
    }

    private function string() {
        $result = '';
        $this->advance(); // Skip the opening quote
        while ($this->currentChar !== null && $this->currentChar !== '"') {
            $result .= $this->currentChar;
            $this->advance();
        }
        $this->advance(); // Skip the closing quote
        return $this->createToken(Token::STRING, $result);
    }

    // 判断当前是否在括号或大括号的范围内
    private function inBracketScope() {
        return !empty($this->bracketStack);
    }
}

class Parser {
    private $lexer;
    private $currentToken;

    public function __construct($lexer) {
        $this->lexer = $lexer;
        $this->currentToken = $this->lexer->getNextToken();
    }

    // 消费当前 token 并读取下一个 token
    private function eat($tokenType) {
        if ($this->currentToken['type'] === $tokenType) {
            $this->currentToken = $this->lexer->getNextToken();
        } else {
            throw new Exception("解析错误: 期待 " . $tokenType . ", 但得到 " . $this->currentToken['type']);
        }
    }

    // 解析表达式
    public function parse() {
        return $this->expression();
    }

    // 表达式递归解析 (支持逻辑运算)
    private function expression() {
        $node = $this->logicalTerm();

        while ($this->currentToken['type'] === Token::OR) {
            $token = $this->currentToken;
            $this->eat(Token::OR);
            $node = [
                'type' => 'LogicalOp',
                'op' => '||',
                'left' => $node,
                'right' => $this->logicalTerm()
            ];
        }

        return $node;
    }

    // 解析逻辑运算的基本单元 (支持 `&&`)
    private function logicalTerm() {
        $node = $this->comparison();

        while ($this->currentToken['type'] === Token::AND) {
            $token = $this->currentToken;
            $this->eat(Token::AND);
            $node = [
                'type' => 'LogicalOp',
                'op' => '&&',
                'left' => $node,
                'right' => $this->comparison()
            ];
        }

        return $node;
    }

    // 解析比较运算符
    private function comparison() {
        $node = $this->term();

        while (in_array($this->currentToken['type'], [Token::GT, Token::GTE, Token::LT, Token::LTE, Token::EQ, Token::NEQ])) {
            $token = $this->currentToken;
            switch ($token['type']) {
                case Token::GT:
                    $this->eat(Token::GT);
                    break;
                case Token::GTE:
                    $this->eat(Token::GTE);
                    break;
                case Token::LT:
                    $this->eat(Token::LT);
                    break;
                case Token::LTE:
                    $this->eat(Token::LTE);
                    break;
                case Token::EQ:
                    $this->eat(Token::EQ);
                    break;
                case Token::NEQ:
                    $this->eat(Token::NEQ);
                    break;
            }

            $node = [
                'type' => 'ComparisonOp',
                'op' => $token['value'],
                'left' => $node,
                'right' => $this->term()
            ];
        }

        return $node;
    }

    // 解析加减法
    private function term() {
        $node = $this->factor();

        while ($this->currentToken['type'] === Token::PLUS || $this->currentToken['type'] === Token::MINUS) {
            $token = $this->currentToken;
            if ($token['type'] === Token::PLUS) {
                $this->eat(Token::PLUS);
            } elseif ($token['type'] === Token::MINUS) {
                $this->eat(Token::MINUS);
            }
            $node = [
                'type' => 'BinaryOp',
                'op' => $token['value'],
                'left' => $node,
                'right' => $this->factor()
            ];
        }

        return $node;
    }

    // 解析乘法、除法
    private function factor() {
        $node = $this->primary();

        while ($this->currentToken['type'] === Token::MUL || $this->currentToken['type'] === Token::DIV) {
            $token = $this->currentToken;
            if ($token['type'] === Token::MUL) {
                $this->eat(Token::MUL);
            } elseif ($token['type'] === Token::DIV) {
                $this->eat(Token::DIV);
            }
            $node = [
                'type' => 'BinaryOp',
                'op' => $token['value'],
                'left' => $node,
                'right' => $this->primary()
            ];
        }

        return $node;
    }

    // 处理数字、标识符、函数调用和大括号
    private function primary() {
        $token = $this->currentToken;

        if ($token['type'] === Token::NUMBER) {
            $this->eat(Token::NUMBER);
            return [
                'type' => 'Number',
                'value' => $token['value']
            ];
        }

        if ($token['type'] === Token::IDENTIFIER) {
            $this->eat(Token::IDENTIFIER);
            // 检查是否是函数调用
            if ($this->currentToken['type'] === Token::LPAREN) {
                return $this->functionCall($token['value']);
            }
            return [
                'type' => 'Identifier',
                'value' => $token['value']
            ];
        }

        if ($token['type'] === Token::LCURLY) { // 处理 { } 包围的表达式
            $this->eat(Token::LCURLY);
            $node = $this->expression();
            $this->eat(Token::RCURLY);
            return [
                'type' => 'CurlyExpr',
                'value' => $node
            ];
        }

        if ($token['type'] === Token::LPAREN) {
            $this->eat(Token::LPAREN);
            $node = $this->expression();
            $this->eat(Token::RPAREN);
            return $node;
        }

        throw new Exception("解析错误: 不可识别的标记 " . $token['value']);
    }

    // 解析函数调用
    private function functionCall($funcName) {
        $this->eat(Token::LPAREN); // 吃掉左括号

        $args = [];
        if ($this->currentToken['type'] !== Token::RPAREN) {
            $args[] = $this->expression();

            while ($this->currentToken['type'] === Token::COMMA) {
                $this->eat(Token::COMMA);
                $args[] = $this->expression();
            }
        }

        $this->eat(Token::RPAREN); // 吃掉右括号

        return [
            'type' => 'FunctionCall',
            'name' => $funcName,
            'arguments' => $args
        ];
    }
}



if($_POST['lexical_text']){
    $lexical_code = $_POST['lexical_text'];

try {
    $input = $lexical_code;
    $lexer = new Lexer($input);
    var_dump($lexer);
    $parser = new Parser($lexer);
    $ast = $parser->parse();
    //var_dump($ast);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
}

if($_POST['lexical_text']){
    $lexical_code = $_POST['lexical_text'];
}


$gm_html =<<<HTML
<form method="post">
测试解析字符串:<textarea name="lexical_text" maxlength="4096" rows="4" cols="40">{$lexical_code}</textarea><br/>
<input type="submit" value="提交">
</form>
HTML;
echo $gm_html;



$end_time = hrtime(true);
$execution_time = ($end_time - $start_time) / 1e6;// 单位是毫秒
echo "执行时间：".$execution_time."ms"; // 输出结果
?>
