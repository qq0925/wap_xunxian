<?php
require_once "../pdo.php";
require_once "../class/player.php";
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/8
 * Time: 0:10
 */
//user_id=$user_id&order_id=$user_id-$user_id-$out_trade_no&pay_type=2&result_code=0&amount=$total_fee&pay-time=$pay_time
$uid = $_GET['user_id'];
$amount = $_GET['amount'];
$player = \player\getplayer1($uid,$dblj);
\player\changeczb(1,$amount*10,$player->sid,$dblj);
echo "充值成功".$amount*10;