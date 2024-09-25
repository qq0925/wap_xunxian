<?php
function get_system_event_data($event_id,$dblj) {
    try {
        // 准备查询语句
        $query = "SELECT * FROM system_event WHERE id = :event_id";
        $stmt = $dblj->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        // 执行查询
        $stmt->execute();

        // 处理查询结果
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        } else {
            return array(); // 如果没有匹配数据，则返回空数组
        }
    } catch (PDOException $e) {
        die("数据库连接失败: " . $e->getMessage());
    }
}

function get_self_event_data($event_id,$dblj) {
    try {
        // 准备查询语句
        $query = "SELECT * FROM system_event_self WHERE id = :event_id";
        $stmt = $dblj->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        // 执行查询
        $stmt->execute();
        // 处理查询结果
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        } else {
            return array(); // 如果没有匹配数据，则返回空数组
        }
    } catch (PDOException $e) {
        die("数据库连接失败: " . $e->getMessage());
    }
}

function get_npc_event_data($event_id,$dblj) {
    try {
        // 准备查询语句
        $query = "SELECT * FROM system_npc_op WHERE id = :event_id";
        $stmt = $dblj->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        // 执行查询
        $stmt->execute();
        // 处理查询结果
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        } else {
            return array(); // 如果没有匹配数据，则返回空数组
        }
    } catch (PDOException $e) {
        die("数据库连接失败: " . $e->getMessage());
    }
}

function get_system_event_evs_data($link_evs,$dblj) {
    // 构建 IN 子句的占位符
    $placeholders = implode(',', array_fill(0, count($link_evs), '?'));
    // 准备查询语句
    $query = "SELECT * FROM system_event_evs WHERE id IN ($placeholders)";
    $stmt = $dblj->prepare($query);

    // 绑定 link_evs 数组的值作为参数
    $stmt->execute($link_evs);

    // 获取所有匹配的数据
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_self_event_evs_data($link_evs,$dblj) {
    // 构建 IN 子句的占位符
    $placeholders = implode(',', array_fill(0, count($link_evs), '?'));
    // 准备查询语句
    $query = "SELECT * FROM system_event_evs_self WHERE id IN ($placeholders)";
    $stmt = $dblj->prepare($query);

    // 绑定 link_evs 数组的值作为参数
    $stmt->execute($link_evs);

    // 获取所有匹配的数据
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function get_npc_event_evs_data($link_evs,$dblj) {
    // 构建 IN 子句的占位符
    $placeholders = implode(',', array_fill(0, count($link_evs), '?'));
    // 准备查询语句
    $query = "SELECT * FROM system_event_evs_npc WHERE id IN ($placeholders)";
    $stmt = $dblj->prepare($query);

    // 绑定 link_evs 数组的值作为参数
    $stmt->execute($link_evs);

    // 获取所有匹配的数据
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}



function global_event_data_get($event_id,$dblj) {
    $event_data = array();
    $system_event_data = get_system_event_data($event_id,$dblj);
            
    if (!empty($system_event_data)) {
        $link_evs = $system_event_data['link_evs'];
                
        // 检查 link_evs 是否为空
        if (!empty($link_evs)) {
                    // 获取system_event_evs表中id等于link_evs值的所有数据
            $link_evs = explode(',', $link_evs);
            $system_event_evs_data = get_system_event_evs_data($link_evs,$dblj);
                } else {
                    $system_event_evs_data = array();
                }
                
                // 将结果存入event_data数组
                $event_data['system_event'] = $system_event_data;
                $event_data['system_event_evs'] = $system_event_evs_data;
            }
            return $event_data;
}

function self_event_data_get($event_id,$dblj) {
    $event_data = array();
            // 获取system_event表中id等于$event_id的所有数据以及link_evs字段的值
            $system_event_data = get_self_event_data($event_id,$dblj);
            if (!empty($system_event_data)) {
                $link_evs = $system_event_data['link_evs'];
                
                // 检查 link_evs 是否为空
                if (!empty($link_evs)) {
                    // 获取system_event_evs表中id等于link_evs值的所有数据
                    $link_evs = explode(',', $link_evs);
                    $system_event_evs_data = get_self_event_evs_data($link_evs,$dblj);
                } else {
                    $system_event_evs_data = array();
                }
                
                // 将结果存入event_data数组
                $event_data['system_event'] = $system_event_data;
                $event_data['system_event_evs'] = $system_event_evs_data;
            }
    return $event_data;
}

function npc_event_data_get($event_id,$dblj) {
    $event_data = array();
            // 获取system_event表中id等于$event_id的所有数据以及link_evs字段的值
            $system_event_data = get_npc_event_data($event_id,$dblj);
            if (!empty($system_event_data)) {
                $link_evs = $system_event_data['link_evs'];
                
                // 检查 link_evs 是否为空
                if (!empty($link_evs)) {
                    // 获取system_event_evs表中id等于link_evs值的所有数据
                    $link_evs = explode(',', $link_evs);
                    $system_event_evs_data = get_npc_event_evs_data($link_evs,$dblj);
                } else {
                    $system_event_evs_data = array();
                }
                
                // 将结果存入event_data数组
                $event_data['system_event'] = $system_event_data;
                $event_data['system_event_evs'] = $system_event_evs_data;
            }
    return $event_data;
}


















?>