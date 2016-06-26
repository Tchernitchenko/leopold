<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Leopold
 */

$cat = get_the_category();

if ( get_post_format() === 'status' && is_home() ) {
	$small_format = 'small-format';
} else {
	$small_format = '';
}
?>
<article id="post-<?php the_ID(); ?>" 
<?php post_class( array( 
	$cat[0]->slug . '-border-color',
	$small_format
	)
); ?>>

	<header class="entry-header">

		<?php if ( has_post_thumbnail()): ?>

			<image itemprop="image" src="<?php echo the_post_thumbnail_url(); ?>" />

			<!-- For facebook share button -->
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>
			<link rel="image_src" href="<?php echo $image[0]; ?>"/>

		<?php endif; ?>

		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php leopold_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>


	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		if ( !is_single() ) {
			the_excerpt();
		} else {
			the_content();
		}

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'leopold' ),
			'after'  => '</div>',
		) );
			
		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ): ?>
	<footer class="entry-footer">
		<?php leopold_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
