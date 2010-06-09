<?php
include_once("smarty_header.php");
include_once("connect.php");
@session_start();
$name = $_POST[id];
$pass = $_POST[pw];
//print_r($_POST);
if($name == ''){
	$smarty->display("login.html");
}
else{
	$sql = "select * from user where name = '$name'";
	$result = mysql_query($sql);
	//echo $result;
	$in_user = mysql_fetch_array($result);
	if($pass == $in_user[password]){
		//进入系统
		$_SESSION['name'] = $name;
		$login = 250;
		include("status.php");
	}
	else{
		echo "输入错误";
		$smarty->display("login.html");
	}
	//print_r($in_user);
}
?>