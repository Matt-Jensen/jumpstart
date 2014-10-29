<?php
/*
Plugin Name: Row Shortcode
Plugin URI: http://wordpress.org/extend/plugins/accordion-shortcode/
Description: Adds shortcode that enables you to create accordions
Author: CTLT
Version: 1.2.1
Author URI: http://ctlt.ubc.ca
*/

/**
 * JS_ROW_SHORTCODE class.
 */
class JS_ROW_SHORTCODE {

	/**
	 * init function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function init() {
		add_shortcode('row', array(__CLASS__, 'row_shortcode'));
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

		foreach( $matches[3] as $index => $cols) {
			$res = array();
			
			$cols = str_replace(array('"', "'", '='), '', $cols);

			if( !is_numeric($cols) ) continue;

			$res['cols'] = $cols;
			$res['content'] = $matches[5][$index];

			array_push($result, $res);
		}

		return $result;
	}
	
	/**
	 * row_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static function row_shortcode( $atts, $content ) {
		$result = '<div class="row">';

		// Parse [columns] and [column] (Both are accepted)
		$columns_shortcodes = self::get_shortcodes('columns|column', $content);

		foreach( $columns_shortcodes as $column ) {
			$result .= '<div class="small-12 medium-'.$column['cols'] .' columns">';
				$result .= wpautop($column['content']);
			$result .= '</div>';
		}

		return $result .= '</div>'; // Close .row
	}
}

// lets play
JS_ROW_SHORTCODE::init();