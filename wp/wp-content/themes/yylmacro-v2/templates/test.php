<?php
/**
 * Template Name: == TEST ==
 * @www.shadowsky.cn
 */
get_header(); ?>

			<?php while ( have_posts() ) : the_post(); // start the loop.?>
				
			<?php /*
			$wp_uid = get_post($id)->post_author;
			$wp_uid = $uid = $user = get_userdata( $id );
			echo <img src="http://dz.yylmacro.com/uc_server/avatar.php?uid=$uid&size=big" width="150px" height="150px" alt="<?php the_author(); ?>" />
			*/
			?>
			<?php 
			print_r(the_content() );
			var_dump(the_content());
			?>
			<?php the_content() ?>
			
			<?php endwhile; // end of the loop. ?>
			
<?php get_footer(); ?>