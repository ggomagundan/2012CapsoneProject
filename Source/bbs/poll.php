<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script>
	var poll = function(){};
	var pollList = [];
	var pollCount = 0;
	var deletePosition = 0;
	var insertPosition = 0;
	var updatePosition = 0;
	poll.prototype.pollType = "objective";
	poll.prototype.makePoll = function(e){
		var newDiv = document.createElement("div");
		var str;
		newDiv.setAttribute("id","quiz"+insertPosition);
		newDiv.setAttribute("class","quiz");
		str =  '<select class="pollType" onchange="onChangePollType(this.value,this.parentNode)">';
		str +=	 	'<option value="objective">按包侥</option>';
		str += 		'<option value="subjective">林包侥</option>';
		str += '</select><br>';
		str += '<span>'+(pollCount+1)+'.</span> <textarea type="text" class="title" rows="4" cols="120">按包侥</textarea><br>';
		str += '<input class="picture" type="file" onchange="imagesSelected(this.files)"/><br>';
		str += '<div id="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event)">Drop Image</div>';
		str += '<button onclick="makeBtnClick(this.parentNode)">plus</button>';
		str += '<button onclick="deleteBtnClick(this.parentNode)">minus</button>';
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
			alert("弥家茄 窍唱狼 巩亲篮 乐绢具 钦聪促!");
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
				str =  '<select class="pollType" onchange="onChangePollType(this.value,this.parentNode)">';
				str +=	 	'<option value="objective">按包侥</option>';
				str += 		'<option value="subjective" selected="selected" >林包侥</option>';
				str += '</select><br>';
				str += '<span>'+(pollCount+1)+'.</span> <textarea type="text" class="title" rows="4" cols="120">林包侥</textarea><br>';
				str += '<input class="picture" type="file" onchange="imagesSelected(this.files)"/><br>';
				str += '<div id="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event)">Drop Image</div>';
				str += '<button onclick="makeBtnClick(this.parentNode)">plus</button>';
				str += '<button onclick="deleteBtnClick(this.parentNode)">minus</button>';
				$(select).html(str);
			});
		}else if ( type == "objective" ){
			$(function(){
				var str;
				str =  '<select class="pollType" onchange="onChangePollType(this.value,this.parentNode)">';
				str +=	 	'<option value="objective" selected="selected">按包侥</option>';
				str += 		'<option value="subjective">林包侥</option>';
				str += '</select><br>';
				str += '<span>'+(pollCount+1)+'.</span> <textarea type="text" class="title" rows="4" cols="120">按包侥</textarea><br>';
				str += '<input class="picture" type="file" onchange="imagesSelected(this.files)"/><br>';
				str += '<div id="imgbox" ondragenter="return false" ondragover="return false" ondrop="dropIt(event)">Drop Image</div>';
				str += '<button onclick="makeBtnClick(this.parentNode)">plus</button>';
				str += '<button onclick="deleteBtnClick(this.parentNode)">minus</button>';
				$(select).html(str);
			});
		}
		reNumber();
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
			});
		}
	}
	/* 
	 * Drop event > after all implement, this sector is plug in
	 */
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
	/*
	 * End 
	 */
</script>
</head>
<body onload="makeBtnClick()">	
	<article id="surveyPaper">
	</article>
</body>
</html>