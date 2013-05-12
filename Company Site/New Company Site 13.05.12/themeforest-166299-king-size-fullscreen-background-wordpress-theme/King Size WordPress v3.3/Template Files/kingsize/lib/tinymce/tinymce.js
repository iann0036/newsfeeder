/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes V 1.0
 **/
function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

/// All shortcodes definition here to insert into the content editor
function insertkingsizeLink() {
	
	var tagtext;

	var style = document.getElementById('shortcode_panel');
	
		var styleid = document.getElementById('put_shortcode_select').value;
		
		if (styleid != 0) {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";
		}	

		if (styleid != 0 && styleid == 'one_third') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'one_third_last') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'two_thirds') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'two_thirds_last') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'img_floated_left') {
			tagtext = "["+ styleid + " src=\"#\" alt=\"\" ]";	
		}

		if (styleid != 0 && styleid == 'img_floated_right') {
			tagtext = "["+ styleid + " src=\"#\" alt=\"\" ]";	
		}

		if (styleid != 0 && styleid == 'button') {
			tagtext = "["+ styleid + " to=\"#\" color=\"\" ]";	
		}

		if (styleid != 0 && styleid == 'info_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'warning_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'error_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'download_box') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'blockquote') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'tooltip_link') {
			tagtext = "["+ styleid + " title=\"\" to=\"#\"]Insert your text here[/" + styleid + "] ";	
		}
		
		if ( styleid == 0) {
			tinyMCEPopup.close();
		}
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
