<?php
/**
 * 機能の設定
 *
 * @package FES-megane
 */

if ( ! function_exists( 'fse_megane_support' ) ) :

	/**
	 * ブロックスタイルと管理画面のスタイルの読み込み
	 */
	function fse_megane_support() {

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}
	add_action( 'after_setup_theme', 'fse_megane_support' );
endif;

/**
 * 独自スタイルの読みこみ
 */
function fse_megane_scripts() {
	// Enqueue theme stylesheet.
	wp_enqueue_style( 'fse-megane-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'fse_megane_scripts' );
