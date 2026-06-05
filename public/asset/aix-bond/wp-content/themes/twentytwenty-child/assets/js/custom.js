jQuery(document).ready(function(e) {


		var isFirefox = typeof InstallTrigger !== 'undefined';

		if(isFirefox){
		 jQuery("body").addClass("is-firefox");
		}


if(/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())){
	 jQuery("body").addClass("is-chrome");
	}

	var mydir = jQuery("html").attr("dir");


	if (mydir == 'rtl') {
		// jQuery('body').addClass("arabic");
		// jQuery('body').persianNum({
	 //  		numberType: 'arabic'
		// });

		var arabicNumbers = ['۰', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
		jQuery('article p, .insight-detail-main-container p, .date, .tooltiptext span, .counter-value, .copyright').text(function(i, v) {
		  var chars = v.split(''); 
		  for (var i = 0; i < chars.length; i++) {
		    if (/\d/.test(chars[i])) {
		      chars[i] = arabicNumbers[chars[i]];
		    }
		  }
		  return chars.join('');
		})

		//jQuery('.date').val().replace(',','-');
		// function ($this) {
  //   		var sum = $this.sum();
  //   		jQuery(".date").html("&euro; " + sum2);
		// }
		// var sum2 = sum.toString().replace(/\./g, ',');


	}




	if(jQuery("body").hasClass("rtl")){
		var sliderRtl = true;
	} else{
		var sliderRtl = false;
	}



	function isMacintosh() {
	  return navigator.platform.indexOf('Mac') > -1
	}

	function isWindows() {
	  return navigator.platform.indexOf('Win') > -1
	}

	var isMac = isMacintosh();
	var isPC = !isMacintosh();


	if(isMac){
		jQuery("body").addClass("is-mac");
	}

	if(isPC){
		jQuery("body").addClass("is-pc");
	}

	var ua = navigator.userAgent.toLowerCase();
		var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
		if(isAndroid) {
		  jQuery("body").addClass("is-android");
		}
       
       //var headerHeight = jQuery('.header').outerHeight();
	//stickey header
		jQuery(window).scroll(function() {    
			var scroll = jQuery(window).scrollTop();	
			jQuery('.page-menu-main-container').removeClass('fixed');
			if (scroll >= 150) {
				jQuery("body").addClass("small-header");
				//alert(headerHeight);
				//jQuery(this).css("paddng-top", headerHeight);
				if (scroll >= 170) {
					jQuery("body").addClass("active");
					//alert(headerHeight);
					//jQuery(this).css("paddng-top", headerHeight);
				}
			}
			else {
				jQuery("body").removeClass("small-header active");
			}
		});

		if (document.documentElement.clientWidth < 1025) {
			jQuery(".header .main-nav .menu > li.has-child-menu").append( jQuery( '<i class="fa fa-angle-down"></i>' ) );
			jQuery( ".header .main-nav .menu > li.has-child-menu i" ).on( "click", function() {
				jQuery(this).parent().find(".mega-menu").slideToggle();
				jQuery(this).toggleClass("fa-angledown fa-angle-up");
			});
			
			if(jQuery("body").hasClass("rtl")){
                /*jQuery(".main-nav").append( jQuery( '<a href="https://wearethefuture-aix.com/" target="_blank" class="we_are_future">نحن المستقبل</a>' ) );*/
                jQuery(".main-nav").append( jQuery( '<a href="https://www.aixinvestment.com/contact#contact-form-main" class="sech-meeting-mobile">حدّد موعدًا الآن</a>' ) );
			} else if(jQuery("body").hasClass("ru")){
                /*jQuery(".main-nav").append( jQuery( '<a href="https://wearethefuture-aix.com/" target="_blank" class="we_are_future">Мы будущее</a>' ) );*/
				jQuery(".main-nav").append( jQuery( '<a href="https://www.aixinvestment.com/ru/contact#contact-form-main" class="sech-meeting-mobile">Запланируйте встречу сейчас</a>' ) );
			} else if(jQuery("body").hasClass("de")){
               /* jQuery(".main-nav").append( jQuery( '<a href="https://wearethefuture-aix.com/" target="_blank" class="we_are_future">Wir sind die Zukunft</a>' ) );*/
				jQuery(".main-nav").append( jQuery( '<a href="https://www.aixinvestment.com/de/contact#contact-form-main" class="sech-meeting-mobile">Vereinbaren Sie ein Meeting!</a>' ) );
			} else if(jQuery("body").hasClass("es")){
               /* jQuery(".main-nav").append( jQuery( '<a href="https://wearethefuture-aix.com/" target="_blank" class="we_are_future">Somos el futuro</a>' ) );*/
				jQuery(".main-nav").append( jQuery( '<a href="https://www.aixinvestment.com/es/contact#contact-form-main" class="sech-meeting-mobile">PROGRAMAR UNA REUNIÓN</a>' ) );
			} else if(jQuery("body").hasClass("zh-hans")){
               /* jQuery(".main-nav").append( jQuery( '<a href="https://www.aixinvestment.com/zh-hans/contact#contact-form-main" class="sech-meeting-mobile">我们是未来</a>' ) );*/
				jQuery(".main-nav").append( jQuery( '<a href="https://www.aixinvestment.com/zh-hans/contact#contact-form-main" class="sech-meeting-mobile">即刻预约您的专属投顾</a>' ) );
			} else {
               /* jQuery(".main-nav").append( jQuery( '<a href="https://wearethefuture-aix.com/" target="_blank" class="we_are_future">WE ARE THE FUTURE</a>' ) );*/
				jQuery(".main-nav").append( jQuery( '<a href="https://aixfincon.com/contact#contact-form-main" class="sech-meeting-mobile">SCHEDULE A MEETING</a>' ) );
			}
		}
		$('.header .header-right .header-top li:nth-child(1) a').on('click', function() {
			// Add target="_blank" attribute for we are the future
			$(this).attr('target', '_blank');
		});
		
        /* ------------------------------------------------------------------------ */
        /* ANIMATIONS *///
        /* ------------------------------------------------------------------------ */	
         
        /**/  if (document.documentElement.clientWidth > 768) {
          
			var fadeDelayAttr;
			var fadeDelay;
			jQuery(".animate-on-load").each(function(){
				if (jQuery(this).data("delay")) {
					
					fadeDelayAttr = jQuery(this).data("delay");
					fadeDelay = fadeDelayAttr;			
				} else {
					fadeDelay = 0;
				}
							
				jQuery(this).delay(fadeDelay).queue(function(){	
					jQuery(this).addClass('animated').clearQueue();
				});			
			});	
			
			
			jQuery('.animate-it').appear();
			jQuery(document.body).on('appear', '.animate-it', function(e, jQueryaffected) {
				var fadeDelayAttr;
				var fadeDelay;
				jQuery(this).each(function(){
					if (jQuery(this).data("delay")) {
						fadeDelayAttr = jQuery(this).data("delay")
						fadeDelay = fadeDelayAttr;				
					} else {
						fadeDelay = 0;
					}			
					jQuery(this).delay(fadeDelay).queue(function(){
						jQuery(this).addClass('animated').clearQueue();
					});			
				})			
			});
            
        }
		
		
		jQuery(".styled-select").niceSelect();
		// === parallax
		jQuery('.parallax-window').parallax();


		// === nav
		jQuery( ".mobile-nav-btn" ).on( "click", function() {
			jQuery(".main-nav").slideToggle();
			jQuery(this).toggleClass("nav-active");
		});

		// === footer mobile nav
		jQuery( ".site-footer .mobile-toggle" ).on( "click", function() {
			jQuery(this).parent().find("ul").slideToggle();
			jQuery(this).toggleClass("active");
		});


		// === Search
		jQuery( ".search-btn" ).on( "click", function() {
			jQuery(".header-search-widget").fadeToggle(200);
			jQuery(this).toggleClass("active");
		});


		// === key sector
		jQuery('.testimonials-carousel').owlCarousel({
			margin:20,
			loop:true,
			dots:true,
			autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed : 1500,
            rtl: sliderRtl,
    		responsive:{
				0:{
					items:1,
					//autoHeight: true
				},
				768:{
					autoHeight: false,
					items:1
				}
			}
		});
		

		// === sectors-carousel
		jQuery('.sectors-carousel').owlCarousel({
			margin:8,
			loop:false,
			dots:false,
			nav:true,
			responsive:{
				0:{
					items:2
				},
				601:{
					items:3
				},
				900:{
					items:4
				},
				1100:{
					items:5
				}
			}
		});


		// === insight-carousel
		jQuery('.single-insights-carousel').owlCarousel({
			margin:30,
			loop:true,
			dots:false,
			//autoWidth:true,
			rtl:sliderRtl,
			nav:true,
			responsive:{
				0:{
					items:1,
					margin:0,
					//autoHeight:true
				},
				601:{
					items:2,
					margin:7,
				},
				900:{
					items:2,
					margin:7,
				},
				1025:{
					items:3,
					nav:true,
					margin:7
				},
				1309:{
					items:3,
					nav:true
				}
			}
		});

		// === featured projects
		jQuery('.featured-projects-carousel').owlCarousel({
			margin:8,
			loop:false,
			dots:true,
			responsive:{
				0:{
					items:1
				},
				601:{
					items:2
				},
				1100:{
					items:3
				}
			}
		});
		/*jQuery( ".footer h3" ).on( "click", function() {
			jQuery(this).parent().find("ul").slideToggle();
			jQuery(this).toggleClass("active");
		});
		
		
		jQuery('.product-selector-tabs').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
			closed:'accordion'
            
        });
		
		// Slideshow 3
		jQuery("#product-detail-slider").responsiveSlides({
			manualControls: '#product-detail-slider-pager',
			maxwidth: 1000
		});
		
		
		
		jQuery('.scroll').each( function() {
			var $this = jQuery(this), 
				target = this.hash;
				jQuery(this).click(function (e) { 
					e.preventDefault();
					if( $this.length > 0 ) {
						if($this.attr('href') == '#' ) {
							// Do nothing   
						} else {
						   jQuery('html, body').animate({ 
								scrollTop: (jQuery(target).offset().top) - -1
							}, 1000);
						}  
					}
				});
			});
		
		
		
		
		jQuery('.products-carousel').owlCarousel({
			margin:44,
			loop:false,
			dots:true,
			responsive:{
				0:{
					items:1
				},
				601:{
					items:2
				},
				1100:{
					items:3
				}
			}
		});
		
		
		jQuery(".testimonials-carousel").responsiveSlides({
			maxwidth: 1200,
			speed: 800,
			pager: true
		  });
		
		jQuery(".social li:eq(1)").attr('data-delay', '300');
		
		jQuery(".fancybox").fancybox({
			maxWidth	: '90%',
			maxHeight	: '90%',
			fitToView	: true,
			width		: '70%',
			height		: '70%',
			autoSize	: true,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
		
		jQuery('.fancybox-media').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			width		: '80%',
			height		: '80%',
			type 		: 'iframe',
			helpers : {
				media : {}
			}
		});
		
		*/
        
    });
	


	
jQuery(document).ready(function () {
	var x = jQuery(".container").offset();
  
	if (jQuery('body').css('direction') == 'rtl') {
	  jQuery('body').css('overflow-x', 'hidden');
	  jQuery(".about-our-vision-container-inner").css("margin-right", x.left);
	  jQuery(".career-center-text-container").css("margin-left", x.left);

  
  
	} else {
	  jQuery(".career-center-text-container").css("margin-right", x.left);
  

  
	}
  });
	
	
	
	
	//function nth(n){return["st","nd","rd"][((n+90)%100-10)%10-1]||"th"}





