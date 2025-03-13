<?php
include 'pdo.php';

try {
    $db = DB::pdo();
    $db->beginTransaction(); // 开启事务提升批量更新性能

    // 定义需要处理的表和字段组合
    $operations =['system_npc', 'ndrop_item'];

        // 步骤1：查询符合格式的数据
        $sql = "SELECT nid,ndrop_item FROM system_npc WHERE ndrop_item REGEXP '^[^|]+\\\\|[^,]+(,[^|]+\\\\|[^,]+)*$'";
        $stmt = $db->query($sql);
        
        if (!$stmt) {
            throw new Exception("查询失败: " . implode(', ', $db->errorInfo()));
        }

        // 步骤2：遍历数据并转换
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jsonData = itemsconvertStringToJson($row['ndrop_item']);
            
            // 步骤3：更新回数据库
            $updateSql = "UPDATE system_npc SET ndrop_item = ? WHERE nid = ?";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->execute([$jsonData, $row['nid']]);
            
            if ($updateStmt->rowCount() === 0) {
                error_log("更新失败: ID {$row['nid']}");
            }
        }
    

    $db->commit();
} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    die("处理失败: " . $e->getMessage());
}
?>