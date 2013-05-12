<?php /* Smarty version Smarty-3.1.8, created on 2012-08-11 02:01:28
         compiled from "/var/www/templates/root.faq.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10296349124f7173b3bda2a7-43371366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce20b4cf049206494a8a53fb7c980609bc892cce' => 
    array (
      0 => '/var/www/templates/root.faq.index.tpl',
      1 => 1344650354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10296349124f7173b3bda2a7-43371366',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f7173b3c186f7_58954971',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f7173b3c186f7_58954971')) {function content_4f7173b3c186f7_58954971($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'FAQ'), 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Frequently Asked Questions','class'=>'iHelp')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Frequently Asked Questions','class'=>'iHelp'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<h3 class="pt20">What is News Feeder?</h1>
<p>News Feeder is a service designed to pull together all the online news content relevant to you into one place.</p>

<h3 class="pt20">Changing the HTTPS setting</h3>
<p>News Feeder is set to use the 'Enable SSL' setting by default, but you can change this setting anytime. Here's some background on why we default to this option: If you sign in to News Feeder via a non-secure Internet connection, like a public wireless or non-encrypted network, your News Feeder account may be more vulnerable to hijacking. Non-secure networks make it easier for someone to impersonate you and gain full access to your News Feeder account, including any sensitive data it may contain like personal information or online log-in credentials. HTTPS, or Hypertext Transfer Protocol Secure, is a secure protocol that provides authenticated and encrypted communication.</p>
<div class="list arrowGrey pt12">
    <span class="legend">To disable or re-enable this feature in News Feeder:</span>
    <ul>
	<li>Sign in to News Feeder.</li>
	<li>Click the <b>Profile</b> in the upper-right corner.</li>
	<li>In the Profile page, check or uncheck the <b>Enable SSL</b> checkbox.</li>
	<li>Click <b>Save Changes</b>.</li>
    </ul>
</div>
<p>Please note that checking 'Enable SSL' will prevent you from accessing News Feeder via HTTP (Hypertext Transfer Protocol). If you trust the security of your network, you can turn this feature off at any time.</p>
<p>If you use a public computer to check your feeds, it's also important to sign out at the end each of your News Feeder sessions. Just click the "Sign Out" link in the upper-right corner. Also, make sure you close all News Feeder browser windows.</p>

<h3 class="pt20">How to subscribe to feeds</h1>
<p>If you already know the address of the feed you want to subscribe to, you can just click the <b>Edit Feeds</b> link from your sheet and paste the address in the text field under the <b>Add New Feed</b> heading. Otherwise, you can use our directory under the <b>Add Preset Feed</b> heading for an easy way to find and add feeds. As a third option, you can always <a href="#">find your own feeds</a>.</p>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Frequently Asked Questions','class'=>'iHelp'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>