<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php 
	$cat_id = $category->term_id;
	
	$args = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'posts_per_page'        => '3',
    'tax_query'             => array(
        array(
            'taxonomy'      => 'product_cat',
            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
            'terms'         =>  $cat_id,
            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
        ),
        array(
            'taxonomy'      => 'product_visibility',
            'field'         => 'slug',
            'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
            'operator'      => 'NOT IN'
        )
    )
);
	$wc_query = new WP_Query($args);
	$count = 1;
	$close_right = false;
	?>
<div class="col-lg-4 col-md-6 cat_block">
<div class="cat_block_container">
	<div class="cat_top_panel">
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );?>
	<div class="cat_show_more">Показать все</div>
	<?php
	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); ?>
	</div>
	<div class="cat_product_container">
	<?php if ($wc_query->have_posts()) : // (3) ?>
			<?php while ($wc_query->have_posts()) : // (4)
			                $wc_query->the_post(); // (4.1) ?>
			<?php if($count === 2 ) { $close_right = true; ?>
				<div class="cat_right_container">
			<?php } ?>
			<div <?php wc_product_cat_class( '', $category ); ?>>
				<a href="<?php echo esc_url(the_permalink()); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
					<div class="cat_product_item">
						<div class="cat_product_img">
							<?php the_post_thumbnail(array(170, 170), array('alt' => get_the_title())); ?>
						</div>
						<div class="cat_product_description">
							<h3 class="cat_product__title"><?php the_title(); ?></h3>
							<span class="cat_product_price">
								<?php 
									$price = get_post_meta( get_the_ID(), '_price', true ); 
									echo wc_price( $price );
								?>
							</span>
						</div>
					</div>
				</a>
			</div>
				
			
			<?php 
				$count = $count + 1;
				endwhile; 
			?>
			<?php wp_reset_postdata(); // (5) ?>
<?php endif; ?>	
<?php if($close_right === true){ ?>
	</div>
<?php } ?>
</div>
</div>
</div>