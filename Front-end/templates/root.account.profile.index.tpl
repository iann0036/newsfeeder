{include 'header.tpl' pagename='Profile'}
{form action='/account/profile/update.php' method='POST'}
    {widget title='Profile Information' class='iFiles' nobody=true}
	<div class="rowElem" noborder>
	    <label>Username:</label>
	    <div class="formRight">
		<input type="text" disabled="disabled" value="admin" name="username"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Password:</label>
	    <div class="formRight">
		<input type="password" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Confirm password:</label>
	    <div class="formRight">
		<input type="password" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Name:</label>
	    <div class="formRight">
		<input type="text" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>E-mail:</label>
	    <div class="formRight">
		<input type="text" class="validate[required]" name="name" id="name" value="Admin"/>
	    </div>
	    <div class="fix"></div>
	</div>
	<div class="rowElem noborder">
	    <label>Profile&nbsp;Picture:</label> 
	    <div class="formRight">
		<input type="file" class="fileInput" id="fileInput" name="opml" />
	    </div>
	    <div class="fix"></div>
	</div>
	<input type="submit" value="Update Profile" class="greyishBtn submitForm" />
	<div class="fix"></div>
    {/widget}
{/form}
{include 'footer.tpl'}