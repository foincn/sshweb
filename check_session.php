<?php
//Header("Content-Type:text/html; charset=utf-8");
//include("smarty_conf.php");
@session_start();


if($_SESSION["name"]==""){
	header("Location:templates/login.html");
	$notlogin = true;
}
?>