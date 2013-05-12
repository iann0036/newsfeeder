<?php /* Smarty version Smarty-3.1.8, created on 2012-10-24 04:18:45
         compiled from "/var/www/templates/root.account.feeds.search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:977160255504db8d7961fb5-15596257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dddfca62cf4330b4256d8358a48164922236c835' => 
    array (
      0 => '/var/www/templates/root.account.feeds.search.tpl',
      1 => 1351052283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '977160255504db8d7961fb5-15596257',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_504db8d79a2380_00714248',
  'variables' => 
  array (
    'searchterm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_504db8d79a2380_00714248')) {function content_504db8d79a2380_00714248($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Search for Feeds'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>('Search for ').($_smarty_tpl->tpl_vars['searchterm']->value),'class'=>'iMagnify')); $_block_repeat=true; echo smarty_block_widget(array('title'=>('Search for ').($_smarty_tpl->tpl_vars['searchterm']->value),'class'=>'iMagnify'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div id="results" name="results"><img src="/images/loaders/loader6.gif" /></div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>('Search for ').($_smarty_tpl->tpl_vars['searchterm']->value),'class'=>'iMagnify'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<script>
var getInt;

function getResults() {
    $.ajax({
      type: "GET",
      url: "/account/feeds/ajax.php",
      data: { searchterm: "<?php echo $_smarty_tpl->tpl_vars['searchterm']->value;?>
" },
      success: function(msg) {
	document.getElementById('results').innerHTML = msg;  
    }});
}
getInt = setInterval(function(){ getResults(); },3000);
</script>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>