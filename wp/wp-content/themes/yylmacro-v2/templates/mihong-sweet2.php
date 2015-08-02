<?php
/**
 * Template Name: == 糖果觅宏1 ==
 * @www.shadowsky.cn
 */
get_header(); ?> 
<div id="main" class="souhong">
	<div id="primary">
		<div id="content" class="cat-macro-list" role="main">

			<div id="mihong-content1" role="main">
				<div class="somacro-1">
					<h1 class="cat-macro-title">寻寻觅觅——就在这里。</h1>
					<!--搜索框-->
					<div id="mihong-search">
					<form role="search" method="get" id="searchform" class="searchform" action="http://www.yylmacro.com/index.php">
									<div>
										<label class="screen-reader-text" for="s">搜索：</label>
										<input type="text" value="" name="s" id="s" />
										<input type="submit" id="searchsubmit" value="搜索" />
									</div>
					</form>
					</div>
				</div>
				
				<div class="somacro-2"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
				
				<div class="somacro-3">
				<!--侧边栏调用-->
				<div id="mihong-choose">
					<div id="share-button"><a href="http://www.yylmacro.com/share" title="发布超级宏"></a></div>
					<div id="list-sidebar"><p style="text-align: right;"><a title="傻瓜式中文写宏" href="http://www.yylmacro.com/thread-3074-1-1.html" target="_blank">可视化编辑器</a> | <a title="超级宏教程" href="http://www.yylmacro.com/study/documents" target="_blank">撰写教程</a> | <a href="http://www.yylmacro.com/thread-3021-1-1.html" target="_blank" style="color:#ff0000 !important;font-weight:bold;" title="超级宏常见问题解答·详细手册">在线帮助</a></p>
					</div>
					<div id="clear"></div>
				</div>
				</div>
				<div class="clear"></div>
		</div><!-- #content1 -->
		
		<!--分类引导-->
				<div id="mihong-cat">
					<ul id="catmenpai-ingame">
						<li id="smcat-bx"><a href="<?php bloginfo('url'); ?>/cloud/category/qixiu" title="" class="button bx serif skew glossy" data-icon="☂">七秀</a></li>
						<li id="smcat-qc"><a href="<?php bloginfo('url'); ?>/cloud/category/qichun" title="" class="button qc serif skew glossy" data-icon="☯">气纯</a></li>	
						<li id="smcat-dj"><a href="<?php bloginfo('url'); ?>/cloud/category/dujing" title="" class="button dj serif skew glossy" data-icon="☣">毒经</a></li>
						<li id="smcat-tl"><a href="<?php bloginfo('url'); ?>/cloud/category/tianluo" title="" class="button tl serif skew glossy" data-icon="✪">天罗</a></li>
						
						<li id="smcat-tc"><a href="<?php bloginfo('url'); ?>/cloud/category/tiance" title="" class="button tc serif skew glossy" data-icon="♬">天策</a></li>	
						<li id="smcat-mz"><a href="<?php bloginfo('url'); ?>/cloud/category/mingjiao" title="" class="button mz serif skew glossy" data-icon="☪">明教</a></li>
						<li id="smcat-hs"><a href="<?php bloginfo('url'); ?>/cloud/category/shaolin" title="" class="button hs serif skew glossy" data-icon="☀">少林</a></li>

						<li id="smcat-hj"><a href="<?php bloginfo('url'); ?>/cloud/category/wanhua" title="" class="button hj serif skew glossy" data-icon="✿">万花</a></li> 
						<li id="smcat-jc"><a href="<?php bloginfo('url'); ?>/cloud/category/jianchun" title="" class="button jc serif skew glossy" data-icon="✝">剑纯</a></li>
						<li id="smcat-bt"><a href="<?php bloginfo('url'); ?>/cloud/category/butian" title="" class="button bt serif skew glossy" data-icon="ஐ">补天</a></li>
						<li id="smcat-jy"><a href="<?php bloginfo('url'); ?>/cloud/category/jingyu" title="" class="button jy serif skew glossy" data-icon="➷">惊羽</a></li>

						<li id="smcat-cj"><a href="<?php bloginfo('url'); ?>/cloud/category/cangjian" title="" class="button cj serif skew glossy" data-icon="♫">藏剑</a></li>
						<li id="smcat-gb"><a href="<?php bloginfo('url'); ?>/cloud/category/gaibang" title="" class="button gb serif skew glossy" data-icon="♨">丐帮</a></li>	
						<li id="smcat-fy"><a href="<?php bloginfo('url'); ?>/cloud/category/tongyong" title="" class="button fy serif skew glossy" data-icon="❤">通用</a></li>
					</ul>
					<div id="clear"></div>
				</div>

		<div id="cat-table">
				<div class="cat-table">
				<?php if ( have_posts() ) : ?>	 
				 <div id="cat-macro-list-title">
				   <span class="cat-macro-list-td1" id="cat-cloudid2">云端ID</span>
				   <span class="cat-macro-list-td1" id="cat-time2" style="text-align:center">更新日期</span>
				   <span class="cat-macro-list-td1" id="cat-title2" style="text-align:center">标 题</a></span>
				   <span class="cat-macro-list-td1" id="cat-author2">作 者</span>	
				   <span class="cat-macro-list-td1" id="cat-xunzhang2"><!--勋 章--></span>
				 </div>
				 
					<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args=array('orderby' => 'modified','paged' => $paged,'order' => 'DESC');
					query_posts($args);
					while ( have_posts() ) : the_post(); ?>
					<?php /* Start the Loop */ ?>

				 <div id="cat-macro-list-tr">
					 <a href="<?php the_permalink(); ?>" rel="bookmark">
						 <p>
						   <span class="cat-macro-list-td" id="cat-cloudid"><?php the_ID(); ?></span>   
						   <span class="cat-macro-list-td" id="cat-time">[ <?php the_modified_time('Ymd'); ?> ]</span>		   
						   <span class="cat-macro-list-td" id="cat-title1">&reg; <?php the_title(); ?></span>
						   <span class="cat-macro-list-td" id="cat-author"><?php the_author(); ?></span>
						  </p>	  	  
					  </a>
				  </div>
					<?php endwhile;?>  
				
				</div>
		</div>

		 <div id="macro-list-page"><?php wp_pagenavi(); ?></div>
				<?php endif; ?>
		<div id="list-bottom-bar"><?php dynamic_sidebar( 'sidebar-8' ); ?></div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<div id="clear"><div style="display:none;"><?php dynamic_sidebar( 'sidebar-2' ); ?></div></div>
</div><!-- #box -->
</body>
</html>