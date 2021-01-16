$(document).ready(function(){
	$('.search_exit, .hide_block').click(function(){
		$('#searchform').slideUp();
		$('.hide_block').fadeOut();
	});
	$('.search_block').click(function(){
		$('#searchform').slideDown();
		$('.hide_block').fadeIn();
	});
	$('.close_cart_block, .hide_block_dark').click(function(){
		$('body').addClass('hide_cart');
		$('.hide_block_dark').fadeOut();
		$('body').addClass('mobi_menu_hide');
		$('body').addClass('filter_block_hide');
	});
	$('.cart-js-link, .single_add_to_cart_button').click(function(){
		$('body').removeClass('hide_cart');
		$('.hide_block_dark').fadeIn();
	});
	$('.mobi_menu_close').click(function(){
		$('body').addClass('mobi_menu_hide');
		$('.hide_block_dark').fadeOut();
	});
	$('.fa-bars').click(function(){
		$('body').removeClass('mobi_menu_hide');
		$('.hide_block_dark').fadeIn();
	});
	$('#menu_mobi').click(function(){
		$('.mobi_category').hide();
		$('.menu-mobi').show();
	});
	$('#cat_mobi').click(function(){
		$('.menu-mobi').hide();
		$('.mobi_category').show();
	});
	$('.close_filter_block').click(function(){
		$('body').addClass('filter_block_hide');
		$('.hide_block_dark').fadeOut();
	});
	$('.show_filters_btn').click(function(){
		$('body').removeClass('filter_block_hide');
		$('.hide_block_dark').fadeIn();
	});

	//ajax корзина на product page
	jQuery(function($) {

	  if ($( "body" ).hasClass( "single-product" )) {
	    $(document).on("click", ".single_add_to_cart_button", function(e) {

	      var product_button = $(this);
	      $product_form = $( this ).closest('form.cart');

	      var product_id = $product_form.find( 'button[name=add-to-cart]' ).val();
	      var quantity = $('.product-input').val();

	      product_button.addClass('loading');

	      var n = {
	        action: "woocommerce_add_to_cart",
	        product_id: product_id,
	        quantity: quantity,
	      };

	      $.post(woocommerce_params.ajax_url, n, function(n) {
	        if (!n) return;

	        var r = window.location.toString();
	        r = r.replace("add-to-cart", "added-to-cart");
	        if (n.error && n.product_url) {
	          window.location = n.product_url;
	          return
	        }
	        if (woocommerce_params.cart_redirect_after_add == "yes") {
	          window.location = woocommerce_params.cart_url;
	          return
	        }

	        $('#header-right').addClass('cart-open');

	        setTimeout(function(){

	          $('#header-right').removeClass('cart-open');

	        }, 5000);

	        //$cartURL = $('.add_to_cart_button').data("cart-url");

	        product_button.removeClass("loading");
	        fragments = n.fragments;
	        cart_hash = n.cart_hash;

	        if (fragments) {
	          jQuery.each(fragments, function(key, value) {
	            jQuery(key).replaceWith(value);
	          });
	        }

	        $("body").trigger("added_to_cart", [fragments, cart_hash])

	        //Now we set the mobile only cart quantity

	        // var cart_quantity = $('.festi-cart-quantity').text();
	        // var mobile_cart_quantity = $('.mobile-only-cart-wrap a');

	        // $(mobile_cart_quantity).text(cart_quantity);

	      });

	      e.preventDefault();


	    });



	  }
	});
	$('body').on('click','.orderby_price', function(event) {
		event.preventDefault();
	  	$('select.orderby').val("price");
	 	updateProducts(true);
	});
	$('body').on('click','.orderby_popularity', function(event) {
		event.preventDefault();
	  	$('select.orderby').val("popularity");
	 	updateProducts(true);
	});
	$('.img_slider').slick({
	  infinite: false,
	  speed: 300,
	  slidesToShow: 1,
	  centerMode: true,
	  fade: true,
	  arrows: false,
	  dots: true,
	  infinite: true,
	  asNavFor: '.nav_img_slider'
	});
	$('.nav_img_slider').slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  arrows: false,
	  dots: false,
	  focusOnSelect: true,
	  vertical: true,
	  infinite: true,
	  centerMode: true,
	  asNavFor: '.img_slider',
	});
});