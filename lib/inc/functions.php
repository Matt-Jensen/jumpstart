<?php
/**
 * Write any custom, theme specific functionality; a blank canvas ...
 */



if( !function_exists('get_post_children') ) {
	function get_post_children($post_id) {
		return get_children( 'post_type=page&orderby=post_date&order=DESC&post_parent='. $post_id );
	}
}

if( !function_exists('sort_array_objects_by_id') ) {
	function sort_array_objects_by_id($arr_objs, $order) {
		$result = array();
		$keys = array_keys($order);
		$fin_order = array();

		// Organize keys from least to greatest
		sort($keys, SORT_NUMERIC);

		// Sort all $arr_objs according to $order: [$position] => $id
		foreach( $keys as $position ) {
			$associated_id = $order[$position];

			foreach( $arr_objs as $obj ) {
				if( $obj->ID === $associated_id ) $associated_obj = $obj;
			}
			
			array_push($result, $associated_obj);
		}

		// If all all objects in the array have been sorted
		if( count($result) === count($arr_objs) ) return $result;

		// Push the remaining $arr_objs (not specified in $order) to the end of $results
		foreach( $arr_objs as $obj ) {
			if( array_search( $obj->ID, $order ) === false ) array_push($result, $obj);
		}
		
		return $result;
	}
}

if( !function_exists('get_nav_menu_item_children') ) {
	function get_nav_menu_item_children($menu_items, $menu_item_id) {
		$children = array();

		foreach( $menu_items as $menu_item ) {
			
			if( !isset($menu_item->menu_item_parent) ) continue;
			if( $menu_item->menu_item_parent == $menu_item_id ) array_push($children, $menu_item);
		}

		return $children;
	}
}


add_filter('page_template', 'force_tab_children');

// Force children of tabbed-child-sections template page's to use 'template-tabbed-child-sections.php'
function force_tab_children($template) {
	global $post;
	$template_url = explode('/', $template);
	$is_child = count(get_post_children($post->ID)) === 0;

	if( !$is_child ) return $template;
	if( $template_url[ count($template_url) - 1 ] === 'template-tabbed-child-sections.php' ) return $template;

	$parent_post = get_post_ancestors($post);
	$parent_post = count($parent_post) ? get_post( $parent_post[0] ) : false;

    // If template-tabbed-child-sections.php is the set template and is the template child
    if( $parent_post && get_page_template_slug($parent_post->ID) === 'template-tabbed-child-sections.php' ) {
    	
    	// Force the child post to use the tabbed-child-sections.php template
    	$template_url[ count($template_url) - 1 ] = 'template-tabbed-child-sections.php';

    	// Updating the database. Keeps ACF logic consistent to have children use same template as parent.
    	update_post_meta($post->ID, '_wp_page_template', 'template-tabbed-child-sections.php');
    }

    return implode('/', $template_url);
}