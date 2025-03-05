<?php
include 'pdo.php';

try {
    $db = DB::pdo();
    $db->beginTransaction(); // 开启事务提升批量更新性能

    // 定义需要处理的表和字段组合
    $operations = [
        ['system_event_evs_self', 's_attrs'],
        ['system_event_evs', 's_attrs'],
        ['system_event_evs_self', 'm_attrs'],
        ['system_event_evs', 'm_attrs']
    ];

    foreach ($operations as $op) {
        list($table, $field) = $op;
        
        // 步骤1：查询符合格式的数据
        $sql = "SELECT id, $field FROM $table WHERE $field REGEXP '^[^=]+=[^=]+(,[^=]+=[^=]+)*$'";
        $stmt = $db->query($sql);
        
        if (!$stmt) {
            throw new Exception("查询失败: " . implode(', ', $db->errorInfo()));
        }

        // 步骤2：遍历数据并转换
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jsonData = convertStringToJson($row[$field]);
            
            // 步骤3：更新回数据库
            $updateSql = "UPDATE $table SET $field = ? WHERE id = ?";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->execute([$jsonData, $row['id']]);
            
            if ($updateStmt->rowCount() === 0) {
                error_log("更新失败: ID {$row['id']}");
            }
        }
    }

    $db->commit();
} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    die("处理失败: " . $e->getMessage());
}

// 增强版转换函数（处理转义字符）
function convertStringToJson($input) {
    $result = [];
    // 处理转义逗号和等号（如 a=b\,c => "b,c"）
    $pairs = preg_split('/(?<!\\\\),/', $input);
    
    foreach ($pairs as $pair) {
        $pair = trim($pair);
        if (empty($pair)) continue;

        // 分割键值（允许值中包含未转义的等号）
        $parts = preg_split('/(?<!\\\\)=/', $pair, 2);
        if (count($parts) !== 2) continue;

        $key = trim(str_replace('\=', '=', $parts[0]));
        $value = trim(str_replace(['\,', '\='], [',', '='], $parts[1]));

        // 移除冗余的包裹引号（支持单双引号）
        if (preg_match('/^["\'](.*)["\']$/s', $value, $matches)) {
            $value = $matches[1];
        }

        $result[$key] = $value;
    }
    
    return json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
?>