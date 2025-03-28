<?php

// system_minute_auto.php

require __DIR__.'/../../class/lexical_analysis.php';
require __DIR__.'/../../class/data_lexical.php';
require __DIR__.'/../../class/gm.php';
require __DIR__.'/../../class/event_data_get.php';
require __DIR__.'/../../pdo.php';

$dblj = DB::pdo();

$lockFile = __DIR__ . '/system_minute_auto.lock';
$lock = fopen($lockFile, 'c');
if (!flock($lock, LOCK_EX | LOCK_NB)) {
    echo "另一个进程正在运行，退出。";
    exit;
}

// 无限循环，每分钟执行一次
while (true) {
    $event_data = global_event_data_get(52, $dblj);
    $event_cond = $event_data['system_event']['cond'];
    $event_cmmt = $event_data['system_event']['cmmt'];

    $register_triggle = checkTriggerCondition($event_cond, $dblj, null);
    if (is_null($register_triggle)) {
        $register_triggle = 1;
    }

    if ($register_triggle) {
        if (!empty($event_data['system_event']['link_evs'])) {
            $system_event_evs = $event_data["system_event_evs"];
            foreach ($system_event_evs as $index => $event) {
                $step_cond = $event['cond'];
                $step_cmmt = $event['cmmt'];
                $step_cmmt2 = $event['cmmt2'];
                $step_s_attrs = $event['s_attrs'];
                $step_m_attrs = $event['m_attrs'];

                $step_triggle = checkTriggerCondition($step_cond, $dblj, null);
                if (is_null($step_triggle)) {
                    $step_triggle = 1;
                }

                if ($step_triggle) {
                    $ret = attrsetting($step_s_attrs, null);
                    $ret = attrchanging($step_m_attrs, null);
                }
            }
        }
    }
    $dblj->exec("UPDATE gm_game_basic SET game_temp_notice_time = game_temp_notice_time - 1 WHERE game_temp_notice_time >0 and game_id = '19980925'");
    $dblj->exec("UPDATE game1
    JOIN (SELECT player_offline_time FROM gm_game_basic WHERE game_id = '19980925' LIMIT 1) AS g
    SET game1.sfzx = 0
    WHERE g.player_offline_time > 0
      AND TIMESTAMPDIFF(MINUTE, game1.endtime, NOW()) > g.player_offline_time and game1.uis_designer = 0");

    // 每分钟执行一次
    sleep(60);
}

flock($lock, LOCK_UN);
fclose($lock);
?>
