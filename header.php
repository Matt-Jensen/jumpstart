<?php
/**
 * jumpstart needs a header.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php $fa_option_address = get_field('location', 'option'); ?>
	<?php if( $fa_option_address && isset($fa_option_address['address']) && isset($fa_option_address['lat']) && isset($fa_option_address['lng']) ): ?>
		<?php the_geolocation_meta_tags( $fa_option_address ); ?>
	<?php endif; ?>

	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/favicon-152.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/favicon-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/favicon-120.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/favicon-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/favicon-72.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/favicon-57.png">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
	
	<?php wp_head(); ?>

	<!-- Typekit -->
	<script src="//use.typekit.net/oxt1bjb.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
</head>

<body data-theme-dir="<?php echo get_template_directory_uri();?>">
	<div class="<?php if( is_front_page() ){ echo 's-front-page'; } else { echo 's-sub-page-header'; } ?>">
		<div class="row">
			<nav class="small-12 columns top-bar fa-top-bar" data-topbar role="navigation">
				
				<ul id="logo" class="title-area hide">
					<li class="name">
						<a href="<?php echo get_home_url(); ?>" class="-db">
							<?php the_interchange_img( 
								get_template_directory_uri() . '/images/', 
								array(
									'small' => 'first-american-logo.png',
									'default' => 'first-american-logo.png',
									'retina' => 'first-american-logo@x2.png'
								),
								get_bloginfo('name') . ' - ' . get_bloginfo('description')
							);?>
						</a>
					</li>
				</ul>

				<section class="top-bar-section hide -medium-up-tac -small-tal">
					<ul class="-inline-block">
						<?php echo jumpstart_the_topnav_lis('Header Menu'); ?>
					</ul>
				</section>
			</nav><!-- nav -->
		</div>