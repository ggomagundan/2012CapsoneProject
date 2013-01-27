$(function($){
	
	$('#rankNavi li').hide();
	$('#rankNavi li #r1').parent().parent().show();
	 setInterval(function(){changeRank()}, 5000);
	
});
var currentRank = 0; 
function changeRank(){
	
	
	if((currentRank/2) % 10 == 0){
		$('#r10').parent().parent().hide();
		$('#r1').parent().parent().show();
	}else if((currentRank/2) % 10 == 1){
		$('#r1').parent().parent().hide();
		$('#r2').parent().parent().show();
	}else if((currentRank/2) % 10 == 2){
		$('#r2').parent().parent().hide();
		$('#r3').parent().parent().show();
	}else if((currentRank/2) % 10 == 3){
		$('#r3').parent().parent().hide();
		$('#r4').parent().parent().show();
	}else if((currentRank/2) % 10 == 4){
		$('#r4').parent().parent().hide();
		$('#r5').parent().parent().show();
	}else if((currentRank/2) % 10 == 5){
		$('#r5').parent().parent().hide();
		$('#r6').parent().parent().show();
	}else if((currentRank/2) % 10 == 6){
		$('#r6').parent().parent().hide();
		$('#r7').parent().parent().show();
	}else if((currentRank/2) % 10 == 7){
		$('#r7').parent().parent().hide();
		$('#r8').parent().parent().show();
	}else if((currentRank/2) % 10 == 8){
		$('#r8').parent().parent().hide();
		$('#r9').parent().parent().show();
		
	}else if((currentRank/2) % 10 == 9){
		$('#r9').parent().parent().hide();
		$('#r10').parent().parent().show();
	}
	currentRank++;
	
}
