{init}
{*assign var="dark" value="false"*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="zF5-ebug9_0x8gROtVdJ35eV_h8PPFpxwGmjcy7uOgQ" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>{$title|default:"News Feeder"}</title>

<link href="{if $dark}/themes/dark{/if}/css/main.css" rel="stylesheet" type="text/css" />
<link href='/css/css.css?family=Cuprum' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="/js/jquery.min.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="/js/jquery-ui.min.js"></script> 

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/flot/jquery.flot.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/flot/excanvas.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/flot/jquery.flot.resize.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/tables/colResizable.min.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/forms.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/autotab.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/forms/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/other/calendar.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/other/elfinder.min.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.colorpicker.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/wizards/jquery.validate.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.ToTop.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.listnav.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/plugins/ui/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/custom.js"></script>
<script type="text/javascript" src="/js/socket.js"></script>
{if $pagename eq 'Administration'}
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/charts/chart.js"></script>
<script type="text/javascript" src="{if $dark}/themes/dark{/if}/js/densityChart.js"></script>
{/if}
</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
{if $loginpage}
            <div class="backTo"><a href="/index.php" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/mainWebsite.png" alt="" /><span>Main website</span></a></div>
            <div class="userNav">
                <ul>
                    <li><a href="/members/register/" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/register.png" alt="" /><span>Register</span></a></li>
                    <li><a href="/contact/" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/contactAdmin.png" alt="" /><span>Contact admin</span></a></li>
                    <li><a href="/faq/" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/help.png" alt="" /><span>Help</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Login form area -->
<div class="loginWrapper">
	<div class="loginLogo"><img src="{if $dark}/themes/dark{/if}/images/loginLogo.png" alt="" /></div>
    {if $message}
    <div class="nNote n{$message.type|capitalize} hideit">
	<p><strong>{$message.type|upper}: </strong>{$message.text}</p>
    </div>
    {/if}
    <div class="loginPanel">
        <div class="head"><h5 class="iUser">Login</h5></div>
        <form action="/account/" method="post" id="valid" class="mainForm">
            <fieldset>
                <div class="loginRow noborder">
                    <label for="username">Username:</label>
                    <div class="loginInput"><input type="text" name="login_username" class="validate[required]" id="username" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <label for="password">Password:</label>
                    <div class="loginInput"><input type="password" name="login_password" class="validate[required]" id="password" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <div class="rememberMe"><input type="checkbox" id="remember" name="remember" /><label for="remember">Remember me</label></div>
                    <input type="submit" value="Log me in" class="greyishBtn submitForm" />
                    <div class="fix"></div>
                </div>
            </fieldset>
        </form>
    </div>
{else}
            {if isset($username)}
	    <div class="welcome"><a href="#" title=""><img src="/misc/image.php?user={$username}" alt="" /></a><span>Howdy, {$realname}!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="/account/profile/" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <!--<li><a href="#" title=""><img src="/images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>-->
                    <li class="dd"><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/messages.png" alt="" /><span>Messages</span>{if $notifications}<span class="numberTop">{$notifications|@count}</span>
			<ul class="menu_body">
			{foreach from=$notifications item=notification}
                            <li><a href="/account/view.php?sheetid={$notification.sheetid}" title="" class="sAdd">The sheet '{$notification.name}' has been updated</a></li>
			{/foreach}
                        </ul>
			{/if}
                    </li>
                    <li><a href="/settings/" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="/account/logout.php" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
	    {else}
	    <div class="welcome"><a href="#" title=""><img src="{if $dark}/themes/dark{/if}/images/userPic.png" alt="" /></a><span>Howdy, Guest!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="/members/login/" title=""><img src="{if $dark}/themes/dark{/if}/images/icons/topnav/mainWebsite.png" alt="" /><span>Login</span></a></li>
                </ul>
            </div>
	    {/if}
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
{if !$nonav}
<div id="header" class="wrapper">
    <div class="logo"><a href="/" title=""><img src="{if $dark}/themes/dark{/if}/images/loginLogo.png" alt="" /></a></div>
    <div id="middleNav" class="middleNav">
    </div>
    <div class="fix"></div>
</div>
{/if}

<!-- Main wrapper -->
<div class="wrapper">

    <!-- Left navigation -->
    {if !$nonav}
    <div class="leftNav">
    	<ul id="menu">
	    <li class="home"><a href="/index.php" title=""{if $pagename eq 'Home'} class="active"{/if}><span>Home</span></a></li>
	    {if $username}
            <li class="dash"><a href="/account/" title=""{if $pagename eq 'Dashboard'} class="active"{/if}><span>Dashboard</span></a></li>
	    <li class="feeds"><a href="/account/feeds/" title=""{if $pagename eq 'Manage Feeds'} class="active"{/if}><span>Feeds</span></a></li>
	    {if $isAdmin}
            <li class="admin"><a href="/admin/" title=""{if $pagename eq 'Administration'} class="active"{/if}><span>Administration</span></a></li>
	    {/if}
	    {/if}
	    <li class="faq"><a href="/faq/" title=""{if $pagename eq 'FAQ'} class="active"{/if}><span>FAQ</span></a></li>
	    <li class="abuse"><a href="/abuse/" title=""{if $pagename eq 'Abuse'} class="active"{/if}><span>Abuse</span></a></li>
	    <li class="contact"><a href="/contact/" title=""{if $pagename eq 'Contact'} class="active"{/if}><span>Contact</span></a></li>
	</ul>
    </div>

	<!-- Content -->
    <div class="content" id="container">
    <div class="title"><h5>{$pagename}</h5></div>
    {/if}
    {if $message}
    <div class="pt20">
	<div class="nNote n{$message.type|capitalize} hideit">
	    <p><strong>{$message.type|upper}: </strong>{$message.text}</p>
	</div>
    </div>
    {/if}
{/if}
