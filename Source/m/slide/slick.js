$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = parseInt(window.screen.width)*0.85;
  
  var slides = $('.slide');
  var numberOfSlides = slides.length;
  
    $('#current').text(1 + "/"+ numberOfSlides);
    $('#currents').css('background-position','0 0');
    $('#currents').css('width',(numberOfSlides*12+2)+'px');

  // Remove scrollbar in JS
  $('#slidesContainer').css('overflow', 'hidden');

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth+'px'
    });
	slides.find('p').css('width',slideWidth+'px');

  // Set #slideInner width equal to total width of all slides
  $('#slideInner').css('width', (slideWidth * numberOfSlides)+'px');
	

  $('.control')
    .bind('click', function(){
    // Determine new position
    
    
    
    
   	currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    if(currentPosition >= numberOfSlides){
    	currentPosition =0;
    }else if(currentPosition <0){
    	currentPosition = numberOfSlides-1;
    }
    
    // Move slideInner using margin-left
    
    $('#slideInner').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
    $('#current').text((currentPosition+1) + "/"+ numberOfSlides);
    $('#currents').css('background-position','0 '+(-currentPosition*20)+'px');
  });

  
});