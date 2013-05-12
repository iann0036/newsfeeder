{include 'header.tpl' pagename=$sheetname}
<script>
    var ul = document.createElement('ul');
    var li = document.createElement('li');
    li.setAttribute('class','iPdfDoc');
    li.setAttribute('href','/account/pdf.php?sheetid={$sheetid}');
    li.setAttribute('target','_blank');
    var a = document.createElement('a');
    a.setAttribute('href','/account/pdf.php?sheetid={$sheetid}');
    a.setAttribute('target','_blank');
    var span = document.createElement('span');
    span.setAttribute('id','pdfButton');
    span.innerHTML = 'Export to PDF';
    a.appendChild(span);
    li.appendChild(a);
    ul.appendChild(li);
    
    var li2 = document.createElement('li');
    li2.setAttribute('class','iRss');
    li2.setAttribute('href','/account/rss.php?sheetid={$sheetid}');
    li2.setAttribute('target','_blank');
    var a2 = document.createElement('a');
    a2.setAttribute('href','/account/rss.php?sheetid={$sheetid}');
    a2.setAttribute('target','_blank');
    var span2 = document.createElement('span');
    span2.setAttribute('id','rssButton');
    span2.innerHTML = 'Export to RSS';
    a2.appendChild(span2);
    li2.appendChild(a2);
    ul.appendChild(li2);
    
    var li3 = document.createElement('li');
    li3.setAttribute('class','iPencil');
    li3.setAttribute('href','/account/feeds/edit.php?sheetid={$sheetid}');
    var a3 = document.createElement('a');
    a3.setAttribute('href','/account/feeds/edit.php?sheetid={$sheetid}');
    var span3 = document.createElement('span');
    span3.setAttribute('id','editButton');
    span3.innerHTML = 'Edit Mode';
    a3.appendChild(span3);
    li3.appendChild(a3);
    ul.appendChild(li3);
    
    document.getElementById('middleNav').appendChild(ul);
</script>
{assign var="order" value="0"}
{left_widgets}
{foreach from=$cphs item=cphtemp}
    {foreach from=$cphs item=cph}
    {if $cph.order eq $order}
    {if $cph.column eq 0}
	{if $cph.feeds}
	{widget title="News Items" class='iList'}
	{foreach from=$cph.feeds item=item name=feediter}
	<div class="supTicket{if $smarty.foreach.feediter.iteration==1} nobg{/if}">
	    <div class="issueType">
		    <span class="issueInfo"><a href="/account/articleviewer.php?sheetid={$sheetid}&articleid={$item.id}" title="">{$item.title}</a></span>
		<span class="issueNum"></span>
		<div class="fix"></div>
	    </div>

	    <div class="issueSummary">
		{if $item.favicon}
		<a href="#" title="" class="floatleft"><img src="{$item.favicon}" alt="" /></a>
		{else}
		<a href="#" title="" class="floatleft"><img src="/images/question.png" alt="" /></a>
		{/if}
		<div class="ticketInfo">
		    <b>Posted by {$item.feedname}, {$item.time}</b><br>
		    {$item.content}
		    <div class="fix"></div>
		</div>
		<div class="fix"></div>
	    </div> 
	</div>
	{/foreach}
	{/widget}
	{elseif $cph.weather}
	{widget title="Weather" class='iCloud'}
	<img src="{$cph.weather.icon}" style="float: left; display: block;" />
	<div class="weatherdiv" style="height: 65px;">
	    <h2 style="margin-left: 20px; float: left;">Weather for {$cph.weather.location|capitalize}</h2><br />
	<h3 style="float: left; margin-left: 20px; margin-top: 8px;">{$cph.weather.c}</h3>
	</div>
	{/widget}
	{/if}
    {/if}
    {/if}
    {/foreach}
    {assign var="order" value={math equation="x+1" x=$order}}
{/foreach}
{/left_widgets}
{assign var="order" value="0"}
{right_widgets}
{foreach from=$cphs item=cphtemp}
    {foreach from=$cphs item=cph}
    {if $cph.order eq $order}
    {if $cph.column eq 1}
	{if $cph.feeds}
	{widget title="News Items" class='iList'}
	{foreach from=$cph.feeds item=item name=feediter}
	<div class="supTicket{if $smarty.foreach.feediter.iteration==1} nobg{/if}">
	    <div class="issueType">
		    <span class="issueInfo"><a href="/account/articleviewer.php?sheetid={$sheetid}&articleid={$item.id}" title="">{$item.title}</a></span>
		<span class="issueNum"></span>
		<div class="fix"></div>
	    </div>

	    <div class="issueSummary">
		    {if $item.favicon}
		    <a href="#" title="" class="floatleft"><img src="{$item.favicon}" alt="" /></a>
		    {else}
		    <a href="#" title="" class="floatleft"><img src="/images/question.png" alt="" /></a>
		    {/if}
		<div class="ticketInfo">
		    <b>Posted by {$item.feedname}, {$item.time}</b><br>
		    {$item.content}
		    <div class="fix"></div>
		</div>
		<div class="fix"></div>
	    </div> 
	</div>
	{/foreach}
	{/widget}
	{elseif $cph.weather}
	{widget title="Weather" class='iCloud'}
	<img src="{$cph.weather.icon}" style="float: left; display: block;" />
	<div class="weatherdiv" style="height: 65px;">
	    <h2 style="margin-left: 20px; float: left;">Weather for {$cph.weather.location|capitalize}</h2><br />
	<h3 style="float: left; margin-left: 20px; margin-top: 8px;">{$cph.weather.c}</h3>
	</div>
	{/widget}
	{/if}
    {/if}
    {/if}
    {/foreach}
    {assign var="order" value={math equation="x+1" x=$order}}
{/foreach}
{/right_widgets}
{include 'footer.tpl'}