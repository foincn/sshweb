<?php
include_once ("smarty_header.php");
include_once ("connect.php");

$sql = "select * from user";

$result = mysql_query ( $sql );

while ( $arr_user = mysql_fetch_array ( $result ) ) {
	if(date("Y-m-d",strtotime($date))>=date("Y-m-d")){
	$usrname = $arr_user [name];
	$usrpass = $arr_user [password];
	$date = $arr_user [overtime];
	system ( "/usr/sbin/useradd $usrname" );
	system ( "echo $usrname:$usrpass | /usr/sbin/chpasswd" );
	system ( "/usr/sbin/usermod -e $date $usrname" );
	echo "$usrname:$usrpass:$date<br>";
	}
}

?>