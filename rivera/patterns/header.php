<?php
/**
 * Title: Header
 * Slug: rivera/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 *
 * @package Rivera
 */

$profile = rivera_get_profile();
$home    = home_url( '/' );
?>
<!-- wp:group {"className":"rivera-header","backgroundColor":"charcoal","textColor":"base","style":{"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group rivera-header has-base-color has-charcoal-background-color has-text-color has-background has-link-color" style="padding-top:0.875rem;padding-bottom:0.875rem">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:paragraph {"className":"rivera-logo","style":{"typography":{"fontWeight":"600"}},"fontSize":"medium"} -->
		<p class="rivera-logo has-medium-font-size" style="font-weight:600"><a href="<?php echo esc_url( $home ); ?>"><?php echo esc_html( $profile['name'] ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:navigation {"ariaLabel":"<?php echo esc_attr__( 'Main', 'rivera' ); ?>","overlayMenu":"never","layout":{"type":"flex","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
			<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'About', 'rivera' ); ?>","url":"<?php echo esc_url( $home . '#about' ); ?>","kind":"custom","isTopLevelLink":true} /-->
			<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'Courses', 'rivera' ); ?>","url":"<?php echo esc_url( $home . '#courses' ); ?>","kind":"custom","isTopLevelLink":true} /-->
			<!-- wp:navigation-link {"label":"<?php echo esc_attr__( 'Contact', 'rivera' ); ?>","url":"<?php echo esc_url( $home . '#contact' ); ?>","kind":"custom","isTopLevelLink":true} /-->
		<!-- /wp:navigation -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
