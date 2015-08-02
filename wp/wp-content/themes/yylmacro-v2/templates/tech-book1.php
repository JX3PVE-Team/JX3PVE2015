<?php
/**
 * Template Name: == 书架内容·书本i ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="bookbg2">
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="tech-page-book" role="main">

        <div id="tech-content-book1" class="tech-content-book">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
			<div class="entry-content-left">
				<div class="tech-list-title-book"><?php the_title(); ?></div>
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<div id="book-2-right" class="entry-content-right">
			<div class="tech-list-title-book2">
			<span id="view-pre"><a href="<?php the_field('tech-pre'); ?>" title="">&laquo; 上一节</a></span>
			<a href="<?php the_field('tech-list'); ?>" title="">【返回专题索引页】</a>
			<span id="view-next"><a href="<?php the_field('tech-next'); ?>" title="">下一节 &raquo;</a></span>
			</div>
			<div id="book2-content-right"><?php the_field('tech-content'); ?></div>
			</div>

			<div id="book-meta"><?php the_modified_time('Y年n月j日'); ?> - By <?php the_author(); ?></div>
    
			</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
		 </div>

		<div id="clear"></div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>