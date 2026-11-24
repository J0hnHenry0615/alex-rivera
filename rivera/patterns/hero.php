<?php
/**
 * Title: Hero
 * Slug: rivera/hero
 * Categories: banner
 * Description: Name, job title and portrait photo.
 *
 * @package Rivera
 */

$profile = rivera_get_profile();
$photo   = rivera_get_photo();
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"align":"wide","className":"rivera-hero-card","gradient":"soft","style":{"border":{"radius":"6px"},"shadow":"var:preset|shadow|card","spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide rivera-hero-card has-soft-gradient-background has-background" style="border-radius:6px;box-shadow:var(--wp--preset--shadow--card);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
		<!-- wp:columns {"verticalAlignment":"center","isStackedOnMobile":true,"style":{"spacing":{"blockGap":{"left":"0","top":"0"}}}} -->
		<div class="wp-block-columns are-vertically-aligned-center">
			<!-- wp:column {"verticalAlignment":"center","width":"58%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);flex-basis:58%">
				<!-- wp:heading {"level":1} -->
				<h1 class="wp-block-heading"><?php echo esc_html( $profile['name'] ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"textColor":"muted","fontSize":"large"} -->
				<p class="has-muted-color has-text-color has-large-font-size"><?php echo esc_html( $profile['job_title'] ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
				<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#courses"><?php esc_html_e( 'View courses', 'rivera' ); ?></a></div>
					<!-- /wp:button -->

					<!-- wp:button {"className":"is-style-outline"} -->
					<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Get in touch', 'rivera' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"42%"} -->
			<div class="wp-block-column" style="flex-basis:42%">
				<!-- wp:image {"aspectRatio":"4/5","scale":"cover","className":"rivera-portrait"} -->
				<figure class="wp-block-image rivera-portrait"><img src="<?php echo esc_url( $photo['url'] ); ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>" style="aspect-ratio:4/5;object-fit:cover"/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
