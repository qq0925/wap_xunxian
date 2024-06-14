<?php

if($_POST&&$reboot == 1){
    $reboot_password = $_POST['reboot_password'];
    
    $sql="select token from game1 where sid='$sid'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('token',$sure_token);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    
    $sql = "update userinfo set designer = '1' WHERE token=?";
    $stmt = $dblj->prepare($sql);
    $stmt->execute(array($sure_token));
    
    $sql = "select userpass from userinfo where token='$sure_token' and userpass = '$reboot_password'";
    $cxjg = $dblj->query($sql);
    $ret2 = $cxjg->fetch(PDO::FETCH_ASSOC);
    if ($ret2['userpass']){
    echo"身份验证通过，正在清空游戏数据！";

    try {
        
    function deleteAllFoldersInDirectory($dir) {
        if (!is_dir($dir)) {
            return;
        }
    
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
    
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                deleteFolder($path);
                rmdir($path);
                echo "目录 $path 已删除。<br>";
            }
        }
    }

    function deleteFolder($folder) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
    
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }
    }
    
    // 定义 images 目录路径
    $imagesDir = __DIR__ . DIRECTORY_SEPARATOR . 'images';
    
    // 删除 images 目录中的所有文件夹
    deleteAllFoldersInDirectory($imagesDir);
        
        // 查询以game_为前缀的所有表名
        $sql = "SHOW TABLES LIKE 'game_%'";
        $stmt = $dblj->query($sql);
        $gamePageTables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // 查询以game_self_page_为前缀的所有表名
        $sql = "SHOW TABLES LIKE 'game_self_page_%'";
        $stmt = $dblj->query($sql);
        $gameSelfPageTables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // 其他需要清空的表
        $otherTables = ['forum_res', 'forum_text', 'game1', 'game2', 'game3', 'game4', 'global_data','system_addition_attr','system_chat_data','system_auc','system_auc_data','system_draw','system_equip_user','system_event_evs','system_event_evs_npc','system_event_evs_self','system_event_self','system_exp_def','system_fight_quick','system_item','system_item_module','system_item_op','system_lp','system_map','system_map_op','system_mk','system_money_type','system_npc','system_npc_midguaiwu','system_npc_op','system_photo','system_photo_type','system_player_black','system_player_boat','system_player_friend','system_player_inputs','system_rank','system_rp','system_self_define_module','system_skill','system_skill_module','system_skill_user','system_storage','system_storage_locked','system_task','system_task_user','system_team_user'];
        // 合并所有需要清空的表
        $tablesToTruncate = array_merge($gamePageTables, $otherTables);
    
        // 开始事务
        $dblj->beginTransaction();
    
    
        // 循环遍历所有表并清空它们
        foreach ($tablesToTruncate as $table) {
            $sql = "TRUNCATE TABLE $table";
            $stmt = $dblj->prepare($sql);
            $stmt->execute();
            echo "表 $table 已成功清空。<br>";
        }

        // 删除以game_self_page_开头的表
        foreach ($gameSelfPageTables as $table) {
            $sql = "DROP TABLE $table";
            $stmt = $dblj->prepare($sql);
            $stmt->execute();
            echo "表 $table 已成功删除。<br>";
        }
    
    
        // 清空并插入数据到 gm_game_basic 表
        $sql = "TRUNCATE TABLE gm_game_basic";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 gm_game_basic 已成功清空。<br>";
    
        $sql = "INSERT INTO gm_game_basic (game_id, game_name, money_name, money_measure, game_max_char, game_status, game_status_string, default_storage, player_offline_time, list_row, near_player_show) 
                VALUES (19980925, '未命名', '银子', '两', 20, 0, '开发中', 20, 10, 8, 3)";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 gm_game_basic 已插入初始数据。<br>";
    
        // 清空并插入数据到 gm_game_attr 表
        $sql = "TRUNCATE TABLE gm_game_attr";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 gm_game_attr 已成功清空。<br>";
    
        // 插入初始属性值到 gm_game_attr 表

        // 准备插入语句
        $stmt = $dblj->prepare("INSERT INTO gm_game_attr (pos, id, name, value_type, default_value, if_item_user_attr, if_basic, if_show, attr_type) VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        // 要插入的默认值
        $data = [
            [1, 1, '标识', 5, 1, 0, 1, 1, 0],
            [2, 1, '区域名称', 5, 0, 0, 1, 1, 1],
            [3, 1, '区域id', 5, 0, 0, 1, 0, 0],
            [4, 1, '场景名称', 5, 0, 0, 1, 0, 1],
            [5, 1, '图片', 5, 0, 0, 1, 1, 1],
            [6, 1, '描述', 5, 0, 0, 1, 1, 1],
            [7, 1, '名称', 1, '', 0, 1, 0, 1],
            [8, 1, '标识', 1, '', 0, 1, 1, 0],
            [9, 1, '称号', 1, '', 0, 1, 0, 1],
            [10, 1, '性别', 1, '', 0, 1, 0, 1],
            [11, 1, '图片', 1, '', 0, 1, 0, 1],
            [12, 1, '最大负载', 1, '', 0, 1, 0, 0],
            [13, 1, '经验', 1, 0, 1, 1, 0, 0],
            [14, 1, '等级', 1, 1, 0, 1, 0, 0],
            [15, 1, '信用币', 1, 0, 1, 0, 0],
            [16, 1, '生命', 1, 0, 1, 0, 0],
            [17, 1, '最大生命', 1, 0, 1, 0, 0],
            [18, 3, '标识', 0, '', 0, 1, 0, 0],
            [19, 3, '区域', 0, '', 0, 1, 0, 0],
            [20, 3, '名称', 0, '', 0, 1, 0, 1],
            [21, 3, '绰号', 0, '', 0, 1, 0, 1],
            [22, 3, '图片', 0, '', 0, 1, 0, 1],
            [23, 3, '描述', 0, '', 0, 1, 0, 1],
            [24, 3, '经验', 0, '', 0, 1, 0, 0],
            [25, 3, '等级', 0, '', 0, 1, 0, 0],
            [26, 3, '是否可杀', 0, '', 0, 1, 0, 2],
            [27, 3, '是否杀不死', 0, '', 0, 1, 0, 2],
            [28, 3, '是否可赶走', 0, '', 0, 1, 0, 2],
            [29, 3, '刷新间隔', 0, '', 0, 1, 0, 0],
            [30, 3, '是否贩货', 0, '', 0, 1, 0, 2],
            [31, 3, '是否收购', 0, '', 0, 1, 0, 2],
            [32, 3, '生命', 0, '', 0, 1, 0, 0],
            [33, 3, '最大生命', 100, '', 0, 1, 1, 0],
            [34, 3, '攻击力', 0, '', 0, 1, 0, 0],
            [35, 3, '防御力', 0, '', 0, 1, 0, 0],
            [36, 1, '是否可pk', 0, '', 0, 1, 0, 2],
            [37, 4, '标识', 1, '', 0, 1, 0, 0],
            [38, 4, '区域', 0, '', 0, 1, 0, 0],
            [39, 4, '名称', 0, '', 0, 1, 0, 1],
            [40, 4, '图片', 0, '', 0, 1, 0, 1],
            [41, 4, '描述', 0, '', 0, 1, 0, 1],
            [42, 4, '类别', 0, '', 0, 1, 0, 0],
            [43, 4, '子类别', 0, '', 0, 1, 0, 0],
            [44, 4, '重量', 0, '', 0, 1, 0, 0],
            [45, 4, '价格', 0, '', 0, 1, 0, 0],
            [46, 4, '是否不可赠送', 0, '', 0, 1, 0, 2],
            [47, 4, '是否不可丢弃', 0, '', 0, 1, 0, 2],
            [48, 5, '刷新间隔', 1, '', 0, 1, 1, 0],
            [49, 6, '标识', 1, '', 0, 1, 1, 0],
            [50, 6, '名称', 0, '', 0, 1, 1, 1],
            [51, 6, '描述', 0, '', 0, 1, 1, 1],
            [52, 6, '攻击描述', 0, '', 0, 1, 1, 1],
            [53, 6, '等级', 1, '', 0, 1, 1, 0],
            [54, 6, '当前熟练度', 0, '', 0, 1, 0, 0],
            [55, 6, '攻击范围', 1, '', 0, 1, 1, 0],
            [56, 5, '是否商店', 0, '', 0, 1, 1, 2],
            [57, 5, '是否当铺', 0, '', 0, 1, 1, 2],
            [58, 5, '是否仓库', 0, '', 0, 1, 1, 2],
            [59, 5, '是否允许pk', 1, '', 0, 1, 1, 2],
            [60, 5, '是否资源点', 0, '', 0, 1, 1, 2],
            [62, 5, '资源点名称', 0, '', 0, 1, 0, 0],
            [63, 5, '是否中转点', 0, '', 0, 1, 1, 2],
            [64, 3, '是否接受物品', 0, '', 0, 1, 0, 2],
            [65, 5, '中转点类型', 0, '', 0, 1, 1, 0],
            [66, 5, '坐标', 0, '0,0,0', 0, 1, 1, 1],
            [67, 5, '天气', 0, '晴天', 0, 1, 0, 1],
            [68, 5, '是否屏蔽其他玩家', 0, '', 0, 1, 1, 2],
            [69, 5, '是否信号闭塞', 0, '', 0, 1, 1, 2]
        ];

        // 插入每一条记录
        foreach ($data as $row) {
            $stmt->execute($row);
        }
    
        echo "attr表默认值插入成功！";

        // 清空并插入数据到 system_area 表
        $sql = "TRUNCATE TABLE system_area";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_area 已成功清空。<br>";
    
        $sql = "INSERT INTO system_area (area_id, area_name) VALUES (0, '未分区')";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_area 已插入未分区初始值。<br>";

        // 清空 system_equip_def 表
        $sql = "TRUNCATE TABLE system_equip_def";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_equip 已成功清空。<br>";
    
        // 从 system_equip_default 表中获取所有数据
        $sql = "SELECT * FROM system_equip_default";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $defaultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // 将数据插入到 system_equip 表
        if (!empty($defaultData)) {
            // 获取列名
            $columns = array_keys($defaultData[0]);
            $columnsList = implode(", ", $columns);
            $placeholders = implode(", ", array_fill(0, count($columns), '?'));
    
            $sql = "INSERT INTO system_equip_def ($columnsList) VALUES ($placeholders)";
            $stmt = $dblj->prepare($sql);
    
            foreach ($defaultData as $row) {
                $stmt->execute(array_values($row));
            }
    
            echo "表 system_equip_def 已使用 system_equip_default 的数据覆盖。<br>";
        } else {
            echo "system_equip_default 表中没有数据。<br>";
        }


        // 保留的字段
        $keepFields = ['item_true_id', 'sid', 'uid', 'iid', 'icount', 'ibind', 'iequiped', 'isale_state', 'isale_price', 'icreate_sale_time', 'iexpire_sale_time', 'isale_time', 'iroot'];
    
        // 获取 system_item 表的所有字段
        $sql = "DESCRIBE system_item";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_item DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }
        echo "所有不必要的字段已删除。";


        // 保留的字段
        $keepFields = ['iid', 'iarea_name', 'iarea_id', 'iname', 'iimage', 'idesc', 'idetail_desc', 'itype', 'isubtype', 'iweight', 'iprice', 'ino_give', 'ino_out', 'iop_target', 'itask_target', 'icreat_event_id', 'ilook_event_id', 'iuse_event_id', 'iminute_event_id', 'iuse_attr', 'iuse_value', 'iattack_value', 'irecovery_value', 'iuse_attr', 'iembed_count', 'iequip_cond'];
    
        // 获取 system_item_module 表的所有字段
        $sql = "DESCRIBE system_item_module";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_item_module DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }
        echo "所有不必要的字段已删除。";

        // 保留的字段
        $keepFields = [
            'mid', 'mname', 'mitem', 'mitem_now', 'mnpc', 'mnpc_now', 'mgtime', 'mpick_time',
            'mrefresh_time', 'mphoto', 'mdesc', 'mup', 'mdown', 'mleft', 'mright', 'marea_name',
            'marea_id', 'mop_target', 'mtask_target', 'mcreat_event_id', 'mlook_event_id',
            'minto_event_id', 'mout_event_id', 'mminute_event_id', 'mshop', 'mhockshop',
            'mshop_item_id', 'mkill', 'mstorage', 'mtianqi', 'mdire', 'mis_tp', 'mtp_type',
            'mis_rp', 'mrp_id', 'mis_shield', 'mis_signal_block'
        ];
    
        // 获取 system_map 表的所有字段
        $sql = "DESCRIBE system_map";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_map DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }
        echo "所有不必要的字段已删除。";

        // 保留的字段
        $keepFields = [
            'narea_id', 'narea_name', 'nid', 'nstate', 'nkill', 'nnot_dead', 'nchuck',
            'nrefresh_time', 'nshop', 'nhock_shop', 'naccept_give', 'nname', 'nexp',
            'nlvl', 'nsex', 'ndesc', 'nequips', 'ndrop_exp', 'ndrop_money', 'ndrop_item',
            'ndrop_item_type', 'nskills', 'nshop_item_id', 'nmuban', 'nshop_cond',
            'ntaskid', 'nnick_name', 'nhp', 'nmaxhp', 'ngj', 'nfy', 'nimage', 'nop_target',
            'ntask_target', 'ncreat_event_id', 'nlook_event_id', 'nattack_event_id',
            'npet_event_id', 'nshop_event_id', 'nup_event_id', 'nheart_event_id',
            'nminute_event_id'
        ];
    
        // 获取 system_npc 表的所有字段
        $sql = "DESCRIBE system_npc";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_npc DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }
        echo "所有不必要的字段已删除。";

        // 保留的字段
        $keepFields = [
            'ngid', 'ncreate_time', 'nsid', 'narea_id', 'narea_name', 'nmid', 'nid', 'nstate',
            'nkill', 'nnot_dead', 'nchuck', 'nrefresh_time', 'nshop', 'nhock_shop',
            'naccept_give', 'nname', 'nexp', 'nlvl', 'nsex', 'ndesc', 'nequips', 'ndrop_exp',
            'ndrop_money', 'ndrop_item', 'ndrop_item_type', 'nskills', 'nshop_item_id',
            'nshop_cond', 'nmuban', 'ntaskid', 'nnick_name', 'nhp', 'nmaxhp', 'ngj', 'nfy',
            'nimage', 'nop_target', 'ntask_target', 'ncreat_event_id', 'nlook_event_id',
            'nattack_event_id', 'npet_event_id', 'nshop_event_id', 'nup_event_id',
            'nheart_event_id', 'nminute_event_id'
        ];
    
        // 获取 system_npc_midguaiwu 表的所有字段
        $sql = "DESCRIBE system_npc_midguaiwu";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_npc_midguaiwu DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }
        echo "所有不必要的字段已删除。";
        header("refresh:1;url=index.php");
        exit();
        
    // 提交事务
    $dblj->commit();


        // 提交事务
        //$dblj->commit();
    } catch (PDOException $e) {
        // 如果发生错误则回滚事务
        $dblj->rollBack();
        echo "清空表时出错: " . $e->getMessage();
    }
    
    
    
    }else{
    echo "输入有误！或者你不具备清空权限！<br/>";
    }
    
}


$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$sure_reboot = $encode->encode("cmd=gm_game_othersetting&canshu=10&reboot=1&&sid=$sid");
$reboot_html = <<<HTML
<p>是否清空所有游戏数据(此操作不可逆！)<br/>
<form action="?cmd=$sure_reboot" method="POST">
请输入创建者密码：<input name="reboot_password"><br/>
<input type="submit" value="确定清空"><br/><br/>
</form>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">返回设计大厅</a><br/>
</p>
HTML;
echo $reboot_html;

?>