<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="alternate" hreflang="ru" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-ui-Slider-Pips/1.11.4/jquery-ui-slider-pips.min.js"></script>
  <meta name="format-detection" content="telephone=no">
  
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/main.css">
  <?php wp_head(); ?>
</head>
<body <?php body_class('hide_cart mobi_menu_hide filter_block_hide'); ?>>
  <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
      <input type="text" name="s" id="search" class="search_text" value="<?php echo get_search_query(); ?>" placeholder="Поиск" />
      <input type="hidden" value="product" name="post_type">
      <button type="button" class="search_exit"><i class="fa fa-times"></i></button>
      <button type="submit" class="search_btn"><i class="fa fa-search"></i></button>
    </form>
  <div class="cart_block">
    <div class="close_cart_block">Закрыть</div>
    <div class="cart_container">
      <?php woocommerce_mini_cart(); ?>
    </div>
  </div>
  <div class="hide_block_dark"></div>
  <div class="hide_block"></div>
<header>
  <div class="mobi_menu">
    <form id="choose_form">
      <input type="radio" class="choose_menu" id="cat_mobi" checked name="choose_menu">
      <label for="cat_mobi" class="mobi_label">Категории</label>
      <input type="radio" class="choose_menu" id="menu_mobi" name="choose_menu">
      <label for="menu_mobi" class="mobi_label">Меню</label>
    </form>
    <div class="mobi_category">
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
              echo '<div class="category-item">';
              echo '<a href="' . get_term_link( $woo_cat_id, 'product_cat' ) . '">' . $woo_cat_name . '</a>';
              echo "</div>";
          }
        ?>
    </div>
      <?php wp_nav_menu(array('them_location'=>'Menu', 'menu_class'=>'menu-mobi','container' => '', 'items_wrap' => '<nav id="%1$s" class="%2$s" style="display:none;">%3$s</nav>')); ?>
    <div class="mobi_menu_close"><i class="fa fa-times"></i></div>
  </div>
  <div class="black_back">
    <div class="container-1500">
    <div class="row">
      <div class="col-12">
        <div class="row top_block">
          <div class="col-2 hide_pc">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </div>
          <div class="col-md-2 col-8 logo_container">
            <a href="/" style="display: flex;"><img src="<?php bloginfo('template_url'); ?>/img/logos.svg" class="main_logo"></a>
          </div>
          <div class="col-md-5 hide_mobile">
            <div class="phone_top">
              <span>+7(978) 70-64-333</span>
              <span>+7(978) 70-64-331</span>
            </div>
          </div>
          <div class="col-md-3 hide_mobile">
            <?php wp_nav_menu(array('them_location'=>'Menu', 'menu_class'=>'menu-top','container' => '', 'items_wrap' => '<nav id="%1$s" class="%2$s">%3$s</nav>')); ?>
          </div>
          <div class="col-2 cart">
            <div class="search_block hide_mobile">
              <i class="fa fa-search"></i>
            </div>
            <div class="cart-js-link">
              <div class="cart-link" title="<?php _e( 'Просмотреть корзину' ); ?>">
                <i class="fa fa-shopping-cart" aria-hidden="true"><span class="cart-total"><?php echo WC()->cart->get_cart_contents_count(); ?></span></i>
              </div>  
            </div>            
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="categories hide_mobile">
    <div class="container-1500">
      <div class="row">
        <div class="col-12">
          <div class="category_container">
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
                  echo '<div class="category-item">';
                  echo '<a href="' . get_term_link( $woo_cat_id, 'product_cat' ) . '">' . $woo_cat_name . '</a>';
                  echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if(is_front_page()){ ?>
  <div class="baner">
    <a href="/telefony-xiaomi/" class="baner_link">
      <img src="<?php bloginfo('template_url'); ?>/img/baner2.jpg">
      <div class="baner_text">
        <h2 class="baner_h2">Xiaomi</h2>
        <p>Прекрасен во всех отношениях</p>
      </div>
      <div class="baner_btn">Перейти</div>
    </a>
  </div>
  <?php } ?>
</header>