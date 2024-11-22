<?php if($wp->request == 'contact'){
	include(get_template_directory().'/contact/index.php');
} else if($wp->request == 'contact/confirm'){
	include(get_template_directory().'/contact/confirm.php');
}else if($wp->request == 'contact/complete'){
	include(get_template_directory().'/contact/complete.php');
}else {
	get_template_part('error/404', get_post_format() );
}?>
