<?php
/**
 * Template Name: == 书架内容·默认 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="tech-page" role="main">

        <div id="tech-content" class="tech-content">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!--内容-->
			<div class="entry-content">
				<?php the_content(); ?>

				<div id="doc-pages">
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<span>分页阅读</span>' ), 'after' => '</div>' ) ); ?>
				</div>
			</div><!-- .entry-content -->

			<!--阅读关联-->
			<div id="tech-view">
			<span id="view-pre"><a href="<?php the_field('tech-pre'); ?>" title="">&laquo; 上一节</a></span>
			《<?php the_title(); ?>》 - 作者:<?php the_author(); ?>
			<span id="view-next"><a href="<?php the_field('tech-next'); ?>" title="">下一节 &raquo;</a></span>
			</div>

			<div id="tech-content2">
			<div id="tech-bak"><a href="<?php the_field('tech-list'); ?>" title="">【返回专题索引页】</a></div>
			<?php the_field('tech-content'); ?>
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