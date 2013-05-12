<?php /* Smarty version Smarty-3.1.8, created on 2012-10-24 22:09:19
         compiled from "/var/www/templates/root.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2423599444f70e924bd7cd7-95041802%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c252adc17a4397eded85cb3a619e76b386deac7b' => 
    array (
      0 => '/var/www/templates/root.index.tpl',
      1 => 1351116555,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2423599444f70e924bd7cd7-95041802',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f70e924c87af7_11190525',
  'variables' => 
  array (
    'stats' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f70e924c87af7_11190525')) {function content_4f70e924c87af7_11190525($_smarty_tpl) {?><?php if (!is_callable('smarty_block_left_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.left_widgets.php';
if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
if (!is_callable('smarty_function_math')) include '/var/www/classes/thirdparty/smarty/plugins/function.math.php';
if (!is_callable('smarty_block_right_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.right_widgets.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Home'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('left_widgets', array()); $_block_repeat=true; echo smarty_block_left_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'An Introduction','class'=>'iFilmStrip')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'An Introduction','class'=>'iFilmStrip'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<iframe src="https://player.vimeo.com/video/45568466" width="424" height="240" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'An Introduction','class'=>'iFilmStrip'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Website Statistics','class'=>'iChart8','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Website Statistics','class'=>'iChart8','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
    <thead>
	<tr>
	  <td width="21%">Amount</td>

	  <td>Description</td>
	  <td width="21%">Changes</td>
	</tr>
    </thead>
    <tbody>
	<tr>
	    <td align="center"><a href="#" title="" class="webStatsLink"><?php echo $_smarty_tpl->tpl_vars['stats']->value['curr_users'];?>
</a></td>

	    <td>total users</td>
	    <td><span<?php if ($_smarty_tpl->tpl_vars['stats']->value['curr_users']<$_smarty_tpl->tpl_vars['stats']->value['prev_users']){?> class="statMinus"<?php }elseif($_smarty_tpl->tpl_vars['stats']->value['curr_users']>=$_smarty_tpl->tpl_vars['stats']->value['prev_users']){?> class="statPlus"<?php }?>><?php echo smarty_function_math(array('equation'=>"abs((y-x)/x*100)",'x'=>$_smarty_tpl->tpl_vars['stats']->value['curr_users'],'y'=>$_smarty_tpl->tpl_vars['stats']->value['prev_users'],'format'=>"%.2f"),$_smarty_tpl);?>
%</span></td>
	</tr>
	<tr>
	    <td align="center"><a href="#" title="" class="webStatsLink"><?php echo $_smarty_tpl->tpl_vars['stats']->value['curr_sheets'];?>
</a></td>
	    <td>total sheets</td>
	    <td><span<?php if ($_smarty_tpl->tpl_vars['stats']->value['curr_sheets']<$_smarty_tpl->tpl_vars['stats']->value['prev_sheets']){?> class="statMinus"<?php }elseif($_smarty_tpl->tpl_vars['stats']->value['curr_sheets']>=$_smarty_tpl->tpl_vars['stats']->value['prev_sheets']){?> class="statPlus"<?php }?>><?php echo smarty_function_math(array('equation'=>"abs((y-x)/x*100)",'x'=>$_smarty_tpl->tpl_vars['stats']->value['curr_sheets'],'y'=>$_smarty_tpl->tpl_vars['stats']->value['prev_sheets'],'format'=>"%.2f"),$_smarty_tpl);?>
%</span></td>

	</tr>
	<tr>
	    <td align="center"><a href="#" title="" class="webStatsLink"><?php echo $_smarty_tpl->tpl_vars['stats']->value['curr_feeds'];?>
</a></td>
	    <td>total feeds</td>
	    <td><span<?php if ($_smarty_tpl->tpl_vars['stats']->value['curr_feeds']<$_smarty_tpl->tpl_vars['stats']->value['prev_feeds']){?> class="statMinus"<?php }elseif($_smarty_tpl->tpl_vars['stats']->value['curr_feeds']>=$_smarty_tpl->tpl_vars['stats']->value['prev_feeds']){?> class="statPlus"<?php }?>><?php echo smarty_function_math(array('equation'=>"abs((y-x)/x*100)",'x'=>$_smarty_tpl->tpl_vars['stats']->value['curr_feeds'],'y'=>$_smarty_tpl->tpl_vars['stats']->value['prev_feeds'],'format'=>"%.2f"),$_smarty_tpl);?>
%</span></td>
	</tr>
	<tr>

	    <td align="center"><a href="#" title="" class="webStatsLink"><?php echo $_smarty_tpl->tpl_vars['stats']->value['curr_items'];?>
</a></td>
	    <td>total items</td>
	    <td><span<?php if ($_smarty_tpl->tpl_vars['stats']->value['curr_items']<$_smarty_tpl->tpl_vars['stats']->value['prev_items']){?> class="statMinus"<?php }elseif($_smarty_tpl->tpl_vars['stats']->value['curr_items']>=$_smarty_tpl->tpl_vars['stats']->value['prev_items']){?> class="statPlus"<?php }?>><?php echo smarty_function_math(array('equation'=>"abs((y-x)/x*100)",'x'=>$_smarty_tpl->tpl_vars['stats']->value['curr_items'],'y'=>$_smarty_tpl->tpl_vars['stats']->value['prev_items'],'format'=>"%.2f"),$_smarty_tpl);?>
%</span></td>
	</tr>
	</tbody>
</table>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Website Statistics','class'=>'iChart8','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_left_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('right_widgets', array()); $_block_repeat=true; echo smarty_block_right_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'About News Feeder','class'=>'iInfo')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'About News Feeder','class'=>'iInfo'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<p>News Feeder is a service which acts as an online news feed aggregator. It's main purpose is to provide a single location and format to view news content instead of our users having to go to a number of different websites for their specific news.</p>
<p>News Feeder allows it's users to specify preferences as to which type of articles they wish to view. These can be based on a number of criteria such as location, category, author, publishing site or specific feed URL's. The system will crawls feeds which match these criteria and store the articles in the system's database. The stored content can be of any media type, including text, images, video and geolocation information.</p>
<p>Our user's can then view the stored content in an organised layout, similar to that of a standard news sheet. These sheets will allow our user's to set a number of filtering options to ensure certain types of content are not displayed to them.</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'About News Feeder','class'=>'iInfo'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_right_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>