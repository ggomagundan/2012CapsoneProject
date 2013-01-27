$(function($){
	var tab = $('#tab_first');
	tab.find('li>a').click(function(){
		$('#tab_first>ul>li').removeClass('selected');
		$('#tab_first>ul>li>div').hide();
		$(this).parent().addClass('selected');
		$(this).parent().find('div').show();
		
		
	});
	$("#tab_first li>a:first").click();
	$('#tab_first>ul>li>div').css('height',$('#tab_first>ul>li>div>ul>li').css('width'));
	// if(window.innerHeight > window.innerWidsth){
		// $('#tab_first').css('height',(parseInt($('#tab_first>ul>li>div').css('height'))+25)+'px');
	// }else{
		// $('#tab_first').css('height',(parseInt($('#tab_first>ul>li>div').css('height'))+25)+'px');
	// }
	$('#tab_first').css('height',(parseInt($('#tab_first>ul>li>div').css('height'))+25)+'px');
	$(window).bind('orientationchange', function(event) {
  		if(event.orientation=='portrait'){
  			alert('portrait');
  		}else{
  			alert('landscape');
  		}
	});

});

