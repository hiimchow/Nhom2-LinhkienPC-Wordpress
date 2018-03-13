<?php
if ( ! class_exists( 'Tj_Slides' ) ) {
	return;
}

$args = array(
	'posts_per_page' => 5,
	'post_status'    => 'publish',
	'post_type'      => 'slides'
);
$slides = new WP_Query( $args );

if ( $slides->have_posts() ) :
?>
	<div class="right-area">
		<div id="main-slider" class="owl-carousel">
			<?php while ( $slides->have_posts() ) : $slides->the_post(); ?>
				<?php $url = get_post_meta( get_the_ID(), 'tjs_slides_url', true ); ?>

				<div class="item">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'storepro-slides', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
					<?php endif; ?>
					<div class="slider-wraper-left">
						<h2 class="offer"><?php the_title(); ?></h2>
						<a href="<?php echo esc_url( $url ); ?>" class="shop-button" rel="bookmark">Shop Now</a>
					</div>
				</div>

			<?php endwhile; ?>
		</div>
	</div>

<?php endif; wp_reset_postdata(); ?>