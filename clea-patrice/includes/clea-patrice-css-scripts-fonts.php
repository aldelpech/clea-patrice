<?php
/**
 *
 * Pour charger du css, des scripts ou des polices 
 *
 *
 * @link       	http://parcours-performance.com/anne-laure-delpech/#ald
 * @since      	1.1.0
 *
 * @package    clea-patrice-add-functions
 * @subpackage clea-patrice-add-functions/includes
 */

add_action( 'wp_enqueue_scripts', 'clea_patrice_enqueue_scripts' ); 
 
if (! function_exists('clea_patrice_enqueue_scripts') ){
	function clea_patrice_enqueue_scripts() {
	
	// enqueue test.css
	
	wp_register_style(
		'Clea_patrice_style',
		CLEA_PATRICE_URL . 'css/test.css' ,
		array(),
		null,
		'all' // no media type
	);

	wp_register_style(
		'font_awesome_css',
		CLEA_PATRICE_URL . 'css/font-awesome.css',
		array(),
		null,
		'all' // no media type
	);
	
	
	wp_enqueue_style( 'Clea_patrice_style' ) ;
	// wp_enqueue_style( 'font_awesome_css' ) ;
	
	// enqueue fonts
	/* 
	wp_enqueue_style( 
		'google-nova-round', 
		'http://fonts.googleapis.com/css?family=Nova+Round'
	);
	*/
	
	// enqueue scripts
	
	
	}
}

// see http://code.tutsplus.com/tutorials/loading-css-into-wordpress-the-right-way--cms-20402
add_action( 'wp_enqueue_scripts', 'ald_enqueue_scripts' );  // to enqueue in the website front end