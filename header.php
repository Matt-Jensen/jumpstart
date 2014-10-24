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

    <link rel="shortcut icon" href="<?php echo LIB; ?>branding/favicon.ico">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo LIB; ?>branding/apple-touch-icon.png">
	
	<?php wp_head(); ?>

	<!-- Typekit -->
	<script src="//use.typekit.net/oxt1bjb.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
</head>

<body>
	<div class="<?php if( is_front_page() ){ echo 's-frontpage-bg'; } else { echo 's-sub-page-header'; } ?>">
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

				<section class="top-bar-section">
					<ul class="right">
						<?php echo jumpstart_the_topnav_lis('Header Menu'); ?>
					</ul>
				</section>
			</nav><!-- nav -->
		</div>
	<?php if( !is_front_page() ): ?>
		<?php include( locate_template( 'partials/inc-headers.php' ) ); ?>
		</div><!-- header -->
	<?php endif; ?>