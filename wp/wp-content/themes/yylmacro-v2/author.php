<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
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

					<h1><?php printf( __( '%s的作品：' ), get_the_author() ); ?></h1>

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