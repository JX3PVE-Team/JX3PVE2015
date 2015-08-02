<?php
/**
 * Template Name: == 插件文档 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div id="pt" class="bm cl">
<div class="z"><a href="http://www.jx3pve.com" class="nvhm" title="首页">剑网3PVE官方站</a><em>»</em><a href="http://www.jx3pve.com/interface">插件站</a></div>
<!--分享传播-->
						<div class="bdsharebuttonbox" id="addon-share">
						<a href="#" class="bds_more" data-cmd="more"></a>
						<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
						<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
						</div>
						<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
						<span id="addon_help">
						<?php edit_post_link( __( '【编辑】' ));?>
						<a href="http://www.jx3pve.com/forum.php?mod=viewthread&tid=3308" title="如何安装与使用插件？" target="_blank">安装帮助</a> |
						<a href="http://www.jx3pve.com/interface/help3" title="如何对插件进行设置？" target="_blank">插件入口</a> |
						<a href="http://www.jx3pve.com/interface/help2" title="如何保存对插件的设置？" target="_blank">数据同步</a> |
						<a href="http://www.jx3pve.com/forum.php?mod=forumdisplay&fid=72">插件论坛</a>
</span>
<div class="clear"></div>
</div>
<div id="main" class="addonpage">
	<div id="primary">
		<div id="content" class="addon-page" role="main">

        <div id="addon-content1">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!--插件标题-->
			<h1 id="addon-title"><?php the_title(); ?></h1>

			<!--插件描述-->
			<div class="entry-content">
				<div id="interface_docments"><?php wp_nav_menu( array( 'theme_location' => 'Interface_Docments', 'menu_class' =>'nav-menu' ) ); ?></div>
				<div id="interface_docments_content"><?php the_content(); ?></div>
				<div id="clear"></div>
			</div><!-- .entry-content -->
			</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
        </div>
        <div id="clear"></div>
		</div><!-- #content -->
		
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>