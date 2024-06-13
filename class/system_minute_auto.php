<?php
require 'lexical_analysis.php';
require 'data_lexical.php';
require 'event_data_get.php';
include 'pdo.php';
$sid = '2be824d1d1eaf47b51176faf90a5b8c9';
$event_data = global_event_data_get(52,$dblj);
$event_cond = $event_data['system_event']['cond'];
$event_cmmt = $event_data['system_event']['cmmt'];
$register_triggle = checkTriggerCondition($event_cond,$dblj,$sid);
if(is_null($register_triggle)){
    $register_triggle =1;
}
if(!$register_triggle){
}elseif($register_triggle){
if(!empty($event_data['system_event']['link_evs'])){
    $system_event_evs = $event_data["system_event_evs"];
    foreach ($system_event_evs as $index => $event) {
    $step_cond = $event['cond'];
    $step_cmmt = $event['cmmt'];
    $step_cmmt2 = $event['cmmt2'];
    $step_s_attrs = $event['s_attrs'];
    $step_m_attrs = $event['m_attrs'];
    $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid);
    if(is_null($step_triggle)){
    $step_triggle =1;
        }
    if(!$step_triggle){
        }elseif($step_triggle){
        $ret = attrsetting($step_s_attrs,$sid);
        $ret = attrchanging($step_m_attrs,$sid);
        }
    }
}
}
?>