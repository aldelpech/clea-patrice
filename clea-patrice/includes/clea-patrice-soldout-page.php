<?php
/**
 *
 * 
 *
 *
 * @link       	http://parcours-performance.com/anne-laure-delpech/#ald
 * @since      	1.2.0
 *
 * @package    clea-patrice-add-functions
 * @subpackage clea-patrice-add-functions/includes
 */

 
add_action( 'woocommerce_product_query', 'so_20990199_product_query' );

function so_20990199_product_query( $q ){

    $product_ids_on_sale = clea_patrice_get_in_stock_product_ids();

    $meta_query = WC()->query->get_meta_query();

    $q->set( 'post__in', array_merge( array( 0 ), $product_ids_on_sale ) );

} 
 
function clea_patrice_get_in_stock_product_ids() {

/*
	// Load from cache
	$featured_product_ids = get_transient( 'wc_featured_products' );

	// Valid cache found
	if ( false !== $featured_product_ids )
		return $featured_product_ids;
*/
	$in_stock = get_posts( array(
		'post_type'      => array( 'product', 'product_variation' ),
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'meta_query'     => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			),
 			array(
				'key' => '_stock_status',
				'value' => 'instock',
				'compare' => '='
			)
		),
		'fields' => 'id=>parent'
	) );

	$product_ids          = array_keys( $in_stock );
	$parent_ids           = array_values( array_filter( $in_stock ) );
	$in_stock_product_ids = array_unique( array_merge( $product_ids, $parent_ids ) );

	// set_transient( 'wc_featured_products', $featured_product_ids, DAY_IN_SECONDS * 30 );

	return $in_stock_product_ids;
} 
 
/* 
*
* Do not display sold out product in shop
*
* source http://www.remicorson.com/modifying-the-current-query-with-pre_get_posts/
*/


	// add_action( 'pre_get_posts', 'clea_patrice_no_sold_out_in_shop' );
	// add_action( 'woocommerce_product_query', 'clea_patrice_no_sold_out_in_shop' );





function clea_patrice_no_sold_out_in_shop( $query ) {
 
// see https://docs.woothemes.com/document/exclude-a-category-from-the-shop-page/

	if ( ! $query->is_main_query() ) {
		return ;
	}

	if ( $query->is_page() && 'page' == get_option( 'show_on_front' ) && $query->get('page_id') == woocommerce_get_page_id('shop') ) {
 
		$query->set('meta_key', '_stock_status');
		$query->set('meta_value', 'instock');
 
	} else {
		echo "this is not it !!!!!" ;
	}
 
}
 

/*
* a shortcode to display sold out products
* 
* source snippet #20 Display onsale products catalog shortcode
* http://www.wpexplorer.com/best-woocommerce-snippets/
*/


function clea_patrice_sold_out_shortcode( $atts ) {

	// allow sold out products in the query...
	remove_action( 'pre_get_posts', 'clea_patrice_no_sold_out_in_shop' );

    global $woocommerce_loop;

    extract(shortcode_atts(array(
        'per_page'  => '12',
        'columns'   => '3',
        'orderby' => 'date',
        'order' => 'desc'
    ), $atts));

    $woocommerce_loop['columns'] = $columns;

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page' => $per_page,
        'orderby' => $orderby,
        'order' => $order,
        'meta_query' => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			),
			array(
				'key' => '_stock_status',
				'value' => 'outofstock',
				'compare' => '='
			)
        )
    );
	
	// Buffer our contents
	ob_start();
		do_action( 'woocommerce_before_shop_loop' );
		$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
			} else {
				echo __( 'No products found' );
			}
		wp_reset_postdata();
		do_action( 'woocommerce_after_shop_loop' );
	// Return buffered contents
    return '<ul class="products">' . ob_get_clean() . '</ul>';
}

add_shortcode('produits_vendus', 'clea_patrice_sold_out_shortcode');


add_action( 'woocommerce_before_shop_loop_item_title', 'clea_patrice_soldout_badge' );

function clea_patrice_soldout_badge() {
	
    global $product;
 
    if ( !$product->is_in_stock() ) {
        echo '<span class="soldout">VENDU</span>';
    }
} 

add_filter('woocommerce_stock_html', 'change_stock_message', 10, 2);
function change_stock_message($message, $stock_status) {
    if ($stock_status == "Produit épuisé") {
        $message = '<p class="stock out-of-stock">Vendu</p>';    
    } else {
        $message = '<p class="stock in-stock">Disponible</p>';           
    }
    return $message;
}
