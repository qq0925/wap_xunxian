
<?php
$sqlname='xunxian';
$sqlpass='lwd54088';
$dbhost='localhost';
$dbname='xunxian';
$dsn="mysql:host=$dbhost;dbname=$dbname;";
$dblj = new PDO($dsn,$sqlname,$sqlpass,array(PDO::ATTR_PERSISTENT=>true));
$dblj->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dblj->query("SET NAMES utf8mb4");
/*class update{
function update($table,$arrData,$condition) {
$flag = 1;
foreach($arrData as $key => $value) {
if($flag) {
$data = "$key = '$value'";
$flag = 0;
} else $data .= ",$key = '$value'";
}
$strSql = "update $table set $data where $condition";
if($this->result = $this->db->exec($strSql)) {
return true;
}
return false;
}
}*/

?>