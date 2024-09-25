<?php

$start_time = hrtime(true);
class Lexer {
    private $input;
    private $position;
    private $currentChar;

    public function __construct($input) {
        $this->input = $input;
        $this->position = 0;
        $this->currentChar = $input[$this->position];
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
                    return $this->createToken(Token::LPAREN, '(');
                case ')':
                    $this->advance();
                    return $this->createToken(Token::RPAREN, ')');
                case '{':
                    $this->advance();
                    return $this->createToken(Token::LCURLY, '{');
                case '}':
                    $this->advance();
                    return $this->createToken(Token::RCURLY, '}');
                case '.':
                    $this->advance();
                    return $this->createToken(Token::DOT, '.');
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
        while ($this->currentChar !== null && ctype_digit($this->currentChar)) {
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
}

class Token {
    const EOF = 'EOF';
    const IDENTIFIER = 'IDENTIFIER';
    const NUMBER = 'NUMBER';
    const PLUS = 'PLUS';
    const MINUS = 'MINUS';
    const MUL = 'MUL';
    const DIV = 'DIV';
    const LPAREN = 'LPAREN';
    const RPAREN = 'RPAREN';
    const LCURLY = 'LCURLY';
    const RCURLY = 'RCURLY';
    const FUNCTION = 'FUNCTION';
    const EVAL = 'EVAL';
    const DOT = 'DOT';
    const QUESTION = 'QUESTION';
    const COLON = 'COLON';
    const OR = 'OR';
    const AND = 'AND';
    const STRING = 'STRING';
    const GT = 'GT';
    const LT = 'LT';
    const GTE = 'GTE';
    const LTE = 'LTE';
    const EQ = 'EQ';
    const NEQ = 'NEQ';
}


class Interpreter {
    private $lexer;
    private $currentToken;
    private $contextCallback;
    private $dblj;
    private $sid;
    private $u_type;
    private $oid;
    private $o_type;
    private $mid;
    private $cid;
    private $eid;
    private $gid;

    public function __construct($lexer, $contextCallback, $dblj, $sid = null, $u_type = null, $oid = null, $o_type = null, $mid = null, $cid = null, $eid = null, $gid = null) {
        $this->lexer = $lexer;
        $this->currentToken = $this->lexer->getNextToken();
        $this->contextCallback = $contextCallback;
        $this->dblj = $dblj;
        $this->sid = $sid;
        $this->u_type = $u_type;
        $this->oid = $oid;
        $this->o_type = $o_type;
        $this->mid = $mid;
        $this->cid = $cid;
        $this->eid = $eid;
        $this->gid = $gid;
    }

    private function eat($tokenType) {
        if ($this->currentToken['type'] === $tokenType) {
            $this->currentToken = $this->lexer->getNextToken();
        } else {
            throw new Exception("无效的语法: 期望 {$tokenType}, 但找到 {$this->currentToken['type']}");
        }
    }

    public function expr() {
        return $this->or_expr();
    }

    private function or_expr() {
        $result = $this->and_expr();

        while ($this->currentToken['type'] === Token::OR) {
            $this->eat(Token::OR);
            $result = $result || $this->and_expr();
        }

        return $result;
    }

    private function and_expr() {
        $result = $this->comparison_expr();

        while ($this->currentToken['type'] === Token::AND) {
            $this->eat(Token::AND);
            $result = $result && $this->comparison_expr();
        }

        return $result;
    }

    private function comparison_expr() {
        $result = $this->ternary_expr();

        while (in_array($this->currentToken['type'], [Token::GT, Token::LT, Token::GTE, Token::LTE, Token::EQ, Token::NEQ])) {
            $token = $this->currentToken;
            if ($token['type'] === Token::GT) {
                $this->eat(Token::GT);
                $result = $result > $this->ternary_expr();
            } elseif ($token['type'] === Token::LT) {
                $this->eat(Token::LT);
                $result = $result < $this->ternary_expr();
            } elseif ($token['type'] === Token::GTE) {
                $this->eat(Token::GTE);
                $result = $result >= $this->ternary_expr();
            } elseif ($token['type'] === Token::LTE) {
                $this->eat(Token::LTE);
                $result = $result <= $this->ternary_expr();
            } elseif ($token['type'] === Token::EQ) {
                $this->eat(Token::EQ);
                $result = $result == $this->ternary_expr();
            } elseif ($token['type'] === Token::NEQ) {
                $this->eat(Token::NEQ);
                $result = $result != $this->ternary_expr();
            }
        }

        return $result;
    }

    private function ternary_expr() {
        $result = $this->additive_expr();

        if ($this->currentToken['type'] === Token::QUESTION) {
            $this->eat(Token::QUESTION);
            $trueExpr = $this->ternary_expr();
            $this->eat(Token::COLON);
            $falseExpr = $this->ternary_expr();
            $result = $result ? $trueExpr : $falseExpr;
        }

        return $result;
    }

    private function additive_expr() {
        $result = $this->multiplicative_expr();

        while (in_array($this->currentToken['type'], [Token::PLUS, Token::MINUS])) {
            $token = $this->currentToken;
            if ($token['type'] === Token::PLUS) {
                $this->eat(Token::PLUS);
                $result += $this->multiplicative_expr();
            } elseif ($token['type'] === Token::MINUS) {
                $this->eat(Token::MINUS);
                $result -= $this->multiplicative_expr();
            }
        }

        return $result;
    }

    private function multiplicative_expr() {
        $result = $this->factor();

        while (in_array($this->currentToken['type'], [Token::MUL, Token::DIV])) {
            $token = $this->currentToken;
            if ($token['type'] === Token::MUL) {
                $this->eat(Token::MUL);
                $result *= $this->factor();
            } elseif ($token['type'] === Token::DIV) {
                $this->eat(Token::DIV);
                $result /= $this->factor();
            }
        }

        return $result;
    }

    private function factor() {
        $token = $this->currentToken;

        if ($token['type'] === Token::NUMBER) {
            $this->eat(Token::NUMBER);
            return intval($token['value']);
        } elseif ($token['type'] === Token::STRING) {
            $this->eat(Token::STRING);
            return $token['value'];
        } elseif ($token['type'] === Token::LPAREN) {
            $this->eat(Token::LPAREN);
            $result = $this->expr();
            $this->eat(Token::RPAREN);
            return $result;
        } elseif ($token['type'] === Token::LCURLY) {
            $this->eat(Token::LCURLY);
            $result = $this->expr();
            $this->eat(Token::RCURLY);
            return $result;
        } elseif ($token['type'] === Token::IDENTIFIER) {
            return $this->propertyAccess();
        } elseif ($token['type'] === Token::FUNCTION || $token['type'] === Token::EVAL) {
            return $this->functionCall();
        } else {
            throw new Exception("无效的语法: " . $token['type']);
        }
    }

    private function propertyAccess() {
        $object = $this->currentToken['value'];
        $this->eat(Token::IDENTIFIER);

        if ($this->currentToken['type'] === Token::DOT) {
            $this->eat(Token::DOT);
            $property = $this->currentToken['value'];
            $this->eat(Token::IDENTIFIER);
            return call_user_func($this->contextCallback, $object, $property, $this->dblj, $this->sid, $this->u_type, $this->oid, $this->o_type, $this->mid, $this->cid, $this->eid, $this->gid);
        }

        throw new Exception("属性访问错误");
    }

    private function functionCall() {
        $funcName = $this->currentToken['value'];
        $this->eat($this->currentToken['type']);
        $this->eat(Token::LPAREN);
        $result = null;

        if ($funcName === 'v') {
            $result = $this->expr();
        } elseif ($funcName === 'eval') {
            $result = $this->expr();
            $result = eval("return \"$result\";");
        } else {
            throw new Exception("未知的函数调用: $funcName");
        }

        $this->eat(Token::RPAREN);
        return $result;
    }
}


function contextCallback($object, $property, $dblj, $sid = null, $u_type = null, $oid = null, $o_type = null, $mid = null, $cid = null, $eid = null, $gid = null) {
    if ($object === 'u' && $sid !== null) {
        $attr_name = $object . $property;
        $stmt = $dblj->prepare("SELECT $attr_name FROM game1 WHERE sid = :sid");
        $stmt->execute(['sid' => $sid]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result[$attr_name] : null;
    }
    throw new Exception("属性不存在: $object.$property");
}

if($_POST['lexical_text']){
    $lexical_code = $_POST['lexical_text'];

try {
    $input = $lexical_code;
    $sid = "959c9277a3e15eacff9e5f117e51f5bb";
    $lexer = new Lexer($input);
    $contextCallback = function($object, $property, $dblj, $sid, $u_type, $oid, $o_type, $mid, $cid, $eid, $gid) {
        if ($object === 'u' && $property === 'sex') {
            return '男';
        }
        return null;
    };
    $interpreter = new Interpreter($lexer, $contextCallback, $dblj = null, $sid = null, $u_type = null, $oid = null, $o_type = null, $mid = null, $cid = null, $eid = null, $gid = null);
    $result = $interpreter->expr();
    echo $result."<br/>";
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
