<?php
$server = "3.ssh0.com:3306";
$user = "root";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("不能链接数据库:".mysql_error());

mysql_select_db('ssh') or die("不能链接数据库:".mysql_error());

?>