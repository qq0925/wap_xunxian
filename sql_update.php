<?php


try {
    $query = $dblj->prepare("SHOW TABLES LIKE 'system_module_cj'");
    $query->execute();
    $table_exists = $query->fetch();

    if (!$table_exists) {
        $dblj->beginTransaction();
        $dblj->exec("CREATE TABLE system_module_cj (
            module_id INT NOT NULL,
            css TEXT NOT NULL DEFAULT '',
            js TEXT NOT NULL DEFAULT ''
        )");

        // 插入数据，提供所有NOT NULL字段的值
        // 插入数据，从1到14
        $sql = "INSERT INTO system_module_cj (module_id, css, js) 
                VALUES 
                    (1, '', ''), (2, '', ''), (3, '', ''), 
                    (4, '', ''), (5, '', ''), (6, '', ''), 
                    (7, '', ''), (8, '', ''), (9, '', ''), 
                    (10, '', ''), (11, '', ''),(14, '', '')";
        $affectedRows = $dblj->exec($sql);

        if ($affectedRows === false) {
            throw new Exception("插入数据失败");
        }

        $dblj->commit();
    }
} catch (PDOException $e) {
    if ($dblj->inTransaction()) {
        $dblj->rollBack();
    }
    echo "操作时出错: " . $e->getMessage();
} catch (Exception $e) {
    if ($dblj->inTransaction()) {
        $dblj->rollBack();
    }
    echo $e->getMessage();
}


    $sql = "SHOW COLUMNS FROM system_self_define_module LIKE 'css'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE system_self_define_module ADD COLUMN css TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "ALTER TABLE system_self_define_module ADD COLUMN js TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }


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

try {
    // 先检查iid字段是否已经是自动递增
    $check_sql = "SHOW COLUMNS FROM system_task_father WHERE Field = 'f_id'";
    $stmt = $dblj->query($check_sql);
    $column_info = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (strpos($column_info['Extra'], 'auto_increment') === false) {
        // 如果不是自动递增，则修改为自动递增
        $sql = "ALTER TABLE system_task_father MODIFY f_id INT(11) NOT NULL AUTO_INCREMENT";
        $result = $dblj->exec($sql);
        $sql = "insert into system_task_father(f_name,f_desc)value('未知系列','未知系列任务') ";
        $result = $dblj->exec($sql);
        $sql = "update system_task set tbelong = 1 WHERE tbelong = 0";
        $result = $dblj->exec($sql);
        echo "成功修改system_task_father表的f_id字段为自动递增字段。<br/>";
    }
} catch (PDOException $e) {
    echo "操作失败: " . $e->getMessage();
}

    $sql = "SHOW COLUMNS FROM gm_game_basic LIKE 'item_head'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE gm_game_basic ADD COLUMN item_head TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }

    $sql = "SHOW COLUMNS FROM system_region LIKE 'change_cond'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE system_region ADD COLUMN change_cond TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "ALTER TABLE system_region ADD COLUMN cmmt2 TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }


    $sql = "SHOW COLUMNS FROM gm_game_basic LIKE 'chat_head'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE gm_game_basic ADD COLUMN chat_head TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }

    $sql = "SHOW COLUMNS FROM gm_game_basic LIKE 'fight_head'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE gm_game_basic ADD COLUMN fight_head TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }


?>