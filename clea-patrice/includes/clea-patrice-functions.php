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
add_action( 'init', 'clea_patrice_remove_storefront_header_search' );
add_action( 'storefront_header', 'clea_patrice_storefront_header_content', 40 );

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


/***************************************************
* * remove search bar

* http://www.pootlepress.com/2015/02/21-tips-tricks-and-css-tweaks-for-woothemes-storefront/
* #12 tip
***************************************************/

function clea_patrice_remove_storefront_header_search() {
	remove_action( 'storefront_header', 'storefront_product_search', 	40 );
}


/***************************************************
* add text to the header

* https://docs.woothemes.com/document/add-static-content-to-the-storefront-header/

***************************************************/

function clea_patrice_storefront_header_content() { ?>
	<div class="clea-adresse">
		<p>Vous avez une question ? </p> 
		<p><em>Contactez-moi (Patrice Poiraud) :</em></p> 
		<p> <strong>06 84 32 51 31</strong> ou <strong><?php echo antispambot('graph@bwatbase.com'); ?></strong></p> 
	</div>
	<?php
}
