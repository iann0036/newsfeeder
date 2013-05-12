{include 'header.tpl' pagename=$article.title}
{widget title=$article.title class='iDoc'}
	{$article.content}
{/widget}
{left_widgets}
    {*widget title='Comments' class='iUserComment' nobody=true num='+2' numclass='blueNum'}         
    <div class="supTicket">
	<div class="issueType">
		<span class="issueInfo"><a href="#" title="">John Smith</a></span>
	    <span class="issueNum"><a href="#" title="">via <a href="#">slashdot.org</a></span>
	    <div class="fix"></div>
	</div>

	<div class="issueSummary">
		<a href="#" title="" class="floatleft"><img src="/images/user.png" alt="" /></a>	
	    <div class="ticketInfo">
		I think this article is relevant because it's on the coolest system in the world! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed adipiscing, massa sit amet scelerisque vestibulum, nibh lorem commodo massa, et eleifend sapien felis eget metus. Mauris mattis, sem eu interdum bibendum, massa ante dapibus lectus, adipiscing pulvinar diam enim malesuada sem. Vivamus commodo vehicula mauris, id volutpat ante porttitor sit amet. Curabitur id nisi sem. Nulla eu justo id arcu sagittis viverra quis in enim. Nunc convallis volutpat sollicitudin. 
		<div class="fix"></div>
	    </div>
	    <div class="fix"></div>
	</div> 
    </div>
    <div class="supTicket">
	<div class="issueType">
		<span class="issueInfo"><a href="#" title="">John Smith</a></span>
	    <span class="issueNum"><a href="#" title="">via <a href="#">slashdot.org</a></span>
	    <div class="fix"></div>
	</div>

	<div class="issueSummary">
		<a href="#" title="" class="floatleft"><img src="/images/user.png" alt="" /></a>	
	    <div class="ticketInfo">
		I think this article is relevant because it's on the coolest system in the world! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed adipiscing, massa sit amet scelerisque vestibulum, nibh lorem commodo massa, et eleifend sapien felis eget metus. Mauris mattis, sem eu interdum bibendum, massa ante dapibus lectus, adipiscing pulvinar diam enim malesuada sem. Vivamus commodo vehicula mauris, id volutpat ante porttitor sit amet. Curabitur id nisi sem. Nulla eu justo id arcu sagittis viverra quis in enim. Nunc convallis volutpat sollicitudin. 
		<div class="fix"></div>
	    </div>
	    <div class="fix"></div>
	</div> 
    </div>
    {/widget*}
    {widget nohead=true nobody=true}
    <div class="head opened" id="toggleOpened"><h5>Article Details</h5></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
    <tbody>
	<tr class="noborder">
	    <td width="50%">Posted by:</td>
	    <td align="right"><strong class="red">{if $article.feedname}{$article.feedname}{else}Unknown{/if}</strong></td>
	</tr>
	<tr>
	    <td>Posted on:</td>

	    <td align="right">{$article.time}</td>
	</tr>
	<tr>
	    <td>URL:</td>
	    <td align="right"><a href="{$article.url}" title="">{$article.url|truncate:30:"...":true}</a></td>
	</tr>

	<tr>
	    <td>Author:</td>
	    <td align="right"><a href="#" class="green">{if $article.author}{$article.author}{else}Unknown{/if}</a></td>
	</tr>
    </tbody>
    </table>
    {/widget}
{/left_widgets}
{right_widgets}
{widget nohead=true nobody=true}
{if $article.geo}
<div class="head closed"><h5>Geolocation</h5></div>
<div class="body"><iframe width="350" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?q={$article.geo}&amp;ie=UTF8&amp;t=m&amp;z=5&amp;vpsrc=0&amp;output=embed"></iframe></div>
{/if}
<div class="head closed"><h5>Images</h5></div>
<div class="body">
<div class="pics">
{if $images}
<ul>
    {foreach from=$images item=image}
    <li><a href="{$image.url}" title="" rel="prettyPhoto"><img src="{$image.data}" alt="" /></a>
	<!--<div class="actions">
	    <a href="#" title=""><img src="/images/edit.png" alt="" /></a>
	    <a href="#" title=""><img src="/images/delete.png" alt="" /></a>
	</div>-->
    </li>
    {/foreach}
</ul> 
{else}
Sorry, no images found.
{/if}
<div class="fix"></div>
</div>
</div>
{/widget}
{/right_widgets}
{include 'footer.tpl'}