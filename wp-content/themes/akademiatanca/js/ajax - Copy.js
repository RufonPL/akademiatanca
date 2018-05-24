var AJAX = {
	signup_form_proccess: function() {
		var signup_form = $('#signupform');
		var popup 		= $('#signup-popup');
		var overlay 	= $('#overlay');
		var close_btn 	= $('#signup-popup .fa-close');
		var signup_btn  = $('.signup-container .signup-btn');
		
		function show_popup() {
			$(overlay).fadeIn(500);
			$(popup).css({'display':'block', 'opacity':'0'}).animate({opacity:1, top:'50%'}, 500);
		};
		function close_popup() {
			$(close_btn).on('click', function() {
				$(overlay).fadeOut();
				$(popup).animate({opacity:0, top:'40%'}, 500).fadeOut();
				clear_form_fields();
			});
		};
		function clear_form_fields() {
			$('#sp_full_name').val('');
			$('#sp_email').val('');
			$('#sp_phone').val('');
			$('#sp_info').val('');
			$('input.error').removeClass('error');
			$('label.error').fadeOut();
		}; clear_form_fields();
		
		function show_loader_container() {
			$('#sp-loader-container').fadeIn(700);	
		};
		function show_message(message) {
			var close_icon = '<i class="fa fa-close"></i>';
			$('#sp-loader').fadeOut(200);
			$('#sp-loader-container').animate({opacity:1},400);	
			$('.singnup-popup-inner').fadeOut();
			$('#sp-message').html(message+close_icon).animate({opacity:1},500);
			var message_h = $('#sp-message').outerHeight();
			$(popup).animate({height:message_h+'px', width:'500px'},300);
		};
		
		function reset_proccess() {
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
		}
		
		$(signup_form).submit(function(e) {
            e.preventDefault();
			show_popup();
        });
		$(signup_btn).on('click', function() {
			if($('.signup-table').length) {
				var course_name = $(this).closest('.st-course').attr('data-course-name');
				var course_type = $(this).closest('.st-course').attr('data-course-type');
				var course_level = $(this).closest('.st-course').attr('data-course-level');
			}
			var course_no = $(this).closest('.st-course').find('.stc-nunmber').text();
			var course_day = $(this).closest('.st-course').find('.stc-day').text();
			var course_time = $(this).closest('.st-course').find('.stc-time').text();
			var course_start = $(this).closest('.st-course').find('.stc-date').text();
			var course_place = $(this).closest('.st-course').find('.stc-place').text();
			var course_instructor = $(this).closest('.st-course').find('.stc-instructor').text();
			var course_price = $(this).closest('.st-course').find('.stc-price').text();
			show_popup();
			$(popup).find('.course-name').text(course_name+' - '+course_type+', '+course_level);
			$(popup).find('.course-number').text(course_no);
			$(popup).find('.course-price').text(course_price);
			
			$('.payment-methods .p').on('click', function() {
				var radio = $(this).find('.pm-radio');
				$('.pm-radio').removeClass('active');
				$(radio).addClass('active');
				
				var payment_method = $(this).find('.payment-method').text();
				
				var payment_info = '';
				if(payment_method == 'Przelew') {
					payment_info = $('.bank-details').html();	
				}
				function resetForm(){
					$('#signupform2')[0].reset();
					validator.resetForm();    
				};
				$.validator.addMethod("phone_check", function(value, element) {
					return this.optional( element ) || /^[0-9 -]+$/i.test( value );
				}, "incorrect phone no");
				validator = $("#signupform2").validate({
					submitHandler: function(form) {
						show_loader_container();
						console.log(course_no);
						var name  = $('#sp_full_name').val();
						var email = $('#sp_email').val();
						var phone = $('#sp_phone').val();
						var info  = $('#sp_info').val();
						var source= $('#sp_source').val();
						var data  = {
							action: 'course_signup',
							course_name: course_name,
							course_type: course_type,
							course_level: course_level,
							course_no: course_no,
							course_day: course_day,
							course_time: course_time,
							course_start: course_start,
							course_place: course_place,
							course_instructor: course_instructor,
							course_price: course_price,
							payment_method: payment_method,	
							payment_info: payment_info,
							client_name: name,
							client_email: email,
							client_phone: phone,
							client_info: info,
							source: source, 
						};
						$.post(frontendajax.ajaxurl, data, function(response){
							resetForm();
							if(response=='success') {
								message = '<h5>Twoje zgłoszenie zostało przyjęte</h5> <h5>Skontaktujemy się z Tobą</h5>';
								$('#sp-message').addClass('message-success');
							}else {
								message = '<h5>Wystąpił błąd.</h5> <h5>Spróbuj ponownie lub skontaktuj się z nami</h5>';	
							}
							setTimeout(function() {
								show_message(message)
							},1000);
							$('#sp-message').on('click', function() {
								reset_proccess();
							});
						});
						return false;	
					},
					rules: {
						'sp_full_name': {required: true,},
						'sp_email': {required:true, email:true,},
						'sp_phone': {required:true, phone_check:true,},
					},
					messages: {
						'sp_full_name': {required: 'Podaj imię i nazwisko',},
						'sp_email': {required: 'Podaj adres email', email: 'Nieprawidłowy adres email',},
						'sp_phone': {required: 'Podaj nr telefonu', phone_check: 'Nieprawidłowy nr telefonu',},
					},
				});
			});
			$('.payment-methods .p:first-child').trigger('click');
		});
		
		close_popup();
	},
	
	onDOMready: function() {
		this.signup_form_proccess();
	}
}

jQuery(document).ready(function($) {
	AJAX.onDOMready();
});