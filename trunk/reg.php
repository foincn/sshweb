<?php
@session_start ();
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
	echo "�������";
	$smarty->display ( "reg.html" );
} elseif ($_SESSION ['VCODE'] != $yz) {
	echo "������֤�����";
	$smarty->display ( "reg.html" );
} else {
	$sql = "select * from user where name = '$name'";
	$result = mysql_query ( $sql );
	//echo $result;
	$in_user = mysql_fetch_array ( $result );
	//print_r($in_user);
	if ('' == $in_user [name]) {
		
		//judge if had reg. if not white the ip
		$ip = $_SERVER ['REMOTE_ADDR'];
		$sql_checkip = "select * from ip where ip = '$ip'";
		$result_checkip = mysql_query ( $sql_checkip );
		$ip_in = mysql_fetch_array ( $result_checkip );
		if ('' == $ip_in [ip]) {
			//���û�
			if ($pass != $pass2) {
				echo "�������벻һ��";
				$smarty->display ( "reg.html" );
			} else {
				$date = date ( "Y-m-d" );
				$sql = "insert into `user` values (default , '$name' , '$pass2' , null ,null,'$taobao_name','$qq','$email','0','$date')";
				$result = mysql_query ( $sql ) or die ( "wrong:" . mysql_error () );
				$_SESSION ['name'] = $name;
				
				// insert the ip info
				$sql = "insert into `ip` values (default , '$name' , '$ip' )";
				$result = mysql_query ( $sql ) or die ( "wrong:" . mysql_error () );

				header ( "Location:status.php?method=reg" );
			}
		}
		else{
			echo "�����ظ�ע���ò��Ժţ������Ҫ��ö�����Ժ�����վ����ϵ������kecker��QQ58287926";
		}
	
	} else {
		echo "����ͬ���û�������";
		$smarty->display ( "reg.html" );
	}
	//print_r($in_user);
}
?>