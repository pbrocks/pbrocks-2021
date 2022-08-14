<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$current_user = wp_get_current_user();
if ( 'pbrocks' === $current_user->user_login ) {
	echo '<h3 style="color:salmon;">__FILE__: ' . __FILE__ . '</h3>';
}

$curl = curl_init();

curl_setopt_array(
	$curl,
	array(
		CURLOPT_URL            => 'https://pbinflocal.us.auth0.com/oauth/token',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING       => '',
		CURLOPT_MAXREDIRS      => 10,
		CURLOPT_TIMEOUT        => 30,
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST  => 'POST',
		CURLOPT_POSTFIELDS     => '{"client_id":"AdM0QIrdzIjpp6vaALfjzDO4oMkzhoaQ","client_secret":"TyWKfecBnAQcprwmDK0Xek9iej6XSAETo8Rb6bOyS_dlAJV4maq-gwZx94b1uGqj","audience":"https://pbinflocal.us.auth0.com/api/v2/","grant_type":"client_credentials"}',
		CURLOPT_HTTPHEADER     => array(
			'content-type: application/json',
		),
	)
);

$response = curl_exec( $curl );
$err      = curl_error( $curl );

curl_close( $curl );

if ( $err ) {
	echo 'cURL Error #:' . $err;
} else {
	echo $response;
}
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content-page' );

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // End of the loop.

get_footer();
