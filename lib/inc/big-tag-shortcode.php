<?php
/*
Plugin Name: Big Tag Shortcode
Plugin URI: http://wordpress.org/extend/plugins/accordion-shortcode/
Description: Adds shortcode that enables you to create accordions
Author: CTLT
Version: 1.2.1
Author URI: http://ctlt.ubc.ca
*/

/**
 * JS_BIG_SHORTCODE class.
 */
class JS_BIG_SHORTCODE {

	/**
	 * init function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function init() {
		add_shortcode('big', array(__CLASS__, 'big_shortcode'));
	}
	
	/**
	 * big_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static function big_shortcode( $atts, $content ) {
		$result = '<big>';
		$result .= $content;
		return $result .= '</big>'; // Close big tag
	}
}

// lets play
JS_BIG_SHORTCODE::init();