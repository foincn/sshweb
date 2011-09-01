<?php
header("Content-Type: text/html; charset=gbk");
include_once ("smarty_header.php");
include_once ("connect.php");
@session_start ();
$name = $_POST [id];
$pass = $_POST [pw];
$yz = $_POST [yz];
//print_r($_POST);
if ($name == '') {
	echo "输入错误";
	$smarty->display ( "login.html" );
	/*
} elseif ($yz != $_SESSION ['VCODE']) {
	echo "输入验证码错误";
	$smarty->display ( "login.html" );   */
}  
else {
	$sql = "select * from user where name = '$name'";
	$result = mysql_query ( $sql );
	//echo $result;
	$in_user = mysql_fetch_array ( $result );
	if ($pass == $in_user [password]) {
		//进入系统
		$_SESSION ['name'] = $name;
		$login = 250;
		//TODO:跳转页面
		header ( "Location:status.php" );
	} else {
		echo "输入错误";
		$smarty->display ( "index.html" );
	}
	//print_r($in_user);
}
?>