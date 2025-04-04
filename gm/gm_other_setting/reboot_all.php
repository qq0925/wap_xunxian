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
    echo"身份验证通过，正在清空游戏数据！(注：css和js文件将会保留)<br/>";

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
    // 定义 ache 目录路径
    $imagesDir = __DIR__ . DIRECTORY_SEPARATOR . 'ache';
    // 删除 ache 目录中的所有文件夹
    deleteAllFoldersInDirectory($imagesDir);
    $imagesDir = __DIR__ . DIRECTORY_SEPARATOR . 'cache';
    // 删除 ache 目录中的所有文件夹
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
        $otherTables = ['forum_res', 'forum_text', 'game1', 'game2', 'game3', 'game4', 'global_data','player_temp_attr','player_clan_apply','player_equip_mosaic','system_addition_attr','system_chat_data','system_auc','system_auc_data','system_draw','system_equip_user','system_event_evs','system_event_evs_npc','system_event_evs_self','system_event_self','system_exp_def','system_fight_quick','system_item','system_item_module','system_item_op','system_lp','system_map','system_map_op','system_mk','system_money_type','system_npc','system_npc_midguaiwu','system_npc_scene','system_pet_scene','system_npc_op','system_photo','system_photo_type','system_player_black','system_player_boat','system_player_land','system_player_aircraft','system_player_friend','system_player_inputs','system_rank','system_rp','system_self_define_module','system_skill','system_skill_module','system_skill_user','system_storage','system_storage_locked','system_task','system_task_user','system_team_user','system_clan_list','system_designer_assist','system_fb','system_npc_drop_list'];
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
    
        $sql = "UPDATE system_event SET cond = NULL, cmmt = NULL, link_evs = NULL";

        // 准备语句
        $stmt = $dblj->prepare($sql);

        // 执行语句
        $stmt->execute();

        echo " system_event表中的数据已成功置为 NULL。<br/>";
    
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
        $stmt = $dblj->prepare("INSERT INTO gm_game_attr (pos, id, name, value_type, default_value, if_item_use_attr, if_basic, if_show, attr_type) VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        // 要插入的默认值
$data = [
    [1, 'id', '标识', 5, 1, 0, 1, 1, 0],
    [2, 'area_name', '区域名称', 5, 0, 0, 1, 1, 1],
    [3, 'area_id', '区域id', 5, 0, 0, 1, 0, 0],
    [4, 'name', '场景名称', 5, 0, 0, 1, 0, 1],
    [5, 'photo', '图片', 5, 0, 0, 1, 1, 1],
    [6, 'desc', '描述', 5, 0, 0, 1, 1, 1],
    [7, 'name', '名称', 1, '', 0, 1, 0, 1],
    [8, 'id', '标识', 1, '', 0, 1, 1, 0],
    [9, 'nick_name', '称号', 1, '', 0, 1, 0, 1],
    [10, 'sex', '性别', 1, '', 0, 1, 0, 1],
    [11, 'image', '图片', 1, '', 0, 1, 0, 1],
    [12, 'max_burthen', '最大负载', 1, '', 0, 1, 0, 0],
    [13, 'exp', '经验', 1, '', 1, 1, 0, 0],
    [14, 'lvl', '等级', 1, 1, 0, 1, 0, 0],
    [15, 'money', '信用币', 1, '', 1, 1, 0, 0],
    [16, 'hp', '生命', 1, '', 1, 1, 0, 0],
    [17, 'maxhp', '最大生命', 1, '', 1, 1, 0, 0],
    [18, 'mp', '法力', 1, '', 1, 1, 0, 0],
    [19, 'maxmp', '最大法力', 1, '', 1, 1, 0, 0],
    [20, 'speed', '出招速度', 1, 1, 1, 1, 0, 0],
    [21, 'id', '标识', 3, '', 0, 1, 0, 0],
    [22, 'area_id', '区域', 3, '', 0, 1, 0, 0],
    [23, 'name', '名称', 3, '', 0, 1, 0, 1],
    [24, 'nick_name', '绰号', 3, '', 0, 1, 0, 1],
    [25, 'image', '图片', 3, '', 0, 1, 0, 1],
    [26, 'desc', '描述', 3, '', 0, 1, 0, 1],
    [27, 'exp', '经验', 3, '', 0, 1, 0, 0],
    [28, 'lvl', '等级', 3, '', 0, 1, 0, 0],
    [29, 'kill', '是否可杀', 3, '', 0, 1, 0, 2],
    [30, 'not_dead', '是否杀不死', 3, '', 0, 1, 0, 2],
    [31, 'chuck', '是否可赶走', 3, '', 0, 1, 0, 2],
    [32, 'refresh_time', '刷新间隔', 3, '', 0, 1, 0, 0],
    [33, 'shop', '是否贩货', 3, '', 0, 1, 0, 2],
    [34, 'hock_shop', '是否收购', 3, '', 0, 1, 0, 2],
    [35, 'hp', '生命', 3, '', 0, 1, 0, 0],
    [36, 'maxhp', '最大生命', 3, 100, '', 1, 1, 0],
    [37, 'mp', '法力', 3, '', 0, 1, 0, 0],
    [38, 'maxmp', '最大法力', 3, 100, '', 1, 1, 0],
    [39, 'speed', '出招速度', 3, 1, '', 1, 1, 0],
    [40, 'gj', '攻击力', 3, '', 0, 1, 0, 0],
    [41, 'fy', '防御力', 3, '', 0, 1, 0, 0],
    [42, 'kill', '是否可pk', 1, '', 0, 1, 0, 2],
    [43, 'id', '标识', 4, 1, '', 1, 0, 0],
    [44, 'area_id', '区域', 4, '', 0, 1, 0, 0],
    [45, 'name', '名称', 4, '', 0, 1, 0, 1],
    [46, 'image', '图片', 4, '', 0, 1, 0, 1],
    [47, 'desc', '描述', 4, '', 0, 1, 0, 1],
    [48, 'type', '类别', 4, '', 0, 1, 0, 0],
    [49, 'subtype', '子类别', 4, '', 0, 1, 0, 0],
    [50, 'weight', '重量', 4, '', 0, 1, 0, 0],
    [51, 'price', '价格', 4, '', 0, 1, 0, 0],
    [52, 'no_give', '是否不可赠送', 4, '', 0, 1, 0, 2],
    [53, 'no_out', '是否不可丢弃', 4, '', 0, 1, 0, 2],
    [54, 'refresh_time', '刷新间隔', 5, 1, '', 1, 1, 0],
    [55, 'id', '标识', 6, 1, '', 1, 1, 0],
    [56, 'name', '名称', 6, '', 0, 1, 1, 1],
    [57, 'desc', '描述', 6, '', 0, 1, 1, 1],
    [58, 'effect_cmmt', '攻击描述', 6, '', 0, 1, 1, 1],
    [59, 'lvl', '等级', 6, 1, '', 1, 1, 0],
    [60, 'point', '当前熟练度', 6, '', 0, 1, 0, 0],
    [61, 'group_attack', '攻击范围', 6, 1, '', 1, 1, 0],
    [62, 'shop', '是否商店', 5, '', 0, 1, 1, 2],
    [63, 'hockshop', '是否当铺', 5, '', 0, 1, 1, 2],
    [64, 'storage', '是否仓库', 5, '', 0, 1, 1, 2],
    [65, 'kill', '是否允许pk', 5, 1, '', 1, 1, 2],
    [66, 'is_rp', '是否资源点', 5, '', 0, 1, 1, 2],
    [67, 'rp_id', '资源点名称', 5, '', 0, 1, 0, 0],
    [68, 'is_tp', '是否中转点', 5, '', 0, 1, 1, 2],
    [69, 'accept_give', '是否接受物品', 3, '', 0, 1, 0, 2],
    [70, 'tp_type', '中转点类型', 5, '', 0, 1, 1, 0],
    [71, 'dire', '坐标', 5, '0,0,0', 0, 1, 1, 1],
    [72, 'tianqi', '天气', 5, '晴天', 0, 1, 0, 1],
    [73, 'is_shield', '是否屏蔽其他玩家', 5, '', 0, 1, 1, 2],
    [74, 'is_signal_block', '是否信号闭塞', 5, '', 0, 1, 1, 2],
    [75, 'hide', '是否隐藏', 5, '', 0, 1, 1, 2],
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
    
        $sql = "INSERT INTO system_area (belong,pos,id, name) VALUES (0,-1,0, '未分区')";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_area 已插入未分区初始值。<br>";

        // 清空并插入数据到 system_region 表
        $sql = "TRUNCATE TABLE system_region";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_region 已成功清空。<br>";
    
        $sql = "INSERT INTO system_region (belong,pos,id, name,sail_hide,sky_hide,road_hide) VALUES (0,0,0, '失落之地',1,1,1)";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_region 已插入未分区初始值。<br>";

        $sql = "INSERT INTO system_skill_module (jid,jhurt_attr,jdeplete_attr) VALUES ('1','hp','mp')";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $sql = "INSERT INTO system_skill_module (jid,jhurt_attr,jdeplete_attr) VALUES ('2','hp','mp')";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_skill_module 已插入初始值。<br>";
        
        $sql = "INSERT INTO system_money_type (rid,rname,runit, rif_default) VALUES ('money','银子','两', '1')";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_money_type 已插入初始值。<br>";
        
        // 清空 system_equip_def 表
        $sql = "TRUNCATE TABLE system_equip_def";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        echo "表 system_equip 已成功清空。<br>";
    
        //将 system_equip_default 表的内容插入到 system_equip_def 表中
        $dblj->exec("INSERT INTO system_equip_def SELECT * FROM system_equip_default");


        // 保留的字段
        $keepFields = ['jid', 'jhurt_attr', 'jdeplete_attr', 'jhurt_exp', 'jdeplete_exp', 'jadd_point_exp', 'jpromotion', 'jpromotion_cond', 'jeffect_cmmt', 'jevent_use_id', 'jevent_up_id'];
    
        // 获取 system_skill_module 表的所有字段
        $sql = "DESCRIBE system_skill_module";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_skill_module DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }

        // 保留的字段
        $keepFields = ['jname','jid','jdesc','joccasion','jimage','jhurt_mod','jgroup_attack','jcooling_time','jcooling_round', 'jhurt_attr', 'jdeplete_attr', 'jhurt_exp', 'jdeplete_exp','jequip_type','jequip_appoint','juse_cond','jcant_use_cmmt', 'jadd_point_exp', 'jpromotion', 'jpromotion_cond', 'jeffect_cmmt', 'jevent_use_id', 'jevent_up_id'];
    
        // 获取 system_skill 表的所有字段
        $sql = "DESCRIBE system_skill";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_skill DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }

        // 保留的字段
        $keepFields = ['item_true_id', 'sid', 'uid', 'iid', 'icount', 'ino_give','ino_out', 'iequiped', 'isale_state', 'isale_price', 'icreate_sale_time', 'iexpire_sale_time', 'isale_time', 'iroot'];
    
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
        // 保留的字段
        $keepFields = ['iid', 'iarea_name', 'iarea_id', 'iname', 'iimage', 'idesc', 'idetail_desc', 'itype', 'isubtype', 'iweight', 'iprice', 'ino_give', 'ino_out', 'iop_target', 'itask_target', 'icreat_event_id', 'ilook_event_id', 'iuse_event_id', 'iminute_event_id', 'iuse_attr', 'iuse_value', 'iattack_value', 'irecovery_value', 'iuse_attr', 'iembed_count', 'iequip_cond','itake_on','itake_off','iembed_on','iembed_off'];
    
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

        // 保留的字段
        $keepFields = [
            'uis_designer', 'uis_forum_gm', 'uid', 'ucmd', 'ulast_cmd', 'uphone', 'sid', 
            'token', 'utran_state', 'uname', 'uimage', 'unick_name', 'ulvl', 'uburthen', 
            'umax_burthen', 'ustorage', 'uis_pve', 'ukill', 'uauto_fight','uis_roading', 'uauto_roading','uis_skying','uauto_skying','uis_sailing', 
            'uauto_sailing', 'umoney', 'uteam_invited_id', 'uteam_id', 'uteam_putin_id','uclan_id',
            'uexp', 'uhp', 'umaxhp', 'ump', 'umaxmp', 'uspeed','ugj', 'ufy', 'usex', 'endtime', 
            'minutetime', 'nowmid', 'justmid', 'tpsmid', 'nowguaiwu', 'sfzx', 'allchattime', 
            'citychattime', 'areachattime', 'cw', 'ispvp'
        ];

        // 获取 game1 表的所有字段
        $sql = "DESCRIBE game1";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE game1 DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }

        // 保留的字段
        $keepFields = [
            'mid', 'mname', 'mitem', 'mitem_now', 'mnpc', 'mnpc_now', 'mgtime', 'mpick_time',
            'mrefresh_time', 'mphoto', 'mdesc', 'mup', 'mdown', 'mleft', 'mright', 'marea_name',
            'marea_id', 'mop_target', 'mtask_target', 'mcreat_event_id', 'mlook_event_id',
            'minto_event_id', 'mout_event_id', 'mminute_event_id', 'mshop', 'mhockshop',
            'mshop_item_id', 'mkill', 'mstorage', 'mtianqi', 'mdire', 'mis_tp', 'mtp_type',
            'mis_rp', 'mrp_id', 'mis_shield', 'mis_signal_block','mhide'
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

        // 保留的字段
        $keepFields = [
            'narea_id', 'narea_name', 'nid', 'nstate', 'nkill', 'nnot_dead', 'nchuck',
            'nrefresh_time', 'nshop', 'nhock_shop', 'naccept_give', 'nname', 'nexp',
            'nlvl', 'nsex', 'ndesc', 'nequips', 'ndrop_exp', 'ndrop_money', 'ndrop_item',
            'ndrop_item_type', 'nskills', 'nshop_item_id', 'nmuban', 'nshop_cond',
            'ntaskid', 'nnick_name', 'nhp', 'nmaxhp', 'nmp', 'nmaxmp','nspeed', 'ngj', 'nfy', 'nimage', 'nop_target',
            'ntask_target', 'ncreat_event_id', 'nlook_event_id', 'nattack_event_id','nwin_event_id','ndefeat_event_id',
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

        // 保留的字段
        $keepFields = [
            'narea_id', 'narea_name', 'nid', 'nstate', 'nkill', 'nnot_dead', 'nchuck',
            'nrefresh_time', 'nshop', 'nhock_shop', 'naccept_give', 'nname', 'nexp',
            'nlvl', 'nsex', 'ndesc', 'nequips', 'ndrop_exp', 'ndrop_money', 'ndrop_item',
            'ndrop_item_type', 'nskills', 'nshop_item_id', 'nmuban', 'nshop_cond',
            'ntaskid', 'nnick_name', 'nhp', 'nmaxhp', 'nmp', 'nmaxmp','nspeed', 'ngj', 'nfy', 'nimage', 'nop_target',
            'ntask_target', 'ncreat_event_id', 'nlook_event_id', 'nattack_event_id','nwin_event_id','ndefeat_event_id',
            'npet_event_id', 'nshop_event_id', 'nup_event_id', 'nheart_event_id',
            'nminute_event_id','nmid','ncreate_time','ncid'
        ];
    
        // 获取 system_npc_scene 表的所有字段
        $sql = "DESCRIBE system_npc_scene";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_npc_scene DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }


        // 保留的字段
        $keepFields = [
            'narea_id', 'narea_name', 'nid', 'nstate', 'nkill', 'nnot_dead', 'nchuck',
            'nrefresh_time', 'nshop', 'nhock_shop', 'naccept_give', 'nname', 'nexp',
            'nlvl', 'nsex', 'ndesc', 'nequips', 'ndrop_exp', 'ndrop_money', 'ndrop_item',
            'ndrop_item_type', 'nskills', 'nshop_item_id', 'nmuban', 'nshop_cond',
            'ntaskid', 'nnick_name', 'nhp', 'nmaxhp', 'nmp', 'nmaxmp','nspeed', 'ngj', 'nfy', 'nimage', 'nop_target',
            'ntask_target', 'ncreat_event_id', 'nlook_event_id', 'nattack_event_id','nwin_event_id','ndefeat_event_id',
            'npet_event_id', 'nshop_event_id', 'nup_event_id', 'nheart_event_id',
            'nminute_event_id','nmid','ncreate_time','nsid','npid'
        ];
    
        // 获取 system_pet_scene 表的所有字段
        $sql = "DESCRIBE system_pet_scene";
        $stmt = $dblj->prepare($sql);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // 生成删除字段的SQL
        $dropFields = array_diff($columns, $keepFields);
        if (!empty($dropFields)) {
            foreach ($dropFields as $field) {
                $sql = "ALTER TABLE system_pet_scene DROP COLUMN $field";
                $stmt = $dblj->prepare($sql);
                $stmt->execute();
                echo "字段 $field 已删除。<br>";
            }
        } else {
            echo "没有需要删除的字段。<br>";
        }

        // 保留的字段
        $keepFields = [
            'ngid', 'ncreate_time', 'nsid', 'narea_id', 'narea_name', 'nmid', 'nid', 'nstate',
            'nkill', 'nnot_dead', 'nchuck', 'nrefresh_time', 'nshop', 'nhock_shop',
            'naccept_give', 'nname', 'nexp', 'nlvl', 'nsex', 'ndesc', 'nequips', 'ndrop_exp',
            'ndrop_money', 'ndrop_item', 'ndrop_item_type', 'nskills', 'nshop_item_id',
            'nshop_cond', 'nmuban', 'ntaskid', 'nnick_name', 'nhp', 'nmaxhp','nmp', 'nmaxmp','nspeed', 'ngj', 'nfy',
            'nimage', 'nop_target', 'ntask_target', 'ncreat_event_id', 'nlook_event_id',
            'nattack_event_id','nwin_event_id','ndefeat_event_id', 'npet_event_id', 'nshop_event_id', 'nup_event_id',
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
        echo "<a href='index.php'>重新登录<br/></a>";
        $finished = 1;
    // 提交事务
    $dblj->commit();

    } catch (PDOException $e) {
        // 如果发生错误则回滚事务
        $dblj->rollBack();
        echo "清空表时出错: " . $e->getMessage();
    }
    
    
    
    }else{
    echo "输入有误！或者你不具备清空权限！<br/>";
    }
    
}

if($finished !=1){
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
}
?>