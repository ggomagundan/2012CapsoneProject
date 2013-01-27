var openTab = false;
var openCategory = true;
var tabContentHeight = "200px";
$(function(){
	$('#perLogin').click(function(){
		$('#persistBox').click();
	});
	$('#tab').find('li').click(function(){
		$("#tab>ul>li").removeClass('selected');
		$(this).addClass('selected');
		var selectId = $(this).attr('id');
		changeTabMenu(selectId);
	});
	$('#tabCloseBtn').click(function(){
		$('#tabCloseBtn').hide();
		$("#tab>ul>li").removeClass('selected');
		$('.tabContent').animate({"height":"0"},1000,function(){
			$('.tabContent').hide();
		});
		openTab = false;
	});
	$('.categoryContent').click(function(){
		var temp = $(this).attr('class');
		_time = 0;
		_currentCategory = temp.substring(24);
		showCategory();
	});
	$('#categoryRightBtn').click(function(){	
		_time = 0;
		_currentCategory = _currentCategory*1;
		if ( _currentCategory == _categoryCount ){
			_currentCategory = 0;
		}
		_currentCategory = _currentCategory + 1;
		showCategory();
		$('.rightSelect').hide();
		$('.select').hide();
	});
	$('#categoryLeftBtn').click(function(){
		_time = 0;
		_currentCategory = _currentCategory*1;
		if ( _currentCategory == 1 ){
			_currentCategory = _categoryCount + 1;
		}
		_currentCategory = _currentCategory - 1;
		showCategory();
		$('.rightSelect').hide();
		$('.select').hide();
	});
	$('#category1').show();
	$('.category1').css("color","gray");
});
function showCategory(){
	var target = "category" + _currentCategory;
	$(".cate").hide();
	$("#"+target).show();
	$(".categoryContent").css("color","Black");
	$("."+target).css("color","gray");
}
function changeTabMenu(id){
	var target = "#"+id+"Tab";
	$('.tabContent').hide();
	if ( openTab == false ){
		$('.tabContent').height('0');
		$(target).show().animate({"height": tabContentHeight}, 1000, function(){
			$('#tabCloseBtn').show();
		});
		openTab = true;
	}else{
		$('.tabContent').height(tabContentHeight);
		$('#tabCloseBtn').hide('fast',function(){
			$(target).fadeIn('fast',function(){
				$('#tabCloseBtn').show();
			});
		});
	}
}
function openCreate(){
	myWindow = window.open('../community/create.php','','width=480, height=600');
	myWindow.focus();
}
function openWin(){
	myWindow = window.open('../join/join.php','','width=480, height=600');
	myWindow.focus();
}
