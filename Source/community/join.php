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
	<script>
		function joinCheck(){
			if($('#agree').is(":checked")){
				//alert("약관에 동의해도 가입시켜주지 않습니다");
				$("#joinform").submit();
			}else{
				alert("약관에 동의하지 않으면 가입되지 않습니다.");
			}
		}
	</script>
</head>
<body>
<?php
	isLogin();
	if ( isset($_GET['msg']) ){
		$msg = $_GET['msg'];
		if ( $msg == 'duplicate' ){
			?>
			<script>
				alert('이미 가입하셨습니다');
				location.replace("list.php");
			</script>
			<?
		}else if( $msg == 'complete'){
			?>
			<script>
				alert('가입을 축하드립니다');
				location.replace("list.php");
			</script>
			<?
		}
	}	
	require_once("../header/header.php");
	if(isset($_POST['community'])){
		$_SESSION['community'] = $_POST['community'];
	}else if(isset($_GET['community'])){
		$_SESSION['community'] = $_GET['community'];
	}
	
	if ( isset($_POST['community_id']) ) {
		$community_id = escape_str($_POST['community_id']);
	}else if( isset($_SESSION['community']) ){
		$community_id = escape_str($_SESSION['community']);
	}
	$query = "select * from CommunityToUser where email='".$_SESSION['user']."' and community_id=".$community_id;
	$result = mysql_query($query);
	$rownum = mysql_num_rows($result);
	if ($rownum >0) {
		$_SESSION['community']= $community_id;
		header("Location: community.php");
	}
	
	$query = "select community_Name, community_Desc, community_policy, doorPicture, create_id from Community where community_id=".$community_id;
	$result = mysql_query($query); // 쿼리 진행 
	//$rownum = mysql_num_rows($result);
	$row = mysql_fetch_row($result);
?>

<div id="wrapCommunity">

	<div id="communityJoin">
		<table class="joinTable">
			<tr>
				<td class="Picture" colspan="2">
					<img class="doorPicture" src="<?=$row[3]?>" alt="DoorPicture"/>
				</td>
			</tr>
			<tr>
				<td class="label">
					Name
				</td>
				<td class="article">
					<?=$row[0]?>
				</td>
			</tr>
			<tr>
				<td class="label">
					설립자
				</td>
				<td class="article">
					<?=$row[4]?>
				</td>
			</tr>
		</table>
		<table class="joinTable">
			<tr>
				<td class="label">
					Description
				</td>
			</tr>
			<tr>
				<td class="article">
					<?=$row[1]?>
				</td>
			</tr>
			<tr>
				<td class="label">
					Policy
				</td>
			</tr>
			<tr>
				<td>
					<textarea wrap="hard" readonly="true"><?=$row[2]?></textarea>
				</td>
			</tr>
		</table>
		<div class="agree">
			<form enctype="multipart/form-data" action="jointest.php" method="post" id="joinform">
				<input type="hidden" name="community_id" id="community_id" value="<?=$community_id?>"/>
				<input type="hidden" name="user_id" id="user_id" value="<?=$_SESSION['user']?>"/> 
				<input type="checkbox" name="agree" id="agree"/> 위 약관에 동의합니다.
			</form>
			<button onclick="javascript:joinCheck()">가입신청</button>
		</div>
	</div>
	<aside id="communitySide">
		<h3>Community Poll</h3>
		<table>
			<tr>
				<td class="list"><div>list1</div></td>
			</tr>
			<tr>
				<td class="list"><div>long long long long long ...</div></td>
			</tr>
			<tr>
				<td class="list"><div>Test</div></td>
			</tr>
		</table>
		<a href="#"><h4>more</h4></a>
		<div class="vdiver">..............................................</div>
		<h3>Change My Post</h3>
		<table>
			<tr>
				<td class="list"><div>modify1</div></td>
			</tr>
			<tr>
				<td class="list"><div>modify2</div></td>
			</tr>
			<tr>
				<td class="list"><div>modify3</div></td>
			</tr>
			<tr>
				<td class="list"><div>modify4</div></td>
			</tr>
			<tr>
				<td class="list"><div>modify5</div></td>
			</tr>
		</table>
		<a href="#"><h4>more</h4></a>
		<div class="vdiver">..............................................</div>
		무엇을 더 넣을까?
	</aside>
</div>
<footer id="footer"><img src="../images/footer.png"/>
	</footer>
</body>
</html>
