<?php // spits out the related content for a sub-page 

$fa_related_contents = get_field('related_content');
?>

<?php if( $fa_related_contents && count($fa_related_contents) ): ?>
	<div id="related-content" class="row -lmt -medium-up-xlmt">	
		<?php foreach($fa_related_contents as $fa_rel_content): ?>
			<div class="small-12 medium-6 columns">
				<h3><?php echo $fa_rel_content['header']; ?></h3>
				<p class="-medium-up-lmb">
					<?php echo strip_tags($fa_rel_content['content'], '<a><u><strong><span><br>'); ?>
				</p>
				<a class="button small alert">
					<?php echo $fa_rel_content['button_text']; ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>