<?php
/**
 * JSON-LD structured data for the home page.
 *
 * Builds one @graph: the website, the profile page, Dr Rivera as a Person,
 * and each of her courses as a Course with her as the provider.
 *
 * @package Rivera
 */

/**
 * Builds the structured data graph.
 *
 * @return array
 */
function rivera_get_schema() {
	$profile  = rivera_get_profile();
	$photo    = rivera_get_photo();
	$home     = home_url( '/' );
	$language = get_bloginfo( 'language' );

	$person_id  = $home . '#person';
	$website_id = $home . '#website';

	$graph = array(
		array(
			'@type'      => 'WebSite',
			'@id'        => $website_id,
			'url'        => $home,
			'name'       => get_bloginfo( 'name' ),
			'inLanguage' => $language,
			'publisher'  => array( '@id' => $person_id ),
		),
		array(
			'@type'              => 'ProfilePage',
			'@id'                => $home . '#webpage',
			'url'                => $home,
			'name'               => $profile['name'] . ' – ' . $profile['job_title'],
			'description'        => $profile['summary'],
			'inLanguage'         => $language,
			'isPartOf'           => array( '@id' => $website_id ),
			'mainEntity'         => array( '@id' => $person_id ),
			'primaryImageOfPage' => array( '@id' => $home . '#photo' ),
		),
		array(
			'@type'           => 'Person',
			'@id'             => $person_id,
			'name'            => $profile['given_name'] . ' ' . $profile['family_name'],
			'honorificPrefix' => $profile['prefix'],
			'givenName'       => $profile['given_name'],
			'familyName'      => $profile['family_name'],
			'jobTitle'        => $profile['job_title'],
			'description'     => $profile['bio'],
			'email'           => 'mailto:' . $profile['email'],
			'url'             => $home,
			'image'           => array(
				'@type'      => 'ImageObject',
				'@id'        => $home . '#photo',
				'url'        => $photo['url'],
				'contentUrl' => $photo['url'],
				'width'      => $photo['width'],
				'height'     => $photo['height'],
				'caption'    => $photo['alt'],
			),
			'address'         => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => $profile['locality'],
				'addressRegion'   => $profile['region'],
				'addressCountry'  => $profile['country'],
			),
			'knowsAbout'      => $profile['expertise'],
		),
	);

	foreach ( $profile['courses'] as $course ) {
		$graph[] = rivera_get_course_schema( $course, $person_id, $profile['topic'] );
	}

	return array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
}

/**
 * Builds the Course node for a single course.
 *
 * @param array  $course    A course from rivera_get_profile().
 * @param string $person_id The @id of the Person node.
 * @param string $topic     What the course is about.
 * @return array
 */
function rivera_get_course_schema( $course, $person_id, $topic ) {
	$instance = array(
		'@type'      => 'CourseInstance',
		'courseMode' => 'Online',
		'instructor' => array( '@id' => $person_id ),
	);

	if ( empty( $course['repeats'] ) ) {
		$instance['courseWorkload'] = $course['workload'];
	} else {
		$instance['courseSchedule'] = array(
			'@type'           => 'Schedule',
			'duration'        => $course['workload'],
			'repeatFrequency' => $course['repeats'],
		);
	}

	$node = array(
		'@type'             => 'Course',
		'@id'               => home_url( '/#course-' . $course['slug'] ),
		'name'              => $course['name'],
		'description'       => $course['description'],
		'about'             => $topic,
		'inLanguage'        => get_bloginfo( 'language' ),
		'provider'          => array( '@id' => $person_id ),
		'hasCourseInstance' => $instance,
	);

	// Leave the URL out until the course has a real page to point at.
	$url = rivera_get_course_url( $course );
	if ( $url ) {
		$node['url'] = $url;
	}

	return $node;
}

/**
 * Prints the JSON-LD script tag on the home page.
 */
function rivera_print_schema() {
	if ( ! is_front_page() ) {
		return;
	}

	wp_print_inline_script_tag(
		wp_json_encode( rivera_get_schema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ),
		array( 'type' => 'application/ld+json' )
	);
}
add_action( 'wp_head', 'rivera_print_schema' );
