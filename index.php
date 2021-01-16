<?php get_header(); ?>	
<div class="container-1500">
	<div class="row">
		

		<?php
			$params = array(
		        'posts_per_page' => 24,
		        'post_type' => 'product',
		        'tax_query' => array(
	                array(
	                    'taxonomy' => 'product_visibility',
	                    'field'    => 'name',
	                    'terms'    => 'featured',
	                ),
	            ),
		        
			);
			$wc_query = new WP_Query($params); 
			$count_post = $wc_query->found_posts;
			?>
			<?php if ($wc_query->have_posts()) : // (3) ?>
			<?php while ($wc_query->have_posts()) : // (4)
			                $wc_query->the_post(); // (4.1) ?>
			<div class="col-lg-4 col-sm-6 product">
				<a href="<?php echo esc_url(the_permalink()); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
					<div class="product_item">
						<div class="product_img">
							<?php the_post_thumbnail(array(350, 350), array('alt' => get_the_title())); ?>
						</div>
						<div class="product_description">
							<h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
							<div class="product_slug"><?php the_excerpt(); ?></div>
							<span class="product_price">
								<?php 
									$price = get_post_meta( get_the_ID(), '_price', true ); 
									echo wc_price( $price );
								?>
							</span>
							<div class="buy_button">Купить</div>
						</div>
					</div>
				</a>
			</div>
				
			
			<?php endwhile; ?>
			<?php wp_reset_postdata(); // (5) ?>
<?php endif; ?>	
	</div>
</div>
<?php get_footer(); ?>	