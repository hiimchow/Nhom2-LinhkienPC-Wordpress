<nav id="secondary-navigation" class="uk-navbar main-nav uk-clearfix" role="navigation">

	<div class="catagory-area uk-visible-large">
		<div class="catagory" data-uk-dropdown>
			<a href="#"><?php _e( 'Category', 'storepro' ); ?><i class="uk-icon-reorder"></i></a>

			<div class="uk-dropdown catagory-dropdown">
				<?php wp_nav_menu(
					array(
						'theme_location' => 'category',
						'container'      => '',
						'menu_id'        => 'menu-category-items',
						'menu_class'     => 'menu-category-items uk-nav',
						'fallback_cb'    => '',
						'walker'         => new Storepro_Category_Nav_Walker
					)
				); ?>
			</div>

		</div>
	</div>

	<div class="main-menu uk-clearfix">

		<div class="main-nav-left">

			<a href="#" class="uk-navbar-toggle uk-hidden-large" data-uk-offcanvas="{target:'#offcanvas-1'}"></a>

			<?php wp_nav_menu(
				array(
					'theme_location' => 'secondary',
					'container'      => '',
					'menu_id'        => 'menu-secondary-items',
					'menu_class'     => 'menu-secondary-items uk-navbar-nav uk-visible-large',
					'fallback_cb'    => '',
					'walker'         => new Storepro_Secondary_Nav_Walker
				)
			); ?>

		</div>

		<?php get_search_form(); // Loads the searchform.php template. ?>

	</div>

	<div id="offcanvas-1" class="uk-offcanvas">
		<div class="uk-offcanvas-bar">

			<?php wp_nav_menu(
				array(
					'theme_location' => 'secondary',
					'container'      => '',
					'menu_id'        => 'menu-secondary-items',
					'menu_class'     => 'uk-nav uk-nav-offcanvas uk-nav-parent-icon',
					'fallback_cb'    => '',
					'items_wrap'     => '<ul id="%1$s" class="%2$s" data-uk-nav>%3$s</ul>',
				)
			); ?>

		</div>
	</div><!--  uk-offcanvas  -->

</nav><!-- #secondary-navigation -->