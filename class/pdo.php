
<?php
$sqlname='xunxian';
$sqlpass='123456';
$dbhost='127.0.0.1';
$dbname='xunxian';
$dsn="mysql:host=$dbhost;dbname=$dbname;";
$dblj = new PDO($dsn,$sqlname,$sqlpass,array(PDO::ATTR_PERSISTENT=>true));
$dblj->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dblj->query("SET NAMES utf8mb4");



$servername = "127.0.0.1";
$username = "xunxian";
$password = "123456";
$dbname = "xunxian";
$db = new mysqli($servername, $username, $password, $dbname);
?>