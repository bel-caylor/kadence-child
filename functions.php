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
	define( 'HOPE_VERSION', '1.8.1' );
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
		add_theme_support( 'styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

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
	// wp_enqueue_style( 'hope-style', get_stylesheet_uri(), array(), HOPE_VERSION );
	// wp_enqueue_style( 'hope-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) ); // Main theme styles

	wp_enqueue_style( 'open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;800&display=swap', array(), null, 'all' ); // Google Font.
	wp_enqueue_style( 'vollkorn', 'https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,700;1,400&display=swap', array(), null, 'all' ); // Google Font.

	wp_enqueue_script( 'hope-script', get_stylesheet_directory_uri() . '/dist/main-script.js', array(), HOPE_VERSION, true );
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'HOPE_scripts' );

function my_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'editor-script', // Handle for the script.
        get_stylesheet_directory_uri() . '/dist/editor-script.js', // Path to the script file.
        array( 'wp-blocks', 'wp-element', 'wp-editor' ), // Dependencies, include other WordPress scripts that your script depends on.
        '1.0', // Version number for the script.
        true // Set to true to enqueue the script in the footer.
    );
}
add_action( 'enqueue_block_editor_assets', 'my_enqueue_block_editor_assets' );


function enqueue_child_theme_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('hope-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), HOPE_VERSION);
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');

/**
 * Add Reuseable Blocks button to admin toolbar.
 */
function be_reusable_blocks_admin_menu() {
    add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}
add_action( 'admin_menu', 'be_reusable_blocks_admin_menu' );

/**
 * Set up the ACF blocks
 */
function hope_acf_register_blocks() {
	// Check function exists.
	if ( function_exists( 'acf_register_block' ) ) {
		acf_register_block_type(
			array(
				'name'            => 'songs',
				'title'           => __( 'Worship Songs' ),
				'description'     => __( 'Create accordion of worship songs.' ),
				'render_template' => '/partials/block-song-accordion.php',
				'category'        => 'hope',
				'icon'            => array(
					'background' => '#FF7800',
					'foreground' => '#FFFFFF',
					'src'        => 'list-view',
				),
				'keywords'        => array(
					'songs',
				),
				'supports'        => array(
					'align'  => false,
					'anchor' => false,
					'mode' => 'edit',
				),
			)
		);
	}
}
add_action( 'acf/init', 'hope_acf_register_blocks' );