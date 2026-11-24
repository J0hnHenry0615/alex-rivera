<?php
/**
 * Site content.
 *
 * The page sections and the structured data both read from here, so the
 * JSON-LD can't drift away from what's actually on the page.
 *
 * @package Rivera
 */

/**
 * Returns Dr Rivera's profile and courses.
 *
 * Course durations are ISO 8601 so they can go straight into the JSON-LD.
 *
 * @return array
 */
function rivera_get_profile() {
	$profile = array(
		'name'        => 'Dr Alex Rivera',
		'given_name'  => 'Alex',
		'family_name' => 'Rivera',
		'prefix'      => 'Dr',
		'job_title'   => 'Clinical Psychologist and Trainer',
		'email'       => 'hello@example.com',
		'locality'    => 'Sydney',
		'region'      => 'NSW',
		'country'     => 'AU',
		'bio'         => 'Dr Alex Rivera is a clinical psychologist based in Sydney, Australia. For the past 12 years she has trained psychologists, counsellors and social workers in Acceptance and Commitment Therapy, a practical approach that helps people handle difficult thoughts and feelings and act on what matters to them.',
		'summary'     => 'Dr Alex Rivera is a clinical psychologist in Sydney who trains psychologists, counsellors and social workers in Acceptance and Commitment Therapy.',
		'topic'       => 'Acceptance and Commitment Therapy',
		'expertise'   => array( 'Acceptance and Commitment Therapy', 'Clinical psychology' ),
		'photo'       => array(
			'file' => 'assets/images/alex-rivera.jpg',
			'alt'  => 'Dr Alex Rivera smiling, in a white coat with a stethoscope, holding a tablet',
		),
		'courses'     => array(
			array(
				'slug'        => 'introduction-to-act',
				'name'        => 'Introduction to Acceptance and Commitment Therapy',
				'description' => 'The core ideas and skills, for practitioners new to the approach.',
				'length'      => '6 hours, online',
				'workload'    => 'PT6H',
				'url'         => '#',
			),
			array(
				'slug'        => 'act-for-anxiety',
				'name'        => 'Acceptance and Commitment Therapy for Anxiety',
				'description' => 'How to apply the approach with clients experiencing anxiety.',
				'length'      => '4 hours, online',
				'workload'    => 'PT4H',
				'url'         => '#',
			),
			array(
				'slug'        => 'act-supervision',
				'name'        => 'Acceptance and Commitment Therapy Supervision',
				'description' => 'Monthly group sessions to discuss cases and build confidence.',
				'length'      => '1.5 hours a month, online',
				'workload'    => 'PT1H30M',
				'repeats'     => 'P1M',
				'url'         => '#',
			),
		),
	);

	/**
	 * Filters the profile, e.g. to swap the placeholder course links for real ones.
	 *
	 * @param array $profile Profile data.
	 */
	return apply_filters( 'rivera_profile', $profile );
}

/**
 * Returns the portrait photo's URL, size and alt text.
 *
 * @return array
 */
function rivera_get_photo() {
	$profile = rivera_get_profile();
	$file    = $profile['photo']['file'];
	$size    = wp_getimagesize( get_theme_file_path( $file ) );

	return array(
		'url'    => get_theme_file_uri( $file ),
		'width'  => $size ? $size[0] : null,
		'height' => $size ? $size[1] : null,
		'alt'    => $profile['photo']['alt'],
	);
}

/**
 * Returns a course link, or an empty string while it's still a placeholder.
 *
 * @param array $course A course from rivera_get_profile().
 * @return string
 */
function rivera_get_course_url( $course ) {
	if ( empty( $course['url'] ) || '#' === $course['url'] ) {
		return '';
	}

	return $course['url'];
}
