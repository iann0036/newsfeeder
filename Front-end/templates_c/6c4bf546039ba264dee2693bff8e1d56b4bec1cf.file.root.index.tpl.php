<?php /* Smarty version Smarty-3.1.8, created on 2012-03-26 12:33:05
         compiled from "./templates/root.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18368348244f684938509b58-55211560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c4bf546039ba264dee2693bff8e1d56b4bec1cf' => 
    array (
      0 => './templates/root.index.tpl',
      1 => 1332765159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18368348244f684938509b58-55211560',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f684938567049_17090516',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f684938567049_17090516')) {function content_4f684938567049_17090516($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Home'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'About News Feeder','class'=>'iInfo')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'About News Feeder','class'=>'iInfo'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
News Feeder was made to stop the painstaking task of checking all the web sites you regularly visit for new information. There's no software to install: News Feeder can be managed via e-mail, web control panel or by a bookmarklet and runs all bandwidth intensive scripts on the server. Since it stores and transmits your passwords, it's advised that you don't use this service for private and/or confidential information monitoring. Oh, and it's free for personal use so long as you accept the terms and conditions.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'About News Feeder','class'=>'iInfo'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>