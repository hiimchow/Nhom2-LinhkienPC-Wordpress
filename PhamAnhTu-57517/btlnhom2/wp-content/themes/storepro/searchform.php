<div class="search-area">
	<div class="form-search" data-uk-dropdown>
		<a href="#" class="search-button"></a>
		<div class=" uk-dropdown">
			<form class="navbar-form" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<input type="text" name="s" id="s">
				<button type="submit" name="submit" id="searchsubmit"><i class="uk-icon-search"></i></button>
				<input type="hidden" name="post_type" value="product" />
			</form>
		</div>
	</div>
</div>