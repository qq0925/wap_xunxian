<?php
// require_once 'class/lexical_analysis.php';
// include_once 'pdo.php';
$map_id = $mid;
$nowmid_arr = array('name'=>'','desc'=>'','photo'=>'','tianqi'=>'','map_upper'=>'','map_left'=>'','map_right'=>'','map_lower'=>'');
$nowmid_desc = '';
function map_init($map_id,$dblj){
    global $nowmid_arr; // 声明 $nowmid_arr 为全局变量
    $sql = "SELECT * FROM system_map WHERE mid = :mapId";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':mapId', $map_id, PDO::PARAM_INT);
    $stmt->execute();
    $map = $stmt->fetch(PDO::FETCH_ASSOC);
    $map_name = $map['mname'];
    $map_name = \lexical_analysis\color_string($map_name);
    $map_desc = $map['mdesc'];
    $map_photo = $map['mphoto'];
    $map_desc = \lexical_analysis\color_string($map_desc);
    $map_tianqi = $map['mtianqi'];
    $next_map_name = $map['mup'];
    $nowmid_arr['map_upper'] = $next_map_name;
    $next_map_name = $map['mdown'];
    $nowmid_arr['map_lower'] = $next_map_name;
    $next_map_name = $map['mleft'];
    $nowmid_arr['map_left'] = $next_map_name;
    $next_map_name = $map['mright'];
    $nowmid_arr['map_right'] = $next_map_name;
    $next_map_name = $map_id;
    $nowmid_arr['name'] = $map_name;
    $nowmid_arr['desc'] = $map_desc;
    $nowmid_arr['photo'] = $map_photo;
    $nowmid_arr['tianqi'] = $map_tianqi;
    return $next_map_name;
}

function map_find($map_id){
    global $dblj;
    $sql = "SELECT mid,mname,mup,mdown,mleft,mright FROM system_map WHERE mid = :mapId";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':mapId', $map_id, PDO::PARAM_INT);
    $stmt->execute();
    $map = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($map !== false) {
        // 将 mname 字段通过 lexical_analysis\color_string 函数处理后再存回数组中
        $map['mname'] = \lexical_analysis\color_string($map['mname']);
    }
    return $map;
}


map_init($map_id,$dblj);

$map_0_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 正中间
$map_1_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 右边连接
$map_2_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 右边地图名
$map_3_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 右右边连接
$map_4_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 右右边地图名
$map__1_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 左边连接
$map__2_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 左边地图名
$map__3_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 左左边边接
$map__4_name = array('m__4_name' => ' ', 'm__3_name' => ' ', 'm__2_name' => ' ', 'm__1_name' => ' ', 'm_0_name' => ' ', 'm_1_name' => ' ', 'm_2_name' => ' ', 'm_3_name' => ' ', 'm_4_name' => ' '); // 左左边地图名

$map_0_name['m_0_name'] = '<font color="red">' . $nowmid_arr['name'] . '</font>';
$jm_page = create_encryption(null, '场景');
$jm_upper = '';
$jm_lower = '';
$jm_right = '';
$jm_left = '';


if ($nowmid_arr['map_upper'] > 0) {
    try {
        $maps = map_find($nowmid_arr['map_upper']);
        $map_1_name['m_0_name'] = '│';
        $jm_upper = create_encryption(null, $nowmid_arr['map_upper']);
        $map_2_name['m_0_name'] = $maps['mname'];

        if ($maps['mup'] > 0) {
            try {
                $maps1 = map_find($maps['mup']);
                $map_3_name['m_0_name'] = '│';
                $map_4_name['m_0_name'] = $maps1['mname'];

                if ($maps1['mleft'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mleft']);
                        $map_4_name['m__1_name'] = '─';
                        $map_4_name['m__2_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mright'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mright']);
                        $map_4_name['m_1_name'] = '─';
                        $map_4_name['m_2_name'] = $maps2['mname'];

                        if ($maps2['mright'] > 0) {
                            try {
                                $maps3 = map_find($maps2['mright']);
                                $map_4_name['m_3_name'] = '─';
                                $map_4_name['m_4_name'] = $maps3['mname'];
                            } catch (Exception $e) {
                            }
                        }
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }

        if ($maps['mleft'] > 0) { // 只检测上和左
            try {
                $maps1 = map_find($maps['mleft']);
                $map_2_name['m__1_name'] = '─';
                $map_2_name['m__2_name'] = $maps1['mname'];

                if ($maps1['mup'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mup']);
                        $map_3_name['m__2_name'] = '│';
                        $map_4_name['m__2_name'] = $maps2['mname'];

                        if ($maps2['mleft'] > 0) {
                            try {
                                $maps3 = map_find($maps2['mleft']);
                                $map_4_name['m__3_name'] = '─';
                                $map_4_name['m__4_name'] = $maps3['mname'];
                            } catch (Exception $e) {
                            }
                        }
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mleft'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mleft']);
                        $map_2_name['m__3_name'] = '─';
                        $map_2_name['m__4_name'] = $maps2['mname'];

                        if ($maps2['mup'] > 0) {
                            try {
                                $maps3 = map_find($maps2['mup']);
                                $map_3_name['m__4_name'] = '│';
                                $map_4_name['m__4_name'] = $maps3['mname'];
                            } catch (Exception $e) {
                            }
                        }
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }

        if ($maps['mright'] > 0) { // 只检测上和右
            try {
                $maps1 = map_find($maps['mright']);
                $map_2_name['m_1_name'] = '─';
                $map_2_name['m_2_name'] = $maps1['mname'];

                if ($maps1['mup'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mup']);
                        $map_3_name['m_2_name'] = '│';
                        $map_4_name['m_2_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mright'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mright']);
                        $map_2_name['m_3_name'] = '─';
                        $map_2_name['m_4_name'] = $maps2['mname'];

                        if ($maps2['mup'] > 0) {
                            try {
                                $maps3 = map_find($maps2['mup']);
                                $map_3_name['m_4_name'] = '│';
                                $map_4_name['m_4_name'] = $maps3['mname'];
                            } catch (Exception $e) {
                            }
                        }
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }
    } catch (Exception $e) {
    }
}

if ($nowmid_arr['map_lower'] > 0) {
    try {
        $maps = map_find($nowmid_arr['map_lower']);
        $map__1_name['m_0_name'] = '│';
        $map__2_name['m_0_name'] = $maps['mname'];
        $jm_lower = create_encryption(null, $nowmid_arr['map_lower']);

        if ($maps['mdown'] > 0) {
            try {
                $maps1 = map_find($maps['mdown']);
                $map__3_name['m_0_name'] = '│';
                $map__4_name['m_0_name'] = $maps1['mname'];

                if ($maps1['mleft'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mleft']);
                        $map__4_name['m__1_name'] = '─';
                        $map__4_name['m__2_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mright'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mright']);
                        $map__4_name['m_1_name'] = '─';
                        $map__4_name['m_2_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }

        if ($maps['mleft'] > 0) { // 只检测上和左
            try {
                $maps1 = map_find($maps['mleft']);
                $map__2_name['m__1_name'] = '─';
                $map__2_name['m__2_name'] = $maps1['mname'];

                if ($maps1['mdown'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mdown']);
                        $map__3_name['m__2_name'] = '│';
                        $map__4_name['m__2_name'] = $maps2['mname'];

                        if ($maps2['mleft'] > 0) {
                            try {
                                $maps3 = map_find($maps2['mleft']);
                                $map__4_name['m__3_name'] = '─';
                                $map__4_name['m__4_name'] = $maps3['mname'];
                            } catch (Exception $e) {
                            }
                        }
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }

            if ($maps1['mleft'] > 0) {
                try {
                    $maps2 = map_find($maps1['mleft']);
                    $map__2_name['m__3_name'] = '─';
                    $map__2_name['m__4_name'] = $maps2['mname'];
                    if ($maps2['mdown'] > 0) {
                        try {
                            $maps3 = map_find($maps2['mdown']);
                            $map__3_name['m__4_name'] = '│';
                            $map__4_name['m__4_name'] = $maps3['mname'];

                            if ($maps3['mright'] > 0) {
                                try {
                                    $maps4 = map_find($maps3['mright']);
                                    $map__4_name['m__3_name'] = '─';
                                    $map__4_name['m__2_name'] = $maps4['mname'];
                                } catch (Exception $e) {
                                }
                            }
                        } catch (Exception $e) {
                        }
                    }
                } catch (Exception $e) {
                }
            }
        }

        if ($maps['mright'] > 0) { // 只检测上和右
            try {
                $maps1 = map_find($maps['mright']);
                $map__2_name['m_1_name'] = '─';
                $map__2_name['m_2_name'] = $maps1['mname'];

                if ($maps1['mdown'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mdown']);
                        $map__3_name['m_2_name'] = '│';
                        $map__4_name['m_2_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mright'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mright']);
                        $map__2_name['m_3_name'] = '─';
                        $map__2_name['m_4_name'] = $maps2['mname'];

                        if ($maps2['mdown'] > 0) {
                            try {
                                $maps3 = map_find($maps2['mdown']);
                                $map__3_name['m_4_name'] = '│';
                                $map__4_name['m_4_name'] = $maps3['mname'];

                                if ($maps3['mleft'] > 0) {
                                    try {
                                        $maps4 = map_find($maps3['mleft']);
                                        $map__4_name['m_3_name'] = '─';
                                        $map__4_name['m_2_name'] = $maps4['mname'];
                                    } catch (Exception $e) {
                                    }
                                }
                            } catch (Exception $e) {
                            }
                        }
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }
    } catch (Exception $e) {
    }
}

if ($nowmid_arr['map_right'] > 0) {
    try {
        $maps = map_find($nowmid_arr['map_right']);
        $map_0_name['m_1_name'] = '─';
        $map_0_name['m_2_name'] = $maps['mname'];
        $jm_right = create_encryption(null, $nowmid_arr['map_right']);

        if ($maps['mright'] > 0) {
            try {
                $maps1 = map_find($maps['mright']);
                $map_0_name['m_3_name'] = '─';
                $map_0_name['m_4_name'] = $maps1['mname'];

                if ($maps1['mup'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mup']);
                        $map_1_name['m_4_name'] = '│';
                        $map_2_name['m_4_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mdown'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mdown']);
                        $map__1_name['m_4_name'] = '│';
                        $map__2_name['m_4_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }

        if ($maps['mup'] > 0) {
            try {
                $maps1 = map_find($maps['mup']);
                $map_1_name['m_2_name'] = '│';
                $map_2_name['m_2_name'] = $maps1['mname'];
            } catch (Exception $e) {
            }
        }

        if ($maps['mdown'] > 0) {
            try {
                $maps1 = map_find($maps['mdown']);
                $map__1_name['m_2_name'] = '│';
                $map__2_name['m_2_name'] = $maps1['mname'];
            } catch (Exception $e) {
            }
        }
    } catch (Exception $e) {
    }
}

if ($nowmid_arr['map_left'] > 0) {
    try {
        $maps = map_find($nowmid_arr['map_left']);
        $map_0_name['m__1_name'] = '─';
        $map_0_name['m__2_name'] = $maps['mname'];
        $jm_left = create_encryption(null, $nowmid_arr['map_left']);

        if ($maps['mleft'] > 0) {
            try {
                $maps1 = map_find($maps['mleft']);
                $map_0_name['m__3_name'] = '─';
                $map_0_name['m__4_name'] = $maps1['mname'];

                if ($maps1['mup'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mup']);
                        $map_1_name['m__4_name'] = '│';
                        $map_2_name['m__4_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }

                if ($maps1['mdown'] > 0) {
                    try {
                        $maps2 = map_find($maps1['mdown']);
                        $map__1_name['m__4_name'] = '│';
                        $map__2_name['m__4_name'] = $maps2['mname'];
                    } catch (Exception $e) {
                    }
                }
            } catch (Exception $e) {
            }
        }

        if ($maps['mup'] > 0) {
            try {
                $maps1 = map_find($maps['mup']);
                $map_1_name['m__2_name'] = '│';
                $map_2_name['m__2_name'] = $maps1['mname'];
            } catch (Exception $e) {
            }
        }

        if ($maps['mdown'] > 0) {
            try {
                $maps1 = map_find($maps['mdown']);
                $map__1_name['m__2_name'] = '│';
                $map__2_name['m__2_name'] = $maps1['mname'];
            } catch (Exception $e) {
            }
        }
    } catch (Exception $e) {
    }
}

if ($jm_upper != '') {
    $map_2_name['m_0_name'] = '<a href="?cmd=' . $jm_upper . '" '. ' style="font-size:11px;"' . $target_top . '>' . $map_2_name['m_0_name'] . '</a>';
}

if ($jm_lower != '') {
    $map__2_name['m_0_name'] = '<a href="?cmd=' . $jm_lower . '" '. ' style="font-size:11px;"' . $target_top . '>' . $map__2_name['m_0_name'] . '</a>';
}

if ($jm_right != '') {
    $map_0_name['m_2_name'] = '<a href="?cmd=' . $jm_right . '" '. ' style="font-size:11px;"' . $target_top . '>' . $map_0_name['m_2_name'] . '</a>';
}

if ($jm_left != '') {
    $map_0_name['m__2_name'] = '<a href="?cmd=' . $jm_left . '" '. ' style="font-size:11px;"' . $target_top . '>' . $map_0_name['m__2_name'] . '</a>';
}

// Print the map
$map_check = '<table style="font-size:10px;"><tr>';
foreach ($map_4_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_3_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_2_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_1_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_0_name as $k => $v) {
    if ($k == 'm_0_name') {
        $map_check .= '<td align="center" nowrap="true" style="border:1px solid red;">' . $v . '</td>';
    } else {
        $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
    }
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__1_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__2_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__3_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__4_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr></table>';

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if($nowmid_arr['photo']){
$nowmid_photo = "#".$nowmid_arr['photo']."#";
$nowmid_photo = \lexical_analysis\process_photoshow($nowmid_photo);
$nowmid_photo = $nowmid_photo."<br/>";
}

$nowmid_arr_desc = $nowmid_arr['desc'];
if($nowmid_arr_desc){
$nowmid_arr_desc = \lexical_analysis\process_string($nowmid_arr_desc,$sid,'scene',$mid);
$nowmid_arr_desc =\lexical_analysis\process_photoshow($nowmid_arr_desc);
$nowmid_arr_desc =\lexical_analysis\color_string($nowmid_arr_desc);
$nowmid_desc = nl2br($nowmid_arr_desc)."<br/>";
}
if($nowmid_arr['tianqi']){
$nowmid_desc .="天气：".$nowmid_arr['tianqi']."<br/>";
}
$map_check .=<<<HTML
$nowmid_photo
$nowmid_desc
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
echo $map_check;
// Function to create an encryption
function create_encryption($encryption=null, $value)
{
    global $encode;
    global $sid;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $value = $encode->encode("cmd=map_detail&mid=$value&ucmd=$cmid&sid=$sid");
    return $value;
}
?>
