{include 'header.tpl' pagename='Administration'}
<script>
	function confirmDelete(url) {
		jConfirm('Can you confirm this delete user action?', 'Confirmation Dialog', function(r) {
			if (r) {
			    window.location = url;
			}
		});
	};
</script>
{widget title='Server Actions' class='iRobot'}
<div id="connectaction">
<a href="#" onclick="sendSocketAction('status');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/electroPlug.png" alt="" class="icon" /><span>Connect</span></a>
</div>
<div id="serveractions" style="display: none">
<br /><a href="#" onclick="sendSocketAction('start');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/play.png" alt="" class="icon" /><span>Start Server</span></a>
<a href="#" onclick="sendSocketAction('stop');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/stop.png" alt="" class="icon" /><span>Stop Server</span></a>
<a href="#" onclick="sendSocketAction('restart');" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/refresh3.png" alt="" class="icon" /><span>Restart Server</span></a>
<a href="/admin/config.php" title="" class="btnIconLeft mr10"><img src="/images/icons/dark/settings.png" alt="" class="icon" /><span>Change Config</span></a>
</div>
{/widget}
{widget title='User List' class='iUsers2' nobody=true}
<div id="myList-nav"></div><ul id="myList">
    {foreach from=$users item=user}
    <li><a href="#">{$user.name} ({$user.username})</a>
	<ul class="listData">
	    <li><a href="#" title="">{$user.email}</a></li>
	    {if $user.isMe}
	    <li><i>That's you!</i></li>
	    {else}
	    <li><a href="#" onclick="confirmDelete('/admin/deleteuser.php?username={$user.username}')"><span class="red">Delete</span></a></li>
	    {/if}
	    {if $user.admin}
	    <li><span class="cNote">admin</span></li>
	    {else}
	    <li><span class="cNote">user</span></li>
	    {/if}
	</ul>
    </li>
    {/foreach}
</ul><div class="fix"></div>
{/widget}
{widget title='Logs' class='iError'}
<iframe style="width: 100%;" src="/admin/logs.php">Loading...</iframe>
{/widget}
{include 'footer.tpl'}