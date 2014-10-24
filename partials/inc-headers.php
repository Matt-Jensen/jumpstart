<div class="row">
	<header class="small-12 columns fa-subpage-header">
		<?php if( is_page() ): ?>
			<h1 class="-white-color"><?php the_title(); ?></h1>
			<?php if( get_field('sub_heading') ): ?>
				<h2 class="-white-color"><?php the_field('sub_heading'); ?></h2>
			<?php endif; ?>
		<?php endif; ?>
	</header>
</div>