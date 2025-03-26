<?php

// 字段配置数组（结构示例）
$fieldConfigs = [
    [
        'table'      => 'system_item',         // 表名
        'field'      => 'icount',           // 字段名
        'expect_type' => 'int',          // 期望的原类型（小写）
        'new_type'   => 'decimal(65,0)',  // 目标新类型（完整SQL类型定义）
        'attributes' => 'NOT NULL DEFAULT 0' // 其他字段属性
    ],
    [
        'table'      => 'game1',         // 表名
        'field'      => 'uburthen',           // 字段名
        'expect_type' => 'int',          // 期望的原类型（小写）
        'new_type'   => 'decimal(65,0)',  // 目标新类型（完整SQL类型定义）
        'attributes' => 'NOT NULL DEFAULT 0' // 其他字段属性
    ],
    [
        'table'      => 'game3',         // 表名
        'fields'     => ['hurt_hp', 'hurt_mp', 'cut_hp', 'cut_mp'],  // 字段名数组
        'expect_type' => 'TEXT',          // 期望的原类型（小写）
        'new_type'   => 'decimal(65,0)',  // 目标新类型（完整SQL类型定义）
        'attributes' => '' // 其他字段属性
    ],
    [
        'table'      => 'system_fight_state',         // 表名
        'fields'     => ['now_hp', 'now_mp'],  // 字段名数组
        'expect_type' => 'int',          // 期望的原类型（小写）
        'new_type'   => 'decimal(65,0)',  // 目标新类型（完整SQL类型定义）
        'attributes' => '' // 其他字段属性
    ],
    [
        'table'     => 'game2',
        'fields'     => ['hurt_hp', 'hurt_mp', 'cut_hp', 'cut_mp'],  // 字段名数组
        'expect_type' => 'int',
        'new_type'   => 'decimal(65,0)',
        'attributes' => ''
    ]
];

// 数据库连接对象 - 请确保这个变量已经在其他地方定义
// $dblj = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
if (!isset($dblj) || !($dblj instanceof PDO)) {
    die('数据库连接对象 $dblj 未定义或不是 PDO 实例');
}

// 执行字段类型检测与修改
try {
    foreach ($fieldConfigs as $config) {
        processFieldConfig($dblj, $config);
    }
} catch (PDOException $e) {
    die("数据库操作错误: " . $e->getMessage());
}

/**
 * 处理字段配置，支持多表和多字段
 * @param PDO $pdo PDO连接对象
 * @param array $config 字段配置数组
 */
function processFieldConfig(PDO $pdo, array $config) {
    // 处理表名（单个或多个）
    $tables = isset($config['tables']) ? $config['tables'] : [$config['table']];
    
    // 处理字段名（单个或多个）
    $fields = isset($config['fields']) ? $config['fields'] : [$config['field']];
    
    // 遍历所有表和字段组合
    foreach ($tables as $table) {
        foreach ($fields as $field) {
            try {
                processFieldType($pdo, $table, $field, $config['expect_type'], $config['new_type'], $config['attributes']);
            } catch (PDOException $e) {
                echo "处理 {$table}.{$field} 时出错: {$e->getMessage()}<br/>";
            }
        }
    }
}

/**
 * 处理单个字段类型修改
 * @param PDO $pdo PDO连接对象
 * @param string $table 表名
 * @param string $field 字段名
 * @param string $expectType 期望的原类型
 * @param string $newType 目标新类型
 * @param string $attributes 其他字段属性
 */
function processFieldType(PDO $pdo, string $table, string $field, string $expectType, string $newType, string $attributes) {
    // 参数安全处理
    $table = trim($table);
    $field = trim($field);
    
    // 查询当前字段类型
    $sql = "SELECT COLUMN_TYPE, DATA_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = :table 
            AND COLUMN_NAME = :field";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':table' => $table, ':field' => $field]);
    
    if (!$stmt->rowCount()) {
        throw new PDOException("字段 {$table}.{$field} 不存在");
    }
    
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentType = strtolower($info['DATA_TYPE']);
    
    // 类型检查与修改
    if ($currentType === strtolower($expectType)) {
        $fullType = $newType;
        if (!empty($attributes)) {
            $fullType .= " {$attributes}";
        }
        
        // 使用引号包裹标识符以防止SQL注入
        $alterSql = "ALTER TABLE `" . $table . "` MODIFY COLUMN `" . $field . "` " . $fullType;
        
        $pdo->exec($alterSql);
        echo "已修改 {$table}.{$field} 类型为: {$fullType}<br/>";
    }
}
?>