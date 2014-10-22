<?php
/**
 * Great place for custom navigation menus.
 */



// Register some sweet, sweet, menus.
register_nav_menus(
    array(
        'header_menu' => 'Header Menu',
        'footer_menu' => 'Footer Menu',
    )
);

if( !function_exists('jumpstart_get_topnav_lis') && !function_exists('jumpstart_get_topnav_dropdown') && !function_exists('jumpstart_the_topnav_menu') ) {
	function jumpstart_get_topnav_dropdown($children, $active_id) {
		$child_res = '';
		foreach( $children as $child ) {
			$child_res .= '<li';
			if( (integer)$child->ID === (integer)$active_id ) $child_res .= ' class="active"';
			$child_res .= '>';
				$child_res .= '<a href="'. get_permalink( $child->ID ) .'">'. $child->post_title .'</a>';
			$child_res .= '</li>';
		}

		return $child_res;
	}

	function jumpstart_get_topnav_lis($requested_menu) {
		global $post;

		$result = '';
		$items = wp_get_nav_menu_items( $requested_menu );
		$is_page = is_page();
		$current_id = $post ? (string)$post->ID : null; // Assume its a page post
		foreach( $items as $item ) {
			// If page is a child page don't render yet
			if( $is_page && $item->post_parent > 0 ) continue;

			$page_is_active = $item->object_id === $current_id;
			$page_link_tag = '<a href="'. $item->url . '">'. $item->title .'</a>';
			$page_children = get_children( 'post_type=page&orderby=post_date&order=DESC&post_parent='. $item->object_id );

			// If page has child pages
			if( count($page_children) ) {
				$page_child_is_active = false;

				foreach( $page_children as $page_child ) {
					if( $current_id === $page_child->ID ) {
						$page_child_is_active = true;
					}
				}

				$result .= '<li class="has-dropdown';
				if( $page_is_active || $page_child_is_active ) $result .= ' active';
				$result .= '">';
					$result .= $page_link_tag;
					$result .= '<ul class="dropdown">';
						$result .= jumpstart_get_topnav_dropdown( $page_children, $current_id );
					$result .= '</ul>';
			}
			else {
				$result .= '<li';
				if( $page_is_active ) $result .= ' class="active"';
				$result .= '>';
					$result .= $page_link_tag;
			}

			$result .= '</li>';
		}

		return $result;
	}

	function jumpstart_the_topnav_lis($requested_menu) {
		echo jumpstart_get_topnav_lis( $requested_menu );
	}
}


/**
 * Remove the unescessary div tag around menu.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu#Removing_the_Navigation_Container Documentation
 *
 * @param array $args
 * @return boolean
 */

function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );