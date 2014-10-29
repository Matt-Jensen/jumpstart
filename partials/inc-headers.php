<?php $header_post = isset($header_post) ? $header_post : $post; ?>
<div class="row">
	<header class="small-12 columns fa-subpage-header">
		<h1 class="-white-color"><?php echo $header_post->post_title ?></h1>
		<?php if( get_field('sub_heading', $header_post->ID) ): ?>
			<h2 class="-white-color"><?php the_field('sub_heading', $header_post->ID); ?></h2>
		<?php endif; ?>
	</header>
</div>

</div><!-- header -->