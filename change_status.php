<?php
include_once ("smarty_header.php");
include_once ("connect.php");
include_once ("check_session.php");
$name = $_POST [id];
$pass = $_POST [pw];
$email = $_POST [email];
$qq = $_POST [qq];
$taobao_name = $_POST [taobao_name];
//print_r ( $_POST );
if ($_SESSION ["name"] != $name){
	echo "�Ƿ��û������в��尡��";
} 
else{	
	$sql = "update user set password='$pass',taobao_name='$taobao_name',qq='$qq',email='$email' where name='$name'";
	$result = mysql_query ( $sql ) or die ( "wrong:" . mysql_error () );
	//TODO:��תҳ��&&��������ҳ��
	header("Location:status.php");

}
?>