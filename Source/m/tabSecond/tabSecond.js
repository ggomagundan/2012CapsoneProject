$(function($){
	var tab = $('#tab_second');
	tab.find('li>a').click(function(){
		$('#tab_second>ul>li').removeClass('selected');
		$('#tab_second>ul>li>div').hide();
		$(this).parent().addClass('selected');
		$(this).parent().find('div').show();
		
		
	});
	$("#tab_second li>a:first").click();
	$('#tab_second>ul>li>div').css('height',$('#tab_second>ul>li>div>ul>li').css('width'));
	$('#tab_second').css('height',$('#tab_second>ul>li>div').css('height')+25+'px');
});
