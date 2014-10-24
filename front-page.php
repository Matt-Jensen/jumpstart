<?php
/**
 * This will always be the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

    <main id="front-page" role="main">
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>

            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() ) :
                    comments_template();
                endif;
            ?>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->

    <?php if( is_front_page() ) echo '</div><!-- header -->'; ?>

<?php
get_sidebar();
get_footer();
