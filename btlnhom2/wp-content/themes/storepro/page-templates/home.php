<?php
/**
 * Template Name: Home template
 */
get_header(); ?>

	<div id="primary" class="main-content">
		<main id="main" class="blog-page" role="main">

			<?php get_sidebar( 'home' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>