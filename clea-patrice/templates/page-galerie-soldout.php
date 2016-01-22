<?php
/**
 * Customises the stock Storefront homepage template to include the sidebar and the boutique_before_homepage_content hook.
 *
 * Template name: Galerie (sold out)
 *
 * @package storefront
 */

get_header(); ?>

	<div class="boutique-featured-products site-main">
		<?php do_action( 'boutique_before_homepage_content' ); ?>
	</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php do_action( 'homepage' ); ?>

	<?php
	/* source 
	https://tarei.me/2014/02/03/build-custom-wp-query-loop-getting-woocommerce-stock-products/
	*/
/*
	$args = array( 'post_type' => 'product', 'posts_per_page' => 30, 'orderby' => 'date', 'order' => 'DESC', 'meta_query' => array(
	array(
	'key' => '_stock_status',
	'value' => 'outofstock',
	'compare' => '='
	)
	)
	);
	$loop = new WP_Query( $args );	
*/
	?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action( 'storefront_sidebar' ); ?>

<?php get_footer(); ?>