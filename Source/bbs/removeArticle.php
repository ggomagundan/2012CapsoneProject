<?php
	require_once('../bbs/db/db_connect.php');
	if(isset($_POST['jsonstr'])){
		var_dump($_POST['jsonstr']);
		$data = $_POST['jsonstr'];
		$data = json_decode($data, true);
		
		$sql1 = 'delete from UserWriteToCommunity ';
		$sql1 .= 'where community_id=' . $data['community_id'] .' and depth1='.$data['depth1'] . ' and depth2='.$data['depth2'] ;
		
		
		mysql_query($sql1);
		mysql_query("commit");  
	}

	
	// community_id : commu_id, 
	// depth1 : depth1, 
	// depth2 : depth2
	
	?>