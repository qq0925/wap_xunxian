<?php
$myfile = fopen("test2.php", "w") or die("Unable to open file!");
$txt = "<?php\necho \"Hello world!\";\n?>";
fwrite($myfile, $txt);
fclose($myfile);
echo "3秒后跳转";
header('Refresh:3,Url=test2.php');
?>