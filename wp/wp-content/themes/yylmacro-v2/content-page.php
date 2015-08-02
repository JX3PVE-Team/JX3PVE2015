<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<div id="article">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="entry-content">
			<?php the_content(); ?>

			 <div id="doc-pages">
		    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<span>分页阅读</span>' ), 'after' => '</div>' ) ); ?>
		    </div>
		</div><!-- .entry-content -->
		
		
	</article><!-- #post -->
</div>