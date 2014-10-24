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

    <main id="page" class="main-content row" role="main">

        <div class="small-12 columns">
            <dl class="tabs vertical fa-tabs" data-tab>
                <dd class="active"><a href="#panel1">Tab 1</a></dd>
                <dd><a href="#panel2">Tab 2</a></dd>
                <dd><a href="#panel3">Tab 3</a></dd>
                <dd><a href="#panel4">Tab 4</a></dd>
            </dl>
            <div class="tabs-content">
                <div class="content active" id="panel1">
                    <p>This is the first panel of the basic tab example. This is the first panel of the basic tab example.</p>
                </div>
                <div class="content" id="panel2">
                    <p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
                </div>
                <div class="content" id="panel3">
                    <p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
                </div>
                <div class="content" id="panel4">
                    <p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
                </div>
            </div>
        </div>

        <div class="small-12 columns">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php if( isset($post->post_content) && strlen($post->post_content) ): ?>
                    <?php echo wpautop($post->post_content); ?>
                <?php endif; ?>

            <?php endwhile; // end of the loop. ?>
        </div>
    </main><!-- #main -->

    <?php include( locate_template( 'partials/related-content.php' ) ); ?>

<?php
get_sidebar();
get_footer();
