<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div id="main" class="yz-main">
	<section id="primary" class="site-content">
		<div id="content" class="macro-list" role="main">

		<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'About : %s'), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <ul>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><li><?php the_title(); ?></li></a>
			<?php endwhile; ?>
            </ul>
			<div id="macro-list-page"><?php wp_pagenavi(); ?></div>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->
</div>
<?php get_footer(); ?>