<?php
/**
 * Template Name: == 文档单页 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="doc-page" role="main">

        <div id="doc-content" class="doc-content">
			<?php while ( have_posts() ) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<h1 class="doc-title"><?php the_title(); ?></h1>


		<div class="entry-content">
			<?php the_content(); ?>

        <div id="doc-pages">
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<span>分页阅读</span>' ), 'after' => '</div>' ) ); ?>
		</div>

		</div><!-- .entry-content -->

		
	</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
        </div>
        
        <div id="doc-sidebar" class="doc-sidebar">

		<div id="doc-meta" class="doc-meta">
		<h1>本页联合撰写人</h1>
		<?php the_field('co-author'); ?>
		<br /><span class="doc-meta-time">最后更新时间:<?php the_modified_time('Y年n月j日'); ?></span>
		</div>
        
		<div id="doc-help"><a href="http://www.yylmacro.com/bbs" title="还有不明白？来提问吧。" target="_blank"></a></div>

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