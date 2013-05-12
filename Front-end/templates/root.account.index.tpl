{include 'header.tpl' pagename='Dashboard'}
<script>
	function confirmDelete(url) {
		jConfirm('Can you confirm this delete sheet action?', 'Confirmation Dialog', function(r) {
			if (r) {
			    window.location = url;
			}
		});
	};
</script>
{$headers=array('Name','Last Updated','Edit','Remove')}
{widget title='News Sheets' class='iDocs' nobody=true}{include 'table.tpl' headers=$headers data=$data}{/widget}
{left_widgets}
    {form action='index.php' method='POST'}
	{widget title='Add Sheet' class='iAdd' nobody=true}
	    <div class="rowElem noborder">
		<label>Sheet&nbsp;Name:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="sheetname" id="sheetname"/>
		</div>
		<div class="fix"></div>

	    </div>
	    <input type="submit" value="Add Sheet" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	{/widget}
    {/form}
{/left_widgets}
{right_widgets}
    {form action='/account/feeds/search.php' method='POST'}
    	{widget title='Search for Feeds' class='iMagnify' nobody=true}
	    <div class="rowElem noborder">
		<label>Search&nbsp;Term:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="searchterm" id="searchterm"/>
		</div>
		<div class="fix"></div>

	    </div>
	    <input id="search" type="submit" value="Search" class="greyishBtn submitForm" onclick="document.getElementById('search').value = 'Searching...';" />
	    <div class="fix"></div>
	{/widget}
    {/form}
{/right_widgets}
{include 'footer.tpl'}
