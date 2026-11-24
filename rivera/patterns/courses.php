<?php
/**
 * Title: Courses
 * Slug: rivera/courses
 * Categories: featured
 * Description: Section listing each course with its length and a link.
 *
 * @package Rivera
 */

$profile = rivera_get_profile();
?>
<!-- wp:group {"tagName":"section","anchor":"courses","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section id="courses" class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center","align":"wide"} -->
	<h2 class="wp-block-heading alignwide has-text-align-center"><?php esc_html_e( 'Courses', 'rivera' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"17rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--40)">
		<?php foreach ( $profile['courses'] as $course ) : ?>
		<!-- wp:group {"tagName":"article","anchor":"course-<?php echo esc_attr( $course['slug'] ); ?>","className":"rivera-course","backgroundColor":"base","style":{"border":{"color":"var:preset|color|line","width":"1px","radius":"6px"},"shadow":"var:preset|shadow|card","spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
		<article id="course-<?php echo esc_attr( $course['slug'] ); ?>" class="wp-block-group rivera-course has-border-color has-base-background-color has-background" style="border-color:var(--wp--preset--color--line);border-width:1px;border-radius:6px;box-shadow:var(--wp--preset--shadow--card);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $course['name'] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"rivera-length","textColor":"muted","fontSize":"x-small"} -->
			<p class="rivera-length has-muted-color has-text-color has-x-small-font-size"><span class="screen-reader-text"><?php esc_html_e( 'Length:', 'rivera' ); ?> </span><?php echo esc_html( $course['length'] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php echo esc_html( $course['description'] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"rivera-more","fontSize":"x-small"} -->
			<p class="rivera-more has-x-small-font-size"><a href="<?php echo esc_url( $course['url'] ); ?>"><?php esc_html_e( 'Find out more', 'rivera' ); ?><span class="screen-reader-text"> <?php echo esc_html( sprintf( /* translators: %s: course name. */ __( 'about %s', 'rivera' ), $course['name'] ) ); ?></span></a></p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
