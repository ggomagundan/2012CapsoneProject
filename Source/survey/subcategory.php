<?php	
	if(isset($_POST['query'])){
		$query = $_POST['query'];
	}else if(isset($_GET['query'])){
		$query = $_GET['query'];
	}else{
		die();
	}
	
	if($query=="culture"){
		//foreach
		echo('<option value="xxxx">culture1</option>');
		//foreach end
		echo('<option value="etc">기타</option>');
	}else if($query=="life") {
		echo('<option value="xxxx">life1</option>');
		echo('<option value="etc">기타</option>');		
	}else if($query=="society") {
		echo('<option value="xxxx">so1</option>');	
		echo('<option value="etc">기타</option>');		
	}else if($query=="study") {
		echo('<option value="xxxx">st1</option>');
		echo('<option value="etc">기타</option>');		
	}else if($query=="sports") {
		echo('<option value="xxxx">sp1</option>');
		echo('<option value="etc">기타</option>');		
	}else if($query=="hotissue") {
		echo('<option value="xxxx">ho1</option>');
		echo('<option value="etc">기타</option>');		
	}
?>