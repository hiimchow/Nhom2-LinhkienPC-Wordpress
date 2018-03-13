<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="single-post-wrapper">
	
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="single-post-detail">
			<time class="published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>">
				<span class="by-date"><?php printf( __( 'Posted on %s', 'storepro' ), '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_date() ) . '</a>' ); ?></span>
			</time>
			<span class="entry-author author vcard by-author"><?php printf( __( 'by <a class="url fn n" href="%1$s"><span>%2$s</span></a>', 'storepro' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?></span>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="entry-comment by-comment">| <?php comments_popup_link( __( '0 Comment', 'storepro' ), __( '1 Comment', 'storepro' ), __( '% Comments', 'storepro' ) ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'storepro' ), '<span class="edit-link">| ', '</span>' ); ?>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'storepro' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</div>

	<div class="border-style"></div>

	<div class="tag-catagory">

		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'storepro' ) );
			if ( $categories_list && storepro_categorized_blog() ) :
		?>
			<span>
				<?php printf( __( 'Posted in: %1$s', 'storepro' ), $categories_list ); ?>
			</span>
		<?php endif; // End if categories ?>
		
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'storepro' ) );
			if ( $tags_list ) :
		?>
			<span>
				<?php printf( __( 'and tagged: %1$s', 'storepro' ), $tags_list ); ?>
			</span>
		<?php endif; // End if $tags_list ?>

	</div>
	
</article><!-- #post-## -->

<?php storepro_post_author(); // Get the post author information. ?>

<?php storepro_related_posts(); // Get the related posts. ?>