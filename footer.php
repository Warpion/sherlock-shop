<footer style="background-image: url('<?php bloginfo('template_url'); ?>/img/footer-min.jpg');">
	<div class="container-1500">
		<div class="row">
			<div class="col-lg-3 col-sm-6">
				<div class="footer_logo_container">
					<img src="<?php bloginfo('template_url'); ?>/img/logo.svg" class="footer_logo">
				</div>
				<div class="contact_block">
					<span class="contact"><span class="contact_caption">Телефон: </span>+7(978) 70-64-331</span>
					<span class="contact"><span class="contact_caption">Адрес: </span>г.Симферополь, ул. Киевская, д. 187</span>
				</div>
				<div class="soc_block">
					<div class="soc_title">Социальные сети</div>
					<div class="soc_link_container">
						<div class="soc_item"><i class="fa fa-vk"></i></div>
						<div class="soc_item"><i class="fa fa-facebook"></i></div>
						<div class="soc_item"><i class="fa fa-twitter"></i></div>
						<div class="soc_item"><i class="fa fa-instagram"></i></div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer_title_container">
					<span class="title_text">Категории</span>
				</div>
				<div class="footer_categories">
			          <?php 
			            $prod_cat_args = array(
			                'taxonomy'    => 'product_cat',
			                'orderby'     => 'id', // здесь по какому полю сортировать
			                'hide_empty'  => true, // скрывать категории без товаров или нет
			                'parent'      => 0 // id родительской категории
			              );

			            $woo_categories = get_categories( $prod_cat_args );
			              foreach ( $woo_categories as $woo_cat ) {
			                  $woo_cat_id = $woo_cat->term_id; //category ID
			                  $woo_cat_name = $woo_cat->name; //category name
			                  $woo_cat_slug = $woo_cat->slug; //category slug
			                  echo '<div class="category-item-footer">';
			                  echo '<a href="' . get_term_link( $woo_cat_id, 'product_cat' ) . '">' . $woo_cat_name . '</a>';
			                  echo "</div>";
			              }
			          ?>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer_title_container">
					<span class="title_text">Полезные страницы</span>
				</div>
				<?php wp_nav_menu(array('them_location'=>'Menu', 'menu_class'=>'menu-footer','container' => '', 'items_wrap' => '<nav id="%1$s" class="%2$s">%3$s</nav>')); ?>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer_title_container">
					<span class="title_text">Оплата</span>
				</div>
				<span class="pay_footer">
					Оплата осуществляется только наличным платежом
				</span>
			</div>
		</div>
	</div>
	<div class="line_footer"></div>
	<div class="container-1500">
		<div class="row">
			<div class="col-12">
				<div class="footer_info">
					Информация, размещенная на сайте, не является публичной офертой
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(55140877, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/55140877" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>