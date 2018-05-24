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
			$(overlay).fadeOut();
			$(popup).animate({opacity:0, top:'40%'}, 500).fadeOut();
			//clear_form_fields();
		};
		
		$(close_btn).on('click', function() {
			close_popup();
		});
		
		$(signup_form).submit(function(e) {
            e.preventDefault();
			show_popup();
        });
		
		$(signup_btn).on('click', function() {
			show_popup();
		});
		
		/* $("#signupform2").on('submit', function(e) {
			e.preventDefault();
			console.log('sent');
		}); */
		
		$.validator.addMethod("phone_check", function(value, element) {
			return this.optional( element ) || /^[0-9 -]+$/i.test( value );
		}, "incorrect phone no");
		validator = $("#signupform2").validate({
			submitHandler: function(form) {
				console.log('sent');
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
	},
	
	onDOMready: function() {
		this.signup_form_proccess();
	}
}

jQuery(document).ready(function($) {
	AJAX.onDOMready();
});