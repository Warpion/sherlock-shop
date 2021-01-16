<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">

		<h2 class="up_sells_title">Возможные модификации</h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>
			
				<?php
					//$post_object = get_post( $upsell->get_id() );
					$post_id =  $upsell->get_id();
					$post_url = get_permalink($post_id);
				?>
				<a class="up_sells_item" href="<?=$post_url?>">
					<?php
						echo '<div class="up_sells_caption"><span class="up_sells_text">'.get_the_title($post_id).'</span></div>';
						$price = get_post_meta( $post_id, '_price', true ); 
						echo '<div class="up_sells_price">'.wc_price( $price ).'</div>';

						//setup_postdata( $GLOBALS['post'] =& $post_object );
						//wc_get_template_part( 'content', 'product' ); 
					?>
				</a>
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
