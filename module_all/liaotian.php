<?php
$player = \player\getplayer($sid,$dblj);
$_SERVER['PHP_SELF'];
if($player->uis_designer ==1){
$goto_url = $encode->encode("cmd=gm_game_othersetting&canshu=14&sid=$sid");
$goto_desi = "<a href='?cmd=$goto_url'>设计头部页面</a><br/>";
echo $goto_desi;
}

$game_config = \player\getgameconfig($dblj);
$list_row = $game_config->list_row;
$chat_head = $game_config->chat_head;

function create_head($head_value, $sid, &$cmid, $dblj, $canshu,$channel_name) {
    global $encode;
    $ret_url = $head_value;
    $channels = [
        'all' => '公共',
        'im' => '私聊',
        'city' => '城聊',
        'area' => '区聊',
        'team' => '队聊',
        'system' => '系聊'
    ];
    $ret_url = str_replace('{{chat_now_nav}}', $channel_name, $ret_url);
    $cmid++;
    $flush_to = $encode->encode("cmd=liaotian&ltlx=$canshu&ucmd=$cmid&sid=$sid");
    $chat_flush_url ="<a href='?cmd=$flush_to'>刷新</a>";
    $ret_url = str_replace('{{chat_flush_url}}', $chat_flush_url, $ret_url);
    // 处理物品类型模式
    $ret_url = preg_replace_callback('/\{\{chat_type_([^}]+)\}\}/', function($matches) use ($encode,$channels, $sid, &$cmid, $canshu) {
    $type = $matches[1];
    $lx_name = $channels[$type];
        $cmid++;
        // 创建此类型的编码URL
        $nav_choose_url = $encode->encode("cmd=liaotian&ltlx=$type&ucmd=$cmid&sid=$sid");
        
        // 如果这是当前选择的类型，只返回文本
        if ($type === $canshu) {
            return $lx_name;
        } else {
            return "<a href=\"?cmd=$nav_choose_url\">{$lx_name}</a>";
        }
    }, $ret_url);

    $ret_url = \lexical_analysis\process_string($ret_url,$sid,$oid,$mid);
    $ret_url = \lexical_analysis\process_photoshow($ret_url);
    $ret_url =\lexical_analysis\color_string($ret_url);
    return nl2br($ret_url);
} 
// 通用函数：处理消息删除
function handleMessageDelete($dblj, $delete_msid) {
    if ($delete_msid) {
        echo "删除成功！<br/>";
        $stmt = $dblj->prepare("DELETE FROM system_chat_data WHERE id = :id");
        $stmt->execute([':id' => $delete_msid]);
        return true;
    }
    return false;
}

// 通用函数：获取分页信息
function getPagination($dblj, $chat_type, $filter_condition, $list_row, $currentPage, $params = []) {
    // 计算总行数
    $sqlCount = "SELECT COUNT(*) as total FROM system_chat_data WHERE $chat_type $filter_condition";
    $countStmt = $dblj->prepare($sqlCount);
    
    // 执行查询，如果有参数则绑定
    if (!empty($params)) {
        $countStmt->execute($params);
    } else {
        $countStmt->execute();
    }
    
    $countRow = $countStmt->fetch(PDO::FETCH_ASSOC);
    $totalRows = $countRow['total'];
    
    // 计算总页数
    $totalPages = ceil($totalRows / $list_row);
    
    // 计算偏移量
    $offset = ($currentPage - 1) * $list_row;
    
    return [
        'totalRows' => $totalRows,
        'totalPages' => $totalPages,
        'offset' => $offset
    ];
}

// 通用函数：构建分页链接
function buildPaginationLinks($encode, $cmid, $ltlx, $sid, $currentPage, $totalPages) {
    $page_html = '';
    
    if ($currentPage > 2) {
        $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
        $page_html .= "<a href=\"?cmd=$main_page\">首页</a> ";
    }
    
    if ($currentPage > 1) {
        $prev_page = $currentPage - 1;
        $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$prev_page&sid=$sid");
        $page_html .= "<a href=\"?cmd=$main_page\">上页</a> ";
    }
    
    if ($currentPage < $totalPages) {
        $next_page = $currentPage + 1;
        $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$next_page&sid=$sid");
        $page_html .= "<a href=\"?cmd=$main_page\">下页</a> ";
    }
    
    if ($totalPages > 2 && $currentPage < $totalPages - 1) {
        $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$totalPages&sid=$sid");
        $page_html .= "<a href=\"?cmd=$main_page\">末页</a>";
    }
    
    return $page_html;
}

// 通用函数：渲染消息
function renderMessages($messages, $encode, &$cmid, $player, $ltlx, $channel_name) {
    $html = '';
    
    foreach ($messages as $message) {
        $uname = $message['name'];
        $umsg = \lexical_analysis\color_string($message['msg']);
        $uid = intval($message['uid']); // 确保为整数
        $send_time = date("m-d H:i", strtotime($message['send_time']));
        $send_type = intval($message['send_type']);
        $msg_id = intval($message['id']);
        $imuid = isset($message['imuid']) ? intval($message['imuid']) : 0;
        
        if ($uid) {
            $cmid++;
            
            if ($send_type == 0) {
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
            } elseif ($send_type == 1) {
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
            }
            
            // 如果是私聊，显示接收者链接
            $receiver_html = '';
            if ($ltlx == 'im') {
                $cmid++;
                $imucmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$imuid&sid=$player->sid");
                $receiver_html = "对<a href='?cmd=$imucmd'>你</a>说:";
            }
            
            $html .= "[<span style='color: orangered;'>$channel_name</span>]<a href='?cmd=$u_cmd'>$uname</a>$receiver_html$umsg<span class='txt-fade'>[$send_time]</span>";
            
            // 管理员可以删除消息
            if ($player->uis_designer == 1) {
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&delete_msid=$msg_id&sid=$player->sid");
                $html .= "<a href='?cmd=$delete_msg'>删除</a>";
            }
            
            $html .= "<br/>";
        } else {
            // 系统消息
            $html .= "<div class='hpys' style='display: inline; color: orangered'>[$channel_name]</div>$umsg<span class='txt-fade'>[$send_time]</span>";
            
            // 管理员可以删除消息
            if ($player->uis_designer == 1) {
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&delete_msid=$msg_id&sid=$player->sid");
                $html .= "<a href='?cmd=$delete_msg'>删除</a>";
            }
            
            $html .= "<br/>";
        }
    }
    
    return $html;
}

// 通用函数：渲染发送表单
function renderSendForm($encode, $cmid, $sid, $ltlx, $extra_fields = '') {
    $post_url = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
    
    $form = <<<HTML
===<br/>
<form action="?cmd={$post_url}" method="post">
<input type="hidden" name="ltlx" value="{$ltlx}">
{$extra_fields}
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    
    return $form;
}

// 当前页码
$currentPage = isset($list_page) ? intval($list_page) : 1;
$lthtml = '';
$page_html = '';

// 处理消息删除
if (isset($delete_msid)) {
    handleMessageDelete($dblj, $delete_msid);
    unset($delete_msid);
}

// 处理清空私聊
if (isset($delete_canshu) && $delete_canshu == 1 && $ltlx == 'im') {
    echo "已清空私聊信息!<br/>";
    $stmt = $dblj->prepare("DELETE FROM system_chat_data WHERE (imuid = :uid) AND (chat_type = 1 OR chat_type = 6)");
    $stmt->execute([':uid' => $player->uid]);
}

// 基于聊天类型设置查询条件和频道名称
switch ($ltlx) {
    case 'all':
        $chat_type_condition = "chat_type = 0";
        $filter_condition = "";
        $channel_name = "公共";
        $params = [];
        break;
        
    case 'im':
        // 恢复原来的私聊查询条件
        $chat_type_condition = "chat_type IN (1, 6) AND imuid = :imuid AND uid != -1";
        $filter_condition = "";
        $channel_name = "私聊";
        $params = [':imuid' => $player->uid];
        break;
        
    case 'city':
        $clmid = \player\getmid($player->nowmid, $dblj);
        $city_id = $clmid->marea_id;
        $chat_type_condition = "chat_type = 2 AND imuid = :imuid";
        $filter_condition = "";
        $channel_name = $clmid->marea_name;
        $params = [':imuid' => $city_id];
        break;
        
    case 'area':
        $clmid = \player\getmid($player->nowmid, $dblj);
        $city_id = $clmid->marea_id;
        $area_mid = \player\getqy($city_id, $dblj)->belong;
        $area_name = \gm\getregion($area_mid, $dblj)['name'];
        $chat_type_condition = "chat_type = 3 AND imuid = :imuid";
        $filter_condition = "";
        $channel_name = $area_name;
        $params = [':imuid' => $area_mid];
        break;
        
    case 'team':
        $team_id = \player\getteam($player->uteam_id, $dblj)['team_id'];
        $team_name = \player\getteam($player->uteam_id, $dblj)['team_name'];
        if ($team_id == 0) {
            $team_name = "你目前没有队伍!";
        }
        $chat_type_condition = "chat_type = 4 AND imuid = :imuid";
        $filter_condition = "";
        $channel_name = $team_name;
        $params = [':imuid' => $team_id];
        break;
        
    case 'system':
        $chat_type_condition = "chat_type = 6 AND imuid = 0";
        $filter_condition = "";
        $channel_name = "系统";
        $params = [];
        break;
        
    default:
        $chat_type_condition = "chat_type = 0";
        $filter_condition = "";
        $channel_name = "公共";
        $ltlx = 'all';
        $params = [];
}

// 获取分页信息
$pagination = getPagination($dblj, $chat_type_condition, $filter_condition, $list_row, $currentPage, $params);
$totalPages = $pagination['totalPages'];
$offset = $pagination['offset'];

// 获取聊天消息
$sql = "SELECT * FROM system_chat_data WHERE $chat_type_condition $filter_condition ORDER BY id DESC LIMIT :offset, :limit";
$stmt = $dblj->prepare($sql);

// 添加LIMIT参数
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $list_row, PDO::PARAM_INT);

// 绑定其他参数（如果有）
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ======= 构建UI开始 =======

// 构建基本页面结构(始终显示)

if($chat_head){
$lthtml = create_head($chat_head, $sid, $cmid, $dblj, $ltlx,$channel_name);
}
$lthtml .="<br/>";

// 显示消息或"暂无消息"提示
if (!empty($messages)) {
    // 渲染消息
    $lthtml .= renderMessages($messages, $encode, $cmid, $player, $ltlx, $channel_name);
    
    // 构建分页链接
    $page_html = buildPaginationLinks($encode, $cmid, $ltlx, $sid, $currentPage, $totalPages);
    if (!empty($page_html)) {
        $lthtml .= $page_html . "<br/>";
    }
    
    // 清空私聊按钮（仅私聊频道）
    if ($ltlx == 'im' && count($messages) > 0) {
        $delete_all_immsg = $encode->encode("cmd=liaotian&delete_canshu=1&ucmd=$cmid&ltlx=im&sid=$sid");
        $lthtml .= "<br/><a href='?cmd=$delete_all_immsg'>清空消息</a><br/>";
    }
} else {
    // 显示"暂无消息"提示
    $lthtml .= "<div style='padding: 15px; margin: 10px 0; color: #666; text-align: center; background-color: #f9f9f9; border-radius: 4px;'>暂无消息</div>";
}

// 发送表单(始终显示，除了特殊情况)
$cmid++;

if ($ltlx == 'im') {
    // 私聊需要输入对方ID
    $extra_fields = "对方id：<input type=\"text\" name=\"imuid\"><br/>\n消息：";
    $lthtml .= renderSendForm($encode, $cmid, $sid, $ltlx, $extra_fields);
} else if (($ltlx == 'team' && $team_id != 0) || $ltlx != 'team') {
    // 队伍聊天需要有队伍，其他频道直接显示
    $extra_fields = '';
    
    // 城市、区域、队伍聊天需要imuid字段
    if (in_array($ltlx, ['city', 'area', 'team'])) {
        $imuid_value = '';
        if ($ltlx == 'city') $imuid_value = intval($city_id);
        else if ($ltlx == 'area') $imuid_value = intval($area_mid);
        else if ($ltlx == 'team') $imuid_value = intval($team_id);
        
        $extra_fields = "<input type=\"hidden\" name=\"imuid\" value=\"$imuid_value\">\n";
    }
    
    // 系统聊天不显示表单
    if ($ltlx != 'system') {
        $lthtml .= renderSendForm($encode, $cmid, $sid, $ltlx, $extra_fields);
    }
}

// 返回游戏链接
$cmid++;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$player->nowmid&sid=$player->sid");
$html = <<<HTML
$lthtml
<br/>
<a href="?cmd={$gonowmid}">返回游戏</a>
HTML;

echo $html;
?>