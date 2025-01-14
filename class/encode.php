<?php
/**
 * 作用：将网址加密与解密
 * User: Administrator
 * Date: 2016/6/10
 * Time: 14:50
 */
namespace encode;
//use DB;

// class encode
// {
//     function encode($string = '', $skey = 'casper_chen') {
// if (isset($string)) {
//     parse_str($string, $variables); // $variables 是解析后的变量数组
//     // 这里可以对 $variables 数组进行操作
// }
// $sid = $variables['sid'];
// $ucmd = $variables['ucmd'];
// if(!$ucmd){
//     $ucmd  = 0;
// }
// $dblj = DB::pdo();
// $sql = "insert into user_cmd_change(url_true,cmd,sid)values('$string','$ucmd','$sid')";
// $dblj->exec($sql);
// $ret_url = "$ucmd&sid=$sid";
// return $ret_url;
//     }


//     function decode($cmd = '',$sid = '') {
// $dblj = DB::pdo();
// $sql = "select * from user_cmd_change where cmd = '$cmd' and sid = '$sid'";
// $cxjg = $dblj->query($sql);
// $cxjg->bindColumn('url_true',$url_true);
// $cxjg->fetch(\PDO::FETCH_ASSOC);
// return $url_true;
//     }
// }

class encode
{
    function encode($string = '', $skey = 'casper_chen') {
        $strArr = str_split(base64_encode($string));
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value)
            $key < $strCount && $strArr[$key].=$value;
        return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
    }


    function decode($string = '', $skey = 'casper_chen') {
        $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value) {
            $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
        }
        return base64_decode(join('', $strArr));
    }
}