<?php
$server = "fan-qiang.com:3306";
$user = "ssh";
$pass = "buptisc";


mysql_connect($server,$user,$pass) or die("�����������ݿ�:".mysql_error());

mysql_select_db('test') or die("�����������ݿ�:".mysql_error());

?>