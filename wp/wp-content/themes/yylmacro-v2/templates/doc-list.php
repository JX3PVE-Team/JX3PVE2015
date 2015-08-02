<?php
/**
 * Template Name: == 文档索引 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="doc-page" role="main">

        <div id="doc-content" class="doc-content">
			<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
        </div>

		<div id="doc-sidebar" class="doc-sidebar">
		<div class="main_nav">
        <div id="doc-nav" class="doc-nav">
           <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </div>
		</div>
		</div>

			<div id="clear"></div>
        

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>