<?php
@session_start();
include_once ("smarty_header.php");
include ("connect.php");
$name = $_POST [id];
$pass = $_POST [pw];
$pass2 = $_POST [pw2];
$email = $_POST [email];
$qq = $_POST [qq];
$yz = $_POST [yz];
$taobao_name = $_POST [taobao_name];
//echo $_SESSION ['VCODE'];
if ($pass2 == '') {
	echo "输入错误";
	$smarty->display ( "reg.html" );
} elseif ($_SESSION ['VCODE'] != $yz) {
	echo "输入验证码错误";
	$smarty->display ( "reg.html" );
} else {
	$sql = "select * from user where name = '$name'";
	$result = mysql_query ( $sql );
	//echo $result;
	$in_user = mysql_fetch_array ( $result );
	//print_r($in_user);
	if ('' == $in_user [name]) {
		//加用户
		if ($pass != $pass2) {
			echo "两次输入不一致";
			$smarty->display ( "reg.html" );
		} else {
			$date = date ( "Y-m-d" );
			$sql = "insert into `user` values (default , '$name' , '$pass2' , null ,null,'$taobao_name','$qq','$email','0','$date')";
			$result = mysql_query ( $sql ) or die ( "wrong:" . mysql_error () );
			$_SESSION ['name'] = $name;
			/*
			echo "注册成功";
			$smarty->display ( "index.html" );
*/
			header ( "Location:status.php?method=reg" );
		}
	} else {
		echo "有相同的用户名存在";
		$smarty->display ( "reg.html" );
	}
	//print_r($in_user);
}
?>