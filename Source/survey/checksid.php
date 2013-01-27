<?php
	$sids = array("survey1","survey2");
	
	if(isset($_POST['query'])){
		$query = $_POST['query'];
	}else if(isset($_GET['query'])){
		$query = $_GET['query'];
	}else{
		die();
	}
	
	if(strlen($query)>4){
		foreach($sids as $name){
			if($name == $query){
				echo("사용할 수 없는 ID입니다");
				return;
			}else{
				echo("사용할 수 있는 ID입니다");
				return;
			}
		}
	}
?>