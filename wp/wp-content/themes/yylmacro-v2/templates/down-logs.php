<?php
/**
 * Template Name: == 历史版本 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="logs-page">
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="download-page" role="main">

        <div id="download-content" class="download-content">
		<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; // end of the loop. ?>	
		</div>
        <div id="clear"></div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>