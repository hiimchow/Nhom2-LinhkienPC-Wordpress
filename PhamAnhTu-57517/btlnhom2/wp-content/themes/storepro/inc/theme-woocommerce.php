<?php
/**
 * Custom filter, hooks and functions to support WooCommerce
 * 
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

global $woo_options;

// Indicate that this theme support WooCommerce.
add_theme_support( 'woocommerce' );

// Remove WooCommerce sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Remove breadcrumbs.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove add to cart button on product page.
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Remove rating on product page.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// // Disable WooCommerce styles
// if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
// 	// WooCommerce 2.1 or above is active
// 	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
// } else {
// 	// WooCommerce is less than 2.1
// 	define( 'WOOCOMMERCE_USE_CSS', false );
// }

/**
 * Define image sizes on theme activation.
 *
 * @since  1.0.0
 */
function storepro_woocommerce_image_sizes() {

	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

		$catalog = array(
			'width'  => '247',
			'height' => '297',
			'crop'   => 1
		);

		$single = array(
			'width'  => '548',
			'height' => '639',
			'crop'   => 1
		);

		$thumbnail = array(
			'width'  => '120',
			'height' => '128',
			'crop'   => 1
		);

		// Product thumbnail size.
		update_option( 'shop_catalog_image_size', $catalog );

		// Single product image size.
		update_option( 'shop_single_image_size', $single );

		// Image gallery thumbnail size.
		update_option( 'shop_thumbnail_image_size', $thumbnail );

	}

}
add_action( 'init', 'storepro_woocommerce_image_sizes', 1 );

// Adjust markup.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'storepro_wc_before_content' ) ) :
/**
 * Markup before product.
 * 
 * @since  1.0.0
 */
function storepro_wc_before_content() {
	?>

	<div id="primary">
		<main id="main" class="product category-product" role="main">

	<?php
}
endif;
add_action( 'woocommerce_before_main_content', 'storepro_wc_before_content', 10 );

if ( ! function_exists( 'storepro_wc_after_content' ) ) :
/**
 * Markup after product.
 * 
 * @since  1.0.0
 */
function storepro_wc_after_content() {
	?>

		</main>
	</div>

	<?php
}
endif;
add_action( 'woocommerce_after_main_content', 'storepro_wc_after_content', 20 );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function storepro_product_classes( $classes, $class = '', $post_id = '' ) {

	if ( 'product' === get_post_type( $post_id ) && ! is_singular( 'product' ) ) {
		$classes[] = 'uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-4 product-item';
	}

	return $classes;
}
add_filter( 'post_class', 'storepro_product_classes' );

/**
 * Change the prev and next pagination icon.
 *
 * @since  1.0.0
 * @param  array  $args
 * @return array
 */
function storepro_pagination_args( $args ) {
	$args['prev_text'] = '<i class="uk-icon-angle-left"></i>';
	$args['next_text'] = '<i class="uk-icon-angle-right"></i>';
	return $args;
}
add_filter( 'woocommerce_pagination_args', 'storepro_pagination_args' );

/**
 * Border style
 *
 * @since  1.0.0
 */
function storepro_meta_border() {
	echo '<div class="border-style"></div>';
}
add_action( 'woocommerce_single_product_summary', 'storepro_meta_border', 35 );

/**
 * Social share.
 *
 * @since  1.0.0
 */
function storepro_social_share() {
	global $post;
?>
	<div class="border-style"></div>

	<div class="social">
		<span><?php _e( 'Share:', 'storepro' ); ?></span>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-facebook uk-icon-small"></i></a>
		<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-twitter uk-icon-small"></i></a>
		<a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="uk-icon-google-plus uk-icon-small"></i></a>
		<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>&description=<?php echo get_the_excerpt(); ?>"><i class="uk-icon-pinterest uk-icon-small"></i></a>
	</div>
<?php
}
add_action( 'woocommerce_share', 'storepro_social_share' );