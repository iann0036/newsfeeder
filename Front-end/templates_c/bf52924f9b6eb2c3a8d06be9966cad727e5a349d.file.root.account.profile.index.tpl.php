<?php /* Smarty version Smarty-3.1.8, created on 2012-07-10 13:39:25
         compiled from "/var/www/templates/root.account.profile.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19426739644f712cbb2cbd88-05551258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf52924f9b6eb2c3a8d06be9966cad727e5a349d' => 
    array (
      0 => '/var/www/templates/root.account.profile.index.tpl',
      1 => 1341922058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19426739644f712cbb2cbd88-05551258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f712cbb310924_51954214',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f712cbb310924_51954214')) {function content_4f712cbb310924_51954214($_smarty_tpl) {?><?php if (!is_callable('smarty_block_form')) include '/var/www/classes/thirdparty/smarty/plugins/block.form.php';
if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Profile'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('action'=>'/account/profile/update.php','method'=>'POST')); $_block_repeat=true; echo smarty_block_form(array('action'=>'/account/profile/update.php','method'=>'POST'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Profile Information','class'=>'iFiles','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Profile Information','class'=>'iFiles','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<div class="rowElem" noborder>
	    <label>Username:</label>
	    <div class="formRight">
		<input type="text" disabled="disabled" value="admin" name="username"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Password:</label>
	    <div class="formRight">
		<input type="password" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Confirm password:</label>
	    <div class="formRight">
		<input type="password" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Name:</label>
	    <div class="formRight">
		<input type="text" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>E-mail:</label>
	    <div class="formRight">
		<input type="text" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Profile&nbsp;Picture:</label> 
	    <div class="formRight">
		<input type="file" class="fileInput" id="fileInput" name="opml" />
	    </div>
	    <div class="fix"></div>
	</div>
	<input type="submit" value="Update Profile" class="greyishBtn submitForm" />
	<div class="fix"></div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Profile Information','class'=>'iFiles','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('action'=>'/account/profile/update.php','method'=>'POST'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>