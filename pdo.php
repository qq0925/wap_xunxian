<?php

if (!file_exists('db_configs.php')) {
    die('未找到配置文件: db_configs.php，请先创建并配置数据库信息，可以参考 configs_example.php 文件');
}
$configs = include 'db_configs.php';

if (!class_exists('DB')) {
    class DB
    {
        private static $pdo;

        public static function pdo()
        {
            self::connect();
            return self::$pdo;
        }

        public static function conn()
        {
            global $db;
            return $db;
        }

        private static function connect()
        {
            global $configs;
            if (!self::$pdo) {
                $dsn = "mysql:host={$configs['db_host']};dbname={$configs['db_name']}";
                self::$pdo = new PDO($dsn, $configs['db_user'], $configs['db_password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->query("SET NAMES utf8mb4");
            }
        }
    }
}


$dblj = DB::pdo();