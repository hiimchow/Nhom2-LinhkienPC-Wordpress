<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page 
 * and be saved in the database.
 *
 * @since  1.0.0
 * @access public
 */
function optionsframework_options() {

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}

	// Pull all the categories into an array
	$categories = array();
	$categories_obj = get_categories();
	foreach ( $categories_obj as $category ) {
		$categories[$category->cat_ID] = esc_html( $category->cat_name );
	}

	// Background thumbnail path.
	$imgpath =  get_template_directory_uri() . '/assets/img/bg/';

	$options = array();

	$options[] = array(
		'name' => __( 'General', 'storepro' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Logo Uploader', 'storepro' ),
		'desc' => __( 'Upload your custom logo, it will automatically replace the Site Title', 'storepro' ),
		'id'   => 'storepro_logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Favicon Uploader', 'storepro' ),
		'desc' => __( 'Upload your custom favicon.', 'storepro' ),
		'id'   => 'storepro_favicon',
		'type' => 'upload'
	);

	$options[] = array(
		'name'  => __( 'FeedBurner URL', 'storepro' ),
		'desc'  => __( 'Enter your full FeedBurner URL. If you wish to use FeedBurner over the standard WordPress feed.', 'storepro' ),
		'id'    => 'storepro_feedburner_url',
		'placeholder' => 'http://feeds.feedburner.com/ThemeJunkie',
		'type'  => 'text'
	);

	$options[] = array(
		'name'  => __( 'Phone Number', 'storepro' ),
		'desc'  => __( 'Enter your store phone number.', 'storepro' ),
		'id'    => 'storepro_phone',
		'type'  => 'text'
	);

	$options[] = array(
		'name'  => __( 'FeedBurner ID', 'storepro' ),
		'desc'  => __( 'Enter your FeedBurner ID here, it will used for the newsletter signup form in the footer.', 'storepro' ),
		'id'    => 'storepro_feedburner_id',
		'placeholder' => 'ThemeJunkie',
		'type'  => 'text'
	);

	$options[] = array(
		'name' => __( 'Single Post', 'storepro' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Display author info ', 'storepro' ),
		'desc' => __( 'Enable the author biographical info.', 'storepro' ),
		'id'   => 'storepro_post_author',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Display share links', 'storepro' ),
		'desc' => __( 'Enable the share links.', 'storepro' ),
		'id'   => 'storepro_post_share',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Display related posts', 'storepro' ),
		'desc' => __( 'Enable the related posts.', 'storepro' ),
		'id'   => 'storepro_related_posts',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Before Content Advertisement', 'storepro' ),
		'desc' => __( 'Your ad will appear on single post before content.', 'storepro' ),
		'id'   => 'storepro_ad_single_before',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'After Content Advertisement', 'storepro' ),
		'desc' => __( 'Your ad will appear on single post after content.', 'storepro' ),
		'id'   => 'storepro_ad_single_after',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Social Links', 'storepro' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Enable ', 'storepro' ),
		'desc' => __( 'Enable social links', 'storepro' ),
		'id'   => 'storepro_enable_social',
		'std'  => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Facebook', 'storepro' ),
		'desc' => __( 'Facebook profile url', 'storepro' ),
		'id'   => 'storepro_fb',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Twitter', 'storepro' ),
		'desc' => __( 'Twitter profile url', 'storepro' ),
		'id'   => 'storepro_tw',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Google Plus', 'storepro' ),
		'desc' => __( 'Google Plus profile url', 'storepro' ),
		'id'   => 'storepro_gplus',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Pinterest', 'storepro' ),
		'desc' => __( 'Pinterest profile url', 'storepro' ),
		'id'   => 'storepro_pinterest',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Vimeo', 'storepro' ),
		'desc' => __( 'Vimeo profile url', 'storepro' ),
		'id'   => 'storepro_vimeo',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Tumblr', 'storepro' ),
		'desc' => __( 'Tumblr profile url', 'storepro' ),
		'id'   => 'storepro_tumblr',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Linkedin', 'storepro' ),
		'desc' => __( 'Linkedin profile url', 'storepro' ),
		'id'   => 'storepro_linkedin',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Instagram', 'storepro' ),
		'desc' => __( 'Instagram profile url', 'storepro' ),
		'id'   => 'storepro_instagram',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Rss', 'storepro' ),
		'desc' => __( 'Rss url', 'storepro' ),
		'id'   => 'storepro_rss',
		'placeholder' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Custom Code', 'storepro' ),
		'type' => 'heading'
	);

	$options['storepro_script_head'] = array(
		'name' => __( 'Header code', 'storepro' ),
		'desc' => __( 'If you need to add custom scripts to your header (meta tag verification, google fonts url), you should enter them in the box. They will be added before &lt;/head&gt; tag', 'storepro' ),
		'id'   => 'storepro_script_head',
		'type' => 'textarea'
	);

	$options['storepro_script_footer'] = array(
		'name' => __( 'Footer code', 'storepro' ),
		'desc' => __( 'If you need to add custom scripts to your footer (like google analytic script), you should enter them in the box. They will be added before &lt;/body&gt; tag', 'storepro' ),
		'id'   => 'storepro_script_footer',
		'type' => 'textarea'
	);

	/* Return the theme settings data. */
	return $options;
}