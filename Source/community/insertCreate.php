<?php
	require_once("../config/datacon.php");

 	if ( $_FILES["door"]["size"]/1024/1024 > 4 or $_FILES["banner"]["size"]/1024/1024 > 4){
		Header("Location: create.php?msg=sizeover");
	}
	if ((($_FILES["door"]["type"] == "image/gif")
		|| ($_FILES["door"]["type"] == "image/jpeg")
		|| ($_FILES["door"]["type"] == "image/pjpeg")
		|| ($_FILES["door"]["type"] == "image/png")
		|| ($_FILES["door"]["name"] == NULL))
		& (($_FILES["banner"]["type"] == "image/gif") 
		|| ($_FILES["banner"]["type"] == "image/jpeg")
		|| ($_FILES["banner"]["type"] == "image/pjpeg")
		|| ($_FILES["banner"]["type"] == "image/png")
		|| ($_FILES["banner"]["name"] == NULL))){
			
		$_path1 = $_path2 = NULL;	
		if($_FILES["door"]["name"] != NULL){
			$_path1 = "/var/www/uploadimg/".date("YmdHis").'_'.$_FILES["door"]["name"];
			if(!move_uploaded_file($_FILES["door"]["tmp_name"], $_path1)){
				Header("Location: create.php?msg=error");
				return;
			}else{
				$_path1 = "/uploadimg/".date("YmdHis").'_'.$_FILES["door"]["name"];
			}
		}
		if($_FILES["banner"]["name"] != NULL){
			$_path2 = "/var/www/uploadimg/".date("YmdHis").'_'.$_FILES["banner"]["name"];
			if(!move_uploaded_file($_FILES["banner"]["tmp_name"], $_path2)){
				Header("Location: create.php?msg=error");
				if(is_file($_path1)){
					unlink($_path1);
				}
				return;
			}else{
				$_path2 = "/uploadimg/".date("YmdHis").'_'.$_FILES["banner"]["name"];
			}
		}

		$name = $description = $policy = $email = "";
		
		if ( isset($_POST['name']) ) $name = escape_str($_POST['name']);
		if ( isset($_POST['description']) ) $description = escape_str($_POST['description']);
		if ( isset($_POST['policy']) ) $policy = escape_str($_POST['policy']);
		if ( isset($_POST['userId']) ) $email = escape_str($_POST['userId']);
		
		if ( strlen($name) == 0 or strlen($description) == 0 or strlen($policy) == 0 or strlen($email)  == 0 ){
			Header("Location: create.php?msg=InputError");
		}else{
			$query = "select count(*) as c from Community where email = '".$email."'";
			$temp = mysql_query($query);
			while ( $i = mysql_fetch_array($temp) ){
				if ( $i['c'] == 1 ) Header("Location: create.php?msg=IdError");
			}
			if($_path1 == NULL ){
				if($_path2 == NULL){
					$query = "insert into Community (community_Name,community_Desc,community_policy,create_id) values('".$name."','".$description."','".$policy."','".$email."')";
				}else{
					$query = "insert into Community (community_Name,community_Desc,community_policy,create_id,bannerPicture) values('".$name."','".$description."','".$policy."','".$email."','".$_path2."')";
				}	
			}else{
				if($_path2 == NULL){
					$query = "insert into Community (community_Name,community_Desc,community_policy,create_id,doorPicture) values('".$name."','".$description."','".$policy."','".$email."','".$_path1."')";
				}else{
					$query = "insert into Community (community_Name,community_Desc,community_policy,create_id,doorPicture,bannerPicture) values('".$name."','".$description."','".$policy."','".$email."','".$_path1."','".$_path2."')";
				}
			}
			
			mysql_query($query);
			?><script>alert("You make id of our site!");</script><?php
			Header("Location: ../index.php");
		}  

	}else{
		Header("Location: create.php?msg=checktype");
	}
?>