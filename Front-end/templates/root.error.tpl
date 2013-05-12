{include 'header.tpl' nonav=true}
<div class="errorPage">
<h2 class="red errorTitle"><span>Something went wrong here</span></h2>

<h1>{$smarty.get.error}</h1>
<span class="bubbles"></span>
<p>Oops! Sorry, an error has occured.</p>
<div class="backToDash"><a href="/index.php" title="" class="seaBtn button">Back to Home</a></div>
{include 'footer.tpl'}