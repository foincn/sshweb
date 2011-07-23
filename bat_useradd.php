<?php
include_once ("connect.php");
require_once 'servers.php';

$date_get = $_GET['date'];

$sql = "select * from user where date > $date_get";
set_time_limit ( 0 );
$result = mysql_query ( $sql );

while ( $arr_user = mysql_fetch_array ( $result ) ) {
	
	$usrname = $arr_user [name];
	$usrpass = $arr_user [password];
	$date = $arr_user [overtime];
	if (date ( "Y-m-d", (strtotime ( $date ) + 432000) ) >= date ( "Y-m-d" )) {
		foreach ( $servers as $server ) {
			$url = "http://$server:9999/cgi-bin/system_adduser.cgi?name=$usrname&pass=$pass&date=$date";
			@file_get_contents ( $url, false, $context );
		}
	}
}
?>