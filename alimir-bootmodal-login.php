<?php

/*
Plugin Name: Ajax BootModal Login
Plugin URI: http://wordpress.org/plugins/ajax-bootmodal-login
Description: wordpress modal login, poweres by bootstrap and ajax. you can use this plugin for better login and show user profile with new shape.
Version: 1.0.1
Author: Ali Mirzaei
Author URI: http://alimir.ir
License: GPLv2 or later
*/

load_plugin_textdomain( 'alimir', false, dirname( plugin_basename( __FILE__ ) ) .'/lang/' );

if(is_admin()):
	include( plugin_dir_path( __FILE__ ) . 'Settings.php');
endif;

function alimir_bootModal_method() {
	if (get_option( 'option_checkbox' ) != 1):
	if (!is_rtl()):
	wp_enqueue_style( 'bootstrap', plugins_url('assets/css/bootstrap.min.css', __FILE__) );
	else:
	wp_enqueue_style( 'rtl-bootstrap', plugins_url('assets/css/rtl-bootstrap.min.css', __FILE__) );
	endif;
	wp_enqueue_script(
		'bootstrap',
		plugins_url( '/assets/js/bootstrap.min.js' , __FILE__ ),
		array( 'scriptaculous' )
	);	
	endif;
	wp_enqueue_style( 'bootstrap-modal', plugins_url('assets/css/bootstrap-modal.css', __FILE__) );
	wp_enqueue_script('jquery');
	wp_enqueue_script(
		'bootstrap-modal',
		plugins_url( '/assets/js/bootstrap-modal.js' , __FILE__ ),
		array( 'scriptaculous' )
	);
}
add_action( 'wp_enqueue_scripts', 'alimir_bootModal_method' );

function  alimir_bootModal_login_shortcode(){
	add_action( 'wp_footer', 'alimir_bootModal_form' );
	if (!is_user_logged_in()) :
	return '
		<button type="button" class="btn-block btn '.default_buttons().' '.default_sizes().'" data-toggle="modal" data-target="#alimir_bootmodal">'.login_button_text().'</button>
	';
	else:
	if (get_option( 'option_usermodal' ) != 1):
	return '
		<button type="button" class="btn-block btn '.default_buttons().' '.default_sizes().'" data-toggle="modal" data-target="#alimir_bootmodal">'. login_button_text() .'</button>
	';
	else:
	return '
		<button type="button" class="btn-block btn '.default_buttons().' '.default_sizes().' disabled" disabled="disabled">'. login_button_text() .'</button>
	';	
	endif;
	endif;
}
add_shortcode( 'Alimir_BootModal_Login', 'alimir_bootModal_login_shortcode' );

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

function alimir_bootModal_ajax_login_init(){
	if (!is_admin()) :
	wp_register_script(
		'ajax-login-script',
		plugins_url( '/assets/js/scripts.js' , __FILE__ ),
		array( 'jquery' )
	);
	wp_enqueue_script( 'ajax-login-script' );
	endif;

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => admin_url(),
        'loadingmessage' => __('<p class="alert" data-alert="alert">Sending user info, please wait...</p>','alimir'),
		'registrationloadingmessage' => __( '<p class="alert" data-alert="alert">Processing Registration...</p>', 'alimir' )
    ));

    add_action( 'wp_ajax_nopriv_ajaxregister', 'alimir_bootModal_ajax_registration' );
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'alimir_bootModal_ajax_login' );
}
add_action('init', 'alimir_bootModal_ajax_login_init');

// Login Process

function alimir_bootModal_ajax_login(){

    check_ajax_referer( 'ajax-login-nonce', 'security' );

    $credentials = array();
    $credentials['user_login'] = $_POST['username'];
    $credentials['user_password'] = $_POST['password'];
    $credentials['remember'] = true;
	if ( $credentials['user_login'] == null || $credentials['user_password'] == null  ){
		echo json_encode(array('loggedin'=>false, 'message'=>__('<p class="alert alert-info" data-alert="alert">Please fill all the fields.</p>','alimir')));
	}
	else{
	if ($credentials['user_login'] != null && $credentials['user_password'] != null){
    $errors = wp_signon( $credentials, false );
	}
    if ( is_wp_error($errors) ){
		$display_errors = __('<p class="alert alert-error" data-alert="alert"><strong>ERROR</strong>: Wrong username or password.</p>','alimir');
        echo json_encode(array('loggedin'=>false, 'message'=>$display_errors));
	}
    else{
        echo json_encode(array('loggedin'=>true, 'message'=>__('<p class="alert alert-success" data-alert="alert">Login successful, redirecting...</p>','alimir')));
	}
	}
    die();
}

// Register Process

function alimir_bootModal_ajax_registration() {

	check_ajax_referer( 'ajax-form-nonce', 'security2' );

	$user_login = $_POST['user_login'];
	$user_email = $_POST['user_email'];
	if ( $user_login == null || $user_email == null  ){
		echo json_encode(array('registered'=>false, 'message'=>__('<p class="alert alert-info" data-alert="alert">Please fill all the fields.</p>','alimir')));
	}
	else{
	$errors = register_new_user($user_login, $user_email);	
	if ( is_wp_error( $errors ) ) {

		$registration_error_messages = $errors->errors;
		$display_errors = '<div class="alert alert-error" data-alert="alert">';
		foreach($registration_error_messages as $error){
			$display_errors .= '<div>'.$error[0].'</div>';
		}
		$display_errors .= '</div>';
		echo json_encode( array(
			'registered' => false,
			'message'  => $display_errors,
		) );

	} else {
		echo json_encode( array(
			'registered' => true,
			'message'  => __( '<p class="alert alert-success" data-alert="alert">Registration complete. Please check your e-mail.</p>', 'alimir' ),
		) );
	}
	}
	die();

}

// Main Forms
	
function alimir_bootModal_form() {
	if (!is_user_logged_in()) :
		?>
		<div id="alimir_bootmodal" class="modal hide fade" tabindex="-1" data-width="360">
		<div class="tab-content">
		<div class="tab-pane active fade in" id="login_tab">		
		<?php include( plugin_dir_path( __FILE__ ) . 'tmp/login-form.php'); ?>
		</div>
		<?php if (get_option( 'can_register_option' ) != 1): ?>
		<div class="tab-pane fade in" id="register_tab">		
		<?php include( plugin_dir_path( __FILE__ ) . 'tmp/registrer-form.php'); ?>
		</div>
		<?php endif; ?>
		</div>
		</div>
		<?php
	else :
		include( plugin_dir_path( __FILE__ ) . 'tmp/login-profile.php');
	endif;
}

// Update User View

function alimir_bootModal_update_user_view() {
	if (is_user_logged_in() && is_single()) :
		
		global $post;
		$user_id = get_current_user_id();
		$posts = get_user_meta( $user_id, 'alimir_viewed_posts', true );
		if (!is_array($posts)) $posts = array();
		if (sizeof($posts)>4) array_shift($posts);
		if (!in_array($post->ID, $posts)) $posts[] = $post->ID;
		update_user_meta( $user_id, 'alimir_viewed_posts', $posts );
		
	endif;
}
add_action('wp_head', 'alimir_bootModal_update_user_view');

// Sidebar Widget

wp_register_widget_control(
	'alimir_bootModal_login',
	'alimir_bootModal_login',
	'alimir_bootModal_widget_control'
);

wp_register_sidebar_widget(
    'alimir_bootModal_login',
    'Ajax BootModal Login',
    'alimir_bootModal_widget',
    array(
        'description' => 'wordpress modal login, poweres by bootstrap and ajax. you can use this plugin for better login and show user profile with new shape.'
    )
);

function alimir_bootModal_widget($args) {
   $widgettitle = get_option('about_us_widget_title');
   extract($args);
   echo $before_widget;
   echo $before_title . $widgettitle . $after_title;
   echo $after_widget;
   echo do_shortcode('[Alimir_BootModal_Login]');
}

function alimir_bootModal_widget_control($args=array()) {
	if (isset($_POST['submitted'])) {
		update_option('about_us_widget_title', $_POST['widgettitle']);
	}	
	$widgettitle = get_option('about_us_widget_title');
	?>
	<br />
	<?php _e('Title:','alimir') ?><br /><br />
	<input type="text" class="widefat" name="widgettitle" value="<?php echo stripslashes($widgettitle); ?>" />
	<br /><br />
	<input type="hidden" name="submitted" value="1" />
	<?php
}

?>