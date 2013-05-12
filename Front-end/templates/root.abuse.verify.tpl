{include 'header.tpl' pagename='Abuse'}
{widget title='Verify Site Ownership' class='iAlert2'}
<p>Please insert the following code EXACTLY as it is below onto your index page, that is, the page that is visited when browsing to your domain directly.</p>
<p><code>&lt;meta name="nfauth" content="{$metacontent}" /&gt;</code>
<form method="POST" action="verify.php">
    <input type="hidden" name="key" value="{$metacontent}" />
    <b>Domain: </b><input type="text" name="domain" />
    <input type="submit" value="Verify" />
</form>
</p>
{/widget}
{include 'footer.tpl'}