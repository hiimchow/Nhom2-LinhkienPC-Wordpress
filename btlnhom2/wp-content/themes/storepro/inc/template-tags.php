<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'storepro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function storepro_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'storepro' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function storepro_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'storepro_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'storepro_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so storepro_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so storepro_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in storepro_categorized_blog.
 *
 * @since 1.0.0
 */
function storepro_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'storepro_categories' );
}
add_action( 'edit_category', 'storepro_category_transient_flusher' );
add_action( 'save_post',     'storepro_category_transient_flusher' );

if ( ! function_exists( 'storepro_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 * 
 * @since  1.0.0
 */
function storepro_site_branding() {

	$logo = of_get_option( 'storepro_logo' );

	// Check if logo available, then display it.
	if ( $logo ) :
		echo '<a href="' . esc_url( get_home_url() ) . '" rel="home">' . "\n";
			echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
		echo '</a>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<h1 class="site-title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>';
	endif;

}
endif;

if ( ! function_exists( 'storepro_social_links' ) ) :
/**
 * Social links.
 *
 * @since  1.0.0
 */
function storepro_social_links() {

	// Get option value.
	$enable     = of_get_option( 'storepro_enable_social', '1' );
	$facebook   = of_get_option( 'storepro_fb' );
	$twitter    = of_get_option( 'storepro_tw' );
	$gplus      = of_get_option( 'storepro_gplus' );
	$pinterest  = of_get_option( 'storepro_pinterest' );
	$vimeo      = of_get_option( 'storepro_vimeo' );
	$tumblr     = of_get_option( 'storepro_tumblr' );
	$linkedin   = of_get_option( 'storepro_linkedin' );
	$instagram  = of_get_option( 'storepro_instagram' );
	$rss        = of_get_option( 'storepro_rss' );

	// Check if social links option enabled.
	if ( $enable ) {
		echo '<ul>';

			if ( $facebook ) {
				echo '<li><a href="' . esc_url( $facebook ) . '"><i class="uk-icon-facebook-square uk-icon-small"></i></a></li>';
			}
			if ( $twitter ) {
				echo '<li><a href="' . esc_url( $twitter ) . '"><i class="uk-icon-twitter uk-icon-small"></i></a></li>';
			}
			if ( $gplus ) {
				echo '<li><a href="' . esc_url( $gplus ) . '"><i class="uk-icon-google-plus uk-icon-small"></i></a></li>';
			}
			if ( $pinterest ) {
				echo '<li><a href="' . esc_url( $pinterest ) . '"><i class="uk-icon-pinterest uk-icon-small"></i></a></li>';
			}
			if ( $vimeo ) {
				echo '<li><a href="' . esc_url( $vimeo ) . '"><i class="uk-icon-vimeo-square uk-icon-small"></i></a></li>';
			}
			if ( $tumblr ) {
				echo '<li><a href="' . esc_url( $tumblr ) . '"><i class="uk-icon-tumblr uk-icon-small"></i></a></li>';
			}
			if ( $linkedin ) {
				echo '<li><a href="' . esc_url( $linkedin ) . '"><i class="uk-icon-linkedin uk-icon-small"></i></a></li>';
			}
			if ( $instagram ) {
				echo '<li><a href="' . esc_url( $instagram ) . '"><i class="uk-icon-instagram uk-icon-small"></i></a></li>';
			}
			if ( $rss ) {
				echo '<li><a href="' . esc_url( $rss ) . '"><i class="uk-icon-rss uk-icon-small"></i></a></li>';
			}

		echo '</ul>';
	}

}
endif;

if ( ! function_exists( 'storepro_post_author' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function storepro_post_author() {

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Bail if user don't want to display the author info via theme settings.
	if ( ! of_get_option( 'storepro_post_author', '1' ) ) {
		return;
	}
?>

	<div class="post-author">
		<article class="uk-comment">
			<header class="uk-comment-header">
				<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'storepro_author_bio_avatar_size', 90 ) ); ?>
				<h3 class="uk-comment-title">
					<?php echo strip_tags( get_the_author() ); ?>
				</h3>
				<div class="uk-comment-meta"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></div>
				<a class="author-name url fn n author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( ( '%s <i class="uk-icon-angle-right"></i>' ), __( 'More from this Author', 'storepro' ) ); ?></a>
			</header>
		</article>
	</div><!-- .post-author -->

<?php
}
endif;

if ( ! function_exists( 'storepro_related_posts' ) ) :
/**
 * Related posts carousel
 *
 * @since  1.0.0
 */
function storepro_related_posts() {
	global $post;

	// Bail if user don't want to display the author info via theme settings.
	if ( ! of_get_option( 'storepro_related_posts', '1' ) ) {
		return;
	}

	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}
	
	// Posts query arguments.
	$query = array(
		'post__not_in' => array( $post->ID ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 10,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'storepro_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : ?>

		<div class="product product-slider">
			
			<h2 class="product-title"><?php _e( 'Related Articles', 'storepro' ); ?></h2>
			<div class="tx-div"></div>
			<div id="blog-post" class="owl-carousel collection">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<div class="item">
						<article class="half-list uk-clearfix">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="article-img">
									<a class="uk-overlay" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'storepro-related', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="article-text">
								<div class="post-review uk-visible-small uk-clearfix">
									<time class="published article-date" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
									<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
										<span class="entry-comment comment">| <?php comments_popup_link( __( '0 Comment', 'storepro' ), __( '1 Comment', 'storepro' ), __( '% Comments', 'storepro' ) ); ?></span>
									<?php endif; ?>
								</div>
								<?php the_title( sprintf( '<h2 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<p><?php echo apply_filters( 'storepro_related_excerpt', wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							</div>
						</article>
					</div>
				<?php endwhile; ?>
			</div>

		</div>

		<div class="border-style"></div>
	
	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'storepro_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function storepro_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'storepro' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'storepro' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment uk-comment">
			
			<header class="uk-comment-header">
				<?php echo get_avatar( $comment, 60 ); ?>

				<div class="uk-comment-body">
					<h4 class="uk-comment-title"><?php echo get_comment_author_link(); ?></h4>
					<span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php echo get_comment_time( 'c' ); ?>"><?php echo get_comment_date(); ?></time></a></span>
					<div class="comment-text">
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'storepro' ); ?></p>
						<?php endif; ?>
						<?php comment_text(); ?>
						<span class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="uk-icon-reply"></i> Reply', 'storepro' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</span><!-- .reply -->
						<div class="border-style"></div>
					</div>
				</div>
			</header>

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;