{include 'header.tpl' pagename='Manage Feeds'}
<script>
	function confirmDelete(url) {
		jConfirm('Can you confirm this delete feed action?', 'Confirmation Dialog', function(r) {
			if (r) {
			    window.location = url;
			}
		});
	};
</script>
{$headers=array('Name','URL','Remove')}
{widget title='Your Feeds' class='iArchive' nobody=true}{include 'table.tpl' headers=$headers data=$data}{/widget}
{left_widgets}
    {form action='/account/feeds/search.php' method='POST'}
    	{widget title='Search for Feeds' class='iMagnify' nobody=true}
	    <div class="rowElem noborder">
		<label>Search&nbsp;Term:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="searchterm" id="searchterm"/>
		</div>
		<div class="fix"></div>

	    </div>
	    <input type="submit" value="Search" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	{/widget}
    {/form}
{/left_widgets}
{right_widgets}
    {form action='/account/feeds/import.php' method='POST' enctype='multipart/form-data'}
	{widget title='Import OPML' class='iTransfer' nobody=true}
	    <div class="rowElem noborder">
		<label>OPML&nbsp;File:</label> 
		<div class="formRight">
		    <input type="file" class="fileInput" id="fileInput" name="opml" />
		</div>
		<div class="fix"></div>
	    </div>
	    <input type="submit" value="Begin Import" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	{/widget}
    {/form}
{/right_widgets}
{include 'footer.tpl'}