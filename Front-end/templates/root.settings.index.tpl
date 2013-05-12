{include 'header.tpl' pagename='Settings'}
{form action='/settings/update.php' method='POST'}
    {widget title='Account Settings' class='iSettings2' nobody=true}
	<div class="rowElem noborder">
	    <label>Secure Browsing: </label>
	    <div class="formRight">
		<input type="checkbox" id="ssl" name="ssl"{if $protocol eq 'https://'} checked="checked"{/if} /><label for="ssl">Enable SSL</label>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem">
	    <label>Layout: </label>
	    <div class="formRight">
		<input type="checkbox" id="layout" name="layout"{if $layout eq 'dark'} checked="checked"{/if} /><label for="layout">Use Dark Layout</label>
	    </div>
	    <div class="fix"></div>
	</div>
	<input type="submit" value="Update Settings" class="greyishBtn submitForm" />
	<div class="fix"></div>
    {/widget}
{/form}
{include 'footer.tpl'}