<?php
/**
 * Title: Page not found
 * Slug: rivera/not-found
 * Inserter: no
 *
 * @package Rivera
 */

?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Page not found', 'rivera' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The page you were looking for has moved or doesn’t exist.', 'rivera' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to the home page', 'rivera' ); ?></a>.</p>
<!-- /wp:paragraph -->
