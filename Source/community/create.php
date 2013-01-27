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
	<link href="create.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		$(function(){
			$('#profile').change(function(){
				$('#imgbox').empty();
			});
		});
		function testForm(){		
			document.formtag.submit();
		}
		function imagesSelected(myFiles, number) {
			var f = myFiles[0];
			var imageReader = new FileReader();
			imageReader.onload = (function(aFile) {
				return function(e) {
					var span = document.createElement('span');
					span.innerHTML = ['<img class="inputimg" src="', e.target.result,'" title="', aFile.name, '"/>'].join('');
					document.getElementById('imgbox'+number).insertBefore(span, null);
				};
			})(f);
			imageReader.readAsDataURL(f);
		}

		function dropIt(e, number){ 
			$('#imgbox'+number).empty();
			imagesSelected(e.dataTransfer.files); 
			e.stopPropagation();  
			e.preventDefault();   
		} 
	</script>
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
	<div id="communityCreate">
		<?php
			if ( isset($_GET['msg']) ){
				$msg = $_GET['msg'];
				if ( $msg == 'sizeover' ){
					$msg = '사진 용량 초과 입니다.';
				}else if($msg == 'checktype'){
					$msg = '지원하지 않는 파일입니다.';
				}
				echo ("<div id='msg'>{$msg}</div>");
			}
		?>
		<form enctype="multipart/form-data" action="insertCreate.php" method="post" id="createForm">
			<fieldset>
				<legend>커뮤니티 기본 정보</legend>
				<ol>
					<li>
						<label for="name">커뮤니티 이름</label> 
						<input id="name" name="name" type="text" placeholder="커뮤니티를 대표할 이름" autocomplete="off">
					</li>
					<div class="checkbox" id="checkid"></div>
					<li>
						<label for="description">커뮤니티 설명</label>
						<input id="description" name="description" type="text" placeholder="간략하게 표시될 커뮤니티 설명">
					</li>
				</ol>
			</fieldset>
			<fieldset>
				<legend>커뮤니티 세부 정보</legend>
				<ol>
					<li>
						<label for="policy">커뮤니티 규약</label>
						<textarea id="policy" name="policy" wrap="hard"></textarea>
					</li>
					<li id="lastli">
						<label for="door">대문 이미지</label>
						<input id="door" name="door" type="file" onchange="imagesSelected(this.files,1)"></input>
						<div id="imgbox1" class="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event, 1)">
							
						</div>
					</li>
					
					<li id="lastli">
						<label for="banner">배너 이미지</label>
						<input id="banner" name="banner" type="file" onchange="imagesSelected(this.files,2)"></input>
						<div id="imgbox2" class="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event, 2)">
		
						</div>
					</li>
					
				</ol>
			</fieldset>
			<fieldset>
				<input id="userId" name="userId" type="hidden" value="<?=$_SESSION['user']?>"/>
				<button onclick="testForm(document.getElementById('name').value,
								document.getElementById('description').value,document.getElementById('policy').value,
								document.getElementById('userId').value)"
								id="onload">확인</button>
			</fieldset>
		</form>
	</div>
</div>
<footer id="footer"><img src="../images/footer.png"/>
	</footer>
</body>
</html>
