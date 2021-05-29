<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$blog_id = get_current_blog_id();

$main_blog_id = get_main_site_id();

$args = array(
	's'              => esc_html( get_search_query() ),
	'posts_per_page' => 10,
);

if ( ! empty( $_GET['blogs'] ) ) {
	$args['blog_id'] = $_GET['blogs'];
}

$networkposts = network_query_posts( $args );

if ( count( $networkposts ) > 0 || have_posts() ) {
	$result_count = count( $networkposts );
	?>
	<header class="page-header alignwide">
		<h1 class="page-title">
			Search Results for : <?php echo esc_html( get_search_query() ); ?>
		</h1>
	</header>

	<?php
	foreach ( $networkposts as $networkpost ) {
		?>
		<article id="post-<?php echo $networkpost->ID; ?>">
			<header class="entry-header">
				<h2 class="entry-title default-max-width"><a href="<?php echo $networkpost->guid; ?>"><?php echo $networkpost->post_title; ?></a></h2>

				<!-- <figure class="post-thumbnail">
					<a class="post-thumbnail-inner alignwide" href="<?php // the_permalink(); ?>">
						<?php // the_post_thumbnail( 'post-thumbnail' ); ?>
					</a>
				</figure> -->
			</header>

			<div class="entry-content">
				<p><?php echo $networkpost->post_excerpt; ?></p>
			</div>

			<footer class="entry-footer default-max-width">
				<div class="post-taxonomies">
					<span class="cat-links">Written by <?php echo ucfirst( get_the_author_meta( 'display_name', $networkpost->post_author ) ); ?></span>
				</div>  
				<span class="posted-on">Published on 
					<time class="entry-date published updated"><?php echo date( 'F j, Y', strtotime( $networkpost->post_date ) ); ?></time>
				</span>
			</footer>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/content/content-none' );
}

get_footer();
