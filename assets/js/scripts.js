jQuery(document).ready(function($) {
    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
        $('form#login div.status').show().html(ajax_login_object.loadingmessage).hide().slideDown("fast");
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: { 
					'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
					'username': $('form#login #username').val(), 
					'password': $('form#login #password').val(), 
					'security': $('form#login #security').val() },
				success: function(data){
					$('form#login div.status').html(data.message).fadeIn().delay(6000).slideUp();
					if (data.loggedin == true){
						document.location.href = ajax_login_object.redirecturl;
					}
				}
			});
        e.preventDefault();
    });
	
	$('form#regform').on('submit', function(e) {
		$('form#regform div.status').show().html(ajax_login_object.registrationloadingmessage).hide().slideDown("fast");
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: { 
					'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
					'user_login': $('form#regform #user_login').val(), 
					'user_email': $('form#regform #user_email').val(), 
					'security2': $('form#regform #security2').val() },
			success: function(data){
				$('form#regform div.status').html(data.message).fadeIn().delay(8000).slideUp();
			}
			});
		e.preventDefault();
	});

});
