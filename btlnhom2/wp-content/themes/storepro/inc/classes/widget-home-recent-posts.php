<?php
/**
 * Home recent posts widget.
 *
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class StorePro_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-storepro-recent-post product product-slider',
			'description' => __( 'Display a slider of your recent posts on home page.', 'storepro' )
		);

		// Create the widget.
		parent::__construct(
			'storepro-recent-post',                             // $this->id_base
			__( '&raquo; Home - Recent Posts', 'storepro' ), // $this->name
			$widget_options                                     // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Display the posts.
		$query_args = array(
			'posts_per_page' => $instance['limit'],
			'post_status'    => 'publish',
			'post_type'      => 'post'
		);

		$posts = new WP_Query( $query_args );

		if ( $posts->have_posts() ) :

			// Output the theme's $before_widget wrapper.
			echo $before_widget;

			// If the title not empty, display it.
			if ( $instance['title'] ) {
				echo '<h2 class="product-title">' . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . '</h2>';
				echo '<div class="tx-div"></div>';
			}
			?>
			
			<div id="blog-post" class="owl-carousel collection">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<div class="item">
						<article class="half-list uk-clearfix">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="article-img">
									<a class="uk-overlay" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'storepro-related', array( 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
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

			<?php
			// Close the theme's widget wrapper.
			echo $after_widget;

		endif; wp_reset_postdata();

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = (int) $new_instance['limit'];

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title' => esc_html__( 'From Our Blog', 'storepro' ),
			'limit' => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title', 'storepro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php _e( 'Number of posts to show', 'storepro' ); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo absint( $instance['limit'] ); ?>" size="3" />
		</p>

	<?php

	}

}