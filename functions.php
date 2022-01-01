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

/**
 * アーカイブタイトルのカスタマイズ
 *
 * @param string $title 出力されるタイトル.
 */
function fse_megane_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}
	$title = $title . 'の記事一覧';
	return $title;
};
add_filter( 'get_the_archive_title', 'fse_megane_title' );

/**
 * アイキャッチの登録がなかった場合にダミー画像を表示
 *
 * @param string $html 出力されるHTML.
 * @param int    $post_id 投稿のID.
 * @param int    $post_thumbnail_id アイキャッチのID.
 */
function fse_megane_dummy_thumbnail( $html, $post_id, $post_thumbnail_id ) {
	if ( ! $post_thumbnail_id ) {
		return '<img src="' . esc_attr( get_template_directory_uri() ) . '/img/dummy.png" alt="' . esc_attr( get_the_title( $post_id ) ) . 'のダミー画像">';
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'fse_megane_dummy_thumbnail', 10, 3 );
