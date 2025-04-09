<?php

try {
    // 先检查iid字段是否已经是自动递增
    $check_sql = "SHOW COLUMNS FROM system_item_module WHERE Field = 'iid'";
    $stmt = $dblj->query($check_sql);
    $column_info = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (strpos($column_info['Extra'], 'auto_increment') === false) {
        // 如果不是自动递增，则修改为自动递增
        $sql = "ALTER TABLE system_item_module MODIFY iid INT NOT NULL AUTO_INCREMENT";
        $result = $dblj->exec($sql);
        echo "成功修改system_item_module表的iid字段为自动递增字段。<br/>";
    }
} catch (PDOException $e) {
    echo "操作失败: " . $e->getMessage();
}
?>