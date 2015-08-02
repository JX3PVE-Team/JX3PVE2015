<?php
/**
 * Template Name: == 插件导航 ==
 * @www.shadowsky.cn
 */
get_header(); ?>
<div class="box">
	<div class="addon-alone main">
		<div class="wp">
			<div class="content">
				<div class="addon-nav">
					<div class="z">
						<a href="http://www.jx3pve.com" title="首页">剑网3PVE官方站</a><em>»</em>
						<a href="http://www.jx3pve.com/interface">插件站</a>
					</div>
					<!--分享传播-->
					<div class="addon-share">
						<a href="#" class="bds_more" data-cmd="more"></a>
						<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
						<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
					</div>
					<div>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</div>
					<span class="addon_help">
						<?php edit_post_link( __( '【编辑】' ));?>
						<a href="http://www.jx3pve.com/forum.php?mod=viewthread&tid=3308" title="如何安装与使用插件？" target="_blank">安装帮助</a> |
						<a href="http://www.jx3pve.com/interface/help3" title="如何对插件进行设置？" target="_blank">插件入口</a> |
						<a href="http://www.jx3pve.com/interface/help2" title="如何保存对插件的设置？" target="_blank">数据同步</a> |
						<a href="http://www.jx3pve.com/forum.php?mod=forumdisplay&fid=72">插件论坛</a>
					</span>
				</div>
				<div class="addon-page">

			        <div class="addon-wp">
						<?php while ( have_posts() ) : the_post(); ?>
						<span id="post-<?php the_ID(); ?>" <?php post_class(); ?>></span>
					</div>

					<!--插件图标-->	
					<div class="addon-icon"><span type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=718"></span></div>

					<!--插件描述-->
					<div class="addon-ct">
						<div class="addon-qcin"><?php the_content(); ?>
								<ul>
									<li class="addon-qcin-1"><a href="http://www.jx3pve.com/forum.php?mod=viewthread&tid=3308"></a></li>
									<li class="addon-qcin-2"><a href="http://www.jx3pve.com/forum.php?mod=forumdisplay&fid=72"></a></li>
									<li class="addon-qcin-3"><a href="http://www.jx3pve.com/forum.php?mod=viewthread&tid=88"></a></li>
									<li class="addon-qcin-4"><a href="http://www.jx3pve.com/addon/pbaddon/"></a></li>
									<li class="addon-qcin-5"><a href="http://www.jx3pve.com/portal.php?mod=topic&topicid=13"></a></li>
								</ul>
						</div>
						<div class="addon-ac"><span id="fav-heart">♥</span> 精品插件 轻松游戏 <span id="fav-heart">♥</span></div>
						<div class="addon-list-index"><h2>团队副本</h2><p>Raid & Fam</p><?php the_field('addon-1'); ?></div>
						<div class="addon-list-index"><h2>战斗辅助</h2><p>Combat</p><?php the_field('addon-2'); ?></div>
						<div class="addon-list-index"><h2>界面美化</h2><p>Landscaping</p><?php the_field('addon-3'); ?></div>
						<div class="addon-list-index"><h2>实用工具</h2><p>Other Tools</p><?php the_field('addon-4'); ?></div>
						<div class="addon-list-index"><h2>配装辅助</h2><p>Professional</p><?php the_field('addon-5'); ?></div>
						<div class="addon-list-index"><h2>按键辅助</h2><p>Press Tools</p><?php the_field('addon-6'); ?></div>
					</div><!-- .entry-content -->
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>