<?php /* Smarty version Smarty-3.1.8, created on 2012-09-16 14:56:26
         compiled from "/var/www/templates/root.account.feeds.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4893470124f730f559c1900-32453340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa32478945df53f233e0285cb2bfd0c039366a27' => 
    array (
      0 => '/var/www/templates/root.account.feeds.index.tpl',
      1 => 1347807380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4893470124f730f559c1900-32453340',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f730f55a4e593_13497338',
  'variables' => 
  array (
    'headers' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f730f55a4e593_13497338')) {function content_4f730f55a4e593_13497338($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
if (!is_callable('smarty_block_left_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.left_widgets.php';
if (!is_callable('smarty_block_form')) include '/var/www/classes/thirdparty/smarty/plugins/block.form.php';
if (!is_callable('smarty_block_right_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.right_widgets.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Manage Feeds'), 0);?>

<script>
	function confirmDelete(url) {
		jConfirm('Can you confirm this delete feed action?', 'Confirmation Dialog', function(r) {
			if (r) {
			    window.location = url;
			}
		});
	};
</script>
<?php $_smarty_tpl->tpl_vars['headers'] = new Smarty_variable(array('Name','URL','Remove'), null, 0);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Your Feeds','class'=>'iArchive','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Your Feeds','class'=>'iArchive','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->getSubTemplate ('table.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('headers'=>$_smarty_tpl->tpl_vars['headers']->value,'data'=>$_smarty_tpl->tpl_vars['data']->value), 0);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Your Feeds','class'=>'iArchive','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('left_widgets', array()); $_block_repeat=true; echo smarty_block_left_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('action'=>'/account/feeds/search.php','method'=>'POST')); $_block_repeat=true; echo smarty_block_form(array('action'=>'/account/feeds/search.php','method'=>'POST'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Search for Feeds','class'=>'iMagnify','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Search for Feeds','class'=>'iMagnify','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	    <div class="rowElem noborder">
		<label>Search&nbsp;Term:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="searchterm" id="searchterm"/>
		</div>
		<div class="fix"></div>

	    </div>
	    <input type="submit" value="Search" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Search for Feeds','class'=>'iMagnify','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('action'=>'/account/feeds/search.php','method'=>'POST'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_left_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('right_widgets', array()); $_block_repeat=true; echo smarty_block_right_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('form', array('action'=>'/account/feeds/import.php','method'=>'POST','enctype'=>'multipart/form-data')); $_block_repeat=true; echo smarty_block_form(array('action'=>'/account/feeds/import.php','method'=>'POST','enctype'=>'multipart/form-data'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Import OPML','class'=>'iTransfer','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Import OPML','class'=>'iTransfer','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	    <div class="rowElem noborder">
		<label>OPML&nbsp;File:</label> 
		<div class="formRight">
		    <input type="file" class="fileInput" id="fileInput" name="opml" />
		</div>
		<div class="fix"></div>
	    </div>
	    <input type="submit" value="Begin Import" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Import OPML','class'=>'iTransfer','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_form(array('action'=>'/account/feeds/import.php','method'=>'POST','enctype'=>'multipart/form-data'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_right_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>