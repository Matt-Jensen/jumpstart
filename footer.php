<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 */
?>

    <footer class="fa-footer">
		<div class="row">
			<div class="small-12 medium-8 columns">
				<?php if( get_field('about_first_american', 'options') ): ?>
					<div class="fa-footer__divider">
						<h3 class="-white-color -nmb">About First American</h3>
						<p class="-white-color -lmb">
							<?php the_field('about_first_american', 'options'); ?>
						</p>
					</div>
				<?php endif; ?>

				<div class="show-for-medium-up">
					<?php include( locate_template( 'partials/footer-copyright.php' ) ); ?>
				</div>
			</div>
			<div class="small-12 medium-4 columns">
				<div class="-medium-up-pl -small-lmb">
					<?php if( get_field('phone_number', 'options') ): ?>
						<h3 class="-white-color -nmb">
							<?php if( get_field('location', 'options') ): ?> 
								<a href="<?php echo get_tel_href(get_field('location', 'options'), get_field('phone_number', 'options')); ?>">
							<?php endif; ?>
							<?php the_field('phone_number', 'options'); ?>
							<?php if( get_field('location', 'options') ): ?>
								</a>
							<?php endif; ?>
						</h3>
					<?php endif; ?>
					
					<?php if( get_field('location', 'options') ): ?>
						<?php $fa_address = explode(',', get_field('location', 'options')['address']); ?>
						<div class="-white-color"><?php echo $fa_address[0]; ?></div>
						<div class="-white-color"><?php echo $fa_address[1]; ?>, <?php echo $fa_address[2]; ?></div>
					<?php endif; ?>
					<?php if( get_field('fax_number', 'options') ): ?>
						<div class="-white-color">Fax. <?php the_field('fax_number', 'options'); ?></div>
					<?php endif; ?>
					<?php if( get_field('email', 'options') ): ?>
						<a class="-db -white-color"
							href="mailto:<?php the_field('email', 'options'); ?>">
							<?php the_field('email', 'options'); ?>
						</a>
					<?php endif; ?>

					<ul class="fa-icon-list -lmt -nmb -npb">
						<?php if( get_field('facebook_public_profile_link', 'options') ): ?>
							<li>
								<a class="facebook-icon" href="<?php the_field('facebook_public_profile_link', 'options'); ?>" target="_blank">
									Facebook
								</a>
							</li>
						<?php endif; ?>
						
						<?php if( get_field('twitter_handle', 'options') ): ?>
							<li>
								<a class="twitter-icon" href="https://twitter.com/<?php the_field('twitter_handle', 'options'); ?>" target="_blank">
									Twitter
								</a>
							</li>
						<?php endif; ?>
						
						<?php if( get_field('linkedin_public_profile_link', 'options') ): ?>
							<li>
								<a class="linked-in-icon" href="<?php the_field('linkedin_public_profile_link', 'options'); ?>" target="_blank">
									Linked In
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="show-for-small-only">
					<?php include( locate_template( 'partials/footer-copyright.php' ) ); ?>
				</div>
			</div>
		</div>
    </footer><!-- footer -->

<?php wp_footer(); ?>
</body>
</html>
