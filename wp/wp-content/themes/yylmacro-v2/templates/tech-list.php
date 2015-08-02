<?php
/**
 * Template Name: == 书架索引·默认 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="tech-page" role="main">

        <div id="tech-content" class="tech-content">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div id="tech-list-title"><?php the_title(); ?></div>
			<!--内容-->
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<div id="tech-content2">
			<h2>索引</h2>
			<ul>
			  <?php wp_list_pages('title_li=&child_of='.$post->ID); ?>
			 </ul>

			</div>
    
			</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
		 </div>

				<div id="page-comment">
					<a href="http://www.yylmacro.com/bbs" title="论坛参与讨论"> </a>
				</div>

		<div id="clear"></div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>