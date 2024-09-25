<?php
// 模拟从数据库中获取抽奖项目的数据
$reward_change = 1;
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
$items = []; // Initialize an empty array

for ($i = 0; $i < @count($reward_gift_para); $i++) {
    $reward_gift_detail = $reward_gift_para[$i];
    $reward_gift_detail_para = explode("|", $reward_gift_detail);
    $reward_gift_id = $reward_gift_detail_para[0];
    $reward_gift_count = $reward_gift_detail_para[1];
    $reward_gift_probability = $reward_gift_detail_para[2];
    $reward_gift_name = \player\getitem($reward_gift_id, $dblj)->iname;
    $reward_gift_name = \lexical_analysis\color_string($reward_gift_name);

    // Only add an item to $items if $reward_gift_id is not empty
    if ($reward_gift_id) {
        $items[] = [
            'image' => '', // You can adjust this value
            'name' => "{$reward_gift_name}",
            'color' => '#0d0d0d',
        ];
    }
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

// 输出 HTML
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>这里是抽奖项目名称</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 320px;
            height: 320px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            padding: 10px;
        }

        .square {
            width: 18%;
            height: 18%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        .outer {
            font-size: 12px;
            font-weight: bold;
        }

        .center {
            position: relative;
        }

        .center button {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            background-color: #ff0000;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
HTML;

// 遍历抽奖项目数据生成对应的 HTML 元素
foreach ($items as $item) {
    $image = $item['image'];
    $name = $item['name'];
    $color = $item['color'];

    echo <<<HTML
    <div class="square">
        <div class="outer">
            <img src='$image' style="height: 1em;">
            <span style="color: $color">$name</span>
        </div>
    </div>
HTML;
}

echo <<<HTML
    <div class="square">
        <div class="center">
            <button><a style="color: #0d0d0d" href="/zhsh/public/vip/starlaunch.html">投放</a></button>
        </div>
    </div>
</div>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
</body>
</html>
HTML;
?>
