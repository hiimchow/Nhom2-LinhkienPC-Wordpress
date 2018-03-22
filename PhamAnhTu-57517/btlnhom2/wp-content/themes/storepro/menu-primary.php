<nav id="primary-navigation" class="main-navigation top-nav uk-clearfix" role="navigation">

	<div class="top-nav-left">
		<?php storepro_site_branding(); // Get the site title/logo. ?>
	</div>
		
	<div class="top-nav-right">

		<?php if ( of_get_option( 'storepro_phone' ) ) : ?>
			<span class="phone-no uk-visible-large"><?php printf( __( 'CALL %s', 'storepro' ), of_get_option( 'storepro_phone' ) ); ?></span>
		<?php endif; ?>

		<?php wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => '',
				'menu_id'        => 'menu-primary-items',
				'menu_class'     => 'menu-primary-items uk-hidden-small',
				'fallback_cb'    => ''
			)
		); ?>
		
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<div class="cart" data-uk-dropdown>
				<?php global $woocommerce; ?>
				<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storepro' ); ?>">
					<?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'storepro' ), $woocommerce->cart->cart_contents_count ); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>

</nav><!-- #primary-navigation -->