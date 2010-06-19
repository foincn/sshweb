<?php
$server = "67.23.228.116:3306";
$user = "root";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("不能链接数据库:".mysql_error());

mysql_select_db('ssh') or die("不能链接数据库:".mysql_error());

?>