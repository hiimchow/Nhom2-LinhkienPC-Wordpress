<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site uk-container uk-container-center">

	<header id="masthead" class="site-header" role="banner">
		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>
	</header><!-- #masthead -->

	<?php if ( is_page_template( 'page-templates/home.php' ) ) : ?>
		<div class="slider-area">

			<div class="left-area uk-visible-large">
				<div class="catagory-dropdown">
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
			
			<?php get_template_part( 'content', 'slides' ); ?>

		</div>
	<?php endif; ?>

	<div id="content" class="site-content">