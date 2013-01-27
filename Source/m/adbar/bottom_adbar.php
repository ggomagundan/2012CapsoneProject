<link rel="stylesheet" href="./adbar/bottom_adbar.css" type="text/css" media="screen" />
<hr />
<a href="">
<div id="bottom_adbar">
	
		<img id="b_adbar" src="" alt="adbar">
	
	
	
</div>	
</a>
<script type="text/javascript">
$(function($){
	
		var rannumber=Math.floor(Math.random()*4)+5;
		 
		 var img_src = "./images/adbar"+rannumber+".png";
		$('#b_adbar').attr('src',img_src);
		if(rannumber == 1){
			$('#bottom_adbar').css('background-color','#96e6ed');	
		}else if(rannumber ==2){
			$('#bottom_adbar').css('background-color','#2880e3');
		}else if(rannumber == 3){
			$('#bottom_adbar').css('background-color','#9880e3');
		}else if(rannumber ==4){
			$('#bottom_adbar').css('background-color','#3f3d9d');
		}else if(rannumber ==5){
			$('#bottom_adbar').css('background-color','#1f1d8b');
		}else if(rannumber ==6){
			$('#bottom_adbar').css('background-color','#00d0ca');
		}else if(rannumber ==7){
			$('#bottom_adbar').css('background-color','#a9a2d0');
		}else if(rannumber ==8){
			$('#bottom_adbar').css('background-color','#6797db');
		}
	
});
	
			
	</script>
