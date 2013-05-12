{include 'header.tpl' pagename='Search for Feeds'}
{widget title='Search for '|cat:$searchterm class='iMagnify'}
<div id="results" name="results"><img src="/images/loaders/loader6.gif" /></div>
{/widget}
<script>
var getInt;

function getResults() {
    $.ajax({
      type: "GET",
      url: "/account/feeds/ajax.php",
      data: { searchterm: "{$searchterm}" },
      success: function(msg) {
	document.getElementById('results').innerHTML = msg;  
    }});
}
getInt = setInterval(function(){ getResults(); },3000);
</script>
{include 'footer.tpl'}
