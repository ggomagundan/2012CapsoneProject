<?php

session_start();

if(isset($_SESSION['user']) ){
	$current_user = $_SESSION['user'];
	$loggedin = TRUE;
}else{
	$loggedin = FALSE;
}

function reset_all_session(){
	$_SESSION = array();
	
	if(ini_get("session.use_cookies")){
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	}
	
	session_destroy();
	session_start();
}

function isLogin(){
	if(!isset($_SESSION['user'])){
			echo "<script type='text/javascript'>alert('로그인 해주세요!');location.replace('../index.php');</script>";
	}
}


?>