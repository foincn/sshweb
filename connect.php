<?php
$server = "184.82.244.41:3306";
$user = "root";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("�����������ݿ�:".mysql_error());

mysql_select_db('ssh') or die("�����������ݿ�:".mysql_error());

?>