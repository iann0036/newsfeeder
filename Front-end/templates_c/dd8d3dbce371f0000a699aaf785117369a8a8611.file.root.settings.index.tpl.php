<?php /* Smarty version Smarty-3.1.8, created on 2012-09-16 14:36:08
         compiled from "/var/www/templates/root.settings.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8174789934f730ab5222074-69306162%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd8d3dbce371f0000a699aaf785117369a8a8611' => 
    array (
      0 => '/var/www/templates/root.settings.index.tpl',
      1 => 1347806003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8174789934f730ab5222074-69306162',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f730ab526d776_64029406',
  'variables' => 
  array (
    'protocol' => 0,
    'layout' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f730ab526d776_64029406')) {function content_4f730ab526d776_64029406($_smarty_tpl) {?><?php if (!is_callable('smarty_block_form')) include '/var/www/classes/thirdparty/smarty/plugins/block.form.php';
if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Settings'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('action'=>'/settings/update.php','method'=>'POST')); $_block_repeat=true; echo smarty_block_form(array('action'=>'/settings/update.php','method'=>'POST'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Account Settings','class'=>'iSettings2','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Account Settings','class'=>'iSettings2','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<div class="rowElem noborder">
	    <label>Secure Browsing: </label>
	    <div class="formRight">
		<input type="checkbox" id="ssl" name="ssl"<?php if ($_smarty_tpl->tpl_vars['protocol']->value=='https://'){?> checked="checked"<?php }?> /><label for="ssl">Enable SSL</label>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem">
	    <label>Layout: </label>
	    <div class="formRight">
		<input type="checkbox" id="layout" name="layout"<?php if ($_smarty_tpl->tpl_vars['layout']->value=='dark'){?> checked="checked"<?php }?> /><label for="layout">Use Dark Layout</label>
	    </div>
	    <div class="fix"></div>
	</div>
	<input type="submit" value="Update Settings" class="greyishBtn submitForm" />
	<div class="fix"></div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Account Settings','class'=>'iSettings2','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('action'=>'/settings/update.php','method'=>'POST'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>