<?php /* Smarty version Smarty-3.1.8, created on 2012-08-09 08:23:21
         compiled from "/var/www/templates/root.abuse.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1539424834f8ba15637cc98-32002262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9ed67c1db126a53f89b4bd45c170565b6b9a884' => 
    array (
      0 => '/var/www/templates/root.abuse.index.tpl',
      1 => 1341922054,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1539424834f8ba15637cc98-32002262',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8ba156747904_73446049',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8ba156747904_73446049')) {function content_4f8ba156747904_73446049($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Abuse'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Report Abuse','class'=>'iAlert2')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Report Abuse','class'=>'iAlert2'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<p>Before being able to report abuse with this service you must first verify your website.</p>

<p>To verify that you own a site, you have a number of options. You can:</p>

<ul>
    <li>Add a meta tag to your home page (proving that you have access to the source files). To use this method, you must be able to edit the HTML code of your site's pages. <a href="#">Use this method.</a></li>
    <li>Create a file with the name we provide you to the root of your server. To use this method, you must be able to create new files on your server.</li>
    <li>Add a DNS TXT record. To use this method, you must be able to sign in to your domain registrar or hosting provider and add a new DNS record.</li>
</ul>

<small>* News Feeder Reporting will check to see that the specified tag, file, or record is present. If it is, we consider you a site owner and you will be able to remove your website from this service.<br />
* We don't use the verification file we ask you to create for any purpose other than to make sure you can upload files to the site.</small>


<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Report Abuse','class'=>'iAlert2'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>