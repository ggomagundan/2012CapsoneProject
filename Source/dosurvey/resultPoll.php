<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
	$poll_id = $_SESSION['poll_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ruara Survey</title>
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link rel="stylesheet" href="resultPoll.css" type="text/css" media="screen" />
	<script>
	function moreOpinion(num){
		mywindow = window.open('moreOpinion.php?problem='+num,'','width=480, height=600');
	}
	</script>
</head>
<body>
<?php
	$query = "select count(*) c from PollingReport where user='".$current_user."' and poll_id ='".$poll_id."'";
	$result = mysql_query($query);
	while ( $row = mysql_fetch_array($result) ){
		$num = $row['c'];
	}	
	if ( $num == 0 ) {
		?>
		<script>
		alert("설문을 해야지 결과를 볼 수 있습니다.");
		javascript :history.back();
		</script>
		<?php
	}
?>
<?php require_once '../header/header.php';?>
	<div id="wrap">
		<div id = "content">
		<?php
			$query = "select join_num from Polls where poll_id = '".$poll_id."'";
			$result = mysql_query($query);
			while ( $row = mysql_fetch_array($result) ){
				//설문 참여자 수
				$join_num = $row['join_num'];
			}

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
							$query2 = "select selected from PollingReport where poll_id= '".$poll_id."' and problem_id='".$problem."'";
							$result2 = mysql_query($query2);
							$select = 1;
							while($row2 = mysql_fetch_array($result2)){
								$opinion = $row2['selected'];
								?>
								<div class = "opinion">의견 <?php echo $select; ?> : <?php echo $opinion;?></div>
								<?php
								if ( $select == 3 ) break; 
								$select++;
							}
							?>
							<input type="button" onclick="javascript:moreOpinion(<?php echo $problem;?>)" value="의견더보기" class="moreOpinion"/>
							<?php
						}else{
							$query2 = "select * from QuestionSelect where poll_id='".$poll_id."' and problem_id='".$problem."'";
							$result2 = mysql_query($query2);
							$select = 1;
							while($row2 = mysql_fetch_array($result2)){
								$question = $row2['contents'];								
								$query3 = "select count(*) c from PollingReport where poll_id='".$poll_id."' and problem_id='".$problem."' and selected ='".$select."'";
								$result3 = mysql_query($query3);
								while($row3 = mysql_fetch_array($result3)){
									$select_people = $row3['c'];
								}
								$final = '('.$select_people.'/'.$join_num.')';
					?>
								<span class="object"><?php echo $select.'. '.$question;?> <?php echo $final;?></span>
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
		</div>
		<aside id = "side_nav">
			<ul>
				<li><a href = "pollList.php?cate=culture">문화분야...</a></li>
				<li><a href = "pollList.php?cate=life">생활분야...</a></li>
				<li><a href = "pollList.php?cate=society">사회분야...</a></li>
				<li><a href = "pollList.php?cate=study">학술분야...</a></li>
				<li><a href = "pollList.php?cate=sports">스포츠분야...</a></li>
				<li><a href = "pollList.php?cate=hotissue">Hot Issue...</a></li>
			</ul>
		</aside>
		
	</div>
	<footer id="footer">
		<img src="../images/footer.png"/>
	</footer>
	
</body>
</title>