<?php
/**
 * Page title, meta description, canonical and social sharing tags.
 *
 * If an SEO plugin is switched on later, it takes over and the tags here
 * step aside so nothing gets printed twice.
 *
 * @package Rivera
 */

/**
 * Whether a dedicated SEO plugin is handling the head tags.
 *
 * @return bool
 */
function rivera_seo_plugin_active() {
	$active = defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' );

	return (bool) apply_filters( 'rivera_seo_plugin_active', $active );
}

/**
 * Uses her name and job title for the home page title, e.g.
 * "Dr Alex Rivera – Clinical Psychologist and Trainer".
 *
 * @param array $parts Document title parts.
 * @return array
 */
function rivera_document_title_parts( $parts ) {
	if ( ! is_front_page() || rivera_seo_plugin_active() ) {
		return $parts;
	}

	$profile = rivera_get_profile();

	$parts['title']   = $profile['name'];
	$parts['tagline'] = $profile['job_title'];
	unset( $parts['site'] );

	return $parts;
}
add_filter( 'document_title_parts', 'rivera_document_title_parts' );

/**
 * Prints the meta description, canonical link and Open Graph tags on the home page.
 */
function rivera_print_meta_tags() {
	if ( ! is_front_page() || rivera_seo_plugin_active() ) {
		return;
	}

	$profile = rivera_get_profile();
	$photo   = rivera_get_photo();
	$title   = $profile['name'] . ' – ' . $profile['job_title'];
	$url     = home_url( '/' );

	$tags = array(
		'description'    => $profile['summary'],
		'og:type'        => 'profile',
		'og:site_name'   => get_bloginfo( 'name' ),
		'og:locale'      => get_locale(),
		'og:title'       => $title,
		'og:description' => $profile['summary'],
		'og:url'         => $url,
		'og:image'       => $photo['url'],
		'og:image:alt'   => $photo['alt'],
		'twitter:card'   => 'summary',
	);

	// Core only adds a canonical link to single posts and pages.
	if ( ! is_singular() ) {
		printf( "<link rel=\"canonical\" href=\"%s\">\n", esc_url( $url ) );
	}

	foreach ( $tags as $key => $content ) {
		$attribute = str_starts_with( $key, 'og:' ) ? 'property' : 'name';

		printf(
			"<meta %s=\"%s\" content=\"%s\">\n",
			esc_attr( $attribute ),
			esc_attr( $key ),
			esc_attr( $content )
		);
	}
}
add_action( 'wp_head', 'rivera_print_meta_tags', 1 );
