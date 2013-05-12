{include 'header.tpl' pagename='Contact'}
{left_widgets}
    {widget title='Contact Information' class='iUsers'}
    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.au/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Wollongong+University,+Northfields+Ave,+University+of+Wollongong+NSW&amp;aq=t&amp;sll=-32.342841,147.32666&amp;sspn=10.073408,21.643066&amp;ie=UTF8&amp;hq=Wollongong+University,+Northfields+Ave,+University+of&amp;hnear=Wollongong+New+South+Wales&amp;t=m&amp;cid=2886925379413737025&amp;ll=-34.404714,150.885544&amp;spn=0.038453,0.084543&amp;output=embed"></iframe><br />
    <p><b>Address: </b>News Feeder Co<br />
		    Bld 3, Northfields Ave<br />
		    University of Wollongong NSW 2522</p>
    <p><b>E-mail: </b>{mailto address="support@newsfeeder.co" text="support@newsfeeder.co"}</p>
    {/widget}
{/left_widgets}
{right_widgets}
    {form action='/contact/index.php' method='POST'}
	{widget title='Contact Form' class='iDoc' nobody=true}
	    <div class="rowElem noborder">
		<label>Name:</label>
		<div class="formRight">
		    <input type="text" class="validate[required]" name="name" id="name"/>
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
		<label>Message:</label>
		<div class="formRight">
		    <textarea rows="8" cols="" name="message" class="validate[required]" id="message"></textarea>
		</div>

		<div class="fix"></div>
	    </div>
	    <input type="submit" value="Send Message" class="greyishBtn submitForm" />
	    <div class="fix"></div>
	{/widget}
    {/form}
{/right_widgets}
{include 'footer.tpl'}