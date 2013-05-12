<?php /* Smarty version Smarty-3.1.8, created on 2012-10-15 22:46:12
         compiled from "/var/www/templates/root.account.articleviewer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14647084814f731b88c4f522-21436116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42b84bafc9a893c88c05b104aff5de02d6f0c324' => 
    array (
      0 => '/var/www/templates/root.account.articleviewer.tpl',
      1 => 1350341142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14647084814f731b88c4f522-21436116',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f731b88cf7b52_90875676',
  'variables' => 
  array (
    'article' => 0,
    'images' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f731b88cf7b52_90875676')) {function content_4f731b88cf7b52_90875676($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
if (!is_callable('smarty_block_left_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.left_widgets.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/classes/thirdparty/smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_block_right_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.right_widgets.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>$_smarty_tpl->tpl_vars['article']->value['title']), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>$_smarty_tpl->tpl_vars['article']->value['title'],'class'=>'iDoc')); $_block_repeat=true; echo smarty_block_widget(array('title'=>$_smarty_tpl->tpl_vars['article']->value['title'],'class'=>'iDoc'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>$_smarty_tpl->tpl_vars['article']->value['title'],'class'=>'iDoc'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('left_widgets', array()); $_block_repeat=true; echo smarty_block_left_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('nohead'=>true,'nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('nohead'=>true,'nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="head opened" id="toggleOpened"><h5>Article Details</h5></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
    <tbody>
	<tr class="noborder">
	    <td width="50%">Posted by:</td>
	    <td align="right"><strong class="red"><?php if ($_smarty_tpl->tpl_vars['article']->value['feedname']){?><?php echo $_smarty_tpl->tpl_vars['article']->value['feedname'];?>
<?php }else{ ?>Unknown<?php }?></strong></td>
	</tr>
	<tr>
	    <td>Posted on:</td>

	    <td align="right"><?php echo $_smarty_tpl->tpl_vars['article']->value['time'];?>
</td>
	</tr>
	<tr>
	    <td>URL:</td>
	    <td align="right"><a href="<?php echo $_smarty_tpl->tpl_vars['article']->value['url'];?>
" title=""><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['article']->value['url'],30,"...",true);?>
</a></td>
	</tr>

	<tr>
	    <td>Author:</td>
	    <td align="right"><a href="#" class="green"><?php if ($_smarty_tpl->tpl_vars['article']->value['author']){?><?php echo $_smarty_tpl->tpl_vars['article']->value['author'];?>
<?php }else{ ?>Unknown<?php }?></a></td>
	</tr>
    </tbody>
    </table>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('nohead'=>true,'nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_left_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('right_widgets', array()); $_block_repeat=true; echo smarty_block_right_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('nohead'=>true,'nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('nohead'=>true,'nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['article']->value['geo']){?>
<div class="head closed"><h5>Geolocation</h5></div>
<div class="body"><iframe width="350" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?q=<?php echo $_smarty_tpl->tpl_vars['article']->value['geo'];?>
&amp;ie=UTF8&amp;t=m&amp;z=5&amp;vpsrc=0&amp;output=embed"></iframe></div>
<?php }?>
<div class="head closed"><h5>Images</h5></div>
<div class="body">
<div class="pics">
<?php if ($_smarty_tpl->tpl_vars['images']->value){?>
<ul>
    <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['image']->value['url'];?>
" title="" rel="prettyPhoto"><img src="<?php echo $_smarty_tpl->tpl_vars['image']->value['data'];?>
" alt="" /></a>
	<!--<div class="actions">
	    <a href="#" title=""><img src="/images/edit.png" alt="" /></a>
	    <a href="#" title=""><img src="/images/delete.png" alt="" /></a>
	</div>-->
    </li>
    <?php } ?>
</ul> 
<?php }else{ ?>
Sorry, no images found.
<?php }?>
<div class="fix"></div>
</div>
</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('nohead'=>true,'nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_right_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>