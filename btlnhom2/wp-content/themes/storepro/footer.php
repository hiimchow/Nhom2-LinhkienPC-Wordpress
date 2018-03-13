	</div><!-- #content -->
</div><!--  uk-container  -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="footer-top">
			<div class="uk-container uk-container-center">
				<div class="uk-grid">
					
					<?php $id = of_get_option( 'storepro_feedburner_id' ); ?>

					<div class="uk-width-1-1 uk-width-large-2-3 footer-top-left">
						<?php if ( $id ) : ?>
							<h3><?php _e( 'Newsletter Signup', 'storepro' ); ?></h3>
							<form class="form-subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo strip_tags( $id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true">
								<input class="email-address" type="text" name="email" placeholder="<?php esc_attr_e( 'Enter your email', 'storepro' ); ?>">
								<input type="hidden" value="<?php echo strip_tags( $id ); ?>" name="uri">
								<input type="hidden" value="<?php echo strip_tags( $id ); ?>" name="title">
								<input type="hidden" name="loc" value="en_US">
								<input type="submit" class="subscribe-button" value="<?php esc_attr_e( 'Submit', 'storepro' ); ?>" name="subscribe" id="subscribe">
							</form>
						<?php endif; ?>
					</div>

					<div class="uk-width-1-1 uk-width-large-1-3 footer-top-right">
						<?php storepro_social_links(); ?>
					</div>

				</div><!--  uk-grid  -->    
			</div><!--  uk-container  -->
		</div><!--  footer-top  -->

		<div class="footer-middle">
			<div class="uk-container uk-container-center">
				<div class="uk-grid" data-uk-grid-match>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>

					<div class="uk-width-1-1 uk-width-small-2-4 uk-width-medium-1-4">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="uk-container uk-container-center">
				<div class="footer-border uk-clearfix">
					<div class="footer-bottom-left">
						<p><?php printf( __( '&copy; Copyright %1$s %2$s', 'storepro' ), date( 'Y' ), '<a href=" ' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>.' ); ?><span class="copyright"><?php printf( __( 'Proudly designed by %s', 'storepro' ), '<a href="http://www.theme-junkie.com/">Theme Junkie</a>.' ); ?></span></p>
					</div>
				</div>
			</div><!--  uk-container  -->
		</div><!--  footer-bottom  -->
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
