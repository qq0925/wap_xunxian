<?php
if ($argc < 2) {
    exit("缺少 NPC ID 参数\n");
}

$npcId = (int) $argv[1]; // 获取 NPC ID

// 连接数据库
$dsn = "mysql:host=localhost;dbname=xunxian;charset=utf8mb4";
$username = "root"; 
$password = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    exit("数据库连接失败！");
}

// 获取 NPC 详情
$stmt = $pdo->prepare("SELECT name, type, location FROM npc WHERE id = ?");
$stmt->execute([$npcId]);
$npc = $stmt->fetch();

if (!$npc) {
    exit("NPC ID {$npcId} 不存在\n");
}

$npcName = $npc['name'];
$npcType = $npc['type'];
$npcLocation = $npc['location'];

// 处理 NPC 事件
switch ($npcType) {
    case 'wanderer': // **流浪 NPC，随机移动**
        $newLocation = rand(1, 10); // 假设地图有 10 个区域
        $pdo->prepare("UPDATE npc SET location = ? WHERE id = ?")->execute([$newLocation, $npcId]);
        error_log("NPC {$npcName} 移动到了区域 {$newLocation}");
        break;

    case 'monster': // **怪物 NPC，可能攻击玩家**
        $player = $pdo->query("SELECT id, username FROM players WHERE location = {$npcLocation} ORDER BY RAND() LIMIT 1")->fetch();
        if ($player) {
            $playerId = $player['id'];
            $playerName = $player['username'];

            // 假设怪物攻击玩家（简单扣血逻辑）
            $pdo->prepare("UPDATE players SET hp = GREATEST(hp - 10, 0) WHERE id = ?")->execute([$playerId]);
            error_log("怪物 {$npcName} 攻击了玩家 {$playerName} (ID: {$playerId})，造成 10 点伤害");
        }
        break;

    case 'merchant': // **商人 NPC，每分钟可能刷新库存**
        $pdo->exec("UPDATE npc_shop SET stock = stock + 1 WHERE npc_id = {$npcId}");
        error_log("商人 {$npcName} 刷新了库存");
        break;

    default:
        error_log("NPC {$npcName} (ID: {$npcId}) 无特殊行为");
        break;
}

?>
