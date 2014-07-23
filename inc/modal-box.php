<?php
function alimir_bootModal_form() {
	if (!is_user_logged_in()) :
		?>
		<div id="alimir_bootmodal" class="modal fade" tabindex="-1" data-width="370" data-backdrop="static" data-keyboard="false" style="display: none;">
		<div class="tab-content">
		<div class="tab-pane active fade in" id="login_tab">		
		<?php load_bootmodal_template('login-form'); ?>
		</div>
		<?php if (get_option( 'can_register_option' ) != 1): ?>
		<div class="tab-pane fade in" id="register_tab">		
		<?php load_bootmodal_template('registrer-form'); ?>
		</div>
		<?php endif; ?>
		<div class="tab-pane fade in" id="lostpass_tab">		
		<?php load_bootmodal_template('lostpass-form'); ?>
		</div>
		</div>
		</div>
		<?php
	else :
		load_bootmodal_template('user-profile');
	endif;
}
?>