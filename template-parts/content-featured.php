<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Leopold
 */

?>
<?php $cat = get_the_category();?>

<article id="post-<?php the_ID(); ?>" 
<?php post_class( array( 
	$cat[0]->slug . '-border-color',
	'featured-article'
	)
); ?>>

	<div class="featured-container">

		<?php 

		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		
		?>

		<div class="featured-content-container">

			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php leopold_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; 

			the_excerpt();
	
		?>

		</div>

	</div>

</article><!-- #post-## -->
