<?php
/**
 * Title: About
 * Slug: rivera/about
 * Categories: text, about
 * Description: Section with the bio.
 *
 * @package Rivera
 */

$profile = rivera_get_profile();
?>
<!-- wp:group {"tagName":"section","anchor":"about","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section id="about" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'About', 'rivera' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"textColor":"muted"} -->
	<p class="has-muted-color has-text-color"><?php echo esc_html( $profile['bio'] ); ?></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->
