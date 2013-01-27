// <script src="http://code.jquery.com/jquery-1.7.2.js"></script>


	function removeElements(ele){
	  		
	  	///alert($(ele).parent().parent().find('.aricle_id').attr('class'));
	  	//alert($(ele).parent().parent().parent().find('.aricle_id').attr('class'));
	  	
	  	var isDelete = confirm("진심이십니까?");
	  		
		if(isDelete == true){
			$(ele).parent().parent().parent().remove();
			
			var commu_id = com_id;
		var depth1 = $(ele).parent().parent().attr('class').substring(9,$(ele).parent().parent().attr('class').length-5);
		
		var jsonstr = JSON.stringify({
					community_id : commu_id, 
					depth1 : depth1 
					});
		//alert(jsonstr);
		
		$.post("../bbs/removeArticle.php", { jsonstr:jsonstr });
		alert('글삭제가 완료되었습니다. ^^');
		}
		
		
	}
	
	function test(ele){
		
		var num = $(ele).text();
		num++;
		$(ele).children().text(num);
		
		var commu_id = com_id;
		var depth1 = $(ele).parent().parent().parent().attr('class').substring(9,$(ele).parent().parent().parent().attr('class').length-5);
		
		//alert('recommd ' + commu_id+ '-> '+depth1);
		
		var jsonstr = JSON.stringify({
					community_id : commu_id, 
					depth1 : depth1 
					});
		//alert(jsonstr);
		alert('추천 되었습니다 ^^');
		$.post("../bbs/updateRecommand.php", { jsonstr:jsonstr });
			
	}
	
	
	function charByteSize(ch) {
        if (ch == null || ch.length == 0) {
          return 0;
        }

        var charCode = ch.charCodeAt(0);

        if (charCode <= 0x00007F) {
          return 1;
        } else if (charCode <= 0x0007FF) {
          return 2;
        } else if (charCode <= 0x00FFFF) {
          return 3;
        } else {
          return 4;
        }
      }
	
	function stringByteSize(str) {
		// http://kwon37xi.egloos.com/3625250
        if (str == null || str.length == 0) {
          return 0;
        }
        var size = 0;

        for (var i = 0; i < str.length; i++) {
          size += charByteSize(str.charAt(i));
        }
        return size;
      }
	
	
	function sendReply(elements, com_id, mail, pic){
		
		alert('<?php echo $current_user;?>');
		var reply_length = $(elements).parent().find('.reply_value').val().length;
		
		var ori_height = $(elements).parent().parent().css('height');
		
		// alert($(elements).parent().parent().attr('class').substring(9,$(elements).parent().parent().attr('class').length-5));
		var depth1 = $(elements).parent().parent().attr('class').substring(9,$(elements).parent().parent().attr('class').length-5);
		// alert($(elements).parent().parent().find('.reply').children().length);
		
		var commu_id = com_id;
		var email = mail;
		var depth1 = $(elements).parent().parent().attr('class').substring(9,$(elements).parent().parent().attr('class').length-5);
		var depth2;
		var reply_num = $(elements).parent().parent().find('.reply').children(':last').attr('class');
		if($(elements).parent().parent().find('.reply').children().length > 0){
	 		depth2 = reply_num.substr(5, reply_num.length);
	 		depth2 = parseInt(depth2)+1;
	 	}else { depth2 = 1;}
	 
		var reply_content = $(elements).parent().find('.reply_value').val();
		var recommand = 0;
		var guilty = 0;
		
		var jsonstr = JSON.stringify({
					community_id : commu_id, 
					email : email, 
					depth1 : depth1, 
					depth2 : depth2, 
					content : reply_content, 
					recommand : 0, 
					guilty : 0,
					photo : ''
					});
			//alert(jsonstr);	
		 $.post("../bbs/writeContent.php", { jsonstr:jsonstr });
		
		//alert(stringByteSize($(elements).parent().find('.reply_value').val()));
		var reply_height = (70 + parseInt(parseInt(reply_length/72)*45));
	//	alert(reply_height + ' ' +reply_length + ' ' + parseInt(parseInt(reply_length/80)*35 ));
		var plus_height = (parseInt(ori_height) + reply_height) + 'px';
		
		//alert(ori_height);
		//alert(plus_height);
		//alert(reply_length);
		 //alert($(elements).parent().parent().attr('class'));
		 //alert($(elements).parent().find('.reply_value').val());
		 $(elements).parent().parent().css('height',plus_height);
		 
		 
		 var rnumber=Math.floor(Math.random()*8)+1;
		 
		 var img_src = "../bbs/images/r"+rnumber+".png";
		 	
		 	
		 	
		 	
		 var time = year;
		 
		 if(currentTime.getMonth() < 10){
		 	time += '-0'+ currentTime.getMonth();
		 }else{
		 	time += '-'+ currentTime.getMonth();
		 }
		 
		 if( day < 10){
		 	time += '-0'+ day +' '+ hours +':'+ minutes ;
		 }else{
		 	time += '-'+ day +' '+ hours +':'+ minutes ;
		 }
		
		 var divs 	= 	'<div class="child'+depth2+'" style="background-color:#3FFF5F; width:700px;height:'+reply_height+'px;border:1px solid #000000;" >';
		 divs 		+= 	'<div class="article_reply_picture"><img src="'+pic+'" alt="img"></div>';
		 divs 		+=	'<div class="article_reply_box"><div class="article_reply_id">'+mail+'<a onClick="doGuilty(this, '+commu_id+')"><img class="guilty_img" src="../bbs/images/guilty.png" alt="legal"></a>';
		 divs 		+= 	'<div class="guiltyTimes"></div>';
		 divs 		+= 	'<div class="reply_write_time">'+time+'</div></div>'
		 divs		+= 	'<div class="article_reply_value">'+$(elements).parent().find('.reply_value').val() + '</div></div>';
		 divs 		+= 	'</div>'; 
		 
		 //alert($(elements).parent().find('.reply_value').attr('class'));
		 // $(elements).parent().find('.reply_value').append(divs);
		 //$(elements).parent().prepend(divs);
		 $(elements).parent().parent().find('.reply').append(divs);
		 $(elements).parent().children(0).val('');
		 			// $(elements).parent().parent().find('.reply').css('height',
					// (parseInt($(elements).parent().parent().find('.reply').css('height'))+35)+'px');
					
		 //$(elements).parent().prepend(divs);
		// $(elements).parent().css('height',(parseInt($(elements).parent().css('height'))+35)+'px');
		//alert($(elements).parent().children(0).val());
	}
	
	function doGuilty(elements, comu_id){
		// alert('regal');
		// alert($(elements).parent().find(".guiltyTimes").text());
		
		var depth1 = $(elements).parent().parent().parent().parent().parent().attr('class');
		depth1 = depth1.substring(9,depth1.length-5);
		var depth2 = $(elements).parent().parent().parent().attr('class');
		depth2 = depth2.substr(5, depth2.length);
	//	alert(comu_id + '  ' + depth1 +'  ' + depth2);
		
		if($(elements).parent().find(".guiltyTimes").text() == ''){
			$(elements).parent().find(".guiltyTimes").css('visibility','hidden');
			$(elements).parent().find(".guiltyTimes").text('1');
			
			
		}else{
			var txt = $(elements).parent().find(".guiltyTimes").text();
			$(elements).parent().find(".guiltyTimes").text(parseInt(txt)+1);
		}
		
		
		
		if(parseInt($(elements).parent().find(".guiltyTimes").text()) >4){
			alert('5회 신고로 댓글이 삭제 됩니다.');
			
			$(elements).parent().parent().parent().parent().parent().css('height',
				parseInt($(elements).parent().parent().parent().parent().parent().css('height'))-70 + 'px');
				
			//alert(parseInt($(elements).parent().parent().parent().parent().parent().css("height")));
			$(elements).parent().parent().parent().remove();
			
			var jsonstr = JSON.stringify({
					community_id : comu_id, 
					depth1 : depth1, 
					depth2 : depth2
					});
			//alert(jsonstr);	
		 $.post("../bbs/removeArticle.php", { jsonstr:jsonstr });
			
			
		}
		
		
	}

	