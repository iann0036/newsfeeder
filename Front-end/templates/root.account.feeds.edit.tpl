{init}
{assign var=category value=$feeds[0]['category']}
{include 'header.tpl' pagename='Manage Sheet'}
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
			sheetid: {$sheetid},
			wdata: data,
			leftsorting: $("#leftColumn").sortable('toArray'),
			rightsorting: $("#rightColumn").sortable('toArray')
		    }, function(response) {
			window.location = "/account/view.php?sheetid={$sheetid}";
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
		    
		    var optgroup_{$category|regex_replace:"/[\ ]/":"_"} = document.createElement('optgroup');
		    optgroup_{$category|regex_replace:"/[\ ]/":"_"}.setAttribute('label','{$category|escape}');
		    {foreach from=$feeds item=feed}
		    {if $feed['category'] ne $category}
			{if $category ne ""}
			    select.appendChild(optgroup_{$category|regex_replace:"/[\ ]/":"_"});
			{/if}
			{assign var=category value=$feed['category']}
			{if $feed['category'] ne ""}
			    var optgroup_{$category|regex_replace:"/[\ ]/":"_"} = document.createElement('optgroup');
			    optgroup_{$category|regex_replace:"/[\ ]/":"_"}.setAttribute('label','{$category|escape}');
			{/if}
		    {/if}
		    {if !$feed.enabled}
			var feed{$feed.id} = document.createElement('option');
			feed{$feed.id}.setAttribute('value','{$feed.id}');
			if ({$feed.id}==value)
			    feed{$feed.id}.setAttribute('selected','true');
			feed{$feed.id}.innerHTML = '{$feed.name|escape}';
			{if $feed['category'] ne ""}
			    optgroup_{$category|regex_replace:"/[\ ]/":"_"}.appendChild(feed{$feed.id});
			{else}
			    select.appendChild(feed{$feed.id});
			{/if}
			{assign var=lastfeed value=$feed}
		    {/if}
		    {/foreach}
		    {if $lastfeed['category'] ne ""}
			select.appendChild(optgroup_{$category|regex_replace:"/[\ ]/":"_"});
		    {/if}	    
		    
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
		    <li class="last"><a href="#" class="count {if $dark}orange{else}blue{/if}" title="" id="opener">&nbsp;+&nbsp;</a><span>add widget</span></li>
		    </div>
		    
		    <li class="last"><a onclick="changeLayout()" href="#" class="count green" title="">&nbsp;2&nbsp;</a><span>change layout</span></li>
		</ul>
		<div class="fix"></div>
	</div>
{left_widgets}
<ul id="leftColumn" class="columns" style="padding: 1px; padding-bottom: 200px;">
</ul>
{/left_widgets}
{right_widgets}
<ul id="rightColumn" class="columns" style="padding: 1px; padding-bottom: 200px;">
</ul>
{/right_widgets}
<script>
{assign var="order" value="0"}
{foreach from=$cphs item=cphtemp}
    {foreach from=$cphs item=cph}
    {if $cph.order eq $order}
    {if $cph.column eq 0}
    insertPredefinedCph({$cph.column},{if $cph.feeds}0,new Array({foreach from=$cph.feedids item=id name=fids}{if $smarty.foreach.fids.index ne 0},{/if}'{$id}'{/foreach}){else}1,"{$cph.weather.search}"{/if});
    {/if}
    {/if}
    {/foreach}
    {assign var="order" value={math equation="x+1" x=$order}}
{/foreach}
{assign var="order" value="0"}
{foreach from=$cphs item=cphtemp}
    {foreach from=$cphs item=cph}
    {if $cph.order eq $order}
    {if $cph.column eq 1}
    insertPredefinedCph({$cph.column},{if $cph.feeds}0,new Array({foreach from=$cph.feedids item=id name=fids}{if $smarty.foreach.fids.index ne 0},{/if}'{$id}'{/foreach}){else}1,"{$cph.weather.search}"{/if});
    {/if}
    {/if}
    {/foreach}
    {assign var="order" value={math equation="x+1" x=$order}}
{/foreach}
</script>
{include 'footer.tpl'}
