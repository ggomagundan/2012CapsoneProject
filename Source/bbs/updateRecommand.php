<?php
	require_once('../bbs/db/db_connect.php');
	if(isset($_POST['jsonstr'])){
		var_dump($_POST['jsonstr']);
		$data = $_POST['jsonstr'];
		$data = json_decode($data, true);
		
		$sql1 = 'update UserWriteToCommunity set recommand = recommand+1 ';
		
		$sql1 .= 'where community_id=' . $data['community_id'] .' and depth1='.$data['depth1'] .' and depth2=0' ;
		
		
		mysql_query($sql1);
		mysql_query("commit");  
	}

	
	// community_id : commu_id, 
	// depth1 : depth1 
	
	?>