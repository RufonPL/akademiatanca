var AJAX = {
	signup_form_proccess: function() {
		var body		= $('body, html');
		var popup 		= $('#signup-popup');
		var overlay 	= $('#overlay');
		var close_btn 	= $('#signup-popup .fa-close');
		var signup_btn  = $('.signup-container .signup-btn');
		var course_data = {};
		
		function show_popup() {
			$(overlay).fadeIn(500);
			$(popup).css({'display':'block', 'opacity':'0'}).animate({opacity:1, top:'50%'}, 500);
			ga('send', 'event', 'Kursy', 'zapisz', 'Zapis na kurs', 1);
		};
		function close_popup() {
			$(overlay).fadeOut();
			$(popup).animate({opacity:0, top:'40%'}, 500).fadeOut();
			course_data.length = 0;
			clear_form_fields();
			$(body).css({'overflow':'auto'});
		};
		
		$(close_btn).on('click', function() {
			close_popup();
		});
		$(overlay).on('click', function() {
			close_popup();
		});
		
		function clear_form_fields() {
			if(!$('.signuplogged').length) {
				$('#sp_fullname').val('');
				$('#sp_e_mail').val('');
			}
			$('#sp_phone').val('');
			$('#sp_info').val('');
			$('input.error').removeClass('error');
			$('label.error').fadeOut(); 
		}; clear_form_fields();
		
		/* function show_message(message) {
			var close_icon = '<i class="fa fa-close"></i>';
			$('#sp-loader').fadeOut(200);
			$('#sp-loader-container').animate({opacity:1},400);	
			$('.singnup-popup-inner').fadeOut();
			$('#sp-message').html(message+close_icon).animate({opacity:1},500);
			var message_h = $('#sp-message').outerHeight();
			$(popup).animate({height:message_h+'px', width:'500px'},300);
		}; */
		
		/* function reset_proccess() {
			$(overlay).fadeOut();
			$('#sp-loader-container').fadeOut();
			$('#sp-loader-container').animate({opacity:0.7},400);
			clear_form_fields();
			$(popup).animate({opacity:0, top:'40%'}, 500).fadeOut();
			setTimeout(function() {
				$('.singnup-popup-inner').fadeIn();
				$('#sp-loader').fadeIn();
				$('#sp-message').html('').animate({opacity:0},100);
				$(popup).css({'height':'auto', 'width':'auto'});
			},500);
		} */
		
		$(signup_btn).on('click', function() {
			show_popup();
			$(body).css({'overflow':'hidden'});
			$('#signup-message').html('');
			var course_name 		= $(this).closest('.st-course').attr('data-course-name');
			var course_type 		= $(this).closest('.st-course').attr('data-course-type');
			var course_level 		= $(this).closest('.st-course').attr('data-course-level');
			var course_level_id		= $(this).closest('.st-course').attr('data-course-level-id');
			var course_no 			= $(this).closest('.st-course').find('.stc-number').attr('data-stc-number');
			//var course_days 		= $(this).closest('.st-course').find('.stc-day').attr('data-stc-days');
			//var course_start_time 	= $(this).closest('.st-course').find('.stc-time').attr('data-stc-start-time');
			//var course_end_time 	= $(this).closest('.st-course').find('.stc-time').attr('data-stc-end-time');
			var course_start_date 	= $(this).closest('.st-course').find('.stc-date').attr('data-stc-start-date');
			var course_end_date 	= $(this).closest('.st-course').find('.stc-date').attr('data-stc-end-date');
			var course_place 		= $(this).closest('.st-course').find('.stc-place').attr('data-stc-place');
			var course_instructor 	= $(this).closest('.st-course').find('.stc-instructor').text();
			var course_instructor_id= $(this).closest('.st-course').find('.stc-instructor').attr('data-stc-instructor');
			var course_price 		= $(this).closest('.st-course').find('.stc-price').text();
			var course_pricelist 	= $(this).closest('.st-course').find('.stc-price').attr('data-stc-pricelist');
			var course_daytime_days = $(this).closest('.st-course').find('.stc-daytime-days p');
			var course_daytime_times= $(this).closest('.st-course').find('.stc-daytime-times p');
			
			var course_days_times	= [],
				course_daytime		= {};
			
			course_daytime_days.add(course_daytime_times).each(function() {
                var that = $(this);
				course_days_times.push(that.text());
            });
			var arr_size = course_days_times.length;
			/* console.log(course_days_times);
			console.log(arr_size); */
			for(var i=0; i<arr_size/2; i++) {
				course_daytime[course_days_times[i]] = course_days_times[i+arr_size/2];
			}
			//console.log(course_daytime);
			
			course_type_text = course_type ? ' - ' + course_type : '';
			course_level_text = course_level ? ', ' + course_level : '';
			
			$(popup).find('.course-name').text(course_name + course_type_text + course_level_text);
			$(popup).find('.course-number').text(course_no);
			$(popup).find('.course-price').text(course_price);
			
			course_data = {
				action: 'course_signup',
				course_name: course_name,
				course_type: course_type,
				course_level: course_level,
				course_level_id: course_level_id,
				course_no: course_no,
				//course_days: course_days,
				//course_start_time: course_start_time,
				//course_end_time: course_end_time,
				course_start_date: course_start_date,
				course_end_date: course_end_date,
				course_place: course_place,
				course_instructor: course_instructor,
				course_instructor_id: course_instructor_id,
				course_price: course_price,
				course_pricelist: course_pricelist,
				daystimes: JSON.stringify(course_daytime)
			};
			
			$('.payment-methods .p').on('click', function() {
				var radio = $(this).find('.pm-radio');
				$('.pm-radio').removeClass('active');
				$(radio).addClass('active');
				
				var payment_method = $(this).find('.active').closest('.p').find('.payment-method').text();
				var payment_info = '';
				if(payment_method == 'Przelew') {
					payment_info = $('.bank-details').html();	
				}
				course_data['payment_method'] = payment_method;
				course_data['payment_info'] = payment_info;
			});
			$('.payment-methods .p:first-child').trigger('click');
		});
		
		$.validator.addMethod("phone_check", function(value, element) {
			return this.optional( element ) || /^[0-9 -]+$/i.test( value );
		}, "incorrect phone no");
		validator = $("#signupform2").validate({
			submitHandler: function(form) {
				$('#sp-loader-container').fadeIn(700);
				
				var first_name  = $('#sp_first_name').val();
				var last_name  	= $('#sp_last_name').val();
				//var name  		= $('#sp_fullname').val();
				var email 		= $('#sp_e_mail').val();
				var phone 		= $('#sp_phone').val();
				var info  		= $('#sp_info').val();
				var source		= $('#sp_source').val();
				
				course_data['source'] = source;
				course_data['client_first_name'] = first_name;
				course_data['client_last_name'] = last_name;
				//course_data['client_name'] = name;
				course_data['client_email'] = email;
				course_data['client_phone'] = phone;
				course_data['client_info'] = info;
				var data = course_data;
				
				$.post(frontendajax.ajaxurl, data, function(response){
					//console.log(response);
					setTimeout(function() {
						$('#sp-loader-container').fadeOut(100);
						clear_form_fields();
						if(response=='success') {
							//message = '';
							$('#signup-message').removeClass('message-error').addClass('message-success').html('<h6>Twoje zgłoszenie zostało przyjęte. Skontaktujemy się z Tobą</h6>');
						}else if(response=='is-on-course') {
							//message = '';
							$('#signup-message').removeClass('message-error').addClass('message-error').html('<h6>Jesteś już zapisany/a na ten kurs</h6>');
						}else {
							//message = ;	
							$('#signup-message').removeClass('message-success').addClass('message-error').html('<h6>Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z nami</h6>');
						}
					},1000);
					/* setTimeout(function() {
						show_message(message)
					},1000);
					$('#sp-message').on('click', function() {
						reset_proccess();
					}); */
				});
				return false;
			},
			rules: {
				'sp_first_name': {required: true,},
				'sp_last_name': {required: true,},
				//'sp_fullname': {required: true,},
				'sp_e_mail': {required:true, email:true,},
        'sp_rodo':{required: true,},
				//'sp_phone': {required:true, phone_check:true,},
			},
			messages: {
				'sp_first_name': {required: 'Podaj imię',},
				'sp_last_name': {required: 'Podaj nazwisko',},
				//'sp_fullname': {required: 'Podaj imię i nazwisko',},
				'sp_e_mail': {required: 'Podaj adres email', email: 'Nieprawidłowy adres email',},
				//'sp_phone': {required: 'Podaj nr telefonu', phone_check: 'Nieprawidłowy nr telefonu',},
			},
		});
	},
	home_form_proccess: function() {
		var signup_form 	= $('#signupform');
		var dance_category 	= $('#dance_category');
		var dance_type		= $('#dance_type');
		
		var loader			= $('#redirect-loader-overlay');
		var type_loader		= $('#type-loader');
		
		$(dance_category).val('0');
		
		$(dance_category).on('change', function() {
			$(type_loader).animate({opacity:1},300);
			var label = $('#dance_category option:selected').html();
			if($(this).val() != 0) {
				var data = {
					action: 'get_dances_by_category',
					url: $(dance_category).val(),
					label: label,
				};
				$.post(frontendajax.ajaxurl, data, function(response){
					$(type_loader).animate({opacity:0},300);
					if(response[0] == 'success') {
						$(dance_type).closest('.select-box').removeClass('error');
						$(dance_type).html(response[1]);
					}else if(response == 'no-dances') {
						$(dance_type).html('<option value="0">Brak tańców tej kategorii</option>');	
						$(dance_type).closest('.select-box').addClass('error');
					}
				});	
			}else {
				$(type_loader).animate({opacity:0},300);
				$(dance_type).closest('.select-box').removeClass('error');
				$(dance_type).html('<option value="0">-- Wybierz dla kogo --</option>');
			}
		});
		
		$(signup_form).submit(function(e) {
            e.preventDefault();
			
			if($(dance_category).val() == 0) {
				$(dance_category).closest('.select-box').addClass('error');
			}else {
				$(dance_category).closest('.select-box').removeClass('error');
				var url = $(dance_category).val() + $(dance_type).val();
				$(loader).fadeIn();
				ga('send', 'event', 'Kursy', 'zapisz', 'Zapis na kurs ze strony głównej', 1);
				setTimeout(function() {
					window.location.replace(url);
				},1500);
			}
			$(dance_category).on('change', function() {
				if($(this).val() != 0) {
					$(this).closest('.select-box').removeClass('error');	
				}
			});
        });
	},
	account_personal_data: function() {
		var loader = $('<div></div>', {
			id: 'mini-loader'	
		});
		var success_msg = $('<h5></h5>', {
			class: 'medium text-center',
			text: 'Twoje dane zostały zapisane',
			style: 'color:#090'
		});
		var error_msg = $('<h5></h5>', {
			class: 'medium text-center',
			text: 'Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z nami',
			style: 'color:#F00'
		});
		
		var button = $('#personal_submit');
		$(button).attr('disabled', false);
		
		$.validator.addMethod("phone_check", function(value, element) {
			return this.optional( element ) || /^[0-9 -]+$/i.test( value );
		}, "incorrect phone no");
		var validator = $("#personal_form").validate({
			submitHandler: function(form) {
				var name  = $('#personal_name').val();
				var email = $('#personal_email').val();
				var phone = $('#personal_phone').val();
				
				var data = {
					action: 'account_personal_save',
					name: name,
					email: email,
					phone: phone	
				}
				
				$(button).attr('disabled', true);
				$(button).parent().append(loader);
				
				$.post(frontendajax.ajaxurl, data, function(response){
					console.log(response);
					setTimeout(function() {
						$(button).attr('disabled', false);
						$(loader).remove();
						if(response == 'success') {
							$(success_msg).fadeIn();
							$("#personal_form").append(success_msg)
							setTimeout(function() {
								$(success_msg).fadeOut();
							},5000);	
						}else {
							$(error_msg).fadeIn();
							$("#personal_form").append(error_msg)
							setTimeout(function() {
								$(error_msg).fadeOut();
							},5000);	
						}
					},1000);
				});
				
				return false;
			},
			rules: {
				'personal_name': {required: true,},
				'personal_email': {required:true, email:true,},
				'personal_phone': {required:true, phone_check:true,},
			},
			messages: {
				'personal_name': {required: 'Podaj imię i nazwisko',},
				'personal_email': {required: 'Podaj adres email', email: 'Nieprawidłowy adres email',},
				'personal_phone': {required: 'Podaj nr telefonu', phone_check: 'Nieprawidłowy nr telefonu',},
			},
		});
	},
	account_password: function() {
		var loader = $('<div></div>', {
			id: 'mini-loader'	
		});
		var success_msg = $('<h5></h5>', {
			class: 'medium text-center',
			text: 'Twoje hasło zostało zmienione',
			style: 'color:#090'
		});
		var error_msg = $('<h5></h5>', {
			class: 'medium text-center',
			text: 'Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z nami',
			style: 'color:#F00'
		});
		
		var button = $('#personal_pass_submit');
		$(button).attr('disabled', false);
		
		function count_down() {
			var counter = 6;
			setInterval(function() {
				counter--;
				if (counter >= 0) {
					$("#pass-changed").text('Zostaniesz wylogowany za: '+counter+' sekund.');
				}
				if (counter === 0) {
					clearInterval(counter);
					location.reload();
				}
			}, 1000);
    	}
		
		$.validator.addMethod("pwcheck", function(value) {
		   return /^[A-Za-z0-9]*$/.test(value) // consists of only these
			   && /[a-z]/.test(value) // has a lowercase letter
			   && /[A-Z]/.test(value) // has a lowercase letter
			   && /\d/.test(value) // has a digit
		});
		
		var validator = $("#password_form").validate({
			submitHandler: function(form) {
				var pass  			= $('#personal_pass').val();
				var pass_repeat 	= $('#personal_pass_repeat').val();
				var pass_current 	= $('#personal_pass_current').val();
				
				var data = {
					action: 'account_new_password',
					pass: pass,
					pass_repeat: pass_repeat,
					pass_current: pass_current	
				}
				
				$(button).attr('disabled', true);
				$(button).parent().append(loader);
				
				$.post(frontendajax.ajaxurl, data, function(response){
					console.log(response);
					setTimeout(function() {
						$(button).attr('disabled', false);
						$(loader).remove();
						if(response == 'success') {
							$(success_msg).fadeIn();
							$("#password_form").append(success_msg);
							count_down();
						}else if(response == 'wrong-pass') {
							validator.showErrors({
							  'personal_pass_current': 'Nieprawidłowe hasło',
							});
						}else {
							$(error_msg).fadeIn();
							$("#password_form").append(error_msg)
							setTimeout(function() {
								$(error_msg).fadeOut();
							},5000);	
						}
					},1000);
				});
				
				return false;
			},
			rules: {
				'personal_pass': {required: true, pwcheck: true, minlength: 8,},
				'personal_pass_repeat': {equalTo: '#personal_pass'},
				'personal_pass_current': {required:true,},
			},
			messages: {
				'personal_pass': {required: 'Podaj nowe hasło', pwcheck: 'Hasło musi być alfanumeryczne i zawierać min. 1 małą i dużą literę oraz cyfrę', minlength: 'Hasło jest zbyt krótkie'},
				'personal_pass_repeat': {required: 'Powtórz hasło', equalTo: 'Hasła muszą być takie same'},
				'personal_pass_current': {required: 'Wpisz aktualne hasło',},
			},
		});
	},
	
	onDOMready: function() {
		this.signup_form_proccess();
		this.home_form_proccess();
		this.account_personal_data();
		this.account_password();
	}
}

jQuery(document).ready(function($) {
	AJAX.onDOMready();
});