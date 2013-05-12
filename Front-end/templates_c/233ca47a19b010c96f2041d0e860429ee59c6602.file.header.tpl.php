<?php /* Smarty version Smarty-3.1.8, created on 2012-09-20 20:10:02
         compiled from "/var/www/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18076900394f70e7383c2bd7-70721697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '233ca47a19b010c96f2041d0e860429ee59c6602' => 
    array (
      0 => '/var/www/templates/header.tpl',
      1 => 1348132197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18076900394f70e7383c2bd7-70721697',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f70e738567aa4_20534670',
  'variables' => 
  array (
    'title' => 0,
    'dark' => 0,
    'pagename' => 0,
    'loginpage' => 0,
    'message' => 0,
    'username' => 0,
    'realname' => 0,
    'notifications' => 0,
    'notification' => 0,
    'nonav' => 0,
    'isAdmin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f70e738567aa4_20534670')) {function content_4f70e738567aa4_20534670($_smarty_tpl) {?><?php if (!is_callable('smarty_function_init')) include '/var/www/classes/thirdparty/smarty/plugins/function.init.php';
if (!is_callable('smarty_modifier_capitalize')) include '/var/www/classes/thirdparty/smarty/plugins/modifier.capitalize.php';
?><?php echo smarty_function_init(array(),$_smarty_tpl);?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="zF5-ebug9_0x8gROtVdJ35eV_h8PPFpxwGmjcy7uOgQ" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? "News Feeder" : $tmp);?>
</title>

<link href="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/css/main.css" rel="stylesheet" type="text/css" />
<link href='/css/css.css?family=Cuprum' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="/js/jquery-ui.min.js"></script> 

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/flot/excanvas.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/flot/jquery.flot.resize.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/tables/colResizable.min.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/forms.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/autotab.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/forms/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/other/calendar.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/other/elfinder.min.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.colorpicker.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/wizards/jquery.validate.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.ToTop.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.listnav.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/plugins/ui/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/custom.js"></script>
<script type="text/javascript" src="/js/socket.js"></script>
<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Administration'){?>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/charts/chart.js"></script>
<script type="text/javascript" src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/js/densityChart.js"></script>
<?php }?>
</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
<?php if ($_smarty_tpl->tpl_vars['loginpage']->value){?>
            <div class="backTo"><a href="/index.php" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/mainWebsite.png" alt="" /><span>Main website</span></a></div>
            <div class="userNav">
                <ul>
                    <li><a href="/members/register/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/register.png" alt="" /><span>Register</span></a></li>
                    <li><a href="/contact/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/contactAdmin.png" alt="" /><span>Contact admin</span></a></li>
                    <li><a href="/faq/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/help.png" alt="" /><span>Help</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Login form area -->
<div class="loginWrapper">
	<div class="loginLogo"><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/loginLogo.png" alt="" /></div>
    <?php if ($_smarty_tpl->tpl_vars['message']->value){?>
    <div class="nNote n<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['message']->value['type']);?>
 hideit">
	<p><strong><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['message']->value['type'], 'UTF-8');?>
: </strong><?php echo $_smarty_tpl->tpl_vars['message']->value['text'];?>
</p>
    </div>
    <?php }?>
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
<?php }else{ ?>
            <?php if (isset($_smarty_tpl->tpl_vars['username']->value)){?>
	    <div class="welcome"><a href="#" title=""><img src="/misc/image.php?user=<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" alt="" /></a><span>Howdy, <?php echo $_smarty_tpl->tpl_vars['realname']->value;?>
!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="/account/profile/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <!--<li><a href="#" title=""><img src="/images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>-->
                    <li class="dd"><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/messages.png" alt="" /><span>Messages</span><?php if ($_smarty_tpl->tpl_vars['notifications']->value){?><span class="numberTop"><?php echo count($_smarty_tpl->tpl_vars['notifications']->value);?>
</span>
			<ul class="menu_body">
			<?php  $_smarty_tpl->tpl_vars['notification'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['notification']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notifications']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['notification']->key => $_smarty_tpl->tpl_vars['notification']->value){
$_smarty_tpl->tpl_vars['notification']->_loop = true;
?>
                            <li><a href="/account/view.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['notification']->value['sheetid'];?>
" title="" class="sAdd">The sheet '<?php echo $_smarty_tpl->tpl_vars['notification']->value['name'];?>
' has been updated</a></li>
			<?php } ?>
                        </ul>
			<?php }?>
                    </li>
                    <li><a href="/settings/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="/account/logout.php" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
	    <?php }else{ ?>
	    <div class="welcome"><a href="#" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/userPic.png" alt="" /></a><span>Howdy, Guest!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="/members/login/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/icons/topnav/mainWebsite.png" alt="" /><span>Login</span></a></li>
                </ul>
            </div>
	    <?php }?>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
<?php if (!$_smarty_tpl->tpl_vars['nonav']->value){?>
<div id="header" class="wrapper">
    <div class="logo"><a href="/" title=""><img src="<?php if ($_smarty_tpl->tpl_vars['dark']->value){?>/themes/dark<?php }?>/images/loginLogo.png" alt="" /></a></div>
    <div id="middleNav" class="middleNav">
    </div>
    <div class="fix"></div>
</div>
<?php }?>

<!-- Main wrapper -->
<div class="wrapper">

    <!-- Left navigation -->
    <?php if (!$_smarty_tpl->tpl_vars['nonav']->value){?>
    <div class="leftNav">
    	<ul id="menu">
	    <li class="home"><a href="/index.php" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Home'){?> class="active"<?php }?>><span>Home</span></a></li>
	    <?php if ($_smarty_tpl->tpl_vars['username']->value){?>
            <li class="dash"><a href="/account/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Dashboard'){?> class="active"<?php }?>><span>Dashboard</span></a></li>
	    <li class="feeds"><a href="/account/feeds/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Manage Feeds'){?> class="active"<?php }?>><span>Feeds</span></a></li>
	    <?php if ($_smarty_tpl->tpl_vars['isAdmin']->value){?>
            <li class="admin"><a href="/admin/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Administration'){?> class="active"<?php }?>><span>Administration</span></a></li>
	    <?php }?>
	    <?php }?>
	    <li class="faq"><a href="/faq/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='FAQ'){?> class="active"<?php }?>><span>FAQ</span></a></li>
	    <li class="abuse"><a href="/abuse/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Abuse'){?> class="active"<?php }?>><span>Abuse</span></a></li>
	    <li class="contact"><a href="/contact/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Contact'){?> class="active"<?php }?>><span>Contact</span></a></li>
	</ul>
    </div>

	<!-- Content -->
    <div class="content" id="container">
    <div class="title"><h5><?php echo $_smarty_tpl->tpl_vars['pagename']->value;?>
</h5></div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['message']->value){?>
    <div class="pt20">
	<div class="nNote n<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['message']->value['type']);?>
 hideit">
	    <p><strong><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['message']->value['type'], 'UTF-8');?>
: </strong><?php echo $_smarty_tpl->tpl_vars['message']->value['text'];?>
</p>
	</div>
    </div>
    <?php }?>
<?php }?>
<?php }} ?>