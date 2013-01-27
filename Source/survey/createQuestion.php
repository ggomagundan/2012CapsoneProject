<?php
	require_once '../config/session.php';
	require_once("../config/datacon.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>create</title>
<script type="text/javascript" src="../javascript/jquery.js"></script>
<link rel="stylesheet" href="createQuestion.css" type="text/css" media="screen"/>
<script>
	var poll = function(){};
	var pollList = [];
	var pollCount = 0;
	var deletePosition = 0;
	var insertPosition = 0;
	var updatePosition = 0;
	poll.prototype.pollType = "objective";
	poll.prototype.number = 1;
	poll.prototype.makePoll = function(e){
		var newDiv = document.createElement("div");
		var str;
		newDiv.setAttribute("id","quiz"+insertPosition);
		newDiv.setAttribute("class","quiz");
		str =  '<p class="qtype">Type </p><select name="type'+(pollCount+1)+'" class="pollType" onchange="onChangePollType(this.value,this.parentNode)">';
		str +=	 	'<option value="subjective">주관식</option>';
		str += 		'<option value="objective">객관식</option>';
		str += '</select><br>';
		str += '<span>'+(pollCount+1)+'.</span> <textarea type="text" name="title'+(pollCount+1)+'" class="title"></textarea><br>';
		str += '<input class="picture" type="file" name="img'+(pollCount+1)+'" onchange="imagesSelected(this.files)"/><br>';
		str += '<input type="button" class="editbtn" value="문항추가" onclick="makeBtnClick(this.parentNode)">';
		str += '<input type="button" class="editbtn" value="문항삭제" onclick="deleteBtnClick(this.parentNode)">';
		newDiv.innerHTML = str;
		if ( pollCount == 0 ){
			document.getElementById('surveyPaper').appendChild(newDiv);	// append insertPosition
		}else{
			$(function(){
				var select = '#quiz'+(insertPosition-1);
				$(select).after(newDiv);
			});
		}
		reNumber();			

		pollCount++;
	}
	function makeBtnClick(target){
		if ( pollCount != 0 ){
			insertPosition = selectCurrentPoll(target);
		}
		if ( pollCount == 0 ){
			pollList[pollCount] = new poll();
			pollList[pollCount].makePoll(target);
		}else if ( pollCount == insertPosition ){
			pollList[pollCount] = new poll();
			pollList[pollCount].makePoll(target);
		}else{
			var temp = target.parentNode.childNodes;
			for ( var i = pollCount ; i > insertPosition ; i-- ){
				pollList[i] = pollList[i-1];
				temp.item(i).setAttribute("id","quiz"+i);
			}
			pollList[insertPosition] = new poll();
			pollList[insertPosition].makePoll(target);
		}
	}
	function deleteBtnClick(target){
		deletePosition = selectCurrentPoll(target);
		if ( pollCount == 1 ){
			alert("최소한 하나의 문항은 있어야 합니다!");
		}else if( pollCount == deletePosition ){
			pollList[pollCount] = "";
			$(function(){
				var select = '#quiz' + (deletePosition-1);
				$(select).remove();
			});
			pollCount--;
		}else{
			var temp = target.parentNode.childNodes;
			$(function(){
				var select = '#quiz' + (deletePosition-1);
				$(select).remove();
			});
			for ( var i = deletePosition ; i < pollCount ; i++ ){
				temp.item(i).setAttribute("id","quiz"+(i-1));
				pollList[i-1] = pollList[i];
			}
			pollList[i-1] = "";
			reNumber();		 
			pollCount--;
		}
	}
	function onChangePollType(type,target){
		updatePosition = selectCurrentPoll(target);
		pollList[updatePosition-1].pollType = type;
		var select = '#quiz' + (updatePosition-1);
		if ( type == "subjective" ){
			$(function(){
				var str;
				str =  '<p class="qtype">Type </p><select name="type'+(pollCount+1)+'" class="pollType" onchange="onChangePollType(this.value,this.parentNode)">';
				str +=	 	'<option value="subjective" selected="selected">주관식</option>';
				str += 		'<option value="objective">객관식</option>';
				str += '</select><br>';
				str += '<span>'+(pollCount+1)+'.</span> <textarea type="text" class="title" name="title'+(pollCount+1)+'" rows="3" cols="120"></textarea><br>';
				str += '<input class="picture" type="file" name="img'+(pollCount+1)+'"  onchange="imagesSelected(this.files)"/><br>';
				str += '<input type="button" class="editbtn" value="문항추가" onclick="makeBtnClick(this.parentNode)">';
				str += '<input type="button" class="editbtn" value="문항삭제" onclick="deleteBtnClick(this.parentNode)">';
				pollList[updatePosition-1].number = 1;
				$(select).html(str);
			});
		}else if ( type == "objective" ){
			$(function(){
				var str = '<div class="objectSelect" id="objectSelect'+pollCount+'">';
					str += '<span id="number'+pollList[updatePosition-1].number+'">'+pollList[updatePosition-1].number + ') ';
					str += '<input class="sinput" type="text" name="'+pollCount+'number'+pollList[updatePosition-1].number+'">';
					str += '<br></span>';
					pollList[updatePosition-1].number++;
					str += '<span id="number'+pollList[updatePosition-1].number+'">'+pollList[updatePosition-1].number + ') ';
					str += '<input class="sinput" type="text" name="'+pollCount+'number'+pollList[updatePosition-1].number+'">';
					pollList[updatePosition-1].number++;
					str += '<br></span>';
					str += '<input class="sbtn" type="button" value="+" onclick="addSelect(this.parentNode,'+updatePosition+')">';	
					str += '<input class="sbtn" type="button" value="-" onclick="delSelect(this.parentNode,'+updatePosition+')">';	
					str += '</div>';
				$(select + '> .picture').after(str); 
			});
		}
		reNumber();
	}
	function addSelect(target,updatePosition){
		var str = '<span id="number'+pollList[updatePosition-1].number+'">'+pollList[updatePosition-1].number + ') ';
		str += '<input class="sinput" type="text" name="'+pollCount+'number'+pollList[updatePosition-1].number+'">';
		pollList[updatePosition-1].number++;
		str += '<br></span>';
		var select = '#' + target.id + '> #number'+(pollList[updatePosition-1].number-2);
		$(select).after(str);
	}
	function delSelect(target,updatePosition){
		temp = pollList[updatePosition-1].number;
		if ( temp == 3 ) alert('객관식은 최소 2개의 문항이 필요합니다');
		else{
			var select = '#' + target.id + '> #number'+(pollList[updatePosition-1].number-1);
			$(select).remove();
			pollList[updatePosition-1].number--;
		}
	}
	function selectCurrentPoll(target){
		var result = target.id.substring(4)*1+1;
		return result;  //return by pno
	}
	function reNumber(){
		for ( var i = 0 ; i <= pollCount ; i++ ){
			$(function(){
				var select = '#quiz' + i + '>span';
				$(select).html(i+1+'. '); 
				var select = '#quiz' + i + '>select';
				$(select).attr('name','type'+(i+1));
				var select = '#quiz' + i + '>textarea';
				$(select).attr('name','title'+(i+1));
				var select = '#quiz' + i + '> .picture';
				$(select).attr('name','img'+(i+1));
			});
		}
	}

</script>
</head>
<body onload="makeBtnClick()">
	<?php require_once("../header/header.php");?>
	<div id="swrap">
		<form action="registerPoll.php" method="post" enctype="multipart/form-data">
			<article id="surveyPaper">
				
			</article>
			<input id="submit" type="submit" value="제출">
		</form>
	</div>
	<footer id="footer">footer
	</footer>
</body>
</html>