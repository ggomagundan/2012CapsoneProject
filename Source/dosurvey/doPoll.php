<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
	$poll_id = $_SESSION['poll_id'];
	$current_user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ruara Survey</title>
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link rel="stylesheet" href="doPoll.css" type="text/css" media="screen" />
	</head>
	<script>
	function submitform(){
		document.forms["pollSubmit"].submit();
	}
	</script>
<body>
<?php
	$query = "select count(*) c from PollingReport where user='".$current_user."' and poll_id ='".$poll_id."'";
	$result = mysql_query($query);
	while ( $row = mysql_fetch_array($result) ){
		$num = $row['c'];
	}	
	if ( $num > 0 ) {
		?>
		<script>
		alert("이미 이 설문을 하였습니다");
		javascript :history.back();
		</script>
		<?php
	}
?>
<?php require_once '../header/header.php';?> 
	<div id="content">
		<form id="pollSubmit" action="pollSubmit.php" method="post">
		<?php
			$query = "select * from Question where poll_id = '".$poll_id."'";
			$result = mysql_query($query);
			$problem = 1;
			
			while($row = mysql_fetch_array($result)){
				$path = $row['file_path'];
				$path = substr($path, 8);
				$path = '../' . $path;
				$title = $row['title'];
				$type = $row['type'];
				$problem_id = $row['problem_id'];
				$file_type =  substr(strrchr($path, "."), 1);
				
				?>
				<div class="problem">
					<span class="pno"><?php echo $problem;?>. </span>
					<div class="title"><?php echo $title; ?></div>
					<?php 
						if ( $file_type == "png" || $file_type == "gif" || $file_type == "jpeg" ||  $file_type == "pjpeg" ){
					?>
							<img src="<?php echo $path;?>" class="pollImg">
					<?php
						}else if ( $path != "../" ){
					?>
							<a href="<?php echo $path;?>" class="pollItem">파일 다운받기</a>
					<?php
						}
					
						if( $type == "subjective" ){
					?>
							<textarea class="subject" type="text" name="answer<?php echo $problem;?>"></textarea>  
					<?php
						}else{
							$query2 = "select * from QuestionSelect where poll_id='".$poll_id."' and problem_id='".$problem."'";
							$result2 = mysql_query($query2);
							$select = 1;
							while($row2 = mysql_fetch_array($result2)){
								$question = $row2['contents'];
					?>
								<input class="object" type="radio" name="answer<?php echo $problem;?>" value="<?php echo $select;?>"><span class="objectQ"><?php echo $select.'. '.$question;?></span>
								<br>
					<?php
								$select++;
							}
						}
					?>
				</div>
				<?php
				echo '<br>';
				$problem++;
			}
			$_SESSION['problem_number']=$problem;
		?>
			<input type="button" onclick="javascript:submitform()" value="완료" id="submitBtn"/>
		</form>
	</div>
	<footer id="footer">
		<img src="../images/footer.png"/>
	</footer>
</body>
</html>