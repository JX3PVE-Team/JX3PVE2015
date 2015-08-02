<?php
/**
 * Template Name: == 微信APP ==
 * @www.shadowsky.cn
 */

get_header(); ?>
<div class="webapp">
	<div id="primary" class="site-content">
		<div id="content" role="main" class="webapp-content">
			<ul>
				<li class="app-list">微信公众号：<span style="color: #ff0000;">剑网3米</span>（jx3love）</li>
				<li class="app-list"><span style="color: #000000;">[ <a href="http://static.yylmacro.com/download/jx3me_0.2_android.apk">点击下载</a> ]</span><br />
				扫描二维码直接下载<br />
				Android(安卓)应用安装包</li>
				<li class="app-list" id="app-list-item-ios"><span style="color: #000000;">[ <a href="http://static.yylmacro.com/download/jx3me_0.2_iosbrk.ipa">点击下载</a> ]</span><br />
				扫描二维码直接下载<br />
				iOS(苹果·越狱)应用安装包</li>
			</ul>	
			<?php //while ( have_posts() ) : the_post(); ?>
				<?php //the_content(); ?>
			<?php //endwhile; // end of the loop. ?>     

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>