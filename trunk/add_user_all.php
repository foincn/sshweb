<?php
include_once ("smarty_header.php");
include_once ("connect.php");

$sql = "select * from user";

$result = mysql_query ( $sql );

while ( $arr_user = mysql_fetch_array ( $result ) ) {
	
	$usrname = $arr_user [name];
	$usrpass = $arr_user [password];
	$date = $arr_user [overtime];
	if(date("Y-m-d",(strtotime($date)+43200))>=date("Y-m-d")){
	exec ( "/usr/sbin/useradd $usrname" );
	exec ( "echo $usrname:$usrpass | /usr/sbin/chpasswd" );
	exec ( "/usr/sbin/usermod -e $date $usrname" );
	echo "$usrname:$usrpass:$date<br>";
	}
}

?>