		<script type="text/javascript">
			
			$(function(){
				var last1 = 0;
				var last2 = 0;	
				var count  = 0;
				
				function receive(){
				$.getJSON('../bbs/newPost.php',function(datas){
					// $('.message').append('<div>'+last_number+'</div>');
					
					
					//if(last1 != datas.data[(datas.data.length-1)].depth1 || last2 != datas.data[(datas.data.length-1)].depth2){
						$('#changePost').empty();
						for(var index=0;index < datas.data.length;index++){	
						
							
							//count++;
							last1 = datas.data[index].depth1;
							last2 = datas.data[index].depth2;
							
							if(datas.data[index].content.length > 15){
								content = (datas.data[index].content).substr(0,12) + '...';
							}else{
								content = (datas.data[index].content).substr(0,15);
							}
							$('#changePost').prepend('<a href = "../community/community.php?depth='+datas.data[index].depth1+'&no='+datas.data[index].community_id+'"><div>'+content+'</div></a>');
							
							// if(count > 7){
								// //alert($('.message div:last-child').text());
								// $('#changePost div:last-child').remove();
								// count--;
								// //deletePost();
// 								
							// }
						}
				//	}
						
				});			
		
				
				
			}
			
			function deletePost(){
				$('.changePost div:last-child').delete();	
			}
			receive();
			setInterval(receive, 5000);
		}); 
		</script>
		
	
