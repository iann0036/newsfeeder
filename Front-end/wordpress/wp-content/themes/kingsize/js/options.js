(function($) { 

$(document).ready(function() {

		$('.option_row a').css('opacity', '.8');


		if ($('#wm_menu_hide_enabled:checked').val() == undefined) {
			$('#wm_menu_show_tooltip, #wm_menu_tooltip').closest('.option_row').hide();
		}
		
		
		$('#wm_menu_hide_enabled').change(function() {
			$('#wm_menu_show_tooltip, #wm_menu_tooltip').closest('.option_row').fadeToggle();
		}); 


		$('.option_row a').hover(function(e){

			$(this).css('opacity', '1');	

			var help_link = $(this).closest('.option_row').find(':input').attr('id');

			var option_div;

			var option_text;

			switch (help_link) {
		

    //****** GLOBAL BACKGROUND PREFERENCES ******//
	
	//background option
	case (help_link = "wm_background_image"):   
	option_div = "background";
	option_text = '<p>This is your main background image that will be shown globally throughout all pages and posts. You can overwrite it on individual pages or posts if you need to, by assigning a new background image in the page / post write-panel.</p>';	                
	break;

	//grid option                      
	case (help_link = "wm_grid_hide_enabled"):
	option_div = "grid";
	option_text = '<p>This enables a <b>Grid Overlay</b> on all pages except the homepage. The grid darkens the background so it is easier for your visitors to focus on content.</p>';	                
	break;
	
	
	
	//****** HOMEPAGE SLIDER PREFERENCES ******//

	//slider enable option                      
	case (help_link = "wm_slider_enabled"):
	option_div = "slider_enabled";
	option_text = '<p><b>To Enable</b> the Homepage Background Slider, make sure this is checkmarked and go to the option in the sidebar titled <i>Background Slider</i> to upload and manage your slider images.</p> <p><b>To Disable</b> the slider, uncheck this box and use the above <i>Global Background Preferences</i> to assign your static image.</p>';	                
	break;
	
	//slider intreval option                      
	case (help_link = "wm_slider_seconds"):
	option_div = "slider_seconds";
	option_text = '<p>Here you can insert the number in seconds for how long in between each slider intreval. By default this is set at 5000 <i>(5 seconds)</i> but can be changed to whatever you would prefer.</p>';	                
	break;
	
	//slider transition option                      
	case (help_link = "wm_slider_transition"):
	option_div = "slider_transition";
	option_text = '<p>You have three options available to you, which are <b>Fade</b>, <b>Vertical</b> and <b>Horizontal</b>.  The selection here will be applied to your Homepage Background Slider. The default setting is Fade.</p>';	                
	break;
	
	//slider direction option                      
	case (help_link = "wm_slider_direction"):
	option_div = "slider_direction";
	option_text = '<p>There are two directions in which you can choose from and those are <b>Normal</b> and <b>Reverse</b>. The default setting is on Normal and can be changed anytime.</p>';	                
	break;
	
	

	//****** NAVIGATION MENU PREFERENCES ******//

	//hide menu option                      
	case (help_link = "wm_menu_hide_enabled"):
	option_div = "menu_hide";
	option_text = '<p>When <b>Enabled</b> this will present the visitor with the option to hide and/or show the navigation by clicking an arrow at the bottom of your navigation.</p> <p>When <b>Disabled</b> the option to hide the navigation will no longer be present.</p>';  
	break;
	
	//menu tooltip enable option                      
	case (help_link = "wm_menu_tooltip_enabled"):
	option_div = "menu_tooltip_enabled";
	option_text = '<p>When <b>Enabled</b> there is a tooltip present whenever someone mouses over the arrow in the navigation.</p> <p>When <b>Disabled</b> the tooltip will no longer be present when moused over.</p>';  
	break;

	//tooltip hide text option   	   
	case (help_link = "wm_menu_tooltip"):
	option_div = "hide_tooltip";
	option_text = '<p>This tooltip message will be displayed when someone mouses over the arrow to <i>hide</i> the navigation.</p>';  
	break;

	//tooltip show text option
	case (help_link = "wm_menu_show_tooltip"):
	option_div = "show_tooltip";
	option_text = '<p>This tooltip message will be displayed when someone mouses over the arrow to <i>show</i> the navigation.</p>';  
	break;
	
	
	
	//****** PAGE AND POST BLOG PREFERENCES ******//

	//excerpt option                      
	case (help_link = "wm_enable_excerpts"):
	option_div = "enable_excerpts";
	option_text = '<p>When <b>Enabled</b> this will automatically create an excerpt from the post contents for your blog page that includes a <i>Read More</i> link to the remainder of the blog post contents.</p> <p>When <b>Disabled</b> this will provide the full contents of the blog post removing the option for the <i>Read More</i> link.</p>';
	break;
	
	//single blog entry dates                     
	case (help_link = "wm_enable_post_dates"):
	option_div = "enable_post_dates";
	option_text = '<p>By default, Post Dates are displayed beneath the titles of all Posts. However, some have requested the ability to disable the Dates. By unchecking this box you will disable the Dates displayed in the single.php / Single Posts.</p>';
	break;
	
	//excerpt option                      
	case (help_link = "wm_enable_blog_dates"):
	option_div = "enable_blog_dates";
	option_text = '<p>By default, Post Dates are displayed beneath all posts on the "Blog Page / Archives" and here you can choose to disable those dates from displaying. When disabled, this area will now display only the "Comments" removing the initial Posting Date. Do not confuse with "Single Posts".</p>';
	break;
	
	//sidebar enable option                      
	case (help_link = "wm_sidebar_enabled"):
	option_div = "sidebar_enabled";
	option_text = '<p>When <b>Enabled</b> the sidebar will be present on all blog related pages and archives managed with <i>Widgets</i>.</p> <p>When <b>Disabled</b> this will remove the sidebar leaving you with a full width display, minus the sidebar.</p>';	                
	break;
	
	//show widget ready footer
	case (help_link = "wm_show_footer"):
	option_div = "show_footer";
	option_text = '<p>When <b>Enabled</b> you have the option to include widgets inside your footer using the 3 designed Widget Sidebars via <i>Appearance</i> > <i>Widgets</i>.</p> <p>When <b>Disabled</b> this will remove the large footer area completely, leaving you only the small copyright footer.</p>';  
	break;

	//portfolio comments option                      
	case (help_link = "wm_show_comments"):
	option_div = "show_comments";
	option_text = '<p>When <b>Enabled</b> this will turn on the option to open comments beneath your portfolio and gallery pages. You still have to enable the discussions via <b>Screen Options</b> when creating a new page to allow further management of your comments.</p>';	                
	break;
	
	//read more option                      
	case (help_link = "wm_read_more_text"):
	option_div = "read_more_text";
	option_text = '<p>Enter in the text you want to use if different than the default <i>Read more...</i></p>';              
	break;
	


	//****** PORTFOLIO PREFERENCES ******//

	//number of portfolio items
	case (help_link = "wm_portfolio_num_items"):
	option_div = "portfolio_prefs";
	option_text = '<p>Here you can enter the number of Portfolio Items you want displayed on your portfolio pages before creating a page two. By default it displays 10.</p>'; 
	break;
	
	//enable or disable single portfolio item
	case (help_link = "wm_portfolio_image_enabled"):
	option_div = "portfolio_image_enabled";
	option_text = '<p>By default, when including a Portfolio post, the main featured image/video will be displayed inside the actual Portfolio Item when clicked. This displays beneath the content. To disable this from appearing, you just uncheck the box here and save to apply your changes.</p>'; 
	break;

	//Read more button text
	case (help_link = "wm_portfolio_read_more_text"):
	option_div = "portfolio_read_more_text";
	option_text = '<p>Enter in the text you want to use if different than the default <i>Read more...</i></p>'; 
	break;
	
	//enable or disable Read more button
	case (help_link = "wm_enable_read_more"):
	option_div = "portfolio_enable_read_more";
	option_text = '<p>Check this box if you want to enable the read more button.</p>'; 
	break;
	
	//enable or disable Read more button
	case (help_link = "wm_enable_portfolio_dates"):
	option_div = "portfolio_dates";
	option_text = '<p>By default, the Dates of the Single Portfolio items will be shown beneath the titles. Here you can uncheck the box if you would like to disable the dates from being displayed.</p>'; 
	break;
	

	//****** COLOR AND STYLE PREFERENCES ******//

	// link colour option
	case (help_link = "wm_link_color"):
	option_div = "link_color";
	option_text = '<p>This option will change the colour of all links in content sections.</p>';  
	break;

	// link colour hover option
	case (help_link = "wm_link_color_hover"):
	option_div = "link_color_hover";
	option_text = '<p>This option will change the colour of all links in a moused-over state.</p>'; 
	break;

	//title colour option
	case (help_link = "wm_post_title_color"):
	option_div = "title_color";
	option_text = '<p>This option will change the colour of the Blog post titles.</p>'; 
	break;

	//text colour option
	case (help_link = "wm_color_text"):
	option_div = "body_color";
	option_text = '<p>This option will change the colour of body text (paragraphs / contents).</p>'; 
	break;

	//heading colour option
	case (help_link = "wm_heading_text_color"):
	option_div = "heading_color";
	option_text = '<p>This option will change the colour of all the headings (h1, h2, h3, h4, h5, h6) except for the blog post titles.</p>'; 
	break;

	//menu links colour option
	case (help_link = "wm_menu_text_color"):
	option_div = "menu_color";
	option_text = '<p>This option will change the colour of links in the navigation menu.</p>'; 
	break;

	//menu desciption colour option
	case (help_link = "wm_menu_description_text_color"):
	option_div = "menu_desc_color";
	option_text = '<p>This option will change the colour of the descriptions in the navigation menu.</p>'; 
	break;

	//menu links colour option in active state
	case (help_link = "wm_menu_active_color"):
	option_div = "menu_desc_color_active";
	option_text = '<p>This option will change the colour of links in the navigation menu (while in an active state).</p>'; 
	break;
	
	//menu description colour option in active state
	case (help_link = "wm_menu_active_description_color"):
	option_div = "menu_color_active";
	option_text = '<p>This option will change the colour of descriptions in the navigation menu (while in an active state).</p>'; 
	break;
	
	
	
	//****** EMAIL CONTACT PREFERENCES ******//

	//e-mail address
	case (help_link = "wm_contact_email"):
	option_div = "email";
	option_text = '<p>Enter the email address here associated with the <b>Contact Page</b> provided with KingSize. This email address will only work if using the KingSize Contact Page Template.</p>'; 
	break;
	
	//e-mail success
	case (help_link = "wm_contact_email_template"):
	option_div = "email";
	option_text = '<p>This message will be shown after the contact form is submitted and if e-mail was successfully sent (only if you are using the KingSize "contact" template).</p>'; 
	break;
	
	//contact success message colour
	case (help_link = "wm_success_color"):
	option_div = "contact_success_color";
	option_text = '<p>This option will change the colour of the success message when an email has successfully been sent.</p>'; 
	break;
	
	
	
	//****** FOOTER COPYRIGHT PREFERENCES ******//

	//footer copyright message
	case (help_link = "wm_footer_copyright"):
	option_div = "footer";
	option_text = '<p>This text will appear in the bottom part of the footer, acting as your copyright. You do have the option of using HTML.</p>'; 
	break;
	
	
	
	//****** MISCELLANEOUS PREFERENCES ******//
	
	//header code insert
	case (help_link = "wm_head_include"):
	option_div = "head";
	option_text = '<p>The code placed here will be inserted in the < head > section of the template.</p>'; 
	break;

	//404 error page header
	case (help_link = "wm_custom_404_title"):
	option_div = "404_title";
	option_text = '<p>This text will be shown on the 404 page as your custom 404 error title.</p>'; 
	break;
	
	//404 error page message
	case (help_link = "wm_custom_404"):
	option_div = "404";
	option_text = '<p>This text will be shown on the 404 page as your custom 404 message.</p>'; 
	break;

	//Google Analytics
	case (help_link = "wm_google_analytics_id"):
	option_div = "google_analytics_id";
	option_text = '<p>For Google Analytics to work, you need to paste the unique ID Google has provided you. Inside your Google Analytics script, you will see an ID similar to "UA-21529767-1", insert that in this area.</p>'; 
	break;
	
	//Disable Right Clicks
	case (help_link = "wm_no_rightclick_enabled"):
	option_div = "no_rightclick_enabled";
	option_text = '<p>By default the template now uses "No Right-Click" and can be disabled by un-checking the box beside here.</p>'; 
	break;
	
	
	
	//Custom CSS Styles
	case (help_link = "wm_custom_css"):
	option_div = "custom_css";
	option_text = '<p>Here you can insert your own CSS that will override the defaults set by style.css eliminating your need to look at any files.</p>'; 
	break;
	

	default:
	option_div = "";
	option_text = '<p></p>'; 

}   

		$('body').append('<div class="option_help ' + option_div + '"> '+ option_text +'  </div>');

		  mouseX = e.pageX + 15 ;

		  mouseY = e.pageY + 5;

		$('.option_help').css({

			left: mouseX + 'px',

			top: mouseY + 'px'	

		});		

	}, 

	function(){

				$(this).css('opacity', '.8');	

				$('.option_help').remove();
				
			  });
});

})(jQuery);