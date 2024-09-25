<?php

$inina = "user.ini";
$path = 'ache/' . $wjid;
$file = $path . "/" . $inina;

if (!file_exists($file)) {
    //ini文件名字
    $inina = "user.ini";
    //判断文件夹是否存在
    //路径
    $path = './ache/' . $wjid;
    $dir = $path;
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $kcmid = 1;
    $ka4 = 1;
    $ka5 = 1;
    $ky = date('Y');
    $km = date('m');
    $kd = date('d');
    $kh = date('H');
    $ki = date('i');
    $ks = date('s');
    file_put_contents($file, "[" . $wjid . "]");
    $iniFile = new iniFile($file);
    $iniFile->addItem('验证信息', [
        '玩家id' => $wjid,
        '玩家验证' => $wjid,
        'cmid值' => $kcmid,
        'xcmid值' => $ka4,
        'dcmid值' => $ka5,
        '年' => $ky,
        '月' => $km,
        '日' => $kd,
        '时' => $kh,
        '分' => $ki,
        '秒' => $ks
    ]);
    $iniFile->addItem('地图坐标', ['p' => '0']);
    $iniFile->addItem('最后页面id', ['页面id' => '0']);
    $iniFile->addItem('超链接值', ['初始' => 123]);
} else {
    $iniFile = new iniFile($file);
}

