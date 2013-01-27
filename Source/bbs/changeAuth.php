<?php
	require_once('../bbs/db/db_connect.php');
	if(isset($_POST['jsonstr'])){
		var_dump($_POST['jsonstr']);
		$data = $_POST['jsonstr'];
		$data = json_decode($data, true);
		
		$sql1 = $data['sql'];
		
		
		mysql_query($sql1);
		mysql_db_query("commit");  
	}

	
	// community_id : commu_id, 
	// depth1 : depth1 
	
	?>