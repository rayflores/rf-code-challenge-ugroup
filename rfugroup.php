<?php
/**
 * Plugin Name: Ray Flores - UGroup Code Challenge
 * Description: A Code Challenge Gutenberg Block with side panel options for UGroup
 * Version: 1.2
 * Author: Ray Flores
 * Author URI:  https://rayflores.com
 *
 * @package rfugroup
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
/**
 * Enqueue block JavaScript and CSS for the editor
 */
function rfugroup_editor_scripts() {
 
    // Enqueue block editor JS
    wp_register_script(
        'rfugroup/editor-scripts',
        plugins_url( '/assets/dist/build.js', __FILE__ ),
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
        filemtime( plugin_dir_path( __FILE__ ) . '/assets/dist/build.js' ) 
    );
 
    // Enqueue block editor styles
    wp_register_style(
        'rfugroup/stylesheets',
        plugins_url( 'assets/dist/style.css', __FILE__ ),
        [ 'wp-edit-blocks' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'assets/dist/style.css' ) 
    );
	// Register block type
    register_block_type('rfugroup/block-library', array(
        'editor_script' => 'rfugroup/editor-scripts',
        'style' => 'rfugroup/stylesheets'   
    ));
 
}

// Hook the register functions into the editor
add_action( 'init', 'rfugroup_editor_scripts' );

/**
 * Enqueue view scripts
 */
function rfugroup_view_scripts() {
    if ( is_admin() ) {
        return;
    }

    wp_enqueue_script(
		'rfugroup/view-scripts',
		plugins_url( '/assets/dist/build.view.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'react', 'react-dom' )
    );
}
// Hook the enqueue functions into the editor
add_action( 'enqueue_block_assets', 'rfugroup_view_scripts' );

// Add custom category to easily see the list of blocks within editor
function ugroup_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'ugroup-blocks',
				'title' => __( 'UGroup Blocks', 'ugroup-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'ugroup_block_category', 10, 2);