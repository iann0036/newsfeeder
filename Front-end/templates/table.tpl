<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
	<tr>
	    {foreach $headers as $header}
	    <th>{$header}</th>
	    {/foreach}
	</tr>
    </thead>
    <tbody>
	{foreach $data as $rowitem}
	<tr class="gradeA">
	    {foreach $rowitem as $dataitem}
	    <td>{$dataitem}</td>
	    {/foreach}
	</tr>
	{/foreach}
	</tr>
    </tbody>
</table>