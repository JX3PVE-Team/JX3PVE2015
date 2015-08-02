<?php
/**
 * Template Name: == 帮助栏目 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="help-page" role="main">
		<div id="help-list">
		<ul>
			<li id="help-icon"><a href="<?php bloginfo('url'); ?>/help" title="HELP"> </a></li>
			<li id="help-text"><a href="<?php bloginfo('url'); ?>/help" title="Install Manual (Text Version)" >安装使用（文字版）</a></li>
			<li id="help-video"><a href="<?php bloginfo('url'); ?>/help/2" title="Install Manual (Video Version)" >安装使用（视频版）</a></li>
			<li id="help-faq"><a href="<?php bloginfo('url'); ?>/help/3" title="Frequently Asked Questions" >常见问题FAQ</a></li>
			<li id="help-cloud"><a href="<?php bloginfo('url'); ?>/help/4" title="How to use cloud yylmacro?" >云端使用方法</a></li>
		</ul>	
		</div>
        <div id="help-content" class="help-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
			<div id="clear"></div>
        </div>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>