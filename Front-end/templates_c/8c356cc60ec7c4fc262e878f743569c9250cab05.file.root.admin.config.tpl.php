<?php /* Smarty version Smarty-3.1.8, created on 2012-07-21 12:11:44
         compiled from "/var/www/templates/root.admin.config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2823645434f968f935e9e25-70394444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c356cc60ec7c4fc262e878f743569c9250cab05' => 
    array (
      0 => '/var/www/templates/root.admin.config.tpl',
      1 => 1341922059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2823645434f968f935e9e25-70394444',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f968f93645cc5_46597370',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f968f93645cc5_46597370')) {function content_4f968f93645cc5_46597370($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Administration'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Server Configuration','class'=>'iSettings')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Server Configuration','class'=>'iSettings'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<form action="" class="mainForm">
<fieldset>
<div class="rowElem noborder">
    <label>Log File Location:</label>
    <div class="formRight">
	<input type="text" name="inputtext"/>
	<a href="#" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/pencil.png" alt="" class="icon" /><span>Update Setting</span></a>
    </div>
    <div class="fix"></div>
</div>
</fieldset>
</form>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Server Configuration','class'=>'iSettings'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>