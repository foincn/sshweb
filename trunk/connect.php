<?php
$server = "67.23.228.116:3306";
$user = "root";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("�����������ݿ�:".mysql_error());

mysql_select_db('ssh') or die("�����������ݿ�:".mysql_error());

?>