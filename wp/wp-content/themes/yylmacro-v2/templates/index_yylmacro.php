<?php
/**
 * Template Name: == 超级宏首页v0.2 ==
 * @www.shadowsky.cn
 */
get_header(); ?>

<div id="yyl-homepage">

<div id="primary" class="site-content-yylindex">
        <?php while ( have_posts() ) : the_post(); ?>
		<div id=""><?php the_content(); ?></div>
		<?php endwhile; // end of the loop. ?>
		<div id="content" class="site-content-yylindex-content" role="main">
				<?php the_content(); ?>
                <div id="logo"><!--<a href="#" title="超级宏，超乎你的想象！"> </a>--></div>
                <div id="download"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
		</div><!-- #content -->  
		
		<div class="yylmacro-index-welcome">
		<div class="yylmacro-index-welcome-content">

        <div id="yylnews" class="yylnews-hot">	
		<div id="hotnews_yyl">最新 · What's new?</div>
		<?php wp_nav_menu( array( 'theme_location' => 'indexnews_yylmacro', 'menu_class' =>'nav-menu' ) ); ?>
		</div>
		
        <div id="yylmacro-catforindex" class="yylmacro-catforindex-content">
           <ul>
	        <li class="yylmacro-index-caticon1"><a href="http://www.yylmacro.com/cloud/category/qixiu" title="七秀宏" alt="七秀宏"> </a></li>
			<li class="yylmacro-index-caticon2"><a href="http://www.yylmacro.com/cloud/category/wanhua" title="万花宏" alt="万花宏"> </a></li>
			<li class="yylmacro-index-caticon3"><a href="http://www.yylmacro.com/cloud/category/wudu" title="五毒宏" alt="五毒宏"> </a></li>
			<li class="yylmacro-index-caticon4"><a href="http://www.yylmacro.com/cloud/category/chunyang" title="纯阳宏" alt="纯阳宏"> </a></li>
			<li class="yylmacro-index-caticon5"><a href="http://www.yylmacro.com/cloud/category/tangmen" title="唐门宏" alt="唐门宏"> </a></li>
			<li class="yylmacro-index-caticon6"><a href="http://www.yylmacro.com/cloud/category/cangjian" title="藏剑宏" alt="藏剑宏"> </a></li>
			<li class="yylmacro-index-caticon7"><a href="http://www.yylmacro.com/cloud/category/tiance" title="天策宏" alt="天策宏"> </a></li>
			<li class="yylmacro-index-caticon8"><a href="http://www.yylmacro.com/cloud/category/shaolin" title="少林宏" alt="少林宏"> </a></li>
			<li class="yylmacro-index-caticon9"><a href="http://www.yylmacro.com/cloud/category/mingjiao" title="明教宏" alt="明教宏"> </a></li>
			<li class="yylmacro-index-caticon10"><a href="http://www.yylmacro.com/cloud/category/gaibang" title="丐帮宏" alt="丐帮宏"> </a></li>
			<li class="yylmacro-index-caticon11"><a href="http://www.yylmacro.com/cloud/category/tongyong" title="通用宏" alt="通用宏"> </a></li>
			<li class="yylmacro-index-caticon12"><a href="http://www.yylmacro.com/share" title="" alt=""> </a></li>
          </ul>
		</div>

		<div id="yylinks-yylindex" class="yylinks-yylindex">
		<ul>
			<li class="yylinks1"><a title="剑三官网" href="http://jx3.xoyo.com/" target="_blank">剑三官网</a></li>
			<li class="yylinks2"><a title="团队事件监控" href="http://www.j3ui.com/" target="_blank">团队监控</a></li>
			<li class="yylinks3"><a title="剑三盒子插件" href="http://jx3.duowan.com/yy/" target="_blank">多玩盒子</a></li>
			<li class="yylinks4"><a title="海鳗PVP插件" href="http://haimanchajian.com/" target="_blank">海鳗插件</a></li>
			<li class="yylinks5"><a title="玩家制作开发的计算查询网站" href="http://paiba.me/jx3/" target="_blank">剑三应用</a></li>
			<li class="yylinks4"><a title="胖叔叔·剑三在线配装" href="http://jx3dps.sinaapp.com/" target="_blank">在线配装</a></li>
			<li class="yylinks6"><a title="西山居贴吧" href="http://tieba.baidu.com/f?ie=utf-8&kw=%E8%A5%BF%E5%B1%B1%E5%B1%85" target="_blank">西山居</a></li>
			<li class="yylinks7"><a title="超级宏贴吧" href="http://tieba.baidu.com/f?kw=%B3%AC%BC%B6%BA%EA" target="_blank">超级宏贴吧</a></li>
		</ul>		
		</div>

        <div id="clear"></div>
        </div>
		</div>

</div>

</div>
<?php get_footer(); ?>