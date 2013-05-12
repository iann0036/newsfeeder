jQuery(document).ready(function($) {                  	

	// CUFON REPLACEMENT
	Cufon.replace('#navbar li a, h1.name, #main h1, #main h2', { fontFamily: 'PT Sans Narrow' }); 
	
	Cufon.replace('#navbar li a span, .post h3 a, a.read_more, #sidebar h3, #main h3, #main h4, #pagination a, a.more-link, #pagination-full a',  { fontFamily: 'PT Sans' }); 
	
	Cufon.replace('a.button', {
	fontFamily: 'PT Sans',
	textShadow: '1px 1px #434343'
	});


	//DROPDOWN SCRIPT
	$('#navbar ul').css({display: "none"}); 
	$('#navbar li').hover(function(){
		$(this).find('ul:first').css({visibility: "visible", display: "none"}).fadeIn('fast');
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});	
	
		
		
					

		// IE navbar last child fix		
		$('#navbar li ul li:last-child').css('border-bottom', 'none');	

	
	//SHOW THE LOADER AND HIDE BACKGROUND IMAGE UNTIL IT IS LOADED
	$('#tf_bg img').css('display', 'none');
	
	/* $('#tf_bg').removeClass('nojs').addClass('tf_bg');*/ 
	
	

	function fix_flash() {
    // loop through every embed tag on the site
    var embeds = document.getElementsByTagName('embed');
    for (i = 0; i < embeds.length; i++) {
        embed = embeds[i];
        var new_embed;
        // everything but Firefox & Konqueror
        if (embed.outerHTML) {
            var html = embed.outerHTML;
            // replace an existing wmode parameter
            if (html.match(/wmode\s*=\s*('|")[a-zA-Z]+('|")/i))
                new_embed = html.replace(/wmode\s*=\s*('|")window('|")/i, "wmode='transparent'");
            // add a new wmode parameter
            else
                new_embed = html.replace(/<embed\s/i, "<embed wmode='transparent' ");
            // replace the old embed object with the fixed version
            embed.insertAdjacentHTML('beforeBegin', new_embed);
            embed.parentNode.removeChild(embed);
        } else {
            // cloneNode is buggy in some versions of Safari & Opera, but works fine in FF
            new_embed = embed.cloneNode(true);
            if (!new_embed.getAttribute('wmode') || new_embed.getAttribute('wmode').toLowerCase() == 'window')
                new_embed.setAttribute('wmode', 'transparent');
            embed.parentNode.replaceChild(new_embed, embed);
        }
    }
    // loop through every object tag on the site
    var objects = document.getElementsByTagName('object');
    for (i = 0; i < objects.length; i++) {
        object = objects[i];
        var new_object;
        // object is an IE specific tag so we can use outerHTML here
        if (object.outerHTML) {
            var html = object.outerHTML;
            // replace an existing wmode parameter
            if (html.match(/<param\s+name\s*=\s*('|")wmode('|")\s+value\s*=\s*('|")[a-zA-Z]+('|")\s*\/?\>/i))
                new_object = html.replace(/<param\s+name\s*=\s*('|")wmode('|")\s+value\s*=\s*('|")window('|")\s*\/?\>/i, "<param name='wmode' value='transparent' />");
            // add a new wmode parameter
            else
                new_object = html.replace(/<\/object\>/i, "<param name='wmode' value='transparent' />\n</object>");
            // loop through each of the param tags
            var children = object.childNodes;
            for (j = 0; j < children.length; j++) {
                try {
                    if (children[j] != null) {
                        var theName = children[j].getAttribute('name');
                        if (theName != null && theName.match(/flashvars/i)) {
                            new_object = new_object.replace(/<param\s+name\s*=\s*('|")flashvars('|")\s+value\s*=\s*('|")[^'"]*('|")\s*\/?\>/i, "<param name='flashvars' value='" + children[j].getAttribute('value') + "' />");
                        }
                    }
                }
                catch (err) {
                }
            }
            // replace the old embed object with the fixed versiony
            object.insertAdjacentHTML('beforeBegin', new_object);
            object.parentNode.removeChild(object);
        }
    }
}

fix_flash();	

    //GALLERY IMAGES HOVER SCRIPT
		
		//add span that will be shown on hover on gallery item
		$(".gallery li a.image, .portfolio li a.image").append('<span class="image_hover"></span>'); //add span to images
		$(".gallery  li a.video, .portfolio li a.video").append('<span class="video_hover"></span>'); //add span to videos

		$('.gallery  li a span').css('opacity', '0').css('display', 'block') //span opacity = 0 
		
		// show / hide span on hover
		$(".gallery li a, .portfolio li a").hover(
			 function () {
				 $(this).find('.image_hover, .video_hover').stop().fadeTo('slow', .7); }, 
			function () {
		  		  $('.image_hover, .video_hover').stop().fadeOut('slow', 0);
		});
			
			
	
             
    //IF BODY HAS CLASS VIDEO_BACKGROUND, MAKE HTML HEIGHT 100% AND ABILITY TO HIDE AND SHOW NAVIGATION ON HOME PAGE

	$('#hide_menu a').css('display', 'block');	
		                  	         
   //SHOWING MENU TOOLTIP ------ delete if you don't want it!                    
    $('#hide_menu a').hover( function(){
         $('.menu_tooltip, .menu_tooltip p').stop().fadeTo('fast', 1);            	
     },
     function () {
     	$('.menu_tooltip, .menu_tooltip p').stop().fadeTo('fast', 0);  
	});
             
	
	 
		            
    //HIDING MENU         
    
  var navHeight = $('#menu_wrap').height();
   var hideHeight = navHeight - 120; 
    
    
    //click on hide menu button (arrow points up)                            
    $('#hide_menu a.menu_visible').live('click',function(){	
		
	    	//add class hidden
	        $('#hide_menu a.menu_visible')
		        .removeClass('menu_visible')
		        .addClass('menu_hidden')
		        .attr('title', 'Show the navigation');
		   
		    // hide the tooltip     
	        $('.menu_tooltip').css('opacity', '0');
	          
	        //move navigation up, after replace the text                  
		    $('#menu_wrap').animate({top: '-='+ hideHeight + 'px'}, "normal", function() {      	
		        $('.menu_tooltip .tooltip_hide').hide();	   
		    	$('.menu_tooltip .tooltip_show').show();	
		                
	 });
	                       	
            return false;
            
     	});
	          
     	       	
	//SHOWING MENU	
		//click on show menu button (arrow points down)                      	
		 $('#hide_menu a.menu_hidden').live('click', function(){	
		    
		     //add class visible	
		     $('#hide_menu a.menu_hidden')
			     .removeClass('menu_hidden')
			     .addClass('menu_visible');
		
			// hide the tooltip      
		      $('.menu_tooltip').css('opacity', '0');    
		        $('#menu_wrap').animate({ top: '+='+ hideHeight + 'px'}, 'normal');  
		        $('.menu_tooltip .tooltip_show').hide();
		        $('.menu_tooltip .tooltip_hide').show();	   
		    		
		            
		            return false;    
		 });



						

	//FORM (CONTACT & COMMENTS) SCRIPTS

		//set variables
		var nameVal = $("#form_name").val();
		var emailVal = $("#form_email").val();
		var websiteVal = $("#form_website").val();
		var messageVal = $("#form_message").val();
				

		//if name field is empty, show label in it
		if(nameVal == '') {
		$("#form_name").parent().find('label').css('display', 'block');	
		}
		
		//if email field is empty, show label in it
		if(emailVal == '') {
		$("#form_email").parent().find('label').css('display', 'block');	
		}
		
		//if website field is empty, show label in it
		if(websiteVal == '') {
		$("#form_website").parent().find('label').css('display', 'block');	
		}
					
		
		//if message field is empty, show label in it
		if(messageVal == '') {
		$("#form_message").parent().find('label').css('display', 'block');	
		}

				
		//hide labels on focus		
		$('form input, form textarea').focus(function(){
			$(this).parent().find('label').fadeOut('fast');		
		});		
		
		//show labels when field is not focused - only if there are no text
		$('form input, form textarea').blur(function(){
			var currentInput = 	$(this);	
			if (currentInput.val() == ""){
   			 $(this).parent().find('label').fadeIn('fast');
 			 }
		});		
		
		
	// CONTACT FORM HANDLING SCRIPT - WHEN USER CLICKS "SUBMIT"
	$("#contact_form #form_submit").click(function(){		
				   				 		
		// hide all error messages
		$(".error").hide();
		
		// remove "error" class from text fields
		$("form input, form textarea").focus(function() {
 			$(this).removeClass('error_input');
			});
		
		// remove error messages when user starts typing		
		$("form input, form textarea").keypress(function() {
 			$(this).parent().find('span').fadeOut();	
		});
		
		$("#form_message").keypress(function() {	
			$(this).animate({ 
  			  width: "420px"
 			 }, 100); 
		});
		
		// set variables
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		
		// validate "name" field
		var nameVal = $("#form_name").val();
		if(nameVal == '') {
			$("#form_name")
			.after('<span class="error">Please enter your name</span>')
			.addClass('error_input')				  
			hasError = true;
		}
		
	
	
		// validate "e-mail" field - andd error message and animate border to red color on error
		var emailVal = $("#form_email").val();
		if(emailVal == '') {
			$("#form_email")
			.after('<span class="error">Please enter your e-mail</span>')
			.addClass('error_input')
			hasError = true; 
				
		} else if(!emailReg.test(emailVal)) {	
			$("#form_email")
			.after('<span class="error">Please provide a valid e-mail</span>')
			.addClass('error_input')
			hasError = true;
		}
		
				
		// validate "message" field
		var messageVal = $("#form_message").val();
		if(messageVal == '') {
			
			$("#form_message")
			.animate({ 
  			  	width: "300px"
 			 }, 100 )
			.after('<span class="error comment_error">Please enter your message</span>')
			.addClass('error_input')
			hasError = true;
		}
		
                // if the are errors - return false
                if(hasError == true) { return false; }
            
		// if no errors are found - submit the form with AJAX
		if(hasError == false) {
			
		var dataString = $('#contact_form').serialize();

			//hide the submit button and show the loader image	
			$("#form_submit").fadeOut('fast', function () {
			$('#contact_form').append('<span id="loader"></span>'); 
			});
			       
			
		// make an Ajax request
        $.ajax({
            type: "POST",
            url: template_directory+"/php/contact-send.php",
            data: dataString,
            success: function(){ 
           
          // on success fade out the form and show the success message
          $('#loader').remove();
          $('#contact_form').children().fadeOut('fast');
          $('.contact_info').fadeOut('fast');
           $('.success').fadeIn();    	
            }
        }); // end ajax

		 return false;  
		} 	
		
	});		
	
	//CONTACT PAGE MAP - CHANE OPACITY ON HOVER
		$('img.map').css('opacity', '.5');
		
		$('img.map').hover(function(){
			$(this).fadeTo('fast', 1);	
		},
		function(){
			$(this).fadeTo('fast', .5);	
		});
		
		
		
	// FOOTER TOOLTIPS
		
	$('.tooltip_link').tipsy({gravity: 's', fade: 'true' });
		
		
		

}); //document.ready function ends here

//WAIT UNTIL CONTENT IS LOADED
/* $(window).load(function() {
	 
	//hide loader
	
	
	//append grid if not on the home page
	if (!$('body').hasClass('body_home')) {	
	$('.grid_overlay, #tf_bg').fadeTo('fast', .8).append('<div class="grid"></div>');
	}
	
	//fade in the image
	//$('#bg img').fadeIn('normal');
	   	
}); */






	

