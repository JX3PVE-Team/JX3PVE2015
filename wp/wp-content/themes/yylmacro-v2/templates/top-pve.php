<?php
/**
 * Template Name: == 五甲风云榜 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="addon-page" role="main">

        <div id="addon-content" class="addon-content">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!--插件标题-->
			<h1 id="addon-title"><?php the_title(); ?>

					<span id="addon_help">
						<a href="http://www.yylmacro.com/interface/help1" title="" target="_blank">安装帮助</a> |
						<a href="http://www.yylmacro.com/interface/help2" title="" target="_blank">数据同步</a> |
						<a href="http://www.jx3pve.com" title="" target="_blank">论坛求助</a> 
					</span>

					<!--分享传播-->
					<span id="bdshare" class="bdshare_b addon_share">
					<img src="http://bdimg.share.baidu.com/static/images/type-button-1.jpg?cdnversion=20120831" />
					</span>
					<script type="text/javascript" id="bdshare_js" data="type=button&amp;uid=6882670" ></script>
					<script type="text/javascript" id="bdshell_js"></script>
					<script type="text/javascript">document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);</script>
					</div>	
			</h1>

			<!--插件图标-->	
			<div id="addon-icon"><img src="<?php the_field('addon_icon'); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" width="1125px" height="200px" /></div>

			<!--插件标签-->
			<div id="addon-meta">
				<span id="cloudid-box"><span id="yylmacro-meta-cloudid" class="yylmacro-meta">下载次数：</span><span id="cloudid"><?php the_views($display = true, $prefix = '', $postfix = '', $always = false) ?></span></span>
				<span class="yylmacro-meta">更新日期</span> <?php the_modified_time('Ymd'); ?>
				<span class="yylmacro-meta">插件作者</span> <?php the_field('addon_author'); ?>
				<span class="yylmacro-meta">插件版本</span> <?php the_field('addon_version'); ?>
				<span class="yylmacro-meta">官方主页</span> <a href="<?php the_field('addon_authorlink'); ?>"  target="_blank">点击访问</a>
				<div id="addon-down"><a href="<?php the_field('addon_down'); ?>" title="" target="_blank"></a></div>
			</div>

			<!--插件描述-->
			<div class="entry-content">
				<div id="addon-content2">
				<?php the_content(); ?>
				</div>

				<!--历史版本-->
				<div id="addon-list">
					<?php dynamic_sidebar( 'sidebar-5' ); ?>

					<h1>历史版本 &raquo;</h1>
					<?php the_field('addon_list'); ?>
				</div>

				<div id="clear"></div>

				<div id="page-comment">
				<script type="text/javascript" id="wumiiComments">
					var wumiiPermaLink = "<?php  $current_url = home_url(add_query_arg(array())); 
				echo $current_url; ?>"; //请用代码生成文章永久的链接
					var wumiiTitle = ""; //请用代码生成文章标题
					var wumiiSitePrefix = "http://www.yylmacro.com/"; //安装无觅评论插件的网站的域名，如果是放在子域名上，请提供子域名，如"http://blog.wumii.com"。如果这里填写的域名不对，请自行改正。
					var wumiiCommentParams = "&pf=JAVASCRIPT";
				</script>
				<script type="text/javascript" src="http://widget.wumii.cn/ext/cw/widget"></script>
				</div>

			</div><!-- .entry-content -->
			</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
        </div>
        
		</div><!-- #content -->
		
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>