<?php
// Return early if no widget found.
if ( ! is_active_sidebar( 'primary' ) ) {
	return;
}
?>

<div id="secondary" class="side-bar" role="complementary">
	<?php dynamic_sidebar( 'primary' ); ?>
</div><!-- #secondary -->