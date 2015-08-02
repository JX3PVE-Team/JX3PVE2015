<?php
/**
 * Template Name: == 糖果觅宏2 ==
 * @www.shadowsky.cn
 */
get_header(); ?> 
<div class="box yylmacro">
	<div class="main">
		<!-- 居中内容wrap -->
		<div class="wp">
			<!-- 头部广告 -->
			<div class="banner souhongtop"><script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=685"></script></div>
			<!-- 内容区 -->
			<div class="mihong">
				<!--#文章头部-->
				<div class="cat-nav">
					
					<h1>寻寻觅觅</h1>
						
					<!--分类引导-->
					<ul class="cat-list">
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/qixiu" title="" class="button bx serif skew glossy" data-icon="☂">七秀</a></li>
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/qichun" title="" class="button qc serif skew glossy" data-icon="☯">气纯</a></li>	
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/dujing" title="" class="button dj serif skew glossy" data-icon="☣">毒经</a></li>
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/tianluo" title="" class="button tl serif skew glossy" data-icon="✪">天罗</a></li>
						
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/tiance" title="" class="button tc serif skew glossy" data-icon="♬">天策</a></li>	
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/mingjiao" title="" class="button mz serif skew glossy" data-icon="☪">明教</a></li>
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/shaolin" title="" class="button hs serif skew glossy" data-icon="☀">少林</a></li>

						<li><a href="<?php bloginfo('url'); ?>/cloud/category/wanhua" title="" class="button hj serif skew glossy" data-icon="✿">万花</a></li> 
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/jianchun" title="" class="button jc serif skew glossy" data-icon="✝">剑纯</a></li>
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/butian" title="" class="button bt serif skew glossy" data-icon="ஐ">补天</a></li>
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/jingyu" title="" class="button jy serif skew glossy" data-icon="➷">惊羽</a></li>

						<li><a href="<?php bloginfo('url'); ?>/cloud/category/cangjian" title="" class="button cj serif skew glossy" data-icon="♫">藏剑</a></li>
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/gaibang" title="" class="button gb serif skew glossy" data-icon="♨">丐帮</a></li>	
						<li><a href="<?php bloginfo('url'); ?>/cloud/category/tongyong" title="" class="button fy serif skew glossy" data-icon="❤">通用</a></li>
					</ul>		
				</div><!-- cat-nav-->
				


				<div class="cat-table">
					<?php if ( have_posts() ) : ?>
					<ul class="list-hd">
						<li> 
							<span class="cat-cloudid">云端ID</span>
							<span class="cat-time">更新日期</span>
							<span class="cat-title">标 题</a></span>
							<span class="cat-author">作 者</span>
						</li>	
					</ul>
						 
					<ul class="list-ct">
						<?php 
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$args=array('orderby' => 'modified','paged' => $paged,'order' => 'DESC');
							query_posts($args);
							while ( have_posts() ) : the_post(); ?>
						<?php /* Start the Loop */ ?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
								<span class="cat-cloudid"> <?php the_ID(); ?></span>   
								<span class="cat-time"> [ <?php the_modified_time('Ymd'); ?> ]</span>		   
								<span class="cat-title"> &reg; <?php the_title(); ?></span>
								<span class="cat-author"> <?php the_author(); ?></span>
							</a>
						</li>
						<?php endwhile;?>  
					</ul>
				</div>

						<!-- 分页 -->
				<div class="cat-pages"><?php wp_pagenavi(); ?></div>
					<?php endif; ?>
			</div><!-- #primary -->
			<!-- 底部banner -->
			<div class="banner souhongbot"><script type="text/javascript" src="http://www.jx3pve.com/api.php?mod=js&bid=684"></script></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
