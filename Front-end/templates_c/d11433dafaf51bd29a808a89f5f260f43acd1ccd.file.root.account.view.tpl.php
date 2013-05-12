<?php /* Smarty version Smarty-3.1.8, created on 2012-09-19 09:04:11
         compiled from "/var/www/templates/root.account.view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3750950604f711067f35965-73234418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd11433dafaf51bd29a808a89f5f260f43acd1ccd' => 
    array (
      0 => '/var/www/templates/root.account.view.tpl',
      1 => 1348045044,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3750950604f711067f35965-73234418',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f7110680c4393_54657833',
  'variables' => 
  array (
    'sheetname' => 0,
    'sheetid' => 0,
    'cphs' => 0,
    'cph' => 0,
    'order' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f7110680c4393_54657833')) {function content_4f7110680c4393_54657833($_smarty_tpl) {?><?php if (!is_callable('smarty_block_left_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.left_widgets.php';
if (!is_callable('smarty_block_widget')) include '/var/www/classes/thirdparty/smarty/plugins/block.widget.php';
if (!is_callable('smarty_modifier_capitalize')) include '/var/www/classes/thirdparty/smarty/plugins/modifier.capitalize.php';
if (!is_callable('smarty_function_math')) include '/var/www/classes/thirdparty/smarty/plugins/function.math.php';
if (!is_callable('smarty_block_right_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.right_widgets.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>$_smarty_tpl->tpl_vars['sheetname']->value), 0);?>

<script>
    var ul = document.createElement('ul');
    var li = document.createElement('li');
    li.setAttribute('class','iPdfDoc');
    li.setAttribute('href','/account/pdf.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
');
    li.setAttribute('target','_blank');
    var a = document.createElement('a');
    a.setAttribute('href','/account/pdf.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
');
    a.setAttribute('target','_blank');
    var span = document.createElement('span');
    span.setAttribute('id','pdfButton');
    span.innerHTML = 'Export to PDF';
    a.appendChild(span);
    li.appendChild(a);
    ul.appendChild(li);
    
    var li2 = document.createElement('li');
    li2.setAttribute('class','iRss');
    li2.setAttribute('href','/account/rss.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
');
    li2.setAttribute('target','_blank');
    var a2 = document.createElement('a');
    a2.setAttribute('href','/account/rss.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
');
    a2.setAttribute('target','_blank');
    var span2 = document.createElement('span');
    span2.setAttribute('id','rssButton');
    span2.innerHTML = 'Export to RSS';
    a2.appendChild(span2);
    li2.appendChild(a2);
    ul.appendChild(li2);
    
    var li3 = document.createElement('li');
    li3.setAttribute('class','iPencil');
    li3.setAttribute('href','/account/feeds/edit.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
');
    var a3 = document.createElement('a');
    a3.setAttribute('href','/account/feeds/edit.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
');
    var span3 = document.createElement('span');
    span3.setAttribute('id','editButton');
    span3.innerHTML = 'Edit Mode';
    a3.appendChild(span3);
    li3.appendChild(a3);
    ul.appendChild(li3);
    
    document.getElementById('middleNav').appendChild(ul);
</script>
<?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable("0", null, 0);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('left_widgets', array()); $_block_repeat=true; echo smarty_block_left_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php  $_smarty_tpl->tpl_vars['cphtemp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cphtemp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cphs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cphtemp']->key => $_smarty_tpl->tpl_vars['cphtemp']->value){
$_smarty_tpl->tpl_vars['cphtemp']->_loop = true;
?>
    <?php  $_smarty_tpl->tpl_vars['cph'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cph']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cphs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cph']->key => $_smarty_tpl->tpl_vars['cph']->value){
$_smarty_tpl->tpl_vars['cph']->_loop = true;
?>
    <?php if ($_smarty_tpl->tpl_vars['cph']->value['order']==$_smarty_tpl->tpl_vars['order']->value){?>
    <?php if ($_smarty_tpl->tpl_vars['cph']->value['column']==0){?>
	<?php if ($_smarty_tpl->tpl_vars['cph']->value['feeds']){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>"News Items",'class'=>'iList')); $_block_repeat=true; echo smarty_block_widget(array('title'=>"News Items",'class'=>'iList'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cph']->value['feeds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['feediter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['feediter']['iteration']++;
?>
	<div class="supTicket<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['feediter']['iteration']==1){?> nobg<?php }?>">
	    <div class="issueType">
		    <span class="issueInfo"><a href="/account/articleviewer.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
&articleid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" title=""><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></span>
		<span class="issueNum"></span>
		<div class="fix"></div>
	    </div>

	    <div class="issueSummary">
		<?php if ($_smarty_tpl->tpl_vars['item']->value['favicon']){?>
		<a href="#" title="" class="floatleft"><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['favicon'];?>
" alt="" /></a>
		<?php }else{ ?>
		<a href="#" title="" class="floatleft"><img src="/images/question.png" alt="" /></a>
		<?php }?>
		<div class="ticketInfo">
		    <b>Posted by <?php echo $_smarty_tpl->tpl_vars['item']->value['feedname'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['time'];?>
</b><br>
		    <?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>

		    <div class="fix"></div>
		</div>
		<div class="fix"></div>
	    </div> 
	</div>
	<?php } ?>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>"News Items",'class'=>'iList'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }elseif($_smarty_tpl->tpl_vars['cph']->value['weather']){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>"Weather",'class'=>'iCloud')); $_block_repeat=true; echo smarty_block_widget(array('title'=>"Weather",'class'=>'iCloud'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<img src="<?php echo $_smarty_tpl->tpl_vars['cph']->value['weather']['icon'];?>
" style="float: left; display: block;" />
	<div class="weatherdiv" style="height: 65px;">
	    <h2 style="margin-left: 20px; float: left;">Weather for <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['cph']->value['weather']['location']);?>
</h2><br />
	<h3 style="float: left; margin-left: 20px; margin-top: 8px;"><?php echo $_smarty_tpl->tpl_vars['cph']->value['weather']['c'];?>
</h3>
	</div>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>"Weather",'class'=>'iCloud'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
    <?php }?>
    <?php }?>
    <?php } ?>
    <?php ob_start();?><?php echo smarty_function_math(array('equation'=>"x+1",'x'=>$_smarty_tpl->tpl_vars['order']->value),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable($_tmp1, null, 0);?>
<?php } ?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_left_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable("0", null, 0);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('right_widgets', array()); $_block_repeat=true; echo smarty_block_right_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php  $_smarty_tpl->tpl_vars['cphtemp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cphtemp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cphs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cphtemp']->key => $_smarty_tpl->tpl_vars['cphtemp']->value){
$_smarty_tpl->tpl_vars['cphtemp']->_loop = true;
?>
    <?php  $_smarty_tpl->tpl_vars['cph'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cph']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cphs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cph']->key => $_smarty_tpl->tpl_vars['cph']->value){
$_smarty_tpl->tpl_vars['cph']->_loop = true;
?>
    <?php if ($_smarty_tpl->tpl_vars['cph']->value['order']==$_smarty_tpl->tpl_vars['order']->value){?>
    <?php if ($_smarty_tpl->tpl_vars['cph']->value['column']==1){?>
	<?php if ($_smarty_tpl->tpl_vars['cph']->value['feeds']){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>"News Items",'class'=>'iList')); $_block_repeat=true; echo smarty_block_widget(array('title'=>"News Items",'class'=>'iList'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cph']->value['feeds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['feediter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['feediter']['iteration']++;
?>
	<div class="supTicket<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['feediter']['iteration']==1){?> nobg<?php }?>">
	    <div class="issueType">
		    <span class="issueInfo"><a href="/account/articleviewer.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
&articleid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" title=""><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></span>
		<span class="issueNum"></span>
		<div class="fix"></div>
	    </div>

	    <div class="issueSummary">
		    <?php if ($_smarty_tpl->tpl_vars['item']->value['favicon']){?>
		    <a href="#" title="" class="floatleft"><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['favicon'];?>
" alt="" /></a>
		    <?php }else{ ?>
		    <a href="#" title="" class="floatleft"><img src="/images/question.png" alt="" /></a>
		    <?php }?>
		<div class="ticketInfo">
		    <b>Posted by <?php echo $_smarty_tpl->tpl_vars['item']->value['feedname'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['time'];?>
</b><br>
		    <?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>

		    <div class="fix"></div>
		</div>
		<div class="fix"></div>
	    </div> 
	</div>
	<?php } ?>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>"News Items",'class'=>'iList'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }elseif($_smarty_tpl->tpl_vars['cph']->value['weather']){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('widget', array('title'=>"Weather",'class'=>'iCloud')); $_block_repeat=true; echo smarty_block_widget(array('title'=>"Weather",'class'=>'iCloud'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<img src="<?php echo $_smarty_tpl->tpl_vars['cph']->value['weather']['icon'];?>
" style="float: left; display: block;" />
	<div class="weatherdiv" style="height: 65px;">
	    <h2 style="margin-left: 20px; float: left;">Weather for <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['cph']->value['weather']['location']);?>
</h2><br />
	<h3 style="float: left; margin-left: 20px; margin-top: 8px;"><?php echo $_smarty_tpl->tpl_vars['cph']->value['weather']['c'];?>
</h3>
	</div>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_widget(array('title'=>"Weather",'class'=>'iCloud'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
    <?php }?>
    <?php }?>
    <?php } ?>
    <?php ob_start();?><?php echo smarty_function_math(array('equation'=>"x+1",'x'=>$_smarty_tpl->tpl_vars['order']->value),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable($_tmp2, null, 0);?>
<?php } ?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_right_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>