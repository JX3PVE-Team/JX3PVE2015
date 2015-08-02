<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div class="box macrotg">
	<div class="main">
		<div class="wp">
			<div class="content">

				<?php if ( have_posts() ) : ?>
					<h1><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
						else :
							_e( 'Archives', 'twentytwelve' );
						endif;
					?></h1>

	            <ul>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
	            </ul>
				<div class="macro-pages"><?php wp_pagenavi(); ?></div>

				<?php endif; ?>
			</div><!-- #content -->
		</div>
	</div>
</div>
<?php get_footer(); ?>