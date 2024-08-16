<?php
//数据库更新补丁

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