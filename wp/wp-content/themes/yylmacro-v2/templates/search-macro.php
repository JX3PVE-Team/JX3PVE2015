<?php
/**
 * Template Name: == 搜宏栏目 ==
 * @www.shadowsky.cn
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?> - <?php bloginfo('description'); ?></title>
<meta name="keywords" content="超级宏,剑三宏,剑网3超级宏,剑网3,剑3,插件,剑网3插件,PVE插件,七秀宏,冰心宏,万花宏,花间宏,五毒宏,毒经宏,奶毒宏,少林宏,和尚宏,易经宏,洗髓宏,天策宏,傲血宏,铁牢宏,明教宏,明尊宏,焚影宏,唐门宏,天罗宏,惊羽宏,纯阳宏,气纯宏,剑纯宏,藏剑宏,丐帮宏" />
<meta name="author" content="Shadow" />
<meta name="Description" content="《剑网3》超级宏官网: 剑侠情缘3/剑三宏下载与分享，最全最新的宏网站。" />
<link rel="stylesheet" id="twentytwelve-style-css" href="<?php bloginfo('url'); ?>/wp-content/themes/twentytwelve/style.css" type="text/css" media="all">
</head>

<body <?php body_class(); ?>>
<div id="box">
<div id="search-yylmacro" class="yylmacro-ingame">
<div id="header-ingame" class="header-ingame">
<div id="logo-ingame"  class="logo-ingame">YYLMACRO.com</div>
<div id="search-ingame"><form role="search" method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>/">
				<div>
					<label class="screen-reader-text" for="s">搜索：</label>
					<input type="text" value="" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="搜索" />
				</div>
			</form></div>
</div>
<ul id="catmenpai-ingame">
	<li id="smcat-bx"><a href="" title="">冰心</a></li>
	<li id="smcat-hj"><a href="" title="">花间</a></li>
	<li id="smcat-dj"><a href="" title="">毒经</a></li>
	<li id="smcat-bt"><a href="" title="">补天</a></li>
	<li id="smcat-tc"><a href="" title="">天策</a></li>
	<li id="smcat-hs"><a href="" title="">少林</a></li>
	<li id="smcat-fy"><a href="" title="">焚影</a></li>
	<li id="smcat-mz"><a href="" title="">明尊</a></li>
	<li id="smcat-qc"><a href="" title="">气纯</a></li>
	<li id="smcat-jc"><a href="" title="">剑纯</a></li>
	<li id="smcat-tl"><a href="" title="">天罗</a></li>
	<li id="smcat-jy"><a href="" title="">惊羽</a></li>
	<li id="smcat-cj"><a href="" title="">藏剑</a></li>
	<li id="smcat-gb"><a href="" title="">丐帮</a></li>
</ul>
<div id="clear"></div>
<div id="list-ingame">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', 'page' ); ?>
<?php endwhile; // end of the loop. ?>
<?php if ( have_posts() ) : ?>
<div class="list-ingame-table">
		 
 		 <div id="list-ingame-table-title">
		   <span class="list-ingame-td1" id="ingamecat-cloudid">云端ID</span>
		   <span class="list-ingame-td1" id="ingamecat-title" style="text-align:center">标 题</a></span>
		   <span class="list-ingame-td1" id="ingamecat-author">作 者</span>
		   <span class="list-ingame-td1" id="ingamecat-xunzhang">勋 章</span>
		   <span class="list-ingame-td1" id="ingamecat-users">使用次数</span>
		 </div>

<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args=array(
'orderby' => 'modified',
'showposts' => 6,
'paged' => $paged,
'order' => 'DESC'
);
query_posts($args);
while ( have_posts() ) : the_post(); ?>
<?php /* Start the Loop */ ?>
         
 		 <div id="list-ingame-tr"><a href="<?php the_permalink(); ?>" rel="bookmark">
		   <span class="list-ingame-td" id="ingamecat-cloudid"><?php the_ID(); ?></span>
		   <span class="list-ingame-td" id="ingamecat-title">&reg; <?php the_title(); ?></span>
		   <span class="list-ingame-td" id="ingamecat-author"><?php the_field('yylmacro_yoursname'); ?></span>	   
		   <span class="list-ingame-td" id="ingamecat-xunzhang"><div id="ingamecat-xunzhang-img"><?php the_field('yylmacro_xunzhang'); ?></div></span>
		   <span class="list-ingame-td" id="ingamecat-users"></span>
         </a></div>
         
<?php endwhile;?>  		
</div>

 <div id="macro-list-page"><?php wp_pagenavi(); ?></div>
<?php endif; ?>


</div>
</div>

</body>
</html>