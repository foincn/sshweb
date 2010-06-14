<?php

	include_once("smarty_header.php");
	include_once("connect.php");
	include_once("check_session.php");


$name = $_SESSION["name"];
//echo $name;
$sql = "select * from user where name = '$name'";

$result = mysql_query($sql);
$in_user = mysql_fetch_array($result);

$smarty->assign("name",$in_user['name']);
$smarty->assign("password",$in_user['password']);
$smarty->assign("paytime",$in_user['paytime']);
$smarty->assign("overtime",$in_user['overtime']);
$smarty->assign("taobao_name",$in_user['taobao_name']);
$smarty->assign("qq",$in_user['qq']);
$smarty->assign("email",$in_user['email']);
$smarty->assign("regtime",$in_user['regtime']);


$sql = "select * from user where name = 'test'";
$smarty->assign("testpassword",$in_user['password']);

if($in_user['regtime'] != ''){
	
}

$smarty->display("status.html");

//print_r($in_user);
?>