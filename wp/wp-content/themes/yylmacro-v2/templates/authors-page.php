<?php
/**
 * Template Name: == 作者团队 ==
 * @www.shadowsky.cn
 */

?>
<head>
<meta http-equiv="refresh" content="0;url=http://www.yylmacro.com/portal.php?mod=topic&topicid=13"> 
</head>

<div id="otherpages">
<div id="main" class="yz-main">
	<div id="primary" class="site-content">
		<div id="content" class="author-page" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php //get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

<!--
<div id="allauthors">
<div id="allauthors-title">全部作者<span>(点击可查看对应作品)<span></div>
<ul><?php //wp_list_authors('%'); ?>
<div id="clear"></div>
</ul>
</div>
-->

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>