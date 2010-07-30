<?php
		$server = "72.11.150.242:3306";
		$user = "ssh";
		$pass = "buptisc";
		
		mysql_connect ( $server, $user, $pass );
		mysql_select_db ( 'ssh' );
		$sql = "select * from user where name='yangjie'";
		
		$result = mysql_query ( $sql );
		$in_user = mysql_fetch_array ( $result );
		$pay_date = date ( "Y-m-d" );
		

		$sql = "select * from user where name='yangjie'";
		echo $result = mysql_query ( $sql );
		/*
		//下面是在服务器上建账号
		$sql = "select * from user where name='$receive_user'";
		$result = mysql_query ( $sql );
		$in_user = mysql_fetch_array ( $result );
		
		require_once '../servers.php';
		foreach ( $servers as $server ) {
			$url = "http://$server:9999/cgi-bin/system_adduser.cgi?name=$receive_user&pass=".$in_user['password']."&date=$end_date";
			@file_get_contents ( $url );
		}
		@exec("../../fetion/fx/sms alipay::::$receive_user",$ret);
		
		*/
		echo "success";
?>