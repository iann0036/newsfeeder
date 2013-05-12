<?php /* Smarty version Smarty-3.1.8, created on 2012-07-12 17:11:33
         compiled from "/var/www/templates/root.members.register.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1731561104f7188c644cc99-86344360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e2ea05b2920ec0c3597a1f55169a5c30574cc53' => 
    array (
      0 => '/var/www/templates/root.members.register.index.tpl',
      1 => 1341922062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1731561104f7188c644cc99-86344360',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f7188c64b5fd7_57684335',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f7188c64b5fd7_57684335')) {function content_4f7188c64b5fd7_57684335($_smarty_tpl) {?><?php if (!is_callable('smarty_block_form')) include '/var/www/classes/thirdparty/smarty/plugins/block.form.php';
if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Register'), 0);?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('action'=>'/members/register/index.php','method'=>'POST','enctype'=>'multipart/form-data')); $_block_repeat=true; echo smarty_block_form(array('action'=>'/members/register/index.php','method'=>'POST','enctype'=>'multipart/form-data'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Register an Account','class'=>'iPencil','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Register an Account','class'=>'iPencil','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	    <div class="rowElem noborder">
		<label>Name:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="name" id="name"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
		<label>Username:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="username" id="username"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
                    <label for="password">Password:</label>
                    <div class="formRight">
			<input type="password" class="validate[required]" name="password" id="password" />
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
		<label>Profile Photo:</label> 
		<div class="formRight">
		    <input type="file" class="fileInput" id="photo" name="photo" />
		</div>
		<div class="fix"></div>
	    </div>
	    <input type="submit" value="Register Account" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Register an Account','class'=>'iPencil','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('action'=>'/members/register/index.php','method'=>'POST','enctype'=>'multipart/form-data'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>