<?php
/**
 * Title: Footer
 * Slug: rivera/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package Rivera
 */

$profile = rivera_get_profile();
?>
<!-- wp:group {"backgroundColor":"charcoal","textColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-base-color has-charcoal-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:paragraph {"className":"rivera-logo","style":{"typography":{"fontWeight":"600"}},"fontSize":"medium"} -->
		<p class="rivera-logo has-medium-font-size" style="font-weight:600"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $profile['name'] ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"fontSize":"x-small"} -->
		<p class="has-x-small-font-size">&copy; <?php echo esc_html( wp_date( 'Y' ) . ' ' . $profile['name'] ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
