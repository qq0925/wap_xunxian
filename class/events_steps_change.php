<?php
require_once 'lexical_analysis.php';
require_once 'data_lexical.php';
require_once 'event_data_get.php';


$parents_cmd = \player\getplayer($sid,$dblj)->ulast_cmd;

if(!$para){
events_steps_change($target_event,$sid,$dblj,$just_page,$steps_page,$cmid,$parents_page,$oid,$mid,$para);
}else {
    $input_value = $_POST['value'];
    $sql = "insert into system_player_inputs(sid,event_id,id,value)values('$sid','$target_event','$id','$input_value')";
    $dblj->exec($sql);
events_steps_change($target_event,$sid,$dblj,$just_page,$steps_page,$cmid,$parents_page,null,null,$para);
}
function events_steps_change($target_event,$sid,$dblj,$just_page,$steps_page,&$cmid,$parents_page,$oid=null,$mid=null,$para=null){
                //事件逻辑
                    global $encode;
                    global $steps_page;
                    global $parents_cmd;
                    global $parents_page;
                    
                    $event_data = self_event_data_get($target_event,$dblj);
                    //var_dump($event_data['system_event']['module_id']);
                    $event_cond = $event_data['system_event']['cond'];
                    $event_cmmt = $event_data['system_event']['cmmt'];
                    $event_step_count = $event_data['system_event']['link_evs'];
                    
                    //考虑先判空再计算
                    if($steps_page==0){
                    $register_triggle = checkTriggerCondition($event_cond,$dblj,$sid,$oid,$mid);//触发条件
                    if(is_null($register_triggle)){
                        $register_triggle =1;//若触发条件为空则默认true
                    }
                    if(!$register_triggle){
                    $step_cmmt = html_entity_decode($step_cmmt);
                    $event_cmmt = \lexical_analysis\process_string($event_cmmt,$sid,$oid,$mid);
                    $event_cmmt = \lexical_analysis\process_photoshow($event_cmmt);
                    $event_cmmt = \lexical_analysis\color_string($event_cmmt);
                    echo $event_cmmt."<br/>";//不满足触发条件则输出cmmt
                    
                    $cmid = $cmid + 1;
                    $cdid[] = $cmid;
                    //这里写默认不生成返回链接的动作
                    
                    //考虑module_id取值。物品和战斗页面触发条件不满足不生成返回游戏链接
                    //$event_data['system_event']['module_id']
                    if($cmd !=$pve_fighting){
                    $just_page = $encode->encode("cmd=$parents_cmd&mid=$mid&ucmd=$cmid&sid=$sid");
                    $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
                    }
                    }elseif($register_triggle &&!empty($event_step_count)){
                        //步骤数量非空，赋初值1
                        $steps_page = 1;
                    }
                    }
                    
                    if($steps_page >0){
                        next_step:
                        if(!empty($event_data['system_event']['link_evs'])){
                        $system_event_evs = $event_data["system_event_evs"];
                        $count = count($system_event_evs);
                        if($steps_page <=$count){
                        $event =$system_event_evs[$steps_page-1];
                        $steps_count = count($system_event_evs);
                        
                        $step_cond = $event['cond'];//触发条件
                        $step_exec_cond = $event['exec_cond'];//执行条件

                        $step_s_attrs = $event['s_attrs'];
                        $step_m_attrs = $event['m_attrs'];
                        $step_items = $event['items'];
                        $step_a_skills = $event['a_skills'];
                        $step_r_skills = $event['r_skills'];
                        $step_r_tasks = $event['r_tasks'];
                        $step_fight_npcs = $event['fight_npcs'];
                        $step_a_adopt = $event['a_adopt'];
                        $step_r_adopt = $event['r_adopt'];
                        $step_page_name = $event['page_name'];
                        $step_not_return_link = $event['not_return_link'];
                        $step_just_return = $event['just_return'];
                        $step_inputs = $event['inputs'];
                        $step_dests = $event['dests'];
                        $step_triggle = checkTriggerCondition($step_cond,$dblj,$sid,$oid,$mid);
                        $step_exec_triggle = checkTriggerCondition($step_exec_cond,$dblj,$sid,$oid,$mid);
                        $step_cmmt = $event['cmmt'];
                        $step_cmmt2 = $event['cmmt2'];
                        
                        if(is_null($step_triggle)){
                        $step_triggle =1;
                    }
                        if(is_null($step_exec_triggle)){
                        $step_exec_triggle =1;
                    }
                        if(!$step_triggle){
                            
                            $sql = "delete from system_player_inputs where sid = '$sid'";//input寿命终结
                            $dblj->exec($sql);
                            $step_cmmt2 = html_entity_decode($step_cmmt2);
                            $step_cmmt2 = \lexical_analysis\process_string($step_cmmt2,$sid,$oid,$mid);
                            $step_cmmt2 = \lexical_analysis\process_photoshow($step_cmmt2);
                            $step_cmmt2 = \lexical_analysis\color_string($step_cmmt2);
                            echo $step_cmmt2."<br/>";
                            $cmid = $cmid + 1;
                            $cdid[] = $cmid;
                            
                            //考虑module_id取值。物品和战斗页面触发条件不满足不生成返回游戏链接
                            //$event_data['system_event']['module_id']
                            if($parents_cmd!="iteminfo_new"||$step_not_return_link ==0){
                                if($mid){
                            $just_page = $encode->encode("cmd=$parents_cmd&mid=$mid&ucmd=$cmid&sid=$sid");
                                }else{
                            $just_page = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
                                }
                             $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
                            }
                            }elseif($step_triggle){
                            //注意，当上一步骤中带有“移动目标”或“是否返回游戏是”或“ct_”时，下面的所有步骤都是不会执行的！
                            if($step_exec_triggle){
                                
                                //这里可以进行输入非空判断
                                
                            $ret = attrsetting($step_s_attrs,$sid,$oid,$mid,$para);
                            $ret_2 = attrchanging($step_m_attrs,$sid,$oid,$mid,$para);
                            $ret_3 = itemchanging($step_items,$sid);
                            $ret_4 = skillschanging($step_a_skills,$sid,1);
                            $ret_6 = skillschanging($step_r_skills,$sid,2);
                            $ret_7 = taskschanging($step_r_tasks,$sid,2);
                            $ret_8 = adoptpeting($step_a_adopt,$sid,1);
                            $ret_9 = adoptpeting($step_r_adopt,$sid,2);
                            $step_cmmt = html_entity_decode($step_cmmt);
                            $step_cmmt = \lexical_analysis\process_string($step_cmmt,$sid,$oid,$mid);
                            $step_cmmt = \lexical_analysis\process_photoshow($step_cmmt);
                            $step_cmmt = \lexical_analysis\color_string($step_cmmt);
                            
                            if($step_cmmt){
                            echo $step_cmmt."<br/>";
                            }
                            if($step_fight_npcs !=''){
                                //$not_ret_canshu = 1;
                                $retgw = explode(",",$step_fight_npcs);
                                for ($i = 0; $i < @count($retgw); $i++){
                                $itemgw = $retgw[$i]; // 引用数组元素
                                $gwinfo = explode("|",$itemgw);
                                $guaiwu = \player\getnpc($gwinfo[0],$dblj);
                                $guaiwu->nid = $gwinfo[0];
                                $gw_count = \lexical_analysis\process_string($gwinfo[1],$sid);
                                $gw_count = eval("return $gw_count;");
                                for ($n=0;$n<$gw_count;$n++){
                                    // 要复制的数据行id
                                    $nid = $guaiwu->nid;
                                    // 获取旧表字段列表
                                    $stmt = $dblj->prepare("SHOW COLUMNS FROM system_npc");
                                    $stmt->execute();
                                    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
                                    // 构建动态插入语句
                                    $cols = implode(", ",$columns);
                                    $nowdate = date('Y-m-d H:i:s');
                                    $sql = "INSERT INTO system_npc_midguaiwu ($cols, nsid, nmid, ncreate_time) 
                                            SELECT $cols, :sid, :nmid, :nowdate 
                                            FROM system_npc 
                                            WHERE nid = :nid";
                                    
                                    // 准备语句
                                    $stmt = $dblj->prepare($sql);
                                    
                                    // 使用 bindParam 来绑定参数
                                    $stmt->bindParam(':nmid', $mid, PDO::PARAM_INT);
                                    $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
                                    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);  // sid 是 text 类型
                                    $stmt->bindParam(':nowdate', $nowdate, PDO::PARAM_STR);  // nowdate 是 date 类型
                                    
                                    // 执行语句
                                    $stmt->execute();
                                    
                                    // 获取插入的 ID
                                    $ngid = $dblj->lastInsertId();
                                    $sql = "insert into game2(sid,gid) values ('$sid','$ngid')";
                                    $dblj->exec($sql);
                                    $sql = "insert into game3(sid,gid) values ('$ngid','$sid')";
                                    $dblj->exec($sql);
                                }
    }
                               $cmd = "pve_fight";
                                \player\changeplayersx('ucmd',$cmd,$sid,$dblj);
                                \player\changeplayersx('uis_pve',1,$sid,$dblj);
                                $ym = 'module_all/scene_fight.php';
                                include $ym;
                                return;
                            }
                            
                            if($step_dests !=''){
                            $return_canshu = 1;
                            $ret_5 = destsing($step_dests,$sid);
                            $cmd = 'gm_scene_new';
                            if(is_numeric($ret_5)){
                            $tps_newmid = $ret_5;
                            $newmid = $ret_5;
                            \player\changeplayersx('tpsmid',$tps_newmid,$sid,$dblj);
                            }else{
                            exit($ret_5);
                            }
                            $ym = 'module_all/main_page.php';
                            //$not_ret_canshu =1;
                            include_once $ym;
                            
                            }
                            
                            $page_id = str_replace('ct_', '', $step_page_name);
                            //这里写事件核心
                            if($page_id !=''){
                                $return_canshu = 1;
                                if($steps_page >=$count){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                                }
                            $dblj->exec("update system_self_define_module set call_sum = call_sum + 1 where id = '$page_id'");
                            $ym = 'module_all/self_page.php';
                            include_once $ym;
                            }
                            
                            
                            //可以参考读取$module_id的值,非自定模板页面统一返回主界面，其余返回自定模板页面
                            if($step_just_return ==1){
                                $return_canshu = 1;
                                $cmd = $parents_cmd;
                                $currentFilePath = $parents_page;
                                $ym = $currentFilePath;
                                include_once $ym;
                                return;
                            }
                            
                            //存在return参数，直接退出函数
                            if($return_canshu ==1){
                                return;
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
                                    $post_url = $encode->encode("cmd=main_target_event&mid=$mid&para=$input_para&ucmd=$cmid&target_event=$target_event&parents_cmd=$parents_cmd&parents_page=$parents_page&steps_page=$steps_page&sid=$sid");
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
                                $page_continue = $encode->encode("cmd=main_target_event&mid=$mid&oid=$oid&ucmd=$cmid&target_event=$target_event&parents_cmd=$parents_cmd&parents_page=$parents_page&steps_page=$steps_page&sid=$sid");
                                $page_continue =<<<HTML
                    <a href="?cmd=$page_continue">继续</a><br/>
HTML;
                            if($step_not_return_link ==0 && $not_ret_canshu!=1){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                            $cmid = $cmid + 1;
                            $cdid[] = $cmid;
                            
                            $just_page = $encode->encode("cmd=$parents_cmd&mid=$mid&ucmd=$cmid&sid=$sid");
                                $page_continue .=<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                            }
                    echo $page_continue;
                                }
                            }
                            elseif($steps_page >=$count && $step_just_return ==0){
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
                                    
                                    $post_url = $encode->encode("cmd=$parents_cmd&mid=$mid&ucmd=$cmid&sid=$sid");
                                    $form_html = <<<HTML
<form action="?cmd=$post_url" method="post">
<input name="id" type="hidden"value="{$form_id}">
{$form_text}:<input name="value" type="{$form_type}" maxlength="{$form_max}"/><br/>
<input name="submit" type="submit"value="提交">
</form>
HTML;
                                    echo $form_html;
                                }else{
                            if($step_not_return_link ==0 && $page_id =='' && $not_ret_canshu!=1){
                            $sql = "delete from system_player_inputs where sid = '$sid'";
                            $dblj->exec($sql);
                            $cmid = $cmid + 1;
                            $cdid[] = $cmid;
                            
                            $just_page = $encode->encode("cmd=$parents_cmd&mid=$mid&ucmd=$cmid&sid=$sid");
                            $page_url =<<<HTML
                    <a href="?cmd=$just_page">返回游戏</a><br/>
HTML;
                    echo $page_url;
}
}
                        }
                            }
                            else{
                                $steps_page ++;
                                goto next_step;
                            }
                        }
                        
                    }
}
                    }
}


?>