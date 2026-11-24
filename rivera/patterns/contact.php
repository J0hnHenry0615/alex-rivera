<?php
/**
 * Title: Contact
 * Slug: rivera/contact
 * Categories: call-to-action
 * Description: Section with the contact email address.
 *
 * @package Rivera
 */

$profile = rivera_get_profile();
?>
<!-- wp:group {"tagName":"section","anchor":"contact","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section id="contact" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Contact', 'rivera' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
	<p class="has-text-align-center has-large-font-size"><?php esc_html_e( 'Email:', 'rivera' ); ?> <a href="<?php echo esc_url( 'mailto:' . $profile['email'] ); ?>"><?php echo esc_html( $profile['email'] ); ?></a></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->
