<?php
	require_once("../config/datacon.php");
	
	if(isset($_POST['query'])){
		$data = $_POST['query'];
	}else if(isset($_GET['query'])){
		$data = $_GET['query'];
	}else{
		echo "Cannot access";
	}
	
	if (strlen($data)>0){
		$query = "select email from Member";
		$id_list = mysql_query($query);		
		while ( $name = mysql_fetch_array($id_list)){
			if($name['email'] == $data){
				echo('<li class="checkli">Alread Used!</li>');
			}
		}
	}
?>	