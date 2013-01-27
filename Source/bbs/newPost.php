<?php
	require_once('../bbs/db/db_connect.php');
	require_once('../config/session.php');
	$sql = 'select distinct * from UserWriteToCommunity a RIGHT JOIN (select depth1 from UserWriteToCommunity where email="'.$current_user.'" and depth2=0)depth on a.depth1=depth.depth1 where depth2!=0 order by writeTime desc limit 6';
	
	
	$result = mysql_query($sql);
	$json = array();
	while($row = mysql_fetch_array($result)){
		
		$row_arr['community_id'] = $row['community_id'];  
		$row_arr['content'] = $row['content'];
		$row_arr['depth1'] = $row['depth1'];
		$row_arr['depth2'] = $row['depth2'];
		array_push($json,$row_arr);
		$lastDepth1 = $row['depth1'];
		$lastDepth2 = $row['depth2'];
	}
	
	$return = array();
	$re['last1'] = $lastDepth1;
	$re['last2'] = $lastDepth2;
	$re['data'] = $json;
	
  	echo (json_encode($re));
	
	
	
	// select * from (select * from test order by id desc limit 10) t order by id;
	
?>


