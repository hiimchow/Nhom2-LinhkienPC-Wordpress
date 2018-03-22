<?php get_header(); ?>

	<section id="primary" class="main-content">

		<header class="page-header">
			<h1 class="page-title">
				<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						printf( __( 'Author: %s', 'storepro' ), '<span class="vcard">' . get_the_author() . '</span>' );

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'storepro' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'storepro' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'storepro' ) ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'storepro' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'storepro' ) ) . '</span>' );

					else :
						_e( 'Archives', 'storepro' );

					endif;
				?>
			</h1>
		</header><!-- .page-header -->

		<main id="main" class="blog-post-item" role="main">
			<div class="border-style"></div>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'archive' ); ?>

				<?php endwhile; ?>

				<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>