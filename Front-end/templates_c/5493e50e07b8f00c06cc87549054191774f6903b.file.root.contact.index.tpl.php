<?php /* Smarty version Smarty-3.1.8, created on 2012-07-11 10:29:36
         compiled from "/var/www/templates/root.contact.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9293923804f71690bcb6a09-06835652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5493e50e07b8f00c06cc87549054191774f6903b' => 
    array (
      0 => '/var/www/templates/root.contact.index.tpl',
      1 => 1342002571,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9293923804f71690bcb6a09-06835652',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f71690bd85509_52880753',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f71690bd85509_52880753')) {function content_4f71690bd85509_52880753($_smarty_tpl) {?><?php if (!is_callable('smarty_block_left_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.left_widgets.php';
if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
if (!is_callable('smarty_function_mailto')) include '/var/www/classes/thirdparty/smarty/plugins/function.mailto.php';
if (!is_callable('smarty_block_right_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.right_widgets.php';
if (!is_callable('smarty_block_form')) include '/var/www/classes/thirdparty/smarty/plugins/block.form.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Contact'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('left_widgets', array()); $_block_repeat=true; echo smarty_block_left_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Contact Information','class'=>'iUsers')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Contact Information','class'=>'iUsers'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.au/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Wollongong+University,+Northfields+Ave,+University+of+Wollongong+NSW&amp;aq=t&amp;sll=-32.342841,147.32666&amp;sspn=10.073408,21.643066&amp;ie=UTF8&amp;hq=Wollongong+University,+Northfields+Ave,+University+of&amp;hnear=Wollongong+New+South+Wales&amp;t=m&amp;cid=2886925379413737025&amp;ll=-34.404714,150.885544&amp;spn=0.038453,0.084543&amp;output=embed"></iframe><br />
    <p><b>Address: </b>News Feeder Co<br />
		    Bld 3, Northfields Ave<br />
		    University of Wollongong NSW 2522</p>
    <p><b>E-mail: </b><?php echo smarty_function_mailto(array('address'=>"support@newsfeeder.co",'text'=>"support@newsfeeder.co"),$_smarty_tpl);?>
</p>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Contact Information','class'=>'iUsers'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_left_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('right_widgets', array()); $_block_repeat=true; echo smarty_block_right_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('action'=>'/contact/index.php','method'=>'POST')); $_block_repeat=true; echo smarty_block_form(array('action'=>'/contact/index.php','method'=>'POST'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Contact Form','class'=>'iDoc','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Contact Form','class'=>'iDoc','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	    <div class="rowElem noborder">
		<label>Name:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="name" id="name"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
		<label>E-mail:</label>
		<div class="formRight">
		    <input type="text" class="validate[required,custom[email]]" name="email" id="email"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
		<label>Message:</label>
		<div class="formRight">
		    <textarea rows="8" cols="" name="message" class="validate[required]" id="message"></textarea>
		</div>

		<div class="fix"></div>
	    </div>
	    <input type="submit" value="Send Message" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Contact Form','class'=>'iDoc','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('action'=>'/contact/index.php','method'=>'POST'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_right_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>