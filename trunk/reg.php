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
		//���û�
		if($pass != $pass2){
			echo "�������벻һ��";
			$smarty->display("reg.html");
		}
		else{
			$sql = "insert into `user` values (default , '$name' , '$pass2' , now() ,null,null,null,null)";
			$result = mysql_query($sql) or die("wrong:".mysql_error());
			echo "ע��ɹ�";
			$smarty->display("login.html");
		}
	}
	else{
		echo "����ͬ���û�������";
		$smarty->display("reg.html");
	}
	//print_r($in_user);
}
?>