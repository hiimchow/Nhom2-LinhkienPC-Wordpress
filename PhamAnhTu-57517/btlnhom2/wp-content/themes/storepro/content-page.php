<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="single-post-wrapper">

		<header class="entry-header">
			<?php the_title( '<h2 class="product-title">', '</h2>' ); ?>
			<div class="tx-div"></div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'storepro' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		
		<?php edit_post_link( __( 'Edit', 'storepro' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
	
	</div><!-- .single-post-wrapper -->

</article><!-- #post-## -->
