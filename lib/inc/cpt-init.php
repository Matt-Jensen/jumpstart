<?php
/**
 * Magically load and instantiate Custom Posts and Custom Taxonomies.
 */



/**
 * Load Custom Post and Custom Taxonomy Classes.
 *
 * The load_template() function imports certain gloabal vars; it's like require_once() on steroids.
 */
require_once( 'CPT/CustomPost.php' );
require_once( 'CPT/CustomTaxonomy.php' );



// Use namespaces to ensure no class conflicts. Create a new variable for each CPT/CT that you want to instantiate.
// WARNING!: Use of namespaces REQUIRES a server with PHP 5.3.
$custom_post = new jumpstart\CustomPost( 'jumpstart' );
$custom_taxonomy = new jumpstart\CustomTaxonomy( 'jumpstart' );


// Instantiate a Custom Post Type.
// List of menu icons: http://melchoyce.github.io/dashicons/
$custom_post->make( 
	'members', 
	'Team Member', 
	'Team Members', 
	array ( 
		'menu_icon' => 'dashicons-universal-access-alt', 
		'supports' => array('title', 'editor', 'thumbnail')
	) 
);


// Instantiate a Custom Taxonomy, that can be related to the Custom Post Type.
// $custom_taxonomy->make( 'sample-taxonomy', 'Sample Taxonomy', 'Sample Taxonomies', array( 'sample' ) );