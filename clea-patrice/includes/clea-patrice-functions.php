<?php
/**
 *
 * Various functions for use in the childtheme boutique of the woocommerce StoreFront theme 
 *
 *
 * @link       	http://parcours-performance.com/anne-laure-delpech/#ald
 * @since      	1.2.0
 *
 * @package    clea-patrice-add-functions
 * @subpackage clea-patrice-add-functions/includes
 */

 
add_action( 'wp_loaded', 'clea_patrice_show_img_cat');


/***************************************************
* * show product categories for images
***************************************************/
// Requires 2 plugins : enhanced media category and Woocommerce
// http://code.tutsplus.com/articles/plugin-templating-within-wordpress--wp-31088


function clea_patrice_show_img_cat() {

	// see https://wordpress.org/support/topic/product-category-in-the-library-dashboard

	global $wp_taxonomies;

    foreach ( get_taxonomies_for_attachments( 'object' ) as $taxonomy => $params ) {

        if ( in_array( 'attachment', $params->object_type ) && in_array( 'product', $params->object_type ) ) {

            // turns on taxonomy columns
            $wp_taxonomies[$taxonomy]->show_admin_column = 1;
        }
    }
	
}	
