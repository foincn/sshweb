<?php
//$name = $_GET['name'];
//exec("ls",$output);
//print_r($output);
//$useradd = "useradd";
//system("sudo /usr/sbin/useradd test1");
//print_r($output);
//exec("echo \"123123\" | sudo passwd test",$output);
//print_r($output);
//echo $return;

$su = "su --login root --command '/usr/sbin/useradd test1'";
$root = "123123";
$fp = @popen($su , "w");
@fputs($fp , $root);
@pcolse($fp);
?>