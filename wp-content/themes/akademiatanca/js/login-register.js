var LoginRegister = {
	url_$_GET: function(param)  {
		var vars = {};
		window.location.href.replace( location.hash, '' ).replace( 
			/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
			function( m, key, value ) { // callback
				vars[key] = value !== undefined ? value : '';
			}
		);
	
		if(param) {
			return vars[param] ? vars[param] : null;	
		}
		return vars;
	},
	checkbox_security: function(id, clear_only) {
		$(id).removeClass('checked').prop('checked',false);  
		$(id).closest('.form-group').find('span').css({'color':'#00192d'}); 
		if(clear_only != 1) {
			$(id).on('click', function() {
				$(this).toggleClass('checked');
			});
		}
	},
	general_clear: function() {
		$('#general-erorr').html('');
		$('#general-message').html('');
		$('#logreg-loader').hide();
	},
	login_box: function() {
		var login_btn 	= $('#login-btn');
		var overlay		= $('#logreg-container');
		var login_box	= $('#logreg-box');
		var close_btn 	= $(login_box).find('.fa-close');
		
		function resetForm(){
			$("#u_login_form").validate().resetForm(); 
			$("#remind_form").validate().resetForm(); 
			$('#logreg-box .form-control').removeClass('error');
			LoginRegister.checkbox_security('#u_login_check', 1);
			LoginRegister.checkbox_security('#rem_check', 1);
			LoginRegister.checkbox_security('#u_register_check', 1);
		};
		
		LoginRegister.checkbox_security('#u_login_check', 0);
		LoginRegister.checkbox_security('#rem_check', 0);
		LoginRegister.checkbox_security('#u_register_check', 0);
			
		$(login_btn).on('click', function() {
			$('a[href="#logowanie"]').tab('show');
			$(overlay).fadeIn(500);
			$(login_box).css({'display':'block', 'opacity':'0', 'top':'45%'}).animate({opacity:1, top:'50%'}, 500);
			close_box();
			resetForm();
			LoginRegister.general_clear();
		});
		
		function close_box() {
			$(close_btn).on('click', function() {
				$(login_box).animate({opacity:0, top:'45%'}, 500).fadeOut();
				setTimeout(function() {
					$(login_box).stop(false, true);
				},400);
				$(overlay).fadeOut(500);
			});
		};
		
	},
	
	login_proccess: function() {
		var loader = $('#logreg-loader');
		var validator = $("#u_login_form").validate({
			submitHandler: function(form) {
				LoginRegister.general_clear();
				
				if(!$('#u_login_check').hasClass('checked')) {
					$('#u_login_check').closest('.form-group').find('span').css({'color':'#f00'});
				}else {
					$('#u_login_check').closest('.form-group').find('span').css({'color':'#00192d'});
					$(loader).fadeIn();
					var login = $('#u_login').val();
					var pass  = $('#u_password').val();
					var check = $('#u_login_check').val();
					var data = {
						action	: 'proccess_login',
						login	: login,
						pass	: pass,
						check	: check,
					};
					$.post(frontendajax.ajaxurl, data, function(response) {
						//console.log(response);
						setTimeout(function() {
							if(response == 'error-login') {
								$(loader).fadeOut();
								validator.showErrors({
									'u_login': 'Nieprawidłowy login lub hasło',
									'u_password': 'Nieprawidłowy login lub hasło',
								});	
							}else if(response == 'not-active') {
								$(loader).fadeOut();
								$('#general-erorr').html('Twoje konto nie zostało aktywowane. Jeżeli nie otrzymałeś/aś maila z linkiem aktywacyjnym, skontaktuj się z nami');	
							}else if(response == 'success') {
								window.location.replace(document.location.origin + document.location.pathname);
							}else {
								$(loader).fadeOut();
								$('#general-erorr').html('Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z nami');	
							}
						},1000);
					});
				}
				return false;
			},
			rules: {
				'u_login': {required: true,},
				'u_password': {required:true,},
			},
			messages: {
				'u_login': {required: 'Podaj login',},
				'u_password': {required: 'Podaj hasło',},
			},
			/* invalidHandler: function(form, validator) {
				var errors = validator.numberOfInvalids();
				if(errors) {
					setTimeout(function() {
					$('#u_login_check.error').closest('.checkbox-box').css({'border':'solid 1px red'});
					},500);
				}
			}, */
		});	
	},
	
	remind_proccess: function() {
		var loader = $('#logreg-loader');
		var validator = $("#remind_form").validate({
			submitHandler: function(form) {
				LoginRegister.general_clear();
				
				if(!$('#rem_check').hasClass('checked')) {
					$('#rem_check').closest('.form-group').find('span').css({'color':'#f00'});
				}else {
					$('#rem_check').closest('.form-group').find('span').css({'color':'#00192d'});
					$(loader).fadeIn();
					var email = $('#rem_email').val();
					var check = $('#rem_check').val();
					var data = {
						action	: 'proccess_remind',
						email	: email,
						check	: check,
					};
					$.post(frontendajax.ajaxurl, data, function(response) {
						setTimeout(function() {
							$(loader).fadeOut();
							if(response == 'error-user') {
								validator.showErrors({
									'rem_email': 'Podany adres email nie jest zarejestrowany',
								});	
							}else if(response == 'success') {
								$('#general-message').html('Twoje hasło zostało wysłane mailem');
								$('#rem_email').val('');
								$('#rem_check').prop('checked', false).removeClass('checked');
							}else {
								$('#general-erorr').html('Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z nami');	
							}
						},1000);
					});
				}
				return false;
			},
			rules: {
				'rem_email': {required: true, email:true,},
			},
			messages: {
				'rem_email': {required: 'Podaj adres e-mail', email:'Nieprawidłowy adres email'},
			},
		});	
	},
	
	registration_proccess: function() {
		var loader = $('#logreg-loader');
		$.validator.addMethod("phone_number", function( value, element ) {
			return this.optional(element) ||  /^[0-9 \-]+$/i.test( value );
		});
		
		var validator = $("#u_register_form").validate({
			submitHandler: function(form) {
				LoginRegister.general_clear();
				
				if(!$('#u_register_check').hasClass('checked')) {
					$('#u_register_check').closest('.form-group').find('span').css({'color':'#f00'});
				}else {
					$('#u_register_check').closest('.form-group').find('span').css({'color':'#00192d'});
					$(loader).fadeIn();
					var name  = $('#u_register_name').val();
					var email = $('#u_register_email').val();
					var phone = $('#u_register_phone').val();
					var check = $('#u_register_check').val();
					var data = {
						action	: 'proccess_registration',
						name	: name,
						email	: email,
						phone	: phone,
						check	: check,
					};
					$.post(frontendajax.ajaxurl, data, function(response) {
						setTimeout(function() {
							$(loader).fadeOut();
							if(response == 'user-exists') {
								validator.showErrors({
									'u_register_email': 'Podany adres email jest już zarejestrowany',
								});	
							}else if(response == 'empty-fields') {
								$('#general-erorr').html('Wypełnij wszystkie pola');	
							}else if(response == 'success') {
								ga('send', 'event', 'Rejestracja', 'zapisz', 'Załóż konto', 1);
								$('#general-message').html('Rejestracja zakończona sukcesem. <br/>Twoje hasło zostało wysłane mailem');
								$('#u_register_name').val('');
								$('#u_register_email').val('');
								$('#u_register_phone').val('');
								$('#u_register_check').prop('checked', false).removeClass('checked');
							}else {
								$('#general-erorr').html('Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z nami');	
							}
						},1000);
					});
				}
				return false;
			},
			rules: {
				'u_register_name': {required: true,},
				'u_register_email': {required: true, email:true,},
				'u_register_phone': {required: true, phone_number:true,},
			},
			messages: {
				'u_register_email': {required: 'Podaj adres e-mail', email:'Nieprawidłowy adres email'},
				'u_register_phone': {required: 'Podaj numer telefonu', phone_number:'Nieprawidłowy numer telefonu'},
				'u_register_name': {required: 'Podaj imię i nazwisko',},
			},
		});
	},
	
	onDOMready: function() {
		if($('#login-btn').length) {
			this.login_box();
			this.login_proccess();
			this.remind_proccess();
			this.registration_proccess();
		}
	},
	onLOad: function() {
		if($('#login-btn').length) {
			if(LoginRegister.url_$_GET('wpadmin') == 1) {
				$('#login-btn').trigger('click');	
			}
		}
	}
}

jQuery(document).ready(function($) {	
	LoginRegister.onDOMready();
});
jQuery(window).load(function($) {
		LoginRegister.onLOad();
});
