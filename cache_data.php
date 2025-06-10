<?php
include 'pdo.php';

$pdo = DB::pdo();
// 2. 连接 Redis
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->select(1);
// 3. 查询数据库
$sql = "SELECT * FROM game1"; // 替换成你的表名
$stmt = $pdo->prepare($sql);
$stmt->execute();

// 4. 获取所有数据
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 5. 将数据写入 Redis
$cacheKey = 'xunxian_all_data';
$redis->set($cacheKey, json_encode($data)); // 将数据以 JSON 格式存入 Redis
$redis->expire($cacheKey, 3600); // 设置过期时间为1小时（3600秒）

echo "数据已成功写入 Redis 缓存";

// 6. 关闭连接
$pdo = null;
$redis->close();
?>
