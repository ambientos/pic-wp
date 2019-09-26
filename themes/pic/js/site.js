(function($){
	var body = $('body')


	/**
	 * Mobile menu
	 */

	var mobileMenu = $('.mobile-main-menu')

	var mobileMenuToggle = $('.header-menu-toggle')
		.on('menu.show', function(){
			body.addClass('is-mobile-menu-show')
		})
		.on('menu.hide', function(){
			body.removeClass('is-mobile-menu-show')
		})
		.on('click', function(){
			mobileMenuToggle.trigger('menu.show')
		})

	mobileMenu.parent().after('<div class="mobile-menu-close" title="Закрыть меню"></div>')

	$('.mobile-menu-close').on('click', function(){
		mobileMenuToggle.trigger('menu.hide')
	})

	$('.mobile-menu-overlay').on('click', function(){
		mobileMenuToggle.trigger('menu.hide')
	})


	/**
	 * Owl Carousel
	 */
	
	$('.carousel-container').each(function(){
		var container = $(this),
			carousel = container.find('.carousel'),
			items = container.data('items') || 0,
			loop = container.data('loop') || 0,
			nav = container.data('nav') || 0,
			dotsHide = container.data('dots-hide') || 0,
			autoHeight = container.data('autoheight') || 0,
			autoWidth = container.data('autowidth') || 0

		options = {
			items: 1,
			margin: 0,
			loop: false,
			nav: false,
			dots: true,
			dotsContainer: container.find('.carousel-nav')
		}

		if ( loop ) {
			options.loop = true
		}

		if ( autoWidth ) {
			options.margin = 30

			if ( ! items ) {
				options.responsive = {
					0: {
						items: 1
					},
					600: {
						items: 2
					},
					768: {
						items: 3
					},
					900: {
						items: 4
					}
				}
			}
		}

		if ( nav ) {
			options.nav = true
		}

		if ( dotsHide ) {
			options.dots = false
		}

		if ( autoHeight ) {
			options.autoHeight = true
		}

		carousel.owlCarousel(options)
	})


	/**
	 * Popup close button
	 */

	$('.popup-callback-close').on('click', function(e){
		e.preventDefault()
		$.fancybox.close()
	})


	/**
	 * Set Product Title input value by Order click
	 */

	$('[data-fancybox][data-title]').fancybox({
		beforeLoad: function( instance, slide ) {
			var $productTitleField = $('#order-product').find('[name="product-name"]'),
				productTitle = slide.opts.$orig.data('title')

			$productTitleField.val( productTitle )
		}
	})
})(jQuery)