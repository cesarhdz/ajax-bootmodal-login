<?php
add_action('admin_menu', 'alimir_bootModal_create_menu');

function alimir_bootModal_create_menu() {
	add_options_page(__( 'BootModal Login Settings', 'alimir' ),__( 'BootModal Login Settings', 'alimir' ), 'administrator', __FILE__, 'alimir_bootModal_settings_page', __FILE__);
	add_action( 'admin_init', 'alimir_bootModal_register_mysettings' );
}


function alimir_bootModal_register_mysettings() {
	register_setting( 'alimir-bootModal-settings-group', 'option_checkbox' );	
	register_setting( 'alimir-bootModal-settings-group', 'option_usermodal' );	
	register_setting( 'alimir-bootModal-settings-group', 'button_text' );	
	register_setting( 'alimir-bootModal-settings-group', 'button_text2' );	
	register_setting( 'alimir-bootModal-settings-group', 'default_buttons' );
	register_setting( 'alimir-bootModal-settings-group', 'default_sizes' );
}

function alimir_bootModal_settings_page() {
?>
<div class="wrap">
<h2><?php _e('Alimir Ajax BootModal Login','alimir'); ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'alimir-bootModal-settings-group' ); ?>
    <?php do_settings_sections( 'alimir-bootModal-settings-group' ); ?>
    <table class="form-table">
		<p class="update-nag"><?php _e('Using <code>[Alimir_BootModal_Login]</code> shortcode, to display ajax bootmodal login.','alimir'); ?></p>
		
        <tr valign="top">
        <th scope="row"><?php _e('Non-use BootStrap modules','alimir'); ?></th>
        <td>
		<input name="option_checkbox" type="checkbox" value="1" <?php checked( '1', get_option( 'option_checkbox' ) ); ?> />
		<p class="description"><?php _e('If your theme support bootstrap, Check this option.','alimir'); ?></p>
		</td>
        </tr>
		
        <tr valign="top">
        <th scope="row"><?php _e('Deactivate User Panel','alimir'); ?></th>
        <td>
		<input name="option_usermodal" type="checkbox" value="1" <?php checked( '1', get_option( 'option_usermodal' ) ); ?> />
		<p class="description"><?php _e('This option disables user modal profile button.','alimir'); ?></p>
		</td>
        </tr>
		
        <tr valign="top">
        <th scope="row"><?php _e('Login Button Text','alimir'); ?></th>
        <td><input type="text" name="button_text" value="<?php echo get_option('button_text'); ?>" /></td>
        </tr>
		
        <tr valign="top">
        <th scope="row"><?php _e('Profile Button Text','alimir'); ?></th>
        <td><input type="text" name="button_text2" value="<?php echo get_option('button_text2'); ?>" /></td>
        </tr>			
		
        <tr valign="top">
        <th scope="row"><?php _e('Default buttons','alimir'); ?></th>
		<td>
		<fieldset>
		<label><input name="default_buttons" type="radio" value="0" <?php checked( '0', get_option( 'default_buttons' ) ); ?> />btn-primary</label><br />
		<label><input name="default_buttons" type="radio" value="1" <?php checked( '1', get_option( 'default_buttons' ) ); ?> />btn-info</label><br />
		<label><input name="default_buttons" type="radio" value="2" <?php checked( '2', get_option( 'default_buttons' ) ); ?> />btn-success</label><br />
		<label><input name="default_buttons" type="radio" value="3" <?php checked( '3', get_option( 'default_buttons' ) ); ?> />btn-warning</label><br />
		<label><input name="default_buttons" type="radio" value="4" <?php checked( '4', get_option( 'default_buttons' ) ); ?> />btn-danger</label><br />
		<label><input name="default_buttons" type="radio" value="5" <?php checked( '5', get_option( 'default_buttons' ) ); ?> />btn-inverse</label>
		<p class="description"><?php _e('choose your button style.','alimir'); ?></p>
		</fieldset>
		</td>
        </tr>
		
        <tr valign="top">
        <th scope="row"><?php _e('Button sizes','alimir'); ?></th>
		<td>
		<fieldset>
		<label><input name="default_sizes" type="radio" value="0" <?php checked( '0', get_option( 'default_sizes' ) ); ?> />btn-large</label><br />
		<label><input name="default_sizes" type="radio" value="1" <?php checked( '1', get_option( 'default_sizes' ) ); ?> />btn-small</label><br />
		<label><input name="default_sizes" type="radio" value="2" <?php checked( '2', get_option( 'default_sizes' ) ); ?> />btn-mini</label>
		<p class="description"><?php _e('choose your button size.','alimir'); ?></p>
		</fieldset>
		</td>
        </tr>
    </table>
	<h2><?php _e('Like this plugin?','alimir'); ?></h2>
		<p>
		<?php _e('Show your support by Rating 5 Star in <a href="http://wordpress.org/plugins/ajax-bootmodal-login"> Plugin Directory reviews</a>','alimir'); ?><br />
		<?php _e('Follow me on <a href="https://www.facebook.com/alimir.ir"> Facebook</a>','alimir'); ?>
		</p>
		<p class="update-nag">
		<?php _e('Plugin Author Blog: <a href="http://alimir.ir"> Wordpress & Programming World.</a>','alimir'); ?>
		</p>
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>