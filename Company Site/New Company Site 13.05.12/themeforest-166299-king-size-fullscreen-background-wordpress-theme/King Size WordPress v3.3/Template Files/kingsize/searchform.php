<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
<div class="searchinput">
<input type="text"
class="inputbox" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Search" />
</div>
</form>