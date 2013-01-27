<?php
	require_once "../config/session.php";
	require_once "../config/datacon.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title> main </title>
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link rel="stylesheet" href="community.css" type="text/css" media="screen" />
	
</head>
<body>
<?php	
	isLogin();
	require_once("../header/header.php");
	if(isset($_POST['community'])){
		$_SESSION['community'] = $_POST['community'];
	}
?>

<div id="wrapCommunity">
	<div class="communityTitle">
		<img class="communityTitle" src="../images/nature-photo.png" alt="communityHead"/>
	</div>
	<div id="communityMain">
	<?php
	//	echo 'community Id = '.$_SESSION['community'];
		if(isset($_GET['admin'])){
			include_once('../bbs/admin.php');
		}else if(isset($_GET['no'])){
			include_once('../bbs/showArticle.php');
		}else{
			include_once('../bbs/test.php');
		}
		
		require_once('../bbs/showNew.php');
	?>
	</div>
	<aside id="communitySide">
		
		
		<h3>Change My Post</h3>
		<div id="changePost"></div>
		
	</aside>
</div>
<footer id="footer"><img src="../images/footer.png"/>
</footer>
</body>
</html>
