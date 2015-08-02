<?php
/**
 * Template Name: == 教程区页 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="shelfbg">
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="study-page" role="main">

        <div id="study-content" class="study-content">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
		 </div>

		<div id="clear"></div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>