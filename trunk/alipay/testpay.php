<?php
$pay_money = "45";
$receive_user = "testdb";

switch ($pay_money) {
	case 45 :
		$add = 12;
		break;
	case 25 :
		$add = 6;
		break;
	case 13 :
		$add = 3;
		break;
	case 4.5 :
		$add = 1;
		break;
	case 0.01 :
		$add = 2;
		break;
	default :
		$add = 0;
}
$server = "67.23.228.116:3306";
$user = "ssh";
$pass = "buptisc";

@mysql_connect ( $server, $user, $pass );
@mysql_select_db ( 'ssh' );
$sql = "select * from user where name='$receive_user'";

$result = mysql_query ( $sql );
$in_user = mysql_fetch_array ( $result );
$pay_date = date ( "Y-m-d" );

if ($in_user ['overtime'] == '') {
	//not paid person!
	$r = substr ( $pay_date, 8, 2 ); //日
	$y = substr ( $pay_date, 5, 2 ); //月
	$n = substr ( $pay_date, 0, 4 ); //年
	$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r, $n ) );

} else {
	if (date ( "Y-m-d", strtotime ( $in_user ['overtime'] ) ) > date ( "Y-m-d" )) {
		$r = substr ( $in_user ['overtime'], 8, 2 ); //日
		$y = substr ( $in_user ['overtime'], 5, 2 ); //月
		$n = substr ( $in_user ['overtime'], 0, 4 ); //年
		$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r, $n ) );
		///echo "Y";
	} else {
		$r = substr ( $pay_date, 8, 2 ); //日
		$y = substr ( $pay_date, 5, 2 ); //月
		$n = substr ( $pay_date, 0, 4 ); //年
		$end_date = date ( "Y-m-d", mktime ( 0, 0, 0, $y + $add, $r, $n ) );
		//echo "N";
	}
}
$sql = "update user set paytime='$pay_date',overtime='$end_date' where name = '$receive_user'";
$result = mysql_query ( $sql );
?>