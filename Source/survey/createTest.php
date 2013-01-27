<?php
	require_once '../config/session.php';
	require_once("../config/datacon.php");

	if ( $_POST['constraint'] ) $policy = $_POST['constraint'] ;
	if ( $policy != 1 ) {
		Header("Location: create.php?msg=clickConstraint");
	}
	if ( $_FILES["picture"]["size"]/1024/1024 > 4 ){
		Header("Location: create.php?msg=sizeover");
	}

	if ((($_FILES["picture"]["type"] == "image/gif")
		|| ($_FILES["picture"]["type"] == "image/jpeg")
		|| ($_FILES["picture"]["type"] == "image/pjpeg"))
		|| ($_FILES["picture"]["type"] == "image/png")){

		$_path = "/var/www/uploadimg/".date("YmdHis").'_'.$_FILES["picture"]["name"];
		if(move_uploaded_file($_FILES["picture"]["tmp_name"], $_path)){
			$sid = $title = $bigcate = $startday = $endday = $maxPeople = $picture = $surveyinfo = 0;
	
			if ( isset($_POST['sid']) ) $sid = escape_str($_POST['sid']);
			if ( isset($_POST['title']) ) 	$title = escape_str($_POST['title']);
			if ( isset($_POST['bigcate']) ) $bigcate = escape_str($_POST['bigcate']);
			if ( isset($_POST['startday']) ) $startday = escape_str($_POST['startday']);
			if ( isset($_POST['lastname']) ) $lastname = escape_str($_POST['lastname']);
			if ( isset($_POST['endday']) ) $endday = escape_str($_POST['endday']);
			if ( isset($_POST['maxPeople']) ) $maxPeople = escape_str($_POST['maxPeople']);
			if ( isset($_POST['picture']) ) $picture = escape_str($_POST['picture']);
			if ( isset($_POST['surveyinfo']) ) $surveyinfo = escape_str($_POST['surveyinfo']);

			if ( strlen($sid) == 0 or strlen($title) == 0 or strlen($bigcate) == 0 or strlen($startday) == 0 or strlen($maxPeople) == 0 or strlen($picture) == 0){
				Header("Location: create.php?msg=InputError");
			}else{
				$user = $current_user;
				$query = "insert into Polls(poll_id,make_email, join_num, max_num, description, start_date, end_date, category, img_path, title)".
									" values('".$sid."','".$user."','0','".$maxPeople."','".$surveyinfo."','".$startday."','".$endday."','".$bigcate."','".$_path."','".$title."')";
				
				$_SESSION['query'] = $query;
				$_SESSION['sid'] = $sid; 
				
				Header("Location: createQuestion.php");			
			}  
		}else{
			Header("Location: create.php?msg=error");
		}
	}else{
		Header("Location: create.php?msg=checktype");
	}  
?>
