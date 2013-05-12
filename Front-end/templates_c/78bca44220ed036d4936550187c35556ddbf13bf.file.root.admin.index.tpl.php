<?php /* Smarty version Smarty-3.1.8, created on 2012-09-17 05:08:20
         compiled from "/var/www/templates/root.admin.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7607053554f717ca89d5643-86544913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78bca44220ed036d4936550187c35556ddbf13bf' => 
    array (
      0 => '/var/www/templates/root.admin.index.tpl',
      1 => 1347858297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7607053554f717ca89d5643-86544913',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f717ca8a84d27_18020830',
  'variables' => 
  array (
    'users' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f717ca8a84d27_18020830')) {function content_4f717ca8a84d27_18020830($_smarty_tpl) {?><?php if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Administration'), 0);?>

<script>
	function confirmDelete(url) {
		jConfirm('Can you confirm this delete user action?', 'Confirmation Dialog', function(r) {
			if (r) {
			    window.location = url;
			}
		});
	};
</script>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Server Actions','class'=>'iRobot')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Server Actions','class'=>'iRobot'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div id="connectaction">
<a href="#" onclick="sendSocketAction('status');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/electroPlug.png" alt="" class="icon" /><span>Connect</span></a>
</div>
<div id="serveractions" style="display: none">
<br /><a href="#" onclick="sendSocketAction('start');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/play.png" alt="" class="icon" /><span>Start Server</span></a>
<a href="#" onclick="sendSocketAction('stop');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/stop.png" alt="" class="icon" /><span>Stop Server</span></a>
<a href="#" onclick="sendSocketAction('restart');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/refresh3.png" alt="" class="icon" /><span>Restart Server</span></a>
<a href="/admin/config.php" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/settings.png" alt="" class="icon" /><span>Change Config</span></a>
</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Server Actions','class'=>'iRobot'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'User List','class'=>'iUsers2','nobody'=>true)); $_block_repeat=true; echo smarty_block_widget(array('title'=>'User List','class'=>'iUsers2','nobody'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div id="myList-nav"></div><ul id="myList">
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
    <li><a href="#"><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
)</a>
	<ul class="listData">
	    <li><a href="#" title=""><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</a></li>
	    <?php if ($_smarty_tpl->tpl_vars['user']->value['isMe']){?>
	    <li><i>That's you!</i></li>
	    <?php }else{ ?>
	    <li><a href="#" onclick="confirmDelete('/admin/deleteuser.php?username=<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
')"><span class="red">Delete</span></a></li>
	    <?php }?>
	    <?php if ($_smarty_tpl->tpl_vars['user']->value['admin']){?>
	    <li><span class="cNote">admin</span></li>
	    <?php }else{ ?>
	    <li><span class="cNote">user</span></li>
	    <?php }?>
	</ul>
    </li>
    <?php } ?>
</ul><div class="fix"></div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'User List','class'=>'iUsers2','nobody'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>'Logs','class'=>'iError')); $_block_repeat=true; echo smarty_block_widget(array('title'=>'Logs','class'=>'iError'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<iframe style="width: 100%;" src="/admin/logs.php">Loading...</iframe>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>'Logs','class'=>'iError'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>