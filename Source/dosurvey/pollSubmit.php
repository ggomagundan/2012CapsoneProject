<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';

	$poll_id = $_SESSION['poll_id'];
	$poll_number = $_SESSION['problem_number'];
	$current_user = $_SESSION['user'];
	$poll_number--;
	
	// error check
	$answer = array();
	
	$query = "select join_num, max_num from Polls where poll_id='".$poll_id."'";
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result)){
		$join = $row['join_num'];
		$max = $row['max_num'];
	} 


	if ( $join == $max ){
		?>
		<script>javascript :history.back();</script>
		<?php
	}
	
	for ( $i = 1 ; isset($_POST['answer'.$i]) ; $i++ ){
		$answer[$i-1] = $_POST['answer'.$i];
		
		$sub = $_POST['answer'.$i];
		if (strlen($sub)==0){
			?>
			<script>javascript :history.back();</script>
			<?php
		}
	}
			
	$i--;
	$input_number = $i;
	
	if ( $poll_number != $input_number ) {
		?>
			<script>javascript :history.back();</script>
		<?php
	}else{
		for ( $i = 0 ; $i < $poll_number ; $i++ ){
			$problem_id = $i+1;
			$query = "insert into PollingReport values('".$poll_id."','".$problem_id."','".$answer[$i]."','".$current_user."')";
			mysql_query($query);
		}
		$query = "update Polls set join_num = join_num + 1 where poll_id='".$poll_id."'";
		mysql_query($query);
	}
	Header("Location: pollList.php?cate=culture"); 

?>