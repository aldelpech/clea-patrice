<?php
/**
 *
 * Le fichier principal du plugin. 
 * 
 * Ce fichier est lu par WordPress pour générer les informations sur l'extension dans le tableau de bord. 
 * Ce fichier sert également à inclure toutes les "dépendances" utilisées par l'extension, enregistrer
 * les fonctions d'activation, désactivation et démarrer le plugin. 
 * 
 * @link			http://parcours-performance.com/anne-laure-delpech/#ald
 * @since 			0.1.0
 * @package			ald-functions
 *
 * @wordpress-plugin
 * Plugin Name: 	ALD fonctions pour Patrice WooCommerce
 * Plugin URI: 		http://knowledge.parcours-performance.com/creer-plugin-wordpress-de-fonctionnalites-utiles/
 * Description: 	pour modifier le thème enfant boutique du thème storefront	
 * Version: 		0.3.0
 * Author: 			Anne-Laure Delpech
 * Author URI: 		http://parcours-performance.com/anne-laure-delpech/#ald
 * License: 		GPL2.0+
 * Text Domain: 	clea-patrice-add-functions
 * Domain Path:		/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/*----------------------------------------------------------------------------*
 * Path to files
 *----------------------------------------------------------------------------*/
	/* 	ALD_KNOWLEDGE_DIR .'images/image.png' will go to the right img directory 
	while ALD_KNOWLEDGE_URL . 'css/test.css' will render the right url */
	define('CLEA_PATRICE_DIR', plugin_dir_path(__FILE__));
	define('CLEA_PATRICE_URL', plugin_dir_url(__FILE__));


/******************************************************************************
* Actions à réaliser à l'initialisation et l'activation du plugin
* see http://codex.wordpress.org/Function_Reference/register_post_type juste avant NOTES
******************************************************************************/
		
	function clea_patrice_activation() {
		// register the custom post types and taxonomies
		
		// reflush (in order to create the new permalink system)
		// see http://code.tutsplus.com/articles/the-rewrite-api-post-types-taxonomies--wp-25488
		// flush_rewrite_rules();
	}

	register_activation_hook(__FILE__, 'clea_patrice_activation'); // plugin's activation 


/********************************************************************************
* appeler d'autres fichiers php et les exécuter
********************************************************************************/	

	require_once plugin_dir_path( __FILE__ ) . 'includes/clea-patrice-css-scripts-fonts.php'; 
	// require_once plugin_dir_path( __FILE__ ) . 'includes/clea-patrice-load-templates.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/clea-patrice-functions.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/clea-patrice-header-logo.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/clea-patrice-soldout-page.php';


/*----------------------------------------------------------------------------*
 * deactivation and uninstall
 *----------------------------------------------------------------------------*/
	/* upon deactivation, wordpress also needs to rewrite the rules */
	register_deactivation_hook(__FILE__, 'clea_patrice_deactivation');

	function clea_patrice_deactivation() {
		// flush_rewrite_rules(); // pour remettre à 0 les permaliens
	}
	
	// register uninstaller
	register_uninstall_hook(__FILE__, 'clea_patrice_uninstall');
	
	function clea_patrice_uninstall() {    
		// actions to perform once on plugin uninstall go here
		// remove all options and custom tables
	}