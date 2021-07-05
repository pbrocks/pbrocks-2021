<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// add_action( 'admin_enqueue_scripts', 'enqueue_seedbed_2021_admin_style', 11 );
/**
 * [enqueue_seedbed_2021_admin_style] As a child theme, let's make sure we enqueue scripts and styles from the parent theme.
 *
 * @return [type] [description]
 */
function enqueue_seedbed_2021_admin_style() {
	wp_enqueue_style(
		'block-editor',
		get_stylesheet_directory_uri() . '/css/block-editor.css',
		array(),
		time()
	);
}

// add_action( 'wp_enqueue_scripts', 'enqueue_seedbed_2021_blog_style', 11 );
/**
 * [enqueue_seedbed_2021_blog_style] As a child theme, let's make sure we enqueue scripts and styles from the parent theme.
 *
 * @return [type] [description]
 */
function enqueue_seedbed_2021_blog_style() {
	wp_register_style( 'parent-style', esc_url( trailingslashit( get_template_directory_uri() ) . 'style.css' ) );
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'parent-style' ),
		time()
	);
}


// add_action( 'enqueue_block_assets', 'enqueue_seedbed_2021_block_styles', 11 );
/**
 * [enqueue_seedbed_2021_block_styles] Block styles for frontend and backend.
 *
 * @return [type] [description]
 */
function enqueue_seedbed_2021_block_styles() {
	wp_enqueue_style(
		'block-styles',
		get_stylesheet_directory_uri() . '/css/block-styles.css',
		array(),
		time()
	);
}


// add_action( 'admin_enqueue_scripts', 'enqueue_seedbed_2021_editor_style', 11 );
/**
 * [enqueue_seedbed_2021_editor_style] Block styles for backend only.
 *
 * @return [type] [description]
 */
function enqueue_seedbed_2021_editor_style() {
	wp_enqueue_style(
		'editor-styles',
		get_stylesheet_directory_uri() . '/css/editor-styles.css',
		array(),
		time()
	);
}

// add_action( 'init', 'seedbed_2021_load_php' );
/**
 * Tell WordPress where to find the php files
 *
 * @since 1.0
 */
function seedbed_2021_load_php() {
	if ( file_exists( __DIR__ . '/inc' ) && is_dir( __DIR__ . '/inc' ) ) {
		/**
		 * Include all php files in /inc directory.
		 */
		foreach ( glob( __DIR__ . '/inc/*.php' ) as $filename ) {
			require $filename;
		}
	}

	if ( file_exists( __DIR__ . '/page-templates' ) && is_dir( __DIR__ . '/page-templates' ) ) {
		/**
		 * Include all php files in /page-templates directory.
		 */
		foreach ( glob( __DIR__ . '/page-templates/*.php' ) as $filename ) {
			require $filename;
		}
	}
}
add_action( 'after_setup_theme', 'create_pbrocks_info_right_menu' );
/**
 * [create_pbrocks_info_right_menu]
 *
 * @return [type] [description]
 */
function create_pbrocks_info_right_menu() {
	 add_theme_support( 'yoast-seo-breadcrumbs' );

	register_nav_menus(
		array(
			'local' => esc_html__( 'Local Right', 'pbrocks-info' ),
		)
	);
	if ( ! get_theme_mod( 'background_color', false ) ) {
		set_theme_mod( 'background_color', 'ffffff' );
	}
}



// add_filter( 'gettext', 'uagb_i18n_text_change_trick', 12, 3 );
/**
 * Change comment form default field names.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function uagb_i18n_text_change_trick( $translated_text, $untranslated_text, $domain ) {
	if ( is_admin() ) {
		return $untranslated_text;
	}

	if ( ! is_multisite() ) {
		return $untranslated_text;
	}

	if ( 'ultimate-addons-for-gutenberg' !== $domain ) {
		return $untranslated_text;
	}
	switch ( $untranslated_text ) {
		case 'Read More':
			$translated_text = __( 'Read today\'s Daily Text >', 'ultimate-addons-for-gutenberg' );
			break;
	}
	return $translated_text;
}
