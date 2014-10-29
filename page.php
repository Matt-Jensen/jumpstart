<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php include( locate_template( 'partials/inc-headers.php' ) ); ?>

    <main id="page" class="main-content row" role="main">

        <div class="small-12 columns">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php if( isset($post->post_content) && strlen($post->post_content) ): ?>
                    <?php echo wpautop(do_shortcode($post->post_content)); ?>
                <?php endif; ?>

            <?php endwhile; // end of the loop. ?>
        </div>
    </main><!-- #main -->

    <?php include( locate_template( 'partials/related-content.php' ) ); ?>

<?php
get_sidebar();
get_footer();
