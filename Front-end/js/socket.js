function sendSocketAction(command)
{
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		    if (command=="status") {
			if (xmlhttp.responseText=="running")
			    document.getElementById("connectaction").innerHTML='<p><img src="/images/icons/color/thumb-up.png" /> <b>Crawler is up</b></p>';
			else
			    document.getElementById("connectaction").innerHTML='<p><img src="/images/icons/color/thumb.png" /> <b>Crawler is down</b></p>';
			document.getElementById("serveractions").style.display = "block";
		    } else if (command=="start") {
			if (xmlhttp.responseText=="success") {
			    $.jGrowl('Crawler started successfully');
			    document.getElementById("connectaction").innerHTML='<p><img src="/images/icons/color/thumb-up.png" /> <b>Crawler is up</b></p>';
			} else
			    $.jGrowl('Crawler failed to start');
		    } else if (command=="stop") {
			if (xmlhttp.responseText=="success") {
			    $.jGrowl('Crawler stopped successfully');
			    document.getElementById("connectaction").innerHTML='<p><img src="/images/icons/color/thumb.png" /> <b>Crawler is down</b></p>';
			} else
			    $.jGrowl('Crawler failed to stop');
		    } else if (command=="restart") {
			if (xmlhttp.responseText=="success") {
			    $.jGrowl('Crawler restarted successfully');
			    document.getElementById("connectaction").innerHTML='<p><img src="/images/icons/color/thumb-up.png" /> <b>Crawler is up</b></p>';
			} else
			    $.jGrowl('Crawler failed to restart');
		    }
		}
	}
	xmlhttp.open("GET","/admin/servicecall.php?command=" + command,true);
	xmlhttp.send();
}