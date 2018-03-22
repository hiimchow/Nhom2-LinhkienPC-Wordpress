<?php
/**
 * Home recent products widget.
 *
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class StorePro_Recent_Prod_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-storepro-recent-prod product product-slider',
			'description' => __( 'Display a slider of your recent products on home page.', 'storepro' )
		);

		// Create the widget.
		parent::__construct(
			'storepro-recent-prod',                             // $this->id_base
			__( '&raquo; Home - Recent Products', 'storepro' ), // $this->name
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

		// Display the products.
		$query_args = array(
			'posts_per_page' => $instance['limit'],
			'post_status'    => 'publish',
			'post_type'      => 'product'
		);

		$products = new WP_Query( $query_args );

		if ( $products->have_posts() ) :

			// Output the theme's $before_widget wrapper.
			echo $before_widget;

			// If the title not empty, display it.
			if ( $instance['title'] ) {
				echo '<h2 class="product-title">' . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . '</h2>';
				echo '<div class="tx-div"></div>';
			}
			?>
			
			<div id="recent-product" class="owl-carousel collection">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<div class="item">
						<div class="uk-overlay">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'storepro-products', array( 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
							<?php endif; ?>
							<?php global $product; ?>
							<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $product->get_title(); ?></a></h3>
							<span class="price">
								<?php echo $product->get_price_html(); ?>
							</span>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="border-style"></div>

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
			'title' => esc_html__( 'Recent Products', 'storepro' ),
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
				<?php _e( 'Number of products to show', 'storepro' ); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo absint( $instance['limit'] ); ?>" size="3" />
		</p>

	<?php

	}

}