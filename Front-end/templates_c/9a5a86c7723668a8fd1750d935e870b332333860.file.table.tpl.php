<?php /* Smarty version Smarty-3.1.8, created on 2012-07-10 12:47:15
         compiled from "/var/www/templates/table.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19731908484f70f429d93968-54354192%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a5a86c7723668a8fd1750d935e870b332333860' => 
    array (
      0 => '/var/www/templates/table.tpl',
      1 => 1341922063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19731908484f70f429d93968-54354192',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f70f429ddefe0_20567821',
  'variables' => 
  array (
    'headers' => 0,
    'header' => 0,
    'data' => 0,
    'rowitem' => 0,
    'dataitem' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f70f429ddefe0_20567821')) {function content_4f70f429ddefe0_20567821($_smarty_tpl) {?><table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
	<tr>
	    <?php  $_smarty_tpl->tpl_vars['header'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['header']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['headers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['header']->key => $_smarty_tpl->tpl_vars['header']->value){
$_smarty_tpl->tpl_vars['header']->_loop = true;
?>
	    <th><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</th>
	    <?php } ?>
	</tr>
    </thead>
    <tbody>
	<?php  $_smarty_tpl->tpl_vars['rowitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rowitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rowitem']->key => $_smarty_tpl->tpl_vars['rowitem']->value){
$_smarty_tpl->tpl_vars['rowitem']->_loop = true;
?>
	<tr class="gradeA">
	    <?php  $_smarty_tpl->tpl_vars['dataitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dataitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rowitem']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dataitem']->key => $_smarty_tpl->tpl_vars['dataitem']->value){
$_smarty_tpl->tpl_vars['dataitem']->_loop = true;
?>
	    <td><?php echo $_smarty_tpl->tpl_vars['dataitem']->value;?>
</td>
	    <?php } ?>
	</tr>
	<?php } ?>
	</tr>
    </tbody>
</table><?php }} ?>