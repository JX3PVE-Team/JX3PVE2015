<?php
/**
 * The Template for displaying all single posts
 * 文章页面
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 
 // 新增 GetHash 提前调用content.php 防止加载 header
/*
if(isset($_GET['GetHash'])){
	while ( have_posts() ) : the_post();
	get_template_part( 'content', get_post_format() );
	endwhile; // end of the loop.
}
*/
get_header(); ?>
			<?php while ( have_posts() ) : the_post(); // start the loop.?>
            <?php get_template_part( 'content', get_post_format() ); ?> 
			<?php endwhile; // end of the loop. ?>

				
        


	

	
	
