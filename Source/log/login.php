<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
	if(isset($_POST['loginId'])){
		if(strlen($_POST['loginId']) != 0 ){
			$username = escape_str($_POST['loginId']);
			$query = "select email, password, profilePicture from Member where email = '$username'";
			$result = mysql_query($query);
			while( $info = mysql_fetch_array($result) ){
				$info_id = $info['email'];
				$info_password = $info['password'];
				$info_pic = $info['profilePicture'];
			}
			
			if($_POST['loginId'] == $info_id && $_POST['loginPwd'] == $info_password){
				$_SESSION['user'] = $username;
				$_SESSION['pic'] = $info_pic;
				$message = "loginOK";
				header("Location: ../index.php?message=".urlencode($message));
				die();
			}else{
				$message = "ERROR";
				header("Location: ../index.php?message=".urlencode($message));
				die();
			}
		}
		$message = "ERROR";
		header("Location: ../index.php?message=".urlencode($message));
		die();
	}else{
		$message = "ERROR";
		header("Location: ../index.php?message=".urlencode($message));
		die();
	}
?>
