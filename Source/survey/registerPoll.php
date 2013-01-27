<?php 
	require_once '../config/session.php';
	require_once("../config/datacon.php");
	
	$poll_id = $_SESSION['sid'];
	$problem_id = 1;
	$title = array();
	$type = array();
	$file_path = array();
	
	$max;

 	for ( $i = 1; isset($_POST['type'.$i]) ; $i++ ){
		$type[$i] = escape_str($_POST['type'.$i]);
		$title[$i] = escape_str($_POST['title'.$i]);
		if($_FILES["img".$i]["size"] == 0){
			$file_path[$i] = "";
		}else if($_FILES["img".$i]["size"]/1024/1024 <= 4 ) {
			$file_path[$i] = "/var/www/surveyUpload/".date("YmdHis").'_'.$_FILES["img".$i]["name"];
		}else{
			Header("Location: createQuestion.php?msg=No".$i."SizeOver");
		}
	}
	
	$max = $i;
		
	$query = $_SESSION['query'];

	mysql_query($query);
	session_unregister("query");

 	for ( $i = 1; $i < $max ; $i++ ){
		$problem_id = $i;
		move_uploaded_file($_FILES["img".$i]["tmp_name"], $file_path[$i]);
		$query = "insert into Question values('".$poll_id."','".$problem_id."','".$title[$i]."','".$type[$i]."','".$file_path[$i]."')";
		mysql_query($query);
		if ( $type[$i] == "objective" ){
			for ( $j = 1; isset($_POST[$i.'number'.$j]) ; $j++ ){
				$content = escape_str($_POST[$i.'number'.$j]);
				$select_id = $j;
				$query = "insert into QuestionSelect values('".$poll_id."','".$problem_id."','".$select_id."','".$content."')";
				mysql_query($query);
			}
		}
	}  
	Header("Location: ../index.php");

?>