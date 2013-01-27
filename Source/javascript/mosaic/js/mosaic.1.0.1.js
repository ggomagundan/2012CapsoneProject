/*
	Mosaic - Sliding Boxes and Captions jQuery Plugin
	Version 1.0.1
	www.buildinternet.com/project/mosaic
	
	By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
	Released under MIT License / GPL License
*/
function layer_open(el){
		
	//$('.layer').addClass('open');

	$('#'+el).fadeIn(500);
	/*
	var temp = $('#' + el);

	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');

	else temp.css('top', '0px');

	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');

	else temp.css('left', '0px');
	*/
}


(function($){
	
    if(!$.omr){
        $.omr = new Object();
    };
    
    var timer;
    var Layer_Open_Flag=0;
    
    $.omr.mosaic = function(el, options){
    
        var base = this;
        
        // Access to jQuery and DOM versions of element
        base.$el = $(el);
        base.el = el;
        
        // Add a reverse reference to the DOM object
        base.$el.data("omr.mosaic", base);
        
        base.init = function(){
            base.options = $.extend({},$.omr.mosaic.defaultOptions, options);
            
            base.load_box();
        };
        
        // Preload Images
        base.load_box = function(){
        	// Hide until window loaded, then fade in
			if (base.options.preload){
				$(base.options.backdrop, base.el).hide();
				$(base.options.overlay, base.el).hide();
			
				$(window).load(function(){
					// IE transparency fade fix
					if(base.options.options.animation == 'fade' && $(base.options.overlay, base.el).css('opacity') == 0 ) $(base.options.overlay, base.el).css('filter', 'alpha(opacity=0)');
					
					$(base.options.overlay, base.el).fadeIn(200, function(){
						$(base.options.backdrop, base.el).fadeIn(200);
					});
					
					base.allow_hover();
				});
			}else{
				$(base.options.backdrop, base.el).show();
				$(base.options.overlay , base.el).show();
				base.allow_hover();
			}
        };
        
        // Initialize hover animations
        base.allow_hover = function(){
        	// Select animation
			switch(base.options.animation){
			
				// Handle fade animations
				case 'fade':
					
					$(base.el).hover(function () {
						if(timer != null){
							clearInterval(timer);
						}
						timer = setInterval(function(){
							Layer_Open_Flag = 1;
							$('#layer1 h4').html("");
							$('#layer1 p').html("");
							$('#layer1').hide();
							layer_open('layer1');
				        	$('.bg').stop().fadeTo(base.options.speed, base.options.opacity);
				        	$('#layer1').css('left',$(base.el).offset().left).css('top',$(base.el).offset().top);
				        	$('#layer1').css('width','300px');
				        	$('#layer1').css('height','187px');
				        	$('#layer1 img').attr('src',$('.mosaic-backdrop img', base.el).attr('src'));
				        	$('#layer1').animate({
				        		height: '250px'
				        	},100, function(){
				        		$('#layer1 h4').html($('.details h4', base.el).html());
				        		$('#layer1 p').html($('.details p', base.el).html());
				        		$('#layer1 a').attr('href',$('a',base.el).attr('href'));
				        			
				        	});
				        	clearInterval(timer);
						},500);
			        	
			        	//alert($(base.el).offset().left);
			        },function () {
			        	if(Layer_Open_Flag == 0){
		        			$('#layer1').fadeOut();
							$('.bg').stop().fadeTo(200, 0);
		        		}
			        	if(timer != null){
							clearInterval(timer);
						}
			      	});
			      	
			    	break;
			    
			    // Handle slide animations
	      		case 'slide':
	      			// Grab default overlay x,y position
					startX = $(base.options.overlay, base.el).css(base.options.anchor_x) != 'auto' ? $(base.options.overlay, base.el).css(base.options.anchor_x) : '0px';
					startY = $(base.options.overlay, base.el).css(base.options.anchor_y) != 'auto' ? $(base.options.overlay, base.el).css(base.options.anchor_y) : '0px';;
	      			
			      	var hoverState = {};
			      	hoverState[base.options.anchor_x] = base.options.hover_x;
			      	hoverState[base.options.anchor_y] = base.options.hover_y;
			      	
			      	var endState = {};
			      	endState[base.options.anchor_x] = startX;
			      	endState[base.options.anchor_y] = startY;
			      	
					$(base.el).hover(function () {
			        	$(base.options.overlay, base.el).stop().animate(hoverState, base.options.speed);
			        },function () {
			        	$(base.options.overlay, base.el).stop().animate(endState, base.options.speed);
			      	});
			      	
			      	break;
			};
        };
        
        // Make it go!
        base.init();
    };
    
    $.omr.mosaic.defaultOptions = {
        animation	: 'fade',
        speed		: 150,
        opacity		: 1,
        preload		: 0,
        anchor_x	: 'left',
        anchor_y	: 'bottom',
        hover_x		: '0px',
        hover_y		: '0px',
        overlay  	: '.mosaic-overlay',	//Mosaic overlay
		backdrop 	: '.mosaic-backdrop'	//Mosaic backdrop
    };
    
    $.fn.mosaic = function(options){
        return this.each(function(){
            (new $.omr.mosaic(this, options));
        });
    };
    
    
    $(document).ready(function(){
		
		$('#layer1').hover(function(){}, function(){
			//alert('빠젺다!');
			Layer_Open_Flag = 0;
			timer = setInterval(function(){	
				$('#layer1').fadeOut();
				$('.bg').stop().fadeTo(200, 0);
				clearInterval(timer);
			},500);
		});
	});
})(jQuery);
