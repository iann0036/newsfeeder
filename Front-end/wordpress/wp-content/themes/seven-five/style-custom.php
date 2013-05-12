body {
background:<?php if (get_option(THEME_PREFIX . "background_color")) { ?> #<?php echo get_option(THEME_PREFIX . "background_color"); ?><?php } ?><?php if (get_option(THEME_PREFIX . "background_img")) { ?> url(<?php echo get_option(THEME_PREFIX . "background_img"); ?>) <?php echo get_option(THEME_PREFIX . "background_vert"); ?> <?php echo get_option(THEME_PREFIX . "background_horiz"); ?> <?php echo get_option(THEME_PREFIX . "background_repeat"); ?><?php if (get_option(THEME_PREFIX . "background_fixed")) { ?> fixed<?php } ?><?php } ?>;
color: <?php if (get_option(THEME_PREFIX . "content_text_color")) { ?>#<?php echo get_option(THEME_PREFIX . "content_text_color"); ?><?php } ?>;
}

#delicious-last-item, #feed-last-item, #comments-last-item {
background: #<?php echo get_option(THEME_PREFIX . "background_color"); ?>;
}

a:link, a:visited {
color: #<?php echo get_option(THEME_PREFIX . "background_link_color"); ?>;
}

a:hover {
color: #<?php echo get_option(THEME_PREFIX . "background_link_hover_color"); ?>;
}

#menu a {
background: #<?php echo get_option(THEME_PREFIX . "background_nav_hover_color"); ?>;
}

#header, .content-item, .tweet, #delicious li, #feed li, ul.commentlist li.alt, ul.commentlist li {
border-bottom: 1px solid #<?php echo get_option(THEME_PREFIX . "background_border_color"); ?>;
}

#comment, #author, #email, #url {
border: 1px solid #<?php echo get_option(THEME_PREFIX . "background_border_color"); ?>;	
}