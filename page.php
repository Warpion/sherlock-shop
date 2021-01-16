<?php get_header(); ?>	
	<div class="container-1500">
		<div class="row">
			<div class="col-12">
				<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
				<div <?php post_class(); ?>>
					<div class="post-main"> 
						<h1 class="post_title"><?php the_title(); ?></h1>
						<div class="post">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?> 
						</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>	