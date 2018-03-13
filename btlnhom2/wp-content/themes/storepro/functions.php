<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

if ( ! function_exists( 'storepro_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function storepro_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'storepro', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'storepro-post', 248, 288, true );
	add_image_size( 'storepro-related', 150, 160, true );
	add_image_size( 'storepro-thumb', 60, 70, true );
	add_image_size( 'storepro-products', 247, 297, true );
	add_image_size( 'storepro-cat', 182, 219, true );
	add_image_size( 'storepro-slides', 830, 350, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'storepro' ),
			'secondary' => __( 'Secondary Menu' , 'storepro' ),
			'category'  => __( 'Category Menu' , 'storepro' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'storepro_custom_background_args', array(
		'default-color' => 'ffffff'
	) ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Enable support woocommerce 3.0
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
endif; // storepro_theme_setup
add_action( 'after_setup_theme', 'storepro_theme_setup' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function storepro_widgets_init() {

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-ads.php';
	register_widget( 'StorePro_Ads_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-feedburner.php';
	register_widget( 'StorePro_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-recent.php';
	register_widget( 'StorePro_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-popular.php';
	register_widget( 'StorePro_Popular_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-random.php';
	register_widget( 'StorePro_Random_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-video.php';
	register_widget( 'StorePro_Video_Widget' );

	// Register home ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/classes/widget-home-ads.php';
	register_widget( 'StorePro_HomeAds_Widget' );

	if ( class_exists( 'WooCommerce' ) ) :

		// Register featured products widget.
		require trailingslashit( get_template_directory() ) . 'inc/classes/widget-home-featured-products.php';
		register_widget( 'StorePro_Featured_Prod_Widget' );

		// Register recent products widget.
		require trailingslashit( get_template_directory() ) . 'inc/classes/widget-home-recent-products.php';
		register_widget( 'StorePro_Recent_Prod_Widget' );

		// Register recent posts widget.
		require trailingslashit( get_template_directory() ) . 'inc/classes/widget-home-recent-posts.php';
		register_widget( 'StorePro_Recent_Posts_Widget' );

		// Register product categories widget.
		require trailingslashit( get_template_directory() ) . 'inc/classes/widget-home-prod-cat.php';
		register_widget( 'StorePro_Prod_Cat_Widget' );

	endif;

	register_sidebar(
		array(
			'name'          => __( 'Home Sidebar', 'storepro' ),
			'id'            => 'home',
			'description'   => __( 'Use this sidebar to manage the content on home page. We recommended you only use a widget with Home prefix.', 'storepro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2><div class="tx-div"></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'storepro' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'storepro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2><div class="tx-div"></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'storepro' ),
			'id'            => 'footer-1',
			'description'   => __( 'The footer sidebar.', 'storepro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4><div class="tx-div"></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'storepro' ),
			'id'            => 'footer-2',
			'description'   => __( 'The footer sidebar.', 'storepro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4><div class="tx-div"></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'storepro' ),
			'id'            => 'footer-3',
			'description'   => __( 'The footer sidebar.', 'storepro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4><div class="tx-div"></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'storepro' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar.', 'storepro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4><div class="tx-div"></div>',
		)
	);
	
}
add_action( 'widgets_init', 'storepro_widgets_init' );

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';

/**
 * Load Options Framework core.
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'admin/' );
require trailingslashit( get_template_directory() ) . 'admin/options-framework.php';
require trailingslashit( get_template_directory() ) . 'admin/options-functions.php';

/**
 * Custom Nav Menu Walker
 */
require trailingslashit( get_template_directory() ) . 'inc/classes/class-secondary-nav-walker.php';
require trailingslashit( get_template_directory() ) . 'inc/classes/class-category-nav-walker.php';

/**
 * Setup WooCommerce support.
 */
if ( class_exists( 'WooCommerce' ) ) { 
	require trailingslashit( get_template_directory() ) . 'inc/theme-woocommerce.php';
}