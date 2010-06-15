<?php

include_once ("smarty_header.php");
include_once ("connect.php");
include_once ("check_session.php");

$name = $_SESSION ["name"];
//echo $name;
$sql = "select * from user where name = '$name'";

$result = mysql_query ( $sql );
$in_user = mysql_fetch_array ( $result );

$smarty->assign ( "name", $in_user ['name'] );
$smarty->assign ( "password", $in_user ['password'] );
$smarty->assign ( "paytime", $in_user ['paytime'] );
$smarty->assign ( "overtime", $in_user ['overtime'] );
$smarty->assign ( "taobao_name", $in_user ['taobao_name'] );
$smarty->assign ( "qq", $in_user ['qq'] );
$smarty->assign ( "email", $in_user ['email'] );
$smarty->assign ( "regtime", $in_user ['regtime'] );

$today = date ( "Y-m-d" );
$r = substr ( $today, 8, 2 ); //ÈÕ
$y = substr ( $today, 5, 2 ); //ÔÂ
$n = substr ( $today, 0, 4 ); //Äê
$yestoday = date ( "Y-m-d", mktime ( 0, 0, 0, $y, $r - 1, $n ) );
$daybeyes = date ( "Y-m-d", mktime ( 0, 0, 0, $y, $r - 2, $n ) );

if ($in_user ['regtime'] == $today || $in_user ['regtime'] == $yestoday || $in_user ['regtime'] == $daybeyes) {
	$sql = "select * from user where name = 'test'";
	$result = mysql_query ( $sql );
	$test = mysql_fetch_array ( $result );
	$smarty->assign ( "testpassword", $test ['password'] );
}

$smarty->display ( "status.html" );

//print_r($in_user);
?>