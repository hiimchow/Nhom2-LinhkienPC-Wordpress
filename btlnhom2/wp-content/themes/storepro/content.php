<article id="post-<?php the_ID(); ?>" <?php post_class( 'two-third uk-clearfix' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-img">
			<a class="uk-overlay" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'storepro-post', array( 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
		</div>
	<?php endif; ?>
	
	<div class="article-text">
		<?php the_title( sprintf( '<h2 class="article-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="tx-div"></div>
		<div class="single-post-detail">
			<time class="published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>">
				<span class="by-date"><?php printf( __( 'Posted on %s', 'storepro' ), '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_date() ) . '</a>' ); ?></span>
			</time>
			<span class="entry-author author vcard by-author"><?php printf( __( 'by <a class="url fn n" href="%1$s"><span>%2$s</span></a>', 'storepro' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?></span>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="entry-comment by-comment">| <?php comments_popup_link( __( '0 Comment', 'storepro' ), __( '1 Comment', 'storepro' ), __( '% Comments', 'storepro' ) ); ?></span>
			<?php endif; ?>
		</div>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read More &raquo;', 'storepro' ); ?></a>
	</div>
	
</article><!-- #post-## -->

<div class="border-style"></div>