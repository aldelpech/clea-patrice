<?php
/**
 * Single Post Template: post test template
 * Description: 
 *
 * @link       	http://parcours-performance.com/anne-laure-delpech/#ald
 * @since      	1.1.1
 *
 * @package    ald-functions
 * @subpackage ald-functions/includes
 */ 

get_header(); ?>

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">
		<?php 
		$texte1 = '<a href = "">' . __( 'ici', 'ald-functions-knowledge' ) . '</a>' ;
		printf( __( 'Ceci est un test pour le plugin décrit %s', 'ald-functions-knowledge' ), $texte1 ); 
		?>
		<hr />
		<a href='#' class='button'><?php _ex( 'port', 'sur un ordinateur', 'ald-functions-knowledge' ); ?></a>
		<hr />
		<a href='#' class='button'><?php _e( 'bouton 2', 'ald-functions-knowledge' ) ; ?></a>
		<hr />
		<?php echo "<a href='#' class='button'>" . __( 'Bouton 3', 'ald-functions-knowledge' ) . "</a>" ;
		<hr />
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
