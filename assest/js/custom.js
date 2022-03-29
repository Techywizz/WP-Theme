$( document ).ready(function($) {

	$('.down').click(function(){
		$('body,html').animate({
			scrollTop:$('.after-banner').offset().top-$('header').height()-20				   	
		},400);					  	
	});
	
	$('.gototop').click(function(){
		$('body,html').animate({
			scrollTop:0  	
		},800);					  	
	});
	
	$('.dropdown-menu').on('click', function(event) {
		event.stopPropagation();
	});
	
	$('.cart-drop').hover(function(){ 
	  $('.cart-toggle', this).trigger('click'); 
	});

	if ( window.location.pathname == '/about-us/' || window.location.pathname == '/contact-us/' ||
	window.location.pathname == '/faq/' || window.location.pathname == '/category/news/' 
	
	
	){
		$('header').each(function() {
			$(this).addClass('sticky');
			$('.sticky img').addClass('logo-dark')	
		});
	}
	
	if ( window.location.pathname == '/' ){
		$(window).scroll(function(){
			var top=$(this).scrollTop();
			if(top>930){

				$('header').each(function() {
					$(this).addClass('sticky');
					$('.sticky img').addClass('logo-dark')	
				});
			}
			
			else{

				$('.sticky img').each(function() {
					$(this).removeClass('logo-dark');	
					$('header').removeClass('sticky');
				})
			}
		});
	}



	$('.filter .dropdown-toggle').click(function(){
			$(this).find('.fa').toggleClass('rotate');
			$(this).toggleClass('act');
	});
	
	
	const moveReview = () => {
		$('.leave-a-review').appendTo($('.review__section .part1'));
	}
	
	
	const panelAction = () => {
		$(".menu-panel .menu li a.active").siblings(".submenu").slideDown(200);
	
	
		$('.open-menu-panel').on("click", function() {
			$('.menu-panel-overlay').show();
			$('.menu-panel-overlay').css('position', 'fixed')
	
			$('.menu-panel').animate({
				right:'0%'
			},500).addClass('open');
			$('.home-content').animate({
				right: '100%'
			},500).removeClass('open');
			
			// $('body,html').addClass('overflow-hidden');
			$('header').animate({
				left:'-100%'
			},500);
			
			$('.sticky').css('background', 'transparent');
			$('.header-white').css('background', 'transparent');
			$('.home-banner').css('position', 'fixed');
			$('.bggreen').css('background', 'black')
		});
		
		
		$('.menu-panel-overlay, .close-menu-panel').on("click", function() {
			$('.menu-panel-overlay').hide();
			$('.menu-panel-overlay').css('position', 'relative')
	
			$('.menu-panel').animate({
				right:'-100%'	 	
			},500).removeClass('open');
	
			$('.home-content').animate({
				right: '0%'
			}, 500).addClass('open');
	
			$('body,html').removeClass('overflow-hidden');
	
			$('header').animate({
				left:'0%'	 	
			},500);
	
			$('.header-white').css('background', 'white');
			
			const scrollAbove = () => {
				if($(window).scrollTop() < 930){
					$('.sticky').css('background', 'transparent');
					$('.home-header').css('background', 'transparent');
				}
			}

			const scrollBelow = () => {
				if($(window).scrollTop() > 930){
					$('.sticky').css('background', 'white');
				} 

			}

			scrollAbove();
			scrollBelow();

			
			$(window).scroll(function(){
				scrollAbove();
				scrollBelow();
			})

	
			$('.home-banner').css('position', 'relative');
			$('.bggreen').css('background', '#B5C699')
		});
	}

	
	
	var width=$(window).width();
	
	
	if(width<992){
		
		$('.home-product-section .row').removeClass('owl-carousel').removeClass('owl-theme').removeClass('owl-loaded').removeClass('owl-drag');
		$('.home-product-section .row').removeAttr('id');
			
		$('#featured-products, #news-slider').addClass('owl-carousel').addClass('owl-theme');

		$('#featured-products').owlCarousel({ 
			items: 1,
			nav: true,
			dots: false,
			autoplay: false,
			margin: 0,
			smartSpeed: 500,
			autoplayHoverPause: true,
			loop: true,
			autoHeight:true,
			responsive: {
				0: {
					items: 1
				},
				400: {
					items: 1
				},
				500: {
					items: 2
				},
				
				767: {
					items: 3
				},			
				1000: {
					items: 4
				}				
					
			}
		});
		
		
		$('.res-filter h4').click(function(){
			$(this).toggleClass('act');						   	
			$('.filter-panel').slideToggle(300);
			$(this).find('.fa').toggleClass('fa-times').toggleClass('fa-angle-down');
		});

	}
	
	
	if(width<768){
		
		$('#news-slider').owlCarousel({ 
			items: 1,
			nav: false,
			dots: true,
			autoplay: false,
			margin: 0,
			smartSpeed: 500,
			autoplayHoverPause: true,
			loop: true,
			autoHeight:true,
			responsive: {
				0: {
					items: 1
				},
				400: {
					items: 1
				},
				500: {
					items: 2,
					margin:20
				},
				767: {
					items: 3,
					margin:20
				},
				1000: {
					items: 4,
					margin:20
				}				
				
			}
		})	
		
	}



	const priceChange = () => {
		let totalSaleNumber = 0;
		let totalNonSaleNumber = 0;

		let salePrice = 0;
		let nonSalePrice = 0

		let inputValue = $('.woocommerce-variation-add-to-cart input[type="number"]');
		let displayPrice = null;

		$(".nice-select").on("click", function() {
			$(".option").on("click", function() {

				setTimeout(function() {
					salePrice = parseInt($('.single_variation_wrap .price span .woocommerce-Price-amount bdi').text().substring(1));
					
					nonSalePrice = parseInt($('.single_variation_wrap .price').text().substring(1))

					displayPrice = $('.woocommerce-variation-price .price')

					inputValue.on('change paste keyup', function() {
						let typedNumber = $(this).val();
						
			
						if(salePrice) {
							totalSaleNumber = typedNumber * salePrice
							totalNonSaleNumber = typedNumber * nonSalePrice
						} else {
							totalNonSaleNumber = typedNumber * nonSalePrice
						}
					})
			
					$('.qty_button').click(()=>{
						
						setTimeout(function() {
							let arrowNumber = $('.woocommerce-variation-add-to-cart input[type="number"]').val()

							if(salePrice ) {
			
								totalSaleNumber = arrowNumber * salePrice
								totalNonSaleNumber = arrowNumber * nonSalePrice
							} else {
								totalNonSaleNumber = arrowNumber * nonSalePrice

							}
						}, 500)
						
					})
					
				})

				setTimeout(function() {
					let optionVal = $('.woocommerce-variation-add-to-cart input[type="number"]').val();
					if(salePrice) {
						totalSaleNumber = optionVal * salePrice
						totalNonSaleNumber = optionVal * nonSalePrice
					} else {
						totalNonSaleNumber = optionVal * nonSalePrice

					}

				}, 200)
			})

		});

		(function(){

			window.setInterval(function() {
					displayPrice = $('.woocommerce-variation-price .price')

				if(displayPrice.is(':visible')){
					displayIsVisible();
				}
			}, 1000);
				
			function displayIsVisible() {

				if( totalSaleNumber) {
					displayPrice.html(`<span class="woocommerce-Price-currencySymbol"><del>$${totalNonSaleNumber}</del> $${totalSaleNumber}</span>`)
				} else {
					displayPrice.html(`<span class="woocommerce-Price-currencySymbol">$${totalNonSaleNumber}</span>`)

				}

			}

		})();
	}

	const changeButtonText = () => {
		// product-type-simple

		$('.product_type_simple.add_to_cart_button').text('Add to Cart')
	}

	const checkoutFix = () => {
		$('.woocommerce-cart-form .button[name="update_cart"]').attr("disabled", true);
		$('.woocommerce-cart-form .button[name="apply_coupon"]').attr("disabled", true);

		const isEmpty = () => {
			if($('[name="coupon_code"]').val().length <= 0) {
				$('.woocommerce-cart-form .button[name="apply_coupon"]').attr("disabled", true);
			}
		}

		$('[name="coupon_code"]').on('input propertychange paste', isEmpty, function() {
			
			$('.woocommerce-cart-form [name="apply_coupon"]').attr("disabled", false);
			isEmpty()
		});


		
		$('.woocommerce-checkout .input-text.text').on('input propertychange paste', function() {
			
			$('.woocommerce-cart-form .button[name="update_cart"]').attr("disabled", false);
		});

		$('.woocommerce-checkout .qty_button').click(function(){
			$('.woocommerce-cart-form .button[name="update_cart"]').attr("disabled", false);
		})

		
	}

	
	moveReview();
	panelAction();
	priceChange();
	checkoutFix()
	changeButtonText();
})