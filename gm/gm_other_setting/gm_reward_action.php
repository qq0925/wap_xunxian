<?php



$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gobackgame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$mid&sid=$sid");
$reward_action = <<<HTML
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
<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/916.png' style="height: 1em;">
<span style="color: #0d0d0d">
商品1</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1228.png' style="height: 1em;">
<span style="color: #0d0d0d">
商品2</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1249.png' style="height: 1em;">
<span style="color: #0d0d0d">
资质丹                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1223.png' style="height: 1em;">
<span style="color: #0d0d0d">
强化神水（20%）                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/919.png' style="height: 1em;">
<span style="color: #0d9904">
一桶正龙泉水                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1610.png' style="height: 1em;">
<span style="color: #ebc005">
万年朱果袋                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1609.png' style="height: 1em;">
<span style="color: #0d9904">
千年朱果袋                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1617.png' style="height: 1em;">
<span style="color: #f10e0e">
星髓                                 </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1253.png' style="height: 1em;">
<span style="color: #0d9904">
传奇装备宝箱                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1107.png' style="height: 1em;">
<span style="color: #0d0d0d">
乾坤袋                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/928.png' style="height: 1em;">
<span style="color: #0d0d0d">
灵魂晶石                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1093.png' style="height: 1em;">
<span style="color: #0d0d0d">
万能鱼饵                                </span>

</div>
</div>

<div class="square">
<div class="center">
<button><a style="color: #0d0d0d" href="#">投放</a></button>
</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1274.png' style="height: 1em;">
<span style="color: #0d0d0d">
修炼丹                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/713.png' style="height: 1em;">
<span style="color: #0d9904">
宠物蛋礼盒（紫）                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1233.png' style="height: 1em;">
<span style="color: #0d9904">
100万经验卷                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1613.png' style="height: 1em;">
<span style="color: #0d0d0d">
精良装备宝箱                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1612.png' style="height: 1em;">
<span style="color: #0d9904">
迷你兽栏                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1608.png' style="height: 1em;">
<span style="color: #0d9904">
500万经验券                                </span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1614.png' style="height: 1em;">
<span style="color: #0d9904">
完美装备宝箱</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1614.png' style="height: 1em;">
<span style="color: #0d9904">
完美装备宝箱</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1614.png' style="height: 1em;">
<span style="color: #0d9904">
完美装备宝箱</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1613.png' style="height: 1em;">
<span style="color: #0d0d0d">
精良装备宝箱</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1254.png' style="height: 1em;">
<span style="color: #ebc005">
神话装备宝箱</span>

</div>
</div>

<div class="square">
<div class="outer">
<img src='/zhsh/public/static/image/home/goods/allgoods/1411.png' style="height: 1em;">
<span style="color: #0d9904">
高级圣痕礼盒</span>
</div>
</div>
</div>
<a href="?cmd=$gobackgame">返回游戏</a><br/>
HTML;
echo $reward_action;
?>