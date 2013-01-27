<?php
	require_once '../config/session.php';
	
	if($loggedin){
		reset_all_session();
	}
	header("Location: ../");
?>