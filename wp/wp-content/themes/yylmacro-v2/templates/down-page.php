<?php
/**
 * Template Name: == 下载栏目 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="downbg">
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="download-page" role="main">
		<div id="downpage-sidebar"><div id="downpage-sidebar-content"><?php dynamic_sidebar( 'sidebar-6' ); ?></div></div>
        <div id="download-content" class="download-content">
		<ul class="down-yylmacro">
			<li id="down-cn" class="downlist"><a href="<?php the_field('yylmacro_download'); ?>" title="下载最新超级宏"> </a></li>
			<li id="down-big5" class="downlist"><a href="<?php the_field('yylmacro_downloadbig5'); ?>"> </a></li>  
			<li id="down-gxq" class="downlist"><a href="<?php the_field('client_download'); ?>" title=""> </a></li>
		</ul>
		<div id="clear"></div>		
		<ul class="down-yylmacro-info">
			<li class="downlist-info">最新版本号：<?php the_field('yylmacro_new_version'); ?></li>
			<li class="downlist-info"><?php the_field('yylmacro_big5'); ?></li>
			<li class="downlist-info"><?php the_field('client_version'); ?></li>
		</ul>
		<div id="myjx3" >
		<?php dynamic_sidebar( 'yzjx3' ); ?>
		</div>
		
		<div id="changelogs">
		
		<div id="weibo_add"><iframe width="63px" height="23px" frameborder="0" scrolling="no" src="http://widget.weibo.com/relationship/followbutton.php?width=200&amp;height=22&amp;uid=3167158510&amp;style=5&amp;btn=red&amp;dpc=1"></iframe></iframe></div>
		<h1>最新更新日志<span id="all-change-logs"><a href="http://www.yylmacro.com/bbs" title="反馈与建议" style="color:#ff0000;" target="_blank">反馈BUG</a>  | <a href="<?php bloginfo('url'); ?>/change-logs" title="" target="_blank">查看历史更新日志与历史版本&raquo;</a></span></h1> 
		<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; // end of the loop. ?>	
		</div>
		</div>
        <div id="clear"></div>
	
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>