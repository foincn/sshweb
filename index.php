<?php

	include_once("smarty_header.php");
	include_once("connect.php");
	include_once("check_session.php");
	
	$smarty->display("index.html");
?>