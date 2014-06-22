<?php
/*
Plugin Name: Ajax BootModal Login
Plugin URI: http://wordpress.org/plugins/ajax-bootmodal-login
Description: Ajax BootModal Login is a WordPress plugin that is powered by bootstrap and ajax for better login, registration or lost password and display the user profile with beautiful shape. It is an easy to use WordPress plugin and can be configured quickly.
Version: 1.2.2
Author: Ali Mirzaei
Author URI: http://alimir.ir
License: GPLv2 or later
*/
session_start();
ob_start();

load_plugin_textdomain( 'alimir', false, dirname( plugin_basename( __FILE__ ) ) .'/lang/' );

//admin setting
if(is_admin()):
include( plugin_dir_path( __FILE__ ) . 'inc/settings.php');
endif;

//functions
include( plugin_dir_path( __FILE__ ) . 'inc/functions.php');

//scripts
include( plugin_dir_path( __FILE__ ) . 'inc/scripts.php');

//shortcode
include( plugin_dir_path( __FILE__ ) . 'inc/shortcode.php');

//ajax authenticate
include( plugin_dir_path( __FILE__ ) . 'inc/authenticate.php');

//Modal box
include( plugin_dir_path( __FILE__ ) . 'inc/modal-box.php');

//widget
include( plugin_dir_path( __FILE__ ) . 'inc/widget.php');

?>