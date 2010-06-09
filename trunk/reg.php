<?php
include_once("smarty_header.php");
include("connect.php");
$name = $_POST[id];
$pass = $_POST[pw];
$pass2 = $_POST[pw2];
//print_r($_POST);
if($pass2 == ''){
	$smarty->display("reg.html");
}
else{
	$sql = "select * from user where name = '$name'";
	$result = mysql_query($sql);
	//echo $result;
	$in_user = mysql_fetch_array($result);
	//print_r($in_user);
	if('' == $in_user[name]){
		//没有这个用户，可以加
		if($pass != $pass2){
			echo "两次输入密码不一致";
			$smarty->display("reg.html");
		}
		else{
			$sql = "insert into `user` values (default , '$name' , '$pass2' , now() ,null,null,null,null)";
			$result = mysql_query($sql) or die("wrong:".mysql_error());
			echo "注册成功";
			$smarty->display("login.html");
		}
	}
	else{
		echo "有相同的用户名存在";
		$smarty->display("reg.html");
	}
	//print_r($in_user);
}
?>