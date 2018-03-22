<?php
/**
 * Product Categories widget.
 *
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class StorePro_Prod_Cat_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-storepro-prod-cat product product-slider',
			'description' => __( 'Display product categories with thumbnail on home page.', 'storepro' )
		);

		// Create the widget.
		parent::__construct(
			'storepro-prod-cat',                                   // $this->id_base
			__( '&raquo; Home - Product Categories', 'storepro' ), // $this->name
			$widget_options                                        // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Get the product tax.
		$categories = get_terms( 
			'product_cat', 
			array( 
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => 1
			) 
		);

		if ( $categories ) :

			// Output the theme's $before_widget wrapper.
			echo $before_widget;

			// If the title not empty, display it.
			if ( $instance['title'] ) {
				echo '<h2 class="product-title">' . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . '</h2>';
				echo '<div class="tx-div"></div>';
			}

			echo '<div id="product-category" class="owl-carousel collection">';

				// Display the categories.
				foreach( $categories as $cat ) :

					$cat_thumb_id  = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
					$cat_thumb_img = wp_get_attachment_image( $cat_thumb_id, 'storepro-cat' );
					$term_link     = get_term_link( $cat, 'product_cat' );

					echo '<div class="item">';
						echo '<div class="uk-overlay">';
							echo '<a href="' . esc_url( $term_link ) . '">' . $cat_thumb_img . '</a>';
							echo '<div class="uk-overlay-caption uk-clearfix">';
								echo '<a href="' . esc_url( $term_link ) . '">' . $cat->name . '</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';

				endforeach;
			
			echo '</div>';
			echo '<div class="border-style"></div>';

			// Close the theme's widget wrapper.
			echo $after_widget;

		endif;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );

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
			'title'   => esc_html__( 'Product Categories', 'storepro' )
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'storepro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

	<?php

	}

}