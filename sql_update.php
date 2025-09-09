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

$modifications = [
    'game2' => [
        'set_default' => ['hurt_hp', 'cut_hp', 'hurt_mp', 'cut_mp'],
        'drop_notnull' => ['fight_umsg', 'fight_omsg']
    ],
    'game3' => [
        'set_default' => ['hurt_hp', 'cut_hp', 'hurt_mp', 'cut_mp'],
        'drop_notnull' => []
    ],
    'system_item'=>[
        'set_default' =>['iequiped','icreate_sale_time','iexpire_sale_time','isale_time','iroot']
        ],
    'system_chat_data'=>[
        'set_default' =>['send_type','send_time','uid','imuid']
        ]
];


    foreach ($modifications as $table => $changes) {
        // 修改默认值为0
        if (!empty($changes['set_default'])) {
            foreach ($changes['set_default'] as $column) {
                modify_column_default($dblj, $table, $column);
            }
        }
        
        // 取消NOT NULL约束
        if (!empty($changes['drop_notnull'])) {
            foreach ($changes['drop_notnull'] as $column) {
                drop_column_notnull($dblj, $table, $column);
            }
        }
    }



function modify_column_default($dblj, $table, $column) {
    // 检查当前默认值
    $stmt = $dblj->prepare("
        SELECT COLUMN_DEFAULT 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = :table 
        AND COLUMN_NAME = :column
    ");
    
    $stmt->execute([':table' => $table, ':column' => $column]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $current_default = $result['COLUMN_DEFAULT'];
        
        // 判断是否需要修改
        if ($current_default !== '0') {
            // 执行修改
            try {
                $alter_sql = "ALTER TABLE $table ALTER COLUMN $column SET DEFAULT 0";
                $dblj->exec($alter_sql);
            } catch (PDOException $e) {
                echo "<p style='color: red;'>修改 $table.$column 默认值失败: " . $e->getMessage() . "</p>";
            }
        }
    } else {
        echo "<p style='color: red;'>错误: 字段 $table.$column 不存在</p>";
    }
}

/**
 * 取消字段的NOT NULL约束（如果需要）
 */
function drop_column_notnull($dblj, $table, $column) {
    // 检查当前是否为NOT NULL
    $stmt = $dblj->prepare("
        SELECT IS_NULLABLE 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = :table 
        AND COLUMN_NAME = :column
    ");
    
    $stmt->execute([':table' => $table, ':column' => $column]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $is_nullable = $result['IS_NULLABLE'];
        
        // 判断是否需要修改
        if ($is_nullable === 'NO') {
            // 执行修改
            try {
                $alter_sql = "ALTER TABLE $table MODIFY COLUMN $column TEXT NULL";
                $dblj->exec($alter_sql);
            } catch (PDOException $e) {
                echo "<p style='color: red;'>取消 $table.$column 的NOT NULL约束失败: " . $e->getMessage() . "</p>";
            }
        }
    } else {
        echo "<p style='color: red;'>错误: 字段 $table.$column 不存在</p>";
    }
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