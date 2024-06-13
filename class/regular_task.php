<?php
require_once 'lexical_analysis.php';
require_once 'data_lexical.php';
require_once 'event_data_get.php';
require_once 'pdo.php';
function global_events_steps_minute($target_event,$sid,$dblj,$just_page=null,$steps_page=null,&$cmid=null,$parents_page=null,$oid=null,$mid=null,$para=null){
                //事件逻辑
                    global $encode;
                    global $steps_page;
                    global $parents_cmd;
                    $event_data = global_event_data_get($target_event,$dblj);
                    $event_cond = $event_data['system_event']['cond'];
                    $event_cmmt = $event_data['system_event']['cmmt'];
                    $event_step_count = $event_data['system_event']['link_evs'];
                    if($steps_page==0){
                    $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid,$oid,$mid);//触发条件
                    if(is_null($register_triggle)){
                        $register_triggle =1;//若触发条件为空则默认true
                    }
                    if(!$register_triggle){
                    $event_cmmt = lexical_analysis\process_string($event_cmmt,$sid,$oid,$mid);
                    echo $event_cmmt."<br/>";//不满足触发条件则输出cmmt
                    $cmid = $cmid + 1;
                    $cdid[] = $cmid;
                    $just_page = $encode->encode("cmd=$parents_cmd&ucmd=$cmid&sid=$sid");
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
                        if($steps_page <=$count){
                        $event =$system_event_evs[$steps_page-1];
                        $steps_count = count($system_event_evs);
                        
                        $step_cond = $event['cond'];
                        $step_cmmt = $event['cmmt'];
                        $step_cmmt2 = $event['cmmt2'];
                        $step_s_attrs = $event['s_attrs'];
                        $step_m_attrs = $event['m_attrs'];
                        $step_items = $event['items'];
                        $step_a_skills = $event['a_skills'];
                        $step_page_name = $event['page_name'];
                        $step_not_return_link = $event['not_return_link'];
                        $step_just_return = $event['just_return'];
                        $step_inputs = $event['inputs'];
                        $step_dests = $event['dests'];
                        $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid,$oid,$mid);
                        if(is_null($step_triggle)){
                        $step_triggle =1;
                    }
                        if(!$step_triggle){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                            $step_cmmt2 = lexical_analysis\process_string($step_cmmt2,$sid,$oid,$mid);
                            echo $step_cmmt2."<br/>";
                            $cmid = $cmid + 1;
                            $cdid[] = $cmid;
                            $just_page = $encode->encode("cmd=$parents_cmd&ucmd=$cmid&sid=$sid");
                             $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
                            }elseif($step_triggle){
                            $step_cmmt = lexical_analysis\process_string($step_cmmt,$sid,$oid,$mid);
                            echo $step_cmmt."<br/>";
                            $ret = attrsetting($step_s_attrs,$sid,$oid,$mid);
                            $ret_2 = attrchanging($step_m_attrs,$sid,$oid,$mid);
                            $ret_3 = itemchanging($step_items,$sid,$oid,$mid);
                            //$ret_4 = skillschanging($step_a_skills,$sid);
                            if($step_dests !=''){
                            $ret_5 = destsing($step_dests,$sid);
                            $cmd = 'gm_scene_new';
                            $ym = 'module_all/main_page.php';
                            include_once $ym;
                            }
                            $page_id = str_replace('ct_', '', $step_page_name);
                            //这里写事件核心
                            if($page_id !=''){
                                if($steps_page >=$count){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                                }
                            $ym = 'module_all/self_page.php';
                            include_once $ym;
                            }
                            if($step_just_return ==1){
                                $cmd = $parents_cmd;
                                $currentFilePath = $parents_page;
                                $ym = $currentFilePath;
                                include_once $ym;
                            }
                            if($steps_page <$steps_count && $step_just_return ==0){
                            if($step_inputs){
                                    $step_input = explode('|',$step_inputs);
                                    $form_id = $step_input[0];
                                    $form_text = $step_input[1];
                                    $form_type = $step_input[2];
                                    $form_type = $form_type ==0?"text":"number";
                                    $form_max = $step_input[3];
                                    $input_para = $form_id;
                                    $steps_page +=1;
                                    $cmid = $cmid + 1;
                                    $cdid[] = $cmid;
                                    $post_url = $encode->encode("cmd=main_target_event&para=$input_para&ucmd=$cmid&target_event=$target_event&parents_cmd=$parents_cmd&parents_page=$parents_page&steps_page=$steps_page&sid=$sid");
                                    $form_html = <<<HTML
<form action="?cmd=$post_url" method="post">
<input name="id" type="hidden"value="{$form_id}">
{$form_text}:<input name="value" type="{$form_type}" maxlength="{$form_max}"/><br/>
<input name="submit" type="submit"value="提交">
</form>
HTML;
                                    echo $form_html;
                                }else{
                                $steps_page +=1;
                                $cmid = $cmid + 1;
                                $cdid[] = $cmid;
                                $page_continue = $encode->encode("cmd=main_target_event&ucmd=$cmid&target_event=$target_event&parents_cmd=$parents_cmd&parents_page=$parents_page&steps_page=$steps_page&sid=$sid");
                                $page_continue =<<<HTML
                    <a href="?cmd=$page_continue">继续</a><br/>
HTML;
                            if($step_not_return_link ==0){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                            $cmid = $cmid + 1;
                            $cdid[] = $cmid;
                            $just_page = $encode->encode("cmd=$parents_cmd&ucmd=$cmid&sid=$sid");
                            $page_continue .=<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                            }
                    echo $page_continue;
                                }
                            }
                            elseif($steps_page >=$count){
                            if($step_inputs){
                                    $step_input = explode('|',$step_inputs);
                                    $form_id = $step_input[0];
                                    $form_text = $step_input[1];
                                    $form_type = $step_input[2];
                                    $form_type = $form_type ==0?"text":"number";
                                    $form_max = $step_input[3];
                                    $input_para = $form_id;
                                    $steps_page +=1;
                                    $cmid = $cmid + 1;
                                    $cdid[] = $cmid;
                                    $post_url = $encode->encode("cmd=$parents_cmd&ucmd=$cmid&sid=$sid");
                                    $form_html = <<<HTML
<form action="?cmd=$post_url" method="post">
<input name="id" type="hidden"value="{$form_id}">
{$form_text}:<input name="value" type="{$form_type}" maxlength="{$form_max}"/><br/>
<input name="submit" type="submit"value="提交">
</form>
HTML;
                                    echo $form_html;
                                }elseif($step_not_return_link ==0){
                            if($page_id ==''){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                            $cmid = $cmid + 1;
                            $cdid[] = $cmid;
                            $just_page = $encode->encode("cmd=$parents_cmd&ucmd=$cmid&sid=$sid");
                            $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
}
}
                                elseif($step_not_return_link ==1){
                            if($page_id ==''){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                    echo $page_url;
}
                                }
                        }
                            }
                        }
                        
                    }

                    }
}


?>