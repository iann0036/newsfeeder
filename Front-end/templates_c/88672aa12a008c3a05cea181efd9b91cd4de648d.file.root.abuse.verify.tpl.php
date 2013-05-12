<?php /* Smarty version Smarty-3.1.8, created on 2012-04-16 04:35:02
         compiled from "/var/www/templates/root.abuse.verify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13073094834f8ba176aad8d7-28978965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88672aa12a008c3a05cea181efd9b91cd4de648d' => 
    array (
      0 => '/var/www/templates/root.abuse.verify.tpl',
      1 => 1334550858,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13073094834f8ba176aad8d7-28978965',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'metacontent' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8ba176b04d31_55962083',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8ba176b04d31_55962083')) {function content_4f8ba176b04d31_55962083($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Abuse'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Verify Site Ownership','class'=>'iAlert2')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Verify Site Ownership','class'=>'iAlert2'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<p>Please insert the following code EXACTLY as it is below onto your index page, that is, the page that is visited when browsing to your domain directly.</p>
<p><code>&lt;meta name="nfauth" content="<?php echo $_smarty_tpl->tpl_vars['metacontent']->value;?>
" /&gt;</code>
<form method="POST" action="verify.php">
    <input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['metacontent']->value;?>
" />
    <b>Domain: </b><input type="text" name="domain" />
    <input type="submit" value="Verify" />
</form>
</p>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Verify Site Ownership','class'=>'iAlert2'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>