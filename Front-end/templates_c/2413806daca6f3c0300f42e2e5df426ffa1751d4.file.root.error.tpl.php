<?php /* Smarty version Smarty-3.1.8, created on 2012-07-10 14:56:58
         compiled from "/var/www/templates/root.error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8746796804f73cde0b3be32-71375351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2413806daca6f3c0300f42e2e5df426ffa1751d4' => 
    array (
      0 => '/var/www/templates/root.error.tpl',
      1 => 1341922061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8746796804f73cde0b3be32-71375351',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f73cde0b71a46_57891462',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f73cde0b71a46_57891462')) {function content_4f73cde0b71a46_57891462($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('nonav'=>true), 0);?>

<div class="errorPage">
<h2 class="red errorTitle"><span>Something went wrong here</span></h2>

<h1><?php echo $_GET['error'];?>
</h1>
<span class="bubbles"></span>
<p>Oops! Sorry, an error has occured.</p>
<div class="backToDash"><a href="/index.php" title="" class="seaBtn button">Back to Home</a></div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>