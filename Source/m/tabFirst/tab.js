$(function($){
	var tab = $('#tab_first');
	tab.find('li>a').click(function(){
		$('#tab_first>ul>li').removeClass('selected');
		$('#tab_first>ul>li>div').hide();
		$(this).parent().addClass('selected');
		$(this).parent().find('div').show();
		
		
	});
	$("#tab_first li>a:first").click();
});
