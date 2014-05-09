<?php 
function login_button_text(){
	if (!is_user_logged_in()):
	if (get_option('button_text') == null):
		return __('Login','alimir');
	else:
		return get_option('button_text');
	endif;
	else:
	if (get_option('button_text2') == null):
		return __('Profile','alimir');
	else:
		return get_option('button_text2');
	endif;	
	endif;	
}

function default_buttons(){
	if (get_option( 'default_buttons' )==0)
	return 'btn-primary';
	else if (get_option( 'default_buttons' )==1)
	return 'btn-info';
	else if (get_option( 'default_buttons' )==2)
	return 'btn-success';
	else if (get_option( 'default_buttons' )==3)
	return 'btn-warning';
	else if (get_option( 'default_buttons' )==4)
	return 'btn-danger';
	else if (get_option( 'default_buttons' )==5)
	return 'btn-inverse';
}

function default_sizes(){
	if (get_option( 'default_sizes' )==0)
	return 'btn-large';
	else if (get_option( 'default_sizes' )==1)
	return 'btn-small';
	else if (get_option( 'default_sizes' )==2)
	return 'btn-mini';
}
?>