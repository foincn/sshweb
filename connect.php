<?php
$server = "localhost:3306";
$user = "root";
$pass = "";


mysql_connect($server,$user,$pass) or die("�����������ݿ�:".mysql_error());

mysql_select_db('ssh') or die("�����������ݿ�:".mysql_error());

?>