<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since  1.0.0
 * @param  array $args Configuration arguments.
 * @return array
 */
function storepro_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'storepro_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function storepro_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'storepro_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function storepro_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'storepro_post_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since  1.0.0
 * @param  string $title Default title text for current view.
 * @param  string $sep Optional separator.
 * @return string The filtered title.
 */
function storepro_wp_title( $title, $sep ) {

	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'storepro' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'storepro_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @since  1.0.0
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function storepro_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'storepro_setup_author' );

/**
 * Generates the relevant template info. Adds template meta with theme version. Uses the theme 
 * name and version from style.css.
 *
 * @since 1.0.0
 */
function storepro_meta_template() {
	$theme    = wp_get_theme( get_template() );
	$template = sprintf( '<meta name="template" content="%1$s %2$s" />' . "\n", esc_attr( $theme->get( 'Name' ) ), esc_attr( $theme->get( 'Version' ) ) );

	echo apply_filters( 'storepro_meta_template', $template );
}
add_action( 'wp_head', 'storepro_meta_template', 10 );

/**
 * Removes default styles set by WordPress recent comments widget.
 *
 * @since 1.0.0
 */
function storepro_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'storepro_remove_recent_comments_style' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function storepro_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'storepro_excerpt_more' );

/**
 * Override the default options.php location.
 *
 * @since  1.0.0
 */
function storepro_location_override() {
	return array( 'admin/options.php' );
}
add_filter( 'options_framework_location', 'storepro_location_override' );

/**
 * Change the theme options text.
 *
 * @since  1.0.0
 * @param  array $menu
 */
function storepro_theme_options_text( $menu ) {
	$menu['page_title'] = '';
	$menu['menu_title'] = __( 'Theme Settings', 'storepro' );

	return $menu;
}
add_filter( 'optionsframework_menu', 'storepro_theme_options_text' );

/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 * @return string
 */
function storepro_feed_url( $output, $feed ) {

	// Get the custom rss feed url.
	$url = of_get_option( 'storepro_feedburner_url' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( !empty( $url ) ) {
		$output = $url;
	}

	return $output;
}
add_filter( 'feed_link', 'storepro_feed_url', 10, 2 );

/**
 * Custom comment form submit field.
 * 
 * @since  1.0.0
 */
function storepro_comment_button() {
	echo '<button type="submit" class="uk-button" id="submit">' . __( 'Post Comment', 'storepro' ) . '</button>';
}
add_action( 'comment_form', 'storepro_comment_button' );