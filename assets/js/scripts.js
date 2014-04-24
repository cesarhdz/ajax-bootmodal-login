jQuery(document).ready(function($) {
    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: { 
					'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
					'username': $('form#login #username').val(), 
					'password': $('form#login #password').val(), 
					'security': $('form#login #security').val() },
				beforeSend:function(){
				$('form#login div.status').show().html('<div class="loader"></div>');
				},	
				success: function(data){
					$('form#login div.status').html(data.message).fadeIn();
					if (data.loggedin == true){
						document.location.href = ajax_login_object.redirecturl;
					}
				}
			});
        e.preventDefault();
    });
	// Perform AJAX register on form submit
	$('form#regform').on('submit', function(e) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: { 
					'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
					'user_login': $('form#regform #user_login').val(), 
					'user_email': $('form#regform #user_email').val(), 
					'security2': $('form#regform #security2').val() },
				beforeSend:function(){
				$('form#regform div.status').show().html('<div class="loader"></div>');
				},						
				success: function(data){
					$('form#regform div.status').html(data.message).fadeIn();
				}
			});
		e.preventDefault();
	});
	// Perform AJAX password on form submit
	$('form#passform').on('submit', function(e) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: {
					'action'     : 	'ajaxlostpass', // Calls our wp_ajax_nopriv_ajaxlogin
					'lost_pass'   : 	$('form#passform #lost_pass').val(),
					'security3'   : 	$('form#passform #security3').val()
				},
				beforeSend:function(){
				$('form#passform div.status').show().html('<div class="loader"></div>');
				},								
				success: function(data){
					$('form#passform div.status').html(data.message).fadeIn();
				}
			});
			e.preventDefault();
	});	
	
	$("#register_tab a,#lostpass_tab a,#login_tab a,.close").click(function(){
		$('div.status').slideUp();
	});
});
