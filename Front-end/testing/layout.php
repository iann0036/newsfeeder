

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="zF5-ebug9_0x8gROtVdJ35eV_h8PPFpxwGmjcy7uOgQ" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>News Feeder</title>

<link href="/themes/dark/css/main.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

<script type="text/javascript" src="/themes/dark/js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/flot/jquery.flot.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/flot/excanvas.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/flot/jquery.flot.resize.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/tables/colResizable.min.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/forms/forms.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/autotab.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/forms/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/other/calendar.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/other/elfinder.min.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.colorpicker.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/wizards/jquery.validate.js"></script>

<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.ToTop.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.listnav.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="/themes/dark/js/plugins/ui/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="/themes/dark/js/custom.js"></script>
<!--<script type="text/javascript" src="/js/socket.js"></script>-->
<script>
	$(function() {
		$("#leftColumn").sortable({
		    cursorAt: {top: 60},
		    connectWith: ".columns"
		}).disableSelection();
		$("#rightColumn").sortable({
		    cursorAt: {top: 60},
		    connectWith: ".columns"
		}).disableSelection();
	});
</script>
</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            	    <div class="welcome"><a href="#" title=""><img src="/misc/image.php?user=admin" alt="" /></a><span>Howdy, Admin!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="/account/profile/" title=""><img src="/themes/dark/images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <!--<li><a href="#" title=""><img src="/images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>-->
                    <li class="dd"><img src="/themes/dark/images/icons/topnav/messages.png" alt="" /><span>Messages</span>                    </li>
                    <li><a href="/settings/" title=""><img src="/themes/dark/images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="/account/logout.php" title=""><img src="/themes/dark/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
	                <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
<div id="header" class="wrapper">
    <div class="logo"><a href="/" title=""><img src="/themes/dark/images/loginLogo.png" alt="" /></a></div>
    <div class="middleNav">
    	<ul>
            <li class="iCheck"><a href="#" title=""><span>Save</span></a></li>
        </ul>
    </div>
    <div class="fix"></div>
</div>

<!-- Main wrapper -->
<div class="wrapper">

    <!-- Left navigation -->
        <div class="leftNav">
    	<ul id="menu">
	    <li class="home"><a href="/index.php" title=""><span>Home</span></a></li>
	                <li class="dash"><a href="/account/" title="" class="active"><span>Dashboard</span></a></li>
	                <li class="admin"><a href="/admin/" title=""><span>Administration</span></a></li>
	    	    	    <li class="faq"><a href="/faq/" title=""><span>FAQ</span></a></li>
	    <li class="contact"><a href="/contact/" title=""><span>Contact</span></a></li>
	</ul>
    </div>

	<!-- Content -->
    <div class="content" id="container">
    <div class="title"><h5>Layout Testing</h5></div>
	
	<div class="stats">
	    <script>
		var dialogIndex = 0;
		
		function addFeed(index) {
		    var div = document.createElement('div');
		    div.setAttribute('class','formRight searchDrop');
		    div.innerHTML = '<select data-placeholder="Choose a Feed..." class="chzn-select" style="width:250px;" tabindex="2">\
                            <option value=""></option> \
                            <option value="1">Lifehacker</option> \
			    <option value="2">Gizmodo</option> \
                        </select>';
		    document.getElementById('feedList' + index).appendChild(div);
		    $(".chzn-select").chosen();
		}
		function finishFeeds() {
		    
		}
		function dialogFunction() {
		    if (document.getElementById('widgetType').value == "news") {
			var li = document.createElement('li');
			li.setAttribute('class','ui-state-default');
			var fieldset = document.createElement('fieldset');
			var div_widget = document.createElement('div');
			div_widget.setAttribute('class','widget');
			var div_head = document.createElement('div');
			div_head.setAttribute('class','head');
			div_head.innerHTML = "<h5>News</h5>";
			div_widget.appendChild(div_head);
			var div_body = document.createElement('div');
			div_body.setAttribute('class','body');
			div_body.innerHTML = '<form action="" class="mainForm">\
<div class="rowElem noborder">\
                        <label>Feeds:</label>\
			<div id="feedList' + dialogIndex + '">\
                        <div class="formRight searchDrop">\
                        <select data-placeholder="Choose a Feed..." class="chzn-select" style="width:250px;" tabindex="2">\
                            <option value=""></option> \
                            <option value="1">Lifehacker</option> \
			    <option value="2">Gizmodo</option> \
                        </select>\
                        </div>             \
			</div>\
                        <div class="fix"></div>\
                    </div>\
		    <div class="rowElem noborder">\
                        <div class="formRight" style="text-align: right;">\
                            <input type="button" onclick="addFeed(' + dialogIndex + ');" value="Add Feed" class="blueBtn" />\
                            <input type="button" onclick="finishFeeds(' + dialogIndex + ');" value="Finish" class="greenBtn" />\
                        </div>\
                        <div class="fix"></div> \
		    </div>\
</form>';
			div_widget.appendChild(div_body);
			fieldset.appendChild(div_widget);
			li.appendChild(fieldset);
			var div_fix = document.createElement('div');
			div_fix.setAttribute('class','fix');
			li.appendChild(div_fix);
			document.getElementById('leftColumn').appendChild(li);
			$(".chzn-select").chosen();
			
			dialogIndex++;
		    }
		}
	    </script>
		<ul>
		    <div class="uDialog">
                    <div id="dialog-message" title="Add widget">
			<script>
			function getWidgetDescription() {
			    if (document.getElementById('widgetType').value == "news")
				document.getElementById('widgetDesc').innerHTML = "The <b>News</b> item gives you a customized view of news items relevant to you.";
			    else
				document.getElementById('widgetDesc').innerHTML = "";
			}
			</script>
                        <p>Select the type of widget you would like to add: <br /><br /></p>
                        <div class="uiForm">
			    <select id="widgetType" onchange="getWidgetDescription()">
				<option></option>
				<option value="news">News</option>
			    </select>
                        </div>
			<p><br /><br /><div id="widgetDesc"></div></p>
                    </div>
                    <!-- Sample page content to illustrate the layering of the dialog -->
                    <!--<input type="button" value="Usual jQuery UI dialog" class="blueBtn" id="opener" />-->
		    <li class="last"><a href="#" class="count orange" title="" id="opener">&nbsp;+&nbsp;</a><span>add widget</span></li>
		    </div>
		</ul>
		<div class="fix"></div>
	</div>

    <div class="widgets"><div class="left">
	<ul id="leftColumn" class="columns" style="padding: 1px; padding-bottom: 200px;">
	</ul>
<div class="fix"></div></div>
<div class="right">
    <ul id="rightColumn" class="columns" style="padding: 1px; padding-bottom: 200px;">
    </ul>
<div class="fix"></div></div>
</div>
</div>
</div>
<!-- Footer -->
<div id="footer">
	<div class="wrapper">
    	<span>Copyright &copy; 2012 <a href="http://company.newsfeeder.co">News Feeder Co.</a>, all rights reserved.</span>
    </div>
</div>

</body>
</html>
