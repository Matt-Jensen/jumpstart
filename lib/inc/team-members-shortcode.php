<?php
/*
Plugin Name: Team Members Shortcode
Plugin URI: http://wordpress.org/extend/plugins/accordion-shortcode/
Description: Adds shortcode that enables you to create accordions
Author: CTLT
Version: 1.2.1
Author URI: http://ctlt.ubc.ca
*/

/**
 * TEAM_MEMBERS_SHORTCODE class.
 */
class TEAM_MEMBERS_SHORTCODE {

	/**
	 * init function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function init() {
		add_shortcode('team-members', array(__CLASS__, 'team_member_shortcode'));
	}
	
	/**
	 * team_member_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static function team_member_shortcode( $atts, $content ) {
		$result = '<ul class="fa-media-list">';

		// Get all team member custom post type, posts
		$team_members = get_posts(array('post_type' => 'members', 'order' => 'ASC'));

		foreach( $team_members as $member ) {
			$featured_image = get_the_post_thumbnail($member->ID, array(188, 153));
			$result .= '<li data-toggle-show-hide-container>';
				$result .= '<h2>'. $member->post_title .'</h2>';
				
				if( $featured_image ) {
					$result .= '<div class="fa-media-list__avatar">';
						$result .= $featured_image;
					$result .= '</div>';
				}
				$result .= '<div class="fa-media-list__content">';
					
					$post_content = do_shortcode($member->post_content);
					
					if( strlen($post_content) > 450 ) {
						$result .= '<div data-show-hide-target><p>';
							$result .= truncate_HTML( $post_content, 450 );
						$result .= '</p></div>';
						$result .= '<div class="hide" data-show-hide-target>'. wpautop( $post_content ) .'</div>';
						$result .= '<button class="button tiny alert -nmb" data-toggle-show-hide>Read More</button>';
					}
					else {
						$result .= wpautop( $post_content );
					}

				$result .= '</div>';

			$result .= '</li>';
		}

		return $result .= '</ul>'; // Close .row
	}
}

// lets play
TEAM_MEMBERS_SHORTCODE::init();