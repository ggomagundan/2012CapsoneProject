<?php
	require_once("../config/datacon.php");


	$email = $community_id ="";
	
	if ( isset($_POST['user_id']) ) 	$email = escape_str($_POST['user_id']);
	if ( isset($_POST['community_id']) ) $community_id = escape_str($_POST['community_id']);
	
	if ( strlen($email) == 0 or strlen($community_id) == 0 ){
		Header("Location: join.php?msg=InputError");
	}else{
		$query = "select count(*) as c from CommunityToUser where email = '".$email."' and community_id = '".$community_id."'";
		$temp = mysql_query($query);
		while ( $i = mysql_fetch_array($temp) ){
			if ( $i['c'] == 1 ) {
				
				Header("Location: join.php?msg=duplicate");
	
				return;
			}
		}
		
		$query = "insert into CommunityToUser values('".$email."','".$community_id."')";
		mysql_query($query);
		header("Location: join.php?msg=complete");
	}  

?>