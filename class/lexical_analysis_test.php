<?php

class TokenType
{
    const NUMBER = 'NUMBER';
    const IDENTIFIER = 'IDENTIFIER';
    const OPERATOR = 'OPERATOR';
    const BRACE_OPEN = 'BRACE_OPEN';
    const BRACE_CLOSE = 'BRACE_CLOSE';
    const FUNC_OPEN = 'FUNC_OPEN';
    const FUNC_CLOSE = 'FUNC_CLOSE';
    const QUESTION = 'QUESTION';
    const COLON = 'COLON';
    // Add other token types as needed
}

class Token
{
    public $type;
    public $value;

    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }
}

class Lexer
{
    private $text;
    private $pos;
    private $currentChar;

    public function __construct($text)
    {
        $this->text = $text;
        $this->pos = 0;
        $this->currentChar = isset($text[$this->pos]) ? $text[$this->pos] : null;
    }

    private function advance()
    {
        $this->pos++;
        $this->currentChar = isset($this->text[$this->pos]) ? $this->text[$this->pos] : null;
    }

    private function skipWhitespace()
    {
        while ($this->currentChar !== null && ctype_space($this->currentChar)) {
            $this->advance();
        }
    }

    private function number()
    {
        $result = '';
        while ($this->currentChar !== null && ctype_digit($this->currentChar)) {
            $result .= $this->currentChar;
            $this->advance();
        }
        return new Token(TokenType::NUMBER, $result);
    }

    private function identifier()
    {
        $result = '';
        while ($this->currentChar !== null && (ctype_alnum($this->currentChar) || $this->currentChar == '.')) {
            $result .= $this->currentChar;
            $this->advance();
        }
        return new Token(TokenType::IDENTIFIER, $result);
    }

    public function getNextToken()
    {
        while ($this->currentChar !== null) {
            if (ctype_space($this->currentChar)) {
                $this->skipWhitespace();
                continue;
            }

            if (ctype_digit($this->currentChar)) {
                return $this->number();
            }

            if (ctype_alpha($this->currentChar) || $this->currentChar == '{' || $this->currentChar == '}') {
                return $this->identifier();
            }

            if ($this->currentChar == '>') {
                $this->advance();
                return new Token(TokenType::OPERATOR, '>');
            }

            if ($this->currentChar == '<') {
                $this->advance();
                return new Token(TokenType::OPERATOR, '<');
            }

            if ($this->currentChar == '=') {
                $this->advance();
                return new Token(TokenType::OPERATOR, '=');
            }

            if ($this->currentChar == '{') {
                $this->advance();
                return new Token(TokenType::BRACE_OPEN, '{');
            }

            if ($this->currentChar == '}') {
                $this->advance();
                return new Token(TokenType::BRACE_CLOSE, '}');
            }

            if ($this->currentChar == '(') {
                $this->advance();
                return new Token(TokenType::FUNC_OPEN, '(');
            }

            if ($this->currentChar == ')') {
                $this->advance();
                return new Token(TokenType::FUNC_CLOSE, ')');
            }

            if ($this->currentChar == '?') {
                $this->advance();
                return new Token(TokenType::QUESTION, '?');
            }

            if ($this->currentChar == ':') {
                $this->advance();
                return new Token(TokenType::COLON, ':');
            }

            throw new Exception("Unrecognized character: " . $this->currentChar);
        }

        return null;
    }
}





class Database
{
    private $pdo;

    public function __construct($dsn, $username, $password)
    {
        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function query($sid, $name)
    {
        $stmt = $this->pdo->prepare('SELECT value FROM game1 WHERE sid = :sid AND name = :name');
        $stmt->execute(['sid' => $sid, 'name' => $name]);
        return $stmt->fetchColumn();
    }
}

class Cache
{
    private $cache;

    public function __construct()
    {
        $this->cache = [];
    }

    public function get($key)
    {
        return $this->cache[$key] ?? null;
    }

    public function set($key, $value)
    {
        $this->cache[$key] = $value;
    }
}


// 示例数据库DSN，用户名和密码（请根据实际情况调整）
$dsn = 'mysql:host=localhost;dbname=xunxian';
$username = 'xunxian';
$password = '123456';

// 创建数据库和缓存实例
$database = new Database($dsn, $username, $password);
$cache = new Cache();

$sid = '12345';

// 示例输入表达式
$input1 = '{u.money}>3';
$input2 = '{eval(v(u.money)>=10?v(u.choose1):v(u.choose2))}';

$lexer = new Lexer($input1);
while (($token = $lexer->getNextToken()) !== null) {
    echo 'Token: ' . $token->type . ' Value: ' . $token->value . PHP_EOL;
}

$lexer = new Lexer($input2);
while (($token = $lexer->getNextToken()) !== null) {
    echo 'Token: ' . $token->type . ' Value: ' . $token->value . PHP_EOL;


// 示例输入表达式
$input1 = '{u.money}>3';
$input2 = '{eval(v(u.money)>=10?v(u.choose1):v(u.choose2))}';

$result1 = evaluateExpression($input1, $variables, $database, $cache, $sid);
$result2 = evaluateExpression($input2, $variables, $database, $cache, $sid);

echo "Result 1: " . ($result1 ? 'true' : 'false') . PHP_EOL;
echo "Result 2: " . $result2 . PHP_EOL;


function evaluateExpression($input, $variables, $database, $cache, $sid) {
    $lexer = new Lexer($input);
    $parser = new Parser($lexer);
    $evaluator = new Evaluator($variables, $database, $cache, $sid);

    // 解析并计算表达式
    $ast = $parser->expr();
    return $evaluator->eval($ast);
}

class Parser
{
    private $lexer;
    private $currentToken;

    public function __construct($lexer)
    {
        $this->lexer = $lexer;
        $this->currentToken = $this->lexer->getNextToken();
    }

    private function eat($tokenType)
    {
        if ($this->currentToken->type === $tokenType) {
            $this->currentToken = $this->lexer->getNextToken();
        } else {
            throw new Exception("Unexpected token: " . $this->currentToken->type);
        }
    }

    private function factor()
    {
        if ($this->currentToken->type == TokenType::NUMBER) {
            $token = $this->currentToken;
            $this->eat(TokenType::NUMBER);
            return new Num($token);
        } elseif ($this->currentToken->type == TokenType::IDENTIFIER) {
            $token = $this->currentToken;
            $this->eat(TokenType::IDENTIFIER);
            if ($this->currentToken->type == TokenType::FUNC_OPEN) {
                $this->eat(TokenType::FUNC_OPEN);
                $arg = $this->expr();
                $this->eat(TokenType::FUNC_CLOSE);
                return new FuncCall($token, $arg);
            }
            return new VarNode($token);
        } elseif ($this->currentToken->type == TokenType::BRACE_OPEN) {
            $this->eat(TokenType::BRACE_OPEN);
            $node = $this->expr();
            $this->eat(TokenType::BRACE_CLOSE);
            return $node;
        }
    }

    private function term()
    {
        $node = $this->factor();
        while (in_array($this->currentToken->type, [TokenType::OPERATOR])) {
            $token = $this->currentToken;
            $this->eat(TokenType::OPERATOR);
            $node = new BinOp($node, $token, $this->factor());
        }
        return $node;
    }

    public function expr()
    {
        $node = $this->term();

        if ($this->currentToken->type == TokenType::QUESTION) {
            $this->eat(TokenType::QUESTION);
            $trueExpr = $this->expr();
            $this->eat(TokenType::COLON);
            $falseExpr = $this->expr();
            return new Ternary($node, $trueExpr, $falseExpr);
        }

        return $node;
    }
}

class FuncCall
{
    public $name;
    public $arg;

    public function __construct($name, $arg)
    {
        $this->name = $name;
        $this->arg = $arg;
    }
}

class Ternary
{
    public $condition;
    public $trueExpr;
    public $falseExpr;

    public function __construct($condition, $trueExpr, $falseExpr)
    {
        $this->condition = $condition;
        $this->trueExpr = $trueExpr;
        $this->falseExpr = $falseExpr;
    }
}

class Evaluator
{
    private $variables;
    private $database;
    private $cache;
    private $sid;

    public function __construct($variables, $database, $cache, $sid)
    {
        $this->variables = $variables;
        $this->database = $database;
        $this->cache = $cache;
        $this->sid = $sid;
    }

    public function eval($node)
    {
        if ($node instanceof Num) {
            return $node->value;
        }

        if ($node instanceof VarNode) {
            $value = $this->getVariableValue($node->name);
            if ($value === null) {
                throw new Exception("Undefined variable: " . $node->name);
            }
            return $value;
        }

        if ($node instanceof BinOp) {
            $left = $this->eval($node->left);
            $right = $this->eval($node->right);

            switch ($node->op->value) {
                case '>':
                    return $left > $right;
                case '<':
                    return $left < $right;
                case '=':
                    return $left == $right;
                // Add other operators as needed
                default:
                    throw new Exception("Unknown operator: " . $node->op->value);
            }
        }

        if ($node instanceof FuncCall) {
            $arg = $this->eval($node->arg);
            switch ($node->name->value) {
                case 'v':
                    return $this->getVariableValue($arg);
                case 'eval':
                    $lexer = new Lexer($arg);
                    $parser = new Parser($lexer);
                    $ast = $parser->expr();
                    return $this->eval($ast);
                default:
                    throw new Exception("Unknown function: " . $node->name->value);
            }
        }

        if ($node instanceof Ternary) {
            $condition = $this->eval($node->condition);
            if ($condition) {
                return $this->eval($node->trueExpr);
            } else {
                return $this->eval($node->falseExpr);
            }
        }

        throw new Exception("Unknown node type");
    }

    private function getVariableValue($name)
    {
        if (isset($this->variables[$name])) {
            return $this->variables[$name];
        }

        // Check cache
        $cacheKey = $this->sid . ':' . $name;
        $value = $this->cache->get($cacheKey);
        if ($value !== null) {
            return $value;
        }

        // Query database
        $value = $this->database->query($this->sid, $name);
        if ($value !== null) {
            $this->cache->set($cacheKey, $value);
            return $value;
        }

        return null;
    }
}

?>