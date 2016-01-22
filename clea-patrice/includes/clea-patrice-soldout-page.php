<?php
/**
 *
 * a shortcode to display sold out products
 *
 *
 * @link       	http://parcours-performance.com/anne-laure-delpech/#ald
 * @since      	1.2.0
 *
 * @package    clea-patrice-add-functions
 * @subpackage clea-patrice-add-functions/includes
 */


 
/*
* source snippet #20 Display onsale products catalog shortcode
* http://www.wpexplorer.com/best-woocommerce-snippets/
*/


function clea_patrice_sale_products( $atts ) {

    global $woocommerce_loop;

    extract(shortcode_atts(array(
        'per_page'  => '12',
        'columns'   => '4',
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

/*
	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) :

		while ( $products->have_posts() ) : $products->the_post(); 

			woocommerce_get_template( 'archive-product.php' );

		endwhile; // end of the loop.

	endif;

	wp_reset_postdata();

	return '<div class="vendus"><h4>début...</h4>' . ob_get_clean() . '<h4>...fin</h4></div>';	
*/	

/*    query_posts($args);
    ob_start();
    // woocommerce_get_template_part( 'loop', 'shop' );
    wc_get_template( 'content', 'product' );
	wp_reset_query();

    // return ob_get_clean();
	return '<div class="vendus">' . ob_get_clean() . '</div>';
*/

/*
ob_start();

    $products = new WP_Query( $args );

    $woocommerce_loop['columns'] = $columns;

    if ( $products->have_posts() ) : ?>     

        <?php woocommerce_product_loop_start(); ?>

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template( 'content', 'product' );  ?>

            <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

    <?php endif;

    wp_reset_postdata();

    return '<div class="woocommerce">' . ob_get_clean() . '</div>';

*/
}

add_shortcode('produits_vendus', 'clea_patrice_sale_products');


add_action( 'woocommerce_before_shop_loop_item_title', 'clea_patrice_soldout_badge' );

function clea_patrice_soldout_badge() {
	
    global $product;
 
    if ( !$product->is_in_stock() ) {
        echo '<span class="soldout">SOLD OUT</span>';
    }
} 


/**
 * Shortcode advert.
 * 
 * input:   [advert]
 * extended: [advert h2="…" h3="" text="…" klasse="…"]
 *
 * @return void
 */
function shortcode_advert_callback( $atts ) {
	
	// Parse forwarded parameters against defaults.
	$args = shortcode_atts( 
		array(
			'h2'     => 'A new collection has arrived in the shop.',
			'h3'     => 'Old collection items are now up to 50% reduced!',
			'text'     => 'advert text here',
			'class'     => 'my-advert',
		),
		$atts
	);
	
	// HTML output with placeholders for parameters.
	$output = sprintf( 
		'<div class="%4$s">
			<h2>%1$s</h2>
			<h3>%2$S</h3>
			<p>%3$s</p>
		</div>',
		$args[ 'h2' ],
		$args[ 'h3' ],
		$args[ 'text' ],
		$args[ 'klasse' ]
	);
	
	return $output; 
}
add_shortcode( 'advert', 'shortcode_advert_callback' );
?>