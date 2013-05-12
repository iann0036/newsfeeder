
			

			
		


/////////////////////////////////////////////////////////////////////////////////////////////////////////

			(function($) {	

			// image preloading
			jQuery.fn.onImagesLoaded = function(_cb) { 
  return this.each(function() {
 
    var $imgs = (this.tagName.toLowerCase()==='img')?$(this):$('img',this),
        _cont = this,
            i = 0,
    _done=function() {
      if( typeof _cb === 'function' ) _cb(_cont);
    };
 
    if( $imgs.length ) {
      $imgs.each(function() {
        var _img = this,
        _checki=function(e) {
          if((_img.complete) || (_img.readyState=='complete'&&e.type=='readystatechange') )
          {
            if( ++i===$imgs.length ) _done();
          }
          else if( _img.readyState === undefined ) // dont for IE
          {
            $(_img).attr('src',$(_img).attr('src')); // re-fire load event
          }
        }; // _checki \\
 
        $(_img).bind('load readystatechange', function(e){_checki(e);});
        _checki({type:'readystatechange'}); // bind to 'load' event...
      });
    } else _done();
  });
};


$('body').append('<span id="body_loader"></span>');	
	$('#body_loader').fadeIn();

		
				
		//disable selecting on double click
	    $.extend($.fn.disableTextSelect = function() {
	        return this.each(function(){
	            if($.browser.mozilla){//Firefox
	                $(this).css('MozUserSelect','none');
	            }else if($.browser.msie){//IE
	                $(this).bind('selectstart',function(){return false;});
	            }else{//Opera, etc.
	                $(this).mousedown(function(){return false;});
	            }
	        });
	    });
	    $('.noSelect').disableTextSelect();//No text selection on elements with a class of 'noSelect'

	
		
				//In our jQuery function, we will first cache some element and define some variables:
				var $tf_bg				= $('#tf_bg'),
					$tf_bg_images		= $tf_bg.find('img'),
					$tf_bg_img			= $tf_bg_images.eq(0),
					total				= $tf_bg_images.length,
					current				= 0,
					$tf_next			= $('#tf_next'),
					$tf_prev			= $('#tf_prev'),
					$tf_loading			= $('#tf_loading');
				
				//preload the images				
				$('#tf_bg').onImagesLoaded(function(_this){
    					//hide loader
	$('#body_loader').fadeOut('fast', function(){
init();
}).remove();
						
					
  				});
				
				//shows the first image and initializes events
				function init(){
					//get dimentions for the image, based on the windows size
					var dim	= getImageDim($tf_bg_img);
					//set the returned values and show the image
					$tf_bg_img.css({
						width	: dim.width,
						height	: dim.height,
						left	: dim.left,
						top    : dim.top
					}).fadeIn('normal', function(){
if ($('body').hasClass('home') && $('#tf_bg').hasClass('slider')) {
				
				var slideTimer = setInterval(function() { scroll(dir); }, sliderTime);	
			}	
				
});


if (!$('body').hasClass('body_home')) {	
	$('.grid_overlay, #tf_bg').fadeTo('fast', .8).append('<div class="grid"></div>');
} 


				
					//resizing the window resizes the $tf_bg_img
				$(window).bind('resize',function(){
					var dim	= getImageDim($tf_bg_img);
					$tf_bg_img.css({
						width	: dim.width,
						height	: dim.height,
						left	: dim.left,
						top		: dim.top
					});
				});
									
				/*	//click the arrow down, scrolls down
					$tf_next.bind('click',function(){
						
						clearInterval(slideTimer);
						
						if($tf_bg_img.is(':animated'))
							return false;
							scroll('tb');
					});
					
					//click the arrow up, scrolls up
					$tf_prev.bind('click',function(){
						
						
						clearInterval(slideTimer);
						
						if($tf_bg_img.is(':animated'))
						return false;
						scroll('bt');
					});
				*/	
					
				}
			
				
			
	
			
			function scroll(dir){
					
				if (slideDirection == 'vertical')  {
					
					//if dir is "tb" (top -> bottom) increment current, 
					//else if "bt" decrement it
					current	= (dir == 'tb')?current + 1:current - 1;
					
					//we want a circular slideshow, 
					//so we need to check the limits of current
					if(current == total) current = 0;
					else if(current < 0) current = total - 1;

					//we get the next image
					var $tf_bg_img_next	= $tf_bg_images.eq(current),
						//its dimentions
						dim				= getImageDim($tf_bg_img_next),
					
							//the top should be one that makes the image out of the viewport
						//the image should be positioned up or down depending on the direction
							top	= (dir == 'tb')?$(window).height() + 'px':-parseFloat(dim.height,10) + 'px';
							
					//set the returned values and show the next image	
						$tf_bg_img_next.css({
							width	: dim.width,
							height	: dim.height,
							left	: dim.left,
							top		: top
						}).show();
						
					//now slide it to the viewport
						$tf_bg_img_next.stop().animate({
							top 	: dim.top
						},1000);
						
					//we want the old image to slide in the same direction, out of the viewport
						var slideTo	= (dir == 'tb')?-$tf_bg_img.height() + 'px':$(window).height() + 'px';
						$tf_bg_img.stop().animate({
							top 	: slideTo
						},1000,function(){
						//hide it
							$(this).hide();
						//the $tf_bg_img is now the shown image
							$tf_bg_img	= $tf_bg_img_next;

				});
				}
				
				
					if (slideDirection == 'horizontal') 
					{
						
						//if dir is "tb" (top -> bottom) increment current, 
					//else if "bt" decrement it
					current	= (dir == 'tb')?current + 1:current - 1;
					
					//we want a circular slideshow, 
					//so we need to check the limits of current
					if(current == total) current = 0;
					else if(current < 0) current = total - 1;

					//we get the next image
					var $tf_bg_img_next	= $tf_bg_images.eq(current),
						//its dimentions
						dim				= getImageDim($tf_bg_img_next),
					
							//the top should be one that makes the image out of the viewport
						//the image should be positioned up or down depending on the direction
							left	= (dir == 'tb')?$(window).width() + 'px':-parseFloat(dim.width,10) + 'px';
							
					//set the returned values and show the next image	
						$tf_bg_img_next.css({
							width	: dim.width,
							height	: dim.height,
							top		: dim.top,
							left	: left
						}).show();
						
					//now slide it to the viewport
						$tf_bg_img_next.stop().animate({
							left 	: dim.left
						},1000);
						
					//we want the old image to slide in the same direction, out of the viewport
						var slideTo	= (dir == 'tb')?-$tf_bg_img.width() + 'px':$(window).width() + 'px';
						$tf_bg_img.stop().animate({
							left 	: slideTo
						},1000,function(){
						//hide it
							$(this).hide();
						//the $tf_bg_img is now the shown image
							$tf_bg_img	= $tf_bg_img_next;

				});		
				}
				

				if (slideDirection == 'fade') 
					{
						
						//if dir is "tb" (top -> bottom) increment current, 
					//else if "bt" decrement it
					current	= (dir == 'tb')?current + 1:current - 1;
					
					//we want a circular slideshow, 
					//so we need to check the limits of current
					if(current == total) current = 0;
					else if(current < 0) current = total - 1;

					//we get the next image
					var $tf_bg_img_next	= $tf_bg_images.eq(current),
						//its dimentions
						dim				= getImageDim($tf_bg_img_next);

					//set the returned values and show the next image	
						$tf_bg_img_next.css({
							width	: dim.width,
							height	: dim.height,
							top		: dim.top,
							left	: dim.left
						}).fadeIn(1500);
						
					//we want the old image to slide in the same direction, out of the viewport
						$tf_bg_img.stop().fadeOut(1500,function(){
						//the $tf_bg_img is now the shown image
							$tf_bg_img	= $tf_bg_img_next;

				});		
				}

			} // scroll functions ends here 
			
			

			
				//animate the image to fit in the viewport
				function resize($img){
					var w_w	= $(window).width(),
						w_h	= $(window).height(),
						i_w	= $img.width(),
						i_h	= $img.height(),
						r_i	= i_h / i_w,
						new_w,new_h;
					
					if(i_w > i_h){
						new_w	= w_w;
						new_h	= w_w * r_i;
						
						if(new_h > w_h){
							new_h	= w_h;
							new_w	= w_h / r_i;
						}
					}	
					else{
						new_h	= w_w * r_i;
						new_w	= w_w;
					}
					
					$img.animate({
						width	: new_w + 'px',
						height	: new_h + 'px',
						top		: '0px',
						left	: '0px'
					},350);
				}
				
				//get dimentions of the image, 
				//in order to make it full size and centered
				function getImageDim($img){
					var w_w	= $(window).width(),
						w_h	= $(window).height(),
						r_w	= w_h / w_w,
						i_w	= $img.width(),
						i_h	= $img.height(),
						r_i	= i_h / i_w,
						new_w,new_h,
						new_left,new_top;
					
					if(r_w > r_i){
						new_h	= w_h;
						new_w	= w_h / r_i;
					}
					else{
						new_h	= w_w * r_i;
						new_w	= w_w;
					}


					return {
						width	: new_w + 'px',
						height	: new_h + 'px',
						left	: (w_w - new_w) / 2 + 'px',
						top		: (w_h - new_h) / 2 + 'px'
					};
					}
			})(jQuery);