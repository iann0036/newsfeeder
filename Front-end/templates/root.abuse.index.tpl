{include 'header.tpl' pagename='Abuse'}
{widget title='Report Abuse' class='iAlert2'}
<p>Before being able to report abuse with this service you must first verify your website.</p>

<p>To verify that you own a site, you have a number of options. You can:</p>

<ul>
    <li>Add a meta tag to your home page (proving that you have access to the source files). To use this method, you must be able to edit the HTML code of your site's pages. <a href="#">Use this method.</a></li>
    <li>Create a file with the name we provide you to the root of your server. To use this method, you must be able to create new files on your server.</li>
    <li>Add a DNS TXT record. To use this method, you must be able to sign in to your domain registrar or hosting provider and add a new DNS record.</li>
</ul>

<small>* News Feeder Reporting will check to see that the specified tag, file, or record is present. If it is, we consider you a site owner and you will be able to remove your website from this service.<br />
* We don't use the verification file we ask you to create for any purpose other than to make sure you can upload files to the site.</small>


{/widget}
{include 'footer.tpl'}