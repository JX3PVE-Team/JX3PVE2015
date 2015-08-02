<?php
/**
 * Template Name: == 其他页面 ==
 * @www.shadowsky.cn
 */

get_header(); ?>
<div id="otherpages">
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>     

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>