<?php 

if( !function_exists('get_state_from_address') ) {
	function get_state_from_address($address) {
		$result = false;

		if( !isset($address) || !is_string($address)) return false;

		$address_sections = explode(',', $address);

		switch( count($address_sections) ) {
			case 3:
				$state_reference = $address_sections[1];
				break;
			case 4:
				$state_reference = $address_sections[2];
				break;
			case 5:
				$state_reference = $address_sections[3];
				break;
			default:
				return false;
		}

		$result = trim( preg_replace("/([0-9])/", '', $state_reference) );

		return strtoupper($result);
	}
}

if( !function_exists('get_country_from_address') ) {
	function get_country_from_address($address, $abbreviate = false) {
		$countries = require('countries.php');
		$result = false;

		if( !isset($address) || !is_string($address)) return false;

		$address_sections = explode(',', $address);

		switch( count($address_sections) ) {
			case 3:
				$country_reference = $address_sections[2];
				break;
			case 4:
				$country_reference = $address_sections[3];
				break;
			case 5:
				$country_reference = $address_sections[4];
				break;
			default:
				return false;
		}

		$result = trim( $country_reference );

		if( $abbreviate ) {
			$result = array_search($result, $countries);
		}

		return strtoupper($result);
	}
}

if( !function_exists('get_country_calling_code') ) {
	function get_country_calling_code($location) {
		$country_codes = require( 'country_codes.php' );

		if( !is_string($location) ) {
			$country_key = get_country_from_address( $location['address'] );
		}
		else {
			$country_key = $location;
		}
		
		return (isset($country_codes[ $country_key ]) ? $country_codes[ $country_key ] : '1');
	}
}

if( !function_exists('get_phone_chunks') ) {
	function get_phone_chunks($phone) {
		$phone = (string)$phone;
		$phone = str_replace(array('.','-','+'), '', $phone);
		$chunks = str_split($phone, 3);
		
		if( count($chunks) < 4 ) return null;

		return array(
			$chunks[0],
			$chunks[1],
			$chunks[2] . $chunks[3]
		);
	}
}

if( !function_exists('get_dashed_phone_number') ) {
	function get_dashed_phone_number($number) {
		$matches = get_phone_chunks( $number );

		if( $matches ) {
			return $matches[0] . '-' . $matches[1] . '-' . $matches[2];
		}
	}
}

if( !function_exists('get_tel_href') ) {
	function get_tel_href($location, $number) {
		return 'tel:' . get_country_calling_code($location) . '-' . get_dashed_phone_number($number);
	}
}

if( !function_exists('get_the_street_address') ) {
	function get_the_street_address($location) {
		$result = false;

		if( !isset($location) || !is_string($location) ) return false;

		$location_sections = explode(',', $location);

		$result = trim( $location_sections[0] );

		return ucwords(strtolower($result));
	}
}

if( !function_exists('get_geolocation_meta_tags') && !function_exists('the_geolocation_meta_tags') ) {
	// Meta tag generation
	function get_geolocation_meta_tags($location) {
		$result = '<meta name="geo.region" content="' . get_country_from_address($location['address'], true) . '-' . get_state_from_address($location['address']) . '" />';
		$result .= '<meta name="geo.position" content="' . $location['lat'] . ';' . $location['lng'] . '" />';
		$result .= '<meta name="ICBM" content="' . $location['lat'] . ', ' . $location['lng'] . '" />';
		return $result;
	}
	function the_geolocation_meta_tags($location) {
		echo get_geolocation_meta_tags($location);
	}
}

if( !function_exists('get_twitter_meta_tag') && !function_exists('the_twitter_meta_tag') ) {
	function get_twitter_meta_tag($twitter_id) {
		return '<meta property="twitter:account_id" content="' . $twitter_id . '" />';
	}
	function the_twitter_meta_tag($twitter_id) {
		echo get_the_twitter_meta_tag($twitter_id);
	}
}

if( !function_exists('get_twitter_handle_meta_tag') && !function_exists('the_twitter_handle_meta_tag') ) {
	function get_twitter_handle_meta_tag($twitter_handle) {
		return '<meta name="twitter:site" content="@' . str_replace('@', '', $twitter_handle) . '">';
	}
	function the_twitter_handle_meta_tag($twitter_handle) {
		echo get_twitter_handle_meta_tag($twitter_handle);
	}
}

if( !function_exists('get_facebook_meta_tag') && !function_exists('the_facebook_meta_tag') ) {
	function get_facebook_meta_tag($facebook_id) {
		return '<meta property="fb:page_id" content="' . $facebook_id . '" />';
	}
	function the_facebook_meta_tag($facebook_id) {
		echo get_the_facebook_meta_tag($facebook_id);
	}
}