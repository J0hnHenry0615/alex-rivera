<?php
/**
 * Theme setup.
 *
 * @package Rivera
 */

// Site content, then the head tags and structured data built from it.
require_once get_theme_file_path( 'inc/profile.php' );
require_once get_theme_file_path( 'inc/seo.php' );
require_once get_theme_file_path( 'inc/schema.php' );

/**
 * Loads the theme stylesheet in the editor as well, so it matches the front end.
 */
function rivera_setup() {
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'rivera_setup' );

/**
 * Loads the theme stylesheet on the front end.
 */
function rivera_enqueue_styles() {
	wp_enqueue_style(
		'rivera',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'rivera_enqueue_styles' );

/**
 * Adds width and height to images that ship with the theme.
 *
 * Core only does this for images in the media library. Without them the
 * browser can't reserve space for the photo, and the layout jumps when it
 * loads.
 *
 * @param string $block_content Rendered image block.
 * @return string
 */
function rivera_add_theme_image_dimensions( $block_content ) {
	$tags = new WP_HTML_Tag_Processor( $block_content );

	if ( ! $tags->next_tag( 'img' ) || $tags->get_attribute( 'width' ) ) {
		return $block_content;
	}

	$src       = (string) $tags->get_attribute( 'src' );
	$theme_uri = get_theme_file_uri();

	if ( ! str_starts_with( $src, $theme_uri ) ) {
		return $block_content;
	}

	$file = get_theme_file_path( substr( $src, strlen( $theme_uri ) ) );
	$size = is_readable( $file ) ? wp_getimagesize( $file ) : false;

	if ( ! $size ) {
		return $block_content;
	}

	$tags->set_attribute( 'width', $size[0] );
	$tags->set_attribute( 'height', $size[1] );

	return $tags->get_updated_html();
}
add_filter( 'render_block_core/image', 'rivera_add_theme_image_dimensions' );

/**
 * Asks the browser to fetch the portrait early.
 *
 * It's the largest thing above the fold, so it decides the Largest
 * Contentful Paint. Core skips images in block templates when it adds
 * fetchpriority, so it's done here for the one image that needs it.
 *
 * @param string $block_content Rendered image block.
 * @param array  $block         Parsed block.
 * @return string
 */
function rivera_prioritise_portrait( $block_content, $block ) {
	$class_name = $block['attrs']['className'] ?? '';

	if ( ! str_contains( $class_name, 'rivera-portrait' ) ) {
		return $block_content;
	}

	$tags = new WP_HTML_Tag_Processor( $block_content );

	if ( $tags->next_tag( 'img' ) ) {
		$tags->set_attribute( 'fetchpriority', 'high' );
		$tags->set_attribute( 'decoding', 'async' );
	}

	return $tags->get_updated_html();
}
add_filter( 'render_block_core/image', 'rivera_prioritise_portrait', 10, 2 );

/**
 * Drops the front-end emoji script and styles. The site doesn't use emoji,
 * and the script is an extra inline blob plus a request to s.w.org.
 */
function rivera_disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'rivera_disable_emoji' );
