<?php
/**
 * Template Name: == 书架索引·书本i ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="bookbg">
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

			<div class="entry-content-right">
			<div class="tech-list-title-book2">目录</div>
			<ul>
			  <?php wp_list_pages('title_li=&child_of='.$post->ID); ?>
			 </ul>
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