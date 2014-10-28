<?php
/*
Plugin Name: Tabs Shortcode
Plugin URI: http://wordpress.org/extend/plugins/accordion-shortcode/
Description: Adds shortcode that enables you to create accordions
Author: CTLT
Version: 1.2.1
Author URI: http://ctlt.ubc.ca
*/

/**
 * JS_TABS_SHORTCODE class.
 */
class JS_TABS_SHORTCODE {
	
	static $add_script;
	static $tab_ids;
	static $current_tabs;
	static $current;
	static $active;

	/**
	 * init function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function init() {

		add_shortcode('tabs', array(__CLASS__, 'tabs_shortcode'));

		add_action('wp_footer', array(__CLASS__, 'print_script'));

		self::$tab_ids = array();
		self::$current = 0;
	}
	
	/**
	 * tab_header_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static  function tab_header_shortcode( $tab_header ) {
		$result = '';
		$active = false;

		$tab_id = 'fa-tab-id-'.count(self::$tab_ids);

		if( isset($tab_header['attributes']) ) {
			if( isset($tab_header['attributes']['active']) && $tab_header['attributes']['active'] ) $active = true;
		}

		array_push(self::$tab_ids, $tab_id); // Add to persisting array
		array_push(self::$current_tabs, $tab_id); // Add to current tab array
		if( $active && !self::$active ) self::$active = $tab_id;

		$result .= '<dd ';
		if($active && $tab_id === self::$active) $result .= 'class="active"';
		$result .= '>';
			$result .= '<a href="#'. $tab_id .'">'. $tab_header['content'] .'</a>';
		$result .= '</dd>';

		return $result;
	}
	
	/**
	 * tab_content_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static  function tab_content_shortcode( $tab_content ) {
		$result = '';

		$tab_id = self::$tab_ids[ self::$current ];
		self::$current++;

		$result .= '<div class="content';
		if( $tab_id === self::$active ) $result .= ' active';
		$result .= '" id="'. $tab_id .'">';
			$result .='<p>'. $tab_content['content'] .'</p>';
		return $result .= '</div>';
	}

	/**
	 * eval_bool function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $item
	 * @return void
	 */
	static function eval_bool( $item ) {
		
		return ( (string) $item == 'false' || (string)$item == 'null'  || (string)$item == '0' || empty($item)   ? false : true );
	}

	static function get_shortcodes($shortcode, $content) {
		$result = array();
		$pattern = '/\[(\[?)('. $shortcode .')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/';

		preg_match_all( $pattern, $content, $matches );
		foreach( $matches[0] as $index => $match) {
			$res = array();

			// If attributes were set
			if( isset($matches[3][$index]) && strlen($matches[3][$index]) ) {
				$attrs = explode(' ', trim($matches[3][$index]));
				foreach( $attrs as $attr ) {
					$attr_parts = explode('=', $attr);

					// If attribute has a value strip quote marks, otherwise attribute = true
					$res['attributes'][$attr_parts[0]] = isset($attr_parts[1]) ? str_replace(array('"', "'"), '', $attr_parts[1]) : true;

					// If string is "true/false" convert to type boolean
					if( array_search(strtolower($res['attributes'][$attr_parts[0]]), array('true', 'false')) !== false ) {
						$res['attributes'][$attr_parts[0]] = strtolower($res['attributes'][$attr_parts[0]]) === 'true' ? true : false;
					}
				}
			}
			$res['content'] = $matches[5][$index];

			array_push($result, $res);
		}

		return $result;
	}
	
	/**
	 * tabs_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static function tabs_shortcode( $atts, $content ) {
		self::$current_tabs = array();
		self::$active = null;

		$result = '';

		self::$add_script = true;
		if( is_string($atts) ) $atts = array();

		$result .= '<dl class="tabs fa-tabs" data-interchange-class="[vertical, (small)], [!vertical, (medium)]" data-tab>';

		// Parse [tab-headers]
		$tab_header_shortcodes = self::get_shortcodes('tab-header', $content);
		foreach( $tab_header_shortcodes as $tab_header ) {
			$result .= self::tab_header_shortcode($tab_header);
		}

		$result .= '</dl>';
		$result .= '<div class="tabs-content">';
		
		// Parse [tab-content]
		$tab_content_shortcodes = self::get_shortcodes('tab-content', $content);
		foreach( $tab_content_shortcodes as $tab_content ) {
			$result .= self::tab_content_shortcode($tab_content);
		}

		return $result .= '</div>';
	}
	
	/**
	 * print_script function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function print_script() {
		if ( !self::$add_script )
			return;
		
		wp_enqueue_script( 'foundation-tab', LIB . '/foundation/js/foundation/foundation.tab.js', array( 'jquery', 'foundation' ), '1.0', TRUE );
	}
}

// lets play
JS_TABS_SHORTCODE::init();