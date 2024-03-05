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
	define( 'HOPE_VERSION', '1.9.0' );
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

function HOPE_editor_styles() {
    $screen = get_current_screen();
    if ( method_exists( $screen, 'is_block_editor' ) && $screen->is_block_editor() ) {
        wp_enqueue_style( 'hope-editor-style', get_theme_file_uri( 'style-editor.css' ), false, '1.0', 'all' );
    }
}
add_action( 'admin_enqueue_scripts', 'HOPE_editor_styles' );



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
		// acf_register_block_type(
		// 	array(
		// 		'name'            => 'adverts',
		// 		'title'           => __( 'Advert Slider' ),
		// 		'description'     => __( 'Slider with active adverts' ),
		// 		'render_template' => '/partials/block-advert-slider.php',
		// 		'category'        => 'hope',
		// 		'icon'            => array(
		// 			'background' => '#FF7800',
		// 			'foreground' => '#FFFFFF',
		// 			'src'        => 'share',
		// 		),
		// 		'keywords'        => array(
		// 			'advert',
		// 			'slider',
		// 		),
		// 		'supports'        => array(
		// 			'align'  => false,
		// 			'anchor' => false,
		// 			'mode' => 'edit',
		// 		),
		// 		'enqueue_assets' => function () {
		// 			wp_enqueue_style('adverts-slider-style', site_url() . '/wp-content/plugins/kadence-blocks-pro/dist/style-blocks-slider.css');
		// 			wp_enqueue_script('adverts-slider-script', site_url() . '/wp-content/plugins/kadence-blocks-pro/includes/assets/js/kb-splide-slider-init.min.js', array('jquery'), '1.0', true);
		// 		},
		// 	)
		// );

		
	}
}
add_action( 'acf/init', 'hope_acf_register_blocks' );


/**
 * Register Custom Blocks
 * @link https://developer.wordpress.org/reference/functions/register_block_type/
 */
function kadence_child_register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/adverts' );
}
add_action( 'init', 'kadence_child_register_acf_blocks' );
function hope_custom_block_enqueue_assets() {
	if (has_block('acf/adverts')) {
		wp_enqueue_style('adverts-blocks-advancedbtn', site_url() . '/wp-content/plugins/kadence-blocks/dist/style-blocks-advancedbtn.css');
		wp_enqueue_style('adverts-blocks-advanced-form', site_url() . '/wp-content/plugins/kadence-blocks/dist/style-blocks-advanced-form.css');
		wp_enqueue_style('adverts-blocks-slider', site_url() . '/wp-content/plugins/kadence-blocks-pro/dist/style-blocks-slider.css');
		wp_enqueue_style('adverts-kadence-splide', site_url() . '/wp-content/plugins/kadence-blocks/includes/assets/css/kadence-splide.min.css');
		wp_enqueue_style('adverts-aos', site_url() . '/wp-content/plugins/kadence-blocks-pro/includes/assets/css/aos.min.css');
		wp_enqueue_style('adverts-blocks-modal', site_url() . '/wp-content/plugins/kadence-blocks-pro/dist/style-blocks-modal.css');
		// wp_enqueue_style('adverts-style', get_template_directory_uri() . 'blocks/adverts/style.css');
		wp_enqueue_script('adverts-kb-advanced-form-block', site_url() . '/wp-content/plugins/kadence-blocks/includes/assets/js/kb-advanced-form-block.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('adverts-splide', site_url() . '/wp-content/plugins/kadence-blocks/includes/assets/js/splide.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('adverts-kb-splide-slider-init', site_url() . '/wp-content/plugins/kadence-blocks-pro/includes/assets/js/kb-splide-slider-init.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('adverts-aos', site_url() . '/wp-content/plugins/kadence-blocks-pro/includes/assets/js/aos.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('adverts-kt-modal-init', site_url() . '/wp-content/plugins/kadence-blocks-pro/includes/assets/js/kt-modal-init.min.js', array('jquery'), '1.0', true);
	}
}
add_action('enqueue_block_assets', 'hope_custom_block_enqueue_assets');


/**
 * Set up Google Analytics
 */
function add_google_analytics_code() {
    ?>
    <!-- Google Analytics tracking code -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BD069F7CV1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-BD069F7CV1');
    </script>
    <?php
}
add_action('wp_head', 'add_google_analytics_code');

/**
 * Remove Podcasting from admin
 */
add_action( 'admin_menu', 'remove_custom_post_type' );
function remove_custom_post_type() {
    remove_menu_page( 'edit.php?post_type=podcast' );
}
add_action( 'admin_bar_menu', 'remove_custom_post_type_menu_bar', 999 );
function remove_custom_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-podcast' );
}

/**
 * Remove Posts from admin
 */
add_action( 'admin_menu', 'remove_default_post_type' );
function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );
function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
