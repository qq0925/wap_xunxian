<!DOCTYPE html>
<html>
<head>
    <title>JSON解析渲染</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <?php
    // 开始计时
    $startTime = microtime(true);
    require 'class/player.php';
    require 'class/encode.php';
    require 'class/gm.php';
    include 'pdo.php';
    require 'class/lexical_analysis.php';
    require 'class/event_data_get.php';
    require 'class/data_lexical.php';
    include 'class/iniclass.php';
    include 'class/global_event_step_change.php';
    require 'class/basic_function_todo.php';
    // 初始化变量
    $sid = $_GET['sid'] ?? null;
    $oid = $_GET['oid'] ?? null;
    $mid = $_GET['mid'] ?? null;
    $cmd = $_GET['cmd'] ?? '';
    $cmid = 0;
    $cdid = [];
    $clj = [];
    $parents_page = $_SERVER['PHP_SELF'];
    $encode = new \encode\encode();
    
    /**
     * 解析JSON字符串，渲染成页面内容
     * 
     * @param string $jsonString JSON字符串
     * @param string $sid 会话ID
     * @param string $oid 对象ID
     * @param string $mid 模块ID
     * @param string $cmd 命令
     * @param string $parents_page 父页面
     * @param object $encode 编码对象
     * @param object $dblj 数据库连接
     * @param int &$cmid 命令ID引用
     * @param array &$cdid 命令ID数组引用
     * @param array &$clj 命令链接数组引用
     * @return string 渲染后的HTML内容
     */
    function renderJsonToHtml($jsonString, $sid, $oid, $mid, $cmd, $parents_page, $encode, $dblj, &$cmid, &$cdid, &$clj) {
        // 解析JSON
        $data = json_decode($jsonString, true);
        $rendered_html = '';
        $error_messages = '';
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return '<p style="color: red;">JSON解析错误: ' . json_last_error_msg() . '</p>';
        }
        
        // 渲染内容
        if (!isset($data['content']) || !is_array($data['content'])) {
            return '<p>无有效内容</p>';
        }
        
        foreach ($data['content'] as $index => $item) {
            // 提取数据并检查必要字段
            $main_id = $item['id'] ?? 0;
            $main_type = $item['type'] ?? 0;
            $main_value = $item['value'] ?? '';
            $main_show_cond = $item['show_cond'] ?? '';
            $main_target_event = $item['target_event'] ?? 0;
            $main_target_func = $item['target_func'] ?? 0;
            $main_link_value = $item['link_value'] ?? '';
            
            // 检查显示条件
            $show_ret = $main_show_cond !== '' 
                ? \lexical_analysis\process_string($main_show_cond, $sid, $oid, $mid, null, null, "check_cond") 
                : 1;
            
            try {
                @$ret = eval("return $show_ret;");
            } catch (\ParseError $e) {
                $itemIndex = $index + 1;
                $error_messages .= "<p style='color: red;'>第{$itemIndex}个元素的显示条件语法错误: ". $e->getMessage()."</p>";
                continue;
            } catch (\Error $e) {
                $itemIndex = $index + 1;
                $error_messages .= "<p style='color: red;'>第{$itemIndex}个元素的显示条件执行错误: ". $e->getMessage()."</p>";
                continue;
            }
            
            $ret_bool = ($ret !== false && $ret !== null) ? 0 : 1;
            if ($ret_bool != 0) {
                continue; // 不满足显示条件，跳过此元素
            }
            
            // 处理换行
            $br_count_html = '';
            if ($main_type != 1) {
                list($main_value, $br_count) = trimTrailingNewlinesAndCount($main_value);
                $br_count_html = str_repeat("<br/>", $br_count);
            } else {
                $main_value = nl2br($main_value);
            }
            
            // 解析文本内容
            $main_value = \lexical_analysis\process_string($main_value, $sid, $oid, $mid);
            $main_value = \lexical_analysis\process_photoshow($main_value);
            $main_value = \lexical_analysis\color_string($main_value);
            
            // 处理事件和函数
            if ($main_target_event != 0) {
                $cmid++;
                $cdid[] = $cmid;
                $clj[] = $index;
                $main_target_event = $encode->encode("cmd=main_target_event&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
            } elseif ($main_target_event == 0) {
                $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&ucmd=$cmid&parents_page=$parents_page&sid=$sid");
            }
            
            if ($main_target_func != 0) {
                $main_target_func = basic_func_choose($cmd, $main_target_func, $sid, $dblj, $main_value, 0, 11, $cmid);
            }
            
            // 根据类型渲染不同的HTML
            switch ($main_type) {
                case 1: // 纯文本
                    $rendered_html .= $main_value;
                    break;
                    
                case 2: // 链接
                    $rendered_html .= "<a href=\"?cmd=$main_target_event\">$main_value</a>$br_count_html";
                    break;
                    
                case 3: // 函数调用
                    if ($main_target_func) {
                        $rendered_html .= "$main_target_func$br_count_html";
                    }
                    break;
                    
                case 4: // 外部链接
                    $rendered_html .= "<a href=\"$main_link_value\">$main_value</a>$br_count_html";
                    break;
                    
                case 5: // 表单
                    $rendered_html .= "<form action=\"?cmd=$main_target_event\" method=\"POST\">$main_value$br_count_html</form>";
                    break;
                    
                default:
                    $rendered_html .= "<p>不支持的内容类型: $main_type</p>";
                    break;
            }
        }
        
        // 返回错误信息和渲染的HTML
        return $error_messages . $rendered_html;
    }
    ?>
    
    <h1>JSON解析渲染</h1>
    
    <div class="container">
        <h2>JSON页面渲染</h2>
        <div id="output">
            <?php
            // 示例JSON字符串 - 扩展以支持5种元素类型
            $jsonString = '
            {
                "content": [
                    {
                        "id": 1,
                        "type": 1,
                        "value": "这是一段纯文本内容。",
                        "show_cond": "",
                        "target_event": 0,
                        "target_func": 0,
                        "link_value": ""
                    },
                    {
                        "id": 2,
                        "type": 2,
                        "value": "这是一个链接",
                        "show_cond": "",
                        "target_event": 100,
                        "target_func": 0,
                        "link_value": ""
                    },
                    {
                        "id": 3,
                        "type": 3,
                        "value": "这是函数调用",
                        "show_cond": "user=admin",
                        "target_event": 0,
                        "target_func": 101,
                        "link_value": ""
                    },
                    {
                        "id": 4,
                        "type": 4,
                        "value": "这是外部链接",
                        "show_cond": "lang=php",
                        "target_event": 0,
                        "target_func": 0,
                        "link_value": "https://www.php.net"
                    },
                    {
                        "id": 5,
                        "type": 5,
                        "value": "<input type=\'text\' name=\'username\' />",
                        "show_cond": "",
                        "target_event": 102,
                        "target_func": 0,
                        "link_value": ""
                    }';
            
            // 添加更多元素，直到500个
            for ($i = 6; $i <= 500; $i++) {
                // 每5个元素设置一个条件
                $condition = '';
                if ($i % 5 == 0) {
                    $condition = 'show=all';
                } elseif ($i % 10 == 0) {
                    $condition = 'level=advanced';
                }
                
                // 随机选择元素类型 (1-5)
                $type = ($i % 5) + 1;
                
                // 设置属性基于类型
                $target_event = 0;
                $target_func = 0;
                $link_value = '';
                
                if ($type == 2) {
                    $target_event = 100 + $i;
                } elseif ($type == 3) {
                    $target_func = 100 + $i;
                } elseif ($type == 4) {
                    $link_value = "https://example.com/link" . $i;
                } elseif ($type == 5) {
                    $target_event = 200 + $i;
                }
                
                $jsonString .= ',
                {
                    "id": ' . $i . ',
                    "type": ' . $type . ',
                    "value": "这是第' . $i . '个元素",
                    "show_cond": "' . $condition . '",
                    "target_event": ' . $target_event . ',
                    "target_func": ' . $target_func . ',
                    "link_value": "' . $link_value . '"
                }';
            }
            
            $jsonString .= '
                ]
            }';
            
            // 调用函数渲染JSON
            echo renderJsonToHtml($jsonString, $sid, $oid, $mid, $cmd, $parents_page, $encode, $dblj, $cmid, $cdid, $clj);
            ?>
        </div>
    </div>
    
    <div class="container" style="margin-top: 20px;">
        <h2>自定义JSON解析</h2>
        <form method="post" action="">
            <textarea name="json_input" style="width: 100%; height: 200px; margin-bottom: 10px;"><?php echo isset($_POST['json_input']) ? htmlspecialchars($_POST['json_input']) : ''; ?></textarea>
            <button type="submit" style="padding: 8px 16px;">解析渲染</button>
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['json_input'])) {
            echo '<h3>渲染结果：</h3>';
            echo '<div id="custom-output">';
            
            $customJson = $_POST['json_input'];
            // 调用函数渲染自定义JSON
            echo renderJsonToHtml($customJson, $sid, $oid, $mid, $cmd, $parents_page, $encode, $dblj, $cmid, $cdid, $clj);
            
            // 如果没有内容，显示示例格式
            if (empty(trim($customJson))) {
                echo '<p>请输入JSON数据，示例格式：</p>';
                echo '<pre>{
    "content": [
        {
            "id": 1,
            "type": 1,
            "value": "这是纯文本",
            "show_cond": "",
            "target_event": 0,
            "target_func": 0,
            "link_value": ""
        },
        {
            "id": 2,
            "type": 2,
            "value": "这是链接",
            "show_cond": "user=admin",
            "target_event": 100,
            "target_func": 0,
            "link_value": ""
        },
        {
            "id": 3,
            "type": 3,
            "value": "这是函数调用",
            "show_cond": "",
            "target_event": 0,
            "target_func": 101,
            "link_value": ""
        },
        {
            "id": 4,
            "type": 4,
            "value": "这是外部链接",
            "show_cond": "",
            "target_event": 0,
            "target_func": 0,
            "link_value": "https://example.com"
        },
        {
            "id": 5,
            "type": 5,
            "value": "<input type=\'text\' name=\'username\' />",
            "show_cond": "",
            "target_event": 102,
            "target_func": 0,
            "link_value": ""
        }
    ]
}</pre>';
            }
            
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="footer">
        <?php
        // 计算并显示耗时
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000; // 转换为毫秒
        echo sprintf('页面加载耗时: %.2f 毫秒', $executionTime);
        
        // 添加退出链接
        $logout = $encode->encode("cmd=logout&sid=$sid");
        echo '<br/><a href="?cmd='.$logout.'">退出游戏</a>';
        ?>
    </div>
</body>
</html>
