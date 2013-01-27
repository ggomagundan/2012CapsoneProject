var _siteRoot='index.html'; // slide system var
var _root='index.html';		// slide system var

var _time=0;
var _categoryChangeTime=5;
var _currentCategory=1;
var _categoryCount=6;

function timedCount(){
	_time = _time + 1;
	t = setTimeout("timedCount()",1000);  // no change 1000
	if ( _time%_categoryChangeTime == 0 ){
		if ( _currentCategory == _categoryCount ){
			_currentCategory = 0;
		}
		_currentCategory = _currentCategory * 1;
		_currentCategory = _currentCategory + 1;
		showCategory();
		$('.rightSelect').hide();
		$('.select').hide();
	}
}

var imgDirect;  // img LR selector
$(function(){
	$('.contentImg').hover(function(){
		var imgsrc = $(this).find('img').attr('src');
		var selectTitle = $(this).find('h1').html();
		$('.selectImg').html('<img src='+imgsrc+'>');
		$('.selectInfo').html('<h1>'+selectTitle+'</h1>');
		$('.selectInfo').append('information');
	});
	$('.imgLeft').hover(function(e){
		imgDirect = $(this).attr('class');
		imgDirect = imgDirect.substring(0,8);
		detailShow(e);
	});
	$('.imgRight').hover(function(e){
		imgDirect = $(this).attr('class');
		imgDirect = imgDirect.substring(0,8);
		detailShow(e);
	});
	$('.select').hover(function(){	
	},function(){
		$('.select').hide();
	});	
	$('.rightSelect').hover(function(){	
	},function(){
		$('.rightSelect').hide();
	});			
});
function detailShow(e){
	var xpos = e.target.offsetLeft;
	var ypos = e.target.offsetTop;
	
	//alert(ypos);
	if (imgDirect == 'imgRight'){
		xpos = xpos - 420;
		if ( ypos < 270 ){ // Why don't act not symbol, '!'.
		}else if( ypos == 347 || ypos == 487 || ypos == 627 || ypos == 767 ){  
			ypos = ypos - 85;
		 	$('.rightSelect').css('left',xpos).css('top',ypos).show();	
		}else{
			ypos = ypos - 10;
			$('.rightSelect').css('left',xpos).css('top',ypos).show();	
		}
	}else{
		xpos = xpos - 10;
		if ( ypos < 270 ){ // Why don't act not symbol, '!'.
		}else if( ypos == 347 || ypos == 487 || ypos == 627 || ypos == 767 ){  
			ypos = ypos - 85;
			$('.select').css('left',xpos).css('top',ypos).show();	
		}else{
			ypos = ypos - 10;
			$('.select').css('left',xpos).css('top',ypos).show();	
		}
	}
}