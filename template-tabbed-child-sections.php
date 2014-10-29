<?php
/**
 * Template Name: Tabbed Children
 *
 * This template displays a parent page's content above a tabbed interface of all child page's content.
 */

get_header(); 

$page_children = get_post_children( get_the_ID() );
$is_parent_page = count($page_children) !== 0;

if( $is_parent_page ) {
	$parent_post = $post;
}
else { 
	$parent_post = get_post_ancestors($post);
	$parent_post = count($parent_post) ? get_post( $parent_post[0] ) : $post; // If no ancestors it the parent
}

$parent_children = $is_parent_page ? $page_children : get_post_children( $parent_post->ID );
$tab_sort_order = array();
$active_tab = null;

// Check if tabs are sorted
foreach( $parent_children as $tab_child ) {

	$sort_order = get_field('tab_order', $tab_child->ID);

	// Check if tab has a specified order
	if( $sort_order && is_numeric($sort_order) ) {
		$tab_sort_order[ $sort_order ] = $tab_child->ID;
	}
}

// If user specified any tab sort order, sort the tabs accordingly
if( count($tab_sort_order) ) {
	$parent_children = sort_array_objects_by_id( $parent_children, $tab_sort_order );
}

// If this is the parent page get index 0 child else use the current post's ID
if( $is_parent_page ) {
	$active_tab_id = count($parent_children) ? array_values($parent_children)[0]->ID : null;
}
else {
	$active_tab_id = $post->ID;
}

if( $active_tab_id ) {
	foreach( $parent_children as $tab_child ) {
		// var_dump($tab_child->ID);
		if( $active_tab_id == $tab_child->ID ) {
			$active_tab = $tab_child;
			break;
		}
	}
}


/////////////
// HEADER
/////////////

$header_post = $parent_post; // Provide specific post to inc-headers.php
include( locate_template( 'partials/inc-headers.php' ) ); 
?>

	<main id="page" class="main-content row" role="main">
		
		<div class="small-12 columns">
			
			<?php 			
			

			////////////////////
			// PARENT CONTENT
			///////////////////
			
			if( isset($parent_post->post_content) && strlen($parent_post->post_content) ):
			    echo wpautop(do_shortcode($parent_post->post_content));
			endif;


			/////////////
			// TABS
			/////////////

			if( $parent_children && is_array($parent_children) && count($parent_children) ): ?>
				<div class="small-12 columns">
				    <dl class="tabs fa-tabs"
				    	data-interchange-class="[vertical, (small)], [!vertical, (medium)]">
				    	<?php foreach( $parent_children as $tab_child ): ?>
							<dd <?php if( $active_tab_id === $tab_child->ID ) echo ' class="active"'; ?>>
								<a href="<?php echo get_permalink($tab_child->ID); ?>">
									<?php echo $tab_child->post_title; ?>
								</a>
							</dd>
				        <?php endforeach; ?>

				    </dl>
				    
				    <?php if( $active_tab && isset($active_tab->post_content) && strlen($active_tab->post_content) ): ?>
						<div class="tabs-content">	            	
							<div class="content active">
								<?php echo wpautop(do_shortcode($active_tab->post_content)); ?>
							</div>
						</div>
					<?php endif; ?>

				</div>
			<?php endif; ?>

	    </div>
		<?php 

		////////////////////
		// RELATED CONTENT
		///////////////////

		$related_contents_post = $parent_post;
		include( locate_template( 'partials/related-content.php' ) );
		?>
		
	</main>

<?php 

get_sidebar();
get_footer();