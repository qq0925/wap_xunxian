<?php
// 模拟从数据库中获取抽奖项目的数据

$sql = "select * from system_draw where id = '$reward_change'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$reward_id = $ret['id'];
$reward_name = $ret['name'];
$reward_cons_type = $ret['cons_type'];
$reward_cons = $ret['cons_count'];
$reward_gift = $ret['draw_reward'];
$reward_cons_open_time = $ret['cons_open_time'];
$reward_cons_close_time = $ret['cons_close_time'];
$reward_gift_para = explode(",",$reward_gift);
$cons_type_detail = explode("|",$reward_cons)[0];
$cons_type_detail_count = explode("|",$reward_cons)[1];
if ($reward_cons_type == 1) {
    $cons_type = "金钱";
    $cons_type_detail = \player\getmoney_type_all($dblj,$cons_type_detail)['rname'];
    //货币表取得货币名
    
} elseif ($reward_cons_type == 2) {
    $cons_type = "物品";
    $cons_type_detail = \lexical_analysis\color_string(\player\getitem($cons_type_detail,$dblj)->iname);
    //物品表取得物品名
    
} else {
    $cons_type = "属性";
    $cons_type_detail = \gm\get_gm_attr_info(1,$cons_type_detail,$dblj)['name'];
    //属性表取得属性名
}

$prizes = [];
for ($i = 1; $i < @count($reward_gift_para) +1; $i++) {
    $reward_gift_detail = $reward_gift_para[$i-1];
    $reward_gift_detail_para = explode("|", $reward_gift_detail);
    $reward_gift_id = $reward_gift_detail_para[0];
    $reward_gift_count = $reward_gift_detail_para[1];
    $reward_gift_probability = $reward_gift_detail_para[2];
    $reward_gift_root_name = \player\getitem($reward_gift_id, $dblj)->iname;
    $reward_gift_name = \lexical_analysis\color_string($reward_gift_root_name);

    // Only add an item to $items if $reward_gift_id is not empty
    if ($reward_gift_id) {
        $prizes[] = [
            'image' => '',
            'real_name' =>"{$reward_gift_root_name}",
            'name' => "{$i}",
            'probability' =>"{$reward_gift_probability}",
            'prize_count' => "{$reward_gift_count}"
        ];
    }
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");


/******************** 页面展示部分 ********************/


// 计算每个奖品的固定角度
$prizeCount = count($prizes);
$fixedAngle = 360 / $prizeCount; // 每个奖品均占据相同角度

$currentAngle = $fixedAngle/2;

$reward_list =<<<HTML
抽奖项目：{$reward_name}<br/>
抽奖消耗($cons_type)：{$cons_type_detail}/{$cons_type_detail_count}<br/>
开放时间：「{$reward_cons_open_time}」到「{$reward_cons_close_time}」<br/>
奖品列表：<br/>
HTML;
for ($i = 1; $i < count($prizes) +1; $i++) {
    $p = &$prizes[$i-1]; // 获取当前元素
    $p['start_angle'] = $currentAngle;
    $p['end_angle'] = $currentAngle + $fixedAngle;
    $real_name = \lexical_analysis\color_string($p['real_name']);
    $prize_count = $p['prize_count'];
    $currentAngle += $fixedAngle;

    // 使用 heredoc 语法拼接 HTML 内容
    $reward_list .= <<<HTML
{$i}.{$real_name}x{$prize_count}<br/>
HTML;
}
echo "<a href='?cmd=$gobackgame'>返回游戏</a><br/>";
echo $reward_list;
unset($p);
$post_cmd = $encode->encode("cmd=system_reward&ucmd=$cmid&action=spin&reward_change=$reward_change&sid=$sid");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $reward_name; ?></title>
    <style>
        /* 修复圆形显示的核心样式 */
        .wheel-container {
            width: 500px;
            height: 500px; /* 必须与width相同 */
            margin: 0 auto;
            position: relative;
        }
/* 手机端样式 */
@media screen and (max-width: 768px) {
    .wheel-container {
            width: 300px;
            height: 300px; /* 必须与width相同 */
            margin: 50px 0 50px 20px;
            position: relative;
    }
}
@media screen and (min-width: 769px) and (max-width: 1024px) {
    .wheel-container {
            width: 400px;
            height: 400px; /* 必须与width相同 */
            margin: 50px 0 50px 20px;
            position: relative;
    }
}

        #wheel {
            width: 100%;
            height: 100%;
            border-radius: 50%; /* 圆形关键属性 */
            overflow: hidden;  /* 隐藏溢出部分 */
            position: relative;
            transition: transform 4s cubic-bezier(0.25, 0.1, 0.25, 1);
            transform: translateZ(0); /* 触发GPU加速 */
            backface-visibility: hidden; /* 修复边缘锯齿 */
            box-sizing: border-box;
        }

        .slice {
            position: absolute;
            width: 50%;
            height: 50%;
            transform-origin: 100% 100%;
            transform: rotate(<?= $rotate ?>deg) skewY(<?= 85 - $angle ?>deg);
            box-sizing: border-box;
        }

        .slice-text {
            position: absolute;
            right: 20px;
            bottom: 20px;
            transform-origin: center;
            white-space: nowrap;
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            font-size: 14px;
        }

        .pointer {
            position: absolute;
            top: -15px;
            left: 50%;
            width: 20px;
            height: 40px;
            background: #ff4757;
            transform: translateX(-50%);
            z-index: 2;
            clip-path: polygon(50% 0%, 100% 100%, 0% 100%);
        }

        #spin-btn {
            display: block;
            margin: 20px auto;
            padding: 15px 30px;
            font-size: 18px;
            background: #2ed573;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        #spin-btn:active {
            transform: scale(0.95);
        }

        /* 调试样式（可选） */
        .debug #wheel {
            box-shadow: 0 0 0 2px red;
        }
        .debug .slice {
            border: 1px solid rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>
    <!-- 添加调试类 -->
    <div class="wheel-container debug">
        <div class="pointer"></div>
        <div id="wheel">
            <?php foreach ($prizes as $i => $p): 
                $rotate = $currentAngle;
                $angle = $fixedAngle;  // 确保每个 slice 角度一致
                $textRotate = -($rotate + $angle / 2); // 修正文本旋转角度
                $hue = $i * (360 / $prizeCount);
            ?>
<div class="slice" 
     style="transform: rotate(<?= $rotate ?>deg) skewY(<?= 90 - $angle ?>deg);
            background: hsl(<?= $hue ?>, 70%, 40%)">
    <div class="slice-text" style="transform: rotate(<?= $textRotate ?>deg)">
        <?= htmlspecialchars($p['name']) ?>
    </div>
</div>
<?php 
    $currentAngle += $fixedAngle; // 增加角度
endforeach; 
?>
        </div>
    </div>
    <button id="spin-btn" onclick="startSpin()">立即抽奖</button>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    
        let isSpinning = false;
        const prizes = <?= json_encode($prizes) ?>;

function calculateRotation(index) {
    const prizeCount = prizes.length;
    const fixedAngle = 360 / prizeCount;
    const targetCenter = index * fixedAngle;
    const targetAngle = 360 - targetCenter;
    return 360 * 5 + targetAngle;
}

async function startSpin() {
    if(isSpinning) return;
    isSpinning = true;
    
    try {
        const btn = document.getElementById('spin-btn');
        //const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        btn.disabled = true;
        const cmd = <?= json_encode($post_cmd) ?>;
        const formData = new FormData();
        formData.append('cmd', cmd);
        //formData.append('csrf_token', getCSRFToken()); // 从Meta标签或Cookie获取
        
        // 发送抽奖请求
        const response = await fetch('gm_reward_spin.php', {
            method: 'POST',
            body: formData,
            credentials: 'include' // 携带Cookie
        });
        const responseText = await response.text();

        let result;
        try {
            result = JSON.parse(responseText);
            //console.log("抽奖结果: ", result);
        } catch (e) {
            console.error("JSON 解析失败，返回内容:", responseText);
            throw new Error("服务器返回数据异常");
        }
        
        if(result.error){
        Swal.fire({
            title: '🎉 错误！',
            html: result.error,
            icon: 'error',
            confirmButtonText: '确定',
        });
        return;
        }
        
        const wheel = document.getElementById('wheel');
        const currentRotation = getCurrentRotation(wheel) % 360;
        const targetRotation = currentRotation + calculateRotation(result.index);
        
        // 修正动画触发问题
        wheel.style.transition = "none"; 
        wheel.style.transform = `rotate(${currentRotation}deg)`;

        setTimeout(() => {
            wheel.style.transition = "transform 4s cubic-bezier(0.25, 0.1, 0.25, 1)";
            wheel.style.transform = `rotate(${targetRotation}deg)`;
        }, 50);

        // 显示中奖结果
    setTimeout(() => {
    let prizeText = result?.prize || '未知奖品';
    Swal.fire({
        title: '🎉 恭喜！',
        html: `获得：${prizeText}`,
        icon: 'success',
        confirmButtonText: '确定',
        didClose: () => {
            // 重置转盘到初始位置
            const wheel = document.getElementById('wheel');
            wheel.style.transition = "none";  // 禁用动画
            wheel.style.transform = "rotate(0deg)";  // 重置角度
        },
    });
    isSpinning = false;
    btn.disabled = false;
}, 4200);


    } catch(error) {
        alert('抽奖失败，请重试');
        console.error(error);
        isSpinning = false;
        document.getElementById('spin-btn').disabled = false;
    }
}


        function getCurrentRotation(element) {
    const style = window.getComputedStyle(element);
    const transform = style.transform;

    if (!transform || transform === "none") return 0;

    const values = transform.match(/matrix\(([^)]+)\)/);
    if (values) {
        const matrix = values[1].split(", ");
        const a = parseFloat(matrix[0]);
        const b = parseFloat(matrix[1]);
        const angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
        return angle < 0 ? angle + 360 : angle;
    }
    return 0;
}

    </script>
</body>
</html>
