<?php /* Smarty version Smarty-3.1.8, created on 2012-10-24 08:07:47
         compiled from "/var/www/templates/root.account.feeds.edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9121462875055b9e62a6e66-28252699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2dbb1f9e008e3d9c3e6811c966537695ce1ccfc' => 
    array (
      0 => '/var/www/templates/root.account.feeds.edit.tpl',
      1 => 1351065837,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9121462875055b9e62a6e66-28252699',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5055b9e6740840_93926171',
  'variables' => 
  array (
    'feeds' => 0,
    'sheetid' => 0,
    'category' => 0,
    'feed' => 0,
    'lastfeed' => 0,
    'dark' => 0,
    'cphs' => 0,
    'cph' => 0,
    'order' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5055b9e6740840_93926171')) {function content_5055b9e6740840_93926171($_smarty_tpl) {?><?php if (!is_callable('smarty_function_init')) include '/var/www/classes/thirdparty/smarty/plugins/function.init.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/classes/thirdparty/smarty/plugins/modifier.regex_replace.php';
if (!is_callable('smarty_block_left_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.left_widgets.php';
if (!is_callable('smarty_block_right_widgets')) include '/var/www/classes/thirdparty/smarty/plugins/block.right_widgets.php';
if (!is_callable('smarty_function_math')) include '/var/www/classes/thirdparty/smarty/plugins/function.math.php';
?><?php echo smarty_function_init(array(),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars['category'] = new Smarty_variable($_smarty_tpl->tpl_vars['feeds']->value[0]['category'], null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('pagename'=>'Manage Sheet'), 0);?>

<div id="bodyContent" class="stats">
	    <script>
		var dialogIndex = 0;
		var data = new Array();
		
		$(function() {
			$("#leftColumn").sortable({
			    cursorAt: { top: 60 },
			    connectWith: ".columns"
			}).disableSelection();
			$("#rightColumn").sortable({
			    cursorAt: { top: 60 },
			    connectWith: ".columns"
			}).disableSelection();
			
			var ul = document.createElement('ul');
			    var li_save = document.createElement('li');
			    li_save.setAttribute('class','iCheck');
			    li_save.setAttribute('onclick','saveLayout()');
			    var a = document.createElement('a');
			    var span = document.createElement('span');
			    span.setAttribute('id','saveButton');
			    span.innerHTML = 'Save';
			    a.appendChild(span);
			    li_save.appendChild(a);
			    
			ul.appendChild(li_save);
			
			document.getElementById('middleNav').appendChild(ul);
		});		
		
		function cph_feed(id,feeds) {
		    this.id = id;
		    this.feeds = feeds;
		}
		
		function cph_weather(id,code) {
		    this.id = id;
		    this.code = code;
		}
		
		function removeWidget(index) {
		    var wid = document.getElementById('wid_'+index);
		    wid.parentNode.removeChild(wid);
		    
		    data[index].disabled = true;
		}
		
		function changeLayout() {
		    jPrompt('Amount of columns:', '2', 'Change Layout', function(r) {
			var rightWidgets = document.getElementById('rightWidgets');
			if (r=='1') {
			    ;
			} else if (r=='2') {
			    ;
			}
		    });
		}
		
		function getWidgetDescription() {
		    if (document.getElementById('widgetType').value == "news")
			document.getElementById('widgetDesc').innerHTML = "The <b>News</b> item gives you a customized view of news items relevant to you.";
		    else if (document.getElementById('widgetType').value == "weather")
			document.getElementById('widgetDesc').innerHTML = "The <b>Weather</b> item gives you a look at the forecast for your region.";
		    else
			document.getElementById('widgetDesc').innerHTML = "";
		}
		
		function saveLayout() {
		    document.getElementById('saveButton').innerHTML = 'Saving...';
		    
		    for (var i=0; i<dialogIndex; i++) {
			if (document.getElementById('weather' + i)!=null) {
			    updateWeather(i);
			}
		    }
		    
		    $.post("/account/feeds/update.php", {
			sheetid: <?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
,
			wdata: data,
			leftsorting: $("#leftColumn").sortable('toArray'),
			rightsorting: $("#rightColumn").sortable('toArray')
		    }, function(response) {
			window.location = "/account/view.php?sheetid=<?php echo $_smarty_tpl->tpl_vars['sheetid']->value;?>
";
		    });
		}
		
		function updateFeed(index,feedno) {
		    data[index].feeds.push(document.getElementById('feedList'+index+'_feed'+feedno).value); // means user cannot change mind
		}
		
		function updateWeather(index) {
		    data[index].code = document.getElementById('weather'+index).value; // means user cannot change mind
		}
		
		function addFeed(index,value) {
		    var feedno = eval(data[index].feeds.length + 1);
		    
		    if (document.getElementById('feedList' + index + '_feed' + feedno)!=null) { // TODO: make this test pretty
			//alert('Bad! Ian M.');
			console.log(document.getElementById('feedList' + index + '_feed' + feedno));
			return;
		    }	
		    
		    var div = document.createElement('div');
		    div.setAttribute('class','formRight searchDrop');
		    
		    var select = document.createElement('select');
		    select.setAttribute('id','feedList' + index + '_feed' + feedno);
		    select.setAttribute('data-placeholder','Choose a Feed...');
		    select.setAttribute('class','chzn-select');
		    select.setAttribute('style','width:250px;');
		    select.setAttribute('tabindex','2');
		    select.setAttribute('onchange','updateFeed(' + index + ',' + feedno + ')');
		    
		    var blank_option = document.createElement('option');
		    blank_option.setAttribute('value','');
		    select.appendChild(blank_option);
		    
		    var optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
 = document.createElement('optgroup');
		    optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
.setAttribute('label','<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8', true);?>
');
		    <?php  $_smarty_tpl->tpl_vars['feed'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feed']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feeds']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['feed']->key => $_smarty_tpl->tpl_vars['feed']->value){
$_smarty_tpl->tpl_vars['feed']->_loop = true;
?>
		    <?php if ($_smarty_tpl->tpl_vars['feed']->value['category']!=$_smarty_tpl->tpl_vars['category']->value){?>
			<?php if ($_smarty_tpl->tpl_vars['category']->value!=''){?>
			    select.appendChild(optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
);
			<?php }?>
			<?php $_smarty_tpl->tpl_vars['category'] = new Smarty_variable($_smarty_tpl->tpl_vars['feed']->value['category'], null, 0);?>
			<?php if ($_smarty_tpl->tpl_vars['feed']->value['category']!=''){?>
			    var optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
 = document.createElement('optgroup');
			    optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
.setAttribute('label','<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8', true);?>
');
			<?php }?>
		    <?php }?>
		    <?php if (!$_smarty_tpl->tpl_vars['feed']->value['enabled']){?>
			var feed<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
 = document.createElement('option');
			feed<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
.setAttribute('value','<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
');
			if (<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
==value)
			    feed<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
.setAttribute('selected','true');
			feed<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
.innerHTML = '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feed']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
';
			<?php if ($_smarty_tpl->tpl_vars['feed']->value['category']!=''){?>
			    optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
.appendChild(feed<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
);
			<?php }else{ ?>
			    select.appendChild(feed<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
);
			<?php }?>
			<?php $_smarty_tpl->tpl_vars['lastfeed'] = new Smarty_variable($_smarty_tpl->tpl_vars['feed']->value, null, 0);?>
		    <?php }?>
		    <?php } ?>
		    <?php if ($_smarty_tpl->tpl_vars['lastfeed']->value['category']!=''){?>
			select.appendChild(optgroup_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['category']->value,"/[\ ]/","_");?>
);
		    <?php }?>	    
		    
		    div.appendChild(select);
		
		    document.getElementById('feedList' + index).appendChild(div);
		    $(".chzn-select").chosen();
		}
		
		function addWeatherWidget(index,column,value) {
		    var li = document.createElement('li');
		    li.setAttribute('id','wid_' + index);
		    li.setAttribute('class','ui-state-default');
		    var fieldset = document.createElement('fieldset');
		    var div_widget = document.createElement('div');
		    div_widget.setAttribute('class','widget');
		    var div_head = document.createElement('div');
		    div_head.setAttribute('class','head');
		    div_head.innerHTML = "<h5 class='iCloud'>Weather</h5><div class='num'><a href='#' class='redNum' onclick='removeWidget(" + index + ")'>X</a></div>";
		    div_widget.appendChild(div_head);
		    var div_body = document.createElement('div');
		    div_body.setAttribute('class','body');
		    var form = document.createElement('form');
		    form.setAttribute('class','mainForm');
		    form.setAttribute('action','');

		    var div_row = document.createElement('div');
		    div_row.setAttribute('class','rowElem noborder');
		    var label = document.createElement('label');
		    label.innerHTML = 'Location:';
		    var div_formright = document.createElement('div');
		    div_formright.setAttribute('class','formRight');
		    var inputbox = document.createElement('input');
		    inputbox.setAttribute('type','text');
		    inputbox.setAttribute('value',value);
		    inputbox.setAttribute('id','weather' + index);
		    inputbox.setAttribute('name','weather' + index);
		    var div_fix = document.createElement('div');
		    div_fix.setAttribute('class','fix');
		    div_formright.appendChild(inputbox);
		    div_row.appendChild(label);
		    div_row.appendChild(div_formright);
		    div_row.appendChild(div_fix);

		    form.appendChild(div_row);

		    div_body.appendChild(form);

		    div_widget.appendChild(div_body);
		    fieldset.appendChild(div_widget);
		    li.appendChild(fieldset);
		    var div_fix2 = document.createElement('div');
		    div_fix2.setAttribute('class','fix');
		    li.appendChild(div_fix2);
		    document.getElementById(column).appendChild(li);
		}
		
		function addNewsWidget(index,column) {
		    var li = document.createElement('li');
		    li.setAttribute('id','wid_' + index);
		    li.setAttribute('class','ui-state-default');
		    var fieldset = document.createElement('fieldset');
		    var div_widget = document.createElement('div');
		    div_widget.setAttribute('class','widget');
		    var div_head = document.createElement('div');
		    div_head.setAttribute('class','head');
		    div_head.innerHTML = "<h5 class='iList'>News</h5><div class='num'><a href='#' class='redNum' onclick='removeWidget(" + index + ")'>X</a></div>";
		    div_widget.appendChild(div_head);
		    var div_body = document.createElement('div');
		    div_body.setAttribute('class','body');
		    var form = document.createElement('form');
		    form.setAttribute('class','mainForm');
		    form.setAttribute('action','');

		    var div_toprow = document.createElement('div');
		    div_toprow.setAttribute('class','rowElem noborder');
		    var feeds_label = document.createElement('label');
		    feeds_label.innerHTML = 'Feeds:';
		    var feedList = document.createElement('div');
		    feedList.setAttribute('id','feedList' + index);
		    var div_fix = document.createElement('div');
		    div_fix.setAttribute('class','fix');
		    div_toprow.appendChild(feeds_label);
		    div_toprow.appendChild(feedList);
		    div_toprow.appendChild(div_fix);

		    var div_bottomrow = document.createElement('div');
		    div_bottomrow.setAttribute('class','rowElem noborder');
		    var form_right = document.createElement('div');
		    form_right.setAttribute('class','formRight');
		    form_right.setAttribute('style','text-align: right;');
		    var addButton = document.createElement('input');
		    addButton.setAttribute('type','button');
		    addButton.setAttribute('onclick','addFeed(' + index + ',null);');
		    addButton.setAttribute('value','Add Feed');
		    addButton.setAttribute('class','blueBtn');

		    form_right.appendChild(addButton);
		    div_bottomrow.appendChild(form_right);
		    div_bottomrow.appendChild(div_fix);

		    form.appendChild(div_toprow);
		    form.appendChild(div_bottomrow);

		    div_body.appendChild(form);

		    div_widget.appendChild(div_body);
		    fieldset.appendChild(div_widget);
		    li.appendChild(fieldset);
		    var div_fix2 = document.createElement('div');
		    div_fix2.setAttribute('class','fix');
		    li.appendChild(div_fix2);
		    document.getElementById(column).appendChild(li);
		}
		
		function dialogFunction() {
		    if (document.getElementById('widgetType').value == "weather") {
			addWeatherWidget(dialogIndex,'leftColumn',"");
			
			/* Add dialog to data */
			data.push(new cph_weather(dialogIndex));
			
			dialogIndex++;
		    } else if (document.getElementById('widgetType').value == "news") {
			addNewsWidget(dialogIndex,'leftColumn');
			
			/* Add dialog to data */
			data.push(new cph_feed(dialogIndex,new Array()));
			
			addFeed(dialogIndex,null); // adds initial feed search and styles
			
			dialogIndex++;
		    }
		}
		
		function insertPredefinedCph(column,type,param) {
		    if (column==0) {
			if (type==0) {
			    addNewsWidget(dialogIndex,'leftColumn');
			    data.push(new cph_feed(dialogIndex,new Array()));
			    for (i=0; i<param.length; i++) {
				addFeed(dialogIndex,param[i]);
				data[dialogIndex].feeds.push(document.getElementById('feedList'+dialogIndex+'_feed'+eval(i+1)).value);
			    }
			} else if (type==1) {
			    addWeatherWidget(dialogIndex,'leftColumn',param);
			    data.push(new cph_weather(dialogIndex));
			}
		    } else {
			if (type==0) {
			    addNewsWidget(dialogIndex,'rightColumn');
			    data.push(new cph_feed(dialogIndex,new Array()));
			    for (i=0; i<param.length; i++) {
				addFeed(dialogIndex,param[i]);
				data[dialogIndex].feeds.push(document.getElementById('feedList'+dialogIndex+'_feed'+eval(i+1)).value);
			    }
			} else if (type==1) {
			    addWeatherWidget(dialogIndex,'rightColumn',param);
			    data.push(new cph_weather(dialogIndex));
			}
		    }
		    dialogIndex++;
		}
	    </script>
		<ul>
		    <div class="uDialog">
                    <div id="dialog-message" title="Add widget">
                        <p>Select the type of widget you would like to add: <br /><br /></p>
                        <div class="uiForm">
			    <select id="widgetType" onchange="getWidgetDescription()">
				<option></option>
				<option value="news">News</option>
				<option value="weather">Weather</option>
			    </select>
                        </div>
			<p><br /><br /><div id="widgetDesc"></div></p>
                    </div>
		    <li class="last"><a href="#" class="count <?php if ($_smarty_tpl->tpl_vars['dark']->value){?>orange<?php }else{ ?>blue<?php }?>" title="" id="opener">&nbsp;+&nbsp;</a><span>add widget</span></li>
		    </div>
		    
		    <li class="last"><a onclick="changeLayout()" href="#" class="count green" title="">&nbsp;2&nbsp;</a><span>change layout</span></li>
		</ul>
		<div class="fix"></div>
	</div>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('left_widgets', array()); $_block_repeat=true; echo smarty_block_left_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<ul id="leftColumn" class="columns" style="padding: 1px; padding-bottom: 200px;">
</ul>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_left_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('right_widgets', array()); $_block_repeat=true; echo smarty_block_right_widgets(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<ul id="rightColumn" class="columns" style="padding: 1px; padding-bottom: 200px;">
</ul>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_right_widgets(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<script>
<?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable("0", null, 0);?>
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
    insertPredefinedCph(<?php echo $_smarty_tpl->tpl_vars['cph']->value['column'];?>
,<?php if ($_smarty_tpl->tpl_vars['cph']->value['feeds']){?>0,new Array(<?php  $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cph']->value['feedids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fids']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['id']->key => $_smarty_tpl->tpl_vars['id']->value){
$_smarty_tpl->tpl_vars['id']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fids']['index']++;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fids']['index']!=0){?>,<?php }?>'<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
'<?php } ?>)<?php }else{ ?>1,"<?php echo $_smarty_tpl->tpl_vars['cph']->value['weather']['search'];?>
"<?php }?>);
    <?php }?>
    <?php }?>
    <?php } ?>
    <?php ob_start();?><?php echo smarty_function_math(array('equation'=>"x+1",'x'=>$_smarty_tpl->tpl_vars['order']->value),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable($_tmp1, null, 0);?>
<?php } ?>
<?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable("0", null, 0);?>
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
    insertPredefinedCph(<?php echo $_smarty_tpl->tpl_vars['cph']->value['column'];?>
,<?php if ($_smarty_tpl->tpl_vars['cph']->value['feeds']){?>0,new Array(<?php  $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cph']->value['feedids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fids']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['id']->key => $_smarty_tpl->tpl_vars['id']->value){
$_smarty_tpl->tpl_vars['id']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fids']['index']++;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fids']['index']!=0){?>,<?php }?>'<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
'<?php } ?>)<?php }else{ ?>1,"<?php echo $_smarty_tpl->tpl_vars['cph']->value['weather']['search'];?>
"<?php }?>);
    <?php }?>
    <?php }?>
    <?php } ?>
    <?php ob_start();?><?php echo smarty_function_math(array('equation'=>"x+1",'x'=>$_smarty_tpl->tpl_vars['order']->value),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["order"] = new Smarty_variable($_tmp2, null, 0);?>
<?php } ?>
</script>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>