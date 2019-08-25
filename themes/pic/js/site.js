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
			carousel = container.find('.carousel')

		carousel.owlCarousel({
			items: 1,
			margin: 0,
			loop: true,
			nav: false,
			dots: true,
			dotsContainer: container.find('.carousel-nav')
		})
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