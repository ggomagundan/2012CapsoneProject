<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';
	
	if ( isset($_GET['problem']) ) $problem = $_GET['problem'];
	$poll_id = $_SESSION['poll_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ruara Survey</title>
	<link rel="stylesheet" href="moreOpinion.css" type="text/css" media="screen" />
</head>
<body>
<?php 
	$query = "select * from Question where poll_id = '".$poll_id."' and problem_id='".$problem."'";
	$result = mysql_query($query);
	
	while($row = mysql_fetch_array($result)){
		$path = $row['file_path'];
		$path = substr($path, 8);
		$path = '../' . $path;
		$title = $row['title'];
		$type = $row['type'];
		$file_type =  substr(strrchr($path, "."), 1);
	}
?>
	<div id="question">
		<span id="pno"><?php echo $problem;?>. </span>
		<div id="title"><?php echo $title; ?></div>
	
	<?php
	if ( $file_type == "png" || $file_type == "gif" || $file_type == "jpeg" ||  $file_type == "pjpeg" ){
	?>
		<img src="<?php echo $path;?>" id="pollImg">
	<?php
	}
	?>
	</div>
<?php 
	$query = "select selected from PollingReport where poll_id= '".$poll_id."' and problem_id='".$problem."'";
	$result = mysql_query($query);
	$select = 1;
	while($row = mysql_fetch_array($result)){
		$opinion = $row['selected'];
		?>
		<div class = "opinion">의견 <?php echo $select; ?> : <?php echo $opinion;?></div>
		<?php
		$select++;
	} 
?>
</body>
</html>