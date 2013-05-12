<?php /* Smarty version Smarty-3.1.8, created on 2012-03-26 12:17:17
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2391417784f704bfc558e82-19244391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1332764094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2391417784f704bfc558e82-19244391',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f704bfc5af794_73708374',
  'variables' => 
  array (
    'title' => 0,
    'loginform' => 0,
    'username' => 0,
    'realname' => 0,
    'pagename' => 0,
    'isAdmin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f704bfc5af794_73708374')) {function content_4f704bfc5af794_73708374($_smarty_tpl) {?><?php if (!is_callable('smarty_function_init')) include '/var/www/classes/thirdparty/smarty/plugins/function.init.php';
?><?php echo smarty_function_init(array(),$_smarty_tpl);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? "News Feeder" : $tmp);?>
</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.4.4.js" type="text/javascript"></script>

<script type="text/javascript" src="js/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

<script type="text/javascript" src="js/fileManager/elfinder.min.js"></script>

<script type="text/javascript" src="js/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="js/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="js/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/flot/excanvas.min.js"></script>

<script type="text/javascript" src="js/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/dataTables/colResizable.min.js"></script>

<script type="text/javascript" src="js/forms/forms.js"></script>
<script type="text/javascript" src="js/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/forms/autotab.js"></script>
<script type="text/javascript" src="js/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/forms/jquery.filestyle.js"></script>

<script type="text/javascript" src="js/colorPicker/colorpicker.js"></script>

<script type="text/javascript" src="js/uploader/plupload.js"></script>
<script type="text/javascript" src="js/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/ui/progress.js"></script>
<script type="text/javascript" src="js/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/ui/jquery.alerts.js"></script>

<script type="text/javascript" src="js/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="js/wizards/jquery.smartWizard.min.js"></script>

<script type="text/javascript" src="js/jBreadCrumb.1.1.js"></script>
<script type="text/javascript" src="js/cal.min.js"></script>
<script type="text/javascript" src="js/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/jquery.ToTop.js"></script>
<script type="text/javascript" src="js/jquery.listnav.js"></script>
<script type="text/javascript" src="js/jquery.sourcerer.js"></script>
<script type="text/javascript" src="js/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="js/custom.js"></script>

</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
<?php if ($_smarty_tpl->tpl_vars['loginform']->value){?>
            <div class="backTo"><a href="/index.php" title=""><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Main website</span></a></div>
            <div class="userNav">
                <ul>
                    <li><a href="/members/register/" title=""><img src="images/icons/topnav/register.png" alt="" /><span>Register</span></a></li>
                    <li><a href="/contact/" title=""><img src="images/icons/topnav/contactAdmin.png" alt="" /><span>Contact admin</span></a></li>
                    <li><a href="/faq/" title=""><img src="images/icons/topnav/help.png" alt="" /><span>Help</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Login form area -->
<div class="loginWrapper">
	<div class="loginLogo"><img src="images/loginLogo.png" alt="" /></div>
    <div class="loginPanel">
        <div class="head"><h5 class="iUser">Login</h5></div>
        <form action="/account/" id="valid" class="mainForm">
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
                    <li><a href="/account/profile/" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <li><a href="#" title=""><img src="images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                    <li class="dd"><img src="images/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop">8</span>
                        <ul class="menu_body">
                            <li><a href="#" title="">new message</a></li>
                            <li><a href="#" title="">inbox</a></li>
                            <li><a href="#" title="">outbox</a></li>
                            <li><a href="#" title="">trash</a></li>
                        </ul>
                    </li>
                    <li><a href="#" title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="/account/logout.php" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
	    <?php }else{ ?>
	    <div class="welcome"><a href="#" title=""><img src="/images/userPic.png" alt="" /></a><span>Howdy, Guest!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="/members/login/" title=""><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Login</span></a></li>
                </ul>
            </div>
	    <?php }?>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
<div id="header" class="wrapper">
    <div class="logo"><a href="/" title=""><img src="images/loginLogo.png" alt="" /></a></div>
    <div class="middleNav">
    </div>
    <div class="fix"></div>
</div>

<!-- Main wrapper -->
<div class="wrapper">

	<!-- Left navigation -->
    <div class="leftNav">
    	<ul id="menu">
	    <li class="home"><a href="/index.php" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Home'){?> class="active"<?php }?>><span>Home</span></a></li>
	    <?php if (isset($_smarty_tpl->tpl_vars['username']->value)){?>
            <li class="dash"><a href="/account/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Dashboard'){?> class="active"<?php }?>><span>Dashboard</span></a></li>
	    <?php if ($_smarty_tpl->tpl_vars['isAdmin']->value){?>
            <li class="admin"><a href="/admin/" title=""<?php if ($_smarty_tpl->tpl_vars['pagename']->value=='Administration'){?> class="active"<?php }?>><span>Administration</span></a></li>
	    <?php }?>
	    <?php }?>
        </ul>
    </div>

	<!-- Content -->
    <div class="content" id="container">
    	<div class="title"><h5><?php echo $_smarty_tpl->tpl_vars['pagename']->value;?>
</h5></div>
<?php }?><?php }} ?>