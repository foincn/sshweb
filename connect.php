<?php
$server = "192.168.123.3:3306";
$user = "root";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("不能连接数据库:".mysql_error());

mysql_select_db('test') or die("不能连接数据库:".mysql_error());

?>