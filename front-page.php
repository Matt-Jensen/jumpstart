<?php
/**
 * This will always be the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

    <main id="front-page" role="main">
        <div class="fa-hero-container">
            <?php if( get_field('heading') ): ?>
                <h1 class="fa-hero-container__header"><?php the_field('heading'); ?></h1>
            <?php endif; ?>
           
            <?php if( get_field('text') ): ?>
                <p class="fa-hero-container__copy"><?php the_field('text'); ?></p>
            <?php endif; ?>

            <?php if( get_field('button_text') && get_field('button_link') ): ?>
                <a class="button fa-hero-container__button" href="<?php the_field('button_link'); ?>"><?php the_field('button_text'); ?></a>
            <?php endif; ?>
        </div>
    </main><!-- #main -->

    <?php if( is_front_page() ) echo '</div><!-- header -->'; ?>

<?php
get_sidebar();
get_footer();
