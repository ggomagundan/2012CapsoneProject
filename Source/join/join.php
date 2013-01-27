<!DOCTYPE HTML>
<html>
<head>
	<title>회원 가입</title>
	<link href="join.css" rel="stylesheet" type="text/css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<script type = "text/javascript" src='../javascript/jquery.js'></script>
	<script type="text/javascript">
		$(function(){
			$("#userid").keyup(function(){
				$.post('checkemail.php',{query:$('#userid').val()}, 
					function(data){
						$('#checkid').html(data).show();
					}
				);
			});
			$("#repwd").keyup(function(){
				$.post('checkpwd.php',{num1:$('#pwd').val(),num2:$('#repwd').val()},
					function(data){
						$('#checkpwd').html(data).show();
					}
				);
			});
			$("#pwd").keyup(function(){
				$.post('checkpwd.php',{num1:$('#pwd').val(),num2:$('#repwd').val()},
					function(data){
						$('#checkpwd').html(data).show();
					}
				);
			});
			$('#profile').change(function(){
				$('#imgbox').empty();
			});
		});
		function testForm(userid,pwd,repwd,first,last,tel,sex,age){		
			var flag = true;
			var regEmail = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
			var regName = /^[A-Za-z가-힣]{1,15}$/;
			var regTel = /^01([0|1|6|7|8|9])-\d{3,4}-\d{4}$/;
			if (regEmail.test(userid) == false){
				alert("Check Your Email(Irregular Expression)");
				flag = false;
			}else if ( pwd != repwd ){
				alert("Check Your Password");
				flag = false;
			}else if ( regName.test(first) == false || regName.text(last) == false ){
				alert("Check Your Name!(English or Korean)");
				flag = false;
			}else if ( regTel.test(tel) == false ){
				alert("Check Your Phone Number!");
				flag = false;
			}else if ( age < 10 || age > 110 ){
				alert("Check Your Age!");
				flag = false;
			}
			
			if ( flag == true ) {
				document.formtag.submit();
			}else{
				document.getElementById('pwd').reset();
				document.getElementById('repwd').reset();
			}
		}
		function imagesSelected(myFiles) {
			var f = myFiles[0];
			var imageReader = new FileReader();
			imageReader.onload = (function(aFile) {
				return function(e) {
					var span = document.createElement('span');
					span.innerHTML = ['<img id="inputimg" src="', e.target.result,'" title="', aFile.name, '"/>'].join('');
					document.getElementById('imgbox').insertBefore(span, null);
				};
			})(f);
			imageReader.readAsDataURL(f);
		}

		function dropIt(e){ 
			$('#imgbox').empty();
			imagesSelected(e.dataTransfer.files); 
			e.stopPropagation();  
			e.preventDefault();   
		} 
	</script>
</head>
<body>
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
	<form enctype="multipart/form-data" action="jointest.php" method="post" id="formtag">
		<fieldset>
			<legend>로그인 정보</legend>
			<ol>
				<li>
					<label for="userid">E-mail</label> 
					<input id="userid" name="userid" type="text" placeholder="ex) ruara@ruara.com" autocomplete="off">
				</li>
				<div class="checkbox" id="checkid"></div>
				<li>
					<label for="pwd">비밀번호</label>
					<input id="pwd" name="pwd" type="password" placeholder="20자미만">
				</li>
				<li>
					<label for="repwd">비밀번호 확인</label>
					<input id="repwd" name="repwd" type="password">
				</li>
				<div class="checkbox" id="checkpwd"></div>
			</ol>
		</fieldset>
		<fieldset>
			<legend>개인 정보</legend>
			<ol>
				<li>
					<label for="firstname">First Name</label>
					<input id="firstname" name="firstname" type="text" placeholder="15자미만 / English or Korean">
				</li>
				<li>
					<label for="lastname">Last Name</label>
					<input id="lastname" name="lastname" type="text" placeholder="15자미만 / English or Korean">
				</li>
				<li>
					<label for="tel">핸드폰 번호</label>
					<input id="tel" name="tel" type="tel" autocomplete="off" placeholder="ex) 010-1234-1234">
				</li>
				<li>
					<label for="sex">성별</label>
					<input id="sex" name="sex" type="radio" value="m" checked="1"/>남성
					<input id="sex" name="sex" type="radio" value="f"/>여성
				</li>
				<li>
					<label for="age">나이</label>
					<input id="age" name="age" type="age" autocomplete="off" placeholder="10~110">
				</li>
			</ol>
		</fieldset>
		<fieldset>
			<legend>기타 정보</legend>
			<ol>
				<li id="lastli">
					<label for="profile">Profile Photo</label>
					<input id="profile" name="profile" type="file" onchange="imagesSelected(this.files)"></input>
					<div id="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event)">
						Serch Image
					</div>
				</li>
			</ol>
		</fieldset>
		<fieldset>
			<button onclick="testForm(document.getElementById('userid').value,
							document.getElementById('pwd').value,document.getElementById('repwd').value,
							document.getElementById('firstname').value,document.getElementById('lastname').value,
							document.getElementById('tel').value,document.getElementById('sex').value,
							document.getElementById('age').value)"
							id="onload">확인</button>
		</fieldset>
	</form>
	
</body>
</html>