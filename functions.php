<?php
/**
 * developer-assignment functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package developer-assignment
 */

function developer_assignment_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * This theme does not use a hard-coded <title> tag in the document head,
	 * WordPress will provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'developer_assignment_setup' );


if ( !defined('DEVELOPER_ASSIGNMENT_VERSION') ) {
	define('DEVELOPER_ASSIGNMENT_VERSION', '1.0.0');
}

/**
 * Enqueue scripts and styles.
 */
function developer_assignment_scripts() {

	// Google Fonts
	wp_enqueue_style( 'google-font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap', false );
	wp_enqueue_style( 'google-font-roboto-condensed', 'https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap', false );

	$script_asset = include( get_template_directory()  . '/build/app.asset.php' );

	// Theme main js
	wp_enqueue_script( 'developer-assignment-script',
		get_template_directory_uri()  . '/build/app.js',
		$script_asset['dependencies'],
		$script_asset['version'], true
	);

	// Theme main CSS
	wp_enqueue_style( 'developer-assignment-style',
		get_template_directory_uri()  . '/build/main.css',
		array(),
		DEVELOPER_ASSIGNMENT_VERSION
	);


	// Feature Block CSS ( only if page/post has block )
	if ( (is_single() || is_page()) && has_block('acf/feature') ) {
		wp_enqueue_style( 'feature-block-style',
			get_template_directory_uri()  . '/build/feature-block.css',
			array(),
			null
		);
	}

}
add_action( 'wp_enqueue_scripts', 'developer_assignment_scripts' );

/**
 * Register ACF Feature block.
 */
function register_acf_feature_block() {
    register_block_type( get_template_directory() . '/blocks/feature' );
}
add_action( 'init', 'register_acf_feature_block' );


/**
 * Unique ID for each ACF block.
 */
add_filter(
    'acf/pre_save_block',
    function( $attributes ) {
        if ( empty( $attributes['id'] ) ) {
            $attributes['id'] = 'wdt-block-' . uniqid();
        }
        return $attributes;
    }
);


/**
 * Editor block custom CSS.
 */
function developer_assignment_editor_assets() {

	wp_enqueue_style( 'webdevtask-editor',
		get_template_directory_uri()  . '/build/editor.css',
		array(),
		null
	);
}
add_action( 'enqueue_block_editor_assets', 'developer_assignment_editor_assets' );
