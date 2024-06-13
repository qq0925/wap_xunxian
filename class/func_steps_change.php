<?php
require_once 'lexical_analysis.php';
require_once 'data_lexical.php';
require_once 'event_data_get.php';
require_once 'pdo.php';


$just_page = $encode->encode("cmd=$parents_cmd&sid=$sid");
func_steps_change($target_event,$sid,$dblj,$just_page,$steps_page);

function func_steps_change($target_event,$sid,$dblj,$just_page,$steps_page,$uid=null,$mid=null,$para=null){
                //事件逻辑
                    global $encode;
                    global $steps_page;
                    global $parents_cmd;
                    $event_data = self_event_data_get($target_event,$dblj);
                    $event_cond = $event_data['system_event']['cond'];
                    $event_cmmt = $event_data['system_event']['cmmt'];
                    $event_step_count = $event_data['system_event']['link_evs'];
                    if($steps_page==0){
                    $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid);
                    if(is_null($register_triggle)){
                        $register_triggle =1;
                    }
                    if(!$register_triggle){
                    $event_cmmt = lexical_analysis\process_string($event_cmmt,$sid);
                    echo $event_cmmt."<br/>";
                    $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
                    }elseif($register_triggle &&!empty($event_step_count)){
                        $steps_page = 1;
                    }
                    }
                    if($steps_page >0){
                        
                        if(!empty($event_data['system_event']['link_evs'])){
                        $system_event_evs = $event_data["system_event_evs"];
                        $count = count($system_event_evs);
                        if($steps_page <$count){
                        $event =$system_event_evs[$steps_page-1];
                        $steps_count = count($system_event_evs);
                        
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
                            $step_cmmt2 = lexical_analysis\process_string($step_cmmt2,$sid);
                            echo $step_cmmt2."<br/>";
                             $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
                    exit();
                            }elseif($step_triggle){
                            $step_cmmt = lexical_analysis\process_string($step_cmmt,$sid);
                            echo $step_cmmt."<br/>";
                            $ret = attrsetting($step_s_attrs,$sid);
                            $ret_2 = attrchanging($step_m_attrs,$sid);
                            
                            if($steps_page <$steps_count){
                                $steps_page +=1;
                                $page_continue = $encode->encode("cmd=main_target_event&target_event=$target_event&parents_cmd=$parents_cmd&steps_page=$steps_page&sid=$sid");
                                $page_continue =<<<HTML
                    <a href="?cmd=$page_continue">继续</a><br/>
HTML;
                    echo $page_continue;
                            }
                            
                            
                            
                            }
                        }elseif($steps_page ==$count){
                            $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
                        }
                        
                    }
                        
                        
                        
                        
                        
                    }
                    
                    
                    
                    
                    
    
    
    
}




?>