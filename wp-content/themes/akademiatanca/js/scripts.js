var APP = {
	register_functions: function() {
		$.fn.wrapMatch = function(count, className) {
			var length = this.length;
			for(var i = 0; i < length ; i+=count) {
				this.slice(i, i+count).wrapAll('<div ' + ((typeof className == 'string') ? 'class="'+className+'"' : '') + '/>');
			}
			return this;
		}; 
	},
	carousel_caption_fade : function() {
		var caption = $('#slider').find('.carousel-caption');
		$(caption).hide().fadeIn(500);
		$('#slider').bind('slide.bs.carousel', function (e) {
			$(caption).fadeOut();
		});
		
		$('#slider').bind('slid.bs.carousel', function (e) {
			$(caption).fadeIn(400);
		});	
	},
	carousel_image_center_mobile: function() {
		var image = $('.carousel-inner > .item > img');
		var image_w = $(image).outerWidth();	
		if($(window).width() < 769) {
			image_w = image_w == 0 ? 700 : image_w;
			if(image_w == 700) {
				var offset = (image_w - $(window).width())/2;
				$(image).css({'margin-left':-offset+'px'});
			}
		}else {
			$(image).css({'margin-left':'0px'});
		}
	},
	news_carousel_fade : function() {
		var slide = $('#news-slider').find('.news-slide');
		$(slide).hide().fadeIn(500);
		$('#news-slider').bind('slide.bs.carousel', function (e) {
			$(slide).fadeOut(500);
		});
		
		$('#news-slider').bind('slid.bs.carousel', function (e) {
			$(slide).fadeIn(400);
		});	
	},
	partners_carousel: function() {
		$('#partners').owlCarousel({
			loop:true,
			margin:10,
			nav:true,
			autoplay:true,
			autoplayTimeout:3000,
			touchDrag:false,
			autoplayHoverPause:true,
			pullDrag:false,
			mouseDrag:false,
			callbacks: true,
			navText: [
			   "<i class='fa fa-chevron-left'></i>",
			   "<i class='fa fa-chevron-right'></i>"
			],
			responsive:{
				0:{
					items:1
				},
				440: {
					items:2
				},
				640:{
					items:3
				}
			}
		});
	},
	instructors_more_btn: function() {
		$('.instructor').each(function() {
			var content   = $(this).find('.instructor-text');
            var text_H 	  = $(this).find('.instructor-description').outerHeight();
			var more	  = $(this).find('.instructor-more');
			var courses_H = $(this).find('.instructor-courses').outerHeight();
			var image_H   = $(this).find('.instructor-photo').outerHeight();
			
			var height1 = 160;
			var height2 = 295;
			var height3 = 210;
			var offset  = 30;
			
			if($(window).width()<961) {
				height2 = 260;
			}
			if($(window).width()<769) {
				height1 = 145;
				height2 = 225;
				offset  = 10; 
			}
			if($(window).width()<641) {
				height1 = 90;
				height2 = 320;
				offset  = image_H;
			}
			$(more).hide();
			$(content).css({'height': height3+'px'});
			$(this).animate({height: height2+'px'},500);
			
			if(text_H+courses_H > 205) {
				$(content).css({'height': height1+'px'});
				$(more).show();
			}
			
			var instructor = $(this)/* .closest('.instructor') */;
			var more_icon  = $(more).find('i');
			var more_text  = $(more).find('strong');
			
			function show_more() {
				$(more).addClass('open');
				$(content).css({'height':'auto'});
				$(instructor).animate({height:$(content).height()+75+offset},500);
				$(more_icon).removeClass('fa fa-caret-down');
				$(more_icon).addClass('fa fa-caret-up');
				$(more_text).text('Pokaż mniej');
			}
			function hide_more() {
				$(more).removeClass('open');
				$(content).animate({height: height1+'px'},500);
				$(instructor).animate({height: height2+'px'},500);
				$(more_icon).removeClass('fa fa-caret-up');
				$(more_icon).addClass('fa fa-caret-down');
				$(more_text).text('Pokaż więcej');
			}
			//slide up if open on resize
			$(more).removeClass('open');
			$(more_icon).removeClass('fa fa-caret-up');
			$(more_icon).addClass('fa fa-caret-down');
			$(more_text).text('Pokaż więcej');
			if($(more).is(':visible')) {
				$(more).unbind("click"); 
				$(more).on('click', function() {
					if($(this).hasClass('open')) {
						hide_more();
					}else {
						show_more();
					}
				});
			}
        });
	},
	wrap_news: function() {
		if ($(window).width() > 992) {  
			$('.news-item').wrapMatch(3,'col-md-12 col-sm-12 col-xs-12');
		}else if ($(window).width() > 768) {  
			$('.news-item').wrapMatch(2,'col-md-12 col-sm-12 col-xs-12');
		}		
	},
	gallery_caption_animation: function() {
		$('.gallery').each(function() {
			var gallery_item = $(this).find('.gallery-inner');
			var gallery_info = $(this).find('.gallery-info');
            var desc = $(this).find('.gallery-info h6');
			
			$(gallery_info).animate({opacity:1},500);
			
			if(desc.length) {
				var desc_h = $(desc).outerHeight();
				
				$(desc).css({'margin-bottom':-desc_h-5+'px'});
				$(gallery_item).hover(function() {
					$(desc).animate({marginBottom:0},300);
				}, function() {
					$(desc).animate({marginBottom:-desc_h-5+'px'},300);
				});
			}
        });
	},
	scroll_to_dance_level: function() {
		var anchor = $('.course-anchor-list a');
		$(anchor).on('click', function(e) {
			e.preventDefault();
			var id = $(this).attr('href');
			var a = $('.st-level[data-anchor*="'+id.replace("#", "")+'"]');
			if($(a).length) {
				b = $(a).offset().top-80;	
				$('html, body').animate({'scrollTop':b},1000);
			}
			//var target = $('.st-level'+id).offset().top-80;
		});
	},
	open_dance_tab: function() {
		$('.dances-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			console.log(e)
		  var that = $(this),
		  	url = that.attr('href'),
			scrollem = $('body').scrollTop() || $('html').scrollTop();
			window.location.hash = url;
			$('html,body').scrollTop(scrollem);
		});
		
		if(window.location.hash) {
			var hash = window.location.hash;
			hash = hash.replace(/!/g, '');
			if($('.dances-tabs').length) {
				var tab = $('.dances-tabs').find('a[href="'+hash+'"]');
				if(tab.length) {
					$(tab).trigger('click');
				}else {
					console.log('not found'); 
				}
			}
		}else {
			//console.log('no hash');	
		}
		return false;
	},
	courses_welcome_page: function() {
		//var course_page = $('.courses-page');
		if($('.course-welcome').length) {
			var welcome = $('.course-welcome');
			
			function content_align() {
				var container_H = $('.dance-container').outerHeight();
				var welcome_H 	= $('.course-welcome').outerHeight();
				var margin_top  = 0;
				if(container_H > welcome_H) {
					margin_top  = (container_H - welcome_H)/2-50;	
				}
				$(welcome).hide().css({'top':margin_top}).fadeIn(500);
			}; content_align();
		}
	},
	courses_sticky_menu: function() {
		$('.secondary-menu').addClass('original-menu').clone().insertAfter('.secondary-menu').addClass('cloned-menu').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original-menu').hide();
		
		scrollIntervalID = setInterval(stickIt, 10);

		function stickIt() {
			var orgElementPos = $('.original-menu').offset();
			orgElementTop = orgElementPos.top;               
			
			if ($(window).scrollTop() >= (orgElementTop)) {
				// scrolled past the original position; now only show the cloned, sticky element.
				// Cloned element should always have same left position and width as original element.     
				orgElement = $('.original-menu');
				coordsOrgElement = orgElement.offset();
				leftOrgElement = coordsOrgElement.left;  
				widthOrgElement = orgElement.css('width');
				$('.cloned-menu').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
				$('.original-menu').css({'visibility':'hidden','opacity':'0','height':'30px'});
			} else {
				// not scrolled past the menu; only show the original menu.
				$('.cloned-menu').hide();
				$('.original-menu').css({'visibility':'visible','opacity':'1','height':'auto'});
			}
			
		}
	},
	menu_mobile_adjustments: function() {
		if($(window).width() < 768) {
			$('.cloned-menu').closest('.secondary-menu').find('.social-media').addClass('hideit');
		}else {
			$('.cloned-menu').closest('.secondary-menu').find('.social-media').removeClass('hideit');
		}
	},
	video_popup: function() {
		var width = 1000;
		var height = 563;
		
		if($(window).width() < 1025) {
			width = 800;
			height = 450;	
		}
		if($(window).width() < 861) {
			width = 600;
			height = 338;	
		}
		if($(window).width() < 641) {
			width = 450;
			height = 254;	
		}
		if($(window).width() < 481) {
			width = 350;
			height = 198;	
		}
		if($(window).width() < 381) {
			width = 250;
			height = 141;	
		}
		if($(window).width() < 281) {
			width = 100+'%';
			height = 141;	
		}
		
		$('.video-play').colorbox({iframe:true, rel:'video-play', innerWidth:width, innerHeight:height});
		// close on resizing
		$.colorbox.close();
	},
	popup_adjustments: function() {
		var signup_btn  = $('.signup-container .signup-btn');
		
		function popup_adjust() {
			var popup 		= $('#signup-popup');
			var popup_inner = $(popup).find('.singnup-popup-inner');
			var browser 	= $(window);
			var popup_h 	= $(popup_inner).outerHeight()+50;
			var browser_h 	= $(browser).height()-100;
			
			$(popup_inner).css({'width':$(popup).width()+20+'px'});
			
			$(popup).css({'max-height':browser_h+'px'});
			if(browser_h < popup_h) {
				$(popup_inner).css({'overflow-y': 'scroll'});
			}else {
				$(popup_inner).css({'overflow-y': 'visible'});
				
			}
		}; popup_adjust();
		
		$(signup_btn).on('click', function() {
			var popup_h = $('#signup-popup').find('.singnup-popup-inner').outerHeight();
			$('#signup-popup').css({'height':popup_h+30+'px'});
			popup_adjust();
		});
	},
	custom_scrollbars_init: function() {
		$('.signup-container .table-responsive, .prices-container .table-responsive').mCustomScrollbar({
			axis:"x",
			theme:"inset-2-dark",
			autoExpandScrollbar:true,
			advanced:{autoExpandHorizontalScroll:true}
		});
		$('#signup-popup').mCustomScrollbar({
			theme:"inset-2-dark",
		});
		$('.account-courses .table-responsive').mCustomScrollbar({
			axis:"x",
			theme:"inset-2-dark",
		});
	},
	newsletter_popup: function() {
		var form_overlay = $('#newsletter__popup-overlay'),
			form_container = $('#newsletter__popup'),
			close_btn = form_container.find('.fa-close'),
			form = document.querySelector('#newsletter__popup form.form_subscribe'),
			infinity = 99999;
			
		var cookie_seen = Cookies.get('nlseentoday'),
			cookie_submitted = Cookies.get('nlsubmitted')
		
		if(form !== null) {
			if(cookie_submitted != 1) {
				if(cookie_seen != 1) {
				setTimeout(function() {
					form_overlay.fadeIn();
					form_submitted();	
				},20000);
				}
			}
		}
		
		function form_submitted() {
			form.onsubmit = function(e) {
				$.post(static_var.ajax, $(this).serialize(), function(data) {
					var obj = $.parseJSON(data);
					if(obj.status == 'success') {
						Cookies.set('nlsubmitted', 1, {expires:infinity});
					}
				})	
			} 
		}
		
		close_btn.on('click', function() {
			form_overlay.fadeOut();
			Cookies.set('nlseentoday', 1, {expires:1});	
		});
	},
	newsletter_ga_events: function() {
		var form = $('form.form_subscribe');
		form.on('submit', function() {
			if($(this).hasClass('freshmail_form_2')) {
				ga('send', 'event', 'Newsletter', 'zapisz', 'Newsletter', 1);
			}
			if($(this).hasClass('freshmail_form_3')) {
				ga('send', 'event', 'Newsletter', 'zapisz', 'Newsletter Popup', 1);
			}
		})
	},
	
	onDOMready: function() {
		this.register_functions();
		this.carousel_caption_fade();
		this.news_carousel_fade();
		this.partners_carousel();
		this.scroll_to_dance_level();
		this.open_dance_tab();
		this.courses_welcome_page();
		this.courses_sticky_menu();
		this.custom_scrollbars_init();
		$(window).on('load', function() {
			APP.newsletter_popup();
		});
		this.newsletter_ga_events();
	},
	onResize: function() {
		function on_resize(c,t) {
			onresize=function() {
				clearTimeout(t);
				t=setTimeout(c,100)
		};return c};
		on_resize(function() {
			APP.instructors_more_btn();
			APP.wrap_news();
			APP.gallery_caption_animation();
			APP.carousel_image_center_mobile();
			APP.menu_mobile_adjustments();
			APP.video_popup();
			APP.popup_adjustments();
		});
		onresize();	
	}
}


jQuery(document).ready(function($) {
	
	APP.onDOMready();
	APP.onResize();
    
	if ($(window).width() > 768) {  
		$('.navbar .dropdown > a').click(function(){
			location.href = this.href;
		}); 
	} 

});
