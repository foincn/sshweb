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
$smarty->assign("regtime",$in_user['regtime']);
$smarty->assign("paytime",$in_user['paytime']);
$smarty->assign("overtime",$in_user['overtime']);
$smarty->assign("ssh_name",$in_user['ssh_name']);
$smarty->assign("ssh_pass",$in_user['ssh_pass']);
$smarty->display("status.html");

print_r($in_user);
?>