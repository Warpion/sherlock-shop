<?php 
	//Поддержка woocommerce
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
		//add_theme_support( 'wc-product-gallery-zoom' );
		//add_theme_support( 'wc-product-gallery-lightbox' );
		//add_theme_support( 'wc-product-gallery-slider' );
	}

	add_filter( 'wc_add_to_cart_message', 'remove_add_to_cart_message' );//убрать сообще о дабалении товара 
	function remove_add_to_cart_message() {
	    return;
	}
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );//Убрать стили css



	add_action( 'woocommerce_archive_description', 'div_col_12', 1 );//Обертка блока перед товароми
	function div_col_12(){
	  echo '<div class="col-12">';
	}

	add_action( 'woocommerce_archive_description', 'h1_page', 5 );//Обертка блока перед товароми
	function h1_page(){
	  echo '<h1 class="page-title">';
	  woocommerce_page_title();
	  echo'</h1>';
	  echo '<div class="show_filters"><div class="show_filters_btn">Фильтры</div></div>';
	}

	add_action( 'woocommerce_before_shop_loop', 'div_col_12_close', 100 );//Обертка блока перед товароми
	function div_col_12_close(){
	  echo '</div>';
	}
	
	add_filter('woocommerce_show_page_title', '__return_false');

	add_action( 'woocommerce_before_shop_loop', 'sidebar_nav', 180 );//Обертка блока с товаром
	function sidebar_nav(){
	  echo '<div class="col-lg-3 col-md-4 filter_mobile"><div class="close_filter_block">Закрыть</div>';
	  dynamic_sidebar( 'filter_sidebar');
	  echo '</div>';
	}
	add_action( 'woocommerce_before_shop_loop', 'div_col_9', 200 );//Обертка блока с товаром
	function div_col_9(){
	  echo '<div class="col-lg-9 col-md-8"><div class="row products">';
	}
	
	add_action( 'woocommerce_after_shop_loop', 'div_col_9_close', 200 );//Обертка блока с товаром
	function div_col_9_close(){
	  echo '</div></div>';
	}
	add_action('woocommerce_before_shop_loop_item', 'product_img_container', 100);
	function product_img_container(){
		echo '<div class="product_img_container">';
	}
	add_action('woocommerce_shop_loop_item_title', 'product_img_container_close', 1);
	function product_img_container_close(){
		echo '</div>';
	}
	add_action('woocommerce_before_single_product', 'container_single_product',30);
	function container_single_product(){
		echo '</div><div class="col-12"><div class="row single_product_background">';
	}
	add_action('woocommerce_after_single_product_summary', 'container_single_product_close', 17);
	function container_single_product_close(){
		echo '</div></div><div class="row">';
	}

	add_filter( 'woocommerce_subcategory_count_html', '__return_false' );
	add_action('woocommerce_before_single_product', 'woocommerce_template_single_title', 20);


	remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );//Удалить кол-во постов
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');//удалить add_to_cart
	remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5);

	remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);

	remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 36);

	add_action('woocommerce_single_product_summary', 'container_single_top',5);
	function container_single_top(){
		echo '<div class="single_top_container">';
	}
	add_action('woocommerce_single_product_summary', 'container_single_top_close',35);
	function container_single_top_close(){
		echo '</div>';
	}
	remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display', 15);
	add_action('woocommerce_single_product_summary', 'woocommerce_upsell_display', 38);
	remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);

	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
	function custom_override_checkout_fields( $fields ) {
	  //unset($fields['billing']['billing_first_name']);// имя
	  unset($fields['billing']['billing_last_name']);// фамилия
	  unset($fields['billing']['billing_company']); // компания
	  //unset($fields['billing']['billing_address_1']);//
	  unset($fields['billing']['billing_address_2']);//
	  unset($fields['billing']['billing_city']);
	  unset($fields['billing']['billing_postcode']);
	  //unset($fields['billing']['billing_country']);
	  unset($fields['billing']['billing_state']);
	  //unset($fields['billing']['billing_phone']);
	  //unset($fields['order']['order_comments']);
	  //unset($fields['billing']['billing_email']);
	  //unset($fields['account']['account_username']);
	  unset($fields['account']['account_password']);
	  unset($fields['account']['account_password-2']);
	 
	    return $fields;
	}

	add_filter('woocommerce_default_address_fields', 'override_address_fields');//Изменить placeholder
	function override_address_fields( $address_fields ) {
		$address_fields['address_1']['placeholder'] = 'Улица, дом, квартира';
		return $address_fields;
	}
	
	//Обновелине количества добавленных товаров в корзину

	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

	function woocommerce_header_add_to_cart_fragment( $fragments ) {
	  global $woocommerce;

	  ob_start();

	  ?>
  	<div class="cart-link" title="<?php _e( 'Просмотреть корзину' ); ?>">
	    <i class="fa fa-shopping-cart" aria-hidden="true">
	    	<span class="cart-total"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	    </i>
 	</div> 
	  <?php
	  $fragments['div.cart-link'] = ob_get_clean();
	  return $fragments;
	}	

	#ajax mini CART
	add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {

	    ob_start();
	    ?>

	    <div class="cart_container">
			<?php woocommerce_mini_cart(); ?>
		</div>

	    <?php $fragments['div.cart_container'] = ob_get_clean();

	    return $fragments;

	} );



	/**
	 * Custom currency and currency symbol
	 */
	add_filter( 'woocommerce_currencies', 'add_my_currency' );

	function add_my_currency( $currencies ) {
	     $currencies['RUB'] = __( 'RUB', 'woocommerce' );
	     return $currencies;
	}

	add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

	function add_my_currency_symbol( $currency_symbol, $currency ) {
	     switch( $currency ) {
	          case 'RUB': $currency_symbol = '.—'; break;
	     }
	     return $currency_symbol;
	}



add_action( 'woocommerce_after_checkout_form', 'bbloomer_disable_shipping_local_pickup' );
function bbloomer_disable_shipping_local_pickup( $available_gateways ) {
global $woocommerce;

$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
$chosen_shipping_no_ajax = $chosen_methods[0];
if ( 0 === strpos( $chosen_shipping_no_ajax, 'local_pickup' ) ) {

 ?>
 <script type="text/javascript">

	jQuery('.address-field').fadeOut();
  $('#billing_address_1').val('Cамовывоз');

</script>
<?php
    
}else{ ?>
  <script>
    $('#billing_address_1').val('');
  </script>
<?php
} 

?>
<script type="text/javascript">

				jQuery('form.checkout').on('change','input[name^="shipping_method"]',function() {
	var val = jQuery( this ).val();
	if (val.match("^local_pickup")) {
              $('#billing_address_1').val('Cамовывоз');
            	jQuery('#billing_address_1_field').fadeOut();
       	} else {
		jQuery('#billing_address_1_field').fadeIn();
    $('#billing_address_1').val('');
	}
});

</script>
<?php

}

 ?>