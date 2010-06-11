<?php
$server = "localhost:3306";
$user = "root";
$pass = "";


mysql_connect($server,$user,$pass) or die("不能链接数据库:".mysql_error());

mysql_select_db('ssh') or die("不能链接数据库:".mysql_error());

?>