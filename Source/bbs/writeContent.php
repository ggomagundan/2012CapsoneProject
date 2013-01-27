<?php
	require_once('../bbs/db/db_connect.php');
	if(isset($_POST['jsonstr'])){
		var_dump($_POST['jsonstr']);
		$data = $_POST['jsonstr'];
		$data = json_decode($data, true);
		
		$sql1 = 'insert into UserWriteToCommunity (community_id, email, depth1, depth2, content, recommand, guilty) ';
		$sql1 .= 'values('.$data['community_id'].', "'.$data['email'].'", '.$data['depth1'].', '.$data['depth2'].', "'.$data['content'].'",0,0)';
		mysql_query($sql1);
		mysql_query("commit");  
	}

	
	// community_id : commu_id, 
	// email : email, 
	// depth1 : depth1, 
	// depth2 : depth2, 
	// content : content, 
	// recommand : 0, 
	// guilty : 0,
	// photo : ''
	
	?>