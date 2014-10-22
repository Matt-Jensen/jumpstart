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
	<header class="s-sub-page-header">
		<nav class="row top-bar" data-topbar role="navigation">
			<section class="top-bar-section">
				<ul class="right">
					<?php echo jumpstart_the_topnav_lis('Header Menu'); ?>
				</ul>
			</section>
		</nav><!-- nav -->
	</header><!-- header -->