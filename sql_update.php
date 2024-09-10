<?php
//数据库更新补丁

try {
    // 查询 game_main_page 表中 value 字段的类型
    $stmt = $dblj->prepare("SHOW COLUMNS FROM game_main_page LIKE 'value'");
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    // 检查 value 字段的类型是否为 VARCHAR
    if ($column && strpos($column['Type'], 'varchar') !== false) {
        // 查询所有以 game_ 开头的数据表
        $stmt = $dblj->prepare("SHOW TABLES LIKE 'game_%'");
        $stmt->execute();
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // 遍历每个表，检查并修改 value 字段的类型
        foreach ($tables as $table) {
            // 检查表中的 value 字段
            $stmt = $dblj->prepare("SHOW COLUMNS FROM $table LIKE 'value'");
            $stmt->execute();
            $column = $stmt->fetch(PDO::FETCH_ASSOC);

            // 如果 value 字段存在并且是 VARCHAR 类型，则修改为 TEXT
            if ($column && strpos($column['Type'], 'varchar') !== false) {
                // 修改字段类型为 TEXT
                $alterStmt = $dblj->prepare("ALTER TABLE $table MODIFY COLUMN value TEXT");
                $alterStmt->execute();
            }
        }
    }
} catch (PDOException $e) {
    echo "数据库错误: " . $e->getMessage();
}


// 检查是否存在 game_equip_detail_page 表
$query = "SHOW TABLES LIKE 'game_equip_detail_page'";
$stmt = $dblj->prepare($query);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    // 表不存在，复制 game_equip_page 表的结构
    $createTableQuery = "CREATE TABLE game_equip_detail_page LIKE game_equip_page";
    $dblj->exec($createTableQuery);
}


    // 检查表是否存在 designer 字段
    $sql = "SHOW COLUMNS FROM userinfo LIKE 'designer'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果 designer 字段不存在，执行添加字段操作
        $sql = "ALTER TABLE userinfo ADD COLUMN designer INT DEFAULT 0";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }

    // 检查 game2 是否存在 hurt_mp 字段
    $sql = "SHOW COLUMNS FROM game2 LIKE 'hurt_mp'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE game2 ADD COLUMN hurt_mp TEXT NOT NULL, ADD COLUMN cut_mp TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }
    
    // 检查 game3 是否存在 hurt_mp 字段
    $sql = "SHOW COLUMNS FROM game3 LIKE 'hurt_mp'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE game3 ADD COLUMN hurt_mp TEXT NOT NULL, ADD COLUMN cut_mp TEXT NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }



    // 检查表是否存在 mhide 字段
    $sql = "SHOW COLUMNS FROM system_map LIKE 'mhide'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果 designer 字段不存在，执行添加字段操作
        $sql = "ALTER TABLE system_map ADD COLUMN mhide TINYINT(1) DEFAULT 0 NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }

    // 检查表是否存在 jpid 字段
    $sql = "SHOW COLUMNS FROM system_skill_user LIKE 'jpid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果 jpid 字段不存在，执行添加字段操作
        $sql = "ALTER TABLE system_skill_user ADD COLUMN jpid INT(11) DEFAULT 0 NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "ALTER TABLE game2 ADD COLUMN pid INT(11) DEFAULT 0 NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "ALTER TABLE game3 ADD COLUMN pid INT(11) DEFAULT 0 NOT NULL";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }

    $sql = "SHOW COLUMNS FROM system_pet_player LIKE 'pnid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
$sql1 = "DROP TABLE IF EXISTS `system_pet_player`;";
$sql2 = "CREATE TABLE `system_pet_player`  (
  `pnid` int(11) NOT NULL,
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pphoto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `psid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `plvl` int(11) NOT NULL,
  `pmaxexp` int(255) NOT NULL,
  `pexp` int(255) NOT NULL,
  `php` int(255) NOT NULL,
  `pmaxhp` int(255) NOT NULL,
  `pgj` int(255) NOT NULL,
  `pfy` int(255) NOT NULL,
  `pstate` int(1) NOT NULL,
  `phunger` int(3) NOT NULL,
  `pthirst` int(3) NOT NULL,
  `pmood` int(4) NOT NULL,
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;";

$stmt1 = $dblj->prepare($sql1);
$stmt1->execute();

$stmt2 = $dblj->prepare($sql2);
$stmt2->execute();

    }


    // 检查表是否存在 adopt 字段
    $sql = "SHOW COLUMNS FROM system_event_evs_self LIKE 'a_adopt'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果 designer 字段不存在，执行添加字段操作
    $sql = "ALTER TABLE system_event_evs_self ADD COLUMN `a_adopt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '添加宠物',
                ADD COLUMN `r_adopt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '删除宠物'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    
    $sql = "ALTER TABLE system_event_evs ADD COLUMN `a_adopt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '添加宠物',
                ADD COLUMN `r_adopt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '删除宠物'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    
    }


    // 检查表是否存在 nwin和ndefeat 字段
    $sql = "SHOW COLUMNS FROM system_npc LIKE 'nwin_event_id'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $column = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$column) {
        // 如果字段不存在，执行添加字段操作
        $sql = "ALTER TABLE system_npc
ADD nwin_event_id int(11) NOT NULL  
AFTER nattack_event_id,  
ADD ndefeat_event_id int(11) NOT NULL  
AFTER nwin_event_id ;";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "ALTER TABLE system_npc_midguaiwu
ADD nwin_event_id int(11) NOT NULL  
AFTER nattack_event_id,  
ADD ndefeat_event_id int(11) NOT NULL  
AFTER nwin_event_id ;";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
    }


    $result = $dblj->query("SHOW TABLES LIKE 'player_temp_attr'");
    if ($result->rowCount() == 0) {
        // 表不存在，创建表
        $sql = "CREATE TABLE player_temp_attr (
            obj_id TEXT NOT NULL,
            obj_oid TEXT NOT NULL,
            obj_type  INT NOT NULL,
            attr_name VARCHAR(255) NOT NULL,
            attr_value VARCHAR(255) NOT NULL
        )";
        $dblj->exec($sql);
    }

    $result = $dblj->query("SHOW TABLES LIKE 'player_equip_mosaic'");
    if ($result->rowCount() == 0) {
        // 表不存在，创建表
        $sql = "CREATE TABLE player_equip_mosaic (
            equip_id int(11) NOT NULL,
            equip_root int(11) NOT NULL,
            belong_sid  text NOT NULL,
            equip_mosaic VARCHAR(255) NOT NULL
        )";
        $dblj->exec($sql);
    }

    $result = $dblj->query("SHOW TABLES LIKE 'system_player_setting'");
    if ($result->rowCount() == 0) {
        // 表不存在，创建表
        $sql = "CREATE TABLE `system_player_setting`  (
  `sid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `if_photo` int(1) NOT NULL COMMENT '是否显示图片',
  `if_message` int(1) NOT NULL,
  `if_save_last_message` int(1) NOT NULL,
  `save_last_message_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `show_message_reg` int(2) NOT NULL,
  `show_list_reg` int(2) NOT NULL,
  `accept_state` int(1) NOT NULL,
  `back_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cmd_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT";
        $dblj->exec($sql);
    }


    // 检查某功能字段是否存在
    $result = $dblj->query("select id from system_function where id = 77");
    if ($result->rowCount() == 0) {
        // 表不存在，创建表
        $sql = "insert into system_function (belong,id,name,link_function,default_value) values (2,77,'镶嵌装备',77,'镶嵌装备')";
        $dblj->exec($sql);
    }
    
        // 检查某功能字段是否存在
    $result = $dblj->query("select id from system_function where id = 78");
    if ($result->rowCount() == 0) {
        // 表不存在，创建表
        $sql = "insert into system_function (belong,id,name,link_function,default_value) values (6,78,'装备核心列表',78,'装备核心列表')";
        $dblj->exec($sql);
    }
    
?>