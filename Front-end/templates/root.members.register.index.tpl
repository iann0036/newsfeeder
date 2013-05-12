{include 'header.tpl' pagename='Register'}
    {form action='/members/register/index.php' method='POST' enctype='multipart/form-data'}
	{widget title='Register an Account' class='iPencil' nobody=true}
	    <div class="rowElem noborder">
		<label>Name:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="name" id="name"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
		<label>Username:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="username" id="username"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
                    <label for="password">Password:</label>
                    <div class="formRight">
			<input type="password" class="validate[required]" name="password" id="password" />
		    </div>
                    <div class="fix"></div>
            </div>
	    <div class="rowElem noborder">
		<label>E-mail:</label>
		<div class="formRight">
		    <input type="text" class="validate[required,custom[email]]" name="email" id="email"/>
		</div>
		<div class="fix"></div>
	    </div>
	    <div class="rowElem noborder">
		<label>Profile Photo:</label> 
		<div class="formRight">
		    <input type="file" class="fileInput" id="photo" name="photo" />
		</div>
		<div class="fix"></div>
	    </div>
	    <input type="submit" value="Register Account" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	{/widget}
    {/form}
{include 'footer.tpl'}