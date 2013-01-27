$(function($){
	var tab = $('#tab_second');
	tab.find('li>a').click(function(){
		$('.tab>ul>li').removeClass('selected');
		$('.tab>ul>li>div').hide();
		$(this).parent().addClass('selected');
		$(this).parent().find('div').show();
		
		
	});
	$(".tab li>a:first").click();
});
