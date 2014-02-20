<div id="alimir_bootmodal" class="modal hide fade" tabindex="-1" data-width="360">
<form id="login" action="login" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
    <h3><?php _e('User Login','alimir'); ?></h3>
  </div> 
  <div class="modal-body">
  	<div class="status"></div>
    <div class="row-fluid control-group">
		<label><?php _e('User Name','alimir'); ?>
        <input type="text" name="username" id="username" class="span12" value="" /></label>
		<label><?php _e('Password','alimir'); ?>
        <input type="password" name="password" id="password" class="span12" value="" /></label>
    </div>
  </div>
  <div class="modal-footer">
        <button type="submit" name="submit" id="wp-submit" class="btn <?php echo default_buttons(); ?> <?php echo default_sizes(); ?> btn-block"><?php _e('Submit','alimir'); ?></button>
  </div>
   <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
  </form>
</div>