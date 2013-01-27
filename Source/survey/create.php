<?php
	require_once '../config/session.php';
	require_once '../config/datacon.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Ruara Survey</title>
<script type="text/javascript" src="../javascript/jquery.js"></script>
<link rel="stylesheet" href="create.css" type="text/css" media="screen"/>
<script type="text/javascript">
$(function(){
	$('#constclick').click(function(){
		$('#constok').click();
	});
	$('#sid').keyup(function(){
		$.post('checksid.php', {query:$('#sid').val()}, function(data){
			$('#checkid').html(data);
		});
	});
	$('#pinput').change(function(){
		$('#imgbox').empty();
	});
});

function imagesSelected(myFiles) {
	var f = myFiles[0];
	var imageReader = new FileReader();
	imageReader.onload = (function(aFile) {
		return function(e) {
			var span = document.createElement('span');
			span.innerHTML = ['<img class="inputimg" src="', e.target.result,'" title="', aFile.name, '"/>'].join('');
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
	<?php require_once("../header/header.php");?>
	<?php 
	if( isset($_SESSION['sid']) ){
		$_SESSION['sid'] = 0;
	}
	?>
	<div id="swrap">
	<form action="createTest.php" method="post" enctype="multipart/form-data">
		<article id="constraint">
			다음의 사항을 준수해 주시기 확인해 주시기 바랍니다.<br><br>
			1. 업로드 파일 크기는 4Byte로 제한합니다.<br><br>
			2. Survey Id는 설문을 구분하는 것으로 설문과 연관은 없습니다.<br><br>
			3. 주관식 정답의 길이는 200자로 제한합니다.<br><br>
			4. 위를 지키지 않을 시 다시 작성할 경우도 생기니 주의해 주십시요.
		</article>
		<div id="constraintcheck">
			<input id="constok" type="checkbox" name="constraint" value="1" checked="unchecked">
			<a id="constclick">제약 사항을 확인합니다.</a>
		</div>
		<table id="leftsection">
			<tr>
				<td class="row"><div class="sbtitle">Survey ID</div></td>
				<td class="row">
					<input class="sinput" type="text" name="sid" id="sid"/>
					<span id="checkid"></span>
				</td>
			<tr>
				<td></td>
				<td class="inforow" colspan="2"><p>설문을 구분하는 것으로 설문과 연관은 없습니다.</p></td>
			</tr>
			</tr>
			<tr>
				<td class="row"><div class="sbtitle">Title</div></td>
				<td class="row">
					<input class="sinput" type="text" name="title" id="title"/>
				</td>
			</tr>
			<tr>
				<td class="row"><div class="sbtitle">Category</div></td>
				<td class="row">
					<span>
						<select class="sinput" name="bigcate" id="bigcate">
							<option value="culture">문화</option>
							<option value="life">생활</option>
							<option value="society">사회</option>
							<option value="study">학술</option>
							<option value="sports">스포츠</option>
							<option value="hotissue">Hot Issue</option>
						</select>
					</span>
				</td>
			</tr>
			<tr>
				<td class="row"><div class="sbtitle">Start Day</div></td>
				<td class="row"><input class="sinput" type="date" name="startday"/></td>
			</tr>
			<tr>
				<td class="row"><div class="sytitle">End Day</div></td>
				<td class="row"><input class="sinput" type="date" name="endday"/></td>
			</tr>
			<tr>
				<td></td>
				<td class="inforow" colspan="2">starty day, end day yyyy-mm-dd형식을 지켜주세요</td>
			</tr>
			<tr>
				<td class="row"><div class="sbtitle">목표 인원</div></td>
				<td class="row"><input class="sinput" type="text" name="maxPeople"/></td>
			</tr>
			<tr>
				<td class="row"><div class="sbtitle">그림</div></td>
				<td class="row"><input class="sinput" type="file" name="picture" id="pinput" onchange="imagesSelected(this.files)"/></td>
			</tr>
			<tr>
				<td class="row"></td>
				<td id="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event)">
				Select Image 310*100 size</td>
			</tr>
			<tr>
				<td class="row alignup"><div class="sytitle">정보</div></td>
				<td class="row"><textarea class="itext" cols="50" rows="10" name="surveyinfo"></textarea></td>
		</table>
		<div id="rightsection">
		<!--
			<table>
				<tr>
					<td class="row"><div class="sbtitle">나이</div></td>
					<td class="row">
						<input id="sageinput" type="text" name="sage">~<input id="eageinput" type="text" name="eage">
						<input type="checkbox" name="nolimitage" value="1" checked="checked"> 제한 없음
					</td>
				</tr>
				<tr>
					<td class="row"><div class="sbtitle">성별</div></td>
					<td class="row">
						<input type="radio" name="sex" value="nolimit" checked="checked">무제한
						<input type="radio" name="sex" value="m">남
						<input type="radio" name="sex" value="f">여
					</td>
				</tr>

			</table>
			<div id="infographic">
				infographic
			</div>
			-->
			<div id="message">
				<p>
				<?php 
				if ( isset($_GET['msg'])){
					echo $_GET['msg'];
				}
				?>
				</p>
			</div>
		</div>	
		<input id="submit" type="submit" value="확인">
	</form> 
	</div>

	<footer id="footer">
		<img src="../images/footer.png"/>
	</footer>
</body>
</html>