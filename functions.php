<?php
/**
 * hope functions and definitions
 *
 * @package hope
 */

if ( ! defined( 'HOPE_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'HOPE_VERSION', 's0kzff' );
}


if ( ! function_exists( 'HOPE_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function HOPE_setup() {
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		// add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		// remove_theme_support( 'block-templates' );

		// Add support for custom templates.
		// add_theme_support( 'custom-page-templates' );
	}
endif;
add_action( 'after_setup_theme', 'HOPE_setup' );


/**
 * Enqueue scripts and styles.
 */
function HOPE_scripts() {
	wp_enqueue_style( 'hope-style', get_stylesheet_uri(), array(), HOPE_VERSION );
	wp_enqueue_style( 'hope-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) ); // Main theme styles

	wp_enqueue_style( 'open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;800&display=swap', array(), null, 'all' ); // Google Font.
	wp_enqueue_style( 'vollkorn', 'https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,700;1,400&display=swap', array(), null, 'all' ); // Google Font.

	wp_enqueue_script( 'hope-script', get_template_directory_uri() . '/js/script.min.js', array(), HOPE_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'HOPE_scripts' );

function enqueue_child_theme_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');
