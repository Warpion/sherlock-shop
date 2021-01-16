<?php 
	add_action( 'after_setup_theme', 'theme_register_nav_menu' );
	function theme_register_nav_menu()
	{
		register_nav_menu( 'main', 'Основное меню' );
	}

	add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
	function my_scripts_method(){
		wp_enqueue_script( 'script', get_template_directory_uri() . '/main.js');
	}

	/*Регистрация видежета*/
	function filter_sidebar() {

	register_sidebar( array(
		'name'          => 'Filter block',
		'id'            => 'filter_sidebar',
		'before_widget' => '<div class="filter_sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="filter_sidebar_title">',
		'after_title'   => '</h2>',
	) );

	}
	add_action( 'widgets_init', 'filter_sidebar' );


	function new_excerpt_length($length) {
		return 50;
	}
	add_filter('excerpt_length', 'new_excerpt_length');


	include('wc_functions.php')
?>