
	function imgClick(ele){
	
	// alert('click img');
	
	$('#imgPreview').css('display','block');
	$('#imgPreview').css('width',(parseInt(window.innerWidth)-40)+'px');
	$('#imgPreview').css('height',(parseInt(window.innerHeight)-30)+'px');
	
	$('#imgPreview').find("#previewImage").attr('src', $(ele).attr('src'));
	
	var preview_width, preview_height;
	var pic_width, pic_height;	
	
	preview_width = parseInt($('#imgPreview').css('width'));
	preview_height = parseInt($('#imgPreview').css('height'));

	$('#imgPreview').find("#previewImage").attr('width',(preview_width*0.6)+'px');
 	pic_width = parseInt($('#imgPreview').find("#previewImage").css('width')); 
	pic_height = parseInt($('#imgPreview').find("#previewImage").css('height'));
	
	//alert( preview_width/pic_width +',  ' + preview_height/pic_height);

	if((preview_width/pic_width < preview_height/pic_height) && preview_width/pic_width < 1){
				
		$('#imgPreview').find("#previewImage").css('width',preview_width+'px');
				
	}else if((preview_width/pic_width > preview_height/pic_height) && preview_height/pic_height < 1){
		
		$('#imgPreview').find("#previewImage").css('height',preview_height+'px');
	}
	
	// alert((parseInt($('#imgPreview').css('height'))));
	// alert(($('#imgPreview').find("img").height())/2);
	// alert((parseInt($('#imgPreview').css('height')) - $('#imgPreview').find("img").height())/2);
	var left_margin =  ((parseInt($('#imgPreview').css('width')) - $('#imgPreview').find("#previewImage").width())/2)+'px';
	var top_margin =  ((parseInt($('#imgPreview').css('height')) - $('#imgPreview').find("#previewImage").height())/2)+'px';
	
	
	
	//alert($('#imgPreview').find("#article_img_thumbnail").attr('id'));
	
	//$('#imgPreview').find("#article_img_thumbnail").attr('id')
	$('#imgPreview').find("#article_img_thumbnail").css('margin-left',left_margin);
	$('#imgPreview').find("#article_img_thumbnail").css('margin-top',top_margin);
	
	}
	
	function image_preview_resize(){
		
		var preview_div = $(document).find('#imgPreview');
		$(preview_div).css('width',(parseInt(window.innerWidth)-40)+'px');
		$(preview_div).css('height',(parseInt(window.innerHeight)-30)+'px');
		
		
			
	
	preview_width = parseInt($(preview_div).css('width'));
	preview_height = parseInt($(preview_div).css('height'));
	$(preview_div).find("#previewImage").attr('width',(preview_width*0.6)+'px');
 	pic_width = parseInt($(preview_div).find("#previewImage").css('width')); 
	pic_height = parseInt($(preview_div).find("#previewImage").css('height'));
		
	//alert( preview_width/pic_width +',  ' + preview_height/pic_height);

	if((preview_width/pic_width < preview_height/pic_height) && preview_width/pic_width < 1){
				
		$(preview_div).find("#previewImage").css('width',preview_width+'px');
				
	}else if((preview_width/pic_width > preview_height/pic_height) && preview_height/pic_height < 1){
		
		$(preview_div).find("#previewImage").css('height',preview_height+'px');
	}
	
	// alert((parseInt($('#imgPreview').css('height'))));
	// alert(($('#imgPreview').find("img").height())/2);
	// alert((parseInt($('#imgPreview').css('height')) - $('#imgPreview').find("img").height())/2);
	var left_margin =  ((parseInt($(preview_div).css('width')) - $(preview_div).find("#previewImage").width())/2)+'px';
	var top_margin =  ((parseInt($(preview_div).css('height')) - $(preview_div).find("#previewImage").height())/2)+'px';
		
	$(preview_div).find("#article_img_thumbnail").css('margin-left',left_margin);
	$(preview_div).find("#article_img_thumbnail").css('margin-top',top_margin);	
	}
	 
	
	
