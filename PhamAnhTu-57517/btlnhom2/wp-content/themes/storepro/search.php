<?php get_header(); ?>

	<section id="primary" class="main-content">

		<header class="page-header">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'storepro' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->

		<main id="main" class="blog-post-item" role="main">
			<div class="border-style"></div>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
