<?php
	/*
	File name: /classes/GUIMaker.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Allows a single place to change generic page source
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/SheetCollection.php';
	
	if (!isset($_SESSION)) // start session only if not already started
		session_start();

	/**
	 * Allows a single place to change generic page source
	 * 
	 * <code>
	 * $gui = new GUIMaker();
	 * 
	 * $gui->header(false,true,3);
	 * $gui->user_details();
	 * $gui->navigation(2);
	 * $gui->footer();
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class GUIMaker {
		/**
		 * An instance of a user
		 * @var User
		 */
		private $user;
	
		/**
		 * Initializes GUIMaker class, determines user
		 */
		public function __construct() {
			$this->user = new User();
		}
		
		/**
		 * Outputs the first parts of the webpage to the users browser
		 * @param int $view if set, uses appropriate sheet viewing style
		 * @param boolean $search if true, initiates AJAX request
		 * @param int $sheetid the id of the sheet, used for the AJAX request
		 */
		public function header($view = false, $search = false, $sheetid = null) {
			echo <<< BLOCK
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>News Feeder</title>	
	<link rel="stylesheet" href="/css/screen.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="/css/plugin.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="/css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
BLOCK;
			if ($this->user->isAltDesign())
				echo '<link rel="stylesheet" href="/css/black/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />';
			if ($view==1)
				echo '<link rel="stylesheet" href="/account/view.css" type="text/css" media="screen" title="no title" charset="utf-8" />';
			echo <<< BLOCK
			
	<style type="text/css" media="screen">
		
	</style>
BLOCK;
			if ($search)
			    echo <<< BLOCK
	<script type="text/javascript">
	function loadResults(term) {
		var xmlhttp;
		if (window.XMLHttpRequest)
		    xmlhttp=new XMLHttpRequest();
		else
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function() {
		    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		        document.getElementById("results").innerHTML=xmlhttp.responseText;
			if (xmlhttp.responseText.charAt(xmlhttp.responseText.length-2)!='b')    
			    loadResults(term);
		    }
		}
		xmlhttp.open("GET","ajax.php?sheetid=$sheetid&term=" + term,true);
		xmlhttp.send();
	}
	</script>
BLOCK;
			echo <<< BLOCK
</head>

<body
BLOCK;
			if ($search)
			    echo ' onload="loadResults(\''.$search.'\')"';
			echo '>';
?>
	<div id="wrapper" class="clearfix">
		<div id="top">
		<div id="header">
			<h1><a href="http://<?php echo HOST; ?>">News Feeder</a></h1>
<?php
		}
		
		/**
		 * Outputs the user details part of the webpage to the users browser
		 */
		public function user_details() {
			if ($this->user->validUser()) {
				echo <<< BLOCK
				<div id="info">
				<h4>Welcome 
BLOCK;
				echo $this->user->getName();
				echo <<< BLOCK
</h4>
				<p>
					Logged in as User
					<br />
					<a href="/account/profile/">Profile</a> | <a href="/account/logout.php">Log Out</a>
				</p>
				<img src="/misc/image.php?user=
BLOCK;
				echo $this->user->getUsername();
				echo <<< BLOCK
" alt="avatar" />
			</div>
		</div>
BLOCK;
			} else
				echo <<< BLOCK
				<div id="info">
				<h4>Welcome Guest</h4>
				
				<p>
					<a href="/members/login/">Login</a>
					<br />
					<a href="/members/register/">Register</a>
				</p>
				
				<img src="/images/avatar.jpg" alt="avatar" />
			</div>
		</div>
BLOCK;
		}
		
		/**
		 * Outputs the navigation part of the webpage to the users browser
		 * @param int $menu which menu is currently active (optional)
		 */
		public function navigation($menu = 0) {
			echo <<< BLOCK
		<div id="nav">	
			<ul class="mega-container mega-grey">
				<li class="mega
BLOCK;
			if ($menu==1)
				echo ' mega-current';
			echo <<< BLOCK
">
					<a href="/index.php" class="mega-link">Home</a>	
				</li>
BLOCK;
			if ($this->user->validUser()) {
				echo <<< BLOCK
				<li class="mega
BLOCK;
				if ($menu==2)
					echo ' mega-current'; /* Sheets redirects to Dashboard, will never be selected */
				echo <<< BLOCK
">
					<a href="/account/" class="mega-link">Dashboard</a>	
				</li>
				<li class="mega">
					<a href="/account/" class="mega-tab">
						Sheets
					</a>
					<div class="mega-content mega-menu ">
						<ul>
BLOCK;
				$sheets = new SheetCollection();
				while ($sheets->more(5)) { // the parameter of more() represents how many to show in nav
					$sheet = $sheets->next();
					echo '<li><a href="/account/view.php?sheetid='.$sheet['id'].'">'.$sheet['name'].'</a></li>
						';
				}
				echo <<< BLOCK
						</ul>
					</div>	
				</li>
BLOCK;
			}
			echo <<< BLOCK
				<li class="mega
BLOCK;
			if ($menu==5)
				echo ' mega-current';
			echo <<< BLOCK
">
					<a href="/faq/" class="mega-link">FAQ</a>	
				</li>
BLOCK;
			echo <<< BLOCK
				<li class="mega
BLOCK;
			if ($menu==4)
				echo ' mega-current';
			echo <<< BLOCK
">
					<a href="/contact/" class="mega-link">Contact</a>	
				</li>
BLOCK;
			if ($this->user->isAdmin()) {
				echo <<< BLOCK
				<li class="mega
BLOCK;
				if ($menu==6)
					echo ' mega-current';
				echo <<< BLOCK
">
					<a href="/admin/" class="mega-link">Administration</a>	
				</li>
BLOCK;
			}
			echo <<< BLOCK
			</ul>
		</div>

BLOCK;
		}
		
		/**
		 * Outputs the footer part of the webpage to the users browser
		 * @param boolean $faq if set, write javascript to make FAQ effects
		 */
		public function footer($faq = false) {
			echo '<div id="footer">';
			echo COPYRIGHT_STRING;
			echo <<< BLOCK
			</div>
	</div>
	<script type="text/javascript" src="/js/jquery/jquery.1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/slate/slate.js"></script>
	<script type="text/javascript" src="/js/slate/slate.portlet.js"></script>
	<script type="text/javascript" src="/js/plugin.js"></script>
	<script type="text/javascript" charset="utf-8">
	$(function ()
	{
		slate.init();
		slate.portlet.init();	
	});
	</script>
BLOCK;
			if ($faq)
				echo <<< BLOCK
<script type="text/javascript" charset="utf-8">
$(function () 
{
	$('input#search_term').quicksearch('.portlet ul li',
	{		
		loader: 'span.loader'
		, onBefore: function ()
		{
			$('.answer').hide ();
		}			
		, noResults: '#no_results'
	});

	$('#search-bar form').live ('submit' , function () { return false; });
	$('.faq .answer').hide ();	
	$('.faq h3 a').live ('click' , function () { $(this).parent ().next ('.answer').slideToggle (); });
});
</script>
BLOCK;
			echo <<< BLOCK
	</body>
</html>
BLOCK;
		}
	}
?>