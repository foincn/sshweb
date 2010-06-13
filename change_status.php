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
if ($_SESSION ["name"] != $name) {
	echo "非法用户，多行不义啊！";
} else {
	$sql = "update user set password='$pass',taobao_name='$taobao_name',qq='$qq',email='$email' where name='$name'";
	$result = mysql_query ( $sql ) or die ( "wrong:" . mysql_error () );
	//TODO:跳转页面&&设置密码页面
	$sql = "select * from user where name='$name'";
	$result = mysql_query ( $sql );
	$in_user = mysql_fetch_array ( $result );
	if ($in_user ['overtime'] != '') {
		require_once 'servers.php';
		foreach ($servers as $server){
			$url = "http://$server:9999/cgi-bin/system_adduser.cgi?name=$name&pass=$pass";
			@file_get_contents($url);
		}
	}
	
	header ( "Location:status.php" );

}
?>