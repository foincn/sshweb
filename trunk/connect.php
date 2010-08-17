<?php
$server = "72.11.150.242:3306";
$user = "ssh";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("不能链接数据库:".mysql_error());

mysql_select_db('ssh') or die("不能链接数据库:".mysql_error());

?>