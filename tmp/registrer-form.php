<form id="regform" action="register" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
    <h3><?php _e('User Registration','alimir'); ?></h3>
  </div> 
  <div class="modal-body">
  	<div class="status"></div>
    <div class="row-fluid control-group">
		<label><?php _e('Username','alimir'); ?>
        <input type="text" name="user_login" id="user_login" class="span12" value="" /></label>
		<label><?php _e('E-mail','alimir'); ?>
        <input type="password" name="user_email" id="user_email" class="span12" value="" /></label>
		<span class="label label-info"><a href="#login_tab" data-toggle="tab"><?php _e('Already registered? Login','alimir'); ?></a></span>
		<span class="label"><?php echo _e('A password will be emailed to you.','alimir') ?></span>
    </div>
  </div>
  <div class="modal-footer">
        <button type="submit" name="user-sumbit" id="user-submit" class="btn <?php echo default_buttons(); ?> <?php echo default_sizes(); ?> btn-block"><?php _e('Submit','alimir'); ?></button>
		<input type="hidden" name="register" value="true" />
  </div>
   <?php wp_nonce_field( 'ajax-form-nonce', 'security2' ); ?>
</form>