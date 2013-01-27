<?php
	require_once("../config/datacon.php");

 	if ( $_FILES["profile"]["size"]/1024/1024 > 4 ){
		Header("Location: join.php?msg=sizeover");
	} 
	if ((($_FILES["profile"]["type"] == "image/gif")
		|| ($_FILES["profile"]["type"] == "image/jpeg")
		|| ($_FILES["profile"]["type"] == "image/pjpeg"))
		|| ($_FILES["profile"]["type"] == "image/png")){
	
		$_path = "/var/www/uploadimg/".date("YmdHis").'_'.$_FILES["profile"]["name"];
		if(move_uploaded_file($_FILES["profile"]["tmp_name"], $_path)){
			$email = $pwd = $familyName = $personalName = $celPhoneNumber = $age = $profilePicture = $sex ="";
			
			if ( isset($_POST['userid']) ) 	$email = escape_str($_POST['userid']);
			if ( isset($_POST['pwd']) ) $pwd = escape_str($_POST['pwd']);
			if ( isset($_POST['firstname']) ) $familyName = escape_str($_POST['firstname']);
			if ( isset($_POST['lastname']) ) $personalName = escape_str($_POST['lastname']);
			if ( isset($_POST['tel']) ) $celPhoneNumber = escape_str($_POST['tel']);
			if ( isset($_POST['age']) ) $age = escape_str($_POST['age']);
			if ( isset($_POST['sex']) ) $sex = escape_str($_POST['sex']);
			
			if ( strlen($email) == 0 or strlen($pwd) == 0 or strlen($familyName) == 0 or strlen($celPhoneNumber) == 0 or
																strlen($personalName) == 0 	or strlen($age) == 0 or strlen($sex) == 0 ){
				Header("Location: join.php?msg=InputError");
			}else{
				$query = "select count(*) as c from Member where email = '".$email."'";
				$temp = mysql_query($query);
				while ( $i = mysql_fetch_array($temp) ){
					if ( $i['c'] == 1 ) Header("Location: join.php?msg=IdError");
				}
				
				if ( $sex == 'm' ) $sex = 1;
				else $sex = 0;
				
				$query = "insert into Member values('".$email."','".$pwd."','".$familyName."','".$personalName."','"
										.$celPhoneNumber."','".$age."','".$_path."','".$sex."')";
				mysql_query($query);
				?><script>alert("You make id of our site!");window.close();</script><?php
			}  
		}else{
			Header("Location: join.php?msg=error");
		}
	}else{
		Header("Location: join.php?msg=checktype");
	}
?>