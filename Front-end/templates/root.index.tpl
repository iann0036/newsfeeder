{include 'header.tpl' pagename='Home'}
{left_widgets}
{widget title='An Introduction' class='iFilmStrip'}
<iframe src="https://player.vimeo.com/video/45568466" width="424" height="240" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
{/widget}
{widget title='Website Statistics' class='iChart8' nobody=true}
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
	    <td align="center"><a href="#" title="" class="webStatsLink">{$stats.curr_users}</a></td>

	    <td>total users</td>
	    <td><span{if $stats.curr_users < $stats.prev_users} class="statMinus"{elseif $stats.curr_users >= $stats.prev_users} class="statPlus"{/if}>{math equation="abs((y-x)/x*100)" x=$stats.curr_users y=$stats.prev_users format="%.2f"}%</span></td>
	</tr>
	<tr>
	    <td align="center"><a href="#" title="" class="webStatsLink">{$stats.curr_sheets}</a></td>
	    <td>total sheets</td>
	    <td><span{if $stats.curr_sheets < $stats.prev_sheets} class="statMinus"{elseif $stats.curr_sheets >= $stats.prev_sheets} class="statPlus"{/if}>{math equation="abs((y-x)/x*100)" x=$stats.curr_sheets y=$stats.prev_sheets format="%.2f"}%</span></td>

	</tr>
	<tr>
	    <td align="center"><a href="#" title="" class="webStatsLink">{$stats.curr_feeds}</a></td>
	    <td>total feeds</td>
	    <td><span{if $stats.curr_feeds < $stats.prev_feeds} class="statMinus"{elseif $stats.curr_feeds >= $stats.prev_feeds} class="statPlus"{/if}>{math equation="abs((y-x)/x*100)" x=$stats.curr_feeds y=$stats.prev_feeds format="%.2f"}%</span></td>
	</tr>
	<tr>

	    <td align="center"><a href="#" title="" class="webStatsLink">{$stats.curr_items}</a></td>
	    <td>total items</td>
	    <td><span{if $stats.curr_items < $stats.prev_items} class="statMinus"{elseif $stats.curr_items >= $stats.prev_items} class="statPlus"{/if}>{math equation="abs((y-x)/x*100)" x=$stats.curr_items y=$stats.prev_items format="%.2f"}%</span></td>
	</tr>
	</tbody>
</table>
{/widget}
{/left_widgets}
{right_widgets}
{widget title='About News Feeder' class='iInfo'}<p>News Feeder is a service which acts as an online news feed aggregator. It's main purpose is to provide a single location and format to view news content instead of our users having to go to a number of different websites for their specific news.</p>
<p>News Feeder allows it's users to specify preferences as to which type of articles they wish to view. These can be based on a number of criteria such as location, category, author, publishing site or specific feed URL's. The system will crawls feeds which match these criteria and store the articles in the system's database. The stored content can be of any media type, including text, images, video and geolocation information.</p>
<p>Our user's can then view the stored content in an organised layout, similar to that of a standard news sheet. These sheets will allow our user's to set a number of filtering options to ensure certain types of content are not displayed to them.</p>{/widget}
{/right_widgets}
{include 'footer.tpl'}
