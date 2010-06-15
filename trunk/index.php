<?php

include_once ("smarty_header.php");
include_once ("connect.php");
@session_start ();
//include_once ("check_session.php");
if ($_SESSION ['name'] != '') {

}
$smarty->display ( "index.html" );
//} else {
//	header ( "Location:status.php" );
//}


?>