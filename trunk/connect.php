<?php
$server = "174.140.166.123:3306";
$user = "root";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("�����������ݿ�:".mysql_error());

mysql_select_db('ssh') or die("�����������ݿ�:".mysql_error());

?>